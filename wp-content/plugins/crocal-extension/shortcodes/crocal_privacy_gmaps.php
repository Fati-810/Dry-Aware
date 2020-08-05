<?php
/**
 * Privacy Google Maps Shortcode
 */

if( !function_exists( 'crocal_ext_vce_privacy_gmaps_shortcode' ) ) {

	function crocal_ext_vce_privacy_gmaps_shortcode( $atts, $content ) {

		$output = '';

		if( empty( $content ) ) {
			$content = "Click to enable/disable Google Maps.";
		}

		if ( function_exists( 'crocal_eutf_get_privacy_switch' ) ) {
			$output .= crocal_eutf_get_privacy_switch ( 'eut-privacy-content-gmaps' , $content );
		}

		return $output;
	}
	add_shortcode( 'crocal_privacy_gmaps', 'crocal_ext_vce_privacy_gmaps_shortcode' );

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
