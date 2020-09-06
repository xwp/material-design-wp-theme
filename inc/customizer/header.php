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
	add_action( 'customize_register', __NAMESPACE__ . '\register', 100 );
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
					Customizer\prepend_slug( 'header_search_display' ),
				],
				'render_callback' => __NAMESPACE__ . '\render_header',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'header_bar_layout',
			array(
				'selector'        => '.site-navigation',
				'settings'        => [
					Customizer\prepend_slug( 'header_bar_layout' ),
				],
				'render_callback' => __NAMESPACE__ . '\render_app_bar',
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
		[
			'id'      => Customizer\prepend_slug( 'header_bar_layout' ),
			'label'   => esc_html__( 'Header layout', 'material-theme' ),
			'type'    => 'radio',
			'choices' => [
				'standard' => esc_html__( 'Standard', 'material-theme' ),
				'fixed'    => esc_html__( 'Fixed', 'material-theme' ),
			],
		],
		[
			// Hidden field for menu locations label.
			'id'          => Customizer\prepend_slug( 'menu-location-label' ),
			'label'       => esc_html__( 'Menu Locations', 'material-theme' ),
			'description' => esc_html__( 'Material theme can display menus in 2 locations. Select which menu appears in each location.', 'material-theme' ),
			'type'        => 'hidden',
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
	add_controls( $wp_customize );
	add_color_controls( $wp_customize );
	add_nav_menu_location_controls( $wp_customize );
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
 * Define color palette controls.
 *
 * @return array Color palette values.
 */
function get_color_controls() {
	return [
		[
			'id'                   => 'header_background_color',
			'label'                => esc_html__( 'Bakground Color', 'material-theme' ),
			'related_text_setting' => Customizer\prepend_slug( 'header_text_color' ),
			'css_var'              => '--mdc-theme-header',
		],
		[
			'id'                   => 'header_text_color',
			'label'                => esc_html__( 'Text Color', 'material-theme' ),
			'related_text_setting' => Customizer\prepend_slug( 'header_background_color' ),
			'css_var'              => '--mdc-theme-on-header',
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
			'transport'         => 'postMessage',
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

	$slug     = Customizer\get_slug();
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
				'section'     => Customizer\prepend_slug( 'header_section' ),
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

/**
 * Render's menu
 *
 * @return void
 */
function render_app_bar() {
	get_template_part( 'template-parts/menu', 'header' );
}
