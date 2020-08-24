import { MDCTabBar } from '@material/tab-bar';

export const tabBarInit = () => {
	const tabBarElements = document.querySelectorAll( '.mdc-tab-bar' );

	if ( ! tabBarElements ) {
		return;
	}

	for ( const tabBarElement of tabBarElements ) {
		const tabBar = new MDCTabBar( tabBarElement );
		const activeTab = tabBarElement.querySelector( '.mdc-tab--active' );

		if ( activeTab ) {
			tabBar.foundation_.scrollIntoView(
				tabBar.foundation_.adapter_.getIndexOfTabById( activeTab.id )
			);
		}
	}
};
