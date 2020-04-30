/* global MutationObserver */

import { MDCTopAppBar } from '@material/top-app-bar';
import search from './search';

export const topAppBarInit = () => {
	const topAppBarElement = document.querySelector( '.mdc-top-app-bar' );

	if ( ! topAppBarElement ) {
		return;
	}

	new search( topAppBarElement );

	setTopAppBarPosition();
	return new MDCTopAppBar( topAppBarElement );
};

/**
 * Set top app bar top position when WP admin bar is rendered.
 */
const setTopAppBarPosition = () => {
	const topAppBarElement = document.querySelector(
		'.admin-bar .mdc-top-app-bar'
	);

	if ( ! topAppBarElement ) {
		return;
	}

	const observer = new MutationObserver( mutations => {
		mutations.forEach( () => {
			let top = parseInt( topAppBarElement.style.top, 10 );
			if ( top >= -128 ) {
				top += 32; // WP admin bar height is 32px.
			}
			observer.disconnect();
			topAppBarElement.style.top = `${ top }px`;
			observe();
		} );
	} );

	const observe = () => {
		observer.observe( topAppBarElement, {
			attributes: true,
			attributeFilter: [ 'style' ],
		} );
	};
	observe();
};
