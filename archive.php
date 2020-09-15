<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaterialTheme
 */

get_header();

$max_width  = get_theme_mod( 'archive_width', 'normal' );
$class_name = sprintf( 'material-archive__%s', $max_width );
?>

	<div id="primary" class="content-area <?php echo esc_attr( $class_name ); ?>">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :
			?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title mdc-typography mdc-typography--headline1">', '</h1>' );
				the_archive_description( '<div class="archive-description mdc-typography mdc-typography--body1">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="site-main__inner">
				<?php get_template_part( 'template-parts/archive' ); ?>
			</div>
		</div>

			<?php
			get_template_part( 'template-parts/page-navigation' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

