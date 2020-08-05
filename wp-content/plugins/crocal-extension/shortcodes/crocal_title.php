<?php
/**
 * Title Shortcode
 */

if( !function_exists( 'crocal_ext_vce_title_shortcode' ) ) {

	function crocal_ext_vce_title_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'gradient_color' => '',
					'gradient_color_1' => 'primary-1',
					'gradient_color_2' => 'primary-2',
					'increase_heading' => '100',
					'increase_heading_reset' => '',
					'line_type' => '',
					'line_width' => '50',
					'line_height' => '1',
					'line_color' => 'primary-1',
					'inherit_align' => 'inherit',
					'animation' => '',
					'clipping_animation' => 'eut-clipping-up',
					'clipping_animation_colors' => 'dark',
					'appear_animation' => 'eut-appear-up',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$title_classes = array( 'eut-element', 'eut-title' );

		array_push( $title_classes, 'eut-align-' . $inherit_align );

		if ( !empty( $animation ) ) {
			if( 'eut-clipping-animation' == $animation ) {
				array_push( $title_classes, $clipping_animation);
				if( 'eut-colored-clipping-up' == $clipping_animation || 'eut-colored-clipping-down' == $clipping_animation || 'eut-colored-clipping-left' == $clipping_animation || 'eut-colored-clipping-right' == $clipping_animation ) {
					array_push( $title_classes, 'eut-colored-clipping');
					$data .= ' data-clipping-color="' . esc_attr( $clipping_animation_colors ) . '"';
				}
			} else if( 'eut-appear-animation' == $animation ) {
				array_push( $title_classes, $appear_animation);
				array_push( $title_classes, 'eut-duration-' . $animation_duration );
			} else {
				array_push( $title_classes, 'eut-animated-item' );
				array_push( $title_classes, 'eut-duration-' . $animation_duration );
			}
			array_push( $title_classes, $animation);
			$data .= ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty( $heading ) ) {
			array_push( $title_classes, 'eut-' . $heading );
		}

		if ( !empty( $custom_font_family ) ) {
			array_push( $title_classes, 'eut-' . $custom_font_family );
		}

		if ( !empty( $el_class ) ) {
			array_push( $title_classes, $el_class );
		}

		if( '100' != $increase_heading ){
			if( !empty( $increase_heading_reset ) ) {
				$title_classes = crocal_ext_vce_increase_heading_reset( $increase_heading_reset, $title_classes );
			}
			array_push( $title_classes, 'eut-increase-heading' );
			array_push( $title_classes, 'eut-heading-' . $increase_heading );
		}

		if ( !empty( $gradient_color ) ) {
			array_push( $title_classes, 'eut-title-gradient' );
			array_push( $title_classes, 'eut-gradient-1-' . $gradient_color_1 );
			array_push( $title_classes, 'eut-gradient-2-' . $gradient_color_2 );
		}

		$title_class_string = implode( ' ', $title_classes );

		$output .= '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '" style="' . $style . '"' . $data . '>';
		$output .= '<span>';
		$output .= crocal_ext_vce_auto_br( $content );

		if ( !empty( $line_type ) ) {
			$line_style = '';
			$line_style .= 'width: '.(preg_match('/(px|em|\%|pt|cm)$/', $line_width) ? $line_width : $line_width.'px').';';
			$line_style .= 'height: '. $line_height. 'px;';
			$output .= '<span class="eut-title-line eut-title-' . esc_attr( $line_type ) . ' eut-bg-' . esc_attr( $line_color ) . '" style="' . esc_attr( $line_style ) . '"></span>';
		}
		$output .= '</span>';
		$output .= '</' . tag_escape( $heading_tag ) . '>';

		return $output;
	}
	add_shortcode( 'crocal_title', 'crocal_ext_vce_title_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_title_shortcode_params' ) ) {
	function crocal_ext_vce_title_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Title", "crocal-extension" ),
			"description" => esc_html__( "Add a title in many and diverse ways", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-title",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => esc_html__( "Title Content", "crocal-extension" ),
					"param_name" => "content",
					"value" => "Sample Title",
					"description" => esc_html__( "Enter your title here.", "crocal-extension" ),
					"save_always" => true,
					"admin_label" => true,
				),
				crocal_ext_vce_get_heading_tag( "h3" ),
				crocal_ext_vce_get_heading( "h3" ),
				crocal_ext_vce_get_heading_increase(),
				crocal_ext_vce_get_heading_increase_reset(),
				crocal_ext_vce_get_custom_font_family(),
				crocal_ext_vce_get_gradient_color(),
				crocal_ext_vce_get_gradient_color_1(),
				crocal_ext_vce_get_gradient_color_2(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Line type", "crocal-extension" ),
					"param_name" => "line_type",
					"value" => array(
						esc_html__( "No Line", "crocal-extension" ) => '',
						esc_html__( "Bottom Line", "crocal-extension" ) => 'bottom-line',
						esc_html__( "Left Line", "crocal-extension" ) => 'left-line',
						esc_html__( "Right Line", "crocal-extension" ) => 'right-line',
					),
					"description" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Line Width", "crocal-extension" ),
					"param_name" => "line_width",
					"value" => "50",
					"description" => esc_html__( "Enter the width for your line (Note: CSS measurement units allowed).", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value_not_equal_to' => array( '' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Line Height", "crocal-extension" ),
					"param_name" => "line_height",
					"value" => array( '1', '2', '3', '4' , '5', '6', '7', '8', '9' , '10' ),
					"std" => '1',
					"description" => esc_html__( "Enter the hight for your line in px.", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value_not_equal_to' => array( '' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Line Color", "crocal-extension" ),
					"param_name" => "line_color",
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
					"description" => esc_html__( "Color for the line.", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value_not_equal_to' => array( '' ) ),
				),
				crocal_ext_vce_add_inherit_align(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
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
						esc_html__( "Clipping Animation", "crocal-extension" ) => "eut-clipping-animation",
						esc_html__( "Appear Animation", "crocal-extension" ) => "eut-appear-animation",
					),
					"group" => esc_html__( "Animation", 'crocal-extension' ),
					"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "CSS Animation", "crocal-extension"),
					"param_name" => "clipping_animation",
					"value" => array(
						esc_html__( "Clipping Up", "crocal-extension" ) => "eut-clipping-up",
						esc_html__( "Clipping Down", "crocal-extension" ) => "eut-clipping-down",
						esc_html__( "Clipping Left", "crocal-extension" ) => "eut-clipping-left",
						esc_html__( "Clipping Right", "crocal-extension" ) => "eut-clipping-right",
						esc_html__( "Colored Clipping Up", "crocal-extension" ) => "eut-colored-clipping-up",
						esc_html__( "Colored Clipping Down", "crocal-extension" ) => "eut-colored-clipping-down",
						esc_html__( "Colored Clipping Left", "crocal-extension" ) => "eut-colored-clipping-left",
						esc_html__( "Colored Clipping Right", "crocal-extension" ) => "eut-colored-clipping-right",
					),
					"group" => esc_html__( "Animation", 'crocal-extension' ),
					"dependency" => array( 'element' => "animation", 'value' => array( 'eut-clipping-animation' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Clipping Color", "crocal-extension" ),
					"param_name" => "clipping_animation_colors",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Dark", "crocal-extension" ) => 'dark',
						esc_html__( "Light", "crocal-extension" ) => 'light',
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
						esc_html__( "Grey", "crocal-extension" ) => 'grey',
					),
					"description" => esc_html__( "Select clipping color", "crocal-extension" ),
					"group" => esc_html__( "Animation", 'crocal-extension' ),
					"dependency" => array( 'element' => "clipping_animation", 'value' => array( 'eut-colored-clipping-up', 'eut-colored-clipping-down', 'eut-colored-clipping-left', 'eut-colored-clipping-right' ) ),
				),

				array(
					"type" => "dropdown",
					"heading" => esc_html__("CSS Appear Animation", 'crocal-extension' ),
					"param_name" => "appear_animation",
					"admin_label" => true,
					"value" => array(
						esc_html__( "Appear Up", 'crocal-extension' ) => "eut-appear-up",
						esc_html__( "Appear Down", 'crocal-extension' ) => "eut-appear-down",
						esc_html__( "Appear Left", 'crocal-extension' ) => "eut-appear-left",
						esc_html__( "Appear Right", 'crocal-extension' ) => "eut-appear-right",
					),
					'dependency' => array(
						'element' => 'animation',
						'value' => 'eut-appear-animation',
					),
					"description" => esc_html__("Select type of animation if you want this column to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'crocal-extension' ),
					"group" => esc_html__( "Animation", 'crocal-extension' ),
				),

				array(
					"type" => "textfield",
					'edit_field_class' => 'vc_col-sm-6',
					"heading" => esc_html__('Css Animation Delay', 'crocal-extension'),
					"param_name" => "animation_delay",
					"value" => '200',
					"description" => esc_html__( "Add delay in milliseconds.", "crocal-extension" ),
					"group" => esc_html__( "Animation", 'crocal-extension' ),
					"dependency" => array( 'element' => "animation", 'value_not_equal_to' => array( '' ) ),
				),
				array(
					"type" => "dropdown",
					'edit_field_class' => 'vc_col-sm-6',
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
					"group" => esc_html__( "Animation", 'crocal-extension' ),
					"dependency" => array( 'element' => "animation", 'value_not_equal_to' => array( 'eut-clipping-animation', '' ) ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_title', 'crocal_ext_vce_title_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_title_shortcode_params( 'crocal_title' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
