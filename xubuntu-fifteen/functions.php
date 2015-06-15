<?php

/*  Init admin
 *
 */

add_action( 'admin_init', 'xubuntu_admin_init' );

function xubuntu_admin_init( ) {
	add_editor_style( 'style-common.css' );
	add_editor_style( 'style-editor.css' );
}

/*  Register widget areas
 *
 */

if( function_exists( 'register_sidebar' ) ) {
	/* Frontpage widget areas */
	register_sidebars( 3, array(
		'name' => 'Front page %d',
		'id' => 'front',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	) );

	/* Navigation for blog pages */
	register_sidebar( array(
		'name' => 'Blog navigation',
		'id' => 'blog_navigation',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	) );
	/* Footer */
	register_sidebars( 2, array(
		'name' => 'Footer %d',
		'id' => 'footer-widgets',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	) );
}

/*  Register menu locations
 *
 */

register_nav_menu( 'main_navigation', 'Main navigation' );
register_nav_menu( 'footer_navigation', 'Footer navigation' );

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
	print '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo( 'name' ) . '" href="' . get_bloginfo( 'rss2_url' ) . '" />' . "\n";
}

/*  Enable HTML5 features
 *
 */

add_action( 'after_setup_theme', 'xubuntu_after_setup_theme' );
function xubuntu_after_setup_theme( ) {
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
}

/*  Enable featured images 
 *
 */

add_theme_support( 'post-thumbnails' );

/*  Register some JS for navigation
 *
 */

add_action( 'wp_enqueue_scripts', 'xubuntu_scripts' );
function xubuntu_scripts( ) {
	if( !is_admin( ) ) {
		wp_enqueue_script( 'xubuntu-menu', get_template_directory_uri( ) . '/menu.js', array( 'jquery' ), '0.1' );
	}
}

/*  Add some image sizes
 *  TODO: Review
 *
 */

add_image_size( 'xubuntu_full', 1400 );
add_image_size( 'xubuntu_split_to_2', 700 );
add_image_size( 'xubuntu_split_to_3', 467 );
add_image_size( 'xubuntu_split_to_4', 350 );

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

/*  Filter post counts for blog and archive pages
 *
 */

add_action( 'pre_get_posts', 'xubuntu_articles_filters' );

function xubuntu_articles_filters( $query ) {
	if( is_archive( ) && $query->is_main_query( ) ) {
		/* Archive pages */
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
	return array( );
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
				'title' => 'Other styles'
			),
			array(
				'title' => 'Button (primary)',
				'selector' => 'a',
				'classes' => 'button primary'
			),
			array(
				'title' => 'Button (regular)',
				'selector' => 'a',
				'classes' => 'button'
			),
			array(
				'title' => 'Three-column list',
				'selector' => 'ul',
				'classes' => 'columnlist group'
			),
			array(
				'title' => 'Boxed content',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'boxed group'
			)
		);

		$style_formats = array_merge( $style_formats, $style_formats_2 );
	}

	$init_array['style_formats'] = json_encode( $style_formats );

	$init_array['theme_advanced_blockformats'] = 'p,h2,h3,h4';
	$init_array['block_formats'] = 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4';

	return $init_array;
}

/*  Custom function for checking if the current page is a blog page
 *  (c) 2011 Wes Bos, https://gist.github.com/wesbos/1189639
 *
 */

function is_blog( ) {
	global $post;
	$posttype = get_post_type( $post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post' ) ) ? true : false ;
}

?>