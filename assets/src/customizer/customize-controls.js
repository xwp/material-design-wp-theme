/**
 * Customizer enhancements for a better user experience.
 *
 * Contains extra logic for our Customizer controls & settings.
 *
 * @since 1.0.0
 */

( api => {
	api.bind( 'ready', () => {
		api( 'material_theme_builder_archive_layout' ).bind( value => {
			const isCardLayout = 'card' === value;

			const controls = [
				'material_theme_builder_archive_comments',
				'material_theme_builder_archive_author',
				'material_theme_builder_archive_excerpt',
				'material_theme_builder_archive_date',
				'material_theme_builder_archive_outlined',
			];

			controls.forEach( control =>
				api.control( control ).active.set( isCardLayout )
			);
		} );
	} );
} )( wp.customize );
