<?php
/*
*	Euthemians Visual Composer Shortcode helper functions
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

function crocal_eutf_vc_social_elements_visibility() {
	$visibility = apply_filters( 'crocal_eutf_vc_social_elements_visibility', false );
	return $visibility;
}
function crocal_eutf_vc_wp_elements_visibility() {
	$visibility = apply_filters( 'crocal_eutf_vc_wp_elements_visibility', false );
	return $visibility;
}
function crocal_eutf_vc_grid_visibility() {
	$visibility = crocal_eutf_visibility( 'vc_grid_visibility' );
	$visibility = apply_filters( 'crocal_eutf_vc_grid_visibility', $visibility );
	return $visibility;
}
function crocal_eutf_vc_charts_visibility() {
	$visibility = crocal_eutf_visibility( 'vc_charts_visibility' );
	$visibility = apply_filters( 'crocal_eutf_vc_charts_visibility', $visibility );
	return $visibility;
}
function crocal_eutf_vc_woo_visibility() {
	$visibility = crocal_eutf_visibility( 'vc_woo_visibility' );
	$visibility = apply_filters( 'crocal_eutf_vc_woo_visibility', $visibility );
	return $visibility;
}
function crocal_eutf_vc_other_elements_visibility() {
	$visibility = apply_filters( 'crocal_eutf_vc_other_elements_visibility', false );
	return $visibility;
}

function crocal_eutf_build_shortcode_img_style( $bg_image = '' , $bg_image_size = '' ) {

	$has_image = false;
	$style = '';

	if((int)$bg_image > 0 && ($attachment_src = wp_get_attachment_image_src( $bg_image, 'crocal-eutf-fullscreen' )) !== false) {

		$image_url = $attachment_src[0];
		//Adaptive Background URL
		if ( empty ( $bg_image_size ) ) {
			$bg_image_size = crocal_eutf_option( 'row_section_bg_size' );
		}
		$image_url = crocal_eutf_get_adaptive_url( $bg_image, $bg_image_size );

		$has_image = true;
		$style .= "background-image: url(" . esc_url( $image_url ) . ");";
	} else {
		$image_url = crocal_eutf_get_fallback_image( $bg_image_size ,'url' );
		$style .= "background-image: url(" . esc_url( $image_url ) . ");";
	}
	return ' style="'. $style .'"';

}

function crocal_eutf_vc_shortcode_img_url( $bg_image = '' , $bg_image_size = '' ) {
	if((int)$bg_image > 0 && ($attachment_src = wp_get_attachment_image_src( $bg_image, 'crocal-eutf-fullscreen' )) !== false) {
		$image_url = $attachment_src[0];
		if ( empty ( $bg_image_size ) ) {
			$bg_image_size = crocal_eutf_option( 'row_section_bg_size' );
		}
		$image_url = crocal_eutf_get_adaptive_url( $bg_image, $bg_image_size );
	} else {
		$image_url = '';
	}
	return $image_url;

}

function crocal_eutf_vc_shortcode_custom_css_class( $param_value, $prefix = '' ) {
	$css_class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value ) ? $prefix . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value ) : '';
	return $css_class;
}

function crocal_eutf_build_shortcode_style( $item = array() ) {


	$bg_color = crocal_eutf_array_value( $item, 'bg_color' );
	$bg_gradient_color_1 = crocal_eutf_array_value( $item, 'bg_gradient_color_1' );
	$bg_gradient_color_2 = crocal_eutf_array_value( $item, 'bg_gradient_color_2' );
	$bg_gradient_direction = crocal_eutf_array_value( $item, 'bg_gradient_direction' );
	$font_color = crocal_eutf_array_value( $item, 'font_color' );
	$padding_top = crocal_eutf_array_value( $item, 'padding_top');
	$padding_bottom = crocal_eutf_array_value( $item, 'padding_bottom' );
	$margin_bottom = crocal_eutf_array_value( $item, 'margin_bottom' );
	$position_top = crocal_eutf_array_value( $item, 'position_top' );
	$position_bottom = crocal_eutf_array_value( $item, 'position_bottom' );
	$position_left = crocal_eutf_array_value( $item, 'position_left' );
	$position_right = crocal_eutf_array_value( $item, 'position_right' );
	$z_index = crocal_eutf_array_value( $item, 'z_index' );
	$content_width = crocal_eutf_array_value( $item, 'content_width' );
	$custom_content_width = crocal_eutf_array_value( $item, 'custom_content_width' );
	$height = crocal_eutf_array_value( $item, 'height' );

	$style = '';

	if(!empty($bg_color)) {
		$style .= crocal_eutf_get_css_color( 'background-color', $bg_color );
	}

	if( !empty($bg_gradient_color_1) && !empty($bg_gradient_color_2) && !empty($bg_gradient_direction) ) {
		$style .= crocal_eutf_get_css_color( 'background-color', $bg_gradient_color_1 );
		$style .= 'background: linear-gradient(' . $bg_gradient_direction . 'deg,' . $bg_gradient_color_1 . ' 0%,' . $bg_gradient_color_2 .' 100%);';
	}

	if( !empty($font_color) ) {
		$style .= crocal_eutf_get_css_color( 'color', $font_color );
	}
	if( $padding_top != '' ) {
		$style .= 'padding-top: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $padding_top) ? $padding_top : $padding_top.'px').';';
	}
	if( $padding_bottom != '' ) {
		$style .= 'padding-bottom: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $padding_bottom) ? $padding_bottom : $padding_bottom.'px').';';
	}
	if( $margin_bottom != '' ) {
		$style .= 'margin-bottom: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $margin_bottom) ? $margin_bottom : $margin_bottom.'px').';';
	}
	if( $position_top != '' ) {
		$style .= 'top: '.(preg_match('/(px|em|\%|pt|cm)$/', $position_top) ? $position_top : $position_top.'px').';';
	}
	if( $position_bottom != '' ) {
		$style .= 'bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $position_bottom) ? $position_bottom : $position_bottom.'px').';';
	}
	if( $position_left != '' ) {
		$style .= 'left: '.(preg_match('/(px|em|\%|pt|cm)$/', $position_left) ? $position_left : $position_left.'px').';';
	}
	if( $position_right != '' ) {
		$style .= 'right: '.(preg_match('/(px|em|\%|pt|cm)$/', $position_right) ? $position_right : $position_right.'px').';';
	}
	if( $z_index != '' ) {
		$style .= 'z-index:' . $z_index;
	}
	if( $content_width != '' && $content_width != '100' && $content_width != 'custom' ) {
		$style .= 'max-width:' . $content_width .'%';
	}
	if( $content_width == 'custom' && !empty ( $custom_content_width ) ) {
		$style .= 'max-width: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $custom_content_width) ? $custom_content_width : $custom_content_width.'px').';';
	}
	if( !empty($height) && $height != 'auto' ) {
		$style .= 'height: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $height) ? $height : $height.'px').';';
	}

	return empty($style) ? $style : ' style="'. $style .'"';
}



if ( !crocal_eutf_vc_grid_visibility() ) {

	//Remove Builder Grid Menu
	function crocal_eutf_remove_vc_menu_items( ){
		remove_menu_page( 'edit.php?post_type=vc_grid_item' );
		remove_submenu_page( 'vc-general', 'edit.php?post_type=vc_grid_item' );
	}
	add_filter( 'admin_menu', 'crocal_eutf_remove_vc_menu_items' );

	//Remove grid element shortcodes
	function crocal_eutf_vc_remove_shortcodes_from_vc_grid_element( $shortcodes ) {
		unset( $shortcodes['vc_icon'] );
		unset( $shortcodes['vc_button2'] );
		unset( $shortcodes['vc_btn'] );
		unset( $shortcodes['vc_custom_heading'] );
		unset( $shortcodes['vc_single_image'] );
		unset( $shortcodes['vc_empty_space'] );
		unset( $shortcodes['vc_separator'] );
		unset( $shortcodes['vc_text_separator'] );
		unset( $shortcodes['vc_gitem_post_title'] );
		unset( $shortcodes['vc_gitem_post_excerpt'] );
		unset( $shortcodes['vc_gitem_post_date'] );
		unset( $shortcodes['vc_gitem_image'] );
		unset( $shortcodes['vc_gitem_post_meta'] );

	  return $shortcodes;
	}
	add_filter( 'vc_grid_item_shortcodes', 'crocal_eutf_vc_remove_shortcodes_from_vc_grid_element', 100 );
}
//Remove all default templates.
add_filter( 'vc_load_default_templates', 'crocal_eutf_remove_custom_template_array' );
function crocal_eutf_remove_custom_template_array( $data ) {
	return array();
}

/**
 * VC Disable Updater Functions
 */
function crocal_eutf_vc_disable_updater_dialog() {

	$auto_updater = crocal_eutf_visibility( 'vc_auto_updater' );
	if( !$auto_updater ) {
		global $vc_manager;

		if ( $vc_manager && method_exists( $vc_manager , 'disableUpdater' ) ) {
			$vc_manager->disableUpdater( true );
		}
	}
}
add_action( 'vc_before_init', 'crocal_eutf_vc_disable_updater_dialog', 9 );


function crocal_eutf_vc_updater_notification() {
	echo "<br>" .
		esc_html__( 'Note: In every new release of the Theme the latest compatible version of Page Builder is included.', 'crocal' ) .
		" " .
		sprintf( '<a href="//docs.euthemians.com/tutorials/bundled-plugins/" target="_blank">%s</a>', esc_html__( 'Theme Bundled Plugins', 'crocal' ) );
}

function crocal_eutf_vc_license_tab_notice() {
	$auto_updater = crocal_eutf_visibility( 'vc_auto_updater' );
	if( $auto_updater ) {
		$screen = get_current_screen();
		if ( 'visual-composer_page_vc-updater' == $screen->id ) {
			echo '<div class="error"><p><strong>'. esc_html__( 'Activating Visual Composer plugin is optional and NOT required for the functionality of the Theme. In every new release of the Theme the latest compatible version of Visual Composer is included.', 'crocal' ) .'</strong></p></div>';
		}
	}
}
add_action( 'admin_notices', 'crocal_eutf_vc_license_tab_notice' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
