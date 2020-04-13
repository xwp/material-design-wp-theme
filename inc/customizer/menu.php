<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Customizer\Menu;

use MaterialTheme\Customizer;

/**
 * Attach hooks
 */
function setup() {
	add_action( 'customize_register', __NAMESPACE__ . '\add_tabs_description', 12 );
}

/**
 * Attach a new description to an existing control
 *
 * @param  WP_Customize_Manager $wp_customize Theme Custopmizer object.
 * @return void
 */
function add_tabs_description( $wp_customize ) {
	$tabs_control = $wp_customize->get_control( 'nav_menu_locations[menu-1]' );

	if ( ! $tabs_control ) {
		return;
	}

	$tabs_control->description = esc_html__( "Children are not supported by this menu, and won't be displayed in the frontend.", 'material-theme' );
}
