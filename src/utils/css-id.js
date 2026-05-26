export function makeCssId() {
	if ( window.crypto?.randomUUID ) {
		return window.crypto
			.randomUUID()
			.replace( /[^a-zA-Z0-9]/g, '' )
			.slice( 0, 12 )
			.toLowerCase();
	}

	return `evb${ Math.random().toString( 36 ).slice( 2, 10 ) }`;
}
