<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package MaterialTheme
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title mdc-typography mdc-typography--headline2">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'material-theme' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="site-main__inner">
				<?php get_template_part( 'template-parts/archive' ); ?>
			</div>

			<?php
			get_template_part( 'template-parts/page-navigation' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
