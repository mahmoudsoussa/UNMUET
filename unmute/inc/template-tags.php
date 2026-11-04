<?php
/**
 * UNMUTE — template tags, icons, defaults & the shared product card.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'unmute_defaults' ) ) {
	/**
	 * Single source of truth for every theme option default.
	 *
	 * @return array
	 */
	function unmute_defaults() {
		return array(
			// Announcement bar.
			'bar_show'            => 1,
			'bar_text'            => __( 'كل قطعة تُطبع حسب الطلب — ٣–٦ أيام إنتاج قبل الشحن. شحن مجاني فوق 95$.', 'unmute' ),

			// Hero.
			'hero_show'           => 1,
			'hero_image'          => '',
			'hero_eyebrow'        => __( 'UNMUTE — EXPRESS WITHOUT LIMITS', 'unmute' ),
			'hero_title'          => __( 'Wear What You Feel.', 'unmute' ),
			'hero_accent'         => __( 'Feel.', 'unmute' ),
			'hero_sub'            => __( 'ارتدِ ما تعبّر به عن نفسك.', 'unmute' ),
			'hero_text'           => __( 'أزياء لفنّانين لا يطلبون إذنًا. رُسوم أصلية، ألوان شفق متدفّقة، وقطع تُصنع حين تطلبها — بلا حدود، وبلا كود لباس.', 'unmute' ),
			'hero_cta'            => __( 'تسوّق الآن', 'unmute' ),
			'hero_url'            => '',
			'hero_cta2'           => __( 'استكشف المجموعات', 'unmute' ),
			'hero_url2'           => '',

			// Benefits strip.
			'features_show'       => 1,
			'f1_icon'             => 'diamond',
			'f1_title'            => __( 'جودة مضمونة', 'unmute' ),
			'f1_text'             => __( 'أقمشة ثقيلة، تفاصيل منجزة يدويًا.', 'unmute' ),
			'f2_icon'             => 'shield',
			'f2_title'            => __( 'دفع آمن', 'unmute' ),
			'f2_text'             => __( 'بوابات دفع مشفّرة موثوقة.', 'unmute' ),
			'f3_icon'             => 'globe',
			'f3_title'            => __( 'شحن عالمي', 'unmute' ),
			'f3_text'             => __( 'تتبّع كامل لأكثر من 40 دولة.', 'unmute' ),
			'f4_icon'             => 'headset',
			'f4_title'            => __( 'دعم سريع', 'unmute' ),
			'f4_text'             => __( 'ردّ بشري خلال ٢٤ ساعة.', 'unmute' ),

			// Featured products.
			'featured_show'       => 1,
			'featured_title'      => __( 'أعمالنا المميزة', 'unmute' ),
			'featured_source'     => 'featured',
			'featured_count'      => 5,

			// Featured collection card ("THE AURORA").
			'promo_show'          => 1,
			'promo_tag'           => __( 'مجموعة محدودة', 'unmute' ),
			'promo_kicker'        => __( 'مجموعة', 'unmute' ),
			'promo_title'         => __( 'THE AURORA', 'unmute' ),
			'promo_text'          => __( 'قطع مستوحاة من الشفق القطبي: تدرّجات بنفسجية وفيروزية تتغيّر مع الحركة.', 'unmute' ),
			'promo_cta'           => __( 'اكتشف المجموعة', 'unmute' ),
			'promo_url'           => '',
			'promo_image'         => '',

			// Collections.
			'collections_show'    => 1,
			'collections_title'   => __( 'مجموعاتنا الفنية', 'unmute' ),
			'collections_count'   => 6,

			// Story.
			'story_show'          => 1,
			'story_image'         => '',
			'story_quote'         => __( 'عقلك لا يعرف زيًّا رسميًا.', 'unmute' ),
			'story_text'          => __( 'بدأت UNMUTE من فكرة واحدة: الصمت ليس فراغًا. كل قطعة تبدأ رسمًا أصليًا — شخصية، حالة، اعتراف — ثم تنتقل إلى قطن ثقيل بإصدارات مرقّمة ومحدودة. لا شخصيات مستعارة، ولا مخزون ضخم. فقط فنّ يقول الجزء الذي يبقى صامتًا فيك.', 'unmute' ),
			'story_cta'           => __( 'قصّتنا', 'unmute' ),
			'story_url'           => '',

			// Newsletter.
			'news_show'           => 1,
			'news_title'          => __( 'ابقَ على تواصل معنا', 'unmute' ),
			'news_text'           => __( 'كن أول من يعرف عن التصاميم الجديدة والعروض الخاصة. رسالة واحدة كل أسبوعين، بلا ضجيج.', 'unmute' ),
			'news_action'         => '',
			'news_note'           => __( 'بالاشتراك أنت توافق على سياسة الخصوصية. يمكنك إلغاء الاشتراك في أي وقت.', 'unmute' ),

			// Colours — Aurora identity.
			'color_bg'            => '#0F1226',
			'color_bg2'           => '#171B35',
			'color_surface'       => '#1A1F3D',
			'color_surface2'      => '#232A4D',
			'color_accent'        => '#7956B9',
			'color_accent2'       => '#37BDB0',
			'color_accent3'       => '#C47BCB',
			'color_text'          => '#E8E8F0',
			'color_muted'         => '#9BA2C7',

			// Typography.
			'font_display'        => 'marker',

			// Shop.
			'shop_columns'        => 4,
			'shop_per_page'       => 12,
			'shop_new_days'       => 30,
			'shop_best_threshold' => 3,
			'single_shipping'     => __( 'تُصنع حسب الطلب: كل قطعة تُطبع بعد طلبك (٣–٦ أيام إنتاج)، ثم تُشحن مع تتبّع. أمريكا ٥–٩ أيام عمل · أوروبا ٤–٨ أيام عمل.', 'unmute' ),
			'single_returns'      => __( 'خطأ في الطباعة أو عيب؟ استبدال مجاني خلال 30 يومًا. مقاس غير مناسب؟ تبديل لمرة واحدة بخصم 50%. التفاصيل الكاملة في صفحة الإرجاع.', 'unmute' ),

			// Footer.
			'footer_email'        => '',
			'footer_phone'        => '',
			'footer_address'      => '',
			'footer_blurb'        => __( 'أزياء فنية لمن لا يطلبون إذنًا في التعبير. رسوم أصلية، إصدارات محدودة، قطن ثقيل — وألوان شفق لا تُقلَّد.', 'unmute' ),
			'footer_copyright'    => '',
			'social_instagram'    => '',
			'social_tiktok'       => '',
			'social_youtube'      => '',
			'social_telegram'     => '',
			'social_facebook'     => '',
			'social_x'            => '',
		);
	}
}

if ( ! function_exists( 'unmute_option' ) ) {
	/**
	 * Read a theme option with its default fallback.
	 *
	 * @param string $key Option key (without prefix).
	 * @return mixed
	 */
	function unmute_option( $key ) {
		$defaults = unmute_defaults();
		$default  = array_key_exists( $key, $defaults ) ? $defaults[ $key ] : '';
		return get_theme_mod( 'unmute_' . $key, $default );
	}
}

if ( ! function_exists( 'unmute_sanitize_hex' ) ) {
	/**
	 * Strict hex-colour sanitizer, with a safe fallback for empty values.
	 *
	 * @param string $value Raw value.
	 * @return string
	 */
	function unmute_sanitize_hex( $value ) {
		$value = is_string( $value ) ? trim( $value ) : '';
		if ( '' === $value ) {
			return '';
		}
		$hex = sanitize_hex_color( $value );
		return $hex ? $hex : '';
	}
}

if ( ! function_exists( 'unmute_icon' ) ) {
	/**
	 * Inline SVG icon set (stroke = currentColor).
	 *
	 * @param string $name  Icon name.
	 * @param string $class Extra class.
	 * @return string
	 */
	function unmute_icon( $name, $class = '' ) {
		$paths = array(
			'search'    => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>',
			'user'      => '<circle cx="12" cy="8" r="4"/><path d="M4 20c1.5-3.5 4.5-5 8-5s6.5 1.5 8 5"/>',
			'bag'       => '<path d="M6 8h12l-1 12H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
			'heart'     => '<path d="M12 20s-7-4.5-9-9c-1.2-2.8.6-6 3.8-6 2 0 3.4 1.2 5.2 3.4C13.8 6.2 15.2 5 17.2 5c3.2 0 5 3.2 3.8 6-2 4.5-9 9-9 9Z"/>',
			'menu'      => '<path d="M4 7h16M4 12h16M4 17h10"/>',
			'close'     => '<path d="m6 6 12 12M18 6 6 18"/>',
			'arrow'     => '<path d="M5 12h14m-6-6 6 6-6 6"/>',
			'arrow-up'  => '<path d="M12 19V5m-6 6 6-6 6 6"/>',
			'diamond'   => '<path d="M7 4h10l4 5-9 11L3 9l4-5Z"/><path d="M3 9h18"/>',
			'truck'     => '<path d="M3 7h11v9H3zM14 10h4l3 3v3h-7z"/><circle cx="7" cy="18" r="1.6"/><circle cx="17" cy="18" r="1.6"/>',
			'globe'     => '<circle cx="12" cy="12" r="8.5"/><path d="M3.5 12h17M12 3.5c2.4 2.4 3.6 5.3 3.6 8.5S14.4 18.1 12 20.5c-2.4-2.4-3.6-5.3-3.6-8.5S9.6 5.9 12 3.5Z"/>',
			'shield'    => '<path d="M12 3 5 6v6c0 4.5 3 7.5 7 9 4-1.5 7-4.5 7-9V6l-7-3Z"/><path d="m9 12 2 2 4-4"/>',
			'headset'   => '<path d="M4 13a8 8 0 0 1 16 0"/><path d="M4 13v4a2 2 0 0 0 2 2h2v-6H6a2 2 0 0 0-2 2ZM20 13v4a2 2 0 0 1-2 2h-2v-6h2a2 2 0 0 1 2 2Z"/>',
			'send'      => '<path d="m4 12 16-8-6 16-2.5-6.5L4 12Z"/>',
			'crown'     => '<path d="m4 17 1-9 4.5 4L12 6l2.5 6L19 8l1 9H4Z"/>',
			'moon'      => '<path d="M20 14.5A8.5 8.5 0 1 1 9.5 4a7 7 0 0 0 10.5 10.5Z"/>',
			'palette'   => '<path d="M12 3a9 9 0 1 0 0 18c1.4 0 2-1 2-2s-.7-1.6-.7-2.4c0-1 .8-1.6 1.9-1.6H18a3 3 0 0 0 3-3A9 9 0 0 0 12 3Z"/><circle cx="8" cy="10" r="1"/><circle cx="12" cy="7.6" r="1"/><circle cx="16" cy="10" r="1"/>',
			'sparkle'   => '<path d="M12 3c.8 4.3 2.7 6.2 7 7-4.3.8-6.2 2.7-7 7-.8-4.3-2.7-6.2-7-7 4.3-.8 6.2-2.7 7-7Z"/>',
			'instagram' => '<rect x="3.5" y="3.5" width="17" height="17" rx="4.5"/><circle cx="12" cy="12" r="3.6"/><circle cx="17" cy="7" r=".9" fill="currentColor" stroke="none"/>',
			'tiktok'    => '<path d="M14 4v9.5a3.5 3.5 0 1 1-3-3.46"/><path d="M14 5.5c.8 2 2.4 3.2 4.5 3.4"/>',
			'youtube'   => '<rect x="3" y="6" width="18" height="12" rx="3.5"/><path d="m10.5 9.5 5 2.5-5 2.5v-5Z"/>',
			'facebook'  => '<path d="M14 8h2.5V5H14a4 4 0 0 0-4 4v2H8v3h2v6h3v-6h2.5l.5-3H13V9a1 1 0 0 1 1-1Z"/>',
			'x'         => '<path d="M4 4h4l12 16h-4L4 4Z"/><path d="M4 20l6-7M14 10l6-6"/>',
		);

		if ( ! isset( $paths[ $name ] ) ) {
			return '';
		}

		return '<svg class="unmute-icon ' . esc_attr( $class ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
	}
}

if ( ! function_exists( 'unmute_sparkle' ) ) {
	/**
	 * The UNMUTE four-point star mark.
	 *
	 * @param string $class Extra class.
	 * @return string
	 */
	function unmute_sparkle( $class = '' ) {
		return '<svg class="unmute-sparkle ' . esc_attr( $class ) . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M12 1.5c1 6.2 3.3 8.5 9.5 9.5-6.2 1-8.5 3.3-9.5 9.5-1-6.2-3.3-8.5-9.5-9.5 6.2-1 8.5-3.3 9.5-9.5Z"/></svg>';
	}
}

if ( ! function_exists( 'unmute_aurora' ) ) {
	/**
	 * Decorative aurora light room. Purely presentational.
	 *
	 * @param string $class Extra class.
	 */
	function unmute_aurora( $class = '' ) {
		echo '<div class="unmute-aurora ' . esc_attr( $class ) . '" aria-hidden="true"><i class="a1"></i><i class="a2"></i><i class="a3"></i></div>';
	}
}

if ( ! function_exists( 'unmute_section_head' ) ) {
	/**
	 * Section heading with sparkle + rule + optional link.
	 *
	 * @param string $title Title.
	 * @param string $url   Link URL.
	 * @param string $label Link label.
	 */
	function unmute_section_head( $title, $url = '', $label = '' ) {
		?>
		<div class="sec-head">
			<?php echo unmute_sparkle(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
			<h2 class="sec-head__title"><?php echo esc_html( $title ); ?></h2>
			<span class="sec-head__rule" aria-hidden="true"></span>
			<?php if ( $url && $label ) : ?>
				<a class="sec-head__link" href="<?php echo esc_url( $url ); ?>">
					<?php echo esc_html( $label ); ?>
					<?php echo unmute_icon( 'arrow', 'unmute-icon--flip-rtl' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
				</a>
			<?php endif; ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unmute_multiline' ) ) {
	/**
	 * Render a Customizer textarea safely, keeping paragraphs and line breaks.
	 *
	 * @param string $text Raw value.
	 * @return string
	 */
	function unmute_multiline( $text ) {
		return wpautop( wp_kses_post( (string) $text ) );
	}
}

if ( ! function_exists( 'unmute_product_badges' ) ) {
	/**
	 * New / Sale / Bestseller badges for a product.
	 *
	 * @param WC_Product $product Product.
	 * @return string
	 */
	function unmute_product_badges( $product ) {
		$out     = array();
		$days    = (int) unmute_option( 'shop_new_days' );
		$best    = (int) unmute_option( 'shop_best_threshold' );
		$created = $product->get_date_created();

		if ( $days > 0 && $created && ( time() - $created->getTimestamp() ) < ( $days * DAY_IN_SECONDS ) ) {
			$out[] = '<span class="unmute-badge unmute-badge--new">' . esc_html__( 'جديد', 'unmute' ) . '</span>';
		}

		if ( $product->is_on_sale() ) {
			$label   = esc_html__( 'Sale', 'unmute' );
			$regular = (float) $product->get_regular_price();
			$sale    = (float) $product->get_sale_price();
			if ( $regular > 0 && $sale > 0 && $sale < $regular ) {
				$label = '-' . round( ( 1 - ( $sale / $regular ) ) * 100 ) . '%';
			}
			$out[] = '<span class="unmute-badge unmute-badge--sale">' . esc_html( $label ) . '</span>';
		}

		$sales = (int) $product->get_total_sales();
		if ( $best > 0 && $sales >= $best ) {
			$out[] = '<span class="unmute-badge unmute-badge--best">' . esc_html__( 'الأكثر مبيعًا', 'unmute' ) . '</span>';
		}

		if ( ! $product->is_in_stock() ) {
			$out[] = '<span class="unmute-badge unmute-badge--out">' . esc_html__( 'نُفد', 'unmute' ) . '</span>';
		}

		return implode( '', $out );
	}
}

if ( ! function_exists( 'unmute_wishlist_control' ) ) {
	/**
	 * Wishlist button — rendered only when a supported wishlist plugin is active
	 * (YITH WooCommerce Wishlist or TI WooCommerce Wishlist), or when another
	 * plugin injects markup through the `unmute_wishlist_markup` filter.
	 *
	 * @param WC_Product $product Product.
	 * @return string
	 */
	function unmute_wishlist_control( $product ) {
		/**
		 * Allow wishlist plugins to inject their button markup into UNMUTE cards.
		 *
		 * @param string     $markup  Empty string by default.
		 * @param WC_Product $product Current product.
		 */
		$markup = apply_filters( 'unmute_wishlist_markup', '', $product );

		if ( ! $markup ) {
			return '';
		}

		return '<div class="unmute-wishlist">' . $markup . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized
	}
}

if ( ! function_exists( 'unmute_product_card_inner' ) ) {
	/**
	 * The card markup itself (no wrapper). Used by the loop and by
	 * `unmute_product_card()`; safe to call inside an existing <li>.
	 *
	 * @param WC_Product $item Product.
	 */
	function unmute_product_card_inner( $item ) {
		$permalink = get_permalink( $item->get_id() );
		$rating    = $item->get_average_rating();
		?>
		<article class="unmute-card">
			<?php
			$badges = unmute_product_badges( $item );
			if ( $badges ) {
				echo '<div class="unmute-card__badges">' . $badges . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized
			}
			echo unmute_wishlist_control( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized
			?>
			<a class="unmute-card__media" href="<?php echo esc_url( $permalink ); ?>" tabindex="-1" aria-hidden="true">
				<?php echo $item->get_image( 'woocommerce_thumbnail', array( 'loading' => 'lazy' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
			</a>
			<div class="unmute-card__body">
				<h3 class="unmute-card__title">
					<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $item->get_name() ); ?></a>
				</h3>
				<?php if ( $rating && $rating > 0 ) : ?>
					<div class="unmute-card__rating"><?php echo wc_get_rating_html( $rating ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?></div>
				<?php endif; ?>
				<div class="unmute-card__price"><?php echo wp_kses_post( $item->get_price_html() ); ?></div>
				<div class="unmute-card__footer">
					<?php woocommerce_template_loop_add_to_cart(); ?>
				</div>
			</div>
		</article>
		<?php
	}
}

if ( ! function_exists( 'unmute_product_card' ) ) {
	/**
	 * Standalone product card (a complete <li>). Use this in grids the theme
	 * builds itself (front page, search). Inside WooCommerce's own loop the
	 * `woocommerce_before_shop_loop_item` hook renders only the inner markup,
	 * so the loop wrapper is never duplicated.
	 *
	 * @param WC_Product|null $product Product object (falls back to global).
	 * @param string          $tag     Wrapper tag: `li` (grids inside ul) or `div`.
	 */
	function unmute_product_card( $passed_product = null, $tag = 'li' ) {
		global $product;

		$item = $passed_product ? $passed_product : $product;

		if ( ! $item || ! is_a( $item, 'WC_Product' ) ) {
			return;
		}

		// woocommerce_template_loop_add_to_cart() reads the global product.
		$previous_global = $product;
		$product         = $item; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

		$tag = ( 'div' === $tag ) ? 'div' : 'li';

		if ( 'li' === $tag ) {
			echo '<li ';
			wc_product_class( '', $item ); // Echoes the class attribute.
			echo '>';
		} else {
			echo '<div class="product unmute-product">';
		}

		unmute_product_card_inner( $item );

		echo '</' . $tag . '>';

		$product = $previous_global; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	}
}

if ( ! function_exists( 'unmute_social_links' ) ) {
	/**
	 * Render the social icon list.
	 */
	function unmute_social_links() {
		$networks = array(
			'instagram' => __( 'Instagram', 'unmute' ),
			'tiktok'    => __( 'TikTok', 'unmute' ),
			'youtube'   => __( 'YouTube', 'unmute' ),
			'telegram'  => __( 'Telegram', 'unmute' ),
			'facebook'  => __( 'Facebook', 'unmute' ),
			'x'         => __( 'X', 'unmute' ),
		);

		$items = '';
		foreach ( $networks as $key => $label ) {
			$url = unmute_option( 'social_' . $key );
			if ( ! $url ) {
				continue;
			}
			$icon   = ( 'telegram' === $key ) ? unmute_icon( 'send' ) : unmute_icon( $key );
			$items .= '<li><a class="unmute-social" href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( $label ) . '">' . $icon . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized
		}

		if ( ! $items ) {
			return;
		}

		echo '<ul class="unmute-socials">' . $items . '</ul>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized
	}
}

if ( ! function_exists( 'unmute_fallback_menu' ) ) {
	/**
	 * Fallback primary menu when no menu is assigned.
	 */
	function unmute_fallback_menu() {
		echo '<ul class="unmute-nav">';
		echo '<li class="menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'الرئيسية', 'unmute' ) . '</a></li>';
		if ( class_exists( 'WooCommerce' ) ) {
			echo '<li class="menu-item"><a href="' . esc_url( wc_get_page_permalink( 'shop' ) ) . '">' . esc_html__( 'المتجر', 'unmute' ) . '</a></li>';
			echo '<li class="menu-item"><a href="' . esc_url( home_url( '/#collections' ) ) . '">' . esc_html__( 'المجموعات', 'unmute' ) . '</a></li>';
		}
		echo '<li class="menu-item"><a href="' . esc_url( home_url( '/?post_type=post' ) ) . '">' . esc_html__( 'المدونة', 'unmute' ) . '</a></li>';
		echo '</ul>';
	}
}

if ( ! function_exists( 'unmute_post_card' ) ) {
	/**
	 * Blog card markup.
	 */
	function unmute_post_card() {
		?>
		<article <?php post_class( 'post-card' ); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
				<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
					<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
				</a>
			<?php endif; ?>
			<div class="post-card__body">
				<time class="post-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
				<a class="post-card__more" href="<?php the_permalink(); ?>">
					<?php esc_html_e( 'اقرأ', 'unmute' ); ?>
					<?php echo unmute_icon( 'arrow', 'unmute-icon--flip-rtl' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
				</a>
			</div>
		</article>
		<?php
	}
}

if ( ! function_exists( 'unmute_newsletter_form' ) ) {
	/**
	 * Shared newsletter form. Used by the SIGNAL band and the footer.
	 *
	 * @param string $variant 'band' or 'footer'.
	 */
	function unmute_newsletter_form( $variant = 'band' ) {
		$action  = unmute_option( 'news_action' );
		$is_foot = ( 'footer' === $variant );
		$field   = 'unmute-news-email-' . $variant;
		$classes = $is_foot ? 'unmute-footer__form' : 'newsletter__form';
		$note    = $is_foot ? 'unmute-footer__note' : 'newsletter__note';
		?>
		<form class="<?php echo esc_attr( $classes ); ?>" method="post" action="<?php echo $action ? esc_url( $action ) : '#'; ?>" data-unmute-newsform="<?php echo $action ? 'external' : 'local'; ?>">
			<?php if ( ! $action ) : ?>
				<?php wp_nonce_field( 'unmute_newsletter', 'unmute_nonce' ); ?>
				<input type="text" name="unmute_hp" class="unmute-hp" tabindex="-1" autocomplete="off" aria-hidden="true">
			<?php endif; ?>
			<label class="screen-reader-text" for="<?php echo esc_attr( $field ); ?>"><?php esc_html_e( 'البريد الإلكتروني', 'unmute' ); ?></label>
			<input id="<?php echo esc_attr( $field ); ?>" type="email" name="email" placeholder="<?php esc_attr_e( 'أدخل بريدك الإلكتروني', 'unmute' ); ?>" required>
			<button class="unmute-btn unmute-btn--primary" type="submit">
				<?php echo unmute_icon( 'send', 'unmute-icon--flip-rtl' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
				<span><?php esc_html_e( 'اشترك', 'unmute' ); ?></span>
			</button>
		</form>
		<?php if ( ! $is_foot && unmute_option( 'news_note' ) ) : ?>
			<p class="<?php echo esc_attr( $note ); ?>" role="status" aria-live="polite"><?php echo esc_html( unmute_option( 'news_note' ) ); ?></p>
		<?php endif; ?>
		<?php
	}
}
