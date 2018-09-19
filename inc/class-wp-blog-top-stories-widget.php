<?php
/**
 * Widget API: WP_Blog_Top_Stories_Widget class
 */

class WP_Blog_Top_Stories_Widget extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' 				  => 'wp_blog_top_stories',
			'description' 				  => __( '' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wp_blog_top_stories', __( 'Top stories' ), $widget_ops );
		$this->alt_option_name = 'wp_blog_top_stories';
	}

	/**
	 * Outputs the content for the current Top stories widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Top stories' );

		$first_category_name  = ( ! empty( $instance['first_category_name'] ) ) ? $instance['first_category_name'] : __( 'Some cat' );
		$second_category_name = ( ! empty( $instance['second_category_name'] ) ) ? $instance['second_category_name'] : __( 'Some cat' );
		$third_category_name  = ( ! empty( $instance['third_category_name'] ) ) ? $instance['third_category_name'] : __( 'Some cat' );
		$first_color 		  = ( ! empty( $instance['first_color'] ) ) ? $instance['first_color'] : __( 'Some color' );
		$second_color		  = ( ! empty( $instance['second_color'] ) ) ? $instance['second_color'] : __( 'Some color' );
		$third_color 		  = ( ! empty( $instance['third_color'] ) ) ? $instance['third_color'] : __( 'Some color' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
		if ( ! $number ) {
			$number = 3;
		}

		/**
		 * Filters the arguments for the Top stories widget.
		 */
		$r1 = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'category_name' 	  => $first_category_name
		), $instance ) );

		$r2 = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'category_name' 	  => $second_category_name
		), $instance ) );

		$r3 = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'category_name' 	  => $third_category_name
		), $instance ) );
		?>
		<?php echo $args['before_widget']; ?>
		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>

		<div class="top_stories_content">
			<ul class="top_stories_list">
                <li class="top_stories_category">
                    <p class="<?php echo $first_color; ?>"><?php echo get_cat_name(get_cat_ID($first_category_name)); ?></p>
                </li>
                <li class="top_stories_category active">
                    <p class="<?php echo $second_color; ?>"><?php echo get_cat_name(get_cat_ID($second_category_name)); ?></p>
                </li>
                <li class="top_stories_category">
                    <p class="<?php echo $third_color; ?>"><?php echo get_cat_name(get_cat_ID($third_category_name)); ?></p>
                </li>
            </ul>
		</div>

		<div class="top_stories_three_pages">
			<div class="top_stories_pages">
				<?php foreach ( $r1->posts as $recent_post ) : ?>
					<?php
					$post_title = get_the_title( $recent_post->ID );
					$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
					$content_post = get_post($recent_post->ID);
					?>
					<div class="top_stories_page">
						<?php echo get_the_post_thumbnail($recent_post->ID, 'top_stories_img'); ?>
                        <p class="top_stories_page_heading">
                        	<a href="<?php the_permalink( $recent_post->ID ); ?>">
                        		<?php 
                        			echo (strlen($title) > 30) ? substr($title, 0, 27) . '...' : $title; 
                        		?>
                        	</a>
                        </p>
                        <p class="top_stories_page_text">
                        	<?php 
                        		$content = $content_post->post_content; 
                        		echo (strlen($content) > 133) ? substr($content, 0, 130) . '...' : substr($content, 0, 133); 
                        	?>
                        	</p>
					</div>
					<hr>
				<?php endforeach; ?>
			</div>
			<div class="top_stories_pages active">
				<?php foreach ( $r2->posts as $recent_post ) : ?>
					<?php
					$post_title = get_the_title( $recent_post->ID );
					$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
					$content_post = get_post($recent_post->ID);
					?>
					<div class="top_stories_page">
						<?php echo get_the_post_thumbnail($recent_post->ID, 'top_stories_img'); ?>
                        <p class="top_stories_page_heading">
                        	<a href="<?php the_permalink( $recent_post->ID ); ?>">
                        		<?php 
                        			echo (strlen($title) > 30) ? substr($title, 0, 27) . '...' : $title; 
                        		?>
                        	</a>
                        </p>
                        <p class="top_stories_page_text">
                        	<?php 
                        		$content = $content_post->post_content; 
                        		echo (strlen($content) > 133) ? substr($content, 0, 130) . '...' : substr($content, 0, 133); 
                        	?>
                        </p>
					</div>
					<hr>
				<?php endforeach; ?>
			</div>
			<div class="top_stories_pages">
				<?php foreach ( $r3->posts as $recent_post ) : ?>
					<?php
					$post_title = get_the_title( $recent_post->ID );
					$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
					$content_post = get_post($recent_post->ID);
					?>
					<div class="top_stories_page">
						<?php echo  get_the_post_thumbnail($recent_post->ID, 'top_stories_img'); ?>
                        <p class="top_stories_page_heading">
                        	<a href="<?php the_permalink( $recent_post->ID ); ?>">
                        		<?php 
                        			echo (strlen($title) > 30) ? substr($title, 0, 27) . '...' : $title; 
                        		?>
                        	</a>
                        </p>
                        <p class="top_stories_page_text">
                        	<?php 
                        		$content = $content_post->post_content; 
                        		echo (strlen($content) > 133) ? substr($content, 0, 130) . '...' : substr($content, 0, 133); 
                        	?>
                        </p>
					</div>
					<hr>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance 						  = $old_instance;
		$instance['title'] 				  = sanitize_text_field( $new_instance['title'] );
		$instance['first_category_name']  = sanitize_text_field( $new_instance['first_category_name'] );
		$instance['second_category_name'] = sanitize_text_field( $new_instance['second_category_name'] );
		$instance['third_category_name']  = sanitize_text_field( $new_instance['third_category_name'] );
		$instance['first_color'] 		  = sanitize_text_field( $new_instance['first_color'] );
		$instance['second_color'] 		  = sanitize_text_field( $new_instance['second_color'] );
		$instance['third_color'] 		  = sanitize_text_field( $new_instance['third_color'] );
		$instance['number'] 			  = (int) $new_instance['number'];
		return $instance;
	}

	/**
	 * Outputs the settings form for the Top stories widget.
	 */
	public function form( $instance ) {
		$title     			  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$first_category_name  = isset( $instance['first_category_name']) ? $instance['first_category_name'] : '';
		$second_category_name = isset( $instance['second_category_name']) ? $instance['second_category_name'] : '';
		$third_category_name  = isset( $instance['third_category_name']) ? $instance['third_category_name'] : '';
		$first_color 		  = isset( $instance['first_color']) ? $instance['first_color'] : '';
		$second_color  		  = isset( $instance['second_color']) ? $instance['second_color'] : '';
		$third_color 		  = isset( $instance['third_color']) ? $instance['third_color'] : '';
		$number    			  = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'first_category_name' ); ?>"><?php _e( 'Name or slug of first category to show:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'first_category_name' ); ?>" name="<?php echo $this->get_field_name( 'first_category_name' ); ?>" type="text" value="<?php echo $first_category_name; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'first_color' ); ?>"><?php _e( 'Color of first category to show:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'first_color' ); ?>" name="<?php echo $this->get_field_name( 'first_color' ); ?>" type="text" value="<?php echo $first_color; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'second_category_name' ); ?>"><?php _e( 'Name or slug of second category to show:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'second_category_name' ); ?>" name="<?php echo $this->get_field_name( 'second_category_name' ); ?>" type="text" value="<?php echo $second_category_name; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'second_color' ); ?>"><?php _e( 'Color of second category to show:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'second_color' ); ?>" name="<?php echo $this->get_field_name( 'second_color' ); ?>" type="text" value="<?php echo $second_color; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'third_category_name' ); ?>"><?php _e( 'Name or slug of second category to show:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'third_category_name' ); ?>" name="<?php echo $this->get_field_name( 'third_category_name' ); ?>" type="text" value="<?php echo $third_category_name; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'third_color' ); ?>"><?php _e( 'Color of second category to show:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'third_color' ); ?>" name="<?php echo $this->get_field_name( 'third_color' ); ?>" type="text" value="<?php echo $third_color; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}
