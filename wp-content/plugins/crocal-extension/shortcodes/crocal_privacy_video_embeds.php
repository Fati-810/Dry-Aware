<?php
/**
 * Privacy Video Embeds Shortcode
 */

if( !function_exists( 'crocal_ext_vce_privacy_video_embeds_shortcode' ) ) {

	function crocal_ext_vce_privacy_video_embeds_shortcode( $atts, $content ) {

		$output = $el_class = '';

		if( empty( $content ) ) {
			$content = "Click to enable/disable video embeds.";
		}

		if ( function_exists( 'crocal_eutf_get_privacy_switch' ) ) {
			$output .= crocal_eutf_get_privacy_switch ( 'eut-privacy-content-video-embeds' , $content );
		}

		return $output;
	}
	add_shortcode( 'crocal_privacy_video_embeds', 'crocal_ext_vce_privacy_video_embeds_shortcode' );

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
