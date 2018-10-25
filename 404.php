<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Boyo
 */

get_header();
boyo_css_loader( '404' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Error 404', 'boyo' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p class="error404-content">404</p>
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'boyo' ); ?></p>
					<p><?php esc_html_e( 'Maybe try a search?', 'boyo' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
