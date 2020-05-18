<?php
/**
 * Template part for post next/previous links.
 *
 * @package MaterialTheme
 */

$previous_link = get_previous_post_link( '%link' );
$next_link     = get_next_post_link( '%link' );

?>

<div class="post-navigation">
	<div class="post-navigation__previous">
		<?php if ( ! empty( $previous_link ) ) : ?>
			<i class="material-icons mdc-button__icon">arrow_back_ios</i>
			<?php echo $previous_link; // phpcs:ignore ?>
		<?php endif; ?>
	</div>

	<div class="post-navigation__next">
		<?php if ( ! empty( $next_link ) ) : ?>
			<?php echo $next_link; // phpcs:ignore ?>
			<i class="material-icons mdc-button__icon">arrow_forward_ios</i>
		<?php endif; ?>
	</div>
</div>
