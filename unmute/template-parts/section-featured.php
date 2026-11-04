<?php
/**
 * UNMUTE — featured products + category pills + the aurora promo card.
 *
 * The promo card ("THE AURORA") occupies the last grid cell so the row reads
 * as one editorial block, exactly like the reference composition.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$promo_show = unmute_option( 'promo_show' );
$columns    = max( 2, min( 4, (int) unmute_option( 'shop_columns' ) ) );
$products   = unmute_front_products();

$shop_url = wc_get_page_permalink( 'shop' );
$cats     = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'parent'     => 0,
		'number'     => 6,
		'hide_empty' => true,
	)
);

// Promo target: Customizer URL → first collection → shop.
$promo_url = unmute_option( 'promo_url' );
if ( ! $promo_url && ! is_wp_error( $cats ) && $cats ) {
	$promo_url = get_term_link( $cats[0] );
}
$promo_url = ( ! $promo_url || is_wp_error( $promo_url ) ) ? $shop_url : $promo_url;

$promo_img = unmute_option( 'promo_image' );
$promo_img = $promo_img ? $promo_img : get_theme_file_uri( 'assets/img/collection-aurora.jpg' );

$has_products = ! empty( $products );
?>
<section class="section featured" id="pieces">
	<div class="unmute-container">
		<?php unmute_section_head( unmute_option( 'featured_title' ), $shop_url, __( 'عرض الكل', 'unmute' ) ); ?>

		<?php if ( ! is_wp_error( $cats ) && $cats ) : ?>
			<nav class="pills" aria-label="<?php esc_attr_e( 'فئات المنتجات', 'unmute' ); ?>">
				<a class="pill is-active" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'كل المنتجات', 'unmute' ); ?></a>
				<?php foreach ( $cats as $cat ) : ?>
					<a class="pill" href="<?php echo esc_url( get_term_link( $cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
				<?php endforeach; ?>
			</nav>
		<?php endif; ?>

		<?php if ( $promo_show ) : ?>
			<div class="featured__head">
				<div class="featured__teaser">
					<?php if ( unmute_option( 'promo_tag' ) ) : ?>
						<span class="featured__teaser-label"><?php echo esc_html( unmute_option( 'promo_tag' ) ); ?></span>
					<?php endif; ?>
					<span class="featured__teaser-title"><?php echo esc_html( unmute_option( 'promo_title' ) ); ?></span>
					<?php if ( unmute_option( 'promo_text' ) ) : ?>
						<span class="featured__teaser-text"><?php echo esc_html( wp_strip_all_tags( unmute_option( 'promo_text' ) ) ); ?></span>
					<?php endif; ?>
				</div>
				<a class="featured__teaser-cta" href="<?php echo esc_url( $promo_url ); ?>">
					<?php echo esc_html( unmute_option( 'promo_cta' ) ); ?>
					<?php echo unmute_icon( 'arrow', 'unmute-icon--flip-rtl' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
				</a>
			</div>
		<?php endif; ?>

		<?php if ( $has_products || $promo_show ) : ?>
			<ul class="products unmute-products featured__grid columns-<?php echo esc_attr( (string) $columns ); ?>">

				<?php
				foreach ( $products as $product ) {
					if ( is_a( $product, 'WC_Product' ) ) {
						unmute_product_card( $product );
					}
				}
				?>

				<?php if ( $promo_show ) : ?>
					<li class="unmute-promo-cell product">
						<a class="aurora-card" href="<?php echo esc_url( $promo_url ); ?>">
							<span class="aurora-card__media" aria-hidden="true">
								<img src="<?php echo esc_url( $promo_img ); ?>" alt="" loading="lazy" decoding="async">
							</span>
							<span class="aurora-card__top">
								<?php if ( unmute_option( 'promo_tag' ) ) : ?>
									<span class="aurora-card__tag"><?php echo esc_html( unmute_option( 'promo_tag' ) ); ?></span>
								<?php endif; ?>
								<?php echo unmute_sparkle(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
							</span>
							<span class="aurora-card__body">
								<?php if ( unmute_option( 'promo_kicker' ) ) : ?>
									<span class="aurora-card__kicker"><?php echo esc_html( unmute_option( 'promo_kicker' ) ); ?></span>
								<?php endif; ?>
								<?php
								$promo_title = (string) unmute_option( 'promo_title' );
								$promo_parts = preg_split( '/\s+/', trim( $promo_title ), 2 );
								?>
								<span class="aurora-card__title"><?php echo esc_html( $promo_parts[0] ); ?><?php if ( ! empty( $promo_parts[1] ) ) : ?><em><?php echo esc_html( $promo_parts[1] ); ?></em><?php endif; ?></span>
								<?php if ( unmute_option( 'promo_text' ) ) : ?>
									<span class="aurora-card__text"><?php echo esc_html( wp_strip_all_tags( unmute_option( 'promo_text' ) ) ); ?></span>
								<?php endif; ?>
								<span class="aurora-card__link">
									<?php echo esc_html( unmute_option( 'promo_cta' ) ); ?>
									<?php echo unmute_icon( 'arrow', 'unmute-icon--flip-rtl' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
								</span>
							</span>
						</a>
					</li>
				<?php endif; ?>
			</ul>
		<?php elseif ( current_user_can( 'manage_woocommerce' ) ) : ?>
			<p class="unmute-admin-note">
				<?php esc_html_e( 'لا توجد منتجات بعد. أضف منتجات من WooCommerce ← المنتجات، ثم ميّز بعضها لتظهر في هذا القسم.', 'unmute' ); ?>
			</p>
		<?php endif; ?>
	</div>
</section>
