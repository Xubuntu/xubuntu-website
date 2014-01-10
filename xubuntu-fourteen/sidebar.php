<?php
	if( is_front_page( ) ) {
		/* Show photoslider */
		if( function_exists( 'dynamic_sidebar' ) ) {
			?><div id="sidebar" class="sidebar-front"><?php dynamic_sidebar( "xubuntu_front" ); ?></div><?php
		}

		/* Shows menu set to 'front-page' */
		wp_nav_menu( array(
			'theme_location' => 'front-page',
			'container_class' => 'group',
			'container_id' => 'xubuntu_front_menu',
			'fallback_cb' => false
		) );

		/* */
	} else {
		/* Not on the front page, output the general sidebar */
		if( function_exists( 'dynamic_sidebar' ) ) {
			?><div id="sidebar" class="sidebar-main"><?php dynamic_sidebar( "xubuntu_sidebar" ); ?></div><?php
		}
	}
?>