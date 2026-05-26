import { makeCssId } from './css-id';

import { ensureBlockClass } from './block-class';

export function regenerateCssId( attributes, setAttributes ) {
	const nextId = makeCssId();

	const oldId = attributes?.evitenicCssId;

	const oldClass = oldId ? `evitenic-css-${ oldId }` : null;

	let className = attributes?.className || '';

	if ( oldClass ) {
		className = className
			.split( ' ' )
			.filter( ( item ) => item !== oldClass )
			.join( ' ' );
	}

	className = ensureBlockClass( className, nextId );

	setAttributes( {
		evitenicCssId: nextId,
		className,
	} );
}
