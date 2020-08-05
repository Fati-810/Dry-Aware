<?php
/**
 * Typed Text Shortcode
 */

if( !function_exists( 'crocal_ext_vce_typed_text_shortcode' ) ) {

	function crocal_ext_vce_typed_text_shortcode( $atts, $content ) {

		$output = $link_start = $link_end = $retina_data = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'typed_prefix' => '',
					'typed_suffix' => '',
					'typed_values' => '',
					'textspeed' => '100',
					'backspeed' => '80',
					'startdelay' => '0',
					'backdelay' => '500',
					'loop' => '',
					'show_cursor' => 'yes',
					'cursor_text' => '|',
					'text_color' => 'primary-1',
					'text_bg_color' => 'none',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'increase_heading' => '100',
					'increase_heading_reset' => '',
					'custom_font_family' => '',
					'align' => 'left',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$typed_classes = array( 'eut-element' );

		array_push( $typed_classes, 'eut-typed-text' );
		array_push( $typed_classes, 'eut-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $typed_classes, 'eut-animated-item' );
			array_push( $typed_classes, $animation);
			array_push( $typed_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		array_push( $typed_classes, 'eut-' . $heading );
		if ( !empty( $custom_font_family ) ) {
			array_push( $typed_classes, 'eut-' . $custom_font_family );
		}

		if ( !empty ( $el_class ) ) {
			array_push( $typed_classes, $el_class);
		}

		if( '100' != $increase_heading ){
			if( !empty( $increase_heading_reset ) ) {
				$typed_classes = crocal_ext_vce_increase_heading_reset( $increase_heading_reset, $typed_classes );
			}
			array_push( $typed_classes, 'eut-increase-heading' );
			array_push( $typed_classes, 'eut-heading-' . $increase_heading );
		}

		$typed_class_string = implode( ' ', $typed_classes );

		$typed_colors = array( 'eut-animated-text' );

		array_push( $typed_colors, 'eut-text-' . $text_color );
		if ( 'none' != $text_bg_color ) {
			array_push( $typed_colors, 'eut-with-bg eut-bg-' . $text_bg_color );
		}

		$typed_colors_string = implode( ' ', $typed_colors );


		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$typed_id = uniqid('eut-typed-item-');

		$typed_string_values = '';

		if( !empty( $typed_values ) ) {


			$typed_values_array = explode(",", $typed_values);
			$typed_values_count= count( $typed_values_array );

			$typed_string_values = '[';

			foreach( $typed_values_array as $key => $value ) {
				$typed_string_values .= '"'. trim( htmlspecialchars_decode( strip_tags( $value ) ) ) . '"';
				if( $key != ( $typed_values_count-1 ) ) {
					$typed_string_values .= ',';
				}
			}

			$typed_string_values .= ']';
		}


		$output .= '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $typed_class_string ) . '" style="' . $style . '"' . $data . '>';
		$output .= '    <span class="eut-typed-text-prefix"> ' . $typed_prefix . '</span>';
		$output .= '    <span class="' . esc_attr( $typed_colors_string ) . '">';
		$output .= '    	<span id="' . $typed_id . '"></span>';
		$output .= '    </span>';
		$output .= '    <span class="eut-typed-text-suffix"> ' . $typed_suffix . '</span>';

		$loop = crocal_ext_vce_text_to_bool( $loop );

		$show_cursor = crocal_ext_vce_text_to_bool( $show_cursor );

		$output .= '<script type="text/javascript">
				jQuery(function($){ $("#' . $typed_id . '").appear(function() {
					$("#' . $typed_id . '").typed({
						strings: ' . $typed_string_values . ',
						typeSpeed: ' . $textspeed . ',
						backSpeed: ' . $backspeed . ',
						startDelay: ' . $startdelay . ',
						backDelay: ' . $backdelay . ',
						loop: ' . $loop . ',
						loopCount: false,
						showCursor: ' . $show_cursor . ',
						cursorChar: "' . $cursor_text . '",
						contentType: null,
						attr: null
					});
				});
			});
		</script>';

		$output .= '</' . tag_escape( $heading_tag ) . '>';

		return $output;
	}
	add_shortcode( 'crocal_typed_text', 'crocal_ext_vce_typed_text_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_typed_text_shortcode_params' ) ) {
	function crocal_ext_vce_typed_text_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Typed text", "crocal-extension" ),
			"description" => esc_html__( "Add a typed text", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-typed-text",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Prefix", "crocal-extension" ),
					"param_name" => "typed_prefix",
					"value" => "",
					"description" => esc_html__( "Enter prefix text.", "crocal-extension" ),
				),
				array(
					"type" => "exploded_textarea",
					"heading" => __("Typed Text", "crocal-extension"),
					"param_name" => "typed_values",
					"description" => esc_html__( "Input Typed Text here. Divide values with linebreaks (Enter).", "crocal-extension" ),
					"value" => "These are the default values...,Use your own values!",
					"save_always" => true,
					"admin_label" => true,
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Suffix", "crocal-extension" ),
					"param_name" => "typed_suffix",
					"value" => "",
					"description" => esc_html__( "Enter suffix text.", "crocal-extension" ),
				),
				crocal_ext_vce_get_heading_tag( "h3" ),
				crocal_ext_vce_get_heading( "h3" ),
				crocal_ext_vce_get_heading_increase(),
				crocal_ext_vce_get_heading_increase_reset(),
				crocal_ext_vce_get_custom_font_family(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Typed Text Color", "crocal-extension" ),
					"param_name" => "text_color",
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
					'std' => 'primary-1',
					"description" => esc_html__( "Color of the typed text.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Background Color", "crocal-extension" ),
					"param_name" => "text_bg_color",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => 'none',
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
					'std' => 'none',
					"description" => esc_html__( "Background color for the typed text.", "crocal-extension" ),
				),
				crocal_ext_vce_add_align(),
				crocal_ext_vce_add_animation(),
				crocal_ext_vce_add_animation_delay(),
				crocal_ext_vce_add_animation_duration(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Text Speed", "crocal-extension" ),
					"param_name" => "textspeed",
					"value" => 100,
					"description" => esc_html__( "Enter text speed in ms.", "crocal-extension" ),
					"group" => esc_html__( "Extra Settings", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Backspeed", "crocal-extension" ),
					"param_name" => "backspeed",
					"value" => 80,
					"description" => esc_html__( "Enter speed of delete in ms.", "crocal-extension" ),
					"group" => esc_html__( "Extra Settings", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Start Delay", "crocal-extension" ),
					"param_name" => "startdelay",
					"value" => 0,
					"description" => esc_html__( "Enter start delay in ms.", "crocal-extension" ),
					"group" => esc_html__( "Extra Settings", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Back Delay", "crocal-extension" ),
					"param_name" => "backdelay",
					"value" => 500,
					"description" => esc_html__( "Enter back delay in ms.", "crocal-extension" ),
					"group" => esc_html__( "Extra Settings", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Loop", "crocal-extension" ),
					"param_name" => "loop",
					"value" => array( esc_html__( "Enable loop", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Extra Settings", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Show Cursor", "crocal-extension" ),
					"param_name" => "show_cursor",
					"value" => array( esc_html__( "Show Cursor", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Extra Settings", "crocal-extension" ),
					"std" => 'yes',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Cursor Text", "crocal-extension" ),
					"param_name" => "cursor_text",
					"value" => "|",
					"description" => esc_html__( "Enter cursor text.", "crocal-extension" ),
					"group" => esc_html__( "Extra Settings", "crocal-extension" ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_typed_text', 'crocal_ext_vce_typed_text_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_typed_text_shortcode_params( 'crocal_typed_text' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
