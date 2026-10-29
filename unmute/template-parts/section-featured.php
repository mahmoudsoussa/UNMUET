<?php
/**
 * UNMUTE — featured products + category pills.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$source = unmute_option( 'featured_source' );
$count  = max( 2, min( 16, (int) unmute_option( 'featured_count' ) ) );

$args = array(
	'limit'  => $count,
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

// Fall back to newest products if no product is flagged as featured yet.
if ( empty( $products ) && 'featured' === $source ) {
	$products = wc_get_products(
		array(
			'limit'   => $count,
			'status'  => 'publish',
			'orderby' => 'date',
			'order'   => 'DESC',
		)
	);
}

$shop_url = wc_get_page_permalink( 'shop' );
$cats     = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'parent'     => 0,
		'number'     => 6,
		'hide_empty' => true,
	)
);
?>
<section class="section featured" id="pieces">
	<div class="unmute-container">
		<?php unmute_section_head( unmute_option( 'featured_title' ), $shop_url, __( 'View all', 'unmute' ) ); ?>

		<?php if ( ! is_wp_error( $cats ) && $cats ) : ?>
			<div class="pills" role="navigation" aria-label="<?php esc_attr_e( 'Product categories', 'unmute' ); ?>">
				<a class="pill is-active" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'All pieces', 'unmute' ); ?></a>
				<?php foreach ( $cats as $cat ) : ?>
					<a class="pill" href="<?php echo esc_url( get_term_link( $cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $products ) : ?>
			<ul class="products unmute-products">
				<?php
				foreach ( $products as $product ) {
					unmute_product_card( $product );
				}
				?>
			</ul>
		<?php elseif ( current_user_can( 'manage_woocommerce' ) ) : ?>
			<p class="unmute-admin-note">
				<?php esc_html_e( 'No products yet. Add products in WooCommerce → Products, then mark a few as “Featured” to curate this section.', 'unmute' ); ?>
			</p>
		<?php endif; ?>
	</div>
</section>
