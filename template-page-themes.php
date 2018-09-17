<?php
/**
 * Template name: Themes
 *
 *  The template for displaying main docs page - require BOYO Themes plugin
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Boyo
 */

get_header();
boyo_css_loader( 'page-themes' );
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
					<?php if(!empty(boyo_themes_the_main_page_subtitle())) :?>
					<p class="boyo-themes-main-page-subtitle"><?php boyo_themes_the_main_page_subtitle(); ?></p>
					<?php endif; ?>
				</header><!-- .entry-header -->

				<?php boyo_post_thumbnail(); ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->

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
			if (function_exists('boyo_themes_the_testimonials_list')) {
				boyo_themes_the_testimonials_list();
			}

			if (function_exists('boyo_themes_the_featured_list')) {
				boyo_themes_the_featured_list();
			}

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
