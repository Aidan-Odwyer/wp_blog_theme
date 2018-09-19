<?php
/**
 * Widget API: WP_Blog_Slider_Widget class
 */

class WP_Blog_Slider_Widget extends WP_Widget {

	/**
	 * Sets up a new Slider widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' 				  => 'wp_blog_slider',
			'description' 				  => esc_html__( '', 'wp_blog' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wp_blog_slider', esc_html__( 'Slider', 'wp_blog' ), $widget_ops );
		$this->alt_option_name = 'wp_blog_slider';
	}

	/**
	 * Outputs the content for the current Slider widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Top stories', 'wp_blog' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
		if ( ! $number ) {
			$number = 3;
		}

		/**
		 * Filters the arguments for the Slider widget.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		), $instance ) );
		?>
		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>

		<div class="slider">
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				$post_title   = get_the_title( $recent_post->ID );
				$title        = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				$content_post = get_post($recent_post->ID);
				$color 		  = ['blue', 'dark_blue', 'pink' ,'orange', 'green', 'red', 'grey'];
				?>
				
				<div class="slide">
	                <?php echo get_the_post_thumbnail($recent_post->ID, 'slider'); ?>
	                <a href="<?php the_permalink( $recent_post->ID ); ?>">
	                    <div class="slide_heading site_bc_<?php shuffle($color); echo $color[0]; ?>">
	                        <p>
	                        	<?php
	                        		$category = get_the_category($recent_post->ID); 
									echo $category[0]->cat_name; 
								?>	
	                        </p>
	                    </div>
	                </a>
	                <div class="slide_text">
	                    <p>
	                    	<a href="<?php the_permalink( $recent_post->ID ); ?>">
	                    		<?php 
		                    		$content = $content_post->post_content; 
		                    		echo (strlen($content) > 85) ? substr($content, 0, 82) . '...' : substr($content, 0, 85); 
		                    	?>
	                    	</a>
	                    </p>
	                </div>
	            </div>
			<?php endforeach; ?>
		</div>
		<?php
	}

	/**
	 * Handles updating the settings for the current Slider widget instance.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance 			= $old_instance;
		$instance['title'] 	= sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
	}

	/**
	 * Outputs the settings form for the Slider widget.
	 */
	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wp_blog' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'wp_blog' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}