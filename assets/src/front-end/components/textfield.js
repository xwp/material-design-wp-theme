import { MDCTextField } from '@material/textfield';

export const textFieldInit = () => {
	const textFieldElements = document.querySelectorAll(
		'.mdc-text-field:not(.comment-field)'
	);

	if ( ! textFieldElements ) {
		return;
	}

	for ( const textFieldElement of textFieldElements ) {
		const input = new MDCTextField( textFieldElement );

		if ( input.trailingIcon_ ) {
			input.trailingIcon_.root_.addEventListener( 'click', handleClick );
			input.trailingIcon_.root_.addEventListener( 'keydown', handleKeydown );
			input.trailingIcon_.root_.addEventListener( 'keyup', handleKeyup );
		}
	}
};

/**
 * Submit form when clicking icon
 *
 * @param {*} event Triggered event
 */
const handleClick = event => {
	if ( 'button' !== event.currentTarget.getAttribute( 'role' ) ) {
		return;
	}

	submitForm( event );
};

/**
 * Handle space and enter keys
 * Prevent space from scrolling page
 *
 * @param {*} event Triggered event
 */
const handleKeydown = event => {
	if ( 'Space' === event.code || 32 === event.keyCode ) {
		event.preventDefault();
	}

	if ( 'Enter' === event.code || 13 === event.keyCode ) {
		submitForm( event );
	}
};

/**
 * Trigger form with space key
 *
 * @param {*} event Triggered event
 */
const handleKeyup = event => {
	if ( 'Space' === event.code || 32 === event.keyCode ) {
		event.preventDefault();
		submitForm( event );
	}
};

/**
 * Submit form if available
 *
 * @param {*} event Previously triggered event
 */
const submitForm = event => {
	const { currentTarget } = event;
	const form = currentTarget.closest( 'form' );

	if ( ! form ) {
		return;
	}

	form.submit();
};
