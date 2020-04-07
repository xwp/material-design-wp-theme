import { MDCDrawer } from '@material/drawer';

const drawerElement = document.querySelector( '.mdc-drawer' );

export const drawerInit = () => {
	if ( ! drawerElement ) {
		return;
	}

	return new MDCDrawer( drawerElement );
};

export const drawerHandler = ( topAppBar, drawer ) => {
	topAppBar.listen( 'MDCTopAppBar:nav', () => {
		drawer.open = ! drawer.open;
	} );

	const listElement = drawerElement.querySelector( '.mdc-list' );
	const mainContentElement = document.querySelector( '.site-content' );

	listElement.addEventListener( 'click', () => {
		drawer.open = false;
	} );

	document.body.addEventListener( 'MDCDrawer:closed', () => {
		mainContentElement.querySelector( 'input, button' ).focus();
	} );
};
