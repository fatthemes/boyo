<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Boyo
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function boyo_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of three-columns-layout when such settings chosen.
	if ( 'three' === get_theme_mod( 'blog_and_archive_pages_layout', '' ) && ( is_archive() || is_search() || is_home() ) ) {
		$classes[] = 'three-columns-layout';
	}

	return $classes;
}
add_filter( 'body_class', 'boyo_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post/article element.
 * @return array
 */
function boyo_post_classes( $classes ) {
	// Adds a class of not-sticky to the not sticky posts.
	if ( ! in_array( 'sticky', $classes ) ) {
		$classes[] = 'not-sticky';
	}
	return $classes;
}
add_filter( 'post_class', 'boyo_post_classes', 100 );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function boyo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'boyo_pingback_header' );

/**
 * Removes "more" text from excerpt.
 */
function boyo_excerpt_more() {
	return '';
}
add_filter( 'excerpt_more', 'boyo_excerpt_more', 100 );

/**
 * Modifies excerpt length.
 *
 * @param int $length excerpt length.
 * @return int
 */
function boyo_excerpt_length( $length ) {
	return get_theme_mod( 'excerpt_length', 20 );
}
add_filter( 'excerpt_length', 'boyo_excerpt_length', 100 );
