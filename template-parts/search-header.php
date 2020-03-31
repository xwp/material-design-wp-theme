<?php
/**
* Search form partial inside header
* 
* @package Material-theme-wp
*/
?>

<form class="search-form" action="/" method="get">
	<button class="mdc-button mdc-button--unelevated">
		<span class="mdc-button__ripple"></span>
		<span class="mdc-button__label"><?php esc_attr_e( 'Exit search form', 'material-theme-wp' ); ?></span>
		<i class="material-icons mdc-button__icon" aria-hidden="true">navigate_before</i>
	</button>
	<div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon">
		<i class="material-icons mdc-text-field__icon mdc-text-field__icon--trailing" tabindex="0">search</i>
		<input class="mdc-text-field__input" id="text-field-hero-input" name="s">
		<div class="mdc-notched-outline">
			<div class="mdc-notched-outline__leading"></div>
			<div class="mdc-notched-outline__notch">
				<label for="text-field-hero-input" class="mdc-floating-label"><?php esc_html_e( 'Search', 'material-theme-wp' ); ?></label>
			</div>
			<div class="mdc-notched-outline__trailing"></div>
		</div>
	</div>
</form>
