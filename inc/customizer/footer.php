<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Customizer\Footer;

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
		'material_footer_section',
		[
			'title' => esc_html__( 'Footer', 'material-theme' ),
		]
	);

	add_settings( $wp_customize );

	add_color_controls( $wp_customize );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'footer_text',
			array(
				'selector'        => '.site-footer__text',
				'render_callback' => __NAMESPACE__ . '\render_text',
				'settings'        => [
					'material_footer_text',
				],
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'back_to_top',
			array(
				'selector'        => '.back-to-top',
				'render_callback' => __NAMESPACE__ . '\render_back_to_top',
				'settings'        => [
					'material_hide_back_to_top',
				],
			)
		);
	}

	// add_filter( 'material_theme_builder__customizer_control_list', __NAMESPACE__ . '\register_plugin_settings' );.
	add_filter( 'material_theme_builder_design_styles', __NAMESPACE__ . '\update_design_styles' );
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
		$controls[ $control['id'] ] = [
			'label'   => $control['label'],
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
 * @return array
 */
function get_controls() {
	return [
		[
			'id'    => 'hide_back_to_top',
			'label' => esc_html__( 'Hide back to top button', 'material-theme' ),
			'type'  => 'checkbox',
		],
		[
			'id'    => 'footer_text',
			'label' => esc_html__( 'Footer text', 'material-theme' ),
			'type'  => 'text',
		],
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
	Customizer\add_color_controls( $wp_customize, get_color_controls(), 'footer_section' );
}

/**
 * Define color controls to use
 *
 * @return array
 */
function get_color_controls() {
	return [
		[
			'id'                   => 'footer_background_color',
			'label'                => esc_html__( 'Bakground Color', 'material-theme' ),
			'related_text_setting' => Customizer\prepend_slug( 'footer_text_color' ),
			'css_var'              => '--mdc-theme-footer',
			'a11y_label'           => __( 'On Background', 'material-theme' ),
		],
		[
			'id'              => 'footer_text_color',
			'label'           => esc_html__( 'Text Color', 'material-theme' ),
			'related_setting' => Customizer\prepend_slug( 'footer_background_color' ),
			'css_var'         => '--mdc-theme-on-footer',
			'a11y_label'      => __( 'On Background', 'material-theme' ),
		],
	];
}

/**
 * Reload footer
 *
 * @return void
 */
function render_footer() {
	get_template_part( 'template-parts/footer' );
}

/**
 * Add footer options to controls array
 *
 * @param  mixed $controls Existing controls.
 * @return array Modified controls
 */
function register_plugin_settings( $controls ) {
	return $controls;
}

/**
 * Add defaults to plugin's design styles
 *
 * @param  array $design_styles Existing styles.
 * @return array Modified styles
 */
function update_design_styles( $design_styles ) {
	$defaults = [
		'footer_background_color' => '#ffffff',
		'footer_text_color'       => '#000000',
	];

	$new_design_styles = [];

	foreach ( $design_styles as $key => $style ) {
		$style = array_merge(
			$style,
			$defaults
		);

		$new_design_styles[ $key ] = $style;
	}

	return $new_design_styles;
}

