<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MaterialTheme
 */

if ( ! is_active_sidebar( 'single' ) ) {
	return;
}
?>

<aside id="sidebar" class="widget-area mdc-layout-grid__cell mdc-layout-grid__cell--span-4">
	<?php dynamic_sidebar( 'single' ); ?>
</aside><!-- #secondary -->
