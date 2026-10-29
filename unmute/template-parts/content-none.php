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
	<h2><?php esc_html_e( 'Nothing here yet.', 'unmute' ); ?></h2>
	<p><?php esc_html_e( 'That silence is temporary — new pieces and stories are in the works.', 'unmute' ); ?></p>
	<?php get_search_form(); ?>
</section>
