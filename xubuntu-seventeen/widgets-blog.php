<?php
	if( function_exists( 'dynamic_sidebar' ) && is_active_sidebar( 'blog_navigation' ) ) {
		?><aside id="sidebar">
			<?php dynamic_sidebar( 'blog_navigation' ); ?>
		</aside><?php
	}
?>