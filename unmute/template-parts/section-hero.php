<?php
/**
 * UNMUTE — hero section.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$image  = unmute_option( 'hero_image' );
$image  = $image ? $image : get_theme_file_uri( 'assets/img/hero-placeholder.jpg' );
$title  = (string) unmute_option( 'hero_title' );
$accent = (string) unmute_option( 'hero_accent' );

if ( $accent && false !== stripos( $title, $accent ) ) {
	$title = preg_replace(
		'/' . preg_quote( $accent, '/' ) . '/i',
		'<span class="hero__accent">$0</span>',
		$title,
		1
	);
}

$cta_url  = unmute_option( 'hero_url' );
$cta_url  = $cta_url ? $cta_url : ( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) );
$cta2_url = unmute_option( 'hero_url2' );
$cta2_url = $cta2_url ? $cta2_url : home_url( '/#collections' );
?>
<section class="hero" id="top">
	<div class="hero__media" aria-hidden="true">
		<img src="<?php echo esc_url( $image ); ?>" alt="" fetchpriority="high">
	</div>
	<div class="hero__rail" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
	<?php echo unmute_sparkle( 'hero__spark hero__spark--1' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
	<?php echo unmute_sparkle( 'hero__spark hero__spark--2' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>

	<div class="unmute-container hero__inner">
		<?php if ( unmute_option( 'hero_eyebrow' ) ) : ?>
			<p class="hero__eyebrow"><?php echo esc_html( unmute_option( 'hero_eyebrow' ) ); ?></p>
		<?php endif; ?>
		<h1 class="hero__title" data-unmute-hero-title><?php echo wp_kses_post( $title ); ?></h1>
		<?php if ( unmute_option( 'hero_text' ) ) : ?>
			<p class="hero__text" data-unmute-hero-text><?php echo esc_html( unmute_option( 'hero_text' ) ); ?></p>
		<?php endif; ?>
		<div class="hero__cta">
			<a class="unmute-btn unmute-btn--primary" href="<?php echo esc_url( $cta_url ); ?>" data-unmute-hero-cta><?php echo esc_html( unmute_option( 'hero_cta' ) ); ?></a>
			<?php if ( unmute_option( 'hero_cta2' ) ) : ?>
				<a class="unmute-btn unmute-btn--ghost" href="<?php echo esc_url( $cta2_url ); ?>"><?php echo esc_html( unmute_option( 'hero_cta2' ) ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
