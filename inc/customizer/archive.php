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
	$wp_customize->add_section(
		Customizer\prepend_slug( 'archive' ),
		[
			'title' => __( 'Layout Settings', 'material-theme' ),
		]
	);

	add_settings( $wp_customize );

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
}

/**
 * Define core controls to use
 *
 * @return array
 */
function get_controls() {
	return [
		[
			'id'      => Customizer\prepend_slug( 'archive_layout' ),
			'label'   => esc_html__( 'Choose archive layout', 'material-theme' ),
			'type'    => 'radio',
			'choices' => [
				'card'  => esc_html__( 'Card', 'material-theme' ),
				'image' => esc_html__( 'Image List', 'material-theme' ),
			],
		],
		[
			'id'      => Customizer\prepend_slug( 'archive_width' ),
			'label'   => esc_html__( 'Width', 'material-theme' ),
			'type'    => 'radio',
			'choices' => [
				'wide'   => esc_html__( 'Wide', 'material-theme' ),
				'normal' => esc_html__( 'Normal', 'material-theme' ),
			],
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
	];
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
				'section' => Customizer\prepend_slug( 'archive' ),
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
