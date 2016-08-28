<?php
	if( is_category( ) ) {
		echo '<h1 class="post-title">' . single_cat_title( 'Archive: ', false ) . '</h1>';
		if( category_description( ) ) {
			echo category_description( );
			echo '<h2>' . __( 'Articles', 'xubuntu' ) . '</h2>';
		}
	} elseif( is_tag( ) ) {
		echo '<h1 class="post-title">' . single_tag_title( 'Archive: ', false ) . '</h1>';
		if( tag_description( ) ) {
			echo tag_description( );
			echo '<h2>' . __( 'Articles', 'xubuntu' ) . '</h2>';
		}
	} else {
		echo '<h1 class="post-title">' . __( 'Archive', 'xubuntu' ) . '</h1>';
	}
?>
 
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