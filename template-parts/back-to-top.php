<?php
/**
 * Back to Top partial
 *
 * @package MaterialTheme
 */

$is_hidden = get_theme_mod( 'material_hide_back_to_top' );

if ( ! empty( $is_hidden ) ) {
	return;
}
?>

<div class="back-to-top mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
	<button id="back-to-top" class="mdc-button mdc-button--outlined" aria-label="<?php esc_attr_e( 'Back to Top', 'material-theme' ); ?>">
		<div class="mdc-button__ripple"></div>
		<i class="material-icons mdc-icon-button__icon">expand_less</i>
	</button>
</div>
