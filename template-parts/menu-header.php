<?php
/**
 * Template part for displaying top app bar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material-theme-wp
 */

use MaterialTheme\Menu;

$top_app_bar_background     = get_theme_mod( 'material_background_color' );
$top_app_bar_text           = get_theme_mod( 'material_text_color' );
$top_app_bar_layout_setting = get_theme_mod( 'material_header_layout' );

$has_changed_color          = ! empty( $top_app_bar_background ) || ! empty( $top_app_bar_text );
$has_search                 = get_theme_mod( 'material_header_search_display' );

$top_app_bar_layout         = ( 'menu' !== $top_app_bar_layout_setting ) ? ' -with-drawer' : '';

$is_material_plugin_active  = class_exists( 'MaterialThemeBuilder\Plugin' );
?>

<div
	class="mdc-top-app-bar top-app-bar<?php echo esc_attr( $top_app_bar_layout ); ?>"
	<?php if ( ! empty( $has_changed_color ) && ! $is_material_plugin_active ) : ?>
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
	<div class="mdc-top-app-bar__row top-app-bar__header">
		<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
			<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button top-app-bar__menu-trigger"><?php esc_html_e( 'menu', 'material-theme-wp' ); ?></button>
			<?php if ( has_custom_logo() ) : ?>
				<div class="logo">
					<?php the_custom_logo(); ?>
				</div>
			<?php endif; ?>
			<span class="mdc-top-app-bar__title top-app-bar__title">
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title mdc-typography mdc-typography--headline1">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h1>
					<?php
				else :
					?>
					<div class="site-title mdc-typography mdc-typography--headline1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
					<?php
				endif;
				?>
			</span>
		</section>
		<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end top-app-bar__menu" role="toolbar">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'walker'         => new Menu\Material_Theme_Menu(),
				'container'      => '',
				'items_wrap'     => '<nav id="%1$s" class="%2$s">%3$s</nav>',
			) );
			?>

			<?php if ( ! empty( $has_search ) ) : ?>
				<button class="mdc-button mdc-button--outlined search__button"> 
					<span class="mdc-button__ripple"></span>
					<i class="material-icons mdc-button__icon">search</i>
					<?php esc_html_e( 'Search', 'material-theme-wp' ); ?>
				</button>
			<?php endif; ?>
		</section>
	</div>

	<div class="mdc-top-app-bar__row top-app-bar__search">
		<?php
		get_template_part( 'template-parts/search', 'header' );
		?>
	</div>
</div>
