<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaterialTheme
 */

$has_sidebar_class = is_active_sidebar( 'single' ) ? 'has-sidebar' : '';
$content_span      = is_active_sidebar( 'single' ) ? 'mdc-layout-grid__cell--span-8' : 'mdc-layout-grid__cell--span-12';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $has_sidebar_class ); ?>>
	<?php material_theme_wp_post_thumbnail(); ?>

	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				material_theme_wp_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title mdc-typography mdc-typography--headline2">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title mdc-typography mdc-typography--headline2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<?php material_theme_wp_posted_by(); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="mdc-layout-grid">
		<div class="mdc-layout-grid__inner">
			<div class="entry-content mdc-layout-grid__cell <?php echo esc_attr( $content_span ); ?>">
				<?php
				the_content(
					sprintf(
						wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'material-theme' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) 
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'material-theme' ),
						'after'  => '</div>',
					) 
				);
				?>
			</div><!-- .entry-content -->

			<?php
			if ( is_single() ) {
				get_sidebar( 'single' );
			}
			?>
		</div>
	</div>

	<footer class="entry-footer">
		<?php material_theme_wp_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
