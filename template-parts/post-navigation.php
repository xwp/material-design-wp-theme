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
	<?php if ( ! empty( $previous_link ) ) : ?>
		<div class="post-navigation__previous">
			<i class="material-icons mdc-button__icon">arrow_back_ios</i>
			<?php echo $previous_link; // phpcs:ignore ?>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $next_link ) ) : ?>
		<div class="post-navigation__next">
			<i class="material-icons mdc-button__icon">arrow_forward_ios</i>
			<?php echo $next_link; // phpcs:ignore ?>
		</div>
	<?php endif; ?>
</div>
