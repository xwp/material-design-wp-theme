<?php
/**
 * Template part for displaying menu drawer
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material-theme-wp
 */

use MaterialTheme\Menu;

$top_app_bar_background     = get_theme_mod( 'material_background_color' );
$top_app_bar_text           = get_theme_mod( 'material_text_color' );
$top_app_bar_layout_setting = get_theme_mod( 'material_header_layout', 'menu' );

$has_changed_color = ! empty( $top_app_bar_background ) || ! empty( $top_app_bar_text );

$top_app_bar_layout = ( 'menu' !== $top_app_bar_layout_setting ) ? ' -with-drawer' : '';

?>

<aside class="mdc-drawer material-drawer mdc-drawer--modal">
	<div class="mdc-drawer__header">
		<?php if ( has_custom_logo() ) : ?>
			<div class="logo">
				<?php the_custom_logo(); ?>
			</div>
		<?php endif; ?>
		<h1 class="shrine-title"><?php bloginfo( 'name' ); ?></h1>
	</div>
	<div class="mdc-drawer__content">
		<nav
			class="mdc-list"
			<?php if ( ! empty( $has_changed_color ) ) : ?>
				style="
					<?php if ( ! empty( $top_app_bar_background ) ) : ?>
						--mdc-theme-primary: <?php echo esc_attr( $top_app_bar_background ); ?>;
					<?php endif; ?>

					<?php if ( ! empty( $top_app_bar_text ) ) : ?>
						--mdc-theme-on-primary: <?php echo esc_attr( $top_app_bar_text ); ?>;
					<?php endif; ?>
				"
			<?php endif; ?>
		>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'walker'         => new Menu\Material_Theme_Drawer_Menu(),
					'container'      => '',
					'items_wrap'     => '%3$s',
				) 
			);
			?>
		</nav>

		<?php get_search_form(); ?>
	</div>
</aside>

<div class="mdc-drawer-scrim"></div>
