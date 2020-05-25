<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaterialTheme
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title mdc-typography--headline2"><?php esc_html_e( 'Page not found.', 'material-theme' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<p><?php esc_html_e( "The page you were looking for could not be found. It might have been removed or renamed, try searching below to find what you're looking for.", 'material-theme' ); ?></p>

		<?php
		get_search_form();
		?>
	</div><!-- .page-content -->

</section><!-- .no-results -->
