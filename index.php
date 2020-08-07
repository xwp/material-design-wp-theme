<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaterialTheme
 */

get_header();

$max_width         = get_theme_mod( 'material_archive_width', 'normal' );
$class_name        = sprintf( 'material-archive__%s', $max_width );
$has_sidebar_class = is_active_sidebar( 'single' ) && 'normal' === $max_width ? 'has-sidebar' : '';
$content_span      = is_active_sidebar( 'single' ) && 'normal' === $max_width ? 'mdc-layout-grid__cell--span-8' : 'mdc-layout-grid__cell--span-12';
?>

	<main id="main" class="mdc-layout-grid <?php echo esc_attr( $has_sidebar_class ); ?> <?php echo esc_attr( $class_name ); ?>">
		<div class="mdc-layout-grid__inner">
			<div id="primary" class="content-area mdc-layout-grid__cell <?php echo esc_attr( $content_span ); ?>">
				<div class="site-main">

					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) :
							?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
							<?php
						endif;
						?>

						<div class="site-main__inner">
							<?php get_template_part( 'template-parts/archive' ); ?>
						</div>

						<?php
						get_template_part( 'template-parts/page-navigation' );

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div><!-- #primary -->
			</div>

			<?php
			if ( 'normal' === $max_width ) {
				get_sidebar( 'single' );
			}
			?>
		</div>
	</main><!-- #main -->

	<?php get_sidebar(); ?>

<?php
get_footer();
