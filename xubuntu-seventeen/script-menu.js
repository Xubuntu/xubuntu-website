jQuery( function( ) {
	// DROPDOWN MENU

	// Make sure submenus do not overlap window area
	jQuery( '#navi .menu > li' ).hover( function( e ) {
		var current = jQuery( this );
		var current_sub = current.children( '.sub-menu' );
		var page_padding = jQuery( '#navi' ).offset( ).left;

		var shift = ( current_sub.outerWidth( ) - current.outerWidth( ) ) / 2;
		// TODO: Adding 15 to the following fixes an overlapping submenu - why?
		var right_border = current.offset( ).left + current_sub.outerWidth( ) - shift;

		if( right_border > jQuery( window ).outerWidth( ) - page_padding ) {
			// The submenu would overflow in the right side
			var extra_offset = right_border - jQuery( window ).outerWidth( ) + page_padding + shift;
			current_sub.css( 'left', -extra_offset);
		} else if( current.offset( ).left - shift < 0 ) {
			// The submenu would overflow in the left side
			current_sub.css( 'left', '-2px' );
		}
	} );

	// Stick menu to the top when scrolled down
	xubuntu_sticky_header( );

	jQuery( window ).scroll( function( e ) {
		xubuntu_sticky_header( );
	} );
} );

function xubuntu_sticky_header( ) {
	if( jQuery( window ).scrollTop( ) > ( jQuery( '#logo' ).outerHeight( ) + jQuery( '#navi' ).outerHeight( ) ) ) {
		jQuery( 'header' ).addClass( 'scrolled' );
	} else {
		jQuery( 'header' ).removeClass( 'scrolled' );
	}
}