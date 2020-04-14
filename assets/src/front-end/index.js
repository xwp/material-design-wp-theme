import { topAppBarInit } from './components/top-app-bar';
import { drawerInit, drawerHandler } from './components/drawer';
import { scrollInit } from './components/scroll';
import rippleInit from './components/ripple';
import { textFieldInit } from './components/textfield';
import { commentsInit } from './components/comments';
import { floatingLabelInit } from './components/floating-label';
import { tabBarInit } from './components/tab-bar';
import './components/navigation';
import './components/skip-link-focus-fix';

document.addEventListener( 'DOMContentLoaded', () => {
	const topAppBar = topAppBarInit();
	const drawer = drawerInit();

	if ( topAppBar && drawer ) {
		drawerHandler( topAppBar, drawer );
	}

	scrollInit();
	textFieldInit();
	floatingLabelInit();
	tabBarInit();
	textFieldInit();
	rippleInit();
	commentsInit();
} );
