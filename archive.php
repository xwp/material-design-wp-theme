<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material-theme-wp
 */

get_header();

$archive_layout = get_theme_mod( 'material_archive_layout', 'card' );
$is_card_layout = 'card' === $archive_layout;
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

		<?php
			if ( $is_card_layout ) {
				get_template_part( 'template-parts/archive', 'card' );
			} else {
				get_template_part( 'template-parts/archive', 'image-list' );
			}
		?>
		
		<div class="load-more">
			<button class="mdc-button mdc-button--outlined">
				<div class="mdc-button__ripple"></div>
				<span class="mdc-button__label"><?php esc_html_e( 'Load More', 'material-theme-wp' ); ?></span>
			</button>
		</div>

			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

