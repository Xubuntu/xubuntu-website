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

	if( strlen( $release_meta['release_codename'] ) > 0 ) {
		$codename = ', ' . $release_meta['release_codename'];
	} else {
		$codename = '';
	}

	echo '<h1 class="post-title">Xubuntu ' . single_term_title( '', false ) . $codename . '</h1>';
	if( isset( $release_time ) || isset( $eol_time ) ) {
		echo '<dl class="release-info group">';
		if( isset( $release_time ) ) {
			echo '<dt>' . __( 'Release date', 'xubuntu' ) . '</dt><dd>' . gmdate( 'F j, Y', $release_time ) . '</dd>';
		}
		if( isset( $eol_time ) ) {
			echo '<dt>' . __( 'End of Life', 'xubuntu' ) . '</dt><dd>' . gmdate( 'F j, Y', $eol_time ) . '</dd>';
		}
		echo '</dl>';
	}

	echo wpautop( $release->description );
?>

<?php
	$official_links = get_posts( array(
		'post_type' => 'release_link',
		'tax_query' => array( array(
			'taxonomy' => 'release',
			'field' => 'term_id',
			'terms' => $release->term_id
		) ),
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'link_type',
				'value' => 'official'
			),
			array(
				'key' => 'link_type',
				'value' => 'official-expiring'
			),
		),
	) );

	if( is_array( $official_links ) && count( $official_links ) > 0 ) {
		$otuput_links = array( );

		foreach( $official_links as $official_link ) {
			$meta = get_post_meta( $official_link->ID );
			if( $meta['link_type'][0] == 'official-expiring' && time( ) <= $eol_time ) {
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
	<div id="archive-posts">
		<ul>
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
	</div>
<?php } ?>

<?php
	$press_links = get_posts( array(
		'post_type' => 'release_link',
		'tax_query' => array( array(
			'taxonomy' => 'release',
			'field' => 'term_id',
			'terms' => $release->term_id
		) ),
		'meta_query' => array( array(
			'key' => 'link_type',
			'value' => 'press'
		) ),
	) );

	if( is_array( $press_links ) && count( $press_links ) > 0 ) {
		echo '<h2>' . __( 'In the Press', 'xubuntu' ) . '</h2>';
		echo '<ul class="link-list">';
		foreach( $press_links as $press_link ) {
			$meta = get_post_meta( $press_link->ID );
			echo '<li>';
			echo '<strong><a href="' . $meta['link_url'][0] . '">' . $press_link->post_title . '</a></strong>';
			if( ( isset( $meta['author_name'][0] ) && strlen( $meta['author_name'][0] ) > 0 ) || ( isset( $meta['author_site'][0] ) && strlen( $meta['author_site'][0] ) > 0 ) ) {
				echo ' by ';
			}
			if( isset( $meta['author_name'][0] ) && strlen( $meta['author_name'][0] ) > 0 ) {
				echo $meta['author_name'][0] . ' of ';
			}
			if( isset( $meta['author_site'][0] ) && strlen( $meta['author_site'][0] ) > 0 ) {
				if( isset( $meta['author_url'][0] ) && strlen( $meta['author_url'][0] ) > 0 ) {
					echo '<a href="' . $meta['author_url'][0] . '">' . $meta['author_site'][0] . '</a>';
				} else {
					echo $meta['author_site'][0];
				}
			}
			echo '</li>';
		}
		echo '</ul>';
	}
?>

<?php
	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'tax_query' => array( array(
			'taxonomy' => 'release',
			'field' => 'term_id',
			'terms' => $release->term_id
		) ),
	) );

	foreach( $attachments as $attachment ) {
		$gallery[] = $attachment->ID;
	}

	if( is_array( $gallery ) ) {
		$gallery_ids = implode( ',', $gallery );

		echo '<h2>' . __( 'Screenshots', 'xubuntu' ) . '</h2>';
		echo do_shortcode( '[gallery size="xubuntu_split_to_3" ids="' . $gallery_ids . '"]' );
	}
?>
