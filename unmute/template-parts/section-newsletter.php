<?php
/**
 * UNMUTE — newsletter section.
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

$action = unmute_option( 'news_action' );
?>
<section class="section newsletter" id="signal">
	<div class="unmute-container">
		<div class="newsletter__band">
			<div class="newsletter__copy">
				<h2 data-unmute-news-title><?php echo esc_html( unmute_option( 'news_title' ) ); ?></h2>
				<p><?php echo esc_html( unmute_option( 'news_text' ) ); ?></p>
			</div>
			<form class="newsletter__form" method="post" action="<?php echo $action ? esc_url( $action ) : '#'; ?>" data-unmute-newsform="<?php echo $action ? 'external' : 'local'; ?>">
				<?php if ( ! $action ) : ?>
					<?php wp_nonce_field( 'unmute_newsletter', 'unmute_nonce' ); ?>
					<input type="text" name="unmute_hp" class="unmute-hp" tabindex="-1" autocomplete="off" aria-hidden="true">
				<?php endif; ?>
				<label class="screen-reader-text" for="unmute-news-email"><?php esc_html_e( 'Email address', 'unmute' ); ?></label>
				<input id="unmute-news-email" type="email" name="email" placeholder="<?php esc_attr_e( 'your@email.com', 'unmute' ); ?>" required>
				<button class="unmute-btn unmute-btn--primary" type="submit">
					<?php echo unmute_icon( 'send', 'unmute-icon--flip-rtl' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
					<span><?php esc_html_e( 'Subscribe', 'unmute' ); ?></span>
				</button>
			</form>
			<p class="newsletter__note" role="status" aria-live="polite"><?php echo esc_html( unmute_option( 'news_note' ) ); ?></p>
		</div>
	</div>
</section>
