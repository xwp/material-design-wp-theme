/* global materialThemeSlug */

/**
 * Customizer enhancements for a better user experience.
 *
 * Contains extra logic for our Customizer controls & settings.
 *
 * @since 1.0.0
 */

( api => {
	api.bind( 'ready', () => {
		const hideHeaderDescription = document.querySelector(
			'#customize-control-material_header_title_display'
		);

		const hideHeaderDescriptionEl = hideHeaderDescription.querySelector(
			'.description'
		);

		if ( hideHeaderDescription.querySelector( 'input:checked' ) ) {
			hideHeaderDescriptionEl.classList.add( '-display' );
		}

		api( `${ materialThemeSlug }_archive_layout` ).bind( value => {
			const isCardLayout = 'card' === value;

			const controls = [
				`${ materialThemeSlug }_archive_card_options`,
				`${ materialThemeSlug }_archive_comments`,
				`${ materialThemeSlug }_archive_author`,
				`${ materialThemeSlug }_archive_excerpt`,
				`${ materialThemeSlug }_archive_date`,
				`${ materialThemeSlug }_archive_outlined`,
			];
			controls.forEach( control =>
				api.control( control ).active.set( isCardLayout )
			);
		} );

		api( `${ materialThemeSlug }_header_title_display` ).bind( value => {
			if ( value ) {
				hideHeaderDescriptionEl.classList.add( '-display' );
			} else {
				hideHeaderDescriptionEl.classList.remove( '-display' );
			}
		} );
	} );
} )( wp.customize );
