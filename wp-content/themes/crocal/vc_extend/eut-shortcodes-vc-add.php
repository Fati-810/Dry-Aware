<?php
/*
 *	Euthemians Visual Composer Shortcode Extensions
 *
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */


if ( function_exists( 'vc_add_param' ) ) {

	//Generic css aniation for elements

	$crocal_eutf_add_animation = array(
		"type" => "dropdown",
		"heading" => esc_html__("CSS Animation", 'crocal' ),
		"param_name" => "animation",
		"admin_label" => true,
		"value" => array(
			esc_html__( "No", "crocal" ) => '',
			esc_html__( "Fade In", "crocal" ) => "eut-fade-in",
			esc_html__( "Fade In Up", "crocal" ) => "eut-fade-in-up",
			esc_html__( "Fade In Up Big", "crocal" ) => "eut-fade-in-up-big",
			esc_html__( "Fade In Down", "crocal" ) => "eut-fade-in-down",
			esc_html__( "Fade In Down Big", "crocal" ) => "eut-fade-in-down-big",
			esc_html__( "Fade In Left", "crocal" ) => "eut-fade-in-left",
			esc_html__( "Fade In Left Big", "crocal" ) => "eut-fade-in-left-big",
			esc_html__( "Fade In Right", "crocal" ) => "eut-fade-in-right",
			esc_html__( "Fade In Right Big", "crocal" ) => "eut-fade-in-right-big",
			esc_html__( "Zoom In", "crocal" ) => "eut-zoom-in",
		),
		"group" => esc_html__( "Animation", "crocal" ),
		"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'crocal' ),
	);

	$crocal_eutf_add_column_animation = array(
		"type" => "dropdown",
		"heading" => esc_html__("CSS Animation", 'crocal' ),
		"param_name" => "animation",
		"admin_label" => true,
		"value" => array(
			esc_html__( "No", "crocal" ) => '',
			esc_html__( "Fade In", "crocal" ) => "fade-in",
			esc_html__( "Fade In Up", "crocal" ) => "fade-in-up",
			esc_html__( "Fade In Up Big", "crocal" ) => "fade-in-up-big",
			esc_html__( "Fade In Down", "crocal" ) => "fade-in-down",
			esc_html__( "Fade In Down Big", "crocal" ) => "fade-in-down-big",
			esc_html__( "Fade In Left", "crocal" ) => "fade-in-left",
			esc_html__( "Fade In Left Big", "crocal" ) => "fade-in-left-big",
			esc_html__( "Fade In Right", "crocal" ) => "fade-in-right",
			esc_html__( "Fade In Right Big", "crocal" ) => "fade-in-right-big",
			esc_html__( "Zoom In", "crocal" ) => "zoom-in",
		),
		"description" => esc_html__("Select type of animation if you want this column to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'crocal' ),
		"group" => esc_html__( "Animation", "crocal" ),
	);

	$crocal_eutf_add_animation_delay = array(
		"type" => "textfield",
		"heading" => esc_html__( 'Css Animation Delay', 'crocal' ),
		"param_name" => "animation_delay",
		"value" => '0',
		"description" => esc_html__( "Add delay in milliseconds.", 'crocal' ),
		"dependency" => array(
			'element' => 'animation',
			'value_not_equal_to' => array( '' )
		),
		"group" => esc_html__( "Animation", "crocal" ),
	);

	$crocal_eutf_add_animation_duration = array(
		"type" => "dropdown",
		"heading" => esc_html__("CSS Animation Duration", 'crocal' ),
		"param_name" => "animation_duration",
		"value" => array(
			esc_html__( "Very Fast", "crocal" ) => "very-fast",
			esc_html__( "Fast", "crocal" ) => "fast",
			esc_html__( "Normal", "crocal" ) => "normal",
			esc_html__( "Slow", "crocal" ) => "slow",
			esc_html__( "Very Slow", "crocal" ) => "very-slow",
		),
		"std" => 'normal',
		"description" => esc_html__("Select the duration for your animated element.", 'crocal' ),
		"dependency" => array(
			'element' => 'animation',
			'value_not_equal_to' => array( '' )
		),
		"group" => esc_html__( "Animation", "crocal" ),
	);

	$crocal_eutf_add_column_clipping_animation = array(
		"type" => "dropdown",
		"heading" => esc_html__("CSS Clipping Animation", 'crocal' ),
		"param_name" => "clipping_animation",
		"admin_label" => true,
		"value" => array(
			esc_html__( "No", "crocal" ) => '',
			esc_html__( "Clipping Up", "crocal" ) => "clipping-up",
			esc_html__( "Clipping Down", "crocal" ) => "clipping-down",
			esc_html__( "Clipping Left", "crocal" ) => "clipping-left",
			esc_html__( "Clipping Right", "crocal" ) => "clipping-right",
			esc_html__( "Colored Clipping Up", "crocal" ) => "colored-clipping-up",
			esc_html__( "Colored Clipping Down", "crocal" ) => "colored-clipping-down",
			esc_html__( "Colored Clipping Left", "crocal" ) => "colored-clipping-left",
			esc_html__( "Colored Clipping Right", "crocal" ) => "colored-clipping-right",
		),
		"description" => esc_html__("Select type of animation if you want this column to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'crocal' ),
		"group" => esc_html__( "Animation", "crocal" ),
	);


	$crocal_eutf_add_clipping_animation_colors = array(
		"type" => "dropdown",
		"heading" => esc_html__( "Clipping Color", 'crocal' ),
		"param_name" => "clipping_animation_colors",
		"param_holder_class" => "eut-colored-dropdown",
		"value" => array(
			esc_html__( "Dark", 'crocal' ) => 'dark',
			esc_html__( "Light", 'crocal' ) => 'light',
			esc_html__( "Primary 1", 'crocal' ) => 'primary-1',
			esc_html__( "Primary 2", 'crocal' ) => 'primary-2',
			esc_html__( "Primary 3", 'crocal' ) => 'primary-3',
			esc_html__( "Primary 4", 'crocal' ) => 'primary-4',
			esc_html__( "Primary 5", 'crocal' ) => 'primary-5',
			esc_html__( "Primary 6", 'crocal' ) => 'primary-6',
			esc_html__( "Green", 'crocal' ) => 'green',
			esc_html__( "Orange", 'crocal' ) => 'orange',
			esc_html__( "Red", 'crocal' ) => 'red',
			esc_html__( "Blue", 'crocal' ) => 'blue',
			esc_html__( "Aqua", 'crocal' ) => 'aqua',
			esc_html__( "Purple", 'crocal' ) => 'purple',
			esc_html__( "Grey", 'crocal' ) => 'grey',
		),
		"description" => esc_html__( "Select clipping color", 'crocal' ),
		"dependency" => array(
			'element' => 'clipping_animation',
			'value' => array( 'colored-clipping-up', 'colored-clipping-down', 'colored-clipping-left', 'colored-clipping-right' )
		),
		"group" => esc_html__( "Animation", "crocal" ),
	);

	$crocal_eutf_add_clipping_animation_delay = array(
		"type" => "textfield",
		"heading" => esc_html__( 'Css Animation Delay', 'crocal' ),
		"param_name" => "animation_delay",
		"value" => '200',
		"description" => esc_html__( "Add delay in milliseconds.", 'crocal' ),
		"dependency" => array(
			'element' => 'clipping_animation',
			'value_not_equal_to' => array( '' )
		),
		"group" => esc_html__( "Animation", "crocal" ),
	);

	$crocal_eutf_add_margin_bottom = array(
		"type" => "textfield",
		"heading" => esc_html__( 'Bottom margin', 'crocal' ),
		"param_name" => "margin_bottom",
		"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'crocal' ),
	);

	$crocal_eutf_add_el_class = array(
		"type" => "textfield",
		"heading" => esc_html__("Extra class name", 'crocal' ),
		"param_name" => "el_class",
		"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'crocal' ),
	);
	$crocal_eutf_add_el_wrapper_class = array(
		"type" => "textfield",
		"heading" => esc_html__("Wrapper class name", 'crocal' ),
		"param_name" => "el_wrapper_class",
		"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'crocal' ),
	);

	$crocal_eutf_add_el_id =array(
		'type' => 'el_id',
		'heading' => __( 'Element ID', 'crocal' ),
		'param_name' => 'el_id',
		'description' => esc_html__( 'Enter element ID (Note: make sure it is unique and valid).', 'crocal' ),
	);

	$crocal_eutf_column_order_list = array(
		esc_html__( "Default", 'crocal' ) => '',
		esc_html__( "order 1", 'crocal' ) => '1',
		esc_html__( "order 2", 'crocal' ) => '2',
		esc_html__( "order 3", 'crocal' ) => '3',
		esc_html__( "order 4", 'crocal' ) => '4',
		esc_html__( "order 5", 'crocal' ) => '5',
		esc_html__( "order 6", 'crocal' ) => '6',
	);

	$crocal_eutf_column_width_list = array(
		esc_html__( '1 column - 1/12', 'crocal' ) => '1/12',
		esc_html__( '2 columns - 1/6', 'crocal' ) => '1/6',
		esc_html__( '3 columns - 1/4', 'crocal' ) => '1/4',
		esc_html__( '4 columns - 1/3', 'crocal' ) => '1/3',
		esc_html__( '5 columns - 5/12', 'crocal' ) => '5/12',
		esc_html__( '6 columns - 1/2', 'crocal' ) => '1/2',
		esc_html__( '7 columns - 7/12', 'crocal' ) => '7/12',
		esc_html__( '8 columns - 2/3', 'crocal' ) => '2/3',
		esc_html__( '9 columns - 3/4', 'crocal' ) => '3/4',
		esc_html__( '10 columns - 5/6', 'crocal' ) => '5/6',
		esc_html__( '11 columns - 11/12', 'crocal' ) => '11/12',
		esc_html__( '12 columns - 1/1', 'crocal' ) => '1/1'
	);

	$crocal_eutf_column_desktop_hide_list = array(
		esc_html__( 'Default value from width attribute', 'crocal') => '',
		esc_html__( 'Hide', 'crocal' ) => 'hide',
	);

	$crocal_eutf_column_width_tablet_list = array(
		esc_html__( 'Default value from width attribute', 'crocal') => '',
		esc_html__( 'Hide', 'crocal' ) => 'hide',
		esc_html__( '1 column - 1/12', 'crocal' ) => '1-12',
		esc_html__( '2 columns - 1/6', 'crocal' ) => '1-6',
		esc_html__( '3 columns - 1/4', 'crocal' ) => '1-4',
		esc_html__( '4 columns - 1/3', 'crocal' ) => '1-3',
		esc_html__( '5 columns - 5/12', 'crocal' ) => '5-12',
		esc_html__( '6 columns - 1/2', 'crocal' ) => '1-2',
		esc_html__( '7 columns - 7/12', 'crocal' ) => '7-12',
		esc_html__( '8 columns - 2/3', 'crocal' ) => '2-3',
		esc_html__( '9 columns - 3/4', 'crocal' ) => '3-4',
		esc_html__( '10 columns - 5/6', 'crocal' ) => '5-6',
		esc_html__( '11 columns - 11/12', 'crocal' ) => '11-12',
		esc_html__( '12 columns - 1/1', 'crocal' ) => '1',
	);

	$crocal_eutf_column_width_tablet_sm_list = array(
		esc_html__( 'Inherit from Tablet Landscape', 'crocal') => '',
		esc_html__( 'Hide', 'crocal' ) => 'hide',
		esc_html__( '1 column - 1/12', 'crocal' ) => '1-12',
		esc_html__( '2 columns - 1/6', 'crocal' ) => '1-6',
		esc_html__( '3 columns - 1/4', 'crocal' ) => '1-4',
		esc_html__( '4 columns - 1/3', 'crocal' ) => '1-3',
		esc_html__( '5 columns - 5/12', 'crocal' ) => '5-12',
		esc_html__( '6 columns - 1/2', 'crocal' ) => '1-2',
		esc_html__( '7 columns - 7/12', 'crocal' ) => '7-12',
		esc_html__( '8 columns - 2/3', 'crocal' ) => '2-3',
		esc_html__( '9 columns - 3/4', 'crocal' ) => '3-4',
		esc_html__( '10 columns - 5/6', 'crocal' ) => '5-6',
		esc_html__( '11 columns - 11/12', 'crocal' ) => '11-12',
		esc_html__( '12 columns - 1/1', 'crocal' ) => '1',
	);
	$crocal_eutf_column_mobile_width_list = array(
		esc_html__( 'Default value 12 columns - 1/1', 'crocal' ) => '',
		esc_html__( 'Hide', 'crocal' ) => 'hide',
		esc_html__( '3 columns - 1/4', 'crocal' ) => '1-4',
		esc_html__( '4 columns - 1/3', 'crocal' ) => '1-3',
		esc_html__( '6 columns - 1/2', 'crocal' ) => '1-2',
		esc_html__( '12 columns - 1/1', 'crocal' ) => '1',
	);

	//Add additional column options for Page Builder 5.5
	if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, '5.5', '>=' ) ) {
		$crocal_eutf_extra_list = array(
			esc_html__( '20% - 1/5', 'crocal' ) => '1/5',
			esc_html__( '40% - 2/5', 'crocal' ) => '2/5',
			esc_html__( '60% - 3/5', 'crocal' ) => '3/5',
			esc_html__( '80% - 4/5', 'crocal' ) => '4/5',
		);
		$crocal_eutf_column_width_list = array_merge( $crocal_eutf_column_width_list, $crocal_eutf_extra_list);

		$crocal_eutf_extra_list_simplified = array(
			esc_html__( '20% - 1/5', 'crocal' ) => '1-5',
			esc_html__( '40% - 2/5', 'crocal' ) => '2-5',
			esc_html__( '60% - 3/5', 'crocal' ) => '3-5',
			esc_html__( '80% - 4/5', 'crocal' ) => '4-5',
		);
		$crocal_eutf_column_width_tablet_list = array_merge( $crocal_eutf_column_width_tablet_list, $crocal_eutf_extra_list_simplified );
		$crocal_eutf_column_width_tablet_sm_list = array_merge( $crocal_eutf_column_width_tablet_sm_list, $crocal_eutf_extra_list_simplified );
		$crocal_eutf_column_mobile_width_list = array_merge( $crocal_eutf_column_mobile_width_list, $crocal_eutf_extra_list_simplified );
	}

	$crocal_eutf_column_gap_list = array(
		esc_html__( 'No Gap', 'crocal' ) => 'none',
		esc_html__( 'Default', 'crocal' ) => 'default',
		esc_html__( '5px', 'crocal' ) => '5',
		esc_html__( '10px', 'crocal' ) => '10',
		esc_html__( '15px', 'crocal' ) => '15',
		esc_html__( '20px', 'crocal' ) => '20',
		esc_html__( '25px', 'crocal' ) => '25',
		esc_html__( '30px', 'crocal' ) => '30',
		esc_html__( '35px', 'crocal' ) => '35',
		esc_html__( '40px', 'crocal' ) => '40',
		esc_html__( '45px', 'crocal' ) => '45',
		esc_html__( '50px', 'crocal' ) => '50',
		esc_html__( '55px', 'crocal' ) => '55',
		esc_html__( '60px', 'crocal' ) => '60',
	);

	$crocal_eutf_position_list = array(
		esc_html__( "None", 'crocal' ) => '',
		esc_html__( "1x", 'crocal' ) => '1x',
		esc_html__( "2x", 'crocal' ) => '2x',
		esc_html__( "3x", 'crocal' ) => '3x',
		esc_html__( "4x", 'crocal' ) => '4x',
		esc_html__( "5x", 'crocal' ) => '5x',
		esc_html__( "6x", 'crocal' ) => '6x',
		esc_html__( "-1x", 'crocal' ) => 'minus-1x',
		esc_html__( "-2x", 'crocal' ) => 'minus-2x',
		esc_html__( "-3x", 'crocal' ) => 'minus-3x',
		esc_html__( "-4x", 'crocal' ) => 'minus-4x',
		esc_html__( "-5x", 'crocal' ) => 'minus-5x',
		esc_html__( "-6x", 'crocal' ) => 'minus-6x',
	);

	$crocal_eutf_separator_list = array(
		esc_html__( "None", 'crocal' ) => '',
		esc_html__( "Triangle", 'crocal' ) => 'triangle-separator',
		esc_html__( "Large Triangle", 'crocal' ) => 'large-triangle-separator',
		esc_html__( "Curve", 'crocal' ) => 'curve-separator',
		esc_html__( "Curve Left", 'crocal' ) => 'curve-left-separator',
		esc_html__( "Curve Right", 'crocal' ) => 'curve-right-separator',
		esc_html__( "Tilt Left", 'crocal' ) => 'tilt-left-separator',
		esc_html__( "Tilt Right", 'crocal' ) => 'tilt-right-separator',
		esc_html__( "Round Split", 'crocal' ) => 'round-split-separator',
		esc_html__( "Wave Left", 'crocal' ) => 'wave-left-separator',
		esc_html__( "Wave Right", 'crocal' ) => 'wave-right-separator',
		esc_html__( "Wave 2 Left", 'crocal' ) => 'wave-2-left-separator',
		esc_html__( "Wave 2 Right", 'crocal' ) => 'wave-2-right-separator',
		esc_html__( "Line", 'crocal' ) => 'line-separator',
		esc_html__( "Torn Paper", 'crocal' ) => 'torn-paper-separator',
	);

	$crocal_eutf_separator_size_list = array(
		esc_html__( "30px", 'crocal' ) => '30px',
		esc_html__( "60px", 'crocal' ) => '60px',
		esc_html__( "90px", 'crocal' ) => '90px',
		esc_html__( "120px", 'crocal' ) => '120px',
		esc_html__( "150px", 'crocal' ) => '150px',
		esc_html__( "180px", 'crocal' ) => '180px',
		esc_html__( "200px", 'crocal' ) => '200px',
		esc_html__( "300px", 'crocal' ) => '300px',
		esc_html__( "10%", 'crocal' ) => '10%',
		esc_html__( "20%", 'crocal' ) => '20%',
		esc_html__( "30%", 'crocal' ) => '30%',
		esc_html__( "40%", 'crocal' ) => '40%',
		esc_html__( "50%", 'crocal' ) => '50%',
		esc_html__( "60%", 'crocal' ) => '60%',
		esc_html__( "70%", 'crocal' ) => '70%',
		esc_html__( "80%", 'crocal' ) => '80%',
		esc_html__( "90%", 'crocal' ) => '90%',
		esc_html__( "100%", 'crocal' ) => '100%',
	);

	//Title Headings/Tags
	if( !function_exists( 'crocal_eutf_get_heading_tag' ) ) {
		function crocal_eutf_get_heading_tag( $std = '' ) {
			return	array(
				"type" => "dropdown",
				"heading" => esc_html__( "Title Tag", "crocal" ),
				"param_name" => "heading_tag",
				"value" => array(
					esc_html__( "h1", "crocal" ) => 'h1',
					esc_html__( "h2", "crocal" ) => 'h2',
					esc_html__( "h3", "crocal" ) => 'h3',
					esc_html__( "h4", "crocal" ) => 'h4',
					esc_html__( "h5", "crocal" ) => 'h5',
					esc_html__( "h6", "crocal" ) => 'h6',
					esc_html__( "div", "crocal" ) => 'div',
				),
				"description" => esc_html__( "Title Tag for SEO", "crocal" ),
				"std" => $std,
				"group" => esc_html__( "Titles & Styles", "crocal" ),
			);
		}
	}

	if( !function_exists( 'crocal_eutf_get_heading' ) ) {
		function crocal_eutf_get_heading( $std = '' ) {
			return	array(
				"type" => "dropdown",
				"heading" => esc_html__( "Title Size/Typography", "crocal" ),
				"param_name" => "heading",
				"value" => array(
					esc_html__( "h1", "crocal" ) => 'h1',
					esc_html__( "h2", "crocal" ) => 'h2',
					esc_html__( "h3", "crocal" ) => 'h3',
					esc_html__( "h4", "crocal" ) => 'h4',
					esc_html__( "h5", "crocal" ) => 'h5',
					esc_html__( "h6", "crocal" ) => 'h6',
					esc_html__( "Leader Text", "crocal" ) => 'leader-text',
					esc_html__( "Subtitle Text", "crocal" ) => 'subtitle-text',
					esc_html__( "Small Text", "crocal" ) => 'small-text',
					esc_html__( "Link Text", "crocal" ) => 'link-text',
				),
				"description" => esc_html__( "Title size and typography, defined in Theme Options - Typography Options", "crocal" ),
				"std" => $std,
				"group" => esc_html__( "Titles & Styles", "crocal" ),
			);
		}
	}
	if( !function_exists( 'crocal_eutf_get_custom_font_family' ) ) {
		function crocal_eutf_get_custom_font_family( $std = '' ) {
			return	array(
				"type" => "dropdown",
				"heading" => esc_html__( "Custom Font Family", "crocal" ),
				"param_name" => "custom_font_family",
				"value" => array(
					esc_html__( "Same as Typography", "crocal" ) => '',
					esc_html__( "Custom Font Family 1", "crocal" ) => 'custom-font-1',
					esc_html__( "Custom Font Family 2", "crocal" ) => 'custom-font-2',
					esc_html__( "Custom Font Family 3", "crocal" ) => 'custom-font-3',
					esc_html__( "Custom Font Family 4", "crocal" ) => 'custom-font-4',

				),
				"description" => esc_html__( "Select a different font family, defined in Theme Options - Typography Options - Extras - Custom Font Family", "crocal" ),
				"std" => $std,
				"group" => esc_html__( "Titles & Styles", "crocal" ),
			);
		}
	}

	function crocal_eutf_rc_style_params( $tag = 'vc_row' ) {

		vc_add_param( $tag,
			array(
				"type" => "colorpicker",
				"heading" => esc_html__('Font Color', 'crocal' ),
				"param_name" => "rc_font_color",
				"description" => esc_html__("Select font color", 'crocal' ),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Heading Color", 'crocal' ),
				"param_name" => "rc_heading_color",
				"param_holder_class" => "eut-colored-dropdown",
				"value" => array(
					esc_html__( "Default", 'crocal' ) => '',
					esc_html__( "Dark", 'crocal' ) => 'dark',
					esc_html__( "Light", 'crocal' ) => 'light',
					esc_html__( "Primary 1", 'crocal' ) => 'primary-1',
					esc_html__( "Primary 2", 'crocal' ) => 'primary-2',
					esc_html__( "Primary 3", 'crocal' ) => 'primary-3',
					esc_html__( "Primary 4", 'crocal' ) => 'primary-4',
					esc_html__( "Primary 5", 'crocal' ) => 'primary-5',
					esc_html__( "Primary 6", 'crocal' ) => 'primary-6',
					esc_html__( "Green", 'crocal' ) => 'green',
					esc_html__( "Orange", 'crocal' ) => 'orange',
					esc_html__( "Red", 'crocal' ) => 'red',
					esc_html__( "Blue", 'crocal' ) => 'blue',
					esc_html__( "Aqua", 'crocal' ) => 'aqua',
					esc_html__( "Purple", 'crocal' ) => 'purple',
					esc_html__( "Grey", 'crocal' ) => 'grey',
				),
				"description" => esc_html__( "Select heading color", 'crocal' ),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Link Color", 'crocal' ),
				"param_name" => "rc_link_color",
				"param_holder_class" => "eut-colored-dropdown",
				"value" => array(
					esc_html__( "Default", 'crocal' ) => '',
					esc_html__( "Dark", 'crocal' ) => 'dark',
					esc_html__( "Light", 'crocal' ) => 'light',
					esc_html__( "Primary 1", 'crocal' ) => 'primary-1',
					esc_html__( "Primary 2", 'crocal' ) => 'primary-2',
					esc_html__( "Primary 3", 'crocal' ) => 'primary-3',
					esc_html__( "Primary 4", 'crocal' ) => 'primary-4',
					esc_html__( "Primary 5", 'crocal' ) => 'primary-5',
					esc_html__( "Primary 6", 'crocal' ) => 'primary-6',
					esc_html__( "Green", 'crocal' ) => 'green',
					esc_html__( "Orange", 'crocal' ) => 'orange',
					esc_html__( "Red", 'crocal' ) => 'red',
					esc_html__( "Blue", 'crocal' ) => 'blue',
					esc_html__( "Aqua", 'crocal' ) => 'aqua',
					esc_html__( "Purple", 'crocal' ) => 'purple',
					esc_html__( "Grey", 'crocal' ) => 'grey',
				),
				"description" => esc_html__( "Select link color", 'crocal' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Link Hover Color", 'crocal' ),
				"param_name" => "rc_link_hover_color",
				"param_holder_class" => "eut-colored-dropdown",
				"value" => array(
					esc_html__( "Default", 'crocal' ) => '',
					esc_html__( "Dark", 'crocal' ) => 'dark',
					esc_html__( "Light", 'crocal' ) => 'light',
					esc_html__( "Primary 1", 'crocal' ) => 'primary-1',
					esc_html__( "Primary 2", 'crocal' ) => 'primary-2',
					esc_html__( "Primary 3", 'crocal' ) => 'primary-3',
					esc_html__( "Primary 4", 'crocal' ) => 'primary-4',
					esc_html__( "Primary 5", 'crocal' ) => 'primary-5',
					esc_html__( "Primary 6", 'crocal' ) => 'primary-6',
					esc_html__( "Green", 'crocal' ) => 'green',
					esc_html__( "Orange", 'crocal' ) => 'orange',
					esc_html__( "Red", 'crocal' ) => 'red',
					esc_html__( "Blue", 'crocal' ) => 'blue',
					esc_html__( "Aqua", 'crocal' ) => 'aqua',
					esc_html__( "Purple", 'crocal' ) => 'purple',
					esc_html__( "Grey", 'crocal' ) => 'grey',
				),
				"description" => esc_html__( "Select link hover color", 'crocal' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group' => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => 'dropdown',
				"heading" => esc_html__( "Background Type", 'crocal' ),
				"param_name" => "rc_bg_type",
				"description" => esc_html__( "Select Background type", 'crocal' ),
				"value" => array(
					esc_html__( "None", 'crocal' ) => '',
					esc_html__( "Color", 'crocal' ) => 'color',
					esc_html__( "Gradient Color", 'crocal' ) => 'gradient',
					esc_html__( "Image", 'crocal' ) => 'image',
					esc_html__( "Hosted Video", 'crocal' ) => 'hosted_video',
					esc_html__( "YouTube/Vimeo Video", 'crocal' ) => 'video',
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'YouTube/Vimeo link', 'crocal' ),
				'param_name' => 'rc_bg_video_url',
				'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
				// default video url
				'description' => esc_html__( 'Add YouTube/Vimeo link.', 'crocal' ),
				'dependency' => array(
					'element' => 'rc_bg_type',
					'value' => 'video',
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Video Popup Button", 'crocal' ),
				"param_name" => "rc_bg_video_button",
				"value" => array(
					esc_html__( 'None', 'crocal' ) => '',
					esc_html__( 'Devices only', 'crocal' ) => 'device',
					esc_html__( 'Always visible', 'crocal' ) => 'all',
				),
				"description" => esc_html__( "Select video popup button behavior", 'crocal' ),
				'dependency' => array(
					'element' => 'rc_bg_type',
					'value' => 'video',
				),
				"std" => 'center-center',
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Video Button Position", 'crocal' ),
				"param_name" => "rc_bg_video_button_position",
				"value" => array(
					esc_html__( 'Left Top', 'crocal' ) => 'left-top',
					esc_html__( 'Left Bottom', 'crocal' ) => 'left-bottom',
					esc_html__( 'Center Center', 'crocal' ) => 'center-center',
					esc_html__( 'Right Top', 'crocal' ) => 'right-top',
					esc_html__( 'Right Bottom', 'crocal' ) => 'right-bottom',
				),
				"description" => esc_html__( "Select position for video popup", 'crocal' ),
				'dependency' => array(
					'element' => 'rc_bg_video_button',
					'value_not_equal_to' => array( '' )
				),
				"std" => 'center-center',
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Custom Background Color", 'crocal' ),
				"param_name" => "rc_bg_color",
				"description" => esc_html__( "Select background color for your row", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'color', 'image', 'hosted_video', 'video' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Custom Color 1", 'crocal' ),
				"param_name" => "rc_bg_gradient_color_1",
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'gradient' )
				),
				"std" => 'rgba(3,78,144,0.9)',
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Custom Color 2", 'crocal' ),
				"param_name" => "rc_bg_gradient_color_2",
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'gradient' )
				),
				"std" => 'rgba(25,180,215,0.9)',
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Gradient Direction", 'crocal' ),
				"param_name" => "rc_bg_gradient_direction",
				"value" => array(
					esc_html__( "Left to Right", 'crocal' ) => '90',
					esc_html__( "Left Top to Right Bottom", 'crocal' ) => '135',
					esc_html__( "Left Bottom to Right Top", 'crocal' ) => '45',
					esc_html__( "Top to Bottom", 'crocal' ) => '180',
				),
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'gradient' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "attach_image",
				"heading" => esc_html__('Background Image', 'crocal' ),
				"param_name" => "rc_bg_image",
				"value" => '',
				"description" => esc_html__("Select background image for your row. Used also as fallback for video.", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'image', 'hosted_video', 'video' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Background Image Type", 'crocal' ),
				"param_name" => "rc_bg_image_type",
				"value" => array(
					esc_html__( "Default", 'crocal' ) => '',
					esc_html__( "Parallax", 'crocal' ) => 'parallax',
					esc_html__( "Horizontal Parallax Left to Right", 'crocal' ) => 'horizontal-parallax-lr',
					esc_html__( "Horizontal Parallax Right to Left", 'crocal' ) => 'horizontal-parallax-rl',
					esc_html__( "Animated", 'crocal' ) => 'animated',
					esc_html__( "Horizontal Animation", 'crocal' ) => 'horizontal',
					esc_html__( "Fixed Image", 'crocal' ) => 'fixed',
					esc_html__( "Image usage as Pattern", 'crocal' ) => 'pattern'
				),
				"description" => esc_html__( "Select how a background image will be displayed", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'image' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Background Image Size", 'crocal' ),
				"param_name" => "rc_bg_image_size",
				"value" => array(
					esc_html__( "--Inherit--", 'crocal' ) => '',
					esc_html__( "Responsive", 'crocal' ) => 'responsive',
					esc_html__( "Extra Extra Large", 'crocal' ) => 'extra-extra-large',
					esc_html__( "Full", 'crocal' ) => 'full',
				),
				"description" => esc_html__( "Select the size of your background image", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'image' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Background Image Vertical Position", 'crocal' ),
				"param_name" => "rc_bg_image_vertical_position",
				"value" => array(
					esc_html__( "Top", 'crocal' ) => 'top',
					esc_html__( "Center", 'crocal' ) => 'center',
					esc_html__( "Bottom", 'crocal' ) => 'bottom',
				),
				"description" => esc_html__( "Select vertical position for background image", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_image_type',
					'value' => array( 'horizontal-parallax-lr', 'horizontal-parallax-rl', 'horizontal' )
				),
				"std" => 'center',
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Background  Position", 'crocal' ),
				"param_name" => "rc_bg_position",
				"value" => array(
					esc_html__( 'Left Top', 'crocal' ) => 'left-top',
					esc_html__( 'Left Center', 'crocal' ) => 'left-center',
					esc_html__( 'Left Bottom', 'crocal' ) => 'left-bottom',
					esc_html__( 'Center Top', 'crocal' ) => 'center-top',
					esc_html__( 'Center Center', 'crocal' ) => 'center-center',
					esc_html__( 'Center Bottom', 'crocal' ) => 'center-bottom',
					esc_html__( 'Right Top', 'crocal' ) => 'right-top',
					esc_html__( 'Right Center', 'crocal' ) => 'right-center',
					esc_html__( 'Right Bottom', 'crocal' ) => 'right-bottom',
				),
				"description" => esc_html__( "Select position for background image", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_image_type',
					'value' => array( '', 'animated' )
				),
				"std" => 'center-center',
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Background Position ( Tablet Portrait )", 'crocal' ),
				"param_name" => "rc_bg_tablet_sm_position",
				"value" => array(
					esc_html__( 'Inherit from above', 'crocal' ) => '',
					esc_html__( 'Left Top', 'crocal' ) => 'left-top',
					esc_html__( 'Left Center', 'crocal' ) => 'left-center',
					esc_html__( 'Left Bottom', 'crocal' ) => 'left-bottom',
					esc_html__( 'Center Top', 'crocal' ) => 'center-top',
					esc_html__( 'Center Center', 'crocal' ) => 'center-center',
					esc_html__( 'Center Bottom', 'crocal' ) => 'center-bottom',
					esc_html__( 'Right Top', 'crocal' ) => 'right-top',
					esc_html__( 'Right Center', 'crocal' ) => 'right-center',
					esc_html__( 'Right Bottom', 'crocal' ) => 'right-bottom',
				),
				"description" => esc_html__( "Tablet devices with portrait orientation and below.", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_image_type',
					'value' => array( '', 'animated' )
				),
				"std" => '',
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Parallax Sensor", 'crocal' ),
				"param_name" => "rc_bg_parallax_threshold",
				"value" => array(
					esc_html__( "Low", 'crocal' ) => '0.1',
					esc_html__( "Normal", 'crocal' ) => '0.3',
					esc_html__( "High", 'crocal' ) => '0.5',
					esc_html__( "Max", 'crocal' ) => '0.8',
				),
				"description" => esc_html__( "Define the appearance for the parallax effect. Note that you get greater image zoom when you increase the parallax sensor.", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_image_type',
					'value' => array( 'parallax', 'horizontal-parallax-lr', 'horizontal-parallax-rl' )
				),
				"std" => '0.3',
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "textfield",
				"heading" => esc_html__("WebM File URL", 'crocal'),
				"param_name" => "rc_bg_video_webm",
				"description" => esc_html__( "Fill WebM and mp4 format for browser compatibility", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'hosted_video' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "textfield",
				"heading" => esc_html__( "MP4 File URL", 'crocal' ),
				"param_name" => "rc_bg_video_mp4",
				"description" => esc_html__( "Fill mp4 format URL", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'hosted_video' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "textfield",
				"heading" => esc_html__( "OGV File URL", 'crocal' ),
				"param_name" => "rc_bg_video_ogv",
				"description" => esc_html__( "Fill OGV format URL ( optional )", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'hosted_video' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Loop", 'crocal' ),
				"param_name" => "rc_bg_video_loop",
				"value" => array(
					esc_html__( "Yes", 'crocal' ) => 'yes',
					esc_html__( "No", 'crocal' ) => 'no',
				),
				"std" => 'yes',
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'hosted_video' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Allow on devices", 'crocal' ),
				"param_name" => "rc_bg_video_device",
				"value" => array(
					esc_html__( "No", 'crocal' ) => 'no',
					esc_html__( "Yes", 'crocal' ) => 'yes',

				),
				"std" => 'no',
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'hosted_video' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => 'checkbox',
				"heading" => esc_html__( "Pattern overlay", 'crocal'),
				"param_name" => "rc_bg_pattern_overlay",
				"description" => esc_html__( "If selected, a pattern will be added.", 'crocal' ),
				"value" => Array(esc_html__( "Add pattern", 'crocal' ) => 'yes'),
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'image', 'hosted_video', 'video' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Color overlay", 'crocal' ),
				"param_name" => "rc_bg_color_overlay",
				"param_holder_class" => "eut-colored-dropdown",
				"value" => array(
					esc_html__( "None", 'crocal' ) => '',
					esc_html__( "Dark", 'crocal' ) => 'dark',
					esc_html__( "Light", 'crocal' ) => 'light',
					esc_html__( "Primary 1", 'crocal' ) => 'primary-1',
					esc_html__( "Primary 2", 'crocal' ) => 'primary-2',
					esc_html__( "Primary 3", 'crocal' ) => 'primary-3',
					esc_html__( "Primary 4", 'crocal' ) => 'primary-4',
					esc_html__( "Primary 5", 'crocal' ) => 'primary-5',
					esc_html__( "Primary 6", 'crocal' ) => 'primary-6',
					esc_html__( "Custom", 'crocal' ) => 'custom',
					esc_html__( "Gradient", 'crocal' ) => 'gradient',
				),
				"dependency" => array(
					'element' => 'rc_bg_type',
					'value' => array( 'image', 'hosted_video', 'video' )
				),
				"description" => esc_html__( "A color overlay for the media", 'crocal' ),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "colorpicker",
				"heading" => esc_html__('Custom Color Overlay', 'crocal' ),
				"param_name" => "rc_bg_color_overlay_custom",
				"dependency" => array(
					'element' => 'rc_bg_color_overlay',
					'value' => array( 'custom' )
				),
				"std" => 'rgba(255,255,255,0.1)',
				"description" => esc_html__("Select custom color overlay", 'crocal' ),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "colorpicker",
				"heading" => esc_html__('Gradient Color Overlay 1', 'crocal' ),
				"param_name" => "rc_bg_gradient_overlay_custom_1",
				"dependency" => array(
					'element' => 'rc_bg_color_overlay',
					'value' => array( 'gradient' )
				),
				"std" => 'rgba(3,78,144,0.9)',
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "colorpicker",
				"heading" => esc_html__('Gradient Color Overlay 2', 'crocal' ),
				"param_name" => "rc_bg_gradient_overlay_custom_2",
				"dependency" => array(
					'element' => 'rc_bg_color_overlay',
					'value' => array( 'gradient' )
				),
				"std" => 'rgba(25,180,215,0.9)',
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Gradient Direction", 'crocal' ),
				"param_name" => "rc_bg_gradient_overlay_direction",
				"value" => array(
					esc_html__( "Left to Right", 'crocal' ) => '90',
					esc_html__( "Left Top to Right Bottom", 'crocal' ) => '135',
					esc_html__( "Left Bottom to Right Top", 'crocal' ) => '45',
					esc_html__( "Bottom to Top", 'crocal' ) => '180',
				),
				"dependency" => array(
					'element' => 'rc_bg_color_overlay',
					'value' => array( 'gradient' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Opacity overlay", 'crocal' ),
				"param_name" => "rc_bg_opacity_overlay",
				"value" => array( '10', '20', '30' ,'40', '50', '60', '70', '80' ,'90' ),
				"std" => '10',
				"description" => esc_html__( "Opacity of the overlay", 'crocal' ),
				"dependency" => array(
					'element' => 'rc_bg_color_overlay',
					'value' => array( 'dark', 'light', 'primary-1', 'primary-2', 'primary-3', 'primary-4', 'primary-5', 'primary-6' )
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);
		vc_add_param( $tag,
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Add Shadow", 'crocal' ),
				"param_name" => "rc_add_shadow",
				"value" => array(
					esc_html__( "No", 'crocal' ) => 'no',
					esc_html__( "Small Shadow", 'crocal' ) => 'small-shadow',
					esc_html__( "Medium Shadow", 'crocal' ) => 'medium-shadow',
					esc_html__( "Large Shadow", 'crocal' ) => 'large-shadow',
				),
				"group" => esc_html__( "Style", 'crocal' ),
			)
		);

	}


	vc_add_param('vc_tta_tabs', crocal_eutf_get_heading_tag('h3') );
	vc_add_param('vc_tta_tabs', crocal_eutf_get_heading('h6') );
	vc_add_param('vc_tta_tabs', crocal_eutf_get_custom_font_family() );
	vc_add_param('vc_tta_tour', crocal_eutf_get_heading_tag('h3') );
	vc_add_param('vc_tta_tour', crocal_eutf_get_heading('h6') );
	vc_add_param('vc_tta_tour', crocal_eutf_get_custom_font_family() );
	vc_add_param('vc_tta_accordion', crocal_eutf_get_heading_tag('h3') );
	vc_add_param('vc_tta_accordion', crocal_eutf_get_heading('h6') );
	vc_add_param('vc_tta_accordion', crocal_eutf_get_custom_font_family() );
	
	vc_add_param('vc_tta_tabs',
		array(
			"type" => 'dropdown',
			"heading" => esc_html__( "Links Go To Top", "crocal" ),
			"param_name" => "links_gototop",
			"value" => array(
				esc_html__( "No", "crocal" ) => 'no',
				esc_html__( "Yes", "crocal" ) => 'yes',
			),
			"std" => "no",
			"description" => esc_html__( "Animate to the top of the links after clicking", "crocal" ),
			"group" => esc_html__( "Extras", "crocal" ),
		)
	);
	
	vc_add_param('vc_tta_tour',
		array(
			"type" => 'dropdown',
			"heading" => esc_html__( "Links Go To Top", "crocal" ),
			"param_name" => "links_gototop",
			"value" => array(
				esc_html__( "No", "crocal" ) => 'no',
				esc_html__( "Yes", "crocal" ) => 'yes',
			),
			"std" => "no",
			"description" => esc_html__( "Animate to the top of the links after clicking", "crocal" ),
			"group" => esc_html__( "Extras", "crocal" ),
		)
	);
	
	vc_add_param('vc_tta_accordion',
		array(
			"type" => 'dropdown',
			"heading" => esc_html__( "Links Go To Top", "crocal" ),
			"param_name" => "links_gototop",
			"value" => array(
				esc_html__( "No", "crocal" ) => 'no',
				esc_html__( "Yes", "crocal" ) => 'yes',
			),
			"std" => "no",
			"description" => esc_html__( "Animate to the top of the links after clicking", "crocal" ),
			"group" => esc_html__( "Extras", "crocal" ),
		)
	);	

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Row Type", 'crocal' ),
			"param_name" => "section_type",
			"value" => array(
				esc_html__( "Full Width Background", 'crocal' ) => 'fullwidth-background',
				esc_html__( "Full Width Content", 'crocal' ) => 'fullwidth',
				esc_html__( "Container Width", 'crocal' ) => 'container-width',
			),
			"description" => esc_html__( "Select row type", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Row Height", 'crocal' ),
			"param_name" => "height_ratio",
			"value" => array(
				esc_html__( "Auto", 'crocal' ) => 'auto',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "100%", 'crocal' ) => '100',
			),
			"description" => esc_html__( "Select your row height", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Row Min Height", 'crocal' ),
			"param_name" => "min_height",
			"description" => esc_html__( "Set the row minimum height in pixel.", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Top padding", 'crocal' ),
			"param_name" => "padding_top_multiplier",
			"value" => array(
				esc_html__( "None", 'crocal' ) => '',
				esc_html__( "1x", 'crocal' ) => '1x',
				esc_html__( "2x", 'crocal' ) => '2x',
				esc_html__( "3x", 'crocal' ) => '3x',
				esc_html__( "4x", 'crocal' ) => '4x',
				esc_html__( "5x", 'crocal' ) => '5x',
				esc_html__( "6x", 'crocal' ) => '6x',
				esc_html__( "Custom", 'crocal' ) => 'custom',
			),
			"std" => '1x',
			"description" => esc_html__( "Select padding top for your section.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Custom Top padding", 'crocal' ),
			"param_name" => "padding_top",
			"dependency" => array(
				'element' => 'padding_top_multiplier',
				'value' => array( 'custom' )
			),
			"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Bottom padding", 'crocal' ),
			"param_name" => "padding_bottom_multiplier",
			"value" => array(
				esc_html__( "None", 'crocal' ) => '',
				esc_html__( "1x", 'crocal' ) => '1x',
				esc_html__( "2x", 'crocal' ) => '2x',
				esc_html__( "3x", 'crocal' ) => '3x',
				esc_html__( "4x", 'crocal' ) => '4x',
				esc_html__( "5x", 'crocal' ) => '5x',
				esc_html__( "6x", 'crocal' ) => '6x',
				esc_html__( "Custom", 'crocal' ) => 'custom',
			),
			"std" => '1x',
			"description" => esc_html__( "Select padding bottom for your section.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Custom Bottom padding", 'crocal' ),
			"param_name" => "padding_bottom",
			"dependency" => array(
				'element' => 'padding_bottom_multiplier',
				'value' => array( 'custom' )
			),
			"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
		"type" => "textfield",
		"heading" => esc_html__( 'Bottom margin', 'crocal' ),
		"param_name" => "rc_margin_bottom",
		"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",	
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Disable row', 'crocal' ),
			'param_name' => 'disable_element',
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'crocal' ),
			'value' => array( esc_html__( 'Yes', 'crocal' ) => 'yes' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__('Section ID', 'crocal' ),
			"param_name" => "section_id",
			"description" => esc_html__("If you wish you can type an id to use it as bookmark.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row", $crocal_eutf_add_el_class );
	vc_add_param( "vc_row", $crocal_eutf_add_el_wrapper_class );

	crocal_eutf_rc_style_params( "vc_row" );
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "On Scroll Effect", 'crocal' ),
			"param_name" => "rc_bg_image_scroll_effect",
			"value" => array(
				esc_html__( "None", 'crocal' ) => '',
				esc_html__( "Hide/Show Background on Scroll", 'crocal' ) => 'opacity-scroll-effect',
			),
			"description" => esc_html__( "Select how the row background will be displayed on scroll", 'crocal' ),
			"dependency" => array(
				'element' => 'rc_bg_type',
				'value' => array( 'image', 'hosted_video', 'video' )
			),
			"group" => esc_html__( "Style", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Initial Opacity", 'crocal' ),
			"param_name" => "rc_bg_image_initial_opacity",
			'edit_field_class' => 'vc_col-sm-6',
			"value" => array(
				esc_html__( "100%", 'crocal' ) => '100',
				esc_html__( "95%", 'crocal' ) => '95',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "85%", 'crocal' ) => '85',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "75%", 'crocal' ) => '75',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "65%", 'crocal' ) => '65',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "55%", 'crocal' ) => '55',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "45%", 'crocal' ) => '45',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "35%", 'crocal' ) => '35',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "25%", 'crocal' ) => '25',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "15%", 'crocal' ) => '15',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "0", 'crocal' ) => '0',
			),
			"description" => esc_html__( "Define the opacity background at first", 'crocal' ),
			"dependency" => array(
				'element' => 'rc_bg_image_scroll_effect',
				'value' => array( 'opacity-scroll-effect' )
			),
			"std" => '100',
			"group" => esc_html__( "Style", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Final Opacity", 'crocal' ),
			"param_name" => "rc_bg_image_final_opacity",
			'edit_field_class' => 'vc_col-sm-6',
			"value" => array(
				esc_html__( "100%", 'crocal' ) => '100',
				esc_html__( "95%", 'crocal' ) => '95',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "85%", 'crocal' ) => '85',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "75%", 'crocal' ) => '75',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "65%", 'crocal' ) => '65',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "55%", 'crocal' ) => '55',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "45%", 'crocal' ) => '45',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "35%", 'crocal' ) => '35',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "25%", 'crocal' ) => '25',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "15%", 'crocal' ) => '15',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "0", 'crocal' ) => '0',
			),
			"description" => esc_html__( "Define the opacity background at last", 'crocal' ),
			"dependency" => array(
				'element' => 'rc_bg_image_scroll_effect',
				'value' => array( 'opacity-scroll-effect' )
			),
			"std" => '0',
			"group" => esc_html__( "Style", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Scroll Effect Offset", 'crocal' ),
			"param_name" => "rc_bg_image_scroll_effect_offset",
			"value" => array(
				esc_html__( "100%", 'crocal' ) => '100',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "10%", 'crocal' ) => '10',
			),
			"description" => esc_html__( "Define the offset for the scroll effect.", 'crocal' ),
			"dependency" => array(
				'element' => 'rc_bg_image_scroll_effect',
				'value' => array( 'opacity-scroll-effect' )
			),
			"std" => '50',
			"group" => esc_html__( "Style", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Columns Gap", 'crocal' ),
			"param_name" => "columns_gap",
			'value' => $crocal_eutf_column_gap_list,
			"description" => esc_html__( "Select gap between columns in row.", 'crocal' ),
			"group" => esc_html__( "Inner Columns", 'crocal' ),
			"std" => 'default',
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Equal Column Height", 'crocal' ),
			"param_name" => "equal_column_height",
			"description" => esc_html__( "Select if you need the same height for the columns of this row. Recommended for multiple columns with different background colors.", 'crocal' ),
			"value" => Array(esc_html__( "Equal Height Columns", 'crocal' ) => 'equal'),
			"group" => esc_html__( "Inner Columns", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Reverse columns in RTL', 'crocal' ),
			'param_name' => 'rtl_reverse',
			'description' => esc_html__( 'If checked columns will be reversed in RTL.', 'crocal' ),
			'value' => array( esc_html__( 'Yes', 'crocal' ) => 'yes' ),
			"group" => esc_html__( "Inner Columns", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Visibility", 'crocal'),
			"param_name" => "label_visibility",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "If selected, row will be hidden on desktops/laptops and devices.", 'crocal' ),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);


	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Desktop Visibility", 'crocal'),
			"param_name" => "desktop_visibility",
			"value" => Array(esc_html__( "Hide", 'crocal' ) => 'hide'),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Tablet Landscape Visibility", 'crocal'),
			"param_name" => "tablet_visibility",
			"value" => Array(esc_html__( "Hide", 'crocal' ) => 'hide'),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Tablet Portrait Visibility", 'crocal'),
			"param_name" => "tablet_sm_visibility",
			"value" => Array(esc_html__( "Hide", 'crocal' ) => 'hide'),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Mobile Visibility", 'crocal'),
			"param_name" => "mobile_visibility",
			"value" => Array(esc_html__( "Hide", 'crocal' ) => 'hide'),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Columns Vertical Gap", 'crocal'),
			"param_name" => "label_columns_vertical_gap",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Select the vertical gap for the columns of this row on Tablets (Landscape, Portrait) and mobiles. This will affect once the columns have 100% width ( 1/1 ).", 'crocal' ),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => __( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_columns_vertical_gap",
			'value' => $crocal_eutf_column_gap_list,
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			"std" => 'none',
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => __( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_sm_columns_vertical_gap",
			'value' => $crocal_eutf_column_gap_list,
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			"std" => 'none',
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => __( "Mobile", 'crocal' ),
			"param_name" => "mobile_columns_vertical_gap",
			'value' => $crocal_eutf_column_gap_list,
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			"std" => '30',
			'edit_field_class' => 'vc_col-sm-4',
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Equal Column Height", 'crocal'),
			"param_name" => "label_equal_column_height",
			"description" => esc_html__( "Select if you wish to keep or disable the Equal Column Height.", 'crocal' ),
			'value' => '',
			'std' => '',
			"dependency" => array(
				'element' => 'equal_column_height',
				'value' => array( 'equal' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_landscape_equal_column_height",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "None", 'crocal' ) => 'false',
			),
			"dependency" => array(
				'element' => 'equal_column_height',
				'value' => array( 'equal' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_portrait_equal_column_height",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "None", 'crocal' ) => 'false',
			),
			"dependency" => array(
				'element' => 'equal_column_height',
				'value' => array( 'equal' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Row Height", 'crocal'),
			"param_name" => "label_height_ratio",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Select if you wish to keep or disable the Row height.", 'crocal' ),
			"dependency" => array(
				'element' => 'height_ratio',
				'value_not_equal_to' => array( 'auto' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_height_ratio",
			"value" => array(
				esc_html__( "Inherit", 'crocal' ) => 'inherit',
				esc_html__( "Auto", 'crocal' ) => '0',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "100%", 'crocal' ) => '100',
			),
			"dependency" => array(
				'element' => 'height_ratio',
				'value_not_equal_to' => array( 'auto' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_sm_height_ratio",
			"value" => array(
				esc_html__( "Inherit", 'crocal' ) => 'inherit',
				esc_html__( "Auto", 'crocal' ) => '0',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "100%", 'crocal' ) => '100',
			),
			"dependency" => array(
				'element' => 'height_ratio',
				'value_not_equal_to' => array( 'auto' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'std' => '0',
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_height_ratio",
			"value" => array(
				esc_html__( "Inherit", 'crocal' ) => 'inherit',
				esc_html__( "Auto", 'crocal' ) => '0',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "100%", 'crocal' ) => '100',
			),
			"dependency" => array(
				'element' => 'height_ratio',
				'value_not_equal_to' => array( 'auto' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'std' => '0',
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'dropdown',
			"heading" => esc_html__( "Top Separator", 'crocal' ),
			"param_name" => "separator_top",
			"description" => esc_html__( "Select Top Separator type", 'crocal' ),
			"value" => $crocal_eutf_separator_list,
			"group" => esc_html__( "Separators", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'dropdown',
			"heading" => esc_html__( "Top Separator Size", 'crocal' ),
			"param_name" => "separator_top_size",
			"description" => esc_html__( "Select Top Separator type", 'crocal' ),
			"value" => $crocal_eutf_separator_size_list,
			"std" => '90px',
			"dependency" => array(
				'element' => 'separator_top',
				'value_not_equal_to' => array( '' )
			),
			"group" => esc_html__( "Separators", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "colorpicker",
			"heading" => esc_html__('Top Separator Color', 'crocal' ),
			"param_name" => "separator_top_color",
			"dependency" => array(
				'element' => 'separator_top',
				'value_not_equal_to' => array( '' )
			),
			"std" => '#ffffff',
			"description" => esc_html__("Select top separator color", 'crocal' ),
			"group" => esc_html__( "Separators", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'dropdown',
			"heading" => esc_html__( "Bottom Separator", 'crocal' ),
			"param_name" => "separator_bottom",
			"description" => esc_html__( "Select Bottom Separator type", 'crocal' ),
			"value" => $crocal_eutf_separator_list,
			"group" => esc_html__( "Separators", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'dropdown',
			"heading" => esc_html__( "Bottom Separator Size", 'crocal' ),
			"param_name" => "separator_bottom_size",
			"description" => esc_html__( "Select Bottom Separator type", 'crocal' ),
			"value" => $crocal_eutf_separator_size_list,
			"std" => '90px',
			"dependency" => array(
				'element' => 'separator_bottom',
				'value_not_equal_to' => array( '' )
			),
			"group" => esc_html__( "Separators", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "colorpicker",
			"heading" => esc_html__('Bottom Separator Color', 'crocal' ),
			"param_name" => "separator_bottom_color",
			"dependency" => array(
				'element' => 'separator_bottom',
				'value_not_equal_to' => array( '' )
			),
			"std" => '#ffffff',
			"description" => esc_html__("Select bottom separator color", 'crocal' ),
			"group" => esc_html__( "Separators", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Header Style", 'crocal' ),
			"param_name" => "scroll_header_style",
			"value" => array(
				esc_html__( "Dark", 'crocal' ) => 'dark',
				esc_html__( "Light", 'crocal' ) => 'light',
				esc_html__( "Default", 'crocal' ) => 'default',
			),
			"std" => 'dark',
			"description" => esc_html__( "Select header style", 'crocal' ),
			"group" => esc_html__( "Scrolling Section Options", 'crocal' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__('Scrolling Section Title', 'crocal' ),
			"param_name" => "scroll_section_title",
			"description" => esc_html__("If you wish you can type a title for the side dot navigation.", 'crocal' ),
			"group" => esc_html__( "Scrolling Section Options", 'crocal' ),
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Row Height", 'crocal' ),
			"param_name" => "height_ratio",
			"value" => array(
				esc_html__( "Auto", 'crocal' ) => 'auto',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "100%", 'crocal' ) => '100',
			),
			"description" => esc_html__( "Select your row height", 'crocal' ),
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Row Min Height", 'crocal' ),
			"param_name" => "min_height",
			"description" => esc_html__( "Set the row minimum height in pixel.", 'crocal' ),
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Top padding", 'crocal' ),
			"param_name" => "padding_top_multiplier",
			"value" => array(
				esc_html__( "None", 'crocal' ) => '',
				esc_html__( "1x", 'crocal' ) => '1x',
				esc_html__( "2x", 'crocal' ) => '2x',
				esc_html__( "3x", 'crocal' ) => '3x',
				esc_html__( "4x", 'crocal' ) => '4x',
				esc_html__( "5x", 'crocal' ) => '5x',
				esc_html__( "6x", 'crocal' ) => '6x',
				esc_html__( "Custom", 'crocal' ) => 'custom',
			),
			"std" => '1x',
			"description" => esc_html__( "Select padding top for your section.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Custom Top padding", 'crocal' ),
			"param_name" => "padding_top",
			"dependency" => array(
				'element' => 'padding_top_multiplier',
				'value' => array( 'custom' )
			),
			"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Bottom padding", 'crocal' ),
			"param_name" => "padding_bottom_multiplier",
			"value" => array(
				esc_html__( "None", 'crocal' ) => '',
				esc_html__( "1x", 'crocal' ) => '1x',
				esc_html__( "2x", 'crocal' ) => '2x',
				esc_html__( "3x", 'crocal' ) => '3x',
				esc_html__( "4x", 'crocal' ) => '4x',
				esc_html__( "5x", 'crocal' ) => '5x',
				esc_html__( "6x", 'crocal' ) => '6x',
				esc_html__( "Custom", 'crocal' ) => 'custom',
			),
			"std" => '1x',
			"description" => esc_html__( "Select padding bottom for your section.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Custom Bottom padding", 'crocal' ),
			"param_name" => "padding_bottom",
			"dependency" => array(
				'element' => 'padding_bottom_multiplier',
				'value' => array( 'custom' )
			),
			"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
		"type" => "textfield",
		"heading" => esc_html__( 'Bottom margin', 'crocal' ),
		"param_name" => "rc_margin_bottom",
		"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",	
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Disable row', 'crocal' ),
			'param_name' => 'disable_element',
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'crocal' ),
			'value' => array( esc_html__( 'Yes', 'crocal' ) => 'yes' ),
		)
	);
	vc_add_param( "vc_row_inner", $crocal_eutf_add_el_id );
	vc_add_param( "vc_row_inner", $crocal_eutf_add_el_class );
	vc_add_param( "vc_row_inner", $crocal_eutf_add_el_wrapper_class );

	crocal_eutf_rc_style_params( "vc_row_inner" );

	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => __( "Columns Gap", 'crocal' ),
			"param_name" => "columns_gap",
			'value' => $crocal_eutf_column_gap_list,
			"description" => __( "Select gap between columns in row.", 'crocal' ),
			"group" => esc_html__( "Inner Columns", 'crocal' ),
			"std" => 'default',
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Equal Column Height", 'crocal' ),
			"param_name" => "equal_column_height",
			"description" => esc_html__( "Select if you need the same height for the columns of this row. Recommended for multiple columns with different background colors.", 'crocal' ),
			"value" => Array(esc_html__( "Equal Height Columns", 'crocal' ) => 'equal'),
			"group" => esc_html__( "Inner Columns", 'crocal' ),
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Reverse columns in RTL', 'crocal' ),
			'param_name' => 'rtl_reverse',
			'description' => esc_html__( 'If checked columns will be reversed in RTL.', 'crocal' ),
			'value' => array( esc_html__( 'Yes', 'crocal' ) => 'yes' ),
			"group" => esc_html__( "Inner Columns", 'crocal' ),
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Visibility", 'crocal'),
			"param_name" => "label_visibility",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "If selected, row will be hidden on desktops/laptops and devices.", 'crocal' ),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Desktop Visibility", 'crocal'),
			"param_name" => "desktop_visibility",
			"value" => Array(esc_html__( "Hide", 'crocal' ) => 'hide'),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Tablet Landscape Visibility", 'crocal'),
			"param_name" => "tablet_visibility",
			"value" => Array(esc_html__( "Hide", 'crocal' ) => 'hide'),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Tablet Portrait Visibility", 'crocal'),
			"param_name" => "tablet_sm_visibility",
			"value" => Array(esc_html__( "Hide", 'crocal' ) => 'hide'),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Mobile Visibility", 'crocal'),
			"param_name" => "mobile_visibility",
			"value" => Array(esc_html__( "Hide", 'crocal' ) => 'hide'),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Columns Vertical Gap", 'crocal'),
			"param_name" => "label_columns_vertical_gap",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Select the vertical gap for the columns of this row on Tablets (Landscape, Portrait) and mobiles. This will affect once the columns have 100% width ( 1/1 ).", 'crocal' ),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => __( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_columns_vertical_gap",
			'value' => $crocal_eutf_column_gap_list,
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			"std" => 'none',
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => __( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_sm_columns_vertical_gap",
			'value' => $crocal_eutf_column_gap_list,
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			"std" => 'none',
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => __( "Mobile", 'crocal' ),
			"param_name" => "mobile_columns_vertical_gap",
			'value' => $crocal_eutf_column_gap_list,
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			"std" => '30',
			'edit_field_class' => 'vc_col-sm-4',
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Equal Column Height", 'crocal'),
			"param_name" => "label_equal_column_height",
			"description" => esc_html__( "Select if you wish to keep or disable the Equal Column Height.", 'crocal' ),
			'value' => '',
			'std' => '',
			"dependency" => array(
				'element' => 'equal_column_height',
				'value' => array( 'equal' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_landscape_equal_column_height",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "None", 'crocal' ) => 'false',
			),
			"dependency" => array(
				'element' => 'equal_column_height',
				'value' => array( 'equal' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_portrait_equal_column_height",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "None", 'crocal' ) => 'false',
			),
			"dependency" => array(
				'element' => 'equal_column_height',
				'value' => array( 'equal' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);
	vc_add_param( "vc_row_inner",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Row Height", 'crocal'),
			"param_name" => "label_height_ratio",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Select if you wish to keep or disable the Row height.", 'crocal' ),
			"dependency" => array(
				'element' => 'height_ratio',
				'value_not_equal_to' => array( 'auto' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_height_ratio",
			"value" => array(
				esc_html__( "Inherit", 'crocal' ) => 'inherit',
				esc_html__( "Auto", 'crocal' ) => '0',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "100%", 'crocal' ) => '100',
			),
			"dependency" => array(
				'element' => 'height_ratio',
				'value_not_equal_to' => array( 'auto' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_sm_height_ratio",
			"value" => array(
				esc_html__( "Inherit", 'crocal' ) => 'inherit',
				esc_html__( "Auto", 'crocal' ) => '0',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "100%", 'crocal' ) => '100',
			),
			"dependency" => array(
				'element' => 'height_ratio',
				'value_not_equal_to' => array( 'auto' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'std' => '0',
		)
	);

	vc_add_param( "vc_row_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_height_ratio",
			"value" => array(
				esc_html__( "Inherit", 'crocal' ) => 'inherit',
				esc_html__( "Auto", 'crocal' ) => '0',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "100%", 'crocal' ) => '100',
			),
			"dependency" => array(
				'element' => 'height_ratio',
				'value_not_equal_to' => array( 'auto' )
			),
			'group' => esc_html__( "Responsiveness", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'std' => '0',
		)
	);

	vc_add_param( "vc_column",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Column Width", 'crocal' ),
			'param_name' => 'width',
			'value' => $crocal_eutf_column_width_list,
			'description' => esc_html__( "Select column width.", 'crocal' ),
			'std' => '1/1',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Content Width", 'crocal' ),
			"param_name" => "content_width",
			"value" => array(
				esc_html__( "5%", 'crocal' ) => '5',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "15%", 'crocal' ) => '15',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "25%", 'crocal' ) => '25',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "35%", 'crocal' ) => '35',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "45%", 'crocal' ) => '45',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "55%", 'crocal' ) => '55',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "65%", 'crocal' ) => '65',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "75%", 'crocal' ) => '75',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "85%", 'crocal' ) => '85',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "95%", 'crocal' ) => '95',
				esc_html__( "100%", 'crocal' ) => '100',
				esc_html__( "Custom", 'crocal' ) => 'custom',
			),
			"description" => esc_html__( "Select the content width.", 'crocal' ),
			'std' => '100',
		)
	);
	vc_add_param( "vc_column",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Custom Content Width", 'crocal' ),
			"param_name" => "custom_content_width",
			"dependency" => array(
				'element' => 'content_width',
				'value' => array( 'custom' )
			),
			"description" => esc_html__( "You can use px, em, vh, vw, %, etc. or enter just number and it will use pixels.", 'crocal' ),
		)
	);	

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Horizontal Content Position", 'crocal' ),
			"param_name" => "horizontal_content_position",
			"value" => array(
				esc_html__( "Left", 'crocal' ) => 'left',
				esc_html__( "Center", 'crocal' ) => 'center',
				esc_html__( "Right", 'crocal' ) => 'right',
			),
			"dependency" => array(
				'element' => 'content_width',
				'value_not_equal_to' => array( '100' )
			),
			"description" => esc_html__( "Select the horizontal position of the content.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Vertical Content Position", 'crocal' ),
			"param_name" => "vertical_content_position",
			"value" => array(
				esc_html__( "Top", 'crocal' ) => 'top',
				esc_html__( "Middle", 'crocal' ) => 'middle',
				esc_html__( "Bottom", 'crocal' ) => 'bottom',
			),
			"description" => esc_html__( "Select the vertical position of the content.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Column 100% Height", 'crocal' ),
			"description" => esc_html__( "Select if you need this column to have 100% height of the parent row.", 'crocal' ),
			"param_name" => "full_height",
			"value" => array(
				esc_html__( "No", 'crocal' ) => 'no',
				esc_html__( "Yes", 'crocal' ) => 'yes',
			),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Text Align", 'crocal' ),
			"param_name" => "text_align",
			"value" => array(
				esc_html__( "Left", 'crocal' ) => 'left',
				esc_html__( "Center", 'crocal' ) => 'center',
				esc_html__( "Right", 'crocal' ) => 'right',
			),
			"description" => esc_html__( "Select the text align of the content.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column", $crocal_eutf_add_el_id );
	vc_add_param( "vc_column", $crocal_eutf_add_el_class );
	vc_add_param( "vc_column", $crocal_eutf_add_el_wrapper_class );
	
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Block Content", 'crocal' ),
			"param_name" => "block_content",
			"value" => crocal_eutf_get_privacy_switch_ids(),
			"description" => esc_html__( "Select the blocking content id to block.", 'crocal' ),
		)
	);		

	crocal_eutf_rc_style_params( "vc_column" );
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Expand Column Background", 'crocal' ),
			"param_name" => "expand_column_bg",
			"value" => array(
				esc_html__( "No", 'crocal' ) => '',
				esc_html__( "Expand Left", 'crocal' ) => 'expand-bg-left',
				esc_html__( "Expand Right", 'crocal' ) => 'expand-bg-right',
			),
			"description" => esc_html__( "Select the expand column of the background.", 'crocal' ),
			"dependency" => array(
				'element' => 'rc_bg_type',
				'value' => array( 'color', 'image', 'gradient' )
			),
			"group" => esc_html__( "Style", 'crocal' ),
		)
	);

	vc_add_param( "vc_column", $crocal_eutf_add_column_clipping_animation );
	vc_add_param( "vc_column", $crocal_eutf_add_clipping_animation_colors );
	vc_add_param( "vc_column", $crocal_eutf_add_clipping_animation_delay );

	vc_add_param( "vc_column",
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'crocal' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Sticky Column", 'crocal' ),
			"param_name" => "column_sticky",
			"value" => array(
				esc_html__( "No", 'crocal' ) => 'no',
				esc_html__( "Yes", 'crocal' ) => 'yes',
			),
			"description" => esc_html__( "Activate this to stick the Column when scrolling.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "textfield",
			"heading" => esc_html__( 'Sticky Top Offset', 'crocal' ),
			"param_name" => "column_sticky_offset",
			"description" => esc_html__( "Enter a number in pixel to initial sticking position.", 'crocal' ),
			"dependency" => array(
				'element' => 'column_sticky',
				'value' => array( 'yes' )
			),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Column Effect", 'crocal' ),
			"param_name" => "column_effect",
			"value" => array(
				esc_html__( "None", 'crocal' ) => 'none',
				esc_html__( "Vertical Parallax", 'crocal' ) => 'vertical-parallax',
			),
			"dependency" => array(
				'element' => 'column_sticky',
				'value' => array( 'no' )
			),
			"description" => esc_html__( "Select column effect behaviour. Notice that the Mouse Move Effect does not affect on devices.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Column Effect Total Range", 'crocal' ),
			"param_name" => "column_effect_limit",
			"value" => array(
				esc_html__( "1x", 'crocal' ) => '1x',
				esc_html__( "2x", 'crocal' ) => '2x',
				esc_html__( "3x", 'crocal' ) => '3x',
				esc_html__( "4x", 'crocal' ) => '4x',
				esc_html__( "5x", 'crocal' ) => '5x',
				esc_html__( "6x", 'crocal' ) => '6x',
				esc_html__( "None", 'crocal' ) => 'none',
			),
			"dependency" => array(
				'element' => 'column_effect',
				'value_not_equal_to' => array( 'none' )
			),
			"description" => esc_html__( "Select column effect total range of motion. None allows column to move with complete freedom.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Column Effect Invert Motion", 'crocal' ),
			"param_name" => "column_effect_invert",
			"value" => array(
				esc_html__( "No", 'crocal' ) => 'false',
				esc_html__( "Yes", 'crocal' ) => 'true',
			),
			"dependency" => array(
				'element' => 'column_effect',
				'value_not_equal_to' => array( 'none' )
			),
			"description" => esc_html__( "Select if you want to enable invert motion effect on this column.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Change Column Position", 'crocal' ),
			"param_name" => "column_custom_position",
			"value" => array(
				esc_html__( "No", 'crocal' ) => 'no',
				esc_html__( "Yes", 'crocal' ) => 'yes',
			),
			"dependency" => array(
				'element' => 'column_sticky',
				'value' => array( 'no' )
			),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( 'Top Position', 'crocal' ),
			"param_name" => "position_top",
			"value" => $crocal_eutf_position_list,
			"description" => esc_html__( "Select the top position of the column.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-6',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( 'Bottom Position', 'crocal' ),
			"param_name" => "position_bottom",
			"value" => $crocal_eutf_position_list,
			"description" => esc_html__( "Select the bottom position of the column.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-6',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Left Position", 'crocal' ),
			"param_name" => "position_left",
			"value" => $crocal_eutf_position_list,
			"description" => esc_html__( "Select the left position of the column.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-6',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( 'Right Position', 'crocal' ),
			"param_name" => "position_right",
			"value" => $crocal_eutf_position_list,
			"description" => esc_html__( "Select the right position of the column.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-6',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "textfield",
			"heading" => esc_html__( 'Z index', 'crocal' ),
			"param_name" => "z_index",
			"description" => esc_html__( "Enter a number for column's z-index. Default value is 1, recommended to be larger than this.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Column Width", 'crocal'),
			"param_name" => "label_column_width",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define your column width for desktops/laptops and devices. Width attribute is defined under General tab.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Desktop", 'crocal' ),
			"param_name" => "desktop_hide",
			"value" => $crocal_eutf_column_desktop_hide_list,
			"description" => esc_html__( "Define your column width for Desktop.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_width",
			"value" => $crocal_eutf_column_width_tablet_list,
			"description" => esc_html__( "Define your column width for Tablet Landscape.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_sm_width",
			"value" => $crocal_eutf_column_width_tablet_sm_list,
			"description" => esc_html__( "Define your column width for Tablet Portrait.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_width",
			"value" => $crocal_eutf_column_mobile_width_list,
			"description" => esc_html__( "Define your column width for Mobile.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);


	vc_add_param( "vc_column",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Content Width", 'crocal'),
			"param_name" => "label_content_width",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define your column content width for devices. Default is defined under General > Content Width.", 'crocal' ),
			"dependency" => array(
				'element' => 'content_width',
				'value_not_equal_to' => array( '100' )
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Tablet Landscape", 'crocal' ),
			'param_name' => 'tablet_content_width',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => 'inherit',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'content_width',
				'value_not_equal_to' => array( '100' )
			),
			"description" => esc_html__( "Define your content width for Tablet Landscape.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Tablet Portrait", 'crocal' ),
			'param_name' => 'tablet_sm_content_width',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => 'inherit',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'content_width',
				'value_not_equal_to' => array( '100' )
			),
			"description" => esc_html__( "Define your content width for Tablet Portrait.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Mobile", 'crocal' ),
			'param_name' => 'mobile_content_width',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => 'inherit',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'content_width',
				'value_not_equal_to' => array( '100' )
			),
			"description" => esc_html__( "Define your content width for Mobile.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Column Effect", 'crocal'),
			"param_name" => "label_column_effect",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define your column effect for devices. Default values are defined under Effect & Positions > Column Effect.", 'crocal' ),
			"dependency" => array(
				'element' => 'column_effect',
				'value' => array( 'vertical-parallax' )
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_landscape_column_effect",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Disable Effect", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column effect for Tablet Landscape.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_effect',
				'value' => array( 'vertical-parallax' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_portrait_column_effect",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Disable Effect", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column effect for Tablet Portrait.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_effect',
				'value' => array( 'vertical-parallax' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_column_effect",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Disable Effect", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column effect for Mobile.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_effect',
				'value' => array( 'vertical-parallax' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Column Positions", 'crocal'),
			"param_name" => "label_column_positions",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define your column positions for devices. Default values are defined under Effect & Positions > Change Column Position.", 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_landscape_column_positions",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Reset Positions", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column positions for Tablet Landscape.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_portrait_column_positions",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Reset Positions", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column positions for Tablet Portrait.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_column_positions",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Reset Positions", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column positions for Mobile.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Text Align", 'crocal'),
			"param_name" => "label_text_align",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define your text align for devices. Default values are defined under General > Text Align.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_text_align",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Left", 'crocal' ) => 'left',
				esc_html__( "Center", 'crocal' ) => 'center',
				esc_html__( "Right", 'crocal' ) => 'right',
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Define your text align for Tablet Landscape.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_sm_text_align",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Left", 'crocal' ) => 'left',
				esc_html__( "Center", 'crocal' ) => 'center',
				esc_html__( "Right", 'crocal' ) => 'right',
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Define your text align for Tablet Portrait.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_text_align",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Left", 'crocal' ) => 'left',
				esc_html__( "Center", 'crocal' ) => 'center',
				esc_html__( "Right", 'crocal' ) => 'right',
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Define your text align for Mobile.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Column Order", 'crocal'),
			"param_name" => "label_column_order",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define the column order in which they appear in the grid for devices.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_column_order",
			"value" => $crocal_eutf_column_order_list,
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Define your column order for Tablet Landscape.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_sm_column_order",
			"value" => $crocal_eutf_column_order_list,
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Define your column order for Tablet Portrait.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_column_order",
			"value" => $crocal_eutf_column_order_list,
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Define your column order for Mobile.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Expand Column Background", 'crocal'),
			"param_name" => "label_expand_column_bg",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define the expand column background for devices. Default is defined under Style > Expand Column Background.", 'crocal' ),
			"dependency" => array(
				'element' => 'expand_column_bg',
				'value_not_equal_to' => array( '' )
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Tablet Landscape", 'crocal' ),
			'param_name' => 'tablet_expand_column_bg',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => '',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'expand_column_bg',
				'value_not_equal_to' => array( '' )
			),
			"description" => esc_html__( "Define the expand column for Tablet Landscape.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Tablet Portrait", 'crocal' ),
			'param_name' => 'tablet_sm_expand_column_bg',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => '',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'expand_column_bg',
				'value_not_equal_to' => array( '' )
			),
			"description" => esc_html__( "Define the expand column for Tablet Portrait.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Mobile", 'crocal' ),
			'param_name' => 'mobile_expand_column_bg',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => '',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'expand_column_bg',
				'value_not_equal_to' => array( '' )
			),
			"description" => esc_html__( "Define the expand column for Mobile.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Column Width", 'crocal' ),
			'param_name' => 'width',
			'value' => $crocal_eutf_column_width_list,
			'description' => esc_html__( "Select column width.", 'crocal' ),
			'std' => '1/1',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Content Width", 'crocal' ),
			"param_name" => "content_width",
			"value" => array(
				esc_html__( "5%", 'crocal' ) => '5',
				esc_html__( "10%", 'crocal' ) => '10',
				esc_html__( "15%", 'crocal' ) => '15',
				esc_html__( "20%", 'crocal' ) => '20',
				esc_html__( "25%", 'crocal' ) => '25',
				esc_html__( "30%", 'crocal' ) => '30',
				esc_html__( "35%", 'crocal' ) => '35',
				esc_html__( "40%", 'crocal' ) => '40',
				esc_html__( "45%", 'crocal' ) => '45',
				esc_html__( "50%", 'crocal' ) => '50',
				esc_html__( "55%", 'crocal' ) => '55',
				esc_html__( "60%", 'crocal' ) => '60',
				esc_html__( "65%", 'crocal' ) => '65',
				esc_html__( "70%", 'crocal' ) => '70',
				esc_html__( "75%", 'crocal' ) => '75',
				esc_html__( "80%", 'crocal' ) => '80',
				esc_html__( "85%", 'crocal' ) => '85',
				esc_html__( "90%", 'crocal' ) => '90',
				esc_html__( "95%", 'crocal' ) => '95',
				esc_html__( "100%", 'crocal' ) => '100',
				esc_html__( "Custom", 'crocal' ) => 'custom',
			),
			"description" => esc_html__( "Select the content width.", 'crocal' ),
			'std' => '100',
		)
	);
	vc_add_param( "vc_column_inner",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Custom Content Width", 'crocal' ),
			"param_name" => "custom_content_width",
			"dependency" => array(
				'element' => 'content_width',
				'value' => array( 'custom' )
			),
			"description" => esc_html__( "You can use px, em, vh, vw, %, etc. or enter just number and it will use pixels.", 'crocal' ),
		)
	);		

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Horizontal Content Position", 'crocal' ),
			"param_name" => "horizontal_content_position",
			"value" => array(
				esc_html__( "Left", 'crocal' ) => 'left',
				esc_html__( "Center", 'crocal' ) => 'center',
				esc_html__( "Right", 'crocal' ) => 'right',
			),
			"dependency" => array(
				'element' => 'content_width',
				'value_not_equal_to' => array( '100' )
			),
			"description" => esc_html__( "Select the horizontal position of the content.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Vertical Content Position", 'crocal' ),
			"param_name" => "vertical_content_position",
			"value" => array(
				esc_html__( "Top", 'crocal' ) => 'top',
				esc_html__( "Middle", 'crocal' ) => 'middle',
				esc_html__( "Bottom", 'crocal' ) => 'bottom',
			),
			"description" => esc_html__( "Select the vertical position of the content.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Column 100% Height", 'crocal' ),
			"description" => esc_html__( "Select if you need this column to have 100% height of the parent row.", 'crocal' ),
			"param_name" => "full_height",
			"value" => array(
				esc_html__( "No", 'crocal' ) => 'no',
				esc_html__( "Yes", 'crocal' ) => 'yes',
			),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Text Align", 'crocal' ),
			"param_name" => "text_align",
			"value" => array(
				esc_html__( "Left", 'crocal' ) => 'left',
				esc_html__( "Center", 'crocal' ) => 'center',
				esc_html__( "Right", 'crocal' ) => 'right',
			),
			"description" => esc_html__( "Select the text align of the content.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner", $crocal_eutf_add_el_id );
	vc_add_param( "vc_column_inner", $crocal_eutf_add_el_class );
	vc_add_param( "vc_column_inner", $crocal_eutf_add_el_wrapper_class );
	
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Block Content", 'crocal' ),
			"param_name" => "block_content",
			"value" => crocal_eutf_get_privacy_switch_ids(),
			"description" => esc_html__( "Select the blocking content id to block.", 'crocal' ),
		)
	);		

	crocal_eutf_rc_style_params( "vc_column_inner" );
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Expand Column Background", 'crocal' ),
			"param_name" => "expand_column_bg",
			"value" => array(
				esc_html__( "No", 'crocal' ) => '',
				esc_html__( "Expand Left", 'crocal' ) => 'expand-bg-left',
				esc_html__( "Expand Right", 'crocal' ) => 'expand-bg-right',
			),
			"description" => esc_html__( "Select the expand column of the background.", 'crocal' ),
			"dependency" => array(
				'element' => 'rc_bg_type',
				'value' => array( 'color', 'image', 'gradient' )
			),
			"group" => esc_html__( "Style", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner", $crocal_eutf_add_column_clipping_animation );
	vc_add_param( "vc_column_inner", $crocal_eutf_add_clipping_animation_colors );
	vc_add_param( "vc_column_inner", $crocal_eutf_add_clipping_animation_delay );

	vc_add_param( "vc_column_inner",
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'crocal' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Column Effect", 'crocal' ),
			"param_name" => "column_effect",
			"value" => array(
				esc_html__( "None", 'crocal' ) => 'none',
				esc_html__( "Vertical Parallax", 'crocal' ) => 'vertical-parallax',
			),
			"description" => esc_html__( "Select column effect behaviour. Notice that the Mouse Move Effect does not affect on devices.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Column Effect Total Range", 'crocal' ),
			"param_name" => "column_effect_limit",
			"value" => array(
				esc_html__( "1x", 'crocal' ) => '1x',
				esc_html__( "2x", 'crocal' ) => '2x',
				esc_html__( "3x", 'crocal' ) => '3x',
				esc_html__( "4x", 'crocal' ) => '4x',
				esc_html__( "5x", 'crocal' ) => '5x',
				esc_html__( "6x", 'crocal' ) => '6x',
				esc_html__( "None", 'crocal' ) => 'none',
			),
			"dependency" => array(
				'element' => 'column_effect',
				'value_not_equal_to' => array( 'none' )
			),
			"description" => esc_html__( "Select column effect total range of motion. None allows column to move with complete freedom.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Column Effect Invert Motion", 'crocal' ),
			"param_name" => "column_effect_invert",
			"value" => array(
				esc_html__( "No", 'crocal' ) => 'false',
				esc_html__( "Yes", 'crocal' ) => 'true',
			),
			"dependency" => array(
				'element' => 'column_effect',
				'value_not_equal_to' => array( 'none' )
			),
			"description" => esc_html__( "Select if you want to enable invert motion effect on this column.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Change Column Position", 'crocal' ),
			"param_name" => "column_custom_position",
			"value" => array(
				esc_html__( "No", 'crocal' ) => 'no',
				esc_html__( "Yes", 'crocal' ) => 'yes',
			),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( 'Top Position', 'crocal' ),
			"param_name" => "position_top",
			"value" => $crocal_eutf_position_list,
			"description" => esc_html__( "Select the top position of the column.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-6',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( 'Bottom Position', 'crocal' ),
			"param_name" => "position_bottom",
			"value" => $crocal_eutf_position_list,
			"description" => esc_html__( "Select the bottom position of the column.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-6',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Left Position", 'crocal' ),
			"param_name" => "position_left",
			"value" => $crocal_eutf_position_list,
			"description" => esc_html__( "Select the left position of the column.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-6',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( 'Right Position', 'crocal' ),
			"param_name" => "position_right",
			"value" => $crocal_eutf_position_list,
			"description" => esc_html__( "Select the right position of the column.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-6',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "textfield",
			"heading" => esc_html__( 'Z index', 'crocal' ),
			"param_name" => "z_index",
			"description" => esc_html__( "Enter a number for column's z-index. Default value is 1, recommended to be larger than this.", 'crocal' ),
			'group' => esc_html__( 'Effect & Positions', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Column Width", 'crocal'),
			"param_name" => "label_column_width",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define your column width for desktops/laptops and devices. Width attribute is defined under General tab.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Desktop", 'crocal' ),
			"param_name" => "desktop_hide",
			"value" => $crocal_eutf_column_desktop_hide_list,
			"description" => esc_html__( "Define your column width for Desktop.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_width",
			"value" => $crocal_eutf_column_width_tablet_list,
			"description" => esc_html__( "Define your column width for Tablet Landscape.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_sm_width",
			"value" => $crocal_eutf_column_width_tablet_sm_list,
			"description" => esc_html__( "Define your column width for Tablet Portrait.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_width",
			"value" => $crocal_eutf_column_mobile_width_list,
			"description" => esc_html__( "Define your column width for Mobile.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Content Width", 'crocal'),
			"param_name" => "label_content_width",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define your column content width for devices. Default is defined under General > Content Width.", 'crocal' ),
			"dependency" => array(
				'element' => 'content_width',
				'value_not_equal_to' => array( '100' )
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Tablet Landscape", 'crocal' ),
			'param_name' => 'tablet_content_width',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => 'inherit',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'content_width',
				'value_not_equal_to' => array( '100' )
			),
			"description" => esc_html__( "Define your content width for Tablet Landscape.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Tablet Portrait", 'crocal' ),
			'param_name' => 'tablet_sm_content_width',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => 'inherit',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'content_width',
				'value_not_equal_to' => array( '100' )
			),
			"description" => esc_html__( "Define your content width for Tablet Portrait.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Mobile", 'crocal' ),
			'param_name' => 'mobile_content_width',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => 'inherit',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'content_width',
				'value_not_equal_to' => array( '100' )
			),
			"description" => esc_html__( "Define your content width for Mobile.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Column Effect", 'crocal'),
			"param_name" => "label_column_effect",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define your column effect for devices. Default values are defined under Effect & Positions > Column Effect.", 'crocal' ),
			"dependency" => array(
				'element' => 'column_effect',
				'value' => array( 'vertical-parallax' )
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_landscape_column_effect",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Disable Effect", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column effect for Tablet Landscape.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_effect',
				'value' => array( 'vertical-parallax' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_portrait_column_effect",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Disable Effect", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column effect for Tablet Portrait.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_effect',
				'value' => array( 'vertical-parallax' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_column_effect",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Disable Effect", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column effect for Mobile.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_effect',
				'value' => array( 'vertical-parallax' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Column Positions", 'crocal'),
			"param_name" => "label_column_positions",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define your column positions for devices. Default values are defined under Effect & Positions > Change Column Position.", 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_landscape_column_positions",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Reset Positions", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column positions for Tablet Landscape.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_portrait_column_positions",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Reset Positions", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column positions for Tablet Portrait.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_column_positions",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Reset Positions", 'crocal' ) => 'none',
			),
			"description" => esc_html__( "Define your column positions for Mobile.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			"dependency" => array(
				'element' => 'column_custom_position',
				'value' => array( 'yes' )
			),
			'edit_field_class' => 'vc_col-sm-4',
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Text Align", 'crocal'),
			"param_name" => "label_text_align",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define your text align for devices. Default values are defined under General > Text Align.", 'crocal' ),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'crocal' ),
			"param_name" => "tablet_text_align",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Left", 'crocal' ) => 'left',
				esc_html__( "Center", 'crocal' ) => 'center',
				esc_html__( "Right", 'crocal' ) => 'right',
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Define your text align for Tablet Landscape.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'crocal' ),
			"param_name" => "tablet_sm_text_align",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Left", 'crocal' ) => 'left',
				esc_html__( "Center", 'crocal' ) => 'center',
				esc_html__( "Right", 'crocal' ) => 'right',
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Define your text align for Tablet Portrait.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'crocal' ),
			"param_name" => "mobile_text_align",
			"value" => array(
				esc_html__( "Default values", 'crocal' ) => '',
				esc_html__( "Left", 'crocal' ) => 'left',
				esc_html__( "Center", 'crocal' ) => 'center',
				esc_html__( "Right", 'crocal' ) => 'right',
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Define your text align for Mobile.", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			"type" => 'crocal_param_label',
			"heading" => esc_html__( "Expand Column Background", 'crocal'),
			"param_name" => "label_expand_column_bg",
			'value' => '',
			'std' => '',
			"description" => esc_html__( "Define the expand column background for devices. Default is defined under Style > Expand Column Background.", 'crocal' ),
			"dependency" => array(
				'element' => 'expand_column_bg',
				'value_not_equal_to' => array( '' )
			),
			'group' => esc_html__( 'Width & Responsiveness', 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Tablet Landscape", 'crocal' ),
			'param_name' => 'tablet_expand_column_bg',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => '',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'expand_column_bg',
				'value_not_equal_to' => array( '' )
			),
			"description" => esc_html__( "Define the expand column for Tablet Landscape.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Tablet Portrait", 'crocal' ),
			'param_name' => 'tablet_sm_expand_column_bg',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => '',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'expand_column_bg',
				'value_not_equal_to' => array( '' )
			),
			"description" => esc_html__( "Define the expand column for Tablet Portrait.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Mobile", 'crocal' ),
			'param_name' => 'mobile_expand_column_bg',
			"value" => array(
				esc_html__( "Default", 'crocal' ) => '',
				esc_html__( "Reset", 'crocal' ) => 'reset',
			),
			"dependency" => array(
				'element' => 'expand_column_bg',
				'value_not_equal_to' => array( '' )
			),
			"description" => esc_html__( "Define the expand column for Mobile.", 'crocal' ),
			'edit_field_class' => 'vc_col-sm-4',
			'group' => esc_html__( "Width & Responsiveness", 'crocal' ),
		)
	);

	vc_add_param( "vc_widget_sidebar",
		array(
			'type' => 'hidden',
			'param_name' => 'title',
			'value' => '',
		)
	);

	if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, '4.6', '>=') ) {

		vc_add_param( "vc_tta_tabs",
			array(
				'type' => 'hidden',
				'param_name' => 'no_fill_content_area',
				'value' => '',
			)
		);

		vc_add_param( "vc_tta_tabs",
			array(
				'type' => 'hidden',
				'param_name' => 'tab_position',
				'value' => 'top',
			)
		);

		vc_add_param( "vc_tta_accordion",
			array(
				'type' => 'hidden',
				'param_name' => 'no_fill',
				'value' => '',
			)
		);

		vc_add_param( "vc_tta_tour",
			array(
				'type' => 'hidden',
				'param_name' => 'no_fill_content_area',
				'value' => '',
			)
		);
	}

	vc_add_param( "vc_column_text",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Text Style", 'crocal' ),
			"param_name" => "text_style",
			"value" => array(
				esc_html__( "None", 'crocal' ) => '',
				esc_html__( "Leader", 'crocal' ) => 'leader-text',
				esc_html__( "Subtitle", 'crocal' ) => 'subtitle',
				esc_html__( "Link Text", 'crocal' ) => 'link-text',
				esc_html__( "Small Text", 'crocal' ) => 'small-text',
			),
			"description" => esc_html__( "Select your text style", 'crocal' ),
		)
	);
	vc_add_param( "vc_column_text", $crocal_eutf_add_animation );
	vc_add_param( "vc_column_text", $crocal_eutf_add_animation_delay );
	vc_add_param( "vc_column_text", $crocal_eutf_add_animation_duration );


}

//Omit closing PHP tag to avoid accidental whitespace output errors.
