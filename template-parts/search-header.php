<?php
/**
 * Search form partial inside header
 *
 * @package MaterialTheme
 */

?>

<form class="search-form" action="/" method="get">
	<div class="mdc-text-field mdc-text-field--fullwidth mdc-text-field--no-label">
		<div class="mdc-text-field__ripple"></div>
		<input
			class="mdc-text-field__input"
			placeholder="<?php esc_attr_e( 'Search the site', 'material-theme' ); ?>"
			aria-label="<?php esc_attr_e( 'Search', 'material-theme' ); ?>"
			type="search"
			name="s"
		>
	</div>
	<button class="mdc-button mdc-button--unelevated button__back" type="button">
		<span class="mdc-button__ripple"></span>
		<span class="mdc-button__label"><?php esc_attr_e( 'Exit search form', 'material-theme' ); ?></span>
		<i class="material-icons mdc-button__icon" aria-hidden="true">close</i>
	</button>
</form>
