jQuery( function( ) {
	// DROPDOWN MENU

	// Make sure submenus appear centered related to the main item when possible
	jQuery( '#navi .menu > li' ).hover( function( e ) {
		var current = jQuery( this );
		var current_sub = current.children( '.sub-menu' );

		var shift = ( current_sub.outerWidth( ) - current.outerWidth( ) ) / 2;
		var right_border = current.offset( ).left + current_sub.outerWidth( ) - shift;

		if( right_border > jQuery( window ).outerWidth( ) - 15 ) {
			// The submenu would overflow in the right side
			var extra_offset = right_border - jQuery( window ).outerWidth( ) + 15 + shift;
			current_sub.css( 'left', -extra_offset);
		} else if( current.offset( ).left - shift < 0 ) {
			// The submenu would overflow in the left side
			current_sub.css( 'left', '-2px' );
		} else {
			// The submenu will fit the screen when centered
			current_sub.css( 'left', -shift );
		}
	} );


	// MOBILE MENU

	// Toggle CSS class on menu opening/closing
	jQuery( '#opennavi' ).click( function( e ) {
		jQuery( '#navi' ).toggleClass( 'open' );
		jQuery( '#navi li' ).removeClass( 'current-menu-ancestor-hidden open-sub' );
		jQuery( '#navi li.current-menu-ancestor' ).addClass( 'open-sub' );
		e.preventDefault( );
	} );

	// Add expand-buttons for parent items
	jQuery( '#navi ul.menu > li' ).each( function( e ) {
		var expand_link = jQuery( '<a>', {
			class: 'expand',
			href: '#'
		} );
		expand_link.prependTo( jQuery( this ) );
	} );

	// Toggle submenus
	jQuery( '#navi .expand' ).click( function( e ) {
		var current_state = jQuery( this ).closest( 'li' ).hasClass( 'open-sub' );

		jQuery( '#navi li.current-menu-ancestor' ).addClass( 'current-menu-ancestor-hidden' );
		jQuery( '#navi li' ).removeClass( 'open-sub' );

		if( current_state == false ) {
			jQuery( this ).closest( 'li' ).addClass( 'open-sub' );
		}

		e.preventDefault( );
	} );
} );
