<?php
/**
 * Privacy Google Fonts Shortcode
 */

if( !function_exists( 'crocal_ext_vce_privacy_gfonts_shortcode' ) ) {

	function crocal_ext_vce_privacy_gfonts_shortcode( $atts, $content ) {

		$output = '';

		if( empty( $content ) ) {
			$content = "Click to enable/disable Google Fonts.";
		}

		if ( function_exists( 'crocal_eutf_get_privacy_switch' ) ) {
			$output .= crocal_eutf_get_privacy_switch ( 'eut-privacy-content-gfonts' , $content );
		}

		return $output;
	}
	add_shortcode( 'crocal_privacy_gfonts', 'crocal_ext_vce_privacy_gfonts_shortcode' );

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
