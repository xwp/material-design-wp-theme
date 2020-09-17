<?php
// Copyright 2020 Google LLC
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//      http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

/**
 * The site title template
 *
 * @package MaterialTheme
 */

$hide_site_title = get_theme_mod( 'header_title_display', true );

if ( $hide_site_title ) {
	return;
}

if ( is_front_page() && is_home() ) :
	?>
	<h1 class="site-title mdc-typography mdc-typography--headline6">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	</h1>
	<?php
else :
	?>
	<div class="site-title mdc-typography mdc-typography--headline6"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
	<?php
endif;
