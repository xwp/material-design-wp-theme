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

	commentForm.addEventListener( 'submit', ( event ) => {
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
}