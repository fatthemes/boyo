<?php
/**
 * The template for displaying all single docs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Boyo
 */

get_header();
boyo_css_loader( 'single-doc' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
while (have_posts()):
    the_post();

    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('</p><p id="breadcrumbs">', '</p><p>');
    }

    the_title();

    if (function_exists('boyo_docs_get_demo_url')) {
        echo esc_url(boyo_docs_get_demo_url());
    }
    if (function_exists('boyo_docs_get_download_url')) {
        echo esc_url(boyo_docs_get_download_url());
    }

	if (function_exists('boyo_docs_the_table_of_content')) {
        boyo_docs_the_table_of_content();
    }

    the_content();

    if (function_exists('boyo_docs_the_docs_list')) {
		boyo_docs_the_docs_list();
    }

    if (function_exists('boyo_docs_the_sections')) {
		boyo_docs_the_sections();
    }

endwhile; // End of the loop.
?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
