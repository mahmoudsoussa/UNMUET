<?php
/**
 * UNMUTE — brand story section.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$image = unmute_option( 'story_image' );
$image = $image ? $image : get_theme_file_uri( 'assets/img/story-placeholder.jpg' );

$url = unmute_option( 'story_url' );
if ( ! $url ) {
	$about = get_page_by_path( 'about' );
	$url   = $about ? get_permalink( $about ) : '';
}
?>
<section class="section story" id="story">
	<div class="unmute-container story__grid">
		<div class="story__media">
			<img src="<?php echo esc_url( $image ); ?>" alt="<?php esc_attr_e( 'UNMUTE studio', 'unmute' ); ?>" loading="lazy">
			<?php echo unmute_sparkle( 'story__spark' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
		</div>
		<div class="story__content">
			<?php echo unmute_sparkle(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
			<blockquote class="story__quote" data-unmute-story-quote><?php echo esc_html( unmute_option( 'story_quote' ) ); ?></blockquote>
			<p class="story__text"><?php echo wp_kses_post( unmute_option( 'story_text' ) ); ?></p>
			<?php if ( unmute_option( 'story_cta' ) && $url ) : ?>
				<a class="unmute-btn unmute-btn--ghost" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( unmute_option( 'story_cta' ) ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
