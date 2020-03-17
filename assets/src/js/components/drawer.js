import { MDCList } from '@material/list';

export const listInit = () => {
	const listElements = document.querySelectorAll( '.mdc-list' );

	if ( ! listElements ) {
		return;
	}

	for ( list of listElements ) {
		new MDCList( list );
	}
};
