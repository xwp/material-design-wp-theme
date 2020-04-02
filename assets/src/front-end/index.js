import { topAppBarInit } from './components/top-app-bar';
import { drawerInit, drawerHandler } from './components/drawer';
import { scrollInit } from './components/scroll';
import rippleInit from './components/ripple';
import { textFieldInit } from './components/textfield';
import { commentsInit } from './components/comments';

document.addEventListener( 'DOMContentLoaded', () => {
	const topAppBar = topAppBarInit();
	const drawer = drawerInit();
	scrollInit();

	if ( topAppBar && drawer ) {
		drawerHandler( topAppBar, drawer );
	}

	textFieldInit();
	rippleInit();
	commentsInit();
} );
