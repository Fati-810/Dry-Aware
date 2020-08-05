<?php
/**
 * Double Image Text Shortcode
 */

if( !function_exists( 'crocal_ext_vce_double_image_text_shortcode' ) ) {

	function crocal_ext_vce_double_image_text_shortcode( $atts, $content ) {

		$output = $output_first_image = $output_second_image = $data = $retina_data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'image_mode' => '',
					'image' => '',
					'retina_image' => '',
					'image_shape' => 'square',
					'image_mode2' => '',
					'image2' => '',
					'retina_image2' => '',
					'image_shape2' => 'square',
					'image_text_align' => 'left',
					'video_popup' => '',
					'video_link' => '',
					'video_icon_color' => 'primary-1',
					'read_more_title' => '',
					'read_more_link' => '',
					'read_more_class' => '',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$title_classes = array( 'eut-title', 'eut-heading-color' );
		$title_classes[]  = 'eut-' . $heading;
		if ( !empty( $custom_font_family ) ) {
			$title_classes[]  = 'eut-' . $custom_font_family;
		}
		$title_class_string = implode( ' ', $title_classes );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$double_image_text_classes = array( 'eut-element', 'eut-double-image-text', 'eut-paraller-wrapper' );

		if ( !empty( $animation ) ) {
			array_push( $double_image_text_classes, 'eut-animated-item' );
			array_push( $double_image_text_classes, $animation);
			array_push( $double_image_text_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $double_image_text_classes, $el_class);
		}

		array_push( $double_image_text_classes, 'eut-align-' . $image_text_align);

		$double_image_text_class_string = implode( ' ', $double_image_text_classes );

		$image_classes = array();
		if ( 'square' != $image_shape ) {
			$image_classes[] = 'eut-' . $image_shape;
		}
		$image_mode_size = crocal_ext_vce_get_image_size( $image_mode );
		$image_classes[] = 'attachment-' . $image_mode_size;
		$image_classes[] = 'size-' . $image_mode_size;
		$image_class_string = implode( ' ', $image_classes );

		$image_classes2 = array();
		if ( 'square' != $image_shape2 ) {
			$image_classes2[] = 'eut-' . $image_shape2;
		}
		$image_mode_size2 = crocal_ext_vce_get_image_size( $image_mode2 );
		$image_classes2[] = 'attachment-' . $image_mode_size2;
		$image_classes2[] = 'size-' . $image_mode_size2;
		$image_class_string2 = implode( ' ', $image_classes2 );


		$output .= '<div class="' . esc_attr( $double_image_text_class_string ) . '" style="' . $style . '"' . $data . '>';

		if ( !empty( $image ) ) {
			$img_id = preg_replace('/[^\d]/', '', $image);
			$img_src = wp_get_attachment_image_src( $img_id, 'full' );
			$thumb_url = $img_src[0];
			$alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
			$image_srcset = '';
			if ( !empty( $retina_image ) && empty( $image_mode ) ) {
				$img_retina_id = preg_replace('/[^\d]/', '', $retina_image);
				$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
				$retina_url = $img_retina_src[0];
				$image_srcset = $thumb_url . ' 1x,' . $retina_url . ' 2x';
				$image_html = crocal_ext_vce_get_attachment_image( $img_id, $image_mode_size , "", array( 'class' => $image_class_string, 'srcset'=> $image_srcset ) );
			} else {
				$image_html = crocal_ext_vce_get_attachment_image( $img_id, $image_mode_size , "", array( 'class' => $image_class_string ) );
			}

		} else {
			$image_html = crocal_ext_vce_get_fallback_image( $image_mode_size, "", array( 'class' => $image_class_string )  );
		}

		if ( !empty( $image2 ) ) {
			$img_id = preg_replace('/[^\d]/', '', $image2);
			$img_src = wp_get_attachment_image_src( $img_id, 'full' );
			$thumb_url = $img_src[0];
			$alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
			$image_srcset = '';
			if ( !empty( $retina_image2 ) && empty( $image_mode2 ) ) {
				$img_retina_id = preg_replace('/[^\d]/', '', $retina_image2);
				$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
				$retina_url = $img_retina_src[0];
				$image_srcset = $thumb_url . ' 1x,' . $retina_url . ' 2x';
				$image_html2 = crocal_ext_vce_get_attachment_image( $img_id, $image_mode_size2 , "", array( 'class' => $image_class_string2, 'srcset'=> $image_srcset ) );
			} else {
				$image_html2 = crocal_ext_vce_get_attachment_image( $img_id, $image_mode_size2 , "", array( 'class' => $image_class_string2 ) );
			}

		} else {
			$image_html2 = crocal_ext_vce_get_fallback_image( $image_mode_size2, "", array( 'class' => $image_class_string2 ) );
		}

		// First Image
		$output_first_image .= '<div class="eut-image eut-first-image">';
		if ( 'yes' == $video_popup && !empty( $video_link ) ) {
			$output_first_image .= '	<a class="eut-video-popup" href="' . esc_url( $video_link ) . '">';
			$output_first_image .= crocal_ext_vce_get_video_icon( $video_icon_color );
			$output_first_image .= '	</a>';
		}
		$output_first_image .= $image_html;
		$output_first_image .= '</div>';

		$output .= $output_first_image;


		$output .= '  <div class="eut-content eut-align-' . esc_attr( $image_text_align ) . '">';

		if ( !empty( $title ) ) {
		$output .= '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">' . $title. '</' . tag_escape( $heading_tag ) . '>';
		}
		if ( !empty( $content ) ) {
		$output .= '  <p class="eut-description">' . do_shortcode( $content ) . '</p>';
		}
		if ( !empty( $read_more_title ) && crocal_ext_vce_has_link( $read_more_link ) ) {
			$link_class_string = 'eut-link-text eut-read-more ' . esc_attr( $read_more_class );
			$link_attributes = crocal_ext_vce_get_link_attributes( $read_more_link, $link_class_string );
			$output .= '<a ' . implode( ' ', $link_attributes ) . '>';
			$output .= $read_more_title ;
			$output .= '</a>';
		}
		// Second Image
		$output_second_image .= '<div class="eut-image eut-second-image eut-paraller" data-invert="true">';
		$output_second_image .= $image_html2;
		$output_second_image .= '</div>';

		$output .= $output_second_image;

		$output .= '  </div>';
		$output .= '</div>';


		return $output;
	}
	add_shortcode( 'crocal_double_image_text', 'crocal_ext_vce_double_image_text_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_double_image_text_shortcode_params' ) ) {
	function crocal_ext_vce_double_image_text_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Double Image Text", "crocal-extension" ),
			"description" => esc_html__( "Combine images and video with text and button", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-double-image-text",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Image align", "crocal-extension" ),
					"param_name" => "image_text_align",
					"description" => esc_html__( "Set the alignment of your image", "crocal-extension" ),
					"value" => array(
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
					),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Video popup", "crocal-extension" ),
					"param_name" => "video_popup",
					"description" => esc_html__( "If selected, a video popup will be appear on click.", "crocal-extension" ),
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Video Link", "crocal-extension" ),
					"param_name" => "video_link",
					"value" => "",
					"description" => esc_html__( "Type video URL e.g Vimeo/YouTube.", "crocal-extension" ),
					"dependency" => array( 'element' => "video_popup", 'not_empty' => true ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Video Icon Color", "crocal-extension" ),
					"param_name" => "video_icon_color",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
						esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
						esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
						esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
						esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
						esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
						esc_html__( "Green", "crocal-extension" ) => 'green',
						esc_html__( "Orange", "crocal-extension" ) => 'orange',
						esc_html__( "Red", "crocal-extension" ) => 'red',
						esc_html__( "Blue", "crocal-extension" ) => 'blue',
						esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
						esc_html__( "Purple", "crocal-extension" ) => 'purple',
						esc_html__( "Black", "crocal-extension" ) => 'black',
						esc_html__( "Grey", "crocal-extension" ) => 'grey',
						esc_html__( "White", "crocal-extension" ) => 'white',
					),
					"dependency" => array( 'element' => "video_popup", 'not_empty' => true ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", "crocal-extension" ),
					"param_name" => "title",
					"value" => "",
					"description" => esc_html__( "Enter your title.", "crocal-extension" ),
					"admin_label" => true,
				),
				crocal_ext_vce_get_heading_tag( "h3" ),
				crocal_ext_vce_get_heading( "h3" ),
				crocal_ext_vce_get_custom_font_family(),
				array(
					"type" => "textarea",
					"heading" => esc_html__( "Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "",
					"description" => esc_html__( "Enter your text.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Read More Title", "crocal-extension" ),
					"param_name" => "read_more_title",
					"value" => "",
					"description" => esc_html__( "Enter your title for your link.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Read More Link Class", "crocal-extension" ),
					"param_name" => "read_more_class",
					"value" => "",
					"description" => esc_html__( "Enter extra class name for your link.", "crocal-extension" ),
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( "Read More Link", "crocal-extension" ),
					"param_name" => "read_more_link",
					"value" => "",
					"description" => esc_html__( "Enter read more link.", "crocal-extension" ),
				),
				crocal_ext_vce_add_animation(),
				crocal_ext_vce_add_animation_delay(),
				crocal_ext_vce_add_animation_duration(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Size", "crocal-extension" ),
					"param_name" => "image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Full ( Custom )', 'crocal-extension' ) => '',
						esc_html__( 'Square Small Crop', 'crocal-extension' ) => 'square',
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
					) ),
					'std' => '',
					"description" => esc_html__( "Select your Image Size.", "crocal-extension" ),
					"group" => esc_html__( "First Image", "crocal-extension" ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Image", "crocal-extension" ),
					"param_name" => "image",
					"value" => '',
					"description" => esc_html__( "Select an image.", "crocal-extension" ),
					"group" => esc_html__( "First Image", "crocal-extension" ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Retina Image", "crocal-extension" ),
					"param_name" => "retina_image",
					"value" => '',
					"description" => esc_html__( "Select a 2x image.", "crocal-extension" ),
					"group" => esc_html__( "First Image", "crocal-extension" ),
					"dependency" => array( 'element' => "image_mode", 'value' => array( '' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image shape", "crocal-extension" ),
					"param_name" => "image_shape",
					"value" => array(
						esc_html__( "Square", "crocal-extension" ) => 'square',
						esc_html__( "Round", "crocal-extension" ) => 'extra-round',
						esc_html__( "Circle", "crocal-extension" ) => 'circle',
					),
					"description" => '',
					"group" => esc_html__( "First Image", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Size", "crocal-extension" ),
					"param_name" => "image_mode2",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Full ( Custom )', 'crocal-extension' ) => '',
						esc_html__( 'Square Small Crop', 'crocal-extension' ) => 'square',
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
					) ),
					'std' => '',
					"description" => esc_html__( "Select your Image Size.", "crocal-extension" ),
					"group" => esc_html__( "Second Image", "crocal-extension" ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Image", "crocal-extension" ),
					"param_name" => "image2",
					"value" => '',
					"description" => esc_html__( "Select an image.", "crocal-extension" ),
					"group" => esc_html__( "Second Image", "crocal-extension" ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Retina Image", "crocal-extension" ),
					"param_name" => "retina_image2",
					"value" => '',
					"description" => esc_html__( "Select a 2x image.", "crocal-extension" ),
					"group" => esc_html__( "Second Image", "crocal-extension" ),
					"dependency" => array( 'element' => "image_mode2", 'value' => array( '' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image shape", "crocal-extension" ),
					"param_name" => "image_shape2",
					"value" => array(
						esc_html__( "Square", "crocal-extension" ) => 'square',
						esc_html__( "Round", "crocal-extension" ) => 'extra-round',
						esc_html__( "Circle", "crocal-extension" ) => 'circle',
					),
					"description" => '',
					"group" => esc_html__( "Second Image", "crocal-extension" ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_double_image_text', 'crocal_ext_vce_double_image_text_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_double_image_text_shortcode_params( 'crocal_double_image_text' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
