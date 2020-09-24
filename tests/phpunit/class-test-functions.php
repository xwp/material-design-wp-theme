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
 * Test_Material_Theme
 *
 * @package MaterialTheme
 */

namespace MaterialTheme;

/**
 * Class Test_Material_Theme
 *
 * @package MaterialTheme
 */
class Test_Material_Theme extends \WP_UnitTestCase {

	/**
	 * Test material_theme_wp_scripts().
	 *
	 * @see material_theme_wp_scripts()
	 */
	public function test_material_theme_wp_scripts() {
		material_theme_wp_scripts();
		$this->assertTrue( wp_style_is( 'material-theme-style', 'enqueued' ) );
		$this->assertTrue( wp_style_is( 'material-theme-front-end-css', 'enqueued' ) );
		$this->assertTrue( wp_style_is( 'material-google-fonts-cdn', 'enqueued' ) );
		$this->assertTrue( wp_script_is( 'material-theme-js', 'enqueued' ) );
	}
}
