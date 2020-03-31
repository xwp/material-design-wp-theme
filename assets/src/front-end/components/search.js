class Search {
	constructor( element ) {
		if ( ! element ) {
			return;
		}

		this.element = element;
		this.trigger = element.querySelector( '.search__button' );
		this.showSearch = this.showSearch.bind( this );

		this.attachEvents();
	}

	attachEvents() {
		if ( ! this.trigger ) {
			return;
		}

		this.trigger.addEventListener( 'click', this.showSearch );
	}

	showSearch() {
		const input = this.element.querySelector( '.mdc-text-field__input' );

		this.element.classList.add( '-with-search' );

		if ( ! input ) {
			return;
		}

		input.focus();
	}
}

export default Search;
