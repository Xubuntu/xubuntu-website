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
	} elseif( is_tax( 'release' ) ) {
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
//			if( $release_meta['release_eol'] >= gmdate( 'Y-m-d' ) ) {
//				echo '<dt>Support</dt><dd><a href="' . home_url( '/' ) . '">Help & Support</a></dd>';
//			}
			echo '</dl>';
		}
		echo wpautop( $release->description );
		echo '<h2>' . __( 'Articles', 'xubuntu' ) . '</h2>';
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