<?php
/**
 * The template for displaying all single themes
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Boyo
 */

get_header();
boyo_css_loader( 'theme' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
while (have_posts()):
    the_post();

    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">', '</p>');
	}
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<header class="entry-header">
		<div class="entry-header-wrapper">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			<?php if(function_exists('boyo_themes_the_subtitle')) :
				boyo_themes_the_subtitle();
			endif; ?>
			<div class="boyo-intro">
				<?php the_content(); ?>
			</div>
			</div>
			<div class="image-wrapper">
				<?php boyo_post_thumbnail(); ?>
			</div>
		</header>
		

		<div class="entry-content">
			<div class="boyo-themes-links-box">
				<div class="boyo-themes-links-wrapper">
					<ul class="boyo-themes-links">
					<?php
						if (function_exists('boyo_themes_get_download_url')) {
							echo '<li class="boyo-themes-links-item boyo-themes-links-download-url"><a href="' . esc_url(boyo_themes_get_download_url()) . '">' . esc_html__('Free Download', 'boyo') . '</a></li>';
						}

						if (function_exists('boyo_themes_get_demo_url')) {
							echo '<li class="boyo-themes-links-item boyo-themes-links-demo-url"><a href="' . esc_url(boyo_themes_get_demo_url()) . '">' . esc_html__('Live Demo', 'boyo') . '</a></li>';
						}

						if (function_exists('boyo_themes_get_translation_link')) {
							echo '<li class="boyo-themes-links-item boyo-themes-links-translation-url"><a href="' . esc_url(boyo_themes_get_translation_link()) . '">' . esc_html__('Help Translate', 'boyo') . '</a></li>';
						}

						if(function_exists('boyo_themes_get_related_doc')) { ?>
							<li class="boyo-themes-links-item boyo-themes-links-docs-url"><a href="<?php the_permalink(boyo_themes_get_related_doc()); ?>"><?php esc_html_e('Theme Documentation', 'boyo') ?></a></li>
						<?php }

						if(!empty(get_theme_mod( 'donate_url', '' ))) { ?>
							<li class="boyo-themes-links-item boyo-themes-links-donate-url"><a href="<?php  the_permalink( get_theme_mod( 'donate_url', '' )); ?>"><?php esc_html_e('Make a Contribution', 'boyo') ?></a></li>
							<?php }
					?>
					</ul>
				</div>
			</div>
			<div class="boyo-themes-theme-details">
			<?php
				if(function_exists('boyo_themes_the_theme_details')) {
					boyo_themes_the_theme_details();
				}
			?>
			<span class="boyo-themes-theme-details-changelog-url"><a href="#boyo-themes-changelog"><strong><?php esc_html_e('View Changelog', 'boyo'); ?></strong></a></span>
			</div>
			<div class="entry-content-wrapper">
			<?php
			if (function_exists('boyo_themes_the_sections')) {
				?>
				<div class="boyo-themes-sections">
					<?php boyo_themes_the_sections(); ?>
				</div>
				<?php
			} ?>
			</div>
			<?php
			if (function_exists('boyo_themes_the_testimonials_list')) {
				?>
				<div class="boyo-themes-testimonials-wrapper">
				<div class="boyo-themes-testimonials">
					<?php boyo_themes_the_testimonials_list(); ?>
				</div>
				</div>
				<?php
			}

			if (function_exists('boyo_themes_get_theme_changelog')) : ?>
				<section id="boyo-themes-changelog" class="boyo-themes-changelog">
					<div class="boyo-themes-changelog-wrapper">
						<?php echo wp_kses_post(boyo_themes_get_theme_changelog()); ?>
					</div>
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
