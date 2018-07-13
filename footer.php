<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Boyo
 */

get_sidebar( 'bottom' );
boyo_css_loader( 'footer' );
?>

	</div><!-- #content -->
	<?php get_sidebar( 'footer' ); ?>
	<footer id="colophon" class="site-footer">
		<div class="site-info">
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme by %1$s', 'boyo' ), '<a href="https://blogonyourown.com/">BlogOnYourOwn.Com</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
