<?php
/**
 * Menu functions
 * 
 * @package MaterialTheme
 */

namespace MaterialTheme\Menu;

/**
 * Loop through menu items in search for one with a parent
 *
 * @param  string $menu_location Location where to look for a menu.
 * @return bool Menu has children
 */
function menu_has_children( $menu_location ) {
	if ( empty( $menu_location ) ) {
		return false;
	}

	$menu_id = get_menu_id_by_location( $menu_location );

	if ( ! empty( $menu_id ) ) {
		$menu_items = wp_get_nav_menu_items( $menu_id );

		if ( empty( $menu_items ) ) {
			return false;
		}

		foreach ( $menu_items as $item ) {
			if ( 0 < $item->menu_item_parent ) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Get menu based on location
 *
 * @param  string $menu_location Location where to look for a menu.
 * @return WP_Term|bool Menu instance if found. Returns false if not found
 */
function get_menu_id_by_location( $menu_location ) {
	if ( empty( $menu_location ) ) {
		return false;
	}

	$theme_locations = get_nav_menu_locations();

	$menu = get_term( $theme_locations[ $menu_location ], 'nav_menu' );

	if ( ! empty( $menu ) && ! is_wp_error( $menu ) ) {
		return $menu;
	}

	return false;
}
