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
}

/**
 * Register controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function add_sections( $wp_customize ) {
	$id = Customizer\prepend_slug( 'header_section' );
	$slug = 'material_theme_builder';
	$label = __( 'Header and Footer', 'material-theme' );
	$args = [
		'priority'   => 50,
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
}

/**
 * Define core controls to use
 *
 * @return array
 */
function get_controls() {
	return [
		[
			'id'      => 'header_label',
			'label'   => esc_html__( 'Top app bar (Header)', 'material-theme' ),	
			'type'    => 'hidden',	
		],
		[
			'id'    => 'header_search_display',
			'label' => esc_html__( 'Show search in header', 'material-theme' ),
			'type'  => 'checkbox',
		],	
		[
			'id'      => 'footer_label',
			'label'   => esc_html__( 'Footer', 'material-theme' ),	
			'type'    => 'hidden',	
		],
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
function render_text() {
	$footer_text = get_theme_mod( 'material_footer_text', '&copy; 2020 Material.io' );

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
