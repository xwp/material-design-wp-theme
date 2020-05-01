<?php
/**
 * Search form partial
 *
 * @package MaterialTheme
 */

?>

<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon">
		<input class="mdc-text-field__input" type="text" aria-labelledby="search-label" name="s" value="<?php echo esc_attr( get_search_query() ); ?>">
		<i class="material-icons mdc-text-field__icon mdc-text-field__icon--trailing" tabindex="0" role="button">search</i>
		<div class="mdc-notched-outline">
			<div class="mdc-notched-outline__leading"></div>
			<div class="mdc-notched-outline__notch">
			<span class="mdc-floating-label" id="seach-label"><?php esc_html_e( 'Search', 'material-theme' ); ?></span>
			</div>
			<div class="mdc-notched-outline__trailing"></div>
		</div>
	</label>
</form>
