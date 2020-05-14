<?php
/**
 * Custom menu walker
 * Adds Material Button to drawer menu links
 *
 * @package MaterialTheme
 */

namespace MaterialTheme;

/**
 * Menu_Drawer_Walker class
 */
class Menu_Drawer_Walker extends \Walker_Nav_Menu {
	/**
	 * DB fields to use.
	 *
	 * @var array
	 */
	public $db_fields = array(
		'parent' => 'menu_item_parent',
		'id'     => 'db_id',
	);

	/**
	 * Add necessary classes to menu items
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param object $item   The data object.
	 * @param int    $depth  Depth of the item.
	 * @param array  $args   An array of additional arguments.
	 * @param int    $id     ID of the current item.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= sprintf(
			'<li %2$s><a href="%1$s">%3$s</a></li>',
			esc_url( $item->url ),
			( absint( $item->object_id ) === get_the_ID() ) ? ' class="mdc-list-item mdc-list-item--activated"' : ' class="mdc-list-item"',
			'<span class="mdc-list-item__text">' . esc_html( $item->title ) . '</span>'
		);
	}
}
