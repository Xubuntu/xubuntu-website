<?php
	if( function_exists( 'dynamic_sidebar' ) ) {
		$widget_areas = array( 'front', 'front-2', 'front-3' );

		foreach( $widget_areas as $area ) {
			if( is_active_sidebar( $area ) ) {
				?><div id="<?php echo $area; ?>" class="widgets_outer"><div class="widgets group"><?php dynamic_sidebar( $area ); ?></div></div><?php
			}
		}
	}
?>