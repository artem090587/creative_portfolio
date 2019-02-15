<?php

class Widget_Patch_About extends WP_Widget {

    function __construct() {
        parent::__construct(
            'patch_about',
            esc_html__( 'Onliest: About', 'onliestwp' ),
            array( 'description' => esc_html__( 'Display biography with image and your sign.', 'onliestwp' ) )
        );

        $this->defaults = array( 'title' => 'About Us', 'subtitle' => '' );
    }

    public function widget( $args, $instance ) {
        $cache = wp_cache_get( 'widget_patch_about', 'widget' );

        if ( ! is_array( $cache ) ) $cache = array();
        
        if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = $this->id;

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
        $image = isset( $instance['image'] ) ? esc_url( $instance['image'] ) : '';
        $subtitle = isset( $instance['subtitle'] ) ? esc_attr( $instance['subtitle'] ) : '';
        $rounded = isset( $instance['rounded'] ) ? esc_attr( $instance['rounded'] ) : '';
		$description = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : '';
        $signing = isset( $instance['signing'] ) ? esc_url( $instance['signing'] ) : '';
        
        ob_start();

        print $args['before_widget'];
        echo ( ! empty( $title ) ) ? $args['before_title'] . $title . $args['after_title'] : ''; ?>
        <div class="patch-about">
            <?php if($image) : ?>
            <div class="patch-about-img">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" <?php if($rounded == true) : ?>class="rounded"<?php endif; ?>/>
            </div>
            <?php endif; ?>

            <?php if($subtitle) : ?>
            <h5 class="patch-about-title"><?php echo wp_kses_post($subtitle); ?></h5>
            <?php endif; ?>
            
            <?php if($description) : ?>
            <p><?php echo wp_kses_post($description); ?></p>
            <?php endif; ?>
            
            <?php if($signing) : ?>
            <div class="patch-about-autograph"><img src="<?php echo esc_url($signing); ?>" alt="<?php echo esc_attr($title); ?>" /></div>
            <?php endif; ?>
        </div>
        <?php print $args['after_widget'];

        $cache[ $args['widget_id'] ] = ob_get_flush();

        wp_cache_set( 'widget_patch_about', $cache, 'widget' );
    }

    public function form( $instance ) {
        $defaults = array( 'title' => 'About Me', 'image' => '', 'rounded' => '', 'subtitle' => '', 'description' => '', 'signing' => '');
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'onliestwp' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:96%;" />
        </p>

        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'image' )); ?>"><?php esc_html_e( 'Image URL:', 'onliestwp' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'image' )); ?>" value="<?php echo esc_attr($instance['image']); ?>" style="width:96%;" /><br />
        </p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'rounded' )); ?>"><?php esc_html_e( 'Make image a circle:', 'onliestwp' ); ?></label>
            <input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'rounded' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rounded' )); ?>" <?php checked( (bool) $instance['rounded'], true ); ?> /><br />
            <small>For a perfect circle your image need to have the same height and width. For example: 260x260</small>
        </p>
        
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>"><?php esc_html_e( 'Subtitle:', 'onliestwp' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'subtitle' )); ?>" value="<?php echo esc_attr($instance['subtitle']); ?>" style="width:96%;" /><br />
        </p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php esc_html_e( 'Short Biography:', 'onliestwp' ); ?></label>
			<textarea id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" style="width:95%;" rows="6"><?php echo esc_attr($instance['description']); ?></textarea>
        </p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'signing' )); ?>"><?php esc_html_e( 'Autograph Image URL:', 'onliestwp' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'signing' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'signing' )); ?>" value="<?php echo esc_attr($instance['signing']); ?>" style="width:96%;" /><br />
		</p>
        <?php    
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
        $instance['subtitle'] = $new_instance['subtitle'];
        $instance['rounded'] = $new_instance['rounded'];
		$instance['description'] = $new_instance['description'];
		$instance['signing'] = strip_tags( $new_instance['signing'] );
        
        return $instance;
    }


}

// Register
function register_widget_patch_about() {
    register_widget( 'Widget_Patch_About' );
}
add_action( 'widgets_init', 'register_widget_patch_about' );