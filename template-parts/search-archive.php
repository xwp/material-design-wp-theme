<?php
/**
* Search form partial for archive, 404 pages
* 
* @package Material-theme-wp
*/
?>

<form class="search-form" action="/" method="get">
	<div class="mdc-text-field mdc-text-field--outlined">
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
