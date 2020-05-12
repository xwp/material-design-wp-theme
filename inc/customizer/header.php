<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Customizer\Header;

use MaterialTheme\Customizer;

/**
 * Attach hooks
 */
function setup() {
	add_action( 'customize_register', __NAMESPACE__ . '\register' );
}

/**
 * Register in Customizer.
 *
 * @param  WP_Customize_Manager $wp_customize Theme Custopmizer object.
 * @return void
 */
function register( $wp_customize ) {
	add_sections( $wp_customize );

	add_settings( $wp_customize );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'header_layout',
			array(
				'selector'        => '.top-app-bar',
				'settings'        => [
					Customizer\prepend_slug( 'background_color' ),
					Customizer\prepend_slug( 'text_color' ),
					Customizer\prepend_slug( 'header_search_display' ),
				],
				'render_callback' => __NAMESPACE__ . '\render_header',
			) 
		);

		$wp_customize->selective_refresh->add_partial(
			'header_width_layout',
			array(
				'selector'        => '.site__navigation',
				'settings'        => [
					Customizer\prepend_slug( 'header_width_layout' ),
				],
				'render_callback' => __NAMESPACE__ . '\render_header_navigation',
			) 
		);
	}
}

/**
 * Register controls.
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function add_sections( $wp_customize ) {
	$wp_customize->add_section(
		Customizer\prepend_slug( 'header_section' ),
		[
			'title' => esc_html__( 'Header', 'material-theme' ),
		]
	);
}

/**
 * Define core controls to use
 *
 * @return array
 */
function get_controls() {
	return [
		[
			'id'    => Customizer\prepend_slug( 'header_search_display' ),
			'label' => esc_html__( 'Show search in header', 'material-theme' ),
			'type'  => 'checkbox',
		],
	];
}

/**
 * Create settings based on controls
 * Add extra setting for image radio
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

	add_radio_controls( $wp_customize );
	add_controls( $wp_customize );
	add_color_controls( $wp_customize );
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
		$controls[ $control['id'] ] = array_merge(
			[
				'section' => Customizer\prepend_slug( 'header_section' ),
			],
			$control 
		);
	}

	Customizer\add_controls( $wp_customize, $controls );
}

/**
 * Attach radio control
 *
 * @param  WP_Customize $wp_customize Customizer object.
 * @return void
 */
function add_radio_controls( $wp_customize ) {
	$settings = [
		'header_width_layout' => [
			'default'           => 'boxed',
			'sanitize_callback' => 'sanitize_text_field',
		],
	];

	Customizer\add_settings( $wp_customize, $settings );

	$controls = [
		'header_width_layout' => new Customizer\Radio_Toggle_Control(
			$wp_customize,
			Customizer\prepend_slug( 'header_width_layout' ),
			[
				'label'   => esc_html__( 'Layout', 'material-theme' ),
				'section' => Customizer\prepend_slug( 'header_section' ),
				'choices' => [
					'full'  => esc_html__( 'Full', 'material-theme' ),
					'boxed' => esc_html__( 'Boxed', 'material-theme' ),
				],
			]
		),
	];

	Customizer\add_controls( $wp_customize, $controls );
}

/**
 * Define color palette controls.
 *
 * @return array Color palette values.
 */
function get_color_controls() {
	return [
		[
			'id'                   => 'background_color',
			'label'                => esc_html__( 'Bakground Color', 'material-theme' ),
			'related_text_setting' => Customizer\prepend_slug( 'text_color' ),
			'css_var'              => '--mdc-theme-primary',
		],
		[
			'id'                   => 'text_color',
			'label'                => esc_html__( 'Text Color', 'material-theme' ),
			'related_text_setting' => Customizer\prepend_slug( 'background_color' ),
			'css_var'              => '--mdc-theme-on-primary',
		],
	];
}

/**
 * Add color palette settings and controls.
 *
 * @param  mixed $wp_customize Rheme Customizer object.
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
 * Decide which color palette control to use
 *
 * @param  mixed $wp_customize Theme Customizer object.
 * @return void
 */
function maybe_use_color_palette_control( $wp_customize ) {
	/**
	* Generate list of all the controls in the colors section.
	 */
	$controls = [];

	if ( ! class_exists( 'MaterialThemeBuilder\Plugin' ) ) {
		foreach ( get_color_controls() as $control ) {
			foreach ( get_color_controls() as $control ) {
				$controls[ $control['id'] ] = [
					'label'   => $control['label'],
					'section' => Customizer\prepend_slug( 'header_section' ),
					'type'    => 'color',
				];
			}
		}
	}

	Customizer\add_controls( $wp_customize, $controls );
}

/**
 * Reload header
 *
 * @return void
 */
function render_header() {
	get_template_part( 'template-parts/menu', 'header' );
}

/**
 * Render's top app bar and tab bar
 *
 * @return void
 */
function render_header_navigation() {
	get_template_part( 'template-parts/header', 'navigation' );
}
