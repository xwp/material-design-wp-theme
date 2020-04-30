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
		}
	}
};

/**
 * Submit form when clicking icon
 * @param {*} event Triggered event
 */
const handleClick = event => {
	const { currentTarget } = event;
	const form = currentTarget.closest( 'form' );

	if ( 'button' === currentTarget.getAttribute( 'role' ) && form ) {
		form.submit();
	}
};
