<?php
/**
 * UNMUTE — header.
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#unmute-main"><?php esc_html_e( 'Skip to content', 'unmute' ); ?></a>

<?php if ( unmute_option( 'bar_show' ) && unmute_option( 'bar_text' ) ) : ?>
	<div class="unmute-bar">
		<div class="unmute-container">
			<p><?php echo esc_html( unmute_option( 'bar_text' ) ); ?></p>
		</div>
	</div>
<?php endif; ?>

<header id="masthead" class="unmute-header">
	<div class="unmute-container unmute-header__inner">

		<a class="unmute-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<?php echo unmute_sparkle( 'unmute-brand__mark' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
				<span class="unmute-brand__name"><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
		</a>

		<nav class="unmute-header__nav" aria-label="<?php esc_attr_e( 'Primary', 'unmute' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'unmute-nav',
					'fallback_cb'    => 'unmute_fallback_menu',
					'depth'          => 2,
				)
			);
			?>
		</nav>

		<div class="unmute-header__actions">
			<button class="unmute-iconbtn" type="button" data-unmute-search-toggle aria-expanded="false" aria-controls="unmute-search-panel">
				<?php echo unmute_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Search', 'unmute' ); ?></span>
			</button>

			<a class="unmute-iconbtn" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url() ); ?>">
				<?php echo unmute_icon( 'user' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Account', 'unmute' ); ?></span>
			</a>

			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<a class="unmute-iconbtn unmute-iconbtn--cart" href="<?php echo esc_url( wc_get_page_permalink( 'cart' ) ); ?>">
					<?php echo unmute_icon( 'bag' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
					<span class="unmute-cart-count"><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></span>
					<span class="screen-reader-text"><?php esc_html_e( 'Cart', 'unmute' ); ?></span>
				</a>
			<?php endif; ?>

			<button class="unmute-iconbtn unmute-menu-toggle" type="button" data-unmute-menu-toggle aria-expanded="false" aria-controls="unmute-drawer">
				<?php echo unmute_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'unmute' ); ?></span>
			</button>
		</div>
	</div>

	<div class="unmute-search-panel" id="unmute-search-panel" hidden>
		<div class="unmute-container">
			<?php get_search_form(); ?>
		</div>
	</div>
</header>

<div class="unmute-drawer" id="unmute-drawer" hidden>
	<div class="unmute-drawer__head">
		<span class="unmute-drawer__title"><?php bloginfo( 'name' ); ?></span>
		<button class="unmute-iconbtn" type="button" data-unmute-menu-toggle aria-expanded="false" aria-controls="unmute-drawer">
			<?php echo unmute_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotSanitized ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Close menu', 'unmute' ); ?></span>
		</button>
	</div>
	<nav aria-label="<?php esc_attr_e( 'Mobile', 'unmute' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'unmute-nav unmute-nav--stacked',
				'fallback_cb'    => 'unmute_fallback_menu',
			)
		);
		?>
	</nav>
	<div class="unmute-drawer__foot">
		<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<a class="unmute-btn unmute-btn--primary" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Shop Now', 'unmute' ); ?></a>
		<?php endif; ?>
		<?php unmute_social_links(); ?>
	</div>
</div>
<div class="unmute-scrim" data-unmute-menu-toggle hidden></div>

<main id="unmute-main" class="unmute-main">
