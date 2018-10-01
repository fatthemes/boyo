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
boyo_css_loader( 'theme' );
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
					<?php // if(function_exists('boyo_themes_the_subtitle')) :
							boyo_themes_the_subtitle();
					// endif; ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="boyo-intro">
						<?php the_content(); ?>
					</div>
					<div class="boyo-themes-links-wrapper">
						<ul class="boyo-themes-links">
						<?php if(!empty(get_theme_mod( 'donate_url', '' ))) : ?>
							<li class="boyo-themes-links-item boyo-themes-links-donate-url"><a href="<?php  the_permalink( get_theme_mod( 'donate_url', '' )); ?>"><?php esc_html_e('Make a Contribution', 'boyo') ?></a></li>
						<?php endif; ?>
						<?php if(!empty(get_theme_mod( 'donate_url', '' ))) : ?>
							<li class="boyo-themes-links-item boyo-themes-links-support-url"><a href="<?php  the_permalink( get_theme_mod( 'support_url', '' )); ?>"><?php esc_html_e('Support', 'boyo') ?></a></li>
						<?php endif; ?>
						</ul>
					</div>
					<div class="boyo-themes-counter-wrapper">
						<div class="hexagon">
							<?php boyo_themes_the_counter(); ?>
						</div>
					</div>

					<?php
					if (function_exists('boyo_themes_the_featured_list')) {
						boyo_themes_the_themes();
					}
					?>

					<div class="boyo-themes-featured">
						<?php
						if (function_exists('boyo_themes_the_featured_list')) {
							boyo_themes_the_featured_list();
						}
						?>
					</div>
					<div class="boyo-themes-testimonials">
						<?php
						if (function_exists('boyo_themes_the_testimonials_list')) {
							boyo_themes_the_testimonials_list();
						}
						?>
					</div>
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
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
