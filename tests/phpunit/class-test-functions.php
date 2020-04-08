<?php
/**
 * Test_Material_Theme
 *
 * @package MaterialThemeBuilder
 */

namespace MaterialThemeBuilder;

/**
 * Class Test_Material_Theme
 *
 * @package MaterialThemeBuilder
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
