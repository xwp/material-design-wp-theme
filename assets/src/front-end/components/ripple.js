import { MDCRipple } from '@material/ripple';

const init = () => {
	const surface = document.querySelectorAll( '.mdc-ripple-surface' );
	if ( surface ) {
		[].forEach.call( surface, node => new MDCRipple( node ) );
	}
};

export default init;