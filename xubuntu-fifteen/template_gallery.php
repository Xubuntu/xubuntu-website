<?php
	/* Template name: Full size gallery */
?>

<?php get_header( ); ?>
<?php the_post( ); ?>

<div id="content_outer">
	<div id="content" class="air">
		<h1 class="boxed"><?php the_title( ); ?></h1>
		<?php
			/* Get attachments for the post */
			$args = array(
				'post_parent' => get_the_ID( ),
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order_by' => 'date',
				'order' => 'ASC'
			);
			$attachments = get_children( $args );

			$galleries = array(
				1 => array( 'columns' => 2 ),
				2 => array( 'columns' => 3 ),
				3 => array( 'columns' => 4 )
			);

			foreach( $attachments as $a ) {
				switch( $i ) {
					case 0:
					case 1:
						$galleries[1]['items'][] = $a->ID;
						break;
					case 2:
					case 3:
					case 4:
						$galleries[2]['items'][] = $a->ID;
						break;
					default:
						$galleries[3]['items'][] = $a->ID;
						break;
				}
				$i++;
			}

			foreach( $galleries as $num => $gallery ) {
				$shortcode = '[gallery size="xubuntu_split_to_' . $gallery['columns'] . '" columns="' . $gallery['columns'] . '" ids="' . implode( ',', $gallery['items'] ) . '"]';
				echo do_shortcode( $shortcode );
			}
		?>
		<div class="boxed">
			<?php the_content( ); ?>
		</div>
	</div>
</div>

<?php get_footer( ); ?>