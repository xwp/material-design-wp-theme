<?php
/**
 * Template part for displaying menu drawer
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaterialTheme
 */

use MaterialTheme\Menu_Drawer_Walker;

$top_app_bar_layout_setting = material_get_theme_mod( 'header_layout', 'menu' );
$top_app_bar_layout         = ( 'menu' !== $top_app_bar_layout_setting ) ? ' -with-drawer' : '';

?>

<aside class="mdc-drawer material-drawer mdc-drawer--modal">
	<div class="mdc-drawer__header">
		<?php if ( has_custom_logo() ) : ?>
			<div class="logo">
				<?php the_custom_logo(); ?>
			</div>
		<?php endif; ?>

		<div class="mdc-drawer__title">
			<?php get_template_part( 'template-parts/site-title' ); ?>
		</div>
	</div>
	<div class="mdc-drawer__content">
		<?php get_search_form(); ?>

		<nav class="mdc-list">
			<?php
			if ( has_nav_menu( 'menu-2' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'secondary-menu',
						'walker'         => new Menu_Drawer_Walker(),
						'container'      => '',
						'items_wrap'     => '%3$s',
					)
				);
			}
			?>
		</nav>
	</div>
</aside>

<div class="mdc-drawer-scrim"></div>
