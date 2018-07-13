<?php
/**
 * Boyo Theme Customizer
 *
 * @package Boyo
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function boyo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'boyo_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'boyo_customize_partial_blogdescription',
		) );
	}

	// Section - "Advanced settings".
	$wp_customize->add_section(
		'advanced_settings', array(
			'title' => esc_html__( 'Advanced', 'blover' ),
			'priority' => 1050,
			'description' => esc_html__( 'Advanced Settings', 'blover' ),
		)
	);

	$wp_customize->add_setting(
		'load_google_fonts_from_google', array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'load_google_fonts_from_google', array(
			'label' => esc_html__( 'Load fonts from Google servers', 'loose' ),
			'section' => 'advanced_settings',
			'type' => 'checkbox',
		)
	);

}
add_action( 'customize_register', 'boyo_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function boyo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function boyo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function boyo_customize_preview_js() {
	wp_enqueue_script( 'boyo-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'boyo_customize_preview_js' );
