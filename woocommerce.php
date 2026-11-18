<?php
/**
 * The template for displaying WooCommerce shop, product archive and product pages.
 *
 * @link https://woocommerce.com/document/woocommerce-theme-developer-handbook/
 *
 * @package Boyo
 */

get_header();

$boyo_shop_sidebar = boyo_woocommerce_has_sidebar();
?>

	<div class="boyo-shop<?php echo esc_attr( $boyo_shop_sidebar ? ' has-shop-sidebar' : '' ); ?>">
		<?php
		// The Shop Sidebar comes first: left of the products on desktop, above them on small screens.
		if ( $boyo_shop_sidebar ) {
			get_sidebar( 'shop' );
		}
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php woocommerce_content(); ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .boyo-shop -->

<?php
get_footer();
