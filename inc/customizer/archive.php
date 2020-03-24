<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package Material-theme-wp
 */

namespace MaterialTheme\Customizer\Archive;

use MaterialTheme\Customizer;

/**
 * Attach hooks
 */
function setup() {
	add_action( 'customize_register', __NAMESPACE__ . '\register' );
}

function register( $wp_customize ) {
	add_settings( $wp_customize );
}

/**
 * Define core controls to use
 *
 * @return void
 */
function get_controls() {
	return [
		[
			'id'      => Customizer\prepend_slug( 'archive_layout' ),
			'label'   => esc_html__( 'Choose archive layout', 'material-theme-wp' ),
			'type'    => 'radio',
			'choices' => [
				'card'  => esc_html__( 'Card', 'material-theme-wp' ),
				'image' => esc_html__( 'Image List', 'material-theme-wp' )
			],
		],
	];
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

	add_controls( $wp_customize );
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
		$controls[ $control[ 'id' ] ] = array_merge( [
			'label' => $control['label'],
			'section' => 'static_front_page',
			'type'    => $control['type'],
		], $control );
	}

	Customizer\add_controls( $wp_customize, $controls );
}
