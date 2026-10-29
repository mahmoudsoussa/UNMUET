<?php
/**
 * UNMUTE — features strip.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="features">
	<div class="unmute-container features__grid">
		<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
			<?php
			$title = unmute_option( 'f' . $i . '_title' );
			$text  = unmute_option( 'f' . $i . '_text' );
			$icon  = unmute_option( 'f' . $i . '_icon' );
			if ( ! $title && ! $text ) {
				continue;
			}
			?>
			<div class="feature">
				<span class="feature__icon"><?php echo unmute_icon( $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?></span>
				<div>
					<h3 class="feature__title"><?php echo esc_html( $title ); ?></h3>
					<p class="feature__text"><?php echo esc_html( $text ); ?></p>
				</div>
			</div>
		<?php endfor; ?>
	</div>
</section>
