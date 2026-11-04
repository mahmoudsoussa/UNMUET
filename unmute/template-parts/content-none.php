<?php
/**
 * UNMUTE — empty state.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="unmute-empty">
	<?php echo unmute_sparkle(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
	<h2><?php esc_html_e( 'لا شيء هنا بعد.', 'unmute' ); ?></h2>
	<p><?php esc_html_e( 'هذا الصمت مؤقّت — قطع وقصص جديدة في الطريق.', 'unmute' ); ?></p>
	<?php get_search_form(); ?>
</section>
