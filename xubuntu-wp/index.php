<?php get_header( ); ?>

<div id="mainwrap">
	<div id="main">
		<?php
			if( is_404( ) ) {
				?>
				<h1 class="post-title"><?php _e( 'Page Not Found', 'xubuntu' ); ?></h1>
				<p><?php _e( 'I\'m sorry, but you\'re looking for something that is not here.', 'xubuntu' ); ?></p>
				<?php
			} elseif( is_archive( ) || is_home( ) ) {
				get_template_part( 'content', 'excerpts' );
			} else {
				get_template_part( 'content', get_post_format( ) );
			}
		?>
	</div>
</div>

<?php get_sidebar( ); ?>

<?php get_footer( ); ?>
