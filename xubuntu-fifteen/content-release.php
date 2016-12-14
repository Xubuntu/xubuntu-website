<?php
	$release = get_term_by( 'slug', get_query_var( 'release' ), 'release', OBJECT );
	$release_meta = get_option( 'taxonomy_term_' . $release->term_id );

	if( isset( $release_meta['release_date'] ) && $release_meta['release_date'] > 0 ) {
		list( $year, $month, $day ) = explode( '-', $release_meta['release_date'] );
		$release_time = gmmktime( 0, 0, 0, $month, $day, $year );
	}
	if( isset( $release_meta['release_eol'] ) && $release_meta['release_eol'] > 0 ) {
		list( $year, $month, $day ) = explode( '-', $release_meta['release_eol'] );
		$eol_time = gmmktime( 0, 0, 1, $month, $day, $year );
	}

	echo '<h1 class="post-title">Xubuntu ' . single_term_title( '', false ) . '</h1>';
	if( strlen( $release_meta['release_codename'] ) > 0 || isset( $release_time ) || isset( $eol_time ) ) {
		echo '<dl class="release-info group">';
		if( strlen( $release_meta['release_codename'] ) > 0 ) {
			echo '<dt>' . __( 'Codename', 'xubuntu' ) . '</dt><dd>' . $release_meta['release_codename'] . '</dd>';
		}
		if( isset( $release_time ) ) {
			echo '<dt>' . __( 'Release Date', 'xubuntu' ) . '</dt><dd>' . gmdate( 'F j, Y', $release_time ) . '</dd>';
		}
		if( isset( $eol_time ) ) {
			echo '<dt>' . __( 'End of Life', 'xubuntu' ) . '</dt><dd>' . gmdate( 'F j, Y', $eol_time ) . '</dd>';
		}
		echo '</dl>';
	}

	echo wpautop( $release->description );
?>

<?php
	$official_links = release_link_list( array( 'official', 'official-expiring' ), $release->term_id );

	if( $official_links ) {
		$output_links = array( );

		foreach( $official_links as $official_link ) {
			$meta = get_post_meta( $official_link->ID );
			if( ( $meta['link_type'][0] == 'official-expiring' && time( ) <= $eol_time ) || $meta['link_type'][0] == 'official' ) {
				$output_links[] = '<li><strong><a href="' . $meta['link_url'][0] . '">' . $official_link->post_title . '</a></strong></li>';
			}
		}
	
		if( count( $output_links ) > 0 ) {
			echo '<h2>' . __( 'Official Links', 'xubuntu' ) . '</h2>';
			echo '<ul class="link-list">';
			foreach( $output_links as $link ) {
				echo $link;
			}
			echo '</ul>';
		}
	}
?>

<?php if( have_posts( ) ) { ?>
	<h2><?php _e( 'Articles', 'xubuntu' ); ?></h2>
	<ul class="posts-list">
		<?php while( have_posts( ) ) { ?>
			<?php the_post( ); ?>
			<?php if( get_post_type( ) == 'post' ) { ?>
				<li class="post-title">
					<span class="post-time"><?php print strftime( __( '%B %e, %Y', 'xubuntu' ), get_the_time( 'U' ) ); ?></span>
					<b><a href="<?php the_permalink( ); ?>" rel="bookmark" title="<?php the_title( ); ?>"><?php the_title( ); ?></a></b>
				</li>
			<?php } ?>
		<?php } ?>
	</ul>
<?php } ?>

<?php
	$press_links = release_link_list( 'press', $release->term_id );
	if( $press_links ) {
		echo '<h2>' . __( 'In the Press', 'xubuntu' ) . '</h2>';
		echo release_link_press_output( $press_links );
	}
?>

<?php
	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'posts_per_page' => -1,
		'tax_query' => array( array(
			'taxonomy' => 'release',
			'field' => 'term_id',
			'terms' => $release->term_id
		) ),
	) );

	$release_gallery = array( );

	foreach( $attachments as $attachment ) {
		$release_gallery[] = $attachment->ID;
	}

	if( count( $release_gallery ) > 0 ) {
		$gallery_ids = implode( ',', $release_gallery );

		echo '<h2>' . __( 'Screenshots', 'xubuntu' ) . '</h2>';
		echo do_shortcode( '[gallery size="xubuntu_split_to_3" link="file" ids="' . $gallery_ids . '"]' );
	}
?>
