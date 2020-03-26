<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material-theme-wp
 */

if ( has_post_thumbnail() ) {
	$thumbnail = get_the_post_thumbnail_url();
} else {
	$thumbnail = get_template_directory_uri() . '/assets/images/placeholder.png';
}
?>

<div id="<?php the_ID(); ?>" <?php post_class( 'mdc-card post-card' ); ?>>
	<div class="mdc-card__primary-action post-card__primary-action" tabindex="0">
		<div class="mdc-card__media mdc-card__media--16-9 post-card__media" style="background-image: url(&quot;<?php esc_attr( $thumbnail ); ?>&quot;);"></div>
    	<div class="post-card__primary">
			<?php the_title( '<h2 class="post-card__title mdc-typography mdc-typography--headline6"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
      		<h3 class="post-card__subtitle mdc-typography mdc-typography--subtitle2"><?php the_time( 'F j, Y' ); ?></h3>
    	</div>
    	<div class="post-card__secondary mdc-typography mdc-typography--body2"><?php the_excerpt(); ?></div>
  	</div>
  	<div class="mdc-card__actions">
    	<div class="mdc-card__action-buttons">
			<a class="mdc-button mdc-card__action mdc-card__action--button" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
				<span class="mdc-button__ripple"></span>
				<i class="material-icons mdc-button__icon" aria-hidden="true">perm_identity</i>
				<?php the_author(); ?>
			</a>

			<a href="<?php comments_link(); ?>" class="mdc-button mdc-card__action mdc-card__action--button">
				<span class="mdc-button__ripple"></span>
				<i class="material-icons-outlined mdc-button__icon" aria-hidden="true">comment</i>
				<?php
				printf(
					_nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'material-theme-wp' ),
					number_format_i18n( get_comments_number() )
				);
				?>
			</a>
		</div>
	</div>
</div>
