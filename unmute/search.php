<?php
/**
 * UNMUTE — search results (posts + products).
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;

get_header();
?>
<div class="unmute-container unmute-page">
	<header class="page-head">
		<h1 class="page-head__title">
			<?php
			/* translators: %s: search query. */
			echo esc_html( sprintf( __( 'Search: %s', 'unmute' ), get_search_query() ) );
			?>
		</h1>
		<p class="page-head__sub">
			<?php
			/* translators: %d: number of results. */
			echo esc_html( sprintf( _n( '%d result', '%d results', (int) $wp_query->found_posts, 'unmute' ), (int) $wp_query->found_posts ) );
			?>
		</p>
	</header>

	<?php if ( have_posts() ) : ?>
		<ul class="products unmute-products unmute-products--search">
			<?php
			while ( have_posts() ) :
				the_post();
				if ( 'product' === get_post_type() && class_exists( 'WooCommerce' ) ) {
					unmute_product_card( wc_get_product( get_the_ID() ) );
				} else {
					echo '<li class="unmute-search-item">';
					get_template_part( 'template-parts/content', 'card' );
					echo '</li>';
				}
			endwhile;
			?>
		</ul>
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
