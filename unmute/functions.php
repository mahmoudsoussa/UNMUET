<?php
/**
 * UNMUTE theme — functions & definitions.
 *
 * EXPRESS WITHOUT LIMITS.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

define( 'UNMUTE_VERSION', '2.0.0' );

require get_theme_file_path( 'inc/template-tags.php' );
require get_theme_file_path( 'inc/customizer.php' );
require get_theme_file_path( 'inc/ajax.php' );
require get_theme_file_path( 'inc/woocommerce.php' );

if ( ! function_exists( 'unmute_setup' ) ) {
	/**
	 * Theme setup.
	 */
	function unmute_setup() {
		load_theme_textdomain( 'unmute', get_theme_file_path( 'languages' ) );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
		);
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 64,
				'width'       => 240,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );
		add_editor_style( array( 'assets/css/fonts.css', 'assets/css/editor.css' ) );

		// WooCommerce.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		register_nav_menus(
			array(
				'primary'     => esc_html__( 'Primary navigation', 'unmute' ),
				'footer'      => esc_html__( 'Footer — company', 'unmute' ),
				'footer-help' => esc_html__( 'Footer — help & policies', 'unmute' ),
			)
		);

		$GLOBALS['content_width'] = 1240;
	}
}
add_action( 'after_setup_theme', 'unmute_setup' );

if ( ! function_exists( 'unmute_assets' ) ) {
	/**
	 * Enqueue styles & scripts.
	 *
	 * Fonts are self-hosted (assets/fonts + assets/css/fonts.css): no
	 * render-blocking third-party request and no GDPR exposure.
	 */
	function unmute_assets() {
		wp_enqueue_style( 'unmute-fonts', get_theme_file_uri( 'assets/css/fonts.css' ), array(), UNMUTE_VERSION );
		wp_enqueue_style( 'unmute-style', get_stylesheet_uri(), array(), UNMUTE_VERSION );
		wp_enqueue_style( 'unmute-main', get_theme_file_uri( 'assets/css/main.css' ), array( 'unmute-fonts', 'unmute-style' ), UNMUTE_VERSION );

		if ( is_rtl() ) {
			wp_enqueue_style( 'unmute-rtl', get_theme_file_uri( 'assets/css/rtl.css' ), array( 'unmute-main' ), UNMUTE_VERSION );
		}

		wp_add_inline_style( 'unmute-main', unmute_css_vars() );

		wp_enqueue_script( 'unmute-main', get_theme_file_uri( 'assets/js/main.js' ), array(), UNMUTE_VERSION, true );
		wp_localize_script(
			'unmute-main',
			'unmuteData',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'unmute_newsletter' ),
				'isRtl'   => is_rtl() ? '1' : '0',
				'i18n'    => array(
					'error'   => __( 'Something went wrong. Please try again.', 'unmute' ),
					'sending' => __( 'Sending…', 'unmute' ),
				),
			)
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'unmute_assets' );

if ( ! function_exists( 'unmute_fonts_url' ) ) {
	/**
	 * Optional third-party font URL. Empty by default: the theme ships
	 * self-hosted faces (Bricolage Grotesque, Manrope, Cairo, Permanent Marker,
	 * Cormorant Garamond). Child themes may return a Google Fonts URL here.
	 *
	 * @return string
	 */
	function unmute_fonts_url() {
		/**
		 * Filter the external font stylesheet URL.
		 *
		 * @param string $url Empty by default.
		 */
		return apply_filters( 'unmute_google_fonts_url', '' );
	}
}

if ( ! function_exists( 'unmute_css_vars' ) ) {
	/**
	 * Customizer values exposed as CSS custom properties.
	 *
	 * @return string
	 */
	function unmute_css_vars() {
		$display = unmute_option( 'font_display' );
		$disp    = array(
			'marker'  => "'Permanent Marker', cursive",
			'brush'   => "'Caveat Brush', cursive",
			'salt'    => "'Rock Salt', cursive",
			'grotesk' => "'Bricolage Grotesque', sans-serif",
		);
		$cols    = max( 2, min( 4, (int) unmute_option( 'shop_columns' ) ) );

		$map = array(
			'bg'        => 'color_bg',
			'bg-2'      => 'color_bg2',
			'surface'   => 'color_surface',
			'surface-2' => 'color_surface2',
			'accent'    => 'color_accent',
			'accent-2'  => 'color_accent2',
			'accent-3'  => 'color_accent3',
			'text'      => 'color_text',
			'muted'     => 'color_muted',
		);

		$css = ':root{';
		foreach ( $map as $var => $option ) {
			$value = unmute_sanitize_hex( unmute_option( $option ) );
			if ( $value ) {
				$css .= '--unmute-' . $var . ':' . $value . ';';
			}
		}
		$css .= '--unmute-font-display:' . ( isset( $disp[ $display ] ) ? $disp[ $display ] : $disp['marker'] ) . ';';
		$css .= '--unmute-cols:' . $cols . ';';
		$css .= '}';

		return $css;
	}
}

if ( ! function_exists( 'unmute_body_classes' ) ) {
	/**
	 * Body classes.
	 *
	 * @param array $classes Classes.
	 * @return array
	 */
	function unmute_body_classes( $classes ) {
		if ( class_exists( 'WooCommerce' ) ) {
			$classes[] = 'unmute-woo-active';
		}
		if ( is_front_page() ) {
			$classes[] = 'unmute-front';
		}
		$classes[] = 'unmute-aurora';
		return $classes;
	}
}
add_filter( 'body_class', 'unmute_body_classes' );

if ( ! function_exists( 'unmute_front_products' ) ) {
	/**
	 * Products for the front-page "featured" grid, sized so the aurora promo
	 * card always fills the final cell of the desktop grid.
	 *
	 * @return array
	 */
	function unmute_front_products() {
		$source = unmute_option( 'featured_source' );
		$count  = max( 2, min( 16, (int) unmute_option( 'featured_count' ) ) );
		$limit  = max( 2, $count );

		$args = array(
			'limit'  => $limit,
			'status' => 'publish',
		);

		switch ( $source ) {
			case 'latest':
				$args['orderby'] = 'date';
				$args['order']   = 'DESC';
				break;
			case 'best_selling':
				$args['orderby'] = 'popularity';
				break;
			case 'random':
				$args['orderby'] = 'rand';
				break;
			default:
				$args['featured'] = true;
		}

		$products = wc_get_products( $args );

		if ( empty( $products ) && 'featured' === $source ) {
			$products = wc_get_products(
				array(
					'limit'   => $limit,
					'status'  => 'publish',
					'orderby' => 'date',
					'order'   => 'DESC',
				)
			);
		}

		return is_array( $products ) ? $products : array();
	}
}

if ( ! function_exists( 'unmute_excerpt_more' ) ) {
	/**
	 * Excerpt suffix.
	 *
	 * @return string
	 */
	function unmute_excerpt_more() {
		return '&hellip;';
	}
}
add_filter( 'excerpt_more', 'unmute_excerpt_more' );

if ( ! function_exists( 'unmute_starter_content' ) ) {
	/**
	 * Starter content for fresh installs.
	 */
	function unmute_starter_content() {
		add_theme_support(
			'starter-content',
			array(
				'posts'     => array(
					'about-unmute' => array(
						'post_title'   => _x( 'About UNMUTE', 'Starter content', 'unmute' ),
						'post_content' => __( 'EXPRESS WITHOUT LIMITS. UNMUTE is an art-driven label: original artwork, heavyweight fabric, limited runs. Your mind has no dress code.', 'unmute' ),
						'post_type'    => 'page',
					),
				),
				'nav_menus' => array(
					'primary' => array(
						'name'  => __( 'Primary navigation', 'unmute' ),
						'items' => array(
							'page_about' => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{about-unmute}}',
							),
						),
					),
				),
			)
		);
	}
}
add_action( 'after_setup_theme', 'unmute_starter_content', 20 );
