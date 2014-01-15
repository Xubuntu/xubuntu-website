<?php

/*  Init
 *
 */

add_action( 'init', 'xubuntu_init' );

function xubuntu_init( ) {
	add_editor_style( 'editor.css' );
	add_editor_style( 'templates.css' );
}

/*  Register widget areas
 *
 */

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
		"name" => "Sidebar",
		"id" => "xubuntu_sidebar",
		'class' => 'sidebar-main',
		"before_widget" => "",
		"after_widget" => "",
		"before_title" => "<h4>",
		"after_title" => "</h4>"
	) );
	register_sidebar( array(
		"name" => "Footer",
		"id" => "xubuntu_footer",
		"before_widget" => "<div class='widgets'>",
		"after_widget" => "</div>",
		"before_title" => "<h4>",
		"after_title" => "</h4>"
	) );
}

/*  Register menu location for front page
 *
 */

register_nav_menu( 'front-page', 'Front page' );

/*  Remove unwanted metadata from <head>
 *
 */

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

/*  Add RSS2 feed link to <head>
 *
 */

add_action( 'wp_head', 'xubuntu_head' );
function xubuntu_head( ) {
	// we always want to link to the main feed. always
	print '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo( 'name' ) . ' // Articles feed" href="' . get_bloginfo( 'rss2_url' ) . '" />' . "\n";
}

/*  Allow uploading SVG
 *
 */

add_filter( 'upload_mimes', 'xubuntu_upload_mime' );
function xubuntu_upload_mime( $mimes = array( ) ) {
	$mimes['svg'] = 'image/svg';
	return $mimes;
}

/*  Filter post counts for blog and archive pages
 *
 */

add_action( 'pre_get_posts', 'xubuntu_articles_filters' );

function xubuntu_articles_filters( $query ) {
	if( ( is_home( ) && $query->is_main_query( ) ) || ( is_archive( ) && $query->is_main_query( ) && !is_paged( ) ) ) {
		/* Single posts and archive front */
		$query->set( 'posts_per_page', 1 );
		return;
	} elseif( is_archive( ) && $query->is_main_query( ) && is_paged( ) ) {
		/* The rest of the archive pages */
		$query->set( 'posts_per_page', -1 );
		return;
	}
}

/*  Tweak TinyMCE menus
 *
 */

add_filter( 'mce_buttons', 'xubuntu_mcebuttons' );

function xubuntu_mcebuttons( $buttons ) {
	$buttons = array(
		"formatselect",
		"bold",
		"italic",
		"underline",
		"strikethrough",
		"styleselect",
		"bullist",
		"numlist",
		"link",
		"unlink",
		"charmap",
		"fullscreen",
//		"wp_adv"
	);

	return $buttons;
}

add_filter( 'mce_buttons_2', 'xubuntu_mcebuttons2' );

function xubuntu_mcebuttons2( $buttons ) {
	return array(  );
}

add_filter( 'tiny_mce_before_init', 'xubuntu_tinymceinit' );

function xubuntu_tinymceinit( $init_array ) {
	/*  http://codex.wordpress.org/TinyMCE_Custom_Styles#Using_style_formats
	 *  See templates.css for styling
	 *
	 */
	$current = get_current_screen( );

	$style_formats = array(
		array(
			'title' => 'Blockquote',
			'block' => 'blockquote',
			'wrapper' => true
		),
		array(
			'title' => 'Code (block)',
			'inline' => 'code',
			'classes' => 'block',
			'wrapper' => true
		),
		array(
			'title' => 'Code (inline)',
			'inline' => 'code'
		),
		array(
			'title' => 'Preface',
			'block' => 'p',
			'classes' => 'preface',
		),
	);

	if( current_user_can( 'publish_posts' ) && $current->post_type == 'page' ) {
		$style_formats_2 = array(
			array(
				'title' => 'Highlight styles'
			),
			array(
				'title' => 'Black highlight',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'hb black'
			),
			array(
				'title' => 'Blue highlight',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'hb blue'
			),
			array(
				'title' => 'Green highlight',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'hb green'
			),
			array(
				'title' => 'Pink highlight',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'hb pink'
			),
			array(
				'title' => 'White highlight',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'hb white darkheading'
			),
			array(
				'title' => 'Modifiers'
			),
			array(
				'title' => 'Three-column list',
				'selector' => 'ul',
				'classes' => 'columnlist'
			)
		);

		$style_formats = array_merge( $style_formats, $style_formats_2 );
	}

	$init_array['style_formats'] = json_encode( $style_formats );
	$init_array['theme_advanced_blockformats'] = 'p,h2,h3,h4';

	return $init_array;
}

?>