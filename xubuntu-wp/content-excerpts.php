	<?php if (have_posts()) : ?>

		<?php print "<p class='archive-message'>" . __( 'You are browsing the articles archive.', 'xubuntu' ) . "</p>"; ?>

		<?php while (have_posts()) : the_post(); $post_num++; ?>

			<?php $post_class = "group post-order" . $post_num; ?>

			<div <?php post_class( $post_class ) ?> id="post-<?php the_ID( ); ?>">
				<?php if( !is_front_page( ) ) { ?>
					<h1 class="post-title"><a href="<?php the_permalink( ); ?>" rel="bookmark" title="<?php the_title( ); ?>"><?php the_title( ); ?></a></h1>
				<?php } ?>
				<div class="post-post">
					<div class="post-entry entry excerpt"><?php the_excerpt( ); ?></div>
				</div>
			</div>

		<?php endwhile; ?>
	<?php else : ?>
		<div class="notfound">
			<h3><?php _e( 'Page Not Found', 'xubuntu' ); ?></h3>
			<p><?php _e( 'I\'m sorry, but you\'re looking for something that is not here.', 'xubuntu' ); ?></p>
		</div>
	<?php endif; ?>
