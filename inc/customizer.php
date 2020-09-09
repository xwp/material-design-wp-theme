<?php
/**
 * Material-theme-wp Theme Customizer
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Customizer;

use MaterialTheme\Customizer\Colors;

/**
 * Attach hooks.
 *
 * @return void
 */
function setup() {
	add_action( 'customize_register', __NAMESPACE__ . '\register' );
	add_action( 'customize_preview_init', __NAMESPACE__ . '\preview_scripts' );

	add_action( 'customize_controls_enqueue_scripts', __NAMESPACE__ . '\scripts' );

	add_action( 'wp_head', __NAMESPACE__ . '\frontend_inline_css', 2 );
	add_action( 'admin_head', __NAMESPACE__ . '\frontend_inline_css', 2 );
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function register( $wp_customize ) {
	if ( ! class_exists( 'MaterialThemeBuilder\Plugin' ) ) {
		$wp_customize->add_panel(
			'material_theme_builder',
			[
				'priority'    => 10,
				'capability'  => 'edit_theme_options',
				'title'       => esc_html__( 'Material Theme Options', 'material-theme' ),
				'description' => esc_html__( 'Change the color, shape, typography, and icons below to customize your theme style. Navigate to the Material Library to see your custom styles applied across Material Components..', 'material-theme' ),
			]
		);
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => __NAMESPACE__ . '\get_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => __NAMESPACE__ . '\get_description',
			)
		);
	}
}

/**
 * Define settings prefix.
 *
 * @return string Settings prefix.
 */
function get_slug() {
	return 'material';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function get_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function get_description() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @return void
 */
function preview_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script(
		'material-theme-customizer-preview',
		get_template_directory_uri() . '/assets/js/customize-preview.js',
		[ 'customize-preview' ],
		$theme_version,
		true
	);

	$css_vars = [];
	$controls = [];

	if ( ! class_exists( 'MaterialThemeBuilder\Plugin' ) ) {
		$controls = array_merge( $controls, Colors\get_color_controls() );
	}

	foreach ( $controls as $control ) {
		$css_vars[ prepend_slug( $control['id'] ) ] = $control['css_var'];
	}

	wp_localize_script(
		'material-theme-customizer-preview',
		'materialThemeColorControls',
		$css_vars
	);
}

/**
 * Enqueue control scripts.
 *
 * @return void
 */
function scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'material-theme-customizer-styles',
		get_template_directory_uri() . '/assets/css/customize-controls-compiled.css',
		[ 'wp-color-picker' ],
		$theme_version
	);

	wp_enqueue_script(
		'material-theme-customizer-controls',
		get_template_directory_uri() . '/assets/js/customize-controls.js',
		[ 'wp-color-picker', 'customize-controls' ],
		$theme_version,
		true
	);
}

/**
 * Register setting in customizer.
 *
 * @param  mixed $wp_customize Theme Customizer object.
 * @param  mixed $settings     Settings to register in customizer.
 * @return void
 */
function add_settings( $wp_customize, $settings = [] ) {
	$slug = get_slug();

	foreach ( $settings as $id => $setting ) {
		$id = prepend_slug( $id );

		if ( is_array( $setting ) ) {
			$defaults = [
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
				'default'           => get_default( $id ),
			];

			$setting = array_merge( $defaults, $setting );
		}

		/**
		 * Filters the customizer setting args.
		 *
		 * This allows other plugins/themes to change the customizer setting args.
		 *
		 * @param array   $setting Array of setting args.
		 * @param string  $id      ID of the setting.
		 */
		$setting = apply_filters( $slug . '_customizer_setting_args', $setting, $id );

		if ( is_array( $setting ) ) {
			$wp_customize->add_setting(
				$id,
				$setting
			);
		} elseif ( $setting instanceof \WP_Customize_Setting ) {
			$setting->id = $id;
			$wp_customize->add_setting( $setting );
		}
	}
}

/**
 * Prepend the slug name if it does not exist.
 *
 * @param  string $name The name of the setting/control.
 * @return string
 */
function prepend_slug( $name ) {
	$slug = get_slug();

	return false === strpos( $name, "{$slug}_" ) ? "{$slug}_{$name}" : $name;
}

/**
 * Get default value for a setting.
 *
 * @param  string $setting Name of the setting.
 * @return mixed
 */
function get_default( $setting ) {
	$slug     = get_slug();
	$setting  = str_replace( "{$slug}_", '', $setting );
	$defaults = get_default_values();

	return isset( $defaults[ $setting ] ) ? $defaults[ $setting ] : '';
}

/**
 * Set default values.
 *
 * @return array
 */
function get_default_values() {
	$defaults = [
		'header_background_color' => '#6200ee',
		'header_text_color'       => '#ffffff',
		'background_color'        => '#ffffff',
		'background_text_color'   => '#000000',
		'footer_background_color' => '#ffffff',
		'footer_text_color'       => '#000000',
		'archive_layout'          => 'card',
		'header_width_layout'     => 'boxed',
		'archive_width'           => 'normal',
		'archive_comments'        => true,
		'archive_author'          => true,
		'archive_excerpt'         => true,
		'archive_date'            => true,
		'archive_outlined'        => false,
	];

	$surface    = get_material_theme_builder_option( 'surface_color' );
	$on_surface = get_material_theme_builder_option( 'surface_text_color' );
	
	if ( $surface ) {
		$defaults['footer_background_color'] = $surface;
	}

	if ( $on_surface ) {
		$defaults['footer_text_color'] = $on_surface;
	}

	return $defaults;
}

/**
 * Add controls to customizer.
 *
 * @param  WP_Customize $wp_customize WP_Customize instance.
 * @param  array        $controls Array of controls to add to customizer.
 * @return void
 */
function add_controls( $wp_customize, $controls = [] ) {
	$slug = get_slug();

	foreach ( $controls as $id => $control ) {
		$id = prepend_slug( $id );

		/**
		 * Filters the customizer control args.
		 *
		 * This allows other plugins/themes to change the customizer controls args.
		 *
		 * @param array  $control Array of control args.
		 * @param string $id      ID of the control.
		 */
		$control = apply_filters( $slug . '_customizer_control_args', $control, $id );

		if ( is_array( $control ) ) {
			$wp_customize->add_control(
				$id,
				$control
			);
		} elseif ( $control instanceof \WP_Customize_Control ) {
			$control->id      = $id;
			$control->section = isset( $control->section ) ? $control->section : '';
			$wp_customize->add_control( $control );
		}
	}
}

/**
 * Add color controls to customizer.
 * Use `Material_Color_Palette_Control` if the material plugin is active.
 *
 * @param  WP_Customize $wp_customize   WP_Customize instance.
 * @param  array        $color_controls Array of controls to add to customizer.
 * @param  string       $section Section to add the controls to.
 * @return void
 */
function add_color_controls( $wp_customize, $color_controls, $section ) {
	/**
	 * Generate list of all the controls in the colors section.
	 */
	$controls = [];

	$section = prepend_slug( $section );

	foreach ( $color_controls as $control ) {
		if ( class_exists( '\MaterialThemeBuilder\Customizer\Material_Color_Palette_Control' ) ) {
			$controls[ $control['id'] ] = new \MaterialThemeBuilder\Customizer\Material_Color_Palette_Control(
				$wp_customize,
				prepend_slug( $control['id'] ),
				[
					'label'                => $control['label'],
					'section'              => $section,
					'related_text_setting' => ! empty( $control['related_text_setting'] ) ? $control['related_text_setting'] : false,
					'related_setting'      => ! empty( $control['related_setting'] ) ? $control['related_setting'] : false,
					'css_var'              => $control['css_var'],
					'a11y_label'           => ! empty( $control['a11y_label'] ) ? $control['a11y_label'] : '',
				]
			);
		} else {
			$controls[ $control['id'] ] = [
				'label'   => $control['label'],
				'section' => $section,
				'type'    => 'color',
			];
		}
	}

	add_controls( $wp_customize, $controls );
}

/**
 * Get custom frontend CSS based on the customizer theme settings.
 */
function get_frontend_css() {
	$color_vars = [];
	$defaults   = get_default_values();

	if ( ! class_exists( 'MaterialThemeBuilder\Plugin' ) ) {
		$controls = array_merge( $controls, Colors\get_color_controls() );
	}

	foreach ( $controls as $control ) {
		$default      = isset( $defaults[ $control['id'] ] ) ? $defaults[ $control['id'] ] : '';
		$value        = get_theme_mod( prepend_slug( $control['id'] ), $default );
		$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] ), esc_html( $value ) );

		if ( '--mdc-theme-primary' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb          = implode( ',', $rgb );
				$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
			}
		}

		if ( '--mdc-theme-on-primary' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb          = implode( ',', $rgb );
				$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
			}       
		}

		if ( '--mdc-theme-secondary' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb = implode( ',', $rgb );
			}

			$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
		}

		if ( '--mdc-theme-on-secondary' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb = implode( ',', $rgb );
			}

			$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
		}

		if ( '--mdc-theme-primary-bg' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb = implode( ',', $rgb );
			}

			$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
		}

		if ( '--mdc-theme-secondary-bg' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb = implode( ',', $rgb );
			}

			$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
		}

		if ( '--mdc-theme-surface' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb = implode( ',', $rgb );
			}

			$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
		}

		if ( '--mdc-theme-on-surface' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb = implode( ',', $rgb );
			}

			$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
		}

		if ( '--mdc-theme-header' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb          = implode( ',', $rgb );
				$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
			}       
		}

		if ( '--mdc-theme-on-header' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb          = implode( ',', $rgb );
				$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
			}
		}

		if ( '--mdc-theme-footer' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb = implode( ',', $rgb );
			}

			$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
		}

		if ( '--mdc-theme-on-footer' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb = implode( ',', $rgb );
			}

			$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
		}

		if ( '--mdc-theme-background' === $control['css_var'] ) {
			$rgb = hex_to_rgb( $value );
			if ( ! empty( $rgb ) ) {
				$rgb = implode( ',', $rgb );
			}

			$color_vars[] = sprintf( '%s: %s;', esc_html( $control['css_var'] . '-rgb' ), esc_html( $rgb ) );
		}
	}

	$color_vars = implode( "\n\t\t\t", $color_vars );

	return "
		:root {
			{$color_vars}
		}
	";
}

/**
 * Output inline styles with css variables at the top of the head.
 */
function frontend_inline_css() {
	?>
	<style id="material-theme-css-variables">
		<?php echo get_frontend_css(); // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</style>
	<?php
}

/**
 * Convert color hex code to rgb.
 *
 * @param  string|array $hex Hex/RGB of the color.
 * @return mixed
 */
function hex_to_rgb( $hex ) {
	if ( is_array( $hex ) && ! empty( $hex ) ) {
		return $hex;
	}

	$hex = strtolower( ltrim( $hex, '#' ) );
	if ( 3 !== strlen( $hex ) && 6 !== strlen( $hex ) ) {
		return false;
	}

	$values = str_split( $hex, ( 3 === strlen( $hex ) ) ? 1 : 2 );

	return array_map(
		function ( $hex_code ) {
			return hexdec( str_pad( $hex_code, 2, $hex_code ) );
		},
		$values
	);
}

/**
 * Get Material Theme builder plugin option by name.
 *
 * @param  string $name name of the option.
 * @return mixed
 */
function get_material_theme_builder_option( $name ) {
	$value = false;
	if ( function_exists( '\MaterialThemeBuilder\get_plugin_instance' ) ) {
		$value = \MaterialThemeBuilder\get_plugin_instance()->customizer_controls->get_option( $name );
	}

	return apply_filters( 'get_material_theme_builder_option', $value, $name );
}
