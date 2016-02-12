<h1 class="post-title"><?php printf( __( 'Search results for "%s"', 'xubuntu' ), $_GET['s'] ); ?></h1>

<?php if( have_posts( ) ) { ?> 
	<div id="archive-posts">
		<ul>
			<?php while( have_posts( ) ) { ?>
				<?php the_post( ); ?>
				<li class="post-title">
					<span class="post-time"><?php print strftime( __( '%B %e, %Y', 'xubuntu' ), get_the_time( 'U' ) ); ?></span>
					<b><a href="<?php the_permalink( ); ?>" rel="bookmark" title="<?php the_title( ); ?>"><?php the_title( ); ?></a></b>
				</li>
			<?php } ?>
		</ul>
	</div>
<?php } else { ?>
	<p><?php _e( 'No content found.', 'xubuntu' ); ?></p>
<?php } ?>

<h2><?php _e( 'Search again?', 'xubuntu' ); ?></h2>
<?php get_search_form( ); ?>
