<?php
// Early exit if Kirki is not installed
if ( ! class_exists( 'Kirki' ) ) {
    return;
}

/**
 * Add Panels
 */

Kirki::add_panel( 'codebean_general_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'General', 'onliestwp' ),
    'description' => esc_html__( 'General options for favicon, layout and color accent choices.', 'onliestwp' ),
    'icon'        => 'dashicons-admin-generic',
) );


Kirki::add_panel( 'codebean_styling_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Styling', 'onliestwp' ),
    'description' => esc_html__( 'Options for colors and typography.', 'onliestwp' ),
    'icon'        => 'dashicons-visibility',
) );

/**
 * Add Sections
 */
Kirki::add_section( 'codebean_logo_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Custom Logo', 'onliestwp' ),
    'panel'       => 'codebean_general_options',
) );

Kirki::add_section( 'codebean_preloader_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Preloader (Page Transition)', 'onliestwp' ),
    'panel'       => 'codebean_general_options',
) );

Kirki::add_section( 'codebean_google_map_api_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Google Map API Key', 'onliestwp' ),
    'panel'       => 'codebean_general_options',
) );

Kirki::add_section( 'codebean_gotop_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Go to Top', 'onliestwp' ),
    'panel'       => 'codebean_general_options',
) );

Kirki::add_section( 'codebean_blog_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Blog Settings', 'onliestwp' ),
    'icon'        => 'dashicons-welcome-write-blog',
) );

Kirki::add_section( 'codebean_footer_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Footer Settings', 'onliestwp' ),
    'icon'        => 'dashicons-arrow-down-alt2'
) );

Kirki::add_section( 'codebean_page_title_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Page Title', 'onliestwp' ),
    'icon'       => 'dashicons-schedule',
) );

Kirki::add_section( 'codebean_social_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Social Networks', 'onliestwp' ),
    'icon'        => 'dashicons-share',
) );

Kirki::add_section( 'codebean_color_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Colors', 'onliestwp' ),
    'panel'       => 'codebean_styling_options',
));

Kirki::add_section( 'codebean_typography_options', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Typography', 'onliestwp' ),
    'panel'       => 'codebean_styling_options',
) );


/**
 * Add General Controls
 */
function codebean_general_controls_fields( $fields ) {

    // Logo Fields
    $fields[] = array(
        'type'        => 'upload',
        'settings'    => 'header_logo',
        'label'       => '',
        'description' => esc_html__( 'Click the button below to upload a custom logo.', 'onliestwp' ),
        'help'        => esc_html__( 'Upload a logo with prefered sizes of 394x74.', 'onliestwp' ),
        'section'     => 'codebean_logo_options',
        'default'     => '',
        'priority'    => 10,
    );

    // Preloader
    $fields[] = array(
        'type'      => 'switch',
        'settings'  => 'enable_preloader',
        'label'     => esc_html__( 'Page Preloader', 'onliestwp' ),
        'description' => esc_html__( 'Enable or disable preloader.', 'onliestwp' ),
        'section'     => 'codebean_preloader_options',
        'default'   => '1',
        'choices' => array(
            'on'  => esc_attr__( 'Enable', 'onliestwp' ),
            'off' => esc_attr__( 'Disable', 'onliestwp' ),
        ),
    );

    // Google Map API Key
    $fields[] = array(
        'type'      => 'text',
        'settings'  => 'gmap_api_key',
        'label'     => esc_html__( 'Google MAP API Key (Required)', 'onliestwp' ),
        'description' => esc_html__( 'Get your API key and then paste the generated API key here.', 'onliestwp' ),
        'section'     => 'codebean_google_map_api_options',
        'default'   => '',
    );

    // Google Map API Key
    $fields[] = array(
        'type'      => 'switch',
        'settings'  => 'enable_go_top',
        'label'     => esc_html__( 'Go Top', 'onliestwp' ),
        'description' => esc_html__( 'Enable or disable go to top button.', 'onliestwp' ),
        'section'     => 'codebean_gotop_options',
        'default'   => '1',
        'choices' => array(
            'on'  => esc_attr__( 'Enable', 'onliestwp' ),
            'off' => esc_attr__( 'Disable', 'onliestwp' ),
        ),
    );

    return $fields;
}

add_filter( 'kirki/fields', 'codebean_general_controls_fields' );

/**
 * Add Blog Controls
 */
function codebean_blog_control_fields( $fields ) {

    // Blog Page Title
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'show_blog_heading',
        'label'       => esc_attr__( 'Show Blog Title', 'onliestwp' ),
        'description' => esc_attr__( 'Show page title on blog page.', 'onliestwp' ),
        'section'     => 'codebean_blog_options',
        'default'     => true,
    );

    // Blog Page Title
    $fields[] = array(
        'type'        => 'text',
        'settings'    => 'blog_page_title',
        'label'       => esc_html__( 'Blog Page Title', 'onliestwp' ),
        'description' => '',
        'help'        => '',
        'section'     => 'codebean_blog_options',
        'default'     => 'Blog',
    );

        // Page Titles Arrays
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'enable_related_posts',
        'label'       => esc_attr__( 'Related Posts', 'onliestwp' ),
        'description' => esc_attr__( 'Show or hide Related Posts on Single Post', 'onliestwp' ),
        'section'     => 'codebean_blog_options',
        'default'     => true,
    );

    // Enable Social Share
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'enable_social_share',
        'label'       => esc_attr__( 'Enable Post Share', 'onliestwp' ),
        'description' => esc_attr__( 'Show or hide social networks to share the stories.', 'onliestwp' ),
        'section'     => 'codebean_blog_options',
        'default'     => true,
    );

    return $fields;
}

add_filter( 'kirki/fields', 'codebean_blog_control_fields' );

/**
 * Add Footer Controls
 */
function codebean_footer_control_fields( $fields ) {

    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'enable_footer_widgets',
        'label'       => esc_html__( 'Footer Widgets', 'onliestwp' ),
        'description' => esc_html__( 'Show or hide footer widgets at the bottom of the site.', 'onliestwp' ),
        'section'     => 'codebean_footer_options',
        'default'     => '1',
    );

    $fields[] = array(
        'type'        => 'radio-image',
        'settings'    => 'footer_columns',
        'label'       => esc_html__( 'Footer Widgets Columns', 'onliestwp' ),
        'description' => esc_html__( 'Choose your prefered columns for footer widgets columns', 'onliestwp' ),
        'section'     => 'codebean_footer_options',
        'default'     => '3',
        'choices'     => array(
            '2' => get_theme_file_uri() . '/assets/images/admin/2col.png',
            '3' => get_theme_file_uri() . '/assets/images/admin/3col.png',
            '4' => get_theme_file_uri() . '/assets/images/admin/4col.png',
            'left-large' => get_theme_file_uri() . '/assets/images/admin/large-left.png',
            'right-large' => get_theme_file_uri() . '/assets/images/admin/large-right.png',
        ),
        'required' => array(
            array(
                'setting' => 'enable_footer_widgets',
                'value' => '1',
                'operator' => '=='
            )
        )
    );

    $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'enable_footer_social_media',
        'label'       => esc_html__( 'Social Icons', 'onliestwp' ),
        'description' => esc_html__( 'Show or hide social icons on footer', 'onliestwp' ),
        'section'     => 'codebean_footer_options',
        'default'     => '1'
    );

    $fields[] = array(
        'type'        => 'textarea',
        'settings'    => 'copyright_text',
        'label'       => esc_html__( 'Bottom Copyright Text', 'onliestwp' ),
        'section'     => 'codebean_footer_options',
        'default'     => esc_html__( '&copy; 2018. Onliest Creative One-Page WordPress Theme', 'onliestwp' ),
    );

    return $fields;
}

add_filter ( 'kirki/fields', 'codebean_footer_control_fields' );

/**
 * Add Page Title Controls
 */
function codebean_page_title_control_fields( $fields ) {

    $fields[] = array(
        'type'        => 'background',
        'settings'    => 'page_heading_background',
        'label'       => esc_html__( 'Background Image', 'onliestwp' ),
        'description' => esc_html__( 'Show or hide footer widgets at the bottom of the site.', 'onliestwp' ),
        'section'     => 'codebean_page_title_options',
        'default'     => array(
            'background-color'    => '#f6f6f6',
            'background-image'    => '',
            'background-repeat'   => 'no-repeat',
            'background-size'     => 'cover',
            'background-attach'   => 'fixed',
            'background-position' => 'left-top',
            'background-opacity'  => 100,
        ),
        'output'		 => array(
            array(
                'element' => '.page-title-background',
            ),
        ),
    );

    return $fields;
}

add_filter( 'kirki/fields', 'codebean_page_title_control_fields' );

/**
 * Add Social Networks Controls
 */
function codebean_social_networks_fields( $fields ) {

    $fields[] = array(
        'type'        => 'repeater',
        'label'       => esc_html__( 'Social Media', 'onliestwp' ),
        'section'     => 'codebean_social_options',
        'settings'    => 'social_networks',
        'row_label' => array( 'type' => 'text', 'value' => esc_attr__( 'Social Icon', 'onliestwp' ) ),
        'default'     => array(),
        'fields'      => array(
            'network' => array(
                'type' => 'select',
                'label' => esc_html__( 'Social Networks', 'onliestwp' ),
                'default' => 'facebook',
                'choices' => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'google-plus' => 'Google+',
                    '500px' => '500px',
                    'apple' => 'Apple',
                    'behance' => 'Behance',
                    'bitbucket' => 'BitBucket',
                    'blogger' => 'Blogger',
                    'codepen' => 'CodePen',
                    'dribbble' => 'Dribbble',
                    'flickr' => 'Flickr',
                    'foursquare' => 'Foursquare',
                    'github' => 'GitHub',
                    'instagram' => 'Instagram',
                    'linkedin-in' => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'reddit' => 'Reddit',
                    'soundcloud' => 'SoundCloud',
                    'snapchat' => 'SnapChat',
                    'spotify' => 'Spotify',
                    'skype' => 'Skype',
                    'slack' => 'Slack',
                    'tumblr' => 'Tumblr',
                    'tripadvisor' => 'TripAdvisor',
                    'twitch' => 'Twitch',
                    'vk' => 'VKontakte',
                    'wordpress' => 'WordPress',
                    'whatsapp' => 'WhatsApp',
                    'xing' => 'Xing',
                    'youtube' => 'YouTube',
                    'yelp' => 'Yelp',
                ),
            ),
            'url' => array(
                'type' => 'text',
                'label' => esc_html__( 'Link URL', 'onliestwp' ),
                'default' => 'https://'
            )
        )
    );

    return $fields;
}

add_filter ( 'kirki/fields', 'codebean_social_networks_fields' );

/**
 * Add Styling Controls
 */
function codebean_styling_control_fields( $fields ) {

    $fields[] = array(
        'type'        => 'color',
        'settings'    => 'accent_color',
        'label'       => esc_html__( 'Accent Color', 'onliestwp' ),
        'description' => esc_attr__( 'This is a color control - without alpha channel.', 'onliestwp' ),
        'section'     => 'codebean_color_options',
        'default'     => '#fe504f',
    );

    // Main Menu Typography
    $fields[] = array(
        'type'        => 'typography',
        'settings'    => 'main_menu_font',
        'label'       => esc_attr__( 'Main Menu', 'onliestwp' ),
        'section'     => 'codebean_typography_options',
        'default'     => array(
            'font-family'    => 'Montserrat',
            'variant'        => '700',
            'font-size'      => '13px',
            'letter-spacing' => '1px',
            'subsets'        => array( 'latin-ext' ),
            'text-transform' => 'uppercase',
        ),
        'priority'    => 10,
        'output'      => array(
            array(
                'element' =>
                    array(
                        '.header-menu > li > a',
                    ),
            ),
        ),
    );

    // Sub Menu Typography
    $fields[] = array(
        'type'        => 'typography',
        'settings'    => 'sub_menu_font',
        'label'       => esc_attr__( 'Sub Menu', 'onliestwp' ),
        'section'     => 'codebean_typography_options',
        'default'     => array(
            'font-family'    => 'Open Sans',
            'variant'        => '400',
            'font-size'      => '13px',
            'letter-spacing' => '0',
            'subsets'        => array( 'latin-ext' ),
            'text-transform' => 'capitalize',
        ),
        'priority'    => 10,
        'output'      => array(
            array(
                'element' =>
                    array(
                        'nav.main-navigation ul li ul.sub-menu li a',
                    ),
            ),
        ),
    );

    // Body Typography
    $fields[] = array(
        'type'        => 'typography',
        'settings'    => 'body_typography',
        'label'       => esc_attr__( 'Body', 'onliestwp' ),
        'section'     => 'codebean_typography_options',
        'default'     => array(
            'font-family'    => 'Open Sans',
            'variant'        => '400',
            'font-size'      => '15px',
            'line-height'    => '27px',
            'letter-spacing' => '0',
            'subsets'        => array( 'latin-ext' ),
            'text-transform' => 'none',
        ),
        'priority'    => 10,
        'output'      => array(
            array(
                'element' =>
                    array(
                        'body',
                    ),
            ),
        ),
    );

    // Headings Tyopgraphy
    $fields[] = array(
        'type'        => 'typography',
        'settings'    => 'heading_typography',
        'label'       => esc_html__( 'Headings H1 - H6', 'onliestwp' ),
        'section'     => 'codebean_typography_options',
        'default'     => array(
            'font-family'    => 'Montserrat',
            'variant'        => '700',
            'subsets'        => array( 'latin-ext' ),
        ),
        'output'      => array(
            array(
                'element' =>
                    array(
                        'h1,h2,h3,h4,h5,h6',
                    ),
            ),
        ),
    );

    return $fields;
}

add_filter( 'kirki/fields', 'codebean_styling_control_fields' );

/**
 * Configuration file for theme customizer.mixed
 */
function codebean_customizer_config( $config ) {

    return wp_parse_args( array(
        'disable_loader' => true,
    ), $config );
}

add_filter( 'kirki/config', 'codebean_customizer_config' );