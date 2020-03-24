import { topAppBarInit } from './components/top-app-bar';
import { drawerInit, drawerHandler } from './components/drawer';
import { scrollInit } from './components/scroll';
import { floatingLabelInit } from './components/floating-label';

document.addEventListener( 'DOMContentLoaded', () => {
	const topAppBar = topAppBarInit();
	const drawer = drawerInit();
	scrollInit();
	floatingLabelInit();

	if ( topAppBar && drawer ) {
		drawerHandler( topAppBar, drawer );
	}
} );
