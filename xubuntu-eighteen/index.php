<?php get_header( ); ?>

<section id="middle" class="group">
	<section id="content" class="group">
		<main id="main" class="the-group">
			<?php
				if( is_search( ) ) {
					get_template_part( 'content', 'search' );
				} elseif( is_tax( 'release' ) ) {
					get_template_part( 'content', 'release' );
				} elseif( is_attachment( ) ) {
					get_template_part( 'content', 'attachment' );
				} elseif( is_page_template( 'template-releases-landing.php' ) ) {
					get_template_part( 'content', 'releases-landing' );
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
		</main>
		<?php
			if( is_tax( 'release' ) || is_page_template( 'template-releases-landing.php' ) ) {
				get_template_part( 'widgets', 'release' );
			} elseif( is_blog( ) || is_search( ) ) {
				get_template_part( 'widgets', 'blog' );
			}
		?>
	</section>
	<?php if( is_front_page( ) ) { get_template_part( 'widgets', 'front' ); } ?>
</section>

<?php get_footer( ); ?>