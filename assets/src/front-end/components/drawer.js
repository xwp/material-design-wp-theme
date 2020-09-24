/**
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

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

	listElement.addEventListener( 'click', () => {
		drawer.open = false;
	} );
};
