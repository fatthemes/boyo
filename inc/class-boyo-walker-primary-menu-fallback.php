<?php
/**
 * Page walker used by the primary menu fallback.
 *
 * @see boyo_primary_menu_fallback()
 *
 * @package Boyo
 */

/**
 * Page walker for the primary menu fallback.
 *
 * Outputs submenus as ul.sub-menu (instead of ul.children) to match
 * the markup of wp_nav_menu().
 */
class Boyo_Walker_Primary_Menu_Fallback extends Walker_Page {
	/**
	 * Outputs the beginning of a submenu.
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param int    $depth  Depth of page.
	 * @param array  $args   Arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n{$indent}<ul class=\"sub-menu\">\n";
	}
}
