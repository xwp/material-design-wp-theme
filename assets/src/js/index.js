import { topAppBarInit } from './components/top-app-bar';
import { drawerInit } from './components/drawer'

document.addEventListener( 'DOMContentLoaded', () => {
	const topBarApp = topAppBarInit();
	const drawer = drawerInit();

	if ( topBarApp && drawer ) {
		topBarApp.listen( 'MDCTopAppBar:nav', () => {
			drawer.open = !drawer.open;
		} );
	}
} );
