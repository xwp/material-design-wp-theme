<?php
/**
* Search form partial for archive, 404 pages
* 
* @package Material-theme-wp
*/
?>

<form class="search-form" action="/" method="get">
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

	<button class="mdc-button mdc-button--outlined" type="submit">
		<i class="material-icons mdc-button__icon">search</i>
		<span class="mdc-button__ripple"></span> <?php esc_html_e( 'Search', 'material-theme-wp' ); ?>
	</button>
</form>
