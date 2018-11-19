/**
 * File search.js.
 *
 * Handles toggling the search panel
 */
( function() {
	var container, button_open, button_close, search, input;

	container = document.getElementById( 'search-form-wrapper' );
	if ( ! container ) {
		return;
	}

	button_open = document.getElementById( 'search-toggle' );
	if ( 'undefined' === typeof button_open ) {
		return;
	}

	button_close = document.getElementById( 'search-close' );
	if ( 'undefined' === typeof button_close ) {
		return;
	}

	search = document.getElementsByClassName( 'search-form' )[0];

	input = container.getElementsByClassName('search-field')[0];

	search.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === search.className.indexOf( 'search-form' ) ) {
		search.className += ' search-form';
	}

	button_open.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button_open.setAttribute( 'aria-expanded', 'false' );
			search.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button_open.setAttribute( 'aria-expanded', 'true' );
			search.setAttribute( 'aria-expanded', 'true' );
			input.focus();
		}
	};

	button_close.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button_open.setAttribute( 'aria-expanded', 'false' );
			search.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button_open.setAttribute( 'aria-expanded', 'true' );
			search.setAttribute( 'aria-expanded', 'true' );
		}
	};

} )();
