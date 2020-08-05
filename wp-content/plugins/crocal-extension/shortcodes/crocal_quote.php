<?php
/**
 * Quote Shortcode
 */

if( !function_exists( 'crocal_ext_vce_quote_shortcode' ) ) {

	function crocal_ext_vce_quote_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'inherit_align' => 'inherit',
					'el_class' => '',
				),
				$atts
			)
		);

		$quote_classes = array( 'eut-element' );

		if ( !empty( $animation ) ) {
			array_push( $quote_classes, 'eut-animated-item' );
			array_push( $quote_classes, $animation);
			array_push( $quote_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		array_push( $quote_classes, 'eut-align-' . $inherit_align );

		if ( !empty( $el_class ) ) {
			array_push( $quote_classes, $el_class);
		}

		$quote_class_string = implode( ' ', $quote_classes );


		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );


		$output .= '<blockquote class="' . esc_attr( $quote_class_string ) . '" style="' . $style . '"' . $data . '>';
		$output .= '<p>' . $content . '</p>';
		$output .= '</blockquote>';


		return $output;
	}
	add_shortcode( 'crocal_quote', 'crocal_ext_vce_quote_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_quote_shortcode_params' ) ) {
	function crocal_ext_vce_quote_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Quote", "crocal-extension" ),
			"description" => esc_html__( "Easily create your Quote Text", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-quote",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textarea",
					"heading" => esc_html__( "Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "Sample Quote",
					"description" => esc_html__( "Type your quote.", "crocal-extension" ),
				),
				crocal_ext_vce_add_inherit_align(),
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
	vc_lean_map( 'crocal_quote', 'crocal_ext_vce_quote_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_quote_shortcode_params( 'crocal_quote' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
