import { MDCTabBar } from '@material/tab-bar';

export const tabBarInit = () => {
	const tabBarElements = document.querySelectorAll( '.mdc-tab-bar' );

	if ( ! tabBarElements ) {
		return;
	}

	for ( const tabBarElement of tabBarElements ) {
		new MDCTabBar( tabBarElement );
	}
};
