<?php
	if( !is_404( ) ) {
		if( get_previous_posts_link() || get_next_posts_link() ) {
			?><div id="postnavi"><?php
			previous_posts_link( __( 'Newer posts', 'xubuntu' ) );
			if( get_previous_posts_link() && get_next_posts_link() ) { print "<br />"; }
		  	next_posts_link( __( 'Older posts', 'xubuntu' ) ); 
			?></div><?php
		}
	}
?>

<div id="wpfooter" class="group">
	<div id="footer-widgets">
		<?php if( function_exists( 'dynamic_sidebar' ) ) {
			dynamic_sidebar( "xubuntu_footer" );
		} ?>
		<?php wp_footer( ); ?>
	</div>
</div>

</div><!-- #wpcontent -->

</body>
</html>
