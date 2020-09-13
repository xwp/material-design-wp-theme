<?php
/**
 * Material-theme-wp Theme Customizer
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
 * Add and initialize colors section
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function register( $wp_customize ) {
	// Add color palettes section.
	$args = [
		'priority' => 50,
		'title'    => esc_html__( 'Color Palettes', 'material-theme' ),
	];

	Customizer\add_section( $wp_customize, 'colors', $args );

	add_settings( $wp_customize );
}

/**
 * Create settings based on controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function add_settings( $wp_customize ) {
	$settings = [];

	foreach ( get_controls() as $control ) {
		$settings[ $control['id'] ] = [
			'transport' => 'postMessage',
		];
	}

	Customizer\add_settings( $wp_customize, $settings );
	Customizer\add_color_controls( $wp_customize, get_controls(), 'colors' );
}

/**
 * Define color controls to use
 *
 * @return array
 */
function get_controls() {
	return [
		[
			'id'         => 'primary_color',
			'label'      => esc_html__( 'Primary Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-primary',
			'a11y_label' => __( 'On Primary', 'material-theme' ),
		],
		[
			'id'         => 'on_primary_color',
			'label'      => esc_html__( 'On Primary Color (text and icons)', 'material-theme' ),
			'css_var'    => '--mdc-theme-on-primary',
			'a11y_label' => __( 'On Primary', 'material-theme' ),
		],
		[
			'id'         => 'secondary_color',
			'label'      => esc_html__( 'Secondary Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-secondary',
			'a11y_label' => __( 'On Secondary', 'material-theme' ),
			'default'    => '#03dac6',
		],
		[
			'id'         => 'on_secondary_color',
			'label'      => esc_html__( 'On Secondary Color (text and icons)', 'material-theme' ),
			'css_var'    => '--mdc-theme-on-secondary',
			'a11y_label' => __( 'On Secondary', 'material-theme' ),
		],
		[
			'id'         => 'surface_color',
			'label'      => esc_html__( 'Surface Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-surface',
			'a11y_label' => __( 'On Surface', 'material-theme' ),
		],
		[
			'id'         => 'on_surface_color',
			'label'      => esc_html__( 'On Surface Color (text and icons)', 'material-theme' ),
			'css_var'    => '--mdc-theme-on-surface',
			'a11y_label' => __( 'On Surface', 'material-theme' ),
		],
		[
			'id'         => 'background_color',
			'label'      => esc_html__( 'Background Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-background',
			'a11y_label' => __( 'On Background', 'material-theme' ),
		],
		[
			'id'         => 'on_background_color',
			'label'      => esc_html__( 'On Background Color (text and icons)', 'material-theme' ),
			'css_var'    => '--mdc-theme-on-background',
			'a11y_label' => __( 'On Background', 'material-theme' ),
		],
		[
			'id'      => 'header_color',
			'label'   => esc_html__( 'Header Color', 'material-theme' ),
			'css_var' => '--mdc-theme-header',
		],
		[
			'id'      => 'on_header_color',
			'label'   => esc_html__( 'On Header Color (text and icons)', 'material-theme' ),
			'css_var' => '--mdc-theme-on-header',
		],
		[
			'id'         => 'footer_color',
			'label'      => esc_html__( 'Footer Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-footer',
			'a11y_label' => __( 'On Background', 'material-theme' ),
		],
		[
			'id'         => 'on_footer_color',
			'label'      => esc_html__( 'On Footer Color (text and icons)', 'material-theme' ),
			'css_var'    => '--mdc-theme-on-footer',
			'a11y_label' => __( 'On Background', 'material-theme' ),
		],
	];
}
