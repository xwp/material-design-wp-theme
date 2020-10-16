<?php
/**
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package MaterialDesign
 */

/**
 * Page navigation partial
 *
 * @package MaterialDesign
 */

global $wp_query;

$current = absint( max( 1, get_query_var( 'paged' ) ) );
$total   = absint( $wp_query->max_num_pages );

if ( $total <= 1 ) {
	return;
}

$links = [
	[
		'link'   => 1 === $current ? false : get_pagenum_link( 1 ),
		'icon'   => 'first_page',
		'title'  => __( 'First', 'material-design' ),
		'number' => 1,
	],
	[
		'link'   => $current <= 1 ? false : get_pagenum_link( $current - 1 ),
		'icon'   => 'chevron_left',
		'title'  => __( 'Previous', 'material-design' ),
		'number' => $current - 1,
	],
	[
		'link'   => $current >= $total ? false : get_pagenum_link( $current + 1 ),
		'icon'   => 'chevron_right',
		'title'  => __( 'Next', 'material-design' ),
		'number' => $current + 1,
	],
	[
		'link'   => $total === $current ? false : get_pagenum_link( $total ),
		'icon'   => 'last_page',
		'title'  => __( 'Last', 'material-design' ),
		'number' => $total,
	],
];
?>

<ul class="mdc-page-navigation">
<?php foreach ( $links as $link ) : // phpcs:ignore ?>
	<li>
		<?php if ( false !== $link['link'] ) : ?>
			<a
				href="<?php echo esc_url( $link['link'] ); ?>"
				title="
					<?php
					printf(
						/* translators: 1. Next page number. 2. total pages. */
						esc_attr__( 'Go to page %1$d of %2$d', 'material-design' ),
						absint( $link['number'] ),
						absint( $total )
					);
					?>
				"
				class="mdc-ripple-surface"
			>
				<span class="material-icons" aria-hidden="true">
					<?php echo esc_html( $link['icon'] ); ?>
				</span>
				<span class="screen-reader-text">
					<?php
						printf(
							/* translators: available page description. */
							esc_attr__( '%s page', 'material-design' ),
							esc_attr( $link['title'] )
						);
					?>
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
