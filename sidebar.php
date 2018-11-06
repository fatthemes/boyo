<?php
/**
 * The sidebar containing the top widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boyo
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
boyo_css_loader( 'widgets' );
?>

		<aside id="top" class="widget-area top-widget-area">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</aside><!-- #top -->
