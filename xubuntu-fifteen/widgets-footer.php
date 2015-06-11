<?php
	if( function_exists( 'dynamic_sidebar' ) ) {
		if( is_active_sidebar( 'footer-widgets' ) ) {
			?><div id="footer_widgets" class="widgets_flex"><div class="widgets group"><?php dynamic_sidebar( 'footer-widgets' ); ?></div></div><?php
		}

		wp_nav_menu( array(
			'theme_location' => 'footer_navigation',
			'container_id' => 'footer_navi',
			'container_class' => 'group navigation nh',
			'fallback_cb' => false
		) );

		if( is_active_sidebar( 'footer-widgets-2' ) ) {
			?><div id="footer_widgets_2" class="widgets group"><?php dynamic_sidebar( 'footer-widgets-2' ); ?></div><?php
		}
	}
?>