<?php
// Copyright 2020 Google LLC
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//      http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

/**
 * Material Theme Customizer Header & Footer section.
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Customizer\Header_Footer;

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
	// Add header section.
	$args = [
		'priority' => 200,
		'title'    => esc_html__( 'Top app bar & Footer', 'material-theme' ),
	];

	Customizer\add_section( $wp_customize, 'header-footer', $args );

	add_settings( $wp_customize );
}

/**
 * Define core controls to use
 *
 * @return array
 */
function get_controls() {
	return [
		[
			'id'    => 'header_label',
			'label' => esc_html__( 'Top app bar', 'material-theme' ),
			'type'  => 'hidden',
		],
		[
			'id'    => 'header_search_display',
			'label' => esc_html__( 'Show search in top app bar', 'material-theme' ),
			'type'  => 'checkbox',
		],
		[
			'id'          => 'header_title_display',
			'label'       => esc_html__( 'Hide site title in top app bar', 'material-theme' ),
			'type'        => 'checkbox',
			'description' => esc_html__( 'Site title is hidden but will still be used for SEO purposes', 'material-theme' ),
		],
		[
			'id'      => 'header_bar_layout',
			'label'   => esc_html__( 'Top app bar layout', 'material-theme' ),
			'type'    => 'radio',
			'choices' => [
				'standard' => esc_html__( 'Standard', 'material-theme' ),
				'fixed'    => esc_html__( 'Fixed', 'material-theme' ),
			],
		],
		[
			// Hidden field for menu locations label.
			'id'          => 'menu-location-label',
			'label'       => esc_html__( 'Menu Locations', 'material-theme' ),
			'description' => esc_html__( 'Material theme can display menus in 2 locations. Select which menu appears in each location.', 'material-theme' ),
			'type'        => 'hidden',
		],
		[
			'id'    => 'footer_label',
			'label' => esc_html__( 'Footer', 'material-theme' ),
			'type'  => 'hidden',
		],
		[
			'id'    => 'footer_text',
			'label' => esc_html__( 'Footer text', 'material-theme' ),
			'type'  => 'text',
		],
		[
			'id'    => 'hide_back_to_top',
			'label' => esc_html__( 'Hide back to top button', 'material-theme' ),
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
	$controls = [];

	foreach ( get_controls() as $control ) {
		$settings[ $control['id'] ] = [
			'transport' => 'postMessage',
		];

		$controls[ $control['id'] ] = array_merge(
			[
				'section' => Customizer\prepend_slug( 'header-footer' ),
			],
			$control
		);
	}

	Customizer\add_settings( $wp_customize, $settings );
	Customizer\add_controls( $wp_customize, $controls );
	add_nav_menu_location_controls( $wp_customize );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'header_search_display',
			array(
				'selector'        => '.top-app-bar',
				'settings'        => [
					'header_search_display',
				],
				'render_callback' => __NAMESPACE__ . '\render_header',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'header_bar_layout',
			array(
				'selector'        => '.site-navigation',
				'settings'        => [
					'header_bar_layout',
				],
				'render_callback' => __NAMESPACE__ . '\render_app_bar',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'header_title_display',
			array(
				'selector'        => '.mdc-top-app-bar__title, .mdc-drawer__title',
				'settings'        => [
					'header_title_display',
				],
				'render_callback' => __NAMESPACE__ . '\render_site_title',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'footer_text',
			array(
				'selector'        => '.site-footer__text',
				'render_callback' => __NAMESPACE__ . '\render_text',
				'settings'        => [
					'footer_text',
				],
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'hide_back_to_top',
			array(
				'selector'        => '.back-to-top',
				'render_callback' => __NAMESPACE__ . '\render_back_to_top',
				'settings'        => [
					'hide_back_to_top',
				],
			)
		);
	}
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
 * Reload footer
 *
 * @return void
 */
function render_footer() {
	get_template_part( 'template-parts/footer' );
}

/**
 * Render's top app bar and tab bar
 *
 * @return void
 */
function render_header_navigation() {
	get_template_part( 'template-parts/header', 'navigation' );
}

/**
 * Add nav menu location dropdowns.
 *
 * @param  WP_Customize $wp_customize WP Customize object.
 * @return void
 */
function add_nav_menu_location_controls( $wp_customize ) {
	$menus = wp_get_nav_menus();

	// Menu locations.
	$locations = get_registered_nav_menus();

	$choices = array( '0' => __( '&mdash; Select &mdash;', 'material-theme' ) );
	foreach ( $menus as $menu ) {
		$choices[ $menu->term_id ] = wp_html_excerpt( $menu->name, 40, '&hellip;' );
	}

	$controls = [];

	foreach ( $locations as $location => $label ) {
		$setting_id = "nav_menu_locations[{$location}]";

		$controls[ $setting_id ] = new \WP_Customize_Nav_Menu_Location_Control(
			$wp_customize,
			$setting_id,
			array(
				'label'       => $label,
				'description' => 'menu-1' === $location ? esc_html__( 'Only the top level items will display.', 'material-theme' ) : '',
				'location_id' => $location,
				'section'     => Customizer\prepend_slug( 'header-footer' ),
				'choices'     => $choices,
			)
		);
	}

	Customizer\add_controls( $wp_customize, $controls );
}


/**
 * Reload header
 *
 * @return void
 */
function render_text() {
	$footer_text = get_theme_mod( 'footer_text', '' );

	echo esc_html( $footer_text );
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
 * Render's menu
 *
 * @return void
 */
function render_app_bar() {
	get_template_part( 'template-parts/menu', 'header' );
}

/**
 * Render title
 *
 * @return void
 */
function render_site_title() {
	get_template_part( 'template-parts/site-title' );
}