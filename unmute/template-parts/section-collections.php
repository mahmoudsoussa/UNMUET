<?php
/**
 * UNMUTE — collections (product categories) section.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$count = max( 2, min( 12, (int) unmute_option( 'collections_count' ) ) );
$cats  = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'parent'     => 0,
		'number'     => $count,
		'hide_empty' => false,
		'orderby'    => 'menu_order',
		'order'      => 'ASC',
	)
);

if ( is_wp_error( $cats ) || ! $cats ) {
	return;
}
?>
<section class="section collections" id="collections">
	<div class="unmute-container">
		<?php unmute_section_head( unmute_option( 'collections_title' ) ); ?>
		<div class="collections__grid">
			<?php
			$i = 0;
			foreach ( $cats as $cat ) :
				$thumb_id  = get_term_meta( $cat->term_id, 'thumbnail_id', true );
				$thumb_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : '';
				$variant   = $i % 3;
				++$i;
				?>
				<a class="col-card col-card--v<?php echo esc_attr( (string) $variant ); ?>" href="<?php echo esc_url( get_term_link( $cat ) ); ?>" <?php echo $thumb_url ? 'style="background-image:url(' . esc_url( $thumb_url ) . ')"' : ''; ?>>
					<span class="col-card__veil" aria-hidden="true"></span>
					<span class="col-card__inner">
						<span class="col-card__name"><?php echo esc_html( $cat->name ); ?></span>
						<span class="col-card__count">
							<?php
							/* translators: %d: number of products. */
							echo esc_html( sprintf( _n( '%d piece', '%d pieces', (int) $cat->count, 'unmute' ), (int) $cat->count ) );
							?>
						</span>
					</span>
					<?php echo unmute_icon( 'arrow', 'col-card__arrow unmute-icon--flip-rtl' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
