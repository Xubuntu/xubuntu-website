jQuery( function( ) {
	// DROPDOWN MENU

	// Make sure submenus appear centered related to the main item when possible
	xubuntu_dropdown_menu_positioning( );

	// Update positioning on resizing
	jQuery( window ).resize( function( e ) {
		xubuntu_dropdown_menu_positioning( );
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

function xubuntu_dropdown_menu_positioning( ) {
	jQuery( '#navi .menu > li' ).each( function( e ) {
		var shift = ( jQuery( this ).children( '.sub-menu' ).outerWidth( ) - jQuery( this ).outerWidth( ) ) / 2;
		var right_border = jQuery( this ).offset( ).left + jQuery( this ).children( '.sub-menu' ).outerWidth( ) - shift;

		if( right_border > jQuery( window ).outerWidth( ) - 15 ) {
			// Submenu would overflow, we need to add offset
			var extra_offset = right_border - jQuery( window ).outerWidth( ) + 15 + shift;
			jQuery( this ).children( '.sub-menu' ).css( 'left', -extra_offset);
		} else if( jQuery( this ).offset( ).left - shift > 0 ) {
			// The submenu will fit the screen
			jQuery( this ).children( '.sub-menu' ).css( 'left', -shift );
		}
	} );
}