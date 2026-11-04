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
			echo esc_html( sprintf( _n( '%d تعليق', '%d تعليقات', $count, 'unmute' ), $count ) );
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
			'title_reply'          => __( 'شاركنا رأيك', 'unmute' ),
			'title_reply_before'   => '<h2 class="comments__title">',
			'title_reply_after'    => '</h2>',
			'label_submit'         => __( 'أرسل التعليق', 'unmute' ),
			'class_submit'         => 'unmute-btn unmute-btn--primary',
			'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'بريدك الإلكتروني لا يُنشر. الحقول الإلزامية معلّمة *', 'unmute' ) . '</p>',
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'تعليقك', 'unmute' ) . '</label><textarea id="comment" name="comment" rows="6" required></textarea></p>',
		)
	);
	?>
</section>
