<?php
/**
 * Privacy Required Shortcode
 */

if( !function_exists( 'crocal_ext_vce_privacy_required_shortcode' ) ) {

	function crocal_ext_vce_privacy_required_shortcode( $atts, $content ) {

		$output = '';
		
		extract(
			shortcode_atts(
				array(
					'value' => 'required',
				),
				$atts
			)
		);		

		if( empty( $content ) ) {
			$content = "write your required title here";
		}

		if ( function_exists( 'crocal_eutf_get_privacy_required' ) ) {
			$output .= crocal_eutf_get_privacy_required ( $value , $content );
		}

		return $output;
	}
	add_shortcode( 'crocal_privacy_required', 'crocal_ext_vce_privacy_required_shortcode' );

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
