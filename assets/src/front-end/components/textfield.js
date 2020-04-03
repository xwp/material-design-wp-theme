import { MDCTextField } from '@material/textfield';

export const textFieldInit = () => {
	const textFieldElements = document.querySelectorAll( '.mdc-text-field' );

	if ( ! textFieldElements ) {
		return;
	}

	for ( let textFieldElement of textFieldElements ) {
		new MDCTextField( textFieldElement );
	}
}