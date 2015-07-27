<?php

/*  News widget
 *  
 */

add_action( 'widgets_init', function( ) { register_widget( 'XubuntuNewsWidget' ); } );

class XubuntuNewsWidget extends WP_Widget {
	/** constructor */
	function __construct( ) {
		$widget_ops = array( 'description' => __( 'Display recent articles', 'xubuntu' ) );
		parent::__construct( 'xubuntu_news', _x( 'Recent Xubuntu articles', 'widget name', 'xubuntu' ), $widget_ops );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo '<div class="xubuntu_news group">';
		echo $before_widget;

		echo '<div class="items">';
		$news_q = new WP_Query( 'posts_per_page=2' );
		while( $news_q->have_posts( ) ) {
			$news_q->the_post( );

			print '<div class="item article-item">';
			print '<a href="' . get_permalink( ) . '">';
			print '<h2>' . get_the_title( ) . '</h2>';
			if( has_post_thumbnail( ) ) {
				echo '<div class="thumbnail">' . get_the_post_thumbnail( get_the_ID( ), 'xubuntu_news' ) . '</div>';
			}
			print '<p>' . get_the_excerpt( ) . '</p>';
			print '</a>';
			print '</div>';
		}
			echo '<div class="item">';
			if( !empty( $title ) ) {
				echo $before_title . $title . $after_title;
			}
			echo '<p>' . $instance['description'] . '</p>';
			if( get_option( 'show_on_front' ) == 'page' ) {
				print '<p class="more"><a class="button primary" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . __( 'More articles', 'xubuntu' ) . '</a></p>';
			}
			echo '</div>';

		echo '</div>';

		echo $after_widget;
		echo '</div>';
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['description'] = $new_instance['description'];

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
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description', 'xubuntu' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $description; ?></textarea>
		</p>
		<?php 
	}
}

?>