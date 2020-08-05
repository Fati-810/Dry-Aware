<?php
/**
 * Privacy Custom Shortcode
 */

if( !function_exists( 'crocal_ext_vce_privacy_custom_shortcode' ) ) {

	function crocal_ext_vce_privacy_custom_shortcode( $atts, $content ) {

		$output = '';

		extract(
			shortcode_atts(
				array(
					'id' => 'custom',
				),
				$atts
			)
		);

		if( empty( $content ) ) {
			$content = "Click to enable/disable custom content.";
		}
		if( empty( $id ) ) {
			$id = 'custom-id';
		}
		$id = sanitize_title_with_dashes( $id );

		if ( function_exists( 'crocal_eutf_get_privacy_switch' ) ) {
			$output .= crocal_eutf_get_privacy_switch ( 'eut-privacy-content-' . esc_attr( $id ) , $content );
		}

		return $output;
	}
	add_shortcode( 'crocal_privacy_custom', 'crocal_ext_vce_privacy_custom_shortcode' );

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
