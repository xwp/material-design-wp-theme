<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MaterialTheme
 */

$header_width = get_theme_mod( 'material_header_width_layout', 'boxed' );

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'mdc-typography' ); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'material-theme' ); ?></a>

		<?php get_template_part( 'template-parts/drawer' ); ?>

		<div
			class="
				site__navigation
				<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
					-has-tab-bar
				<?php endif; ?>
			"
			<?php if ( 'full' === $header_width ) : ?>
				style="--mt-header-width: 76.5625rem;"
			<?php endif; ?>
		>
			<?php get_template_part( 'template-parts/menu', 'header' ); ?>

			<?php get_template_part( 'template-parts/menu', 'tabs' ); ?>
		</div>

		<div id="content" class="site-content">
