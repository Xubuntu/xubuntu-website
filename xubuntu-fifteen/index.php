<?php get_header( ); ?>

<div id="content_outer">
	<div id="content" class="group">
		<div id="main" class="group">
			<?php
				if( is_search( ) ) {
					get_template_part( 'content', 'search' );
				} elseif( have_posts( ) && !is_404( ) ) {
					if( is_archive( ) ) {
						get_template_part( 'content', 'archive' );
					} else {
						get_template_part( 'content', get_post_format( ) );
					}
				} else {
					?>
					<h1 class="post-title"><?php _e( 'Page Not Found', 'xubuntu' ); ?></h1>
					<div class="post-post">
						<p><?php _e( 'I\'m sorry, but you\'re looking for something that is not here.', 'xubuntu' ); ?></p>
					</div>
					<?php
				}
			?>
		</div>
		<?php if( is_blog( ) || is_search( ) ) { get_template_part( 'widgets', 'blog' ); } ?>
	</div>
	<?php if( is_front_page( ) ) { get_template_part( 'widgets', 'front' ); } ?>
</div>

<?php get_footer( ); ?>