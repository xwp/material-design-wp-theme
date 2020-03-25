<?php
/**
 * Image list layout
 */
?>

<ul class="mdc-image-list mdc-image-list--masonry mdc-image-list--with-text-protection archive-image-list">
	<?php
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		/*
		* Include the Post-Type-specific template for the content.
		* If you want to override this in a child theme, then include a file
		* called content-___.php (where ___ is the Post Type name) and that will be used instead.
		*/
		get_template_part( 'template-parts/content-image-card', get_post_type() );

	endwhile;
	?>
</ul>
