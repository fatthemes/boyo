<?php
/**
 * The sidebar containing the bottom widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boyo
 */

if ( ! is_active_sidebar( 'sidebar-3' ) ) {
	return;
}
boyo_css_loader( 'widgets' );
?>

		<aside id="bottom" class="widget-area bottom-widget-area">
			<div class="bottom-widget-area-wrapper">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div>
		</aside><!-- #bottom -->
