import './style.scss';

import { addFilter } from '@wordpress/hooks';

import { addBlockAttributes } from './filters/attributes';

import { withEvitenicInspector } from './hoc/with-inspector';

import './editor-css-sync';

addFilter(
	'blocks.registerBlockType',

	'evitenic/block-css/attributes',

	addBlockAttributes
);

addFilter(
	'editor.BlockEdit',

	'evitenic/block-css/inspector',

	withEvitenicInspector
);
