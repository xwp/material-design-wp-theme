<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package Material-theme-wp
 */

namespace MaterialTheme\Customizer\Footer;

use MaterialTheme\Customizer;

function add_section( $wp_customize ) {
	$wp_customize->add_section( 'material_footer_section',
		[
			'title' => esc_html__( 'Footer', 'material-theme-wp' ),
		]
	);

	add_settings( $wp_customize );
}

function render_text() {
	$footer_text = get_theme_mod( 'material_footer_text', '&copy; 2020 Material.io' );

	echo esc_html( $footer_text );
}

function add_controls( $wp_customize ) {
	$controls = [];

	foreach ( get_controls() as $control ) {
		$controls[ $control[ 'id' ] ] = [
			'label' => $control['label'],
			'section' => Customizer\prepend_slug( 'footer_section' ),
			'type'    => $control['type'],
		];
	}

	Customizer\add_controls( $wp_customize, $controls );
}

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

function get_controls() {
	return [
		[
			'id'                   => 'hide_back_to_top',
			'label'                => esc_html__( 'Hide back to top button', 'material-theme-wp' ),
			'type'                 => 'checkbox',
		],
		[
			'id'                   => 'footer_text',
			'label'                => esc_html__( 'Footer text', 'material-theme-wp' ),
			'type'                 => 'text',
		]
	];
}
