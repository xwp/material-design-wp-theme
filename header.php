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

$corner_radius = get_theme_mod( 'mtb_small_component_radius' );

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body
	<?php body_class( 'mdc-typography' ); ?>
	style="
		<?php
		if ( $corner_radius ) {
			echo '--mdc-small-component-radius:' . esc_attr( $corner_radius ) . 'px;';
		} 
		?>
	"
>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'material-theme' ); ?></a>

		<?php get_template_part( 'template-parts/drawer' ); ?>

		<?php get_template_part( 'template-parts/header', 'navigation' ); ?>

		<div id="content" class="site-content">
