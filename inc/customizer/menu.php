<?php
/**
 * Material Theme Customizer Menu options.
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
	add_action( 'admin_notices', __NAMESPACE__ . '\add_admin_notice' );
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

	$tabs_control->description = esc_html__( 'Only the top level items will display.', 'material-theme' );
}

/**
 * Add drawer menu notice in menu admin panel
 *
 * @return void
 */
function add_admin_notice() {
	$screen = get_current_screen();

	if ( ! $screen || 'nav-menus' !== $screen->id ) {
		return;
	}

	printf(
		'<div class="notice notice-info is-dismissible"><p><strong>%1$s</strong> %2$s</p></div>',
		esc_html__( 'Tabs Menu:', 'material-theme' ),
		esc_html__( 'Only the top level items will display.', 'material-theme' )
	);
}
