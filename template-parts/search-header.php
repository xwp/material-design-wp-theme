<?php
/**
 * Search form partial inside header
 * 
 * @package Material-theme-wp
 */
?>

<form class="search-form" action="/" method="get">
	<button class="mdc-button mdc-button--unelevated button__back" type="button">
		<span class="mdc-button__ripple"></span>
		<span class="mdc-button__label"><?php esc_attr_e( 'Exit search form', 'material-theme-wp' ); ?></span>
		<i class="material-icons mdc-button__icon" aria-hidden="true">navigate_before</i>
	</button>
	<div class="mdc-text-field mdc-text-field--fullwidth mdc-text-field--no-label">
		<div class="mdc-text-field__ripple"></div>
		<input
			class="mdc-text-field__input"
			placeholder="<?php esc_attr_e( 'Search the site', 'material-theme-wp' ); ?>"
			aria-label="<?php esc_attr_e( 'Search', 'material-theme-wp' ); ?>"
			type="search"
			name="s"
		>
	</div>
</form>
