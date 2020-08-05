<?php
/**
 * Dropcap Shortcode
 */

if( !function_exists( 'crocal_ext_vce_dropcap_shortcode' ) ) {

	function crocal_ext_vce_dropcap_shortcode( $atts, $content ) {

		$output = $style = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'dropcap_style' => '1',
					'color' => 'primary-1',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);


		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$dropcap_classes = array( 'eut-element', 'eut-dropcap' );

		if ( !empty( $animation ) ) {
			array_push( $dropcap_classes, 'eut-animated-item' );
			array_push( $dropcap_classes, $animation);
			array_push( $dropcap_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $dropcap_classes, $el_class);
		}
		$dropcap_class_string = implode( ' ', $dropcap_classes );

		if ( !empty( $content ) ) {

			$dropcap_char = mb_substr( $content, 0, 1, 'UTF8' );
			$dropcap_content = mb_substr( $content, 1, mb_strlen( $content ) , 'UTF8' );
			$output .= '<div class="' . esc_attr( $dropcap_class_string ) . '" style="' . $style . '"' . $data .'>';
			if ( '1' == $dropcap_style ) {
			$output .= '  <p><span class="eut-style-' . esc_attr( $dropcap_style ) . ' eut-text-' . esc_attr( $color ) . '">' . $dropcap_char . '</span>' . $dropcap_content . '</p>';
			} else {
			$output .= '  <p><span class="eut-style-' . esc_attr( $dropcap_style ) . ' eut-bg-' . esc_attr( $color ) . '">' . $dropcap_char . '</span>' . $dropcap_content . '</p>';
			}
			$output .= '</div>';

		}


		return $output;
	}
	add_shortcode( 'crocal_dropcap', 'crocal_ext_vce_dropcap_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_dropcap_shortcode_params' ) ) {
	function crocal_ext_vce_dropcap_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Dropcap", "crocal-extension" ),
			"description" => esc_html__( "Two separate styles for your dropcaps", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-dropcap",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Style", "crocal-extension" ),
					"param_name" => "dropcap_style",
					"value" => array(
						esc_html__( "Style 1", "crocal-extension" ) => '1',
						esc_html__( "Style 2", "crocal-extension" ) => '2',
					),
					"description" => esc_html__( "Style of the dropcap.", "crocal-extension" ),
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__( "Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "Sample Text",
					"description" => esc_html__( "Type your dropcap text.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Dropcap Color", "crocal-extension" ),
					"param_name" => "color",
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
					),
					"description" => esc_html__( "First character background color", "crocal-extension" ),
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
	vc_lean_map( 'crocal_dropcap', 'crocal_ext_vce_dropcap_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_dropcap_shortcode_params( 'crocal_dropcap' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
