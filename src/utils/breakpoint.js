import breakpoints from '../constants/breakpoint';

export function getDefaultBreakpointId() {
	const base = breakpoints.find( ( item ) => item.type === 'base' );

	return base?.id || breakpoints[ 0 ]?.id || 'desktop';
}

export function getBreakpointOptions() {
	return breakpoints.map( ( item ) => ( {
		label: item.value ? `${ item.label } - ${ item.value }px` : item.label,

		value: item.id,
	} ) );
}
