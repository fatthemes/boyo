<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boyo
 */

if ( ! is_active_sidebar( 'sidebar-5' ) ) {
	return;
}
boyo_css_loader( 'widgets' );
?>

<aside id="page-below-content" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-5' ); ?>
</aside><!-- #page-below-content -->
