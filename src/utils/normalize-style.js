export function normalizeStyles( value ) {
	return value && typeof value === 'object' ? value : {};
}
