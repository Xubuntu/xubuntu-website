<?php get_header( ); ?>

<div id="mainwrap" class="group">
	<div id="main">
		<?php
			if( is_404( ) ) {
				?>
				<h1 class="post-title"><?php _e( 'Page Not Found', 'xubuntu' ); ?></h1>
				<p><?php _e( 'I\'m sorry, but you\'re looking for something that is not here.', 'xubuntu' ); ?></p>
				<?php
			} elseif( ( is_archive( ) && !is_paged( ) ) || is_home( ) ) {
				/* Archive front page */
				get_template_part( 'content', get_post_format( ) );
			} elseif( is_archive( ) && is_paged( ) ) {
				/* The real archives... */
				get_template_part( 'content', 'titles' );
			} else {
				get_template_part( 'content', get_post_format( ) );
			}

			if( !is_page( ) && !is_paged( ) ) {
				/* Output browsing links for blog */
				get_template_part( 'browse' );
			}
		?>
	</div>
</div>

<?php get_sidebar( ); ?>
<?php get_footer( ); ?>