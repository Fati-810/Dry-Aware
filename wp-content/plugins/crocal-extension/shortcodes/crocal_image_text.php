<?php
/**
 * Image Text Shortcode
 */

if( !function_exists( 'crocal_ext_vce_image_text_shortcode' ) ) {

	function crocal_ext_vce_image_text_shortcode( $atts, $content ) {

		$output = $output_image = $data = $retina_data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'layout' => '1',
					'title' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'image_mode' => '',
					'image' => '',
					'retina_image' => '',
					'image_shape' => 'square',
					'image_text_align' => 'left',
					'content_align' => 'left',
					'image_popup_size' => 'extra-extra-large',
					'video_popup' => '',
					'video_link' => '',
					'shadow' => '',
					'video_icon_color' => 'primary-1',
					'read_more_title' => '',
					'read_more_link' => '',
					'read_more_class' => '',
					'content_bg' => 'none',
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

		$image_text_classes = array( 'eut-element', 'eut-image-text' );

		if ( !empty( $animation ) ) {
			array_push( $image_text_classes, 'eut-animated-item' );
			array_push( $image_text_classes, $animation);
			array_push( $image_text_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $image_text_classes, $el_class);
		}
		array_push( $image_text_classes, 'eut-image-' . $image_text_align );

		$image_text_class_string = implode( ' ', $image_text_classes );

		$image_wrapper_classes = array('eut-image');
		if ( 'square' != $image_shape ) {
			$image_wrapper_classes[] = 'eut-' . $image_shape;
		}

		if ( !empty( $shadow ) ) {
			$image_wrapper_classes[] = 'eut-' . $shadow;
			$image_wrapper_classes[] = 'eut-with-shadow';
		}
		$image_wrapper_class_string = implode( ' ', $image_wrapper_classes );

		$image_classes = array();
		$image_mode_size = crocal_ext_vce_get_image_size( $image_mode );
		$image_classes[] = 'attachment-' . $image_mode_size;
		$image_classes[] = 'size-' . $image_mode_size;

		$image_class_string = implode( ' ', $image_classes );

		$image_popup_size_mode = crocal_ext_vce_get_image_size( $image_popup_size );

		$output .= '<div class="' . esc_attr( $image_text_class_string ) . '" style="' . $style . '"' . $data . '>';

		if ( !empty( $image ) ) {
			$img_id = preg_replace('/[^\d]/', '', $image);
			$img_src = wp_get_attachment_image_src( $img_id, 'full' );
			$thumb_url = $img_src[0];
			$image_dimensions = 'width="' . $img_src[1] . '" height="' . $img_src[2] . '"';
			$alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
			$image_srcset = '';
			$full_src = wp_get_attachment_image_src( $img_id, $image_popup_size_mode );
			$full_url = $full_src[0];

			if ( !empty( $retina_image ) && empty( $image_mode ) ) {
				$img_retina_id = preg_replace('/[^\d]/', '', $retina_image);
				$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
				$retina_data = ' data-at2x="' . esc_attr( $img_retina_src[0] ) . '"';
				$retina_url = $img_retina_src[0];
				$image_srcset = $thumb_url . ' 1x,' . $retina_url . ' 2x';
				$image_html = crocal_ext_vce_get_attachment_image( $img_id, $image_mode_size , "", array( 'class' => $image_class_string, 'srcset'=> $image_srcset, 'data-column-space' => '100' ) );
			} else {
				$image_html = crocal_ext_vce_get_attachment_image( $img_id, $image_mode_size , "", array( 'class' => $image_class_string, 'data-column-space' => '100' ) );
			}

		} else {
			$full_url = crocal_ext_vce_get_fallback_image( $image_popup_size_mode, 'url' );
			$image_html = crocal_ext_vce_get_fallback_image( $image_mode_size, "", array( 'class' => $image_class_string, 'data-column-space' => '100' ) );
		}


		if ( 'yes' == $video_popup && !empty( $video_link ) ) {
			$output_image .= '<div class="' . esc_attr( $image_wrapper_class_string ) . '">';
			$output_image .= '	<a class="eut-video-popup" href="' . esc_url( $video_link ) . '">';
			$output_image .= crocal_ext_vce_get_video_icon( $video_icon_color );
			$output_image .= '	</a>';
			$output_image .= $image_html;
			$output_image .= '</div>';
		} elseif ( 'image' == $video_popup ) {
			$output_image .= '<div class="' . esc_attr( $image_wrapper_class_string ) . '">';
			$output_image .= '<a class="eut-image-popup" href="' . esc_url( $full_url ) . '">';
			$output_image .= $image_html;
			$output_image .= '</a>';
			$output_image .= '</div>';
		} else {
			$output_image .= '<div class="' . esc_attr( $image_wrapper_class_string ) . '">';
			$output_image .= $image_html;
			$output_image .= '</div>';
		}

		$output .= $output_image;

		if ( '2' == $layout ) {
			$output .= '  <div class="eut-content eut-bg-' . esc_attr( $content_bg ) . ' eut-box-item eut-paraller" data-limit="1x" eut-align-' . esc_attr( $content_align ) . '>';
		} else {
			$output .= '  <div class="eut-content eut-align-' . esc_attr( $content_align ) . '">';
		}
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

		$output .= '  </div>';
		$output .= '</div>';


		return $output;
	}
	add_shortcode( 'crocal_image_text', 'crocal_ext_vce_image_text_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_image_text_shortcode_params' ) ) {
	function crocal_ext_vce_image_text_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Image Text", "crocal-extension" ),
			"description" => esc_html__( "Combine image or video with text and button", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-image-text",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
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
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Image", "crocal-extension" ),
					"param_name" => "image",
					"value" => '',
					"description" => esc_html__( "Select an image.", "crocal-extension" ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Retina Image", "crocal-extension" ),
					"param_name" => "retina_image",
					"value" => '',
					"description" => esc_html__( "Select a 2x image.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_mode", 'value' => array( '' ) ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Image Position", "crocal-extension" ),
					"param_name" => "image_text_align",
					"description" => esc_html__( "Set the position of your image", "crocal-extension" ),
					"value" => array(
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image shape", "crocal-extension" ),
					"param_name" => "image_shape",
					"value" => array(
						esc_html__( "Square", "crocal-extension" ) => 'square',
						esc_html__( "Radius 3px", "crocal-extension" ) => 'radius-3',
						esc_html__( "Radius 5px", "crocal-extension" ) => 'radius-5',
						esc_html__( "Radius 10px", "crocal-extension" ) => 'radius-10',
						esc_html__( "Radius 15px", "crocal-extension" ) => 'radius-15',
						esc_html__( "Radius 20px", "crocal-extension" ) => 'radius-20',
						esc_html__( "Radius 25px", "crocal-extension" ) => 'radius-25',
						esc_html__( "Radius 30px", "crocal-extension" ) => 'radius-30',
						esc_html__( "Radius 35px", "crocal-extension" ) => 'radius-35',
						esc_html__( "Circle", "crocal-extension" ) => 'circle',
					),
					"description" => '',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Add Shadow", "crocal-extension" ),
					"param_name" => "shadow",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Small", "crocal-extension" ) => 'small-shadow',
						esc_html__( "Medium", "crocal-extension" ) => 'medium-shadow',
						esc_html__( "Large", "crocal-extension" ) => 'large-shadow',
					),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Popup", "crocal-extension" ),
					"param_name" => "video_popup",
					"description" => esc_html__( "If selected, a popup will be appear on click.", "crocal-extension" ),
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Video Popup", "crocal-extension" ) => 'yes',
						esc_html__( "Image Popup", "crocal-extension" ) => 'image',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Popup Size", "crocal-extension" ),
					"param_name" => "image_popup_size",
					'value' => array(
						esc_html__( 'Large' , 'crocal-extension' ) => 'large',
						esc_html__( 'Extra Extra Large' , 'crocal-extension' ) => 'extra-extra-large',
						esc_html__( 'Full' , 'crocal-extension' ) => 'full',
					),
					"std" => 'extra-extra-large',
					"dependency" => array( 'element' => "video_popup", 'value' => array( 'image' ) ),
					"description" => esc_html__( "Select size for your popup image.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Video Link", "crocal-extension" ),
					"param_name" => "video_link",
					"value" => "",
					"description" => esc_html__( "Type video URL e.g Vimeo/YouTube.", "crocal-extension" ),
					"dependency" => array( 'element' => "video_popup", 'value' => array( 'yes' ) ),
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
					"dependency" => array( 'element' => "video_popup", 'value' => array( 'yes' ) ),
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
					"type" => 'dropdown',
					"heading" => esc_html__( "Content Alignment", "crocal-extension" ),
					"param_name" => "content_align",
					"description" => esc_html__( "Set the alignment of your content", "crocal-extension" ),
					"value" => array(
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
					),
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
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_image_text', 'crocal_ext_vce_image_text_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_image_text_shortcode_params( 'crocal_image_text' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
