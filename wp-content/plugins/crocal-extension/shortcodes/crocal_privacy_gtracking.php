<?php
/**
 * Privacy Google Tracking Code Shortcode
 */

if( !function_exists( 'crocal_ext_vce_privacy_gtracking_shortcode' ) ) {

	function crocal_ext_vce_privacy_gtracking_shortcode( $atts, $content ) {

		$output = '';

		if( empty( $content ) ) {
			$content = "Click to enable/disable Google Analytics tracking code.";
		}

		if ( function_exists( 'crocal_eutf_get_privacy_switch' ) ) {
			$output .= crocal_eutf_get_privacy_switch ( 'eut-privacy-content-gtracking' , $content );
		}

		return $output;
	}
	add_shortcode( 'crocal_privacy_gtracking', 'crocal_ext_vce_privacy_gtracking_shortcode' );

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
