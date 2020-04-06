<?php
/**
 * Search form partial
 * 
 * @package MaterialTheme
 */
?>

<form class="search-form" action="" method="get">
	<label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon">
		<input class="mdc-text-field__input" type="text" aria-labelledby="search-label" name="s">
		<i class="material-icons mdc-text-field__icon mdc-text-field__icon--trailing" tabindex="0" role="button">search</i>
		<div class="mdc-notched-outline">
			<div class="mdc-notched-outline__leading"></div>
			<div class="mdc-notched-outline__notch">
			<span class="mdc-floating-label" id="seach-label"><?php esc_html_e( 'Search' ); ?></span>
			</div>
			<div class="mdc-notched-outline__trailing"></div>
		</div>
	</label>
</form>
