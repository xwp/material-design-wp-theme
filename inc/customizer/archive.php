<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Customizer\Archive;

use MaterialTheme\Customizer;

/**
 * Attach hooks
 */
function setup() {
	add_action( 'customize_register', __NAMESPACE__ . '\register' );
}

/**
 * Register settings and controls.
 *
 * @param  WP_Customize $wp_customize WP_Customize instance.
 * @return void
 */
function register( $wp_customize ) {

	add_sections( $wp_customize );

	add_layout_settings_controls( $wp_customize );
}

/**
 * Register settings and controls.
 *
 * @param  WP_Customize $wp_customize WP_Customize instance.
 * @return void
 */
function add_sections( $wp_customize ) {

	$id   = 'archive';
	$slug = 'material_theme_builder';

	$sections = [
		'navigation' => __( 'Site Navigation (Top app bar & Footer)', 'material-theme-builder' ),
		'layout'     => __( 'Layout Settings', 'material-theme-builder' ),
	];

	foreach ( $sections as $id => $label ) {
		$id = Customizer\prepend_slug( $id );

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

	$label = __( 'Layout Settings', 'material-theme' );
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
}

/**
 * Define core controls to use
 *
 * @return array
 */
function get_layout_settings_controls() {
	return [
		[
			'id'      => Customizer\prepend_slug( 'archive_layout' ),
			'label'   => esc_html__( 'Post layout and display options', 'material-theme' ),
			'type'    => 'radio',
			'choices' => [
				'card'  => esc_html__( 'Card', 'material-theme' ),
				'image' => esc_html__( 'Image List', 'material-theme' ),
			],
		],
		[
			'id'      => Customizer\prepend_slug( 'archive_width' ),
			'label'   => esc_html__( 'Layout Width', 'material-theme' ),
			'type'    => 'radio',
			'choices' => [
				'wide'   => esc_html__( 'Wide', 'material-theme' ),
				'normal' => esc_html__( 'Normal', 'material-theme' ),
			],
		],
		[
			'id'    => Customizer\prepend_slug( 'archive_card_options' ),
			'label' => esc_html__( 'Card display options', 'material-theme' ),
			'type'  => 'none',    
		],
		[
			'id'              => Customizer\prepend_slug( 'archive_comments' ),
			'label'           => esc_html__( 'Comments', 'material-theme' ),
			'type'            => 'checkbox',
			'active_callback' => __NAMESPACE__ . '\is_card_layout',
		],
		[
			'id'              => Customizer\prepend_slug( 'archive_author' ),
			'label'           => esc_html__( 'Author', 'material-theme' ),
			'type'            => 'checkbox',
			'active_callback' => __NAMESPACE__ . '\is_card_layout',
		],
		[
			'id'              => Customizer\prepend_slug( 'archive_excerpt' ),
			'label'           => esc_html__( 'Excerpt', 'material-theme' ),
			'type'            => 'checkbox',
			'active_callback' => __NAMESPACE__ . '\is_card_layout',
		],
		[
			'id'              => Customizer\prepend_slug( 'archive_date' ),
			'label'           => esc_html__( 'Date', 'material-theme' ),
			'type'            => 'checkbox',
			'active_callback' => __NAMESPACE__ . '\is_card_layout',
		],
		[
			'id'              => Customizer\prepend_slug( 'archive_outlined' ),
			'label'           => esc_html__( 'Outlined', 'material-theme' ),
			'type'            => 'checkbox',
			'active_callback' => __NAMESPACE__ . '\is_card_layout',
		],
		[
			'id'      => Customizer\prepend_slug( 'comments_section' ),
			'label'   => esc_html__( 'Comment fields', 'material-theme' ),
			'type'    => 'radio',
			'default' => 'outlined',
			'choices' => [
				'outlined' => esc_html__( 'Outlined', 'material-theme' ),
				'filled'   => esc_html__( 'Filled', 'material-theme' ),
			],
		],
	];
}

/**
 * Create settings based on controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function add_layout_settings_controls( $wp_customize ) {

	$wp_customize->selective_refresh->add_partial(
		'archive_layout',
		[
			'selector'        => '.site-main__inner',
			'render_callback' => __NAMESPACE__ . '\render_layout',
			'settings'        => [
				'material_archive_layout',
				'material_archive_width',
				'material_archive_comments',
				'material_archive_author',
				'material_archive_excerpt',
				'material_archive_date',
				'material_archive_outlined',
			],
		]
	);

	$settings = [];

	foreach ( get_layout_settings_controls() as $control ) {
		$settings[ $control['id'] ] = [
			'transport' => 'postMessage',
		];
	}

	Customizer\add_settings( $wp_customize, $settings );

	add_controls( $wp_customize, 'layout' );
}

/**
 * Add regular controls
 * Call to parent function
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function add_controls( $wp_customize, $label ) {
	$controls = [];

	foreach ( get_layout_settings_controls() as $control ) {
		$controls[ $control['id'] ] = array_merge(
			[
				'section' => Customizer\prepend_slug( $label ),
			],
			$control
		);
	}

	Customizer\add_controls( $wp_customize, $controls );
}

/**
 * Render selected layout
 *
 * @return void
 */
function render_layout() {
	get_template_part( 'template-parts/archive' );
}

/**
 * Determine if the layout is card.
 *
 * @return boolean
 */
function is_card_layout() {
	return 'card' === get_theme_mod( Customizer\prepend_slug( 'archive_layout' ), 'card' );
}
