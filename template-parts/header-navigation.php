<?php
/**
 * The header navigation
 * Contains top app bar and tab bar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MaterialTheme
 */

$header_width = get_theme_mod( 'material_header_width_layout', 'full' );

?>

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
