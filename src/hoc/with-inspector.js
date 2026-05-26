import { Fragment, useEffect, useMemo, useState } from '@wordpress/element';

import { InspectorControls } from '@wordpress/block-editor';

import { PanelBody, SelectControl, Button, Modal } from '@wordpress/components';

import { createHigherOrderComponent } from '@wordpress/compose';

import CodeMirror from '@uiw/react-codemirror';

import { css } from '@codemirror/lang-css';

import { makeCssId } from '../utils/css-id';

import { ensureBlockClass } from '../utils/block-class';

import { regenerateCssId } from '../utils/regenerate-css-id';

import breakpoints from '../constants/breakpoint';

function getDefaultBreakpointId() {
	const base = breakpoints.find( ( item ) => item.type === 'base' );

	return base?.id || breakpoints?.[ 0 ]?.id || 'desktop';
}

function normalizeStyles( value ) {
	return value && typeof value === 'object' ? value : {};
}

function CodeField( { value, onChange, className } ) {
	return (
		<div className={ className }>
			<CodeMirror
				value={ value || '' }
				height="260px"
				extensions={ [ css() ] }
				onChange={ onChange }
			/>
		</div>
	);
}

export function withEvitenicInspector( BlockEdit ) {
	return createHigherOrderComponent(
		( props ) => {
			const { name, attributes, setAttributes } = props;

			const styles = normalizeStyles( attributes?.evitenicBlockCSS );

			const cssId = attributes?.evitenicCssId || '';

			const [ isModalOpen, setIsModalOpen ] = useState( false );

			const breakpointOptions = useMemo(
				() =>
					breakpoints.map( ( item ) => ( {
						label: item.value
							? `${ item.label } - ${ item.value }`
							: item.label,

						value: item.id,
					} ) ),
				[]
			);

			useEffect( () => {
				if ( ! cssId && setAttributes ) {
					const nextId = makeCssId();

					setAttributes( {
						evitenicCssId: nextId,

						className: ensureBlockClass(
							attributes?.className || '',

							nextId
						),
					} );
				}
			}, [ cssId, attributes?.className, setAttributes ] );

			useEffect( () => {
				const active = attributes?.evitenicActiveBreakpoint;

				const hasActive = breakpoints.some(
					( item ) => item.id === active
				);

				if ( ! hasActive && setAttributes ) {
					setAttributes( {
						evitenicActiveBreakpoint: getDefaultBreakpointId(),
					} );
				}
			}, [ attributes?.evitenicActiveBreakpoint, setAttributes ] );

			if ( ! name || ! setAttributes ) {
				return <BlockEdit { ...props } />;
			}

			const activeBreakpoint =
				attributes?.evitenicActiveBreakpoint ||
				getDefaultBreakpointId();

			const currentCss = styles[ activeBreakpoint ] || '';

			function updateCss( nextValue ) {
				setAttributes( {
					evitenicBlockCSS: {
						...styles,

						[ activeBreakpoint ]: nextValue,
					},
				} );
			}

			function clearBreakpoint() {
				const nextStyles = {
					...styles,
				};

				delete nextStyles[ activeBreakpoint ];

				setAttributes( {
					evitenicBlockCSS: nextStyles,
				} );
			}

			function onBreakpointChange( nextBreakpoint ) {
				setAttributes( {
					evitenicActiveBreakpoint: nextBreakpoint,
				} );
			}

			return (
				<Fragment>
					<BlockEdit { ...props } />

					<InspectorControls>
						<PanelBody title="Evitenic Block CSS" initialOpen>
							<div className="evitenic-css-toolbar">
								<SelectControl
									label="Breakpoint"
									value={ activeBreakpoint }
									options={ breakpointOptions }
									onChange={ onBreakpointChange }
								/>

								<Button
									variant="secondary"
									icon="fullscreen-alt"
									label="Fullscreen"
									onClick={ () => setIsModalOpen( true ) }
								/>
							</div>

							<p
								style={ {
									fontSize: '12px',
									opacity: 0.7,
									marginTop: '16px',
								} }
							>
								Scoped ID: <code>{ cssId }</code>
							</p>

							<CodeField
								value={ currentCss }
								onChange={ updateCss }
								className="evitenic-code-editor"
							/>

							<div className="evitenic-css-actions">
								<Button
									variant="secondary"
									onClick={ clearBreakpoint }
								>
									Clear breakpoint
								</Button>

								<Button
									variant="tertiary"
									onClick={ () => {
										regenerateCssId(
											attributes,
											setAttributes
										);
									} }
								>
									Regenerate ID
								</Button>
							</div>
						</PanelBody>
					</InspectorControls>

					{ isModalOpen && (
						<Modal
							title="Edit CSS"
							size="large"
							onRequestClose={ () => setIsModalOpen( false ) }
						>
							<div className="evitenic-css-modal">
								<SelectControl
									label="Breakpoint"
									value={ activeBreakpoint }
									options={ breakpointOptions }
									onChange={ onBreakpointChange }
								/>

								<CodeMirror
									value={ currentCss }
									extensions={ [ css() ] }
									onChange={ updateCss }
								/>

								<div className="evitenic-css-modal-actions">
									<Button
										variant="secondary"
										onClick={ clearBreakpoint }
									>
										Clear breakpoint
									</Button>

									<Button
										variant="primary"
										onClick={ () =>
											setIsModalOpen( false )
										}
									>
										Done
									</Button>
								</div>
							</div>
						</Modal>
					) }
				</Fragment>
			);
		},

		'withEvitenicInspector'
	);
}
