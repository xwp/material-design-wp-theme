<?php
/**
 * Template part for displaying tabs navigation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaterialTheme
 */

use MaterialTheme\Menu_Walker;

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
						'depth'          => 1,
					)
				);
				?>
			</div>
		</div>
	</div>
</div>
