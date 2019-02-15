<?php

class Widget_Patch_Icon_List extends WP_Widget {

    public function __construct() {
        // Widget settings
        $widget_ops = array( 'classname' => 'patch-contact-info-widget', 'description' => esc_html__( 'Displays the site contact info.', 'onliestwp' ) );
        
        // Create the widget calling the parent class construct method
        parent::__construct(
            'patch_contact_info_widget',
            esc_html__('Onliest: Contact Info', 'onliestwp'),
            $widget_ops
        );
    }
    
    public function form( $instance ) {
        
        // Set default widget settings
        $defaults = array( 'title' => esc_html__('Contact Info', 'onliestwp' ), 'phone_icon' => 'fa-phone', 'phone_text' => '', 'email_icon' => 'fa-envelope', 'email_text' => '', 'website_icon' => 'fa-globe', 'website_text' => '', 'address_icon' => 'fa-home', 'address_text' => '' );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
          
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title', 'onliestwp' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
                        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('phone_icon') ); ?>"><?php esc_html_e('Phone Icon:', 'onliestwp' ); ?></label>
            <input type="text"  class="widefat" id="<?php echo esc_attr( $this->get_field_id('phone_icon') ); ?>" name="<?php echo esc_attr( $this->get_field_name('phone_icon') ); ?>" value="<?php echo esc_attr( $instance['phone_icon'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('phone_text') ); ?>"><?php esc_html_e('Phone Text:', 'onliestwp' ); ?></label>
            <input type="text"  class="widefat" id="<?php echo esc_attr( $this->get_field_id('phone_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('phone_text') ); ?>" value="<?php echo esc_attr( $instance['phone_text'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('email_icon') ); ?>"><?php esc_html_e('Email Icon:', 'onliestwp' ); ?></label>
            <input type="text"  class="widefat" id="<?php echo esc_attr( $this->get_field_id('email_icon') ); ?>" name="<?php echo esc_attr( $this->get_field_name('email_icon') ); ?>" value="<?php echo esc_attr( $instance['email_icon'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('email_text') ); ?>"><?php esc_html_e('Email Text:', 'onliestwp' ); ?></label>
            <input type="text"  class="widefat" id="<?php echo esc_attr( $this->get_field_id('email_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('email_text') ); ?>" value="<?php echo esc_attr( $instance['email_text'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('address_icon') ); ?>"><?php esc_html_e('Address Icon:', 'onliestwp' ); ?></label>
            <input type="text"  class="widefat" id="<?php echo esc_attr( $this->get_field_id('address_icon') ); ?>" name="<?php echo esc_attr( $this->get_field_name('address_icon') ); ?>" value="<?php echo esc_attr( $instance['address_icon'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('address_text') ); ?>"><?php esc_html_e('Address Text:', 'onliestwp' ); ?></label>
            <textarea rows="5" class="widefat" id="<?php echo esc_attr( $this->get_field_id('address_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('address_text') ); ?>" ><?php echo esc_html( $instance['address_text'] ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('website_icon') ); ?>"><?php esc_html_e('Website Icon:', 'onliestwp' ); ?></label>
            <input type="text"  class="widefat" id="<?php echo esc_attr( $this->get_field_id('website_icon') ); ?>" name="<?php echo esc_attr( $this->get_field_name('website_icon') ); ?>" value="<?php echo esc_attr( $instance['website_icon'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('website_text') ); ?>"><?php esc_html_e('Website Text:', 'onliestwp' ); ?></label>
            <input type="text"  class="widefat" id="<?php echo esc_attr( $this->get_field_id('website_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('website_text') ); ?>" value="<?php echo esc_attr( $instance['website_text'] ); ?>" />
        </p>
                
    <?php
    }

    public function update( $new_instance, $old_instance ) {
            
        // Process Widget Options to be Saved
        $instance = $old_instance;
        $instance['title']        = strip_tags( $new_instance['title'] );       
        $instance['phone_icon']   = strip_tags( $new_instance['phone_icon'] );
        $instance['phone_text']   = strip_tags( $new_instance['phone_text'] );
        $instance['email_icon']   = strip_tags( $new_instance['email_icon'] );
        $instance['email_text']   = strip_tags( $new_instance['email_text'] );
        $instance['address_icon'] = strip_tags( $new_instance['address_icon'] );
        $instance['address_text'] = strip_tags( $new_instance['address_text'] );
        $instance['website_icon'] = strip_tags( $new_instance['website_icon'] );
        $instance['website_text'] = strip_tags( $new_instance['website_text'] );
        
        return $instance;
    }
    
    public function widget( $args, $instance ) {
        
        // Outputs Content of the Widget
        extract( $args );

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
        $phone_icon   = isset( $instance['phone_icon'] ) ? esc_attr( $instance['phone_icon'] ) : '';
        $phone_text   = isset( $instance['phone_text'] ) ? esc_attr( $instance['phone_text'] ) : '';
        $email_icon   = isset( $instance['email_icon'] ) ? esc_attr( $instance['email_icon'] ) : '';
        $email_text   = isset( $instance['email_text'] ) ? esc_attr( $instance['email_text'] ) : '';
        $address_icon = isset( $instance['address_icon'] ) ? esc_attr( $instance['address_icon'] ) : '';
        $address_text = isset( $instance['address_text'] ) ? esc_attr( $instance['address_text'] ) : '';
        $website_icon = isset( $instance['website_icon'] ) ? esc_attr( $instance['website_icon'] ) : '';
        $website_text = isset( $instance['website_text'] ) ? esc_attr( $instance['website_text'] ) : '';
        
        echo wp_kses_post( $before_widget );
        
        if( $title ) {
            echo wp_kses_post( $before_title . $title . $after_title );
        } ?>
        
        <div class="contact-info">
            <ul>               
                <?php if ( !empty( $address_text ) ) : ?>
                    <li>
                        <span class="fa <?php echo esc_attr( $address_icon ); ?>"></span>
                        <p><?php echo esc_html( $address_text ); ?></p>
                    </li>
                <?php endif; ?>
                <?php if ( !empty( $phone_text ) ) : ?>
                    <li>
                        <span class="fa <?php echo esc_attr( $phone_icon ); ?>"></span>
                        <p><?php echo esc_html( $phone_text ); ?></p>
                    </li>
                <?php endif; ?>
                <?php if ( !empty( $email_text ) ) : ?>
                    <li>
                        <span class="fa <?php echo esc_attr( $email_icon ); ?>"></span>
                        <p><a href="mailto:<?php echo esc_html( $email_text ); ?>"><?php echo esc_html( $email_text ); ?></a></p>
                    </li>
                <?php endif; ?>
                <?php if ( !empty( $website_text ) ) : ?>
                    <li>
                        <span class="fa <?php echo esc_attr( $website_icon ); ?>"></span>
                        <p><a href="<?php echo esc_url( $website_text ); ?>"><?php echo esc_html( $website_text ); ?></a></p>
                    </li>
                <?php endif; ?>
            </ul>
        </div>   
               
        <?php
        echo wp_kses_post( $after_widget );
    }
}

// Register
function register_widget_patch_icon_list() {
    register_widget( 'Widget_Patch_Icon_List' );
}
add_action( 'widgets_init', 'register_widget_patch_icon_list' );