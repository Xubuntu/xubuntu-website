	<?php if (have_posts()) : ?>

		<?php
			if( is_archive( ) ) {
				if( is_category( ) ) {
					print "<h1 class='post-title'>" . single_cat_title( 'Archive: ', false ) . "</h1>";
				} elseif( is_tag( ) ) {
					print "<h1 class='post-title'>" . single_tag_title( 'Archive: ', false ) . "</h1>";
				} else {
					print "<h1 class='post-title'>" . __( 'Archive', 'xubuntu' ) . "</h1>";
				}
			}
		?>

		<div id="archive-posts">
			<ul>
				<?php while (have_posts()) : the_post(); $post_num++; ?>
				<li class="post-title">
					<span class="post-time"><?php print strftime( __( '%B %e, %Y', 'xubuntu' ), get_the_time( 'U' ) ); ?></span>
					<b><a href="<?php the_permalink( ); ?>" rel="bookmark" title="<?php the_title( ); ?>"><?php the_title( ); ?></a></b>
				</li>
			<?php endwhile; ?>
			</ul>
		</div>

	<?php else : ?>
		<h1 class="post-title"><?php _e( 'Page Not Found', 'xubuntu' ); ?></h1>
		<p><?php _e( 'I\'m sorry, but you\'re looking for something that is not here.', 'xubuntu' ); ?></p>
	<?php endif; ?>
