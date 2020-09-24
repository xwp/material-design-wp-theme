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

import { MDCTextField } from '@material/textfield';

export const commentsInit = () => {
	const commentForm = document.querySelector( '#commentform' );
	if ( ! commentForm ) {
		return;
	}

	const fields = [];

	for ( const field of commentForm.querySelectorAll( '.mdc-text-field' ) ) {
		fields.push( new MDCTextField( field ) );
	}

	commentForm.addEventListener( 'submit', event => {
		let isValid = true;
		fields.forEach( field => {
			if ( field.required && ! field.valid ) {
				isValid = false;
				// Blur the field so error styles are rendered.
				field.foundation_.deactivateFocus();
			}
		} );

		if ( ! isValid ) {
			event.preventDefault();
		}
	} );
};
