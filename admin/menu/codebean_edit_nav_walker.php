<?php

/**
 * Pholio's Custom Edit Nav Menu Walker
 * 
 * https://gist.github.com/westonruter/3802459
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'codebean_Edit_Nav_Walker' ) ):

// Class dependencies
if ( ! class_exists( 'Walker_Nav_Menu' ) ):
	require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
endif;

class codebean_Edit_Nav_Walker extends Walker_Nav_Menu_Edit {

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		
		$item_output = '';
		parent::start_el($item_output, $item, $depth, $args);
		// inject $new_fields before: <div class="menu-item-actions description-wide submitbox">
		if ( $new_fields = codebean_Custom_Menu::instance()->render_fields( $item, $depth, $args ) ) {
			$item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
		}
		$output .= $item_output;
	}

}

endif;

/**
 * EOF
 */