<?php

/*
*	Custom Nav Menu
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

/**
 * Function to overwrite default menu Walker
 */
function crocal_eutf_edit_walker( $walker,$menu_id ) {
	return 'Crocal_Eutf_Walker_Nav_Menu_Edit';
}
add_filter( 'wp_edit_nav_menu_walker', 'crocal_eutf_edit_walker', 10, 2 );

include_once get_template_directory() . '/includes/custom-menu/eut-walker-nav-menu-edit.php';
include_once get_template_directory() . '/includes/custom-menu/eut-main-navigation-walker.php';
include_once get_template_directory() . '/includes/custom-menu/eut-simple-navigation-walker.php';
include_once get_template_directory() . '/includes/custom-menu/eut-split-navigation-walker.php';

/**
 * Function to get custom menu items
 */
function crocal_eutf_get_custom_nav_menu_items( $menu_item ) {
	$menu_item->eut_megamenu = get_post_meta( $menu_item->ID, '_crocal_eutf_menu_item_megamenu', true );
	$menu_item->eut_link_mode = get_post_meta( $menu_item->ID, '_crocal_eutf_menu_item_link_mode', true );
	$menu_item->eut_link_classes = get_post_meta( $menu_item->ID, '_crocal_eutf_menu_item_link_classes', true );
	$menu_item->eut_label_text = get_post_meta( $menu_item->ID, '_crocal_eutf_menu_item_label_text', true );
	$menu_item->eut_label_color = get_post_meta( $menu_item->ID, '_crocal_eutf_menu_item_label_color', true );
	$menu_item->eut_icon_fontawesome = get_post_meta( $menu_item->ID, '_crocal_eutf_menu_item_icon_fontawesome', true );
	$menu_item->eut_style = get_post_meta( $menu_item->ID, '_crocal_eutf_menu_item_style', true );
	$menu_item->eut_color = get_post_meta( $menu_item->ID, '_crocal_eutf_menu_item_color', true );
	$menu_item->eut_hover_color = get_post_meta( $menu_item->ID, '_crocal_eutf_menu_item_hover_color', true );
	return $menu_item;
}
add_filter( 'wp_setup_nav_menu_item', 'crocal_eutf_get_custom_nav_menu_items' );

/**
 * Function to update custom menu items
 */
function crocal_eutf_update_custom_nav_menu_items( $menu_id, $menu_item_db_id, $args ) {

	$custom_nav_menu_fields = array( 'megamenu', 'link_mode', 'link_classes', 'label_text', 'label_color', 'icon_fontawesome', 'style', 'color', 'hover_color' );

	if( isset( $_POST['_crocal_eutf_menu_options'] ) ) {
		parse_str( urldecode( $_POST['_crocal_eutf_menu_options'] ), $parse_array );

		foreach ( $custom_nav_menu_fields as $key ){
			if( !isset( $parse_array['_crocal_eutf_menu_item_' . $key . '_' . $menu_item_db_id] ) ) {
				$parse_array['_crocal_eutf_menu_item_' . $key . '_' . $menu_item_db_id] = "";
			}
			$new_meta_value = $parse_array['_crocal_eutf_menu_item_' . $key . '_' . $menu_item_db_id];
			$meta_key = '_crocal_eutf_menu_item_' . $key;
			$meta_value = get_post_meta( $menu_item_db_id, $meta_key, true );

			if ( $new_meta_value && '' == $meta_value ) {
				if ( !add_post_meta( $menu_item_db_id, $meta_key, $new_meta_value, true ) ) {
					update_post_meta( $menu_item_db_id, $meta_key, $new_meta_value );
				}
			} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
				update_post_meta( $menu_item_db_id, $meta_key, $new_meta_value );
			} elseif ( '' == $new_meta_value && $meta_value ) {
				delete_post_meta( $menu_item_db_id, $meta_key, $meta_value );
			}
		}
	}

}
add_action( 'wp_update_nav_menu_item', 'crocal_eutf_update_custom_nav_menu_items', 10, 3 );

/**
 * Function to add simple custom walker to widget navigation menu
 */
if ( !function_exists('crocal_eutf_widget_menu_custom_walker') ) {
	function crocal_eutf_widget_menu_custom_walker( $args ) {
		return array_merge( $args, array(
			'walker' => new Crocal_Eutf_Simple_Navigation_Walker(),
		) );
	}
}
add_filter( 'widget_nav_menu_args', 'crocal_eutf_widget_menu_custom_walker' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
