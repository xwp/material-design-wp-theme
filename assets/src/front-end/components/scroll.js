export const scrollInit = () => {
	const topTrigger = document.getElementById( 'back-to-top' );

	if ( ! topTrigger ) {
		return;
	}

	topTrigger.addEventListener( 'click', scrollToTop );
};

const scrollToTop = () => {
	window.scroll( {
		top: 0,
		left: 0,
		behavior: 'smooth'
	} );
}