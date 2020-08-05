<?php
/**
 * Media Box Shortcode
 */

if( !function_exists( 'crocal_ext_vce_media_box_shortcode' ) ) {

	function crocal_ext_vce_media_box_shortcode( $atts, $content ) {
		global $wp_embed;
		$output = $data = $retina_data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'media_type' => 'image',
					'image_mode' => '',
					'image' => '',
					'retina_image' => '',
					'shadow' => '',
					'radius' => '',
					'zoom_effect' => 'none',
					'overlay_color' => 'light',
					'overlay_opacity' => '90',
					'text_style' => 'none',
					'video_popup' => '',
					'video_link' => '',
					'video_icon_color' => 'primary-1',
					'map_lat' => '51.516221',
					'map_lng' => '-0.136986',
					'map_height' => '280',
					'map_marker' => '',
					'map_zoom' => '14',
					'map_disable_style' => 'no',
					'title_link' => '',
					'read_more_title' => '',
					'align' => 'left',
					'add_icon' => '',
					'icon_library' => 'fontawesome',
					'icon_fontawesome' => 'fa fa-info-circle',
					'icon_openiconic' => 'vc-oi vc-oi-dial',
					'icon_typicons' => 'typcn typcn-adjust-brightness',
					'icon_entypo' => 'entypo-icon entypo-icon-note',
					'icon_linecons' => 'vc_li vc_li-heart',
					'icon_simplelineicons' => 'smp-icon-user',
					'icon_etlineicons' => 'et-icon-mobile',
					'icon_bg_color' => 'green',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$has_link = crocal_ext_vce_has_link( $title_link );

		if( 'yes' == $add_icon ) {
			$icon_class = isset( ${"icon_" . $icon_library} ) ? esc_attr( ${"icon_" . $icon_library} ) : 'fa fa-adjust';
			if ( function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
				vc_icon_element_fonts_enqueue( $icon_library );
			}
		}

		$media_box_classes = array( 'eut-element', 'eut-box', 'eut-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $media_box_classes, 'eut-animated-item' );
			array_push( $media_box_classes, $animation);
			array_push( $media_box_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $media_box_classes, $el_class);
		}
		if ( $has_link ) {
			array_push( $media_box_classes, 'eut-has-link');
		}
		$media_box_classe_string = implode( ' ', $media_box_classes );

		// Media Classes
		$media_classes = array( 'eut-media' );
		if ( !empty( $shadow ) ) {
			array_push( $media_classes, 'eut-' . $shadow);
			array_push( $media_classes, 'eut-with-shadow');
		}
		if ( !empty( $radius ) ) {
			array_push( $media_classes, 'eut-' . $radius);
		}

		$media_class_string = implode( ' ', $media_classes );

		// Paragraph
		$text_style_class = '';
		if ( 'none' != $text_style ) {
			$text_style_class = 'eut-' .$text_style;
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $media_box_classe_string ) . '" style="' . $style . '"' . $data . '>';


		switch( $media_type ) {
			case 'image':
			case 'image-video-popup':
				if ( !empty( $image ) ) {

					$image_mode_size = crocal_ext_vce_get_image_size( $image_mode );

					$img_id = preg_replace('/[^\d]/', '', $image);
					$img_src = wp_get_attachment_image_src( $img_id, $image_mode_size );
					$img_url = $img_src[0];
					$image_srcset = '';
					if ( !empty( $retina_image ) ) {
						$img_retina_id = preg_replace('/[^\d]/', '', $retina_image);
						$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
						$retina_url = $img_retina_src[0];
						$image_srcset = esc_attr( $img_url ) . ' 1x,' . esc_attr( $retina_url ) . ' 2x';
						$image_html = crocal_ext_vce_get_attachment_image( $img_id, 'full' , "", array( 'srcset'=> $image_srcset, 'data-column-space' => '100' ) );
					} else {
						$image_html = crocal_ext_vce_get_attachment_image( $img_id, $image_mode_size, "", array( 'data-column-space' => '100' ) );
					}
				} else {
					$image_html = crocal_ext_vce_get_fallback_image( 'medium' );
				}

				if ( 'image-video-popup' == $media_type && !empty( $video_link ) ) {
					$output .= '<a class="eut-video-popup" href="' . esc_url( $video_link ) . '">';
					if( 'yes' == $add_icon ) {
						$output .= '<div class="eut-media-box-icon eut-bg-'. esc_attr( $icon_bg_color ) . '"><i class="'. esc_attr( $icon_class ) . '"></i></div>';
					}
					$output .= '	<div class="' . esc_attr( $media_class_string ) . '">';
					$output .= '		<figure class="eut-image-hover eut-zoom-' . esc_attr( $zoom_effect ) . '">';
					$output .= crocal_ext_vce_get_video_icon( $video_icon_color );
					$output .= '			<div class="eut-bg-' . esc_attr( $overlay_color ) . ' eut-hover-overlay eut-opacity-' . esc_attr( $overlay_opacity ) . '"></div>';
					$output .= $image_html;
					$output .= '		</figure>';
					$output .= '	</div>';
					$output .= '</a>';
				} else {
					if ( $has_link ) {
						$link_attributes = crocal_ext_vce_get_link_attributes( $title_link );
						$output .= '<a ' . implode( ' ', $link_attributes ) . '>';
					}
					if( 'yes' == $add_icon ) {
						$output .= '<div class="eut-media-box-icon eut-bg-'. esc_attr( $icon_bg_color ) . '"><i class="'. esc_attr( $icon_class ) . '"></i></div>';
					}
					$output .= '<div class="' . esc_attr( $media_class_string ) . '">';
					$output .= '	<figure class="eut-image-hover eut-zoom-' . esc_attr( $zoom_effect ) . '">';
					$output .= '		<div class="eut-bg-' . esc_attr( $overlay_color ) . ' eut-hover-overlay eut-opacity-' . esc_attr( $overlay_opacity ) . '"></div>';
					$output .= $image_html;
					$output .= '	</figure>';
					$output .= '</div>';
					if ( $has_link ) {
						$output .= '</a>';
					}
				}
				break;
			case 'video':
				if ( !empty( $video_link ) ) {
					$output .= '<div class="' . esc_attr( $media_class_string ) . '">';
					$output .= $wp_embed->run_shortcode( '[embed]' . $video_link . '[/embed]' );
					$output .= '</div>';
				}
				break;
			case 'map':
				wp_enqueue_script( 'crocal-eutf-maps-script');
				if ( empty( $map_marker ) ) {
					$map_marker = get_template_directory_uri() . '/images/markers/markers.png';
				} else {
					$id = preg_replace('/[^\d]/', '', $map_marker);
					$full_src = wp_get_attachment_image_src( $id, 'full' );
					$map_marker = $full_src[0];
				}
				$map_title = '';

				$data_map = 'data-lat="' . esc_attr( $map_lat ) . '" data-lng="' . esc_attr( $map_lng ) . '" data-zoom="' . esc_attr( $map_zoom ) . '" data-disable-style="' . esc_attr( $map_disable_style ) . '"';
				$output .= '<div class="' . esc_attr( $media_class_string ) . '">';
				$output .= '  <div class="eut-map" ' . $data_map . ' style="' . $style . crocal_ext_vce_build_dimension( 'height', $map_height ) . '">';
				$output .= apply_filters( 'crocal_eutf_privacy_gmap_fallback', '', $map_lat, $map_lng );
				$output .= '</div>';
				$output .= '  <div style="display:none" class="eut-map-point" data-point-lat="' . esc_attr( $map_lat ) . '" data-point-lng="' . esc_attr( $map_lng ) . '" data-point-marker="' . esc_attr( $map_marker ) . '" data-point-title="' . esc_attr( $map_title ) . '"></div>';
				$output .= '</div>';
				break;
			default :
				break;
		}


		$output .= '  <div class="eut-box-content">';
		if ( !empty( $title ) ) {

			$title_classes = array( 'eut-box-title' );
			$title_classes[]  = 'eut-' . $heading;
			if ( !empty( $custom_font_family ) ) {
				$title_classes[]  = 'eut-' . $custom_font_family;
			}
			$title_class_string = implode( ' ', $title_classes );

			if ( $has_link ) {
			$link_attributes = crocal_ext_vce_get_link_attributes( $title_link );
			$output .= '<a ' . implode( ' ', $link_attributes ) . '>';
			}
			$output .= '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">' . $title. '</' . tag_escape( $heading_tag ) . '>';
			if ( !empty( $title_link ) ) {
			$output .= '    </a>';
			}
		}

		$output .= '    <p class="' . esc_attr( $text_style_class ) . '">' . do_shortcode( $content ) . '</p>';
		if ( !empty( $read_more_title ) && $has_link ) {
			$link_class_string = 'eut-link-text eut-read-more';
			$link_attributes = crocal_ext_vce_get_link_attributes( $title_link, $link_class_string );
			$output .= '<a ' . implode( ' ', $link_attributes ) . '>';
			$output .=  $read_more_title ;
			$output .= '</a>';
		}
		$output .= '  </div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'crocal_media_box', 'crocal_ext_vce_media_box_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_media_box_shortcode_params' ) ) {
	function crocal_ext_vce_media_box_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Media Box", "crocal-extension" ),
			"description" => esc_html__( "Image, Video or Map combined with text", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-media-box",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Media type", "crocal-extension" ),
					"param_name" => "media_type",
					"value" => array(
						esc_html__( "Image", "crocal-extension" ) => 'image',
						esc_html__( "Image - Video Popup", "crocal-extension" ) => 'image-video-popup',
						esc_html__( "Video", "crocal-extension" ) => 'video',
						esc_html__( "Map", "crocal-extension" ) => 'map',
					),
					"description" => esc_html__( "Select your media type.", "crocal-extension" ),
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
					"dependency" => array( 'element' => "media_type", 'value' => array( 'image', 'image-video-popup' ) ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Image", "crocal-extension" ),
					"param_name" => "image",
					"value" => '',
					"description" => esc_html__( "Select an image.", "crocal-extension" ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'image', 'image-video-popup' ) ),
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
					"type" => "dropdown",
					"heading" => esc_html__( "Image Zoom Effect", "crocal-extension" ),
					"param_name" => "zoom_effect",
					"value" => array(
						esc_html__( "Zoom In", "crocal-extension" ) => 'in',
						esc_html__( "Zoom Out", "crocal-extension" ) => 'out',
						esc_html__( "None", "crocal-extension" ) => 'none',
					),
					"description" => esc_html__( "Choose the image zoom effect.", "crocal-extension" ),
					'std' => 'none',
					"dependency" => array( 'element' => "media_type", 'value' => array( 'image', 'image-video-popup' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Overlay Color", "crocal-extension" ),
					"param_name" => "overlay_color",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Light", "crocal-extension" ) => 'light',
						esc_html__( "Dark", "crocal-extension" ) => 'dark',
						esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
						esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
						esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
						esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
						esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
						esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
					),
					"description" => esc_html__( "Choose the image color overlay.", "crocal-extension" ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'image', 'image-video-popup' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Overlay Opacity", "crocal-extension" ),
					"param_name" => "overlay_opacity",
					"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
					"std" => '90',
					"description" => esc_html__( "Choose the opacity for the overlay.", "crocal-extension" ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'image', 'image-video-popup' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Video Link", "crocal-extension" ),
					"param_name" => "video_link",
					"value" => "",
					"description" => esc_html__( "Type video URL e.g Vimeo/YouTube.", "crocal-extension" ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'image-video-popup', 'video' ) ),
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
					"dependency" => array( 'element' => "media_type", 'value' => array( 'image-video-popup', 'video' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Map Latitude", "crocal-extension" ),
					"param_name" => "map_lat",
					"value" => "51.516221",
					"description" => esc_html__( "Type map Latitude.", "crocal-extension" ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'map' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Map Longtitude", "crocal-extension" ),
					"param_name" => "map_lng",
					"value" => "-0.136986",
					"description" => esc_html__( "Type map Longtitude.", "crocal-extension" ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'map' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Map Zoom", "crocal-extension" ),
					"param_name" => "map_zoom",
					"value" => array( '1', '2', '3' ,'4', '5', '6', '7', '8' ,'9' ,'10' ,'11' ,'12', '13', '14', '15', '16', '17', '18', '19' ),
					"std" => '14',
					"description" => esc_html__( "Zoom of the map.", "crocal-extension" ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'map' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Map Height", "crocal-extension" ),
					"param_name" => "map_height",
					"value" => "280",
					"description" => esc_html__( "Type map height.", "crocal-extension" ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'map' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Disable Custom Style", "crocal-extension" ),
					"param_name" => "map_disable_style",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => 'no',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"description" => esc_html__( "Select if you want to disable custom map style.", "crocal-extension" ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'map' ) ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Custom marker", "crocal-extension" ),
					"param_name" => "map_marker",
					"value" => '',
					"description" => esc_html__( "Select an icon for custom marker.", "crocal-extension" ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'map' ) ),
				),
				crocal_ext_vce_add_shadow(),
				crocal_ext_vce_add_radius(),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", "crocal-extension" ),
					"param_name" => "title",
					"value" => "Sample Title",
					"description" => esc_html__( "Enter your title.", "crocal-extension" ),
					"save_always" => true,
					"admin_label" => true,
				),
				crocal_ext_vce_get_heading_tag( "h3" ),
				crocal_ext_vce_get_heading( "h3" ),
				crocal_ext_vce_get_custom_font_family(),
				array(
					"type" => "textarea",
					"heading" => esc_html__( "Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "Sample Text",
					"description" => esc_html__( "Enter your text.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Text Style", "crocal-extension" ),
					"param_name" => "text_style",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => '',
						esc_html__( "Leader", "crocal-extension" ) => 'leader-text',
						esc_html__( "Subtitle", "crocal-extension" ) => 'subtitle',
						esc_html__( "Small Text", "crocal-extension" ) => 'small-text',
					),
					"description" => 'Select your text style',
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( "Title Link", "crocal-extension" ),
					"param_name" => "title_link",
					"value" => "",
					"description" => esc_html__( "Enter title link.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Read More Title", "crocal-extension" ),
					"param_name" => "read_more_title",
					"value" => "",
					"description" => esc_html__( "Enter your title for your link.", "crocal-extension" ),
				),
				crocal_ext_vce_add_align(),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Add icon?", "crocal-extension" ),
					"param_name" => "add_icon",
					"value" => array( esc_html__( "Select if you want to show an icon", "crocal-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "media_type", 'value' => array( 'image', 'image-video-popup' ) ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'crocal-extension' ),
					'value' => array(
						esc_html__( 'Font Awesome', 'crocal-extension' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'crocal-extension' ) => 'openiconic',
						esc_html__( 'Typicons', 'crocal-extension' ) => 'typicons',
						esc_html__( 'Entypo', 'crocal-extension' ) => 'entypo',
						esc_html__( 'Linecons', 'crocal-extension' ) => 'linecons',
						esc_html__( 'Simple Line Icons', 'crocal-extension' ) => 'simplelineicons',
						esc_html__( 'Elegant Line Icons', 'crocal-extension' ) => 'etlineicons',
					),
					'param_name' => 'icon_library',
					'description' => esc_html__( 'Select icon library.', 'crocal-extension' ),
					"dependency" => array( 'element' => "add_icon", 'value' => array( 'yes' ) ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'crocal-extension' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-info-circle',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'crocal-extension' ),
					'param_name' => 'icon_openiconic',
					'value' => 'vc-oi vc-oi-dial',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'openiconic',
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'openiconic',
					),
					'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'crocal-extension' ),
					'param_name' => 'icon_typicons',
					'value' => 'typcn typcn-adjust-brightness',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'typicons',
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'crocal-extension' ),
					'param_name' => 'icon_entypo',
					'value' => 'entypo-icon entypo-icon-note',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'entypo',
						'iconsPerPage' => 300, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'crocal-extension' ),
					'param_name' => 'icon_linecons',
					'value' => 'vc_li vc_li-heart',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'linecons',
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'linecons',
					),
					'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'crocal-extension' ),
					'param_name' => 'icon_simplelineicons',
					'value' => 'smp-icon-user',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'simplelineicons',
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'simplelineicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'crocal-extension' ),
					'param_name' => 'icon_etlineicons',
					'value' => 'et-icon-mobile',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'etlineicons',
						'iconsPerPage' => 100,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'etlineicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Background Color", "crocal-extension" ),
					"param_name" => "icon_bg_color",
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
					"description" => esc_html__( "Background color of the box.", "crocal-extension" ),
					"dependency" => array( 'element' => "add_icon", 'value' => array( 'yes' ) ),
					'std' => 'green',
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
	vc_lean_map( 'crocal_media_box', 'crocal_ext_vce_media_box_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_media_box_shortcode_params( 'crocal_media_box' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
