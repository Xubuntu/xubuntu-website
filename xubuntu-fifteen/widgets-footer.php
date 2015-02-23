<?php
	if( function_exists( 'dynamic_sidebar' ) ) {
		?>
		<div id="footer-widgets" class="widgets_flex"><div class="widgets group"><?php dynamic_sidebar( 'footer-widgets' ); ?></div></div>
		<div id="footer-widgets-2" class="widgets group"><?php dynamic_sidebar( 'footer-widgets-2' ); ?></div>
		<?php
	}
?>