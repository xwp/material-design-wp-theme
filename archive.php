<?php
/**
 * The template for displaying archive pages
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
			<header class="page-header mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
				<?php
				the_archive_title( '<h1 class="page-title mdc-typography mdc-typography--headline1">', '</h1>' );
				the_archive_description( '<div class="archive-description mdc-typography mdc-typography--body1">', '</div>' );
				?>
			</header><!-- .page-header -->
		</div>

		<div class="mdc-layout-grid__inner">
			<div id="primary" class="content-area mdc-layout-grid__cell <?php echo esc_attr( $content_span ); ?>">
				<div class="site-main">

					<?php
					if ( have_posts() ) :
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

				</div><!-- #main -->
			</div>

			<?php
			if ( 'normal' === $max_width ) {
				get_sidebar( 'single' );
			}
			?>
		</div>
	</main><!-- #primary -->
<?php
get_sidebar();
get_footer();

