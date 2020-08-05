<?php
/**
 * Empty Space Shortcode
 */

if( !function_exists( 'crocal_ext_vce_empty_space_shortcode' ) ) {

	function crocal_ext_vce_empty_space_shortcode( $atts, $content ) {

		$output = $style = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'height' => '32px',
					'height_multiplier' => '1x',
					'el_class' => '',
				),
				$atts
			)
		);

		$style = '';

		$empty_space_classes = array( 'eut-empty-space' );
		if ( 'custom' == $height_multiplier ) {
			$pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
			$regexr = preg_match( $pattern, $height, $matches );
			$value = isset( $matches[1] ) ? (float) $matches[1] : 30;
			$unit = isset( $matches[2] ) ? $matches[2] : 'px';
			$height = $value . $unit;
			$style = 'height: ' . esc_attr( $height ) . ';';
		} else {
			$empty_space_classes[] = 'eut-height-' . $height_multiplier;
		}

		if ( !empty ( $el_class ) ) {
			$empty_space_classes[] = $el_class;
		}
		$empty_space_class = implode( ' ', $empty_space_classes );

		$output .= '<div class="' . esc_attr( $empty_space_class ).'" style="' . esc_attr( $style ) . '"></div>';

		return $output;
	}
	add_shortcode( 'crocal_empty_space', 'crocal_ext_vce_empty_space_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_empty_space_shortcode_params' ) ) {
	function crocal_ext_vce_empty_space_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Empty Space", "crocal-extension" ),
			"description" => esc_html__( "Blank space with custom height", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-empty-space",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Height", 'crocal-extension' ),
					"param_name" => "height_multiplier",
					"value" => array(
						esc_html__( "1x", 'crocal-extension' ) => '1x',
						esc_html__( "2x", 'crocal-extension' ) => '2x',
						esc_html__( "3x", 'crocal-extension' ) => '3x',
						esc_html__( "4x", 'crocal-extension' ) => '4x',
						esc_html__( "5x", 'crocal-extension' ) => '5x',
						esc_html__( "6x", 'crocal-extension' ) => '6x',
						esc_html__( "Custom", 'crocal-extension' ) => 'custom',
					),
					"std" => '1x',
					"description" => esc_html__( "Select empty space height.", 'crocal-extension' ),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Height', 'crocal-extension' ),
					'param_name' => 'height',
					'value' => '32px',
					'description' => __( 'Enter empty space height (Note: CSS measurement units allowed).', 'crocal-extension' ),
					"dependency" => array(
						'element' => 'height_multiplier',
						'value' => array( 'custom' )
					),
				),
				crocal_ext_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_empty_space', 'crocal_ext_vce_empty_space_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_empty_space_shortcode_params( 'crocal_empty_space' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.