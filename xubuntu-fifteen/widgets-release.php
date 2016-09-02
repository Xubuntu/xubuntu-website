<?php
	if( function_exists( 'dynamic_sidebar' ) && is_active_sidebar( 'release_widgets' ) ) {
		?><aside id="sidebar">
			<?php dynamic_sidebar( 'release_widgets' ); ?>
		</aside><?php
	}
?>