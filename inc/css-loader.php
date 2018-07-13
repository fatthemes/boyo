<?php
/**
 * This file is for handling atomic CSS file loading.
 *
 * @package Boyo
 */

if ( ! function_exists( 'boyo_css_loader' ) ) :
	/**
	 * Load required css files.
	 *
	 * Atomic loading of css files related to specific template.
	 */
	function boyo_css_loader( $filename ) {
		$css_path_part = get_template_directory() . '/css/' . $filename;
		$css_array = array(
			'sm' => $css_path_part . '-sm.css',
			'md' => $css_path_part . '-md.css',
			'lg' => $css_path_part . '-lg.css',
			'xl' => $css_path_part . '-xl.css',
		);
		foreach( $css_array as $size => $css_file ) {
			if( file_exists( $css_file ) ) {
				wp_print_styles( 'boyo-' . $filename . '-' . $size );
			}
		}
	}
endif;

if ( ! function_exists( 'boyo_register_stylesheets' ) ) :
	/**
	 * Load 
	 */
	function boyo_register_stylesheets() {
		$dir = new DirectoryIterator( get_template_directory() . '/css' );
		$theme_version = wp_get_theme()->get('Version');
		foreach ($dir as $item) {
			$ext = $item->getExtension();
			if ( 'css' === $ext ) {
				$file =  $item->getFilename();
				$filename = $item->getBasename( '.css' );
				$min_width = boyo_get_min_width_from_filename( $filename );
				wp_register_style( 'boyo-' . $filename, get_theme_file_uri( '/css/' . $file ), array(), $theme_version, boyo_supported_browsers_string( $min_width ) );
				if( boyo_is_header_css( $filename ) ) {
					wp_enqueue_style( 'boyo-' . $filename );
				}
			}
		}
	}
endif;

if ( ! function_exists( 'boyo_get_min_width_from_filename' ) ) :
	/**
	 * Load 
	 */
	function boyo_get_min_width_from_filename( $filename ) {
		$pre_size = explode( '-', $filename );
		$size = $pre_size[1];
		switch( $size ) {
			case 'xl':
				return '1281px';
			break;
			case 'lg':
				return '961px';
			break;
			case 'md':
				return '481px';
			break;
			default:
				return '';
			break;
		}
	}
endif;

if ( ! function_exists( 'boyo_supported_browsers_string' ) ) :
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
	function boyo_supported_browsers_string( $min_width = '' ) {
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
endif;

if ( ! function_exists( 'boyo_is_header_css' ) ) :
	/**
	 * Checks if css file should go to head section - if it's named header-*.css.
	 */
	function boyo_is_header_css( $filename ) {
		$header = explode( '-', $filename );
		if( $header[0] && 'header' === $header[0] ) {
			return true;
		}
		return false;
	}
endif;
