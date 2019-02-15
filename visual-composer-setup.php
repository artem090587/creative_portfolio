<?php

// Set Visual Composer As Theme Mode
add_action( 'vc_before_init', 'codebean_vcSetAsTheme' );
function codebean_vcSetAsTheme() {
	vc_manager()->disableUpdater(true);
	vc_set_as_theme();
}


$add_css_animation = '';

$add_css_animation = array(
    'type'  => 'dropdown',
    'heading'   => esc_html__( 'CSS Animation', 'onliestwp' ),
    'param_name'    => 'css_animation',
    'admin_label'   => true,
    'value' => array(
        esc_html__( 'No', 'onliestwp' ) => '',
		esc_html__( 'Top to bottom', 'onliestwp' ) => 'top-to-bottom',
		esc_html__( 'Bottom to top', 'onliestwp' ) => 'bottom-to-top',
		esc_html__( 'Left to right', 'onliestwp' ) => 'left-to-right',
		esc_html__( 'Right to left', 'onliestwp' ) => 'right-to-left',
		esc_html__( 'Appear from center', 'onliestwp' ) => 'appear',
    ),
    'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'onliestwp' ),
);

$add_icon = '';

$add_icon = array(
    'type' => 'dropdown',
	'holder' => 'div',
	'heading' => esc_html__( 'Icon', 'onliestwp' ),
	'param_name' => 'icon',
	'value' => array(
		esc_html__( 'No Icon', 'onliestwp' ) => '',
	),
);

/**
 * Edit Content Element: Row
 */
vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'Background Overlay', 'onliestwp' ),
	'param_name' => 'bg_overlay',
	'value' => array(
		esc_html__( 'none', 'onliestwp' ) => '',
		esc_html__( 'black overlay', 'onliestwp' ) => 'black-overlay',
		esc_html__( 'dotted overlay', 'onliestwp' ) => 'dotted-overlay',
	),
	'dependency' => array( 'element' => 'bg_mode', 'value' => array( 'images' ) ),
) );
vc_add_param( 'vc_row', array(
	'type' => 'colorpicker',
	'heading' => esc_html__( 'Text Color', 'onliestwp' ),
	'param_name' => 'font_color',
) );


/**
 * Add Onliest Element: Button
 */
vc_map( array(
    'name' => esc_html__( 'Button', 'onliestwp' ),
    'base' => 'vc_onliest_button',
    'content_element' => true,
    'show_settings_on_create' => true,
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'Show button with different styles', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'holder' => 'div',
            'heading' => esc_html__( 'Text', 'onliestwp' ),
            'param_name' => 'text',
            'value' => esc_html__( 'Anchor Text', 'onliestwp' ),
        ),
        array(
            'type' => 'vc_link',
            'holder' => 'div',
            'heading' => esc_html__( 'Link URL', 'onliestwp' ),
            'param_name' => 'link',
            'value' => '#',
        ),
        $add_icon,
        array(
            'type' => 'dropdown',
            // 'holder' => 'div',
            'heading' => esc_html__( 'Style', 'onliestwp' ),
            'param_name' => 'style',
            'value' => array(

                esc_html__( 'black', 'onliestwp' ) => 'btn-black',
                esc_html__( 'bordered', 'onliestwp' ) => 'btn-bordered',
                esc_html__( 'white', 'onliestwp' ) => 'btn-white',
                esc_html__( 'primary', 'onliestwp' ) => 'btn-primary',
                esc_html__( 'success', 'onliestwp' ) => 'btn-success',
                esc_html__( 'info', 'onliestwp' ) => 'btn-info',
                esc_html__( 'warning', 'onliestwp' ) => 'btn-warning',
                esc_html__( 'danger', 'onliestwp' ) => 'btn-danger',
                esc_html__( 'link', 'onliestwp' ) => 'btn-link',
            ),
        ),
        array(
            'type' => 'dropdown',
            'holder' => 'div',
            'heading' => esc_html__( 'Size', 'onliestwp' ),
            'param_name' => 'size',
            'value' => array(
                esc_html__( 'normal', 'onliestwp' ) => '',
                esc_html__( 'large', 'onliestwp' ) => 'btn-large',
                esc_html__( 'small', 'onliestwp' ) => 'btn-small',
                esc_html__( 'xlarge', 'onliestwp' ) => 'btn-xlarge',
            ),
        ),
        $add_css_animation,
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' ),
        ),
    ),
) );

/**
 * Add Onliest Element: Section Heading
 */
vc_map( array(
    'name' => esc_html__( 'Section Heading', 'onliestwp' ),
	'base' => 'vc_onliest_section_heading',
    'content_element' => true,
    'show_settings_on_create' => true,
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'Show section heading and subtitle.', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Large Heading', 'onliestwp' ),
			'param_name' => 'large_heading',
        ),
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Small Heading', 'onliestwp' ),
			'param_name' => 'small_heading',
        ),
        array(
            'type' => 'dropdown',
			'holder' => 'div',
			'heading' => esc_html__( 'Text Alignment', 'onliestwp' ),
			'param_name' => 'align',
			'value' => array(
				esc_html__( 'center', 'onliestwp' ) => 'center',
				esc_html__( 'left', 'onliestwp' ) => 'left',
				esc_html__( 'right', 'onliestwp' ) => 'right',
			),
        ),
        $add_css_animation,
        array(
            'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' ),
		)
    ),
) );

/**
 * Add Onliest Element: Fancy Title
 */
vc_map( array(
    'name' => esc_html__( 'Fancy Title', 'onliestwp' ),
    'base' => 'onliest_fancy_title',
    'content_element' => true,
    'show_settings_on_create' => true,
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'User fancy title for section title too.', 'onliestwp' ),
    'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'h1',
			'heading' => esc_html__( 'Title', 'onliestwp' ),
			'param_name' => 'title',
        ),
        $add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' ),
		),
	),
) );

/**
 * Add Onliest Element: Icon Box
 */
vc_map( array(
    'name' => esc_html__( 'Icon Box', 'onliestwp' ),
	'base' => 'vc_onliest_service_block',
    'content_element' => true,
    'show_settings_on_create' => true,
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'Icon boxes as service blocks', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Heading Text', 'onliestwp' ),
			'param_name' => 'heading',
			'value' => esc_html__( 'Service Heading', 'onliestwp' ),
        ),
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Subheading Text', 'onliestwp' ),
			'param_name' => 'subheading',
			'value' => esc_html__( 'Service Subheading', 'onliestwp' ),
        ),
        array(
            'type' => 'dropdown',
			'holder' => 'div',
			'heading' => esc_html__( 'Style', 'onliestwp' ),
			'param_name' => 'style',
			'value' => array(
				'style-1' => 'style-1',
				'style-2' => 'style-2',
			),
        ),
        $add_icon,
        array(
            'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Content', 'onliestwp' ),
			'param_name' => 'content',
			'value' => esc_html__( 'I am a service block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'onliestwp' ),
        ),
        $add_css_animation,
        array(
            'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' ),
        ),
    ),
) );

/**
 * Add Onliest Element: Counter
 */
vc_map( array(
    'name' => esc_html__( 'Counter', 'onliestwp' ),
	'base' => 'vc_onliest_counter',
    'content_element' => true,
    'show_settings_on_create' => true,
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'Fun facts with counter e.g your achievements', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Subject', 'onliestwp' ),
			'param_name' => 'subject',
        ),
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Start', 'onliestwp' ),
			'param_name' => 'start',
			'value' => 0,
        ),
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'End (Value)', 'onliestwp' ),
			'param_name' => 'end',
			'value' => 100,
        ),
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Suffix', 'onliestwp' ),
			'param_name' => 'suffix',
			'description' => esc_html__( 'String after number', 'onliestwp' ),
        ),
        array(
            'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' ),
        ),
    ),
) );

/**
 * Add Onliest Element: Testimonials
 */
vc_map( array(
    'name' => esc_html__( 'Testimonials', 'onliestwp' ),
    'base' => 'onliest_testimonials',
    'as_parent' => array('only' => 'onliest_testimonial'),
    'content_element' => true,
    'show_settings_on_create' => true,
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'User testimonials slider or grid', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Layout', 'onliestwp' ),
            'param_name' => 'layout',
            'value' => array(
                esc_html__( 'Slider', 'onliestwp' ) => 'slider',
                esc_html__( 'Grid', 'onliestwp' ) => 'grid',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Align', 'onliestwp' ),
            'param_name' => 'align',
            'value' => array(
                esc_html__( 'Center', 'onliestwp' ) => 'center',
                esc_html__( 'Left', 'onliestwp' ) => 'left',
                esc_html__( 'Right', 'onliestwp' ) => 'right',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Columns', 'onliestwp' ),
            'param_name' => 'columns',
            'value' => array(
                1,2,3,4,5,6
            ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array( 'grid' ),
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Slides per view', 'onliestwp' ),
            'param_name' => 'slides_per_view',
            'value' => array(
                1,2,3,4,5,6,7,8
            ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array( 'slider' ),
            ),
            'description' => esc_html__( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode.', 'onliestwp' )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Slider autoplay', 'onliestwp' ),
            'param_name' => 'autoplay',
            'description' => esc_html__( 'Enables autoplay mode.', 'onliestwp' ),
            'value' => array( esc_html__( 'Yes, please', 'onliestwp' ) => 'yes' ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array( 'slider' ),
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Autoheight', 'onliestwp' ),
            'param_name' => 'autoheight',
            'description' => esc_html__( 'Enables autoheight mode.', 'onliestwp' ),
            'value' => array( esc_html__( 'Yes, please', 'onliestwp' ) => 'yes' ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array( 'slider' ),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Slider speed', 'onliestwp' ),
            'param_name' => 'speed',
            'value' => '5000',
            'description' => esc_html__( 'Duration of animation between slides (in ms)', 'onliestwp' ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array( 'slider' ),
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show pagination control', 'onliestwp' ),
            'param_name' => 'show_pagination_control',
            'description' => esc_html__( 'If "YES" pagination control will be added', 'onliestwp' ),
            'value' => array( esc_html__( 'Yes, please', 'onliestwp' ) => 'yes' ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array( 'slider' ),
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show prev/next buttons', 'onliestwp' ),
            'param_name' => 'show_prev_next_buttons',
            'description' => esc_html__( 'If "YES" prev/next control will be added', 'onliestwp' ),
            'value' => array( esc_html__( 'Yes, please', 'onliestwp' ) => 'yes' ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array( 'slider' ),
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Slider loop', 'onliestwp' ),
            'param_name' => 'wrap',
            'description' => esc_html__( 'Enables loop mode.', 'onliestwp' ),
            'value' => array( esc_html__( 'Yes, please', 'onliestwp' ) => 'yes' ),
            'dependency' => array(
                'element' => 'layout',
                'value' => array( 'slider' ),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' )
        ),
    ),
    'js_view' => 'VcColumnView'
) );

vc_map( array(
    'name' => esc_html__( 'Testimonial', 'onliestwp' ),
    'base' => 'onliest_testimonial',
    'class' => '',
    'as_child' => array('only' => 'onliest_testimonials'),
    'content_element' => true,
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'User testimonial', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Name', 'onliestwp' ),
            'param_name' => 'name',
            'value' => '',
            'description' => esc_html__( 'User name', 'onliestwp' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'onliestwp' ),
            'param_name' => 'title',
            'value' => '',
            'description' => esc_html__( 'User title', 'onliestwp' )
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'User Avatar', 'onliestwp' ),
            'param_name' => 'image',
            'value' => '',
            'description' => esc_html__( 'Select image from media library.', 'onliestwp' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image size', 'onliestwp' ),
            'param_name' => 'img_size',
            'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'onliestwp' )
        ),
        array(
            'type' => 'textarea_html',
            'holder' => 'div',
            'heading' => esc_html__( 'Text', 'onliestwp' ),
            'param_name' => 'content'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' )
        )
    )
) );

/**
 * Add Onliest Element: Progress Bar
 */
vc_map( array(
    'name' => esc_html__( 'Progress Bar', 'onliestwp' ),
	'base' => 'onliest_progress_bar',
    'content_element' => true,
    'show_settings_on_create' => true,
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'Show your skills with animated progress bars.', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Caption', 'onliestwp' ),
			'param_name' => 'caption',
        ),
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Value', 'onliestwp' ),
			'param_name' => 'value',
			'description' => esc_html__( 'Valid value from 0 to 100, and without "%"', 'onliestwp' ),
        ),
        array(
            'type' => 'colorpicker',
			'holder' => 'div',
			'heading' => esc_html__( 'Custom Color', 'onliestwp' ),
			'param_name' => 'color',
        ),
        array(
            'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' ),
        )
    ),
) );

/**
 * Add Onliest Element: Team Members
 */
vc_map( array(
    'name' => esc_html__( 'Team Member Block', 'onliestwp' ),
	'base' => 'vc_onliest_team_member_block',
    'content_element' => true,
    'show_settings_on_create' => true,
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'Display information of some person', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Name', 'onliestwp' ),
			'param_name' => 'name',
			'value' => esc_html__( 'John Doe', 'onliestwp' ),
        ),
        array(
            'type' => 'attach_image',
			'holder' => 'div',
			'heading' => esc_html__( 'Photo', 'onliestwp' ),
			'param_name' => 'photo',
			'description' => esc_html__( 'Minimum size recommended: 600px width image', 'onliestwp' ),
        ),
        array(
            'type' => 'textfield',
			'holder' => 'div',
			'heading' => esc_html__( 'Position', 'onliestwp' ),
			'param_name' => 'position',
        ),
        array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Content', 'onliestwp' ),
			'param_name' => 'content',
			'value' => esc_html__( 'John Doe is a designer who works remotely from Birmingham, AL. A graduate of Ole Miss, where he played.', 'onliestwp' ),
        ),
        array(
			'type' => 'textarea',
			'holder' => 'div',
			'heading' => esc_html__( 'Social Media', 'onliestwp' ),
			'description' => esc_html__( 'Line break separated. See all available social media types <a href="http://fontawesome.io/icons/#brand">here</a>. Input format is social_media_type: your_url. For example, facebook: http://facebook.com.', 'onliestwp' ),
			'param_name' => 'socmed',
			'value' => esc_html__( "facebook : http://facebook.com\ntwitter : http://twitter.com\nlinkedin : http://linkedin.com", 'onliestwp' ),
        ),
        $add_css_animation,
        array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' ),
		),
    ),
) );

/**
 * Add Onliest Element: Blog Masonry
 */
vc_map( array(
    'name' => esc_html__( 'Blog Masonry', 'onliestwp' ),
	'base' => 'vc_onliest_blog_grid',
    'content_element' => true,
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'Display blog on masonry mode', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'loop',
            'heading' => esc_html__( 'Blog Query', 'onliestwp' ),
            'param_name' => 'blog_query',
            'settings' => array(
                'size' => array('hidden' => false, 'value' => 3),
                'order_by' => array('value' => 'date'),
                'post_type' => array('value' => 'post', 'hidden' => false)
            ),
            'description' => 'Create WordPress loop, to populate only blog posts from your site.',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Columns', 'onliestwp' ),
            'param_name' => 'blog_columns',
            'value' => array(
                1, 2, 3, 4
            ),
            'description' => esc_html__( 'Set number of columns to separate blog posts.', 'onliestwp' ),
        ),
        array(
            'type'           => 'vc_link',
            'heading'        => esc_html__( 'More Link', 'onliestwp' ),
            'param_name'     => 'more_link',
            'value'          => '',
            'description'	 => esc_html__( 'This will show "More" button in the end of blog items.', 'onliestwp' )
        ),
        array(
            'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' ),
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => 'Css',
            'param_name' => 'css',
            'group'      => esc_html__( 'Design options', 'onliestwp' ),
        )
    ),
) );

/**
 * Add Onliest Element: Portfolio Items
 */
vc_map( array(
    'name' => esc_html__( 'Portfolio Masonry', 'onliestwp' ),
    'base' => 'vc_onliest_portfolio_masonry',
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'Display portfolio in masonry style', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Style', 'onliestwp' ),
            'param_name' => 'style',
            'admin_label' => true,
            'value' => array(
                esc_html__( 'Style 1', 'onliestwp' ) => 'style1',
                esc_html__( 'Style 2', 'onliestwp' ) => 'style2',
            ),
            'description' => esc_html__( 'This changes the style of the portfolios', 'onliestwp' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Layout', 'onliestwp' ),
            'param_name' => 'masonry_layout',
            'value' => array(
                esc_html__( 'Masonry Layout 1', 'onliestwp' ) => 'masonry-style1',
                esc_html__( 'Masonry Layout 2', 'onliestwp' ) => 'masonry-style2',
                esc_html__( 'Masonry Layout 3', 'onliestwp' ) => 'masonry-style3',
            ),
            'description' => esc_html__( 'This changes the layout of the masonry for Style 1', 'onliestwp' ),
            'dependency' => array('element' => 'style', 'value' => array('style1'))
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Columns', 'onliestwp' ),
            'param_name' => 'columns',
            'value' => array(
                esc_html__( 'Two Columns', 'onliestwp' ) => 'col-sm-6',
                esc_html__( 'Three Columns', 'onliestwp' ) => 'col-md-4',
                esc_html__( 'Four Columns', 'onliestwp' ) => 'col-md-3',
            ),
            'description' => esc_html__( 'This changes the column counts of the Style 2', 'onliestwp' ),
            'dependency' => array('element' => 'style', 'value' => array('style2'))
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Portfolio Source', 'onliestwp' ),
            'param_name' => 'portfolio_source',
            'value' => array(
                esc_html__( 'By ID (default)', 'onliestwp' ) => 'by_id',
                esc_html__( 'Advanced', 'onliestwp' ) => 'advanced',
            )
        ),
        array(
            'type' => 'loop',
            'heading' => esc_html__( 'Advanced Portfolio Source', 'onliestwp' ),
            'param_name' => 'source',
            'description' => esc_html__( 'Set your portfolio source here. Make sure you select portfolio post type', 'onliestwp' ),
            'dependency' => array('element' => 'portfolio_source', 'value' => array('advanced'))
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Portfolio IDs', 'onliestwp' ),
            'param_name' => 'portfolio_ids',
            'admin_label' => true,
            'description' => esc_html__( 'Enter the portfolio IDs you would like to display seperated by comma', 'onliestwp' ),
            'dependency' => array('element' => 'portfolio_source', 'value' => array('by_id'))
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Hover Style', 'onliestwp' ),
            'param_name' => 'hover_style',
            'value' => array(
                esc_html__( 'Default', 'onliestwp' ) => '',
                esc_html__( 'With Border', 'onliestwp' ) => 'border-hover',
                esc_html__( 'Push Top', 'onliestwp' ) => 'top-hover',
                esc_html__( 'Push Bottom', 'onliestwp' ) => 'bottom-hover',
            ),
            'description' => esc_html__( 'You can change the hover styles here. Hover styles are dependent on which portfolio styles you are using so they might not work for every style.', 'onliestwp' ),
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__("Add Filters?", "onliestwp"),
            "param_name" => "add_filters",
            "value" => array(
                "Yes" => "true"
            ),
            "description" => esc_html__("This will display filters on the top", "onliestwp")
        ),
    ),
) );

/**
* Add Onliest Element: Google Map
*/
vc_map( array(
	'name' => esc_html__( 'Google Map', 'onliestwp' ),
	'base' => 'onliest_google_map',
	'class' => '',
	'category' => esc_html__( 'Codebean', 'onliestwp' ),
	'params' => array(
		array(
			'type'         => 'textfield',
			'heading'      => esc_html__( 'Title', 'onliestwp' ),
			'param_name'   => 'title',
			'admin_label' => true,
		),
		array(
			'type'         => 'textfield',
			'heading'      => esc_html__( 'Map Latitude', 'onliestwp' ),
			'description'         => esc_html__( 'Go to https://www.google.com/maps and copy the latitude info from the browser url field and paste it here.', 'onliestwp'),
			'param_name'   => 'map_lat',
			'value' => '44.5403',

		),
		array(
			'type'         => 'textfield',
			'heading'      => esc_html__( 'Map Logintude', 'onliestwp' ),
			'description'         => esc_html__( 'Go to https://www.google.com/maps and copy the longitude info from the browser url field and paste it here.', 'onliestwp'),
			'param_name'   => 'map_lon',
			'value' => '-78.5463',

		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Custom Marker Icon URL', 'onliestwp' ),
			'description' => esc_html__( 'Enter your custom map marker icon url. Leave it empty to show the default icon.', 'onliestwp' ),
			'param_name'  => 'map_icon'
		),
		array(
			'type'         => 'textfield',
			'heading'      => esc_html__( 'Map Zoom', 'onliestwp' ),
			'param_name'   => 'map_zoom',
			'value' => '15',

		),
		array(
			'type'         => 'textfield',
			'heading'      => esc_html__( 'Map Height', 'onliestwp' ),
			'param_name'   => 'map_height',
			'value' => '345',

		),
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'Css', 'onliestwp' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'onliestwp' )
		)
	),
) );

/**
 * Add Onliest Element: Icon List
 */
vc_map( array(
	'name'        => esc_html__( 'Icon List', 'onliestwp' ),
    'base'        => 'onliest_icon_list',
    'as_parent'   => array('only' => 'onliest_icon_list_item'),
    "content_element" => true,
    "show_settings_on_create" => true,
	'category'    => esc_html__( 'Codebean', 'onliestwp' ),
	'description'    => esc_html__( 'Insert Icon List', 'onliestwp' ),
	"params"		=> array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__( 'Icon Color', 'onliestwp' ),
			'param_name' => 'color',
			'value' => array(
				"Default (inherit from row Text Color)" => "default",
				"Accent Color" => "Accent-Color",
			),
			'save_always' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon Size', 'onliestwp' ),
			"param_name" => "icon_size",
			"value" => array(
				"Small" => "small-icon",
				"Medium" => "medium-icon",
				"Large" => "large-icon"
			),
			'save_always' => true,
			"description" => esc_html__("Select icon size to display on your list.", 'onliestwp')
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Icon Style", 'onliestwp'),
			"param_name" => "icon_style",
			"value" => array(
				  "Icon Colored W/ Border" => "border",
				  "Icon Colored No Border" => "no-border"
			  ),
			'save_always' => true,
			"description" => esc_html__("Please select the direction you would like your list items to display in", 'onliestwp')
		),
	),
	'js_view' => 'VcColumnView'
) );

vc_map( array(
	'name'        => esc_html__( 'Icon List Item', 'onliestwp' ),
    'base'        => 'onliest_icon_list_item',
    'as_child' => array('only' => 'onliest_icon_list'),
    "content_element" => true,
	'category'    => esc_html__( 'Codebean', 'onliestwp' ),
	'description'   => esc_html__( 'Add icon list item.', 'onliestwp' ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__("List Icon Type", 'onliestwp'),
			"param_name" => "icon_type",
			"value" => array(
				  "Number" => "numerical",
				  "Icon" => "icon"
			  ),
			'save_always' => true,
			"admin_label" => true,
			"description" => esc_html__("Select icon type you like to show.", 'onliestwp')
		),
		$add_icon,
		array(
			"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Header", 'onliestwp'),
			"param_name" => "header",
			"description" => esc_html__("Enter the header desired for your icon list element", 'onliestwp')
		),
		array(
			"admin_label" => true,
			"type" => "textarea",
			"heading" => esc_html__("Text Content", 'onliestwp'),
			"param_name" => "text",
			"description" => esc_html__("Enter the text content desired for your icon list element", 'onliestwp')
		),
		$add_css_animation,
	)
) );

/**
 * Add Onliest Element: Images Gallery
 */
vc_map( array(
    'name' => esc_html__( 'Images gallery', 'onliestwp' ),
    'base' => 'onliest_gallery',
    'class' => '',
    'category' => esc_html__( 'Codebean', 'onliestwp' ),
    'description' => esc_html__( 'Images carousel', 'onliestwp' ),
    'params' => array(
        array(
            'type' => 'attach_images',
            'heading' => esc_html__( 'Images', 'onliestwp' ),
            'param_name' => 'images',
            'value' => '',
            'description' => esc_html__( 'Select images from media library.', 'onliestwp' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image size', 'onliestwp' ),
            'param_name' => 'img_size',
            'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'onliestwp' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Slides per view', 'onliestwp' ),
            'param_name' => 'slides_per_view',
            'value' => array(
                1,2,3,4,5,6,7,8
            ),
            'description' => esc_html__( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode.', 'onliestwp' )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show pagination control', 'onliestwp' ),
            'param_name' => 'show_pagination_control',
            'description' => esc_html__( 'If "YES" pagination control will be added', 'onliestwp' ),
            'value' => array( esc_html__( 'Yes, please', 'onliestwp' ) => 'yes' )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show prev/next buttons', 'onliestwp' ),
            'param_name' => 'show_prev_next_buttons',
            'description' => esc_html__( 'If "YES" prev/next control will be added', 'onliestwp' ),
            'value' => array( esc_html__( 'Yes, please', 'onliestwp' ) => 'yes' ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Slider loop', 'onliestwp' ),
            'param_name' => 'wrap',
            'description' => esc_html__( 'Enables loop mode.', 'onliestwp' ),
            'value' => array( esc_html__( 'Yes, please', 'onliestwp' ) => 'yes' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'On click action', 'onliestwp' ),
            'param_name' => 'on_click',
            'value' => array(
                '' => '',
                esc_html__( 'Custom Link', 'onliestwp' ) => 'links',
                esc_html__( 'None', 'onliestwp' ) => 'none'
            )
        ),
        array(
            'type' => 'exploded_textarea_safe',
            'heading' => esc_html__( 'Custom links', 'onliestwp' ),
            'param_name' => 'custom_links',
            'description' => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'onliestwp' ),
            'dependency' => array(
                'element' => 'on_click',
                'value' => array( 'links' ),
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Open in new tab', 'onliestwp' ),
            'save_always' => true,
            'param_name' => 'target_blank',
            'value' => array( esc_html__( 'Yes, please', 'onliestwp' ) => 'yes' ),
            'default' => 'yes',
            'dependency' => array(
                'element' => 'on_click',
                'value' => array( 'links' ),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'onliestwp' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'onliestwp' )
        )
    )
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Onliest_Icon_List extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Onliest_Testimonials extends WPBakeryShortCodesContainer {}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_VC_Onliest_Button extends WPBakeryShortCode {}
	class WPBakeryShortCode_VC_Onliest_Section_Heading extends WPBakeryShortCode {}
	class WPBakeryShortCode_VC_Onliest_Service_Block extends WPBakeryShortCode {}
	class WPBakeryShortCode_VC_Onliest_Counter extends WPBakeryShortCode {}
	class WPBakeryShortCode_Onliest_Progress_Bar extends WPBakeryShortCode {}
	class WPBakeryShortCode_VC_Onliest_Team_Member_Block extends WPBakeryShortCode {}
	class WPBakeryShortCode_VC_Onliest_Blog_Grid extends WPBakeryShortCode {}
	class WPBakeryShortCode_VC_Onliest_Portfolio_Masonry extends WPBakeryShortCode {}
	class WPBakeryShortCode_Onliest_Google_Map extends WPBakeryShortCode {}
	class WPBakeryShortCode_Onliest_Icon_List_Item extends WPBakeryShortCode {}
    class WPBakeryShortCode_Onliest_Testimonial extends WPBakeryShortCode {}
    class WPBakeryShortCode_Onliest_Gallery extends WPBakeryShortCode {}
    class WPBakeryShortCode_Onliest_Fancy_Title extends WPBakeryShortCode {}
}
