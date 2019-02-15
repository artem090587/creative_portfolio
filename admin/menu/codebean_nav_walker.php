<?php

/**
 * Pholio's Custom Nav Walker
 *
 * https://github.com/twittem/wp-bootstrap-navwalker
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'codebean_Nav_Walker' ) ):

class codebean_Nav_Walker extends Walker_Nav_Menu {

	// taken from wp_bootstrap_navwalker
	public static function fallback( $args ) {

		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo wp_kses_post($fb_output);
		}
	}

}

endif;

/**
 * EOF
 */