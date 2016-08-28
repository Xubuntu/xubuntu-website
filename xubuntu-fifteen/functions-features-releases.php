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
			'show_in_nav_menus' => true,
			'show_tagcloud' => false,
			'show_in_quick_edit' => true,
			'meta_box_cb' => 'release_taxonomy_meta_box',
			'show_admin_column' => true,
			'description' => _x( 'Xubuntu releases', 'taxonomy description', 'xubuntu' ),
			'query_var' => true
		)
	);
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
		'type' => 'date'
	),
	'release_eol' => array(
		'label' => __( 'Release End of Life', 'xubuntu' ),
		'type' => 'date'
	)
);

add_action( 'release_edit_form_fields', 'release_taxonomy_custom_fields_edit', 10, 2 );
add_action( 'release_add_form_fields', 'release_taxonomy_custom_fields_add', 10, 2 );

function release_taxonomy_custom_fields_edit( $tax ) {
	global $taxonomy_release_fields;

	$term_id = $tax->term_id;
	$term_meta = get_option( 'taxonomy_term_' . $term_id );

	foreach( $taxonomy_release_fields as $id => $field ) {
		echo '<tr class="form-field">';
		echo '<th scope="row" valign="top">';
		echo '<label for="' . $id . '">' . $field['label'] . '</label>';
		echo '</th>';
		echo '<td>';
		echo '<input name="term_meta[' . $id . ']" id="' . $id . '" value="' . $term_meta[$id] . '" type="' . $field['type'] . '" />';
		if( 'date' == $field['type'] ) {
			echo '<p class="description">Date in YYYY-MM-DD format.</p>';
		}
		echo '</td>';
		echo '</tr>';
	}
}

function release_taxonomy_custom_fields_add( $tax ) {
	global $taxonomy_release_fields;

	if( isset( $tax->term_id ) ) {
		$term_id = $tax->term_id;
		$term_meta = get_option( 'taxonomy_term_' . $term_id );
	} else {
		$term_meta = get_option( 'taxonomy_term_0' );
	}

	foreach( $taxonomy_release_fields as $id => $field ) {
		echo '<div class="form-field">';
		echo '<label for="' . $id . '">' . $field['label'] . '</label>';
		echo '<input name="term_meta[' . $id . ']" id="' . $id . '" value="' . $term_meta[$id] . '" type="' . $field['type'] . '" />';
		if( 'date' == $field['type'] ) {
			echo '<p>Date in YYYY-MM-DD format.</p>';
		}
		echo '</div>';
	}
}

/*
 *  Handle saving custom fields
 *
 */

add_action( 'edited_release', 'release_taxonomy_custom_fields_save', 10, 2 );
add_action( 'created_release', 'release_taxonomy_custom_fields_save', 10, 2 );

function release_taxonomy_custom_fields_save( $term_id ) {
	if( isset( $_POST['term_meta'] ) ) {
		$term_meta = get_option( 'taxonomy_term_' . $term_id );
		$keys = array_keys( $_POST['term_meta'] );
		foreach( $keys as $key ) {
			if( isset( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}  
		}  

		update_option( 'taxonomy_term_' . $term_id, $term_meta );
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
			$release_meta = get_option( 'taxonomy_term_' . $release->term_id );
			if( $class != 'eol' && $release->release_is_eol == 1 ) {
				echo '<li class="nobullet show-on-js"><a class="show-eol" href="#show-eol">Show EOL releases</a></li>';
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
				$release_meta = get_option( 'taxonomy_term_' . $release->term_id );
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
		$release_meta = get_option( 'taxonomy_term_' . $release->term_id );

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

	usort( $releases, 'release_taxonomy_release_usort' );
	return $releases;
}

function release_taxonomy_release_usort( $a, $b ) {
	$eolcmp = strnatcmp( $a->release_is_eol, $b->release_is_eol );

	if( $eolcmp != 0 ) {
		return $eolcmp;
	} else {
		return strnatcmp( $b->name, $a->name );
	}
}

?>