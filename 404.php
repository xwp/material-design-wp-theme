<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Material-theme-wp
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title mdc-typography--headline2"><?php esc_html_e( 'Oops! This page can&rsquo;t be found.', 'material-theme-wp' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'material-theme-wp' ); ?></p>

					<?php
					get_template_part( 'template-parts/search', 'archive' );
					?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
