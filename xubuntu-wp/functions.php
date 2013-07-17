<?php

/* enable shortcodes for widgets */
add_filter( 'widget_text', 'do_shortcode' );

/* enable widget areas */
if( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		"name" => "Frontpage",
		"id" => "xubuntu_front",
		"before_widget" => "<div class='column'>",
		"after_widget" => "</div>",
		"before_title" => "<h2>",
		"after_title" => "</h2>"
	) );
	register_sidebar( array(
		"name" => "Frontpage columns",
		"id" => "xubuntu_front_columns",
		"before_widget" => "<div class='column'>",
		"after_widget" => "</div>",
		"before_title" => "<h2>",
		"after_title" => "</h2>"
	) );
	register_sidebar( array(
		"name" => "Sidebar",
		"id" => "xubuntu_sidebar",
		"before_widget" => "",
		"after_widget" => "",
		"before_title" => "<h4>",
		"after_title" => "</h4>"
	) );
	register_sidebar( array(
		"name" => "Footer",
		"id" => "xubuntu_footer",
		"before_widget" => "<div class='footer-widget'>",
		"after_widget" => "</div>",
		"before_title" => "<h4>",
		"after_title" => "</h4>"
	) );
}

/* enable menus */
if( function_exists( 'register_nav_menu' ) ) {
	register_nav_menus( array(
		'horizontal_navi' => 'Horizontal navigation'
	) );
}

/* enable uploading svg's */
add_filter( 'upload_mimes', 'xubuntu_upload_mime' );
function xubuntu_upload_mime( $mimes = array( ) ) {
	$mimes['svg'] = 'image/svg';
	return $mimes;
}

/* remove unnecessary stuff from head */
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

/* and now add a meaningful feed link to the head */
add_action( 'wp_head', 'xubuntu_feed_head' );
function xubuntu_feed_head( ) {
	// we always want to link to the main feed. always
	print '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo( 'name' ) . ' // Articles feed" href="' . get_bloginfo( 'rss2_url' ) . '" />' . "\n";
}

?>
