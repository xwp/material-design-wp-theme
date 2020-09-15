<?php
/**
 * Template part for displaying top app bar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaterialTheme
 */

use MaterialTheme\Menu_Walker;

$has_search = material_get_theme_mod( 'header_search_display' );
$layout     = material_get_theme_mod( 'header_bar_layout', 'standard' );
$class      = ( 'fixed' === $layout ) ? 'mdc-top-app-bar--fixed' : '';
?>

<div class="mdc-top-app-bar top-app-bar <?php echo esc_attr( $class ); ?>">
	<div class="mdc-top-app-bar__row top-app-bar__header">
		<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
			<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
				<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button top-app-bar__menu-trigger"><?php esc_html_e( 'menu', 'material-theme' ); ?></button>
			<?php endif; ?>
			<?php if ( has_custom_logo() ) : ?>
				<div class="logo">
					<?php the_custom_logo(); ?>
				</div>
			<?php endif; ?>
			<span class="mdc-top-app-bar__title top-app-bar__title">
				<?php get_template_part( 'template-parts/site-title' ); ?>
			</span>
		</section>
		<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end top-app-bar__menu" role="toolbar">
				<?php if ( ! empty( $has_search ) ) : ?>
				<button class="mdc-button search__button"> 
					<span class="mdc-button__ripple"></span>
					<i class="material-icons mdc-button__icon">search</i>
					<span class="screen-reader-text"><?php esc_html_e( 'Search', 'material-theme' ); ?></span>
				</button>
			<?php endif; ?>
		</section>
	</div>

	<div class="mdc-top-app-bar__row top-app-bar__search">
		<?php
		get_template_part( 'template-parts/search', 'header' );
		?>
	</div>

	<?php get_template_part( 'template-parts/menu', 'tabs' ); ?>
</div>
