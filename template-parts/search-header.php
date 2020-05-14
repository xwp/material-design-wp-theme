<?php
/**
 * Search form partial inside header
 *
 * @package MaterialTheme
 */

?>

<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<div class="mdc-text-field mdc-text-field--fullwidth mdc-text-field--no-label">
		<div class="mdc-text-field__ripple"></div>
		<input
			class="mdc-text-field__input"
			placeholder="<?php esc_attr_e( 'Search the site', 'material-theme' ); ?>"
			aria-label="<?php esc_attr_e( 'Search', 'material-theme' ); ?>"
			type="search"
			name="s"
		>
		<button class="mdc-button mdc-button--unelevated screen-reader-text" type="submit" aria-hidden="true">
			<span class="mdc-button__ripple"></span>
			<span class="mdc-button__label"><?php esc_attr_e( 'Search', 'material-theme' ); ?></span>
			<i class="material-icons mdc-button__icon">search</i>
		</button>
	</div>
	<button class="mdc-button mdc-button--unelevated button__back" type="button" tabindex="-1" aria-label="<?php esc_attr_e( 'Exit search form', 'material-theme' ); ?>">
		<span class="mdc-button__ripple"></span>
		<span class="mdc-button__label"></span>
		<i class="material-icons mdc-button__icon" aria-hidden="true">close</i>
	</button>
</form>
