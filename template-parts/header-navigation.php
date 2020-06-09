<?php
/**
 * The header navigation
 * Contains top app bar and tab bar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MaterialTheme
 */

?>

<div
	class="
		site__navigation
		<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
			-has-tab-bar
		<?php endif; ?>
		"
	role="banner"
>
	<?php get_template_part( 'template-parts/menu', 'header' ); ?>

	<?php get_template_part( 'template-parts/menu', 'tabs' ); ?>
</div>
