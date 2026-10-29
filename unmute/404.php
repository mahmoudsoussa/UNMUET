<?php
/**
 * UNMUTE — 404.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div class="unmute-container unmute-page unmute-404">
	<?php echo unmute_sparkle( 'unmute-404__spark' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
	<p class="unmute-404__code">404</p>
	<h1 class="unmute-404__title"><?php esc_html_e( 'Signal lost.', 'unmute' ); ?></h1>
	<p class="unmute-404__text"><?php esc_html_e( 'The page you are looking for went quiet. Try the shop, or search for a feeling.', 'unmute' ); ?></p>
	<div class="unmute-404__actions">
		<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<a class="unmute-btn unmute-btn--primary" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Shop Now', 'unmute' ); ?></a>
		<?php endif; ?>
		<a class="unmute-btn unmute-btn--ghost" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back home', 'unmute' ); ?></a>
	</div>
	<div class="unmute-404__search">
		<?php get_search_form(); ?>
	</div>
</div>
<?php
get_footer();
