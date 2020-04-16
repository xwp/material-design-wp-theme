<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MaterialTheme
 */

if ( ! is_active_sidebar( 'footer' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area mdc-layout-grid">
	<div class="mdc-layout-grid__inner">
		<?php dynamic_sidebar( 'footer' ); ?>
	</div>
</aside><!-- #secondary -->
