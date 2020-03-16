import { MDCTopAppBar } from '@material/top-app-bar';

export const topAppBarInit = () => {
	const topAppBarElements = document.querySelectorAll( '.mdc-top-app-bar' );

	if ( ! topAppBarElements ) {
		return;
	}

	topAppBarElements.forEach( topAppBarElement => new MDCTopAppBar( topAppBarElement ) );
};
