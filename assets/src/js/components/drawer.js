import { MDCDrawer } from '@material/drawer';

export const drawerInit = () => {
	const drawerElement = document.querySelector( '.mdc-drawer' );

	if ( ! drawerElement ) {
		return;
	}

	return new MDCDrawer( drawerElement );
};
