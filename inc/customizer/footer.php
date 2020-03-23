<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package Material-theme-wp
 */

namespace MaterialTheme\Customizer\Footer;

function add_section( $wp_customize ) {
	$wp_customize->add_section( 'material_footer_section',
		[
			'title' => esc_html__( 'Footer', 'material-theme-wp' ),
		]
	);

	$wp_customize->add_setting( 'material_footer_text',
		[
			'transport' => 'postMessage'
		]
	);

	$wp_customize->add_control( 'material_footer_text',
		[
			'label'     => esc_html__( 'Footer text', 'material-theme-wp' ),
			'section'   => 'material_footer_section',
			'type'      => 'text',
		]
	);
}

function render_text() {
	$footer_text = get_theme_mod( 'material_footer_text', '&copy; 2020 Material.io' );

	echo esc_html( $footer_text );
}
