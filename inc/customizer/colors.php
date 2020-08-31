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

	$id    = Customizer\prepend_slug( 'material_colors_section' );
	$slug  = 'material_theme_builder';
	$label = __( 'Colors', 'material-theme' );
	$args  = [
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'title'      => esc_html( $label ),
		'panel'      => $slug,
		'type'       => 'collapse',
	];

	/**
	 * Filters the customizer section args.
	 *
	 * This allows other plugins/themes to change the customizer section args.
	 *
	 * @param array  $args Array of section args.
	 * @param string $id   ID of the section.
	 */
	$section = apply_filters( $slug . '_customizer_section_args', $args, $id );

	if ( is_array( $section ) ) {
		$wp_customize->add_section(
			$id,
			$section
		);
	} elseif ( $section instanceof \WP_Customize_Section ) {
		$section->id = $id;
		$wp_customize->add_section( $section );
	}

	add_settings( $wp_customize );

	add_color_controls( $wp_customize );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'colors_text',
			array(
				'selector'        => '.site-colors__text',
				'render_callback' => __NAMESPACE__ . '\render_text',
				'settings'        => [
					'material_colors_text',
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
}

/**
 * Render colors copyright text
 */
function render_text() {
	$colors_text = get_theme_mod( 'material_colors_text', '&copy; 2020 Material.io' );

	echo esc_html( $colors_text );
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
			'section' => Customizer\prepend_slug( 'colors_section' ),
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
	return [];
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
	Customizer\add_color_controls( $wp_customize, get_color_controls(), 'colors_section' );
}

/**
 * Define color controls to use
 *
 * @return array
 */
function get_color_controls() {
	return [
		[
			'id'         => 'primary_color',
			'label'      => esc_html__( 'Primary Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-primary',
			'a11y_label' => __( 'Primary', 'material-theme' ),
		],
		[
			'id'         => 'on_primary_color_bg',
			'label'      => esc_html__( 'Primary Background Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-primary-bg',
			'a11y_label' => __( 'On Primary', 'material-theme' ),
		],
		[
			'id'         => 'on_primary_color',
			'label'      => esc_html__( 'On Primary Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-on-primary',
			'a11y_label' => __( 'On Primary', 'material-theme' ),
		],
		[
			'id'         => 'secondary_color',
			'label'      => esc_html__( 'Secondary Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-secondary',
			'a11y_label' => __( 'Secondary', 'material-theme' ),
		],
		[
			'id'         => 'on_secondary_color_bg',
			'label'      => esc_html__( 'Secondary Background Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-secondary-bg',
			'a11y_label' => __( 'Secondary Background Color', 'material-theme' ),
		],
		[
			'id'         => 'on_secondary_color',
			'label'      => esc_html__( 'On Secondary Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-on-secondary',
			'a11y_label' => __( 'On Secondary', 'material-theme' ),
		],
		[
			'id'         => 'surface_color',
			'label'      => esc_html__( 'Surface Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-surface',
			'a11y_label' => __( 'Surface', 'material-theme' ),
		],
		[
			'id'         => 'on_surface_color',
			'label'      => esc_html__( 'On Surface Color', 'material-theme' ),
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
			'id'      => 'header_color',
			'label'   => esc_html__( 'Header Color', 'material-theme' ),
			'css_var' => '--mdc-theme-header',
		],
		[
			'id'      => 'on-header_color',
			'label'   => esc_html__( 'On Header Color', 'material-theme' ),
			'css_var' => '--mdc-theme-on-header',
		],
		[
			'id'         => 'footer_color',
			'label'      => esc_html__( 'Footer Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-footer',
			'a11y_label' => __( 'On Background', 'material-theme' ),
		],
		[
			'id'         => 'on-footer_color',
			'label'      => esc_html__( 'On Footer Color', 'material-theme' ),
			'css_var'    => '--mdc-theme-on-footer',
			'a11y_label' => __( 'On Background', 'material-theme' ),
		],
	];
}

/**
 * Reload colors
 *
 * @return void
 */
function render_colors() {
	get_template_part( 'template-parts/colors' );
}
