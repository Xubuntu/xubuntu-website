jQuery( function( ) {
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