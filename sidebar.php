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
		<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
			<?php dynamic_sidebar( 'footer' ); ?>
		</div>

		<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
			<?php dynamic_sidebar( 'footer-right' ); ?>
		</div>
	</div>
</aside><!-- #secondary -->
