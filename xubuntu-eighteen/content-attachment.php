<?php
	if( get_the_excerpt( ) ) {
		echo '<h1>' . get_the_excerpt( ) . '</h1>';
	}
	if( get_the_content( ) ) {
		echo wpautop( get_the_content( ) );
	}
?>

<p><?php echo wp_get_attachment_image( get_the_ID( ), 'original' ); ?></p>

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
	<div class="attachment-navi">
		<a class="button back" href="<?php echo get_the_permalink( $prev_img->ID ); ?>"><?php _e( 'Previous', 'xubuntu' ); ?></a>
		<a class="button primary clean" href="<?php echo get_the_permalink( get_post_field( 'post_parent', get_the_ID( ) ) ); ?>"><?php _e( 'Parent', 'xubuntu' ); ?></a>
		<a class="button" href="<?php echo get_the_permalink( $next_img->ID ); ?>"><?php _e( 'Next', 'xubuntu' ); ?></a>
	</div>
<?php } ?>
