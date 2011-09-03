<?php get_header( ); ?>

<div id="mainwrap">
	<div id="main">
		<?php include "tpl.php"; ?>
	</div>
</div>

<div id="sidebar">
	<?php
		if( function_exists( 'dynamic_sidebar' ) ) {
			if( is_front_page( ) ) {
				dynamic_sidebar( "xubuntu_home_sidebar" );
			} elseif( is_home( ) || is_archive( ) || is_single( ) ) {
				dynamic_sidebar( "xubuntu_archive_sidebar" );
			} else {
				dynamic_sidebar( "xubuntu_archive_sidebar" );
			}
		}
	?>
</div>

<?php get_footer( ); ?>
