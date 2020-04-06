<?php 
/**
 * Custom menu walker
 * Adds Material Button to menu links
 * 
 * @package Material-theme-wp
 */

namespace MaterialTheme\Menu;

class Material_Theme_Menu extends \Walker {
	var $db_fields = array(
		'parent' => 'menu_item_parent',
		'id'     => 'db_id',
	);

	/**
	 * Add necessary classes to menu items
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= sprintf(
			'<a href="%1$s" %2$s>%3$s</a>',
			esc_url( $item->url ),
			( $item->object_id === get_the_ID() ) ? ' class="current mdc-button"' : ' class="mdc-button mdc-top-app-bar__action-item top-app-bar__button"',
			'<div class="mdc-button__ripple"></div><span class="mdc-button__label">' . esc_html( $item->title ) . '</span>'
		);
	}
}
