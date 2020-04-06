<?php
/**
 * Footer component
 *
 * @package MaterialTheme
 */

$footer_text             = get_theme_mod( 'material_footer_text' );
$footer_background_color = get_theme_mod( 'material_footer_background_color' );
$footer_text_color       = get_theme_mod( 'material_footer_text_color' );

$has_changed_color = ! empty( $footer_background_color ) || ! empty( $footer_text_color );
?>

	<div
		id="colophon"
		class="mdc-layout-grid site-footer__inner"
		<?php if ( ! empty( $has_changed_color ) ) : ?>
			style="
				<?php if ( ! empty( $footer_background_color ) ) : ?>
					--mdc-theme-primary: <?php echo esc_attr( $footer_background_color ); ?>;
				<?php endif; ?>

				<?php if ( ! empty( $footer_text_color ) ) : ?>
					--mdc-theme-on-primary: <?php echo esc_attr( $footer_text_color ); ?>;
				<?php endif; ?>
			"
		<?php endif; ?>
	>
		<div class="mdc-layout-grid__inner">
			<div class="site-footer__copyright mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
				<small class="site-footer__text mdc-typography--subtitle2"><?php echo esc_html( $footer_text ); ?></small>
			</div>

			<?php get_template_part( 'template-parts/back-to-top' ); ?>
		</div>
	</div><!-- #colophon -->
