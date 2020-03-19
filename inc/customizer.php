<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package Material-theme-wp
 */

namespace MaterialTheme\Customizer;

function setup() {
	add_action( 'customize_register', __NAMESPACE__ . '\material_theme_wp_customize_register' );
	add_action( 'customize_preview_init', __NAMESPACE__ . '\material_theme_wp_customize_preview_js' );

	add_action( 'customize_controls_enqueue_scripts', __NAMESPACE__ . '\scripts' );
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function material_theme_wp_customize_register( $wp_customize ) {
	require get_template_directory() . '/inc/customizer/class-image-radio-control.php';

	add_header_sections( $wp_customize );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => __NAMESPACE__ . '\material_theme_wp_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => __NAMESPACE__ . '\material_theme_wp_customize_partial_blogdescription',
		) );
	}
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function material_theme_wp_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function material_theme_wp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function material_theme_wp_customize_preview_js() {
	wp_enqueue_script( 'material-theme-wp-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

function scripts() {
	wp_enqueue_style(
		'material-theme-customizer-styles',
		get_template_directory_uri() . '/assets/css/customize-controls-compiled.css',
		[]
	);
}

function add_header_sections( $wp_customize ) {
	$wp_customize->add_section( 'material_header_section',
		[
			'title' => esc_html__( 'Header', 'material-theme-wp' ),

		]
	);

	$wp_customize->add_setting( 'material_header_search_display',
		[
			'transport' => 'postMessage'
		]
	);

	$wp_customize->add_control( 'material_header_search_display',
		[
			'label' => esc_html__( 'Show search in header' ),
			'section' => 'material_header_section',
			'priority' => 10,
			'type' => 'checkbox',
		]
	);

	$wp_customize->add_setting( 'material_header_layout',
		[
			'transport' => 'postMessage'
		]
	);

	$wp_customize->add_control(	maybe_us_image_radio_control( $wp_customize ) );
}

function get_image_radio_args() {
	return [
		'section'  => 'material_header_section',
		'priority' => 10,
		'choices'  => [
			'drawer'    => [
				'label' => esc_html__( 'Menu Drawer', 'material-theme-wp' ),
				'url'   => get_template_directory_uri() . '/assets/svg/drawer.svg',
			],
			'menu'       => [
				'label' => __( 'No Menu Drawer', 'material-theme-wp' ),
				'url'   => get_template_directory_uri() . '/assets/svg/menu.svg',
			],
		],
	];
}

function maybe_us_image_radio_control( $wp_customize ) {
	$args = get_image_radio_args();

	if ( class_exists( 'MaterialThemeBuilder\Customizer\Image_Radio_Control' ) ) {
		$image_radio_control = new \MaterialThemeBuilder\Customizer\Image_Radio_Control(
			$wp_customize,
			'material_header_layout',
			get_image_radio_args()
		);
	} else {
		$image_radio_control = new Image_Radio_Control(
			$wp_customize,
			'material_header_layout',
			get_image_radio_args()
		);
	}

	return $image_radio_control;
}
