<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boyo
 */

if ( ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
boyo_css_loader( 'widgets' );
?>

		<aside id="footer" class="widget-area footer-widget-area">
			<div class="footer-widget-area-wrapper">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div>
		</aside><!-- #footer -->
