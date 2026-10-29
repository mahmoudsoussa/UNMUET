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
	<div class="unmute-container unmute-footer__grid">

		<div class="unmute-footer__brand">
			<a class="unmute-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php echo unmute_sparkle( 'unmute-brand__mark' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
				<span class="unmute-brand__name"><?php bloginfo( 'name' ); ?></span>
			</a>
			<p class="unmute-footer__blurb"><?php echo esc_html( unmute_option( 'footer_blurb' ) ); ?></p>
			<?php unmute_social_links(); ?>
		</div>

		<nav class="unmute-footer__col" aria-label="<?php esc_attr_e( 'Shop', 'unmute' ); ?>">
			<h3 class="unmute-footer__title"><?php esc_html_e( 'Shop', 'unmute' ); ?></h3>
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<ul>
					<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'All pieces', 'unmute' ); ?></a></li>
					<?php
					$cats = get_terms(
						array(
							'taxonomy'   => 'product_cat',
							'parent'     => 0,
							'number'     => 6,
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
				<ul><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'unmute' ); ?></a></li></ul>
			<?php endif; ?>
		</nav>

		<nav class="unmute-footer__col" aria-label="<?php esc_attr_e( 'Company', 'unmute' ); ?>">
			<h3 class="unmute-footer__title"><?php esc_html_e( 'Company', 'unmute' ); ?></h3>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => '',
						'depth'          => 1,
					)
				);
			} else {
				echo '<ul>';
				echo '<li><a href="' . esc_url( home_url( '/?post_type=post' ) ) . '">' . esc_html__( 'Journal', 'unmute' ) . '</a></li>';
				echo '<li><a href="' . esc_url( home_url( '/#story' ) ) . '">' . esc_html__( 'Our story', 'unmute' ) . '</a></li>';
				echo '</ul>';
			}
			?>
		</nav>

		<div class="unmute-footer__col">
			<h3 class="unmute-footer__title"><?php esc_html_e( 'Help & contact', 'unmute' ); ?></h3>
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
						echo '<li><a href="' . esc_url( $privacy ) . '">' . esc_html__( 'Privacy policy', 'unmute' ) . '</a></li>';
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
					echo '<li><span>' . esc_html( $address ) . '</span></li>';
				}
				?>
			</ul>
		</div>
	</div>

	<div class="unmute-container unmute-footer__bottom">
		<p>
			<?php
			$copyright = unmute_option( 'footer_copyright' );
			if ( $copyright ) {
				echo esc_html( $copyright );
			} else {
				/* translators: %s: year + site name. */
				echo esc_html( sprintf( __( '© %1$s %2$s — Wear What You Feel.', 'unmute' ), gmdate( 'Y' ), get_bloginfo( 'name' ) ) );
			}
			?>
		</p>
		<p class="unmute-footer__credits">
			<?php esc_html_e( 'Powered by WordPress & WooCommerce', 'unmute' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
