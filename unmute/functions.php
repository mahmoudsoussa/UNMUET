<?php
/**
 * UNMUTE theme — functions & definitions.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

define( 'UNMUTE_VERSION', '1.0.0' );

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
				'width'       => 220,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );

		// WooCommerce.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		register_nav_menus(
			array(
				'primary'    => esc_html__( 'Primary navigation', 'unmute' ),
				'footer'     => esc_html__( 'Footer — company', 'unmute' ),
				'footer-help' => esc_html__( 'Footer — help & policies', 'unmute' ),
			)
		);

		add_editor_style( 'assets/css/editor.css' );

		$GLOBALS['content_width'] = 1200;
	}
}
add_action( 'after_setup_theme', 'unmute_setup' );

if ( ! function_exists( 'unmute_assets' ) ) {
	/**
	 * Enqueue styles & scripts.
	 */
	function unmute_assets() {
		wp_enqueue_style( 'unmute-style', get_stylesheet_uri(), array(), UNMUTE_VERSION );

		wp_enqueue_style( 'unmute-main', get_theme_file_uri( 'assets/css/main.css' ), array( 'unmute-style' ), UNMUTE_VERSION );

		$fonts = unmute_google_fonts_url();
		if ( $fonts ) {
			wp_enqueue_style( 'unmute-fonts', $fonts, array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		}

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
			)
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'unmute_assets' );

if ( ! function_exists( 'unmute_resource_hints' ) ) {
	/**
	 * Preconnect for Google Fonts.
	 *
	 * @param array  $urls URLs.
	 * @param string $relation_type Relation.
	 * @return array
	 */
	function unmute_resource_hints( $urls, $relation_type ) {
		if ( 'preconnect' === $relation_type && unmute_google_fonts_url() ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}
		return $urls;
	}
}
add_filter( 'wp_resource_hints', 'unmute_resource_hints', 10, 2 );

if ( ! function_exists( 'unmute_google_fonts_url' ) ) {
	/**
	 * Google Fonts URL (display face selectable in the Customizer).
	 *
	 * @return string
	 */
	function unmute_google_fonts_url() {
		$display = unmute_option( 'font_display' );
		$map     = array(
			'marker' => 'Permanent+Marker',
			'brush'  => 'Caveat+Brush',
			'salt'   => 'Rock+Salt',
		);
		$family  = isset( $map[ $display ] ) ? $map[ $display ] : $map['marker'];

		$families = array(
			'Manrope:wght@400;500;600;700;800',
			'Cormorant+Garamond:ital,wght@0,500;0,600;1,500;1,600',
			$family,
		);

		/**
		 * Filter the Google Fonts URL. Return an empty string to self-host fonts.
		 *
		 * @param string $url
		 */
		return apply_filters( 'unmute_google_fonts_url', 'https://fonts.googleapis.com/css2?family=' . implode( '&family=', $families ) . '&display=swap' );
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
			'marker' => "'Permanent Marker', cursive",
			'brush'  => "'Caveat Brush', cursive",
			'salt'   => "'Rock Salt', cursive",
		);
		$cols    = max( 2, min( 4, (int) unmute_option( 'shop_columns' ) ) );

		$css  = ':root{';
		$css .= '--unmute-bg:' . unmute_option( 'color_bg' ) . ';';
		$css .= '--unmute-surface:' . unmute_option( 'color_surface' ) . ';';
		$css .= '--unmute-surface-2:' . unmute_option( 'color_surface2' ) . ';';
		$css .= '--unmute-accent:' . unmute_option( 'color_accent' ) . ';';
		$css .= '--unmute-accent-2:' . unmute_option( 'color_accent2' ) . ';';
		$css .= '--unmute-text:' . unmute_option( 'color_text' ) . ';';
		$css .= '--unmute-muted:' . unmute_option( 'color_muted' ) . ';';
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
		return $classes;
	}
}
add_filter( 'body_class', 'unmute_body_classes' );

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
				'posts'    => array(
					'about-unmute' => array(
						'post_title'   => _x( 'About UNMUTE', 'Starter content', 'unmute' ),
						'post_content' => __( 'Your feelings deserve a voice. Wear them. UNMUTE is an art-driven darkwear label: original drawings, heavyweight fabric, limited runs.', 'unmute' ),
						'post_type'    => 'page',
					),
				),
				'nav_menus' => array(
					'primary' => array(
						'name'  => __( 'Primary navigation', 'unmute' ),
						'items' => array(
							'page_about' => array(
								'type'    => 'post_type',
								'object'  => 'page',
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
