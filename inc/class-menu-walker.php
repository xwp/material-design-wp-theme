<?php
/**
 * Custom menu walker
 * Adds Material Button to menu links
 *
 * @package MaterialTheme
 */

namespace MaterialTheme;

/**
 * Menu_Walker class
 */
class Menu_Walker extends \Walker {
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
			'<a href="%1$s" %2$s>%3$s</a>',
			esc_url( $item->url ),
			( get_the_ID() === $item->object_id ) ? ' class="current mdc-button"' : ' class="mdc-button mdc-top-app-bar__action-item top-app-bar__button"',
			'<div class="mdc-button__ripple"></div><span class="mdc-button__label">' . esc_html( $item->title ) . '</span>'
		);
	}
}
