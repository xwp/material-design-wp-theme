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
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MaterialTheme
 */

if ( ! is_active_sidebar( 'footer' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area mdc-layout-grid">
	<div class="mdc-layout-grid__inner">
		<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
			<?php dynamic_sidebar( 'footer' ); ?>
		</div>

		<div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
			<?php dynamic_sidebar( 'footer-right' ); ?>
		</div>
	</div>
</aside><!-- #secondary -->
