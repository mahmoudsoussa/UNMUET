<?php
/**
 * UNMUTE — WooCommerce integration.
 *
 * Design decisions:
 * - No core WooCommerce template overrides. The shop loop is rebuilt through
 *   WooCommerce's own hook API (removing the default loop-item callbacks and
 *   rendering `unmute_product_card()` instead), which keeps the theme
 *   upgrade-safe across WooCommerce versions.
 * - Single product, cart, checkout and account pages use WooCommerce core
 *   templates, restyled with CSS and extended through hooks only.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

/* ------------------------------------------------------------------------
 * Loop: replace default card output with the UNMUTE card.
 * ---------------------------------------------------------------------- */

add_action(
	'wp',
	function () {
		if ( ! function_exists( 'unmute_product_card' ) ) {
			return;
		}
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_rating', 5 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

		add_action(
			'woocommerce_before_shop_loop_item',
			function () {
				unmute_product_card();
			},
			10
		);
	}
);

/* ------------------------------------------------------------------------
 * Page wrapper (container) around WooCommerce content.
 * ---------------------------------------------------------------------- */

add_action(
	'woocommerce_before_main_content',
	function () {
		echo '<div class="unmute-container unmute-shop-wrap">';
	},
	5
);

add_action(
	'woocommerce_after_main_content',
	function () {
		echo '</div><!-- .unmute-shop-wrap -->';
	},
	5
);

// The theme has no sidebar; keep the shop full width.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/* ------------------------------------------------------------------------
 * Shop layout options.
 * ---------------------------------------------------------------------- */

add_filter(
	'loop_shop_columns',
	function () {
		return max( 2, min( 4, (int) unmute_option( 'shop_columns' ) ) );
	}
);

add_filter(
	'loop_shop_per_page',
	function () {
		return max( 4, min( 48, (int) unmute_option( 'shop_per_page' ) ) );
	}
);

/* ------------------------------------------------------------------------
 * Breadcrumb styling hooks.
 * ---------------------------------------------------------------------- */

add_filter(
	'woocommerce_breadcrumb_defaults',
	function ( $defaults ) {
		$defaults['wrap_before'] = '<nav class="unmute-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'unmute' ) . '">';
		$defaults['wrap_after']  = '</nav>';
		$defaults['separator']   = ' / ';
		$defaults['before']      = '<span class="unmute-breadcrumbs__crumb">';
		$defaults['after']       = '</span>';
		return $defaults;
	}
);

/* ------------------------------------------------------------------------
 * Cart icon live count (AJAX fragments).
 * ---------------------------------------------------------------------- */

add_filter(
	'woocommerce_add_to_cart_fragments',
	function ( $fragments ) {
		$fragments['span.unmute-cart-count'] = '<span class="unmute-cart-count">' . esc_html( WC()->cart->get_cart_contents_count() ) . '</span>';
		return $fragments;
	}
);

/* ------------------------------------------------------------------------
 * Single product: made-to-order shipping & returns blocks.
 * ---------------------------------------------------------------------- */

add_action(
	'woocommerce_after_single_product_summary',
	function () {
		$shipping = unmute_option( 'single_shipping' );
		$returns  = unmute_option( 'single_returns' );
		if ( ! $shipping && ! $returns ) {
			return;
		}
		echo '<section class="unmute-product-info">';
		if ( $shipping ) {
			echo '<div class="unmute-product-info__item">' . unmute_icon( 'truck' ) . '<div><h3>' . esc_html__( 'Shipping & production', 'unmute' ) . '</h3><p>' . esc_html( $shipping ) . '</p></div></div>';
		}
		if ( $returns ) {
			echo '<div class="unmute-product-info__item">' . unmute_icon( 'shield' ) . '<div><h3>' . esc_html__( 'Returns & exchanges', 'unmute' ) . '</h3><p>' . esc_html( $returns ) . '</p></div></div>';
		}
		echo '</section>';
	},
	15
);

/* ------------------------------------------------------------------------
 * Search: include products in site search results.
 * ---------------------------------------------------------------------- */

add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
			return;
		}
		$query->set( 'post_type', array( 'post', 'product' ) );
	}
);

/* ------------------------------------------------------------------------
 * Placeholder image for products without photography.
 * ---------------------------------------------------------------------- */

add_filter(
	'woocommerce_placeholder_img_src',
	function () {
		return get_theme_file_uri( 'assets/img/product-placeholder.svg' );
	}
);

/* ------------------------------------------------------------------------
 * Wishlist plugins: keep their loop button out of the default position so
 * it does not render twice (UNMUTE prints it inside the card instead).
 * ---------------------------------------------------------------------- */

add_action(
	'wp',
	function () {
		global $wp_filter;

		$hooks = array( 'woocommerce_after_shop_loop_item', 'woocommerce_after_shop_loop_item_title' );

		foreach ( $hooks as $hook ) {
			if ( empty( $wp_filter[ $hook ] ) || ! is_object( $wp_filter[ $hook ] ) ) {
				continue;
			}
			foreach ( (array) $wp_filter[ $hook ]->callbacks as $priority => $callbacks ) {
				foreach ( $callbacks as $callback ) {
					$fn    = $callback['function'];
					$class = '';
					if ( is_array( $fn ) && is_object( $fn[0] ) ) {
						$class = get_class( $fn[0] );
					} elseif ( is_string( $fn ) ) {
						$class = $fn;
					}
					if ( $class && ( 0 === strpos( $class, 'YITH_WCWL' ) || 0 === strpos( $class, 'TInvWL' ) ) ) {
						remove_action( $hook, $fn, $priority );
					}
				}
			}
		}
	},
	20
);

/* ------------------------------------------------------------------------
 * Related products: match the shop grid columns.
 * ---------------------------------------------------------------------- */

add_filter(
	'woocommerce_output_related_products_args',
	function ( $args ) {
		$args['columns'] = 4;
		$args['posts_per_page'] = 4;
		return $args;
	}
);
