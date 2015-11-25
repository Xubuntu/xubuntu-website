<?php

/*  Articles widget
 *  
 */

add_action( 'widgets_init', function( ) { register_widget( 'XubuntuArticlesWidget' ); } );

class XubuntuArticlesWidget extends WP_Widget {
	/** constructor */
	function __construct( ) {
		$widget_ops = array( 'description' => __( 'Display recent articles', 'xubuntu' ) );
		parent::__construct( 'xubuntu_articles', _x( 'Recent Xubuntu articles', 'widget name', 'xubuntu' ), $widget_ops );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		$news_q = new WP_Query(
			array(
				'cat' => $instance['categories'],
				'posts_per_page' => '2'
			)
		);

		while( $news_q->have_posts( ) ) {
			$news_q->the_post( );

			echo $before_widget;
			echo '<h2>' . get_the_title( ) . '</h2>';
			echo '<p>' . get_the_excerpt( ) . '</p>';
			echo '<p><span class="more"><a class="button" href="' . get_permalink( ) . '">' . $instance['buttontext'] . '</a></span></p>';
			echo $after_widget;
		}

		echo $before_widget;
		if( !empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		echo '<p>' . $instance['description'] . '</p>';
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['description'] = $new_instance['description'];
		$instance['categories'] = implode( ',', $new_instance['categories'] );
		$instance['buttontext'] = $new_instance['buttontext'];

		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		$title = esc_attr( $instance['title'] );
		$description = esc_attr( $instance['description'] );
		$categories = explode( ',', $instance['categories'] );

		$buttontext = esc_attr( $instance['buttontext'] );
		if( strlen( $buttontext ) == 0 ) { $buttontext = __( 'Read more', 'xubuntu' ); }

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'xubuntu' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description', 'xubuntu' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $description; ?></textarea>
		</p>
		<p>
			<?php echo $instance['categories']; ?>
			<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Categories', 'xubuntu' ); ?><br />
				<select class="widefat" multiple="multiple" id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>[]" style="margin-top: 0.2em; height: 6.5em;">
					<?php
						foreach( get_terms( 'category' ) as $term ) {
							if( in_array( $term->term_id, $categories ) ) { $sel = true; } else { $sel = false; }
							print '<option value="' . $term->term_id . '"' . selected( $sel, true, false ) . '>' . $term->name . '</option>';
						}
					?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'buttontext' ); ?>"><?php _e( 'Button text', 'xubuntu' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'buttontext' ); ?>" name="<?php echo $this->get_field_name( 'buttontext' ); ?>" type="text" value="<?php echo $buttontext; ?>" />
		</p>
		<?php 
	}
}

?>