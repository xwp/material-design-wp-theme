<?php
/**
 * Archive card layout
 *
 * @package MaterialTheme
 */

$columns = 2;

?>

<div class="archive-cards masonry-grid layout-masonry-<?php echo esc_attr( $columns ); ?>">
	<?php
	// Divide posts into columns for masonry layout.
	$i            = 0;
	$column_items = [];

	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		// Buffer the post template output.
		ob_start();

		/*
		* Include the Post-Type-specific template for the content.
		* If you want to override this in a child theme, then include a file
		* called content-___.php (where ___ is the Post Type name) and that will be used instead.
		*/
		get_template_part( 'template-parts/content', get_post_type() );

		$col_index                   = $i % $columns;
		$column_items[ $col_index ]  = isset( $column_items[ $col_index ] ) ? $column_items[ $col_index ] : '';
		$column_items[ $col_index ] .= ob_get_clean();
		$i++;

	endwhile;

	// Build the output by combining all the generated columns with the column markup.
	?>
	<div class="masonry-grid_column">
		<?php echo implode( "</div>\n<div class='masonry-grid_column'>", $column_items ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</div>
