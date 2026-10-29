<?php
/**
 * UNMUTE — comments.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments__title">
			<?php
			$count = (int) get_comments_number();
			/* translators: %d: comment count. */
			echo esc_html( sprintf( _n( '%d response', '%d responses', $count, 'unmute' ), $count ) );
			?>
		</h2>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'          => __( 'Leave a response', 'unmute' ),
			'label_submit'         => __( 'Post response', 'unmute' ),
			'class_submit'         => 'unmute-btn unmute-btn--primary',
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your response', 'unmute' ) . '</label><textarea id="comment" name="comment" rows="6" required></textarea></p>',
		)
	);
	?>
</section>
