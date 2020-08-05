<?php
/**
 * Privacy Link
 */

if( !function_exists( 'crocal_ext_vce_privacy_preferences_link_shortcode' ) ) {

	function crocal_ext_vce_privacy_preferences_link_shortcode( $atts, $content ) {

		$output = '';

		if ( function_exists( 'crocal_eutf_get_privacy_preferences_link' ) ) {
			$output .= crocal_eutf_get_privacy_preferences_link ( $content );
		}
		return $output;
	}
	add_shortcode( 'crocal_privacy_preferences_link', 'crocal_ext_vce_privacy_preferences_link_shortcode' );

}


//Omit closing PHP tag to avoid accidental whitespace output errors.
