import { topAppBarInit } from './components/top-app-bar';
import { drawerInit, drawerHandler } from './components/drawer'

document.addEventListener( 'DOMContentLoaded', () => {
	const topAppBar = topAppBarInit();
	const drawer = drawerInit();

	if ( topAppBar && drawer ) {
		drawerHandler( topAppBar, drawer );
	}
} );
