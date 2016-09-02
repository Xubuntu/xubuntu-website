<?php

/*
 *  Register the release link post type
 *
 */

add_action( 'init', 'release_link_register' );

function release_link_register( ) {
	register_post_type(
		'release_link',
		array(
			'label' => _x( 'Release Links', 'post type label', 'xubuntu' ),
			'labels' => array(
				'name' => _x( 'Release Links', 'post type label: name', 'xubuntu' ),
				'singular_name' => _x( 'Release Link', 'post type label: singular_name', 'xubuntu' ),
				'add_new_item' => _x( 'Add New Release Link', 'post type label: add_new_item', 'xubuntu' ),
				'edit_item' => _x( 'Edit Release Link', 'post type label: edit_item', 'xubuntu' ),
				'view_item' => _x( 'View Release Link', 'post type label: view_item', 'xubuntu' ),
				'search_items' => _x( 'Search Release Links', 'post type label: search_items', 'xubuntu' ),
				'not_found' => _x( 'No release links found.', 'post type label: not_found', 'xubuntu' ),
				'all_items' => _x( 'All Release Links', 'post type label: all_items', 'xubuntu' ),
			),
			'description' => _x( 'Xubuntu Release Links', 'post type description', 'xubuntu' ),
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 20,
			'menu_icon' => 'dashicons-admin-links',
			'supports' => false,
			'taxonomies' => array(
				'release'
			),
			'rewrite' => false,
			'query_var' => false
		)
	);
}

/*
 *  Add meta boxes for the post type
 *
 */

add_action( 'add_meta_boxes', 'release_link_add_meta_boxes' );

function release_link_add_meta_boxes( ) {
	add_meta_box( 'release_link_type', _x( 'Link Type', 'meta box title', 'xubuntu' ), 'release_link_meta_box_link_type', 'release_link', 'normal', 'high' );	
	add_meta_box( 'release_link_link', _x( 'Link', 'meta box title', 'xubuntu' ), 'release_link_meta_box_link', 'release_link', 'normal', 'high' );
	add_meta_box( 'release_link_author', _x( 'Author', 'meta box title', 'xubuntu' ), 'release_link_meta_box_author', 'release_link', 'normal' );

}

function release_link_meta_box_link_type( $post, $box ) {
	$link_type = get_post_meta( $post->ID, 'link_type', true );

	$link_types = array(
		'press' => __( 'In the Press', 'xubuntu' ),
		'official' => __( 'Official link', 'xubuntu' ),
		'official-expiring' => __( 'Official link – Expires on EOL', 'xubuntu' ),
	);

	echo '<select class="widefat" name="link_type">';
	foreach( $link_types as $value => $name ) {
		echo '<option value="' . $value . '" ' . selected( $link_type, $value, false ) . '>' . $name . '</option>';
	}
	echo '</select>';
}

function release_link_meta_box_link( $post, $box ) {
	$link_title = get_post_meta( $post->ID, 'link_title', true );
	$link_url = get_post_meta( $post->ID, 'link_url', true );

	echo '<p><input type="text" class="widefat" name="link_title" placeholder="' . _x( 'Review of the latest Xubuntu release – awesome!', 'placeholder text', 'xubuntu' ) . '" value="' . $link_title . '" /></p>';
	echo '<p><input type="text" class="widefat" name="link_url" placeholder="' . _x( 'http://example.com/xubuntu-review/', 'placeholder text', 'xubuntu' ) . '" value="' . $link_url . '" /></p>';
	echo '</label></p>';
}

function release_link_meta_box_author( $post, $box ) {
	$author_site = get_post_meta( $post->ID, 'author_site', true );	
	$author_name = get_post_meta( $post->ID, 'author_name', true );
	$author_url = get_post_meta( $post->ID, 'author_url', true );

	echo '<p><input type="text" class="widefat" name="author_site" placeholder="' . _x( 'Example dot com', 'placeholder text', 'xubuntu' ) . '" value="' . $author_site . '" /></p>';
	echo '<p><input type="text" class="widefat" name="author_name" placeholder="' . _x( 'John Doe', 'placeholder text', 'xubuntu' ) . '" value="' . $author_name . '" /></p>';
	echo '<p><input type="text" class="widefat" name="author_url" placeholder="' . _x( 'http://example.com/', 'placeholder text', 'xubuntu' ) . '" value="' . $author_url . '" /></p>';
	echo '<p>' . _x( 'This information is considered for press links only.', 'xubuntu' ) . '</p>';
}

/*
 *  Remove some meta boxes from the post type
 *
 */

add_action( 'admin_menu', 'release_link_remove_meta_boxes' );

function release_link_remove_meta_boxes( ) {
	remove_meta_box( 'slugdiv', 'release_link', 'normal' );
}

/*
 *  Handle saving the link data
 *
 */

add_action( 'save_post_release_link', 'release_link_save_post' );

function release_link_save_post( $post_id ) {
	global $wpdb;

	$fields_to_save = array(
		'link_type',
		'link_title',
		'link_url',
		'author_site',
		'author_name',
		'author_url'
	);

	foreach( $fields_to_save as $field ) {
		if( isset( $_POST[$field] ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
		}
	}

	if( isset( $_POST['link_title'] ) ) {
		$wpdb->update( $wpdb->posts, array( 'post_title' => $_POST['link_title'] ), array( 'ID' => $post_id ) );
	}
}

/*
 *  Add a function to help listing release links
 *
 */

function release_link_list( $link_type = 'press', $term = null ) {
	$args = array(
		'post_type' => 'release_link',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC'
	);

	if( isset( $link_type ) ) {
		$args['meta_query'] = array(
			'relation' => 'OR',
		);

		if( is_array( $link_type ) ) {
			foreach( $link_type as $type ) {
				$args['meta_query'][] = array(
					'key' => 'link_type',
					'value' => $type
				);
			}
		} else {
			$args['meta_query'][] = array(
				'key' => 'link_type',
				'value' => $link_type
			);
		}
	}

	if( isset( $term ) ) {
		$args['tax_query'] = array( array(
			'taxonomy' => 'release',
			'field' => 'term_id',
			'terms' => $term
		) );
	}

	$links = get_posts( $args );

	if( is_array( $links ) && count( $links ) > 0 ) {
		return $links;
	} else {
		return null;
	}
}

/*
 *  Add a function to output press links
 *
 */

function release_link_press_output( $press_links = array( ) ) {
	if( count( $press_links ) > 0 ) {
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
}

/*
 *  Add a shortcode for printing out press links
 *
 */

add_shortcode( 'press', 'release_link_shortcode_press' );

function release_link_shortcode_press( $atts ) {
	$atts = shortcode_atts(
		array(
			'release' => false,
		),
		$atts,
		'press'
	);

	if( strlen( $atts['release'] ) > 0 ) {
		$links = release_link_list( 'press', $atts['release'] );
	} else {
		$links = release_link_list( 'press' );
	}

	print_r( $links );
}



?>