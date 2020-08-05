<?php

/*
 *	Helper functions
 *
 * 	@version	1.0
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */



 /**
 * Generic Parameters to reuse
 * Used in vc shortcodes
 */

if( !function_exists( 'crocal_ext_vce_add_animation' ) ) {
	function crocal_ext_vce_add_animation() {
		return array(
			"type" => "dropdown",
			"heading" => esc_html__( "CSS Animation", "crocal-extension"),
			"param_name" => "animation",
			"value" => array(
				esc_html__( "No", "crocal-extension" ) => '',
				esc_html__( "Fade In", "crocal-extension" ) => "eut-fade-in",
				esc_html__( "Fade In Up", "crocal-extension" ) => "eut-fade-in-up",
				esc_html__( "Fade In Up Big", "crocal-extension" ) => "eut-fade-in-up-big",
				esc_html__( "Fade In Down", "crocal-extension" ) => "eut-fade-in-down",
				esc_html__( "Fade In Down Big", "crocal-extension" ) => "eut-fade-in-down-big",
				esc_html__( "Fade In Left", "crocal-extension" ) => "eut-fade-in-left",
				esc_html__( "Fade In Left Big", "crocal-extension" ) => "eut-fade-in-left-big",
				esc_html__( "Fade In Right", "crocal-extension" ) => "eut-fade-in-right",
				esc_html__( "Fade In Right Big", "crocal-extension" ) => "eut-fade-in-right-big",
				esc_html__( "Zoom In", "crocal-extension" ) => "eut-zoom-in",
			),
			"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "crocal-extension" ),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_animation_delay' ) ) {
	function crocal_ext_vce_add_animation_delay() {
		return array(
			"type" => "textfield",
			"heading" => esc_html__('Css Animation Delay', 'crocal-extension'),
			"param_name" => "animation_delay",
			"value" => '200',
			"description" => esc_html__( "Add delay in milliseconds.", "crocal-extension" ),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_animation_duration' ) ) {
	function crocal_ext_vce_add_animation_duration() {
		return array(
			"type" => "dropdown",
			"heading" => esc_html__( "CSS Animation Duration", "crocal-extension"),
			"param_name" => "animation_duration",
			"value" => array(
				esc_html__( "Very Fast", "crocal-extension" ) => "very-fast",
				esc_html__( "Fast", "crocal-extension" ) => "fast",
				esc_html__( "Normal", "crocal-extension" ) => "normal",
				esc_html__( "Slow", "crocal-extension" ) => "slow",
				esc_html__( "Very Slow", "crocal-extension" ) => "very-slow",
			),
			"std" => 'normal',
			"description" => esc_html__("Select the duration for your animated element.", 'crocal-extension' ),
		);
	}
}


if( !function_exists( 'crocal_ext_vce_add_shadow' ) ) {
	function crocal_ext_vce_add_shadow() {
		return array(
			"type" => "dropdown",
			"heading" => esc_html__( "Add Shadow", "crocal-extension"),
			"param_name" => "shadow",
			"value" => array(
				esc_html__( "No", "crocal-extension" ) => "",
				esc_html__( "Small Shadow", "crocal-extension" ) => "small-shadow",
				esc_html__( "Medium Shadow", "crocal-extension" ) => "medium-shadow",
				esc_html__( "Large Shadow", "crocal-extension" ) => "large-shadow",
			),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_radius' ) ) {
	function crocal_ext_vce_add_radius() {
		return array(
			"type" => "dropdown",
			"heading" => esc_html__( "Radius", "crocal-extension"),
			"param_name" => "radius",
			"value" => array(
				esc_html__( "No", "crocal-extension" ) => "",
				esc_html__( "Radius 3px", "crocal-extension" ) => 'radius-3',
				esc_html__( "Radius 5px", "crocal-extension" ) => 'radius-5',
				esc_html__( "Radius 10px", "crocal-extension" ) => 'radius-10',
				esc_html__( "Radius 15px", "crocal-extension" ) => 'radius-15',
				esc_html__( "Radius 20px", "crocal-extension" ) => 'radius-20',
				esc_html__( "Radius 25px", "crocal-extension" ) => 'radius-25',
				esc_html__( "Radius 30px", "crocal-extension" ) => 'radius-30',
				esc_html__( "Radius 35px", "crocal-extension" ) => 'radius-35',
			),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_margin_bottom' ) ) {
	function crocal_ext_vce_add_margin_bottom() {
		return array(
			"type" => "textfield",
			"heading" => esc_html__('Bottom margin', 'crocal-extension'),
			"param_name" => "margin_bottom",
			"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", "crocal-extension" ),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_el_class' ) ) {
	function crocal_ext_vce_add_el_class() {
		return array(
			"type" => "textfield",
			"heading" => esc_html__( "Extra class name", "crocal-extension" ),
			"param_name" => "el_class",
			"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "crocal-extension" ),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_align' ) ) {
	function crocal_ext_vce_add_align() {
		return array(
			"type" => "dropdown",
			"heading" => esc_html__( "Alignment", "crocal-extension" ),
			"param_name" => "align",
			"value" => array(
				esc_html__( "Left", "crocal-extension" ) => 'left',
				esc_html__( "Right", "crocal-extension" ) => 'right',
				esc_html__( "Center", "crocal-extension" ) => 'center',
			),
			"description" => '',
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_inherit_align' ) ) {
	function crocal_ext_vce_add_inherit_align() {
		return array(
			"type" => "dropdown",
			"heading" => esc_html__( "Alignment", "crocal-extension" ),
			"param_name" => "inherit_align",
			"value" => array(
				esc_html__( "Inherit", "crocal-extension" ) => 'inherit',
				esc_html__( "Left", "crocal-extension" ) => 'left',
				esc_html__( "Right", "crocal-extension" ) => 'right',
				esc_html__( "Center", "crocal-extension" ) => 'center',
			),
			"description" => 'Inherits its value from its column text align definition.',
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_order_by' ) ) {
	function crocal_ext_vce_add_order_by() {
		return array(
			"type" => "dropdown",
			"heading" => esc_html__( "Order By", "crocal-extension" ),
			"param_name" => "order_by",
			"value" => array(
				esc_html__( "Date", "crocal-extension" ) => 'date',
				esc_html__( "Last modified date", "crocal-extension" ) => 'modified',
				esc_html__( "Number of comments", "crocal-extension" ) => 'comment_count',
				esc_html__( "Title", "crocal-extension" ) => 'title',
				esc_html__( "Author", "crocal-extension" ) => 'author',
				esc_html__( "Random", "crocal-extension" ) => 'rand',
			),
			"description" => '',
			'edit_field_class' => 'vc_col-sm-6',
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_order' ) ) {
	function crocal_ext_vce_add_order() {
		return array(
			"type" => "dropdown",
			"heading" => esc_html__( "Order", "crocal-extension" ),
			"param_name" => "order",
			"value" => array(
				esc_html__( "Descending", "crocal-extension" ) => 'DESC',
				esc_html__( "Ascending", "crocal-extension" ) => 'ASC'
			),
			"dependency" => array( 'element' => "order_by", 'value' => array( 'date', 'modified', 'comment_count', 'name', 'author', 'title' ) ),
			"description" => '',
			'edit_field_class' => 'vc_col-sm-6',
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_slideshow_speed' ) ) {
	function crocal_ext_vce_add_slideshow_speed() {
		return array(
			"type" => "textfield",
			"heading" => esc_html__( "Slideshow Speed", "crocal-extension" ),
			"param_name" => "slideshow_speed",
			"value" => '3000',
			"description" => esc_html__( "Slideshow Speed in ms.", "crocal-extension" ),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_pagination_speed' ) ) {
	function crocal_ext_vce_add_pagination_speed() {
		return array(
			"type" => "textfield",
			"heading" => esc_html__( "Pagination Speed", "crocal-extension" ),
			"param_name" => "pagination_speed",
			"value" => '400',
			"description" => esc_html__( "Pagination Speed in ms.", "crocal-extension" ),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_navigation_type' ) ) {
	function crocal_ext_vce_add_navigation_type() {
		return array(
			"type" => "dropdown",
			"heading" => esc_html__( "Navigation Type", "crocal-extension" ),
			"param_name" => "navigation_type",
			'value' => array(
				esc_html__( 'Style 1' , 'crocal-extension' ) => '1',
				esc_html__( 'No Navigation' , 'crocal-extension' ) => '0',
			),
			"description" => esc_html__( "Select your Navigation type.", "crocal-extension" ),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_navigation_color' ) ) {
	function crocal_ext_vce_add_navigation_color() {
		return array(
			"type" => "dropdown",
			"heading" => esc_html__( "Navigation Color", "crocal-extension" ),
			"param_name" => "navigation_color",
			'value' => array(
				esc_html__( 'Dark' , 'crocal-extension' ) => 'dark',
				esc_html__( 'Light' , 'crocal-extension' ) => 'light',
			),
			"description" => esc_html__( "Select the background Navigation color.", "crocal-extension" ),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_add_auto_height' ) ) {
	function crocal_ext_vce_add_auto_height() {
		return array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Auto Height", "crocal-extension" ),
			"param_name" => "auto_height",
			"value" => array( esc_html__( "Select if you want smooth auto height", "crocal-extension" ) => 'yes' ),
		);
	}
}


//Title Headings/Tags
if( !function_exists( 'crocal_ext_vce_get_heading_tag' ) ) {
	function crocal_ext_vce_get_heading_tag( $std = '' ) {
		return	array(
			"type" => "dropdown",
			"heading" => esc_html__( "Title Tag", "crocal-extension" ),
			"param_name" => "heading_tag",
			"value" => array(
				esc_html__( "h1", "crocal-extension" ) => 'h1',
				esc_html__( "h2", "crocal-extension" ) => 'h2',
				esc_html__( "h3", "crocal-extension" ) => 'h3',
				esc_html__( "h4", "crocal-extension" ) => 'h4',
				esc_html__( "h5", "crocal-extension" ) => 'h5',
				esc_html__( "h6", "crocal-extension" ) => 'h6',
				esc_html__( "div", "crocal-extension" ) => 'div',
			),
			"description" => esc_html__( "Title Tag for SEO", "crocal-extension" ),
			"std" => $std,
		);
	}
}

if( !function_exists( 'crocal_ext_vce_get_heading' ) ) {
	function crocal_ext_vce_get_heading( $std = '' ) {
		return	array(
			"type" => "dropdown",
			"heading" => esc_html__( "Title Size/Typography", "crocal-extension" ),
			"param_name" => "heading",
			"value" => array(
				esc_html__( "h1", "crocal-extension" ) => 'h1',
				esc_html__( "h2", "crocal-extension" ) => 'h2',
				esc_html__( "h3", "crocal-extension" ) => 'h3',
				esc_html__( "h4", "crocal-extension" ) => 'h4',
				esc_html__( "h5", "crocal-extension" ) => 'h5',
				esc_html__( "h6", "crocal-extension" ) => 'h6',
				esc_html__( "Leader Text", "crocal-extension" ) => 'leader-text',
				esc_html__( "Subtitle Text", "crocal-extension" ) => 'subtitle-text',
				esc_html__( "Small Text", "crocal-extension" ) => 'small-text',
				esc_html__( "Link Text", "crocal-extension" ) => 'link-text',
			),
			"description" => esc_html__( "Title size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
			"std" => $std,
		);
	}
}

// Heading Increase
if( !function_exists( 'crocal_ext_vce_get_heading_increase' ) ) {
	function crocal_ext_vce_get_heading_increase() {
		return	array(
			"type" => "dropdown",
			"heading" => esc_html__( "Increased Heading Size", "crocal-extension" ),
			"param_name" => "increase_heading",
			"value" => array(
				esc_html__( "100%", "crocal-extension" ) => '100',
				esc_html__( "120%", "crocal-extension" ) => '120',
				esc_html__( "140%", "crocal-extension" ) => '140',
				esc_html__( "160%", "crocal-extension" ) => '160',
				esc_html__( "180%", "crocal-extension" ) => '180',
				esc_html__( "200%", "crocal-extension" ) => '200',
				esc_html__( "250%", "crocal-extension" ) => '250',
				esc_html__( "300%", "crocal-extension" ) => '300',
			),
			"description" => esc_html__( "Set the percentage you want to increase your Headings size.", "crocal-extension" ),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_get_heading_increase_reset' ) ) {
	function crocal_ext_vce_get_heading_increase_reset() {
		return	array(
			"type" => "dropdown",
			"heading" => esc_html__( "Reset Heading Size", "crocal-extension" ),
			"param_name" => "increase_heading_reset",
			"value" => array(
				esc_html__( "Never", "crocal-extension" ) => '',
				esc_html__( "on Small Desktop and below", "crocal-extension" ) => 'desktop-sm',
				esc_html__( "on Tablet Landscape and below", "crocal-extension" ) => 'tablet',
				esc_html__( "on Tablet Portrait and below", "crocal-extension" ) => 'tablet-sm',
				esc_html__( "on Mobile Ladscape and below", "crocal-extension" ) => 'mobile',
			),
			"description" => esc_html__( "Select if you want to reset the header size in some devices in case size is too large.", "crocal-extension" ),
			"dependency" => array( 'element' => "increase_heading", 'value_not_equal_to' => array( '100' ) ),
		);
	}
}


if( !function_exists( 'crocal_ext_vce_get_heading_blog' ) ) {
	function crocal_ext_vce_get_heading_blog( $std = '' ) {
		return	array(
			"type" => "dropdown",
			"heading" => esc_html__( "Title Size", "crocal-extension" ),
			"param_name" => "heading",
			"value" => array(
				esc_html__( "Auto", "crocal-extension" ) => 'auto',
				esc_html__( "h1", "crocal-extension" ) => 'h1',
				esc_html__( "h1", "crocal-extension" ) => 'h1',
				esc_html__( "h2", "crocal-extension" ) => 'h2',
				esc_html__( "h3", "crocal-extension" ) => 'h3',
				esc_html__( "h4", "crocal-extension" ) => 'h4',
				esc_html__( "h5", "crocal-extension" ) => 'h5',
				esc_html__( "h6", "crocal-extension" ) => 'h6',
				esc_html__( "Leader Text", "crocal-extension" ) => 'leader-text',
				esc_html__( "Subtitle Text", "crocal-extension" ) => 'subtitle-text',
				esc_html__( "Small Text", "crocal-extension" ) => 'small-text',
				esc_html__( "Link Text", "crocal-extension" ) => 'link-text',
			),
			"description" => esc_html__( "Title size and typography", "crocal-extension" ),
			"std" => $std,
		);
	}
}

if( !function_exists( 'crocal_ext_vce_get_custom_font_family' ) ) {
	function crocal_ext_vce_get_custom_font_family( $std = '' ) {
		return	array(
			"type" => "dropdown",
			"heading" => esc_html__( "Custom Font Family", "crocal-extension" ),
			"param_name" => "custom_font_family",
			"value" => array(
				esc_html__( "Same as Typography", "crocal-extension" ) => '',
				esc_html__( "Custom Font Family 1", "crocal-extension" ) => 'custom-font-1',
				esc_html__( "Custom Font Family 2", "crocal-extension" ) => 'custom-font-2',
				esc_html__( "Custom Font Family 3", "crocal-extension" ) => 'custom-font-3',
				esc_html__( "Custom Font Family 4", "crocal-extension" ) => 'custom-font-4',

			),
			"description" => esc_html__( "Select a different font family, defined in Theme Options - Typography Options - Extras - Custom Font Family", "crocal-extension" ),
			"std" => $std,
		);
	}
}

if( !function_exists( 'crocal_ext_vce_get_gradient_color' ) ) {
	function crocal_ext_vce_get_gradient_color( ) {
		return	array(
			"type" => "dropdown",
			"heading" => esc_html__( "Gradient Color", "crocal-extension" ),
			"param_name" => "gradient_color",
			"value" => array(
				esc_html__( "No", "crocal-extension" ) => '',
				esc_html__( "Yes", "crocal-extension" ) => 'yes',

			),
			"description" => esc_html__( "Select if you want gradient color", "crocal-extension" ),
		);
	}
}

if( !function_exists( 'crocal_ext_vce_get_gradient_color_1' ) ) {
	function crocal_ext_vce_get_gradient_color_1( ) {
		return	array(
				"type" => "dropdown",
				"heading" => esc_html__( "Gradient Color 1 ", "crocal-extension" ),
				"param_name" => "gradient_color_1",
				"param_holder_class" => "eut-colored-dropdown",
				'edit_field_class' => 'vc_col-sm-6',
				"value" => array(
					esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
					esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
					esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
					esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
					esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
					esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
					esc_html__( "Green", "crocal-extension" ) => 'green',
					esc_html__( "Orange", "crocal-extension" ) => 'orange',
					esc_html__( "Red", "crocal-extension" ) => 'red',
					esc_html__( "Blue", "crocal-extension" ) => 'blue',
					esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
					esc_html__( "Purple", "crocal-extension" ) => 'purple',
					esc_html__( "Black", "crocal-extension" ) => 'black',
					esc_html__( "Grey", "crocal-extension" ) => 'grey',
					esc_html__( "White", "crocal-extension" ) => 'white',
				),
				"description" => esc_html__( "Select first color for gradient.", "crocal-extension" ),
				"dependency" => array( 'element' => "gradient_color", 'value' => array( 'yes' ) ),
				"std" => 'primary-1',
		);
	}
}

if( !function_exists( 'crocal_ext_vce_get_gradient_color_2' ) ) {
	function crocal_ext_vce_get_gradient_color_2( ) {
		return	array(
				"type" => "dropdown",
				"heading" => esc_html__( "Gradient Color 2 ", "crocal-extension" ),
				"param_name" => "gradient_color_2",
				"param_holder_class" => "eut-colored-dropdown",
				'edit_field_class' => 'vc_col-sm-6',
				"value" => array(
					esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
					esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
					esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
					esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
					esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
					esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
					esc_html__( "Green", "crocal-extension" ) => 'green',
					esc_html__( "Orange", "crocal-extension" ) => 'orange',
					esc_html__( "Red", "crocal-extension" ) => 'red',
					esc_html__( "Blue", "crocal-extension" ) => 'blue',
					esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
					esc_html__( "Purple", "crocal-extension" ) => 'purple',
					esc_html__( "Black", "crocal-extension" ) => 'black',
					esc_html__( "Grey", "crocal-extension" ) => 'grey',
					esc_html__( "White", "crocal-extension" ) => 'white',
				),
				"description" => esc_html__( "Select second color for gradient.", "crocal-extension" ),
				"dependency" => array( 'element' => "gradient_color", 'value' => array( 'yes' ) ),
				"std" => 'primary-2',
		);
	}
}

function crocal_ext_vce_get_social_links_params() {
	global $crocal_eutf_social_list_extended;

	$social_params = array();
	if ( isset( $crocal_eutf_social_list_extended ) ) {

		foreach ( $crocal_eutf_social_list_extended as $social_item ) {

			$social_params[] = array(
				"type" => "textfield",
				"heading" => esc_html( $social_item['title'] ),
				"param_name" => $social_item['url'],
				"value" => "",
				"group" => esc_html__( "Social Links", "crocal-extension" ),
			);
		}
	}

	return $social_params;
}


function crocal_ext_vce_get_icon_params( $element = '', $dependency = array() ) {

	if ( 'crocal_icon_box' == $element ) {
		$icon_type_options = array(
			esc_html__( "Icon", "crocal-extension" ) => 'icon',
			esc_html__( "Image", "crocal-extension" ) => 'image',
			esc_html__( "Animated SVG", "crocal-extension" ) => 'icon_svg',
			esc_html__( "Character", "crocal-extension" ) => 'char',
		);
	} elseif ( 'crocal_pricing_table' == $element)  {
		$icon_type_options = array(
			esc_html__( "No Icon", "crocal-extension" ) => '',
			esc_html__( "Icon", "crocal-extension" ) => 'icon',
			esc_html__( "Image", "crocal-extension" ) => 'image',
			esc_html__( "Animated SVG", "crocal-extension" ) => 'icon_svg',
		);
	} elseif ( 'crocal_testimonial' == $element)  {
		$icon_type_options = array(
			esc_html__( "No Icon", "crocal-extension" ) => '',
			esc_html__( "Icon", "crocal-extension" ) => 'icon',
			esc_html__( "Image", "crocal-extension" ) => 'image',
			esc_html__( "Animated SVG", "crocal-extension" ) => 'icon_svg',
		);
	} elseif ( 'crocal_counter' == $element )  {
		$icon_type_options = array(
			esc_html__( "No Icon", "crocal-extension" ) => '',
			esc_html__( "Icon", "crocal-extension" ) => 'icon',
			esc_html__( "Animated SVG", "crocal-extension" ) => 'icon_svg',
		);
	} else {
		$icon_type_options = array(
			esc_html__( "Icon", "crocal-extension" ) => 'icon',
			esc_html__( "Animated SVG", "crocal-extension" ) => 'icon_svg',
		);
	}

	$icon_params = array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Icon Type", "crocal-extension" ),
			"param_name" => "icon_type",
			"value" => $icon_type_options,
			"description" => '',
			"dependency" => $dependency,
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Icon size", "crocal-extension" ),
			"param_name" => "icon_size",
			"value" => array(
				esc_html__( "Extra Large", "crocal-extension" ) => 'extra-large',
				esc_html__( "Large", "crocal-extension" ) => 'large',
				esc_html__( "Medium", "crocal-extension" ) => 'medium',
				esc_html__( "Small", "crocal-extension" ) => 'small',
			),
			"std" => 'medium',
			"description" => '',
			"dependency" => array( 'element' => 'icon_type', 'value_not_equal_to' => array( '' ) ),
		),
		array(
			"type" => "attach_image",
			"heading" => esc_html__( "Icon Image", "crocal-extension" ),
			"param_name" => "icon_image",
			"value" => '',
			"description" => esc_html__( "Select an icon image.", "crocal-extension" ),
			"dependency" => array( 'element' => "icon_type", 'value' => array( 'image' ) ),
		),
		array(
			"type" => "attach_image",
			"heading" => esc_html__( "Retina Icon Image", "crocal-extension" ),
			"param_name" => "retina_icon_image",
			"value" => '',
			"description" => esc_html__( "Select a 2x icon.", "crocal-extension" ),
			"dependency" => array( 'element' => "icon_type", 'value' => array( 'image' ) ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'crocal-extension' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'crocal-extension' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'crocal-extension' ) => 'openiconic',
				esc_html__( 'Typicons', 'crocal-extension' ) => 'typicons',
				esc_html__( 'Entypo', 'crocal-extension' ) => 'entypo',
				esc_html__( 'Linecons', 'crocal-extension' ) => 'linecons',
				esc_html__( 'Simple Line Icons', 'crocal-extension' ) => 'simplelineicons',
				esc_html__( 'Elegant Line Icons', 'crocal-extension' ) => 'etlineicons',
			),
			'param_name' => 'icon_library',
			'description' => esc_html__( 'Select icon library.', 'crocal-extension' ),
			"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon' ) ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'icon_openiconic',
			'value' => 'vc-oi vc-oi-dial',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'openiconic',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'icon_typicons',
			'value' => 'typcn typcn-adjust-brightness',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'typicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'icon_entypo',
			'value' => 'entypo-icon entypo-icon-note',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'entypo',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'icon_linecons',
			'value' => 'vc_li vc_li-heart',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'linecons',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'icon_simplelineicons',
			'value' => 'smp-icon-user',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'simplelineicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'simplelineicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'icon_etlineicons',
			'value' => 'et-icon-mobile',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'etlineicons',
				'iconsPerPage' => 100,
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'etlineicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
		),
		array(
			"type" => "attach_image",
			"heading" => esc_html__( "Icon SVG", "crocal-extension" ),
			"param_name" => "icon_svg",
			"value" => '',
			"description" => esc_html__( "Select an svg icon. Note: SVG mime type must be enabled in WordPress", "crocal-extension" ),
			"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon_svg' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__('SVG Animation Duration', 'crocal-extension'),
			"param_name" => "icon_svg_animation_duration",
			"value" => '100',
			"description" => esc_html__( "Add delay in milliseconds.", "crocal-extension" ),
			"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon_svg' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Icon Color", "crocal-extension" ),
			"param_name" => "icon_color",
			"param_holder_class" => "eut-colored-dropdown",
			"value" => array(
				esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
				esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
				esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
				esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
				esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
				esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
				esc_html__( "Green", "crocal-extension" ) => 'green',
				esc_html__( "Orange", "crocal-extension" ) => 'orange',
				esc_html__( "Red", "crocal-extension" ) => 'red',
				esc_html__( "Blue", "crocal-extension" ) => 'blue',
				esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
				esc_html__( "Purple", "crocal-extension" ) => 'purple',
				esc_html__( "Black", "crocal-extension" ) => 'black',
				esc_html__( "Grey", "crocal-extension" ) => 'grey',
				esc_html__( "White", "crocal-extension" ) => 'white',
				esc_html__( "Custom", "crocal-extension" ) => 'custom',
			),
			"description" => esc_html__( "Color of the icon.", "crocal-extension" ),
			"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon', 'icon_svg' ) ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( "Custom Icon Color", "crocal-extension" ),
			'param_name' => 'icon_color_custom',
			'description' => esc_html__( "Select a custom color for your icon", "crocal-extension" ),
			'std' => '#e1e1e1',
			"dependency" => array( 'element' => "icon_color", 'value' => array( 'custom' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Icon shape", "crocal-extension" ),
			"param_name" => "icon_shape",
			"value" => array(
				esc_html__( "None", "crocal-extension" ) => 'no-shape',
				esc_html__( "Square", "crocal-extension" ) => 'square',
				esc_html__( "Round", "crocal-extension" ) => 'round',
				esc_html__( "Circle", "crocal-extension" ) => 'circle',
			),
			"description" => '',
			"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon', 'icon_svg' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Shape type", "crocal-extension" ),
			"param_name" => "icon_shape_type",
			"value" => array(
				esc_html__( "Simple", "crocal-extension" ) => 'simple',
				esc_html__( "Outline", "crocal-extension" ) => 'outline',
			),
			"description" => esc_html__( "Select shape type.", "crocal-extension" ),
			"dependency" => array( 'element' => "icon_shape", 'value' => array( 'square', 'round', 'circle' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Icon Shape Color", "crocal-extension" ),
			"param_name" => "icon_shape_color",
			"param_holder_class" => "eut-colored-dropdown",
			"value" => array(
				esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
				esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
				esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
				esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
				esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
				esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
				esc_html__( "Green", "crocal-extension" ) => 'green',
				esc_html__( "Orange", "crocal-extension" ) => 'orange',
				esc_html__( "Red", "crocal-extension" ) => 'red',
				esc_html__( "Blue", "crocal-extension" ) => 'blue',
				esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
				esc_html__( "Purple", "crocal-extension" ) => 'purple',
				esc_html__( "Black", "crocal-extension" ) => 'black',
				esc_html__( "Grey", "crocal-extension" ) => 'grey',
				esc_html__( "White", "crocal-extension" ) => 'white',
				esc_html__( "Custom", "crocal-extension" ) => 'custom',
			),
			'std' => 'grey',
			"description" => esc_html__( "This affects to the Background of the simple shape type. Alternatively, affects to the line shape type.", "crocal-extension" ),
			"dependency" => array( 'element' => "icon_shape", 'value' => array( 'square', 'round', 'circle' ) ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( "Custom Icon Shape Color", "crocal-extension" ),
			'param_name' => 'icon_shape_color_custom',
			'description' => esc_html__( "Select a custom color for your icon shape.", "crocal-extension" ),
			'std' => '#e1e1e1',
			"dependency" => array( 'element' => "icon_shape_color", 'value' => array( 'custom' ) ),
		),
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Enable Hover Effect", "crocal-extension" ),
			"param_name" => "icon_hover_effect",
			"value" => array( esc_html__( "If selected, you will have hover effect.", "crocal-extension" ) => 'yes' ),
			"dependency" => array( 'element' => "icon_shape", 'value' => array( 'square', 'round', 'circle' ) ),
		),
	);

	return $icon_params;

}
//Button Parameters

function crocal_ext_vce_get_button_params( $group = 'button', $index = '' ) {


	if ( 'first' == $group ) {
		$group_string = esc_html__( "First Button", "crocal-extension" );
	} elseif ( 'second' == $group ) {
		$group_string = esc_html__( "Second Button", "crocal-extension" );
	} else {
		$group_string = esc_html__( "Button", "crocal-extension" );
	}

	$btn_params = array(
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Button Text", "crocal-extension" ),
			"param_name" => "button" . $index . "_text",
			"save_always" => true,
			"admin_label" => true,
			"value" => "Button",
			"description" => esc_html__( "Text of the button.", "crocal-extension" ),
			"group" => $group_string,
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Type", "crocal-extension" ),
			"param_name" => "button" . $index . "_type",
			"value" => array(
				esc_html__( "Simple", "crocal-extension" ) => 'simple',
				esc_html__( "Outline", "crocal-extension" ) => 'outline',
				esc_html__( "Underline", "crocal-extension" ) => 'underline',
				esc_html__( "Gradient", "crocal-extension" ) => 'gradient',
			),
			"description" => esc_html__( "Select button type.", "crocal-extension" ),
			"group" => $group_string,
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Color", "crocal-extension" ),
			"param_name" => "button" . $index . "_color",
			"param_holder_class" => "eut-colored-dropdown",
			"value" => array(
				esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
				esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
				esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
				esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
				esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
				esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
				esc_html__( "Green", "crocal-extension" ) => 'green',
				esc_html__( "Orange", "crocal-extension" ) => 'orange',
				esc_html__( "Red", "crocal-extension" ) => 'red',
				esc_html__( "Blue", "crocal-extension" ) => 'blue',
				esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
				esc_html__( "Purple", "crocal-extension" ) => 'purple',
				esc_html__( "Black", "crocal-extension" ) => 'black',
				esc_html__( "Grey", "crocal-extension" ) => 'grey',
				esc_html__( "White", "crocal-extension" ) => 'white',
			),
			"description" => esc_html__( "Color of the button.", "crocal-extension" ),
			"dependency" => array( 'element' => "button" . $index . "_type", 'value' => array( 'simple', 'outline', 'underline' ) ),
			"group" => $group_string,
			"std" => 'primary-1',
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Line Color", "crocal-extension" ),
			"param_name" => "button" . $index . "_line_color",
			"param_holder_class" => "eut-colored-dropdown",
			"value" => array(
				esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
				esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
				esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
				esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
				esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
				esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
				esc_html__( "Green", "crocal-extension" ) => 'green',
				esc_html__( "Orange", "crocal-extension" ) => 'orange',
				esc_html__( "Red", "crocal-extension" ) => 'red',
				esc_html__( "Blue", "crocal-extension" ) => 'blue',
				esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
				esc_html__( "Purple", "crocal-extension" ) => 'purple',
				esc_html__( "Black", "crocal-extension" ) => 'black',
				esc_html__( "Grey", "crocal-extension" ) => 'grey',
				esc_html__( "White", "crocal-extension" ) => 'white',
			),
			"description" => esc_html__( "Color of the button line.", "crocal-extension" ),
			"dependency" => array( 'element' => "button" . $index . "_type", 'value' => array( 'underline' ) ),
			"group" => $group_string,
			"std" => 'primary-1',
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Gradient Color 1", "crocal-extension" ),
			"param_name" => "button" . $index . "_gradient_color_1",
			"param_holder_class" => "eut-colored-dropdown",
			'edit_field_class' => 'vc_col-sm-6',
			"value" => array(
				esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
				esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
				esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
				esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
				esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
				esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
				esc_html__( "Green", "crocal-extension" ) => 'green',
				esc_html__( "Orange", "crocal-extension" ) => 'orange',
				esc_html__( "Red", "crocal-extension" ) => 'red',
				esc_html__( "Blue", "crocal-extension" ) => 'blue',
				esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
				esc_html__( "Purple", "crocal-extension" ) => 'purple',
				esc_html__( "Black", "crocal-extension" ) => 'black',
				esc_html__( "Grey", "crocal-extension" ) => 'grey',
				esc_html__( "White", "crocal-extension" ) => 'white',
			),
			"description" => esc_html__( "Select first color for gradient.", "crocal-extension" ),
			"dependency" => array( 'element' => "button" . $index . "_type", 'value' => array( 'gradient' ) ),
			"group" => $group_string,
			"std" => 'primary-1',
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Gradient Color 2", "crocal-extension" ),
			"param_name" => "button" . $index . "_gradient_color_2",
			"param_holder_class" => "eut-colored-dropdown",
			'edit_field_class' => 'vc_col-sm-6',
			"value" => array(
				esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
				esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
				esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
				esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
				esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
				esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
				esc_html__( "Green", "crocal-extension" ) => 'green',
				esc_html__( "Orange", "crocal-extension" ) => 'orange',
				esc_html__( "Red", "crocal-extension" ) => 'red',
				esc_html__( "Blue", "crocal-extension" ) => 'blue',
				esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
				esc_html__( "Purple", "crocal-extension" ) => 'purple',
				esc_html__( "Black", "crocal-extension" ) => 'black',
				esc_html__( "Grey", "crocal-extension" ) => 'grey',
				esc_html__( "White", "crocal-extension" ) => 'white',
			),
			"description" => esc_html__( "Select second color for gradient.", "crocal-extension" ),
			"dependency" => array( 'element' => "button" . $index . "_type", 'value' => array( 'gradient' ) ),
			"group" => $group_string,
			"std" => 'primary-2',
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Hover Color", "crocal-extension" ),
			"param_name" => "button" . $index . "_hover_color",
			"param_holder_class" => "eut-colored-dropdown",
			"value" => array(
				esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
				esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
				esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
				esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
				esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
				esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
				esc_html__( "Green", "crocal-extension" ) => 'green',
				esc_html__( "Orange", "crocal-extension" ) => 'orange',
				esc_html__( "Red", "crocal-extension" ) => 'red',
				esc_html__( "Blue", "crocal-extension" ) => 'blue',
				esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
				esc_html__( "Purple", "crocal-extension" ) => 'purple',
				esc_html__( "Black", "crocal-extension" ) => 'black',
				esc_html__( "Grey", "crocal-extension" ) => 'grey',
				esc_html__( "White", "crocal-extension" ) => 'white',
			),
			"description" => esc_html__( "Color of the button.", "crocal-extension" ),
			"dependency" => array( 'element' => "button" . $index . "_type", 'value' => array( 'simple', 'outline', 'gradient' ) ),
			"group" => $group_string,
			"std" => 'black',
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Size", "crocal-extension" ),
			"param_name" => "button" . $index . "_size",
			"value" => array(
				esc_html__( "Extra Small", "crocal-extension" ) => 'extrasmall',
				esc_html__( "Small", "crocal-extension" ) => 'small',
				esc_html__( "Medium", "crocal-extension" ) => 'medium',
				esc_html__( "Large", "crocal-extension" ) => 'large',
				esc_html__( "Extra Large", "crocal-extension" ) => 'extralarge',
			),
			"description" => '',
			"std" => 'medium',
			"group" => $group_string,
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Shape", "crocal-extension" ),
			"param_name" => "button" . $index . "_shape",
			"value" => array(
				esc_html__( "Square", "crocal-extension" ) => 'square',
				esc_html__( "Round", "crocal-extension" ) => 'round',
				esc_html__( "Extra Round", "crocal-extension" ) => 'extra-round',
			),
			"dependency" => array( 'element' => "button" . $index . "_type", 'value' => array( 'simple', 'outline', 'gradient' ) ),
			"description" => '',
			"std" => 'square',
			"group" => $group_string,
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Button Shadow", "crocal-extension" ),
			"param_name" => "button" . $index . "_shadow",
			"value" => array(
				esc_html__( "None", "crocal-extension" ) => '',
				esc_html__( "Small", "crocal-extension" ) => 'small',
				esc_html__( "Medium", "crocal-extension" ) => 'medium',
				esc_html__( "Large", "crocal-extension" ) => 'large',
			),
			"dependency" => array( 'element' => "button" . $index . "_type", 'value' => array( 'simple', 'gradient' ) ),
			"description" => '',
			"std" => '',
			"group" => $group_string,
		),
		array(
			"type" => "vc_link",
			"heading" => esc_html__( "Button Link", "crocal-extension" ),
			"param_name" => "button" . $index . "_link",
			"value" => "",
			"description" => esc_html__( "Enter link.", "crocal-extension" ),
			"group" => $group_string,
		),
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Add icon?", "crocal-extension" ),
			"param_name" => "btn" . $index . "_add_icon",
			"value" => array( esc_html__( "Select if you want to show an icon next to button", "crocal-extension" ) => 'yes' ),
			"group" => $group_string
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'crocal-extension' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'crocal-extension' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'crocal-extension' ) => 'openiconic',
				esc_html__( 'Typicons', 'crocal-extension' ) => 'typicons',
				esc_html__( 'Entypo', 'crocal-extension' ) => 'entypo',
				esc_html__( 'Linecons', 'crocal-extension' ) => 'linecons',
				esc_html__( 'Simple Line Icons', 'crocal-extension' ) => 'simplelineicons',
				esc_html__( 'Elegant Line Icons', 'crocal-extension' ) => 'etlineicons',
			),
			'param_name' => 'btn' . $index . '_icon_library',
			'description' => esc_html__( 'Select icon library.', 'crocal-extension' ),
			"dependency" => array( 'element' => "btn" . $index . "_add_icon", 'value' => array( 'yes' ) ),
			"group" => $group_string,
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'btn' . $index . '_icon_fontawesome',
			'value' => 'fa fa-adjust',
			'settings' => array(
				'emptyIcon' => false,
				'iconsPerPage' => 200,
			),
			'dependency' => array(
				'element' => 'btn' . $index . '_icon_library',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
			"group" => $group_string,
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'btn' . $index . '_icon_openiconic',
			'value' => 'vc-oi vc-oi-dial',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'openiconic',
				'iconsPerPage' => 200,
			),
			'dependency' => array(
				'element' => 'btn' . $index . '_icon_library',
				'value' => 'openiconic',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
			"group" => $group_string,
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'btn' . $index . '_icon_typicons',
			'value' => 'typcn typcn-adjust-brightness',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'typicons',
				'iconsPerPage' => 200,
			),
			'dependency' => array(
				'element' => 'btn' . $index . '_icon_library',
				'value' => 'typicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
			"group" => $group_string,
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'btn' . $index . '_icon_entypo',
			'value' => 'entypo-icon entypo-icon-note',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'entypo',
				'iconsPerPage' => 300,
			),
			'dependency' => array(
				'element' => 'btn' . $index . '_icon_library',
				'value' => 'entypo',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
			"group" => $group_string,
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'btn' . $index . '_icon_linecons',
			'value' => 'vc_li vc_li-heart',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'linecons',
				'iconsPerPage' => 200,
			),
			'dependency' => array(
				'element' => 'btn' . $index . '_icon_library',
				'value' => 'linecons',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
			"group" => $group_string,
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'btn' . $index . '_icon_simplelineicons',
			'value' => 'smp-icon-user',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'simplelineicons',
				'iconsPerPage' => 200,
			),
			'dependency' => array(
				'element' => 'btn' . $index . '_icon_library',
				'value' => 'simplelineicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
			"group" => $group_string,
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'crocal-extension' ),
			'param_name' => 'btn' . $index . '_icon_etlineicons',
			'value' => 'et-icon-mobile',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'etlineicons',
				'iconsPerPage' => 100,
			),
			'dependency' => array(
				'element' => 'btn' . $index . '_icon_library',
				'value' => 'etlineicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
			"group" => $group_string,
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Button class name", "crocal-extension" ),
			"param_name" => "button" . $index . "_class",
			"description" => esc_html__( "If you wish to style your button differently, then use this field to add a class name and then refer to it in your css file.", "crocal-extension" ),
			"group" => $group_string,
		),
	);
	return $btn_params;
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
