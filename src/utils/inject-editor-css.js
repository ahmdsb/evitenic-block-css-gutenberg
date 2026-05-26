const STYLE_ID = 'evitenic-editor-css';

export function injectEditorCss( css ) {
	let style = document.getElementById( STYLE_ID );

	if ( ! style ) {
		style = document.createElement( 'style' );

		style.id = STYLE_ID;

		document.head.appendChild( style );
	}

	style.innerHTML = css;
}
