<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material-theme-wp
 */

get_header();
?>

	<div id="primary" class="content-area">
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

		<div class="masonry-grid layout-masonry-2">
			<div class="masonry-grid_column">

				<?php
				$i = 1;
				$posts_per_page = get_option( 'posts_per_page' );
				$column_limit   = absint( round( $posts_per_page / 2 ) );

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

					if ( $column_limit === $i ) {
						echo '</div><div class="masonry-grid_column">';
					}

					$i++;

				endwhile;

				?>
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
get_footer();

