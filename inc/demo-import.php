<?php
/**
 * Boyo Theme Demo import configuration.
 *
 * @package boyo
 */

/**
 * Demo import configuration.
 *
 * @return type
 */
function boyo_by_fat_import_files() {
	return array(
		array(
			'import_file_name'             => esc_html__( 'Demo 1', 'boyo' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demos/1/demo1-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/1/demo1-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demos/1/demo1-customizer.dat',
			'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/demos/1/boyo1.jpg',
			'preview_url'                  => 'https://boyo1.blogonyourown.com/',
		),
		array(
			'import_file_name'             => esc_html__( 'Demo 2', 'boyo' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demos/2/demo2-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/2/demo2-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demos/2/demo2-customizer.dat',
			'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/demos/2/boyo2.jpg',
			'preview_url'                  => 'https://boyo2.blogonyourown.com/',
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'boyo_by_fat_import_files' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
