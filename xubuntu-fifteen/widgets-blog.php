<?php
	if( function_exists( 'dynamic_sidebar' ) ) {
		?><div id="sidebar_outer"><div id="sidebar">
			<?php dynamic_sidebar( 'blog_navigation' ); ?>
		</div></div><?php
	}
?>