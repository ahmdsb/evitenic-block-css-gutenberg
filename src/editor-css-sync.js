import { subscribe, select } from '@wordpress/data';

import breakpoints from './constants/breakpoint';

import { generateEditorCss } from './utils/generate-editor-css';

import { injectEditorCss } from './utils/inject-editor-css';

let previous = '';

const update = () => {
	const blocks = select( 'core/block-editor' ).getBlocks();

	const css = generateEditorCss( blocks, breakpoints );

	if ( css === previous ) {
		return;
	}

	previous = css;

	injectEditorCss( css );
};

subscribe( update );
