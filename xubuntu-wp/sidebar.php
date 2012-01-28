<div id="sidebar">
	<?php
		if( function_exists( 'dynamic_sidebar' ) ) {
			if( is_front_page( ) ) {
				// print picslide here
				echo do_shortcode( '[picslide size="450x450"]' );
				// dynamic_sidebar( "xubuntu_home_sidebar" );
			} else {
				dynamic_sidebar( "xubuntu_sidebar" );
			}
		}
	?>
</div>

<?php if( is_front_page( ) ) { ?>
	<div id="front_columns" class="group">
		<?php dynamic_sidebar( "xubuntu_front_columns" ); ?>
	</div>
<?php } ?>
