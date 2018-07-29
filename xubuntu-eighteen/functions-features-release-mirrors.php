<?php

/*
 *  Register the release download mirror post type
 *
 */

add_action( 'init', 'release_download_mirror_register' );

function release_download_mirror_register( ) {
	register_post_type(
		'download_mirror',
		array(
			'label' => _x( 'Download Mirrors', 'post type label', 'xubuntu' ),
			'labels' => array(
				'name' => _x( 'Download Mirrors', 'post type label: name', 'xubuntu' ),
				'singular_name' => _x( 'Download Mirror', 'post type label: singular_name', 'xubuntu' ),
				'add_new_item' => _x( 'Add New Download Mirror', 'post type label: add_new_item', 'xubuntu' ),
				'edit_item' => _x( 'Edit Download Mirror', 'post type label: edit_item', 'xubuntu' ),
				'view_item' => _x( 'View Download Mirror', 'post type label: view_item', 'xubuntu' ),
				'search_items' => _x( 'Search Download Mirrors', 'post type label: search_items', 'xubuntu' ),
				'not_found' => _x( 'No download mirrors found.', 'post type label: not_found', 'xubuntu' ),
				'all_items' => _x( 'All Download Mirrors', 'post type label: all_items', 'xubuntu' ),
				'menu_name' => _x( 'DL Mirrors', 'post type label: menu_name', 'xubuntu' ),
			),
			'description' => _x( 'Xubuntu Download Mirrors', 'post type description', 'xubuntu' ),
			'public' => true,
			'show_in_menu' => false,
			'show_in_nav_menus' => false,
			'menu_position' => 21,
			'menu_icon' => 'dashicons-download',
			'supports' => false,
			/* 'taxonomies' => array(
				'release'
			), */
			'rewrite' => false,
			'query_var' => false
		)
	);
}

/*
 *  Add meta boxes for the post type
 *
 */

add_action( 'add_meta_boxes', 'release_download_mirror_add_meta_boxes' );

function release_download_mirror_add_meta_boxes( ) {
	add_meta_box( 'release_download_mirror_info', _x( 'Mirror Information', 'meta box title', 'xubuntu' ), 'release_download_mirror_meta_box_info', 'download_mirror', 'normal', 'high' );
	add_meta_box( 'release_download_mirror_location', _x( 'Mirror Location', 'meta box title', 'xubuntu' ), 'release_download_mirror_meta_box_location', 'download_mirror', 'normal' );
	add_meta_box( 'release_download_mirror_link_template', _x( 'Mirror Link Template', 'meta box title', 'xubuntu' ), 'release_download_mirror_meta_box_link_template', 'download_mirror', 'normal' );
	add_meta_box( 'release_download_mirror_activity', _x( 'Activity', 'meta box title', 'xubuntu' ), 'release_download_mirror_meta_box_activity', 'download_mirror', 'side' );
}

function release_download_mirror_meta_box_info( $post, $box ) {
	$mirror_name = get_post_meta( $post->ID, 'mirror_name', true );
	$mirror_lp_url = get_post_meta( $post->ID, 'mirror_lp_url', true );

	echo '<p><input type="text" class="widefat" name="mirror_name" placeholder="' . _x( 'University of Mirrors', 'placeholder text', 'xubuntu' ) . '" value="' . $mirror_name . '" /></p>';
	echo '<p><input type="text" class="widefat" name="mirror_lp_url" placeholder="' . _x( 'https://launchpad.net/ubuntu/+mirror/ubuntu.mirror.university-release', 'placeholder text', 'xubuntu' ) . '" value="' . $mirror_lp_url . '" /></p>';
}

function release_download_mirror_meta_box_location( $post, $box ) {
	$mirror_area = get_post_meta( $post->ID, 'mirror_area', true );
	$mirror_country = get_post_meta( $post->ID, 'mirror_country', true );

	$mirror_areas = array(
		'unknown' => __( 'Unknown or Other', 'xubuntu' ),
		'africa' => __( 'Africa', 'xubuntu' ),
		'americas' => __( 'Americas', 'xubuntu' ),
		'asia' => __( 'Asia', 'xubuntu' ),
		'europe' => __( 'Europe', 'xubuntu' ),
		'oceania' => __( 'Oceania', 'xubuntu' ),
	);

	echo '<select class="widefat" name="mirror_area">';
	foreach( $mirror_areas as $value => $name ) {
		echo '<option value="' . $value . '" ' . selected( $mirror_area, $value, false ) . '>' . $name . '</option>';
	}
	echo '</select>';

	echo '<p><input type="text" class="widefat" name="mirror_country" placeholder="' . _x( 'Finland', 'placeholder text', 'xubuntu' ) . '" value="' . $mirror_country . '" /></p>';
}

function release_download_mirror_meta_box_link_template( $post, $box ) {
	$mirror_http_template = get_post_meta( $post->ID, 'mirror_http_template', true );

	echo '<p><input type="text" class="widefat" name="mirror_http_template" placeholder="' . _x( 'http://ubuntu.mirror.university/releases/VERSION/', 'placeholder text', 'xubuntu' ) . '" value="' . $mirror_http_template . '" /></p>';
	echo '<p>' . __( 'The tag <code>VERSION</code> in the mirror template will be replaced by the appropriate version number (eg. <em>16.04</em>)', 'xubuntu' ) . '</p>';
}

function release_download_mirror_meta_box_activity( $post, $box ) {
	$mirror_main = get_post_meta( $post->ID, 'mirror_main', true );
	$mirror_active = get_post_meta( $post->ID, 'mirror_active', true );

	echo '<ul>';
	echo '<li><label class="selectit">';
	echo '<input type="checkbox" name="mirror_active" ' . checked( $mirror_active, 1, false ) . '/>';
	echo _x( 'Is active?', 'release mirror activity', 'xubuntu' );
	echo '</label></li>';
	echo '<li><label class="selectit">';
	echo '<input type="checkbox" name="mirror_main" ' . checked( $mirror_main, 1, false ) . '/>';
	echo __( 'Is a main download mirror?', 'release mirror status', 'xubuntu' );
	echo '</label></li>';
	echo '</ul>';
}

/*
 *  Handle saving the link data
 *
 */

add_action( 'save_post_download_mirror', 'release_download_mirror_save_post' );

function release_download_mirror_save_post( $post_id ) {
	global $wpdb;

	$fields_to_save = array(
		'mirror_name',
		'mirror_lp_url',
		'mirror_area',
		'mirror_country',
		'mirror_http_template',
	);

	foreach( $fields_to_save as $field ) {
		if( isset( $_POST[$field] ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
		}
	}

	$bool_fields_to_save = array(
		'mirror_active',
		'mirror_main',
	);

	foreach( $bool_fields_to_save as $field ) {
		if( $_POST[$field] != 'on' ) { // TODO
			update_post_meta( $post_id, $field, 0 );
		} else {
			update_post_meta( $post_id, $field, 1 );
		}
	}

	if( isset( $_POST['mirror_name'] ) ) {
		$wpdb->update( $wpdb->posts, array( 'post_title' => $_POST['mirror_name'] ), array( 'ID' => $post_id ) );
	}
}

/*
 *  Add a shortcode to print the list of mirrors
 *
 */

add_shortcode( 'mirrors', 'release_download_mirror_shortcode_downloads' );

function release_download_mirror_shortcode_downloads( $atts ) {
	$atts = shortcode_atts(
		array(
			'release' => false,
		),
		$atts,
		'mirrors'
	);

	if( strlen( $atts['release'] ) < 1 ) {
		return;
	}

	$args = array(
		'post_type' => 'download_mirror',
		'posts_per_page' => -1,
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'meta_key' => 'mirror_country',
		'meta_query' => array(
			array(
				'key' => 'mirror_active',
				'value' => 1,
				'compare' => '='
			),
		),
	);
	$mirrors = get_posts( $args );

	if( count( $mirrors ) > 0 ) {
		$out = '<ul class="columnlist mirrors">';
		foreach( $mirrors as $mirror ) {
			$mirror_meta = get_post_meta( $mirror->ID );
			if( $mirror_meta['mirror_main'][0] == 1 ) {
				$class = 'main';
			} else {
				$class = 'secondary';
			}

			$out .= '<li class="' . $class . '"><a href="' . release_download_url( $mirror_meta['mirror_http_template'][0], $atts['release'] ) . '" title="' . $mirror->post_title . ', ' . $mirror_meta['mirror_country'][0] . '">' . $mirror_meta['mirror_country'][0] . '</a>';
			if( strlen( $mirror_meta['mirror_lp_url'][0] ) > 0 ) {
				$out .= '<span class="mirror-lp-url"><a href="' . $mirror_meta['mirror_lp_url'][0] . '">' . _x( 'Info', 'Link to download mirror information on Launchpad', 'xubuntu' ) . '</a></span>';
			}
			$out .= '</li>';
		}
		$out .= '<li class="nobullet show-on-js"><a class="show-all" href="#show-all">' . __( 'Show all mirrors with full information', 'xubuntu' ) . '</a></li>';
		$out .= '</ul>';

		return $out;
	}
}

function release_download_url( $template, $release_slug ) {
	$release = get_term_by( 'slug', $release_slug, 'release' );

	return str_replace( 'VERSION', $release->name, $template );
}

?>