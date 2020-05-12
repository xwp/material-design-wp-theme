<?php
/**
 * Custom radio toggle
 * Adds a toggle radoi control to customizer
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Customizer;

/**
 * Menu_Drawer_Walker class
 */
class Radio_Toggle_Control extends \WP_Customize_Control {
	/**
	 * The type of customize control being rendered.
	 *
	 * @var string
	 */
	public $type = 'toggle_radio';

	/**
	 * Displays the control content.
	 *
	 * @return void
	 */
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}
		?>

		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>

		<div class="customize-control-row">
			<?php foreach ( $this->choices as $value => $label ) : ?>
				<input
					type="radio"
					<?php $this->link(); ?>
					value="<?php echo esc_attr( $value ); ?>"
					id="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>"
					name="<?php echo esc_attr( "_customize-radio-{$this->id}" ); ?>"
					<?php checked( $this->value(), $value ); ?>
				/>

				<label for="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>">
					<?php echo esc_html( $label ); ?>
				</label>
				<?php
			endforeach;
			?>
		</div>
		<?php
	}
}
