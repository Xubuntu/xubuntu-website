<?php get_header( ); ?>

<div id="mainwrap">
	<div id="main">
		<?php
			if( is_archive( ) || is_home( ) ) {
				get_template_part( 'content', 'excerpts' );
			} else {
				get_template_part( 'content', get_post_format( ) );
			}
		?>
	</div>
</div>

<?php get_sidebar( ); ?>

<?php get_footer( ); ?>
