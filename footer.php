<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Material-theme-wp
 */

?>

	</div><!-- #content -->

	<aside class="mdc-drawer material-drawer mdc-drawer--modal">
		<div class="mdc-drawer__header">
			<h1 class="shrine-title"><?php bloginfo( 'name' ); ?></h1>
		</div>
		<div class="mdc-drawer__content">
			<nav class="mdc-list">
				<a class="mdc-list-item mdc-list-item--activated" aria-selected="true" tabindex="0" href="#">
					<span class="mdc-list-item__text">Featured</span>
				</a>
				<a class="mdc-list-item" href="#">
					<span class="mdc-list-item__text">Apartment</span>
				</a>
				<a class="mdc-list-item" href="#">
					<span class="mdc-list-item__text">Accessories</span>
				</a>
			</nav>
		</div>
	</aside>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'material-theme-wp' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'material-theme-wp' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'material-theme-wp' ), 'material-theme-wp', '<a href="http://underscores.me/">Me</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
