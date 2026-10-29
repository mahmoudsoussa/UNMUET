<?php
/**
 * UNMUTE — archives (blog categories, tags, dates).
 *
 * Product category archives are handled by WooCommerce templates.
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
		<h1 class="page-head__title"><?php the_archive_title(); ?></h1>
		<?php the_archive_description( '<p class="page-head__sub">', '</p>' ); ?>
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
