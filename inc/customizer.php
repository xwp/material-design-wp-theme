<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package Material-theme-wp
 */

namespace MaterialTheme\Customizer;

use MaterialTheme\Customizer\Footer;

/**
 * Attach hooks.
 *
 * @return void
 */
function setup() {
	add_action( 'customize_register', __NAMESPACE__ . '\register' );
	add_action( 'customize_preview_init', __NAMESPACE__ . '\preview_scripts' );

	add_action( 'customize_controls_enqueue_scripts', __NAMESPACE__ . '\scripts' );
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function register( $wp_customize ) {
	require get_template_directory() . '/inc/customizer/class-image-radio-control.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => __NAMESPACE__ . '\get_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => __NAMESPACE__ . '\get_description',
		) );
	}
}

/**
 * Define settings prefix.
 *
 * @return string Settings prefix.
 */
function get_slug() {
	return 'material';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function get_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function get_description() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @return void
 */
function preview_scripts() {
	wp_enqueue_script( 'material-theme-wp-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

/**
 * Enqueue control scripts.
 *
 * @return void
 */
function scripts() {
	wp_enqueue_style(
		'material-theme-customizer-styles',
		get_template_directory_uri() . '/assets/css/customize-controls-compiled.css',
		[]
	);
}

/**
 * Register setting in customizer.
 *
 * @param  mixed $wp_customize Theme Customizer object.
 * @param  mixed $settings     Settings to register in customizer.
 * @return void
 */
function add_settings( $wp_customize, $settings = [] ) {
	$slug = get_slug();

	foreach ( $settings as $id => $setting ) {
		$id = prepend_slug( $id );

		if ( is_array( $setting ) ) {
			$defaults = [
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
				'default'           => get_default( $id ),
			];

			$setting = array_merge( $defaults, $setting );
		}

		/**
		 * Filters the customizer setting args.
		 *
		 * This allows other plugins/themes to change the customizer setting args.
		 *
		 * @param array   $setting Array of setting args.
		 * @param string  $id      ID of the setting.
		 */
		$setting = apply_filters( $slug . '_customizer_setting_args', $setting, $id );

		if ( is_array( $setting ) ) {
			$wp_customize->add_setting(
				$id,
				$setting
			);
		} elseif ( $setting instanceof \WP_Customize_Setting ) {
			$setting->id = $id;
			$wp_customize->add_setting( $setting );
		}
	}
}

/**
 * Prepend the slug name if it does not exist.
 *
 * @param  string $name The name of the setting/control.
 * @return string
 */
function prepend_slug( $name ) {
	$slug = get_slug();

	return false === strpos( $name, "{$slug}_" ) ? "{$slug}_{$name}" : $name;
}

/**
 * Get default value for a setting.
 *
 * @param  string $setting Name of the setting.
 * @return mixed
 */
function get_default( $setting ) {
	$slug = get_slug();
	$setting  = str_replace( "{$slug}_", '', $setting );
	$defaults   = get_default_values();

	return isset( $defaults[ $setting ] ) ? $defaults[ $setting ] : '';
}

/**
 * Set default values.
 *
 * @return array
 */
function get_default_values() {
	return [
		'background_color'        => '#6200ee',
		'text_color'              => '#ffffff',
		'footer_background_color' => '#6200ee',
		'footer_text_color'       => '#ffffff',
		'archive_layout'          => 'card',
	];
}

/**
 * Add controls to customizer.
 *
 * @param  array $controls Array of controls to add to customizer.
 * @return void
 */
function add_controls( $wp_customize, $controls = [] ) {
	$slug = get_slug();

	foreach ( $controls as $id => $control ) {
		$id = prepend_slug( $id );

		/**
		 * Filters the customizer control args.
		 *
		 * This allows other plugins/themes to change the customizer controls args.
		 *
		 * @param array  $control Array of control args.
		 * @param string $id      ID of the control.
		 */
		$control = apply_filters( $slug . '_customizer_control_args', $control, $id );

		if ( is_array( $control ) ) {
			$wp_customize->add_control(
				$id,
				$control
			);
		} elseif ( $control instanceof \WP_Customize_Control ) {
			$control->id      = $id;
			$control->section = isset( $control->section ) ? prepend_slug( $control->section ) : '';
			$wp_customize->add_control( $control );
		}
	}
}
