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

	maybe_use_color_palette_control( $wp_customize );
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
			'related_text_setting' => Customizer\prepend_slug( 'background_color' ),
			'css_var'              => '--mdc-theme-background',
		],
		[
			'id'                   => 'text_color',
			'label'                => esc_html__( 'Text Color', 'material-theme' ),
			'related_text_setting' => Customizer\prepend_slug( 'text_color' ),
			'css_var'              => '--mdc-theme-on-background',
		],
	];
}

/**
 * Use advanced color control if Material theme builder is available
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function maybe_use_color_palette_control( $wp_customize ) {
	/**
	 * Generate list of all the controls in the colors section.
	 */
	$controls = [];

	if ( class_exists( 'MaterialThemeBuilder\Customizer\Material_Color_Palette_Control' ) ) {
		foreach ( get_controls() as $control ) {
			$controls[ $control['id'] ] = new \MaterialThemeBuilder\Customizer\Material_Color_Palette_Control(
				$wp_customize,
				Customizer\prepend_slug( $control['id'] ),
				[
					'label'                => $control['label'],
					'section'              => Customizer\prepend_slug( 'colors_section' ),
					'related_text_setting' => ! empty( $control['related_text_setting'] ) ? $control['related_text_setting'] : false,
					'related_setting'      => ! empty( $control['related_setting'] ) ? $control['related_setting'] : false,
					'css_var'              => $control['css_var'],
				]
			);
		}
	} else {
		foreach ( get_controls() as $control ) {
			$controls[ $control['id'] ] = [
				'label'   => $control['label'],
				'section' => Customizer\prepend_slug( 'colors_section' ),
				'type'    => 'color',
			];
		}
	}

	Customizer\add_controls( $wp_customize, $controls );
}
