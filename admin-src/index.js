import './style.scss';

( function () {
	const list = document.getElementById( 'evitenic-breakpoints-list' );

	const addBtn = document.getElementById( 'evitenic-add-breakpoint' );

	const template = document.getElementById( 'evitenic-breakpoint-template' );

	if ( ! list || ! addBtn || ! template ) {
		return;
	}

	function renumber() {
		const rows = list.querySelectorAll( '.evitenic-breakpoint-row' );

		rows.forEach( ( row, index ) => {
			row.querySelectorAll( '[data-name]' ).forEach( ( field ) => {
				const name = field.getAttribute( 'data-name' );

				field.name = `evitenic_block_css_breakpoints[${ index }][${ name }]`;
			} );
		} );
	}

	function moveRow( row, direction ) {
		if ( direction === 'up' && row.previousElementSibling ) {
			list.insertBefore( row, row.previousElementSibling );
		}

		if ( direction === 'down' && row.nextElementSibling ) {
			list.insertBefore( row.nextElementSibling, row );
		}

		renumber();
	}

	addBtn.addEventListener( 'click', () => {
		const index = list.querySelectorAll(
			'.evitenic-breakpoint-row'
		).length;

		const html = template.innerHTML.replace(
			/__INDEX__/g,
			String( index )
		);

		list.insertAdjacentHTML( 'beforeend', html );

		renumber();
	} );

	list.addEventListener( 'click', ( event ) => {
		const button = event.target.closest( 'button' );

		if ( ! button ) {
			return;
		}

		const row = button.closest( '.evitenic-breakpoint-row' );

		if ( ! row ) {
			return;
		}

		if ( button.classList.contains( 'evitenic-remove-row' ) ) {
			/* eslint-disable no-alert */
			const userResponse = window.confirm(
				'Are you sure you want to delete this breakpoint?'
			);
			/* eslint-enable no-alert */

			if ( userResponse ) {
				row.remove();

				renumber();
			}

			return;
		}

		if ( button.classList.contains( 'evitenic-move-up' ) ) {
			moveRow( row, 'up' );

			return;
		}

		if ( button.classList.contains( 'evitenic-move-down' ) ) {
			moveRow( row, 'down' );
		}
	} );

	renumber();
} )();
