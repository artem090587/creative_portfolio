<?php

class Widget_Patch_Recent_Posts extends WP_Widget {

    function __construct() {
        parent::__construct(
            'patch_recent_posts',
            esc_html__( 'Onliest: Recent Posts', 'onliestwp' ),
            array( 'description' => esc_html__( 'Recent Posts list with thumbnail images', 'onliestwp' ) )
        );
    }

    public function widget( $args, $instance ) {
        $cache = wp_cache_get( 'widget_patch_recent_posts', 'widget' );

        if ( ! is_array( $cache ) ) $cache = array();
        
        if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = $this->id;

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
        
        global $wp_query; $temp = $wp_query;
		$wp_query = new WP_Query( array(
			'post_type'           => 'post',
			'posts_per_page'      => $number,
			'ignore_sticky_posts' => 1,
		) );

		ob_start();

        print $args['before_widget'];
        echo ( ! empty( $title ) ) ? $args['before_title'] . $title . $args['after_title'] : '';
        include( locate_template( 'loop-widget-posts.php' ) );
        print $args['after_widget'];

        $cache[ $args['widget_id'] ] = ob_get_flush();

        $wp_query = $temp; wp_reset_postdata();

        wp_cache_set( 'widget_patch_recent_posts', $cache, 'widget' );
    }

    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number']) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date']) ? (bool) $instance['show_date'] : false;
        
        ?>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'onliestwp' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'onliestwp' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>">
				<input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" type="checkbox" <?php checked( $show_date ); ?> name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
				<?php esc_html_e( 'Display post date?', 'onliestwp' ); ?>
			</label>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = $new_instance['number'];
        $instance['show_date'] = $new_instance['show_date'];

        return $instance;
    }
}

// Register
function register_widget_patch_recent_posts() {
    register_widget( 'Widget_Patch_Recent_Posts' );
}
add_action( 'widgets_init', 'register_widget_patch_recent_posts' );