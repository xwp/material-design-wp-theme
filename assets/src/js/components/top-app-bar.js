import { MDCTopAppBar } from '@material/top-app-bar';

export const topAppBarInit = () => {
	const topAppBarElements = document.querySelectorAll( '.mdc-top-app-bar' );

	if ( ! topAppBarElements ) {
		return;
	}

	for ( topAppBar of topAppBarElements ) {
		new MDCTopAppBar( topAppBar );
	}
};
