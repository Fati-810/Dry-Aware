<?php
/**
 * Video Shortcode
 */

if( !function_exists( 'crocal_ext_vce_video_shortcode' ) ) {

	function crocal_ext_vce_video_shortcode( $atts, $content ) {
		global $wp_embed;
		$output = $class_fullwidth = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'video_type' => 'link',
					'video_link' => '',
					'video_poster' => '',
					'video_webm' => '',
					'video_mp4' => '',
					'video_ogv' => '',
					'video_controls' => 'yes',
					'video_loop' => 'yes',
					'video_autoplay' => 'yes',
					'video_sound' => 'yes',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$video_classes = array( 'eut-element' );

		if ( $video_type == 'link' ){
			array_push( $video_classes, 'eut-video');
		} else {
			array_push( $video_classes, 'eut-embed-video');
		}

		if ( !empty( $el_class ) ) {
			array_push( $video_classes, $el_class);
		}

		$video_class_string = implode( ' ', $video_classes );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$video_attr = '';

		if ( $video_type == 'html5' ){
			if( $video_controls == 'yes' ){
				$video_attr .= ' controls';
			}
			if( $video_loop == 'yes' ){
				$video_attr .= ' loop="loop"';
			}
			if( $video_sound == 'no' ){
				$video_attr .= ' muted="muted"';
			}
			if( $video_autoplay == 'yes' ){
				$video_attr .= ' autoplay="autoplay"';
			}
			if( !empty( $video_poster ) ){
				$id = preg_replace('/[^\d]/', '', $video_poster);
				$image_url = wp_get_attachment_url( $id );
				$video_attr .= ' poster="' . esc_url( $image_url ) . '"';
			}
		}

		if ( $video_type == 'link' && !empty( $video_link ) ) {
			$output .= '<div class="' . esc_attr( $video_class_string ) . '" style="' . $style . '">';
			$output .= $wp_embed->run_shortcode( '[embed]' . $video_link . '[/embed]' );
			$output .= '</div>';
		}

		if ( $video_type == 'html5' ) {
			$output .= '<video class="' . esc_attr( $video_class_string ) . '" ' . $video_attr . '>';
			if ( !empty ( $video_webm ) ) {
				$output .= '<source src="' . esc_url( $video_webm ) . '" type="video/webm">';
			}
			if ( !empty ( $video_mp4 ) ) {
				$output .= '<source src="' . esc_url( $video_mp4 ) . '" type="video/mp4">';
			}
			if ( !empty ( $video_ogv ) ) {
				$output .= '<source src="' . esc_url( $video_ogv ) . '" type="video/ogg">';
			}
			$output .= '</video>';
		}

		return $output;
	}
	add_shortcode( 'crocal_video', 'crocal_ext_vce_video_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_video_shortcode_params' ) ) {
	function crocal_ext_vce_video_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Video", "crocal-extension" ),
			"description" => esc_html__( "Embed YouTube/Vimeo player", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-video",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Video Type", "crocal-extension" ),
					"param_name" => "video_type",
					"value" => array(
						esc_html__( "YouTube/Vimeo Video", "crocal-extension" ) => 'link',
						esc_html__( "HTML5 Video", "crocal-extension" ) => 'html5',
					),
					"description" => 'Select your Video Type',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Video Link", "crocal-extension" ),
					"param_name" => "video_link",
					"value" => "",
					"description" => esc_html__( "Type Vimeo/YouTube URL.", "crocal-extension" ),
					"dependency" => array( 'element' => "video_type", 'value' => array( 'link' ) ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Image", "crocal-extension" ),
					"param_name" => "video_poster",
					"value" => '',
					"description" => esc_html__( "Select a poster image.", "crocal-extension" ),
					"dependency" => array( 'element' => "video_type", 'value' => array( 'html5' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "WebM File URL", "crocal-extension" ),
					"param_name" => "video_webm",
					"value" => "",
					"description" => esc_html__( "Fill WebM and mp4 format for browser compatibility", 'crocal-extension' ),
					"dependency" => array( 'element' => "video_type", 'value' => array( 'html5' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "MP4 File URL", "crocal-extension" ),
					"param_name" => "video_mp4",
					"value" => "",
					"description" => esc_html__( "Fill mp4 format URL", 'crocal-extension' ),
					"dependency" => array( 'element' => "video_type", 'value' => array( 'html5' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "OGV File URL", "crocal-extension" ),
					"param_name" => "video_ogv",
					"value" => "",
					"description" => esc_html__( "Fill OGV format URL ( optional )", 'crocal-extension' ),
					"dependency" => array( 'element' => "video_type", 'value' => array( 'html5' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Show Video Controls", "crocal-extension" ),
					"param_name" => "video_controls",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"dependency" => array( 'element' => "video_type", 'value' => array( 'html5' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Video Loop", "crocal-extension" ),
					"param_name" => "video_loop",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"dependency" => array( 'element' => "video_type", 'value' => array( 'html5' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Video Autoplay", "crocal-extension" ),
					"param_name" => "video_autoplay",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"dependency" => array( 'element' => "video_type", 'value' => array( 'html5' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Video Sound", "crocal-extension" ),
					"param_name" => "video_sound",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"dependency" => array( 'element' => "video_type", 'value' => array( 'html5' ) ),
				),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_video', 'crocal_ext_vce_video_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_video_shortcode_params( 'crocal_video' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
