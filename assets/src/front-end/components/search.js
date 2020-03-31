class Search {
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

	showSearch() {
		const input = this.element.querySelector( '.mdc-text-field__input' );

		this.element.classList.add( '-with-search' );

		if ( ! input ) {
			return;
		}

		input.focus();
	}

	hideSearch( event ) {
		this.element.classList.remove( '-with-search' );
	}
}

export default Search;
