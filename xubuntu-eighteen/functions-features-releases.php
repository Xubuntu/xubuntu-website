<?php

/*
 *  Register the release taxonomy
 *
 */

add_action( 'init', 'release_taxonomy_register' );

function release_taxonomy_register( ) {
	register_taxonomy(
		'release',
		array(
			'post',
			'attachment',
			'release_link' /* see functions-features-release-links.php */
		),
		array(
			'label' => _x( 'Releases', 'taxonomy label', 'xubuntu' ),
			'labels' => array(
				'name' => _x( 'Releases', 'taxonomy label: name', 'xubuntu' ),
				'singular_name' => _x( 'Release', 'taxonomy label: singular_name', 'xubuntu' ),
				'all_items' => _x( 'All Releases', 'taxonomy label: all_items', 'xubuntu' ),
				'edit_item' => _x( 'Edit Release', 'taxonomy label: edit_item', 'xubuntu' ),
				'view_item' => _x( 'View Release', 'taxonomy label: view_item', 'xubuntu' ),
				'update_item' => _x( 'Update Release', 'taxonomy label: update_item', 'xubuntu' ),
				'add_new_item' => _x( 'Add New Release', 'taxonomy label: add_new_item', 'xubuntu' ),
				'new_item_name' => _x( 'New Release Name', 'taxonomy label: new_item_name', 'xubuntu' ),
				'search_items' => _x( 'Search Releases', 'taxonomy label: search_items', 'xubuntu' ),
				'popular_items' => _x( 'Most Referenced Releases', 'taxonomy label: popular_items', 'xubuntu' ),
				'separate_items_with_commas' => _x( 'Separate releases with commas', 'taxonomy label: separate_items_with_commas', 'xubuntu' ),
				'add_or_remove_items' => _x( 'Add or remove releases', 'taxonomy label: add_or_remove_items', 'xubuntu' ),
				'choose_from_most_used' => _x( 'Choose from most referenced releases', 'taxonomy label: choose_from_most_used', 'xubuntu' ),
				'not_found' => _x( 'No releases found.', 'taxonomy label: not_found', 'xubuntu' ),
			),
			'public' => true,
			'show_in_menu' => false,
			'show_in_nav_menus' => true,
			'show_tagcloud' => false,
			'show_in_quick_edit' => true,
			'meta_box_cb' => 'release_taxonomy_meta_box',
			'show_admin_column' => true,
			'description' => _x( 'Xubuntu releases', 'taxonomy description', 'xubuntu' ),
			'query_var' => true,
			'rewrite' => array( 'with_front' => false ),
		)
	);
}

/*
 *  Add a custom admin menu page for releases
 *
 */

add_action( 'admin_menu', 'release_admin_menu' );

function release_admin_menu( ) {
	global $submenu;
	$icon = 'dashicons-flag';
	$icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjwhLS0gQ3JlYXRlZCB3aXRoIElua3NjYXBlIChodHRwOi8vd3d3Lmlua3NjYXBlLm9yZy8pIC0tPgoKPHN2ZwogICB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iCiAgIHhtbG5zOmNjPSJodHRwOi8vY3JlYXRpdmVjb21tb25zLm9yZy9ucyMiCiAgIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyIKICAgeG1sbnM6c3ZnPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIgogICB4bWxuczpzb2RpcG9kaT0iaHR0cDovL3NvZGlwb2RpLnNvdXJjZWZvcmdlLm5ldC9EVEQvc29kaXBvZGktMC5kdGQiCiAgIHhtbG5zOmlua3NjYXBlPSJodHRwOi8vd3d3Lmlua3NjYXBlLm9yZy9uYW1lc3BhY2VzL2lua3NjYXBlIgogICB3aWR0aD0iNjQiCiAgIGhlaWdodD0iNjQiCiAgIGlkPSJzdmczNjgxIgogICB2ZXJzaW9uPSIxLjEiCiAgIGlua3NjYXBlOnZlcnNpb249IjAuOTIuMyAoMjQwNTU0NiwgMjAxOC0wMy0xMSkiCiAgIHNvZGlwb2RpOmRvY25hbWU9Imljb25fYmxhY2tfc2hhcGUuc3ZnIgogICBpbmtzY2FwZTpleHBvcnQtZmlsZW5hbWU9Ii9kYXRhL2tub21lL09wZW4vWHVidW50dS9Mb2dvLzIwMTcvaWNvbi0xMDI0LnBuZyIKICAgaW5rc2NhcGU6ZXhwb3J0LXhkcGk9IjE0MzkuOTk5NSIKICAgaW5rc2NhcGU6ZXhwb3J0LXlkcGk9IjE0MzkuOTk5NSI+CiAgPGRlZnMKICAgICBpZD0iZGVmczM2ODMiIC8+CiAgPHNvZGlwb2RpOm5hbWVkdmlldwogICAgIGlkPSJiYXNlIgogICAgIHBhZ2Vjb2xvcj0iI2ZmZmZmZiIKICAgICBib3JkZXJjb2xvcj0iIzY2NjY2NiIKICAgICBib3JkZXJvcGFjaXR5PSIxLjAiCiAgICAgaW5rc2NhcGU6cGFnZW9wYWNpdHk9IjAuMCIKICAgICBpbmtzY2FwZTpwYWdlc2hhZG93PSIyIgogICAgIGlua3NjYXBlOnpvb209IjcuOTk5OTk5NiIKICAgICBpbmtzY2FwZTpjeD0iNjAuODYyODIyIgogICAgIGlua3NjYXBlOmN5PSI0My4wNzM1IgogICAgIGlua3NjYXBlOmRvY3VtZW50LXVuaXRzPSJweCIKICAgICBpbmtzY2FwZTpjdXJyZW50LWxheWVyPSJsYXllcjEiCiAgICAgc2hvd2dyaWQ9ImZhbHNlIgogICAgIGZpdC1tYXJnaW4tdG9wPSIwIgogICAgIGZpdC1tYXJnaW4tbGVmdD0iMCIKICAgICBmaXQtbWFyZ2luLXJpZ2h0PSIwIgogICAgIGZpdC1tYXJnaW4tYm90dG9tPSIwIgogICAgIGlua3NjYXBlOndpbmRvdy13aWR0aD0iMTYzMyIKICAgICBpbmtzY2FwZTp3aW5kb3ctaGVpZ2h0PSIxMzE5IgogICAgIGlua3NjYXBlOndpbmRvdy14PSI5ODAiCiAgICAgaW5rc2NhcGU6d2luZG93LXk9IjAiCiAgICAgaW5rc2NhcGU6d2luZG93LW1heGltaXplZD0iMCIKICAgICBzaG93Z3VpZGVzPSJmYWxzZSIgLz4KICA8bWV0YWRhdGEKICAgICBpZD0ibWV0YWRhdGEzNjg2Ij4KICAgIDxyZGY6UkRGPgogICAgICA8Y2M6V29yawogICAgICAgICByZGY6YWJvdXQ9IiI+CiAgICAgICAgPGRjOmZvcm1hdD5pbWFnZS9zdmcreG1sPC9kYzpmb3JtYXQ+CiAgICAgICAgPGRjOnR5cGUKICAgICAgICAgICByZGY6cmVzb3VyY2U9Imh0dHA6Ly9wdXJsLm9yZy9kYy9kY21pdHlwZS9TdGlsbEltYWdlIiAvPgogICAgICAgIDxkYzp0aXRsZT48L2RjOnRpdGxlPgogICAgICA8L2NjOldvcms+CiAgICA8L3JkZjpSREY+CiAgPC9tZXRhZGF0YT4KICA8ZwogICAgIGlua3NjYXBlOmxhYmVsPSJMYXllciAxIgogICAgIGlua3NjYXBlOmdyb3VwbW9kZT0ibGF5ZXIiCiAgICAgaWQ9ImxheWVyMSIKICAgICB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtNTAxLjMxMjAzLC00OTQuMDMxNjQpIj4KICAgIDxwYXRoCiAgICAgICBzdHlsZT0iZmlsbDojMDAwMDAwO2ZpbGwtb3BhY2l0eToxO3N0cm9rZTpub25lIgogICAgICAgZD0iTSAzMiAwIEEgMzIgMzIgMCAwIDAgMCAzMiBBIDMyIDMyIDAgMCAwIDMyIDY0IEEgMzIgMzIgMCAwIDAgNjQgMzIgQSAzMiAzMiAwIDAgMCAzMiAwIHogTSA0Mi41MzEyNSAxMS45MzE2NDEgQyA0My40MjE5MTYgMTIuMDkzNjYgNDIuODE3MDc1IDE2LjI5OTM1OSA0Mi41NzgxMjUgMTguODU3NDIyIEMgNDIuMzYxODY1IDIxLjE3MjU2MiA0Mi4yNDEzOTQgMjEuOTM1MTU0IDQxLjgwODU5NCAyNC40OTAyMzQgQyA0MS42NzI2MDQgMjUuMjkzMDU0IDQxLjI3Mjk2MSAyNi4zMjEyOTggNDAuMDI1MzkxIDI2LjE3MzgyOCBDIDM4Ljk3ODg4MSAyNi4wNDExNjggMzguODExMjAzIDI0LjMxODE3MSAzOC44NDU3MDMgMjMuNTE5NTMxIEMgMzguOTA0OTgzIDIyLjE0ODE2MSAzOS42NTM5NzEgMTguODA3NzMyIDM5Ljg5NDUzMSAxNy42MDc0MjIgQyA0MC4yMDMzMjEgMTYuMDY2NjYyIDQxLjE0NTIyMSAxMi4zODk5MDggNDIuMzMyMDMxIDExLjk1NTA3OCBDIDQyLjQwNTI0NiAxMS45MjgyNTMgNDIuNDcxODcyIDExLjkyMDgzOSA0Mi41MzEyNSAxMS45MzE2NDEgeiBNIDUwLjg4NjcxOSAxMy44MjgxMjUgQyA1Mi42NzE1NTkgMTMuNTcxNjg1IDQ5Ljk2NjM0MiAxOC40MDY2MzggNDguODgyODEyIDIwLjkyMzgyOCBDIDQ4LjE0NjI5MyAyMi42MzQ4NjggNDcuNjE4NzEzIDI0LjAwNTI2OCA0Ni42NjQwNjIgMjYuMjY3NTc4IEMgNDYuMzQ3NDkzIDI3LjAxNzc2OCA0NS4zNzM2NDcgMjguMDk2OTIzIDQ0LjI0ODA0NyAyNy41MzkwNjIgQyA0My4zMDM1ODcgMjcuMDcwOTg0IDQzLjYyNzEzNyAyNS42OTQ3MDkgNDQuMzEwNTQ3IDI0LjA5OTYwOSBDIDQ1LjI5NDgxNyAyMS44MDIyNTkgNDYuMTAzNjgxIDIwLjI2Njc1NiA0Ny4xNDQ1MzEgMTguNTM1MTU2IEMgNDcuOTUxODAxIDE3LjE4Njk1NiA0OS42MzU1ODkgMTQuMDA3ODg1IDUwLjg4NjcxOSAxMy44MjgxMjUgeiBNIDI2LjI4MzIwMyAxNS4wNzIyNjYgQyAyNy4xMTQ1NzMgMTUuMTMwNjI2IDI3LjgwNzcyMyAxNS40OTY2MDYgMjguMjgzMjAzIDE2LjA3MjI2NiBDIDMwLjMzNjIyMyAxOC41NTc4NTYgMjkuOTAyODMxIDIyLjgyNDEwNiAzMC4wODIwMzEgMjYuMDY2NDA2IEMgMzMuMjgyMzAxIDI2LjI0MDUzNiAzNS45MjIyMTEgMjYuNjI4NzUgMzkuMzMyMDMxIDI3LjYyNSBDIDQxLjkzMDc2MSAyOC4zODQyOCA0NS41MjcwMzQgMjkuNjU1ODE4IDQ3LjYzMjgxMiAzMS4wMjM0MzggQyA0OS43MzA3ODQgMzIuMzg1OTk4IDUxLjMwNDY2MiAzNC4xNTAyMzggNTEuNjMyODEyIDM2LjUyMzQzOCBDIDUxLjgzNjQzMyAzNy45OTYwNTcgNTAuNzE2OTMxIDM5LjQ3Mjk1NiA0OS4xODE2NDEgNDAuODIyMjY2IEMgNDcuNjQ4ODMxIDQyLjE2OTM4NiA0NS42NDQxNjIgNDMuNDM1NzA3IDQzLjQ4MjQyMiA0NC42MjMwNDcgQyA0MS4zMjE3MzIgNDUuODA5ODE3IDM5LjA3NDg4MyA0Ni44ODcyMTYgMzcuMjgzMjAzIDQ3LjcyMjY1NiBDIDMzLjM3MzQxMyA0OS41NDU3NTYgMjkuMjQwMTYyIDUxLjMyMjM5NCAyNC4xNjk5MjIgNTEuODMzOTg0IEMgMTAuNDIzNDYyIDUzLjIyMTAxNCAxMS45MjM3NDEgNDAuNzQ2MTg3IDEyLjQ1NzAzMSAzNi42MjMwNDcgQyAxMi44NzI0NTEgMzMuNDExMTk3IDE0LjU5MTQ1MyAyOC43Nzc3MzQgMTQuODc2OTUzIDI3LjkzMzU5NCBDIDE0LjUwMjc1MyAyNi43NDUwMzQgMTQuMjExMjcyIDI1Ljc0MjgwNiAxMy45ODI0MjIgMjQuNDcyNjU2IEMgMTMuNzg3OTgyIDIzLjM5MzQ4NiAxMy42ODMxMzEgMjIuMTQ5NTI2IDEzLjkzMTY0MSAyMS4wNzIyNjYgQyAxNC4xNzY1MzEgMjAuMDEwNzM2IDE0Ljg5MDQ4NiAxOC44Mjc3MjQgMTYuMDcyMjY2IDE4LjMzMzk4NCBDIDE3LjAwOTA3NiAxNy45NDI1ODQgMTcuNjk2NzI2IDE4LjA5NzMxNSAxOC41NzIyNjYgMTguODkwNjI1IEMgMTkuMjkzMDc2IDE5LjU0MzczNSAxOS44OTc0MzIgMjAuNTExMTY4IDIwLjQ4MjQyMiAyMS41MjM0MzggQyAyMS4zMjgxNTIgMjIuOTg2ODg3IDIxLjY3MjUwNCAyNC41MDU2MjcgMjIuMzk2NDg0IDI1Ljk5MjE4OCBDIDIyLjUzNjQ3NCAyNi4yNzk1MDcgMjMuMjU5NzgxIDI2LjQxMTg3MiAyMy42ODE2NDEgMjYuMjg5MDYyIEMgMjMuNzc5ODIxIDI2LjI2MDQ4MiAyMy44ODgxMzEgMjYuMDEzOTU2IDIzLjgzMjAzMSAyNS44MjIyNjYgQyAyMi45MDI5MDEgMjIuNjQ1MTE2IDIyLjIzODY3MiAyMC4wMTgwNTYgMjIuNzAxMTcyIDE3LjcyMjY1NiBDIDIzLjEzMDUwMiAxNS41OTE4ODYgMjQuOTQ3MTMzIDE1LjEyNjA2NiAyNi4yODMyMDMgMTUuMDcyMjY2IHogIgogICAgICAgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNTAxLjMxMjAzLDQ5NC4wMzE2NCkiCiAgICAgICBpZD0icGF0aDEyODc4IiAvPgogIDwvZz4KPC9zdmc+Cg==';
	add_menu_page( __( 'Releases', 'xubuntu' ), __( 'Releases', 'xubuntu' ), 'manage_categories', 'release_admin', 'release_admin_page', $icon, 24 );

	// Releases taxonomy
	$release_tax_admin_url = admin_url( 'edit-tags.php?taxonomy=release' );
	$submenu['release_admin'][] = array( __( 'Releases', 'xubuntu' ), 'manage_categories', $release_tax_admin_url );

	// Mirror post type
	$mirror_admin_url = admin_url( 'edit.php?post_type=download_mirror' );
	$submenu['release_admin'][] = array( __( 'Mirrors', 'xubuntu' ), 'manage_categories', $mirror_admin_url );

	// Release link post type
	$release_link_admin_url = admin_url( 'edit.php?post_type=release_link' );
	$submenu['release_admin'][] = array( __( 'Links', 'xubuntu' ), 'manage_categories', $release_link_admin_url );
}

add_action( 'admin_head', 'release_menu_highlight' );

function release_menu_highlight( ) {
	global $parent_file, $submenu_file, $post_type;

	if( 'edit-tags.php?taxonomy=release' == $submenu_file ||
		'download_mirror' == $post_type ||
		'release_link' == $post_type ) {
		$parent_file = 'release_admin';
		$submenu_file = admin_url( $submenu_file );
	}
	if( 'download_mirror' == $post_type ||
		'release_link' == $post_type ) {
		$submenu_file = admin_url( 'edit.php?post_type=' . $post_type );
	}
}

function release_admin_page( ) {
	echo 'Hello!';
}

/*
 *  Register custom fields
 *
 */

$taxonomy_release_fields = array(
	'release_codename' => array(
		'label' => __( 'Release Codename', 'xubuntu' ),
		'type' => 'text'
	),
	'release_date' => array(
		'label' => __( 'Release Date', 'xubuntu' ),
		'type' => 'date',
		'description' => __( 'Date in YYYY-MM-DD format.', 'xubuntu' )
	),
	'release_lts' => array(
		'label' => __( 'LTS?', 'xubuntu' ),
		'type' => 'checkbox',
		'check_label' => 'This release is a long term support (LTS) release.',
	),
	'release_eol' => array(
		'label' => __( 'Release End of Life', 'xubuntu' ),
		'type' => 'date',
		'description' => __( 'Date in YYYY-MM-DD format.', 'xubuntu' )
	),
	'release_torrent_32bit' => array(
		'label' => __( 'Torrent download link (32-bit)', 'xubuntu' ),
		'type' => 'url',
		'description' => __( 'The download link for the 32-bit image; for LTS, always use the latest point release link. Will be hidden after the release goes EOL.', 'xubuntu' )
	),
	'release_torrent_64bit' => array(
		'label' => __( 'Torrent download link (64-bit)', 'xubuntu' ),
		'type' => 'url',
		'description' => __( 'The download link for the 64-bit image; for LTS, always use the latest point release link. Will be hidden after the release goes EOL.', 'xubuntu' )
	),
	'release_documentation_link' => array(
		'label' => __( 'Online Documentation', 'xubuntu' ),
		'type' => 'url',
		'description' => __( 'URL for the online documentation for the release. Will be hidden after the release goes EOL.', 'xubuntu' )
	),
	'release_released' => array(
		'label' => __( 'Released?', 'xubuntu' ),
		'type' => 'checkbox',
		'check_label' => 'This release is officially released.',
		'description' => __( 'Controls the visibility of release links on the release apes; check this box once released and links will appear.', 'xubuntu' )
	),
);

add_action( 'release_edit_form_fields', 'release_taxonomy_custom_fields_edit', 10, 2 );
add_action( 'release_add_form_fields', 'release_taxonomy_custom_fields_add', 10, 2 );

function release_taxonomy_custom_fields_edit( $tax ) {
	global $taxonomy_release_fields;

	if( isset( $tax->term_id ) ) {
		$term_meta = get_release_meta( $tax->term_id );
	}

	foreach( $taxonomy_release_fields as $id => $field ) {
		echo '<tr class="form-field">';
		echo '<th scope="row" valign="top">';
		echo '<label for="' . $id . '">' . $field['label'] . '</label>';
		echo '</th>';
		echo '<td>';
		switch( $field['type'] ) {
			case 'checkbox':
				echo '<input name="term_meta[' . $id . ']" id="' . $id . '" ' . ( !isset( $term_meta[$id] ) ? '' : checked( $term_meta[$id], '1', false ) ) . ' type="checkbox" /> ' . $field['check_label'];
				break;
			default:
				echo '<input name="term_meta[' . $id . ']" id="' . $id . '" value="' . ( !isset( $term_meta ) ? '' : $term_meta[$id] ) . '" type="' . $field['type'] . '" />';
		}
		if( isset( $field['description'] ) ) {
			echo '<p class="description">' . $field['description'] . '</p>';
		}
		echo '</td>';
		echo '</tr>';
	}
}

function release_taxonomy_custom_fields_add( $tax ) {
	global $taxonomy_release_fields;

	if( isset( $tax->term_id ) ) {
		$term_meta = get_release_meta( $tax->term_id );
	}

	foreach( $taxonomy_release_fields as $id => $field ) {
		echo '<div class="form-field">';
		echo '<label for="' . $id . '">' . $field['label'] . '</label>';
		switch( $field['type'] ) {
			case 'checkbox':
				echo '<input name="term_meta[' . $id . ']" id="' . $id . '" ' . ( !isset( $term_meta[$id] ) ? '' : checked( $term_meta[$id], '1', false ) ) . ' type="checkbox" /> ' . $field['check_label'];
				break;
			default:
				echo '<input name="term_meta[' . $id . ']" id="' . $id . '" value="' . ( !isset( $term_meta ) ? '' : $term_meta[$id] ) . '" type="' . $field['type'] . '" />';
		}
		if( 'date' == $field['type'] ) {
			echo '<p>Date in YYYY-MM-DD format.</p>';
		}
		echo '</div>';
	}
}

/*
 *  Handle saving custom fields
 *  TODO: Are nonces needed here?
 *
 */

add_action( 'edited_release', 'release_taxonomy_custom_fields_save', 10, 2 );
add_action( 'created_release', 'release_taxonomy_custom_fields_save', 10, 2 );

function release_taxonomy_custom_fields_save( $term_id ) {
	if( isset( $_POST['term_meta'] ) ) {
		$term_meta = get_release_meta( $term_id );
		foreach( $_POST['term_meta'] as $key => $value ) {
			if( isset( $value ) ) {
				$term_meta[$key] = $value;
			}
		}
		if( isset( $_POST['term_meta']['release_lts'] ) ) { $term_meta['release_lts'] = 1; } else { $term_meta['release_lts'] = 0; }
		if( isset( $_POST['term_meta']['release_released'] ) ) { $term_meta['release_released'] = 1; } else { $term_meta['release_released'] = 0; }

		update_term_meta( $term_id, 'release_information', $term_meta );
		// TODO: Temporarily keep deleting options
		delete_option( 'taxonomy_term_' . $term_id );
	}
}

/*
 *  Add a custom meta box
 *
 */

function release_taxonomy_meta_box( ) {
	$releases = release_taxonomy_get_releases_sorted( );

	if( is_array( $releases ) ) {
		$class = '';
		echo '<ul class="releases">';
		foreach( $releases as $release ) {
			$release_meta = get_release_meta( $release->term_id );
			if( $class != 'eol' && $release->release_is_eol == 1 ) {
				echo '<li class="nobullet show-on-js"><a class="show-eol" href="#show-eol">' . __( 'Show EOL releases', 'xubuntu' ) . '</a></li>';
				$class = 'eol';
			}

			echo '<li class="' . $class . '">';
			echo '<label class="selectit">';
			echo '<input type="checkbox" name="tax_input[release][]" id="release" value="' . $release->slug . '" ' . checked( has_term( $release->term_id, 'release' ), true, false ) . '/>';
			echo ' <strong>' . $release->name . '</strong> &nbsp;' . $release_meta['release_codename'];
			echo '</label>';
			echo '</li>';
		}
		echo '</ul>';
	}
}

/*
 *  Enable filtering posts by release
 *
 */

add_action( 'restrict_manage_posts', 'release_taxonomy_post_filter' );

function release_taxonomy_post_filter( ) {
	global $typenow;
	global $wp_query;

	if( 'post' == $typenow ) {
		wp_dropdown_categories( array(
			'show_option_all' => _x( 'All releases', 'filter dropdown', 'xubuntu' ),
			'taxonomy' => 'release',
			'name' => 'release',
			'selected' => $wp_query->query['release'],
		) );
    }
}

add_filter( 'parse_query', 'release_taxonomy_post_filter_execute' );

function release_taxonomy_post_filter_execute( $query ) {
	global $pagenow;
	$qv = &$query->query_vars;

	if( 'edit.php' == $pagenow &&
		isset( $qv['release'] ) &&
		is_numeric( $qv['release'] ) ) {
		$term = get_term_by( 'id', $qv['release'], 'release' );
		$qv['release'] = $term->slug;
	}
}

/*
 *  Widget for showing releases
 *  
 */

add_action( 'widgets_init', function( ) { register_widget( 'XubuntuReleasesWidget' ); } );

class XubuntuReleasesWidget extends WP_Widget {
	/** constructor */
	function __construct( ) {
		$widget_ops = array( 'description' => __( 'Display a list of registered releases', 'xubuntu' ) );
		parent::__construct( 'xubuntu_releases', _x( 'Releases', 'widget name', 'xubuntu' ), $widget_ops );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		extract( $args );
		if( $instance['title'] ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
		}

		echo $before_widget;
		if( !empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		$releases = release_taxonomy_get_releases_sorted( );

		if( is_array( $releases ) ) {
			echo '<ul class="releases group">';
			foreach( $releases as $release ) {
				$release_meta = get_release_meta( $release->term_id );
				if( strlen( $release_meta['release_codename'] ) > 0 ) {
					$release->name .= ', ' . $release_meta['release_codename'];
				}
				if( $release->release_is_eol == 1 ) {
					if( !isset( $first_eol ) ) {
						echo '<li class="nobullet show-on-js"><a class="show-eol" href="#show-eol">Show EOL releases</a></li>';
						$first_eol = true;
					}
					echo '<li class="eol"><a href="' . get_term_link( $release ) . '">' . $release->name . '</a></li>';
				} else {
					echo '<li><a href="' . get_term_link( $release ) . '">' . $release->name . '</a></li>';
				}
			}
			echo '</ul>';
		}
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		$title = esc_attr( $instance['title'] );
		$description = esc_attr( $instance['description'] );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'xubuntu' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php 
	}
}

/*
 *  Custom sort for the releases (EOL releases last)
 *
 */

function release_taxonomy_get_releases_sorted( ) {
	$releases = get_terms( 'release', array( 'hide_empty' => false ) );
	$date_now = new DateTime( 'now' );

	foreach( $releases as $release_id => $release ) {
		$release_meta = get_release_meta( $release->term_id );

		if( isset( $release_meta['release_eol'] ) ) {
			$date_eol = new DateTime( $release_meta['release_eol'] );
			if( $date_eol->format( 'Ymd' ) <= $date_now->format( 'Ymd' ) ) {
				$releases[$release_id]->release_is_eol = 1;
			} else {
				$releases[$release_id]->release_is_eol = 0;
			}
		} else {
			$releases[$release_id]->release_is_eol = 0;
		}
	}

	usort( $releases, 'release_taxonomy_release_usort_eol_last' );
	return $releases;
}

function release_taxonomy_release_usort_eol_last( $a, $b ) {
	$eolcmp = strnatcmp( $a->release_is_eol, $b->release_is_eol );

	if( $eolcmp != 0 ) {
		return $eolcmp;
	} else {
		return strnatcmp( $b->name, $a->name );
	}
}

function release_taxonomy_release_usort( $a, $b ) {
	return strnatcmp( $b->name, $a->name );
}

/*
 *  Add a shortcode to print the torrent link buttons
 *
 */

add_shortcode( 'torrents', 'release_torrent_links' );

function release_torrent_links( $atts ) {
	$atts = shortcode_atts(
		array(
			'release' => false,
		),
		$atts,
		'torrents'
	);

	if( strlen( $atts['release'] ) < 1 ) {
		return;
	}

	$release = get_term_by( 'slug', $atts['release'], 'release' );
	$release_meta = get_release_meta( $release->term_id );
	$out = '';

	if( isset( $release_meta['release_torrent_64bit'] ) ) {
		$out .= '<a class="button primary" href="' . $release_meta['release_torrent_64bit'] . '">' . _x( '<strong>64-bit</strong> systems', 'torrent download link', 'xubuntu' ) . '</a>';
	}
	if( isset( $release_meta['release_torrent_32bit'] ) ) {
		$out .= '<a class="button" href="' . $release_meta['release_torrent_32bit'] . '">' . __( '<strong>32-bit</strong> systems', 'torrent download link', 'xubuntu' ) . '</a>';
	}

	if( strlen( $out ) > 0 ) {
		return '<p>' . $out . '</p>';
	}
}

/*
 *  Add a shortcode to list all online documentation links for released, non-EOL releases
 *
 */

add_shortcode( 'documentation_links', 'release_documentation_links' );

function release_documentation_links( $atts ) {
	$releases = release_taxonomy_get_releases_sorted( );

	if( is_array( $releases ) ) {
		$date_now = new DateTime( 'now' );
		$out = '<ul>';
		foreach( $releases as $release ) {
			$release_meta = get_release_meta( $release->term_id );

			if( isset( $release_meta['release_documentation_link'] ) && strlen( $release_meta['release_documentation_link'] ) > 0 && isset( $release_meta['release_released'] ) && $release_meta['release_released'] == 1 ) {
				$date_release = new DateTime( $release_meta['release_date'] );

				if( strlen( $release_meta['release_codename'] ) > 0 ) {
					$release->name .= ' (' . $release_meta['release_codename'] . ')';
				}
				if( $release->release_is_eol == 0 && $date_release->format( 'Ymd' ) <= $date_now->format( 'Ymd' ) ) {
					$date_eol = new DateTime( $release_meta['release_eol'] );
					$out .= '<li><strong><a href="' . $release_meta['release_documentation_link'] . '">Xubuntu ' . $release->name . '</a></strong>, supported until ' . $date_eol->format( 'F Y' ) . '</li>';
				}
			}
		}
		$out .= '</ul>';

		return $out;
	}
}

/*
 *  Get release metadata
 *
 */

function get_release_meta( $release ) {
	$meta = get_term_meta( $release, 'release_information', true );

	// TODO: Temporary check to migrate data from options to term_meta
	if( $meta == false ) {
		$meta = get_option( 'taxonomy_term_' . $release );
		update_term_meta( $release, 'release_information', $meta );
		delete_option( 'taxonomy_term_' . $release );
	}

	return $meta;
}

?>