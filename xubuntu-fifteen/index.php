<?php get_header( ); ?>

<div id="content_outer">
	<div id="content" class="group">

		<div id="main_outer" class="group">
			<div id="main">
				<?php
					if( is_404( ) ) {
						?>
						<h1 class="post-title"><?php _e( 'Page Not Found', 'xubuntu' ); ?></h1>
						<div class="post-post">
							<p><?php _e( 'I\'m sorry, but you\'re looking for something that is not here.', 'xubuntu' ); ?></p>
						</div>
						<?php
					} elseif( is_archive( ) ) {
						get_template_part( 'content', 'titles' );
					} else {
						get_template_part( 'content', get_post_format( ) );
					}
				?>
			</div>
			<?php if( is_blog( ) ) { get_template_part( 'widgets', 'blog' ); } ?>
		</div>
	</div>
	<?php if( is_front_page( ) ) { get_template_part( 'widgets', 'front' ); } ?>
</div>

<?php get_footer( ); ?>