<?php
/**
 * UNMUTE — footer.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</main><!-- #unmute-main -->

<footer class="unmute-footer">
	<?php unmute_aurora( 'unmute-aurora--calm' ); ?>

	<div class="unmute-container">

		<div class="unmute-footer__top">

			<?php if ( unmute_option( 'news_show' ) ) : ?>
				<div class="unmute-footer__signup">
					<h2><?php echo esc_html( unmute_option( 'news_title' ) ); ?></h2>
					<p><?php echo esc_html( wp_strip_all_tags( unmute_option( 'news_text' ) ) ); ?></p>
					<?php unmute_newsletter_form( 'footer' ); ?>
					<?php if ( unmute_option( 'news_note' ) ) : ?>
						<p class="unmute-footer__note" role="status" aria-live="polite"><?php echo esc_html( unmute_option( 'news_note' ) ); ?></p>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="unmute-footer__social">
				<h3 class="unmute-footer__social-title"><?php esc_html_e( 'تابعنا', 'unmute' ); ?></h3>
				<?php unmute_social_links(); ?>
			</div>

			<div class="unmute-footer__brand">
				<a class="unmute-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php echo unmute_sparkle( 'unmute-brand__mark' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
					<span class="unmute-brand__name"><?php bloginfo( 'name' ); ?></span>
				</a>
				<?php if ( unmute_option( 'footer_blurb' ) ) : ?>
					<p class="unmute-footer__blurb"><?php echo esc_html( wp_strip_all_tags( unmute_option( 'footer_blurb' ) ) ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="unmute-footer__cols">

			<nav class="unmute-footer__col" aria-label="<?php esc_attr_e( 'المتجر', 'unmute' ); ?>">
				<h3 class="unmute-footer__title"><?php esc_html_e( 'المتجر', 'unmute' ); ?></h3>
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<ul>
						<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'كل القطع', 'unmute' ); ?></a></li>
						<?php
						$cats = get_terms(
							array(
								'taxonomy'   => 'product_cat',
								'parent'     => 0,
								'number'     => 5,
								'hide_empty' => false,
							)
						);
						if ( ! is_wp_error( $cats ) ) {
							foreach ( $cats as $cat ) {
								echo '<li><a href="' . esc_url( get_term_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
							}
						}
						?>
					</ul>
				<?php else : ?>
					<ul><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'unmute' ); ?></a></li></ul>
				<?php endif; ?>
			</nav>

			<nav class="unmute-footer__col" aria-label="<?php esc_attr_e( 'العلامة', 'unmute' ); ?>">
				<h3 class="unmute-footer__title"><?php esc_html_e( 'العلامة', 'unmute' ); ?></h3>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => '',
							'depth'          => 1,
							'items_wrap'     => '<ul>%3$s</ul>',
						)
					);
				} else {
					echo '<ul>';
					echo '<li><a href="' . esc_url( home_url( '/?post_type=post' ) ) . '">' . esc_html__( 'المدونة', 'unmute' ) . '</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/#story' ) ) . '">' . esc_html__( 'قصّتنا', 'unmute' ) . '</a></li>';
					echo '</ul>';
				}
				?>
			</nav>

			<div class="unmute-footer__col">
				<h3 class="unmute-footer__title"><?php esc_html_e( 'المساعدة والتواصل', 'unmute' ); ?></h3>
				<ul>
					<?php
					if ( has_nav_menu( 'footer-help' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer-help',
								'container'      => false,
								'menu_class'     => '',
								'depth'          => 1,
								'items_wrap'     => '%3$s',
							)
						);
					} else {
						$privacy = get_privacy_policy_url();
						if ( $privacy ) {
							echo '<li><a href="' . esc_url( $privacy ) . '">' . esc_html__( 'سياسة الخصوصية', 'unmute' ) . '</a></li>';
						}
					}
					$email = unmute_option( 'footer_email' );
					if ( $email ) {
						echo '<li><a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a></li>';
					}
					$phone = unmute_option( 'footer_phone' );
					if ( $phone ) {
						echo '<li><span>' . esc_html( $phone ) . '</span></li>';
					}
					$address = unmute_option( 'footer_address' );
					if ( $address ) {
						echo '<li><span>' . esc_html( wp_strip_all_tags( $address ) ) . '</span></li>';
					}
					?>
				</ul>
			</div>

			<nav class="unmute-footer__col" aria-label="<?php esc_attr_e( 'الأسئلة والحساب', 'unmute' ); ?>">
				<h3 class="unmute-footer__title"><?php esc_html_e( 'الحساب', 'unmute' ); ?></h3>
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<ul>
						<li><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'حسابي', 'unmute' ); ?></a></li>
						<li><a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php esc_html_e( 'حقيبة التسوق', 'unmute' ); ?></a></li>
						<li><a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"><?php esc_html_e( 'إتمام الشراء', 'unmute' ); ?></a></li>
						<?php if ( function_exists( 'wc_get_page_permalink' ) && wc_get_page_id( 'terms' ) > 0 ) : ?>
							<li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'terms' ) ) ); ?>"><?php esc_html_e( 'الشروط', 'unmute' ); ?></a></li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>
			</nav>
		</div>

		<div class="unmute-footer__bottom">
			<p>
				<?php
				$copyright = unmute_option( 'footer_copyright' );
				if ( $copyright ) {
					echo esc_html( $copyright );
				} else {
					/* translators: %s: year + site name. */
					echo esc_html( sprintf( __( '© %1$s %2$s — EXPRESS WITHOUT LIMITS.', 'unmute' ), gmdate( 'Y' ), get_bloginfo( 'name' ) ) );
				}
				?>
			</p>
			<p class="unmute-footer__credits">
				<?php esc_html_e( 'مدعوم بـ WordPress و WooCommerce', 'unmute' ); ?>
			</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
