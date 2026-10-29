<?php
/**
 * UNMUTE — static page (Gutenberg-ready).
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div class="unmute-container unmute-page">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'page-single' ); ?>>
			<header class="page-head">
				<h1 class="page-head__title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</div>
<?php
get_footer();
