<?php
/**
 * Material Theme Customizer
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Customizer\Colors;

use MaterialTheme\Customizer;

/**
 * Attach hooks.
 *
 * @return void
 */
function setup() {
	add_action( 'customize_register', __NAMESPACE__ . '\register' );
}

/**
 * Add and initialize footer section
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function register( $wp_customize ) {
	$wp_customize->add_section(
		'material_colors_section',
		[
			'title' => esc_html__( 'Colors', 'material-theme' ),
		]
	);

	/**
	 * Generate list of all the settings in the colors section.
	 */
	$settings = [];

	foreach ( get_controls() as $control ) {
		$settings[ $control['id'] ] = [
			'sanitize_callback' => 'sanitize_hex_color',
		];
	}

	Customizer\add_settings( $wp_customize, $settings );
	Customizer\add_color_controls( $wp_customize, get_controls(), 'colors_section' );
}

/**
 * Define core controls to use
 *
 * @return array
 */
function get_controls() {
	return [
		[
			'id'                   => 'background_color',
			'label'                => esc_html__( 'Background Color', 'material-theme' ),
			'related_text_setting' => Customizer\prepend_slug( 'background_text_color' ),
			'css_var'              => '--mdc-theme-background',
			'a11y_label'           => __( 'On Background', 'material-theme' ),
		],
		[
			'id'              => 'background_text_color',
			'label'           => esc_html__( 'Text Color', 'material-theme' ),
			'related_setting' => Customizer\prepend_slug( 'background_color' ),
			'css_var'         => '--mdc-theme-on-background',
			'a11y_label'      => __( 'On Background', 'material-theme' ),
		],
	];
}
