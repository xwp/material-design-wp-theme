<?php
/**
 * Class Walker_Comment.
 *
 * Included for compatibility.
 * When available, use the plugin
 *
 * @package MaterialTheme
 */

namespace MaterialTheme;

/**
 * Walker_Comment.
 */
class Walker_Comment extends \Walker_Comment {
	/**
	 * Outputs a comment in the HTML5 format and uses material classes.
	 *
	 * @since 1.0.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter = wp_get_current_commenter();
		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.', 'material-theme' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.', 'material-theme' );
		}

		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="comment-author-avatar">
					<?php if ( 0 != $args['avatar_size'] ) : ?>
						<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php endif; ?>
				</div><!-- .comment-author-avatar -->

				<div class="comment-content">
					<h5 class="comment-author mdc-typography--headline5">
						<?php echo get_comment_author_link( $comment ); ?>
					</h5>

					<div class="comment-meta mdc-typography--subtitle1">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php
								/* translators: 1: Comment date, 2: Comment time. */
								printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
							?>
						</time>
						<?php edit_comment_link( __( 'Edit', 'material-theme' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<em class="comment-awaiting-moderation mdc-typography--caption"><?php echo $moderation_note; ?></em>
					<?php endif; ?>

					<div class="comment-content">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<div class="reply">',
								'after'     => '</div>',
							)
						)
					);
					?>

				</div> <!-- .comment-content -->
			</article><!-- .comment-body -->
		<?php
	}
}