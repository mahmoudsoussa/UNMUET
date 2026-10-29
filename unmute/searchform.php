<?php
/**
 * UNMUTE — search form.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form role="search" method="get" class="unmute-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="unmute-s"><?php esc_html_e( 'Search for:', 'unmute' ); ?></label>
	<?php echo unmute_icon( 'search', 'unmute-searchform__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
	<input id="unmute-s" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search designs, collections…', 'unmute' ); ?>">
	<button class="unmute-btn unmute-btn--primary" type="submit"><?php esc_html_e( 'Search', 'unmute' ); ?></button>
</form>
