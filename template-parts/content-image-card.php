<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaterialTheme
 */

if ( has_post_thumbnail() ) {
	$thumbnail = get_the_post_thumbnail_url();
} else {
	$thumbnail = get_template_directory_uri() . '/assets/images/placeholder.png';
}
?>

<li class="mdc-image-list__item">
	<a href="<?php the_permalink(); ?>">
		<img class="mdc-image-list__image" src="<?php echo esc_url( $thumbnail ); ?>">
	</a>
	<div class="mdc-image-list__supporting">
		<a href="<?php the_permalink(); ?>" class="mdc-image-list__label">
			<?php the_title(); ?>
		</a>
	</div>
</li>
