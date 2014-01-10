<?php

	if( is_category( ) ) {
		/* Category archive front page */
		$tax = 'category';

		foreach( get_the_category( ) as $cat ) {
			$terms[] = $cat->term_id;
		}

		if( count( $terms ) > 1 ) {
			$title = __( 'More from these categories', 'xubuntu' );
		} else {
			$title = __( 'More from', 'xubuntu' ) . " " . single_cat_title( null, null );
			$more_link = get_category_link( $terms[0] ) . "page/2/";
			$more = __( 'See all articles from this category »', 'xubuntu' );
		}
	} elseif( is_tag( ) ) {
		/* Tag archive front page */
		$tax = 'tag';

		foreach( get_the_tags( ) as $tag ) {
			$terms[] = $tag->term_id;
		}

		if( count( $terms ) > 1 ) {
			$title = __( 'More from these tags', 'xubuntu' );
		} else {
			$title = __( 'More from', 'xubuntu' ) . " " . single_tag_title( null, null );
			$more_link = get_tag_link( $terms[0] ) . "page/2/";
			$more = __( 'See all articles for this tag »', 'xubuntu' );
		}
	} else {
		$title = __( 'Newest articles in the blog', 'xubuntu' );
	}

	if( $terms ) {
		$left_query = new WP_Query( array(
			'tax_query' => array( array(
				'taxonomy' => $tax,
				'field' => 'id',
				'terms' => $terms
			) )
		) );
	} else {
		$left_query = new WP_Query( array(
			'posts_per_page' => get_option( 'posts_per_page' )
		) );
	}

	# print_r( $left_query );

?>

<div id="browse" class="group">
	<div class="left-column">
		<h4><?php echo $title; ?></h4>
		<ul>
		<?php
			while( $left_query->have_posts( ) ) {
				$left_query->the_post( );
				?><li><a href="<?php the_permalink( ); ?>"><?php the_title( ); ?></a></li><?php
			}
		?>
		</ul>
		<?php if( $more ) { ?>
			<p class="more-link"><a href="<?php echo $more_link; ?>"><?php echo $more; ?></a></p>
		<?php } ?>
	</div>
	<div class="right-column">
		<h4><?php _e( 'Browse by category' ); ?></h4>
		<ul>
		<?php
			foreach( get_categories( ) as $cat ) {	
				?><li><a href="<?php echo get_category_link( $cat->term_id ); ?>"><?php echo $cat->name; ?></a></li><?php
			}
		?>
		</ul>
		<?php
			if( !is_home( ) ) { ?>
				<hr />
				<p class="more-link"><a href="<?php print get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e( 'Go to the blog starting page »', 'xubuntu' ); ?></a></p>
			<? }
		?>
	</div>
</div>

<?php
	/* Reset queries */
	wp_reset_postdata( );
?>