<?php
/**
 * UNMUTE — front page (brand landing).
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( unmute_option( 'hero_show' ) ) {
	get_template_part( 'template-parts/section', 'hero' );
}

if ( unmute_option( 'features_show' ) ) {
	get_template_part( 'template-parts/section', 'features' );
}

if ( unmute_option( 'featured_show' ) ) {
	get_template_part( 'template-parts/section', 'featured' );
}

if ( unmute_option( 'collections_show' ) ) {
	get_template_part( 'template-parts/section', 'collections' );
}

if ( unmute_option( 'story_show' ) ) {
	get_template_part( 'template-parts/section', 'story' );
}

if ( unmute_option( 'news_show' ) ) {
	get_template_part( 'template-parts/section', 'newsletter' );
}

// Optional: render the assigned static page's blocks below the brand sections,
// so Gutenberg content can extend the landing page.
if ( 'page' === get_option( 'show_on_front' ) && (int) get_option( 'page_on_front' ) > 0 ) {
	$front = get_post( (int) get_option( 'page_on_front' ) );
	if ( $front && trim( (string) $front->post_content ) !== '' ) {
		echo '<section class="unmute-blocks"><div class="unmute-container">';
		echo apply_filters( 'the_content', $front->post_content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized
		echo '</div></section>';
	}
}

get_footer();
