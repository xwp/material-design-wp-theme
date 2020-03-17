import { MDCTopAppBar } from '@material/top-app-bar';

export const topAppBarInit = () => {
	const topAppBarElement = document.querySelector( '.mdc-top-app-bar' );

	if ( ! topAppBarElement ) {
		return;
	}

	return new MDCTopAppBar( topAppBarElement );
};
