<li class="mdc-image-list__item">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>">
			<img class="mdc-image-list__image" src="<?php the_post_thumbnail_url(); ?>">
		</a>
	<?php endif; ?>
	<div class="mdc-image-list__supporting">
		<a href="<?php the_permalink(); ?>" class="mdc-image-list__label">
			<?php the_title(); ?>
		</a>
	</div>
</li>
