<?php
	//  Get release information
	$release = get_term_by( 'slug', get_query_var( 'release' ), 'release', OBJECT );
	$release_meta = get_release_meta( $release->term_id );

	//  Get release timestamp
	if( isset( $release_meta['release_date'] ) && $release_meta['release_date'] > 0 ) {
		list( $year, $month, $day ) = explode( '-', $release_meta['release_date'] );
		$release_time = gmmktime( 0, 0, 0, $month, $day, $year );
	}
	//  Get EOL timestamp
	if( isset( $release_meta['release_eol'] ) && $release_meta['release_eol'] > 0 ) {
		list( $year, $month, $day ) = explode( '-', $release_meta['release_eol'] );
		$eol_time = gmmktime( 0, 0, 1, $month, $day, $year );
	}
?>

<h1 class="post-title">Xubuntu <?php echo single_term_title( '', false ); ?></h1>
<?php echo wpautop( $release->description ); ?>

<?php
	//  Release information
	$info = '';
	if( strlen( $release_meta['release_codename'] ) > 0 ) {
		$info .= '<dt>' . __( 'Codename', 'xubuntu' ) . '</dt><dd>' . $release_meta['release_codename'] . '</dd>';
	}
	if( isset( $release_time ) ) {
		$info .= '<dt>' . __( 'Release Date', 'xubuntu' ) . '</dt><dd>' . gmdate( 'F j, Y', $release_time ) . '</dd>';
	}
	if( isset( $eol_time ) ) {
		$info .= '<dt>' . __( 'End of Life', 'xubuntu' ) . '</dt><dd>' . gmdate( 'F j, Y', $eol_time ) . '</dd>';
	}

	//  Release links
	if( $release_time < time( ) && $release_meta['release_released'] == 1 && $eol_time > time( ) ) {
		if( isset( $release_meta['release_torrent_64bit'] ) && strlen( $release_meta['release_torrent_64bit'] ) > 0 ) {
			$info_links[] = '<strong><a href="' . $release_meta['release_torrent_64bit'] . '">' . __( 'Torrent download for 64-bit systems', 'xubuntu' ) . '</a></strong>';
		}
		if( isset( $release_meta['release_torrent_32bit'] ) && strlen( $release_meta['release_torrent_32bit'] ) > 0 ) {
			$info_links[] = '<strong><a href="' . $release_meta['release_torrent_32bit'] . '">' . __( 'Torrent download for 32-bit systems', 'xubuntu' ) . '</a></strong>';
		}
		if( isset( $release_meta['release_documentation_link'] ) && strlen( $release_meta['release_documentation_link'] ) > 0 ) {
			$info_links[] = '<a href="' . $release_meta['release_documentation_link'] . '">' . __( 'Online Documentation', 'xubuntu' ) . '</a>';
		}
		if( isset( $info_links ) ) {
			$info .= '<dt>' . __( 'Release Links', 'xubuntu' ) . '</dt><dd>' . implode( $info_links, '<br />' ) . '</dd>';
		}
	}

	if( strlen( $info ) > 0 ) {
		echo '<dl class="release-info group">';
		echo $info;
		echo '</dl>';
	}
?>

<?php
	//  Direct download links
	if( isset( $eol_time ) && $eol_time > time( ) && $release_meta['release_released'] == 1 ) {
		if( shortcode_exists( 'mirrors' ) )  {
			$mirrors = do_shortcode( '[mirrors release=' . $release->slug . ']' );
			if( isset( $mirrors ) ) {
				echo '<h2>' . __( 'Direct Downloads', 'xubuntu' ) . '</h2>';
				echo $mirrors;
			}
		}
	}
?>

<?php //  Articles  ?>
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
	//  Press links
	$press_links = release_link_list( 'press', $release->term_id );
	if( $press_links ) {
		echo '<h2>' . __( 'In the Press', 'xubuntu' ) . '</h2>';
		echo release_link_press_output( $press_links );
	}
?>

<?php
	//  Attachments, usually screenshots
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