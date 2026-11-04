<?php
/**
 * UNMUTE — SIGNAL newsletter section.
 *
 * When "External form action URL" is empty the form posts to admin-ajax and
 * subscribers are stored in the `unmute_subscribers` option (export them from
 * the database or hook `unmute_newsletter_subscribed` to sync an ESP).
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="newsletter" id="signal">
	<div class="unmute-container">
		<div class="newsletter__band">
			<?php unmute_aurora(); ?>
			<div class="newsletter__copy">
				<h2 data-unmute-news-title><?php echo esc_html( unmute_option( 'news_title' ) ); ?></h2>
				<p><?php echo esc_html( wp_strip_all_tags( unmute_option( 'news_text' ) ) ); ?></p>
			</div>
			<div class="newsletter__form-wrap">
				<?php unmute_newsletter_form( 'band' ); ?>
			</div>
		</div>
	</div>
</section>
