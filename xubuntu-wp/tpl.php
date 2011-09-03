	<?php if (have_posts()) : ?>

		<?php if( is_archive( ) || is_home( ) ) {
			print "<p class='archive-message'>" . __( "You are browsing the articles archive." ) . "</p>";
		}?>

		<?php while (have_posts()) : the_post(); $post_num++; ?>

			<?php $post_class = "group post-order" . $post_num; ?>

			<article>
			<div <?php post_class( $post_class ) ?> id="post-<?php the_ID(); ?>">
				<?php if( !is_front_page( ) ) { ?>
					<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
				<?php } ?>
				<?php /* post meta data */ ?>
				<?php if( !is_page( ) ) { ?>
					<div class="post-meta">
						<?php /* translators: php strftime() format */ ?>
						<span class="post-time"><?php print strftime( __( '%B %e, %Y', 'xubuntu-wp' ), get_the_time('U') ); ?></span>
						<?php if( !is_single() && !is_page() ) { ?><span class="comments">
							&mdash;
							<?php comments_popup_link( __( 'No comments' ), __( '1 comment' ), sprintf( __( '%1$s comments' ), "%" ) ); ?>
						</span><?php } ?>
						&mdash;
						<span class="post-cat"><?php the_category( ', ' ); ?></span>
						<?php the_tags( '&mdash; <span class="post-tags">', ', ', '</span>' ); ?>
					</div>
				<?php } ?>
				<?php /* post itself */ ?>
				<div class="post-post">
					<div class="post-entry entry"><?php the_content( __( 'Read the rest of this entry »', 'xubuntu-wp' ) ); ?></div>
				</div>
			</div>
			</article>

			<?php if( !is_page() ) { comments_template(); } ?>

		<?php endwhile; ?>
	<?php else : ?>
		<div class="notfound">
			<h3><?php _e( 'Page Not Found', 'xubuntu-wp' ); ?></h3>
			<p><?php _e( 'I\'m sorry, but you\'re looking for something that is not here.', 'xubuntu-wp' ); ?></p>
		</div>
	<?php endif; ?>
