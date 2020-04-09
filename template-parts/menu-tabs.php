<?php
/**
 * Template part for displaying tabs navigation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaterialTheme
 */

use MaterialTheme\Menu;
use MaterialTheme\Menu_Walker;

$menu_has_children = Menu\menu_has_children( 'menu-1' );

if ( $menu_has_children ) {
	return;
}
?>

<div class="mdc-tab-bar tab-bar" role="tablist">
	<div class="mdc-tab-scroller">
		<div class="mdc-tab-scroller__scroll-area">
			<div class="mdc-tab-scroller__scroll-content">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'walker'         => new Menu_Walker(),
						'container'      => '',
						'items_wrap'     => '%3$s',
					)
				);
				?>
			</div>
		</div>
	</div>
</div>
