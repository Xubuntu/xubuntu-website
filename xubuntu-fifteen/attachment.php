<?php
	/* Template name: Full size gallery */
?>

<?php get_header( ); ?>
<?php the_post( ); ?>

<div id="content_outer">
	<div id="content" class="air">
		<?php
			// Get previous/next attachment if available
			$args = array(
				'post_parent' => get_post_field( 'post_parent', get_the_ID( ) ),
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order_by' => 'date',
				'order' => 'ASC'
			);
			$attachments = get_children( $args );
			sort( $attachments );

			foreach( $attachments as $i => $a ) {
				if( $a->ID == get_the_ID( ) ) {
					$prev = $i - 1; $next = $i + 1;

					if( $prev >= 0 ) {
						$prev_img = $attachments[$prev];
					} else {
						$last = count( $attachments ) - 1;
						$prev_img = $attachments[$last];
					}

					if( $next <= count( $attachments ) - 1 ) {
						$next_img = $attachments[$next];
					} else {
						$next_img = $attachments[0];
					}
				}

				continue;
			}
		?>
		<?php if( count( $attachments ) > 1 ) { ?>
			<div id="attachment_navi">
				<a class="button back" href="<?php echo get_the_permalink( $prev_img->ID ); ?>"><?php _e( 'Previous', 'xubuntu' ); ?></a>
				<a class="button primary clean" href="<?php echo get_the_permalink( get_post_field( 'post_parent', get_the_ID( ) ) ); ?>"><?php _e( 'Parent', 'xubuntu' ); ?></a>
				<a class="button" href="<?php echo get_the_permalink( $next_img->ID ); ?>"><?php _e( 'Next', 'xubuntu' ); ?></a>
			</div>
		<?php } ?>
		<div id="attachment">
			<?php
				// Output the image
				echo wp_get_attachment_image( get_the_ID( ), 'original' );
			?>
		</div>
		<?php
			$caption = get_the_excerpt( );
			$description = get_the_content( );
		?>
		<?php if( $caption || $description ) { ?>
			<div class="boxed">
				<?php if( $caption ) { ?><h2><?php echo $caption; ?></h2><?php } ?>
				<?php if( $description ) { ?><p><?php echo $description; ?></p><?php } ?>
			</div>
		<?php } ?>
	</div>
</div>

<?php get_footer( ); ?>