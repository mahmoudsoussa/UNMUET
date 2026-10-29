<?php
/**
 * UNMUTE — blog post.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div class="unmute-container unmute-container--narrow unmute-page">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'post-single' ); ?>>
			<header class="post-single__head">
				<time class="post-single__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				<h1 class="post-single__title"><?php the_title(); ?></h1>
				<p class="post-single__meta">
					<?php
					/* translators: %s: author name. */
					echo esc_html( sprintf( __( 'By %s', 'unmute' ), get_the_author() ) );
					?>
				</p>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="post-single__media">
					<?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?>
				</figure>
			<?php endif; ?>

			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>

			<?php
			$tags = get_the_tag_list( '', ', ' );
			if ( $tags ) :
				?>
				<footer class="post-single__foot">
					<span class="post-single__tags"><?php echo wp_kses_post( $tags ); ?></span>
				</footer>
			<?php endif; ?>

			<?php
			the_post_pagination(
				array(
					'prev_text' => esc_html__( 'Previous story', 'unmute' ),
					'next_text' => esc_html__( 'Next story', 'unmute' ),
				)
			);
			?>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</article>
		<?php
	endwhile;
	?>
</div>
<?php
get_footer();
