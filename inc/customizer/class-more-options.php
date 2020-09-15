<?php
/**
 * Class More_Options.
 *
 * @package MaterialTheme
 */

namespace MaterialTheme\Customizer;

if ( ! class_exists( '\WP_Customize_Control' ) ) {
	return;
}

/**
 * Range Slider control.
 */
class More_Options extends \WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @var string
	 */
	public $type = 'more_options';

	/**
	 * Children controls.
	 *
	 * @var array
	 */
	public $controls = [];

	/**
	 * Displays the control content.
	 *
	 * @access public
	 * @return void
	 */
	public function render_content() {
		?>
		<div class="material-more_options" id="<?php echo esc_html( $this->id ); ?>">
			<a href="#" class="material-show-more-options"><?php esc_html_e( 'More Options', 'material-theme' ); ?></a>
			<a href="#" class="material-show-more-options less-options"><?php esc_html_e( 'Less Options', 'material-theme' ); ?></a>
		</div>
		<?php
	}

	/**
	 * Add our custom args for JSON output as params.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['controls'] = ! empty( $this->controls ) ? $this->controls : [];
	}
}
