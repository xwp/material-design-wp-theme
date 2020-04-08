<?php
/**
 * Custom menu walker
 * Adds Material Button to menu links
 *
 * @package MaterialTheme
 */

namespace MaterialTheme;

/**
 * Menu_Walker class
 */
class Menu_Walker extends \Walker {
	/**
	 * DB fields to use.
	 *
	 * @var array
	 */
	public $db_fields = array(
		'parent' => 'menu_item_parent',
		'id'     => 'db_id',
	);

	/**
	 * Add necessary classes to menu items
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param object $item   The data object.
	 * @param int    $depth  Depth of the item.
	 * @param array  $args   An array of additional arguments.
	 * @param int    $id     ID of the current item.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= sprintf(
			'<a href="%1$s" %2$s>%3$s</a>',
			esc_url( $item->url ),
			( get_the_ID() === absint( $item->object_id ) ) ? ' class="mdc-tab mdc-tab--active" aria-selected="true"' : ' class="mdc-tab"',
			$this->build_markup( $item )
		);
	}
	
	/**
	 * Add necessary markup to build tab
	 *
	 * @param  object $item The data object.
	 * @return string Markup to display
	 */
	private function build_markup( $item ) {
		$is_active = get_the_ID() === absint( $item->object_id );

		ob_start();
		?>
		<span class="mdc-tab__content">
			<span class="mdc-tab__text-label"><?php echo esc_html( $item->title ); ?></span>
		</span>

		<span 
			class="mdc-tab-indicator 
			<?php
			if ( $is_active ) {
				echo 'mdc-tab-indicator--active';
			}
			?>
		">
			<span class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
		</span>
		<span class="mdc-tab__ripple"></span>
		<?php

		return ob_get_clean();
	}
}
