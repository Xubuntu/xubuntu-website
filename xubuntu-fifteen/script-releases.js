jQuery( function( ) {
	jQuery( '.show-on-js' ).show( );

	jQuery( '.releases .eol' ).hide( );
	jQuery( '.releases .show-eol' ).click( function( ) {
		jQuery( this ).hide( );
		jQuery( '.releases .eol' ).fadeIn( );
	} );

	/* Admin */
	jQuery( '.releases .eol input:checked' ).closest( '.eol' ).show( );
} );