import breakpoints from '../constants/breakpoint';

function getDefaultBreakpointId() {
	const base = breakpoints.find( ( item ) => item.type === 'base' );

	return base?.id || breakpoints?.[ 0 ]?.id || 'desktop';
}

export function addBlockAttributes( settings ) {
	settings.attributes = {
		...settings.attributes,

		evitenicCssId: {
			type: 'string',
			default: '',
		},

		evitenicBlockCSS: {
			type: 'object',
			default: {},
		},

		evitenicActiveBreakpoint: {
			type: 'string',
			default: getDefaultBreakpointId(),
		},
	};

	return settings;
}
