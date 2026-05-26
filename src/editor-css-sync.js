import { subscribe, select } from '@wordpress/data';

import debounce from 'lodash.debounce';

import breakpoints from './constants/breakpoint';

import { generateEditorCss } from './utils/generate-editor-css';

import { injectEditorCss } from './utils/inject-editor-css';

let previous = '';

const render = debounce(
	() => {
		const blocks = select( 'core/block-editor' ).getBlocks();

		const css = generateEditorCss( blocks, breakpoints );

		if ( css === previous ) {
			return;
		}

		previous = css;

		injectEditorCss( css );
	},

	100
);

function waitForIframe( callback ) {
	const iframe = document.querySelector( 'iframe[name="editor-canvas"]' );

	if ( iframe ) {
		callback();
		return;
	}

	window.requestAnimationFrame( () => waitForIframe( callback ) );
}

waitForIframe( () => {
	render();

	subscribe( render );
} );
