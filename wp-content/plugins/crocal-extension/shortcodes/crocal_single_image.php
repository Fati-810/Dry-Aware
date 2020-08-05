<?php
/**
* Single Image Shortcode
*/

if( !function_exists( 'crocal_ext_vce_single_image_shortcode' ) ) {

	function crocal_ext_vce_single_image_shortcode( $attr, $content ) {

		$output = $data = $retina_data = $el_class = $image_srcset = '' ;

		extract(
			shortcode_atts(
				array(
					'image' => '',
					'image_mode' => '',
					'retina_image' => '',
					'image_type' => 'image',
					'ids' => '',
					'image_popup_size' => 'extra-extra-large',
					'image_popup_title_caption' => 'none',
					'image_column_space' => 'auto',
					'inherit_align' => 'center',
					'title_heading_tag' => 'h3',
					'title_heading' => 'h3',
					'title_custom_font_family' => '',
					'custom_title' => '',
					'custom_caption' => '',
					'image_hover_style' => 'hover-style-1',
					'image_shape' => 'square',
					'shadow' => '',
					'zoom_effect' => 'in',
					'grayscale_effect' => 'none',
					'content_bg_color' => 'white',
					'overlay_color' => 'dark',
					'overlay_opacity' => '60',
					'link' => '',
					'link_class' => '',
					'video_link' => '',
					'video_icon_color' => 'primary-1',
					'animation' => '',
					'clipping_animation' => 'eut-clipping-up',
					'clipping_animation_colors' => 'dark',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$attr
			)
		);

		$has_link = crocal_ext_vce_has_link( $link );

		$single_image_classes = array( 'eut-element', 'eut-image' );

		if ( !empty( $animation ) ) {
			if( 'eut-clipping-animation' == $animation ) {
				array_push( $single_image_classes, $clipping_animation);
				array_push( $single_image_classes, 'eut-advanced-animation');

				if( 'eut-colored-clipping-up' == $clipping_animation || 'eut-colored-clipping-down' == $clipping_animation || 'eut-colored-clipping-left' == $clipping_animation || 'eut-colored-clipping-right' == $clipping_animation ) {
					array_push( $single_image_classes, 'eut-colored-clipping');
					$data .= ' data-clipping-color="' . esc_attr( $clipping_animation_colors ) . '"';
				}
			} else {
				array_push( $single_image_classes, 'eut-animated-item' );
				array_push( $single_image_classes, 'eut-duration-' . $animation_duration );
			}
			array_push( $single_image_classes, $animation);
			$data .= ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if( 'none' != $grayscale_effect ){
			array_push( $single_image_classes, 'eut-' . $grayscale_effect);
		}
		if ( !empty( $el_class ) ) {
			array_push( $single_image_classes, $el_class);
		}

		array_push( $single_image_classes, 'eut-align-' . $inherit_align );
		if( 'image-caption' == $image_type || 'image-popup-caption' == $image_type  ) {
			array_push( $single_image_classes, 'eut-hover-item' );
			array_push( $single_image_classes, 'eut-' . $image_hover_style );
		}

		if ( 'auto' != $image_column_space ) {
			array_push( $single_image_classes, 'eut-image-space-' . $image_column_space );
			array_push( $single_image_classes, 'eut-image-expand-width' );
		}

		if ( 'gallery-popup' == $image_type ) {
			array_push( $single_image_classes, 'eut-gallery-popup' );
		}

		if ( 'image-popup' == $image_type || 'image-video-popup' == $image_type || 'gallery-popup' == $image_type || 'image-popup-caption' == $image_type ) {
			array_push( $single_image_classes, 'eut-light-gallery' );
		}

		$single_image_classes_string = implode( ' ', $single_image_classes );

		$image_classes = array();

		$image_mode_size = crocal_ext_vce_get_image_size( $image_mode );
		$image_classes[] = 'attachment-' . $image_mode_size;
		$image_classes[] = 'size-' . $image_mode_size;

		$image_class_string = implode( ' ', $image_classes );

		if( 'image-caption' == $image_type || 'image-popup-caption' == $image_type  ) {
			$image_class_string = '';
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );


		//Image Title & Caption Color
		$text_color = 'white';
		$title_color = 'white';
		if( 'hover-style-1' == $image_hover_style ){
			$text_color = 'inherit';
			$title_color = 'inherit';
		} elseif( 'hover-style-2' == $image_hover_style || 'hover-style-3' == $image_hover_style ){
			if( 'light' == $overlay_color ) {
				$text_color = 'content';
				$title_color = 'black';
			}
		}
		if( 'hover-style-4' == $image_hover_style || 'hover-style-5' == $image_hover_style || 'hover-style-7' == $image_hover_style ){
			$text_color = 'inherit';
			if( 'white' == $content_bg_color ){
				$title_color = 'black';
			} else {
				$title_color = 'white';
			}
		}

		$image_content_classes = array( 'eut-content' );
		if ( !empty( $custom_title ) || !empty( $custom_caption ) ) {
			if( 'hover-style-7' == $image_hover_style ){
				array_push( $image_content_classes, 'eut-align-left');
			} else {
				array_push( $image_content_classes, 'eut-align-center');
			}
			if( 'hover-style-4' == $image_hover_style || 'hover-style-5' == $image_hover_style || 'hover-style-7' == $image_hover_style ){
				array_push( $image_content_classes, 'eut-box-item eut-bg-' . $content_bg_color );
			}
		}
		$image_content_class_string = implode( ' ', $image_content_classes );

		// Image Wrapper Classes
		$image_wrapper_classes = array( 'eut-image-wrapper', 'eut-popup-item' );

		if ( 'square' != $image_shape ) {
			$image_wrapper_classes[] = 'eut-' . $image_shape;
		}

		if ( !empty( $shadow ) ) {
			$image_wrapper_classes[] = 'eut-' . $shadow;
			$image_wrapper_classes[] = 'eut-with-shadow';
		}

		$image_wrapper_class_string = implode( ' ', $image_wrapper_classes );


		$image_popup_size_mode = crocal_ext_vce_get_image_size( $image_popup_size );

		$img_width = '100%';

		if ( !empty( $image ) ) {
			$id = preg_replace('/[^\d]/', '', $image);
			$thumb_src = wp_get_attachment_image_src( $id, $image_mode_size );
			$thumb_url = $thumb_src[0];
			$image_srcset = '';
			$img_width = $thumb_src[1];
			$full_src = wp_get_attachment_image_src( $id, $image_popup_size_mode );
			$full_url = $full_src[0];

			if ( !empty( $retina_image ) && empty( $image_mode ) ) {
				$img_retina_id = preg_replace('/[^\d]/', '', $retina_image);
				$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
				$retina_url = $img_retina_src[0];
				$image_srcset = $thumb_url . ' 1x,' . $retina_url . ' 2x';
				$image_html = crocal_ext_vce_get_attachment_image( $id, $image_mode_size , "", array( 'class' => $image_class_string, 'srcset'=> $image_srcset, 'data-column-space' => $image_column_space ) );
			} else {
				$image_html = crocal_ext_vce_get_attachment_image( $id, $image_mode_size , "", array( 'class' => $image_class_string, 'data-column-space' => $image_column_space ) );
			}

		} else {
			$full_url = crocal_ext_vce_get_fallback_image( $image_popup_size_mode, 'url' );
			$image_html = crocal_ext_vce_get_fallback_image( $image_mode_size, "", array( 'class' => $image_class_string ) );
		}

		$output .= '<div class="' . esc_attr( $single_image_classes_string ) . '" style="' . $style . '"' . $data . '>';
		if ( 'auto' != $image_column_space ){
			$output .= '<div class="' . esc_attr( $image_wrapper_class_string ) . '">';
		} else {
			$output .= '<div class="' . esc_attr( $image_wrapper_class_string ) . '" style="max-width:' . esc_attr( $img_width ) . 'px;">';
		}

		if ( 'image-popup' == $image_type ) {

			$image_title = $image_caption = "";
			if ( !empty( $image ) ) {
				$image_title = get_post_field( 'post_title', $id );
				$image_caption = get_post_field( 'post_excerpt', $id );
			}
			$data = "";
			$data_html = '';
			if ( !empty( $image_title ) && 'none' != $image_popup_title_caption && 'caption-only' != $image_popup_title_caption ) {
				$data_html .= '<span class="eut-title">' . $image_title . '</span>';
			}
			if ( !empty( $image_caption ) && 'none' != $image_popup_title_caption && 'title-only' != $image_popup_title_caption ) {
				$data_html .= '<span class="eut-caption">' . $image_caption . '</span>';
			}
			if ( !empty( $data_html ) ) {
				$data .= ' data-sub-html="' . esc_attr( $data_html ) . '"';
			}

			$data .= ' data-size="' . esc_attr( $full_src[1] ) . 'x' . esc_attr( $full_src[2] ) . '"';

			$output .= '<a class="eut-item-url" href="' . esc_url( $full_url ) . '"' . $data . '></a>';
			$output .= $image_html;
		} else if ( 'gallery-popup' == $image_type ) {

			$attachments = explode( ",", $ids );
			if ( !empty( $ids ) && !empty( $attachments ) ) {
				$first_image_data = "";
				$first_image_url = "#";
				$index = 0;

				$gallery_links = "";
				$gallery_links .= '<div class="eut-hidden">';
				foreach ( $attachments as $id ) {
					$full_src = wp_get_attachment_image_src( $id, $image_popup_size_mode );
					$full_url = $full_src[0];
					$image_title = get_post_field( 'post_title', $id );
					$image_caption = get_post_field( 'post_excerpt', $id );
					$data = "";
					$data_html = '';
					if ( !empty( $image_title ) && 'none' != $image_popup_title_caption && 'caption-only' != $image_popup_title_caption ) {
						$data_html .= '<span class="eut-title">' . $image_title . '</span>';
					}
					if ( !empty( $image_caption ) && 'none' != $image_popup_title_caption && 'title-only' != $image_popup_title_caption ) {
						$data_html .= '<span class="eut-caption">' . $image_caption . '</span>';
					}
					if ( !empty( $data_html ) ) {
						$data .= ' data-sub-html="' . esc_attr( $data_html ) . '"';
					}
					$data .= ' data-size="' . esc_attr( $full_src[1] ) . 'x' . esc_attr( $full_src[2] ) . '"';
					if ( 0 == $index ) {
						$first_image_data = $data;
						$first_image_url= $full_url;
					} else {
						$gallery_links .= '<a class="eut-item-url" href="' . esc_url( $full_url ) . '"' . $data . '></a>';
					}
					$index ++;
				}
				$gallery_links .= '</div>';

				$output .= '<a class="eut-item-url" href="' . esc_url( $first_image_url ) . '"' . $first_image_data . '></a>';
				$output .= $image_html;
				$output .= $gallery_links;
			} else {
				$output .= $image_html;
			}

		} else if ( 'image-link' == $image_type ) {
			$link_attributes = crocal_ext_vce_get_link_attributes( $link, $link_class );
			$output .= '<a ' . implode( ' ', $link_attributes ) . '>';
			$output .= $image_html;
			$output .= '</a>';
		} else if ( 'image-video-popup' == $image_type ) {
			if ( !empty( $video_link ) ) {
				$output .= '<div class="eut-media eut-paraller-wrapper">';
				$output .= '	<a class="eut-item-url eut-video-popup" href="' . esc_url( $video_link ) . '">';
				$output .= crocal_ext_vce_get_video_icon( $video_icon_color );
				$output .= '	</a>';
				$output .= $image_html;
				$output .= '</div>';
			} else {
				$output .= '<div class="eut-media">';
				$output .= $image_html;
				$output .= '</div>';
			}
		} else if ( 'image-caption' == $image_type || 'image-popup-caption' == $image_type ) {

			$title_classes = array( 'eut-title' );
			$title_classes[]  = 'eut-' . $title_heading;
			$title_classes[]  = 'eut-text-' . $title_color;
			if ( !empty( $title_custom_font_family ) ) {
				$title_classes[]  = 'eut-' . $title_custom_font_family;
			}
			$title_class_string = implode( ' ', $title_classes );

			if ( 'hover-style-1' == $image_hover_style ) {
				$output .= '<figure class="eut-image-hover eut-media eut-zoom-' . esc_attr( $zoom_effect ) . '">';
				if ( 'image-caption' == $image_type && $has_link ) {
					$link_class_string = 'eut-item-url ' . esc_attr( $link_class );
					$link_attributes = crocal_ext_vce_get_link_attributes( $link, $link_class_string );
					$output .= '<a ' . implode( ' ', $link_attributes ) . '></a>';
				} elseif ( 'image-popup-caption' == $image_type ) {
					$data = "";
					$data_html = '';
					if ( !empty( $custom_title ) && 'none' != $image_popup_title_caption && 'caption-only' != $image_popup_title_caption ) {
						$data_html .= '<span class="eut-title">' . $custom_title . '</span>';
					}
					if ( !empty( $custom_caption ) && 'none' != $image_popup_title_caption && 'title-only' != $image_popup_title_caption ) {
						$data_html .= '<span class="eut-caption">' . $custom_caption . '</span>';
					}
					if ( !empty( $data_html ) ) {
						$data .= ' data-sub-html="' . esc_attr( $data_html ) . '"';
					}
					$data .= ' data-size="' . esc_attr( $full_src[1] ) . 'x' . esc_attr( $full_src[2] ) . '"';
					$output .= '<a class="eut-item-url" href="' . esc_url( $full_url ) . '"' . $data . '></a>';
				}
				$output .= '<div class="eut-bg-' . esc_attr( $overlay_color ) . ' eut-hover-overlay  eut-opacity-' . esc_attr( $overlay_opacity )  . '"></div>';
				$output .= $image_html;
				$output .= '<figcaption></figcaption>';
				$output .= '</figure>';
				if ( !empty( $custom_title ) || !empty( $custom_caption ) ) {
					$output .= '<div class="' . esc_attr( $image_content_class_string ) . '">';
					if ( !empty( $custom_title ) ) {
						$output .= '<' . tag_escape( $title_heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">' . esc_html( $custom_title ) . '</' . tag_escape( $title_heading_tag ) . '>';
					}
					if ( !empty( $custom_caption ) ) {
						$output .= '<span class="eut-description eut-link-text eut-text-content">' . wp_kses_post( $custom_caption ) . '</span>';
					}
					$output .= '</div>';
				}
			} else {
				$output .= '<figure class="eut-image-hover eut-media eut-zoom-' . esc_attr( $zoom_effect ) . '">';
				if ( 'image-caption' == $image_type && $has_link ) {
					$link_class_string = 'eut-item-url ' . esc_attr( $link_class );
					$link_attributes = crocal_ext_vce_get_link_attributes( $link, $link_class_string );
					$output .= '<a ' . implode( ' ', $link_attributes ) . '></a>';
				} elseif ( 'image-popup-caption' == $image_type ) {
					$output .= '<a class="eut-item-url" href="' . esc_url( $full_url ) . '"></a>';
				}
				if( 'hover-style-6' != $image_hover_style ){
					$output .= '<div class="eut-bg-' . esc_attr( $overlay_color ) . ' eut-hover-overlay  eut-opacity-' . esc_attr( $overlay_opacity )  . '"></div>';
				} else {
					$output .= '<div class="eut-gradient-overlay eut-gradient-' . esc_attr( $overlay_color ) . ' eut-gradient-opacity-' . esc_attr( $overlay_opacity ) .'"></div>';
				}
				$output .= $image_html;
				if ( !empty( $custom_title ) || !empty( $custom_caption ) ) {
					$output .= '<figcaption class="' . esc_attr( $image_content_class_string ) . '">';
					if ( !empty( $custom_title ) ) {
						$output .= '<' . tag_escape( $title_heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">' . esc_html( $custom_title ) . '</' . tag_escape( $title_heading_tag ) . '>';
					}
					if ( !empty( $custom_caption ) ) {
						$output .= '<span class="eut-description eut-small-text eut-text-' . esc_attr( $text_color ) . '">' . wp_kses_post( $custom_caption ) . '</span>';
					}
					$output .= '</figcaption>';
				} else {
					$output .= '<figcaption></figcaption>';
				}
				$output .= '</figure>';
			}

		} else {
			$output .= $image_html;
		}

		$output .= '  </div>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'crocal_single_image', 'crocal_ext_vce_single_image_shortcode' );

}

/**
* Add shortcode to Page Builder
*/

if( !function_exists( 'crocal_ext_vce_single_image_shortcode_params' ) ) {
	function crocal_ext_vce_single_image_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Single Image", "crocal-extension" ),
			"description" => esc_html__( "Image or Video popup in various uses", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-single-image",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Type", "crocal-extension" ),
					"param_name" => "image_type",
					"value" => array(
						esc_html__( "Image", "crocal-extension" ) => 'image',
						esc_html__( "Image Link", "crocal-extension" ) => 'image-link',
						esc_html__( "Image Popup", "crocal-extension" ) => 'image-popup',
						esc_html__( "Image Video Popup", "crocal-extension" ) => 'image-video-popup',
						esc_html__( "Image With Caption", "crocal-extension" ) => 'image-caption',
						esc_html__( "Image Popup With Caption", "crocal-extension" ) => 'image-popup-caption',
						esc_html__( "Gallery Popup", "crocal-extension" ) => 'gallery-popup',
					),
					"description" => esc_html__( "Select your image type.", "crocal-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Size", "crocal-extension" ),
					"param_name" => "image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Full ( Custom )', 'crocal-extension' ) => '',
						esc_html__( 'Square Small Crop', 'crocal-extension' ) => 'square',
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
						esc_html__( 'Resize ( Extra Extra Large )', 'crocal-extension' ) => 'extra-extra-large',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
						esc_html__( 'Thumbnail', 'crocal-extension' ) => 'thumbnail',
					) ),
					'std' => '',
					"description" => esc_html__( "Select your Image Size.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Popup Size", "crocal-extension" ),
					"param_name" => "image_popup_size",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Large' , 'crocal-extension' ) => 'large',
						esc_html__( 'Extra Extra Large' , 'crocal-extension' ) => 'extra-extra-large',
						esc_html__( 'Full' , 'crocal-extension' ) => 'full',
					) ),
					"std" => 'extra-extra-large',
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-popup', 'image-popup-caption', 'gallery-popup' ) ),
					"description" => esc_html__( "Select size for your popup image.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Popup Title & Caption Visibility", "crocal-extension" ),
					"param_name" => "image_popup_title_caption",
					'value' => array(
						esc_html__( 'None' , 'crocal-extension' ) => 'none',
						esc_html__( 'Title and Caption' , 'crocal-extension' ) => 'title-caption',
						esc_html__( 'Title Only' , 'crocal-extension' ) => 'title-only',
						esc_html__( 'Caption Only' , 'crocal-extension' ) => 'caption-only',
					),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-popup', 'image-popup-caption', 'gallery-popup' ) ),
					"description" => esc_html__( "Define the visibility for your popup image title - caption.", "crocal-extension" ),
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
					"type"			=> "attach_images",
					"class"			=> "",
					"heading"		=> esc_html__( "Attach Images", "crocal-extension" ),
					"param_name"	=> "ids",
					"value" => '',
					"description"	=> esc_html__( "Select your gallery images.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'gallery-popup' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Column Space", "crocal-extension" ),
					"param_name" => "image_column_space",
					"value" => array(
						esc_html__( "Auto", "crocal-extension" ) => 'auto',
						esc_html__( "100%", "crocal-extension" ) => '100',
						esc_html__( "125%", "crocal-extension" ) => '125',
						esc_html__( "150%", "crocal-extension" ) => '150',
						esc_html__( "175%", "crocal-extension" ) => '175',
						esc_html__( "200%", "crocal-extension" ) => '200',
						esc_html__( "225%", "crocal-extension" ) => '225',
						esc_html__( "250%", "crocal-extension" ) => '250',
					),
					"description" => esc_html__( "Define the max width of the image on this column. Setting percentage larger than 100% the image overflows out of the column. Default is the image resolution.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Alignment", "crocal-extension" ),
					"param_name" => "inherit_align",
					"value" => array(
						esc_html__( "Inherit", "crocal-extension" ) => 'inherit',
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
						esc_html__( "Center", "crocal-extension" ) => 'center',
					),
					"description" => 'Inherits its value from its column text align definition.',
					"std" => 'center',
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
					"type" => "dropdown",
					"heading" => esc_html__( "Grayscale Effect", "crocal-extension" ),
					"param_name" => "grayscale_effect",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => 'none',
						esc_html__( "Grayscale Image", "crocal-extension" ) => 'grayscale-image',
						esc_html__( "Colored on Hover", "crocal-extension" ) => 'grayscale-image-hover',
					),
					"description" => esc_html__( "Choose the grayscale effect.", "crocal-extension" ),
					'std' => 'none',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Video Link", "crocal-extension" ),
					"param_name" => "video_link",
					"value" => "",
					"description" => esc_html__( "Type video URL e.g Vimeo/YouTube.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-video-popup') ),
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
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-video-popup') ),
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( "Link", "crocal-extension" ),
					"param_name" => "link",
					"value" => "",
					"description" => esc_html__( "Enter link.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-link', 'image-caption' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Link Class", "crocal-extension" ),
					"param_name" => "link_class",
					"value" => "",
					"description" => esc_html__( "Enter extra class name for your link.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-link', 'image-caption' ) ),
				),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "CSS Animation", "crocal-extension"),
					"param_name" => "animation",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Fade In", "crocal-extension" ) => "eut-fade-in",
						esc_html__( "Fade In Up", "crocal-extension" ) => "eut-fade-in-up",
						esc_html__( "Fade In Up Big", "crocal-extension" ) => "eut-fade-in-up-big",
						esc_html__( "Fade In Down", "crocal-extension" ) => "eut-fade-in-down",
						esc_html__( "Fade In Down Big", "crocal-extension" ) => "eut-fade-in-down-big",
						esc_html__( "Fade In Left", "crocal-extension" ) => "eut-fade-in-left",
						esc_html__( "Fade In Left Big", "crocal-extension" ) => "eut-fade-in-left-big",
						esc_html__( "Fade In Right", "crocal-extension" ) => "eut-fade-in-right",
						esc_html__( "Fade In Right Big", "crocal-extension" ) => "eut-fade-in-right-big",
						esc_html__( "Zoom In", "crocal-extension" ) => "eut-zoom-in",
						esc_html__( "Clipping Animation", "crocal-extension" ) => "eut-clipping-animation",
					),
					"group" => esc_html__( "Animation", 'crocal-extension' ),
					"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "CSS Animation", "crocal-extension"),
					"param_name" => "clipping_animation",
					"value" => array(
						esc_html__( "Clipping Up", "crocal-extension" ) => "eut-clipping-up",
						esc_html__( "Clipping Down", "crocal-extension" ) => "eut-clipping-down",
						esc_html__( "Clipping Left", "crocal-extension" ) => "eut-clipping-left",
						esc_html__( "Clipping Right", "crocal-extension" ) => "eut-clipping-right",
						esc_html__( "Colored Clipping Up", "crocal-extension" ) => "eut-colored-clipping-up",
						esc_html__( "Colored Clipping Down", "crocal-extension" ) => "eut-colored-clipping-down",
						esc_html__( "Colored Clipping Left", "crocal-extension" ) => "eut-colored-clipping-left",
						esc_html__( "Colored Clipping Right", "crocal-extension" ) => "eut-colored-clipping-right",
					),
					"group" => esc_html__( "Animation", 'crocal-extension' ),
					"dependency" => array( 'element' => "animation", 'value' => array( 'eut-clipping-animation' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Clipping Color", "crocal-extension" ),
					"param_name" => "clipping_animation_colors",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Dark", "crocal-extension" ) => 'dark',
						esc_html__( "Light", "crocal-extension" ) => 'light',
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
						esc_html__( "Grey", "crocal-extension" ) => 'grey',
					),
					"description" => esc_html__( "Select clipping color", "crocal-extension" ),
					"group" => esc_html__( "Animation", 'crocal-extension' ),
					"dependency" => array( 'element' => "clipping_animation", 'value' => array( 'eut-colored-clipping-up', 'eut-colored-clipping-down', 'eut-colored-clipping-left', 'eut-colored-clipping-right' ) ),
				),
				array(
					"type" => "textfield",
					'edit_field_class' => 'vc_col-sm-6',
					"heading" => esc_html__('Css Animation Delay', 'crocal-extension'),
					"param_name" => "animation_delay",
					"value" => '200',
					"description" => esc_html__( "Add delay in milliseconds.", "crocal-extension" ),
					"group" => esc_html__( "Animation", 'crocal-extension' ),
					"dependency" => array( 'element' => "animation", 'value_not_equal_to' => array( '' ) ),
				),
				array(
					"type" => "dropdown",
					'edit_field_class' => 'vc_col-sm-6',
					"heading" => esc_html__( "CSS Animation Duration", "crocal-extension"),
					"param_name" => "animation_duration",
					"value" => array(
						esc_html__( "Very Fast", "crocal-extension" ) => "very-fast",
						esc_html__( "Fast", "crocal-extension" ) => "fast",
						esc_html__( "Normal", "crocal-extension" ) => "normal",
						esc_html__( "Slow", "crocal-extension" ) => "slow",
						esc_html__( "Very Slow", "crocal-extension" ) => "very-slow",
					),
					"std" => 'normal',
					"description" => esc_html__("Select the duration for your animated element.", 'crocal-extension' ),
					"group" => esc_html__( "Animation", 'crocal-extension' ),
					"dependency" => array( 'element' => "animation", 'value_not_equal_to' => array( 'eut-clipping-animation', '' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Title Tag", "crocal-extension" ),
					"param_name" => "title_heading_tag",
					"value" => array(
						esc_html__( "h1", "crocal-extension" ) => 'h1',
						esc_html__( "h2", "crocal-extension" ) => 'h2',
						esc_html__( "h3", "crocal-extension" ) => 'h3',
						esc_html__( "h4", "crocal-extension" ) => 'h4',
						esc_html__( "h5", "crocal-extension" ) => 'h5',
						esc_html__( "h6", "crocal-extension" ) => 'h6',
						esc_html__( "div", "crocal-extension" ) => 'div',
					),
					"description" => esc_html__( "Title Tag for SEO", "crocal-extension" ),
					"std" => 'h3',
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-caption', 'image-popup-caption' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Title Size/Typography", "crocal-extension" ),
					"param_name" => "title_heading",
					"value" => array(
						esc_html__( "h1", "crocal-extension" ) => 'h1',
						esc_html__( "h2", "crocal-extension" ) => 'h2',
						esc_html__( "h3", "crocal-extension" ) => 'h3',
						esc_html__( "h4", "crocal-extension" ) => 'h4',
						esc_html__( "h5", "crocal-extension" ) => 'h5',
						esc_html__( "h6", "crocal-extension" ) => 'h6',
						esc_html__( "Leader Text", "crocal-extension" ) => 'leader-text',
						esc_html__( "Subtitle Text", "crocal-extension" ) => 'subtitle-text',
						esc_html__( "Small Text", "crocal-extension" ) => 'small-text',
						esc_html__( "Link Text", "crocal-extension" ) => 'link-text',
					),
					"description" => esc_html__( "Title size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
					"std" => 'h3',
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-caption', 'image-popup-caption' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Custom Font Family", "crocal-extension" ),
					"param_name" => "title_custom_font_family",
					"value" => array(
						esc_html__( "Same as Typography", "crocal-extension" ) => '',
						esc_html__( "Custom Font Family 1", "crocal-extension" ) => 'custom-font-1',
						esc_html__( "Custom Font Family 2", "crocal-extension" ) => 'custom-font-2',
						esc_html__( "Custom Font Family 3", "crocal-extension" ) => 'custom-font-3',
						esc_html__( "Custom Font Family 4", "crocal-extension" ) => 'custom-font-4',

					),
					"description" => esc_html__( "Select a different font family, defined in Theme Options - Typography Options - Extras - Custom Font Family", "crocal-extension" ),
					"std" => '',
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-caption', 'image-popup-caption' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", "crocal-extension" ),
					"param_name" => "custom_title",
					"value" => "",
					"description" => esc_html__( "Enter your title.", "crocal-extension" ),
					"admin_label" => true,
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-caption', 'image-popup-caption' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__( "Caption", "crocal-extension" ),
					"param_name" => "custom_caption",
					"value" => "",
					"description" => esc_html__( "Enter your caption.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-caption', 'image-popup-caption' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Style - Hovers", "crocal-extension" ),
					"param_name" => "image_hover_style",
					'value' => array(
						esc_html__( 'Content Below Image' , 'crocal-extension' ) => 'hover-style-1',
						esc_html__( 'Top Down Animated Content' , 'crocal-extension' ) => 'hover-style-2',
						esc_html__( 'Left Right Animated Content' , 'crocal-extension' ) => 'hover-style-3',
						esc_html__( 'Static Box Content' , 'crocal-extension' ) => 'hover-style-4',
						esc_html__( 'Animated Box Content' , 'crocal-extension' ) => 'hover-style-5',
						esc_html__( 'Gradient Overlay' , 'crocal-extension' ) => 'hover-style-6',
						esc_html__( 'Animated Right Corner Box Content' , 'crocal-extension' ) => 'hover-style-7',
					),
					"description" => esc_html__( "Select the hover style for the image.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-caption', 'image-popup-caption' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Content Background Color", "crocal-extension" ),
					"param_name" => "content_bg_color",
					'value' => array(
						esc_html__( 'White' , 'crocal-extension' ) => 'white',
						esc_html__( 'Black' , 'crocal-extension' ) => 'black',
					),
					"description" => esc_html__( "Select the background color for image item content.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_hover_style", 'value' => array( 'hover-style-4', 'hover-style-5', 'hover-style-7' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Zoom Effect", "crocal-extension" ),
					"param_name" => "zoom_effect",
					"value" => array(
						esc_html__( "Zoom In", "crocal-extension" ) => 'in',
						esc_html__( "Zoom Out", "crocal-extension" ) => 'out',
						esc_html__( "None", "crocal-extension" ) => 'none',
					),
					"description" => esc_html__( "Choose the image zoom effect.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-caption', 'image-popup-caption' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Overlay Color", "crocal-extension" ),
					"param_name" => "overlay_color",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Dark", "crocal-extension" ) => 'dark',
						esc_html__( "Light", "crocal-extension" ) => 'light',
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
						esc_html__( "Grey", "crocal-extension" ) => 'grey',
						esc_html__( "Dark Grey", "crocal-extension" ) => 'dark-grey',
						esc_html__( "Light Grey", "crocal-extension" ) => 'light-grey',
					),
					"description" => esc_html__( "Choose the image color overlay.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-caption', 'image-popup-caption' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Overlay Opacity", "crocal-extension" ),
					"param_name" => "overlay_opacity",
					"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
					"std" => '60',
					"description" => esc_html__( "Choose the opacity for the overlay.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-caption', 'image-popup-caption' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_single_image', 'crocal_ext_vce_single_image_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_single_image_shortcode_params( 'crocal_single_image' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
