<?php
/**
 * Comments option for theme customizer
 *
 * @package material-theme
 */

namespace MaterialTheme\Customizer\Comments;

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
 * Add and initialize comments section
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function register( $wp_customize ) {
	$wp_customize->add_section(
		Customizer\prepend_slug( 'comments_section' ),
		[
			'title' => esc_html__( 'Comments', 'material-theme' ),
		]
	);

	add_settings( $wp_customize );
}

/**
 * Add regular controls
 * Call to parent function
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function add_controls( $wp_customize ) {
	$controls = [];

	foreach ( get_controls() as $control ) {
		$controls[ $control['id'] ] = $control;
	}

	Customizer\add_controls( $wp_customize, $controls );
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
			'transport' => 'refresh',
			'default'   => $control['default'],
		];
	}

	Customizer\add_settings( $wp_customize, $settings );

	add_controls( $wp_customize );
}

/**
 * Define core controls to use
 *
 * @return array
 */
function get_controls() {
	return [
		[
			'id'      => 'comment_fields_style',
			'label'   => esc_html__( 'Text field style', 'material-theme' ),
			'type'    => 'radio',
			'section' => Customizer\prepend_slug( 'comments_section' ),
			'default' => 'outlined',
			'choices' => [
				'outlined' => esc_html__( 'Outlined', 'material-theme' ),
				'filled'   => esc_html__( 'Filled', 'material-theme' ),
			],
		],
	];
}
