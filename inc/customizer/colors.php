<?php
/**
 * Copyright 2020 Material Design
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Material Theme Customizer Colors section.
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
	if ( ! material_is_plugin_active() ) {
		// Add color palettes section.
		$args = [
			'priority' => 50,
			'title'    => esc_html__( 'Color Palettes', 'material-theme' ),
		];

		Customizer\add_section( $wp_customize, 'colors', $args );
	}

	add_settings( $wp_customize );
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
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		];
	}

	Customizer\add_settings( $wp_customize, $settings );
	Customizer\add_color_controls( $wp_customize, get_controls(), 'colors' );
}

/**
 * Define color controls to use
 *
 * @return array
 */
function get_controls() {
	$controls = [];

	if ( ! material_is_plugin_active() ) {
		$controls = [
			[
				'id'         => 'primary_color',
				'label'      => esc_html__( 'Primary Color', 'material-theme' ),
				'css_var'    => '--mdc-theme-primary',
				'a11y_label' => __( 'Primary', 'material-theme' ),
			],
			[
				'id'         => 'secondary_color',
				'label'      => esc_html__( 'Secondary Color', 'material-theme' ),
				'css_var'    => '--mdc-theme-secondary',
				'a11y_label' => __( 'Secondary', 'material-theme' ),
				'default'    => '#03dac6',
			],
			[
				'id'         => 'on_primary_color',
				'label'      => esc_html__( 'On Primary Color (text and icons)', 'material-theme' ),
				'css_var'    => '--mdc-theme-on-primary',
				'a11y_label' => __( 'On Primary', 'material-theme' ),
			],
			[
				'id'         => 'on_secondary_color',
				'label'      => esc_html__( 'On Secondary Color (text and icons)', 'material-theme' ),
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
				'label'      => esc_html__( 'On Surface Color (text and icons)', 'material-theme' ),
				'css_var'    => '--mdc-theme-on-surface',
				'a11y_label' => __( 'On Surface', 'material-theme' ),
			],
			[
				// Using the `custom_` prefix to prevent conflicts with the default WordPress
				// `background_color` setting.
				'id'         => 'custom_background_color',
				'label'      => esc_html__( 'Background Color', 'material-theme' ),
				'css_var'    => '--mdc-theme-background',
				'a11y_label' => __( 'Background', 'material-theme' ),
			],
			[
				'id'         => 'on_background_color',
				'label'      => esc_html__( 'On Background Color (text and icons)', 'material-theme' ),
				'css_var'    => '--mdc-theme-on-background',
				'a11y_label' => __( 'On Background', 'material-theme' ),
			],
		];
	}

	return array_merge(
		$controls,
		[
			[
				'id'         => 'header_color',
				'label'      => esc_html__( 'Header Color', 'material-theme' ),
				'css_var'    => '--mdc-theme-header',
				'a11y_label' => __( 'On Header', 'material-theme' ),
			],
			[
				'id'         => 'on_header_color',
				'label'      => esc_html__( 'On Header Color (text and icons)', 'material-theme' ),
				'css_var'    => '--mdc-theme-on-header',
				'a11y_label' => __( 'On Header', 'material-theme' ),
			],
			[
				'id'         => 'footer_color',
				'label'      => esc_html__( 'Footer Color', 'material-theme' ),
				'css_var'    => '--mdc-theme-footer',
				'a11y_label' => __( 'On Footer', 'material-theme' ),
			],
			[
				'id'         => 'on_footer_color',
				'label'      => esc_html__( 'On Footer Color (text and icons)', 'material-theme' ),
				'css_var'    => '--mdc-theme-on-footer',
				'a11y_label' => __( 'On Footer', 'material-theme' ),
			],
		]
	);
}
