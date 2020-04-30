<?php
/**
 * Material-theme-wp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MaterialTheme
 */

if ( ! function_exists( 'material_theme_wp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function material_theme_wp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Material-theme-wp, use a find and replace
		 * to change 'material-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'material-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Tabs', 'material-theme' ),
				'menu-2' => esc_html__( 'Drawer', 'material-theme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'material_theme_wp_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'material_theme_wp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function material_theme_wp_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'material_theme_wp_content_width', 640 );
}
add_action( 'after_setup_theme', 'material_theme_wp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function material_theme_wp_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'material-theme' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'Footer widgets area.', 'material-theme' ),
			'before_widget' => '<section id="%1$s" class="widget mdc-layout-grid__cell mdc-layout-grid__cell--span-6 %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title mdc-typography--headline5">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'material_theme_wp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function material_theme_wp_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'material-theme-style', get_stylesheet_uri(), array(), $theme_version );

	wp_enqueue_style( 'material-theme-front-end-css', get_template_directory_uri() . '/assets/css/front-end-compiled.css', array( 'material-theme-style' ), $theme_version );

	if ( ! wp_style_is( 'material-google-fonts-cdn', 'enqueued' ) ) {
		wp_enqueue_style(
			'material-google-fonts-cdn',
			esc_url( '//fonts.googleapis.com/css?family=Roboto|Material+Icons' ),
			[],
			$theme_version
		);
	}

	wp_enqueue_script( 'material-theme-js', get_template_directory_uri() . '/assets/js/front-end.js', array(), $theme_version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'material_theme_wp_scripts' );

/**
 * Enqueue backend styles.
 */
function enqueue_backend_assets() {
	wp_enqueue_style(
		'material-backend-css',
		get_template_directory_uri() . '/assets/css/backend-compiled.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'admin_enqueue_scripts', 'enqueue_backend_assets' );

/**
 * Show admin notice if plugin isn't installed.
 *
 * @return void
 */
function plugin_not_installed_notice() {
	// Plugin already installed. Don't show the notice.
	if ( file_exists( WP_CONTENT_DIR . '/plugins/material-theme-builder' ) ) {
		return;
	}
	?>
	<div class="notice notice-info is-dismissible  material-notice-container">
		<img 
			src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/plugin-icon.svg' ); ?>" 
			alt="<?php _e( 'Material Theme Builder', 'material-theme' ); ?>" 
		/>

		<div class="material-notice-container__content">
			<h3 class="material-notice-container__content__title">
				<?php 
				esc_html_e( 
					'Install the Material Plugin to customize your Material Theme', 
					'material-theme' 
				) 
				?>
			</h3>
			<p class="material-notice-container__content__text">
				<?php 
				echo wp_kses( 
					sprintf(
						/* translators: %s: url to the plugin installation page */
						__( 
							'To take full advantage of this theme you will need the Material Plugin. <a href="%s">Install and activate the plugin</a>', 
							'material-theme' 
						), 
						esc_url( admin_url( '/wp-admin/plugin-install.php?s=Material+Theme+Builder&tab=search&type=term' ) )
					),
					array( 'a' => array( 'href' => array() ) )
				)
				?>
			</p>
		</div>
	</div>
	<?php
}
add_action( 'admin_notices', 'plugin_not_installed_notice' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer/header.php';
require get_template_directory() . '/inc/customizer/footer.php';
require get_template_directory() . '/inc/customizer/archive.php';
require get_template_directory() . '/inc/customizer/comments.php';
require get_template_directory() . '/inc/customizer/menu.php';

/**
 * Custom menu walker
 */
require get_template_directory() . '/inc/class-menu-walker.php';
require get_template_directory() . '/inc/class-menu-drawer-walker.php';

/**
 * Custom comments walker
 */
require get_template_directory() . '/inc/class-walker-comment.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/class-wp-widget-archives.php';
require get_template_directory() . '/inc/widgets/class-wp-widget-categories.php';
require get_template_directory() . '/inc/widgets/class-wp-widget-meta.php';
require get_template_directory() . '/inc/widgets/class-wp-widget-pages.php';
require get_template_directory() . '/inc/widgets/class-wp-widget-recent-comments.php';
require get_template_directory() . '/inc/widgets/class-wp-widget-recent-posts.php';
require get_template_directory() . '/inc/widgets/class-wp-widget-rss.php';
require get_template_directory() . '/inc/widgets.php';

MaterialTheme\Customizer\setup();
MaterialTheme\Customizer\Header\setup();
MaterialTheme\Customizer\Footer\setup();
MaterialTheme\Customizer\Archive\setup();
MaterialTheme\Customizer\Comments\setup();
MaterialTheme\Customizer\Menu\setup();
MaterialTheme\Widgets\setup();
