<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package Material-theme-wp
 */

namespace MaterialTheme\Customizer\Footer;

use MaterialTheme\Customizer;

/**
 * Add and initialize footer section
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function add_section( $wp_customize ) {
	$wp_customize->add_section( 'material_footer_section',
		[
			'title' => esc_html__( 'Footer', 'material-theme-wp' ),
		]
	);

	add_settings( $wp_customize );

	add_color_controls( $wp_customize );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'footer_text', array(
			'selector'        => '.site-footer__text',
			'render_callback' => 'MaterialTheme\Customizer\Footer\render_text',
			'settings'        => [
				'material_footer_text',
			],
		) );

		$wp_customize->selective_refresh->add_partial( 'back_to_top', array(
			'selector'        => '.back-to-top',
			'render_callback' => 'MaterialTheme\Customizer\Footer\render_back_to_top',
			'settings'        => [
				'material_hide_back_to_top',
			],
		) );
	}
}

/**
 * Render footer copyright text
 */
function render_text() {
	$footer_text = get_theme_mod( 'material_footer_text', '&copy; 2020 Material.io' );

	echo esc_html( $footer_text );
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
		$controls[ $control[ 'id' ] ] = [
			'label' => $control['label'],
			'section' => Customizer\prepend_slug( 'footer_section' ),
			'type'    => $control['type'],
		];
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
			'transport' => 'postMessage',
		];
	}

	Customizer\add_settings( $wp_customize, $settings );

	add_controls( $wp_customize );
}

/**
 * Define core controls to use
 *
 * @return void
 */
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

/**
 * Reload back to top
 *
 * @return void
 */
function render_back_to_top() {
	get_template_part( 'template-parts/back-to-top' );
}

/**
 * Add settings for color controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function add_color_controls( $wp_customize ) {
	/**
	 * Generate list of all the settings in the colors section.
	 */
	$settings = [];

	foreach ( get_color_controls() as $control ) {
		$settings[ $control['id'] ] = [
			'sanitize_callback' => 'sanitize_hex_color',
		];
	}

	Customizer\add_settings( $wp_customize, $settings );

	maybe_use_color_palette_control( $wp_customize );
}

/**
 * Define color controls to use
 *
 * @return void
 */
function get_color_controls() {
	return [
		[
			'id'                   => 'footer_background_color',
			'label'                => esc_html__( 'Bakground Color', 'material-theme-wp' ),
			'related_text_setting' => Customizer\prepend_slug( 'footer_text_color' ),
			'css_var'              => '--mdc-theme-primary',
		],
		[
			'id'                   => 'footer_text_color',
			'label'                => esc_html__( 'Text Color', 'material-theme-wp' ),
			'related_text_setting' => Customizer\prepend_slug( 'footer_background_color' ),
			'css_var'              => '--mdc-theme-on-primary',
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
		foreach ( get_color_controls() as $control ) {
			$controls[ $control['id'] ] = new \MaterialThemeBuilder\Customizer\Material_Color_Palette_Control(
				$wp_customize,
				Customizer\prepend_slug( $control['id'] ),
				[
					'label'                => $control['label'],
					'section'              => Customizer\prepend_slug( 'footer_section' ),
					'related_text_setting' => ! empty( $control['related_text_setting'] ) ? $control['related_text_setting'] : false,
					'related_setting'      => ! empty( $control['related_setting'] ) ? $control['related_setting'] : false,
					'css_var'              => $control['css_var'],
				]
			);
		}
	} else {
		foreach ( get_color_controls() as $control ) {
			$controls[ $control['id'] ] = [
				'label'                => $control['label'],
				'section'              => Customizer\prepend_slug( 'footer_section' ),
				'type'                 => 'color',
			];
		}
	}

	Customizer\add_controls( $wp_customize, $controls );
}
