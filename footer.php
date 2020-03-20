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

	<footer id="colophon" class="site-footer">
		<div class="site-footer__copyright">

		</div>
		<div class="back-to-top">
			<button class="mdc-button" aria-label="<?php esc_attr_e( 'Back to Top', 'material-theme-wp' ); ?>">
				<div class="mdc-button__ripple"></div>
				<i class="material-icons mdc-icon-button__icon">expand_less</i>
			</button>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
