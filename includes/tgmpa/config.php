<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once( get_parent_theme_file_path() . '/includes/tgmpa/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'codebean_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 *  <snip />
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function codebean_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Visual Composer
		array(
			'name'               => esc_html__( 'Visual Composer', 'onliestwp' ),
			'slug'               => 'js_composer', 
			'source'             => get_theme_file_uri()  . '/plugins/js_composer.zip',
			'required'           => true, 
			'version'            => '', 
			'force_activation'   => false, 
			'force_deactivation' => false,
			'external_url'       => '', 
			'is_callable'        => '',
		),

		// Includes the Revolution Slider Plugin
		array(
            'name'               => esc_html__( 'Revolution Slider', 'onliestwp' ),
            'slug'               => 'revslider', 
            'source'             => get_theme_file_uri()  . '/plugins/revslider.zip',
            'required'           => true,           
        ),

        array(
            'name'               => esc_html__( 'Onliest Plugin', 'onliestwp' ),
            'slug'               => 'onliest-plugin',
            'source'             => get_theme_file_uri()  . '/plugins/onliest-plugin.zip',
            'required'           => false,
        ),

		array(
		    'name'               => esc_html__( 'Kirki', 'onliestwp' ),
            'slug'               => 'kirki',
            'required'           => true,
        ),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => esc_html__( 'Contact Form 7', 'onliestwp' ),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),

        array(
            'name'               => esc_html__( 'Advanced Custom Fields', 'onliestwp' ),
            'slug'               => 'advanced-custom-fields',
            'required'           => true,
        ),

        array(
            'name'               => esc_html__( 'ACF Repeater', 'onliestwp' ),
            'slug'               => 'acf-repeater',
            'source'             => get_theme_file_path() . '/plugins/acf-repeater.zip',
            'required'           => true,
        ),

        array(
            'name'               => esc_html__( 'ACF Flexible Content', 'onliestwp' ),
            'slug'               => 'acf-flexible-content',
            'source'             => get_theme_file_path() . '/plugins/acf-flexible-content.zip',
            'required'           => true,
        ),

        array(
            'name'               => esc_html__( 'ACF Gallery', 'onliestwp' ),
            'slug'               => 'acf-gallery',
            'source'             => get_theme_file_path() . '/plugins/acf-gallery.zip',
            'required'           => true,
        ),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'onliestwp',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		/*
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'theme-slug' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'theme-slug' ),
			// <snip>...</snip>
			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
		*/
	);

	tgmpa( $plugins, $config );

}