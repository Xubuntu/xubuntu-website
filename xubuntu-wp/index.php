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
				// print picslide here
				echo do_shortcode( '[picslide size="450x450"]' );
				// dynamic_sidebar( "xubuntu_home_sidebar" );
			} elseif( is_home( ) || is_archive( ) || is_single( ) ) {
				dynamic_sidebar( "xubuntu_archive_sidebar" );
			} else {
				dynamic_sidebar( "xubuntu_archive_sidebar" );
			}
		}
	?>
</div>

<?php if( is_front_page( ) ) { ?>
	<div id="front_columns" class="group">
		<?php dynamic_sidebar( "xubuntu_front_columns" ); ?>
	</div>
<?php } ?>

<?php get_footer( ); ?>
