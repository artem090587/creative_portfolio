<?php

/**
 * Pholio's Custom Menu
 * 
 * https://gist.github.com/westonruter/3802459
 * http://www.wpexplorer.com/adding-custom-attributes-to-wordpress-menus/
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'codebean_Custom_Menu' ) ):

// Class dependencies
if ( ! class_exists( 'codebean_Nav_Walker' ) ):
	require_once 'codebean_nav_walker.php';
endif;

class codebean_Custom_Menu {

	private static $_instance;

	public $fields   = array();

	public $template = '
		<p class="additional-menu-field-{name} description description-thin">
			<label for="edit-menu-item-{name}-{id}">
				{label}<br>
				<input
					type="{input_type}"
					id="edit-menu-item-{name}-{id}"
					class="widefat code edit-menu-item-{name}"
					name="menu-item-{name}[{id}]"
					value="{value}">
			</label>
		</p>
	';

	public static function instance() {

		if( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct() {

		// get all custom fields
		$this->fields = apply_filters( 'codebean_nav_menu_item_custom_fields', $this->fields );

		// add custom fields
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_nav_menu_item_custom_fields' ) );
		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'update_nav_menu_item_custom_fields' ), 10, 3 );
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'edit_nav_menu_walker' ) );
	}

	public function add_nav_menu_item_custom_fields( $menu_item ) {

		if( $menu_item->type === 'custom' )
			return $menu_item;

		foreach ( $this->fields as $key => $field ) {
			$menu_item->{$field['name']} = get_post_meta( $menu_item->ID, "_menu_item_{$field['name']}", true );
		}
		return $menu_item;
	}

	public function update_nav_menu_item_custom_fields( $menu_id, $menu_item_db_id, $args ) {

		if( $args['menu-item-type'] === 'custom' )
			return;

		foreach ( $this->fields as $key => $field ) {
			if ( isset($_REQUEST["menu-item-{$field['name']}"]) and is_array( $_REQUEST["menu-item-{$field['name']}"] ) ) {
				$value = ltrim( $_REQUEST["menu-item-{$field['name']}"][$menu_item_db_id], '#');
				update_post_meta( $menu_item_db_id, "_menu_item_{$field['name']}", $value );
			}
		}
	}

	public function render_fields( $item, $depth, $args ) {

		$output = '';

		if( $item->type === 'custom' )
			return;

		foreach ( $this->fields as $key => $field ) {

			$field['value'] = get_post_meta( $item->ID, "_menu_item_{$field['name']}", true );
			$field['id']    = $item->ID;

			$output .= str_replace(
				// array of keys
				array_map( array( $this, 'template_key' ), array_keys( $field ) ),
				// array of escaped attributes
				array_values( array_map( 'esc_attr', $field ) ),
				// template
				$this->template
			);
		}

		return $output;
	}

	public function template_key( $key ) {

		return "{" . $key . "}";
	}

	public function edit_nav_menu_walker() {

		// require custom menu walker
		if ( ! class_exists( 'codebean_Edit_Nav_Walker' ) )
			require_once 'codebean_edit_nav_walker.php';

		return 'codebean_Edit_Nav_Walker';
	}

}

/**
 * Add our custom fields
 */
add_filter( 'codebean_nav_menu_item_custom_fields', 'codebean_custom_menu' );

function codebean_custom_menu( $fields ) {

	$fields['section_id'] = array(
		'name'              => 'section_id',
		'label'             => 'Section ID (w/o #)',
		'container_classes' => '',
		'type'              => 'textbox'
	);
	$fields['icon_class'] = array(
		'name'              => 'icon_class',
		'label'             => 'Icon Class',
		'container_classes' => '',
		'type'              => 'textbox'
	);
	return $fields;
}

add_filter( 'nav_menu_link_attributes', 'codebean_nav_menu_link_attributes', 10, 3 );
function codebean_nav_menu_link_attributes( $atts, $item, $args ) {

	if( isset( $item->section_id ) && ! empty( $item->section_id ) ) {
		$atts['href'] = trailingslashit($atts['href']) . "#" . $item->section_id;
	}
	return $atts;
}
add_filter( 'the_title', 'codebean_nav_menu_title', 10, 2 );
function codebean_nav_menu_title( $title, $ID ) {

	$type = get_post_type( $ID );
	if( $type === 'nav_menu_item' ) {
		$icon_class = get_post_meta( $ID, "_menu_item_icon_class", true );
		if( $icon_class ) {
			$title  = '<i class="' . $icon_class . '"></i>' . $title;
		}
	}
	return $title;
}

/**
 * Instantiate onliestwp's custom menu
 */
codebean_Custom_Menu::instance();

endif;

/**
 * EOF
 */