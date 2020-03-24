import { MDCFloatingLabel } from '@material/floating-label';

export const floatingLabelInit = () => {
	const floatingLabels = document.querySelectorAll( '.mdc-floating-label' );

	if ( ! floatingLabels ) {
		return;
	}

	for ( let floatingLabel of floatingLabels ) {
		new MDCFloatingLabel( floatingLabel );
	}
};
