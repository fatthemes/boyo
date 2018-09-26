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
			$aaa_menu = wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'container_class'=> 'main-menu'
			) );
			?>
			<!--<button class="search-toggle">
				<span class="screen-reader-text"><?php esc_html_e( 'Search', 'boyo' ); ?></span>
				<span class="search-button"></span>
			</button>-->
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'boyo' ); ?></span>
				<span class="hamburger-box">
					<span class="hamburger-bar-first"></span>
					<span class="hamburger-bar-second"></span>
					<span class="hamburger-bar-third"></span>
				</span>
			</button>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
<?php get_sidebar( 'top' );
boyo_css_loader( 'content' );
