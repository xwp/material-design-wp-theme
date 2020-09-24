<?php
/**
 * Copyright 2020 Material Design
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Search form partial
 *
 * @package MaterialTheme
 */

?>

<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
	<label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon">
		<input class="mdc-text-field__input" type="text" aria-labelledby="search-label" name="s" value="<?php echo esc_attr( get_search_query() ); ?>">
		<i class="material-icons mdc-text-field__icon mdc-text-field__icon--trailing" tabindex="0" role="button">search</i>
		<div class="mdc-notched-outline">
			<div class="mdc-notched-outline__leading"></div>
			<div class="mdc-notched-outline__notch">
			<span class="mdc-floating-label" id="search-label"><?php esc_html_e( 'Search', 'material-theme' ); ?></span>
			</div>
			<div class="mdc-notched-outline__trailing"></div>
		</div>
	</label>
</form>
