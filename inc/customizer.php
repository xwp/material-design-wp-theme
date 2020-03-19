<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package Material-theme-wp
 */

namespace MaterialTheme\Customizer;

/**
 * Attach hooks
 */
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

function get_slug() {
	return 'material';
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

/**
 * Enqueue control scripts
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
 * Register controls
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
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
			'label' => esc_html__( 'Show search in header', 'material-theme-wp' ),
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

	$wp_customize->add_control(	maybe_use_image_radio_control( $wp_customize ) );

	add_color_controls( $wp_customize );
}

function get_image_radio_args() {
	return [
		'label'    => esc_html__( 'Header Style', 'material-theme-wp' ),
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

/**
 * Choose which image radio control to use
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function maybe_use_image_radio_control( $wp_customize ) {
	$args = get_image_radio_args();

	if ( class_exists( 'MaterialThemeBuilder\Customizer\Image_Radio_Control' ) ) {
		$image_radio_control = new \MaterialThemeBuilder\Customizer\Image_Radio_Control(
			$wp_customize,
			'material_header_layout',
			$args
		);
	} else {
		$image_radio_control = new Image_Radio_Control(
			$wp_customize,
			'material_header_layout',
			$args
		);
	}

	return $image_radio_control;
}

function get_color_palette_args() {
	return [
		'label'                => esc_html__( 'Background Color', 'material-theme-wp' ),
		'section'              => 'colors',
		'priority'             => 10,
		'related_text_setting' => 'material_header_primary_background_color',
		'related_setting'      => ! empty( $control['related_setting'] ) ? $control['related_setting'] : false,
		'css_var'              => $control['css_var'],
	];
}

function maybe_use_color_palette_control( $wp_customize ) {
	/**
	* Generate list of all the controls in the colors section.
	 */
	$controls = [];

	if ( class_exists( 'MaterialThemeBuilder\Customizer\Material_Color_Palette_Control' ) ) {
		foreach ( get_color_controls() as $control ) {
			$controls[ $control['id'] ] = new \MaterialThemeBuilder\Customizer\Material_Color_Palette_Control(
				$wp_customize,
				prepend_slug( $control['id'] ),
				[
					'label'                => $control['label'],
					'section'              => prepend_slug( 'header_section' ),
					'related_text_setting' => ! empty( $control['related_text_setting'] ) ? $control['related_text_setting'] : false,
					'related_setting'      => ! empty( $control['related_setting'] ) ? $control['related_setting'] : false,
					'css_var'              => $control['css_var'],
				]
			);
		}
	} else {
		foreach ( get_color_controls() as $control ) {
			$controls[ $control['id'] ] = [
				'label'                => $control['label'],
				'section'              => prepend_slug( 'header_section' ),
				'type'                 => 'color',
			];
		}
	}

	add_controls( $wp_customize, $controls );
}

function get_color_controls() {
	return [
		[
			'id'                   => 'background_color',
			'label'                => esc_html__( 'Bakground Color', 'material-theme-wp' ),
			'related_text_setting' => prepend_slug( 'background_color' ),
			'css_var'              => '--mdc-theme-header-primary',
		],
		[
			'id'                   => 'text_color',
			'label'                => esc_html__( 'Text Color', 'material-theme-wp' ),
			'related_text_setting' => prepend_slug( 'text_color' ),
			'css_var'              => '--mdc-theme-header-secondary',
		],
	];
}

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

function get_default_values() {
	return [
		'background_color' => '#6200ee',
		'text_color'       => '#ffffff',
	];
}

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

	add_settings( $wp_customize, $settings );

	maybe_use_color_palette_control( $wp_customize );
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
			$control['section'] = isset( $control['section'] ) ? prepend_slug( $control['section'] ) : '';
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
