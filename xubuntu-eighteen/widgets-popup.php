<?php
	if( function_exists( 'dynamic_sidebar' ) && is_active_sidebar( 'front_popup' ) ) {
		?><main id="front_popup">
			<?php dynamic_sidebar( 'front_popup' ); ?>
		</main><?php
	}
?>