<?php
/**
 * Template name: About Us
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Boyo
 */

get_header();
boyo_css_loader( 'page' );
//if( is_front_page() ) {
//	boyo_css_loader( 'front' );
//}
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php if(function_exists('boyo_companion_the_subtitle'))
						boyo_companion_the_subtitle(); ?>
				</header><!-- .entry-header -->

				<?php boyo_post_thumbnail(); ?>
				<div class="entry-content">
					<?php if(function_exists('boyo_companion_about_us_extra_info')) :
							boyo_companion_about_us_extra_info();
					endif; ?>
					<div class="about-us-content">
						<?php the_content(); ?>
					</div>
					<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'boyo' ),
						'after'  => '</div>',
					) );
					?>
				</div><!-- .entry-content -->

				<?php if(function_exists('boyo_companion_about_us_cite')) :
							boyo_companion_about_us_cite();
					endif; ?>

				<?php get_sidebar('page-below-content'); ?>

				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'boyo' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</article><!-- #post-<?php the_ID(); ?> -->
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
