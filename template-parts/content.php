<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MaterialTheme
 */

$show_comments = get_theme_mod( 'material_archive_comments', true );
$show_author   = get_theme_mod( 'material_archive_author', true );
$show_excerpt  = get_theme_mod( 'material_archive_excerpt', true );
$show_date     = get_theme_mod( 'material_archive_date', true );
?>

<div id="<?php the_ID(); ?>" <?php post_class( 'mdc-card post-card' ); ?>>
	<div class="mdc-card__primary-action post-card__primary-action" tabindex="0">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="mdc-card__media mdc-card__media--16-9 post-card__media" style="background-image: url(&quot;<?php echo esc_attr( get_the_post_thumbnail_url() ); ?>&quot;);"></div>
		<?php endif; ?>
		<div class="post-card__primary">
			<?php the_title( '<h2 class="post-card__title mdc-typography mdc-typography--headline6"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<?php if ( ! empty( $show_date ) ) : ?>
				<h3 class="post-card__subtitle mdc-typography mdc-typography--subtitle2"><?php the_time( 'F j, Y' ); ?></h3>
			<?php endif; ?>
		</div>
		<?php if ( ! empty( $show_excerpt ) ) : ?>
			<div class="post-card__secondary mdc-typography mdc-typography--body2"><?php the_excerpt(); ?></div>
		<?php endif; ?>
	</div>
	<?php if ( ! empty( $show_author ) || ! empty( $show_comments ) ) : ?>
		<div class="mdc-card__actions">
			<div class="mdc-card__action-buttons">
				<?php if ( ! empty( $author ) ) : ?>
					<a
						class="mdc-button mdc-card__action mdc-card__action--button"
						href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
						aria-label="
							<?php
							printf(
								/* translators: 1: author name. */
								esc_attr__(
									'Author: %s',
									'material-theme'
								),
								esc_attr( get_the_author() )
							);
							?>
						"
					>
						<span class="mdc-button__ripple"></span>
						<i class="material-icons mdc-button__icon" aria-hidden="true">perm_identity</i>
						<?php the_author(); ?>
					</a>
				<?php endif; ?>

				<?php if ( ! empty( $comments ) ) : ?>
					<a href="<?php comments_link(); ?>" class="mdc-button mdc-card__action mdc-card__action--button">
						<span class="mdc-button__ripple"></span>
						<i class="material-icons mdc-button__icon" aria-hidden="true">comment</i>
						<?php
						echo esc_html(
							sprintf(
								/* translators: 1: comment count. */
								_nx( // phpcs:disable
									'One Comment', // phpcs:disable
									'%s Comments',
									get_comments_number(),
									'comments title',
									'material-theme'
								),
								number_format_i18n( get_comments_number() )
							)
						);
						?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
