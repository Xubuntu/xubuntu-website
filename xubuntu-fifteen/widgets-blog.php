<?php
	if( function_exists( 'dynamic_sidebar' ) ) {
		?><div id="sidebar">
			<?php dynamic_sidebar( 'blog_navigation' ); ?>
		</div><?php
	}
?>