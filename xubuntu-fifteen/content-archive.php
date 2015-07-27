	<?php if (have_posts()) : ?>

		<?php
			if( is_archive( ) ) {
				if( is_category( ) ) {
					echo '<h1 class="post-title">' . single_cat_title( 'Archive: ', false ) . '</h1>';
				} elseif( is_tag( ) ) {
					echo '<h1 class="post-title">' . single_tag_title( 'Archive: ', false ) . '</h1>';
				} elseif( is_tax( 'release' ) ) {
					$release = get_term_by( 'slug', get_query_var( 'release' ), 'release', OBJECT );
					$release_meta = get_option( 'taxonomy_term_' . $release->term_id );

					list( $year, $month, $day ) = explode( '-', $release_meta['release_date'] );
					$release_time = gmmktime( 0, 0, 0, $month, $day, $year );
					list( $year, $month, $day ) = explode( '-', $release_meta['release_eol'] );
					$eol_time = gmmktime( 0, 0, 1, $month, $day, $year );

					if( strlen( $release_meta['release_codename'] ) > 0 ) {
						$codename = ', ' . $release_meta['release_codename'];
					} else {
						$codename = '';
					}

					echo '<h1 class="post-title">Xubuntu ' . single_term_title( '', false ) . $codename . '</h1>';
					if( $release_time > 0 || $eol_time > 0 ) {
						echo '<dl class="release-info group">';
						if( $release_time > 0 ) {
							echo '<dt>' . __( 'Release date', 'xubuntu' ) . '</dt><dd>' . gmdate( 'F j, Y', $release_time ) . '</dd>';
						}
						if( $eol_time > 0 ) {
							echo '<dt>' . __( 'End of Life', 'xubuntu' ) . '</dt><dd>' . gmdate( 'F j, Y', $eol_time ) . '</dd>';
						}
//						if( $release_meta['release_eol'] >= gmdate( 'Y-m-d' ) ) {
//							echo '<dt>Support</dt><dd><a href="' . home_url( '/' ) . '">Help & Support</a></dd>';
//						}
						echo '</dl>';
					}
					echo wpautop( $release->description );
					echo '<h2>' . __( 'Articles', 'xubuntu' ) . '</h2>';
				} else {
					echo '<h1 class="post-title">' . __( 'Archive', 'xubuntu' ) . '</h1>';
				}
			}
		?>
 
 		<div id="archive-posts">
			<ul>
				<?php while (have_posts()) : the_post(); $post_num++; ?>
				<li class="post-title">
					<span class="post-time"><?php print strftime( __( '%B %e, %Y', 'xubuntu' ), get_the_time( 'U' ) ); ?></span>
					<b><a href="<?php the_permalink( ); ?>" rel="bookmark" title="<?php the_title( ); ?>"><?php the_title( ); ?></a></b>
				</li>
			<?php endwhile; ?>
			</ul>
		</div>

	<?php else : ?>
		<h1 class="post-title"><?php _e( 'Page Not Found', 'xubuntu' ); ?></h1>
		<p><?php _e( 'I\'m sorry, but you\'re looking for something that is not here.', 'xubuntu' ); ?></p>
	<?php endif; ?>
