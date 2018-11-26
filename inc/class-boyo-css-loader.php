<?php
/**
 * This file is for handling CSS file loading.
 *
 * @package Boyo
 */

/**
 * Loads css styles.
 */
class Boyo_CSS_Loader {

	/**
	 * Registering stylesheets for future use.
	 */
	public static function register_stylesheets() {
		$dir = new DirectoryIterator( get_template_directory() . '/css' );
		$theme_version = wp_get_theme()->get( 'Version' );
		foreach ( $dir as $item ) {
			$ext = $item->getExtension();
			if ( 'css' === $ext ) {
				$file = $item->getFilename();
				$filename = $item->getBasename( '.css' );
				wp_register_style( 'boyo-' . $filename, get_theme_file_uri( '/css/' . $file ), array(), $theme_version, self::supported_browsers_string() );
				if ( self::is_header_css( $filename ) ) {
					wp_enqueue_style( 'boyo-' . $filename );
				}
			}
		}
	}

	/**
	 * Load required css files.
	 * Atomic loading of css files related to specific template.
	 *
	 * @param array $filename Name of css file.
	 * @return void
	 */
	public static function css_loader( $filename ) {
		wp_print_styles( 'boyo-' . $filename );
	}

	/**
	 * Based on https://github.com/Fall-Back/CSS-Mustard-Cut
	 * No CSS applied for old browsers - only html served.
	 *
	 * Print (Edge doesn't apply to print otherwise)
	 * IE 10, 11
	 * Edge
	 * Chrome 29+, Opera 16+, Safari 6.1+, iOS 7+, Android ~4.4+
	 * FF 29+
	 */
	private static function supported_browsers_string() {

		$output = 'only print,';
		$output .= 'only all and (-ms-high-contrast: none),';
		$output .= 'only all and (-ms-high-contrast: active),';
		$output .= 'only all and (pointer: fine),';
		$output .= 'only all and (pointer: coarse),';
		$output .= 'only all and (pointer: none),';
		$output .= 'only all and (-webkit-min-device-pixel-ratio:0) and (min-color-index:0),';
		$output .= 'only all and (min--moz-device-pixel-ratio:0) and (min-resolution: 3e1dpcm)';
		return $output;
	}

	/**
	 * Checks if css file should go to head section - if it's named header-*.css.
	 *
	 * @param array $filename Name of css file.
	 * @return bool
	 */
	private static function is_header_css( $filename ) {
		if ( 'base' === $filename ) {
			return true;
		}
		return false;
	}
}

/**
 * Function for registering stylesheets - for usage outside the class.
 */
function boyo_register_stylesheets() {
	Boyo_CSS_Loader::register_stylesheets();
}

/**
 * Function for loading css files related to specific template.
 *
 * @param array $filename Name of css file.
 * @return void
 * @see Boyo_CSS_Loader::css_loader()
 */
function boyo_css_loader( $filename ) {
	Boyo_CSS_Loader::css_loader( $filename );
}
