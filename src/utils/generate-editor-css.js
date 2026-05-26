export function generateEditorCss( blocks, breakpoints ) {
	const styles = [];

	function walk( items ) {
		items.forEach( ( block ) => {
			const attrs = block?.attributes || {};

			const cssId = attrs?.evitenicCssId;

			const cssMap = attrs?.evitenicBlockCSS;

			if ( cssId && cssMap ) {
				const wrapperClass = `.evitenic-css-${ cssId }`;

				Object.entries( cssMap ).forEach( ( [ breakpointId, css ] ) => {
					if ( ! css?.trim() ) {
						return;
					}

					const breakpoint = breakpoints.find(
						( item ) => item.id === breakpointId
					);

					if ( ! breakpoint ) {
						return;
					}

					const compiled = css.replaceAll( 'selector', wrapperClass );

					if ( breakpoint.type === 'base' ) {
						styles.push( compiled );

						return;
					}

					styles.push( `
@media (${ breakpoint.type }-width: ${ breakpoint.value }px) {
${ compiled }
}
` );
				} );
			}

			if ( block?.innerBlocks?.length ) {
				walk( block.innerBlocks );
			}
		} );
	}

	walk( blocks );

	return styles.join( '\\n' );
}
