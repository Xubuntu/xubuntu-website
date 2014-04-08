<div id="browse" class="group">
	<div class="left-column">
		<h4><?php _e( 'Browse by category' ); ?></h4>
		<ul>
		<?php
			foreach( get_categories( ) as $cat ) {	
				?><li><a href="<?php echo get_category_link( $cat->term_id ); ?>"><?php echo $cat->name; ?></a></li><?php
			}
		?>
		</ul>
	</div>
	<div class="right-column">
		<h4><?php _e( 'Browse by release/tag' ); ?></h4>
		<ul class="tags">
		<?php
			foreach( get_tags( ) as $tag ) {	
				?><li><a href="<?php echo get_tag_link( $tag->term_id ); ?>"><?php echo $tag->name; ?></a></li><?php
			}
		?>
		</ul>
	</div>
	<?php
		if( !is_home( ) ) { ?>
			<hr />
			<p class="more-link"><a href="<?php print get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e( 'Go to the blog starting page »', 'xubuntu' ); ?></a></p>
		<? }
	?>
</div>