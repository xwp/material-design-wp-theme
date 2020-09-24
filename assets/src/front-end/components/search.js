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

/**
 * Shows / Hides search box at the top of the page
 */
class Search {
	/**
	 * Store elements
	 *
	 * @param {*} element
	 */
	constructor( element ) {
		if ( ! element ) {
			return;
		}

		this.element = element;
		this.trigger = element.querySelector( '.search__button' );
		this.backTrigger = element.querySelector( '.button__back' );
		this.showSearch = this.showSearch.bind( this );
		this.hideSearch = this.hideSearch.bind( this );

		this.attachEvents();
	}

	/**
	 * Add events to trigger and hide search
	 */
	attachEvents() {
		if ( ! this.trigger ) {
			return;
		}

		this.trigger.addEventListener( 'click', this.showSearch );

		if ( ! this.backTrigger ) {
			return;
		}

		this.backTrigger.addEventListener( 'click', this.hideSearch );
	}

	/**
	 * Show search
	 */
	showSearch() {
		const input = this.element.querySelector( '.mdc-text-field__input' );

		this.element.classList.add( '-with-search' );

		if ( ! input ) {
			return;
		}

		input.focus();
	}

	/**
	 * Hide search
	 */
	hideSearch() {
		this.element.classList.remove( '-with-search' );
	}
}

export default Search;
