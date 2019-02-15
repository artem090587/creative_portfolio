<?php

class Widget_Patch_Facebook_Like_Box extends WP_Widget {

	function __construct() {
		parent::__construct(
			'patch_facebook_like_box',
			esc_html__( 'Onliest: Facebook Like Box', 'onliestwp' ),
			array( 'description' => esc_html__( 'Facebook Like Box', 'onliestwp' ) )
		);
	}

	public function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_patch_facebook_like_box', 'widget' );

		if ( ! is_array( $cache ) ) $cache = array();

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = $this->id;


        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$url = isset( $instance['url'] ) ? esc_url( $instance['url'] ) : '';
		$height = isset( $instance['height'] ) ? esc_attr( $instance['height'] ) : '';
		$show_faces = isset( $instance['show_faces'] ) ? esc_attr( $instance['show_faces'] ) : '';
		$show_posts = isset( $instance['show_posts'] ) ? esc_attr( $instance['show_posts'] ) : '';

		ob_start();

		print $args['before_widget'];
		echo ( ! empty( $title ) ) ? $args['before_title'] . $title . $args['after_title'] : ''; ?>
		<div class="fb-like-box">
			<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo esc_url( $url ); ?>&amp;width=320&amp;height=<?php echo esc_attr($height); ?>&amp;colorscheme=light&amp;show_faces=<?php echo ( $show_faces ) ? 'true' : 'false'; ?>&amp;header=false&amp;stream=<?php echo ( $show_posts ) ? 'true' : 'false'; ?>&amp;show_border=false&amp;appId=1461883470698515" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:<?php echo esc_attr($height); ?>px;" allowTransparency="true"></iframe>
		</div>
		<?php print $args['after_widget'];

		$cache[ $args['widget_id'] ] = ob_get_flush();

		wp_cache_set( 'widget_patch_facebook_like_box', $cache, 'widget' );
	}

	public function form( $instance ) {

		$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$url        = isset( $instance['url'] ) ? $instance['url'] : '';
		$height     = isset( $instance['height'] ) ? absint( $instance['height'] ) : 558;
		$show_faces = isset( $instance['show_faces'] ) ? (bool) $instance['show_faces'] : false;
		$show_posts  = isset( $instance['show_posts'] ) ? (bool) $instance['show_posts'] : false;
		
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'onliestwp' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'url' )); ?>"><?php esc_html_e( 'Facebook Page URL:', 'onliestwp' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'url' )); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'height' )); ?>"><?php esc_html_e( 'Height in px:', 'onliestwp' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'height' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'height' )); ?>" type="text" value="<?php echo esc_attr($height); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_faces' )); ?>">
				<input class="checkbox" id="<?php echo esc_attr($this->get_field_id( 'show_faces' )); ?>" type="checkbox" <?php checked( $show_faces ); ?> name="<?php echo esc_attr($this->get_field_name( 'show_faces' )); ?>" />
				<?php esc_html_e( 'Show Faces?', 'onliestwp' ); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_posts' )); ?>">
				<input class="checkbox" id="<?php echo esc_attr($this->get_field_id( 'show_posts' )); ?>" type="checkbox" <?php checked( $show_posts ); ?> name="<?php echo esc_attr($this->get_field_name( 'show_posts' )); ?>" />
				<?php esc_html_e( 'Show Posts?', 'onliestwp' ); ?>
			</label>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url'] = $new_instance['url'];
		$instance['height'] = (int) $new_instance['height'];
		$instance['show_faces'] = (bool) $new_instance['show_faces'];
		$instance['show_posts'] = (bool) $new_instance['show_posts'];

		return $instance;
	}

}

// register
function register_widget_patch_facebook_like_box() {
    register_widget( 'Widget_Patch_Facebook_Like_Box' );
}
add_action( 'widgets_init', 'register_widget_patch_facebook_like_box' );