<?php
/**
 * Admin features
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Admin;

/**
 * Attach hooks
 *
 * @return void
 */
function setup() {
	add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_admin_assets' );
	add_action( 'admin_notices', __NAMESPACE__ . '\plugin_not_installed_notice' );
	add_action( 'tgmpa_register', __NAMESPACE__ . '\register_required_plugins' );
}

/**
 * Enqueue admin styles.
 */
function enqueue_admin_assets() {
	wp_enqueue_style(
		'material-theme-admin-css',
		get_template_directory_uri() . '/assets/css/admin-compiled.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
}

/**
 * Show admin notice if plugin isn't installed.
 *
 * @return void
 */
function plugin_not_installed_notice() {
	$plugin = 'material-theme-builder';
	$action = false;
	$title  = '';
	$cta    = '';

	if ( ! file_exists( trailingslashit( WP_CONTENT_DIR ) . 'plugins/' . $plugin ) ) {
		$action = 'install';
		$title  = esc_html__( 'Install', 'material-theme' );
		$cta    = esc_html__( 'Install and activate', 'material-theme' );
	} elseif ( ! is_plugin_active( "$plugin/$plugin.php" ) ) {
		$action = 'activate';
		$cta    = esc_html__( 'Activate', 'material-theme' );
		$title  = $cta;
	}

	// Plugin already installed and active or on the activation screen. Don't show the notice.
	if ( empty( $action ) || (
		'activate-plugin' === filter_input( INPUT_GET, 'tgmpa-activate', FILTER_SANITIZE_STRING ) &&
		filter_input( INPUT_GET, 'plugin', FILTER_SANITIZE_STRING ) === $plugin
	) ) {
		return;
	}

	$args = [
		'page'             => 'tgmpa-install-plugins',
		'plugin'           => $plugin,
		'tgmpa-' . $action => $action . '-plugin',
		'tgmpa-nonce'      => wp_create_nonce( 'tgmpa-' . $action ),
	];

	$action_link = sprintf(
		'<a href="%1$s">%2$s %3$s</a>',
		esc_url( add_query_arg( $args, admin_url( '/themes.php' ) ) ),
		esc_html( $cta ),
		esc_html__( ' the plugin', 'material-theme' )
	);

	?>
	<div class="notice notice-info is-dismissible  material-notice-container">
		<img
			src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/plugin-icon.svg' ); ?>"
			alt="<?php esc_html_e( 'Material Theme Builder', 'material-theme' ); ?>"
		/>

		<div class="material-notice-container__content">
			<h3 class="material-notice-container__content__title">
				<?php
				printf(
					'%s %s',
					esc_html( $title ),
					esc_html__(
						' the Material Plugin to customize your Material Theme',
						'material-theme'
					)
				)
				?>
			</h3>
			<p class="material-notice-container__content__text">
				<?php
				echo wp_kses(
					sprintf(
						/* translators: %s: url to the plugin install/active action */
						esc_html__(
							'To take full advantage of this theme you will need the Material Plugin. %s',
							'material-theme'
						),
						$action_link
					),
					array( 'a' => array( 'href' => array() ) )
				)
				?>
			</p>
		</div>
	</div>
	<?php
}

/**
 * Register the required plugins for this theme.
 */
function register_required_plugins() {
	$plugins = array(
		array(
			'name'     => esc_html__( 'Material Theme Builder', 'material-theme' ),
			'slug'     => 'material-theme-builder',
			// @todo remove source and point to the WordPress.org plugin repo after the plugin is published.
			'source'   => 'https://storage.googleapis.com/xwp-mdc/material-theme-builder/material-theme-builder.zip',
			'required' => true,
		),
	);

	$config = array(
		'id'           => 'tgmpa-material-theme',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => false,
		'is_automatic' => true,
	);

	tgmpa( $plugins, $config );

}
