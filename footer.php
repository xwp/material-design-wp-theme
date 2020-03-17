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

	<aside class="mdc-drawer shrine-drawer">
		<div class="mdc-drawer__header">
			<svg class="shrine-logo-drawer" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			width="48px" height="48px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve" fill="#000000" focusable="false">
			<g>
				<g>
				<path d="M17,2H7L2,6.62L12,22L22,6.62L17,2z M16.5,3.58l3.16,2.92H16.5V3.58z M7.59,3.5H15v3H4.34L7.59,3.5z
					M11.25,18.1L7.94,13h3.31V18.1z M11.25,11.5H6.96L4.69,8h6.56V11.5z M16.5,12.32 M12.75,18.09V8h6.56L12.75,18.09z"/>
				</g>
				<rect fill="none" width="24" height="24"/>
			</g>
			</svg>
			<h1 class="shrine-title">SHRINE</h1>
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
