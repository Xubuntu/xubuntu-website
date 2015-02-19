<?php
	/* Template name: Featured image and gallery */
?>

<?php get_header( ); ?>
<?php the_post( ); ?>

<div id="content_outer">
	<div id="content" class="air">
		<h1 class="boxed"><?php the_title( ); ?></h1>
		<div class="featured highlight group">
			<?php
				$featured = get_post( get_post_thumbnail_id( ) );
				echo '<div class="image">';
				echo '<a href="' . get_permalink( get_post_thumbnail_id( ) ) . '">';
				echo get_the_post_thumbnail( null, 'xubuntu_split_to_2' );
				echo '</a>';
				echo '</div>';
				echo '<div class="description">';
				echo '<h2>' . $featured->post_excerpt . '</h2>';
				echo '<p>' . $featured->post_content . '</p>';
				echo '</div>';
			?>
		</div>
		<div class="boxed">
			<?php the_content( ); ?>
		</div>
		<div class="group">
			<?php
				/* Output the gallery */
				$args = array(
					'post_parent' => get_the_ID( ),
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order_by' => 'date',
					'order' => 'DESC',
					'numberposts' => -1,
				);
				$attachments = get_children( $args );

				if( is_array( $attachments ) ) {
					$shortcode = '[gallery size="xubuntu_split_to_4" columns="4" exclude="' . get_post_thumbnail_id( ) . '"]';
					echo do_shortcode( $shortcode );
				}
			?>
		</div>
	</div>
</div>

<?php get_footer( ); ?>