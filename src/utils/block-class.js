export function ensureBlockClass( className = '', cssId ) {
	const scopedClass = `evitenic-css-${ cssId }`;

	const classes = className
		.split( ' ' )
		.filter( ( item ) => ! item.startsWith( 'evitenic-css-' ) );

	if ( ! classes.includes( scopedClass ) ) {
		classes.push( scopedClass );
	}

	return classes.join( ' ' );
}
