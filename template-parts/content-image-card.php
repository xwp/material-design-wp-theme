<li class="mdc-image-list__item">
	<?php if ( has_post_thumbnail() ) : ?>
		<img class="mdc-image-list__image" src="<?php the_post_thumbnail_url(); ?>">
	<?php endif; ?>
	<div class="mdc-image-list__supporting">
		<span class="mdc-image-list__label"><?php the_title(); ?></span>
	</div>
</li>
