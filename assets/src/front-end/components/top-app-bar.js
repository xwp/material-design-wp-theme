import { MDCTopAppBar } from '@material/top-app-bar';
import search from './search';

export const topAppBarInit = () => {
	const topAppBarElement = document.querySelector( '.mdc-top-app-bar' );

	if ( ! topAppBarElement ) {
		return;
	}

	new search( topAppBarElement );

	return new MDCTopAppBar( topAppBarElement );
};
