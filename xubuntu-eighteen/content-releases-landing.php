<?php while( have_posts( ) ) { ?>
	<?php the_post( ); ?>
	<div <?php post_class( 'group' ) ?> id="post-<?php the_ID( ); ?>">
		<?php	if( !is_front_page( ) ) { ?>
			<?php if( !is_page( ) ) { ?>
				<h1 class="post-title"><a href="<?php the_permalink( ); ?>"><?php the_title( ); ?></a></h1>
			<?php } else { ?>
				<h1 class="post-title"><?php the_title( ); ?></h1>
			<?php } ?>
		<?php } ?>

		<div class="post-post">
			<div class="post-entry entry">
				<?php the_content( __( 'Read the rest of this entry »', 'xubuntu' ) ); ?>
			</div>
		</div>
	</div>
<?php } ?>

<?php
	$releases = release_taxonomy_get_releases_sorted( );

	if( is_array( $releases ) ) {
		$date_now = new DateTime( 'now' );
		foreach( $releases as $release ) {
			$release_meta = get_option( 'taxonomy_term_' . $release->term_id );
			$date_release = new DateTime( $release_meta['release_date'] );

			if( strlen( $release_meta['release_codename'] ) > 0 ) {
				$release->name .= ' (' . $release_meta['release_codename'] . ')';
			}
			if( $release->release_is_eol == 0 && $date_release->format( 'Ymd' ) <= $date_now->format( 'Ymd' ) ) {
				$date_eol = new DateTime( $release_meta['release_eol'] );
				echo '<h2>Xubuntu ' . $release->name . '</h2>';
				echo wpautop( $release->description );
				echo '<p><a class="button primary" href="' . get_term_link( $release ) . '">' . __( 'Visit the release page', 'xubuntu' ) . '</a></p>';
			}
		}
	}
?>