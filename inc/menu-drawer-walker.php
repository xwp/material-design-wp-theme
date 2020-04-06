<?php 
/**
 * Custom menu walker
 * Adds Material Button to drawer menu links
 * 
 * @package Material-theme-wp
 */

namespace MaterialTheme\Menu;

class Material_Theme_Drawer_Menu extends \Walker {
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
			( absint( $item->object_id ) === get_the_ID() ) ? ' class="mdc-list-item mdc-list-item--activated"' : ' class="mdc-list-item"',
			'<span class="mdc-list-item__text">' . esc_html( $item->title ) . '</span>'
		);
	}
}
