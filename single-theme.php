<?php
/**
 * The template for displaying all single themes
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Boyo
 */

get_header();
boyo_css_loader( 'single-theme' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
while (have_posts()):
    the_post();

    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('</p><p id="breadcrumbs">', '</p><p>');
	}
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1><?php the_title(); ?></h1>
			<?php
			if (function_exists('boyo_themes_the_subtitle')) {
				?>
				<p class="boyo-themes-subtitle"><?php boyo_themes_the_subtitle(); ?></p>
				<?php
			}
			?>
		</header>
		<div class="entry-content">
			<div class="boyo-themes-details">
			<?php
				if (function_exists('boyo_themes_get_demo_url')) {
					echo esc_url(boyo_themes_get_demo_url());
				}
				
				if (function_exists('boyo_themes_get_download_url')) {
					echo esc_url(boyo_themes_get_download_url());
				}

				if(function_exists('boyo_docs_get_related_doc')) {
					the_permalink(boyo_docs_get_related_doc());
				}

				if(!empty(get_theme_mod( 'donate_url', '' ))) {
					the_permalink( get_theme_mod( 'donate_url', '' ) );
				}
				
				if(function_exists('boyo_themes_the_theme_details')) {
					boyo_themes_the_theme_details();
				}
			?>
			</div>
			<div class="boyo-intro">
				<?php the_content(); ?>
			</div>
			<?php
			if (function_exists('boyo_themes_the_sections')) {
				?>
				<div class="boyo-themes-sections">
					<?php boyo_themes_the_sections(); ?>
				</div>
				<?php
			}

			if (function_exists('boyo_themes_the_testimonials_list')) {
				boyo_themes_the_testimonials_list();
			}

			if (function_exists('boyo_themes_get_theme_changelog')) : ?>
				<section class="boyo-themes-changelog">
					<?php echo wp_kses_post(boyo_themes_get_theme_changelog()); ?>
				</section>
			<?php endif; ?>
		</div>

	</article>
	<?php
endwhile; // End of the loop.
?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
