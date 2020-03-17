import { MDCDrawer } from '@material/drawer';

export const drawerInit = () => {
	const drawerElements = document.querySelectorAll( '.mdc-drawer' );

	if ( ! drawerElements ) {
		return;
	}

	for ( drawer of drawerElements ) {
		new MDCDrawer( drawer );
	}
};
