<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Boyo
 */

get_header();
boyo_css_loader( 'archive' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php if ( have_posts() ) : ?>
			<div id="articles-wrapper" class="articles-wrapper">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				if ( is_sticky() && ! is_paged() ) :
					get_template_part( 'template-parts/content', 'sticky' );
				else :
					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_format() );

				endif;
			endwhile;
			?>
			</div><!-- #articles-wrapper -->
			<?php
			the_posts_pagination(
				array(
					'prev_text' => esc_html__( 'Prev', 'boyo' ),
				)
			);

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
