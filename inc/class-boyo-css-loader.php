<?php
/**
 * This file is for handling CSS file loading.
 *
 * @package Boyo
 */

class Boyo_CSS_Loader {
	private $screen_sizes = array();

	private static $_instance = null;

	public function __construct() {
		$this->screen_sizes = apply_filters( 'boyo_screen_sizes', $screen_sizes = array(
			'sm' => '',
			'md' => '481px',
			'lg' => '961px',
			'xl' => '1281px',
		) );
	}

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function get_screen_sizes() {
		return $this->screen_sizes;
	}

	/**
	 * Registering stylesheets for future use.
	 */
	public function register_stylesheets() {
		$dir = new DirectoryIterator( get_template_directory() . '/css' );
		$theme_version = wp_get_theme()->get('Version');
		foreach ($dir as $item) {
			$ext = $item->getExtension();
			if ( 'css' === $ext ) {
				$file =  $item->getFilename();
				$filename = $item->getBasename( '.css' );
				$min_width = $this->get_min_width_from_filename( $filename );
				wp_register_style( 'boyo-' . $filename, get_theme_file_uri( '/css/' . $file ), array(), $theme_version, $this->supported_browsers_string( $min_width ) );
				if( $this->is_header_css( $filename ) ) {
					wp_enqueue_style( 'boyo-' . $filename );
				}
			}
		}
	}

	/**
	 * Load required css files.
	 *
	 * Atomic loading of css files related to specific template.
	 */
	public function css_loader( $filename ) {
		$sizes_sizes = $this->get_screen_sizes();
		$css_path_part = get_template_directory() . '/css/' . $filename;
		foreach( $sizes_sizes as $size => $min_width ) {
			$css_file = $css_path_part . '-' . $size . '.css';
			if( file_exists( $css_file ) ) {
				wp_print_styles( 'boyo-' . $filename . '-' . $size );
			}
		}
	}

	/**
	 * Get min-width value for media queries and conditional file loading.
	 */
	private function get_min_width_from_filename( $filename ) {
		$pre_size = explode( '-', $filename );
		$size = $pre_size[1];

		if( $this->screen_sizes[$size] ) {
			return $this->screen_sizes[$size];
		}
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
	private function supported_browsers_string( $min_width = '' ) {
        $min_width_string = '';
		if( ! empty( $min_width ) ) {
            $min_width_string = ', ';
			$min_width_string .= 'only all and ( min-width: ' . $min_width . ')';
		}
		$output = 'only print,';
		$output .= 'only all and (-ms-high-contrast: none), only all and (-ms-high-contrast: active),';
		$output .= 'only all and (pointer: fine), only all and (pointer: coarse), only all and (pointer: none),';
		$output .= 'only all and (-webkit-min-device-pixel-ratio:0) and (min-color-index:0),';
		$output .= 'only all and (min--moz-device-pixel-ratio:0) and (min-resolution: 3e1dpcm)' . $min_width_string;
		return $output;
	}

	/**
	 * Checks if css file should go to head section - if it's named header-*.css.
	 */
	private function is_header_css( $filename ) {
		$header = explode( '-', $filename );
		if( $header[0] && 'base' === $header[0] ) {
			return true;
		}
		return false;
	}
}

/**
 * Function for registering stylesheets - for usage outside the class.
 */
function boyo_register_stylesheets() {
	$css_loader = Boyo_CSS_Loader::instance();
	$css_loader->register_stylesheets();
}

/**
 * Function for loading of css files related to specific template.
 */
function boyo_css_loader( $filename ) {
	$css_loader = Boyo_CSS_Loader::instance();
	$css_loader->css_loader( $filename );
}
