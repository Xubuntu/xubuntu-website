jQuery( function( ) {
	// DROPDOWN MENU

	// Make sure submenus do not overlap window area
	jQuery( '#navi .menu > li' ).hover( function( e ) {
		var current = jQuery( this );
		var current_sub = current.children( '.sub-menu' );
		var page_padding = jQuery( '#navi' ).offset( ).left;

		var shift = ( current_sub.outerWidth( ) - current.outerWidth( ) ) / 2;
		var right_border = current.offset( ).left + current_sub.outerWidth( ) - shift;

		if( right_border > jQuery( window ).outerWidth( ) - page_padding ) {
			// The submenu would overflow in the right side
			var extra_offset = right_border - jQuery( window ).outerWidth( ) + page_padding + shift;
			current_sub.css( 'left', -extra_offset);
		} else if( current.offset( ).left - shift < 0 ) {
			// The submenu would overflow in the left side
			current_sub.css( 'left', '-2px' );
		} else {
			// The submenu will fit the screen when centered
			// Commenting this line keeps menus left-aligned
			//current_sub.css( 'left', -shift );
		}
	} );


	// MOBILE MENU

	// Toggle CSS class on menu opening/closing
	jQuery( '#navi' ).addClass( 'closed' );
	jQuery( '.navi_open_button' ).click( function( e ) {
		jQuery( '#navi' ).toggleClass( 'open closed' );
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

	// Stick menu to the top when scrolled down
	xubuntu_sticky_header( );

	jQuery( window ).scroll( function( e ) {
		xubuntu_sticky_header( );
	} );
} );

function xubuntu_sticky_header( ) {
	if( jQuery( window ).scrollTop( ) > ( jQuery( '#header' ).outerHeight( ) + jQuery( '#navi' ).outerHeight( ) ) ) {
		jQuery( '#header_outer' ).addClass( 'scrolled' );
	} else {
		jQuery( '#header_outer' ).removeClass( 'scrolled' );
	}
}

function xubuntu_scrolled( ) {
	if( jQuery( window ).width( ) < 600 ) {
		jQuery( '#header_outer' ).addClass( 'scrolled' );
	} else {
		jQuery( '#header_outer' ).removeClass( 'scrolled' );
	}
}