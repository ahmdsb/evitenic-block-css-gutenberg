import { createHigherOrderComponent } from '@wordpress/compose';

export const withBlockEditorClass = createHigherOrderComponent(
	( BlockListBlock ) => {
		return ( props ) => {
			const cssId = props?.attributes?.evitenicCssId;

			if ( ! cssId ) {
				return <BlockListBlock { ...props } />;
			}

			return (
				<BlockListBlock
					{ ...props }
					className={
						`${ props.className || '' } ` +
						`evitenic-css-${ cssId }`
					}
				/>
			);
		};
	},

	'withBlockEditorClass'
);
