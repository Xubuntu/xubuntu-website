<div id="footer_outer" class="group">
	<div id="footer">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'main_navigation',
				'container_class' => 'group navigation nh',
				'container_id' => 'fbnavi',
				'fallback_cb' => false
			) );

			if( function_exists( 'dynamic_sidebar' ) ) {
				dynamic_sidebar( 'footer' );
			}
		?>
		<?php wp_footer( ); ?>
	</div>
</div>

</body>
</html>
