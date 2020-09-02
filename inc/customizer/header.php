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
 * Render footer copyright text
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