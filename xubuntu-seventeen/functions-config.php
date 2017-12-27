<?php

/*  Add image sizes
 *  TODO: Review – are these used, and where, and can/should we drop some?
 *
 */

add_image_size( 'xubuntu_full', 1400 );
add_image_size( 'xubuntu_split_to_2', 700 );
add_image_size( 'xubuntu_split_to_3', 467 );
add_image_size( 'xubuntu_split_to_4', 350 );
add_image_size( 'xubuntu_news', 467, 90, true ); /* ? */

add_filter( 'image_size_names_choose', 'xubuntu_image_sizes' );
function xubuntu_image_sizes( $sizes ) {
	$new_sizes = array(
		'xubuntu_full' => __( 'Xubuntu: Full (1400)', 'xubuntu' ),
		'xubuntu_split_to_2' => __( 'Xubuntu: Half (700)', 'xubuntu' ),
		'xubuntu_split_to_3' => __( 'Xubuntu: Third (467)', 'xubuntu' ),
		'xubuntu_split_to_4' => __( 'Xubuntu: Fourth (250)', 'xubuntu' ),
	);

	return array_merge( $sizes, $new_sizes );
}

/*  Allow uploading SVG
 *
 */

add_filter( 'upload_mimes', 'xubuntu_upload_mime' );
function xubuntu_upload_mime( $mimes = array( ) ) {
	$mimes['svg'] = 'image/svg';
	return $mimes;
}

/*  Filter post counts for archive pages
 *  Always show all posts
 *
 */

add_action( 'pre_get_posts', 'xubuntu_articles_filters' );

function xubuntu_articles_filters( $query ) {
	if( ( is_archive( ) && $query->is_main_query( ) ) || ( is_search( ) && $query->is_main_query( ) ) ) {
		/* Archive pages */
		$query->set( 'posts_per_page', -1 );
		return;
	}
	if( is_home( ) && $query->is_main_query( ) ) {
		/* Blog home page */
		$query->set( 'posts_per_page', 5 );
		return;
	}
}

?>