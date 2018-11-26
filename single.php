<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Boyo
 */

get_header();
boyo_css_loader( 'singular' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			boyo_the_authors();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			the_post_navigation(
				array(
					'prev_text'          => '<span class="previous-article">' . esc_html__( 'Previous article', 'boyo' ) . '</span><h3 class="previous-article-title"> %title</h3>',
					'next_text'          => '<span class="next-article">' . esc_html__( 'Next article', 'boyo' ) . '</span><br><h3 class="next-article-title"> %title</h3>',
				)
			);

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
