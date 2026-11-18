<?php
/**
 * The sidebar containing the shop widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boyo
 */

if ( ! is_active_sidebar( 'boyo-shop-sidebar' ) ) {
	return;
}
boyo_css_loader( 'widgets' );
?>

		<aside id="secondary" class="widget-area shop-widget-area" aria-label="<?php esc_attr_e( 'Shop Sidebar', 'boyo' ); ?>">
			<?php dynamic_sidebar( 'boyo-shop-sidebar' ); ?>
		</aside><!-- #secondary -->
