<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boyo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'boyo' ); ?></a>

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation">
			<?php the_custom_logo(); ?>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container_class' => 'main-menu',
					'fallback_cb' => false,
				)
			);
			?>
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'boyo' ); ?></span>
				<span class="hamburger-box">
					<span class="hamburger-bar-first"></span>
					<span class="hamburger-bar-second"></span>
					<span class="hamburger-bar-third"></span>
				</span>
			</button>
			<button id="search-toggle" class="search-toggle" aria-controls="search-form-wrapper" aria-expanded="false">
				<span class="screen-reader-text"><?php esc_html_e( 'Search', 'boyo' ); ?></span>
				<span class="search-button"><svg version="1.1" id="search_icon" x="0px"
	 y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
<path fill="#F05368" d="M17.545,16.684l-0.335,0.335l-0.813-0.813c1.246-1.42,2.009-3.275,2.009-5.309
	c0-4.446-3.616-8.063-8.06-8.063c-4.445,0-8.062,3.617-8.062,8.063c0,4.445,3.617,8.063,8.062,8.063
	c2.052,0,3.921-0.777,5.346-2.045l0.812,0.812l-0.372,0.372l7.013,7.012l1.414-1.414L17.545,16.684z M10.345,16.959
	c-3.343,0-6.062-2.72-6.062-6.063c0-3.343,2.719-6.063,6.062-6.063c3.341,0,6.06,2.72,6.06,6.063
	C16.405,14.239,13.687,16.959,10.345,16.959z"/>
</svg></span>
			</button>
			<div id="search-form-wrapper" class="search-form-wrapper" aria-expanded="false">
				<?php get_search_form(); ?>
				<button id="search-close" class="search-close">
				<span class="screen-reader-text"><?php esc_html_e( 'Search', 'boyo' ); ?></span>
				<span class="search-close-bars">
					<span class="search-close-bar-first"></span>
					<span class="search-close-bar-second"></span>
				</span>
			</button>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
<?php
get_sidebar();
boyo_css_loader( 'content' );
