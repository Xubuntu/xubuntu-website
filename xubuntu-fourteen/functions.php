<?php

$content_width = 585;

/*  Init
 *
 */

add_action( 'init', 'xubuntu_init' );

function xubuntu_init( ) {
	add_editor_style( 'editor.css' );
	add_editor_style( 'editor-narrow.css' );
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
		"name" => "Frontpage: Sticky news",
		"id" => "xubuntu_front_sticky",
		"before_widget" => "<div class='widget'><div class='content'>",
		"after_widget" => "</div></div>",
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

/*  Enable HTML5 features
 *
 */

add_action( 'after_setup_theme', 'xubuntu_after_setup_theme' );
function xubuntu_after_setup_theme( ) {
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
}

/*  Add some image sizes 
 *
 */

add_image_size( 'half_page', 285 );
add_image_size( 'full_page', 600 );

add_filter( 'image_size_names_choose', 'xubuntu_image_sizes' );
function xubuntu_image_sizes( $sizes ) {
	$new_sizes = array(
		'half_page' => __( '1/2 page', 'xubuntu' ),
		'full_page' => __( 'Full page', 'xubuntu' )
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
				'classes' => 'columnlist group'
			)
		);

		$style_formats = array_merge( $style_formats, $style_formats_2 );
	}

	$init_array['style_formats'] = json_encode( $style_formats );

	$init_array['theme_advanced_blockformats'] = 'p,h2,h3,h4';
	$init_array['block_formats'] = 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4';

	return $init_array;
}

/*  Output mobile navigation
 *
 */

function xubuntu_mobile_navigation( ) {
	echo '<div id="mobile_navi">';
	wp_nav_menu( array(
		'theme_location' => 'front-page',
		'container_class' => 'mobile_menu group',
		'container_id' => 'mnmenu',
		'fallback_cb' => false,
		'depth' => 1
	) );
	wp_nav_menu( array(
		'theme_location' => 'front-page',
		'container_class' => 'mobile_menu group',
		'container_id' => 'flmenu',
		'fallback_cb' => false
	) );
	echo '</div>';
}

/*  Build custom submenu for mobile use
 *
 */

function xubuntu_submenu( ) {
	global $post;
	$locations = get_nav_menu_locations( );

	if( isset( $locations['front-page'] ) ) {
		$menu = wp_get_nav_menu_object( $locations['front-page'] );
		$menu_items = wp_get_nav_menu_items( $menu->term_id );

		foreach( $menu_items as $key => $item ) {
			if( $item->menu_item_parent == 0 ) {
				$main[$item->ID] = $item;
			} else {
				$sub[$item->menu_item_parent][] = $item;
			}

			if( $post->ID == $item->object_id ) {
				// This is the current branch
				if( $item->menu_item_parent > 0 ) {
					$menu_branch_parent = $item->menu_item_parent;
				} else {
					$menu_branch_parent = $item->ID;
				}
			}
		}

		echo '<ul id="flmenu">';
		echo '<li class="title"><a href="#">' . $main[$menu_branch_parent]->post_title . '</a></li>';
		foreach( $sub[$menu_branch_parent] as $item ) {
			echo '<li><a href="">' . $item->post_title . '</a></li>';
		}
		echo '</ul>';
	}
}

?>