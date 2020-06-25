/**
 * Customizer enhancements for a better user experience.
 *
 * Contains extra logic for our Customizer controls & settings.
 *
 * @since 1.0.0
 */

/* global jQuery, materialThemeColorControls */

( function( $ ) {
	const api = wp.customize;
	const parentApi = window.parent.wp.customize;

	Object.keys( materialThemeColorControls ).forEach( control => {
		api( control, value => value.bind( generatePreviewStyles ) );
	} );

	// Site title and description.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	api( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );

	// Archive width
	api( 'material_archive_width', function( value ) {
		value.bind( function( to ) {
			if ( 'wide' === to ) {
				$( '.content-area' ).removeClass( 'material-archive__normal' );
				$( '.content-area' ).addClass( 'material-archive__wide' );
			} else {
				$( '.content-area' ).removeClass( 'material-archive__wide' );
				$( '.content-area' ).addClass( 'material-archive__normal' );
			}
		} );
	} );

	/**
	 * Add styles to elements in the preview pane.
	 *
	 * @since 1.0.0
	 *
	 * @return {void}
	 */
	const generatePreviewStyles = () => {
		const stylesheetID = 'material-customizer-preview-styles';
		let stylesheet = $( '#' + stylesheetID ),
			styles = '';

		// If the stylesheet doesn't exist, create it and append it to <head>.
		if ( ! stylesheet.length ) {
			$( 'head' ).append( '<style id="' + stylesheetID + '"></style>' );
			stylesheet = $( '#' + stylesheetID );
		}

		// Generate the styles.
		Object.keys( materialThemeColorControls ).forEach( control => {
			styles += `${ materialThemeColorControls[ control ] }: ${ parentApi(
				control
			).get() };`;

			if ( 'material_background_text_color' === control ) {
				const backgroundColor = parentApi( control ).get(),
					backgroundColorRgb = hexToRgb( backgroundColor ).join( ',' );
				styles += `${ materialThemeColorControls[ control ] }-rgb: ${ backgroundColorRgb };
					--mdc-theme-text-primary-on-background: rgba(--mdc-theme-on-background-rgb, 0.87);
					--mdc-theme-text-secondary-on-background: rgba(--mdc-theme-on-background-rgb, 0.54);
					--mdc-theme-text-hint-on-background: rgba(--mdc-theme-on-background-rgb, 0.38);
					--mdc-theme-text-disabled-on-background: rgba(--mdc-theme-on-background-rgb, 0.38);
					--mdc-theme-text-icon-on-background: rgba(--mdc-theme-on-background-rgb, 0.38);`;
			}
		} );

		styles = `:root {
			${ styles }
		}`;

		// Add styles.
		stylesheet.html( styles );
	};

	const hexToRgb = hex =>
		hex
			.replace(
				/^#?([a-f\d])([a-f\d])([a-f\d])$/i,
				( m, r, g, b ) => '#' + r + r + g + g + b + b
			)
			.substring( 1 )
			.match( /.{2}/g )
			.map( x => parseInt( x, 16 ) );
} )( jQuery );
