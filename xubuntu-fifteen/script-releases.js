jQuery( function( ) {
	jQuery( '.show-on-js' ).show( );

	/* Release list */
	jQuery( '.releases .eol' ).hide( );
	jQuery( '.releases .show-eol' ).click( function( ) {
		jQuery( this ).hide( );
		jQuery( '.releases .eol' ).fadeIn( );
	} );

	/* Release list (admin) */
	jQuery( '.releases .eol input:checked' ).closest( '.eol' ).show( );

	/* Mirror list */
	jQuery( '.mirrors .secondary' ).hide( );
	jQuery( '.mirrors .show-all' ).click( function( ) {
		jQuery( this ).hide( );
		jQuery( this ).closest( '.mirrors' ).addClass( 'expanded' );
		jQuery( this ).closest( '.mirrors' ).children( '.secondary' ).fadeIn( );
	} );
} );