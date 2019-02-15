<?php

/**
 * ------------------------------------------------------------------------------------------------
 * Codebean: Excerpt ellipsis
 * ------------------------------------------------------------------------------------------------
 */
function codebean_excerpt_more( $excerpt ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'codebean_excerpt_more' );

/**
 * ------------------------------------------------------------------------------------------------
 * Register Navigation Location
 * ------------------------------------------------------------------------------------------------
 */
function codebean_action_register_menus() {
    register_nav_menus( array(
        'header-navigation' => esc_html__( 'Header Navigation', 'onliestwp' ),
    ) );
}
add_action( 'init', 'codebean_action_register_menus' );

/**
 * ------------------------------------------------------------------------------------------------
 * Custom Password Protect Form
 * ------------------------------------------------------------------------------------------------
 */
function codebean_password_form() {
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p class="password-text">' . esc_html__( "This is a protected area. Please enter your password:", 'onliestwp' ) . '</p>
    <input name="post_password" type="password" class="box form-control" placeholder="' . esc_html__('Enter Password', 'onliestwp') . '"/></p><p><input type="submit" name="Submit" class="btn" value="' . esc_attr__( 'Submit Password', 'onliestwp' ) . '" /></form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'codebean_password_form' );

/**
 * ------------------------------------------------------------------------------------------------
 * Append dependency to registered script
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'codebean_append_dependency' ) ) {
    function codebean_append_dependency( $handle, $dep ){
        global $wp_scripts;

        $script = $wp_scripts->query( $handle, 'registered' );
        if( !$script )
            return false;

        if( !in_array( $dep, $script->deps ) ){
            $script->deps[] = $dep;
        }

        return true;
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Modify Read More Link
 * ------------------------------------------------------------------------------------------------
 */
function codebean_custom_read_more() {
    $anchor = get_permalink();
    $read_more = esc_html__( 'Continue Reading', 'onliestwp' );
    $link = sprintf( '<a class="btn btn-bordered" href="%s">%s</a>', $anchor, $read_more );

    return '<div class="read-more text-center">' . $link . '</div>';
}
add_filter( 'the_content_more_link', 'codebean_custom_read_more' );