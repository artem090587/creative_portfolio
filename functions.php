<?php
/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file.
	You have been warned!

-------------------------------------------------------------------------------------*/

/**
 * ------------------------------------------------------------------------------------------------
 * Load all CORE Classes and files
 * ------------------------------------------------------------------------------------------------
 */
require get_parent_theme_file_path( 'includes/codebean_actions.php' );
require get_parent_theme_file_path( 'includes/codebean_filter.php' );
require get_parent_theme_file_path( 'includes/codebean_functions.php' );
require get_parent_theme_file_path( 'includes/helpers.php' );
require get_parent_theme_file_path( 'includes/mobiledetect.php' );

/**
 * ------------------------------------------------------------------------------------------------
 * Widgets
 * ------------------------------------------------------------------------------------------------
 */
require get_parent_theme_file_path( 'includes/class-widget-onliest-about.php' );
require get_parent_theme_file_path( 'includes/class-widget-onliest-facebook-like-box.php' );
require get_parent_theme_file_path( 'includes/class-widget-onliest-icon-list.php' );
require get_parent_theme_file_path( 'includes/class-widget-onliest-recent-posts.php' );

/**
 * ------------------------------------------------------------------------------------------------
 * Include Configuration File for Theme Customizer
 * ------------------------------------------------------------------------------------------------
 */
include_once( get_parent_theme_file_path() . '/includes/theme-customizer.php' );

/**
 * ------------------------------------------------------------------------------------------------
 * Include Advanced Custom Fields (ACF)
 * ------------------------------------------------------------------------------------------------
 */
require_once get_parent_theme_file_path() . '/includes/acf-fields.php';

/**
 * ------------------------------------------------------------------------------------------------
 * Include Onliest Custom Menu Walker
 * ------------------------------------------------------------------------------------------------
 */
require_once( get_parent_theme_file_path() . '/admin/menu/codebean_custom_menu.php' );

/**
 * ------------------------------------------------------------------------------------------------
 * Include Onliest Data Sources (animations, icons, etc..)
 * ------------------------------------------------------------------------------------------------
 */
require_once( get_parent_theme_file_path() . '/admin/data-sources.php' );

/**
 * ------------------------------------------------------------------------------------------------
 * TGM Plugin Activation
 * ------------------------------------------------------------------------------------------------
 */
if ( is_admin() ) {
    require( get_parent_theme_file_path() . '/includes/tgmpa/config.php' );
}