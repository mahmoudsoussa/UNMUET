<?php
/**
 * UNMUTE — WordPress Customizer.
 *
 * Every front-page section, brand colour, social link and shop behaviour
 * is controllable here without touching code.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'unmute_customizer_schema' ) ) {
	/**
	 * Declarative schema of all Customizer controls.
	 *
	 * @return array
	 */
	function unmute_customizer_schema() {
		return array(
			// --- Announcement bar -----------------------------------------
			array( 'bar_show', 'checkbox', __( 'Show announcement bar', 'unmute' ), 'bar' ),
			array( 'bar_text', 'text', __( 'Announcement bar text', 'unmute' ), 'bar' ),

			// --- Hero -------------------------------------------------------
			array( 'hero_show', 'checkbox', __( 'Show hero section', 'unmute' ), 'hero' ),
			array( 'hero_image', 'image', __( 'Hero artwork (replace the placeholder)', 'unmute' ), 'hero' ),
			array( 'hero_eyebrow', 'text', __( 'Hero eyebrow line', 'unmute' ), 'hero' ),
			array( 'hero_title', 'text', __( 'Hero headline', 'unmute' ), 'hero', array( 'transport' => 'postMessage' ) ),
			array( 'hero_accent', 'text', __( 'Accent word inside the headline', 'unmute' ), 'hero', array( 'transport' => 'postMessage' ) ),
			array( 'hero_text', 'textarea', __( 'Hero description', 'unmute' ), 'hero', array( 'transport' => 'postMessage' ) ),
			array( 'hero_cta', 'text', __( 'Primary button label', 'unmute' ), 'hero', array( 'transport' => 'postMessage' ) ),
			array( 'hero_url', 'url', __( 'Primary button link (empty = shop page)', 'unmute' ), 'hero' ),
			array( 'hero_cta2', 'text', __( 'Secondary button label', 'unmute' ), 'hero' ),
			array( 'hero_url2', 'url', __( 'Secondary button link (empty = collections section)', 'unmute' ), 'hero' ),

			// --- Features ---------------------------------------------------
			array( 'features_show', 'checkbox', __( 'Show features strip', 'unmute' ), 'features' ),
			array( 'f1_icon', 'select', __( 'Feature 1 icon', 'unmute' ), 'features', array( 'choices' => unmute_icon_choices() ) ),
			array( 'f1_title', 'text', __( 'Feature 1 title', 'unmute' ), 'features' ),
			array( 'f1_text', 'text', __( 'Feature 1 text', 'unmute' ), 'features' ),
			array( 'f2_icon', 'select', __( 'Feature 2 icon', 'unmute' ), 'features', array( 'choices' => unmute_icon_choices() ) ),
			array( 'f2_title', 'text', __( 'Feature 2 title', 'unmute' ), 'features' ),
			array( 'f2_text', 'text', __( 'Feature 2 text', 'unmute' ), 'features' ),
			array( 'f3_icon', 'select', __( 'Feature 3 icon', 'unmute' ), 'features', array( 'choices' => unmute_icon_choices() ) ),
			array( 'f3_title', 'text', __( 'Feature 3 title', 'unmute' ), 'features' ),
			array( 'f3_text', 'text', __( 'Feature 3 text', 'unmute' ), 'features' ),
			array( 'f4_icon', 'select', __( 'Feature 4 icon', 'unmute' ), 'features', array( 'choices' => unmute_icon_choices() ) ),
			array( 'f4_title', 'text', __( 'Feature 4 title', 'unmute' ), 'features' ),
			array( 'f4_text', 'text', __( 'Feature 4 text', 'unmute' ), 'features' ),

			// --- Featured products ------------------------------------------
			array( 'featured_show', 'checkbox', __( 'Show featured products', 'unmute' ), 'featured' ),
			array( 'featured_title', 'text', __( 'Section title', 'unmute' ), 'featured' ),
			array(
				'featured_source',
				'select',
				__( 'Which products to feature', 'unmute' ),
				'featured',
				array(
					'choices' => array(
						'featured'     => __( 'Marked as featured', 'unmute' ),
						'latest'       => __( 'Newest products', 'unmute' ),
						'best_selling' => __( 'Best sellers', 'unmute' ),
						'random'       => __( 'Random selection', 'unmute' ),
					),
				)
			),
			array( 'featured_count', 'number', __( 'Number of products', 'unmute' ), 'featured', array( 'min' => 2, 'max' => 16 ) ),

			// --- Collections --------------------------------------------------
			array( 'collections_show', 'checkbox', __( 'Show collections (product categories)', 'unmute' ), 'collections' ),
			array( 'collections_title', 'text', __( 'Section title', 'unmute' ), 'collections' ),
			array( 'collections_count', 'number', __( 'Number of collections', 'unmute' ), 'collections', array( 'min' => 2, 'max' => 12 ) ),

			// --- Story ---------------------------------------------------------
			array( 'story_show', 'checkbox', __( 'Show brand story section', 'unmute' ), 'story' ),
			array( 'story_image', 'image', __( 'Story image (replace the placeholder)', 'unmute' ), 'story' ),
			array( 'story_quote', 'textarea', __( 'Quote', 'unmute' ), 'story', array( 'transport' => 'postMessage' ) ),
			array( 'story_text', 'textarea', __( 'Story body', 'unmute' ), 'story' ),
			array( 'story_cta', 'text', __( 'Button label', 'unmute' ), 'story' ),
			array( 'story_url', 'url', __( 'Button link (empty = About page if set)', 'unmute' ), 'story' ),

			// --- Newsletter ------------------------------------------------------
			array( 'news_show', 'checkbox', __( 'Show newsletter section', 'unmute' ), 'news' ),
			array( 'news_title', 'text', __( 'Heading', 'unmute' ), 'news', array( 'transport' => 'postMessage' ) ),
			array( 'news_text', 'textarea', __( 'Description', 'unmute' ), 'news' ),
			array( 'news_action', 'url', __( 'External form action URL (Mailchimp, Klaviyo…). Empty = save subscribers locally', 'unmute' ), 'news' ),
			array( 'news_note', 'text', __( 'Privacy microcopy', 'unmute' ), 'news' ),

			// --- Colours -----------------------------------------------------------
			array( 'color_bg', 'color', __( 'Page background', 'unmute' ), 'colors', array( 'transport' => 'postMessage' ) ),
			array( 'color_surface', 'color', __( 'Surface (cards, header)', 'unmute' ), 'colors', array( 'transport' => 'postMessage' ) ),
			array( 'color_surface2', 'color', __( 'Surface 2 (bands, inputs)', 'unmute' ), 'colors', array( 'transport' => 'postMessage' ) ),
			array( 'color_accent', 'color', __( 'Accent (lavender)', 'unmute' ), 'colors', array( 'transport' => 'postMessage' ) ),
			array( 'color_accent2', 'color', __( 'Accent deep (glows, gradients)', 'unmute' ), 'colors', array( 'transport' => 'postMessage' ) ),
			array( 'color_text', 'color', __( 'Body text', 'unmute' ), 'colors', array( 'transport' => 'postMessage' ) ),
			array( 'color_muted', 'color', __( 'Muted text', 'unmute' ), 'colors', array( 'transport' => 'postMessage' ) ),
			array(
				'font_display',
				'select',
				__( 'Display (brush) font', 'unmute' ),
				'colors',
				array(
					'choices' => array(
						'marker' => __( 'Permanent Marker (default)', 'unmute' ),
						'brush'  => __( 'Caveat Brush', 'unmute' ),
						'salt'   => __( 'Rock Salt', 'unmute' ),
					),
				)
			),

			// --- Shop ---------------------------------------------------------------
			array( 'shop_columns', 'number', __( 'Product columns on desktop (2–4)', 'unmute' ), 'shop', array( 'min' => 2, 'max' => 4 ) ),
			array( 'shop_per_page', 'number', __( 'Products per shop page', 'unmute' ), 'shop', array( 'min' => 4, 'max' => 48 ) ),
			array( 'shop_new_days', 'number', __( 'Days a product counts as “New” (0 = off)', 'unmute' ), 'shop', array( 'min' => 0, 'max' => 365 ) ),
			array( 'shop_best_threshold', 'number', __( 'Sales needed for a “Bestseller” badge (0 = off)', 'unmute' ), 'shop', array( 'min' => 0, 'max' => 10000 ) ),
			array( 'single_shipping', 'textarea', __( 'Single product — shipping info block', 'unmute' ), 'shop' ),
			array( 'single_returns', 'textarea', __( 'Single product — returns info block', 'unmute' ), 'shop' ),

			// --- Footer & social -------------------------------------------------------
			array( 'footer_blurb', 'textarea', __( 'Footer brand blurb', 'unmute' ), 'footer' ),
			array( 'footer_email', 'text', __( 'Contact email', 'unmute' ), 'footer' ),
			array( 'footer_phone', 'text', __( 'Contact phone', 'unmute' ), 'footer' ),
			array( 'footer_address', 'textarea', __( 'Studio address (optional)', 'unmute' ), 'footer' ),
			array( 'footer_copyright', 'text', __( 'Copyright line (empty = automatic)', 'unmute' ), 'footer' ),
			array( 'social_instagram', 'url', __( 'Instagram URL', 'unmute' ), 'footer' ),
			array( 'social_tiktok', 'url', __( 'TikTok URL', 'unmute' ), 'footer' ),
			array( 'social_youtube', 'url', __( 'YouTube URL', 'unmute' ), 'footer' ),
			array( 'social_telegram', 'url', __( 'Telegram URL', 'unmute' ), 'footer' ),
			array( 'social_facebook', 'url', __( 'Facebook URL', 'unmute' ), 'footer' ),
			array( 'social_x', 'url', __( 'X (Twitter) URL', 'unmute' ), 'footer' ),
		);
	}
}

if ( ! function_exists( 'unmute_icon_choices' ) ) {
	/**
	 * Icon choices for feature controls.
	 *
	 * @return array
	 */
	function unmute_icon_choices() {
		return array(
			'diamond' => __( 'Diamond (quality)', 'unmute' ),
			'truck'   => __( 'Truck (shipping)', 'unmute' ),
			'shield'  => __( 'Shield (secure)', 'unmute' ),
			'headset' => __( 'Headset (support)', 'unmute' ),
			'heart'   => __( 'Heart', 'unmute' ),
			'moon'    => __( 'Moon', 'unmute' ),
			'crown'   => __( 'Crown', 'unmute' ),
		);
	}
}

if ( ! function_exists( 'unmute_sanitize_choice' ) ) {
	/**
	 * Sanitize callback factory for select controls.
	 *
	 * @param array $choices Allowed values.
	 * @return callable
	 */
	function unmute_sanitize_choice( $choices ) {
		return function ( $value, $setting ) use ( $choices ) {
			$value = is_string( $value ) ? $value : (string) $value;
			return array_key_exists( $value, $choices ) ? $value : $setting->default;
		};
	}
}

if ( ! function_exists( 'unmute_sanitize_number' ) ) {
	/**
	 * Sanitize callback factory for number controls.
	 *
	 * @param array $args min/max.
	 * @return callable
	 */
	function unmute_sanitize_number( $args ) {
		return function ( $value, $setting ) use ( $args ) {
			$value = (int) $value;
			$min   = isset( $args['min'] ) ? (int) $args['min'] : 0;
			$max   = isset( $args['max'] ) ? (int) $args['max'] : 100;
			return max( $min, min( $max, $value ) );
		};
	}
}

if ( ! function_exists( 'unmute_register_customizer' ) ) {
	/**
	 * Register panel, sections, settings & controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer.
	 */
	function unmute_register_customizer( $wp_customize ) {
		$defaults = unmute_defaults();

		$wp_customize->add_panel(
			'unmute_panel',
			array(
				'title'    => __( 'UNMUTE Brand & Store', 'unmute' ),
				'priority' => 30,
			)
		);

		$sections = array(
			'bar'         => __( 'Announcement bar', 'unmute' ),
			'hero'        => __( 'Hero', 'unmute' ),
			'features'    => __( 'Features strip', 'unmute' ),
			'featured'    => __( 'Featured products', 'unmute' ),
			'collections' => __( 'Collections', 'unmute' ),
			'story'       => __( 'Brand story', 'unmute' ),
			'news'        => __( 'Newsletter', 'unmute' ),
			'colors'      => __( 'Brand colours & type', 'unmute' ),
			'shop'        => __( 'Shop behaviour', 'unmute' ),
			'footer'      => __( 'Footer, contact & social', 'unmute' ),
		);

		$priority = 10;
		foreach ( $sections as $id => $title ) {
			$wp_customize->add_section(
				'unmute_' . $id,
				array(
					'title' => $title,
					'panel' => 'unmute_panel',
					'priority' => $priority,
				)
			);
			$priority += 10;
		}

		foreach ( unmute_customizer_schema() as $control ) {
			list( $key, $type, $label, $section ) = $control;
			$extra    = isset( $control[4] ) ? $control[4] : array();
			$default  = array_key_exists( $key, $defaults ) ? $defaults[ $key ] : '';
			$transport = isset( $extra['transport'] ) ? $extra['transport'] : 'refresh';

			$setting_args = array(
				'default'   => $default,
				'transport' => $transport,
			);

			switch ( $type ) {
				case 'checkbox':
					$setting_args['sanitize_callback'] = 'unmute_sanitize_checkbox';
					break;
				case 'color':
					$setting_args['sanitize_callback'] = 'sanitize_hex_color';
					break;
				case 'url':
				case 'image':
					$setting_args['sanitize_callback'] = 'esc_url_raw';
					break;
				case 'textarea':
					$setting_args['sanitize_callback'] = 'wp_kses_post';
					break;
				case 'select':
					$setting_args['sanitize_callback'] = unmute_sanitize_choice( $extra['choices'] );
					break;
				case 'number':
					$setting_args['sanitize_callback'] = unmute_sanitize_number( $extra );
					break;
				default:
					$setting_args['sanitize_callback'] = 'sanitize_text_field';
			}

			$wp_customize->add_setting( 'unmute_' . $key, $setting_args );

			$control_args = array(
				'label'   => $label,
				'section' => 'unmute_' . $section,
			);

			switch ( $type ) {
				case 'checkbox':
					$wp_customize->add_control( 'unmute_' . $key, $control_args );
					break;
				case 'color':
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'unmute_' . $key, $control_args ) );
					break;
				case 'image':
					$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'unmute_' . $key, $control_args ) );
					break;
				case 'textarea':
					$wp_customize->add_control( 'unmute_' . $key, array_merge( $control_args, array( 'type' => 'textarea' ) ) );
					break;
				case 'select':
					$wp_customize->add_control( 'unmute_' . $key, array_merge( $control_args, array( 'type' => 'select', 'choices' => $extra['choices'] ) ) );
					break;
				case 'number':
					$wp_customize->add_control(
						'unmute_' . $key,
						array_merge(
							$control_args,
							array(
								'type'  => 'number',
								'input_attrs' => array(
									'min'  => isset( $extra['min'] ) ? $extra['min'] : 0,
									'max'  => isset( $extra['max'] ) ? $extra['max'] : 100,
									'step' => 1,
								),
							)
						)
					);
					break;
				default:
					$wp_customize->add_control( 'unmute_' . $key, $control_args );
			}
		}
	}
}
add_action( 'customize_register', 'unmute_register_customizer' );

if ( ! function_exists( 'unmute_sanitize_checkbox' ) ) {
	/**
	 * Checkbox sanitizer.
	 *
	 * @param mixed $value Value.
	 * @return int
	 */
	function unmute_sanitize_checkbox( $value ) {
		return ( $value ) ? 1 : 0;
	}
}
