<?php

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: Add Theme Setup Supports
 * ------------------------------------------------------------------------------------------------
 */
function codebean_action_add_theme_supports() {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'onliestwp-classic-blog-thumb', 790, 500, true );
    add_image_size( 'onliestwp-recent-blog-thumb', 100, 70, true );
    add_image_size( 'onliestwp-masonry-blog-thumb', 570, 9999, false );
    add_image_size( 'onliestwp-related-blog-thumb', 240, 180, true );
    add_image_size( 'onliestwp-portfolio-thumb', 800, 600, true );


    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'title-tag' );

    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );
}
add_action( 'after_setup_theme', 'codebean_action_add_theme_supports' );

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: Content Width
 * ------------------------------------------------------------------------------------------------
 */
if ( ! isset( $content_width ) ) {
    $content_width = 800;
}

/**
 * ------------------------------------------------------------------------------------------------
 * Load Languages
 * ------------------------------------------------------------------------------------------------
 */
function codebean_language() {
    load_theme_textdomain( 'onliestwp', get_theme_file_path() . '/lang' );
}
add_action( 'after_setup_theme', 'codebean_language' );

/**
 * ------------------------------------------------------------------------------------------------
 * Enqueue styles and scripts
 * ------------------------------------------------------------------------------------------------
 */
function codebean_action_enqueue_scripts() {
    $theme_data = wp_get_theme();

    /*
    * CSS
    */
    // Other CSS
    wp_register_style( 'bootstrap', get_parent_theme_file_uri()  . '/assets/css/bootstrap.min.css', array(), '3.3.7' );
    wp_register_style( 'font-awesome', get_parent_theme_file_uri()  . '/assets/css/font-awesome.min.css', array(), '4.7.0' );
    wp_register_style( 'themify', get_parent_theme_file_uri()  . '/assets/css/themify-icons.css', array(), '1.0.1' );
    wp_register_style( 'animate', get_parent_theme_file_uri()  . '/assets/css/animate.css', array(), '3.5.2' );
    wp_register_style( 'onliest-style', get_parent_theme_file_uri()  . '/assets/css/main.css', array(
        'bootstrap',
        'font-awesome',
        'themify',
        'animate',
    ), $theme_data->get( 'Version' ) );
    wp_enqueue_style( 'onliest-style' );

    // Dynamic Style
    ob_start(); include( get_parent_theme_file_path() . '/assets/css/style-dynamic.php' ); $dynamic_style = ob_get_clean();
    wp_add_inline_style( 'onliest-style', $dynamic_style );

    // Theme stylesheet
    wp_enqueue_style( 'style', get_stylesheet_uri() ); // WP default stylesheet

    /**
     * JS
     */
    global $wp_scripts;
    wp_register_script( 'html5shiv', get_parent_theme_file_uri()  . '/assets/js/html5shiv.js', array(), '3.7.0' );
    $wp_scripts->add_data( 'html5shiv', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'html5shiv' );

    wp_register_script( 'respond', get_parent_theme_file_uri()  . '/assets/js/respond.min.js', array(), '1.4.2' );
    $wp_scripts->add_data( 'respond', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'respond' );

    wp_register_script( 'jquery-stikcy', get_parent_theme_file_uri()  . '/assets/js/jquery.sticky.js', array(), '1.0.4' );
    wp_register_script( 'jquery-waypoints', get_parent_theme_file_uri()  . '/assets/js/jquery.waypoints.min.js', array(), '4.0.1' );
    wp_register_script( 'jquery-jpreloader', get_parent_theme_file_uri()  . '/assets/js/jpreloader.min.js', array( 'jquery' ), '2.1' );
    wp_register_script( 'jquery-superfish', get_parent_theme_file_uri()  . '/assets/js/superfish.min.js', array( 'jquery' ), '1.7.9' );
    wp_register_script( 'jquery-parallax', get_parent_theme_file_uri()  . '/assets/js/jquery.parallax.js', array( 'jquery' ), '1.1.3' );
    wp_register_script( 'jquery-countup', get_parent_theme_file_uri()  . '/assets/js/countup.min.js', array(), '1.1.0' );
    wp_register_script( 'jquery-flexslider', get_parent_theme_file_uri()  . '/assets/js/jquery.flexslider-min.js', array(), '2.6.4' );
    wp_register_script( 'onliest-plugins', get_parent_theme_file_uri()  . '/assets/js/plugins.min.js', array(), NULL );

    $google_api_key = get_theme_mod( 'gmap_api_key', '' );

    if ( false == is_admin() ) {
        wp_register_script( 'google-maps', '//maps.googleapis.com/maps/api/js?key=' . $google_api_key, null, null, true );
    }

    wp_register_script( 'onliest-main', get_parent_theme_file_uri()  . '/assets/js/main.js', array(
        'jquery',
        'jquery-waypoints',
        'jquery-stikcy',
        'jquery-superfish',
        'onliest-plugins',
    ), $theme_data->get( 'Version' ), true );
    wp_enqueue_script( 'onliest-main' );

    if ( true == get_theme_mod( 'enable_preloader', true ) ) {
        wp_enqueue_script( 'jquery-jpreloader' );
    }

	// Get current page protocol
	$protocol = isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://';

	// Output admin-ajax.php URL with same protocol as current page
	$params = array(
		'ajaxurl' => admin_url( 'admin-ajax.php', $protocol )
	);

	wp_localize_script( 'onliest-main', 'codebean_theme_ajax', $params );

    // Enable threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'codebean_action_enqueue_scripts' );

/**
 * ------------------------------------------------------------------------------------------------
 * Register Sidebars (Widgetized Areas)
 * ------------------------------------------------------------------------------------------------
 */
function codebean_register_sidebars() {

    // Sidebar: Default
    register_sidebar( array(
        'name' 				=> esc_html__( 'Sidebar', 'onliestwp' ),
        'description'       => esc_html__( 'Main sidebar widgets.', 'onliestwp' ),
        'id' 				=> 'sidebar',
        'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
        'after_widget' 		=> '</div>',
        'before_title' 		=> '<h3 class="widget-title">',
        'after_title' 		=> '</h3>'
    ) );

    // Sidebar: Footer Column 1
    register_sidebar( array(
        'name' 				=> esc_html__( 'Footer 1', 'onliestwp' ),
        'description'       => esc_html__( 'Footer column 1.', 'onliestwp' ),
        'id' 				=> 'footer1',
        'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
        'after_widget' 		=> '</div>',
        'before_title' 		=> '<h3 class="widget-title">',
        'after_title' 		=> '</h3>'
    ) );

    // Sidebar: Footer Column 2
    register_sidebar( array(
        'name' 				=> esc_html__( 'Footer 2', 'onliestwp' ),
        'description'       => esc_html__( 'Footer column 2.', 'onliestwp' ),
        'id' 				=> 'footer2',
        'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
        'after_widget' 		=> '</div>',
        'before_title' 		=> '<h3 class="widget-title">',
        'after_title' 		=> '</h3>'
    ) );

    // Sidebar: Footer Column 3
    register_sidebar( array(
        'name' 				=> esc_html__( 'Footer 3', 'onliestwp' ),
        'description'       => esc_html__( 'Footer column 3.', 'onliestwp' ),
        'id' 				=> 'footer3',
        'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
        'after_widget' 		=> '</div>',
        'before_title' 		=> '<h3 class="widget-title">',
        'after_title' 		=> '</h3>'
    ) );

    // Sidebar: Footer Column 4
    register_sidebar( array(
        'name' 				=> esc_html__( 'Footer 4', 'onliestwp' ),
        'description'       => esc_html__( 'Footer column 4.', 'onliestwp' ),
        'id' 				=> 'footer4',
        'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
        'after_widget' 		=> '</div>',
        'before_title' 		=> '<h3 class="widget-title">',
        'after_title' 		=> '</h3>'
    ) );

}
add_action( 'widgets_init', 'codebean_register_sidebars' );

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: Body Classes
 * ------------------------------------------------------------------------------------------------
 */
function codebean_body_classes( $classes ) {

    // Check if Page Transition Enabled
    if ( true == get_theme_mod( 'enable_preloader', true ) ) {
        $classes[] = 'js-preloader';
    }
    return $classes;
}

add_filter( 'body_class', 'codebean_body_classes' );

/**
 * ------------------------------------------------------------------------------------------------
 * Enable Support For Plugins Check in Multisite Setup
 * ------------------------------------------------------------------------------------------------
 */
function codebean_is_plugin_active_for_network( $plugin ) {
    if ( !is_multisite() )
        return false;

    $plugins = get_site_option( 'active_sitewide_plugins');
    if ( isset($plugins[$plugin]) )
        return true;

    return false;
}

/**
 * ------------------------------------------------------------------------------------------------
 * Revolution Slider on ACF
 * ------------------------------------------------------------------------------------------------
 */
function my_acf_load_field( $field ) {
    if ( class_exists( 'RevSlider' ) ) {
        $rev_slider = new RevSlider();
        $slider_aliases = $rev_slider->getAllSliderAliases();
        if(count($slider_aliases) > 0) {
            foreach($slider_aliases as $slider_alias)
            {
                $field['choices'][$slider_alias] = $slider_alias;
            }
        } else {
            $field['choices'] = array( 'none' => 'No sliders exist. You must create one first.' );
        }
    } else {
        $field['choices'] = array( 'none' => 'Slider Revolution plugin was not found.' );
    }
    return $field;
}
//Only place these options on a specific select field with the alias "rev_slider"
add_filter('acf/load_field/name=rev_slider', 'my_acf_load_field');

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean Function: Print Page Title
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists('codebean_print_page_title' ) ) {
    function codebean_print_page_title() {

        $page_title = null;
        $enable_parallax = get_theme_mod( 'enable_page_title_parallax', '1' );

        // Print title for blog pages
        if ( is_home() ) {
            $page_title = get_theme_mod( 'blog_page_title', 'Blog' );
        }

        elseif ( is_page() ) {
            $page_title = get_the_title();
        }

        elseif ( is_category() ) {
            $page_title = single_cat_title('', false);
        }

        elseif ( is_search() ) {
            $page_title = esc_html__('Search Results ', 'onliestwp');
        }

        elseif ( is_author() ) {
            $page_title = get_the_author();
        }

        elseif ( is_tag() ) {
            $page_title = single_tag_title( '', false );
        }

        elseif ( is_single() ) {
            $page_title = null;
        }

        elseif ( is_date() ) {

            if ( is_day() ) {
                $page_title = get_the_date();
            }

            elseif ( is_month() ) {
                $page_title = get_the_date('F Y');
            }

            elseif ( is_year() ) {
                $page_title = get_the_date('Y');
            }
        }


        ?>

        <?php if ( ! empty( $page_title ) || !empty( $page_subtitle )) : ?>
            <div class="page-title-section light-scheme">

                <div class="page-title-background"></div>

                <div class="container">
                    <h2 class="onliest-fancy-title text-center">
                        <div class="wpb_wrapper">
                            <span><?php echo esc_html( $page_title ); ?></span>
                        </div>
                    </h2>
                </div>

            </div>
        <?php endif; ?>

        <?php
    }
}


/**
 * ------------------------------------------------------------------------------------------------
 * Onliest Content Nav
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'codebean_content_nav' ) ) :
    function codebean_content_nav( $nav_id ) {
        global $wp_query, $post;

        // Don't print empty markup on single pages if there's nowhere to navigate.
        if ( is_single() ) {
            $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
            $next = get_adjacent_post( false, '', false );

            if ( ! $next && ! $previous )
                return;
        }

        // Don't print empty markup in archives if there's only one page.
        if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
            return;

        $nav_class = ( is_single() ) ? 'portfolio-post-navigation' : 'paging-navigation';

        ?>
        <nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr($nav_class); ?>">

            <?php if ( is_single() ) : // navigation links for single posts ?>

                <div class="container">
                    <div class="nav-holder">

                        <div class="nav-holder-item -prev">
                            <div class="nav-previous"><?php previous_post_link( '%link', '<span class="nav-previous-title">'.esc_html__( "Previous Project", 'onliestwp' ).'</span> <span class="nav-post-title"> %title </span>' ); ?></div>
                        </div>

                        <div class="nav-holder-item -next">
                            <div class="nav-next"><?php next_post_link( '%link', '<span class="nav-next-title">'.esc_html__( "Next Project", 'onliestwp' ).'</span> <span class="nav-post-title"> %title </span>' ); ?></div>
                        </div>

                    </div>
                </div>

            <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

                <div class="col-md-6 col-sm-6 col-xs-6">
                    <?php if ( get_next_posts_link() ) : ?>
                        <div class="nav-previous"><span class="meta-nav"><i class="fa fa-chevron-left"></i></span><span><?php next_posts_link( esc_html__( 'Older posts', 'onliestwp' ) ); ?></span></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-6">
                    <?php if ( get_previous_posts_link() ) : ?>
                        <div class="nav-next"><span><?php previous_posts_link( esc_html__( 'Newer posts', 'onliestwp' ) ); ?></span><span class="meta-nav"><i class="fa fa-chevron-right"></i></span></div>
                    <?php endif; ?>
                </div>

            <?php endif; ?>



        </nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
        <?php
    }
endif;

/**
 * ------------------------------------------------------------------------------------------------
 * Include Visual Composer functions
 * ------------------------------------------------------------------------------------------------
 */
if ( in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || codebean_is_plugin_active_for_network( 'js_composer/js_composer.php' ) ) {
    require_once get_parent_theme_file_path('visual-composer-setup.php');
}

/**
 * ------------------------------------------------------------------------------------------------
 * Default Value Set for Visual Composer Loop Parameter Type
 * ------------------------------------------------------------------------------------------------
 */
function codebean_vc_loop_parap_set_default_value( & $query, $field, $value = '' ) {

    if ( ! preg_match( '/(\|?)' . preg_quote( $field ) . ':/', $query ) ) {
        $query .= "|{$field}:{$value}";
    }

    return ltrim( '|', $query );
}

/**
 * ------------------------------------------------------------------------------------------------
 * Comment List
 * ------------------------------------------------------------------------------------------------
 */
function codebean_list_comments_open ( $comment, $args, $depth ) {
    global $post, $wpdb, $comment_index;

    $comment_ID 			= $comment->comment_ID;
    $comment_author 		= $comment->comment_author;
    $comment_author_url		= $comment->comment_author_url;
    $comment_author_email	= $comment->comment_author_email;
    $comment_date 			= $comment->comment_date;
    $comment_parent_ID 		= $comment->comment_parent;

    $avatar					= preg_replace("/\s?(height='[0-9]+'|width='[0-9]+')/", "", get_avatar($comment));

    $comment_time 			= strtotime($comment_date);
    $comment_timespan 		= human_time_diff($comment_time, time());

    $link 					= '<a href="' . $comment_author_url . '" target="_blank">';

    $comment_classes = array();

    if($depth > 3)
        $comment_classes[] = 'col-md-offset-3';
    elseif($depth > 2)
        $comment_classes[] = 'col-md-offset-2';
    elseif($depth > 1)
        $comment_classes[] = 'col-md-offset-1';

    # In reply to Get
    $parent_comment = null;

    if($comment_parent_ID) {
        $parent_comment = get_comment($comment_parent_ID);
    } ?>
    <div <?php comment_class(implode(' ', $comment_classes)); ?> id="comment-<?php echo esc_attr($comment_ID); ?>"<?php echo esc_attr($depth) > 1 ? " data-replied-to=\"comment-{$comment_parent_ID}\"" : ''; ?>>
        <?php if($depth > 1): ?>
        <?php endif; ?>

        <div class="comment-avatar">
            <?php echo wp_kses_post($avatar); ?>
        </div>

        <div class="comment-details">
            <div class="comment-name">
                <h4><?php echo esc_url($comment_author_url) ? ($link . $comment_author . '</a>') : $comment_author; ?></h4>
            </div>
            <span class="comment-date"><?php echo date_i18n("F d, Y - H:i", $comment_time); ?></span>
            <div class="comment-text">
                <?php comment_text(); ?>
            </div>
            <?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
            <?php edit_comment_link( esc_html__('Edit', 'onliestwp'), '<span class="comment-meta-edit">', '</span>') ?>
        </div>

    </div>

    <?php
}

function codebean_list_comments_close() {}

/**
 * ------------------------------------------------------------------------------------------------
 * Comment Form
 * ------------------------------------------------------------------------------------------------
 */
function codebean_comment_form() {

    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    $fields = array(
        'author' =>
            '<div class="row">'.
            '<div class="col-md-4 comment-form-author form-group">
			<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
            '" placeholder="'.esc_attr__( 'Name','onliestwp' ).'"' . $aria_req . ' /></div>',

        'email' =>
            '<div class="col-md-4 comment-form-email form-group">'.
            '<input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" placeholder="'.esc_attr__( 'Email Address', 'onliestwp' ).'"' . $aria_req . ' /></div>',

        'url' =>
            '<div class="col-md-4 comment-form-url form-group">'.
            '<input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
            '" placeholder="'.esc_attr__( 'Website', 'onliestwp' ).'"'.' /></div></div><!-- /.row -->',
    );
    $comment_form_args = array(
        'fields' => $fields,
        'comment_field' => '<div class="row"><div class="col-md-12 form-group">
								<textarea rows="6" id="comment" name="comment" class="form-control" placeholder="'.esc_attr__( 'Enter your comment here...', 'onliestwp' ) .'" '. $aria_req .'></textarea>' .
            '</div></div>',
        'comment_notes_bofore' 	=> '<p class="comment-notes">' .
            esc_html__( 'Your email address will not be published.', 'onliestwp' ) .
            '</p>',
        'comment_notes_after'	=> '',
        'id_submit'				=> 'submit-comment',
        'class_submit'			=> 'btn btn-primary',
        'title_reply'			=> esc_html__( 'Leave a Comment', 'onliestwp' ),
        'title_reply_to'		=> esc_html__( 'Leave a Reply to %s', 'onliestwp' ),
        'cancel_reply_link'		=> esc_html__( 'Cancel reply', 'onliestwp' ),
        'label_submit'			=> esc_html__( 'Leave a Reply', 'onliestwp' )
    );

    comment_form( $comment_form_args );
}