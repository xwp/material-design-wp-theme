<?php
/**
 * Decide which archive template to render
 *
 * @package MaterialTheme
 */

$archive_layout = get_theme_mod( 'material_archive_layout', 'card' );
$is_card_layout = 'card' === $archive_layout;

if ( $is_card_layout ) {
	get_template_part( 'template-parts/archive', 'card' );
} else {
	get_template_part( 'template-parts/archive', 'image-list' );
}
