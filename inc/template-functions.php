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

/**
 * Registers stylesheets for usage outside the class.
 */
function boyo_register_stylesheets() {
	Boyo_CSS_Loader::register_stylesheets();
}

/**
 * Loads CSS files related to a specific template.
 *
 * @param string $filename Name of CSS file.
 * @return void
 * @see Boyo_CSS_Loader::css_loader()
 */
function boyo_css_loader( $filename ) {
	Boyo_CSS_Loader::css_loader( $filename );
}

/**
 * Checks if the Top widget area should be displayed.
 *
 * An unsaved setting counts as enabled, so sites that already used the theme
 * before this setting existed keep displaying the Top widget area.
 *
 * @return bool
 */
function boyo_show_top_widget_area() {
	return (bool) get_theme_mod( 'boyo_show_top_widget_area', true );
}

/**
 * Hides the Top widget area by default when the theme is activated.
 */
function boyo_hide_top_widget_area_on_activation() {
	if ( null === get_theme_mod( 'boyo_show_top_widget_area', null ) ) {
		set_theme_mod( 'boyo_show_top_widget_area', false );
	}
}
add_action( 'after_switch_theme', 'boyo_hide_top_widget_area_on_activation' );

/**
 * Renames page list classes to their nav menu equivalents.
 *
 * Only hooked while boyo_primary_menu_fallback() runs.
 *
 * @param array   $css_class Classes of the page list item.
 * @param WP_Post $page      Page data object.
 * @param int     $depth     Depth of page.
 * @param array   $args      Arguments of wp_list_pages().
 * @return array
 */
function boyo_primary_menu_fallback_classes( $css_class, $page, $depth, $args ) {
	// Children beyond the depth limit are not displayed.
	if ( ! empty( $args['depth'] ) && $depth + 1 >= $args['depth'] ) {
		$css_class = array_diff( $css_class, array( 'page_item_has_children' ) );
	}

	$map = array(
		'page_item'              => 'menu-item',
		'page_item_has_children' => 'menu-item-has-children',
		'current_page_item'      => 'current-menu-item',
		'current_page_ancestor'  => 'current-menu-ancestor',
		'current_page_parent'    => 'current-menu-parent',
	);

	foreach ( $css_class as $key => $class ) {
		if ( isset( $map[ $class ] ) ) {
			$css_class[ $key ] = $map[ $class ];
		}
	}
	return $css_class;
}

/**
 * Displays a list of pages when no menu is assigned to the Primary location.
 *
 * @param array $args Arguments passed from wp_nav_menu().
 * @return string|void Menu markup when $args['echo'] is false.
 */
function boyo_primary_menu_fallback( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'container_class' => 'main-menu',
			'menu_id'         => 'primary-menu',
			'menu_class'      => 'menu',
			'echo'            => true,
		)
	);

	$defaults      = array(
		'number' => 4,
		'depth'  => 2,
	);
	$fallback_args = wp_parse_args( apply_filters( 'boyo_primary_menu_fallback_args', $defaults ), $defaults );

	$sort_column  = 'menu_order,post_title';
	$exclude_tree = array();
	if ( absint( $fallback_args['number'] ) > 0 ) {
		$top_level    = get_pages(
			array(
				'parent'       => 0,
				'hierarchical' => 0,
				'sort_column'  => $sort_column,
			)
		);
		$exclude_tree = array_slice( wp_list_pluck( $top_level, 'ID' ), absint( $fallback_args['number'] ) );
	}

	add_filter( 'page_css_class', 'boyo_primary_menu_fallback_classes', 10, 4 );
	$items = wp_list_pages(
		array(
			'title_li'     => '',
			'echo'         => false,
			'depth'        => absint( $fallback_args['depth'] ),
			'sort_column'  => $sort_column,
			'exclude_tree' => implode( ',', $exclude_tree ),
			'walker'       => new Boyo_Walker_Primary_Menu_Fallback(),
		)
	);
	remove_filter( 'page_css_class', 'boyo_primary_menu_fallback_classes', 10 );

	if ( empty( $items ) ) {
		return;
	}

	$menu = sprintf(
		'<div class="%1$s"><ul id="%2$s" class="%3$s">%4$s</ul></div>',
		esc_attr( $args['container_class'] ),
		esc_attr( $args['menu_id'] ),
		esc_attr( $args['menu_class'] ),
		$items
	);

	if ( $args['echo'] ) {
		echo $menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $menu;
	}
}
