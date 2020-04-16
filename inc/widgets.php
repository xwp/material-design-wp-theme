<?php
/**
 * Custom widget functions
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Widgets;

/**
 * Attach hooks
 *
 * @return void
 */
function setup() {
	add_action( 'widgets_init', __NAMESPACE__ . '\replace_default_widgets' );
}

/**
 * Remove default widgets and replace with our versions
 *
 * @return void
 */
function replace_default_widgets() {
	unregister_widget( 'WP_Widget_Archives' );

	register_widget( __NAMESPACE__ . '\WP_Widget_Archives' );
}
