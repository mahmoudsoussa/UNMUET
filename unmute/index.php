<?php
/**
 * UNMUTE — blog index fallback.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div class="unmute-container unmute-page">
	<header class="page-head">
		<h1 class="page-head__title"><?php esc_html_e( 'Journal', 'unmute' ); ?></h1>
		<p class="page-head__sub"><?php esc_html_e( 'Notes, drops and studio stories from UNMUTE.', 'unmute' ); ?></p>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="unmute-blog-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'card' );
			endwhile;
			?>
		</div>
		<?php
		the_posts_pagination(
			array(
				'mid_size'  => 1,
				'prev_text' => esc_html__( 'Previous', 'unmute' ),
				'next_text' => esc_html__( 'Next', 'unmute' ),
			)
		);
		?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>
</div>
<?php
get_footer();
