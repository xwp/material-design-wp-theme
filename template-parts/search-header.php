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
 * 
 * @package MaterialTheme
 */

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
	</div>
	<button class="mdc-button mdc-button--unelevated button__back" type="button">
		<span class="mdc-button__ripple"></span>
		<span class="mdc-button__label"><?php esc_attr_e( 'Exit search form', 'material-theme' ); ?></span>
		<i class="material-icons mdc-button__icon" aria-hidden="true">close</i>
	</button>
</form>
