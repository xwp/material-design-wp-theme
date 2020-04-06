<?php
global $wp_query;

$current = absint( max( 1, get_query_var( 'paged' ) ) );
$total   = absint( $wp_query->max_num_pages );

if ( $total <= 1 ) {
	return;
}

$links = [
	[
		'link'  => 1 === $current ? false : get_pagenum_link( 1 ),
		'icon'  => 'first_page',
		'title' => __( 'First', 'material-theme' ),
	],
	[
		'link'  => $current <= 1 ? false : get_pagenum_link( $current - 1 ),
		'icon'  => 'chevron_left',
		'title' => __( 'Previous', 'material-theme' ),
	],
	[
		'link'  => $current >= $total ? false : get_pagenum_link( $current + 1 ),
		'icon'  => 'chevron_right',
		'title' => __( 'Next', 'material-theme' ),
	],
	[
		'link'  => $total === $current ? false : get_pagenum_link( $total ),
		'icon'  => 'last_page',
		'title' => __( 'Last', 'material-theme' ),
	],
];
?>

<ul class="mdc-page-navigation">
<?php foreach ( $links as $link ) : ?>
	<li>
		<?php if ( false !== $link['link'] ) : ?>
			<a href="<?php echo esc_url( $link['link'] ); ?>" title="<?php echo esc_html( $link['title'] ); ?>" class="mdc-ripple-surface">
				<span class="material-icons">
					<?php echo esc_html( $link['icon'] ); ?>
				</span>
			</a>
		<?php else : ?>
			<span class="material-icons" title="<?php echo esc_html( $link['title'] ); ?>">
				<?php echo esc_html( $link['icon'] ); ?>
			</span>
		<?php endif ?>
	</li>
<?php endforeach; ?>
</ul>
