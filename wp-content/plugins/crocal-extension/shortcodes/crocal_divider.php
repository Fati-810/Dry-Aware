<?php
/**
 * Divider Shortcode
 */

if( !function_exists( 'crocal_ext_vce_divider_shortcode' ) ) {

	function crocal_ext_vce_divider_shortcode( $atts, $content ) {

		$output = $class_fullwidth = $style = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'line_type' => 'line',
					'line_width' => '50',
					'line_height' => '2',
					'vertical_line_height' => '50',
					'vertical_line_width' => '2',
					'line_color' => 'primary-1',
					'line_color_custom' => '#000000',
					'backtotop_title' => 'Back to top',
					'inherit_align' => 'inherit',
					'padding_top' => '',
					'padding_bottom' => '',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'el_class' => '',
				),
				$atts
			)
		);

		$style .= crocal_ext_vce_build_padding_top_style( $padding_top );
		$style .= crocal_ext_vce_build_padding_bottom_style( $padding_bottom );

		$divider_classes = array( 'eut-element', 'eut-divider' );

		if ( !empty ( $el_class ) ) {
			array_push( $divider_classes, $el_class);
		}

		if ( !empty( $animation ) ) {
			array_push( $divider_classes, 'eut-animated-item' );
			array_push( $divider_classes, $animation);
			array_push( $divider_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		$divider_string = implode( ' ', $divider_classes );

		$output .= '<div class="' . esc_attr( $divider_string ) . '" style="' . $style . '"' . $data . '>';
		if( 'custom-line' == $line_type ) {
			$line_style = '';
			$line_style .= 'width: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $line_width) ? $line_width : $line_width.'px').';';
			$line_style .= 'height: '. $line_height. 'px;';
			if( 'custom' == $line_color ) {
				$line_style .= ' background-color: ' . esc_attr( $line_color_custom ) . ';';
			}
			$output .=   '<span class="eut-custom-divider eut-bg-' . esc_attr( $line_color ) . ' eut-align-' . esc_attr( $inherit_align ) . '" style="' . esc_attr( $line_style ) . '"></span>';
		} else if( 'vertical-line' == $line_type ) {
			$line_style = '';
			$line_style .= 'width: '. $vertical_line_width. 'px;';
			$line_style .= 'height: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $vertical_line_height) ? $vertical_line_height : $vertical_line_height.'px').';';

			if( 'custom' == $line_color ) {
				$line_style .= ' background-color: ' . esc_attr( $line_color_custom ) . ';';
			}
			$output .=   '<span class="eut-custom-divider eut-bg-' . esc_attr( $line_color ) . ' eut-align-' . esc_attr( $inherit_align ) . '" style="' . esc_attr( $line_style ) . '"></span>';
		} else {
			$output .= '<div class="eut-' . $line_type . '-divider eut-border">';
			if ( !empty( $backtotop_title ) && 'top-line' == $line_type ) {
				$output .= '    <span class="eut-divider-backtotop eut-border eut-small-text eut-text-hover-primary-1">' . $backtotop_title. '</span>';
			}
			$output .= '</div>';
		}
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'crocal_divider', 'crocal_ext_vce_divider_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_divider_shortcode_params' ) ) {
	function crocal_ext_vce_divider_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Divider", "crocal-extension" ),
			"description" => esc_html__( "Insert dividers, just spaces or different lines", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-divider",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Line type", "crocal-extension" ),
					"param_name" => "line_type",
					"value" => array(
						esc_html__( "Line", "crocal-extension" ) => 'line',
						esc_html__( "Double Line", "crocal-extension" ) => 'double-line',
						esc_html__( "Dashed Line", "crocal-extension" ) => 'dashed-line',
						esc_html__( "Back to Top", "crocal-extension" ) => 'top-line',
						esc_html__( "Custom Line", "crocal-extension" ) => 'custom-line',
						esc_html__( "Vertical Line", "crocal-extension" ) => 'vertical-line',
					),
					"description" => '',
					"admin_label" => true,
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Line Width", "crocal-extension" ),
					"param_name" => "line_width",
					"value" => "50",
					"description" => esc_html__( "Enter the width for your line (Note: CSS measurement units allowed).", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value' => array( 'custom-line' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Line Height", "crocal-extension" ),
					"param_name" => "line_height",
					"value" => array( '1', '2', '3', '4' , '5', '6', '7', '8', '9' , '10' ),
					"std" => '2',
					"description" => esc_html__( "Enter the hight for your line in px.", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value' => array( 'custom-line' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Line Width", "crocal-extension" ),
					"param_name" => "vertical_line_width",
					"value" => array( '1', '2', '3', '4' , '5', '6', '7', '8', '9' , '10' ),
					"std" => '2',
					"description" => esc_html__( "Enter the width for your line in px.", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value' => array( 'vertical-line' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Line Height", "crocal-extension" ),
					"param_name" => "vertical_line_height",
					"value" => "50",
					"description" => esc_html__( "Enter the height for your line (Note: CSS measurement units allowed).", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value' => array( 'vertical-line' ) ),
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
						esc_html__( "Custom", "crocal-extension" ) => 'custom',
					),
					"description" => esc_html__( "Color for the line.", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value' => array( 'custom-line', 'vertical-line' ) ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Custom Line Color", "crocal-extension" ),
					'param_name' => 'line_color_custom',
					'description' => esc_html__( "Select a custom color for your line", "crocal-extension" ),
					'std' => '#000000',
					"dependency" => array( 'element' => "line_color", 'value' => array( 'custom' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Divider Alignment", "crocal-extension" ),
					"param_name" => "inherit_align",
					"value" => array(
						esc_html__( "Inherit", "crocal-extension" ) => 'inherit',
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
						esc_html__( "Center", "crocal-extension" ) => 'center',
					),
					"description" => 'Inherits its value from its column text align definition.',
					"dependency" => array( 'element' => "line_type", 'value' => array( 'custom-line', 'vertical-line' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Back to Top Title", "crocal-extension" ),
					"param_name" => "backtotop_title",
					"value" => "Back to top",
					"description" => esc_html__( "Set Back to top title.", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value' => array( 'top-line' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Top padding", "crocal-extension" ),
					"param_name" => "padding_top",
					"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Bottom padding", "crocal-extension" ),
					"param_name" => "padding_bottom",
					"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", "crocal-extension" ),
				),
				crocal_ext_vce_add_animation(),
				crocal_ext_vce_add_animation_delay(),
				crocal_ext_vce_add_animation_duration(),
				crocal_ext_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_divider', 'crocal_ext_vce_divider_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_divider_shortcode_params( 'crocal_divider' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.