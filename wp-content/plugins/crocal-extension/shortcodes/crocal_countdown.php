<?php
/**
 * Typed Text Shortcode
 */

if( !function_exists( 'crocal_ext_vce_countdown_shortcode' ) ) {

	function crocal_ext_vce_countdown_shortcode( $atts, $content ) {

		$output = $el_class = $data = '';

		extract(
			shortcode_atts(
				array(
					'final_date' => '',
					'countdown_format' => 'D|H|M|S',
					'countdown_style' => '1',
					'numbers_size' => 'h3',
					'text_size' => 'small-text',
					'numbers_color' => 'black',
					'text_color' => 'black',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$countdown_classes = array( 'eut-element' , 'eut-countdown' );

		array_push( $countdown_classes, 'eut-style-' . $countdown_style );

		if ( !empty( $animation ) ) {
			array_push( $countdown_classes, 'eut-animated-item' );
			array_push( $countdown_classes, $animation);
			array_push( $countdown_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $countdown_classes, $el_class);
		}

		$countdown_class_string = implode( ' ', $countdown_classes );


		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );


		$output .= '<div class="' . esc_attr( $countdown_class_string ) . '" style="' . $style . '" data-countdown="' . esc_attr( $final_date ) . '" data-countdown-format="' . esc_attr( $countdown_format ) . '" data-numbers-size="' . esc_attr( $numbers_size ) . '" data-text-size="' . esc_attr( $text_size ) . '" data-numbers-color="' . esc_attr( $numbers_color ) . '" data-text-color="' . esc_attr( $text_color ) . '"' . $data . '></div>';


		return $output;
	}
	add_shortcode( 'crocal_countdown', 'crocal_ext_vce_countdown_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_countdown_shortcode_params' ) ) {
	function crocal_ext_vce_countdown_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Countdown", "crocal-extension" ),
			"description" => esc_html__( "Add a countdown element", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-countdown",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Final Date", "crocal-extension" ),
					"param_name" => "final_date",
					"value" => "",
					"description" => esc_html__( "Accepted formats: YYYY/MM/DD , MM/DD/YYYY , YYYY/MM/DD hh:mm:ss , MM/DD/YYYY hh:mm:ss ( e.g: 2019/12/30 )", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Countdown Display", "crocal-extension" ),
					"param_name" => "countdown_format",
					"value" => array(
						esc_html__( "Days Hours Minutes Seconds", "crocal-extension" ) => 'D|H|M|S',
						esc_html__( "Weeks Days Hours Minutes Seconds", "crocal-extension" ) => 'w|d|H|M|S',
					),
					'std' => 'D|H|M|S',
					"description" => esc_html__( "Select the countdown display.", "crocal-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Countdown Style", "crocal-extension" ),
					"param_name" => "countdown_style",
					"value" => array(
						esc_html__( "Style 1", "crocal-extension" ) => '1',
						esc_html__( "Style 2", "crocal-extension" ) => '2',
						esc_html__( "Style 3", "crocal-extension" ) => '3',
					),
					'std' => '1',
					"description" => esc_html__( "Select the countdown style.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Numbers size", "crocal-extension" ),
					"param_name" => "numbers_size",
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
					"description" => esc_html__( "Numbers size and typography", "crocal-extension" ),
					"std" => 'h3',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Text size", "crocal-extension" ),
					"param_name" => "text_size",
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
					"description" => esc_html__( "Text size and typography", "crocal-extension" ),
					"std" => 'small-text',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Numbers Color", "crocal-extension" ),
					"param_name" => "numbers_color",
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
					'std' => 'black',
					"description" => esc_html__( "Color of the numbers.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Text Color", "crocal-extension" ),
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
					'std' => 'black',
					"description" => esc_html__( "Color of the text.", "crocal-extension" ),
				),
				crocal_ext_vce_add_animation(),
				crocal_ext_vce_add_animation_delay(),
				crocal_ext_vce_add_animation_duration(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_countdown', 'crocal_ext_vce_countdown_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_countdown_shortcode_params( 'crocal_countdown' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
