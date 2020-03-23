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

 $footer_text = get_theme_mod( 'material_footer_text' );

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer mdc-layout-grid">
		<div class="mdc-layout-grid__inner">
			<div class="site-footer__copyright mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
				<small class="site-footer__text mdc-typography--subtitle2"><?php echo esc_html( $footer_text ); ?></small>
			</div>
			
			<?php get_template_part( 'template-parts/back-to-top' ); ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
