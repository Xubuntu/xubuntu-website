<div id="postnavi">
	<?php
	if( get_previous_posts_link() || get_next_posts_link() ) {
		previous_posts_link( __( "Newer posts", 'xubuntu-wp' ) ); print "<br />";
	  	next_posts_link( __( "Older posts", 'xubuntu-wp' ) ); 
	}
	?>
</div>

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
