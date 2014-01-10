	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); $post_num++; ?>

			<?php $post_class = "group post-order" . $post_num; ?>

			<div <?php post_class( $post_class ) ?> id="post-<?php the_ID(); ?>">
				<?php if( !is_front_page( ) ) { ?>
					<h1 class="post-title"><?php the_title( ); ?></h1>
				<?php } ?>
				<?php /* post meta data */ ?>
				<?php if( !is_page( ) ) { ?>
					<div class="post-meta">
						<?php /* translators: php strftime() format */ ?>
						<span class="post-time"><?php print strftime( __( '%B %e, %Y', 'xubuntu' ), get_the_time( 'U' ) ); ?></span>
						&mdash;
						<span class="post-cat"><?php the_category( ', ' ); ?></span>
						<?php the_tags( '&mdash; <span class="post-tags">', ', ', '</span>' ); ?>
					</div>
				<?php } ?>
				<?php /* post itself */ ?>
				<div class="post-post">
					<div class="post-entry entry"><?php the_content( __( 'Read the rest of this entry »', 'xubuntu' ) ); ?></div>
				</div>
			</div>

		<?php endwhile; ?>
	<?php else : ?>
		<h1 class="post-title"><?php _e( 'Page Not Found', 'xubuntu' ); ?></h1>
		<p><?php _e( 'I\'m sorry, but you\'re looking for something that is not here.', 'xubuntu' ); ?></p>
	<?php endif; ?>
