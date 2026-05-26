const STYLE_ID = 'evitenic-editor-css';

let styleElement = null;

function getEditorDocument() {
	const iframe = document.querySelector( 'iframe[name="editor-canvas"]' );

	if ( ! iframe ) {
		return null;
	}

	return iframe.contentDocument || iframe.contentWindow?.document;
}

export function injectEditorCss( css ) {
	const iframeDocument = getEditorDocument();

	if ( ! iframeDocument || ! iframeDocument.head ) {
		window.requestAnimationFrame( () => {
			injectEditorCss( css );
		} );

		return;
	}

	if ( ! styleElement || ! iframeDocument.contains( styleElement ) ) {
		styleElement = iframeDocument.getElementById( STYLE_ID );

		if ( ! styleElement ) {
			styleElement = iframeDocument.createElement( 'style' );

			styleElement.id = STYLE_ID;
		}
	}

	styleElement.textContent = css;

	iframeDocument.head.appendChild( styleElement );
}
