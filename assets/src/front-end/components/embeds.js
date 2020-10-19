const makeFit = () => {
	document
		.querySelectorAll( 'iframe, object, video' )
		.forEach( function( video ) {
			const container = video.parentNode;

			// Skip videos we want to ignore.
			if (
				video.classList.contains( 'intrinsic-ignore' ) ||
				video.parentNode.classList.contains( 'intrinsic-ignore' )
			) {
				return true;
			}

			if ( ! video.dataset.origwidth ) {
				// Get the video element proportions.
				video.setAttribute( 'data-origwidth', video.width );
				video.setAttribute( 'data-origheight', video.height );
			}

			const iTargetWidth = container.offsetWidth;

			// Get ratio from proportions.
			const ratio = iTargetWidth / video.dataset.origwidth;

			// Scale based on ratio, thus retaining proportions.
			video.style.width = iTargetWidth + 'px';
			video.style.height = video.dataset.origheight * ratio + 'px';
		} );
};

export const embedsInit = () => {
	makeFit();

	window.addEventListener( 'resize', makeFit );
};
