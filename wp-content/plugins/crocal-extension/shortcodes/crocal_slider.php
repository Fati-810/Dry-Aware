<?php
/**
 * Slider Shortcode
 */

if( !function_exists( 'crocal_ext_vce_slider_shortcode' ) ) {

	function crocal_ext_vce_slider_shortcode( $attr, $content ) {

		$output = $class_fullwidth = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'ids' => '',
					'image_mode' => 'extra-extra-large',
					'image_full_column' => '',
					'zoom_effect' => 'none',
					'slideshow_speed' => '3500',
					'navigation_type' => '1',
					'navigation_color' => 'dark',
					'pagination' => 'yes',
					'transition' => 'slide',
					'pause_hover' => 'no',
					'auto_play' => 'yes',
					'loop' => 'yes',
					'auto_height' => 'no',
					'margin_bottom' => '',
					'el_class' => '',
					'image_title_caption' => 'none',
					'image_title_heading_tag' => 'h3',
					'image_title_heading' => 'h3',
					'image_title_custom_font_family' => '',
					'image_hover_style' => 'hover-style-1',
					'image_content_bg_color' => 'white',
					'overlay_color' => 'light',
					'overlay_opacity' => '0',
					'image_link_mode' => ' none',
					'image_popup_size' => 'extra-extra-large',
					'custom_links' => '',
					'custom_links_target' => '_self',
				),
				$attr
			)
		);

		$attachments = explode( ",", $ids );

		if ( empty( $attachments ) ) {
			return '';
		}



		if( 'autocrop' == $image_mode ) {
			$image_size = 'crocal-eutf-large-rect-horizontal';
		} else {
			$image_size = crocal_ext_vce_get_image_size( $image_mode );
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$slider_data = '';
		$slider_data .= ' data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
		$slider_data .= ' data-slider-pause="' . esc_attr( $pause_hover ) . '"';
		$slider_data .= ' data-slider-autoplay="' . esc_attr( $auto_play ) . '"';
		$slider_data .= ' data-slider-loop="' . esc_attr( $loop ) . '"';
		$slider_data .= ' data-slider-transition="' . esc_attr( $transition ) . '"';
		$slider_data .= ' data-slider-autoheight="' . esc_attr( $auto_height ) . '"';
		$slider_data .= ' data-pagination-color="' . esc_attr( $navigation_color ) . '"';
		$slider_data .= ' data-pagination="' . esc_attr( $pagination ) . '"';

		$slider_classes = array( 'eut-element', 'eut-slider', 'eut-layout-1' );
		if ( 'yes' == $image_full_column ) {
			$slider_classes[] = 'eut-full-image';
		}
		if ( !empty( $el_class ) ) {
			$slider_classes[] = $el_class;
		}

		if ( 'custom_link' == $image_link_mode ) {
			$custom_links = vc_value_from_safe( $custom_links );
			$custom_links = explode( ',', $custom_links );
		} else {
			$slider_classes[] = 'eut-gallery-popup';
		}

		$slider_class_string = implode( ' ', $slider_classes );

		//Title & Caption Color
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
		} elseif( 'hover-style-4' == $image_hover_style || 'hover-style-5' == $image_hover_style || 'hover-style-7' == $image_hover_style ){
			$text_color = 'inherit';
			if( 'white' == $image_content_bg_color ){
				$title_color = 'black';
			} else {
				$title_color = 'white';
			}
		}

		$image_title_classes = array( 'eut-title' );
		$image_title_classes[]  = 'eut-' . $image_title_heading;
		$image_title_classes[]  = 'eut-text-' . $title_color;
		if ( !empty( $custom_font_family ) ) {
			$image_title_classes[]  = 'eut-' . $image_title_custom_font_family;
		}
		$image_title_class_string = implode( ' ', $image_title_classes );

		$output .= '<div class="' . esc_attr( $slider_class_string ) . '"  style="' . $style . ' ">';
		$output .= '  <div class="eut-carousel-wrapper">';


		//Slider Navigation
		$output .= crocal_ext_vce_element_navigation( $navigation_type, $navigation_color );

		$output .= '<div class="eut-slider-element owl-carousel eut-theme"' . $slider_data . '>';

		$image_popup_size_mode = crocal_ext_vce_get_image_size( $image_popup_size );

		$i = -1;
		foreach ( $attachments as $id ) {

			$i++;
			$thumb_src = wp_get_attachment_image_src( $id, $image_size );
			$full_src = wp_get_attachment_image_src( $id, $image_popup_size_mode );
			$image_title = get_post_field( 'post_title', $id );
			$image_caption = get_post_field( 'post_excerpt', $id );

			//Check Title and Caption
			$show_title = $show_caption = $show_title_or_caption = 'no';
			if ( !empty( $image_title ) && 'none' != $image_title_caption && 'caption-only' != $image_title_caption ) {
				$show_title = $show_title_or_caption = 'yes';
			}
			if ( !empty( $image_caption ) && 'none' != $image_title_caption && 'title-only' != $image_title_caption ) {
				$show_caption = $show_title_or_caption = 'yes';
			}

			if( 'no' == $show_title_or_caption ){
				$image_hover_style = 'hover-style-none';
			}

			//Image Content Classes
			$image_content_classes = array( 'eut-content' );
			if ( 'yes' == $show_title_or_caption ) {
				if( 'hover-style-7' == $image_hover_style ){
					array_push( $image_content_classes, 'eut-align-left');
				} else {
					array_push( $image_content_classes, 'eut-align-center');
				}

				if( 'hover-style-4' == $image_hover_style || 'hover-style-5' == $image_hover_style || 'hover-style-7' == $image_hover_style ){
					array_push( $image_content_classes, 'eut-box-item eut-bg-' . $image_content_bg_color );
				}
			}
			$image_content_class_string = implode( ' ', $image_content_classes );

			//Popup Link Data
			$link_data = '';
			if( 'yes' == $show_title ){
				$link_data .= ' data-title="' . esc_attr( $image_title ) . '"';
			}
			if( 'yes' == $show_caption ){
				$link_data .= ' data-desc="' . esc_attr( $image_caption ) . '"';
			}


			$output .= '<div class="eut-slider-item eut-hover-item eut-' . esc_attr( $image_hover_style ) . '">';


			//Figure
			$output .= '  <figure class="eut-image-hover eut-zoom-' . esc_attr( $zoom_effect ) . '">';

			if ( 'popup' == $image_link_mode ) {
				$output .= '    <a class="eut-item-url" href="' . esc_url( $full_src[0] ) . '" ' . $link_data . '></a>';
			} elseif ( 'custom_link' == $image_link_mode && isset( $custom_links[ $i ] ) && !empty(  $custom_links[ $i ] )  ) {
				$output .= '    <a class="eut-item-url" href="' . esc_url( $custom_links[ $i ] ) . '" target="' . esc_attr( $custom_links_target ) . '" ' . $link_data . '></a>';
			}
			if( '0' != $overlay_opacity ) {
				if ( 'hover-style-6' != $image_hover_style ){
					$output .= '<div class="eut-hover-overlay eut-bg-' . esc_attr( $overlay_color ) . ' eut-opacity-' . esc_attr( $overlay_opacity ) . '"></div>';
				} else {
					$output .= '<div class="eut-gradient-overlay eut-gradient-' . esc_attr( $overlay_color ) . ' eut-gradient-opacity-' . esc_attr( $overlay_opacity ) .'"></div>';	
				}
			}
			

			$output .= '<div class="eut-media">';
			$output .= crocal_ext_vce_get_attachment_image( $id, $image_size );
			$output .= '</div>';

			if ( 'hover-style-1' != $image_hover_style && 'yes' == $show_title_or_caption ) {
					$output .= '<figcaption class="' . esc_attr( $image_content_class_string ) . '">';
					if( 'yes' == $show_title ){
						$output .= '<' . tag_escape( $image_title_heading_tag ) .' class="' . esc_attr( $image_title_class_string ) . '">' . wptexturize( $image_title ) . '</' . tag_escape( $image_title_heading_tag ) .'>';
					}
					if( 'yes' == $show_caption ){
						$output .= '<div class="eut-description eut-text-' . esc_attr( $text_color ) . '">' . wptexturize( $image_caption ) . '</div>';
					}
					$output .= '</figcaption>';
			}

			$output .= '  </figure>';

			//Content Below Image
			if( 'hover-style-1' == $image_hover_style && 'yes' == $show_title_or_caption ){
				$output .= '<div class="' . esc_attr( $image_content_class_string ) . '">';
					if( 'yes' == $show_title ){
						$output .= '<' . tag_escape( $image_title_heading_tag ) .' class="' . esc_attr( $image_title_class_string ) . '">' . wptexturize( $image_title ) . '</' . tag_escape( $image_title_heading_tag ) .'>';
					}
					if( 'yes' == $show_caption ){
						$output .= '<div class="eut-description eut-text-content">' . wptexturize( $image_caption ) . '</div>';
					}
				$output .= '</div>';
			}


			$output .= '</div>';

		}
		$output .= '	</div>';
		$output .= '  </div>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'crocal_slider', 'crocal_ext_vce_slider_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_slider_shortcode_params' ) ) {
	function crocal_ext_vce_slider_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Slider", "crocal-extension" ),
			"description" => esc_html__( "Create a simple slider", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-slider",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type"			=> "attach_images",
					"admin_label"	=> true,
					"class"			=> "",
					"heading"		=> esc_html__( "Attach Images", "crocal-extension" ),
					"param_name"	=> "ids",
					"value" => '',
					"description"	=> esc_html__( "Select your slider images.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Mode", "crocal-extension" ),
					"param_name" => "image_mode",
					'value' => array(
						esc_html__( 'Square Small Crop', 'crocal-extension' ) => 'square',
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Landscape Medium Crop', 'crocal-extension' ) => 'landscape-medium',
						esc_html__( 'Landscape Large Wide Crop', 'crocal-extension' ) => 'landscape-large-wide',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
						esc_html__( 'Resize ( Extra Extra Large )' , 'crocal-extension' ) => 'extra-extra-large',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
					),
					"std" => 'extra-extra-large',
					"description" => esc_html__( "Select your slider image mode.", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Image Fill Column Space", "crocal-extension" ),
					"param_name" => "image_full_column",
					"value" => array( esc_html__( "If selected, image will fill the column space", "crocal-extension" ) => 'yes' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Loop", "crocal-extension" ),
					"param_name" => "loop",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Autoplay", "crocal-extension" ),
					"param_name" => "auto_play",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
				),
				crocal_ext_vce_add_slideshow_speed(),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Pause on Hover", "crocal-extension" ),
					"param_name" => "pause_hover",
					"value" => array( esc_html__( "If selected, slider will be paused on hover", "crocal-extension" ) => 'yes' ),
				),
				crocal_ext_vce_add_auto_height(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Transition", "crocal-extension" ),
					"param_name" => "transition",
					"value" => array(
						esc_html__( "Slide", "crocal-extension" ) => 'slide',
						esc_html__( "Fade", "crocal-extension" ) => 'fade',
					),
					"description" => esc_html__( "Transition Effect.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Pagination", "crocal-extension" ),
					"param_name" => "pagination",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"std" => "yes",
				),
				crocal_ext_vce_add_navigation_type(),
				crocal_ext_vce_add_navigation_color(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Title & Caption Visibility", "crocal-extension" ),
					"param_name" => "image_title_caption",
					'value' => array(
						esc_html__( 'None' , 'crocal-extension' ) => 'none',
						esc_html__( 'Title and Caption' , 'crocal-extension' ) => 'title-caption',
						esc_html__( 'Title Only' , 'crocal-extension' ) => 'title-only',
						esc_html__( 'Caption Only' , 'crocal-extension' ) => 'caption-only',
					),
					"description" => esc_html__( "Define the visibility for your image title - caption.", "crocal-extension" ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Title Tag", "crocal-extension" ),
					"param_name" => "image_title_heading_tag",
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
					"dependency" => array( 'element' => "image_title_caption", 'value' => array( 'title-caption', 'title-only' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Title Size/Typography", "crocal-extension" ),
					"param_name" => "image_title_heading",
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
					"description" => esc_html__( "Image Title size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
					"std" => 'h3',
					"dependency" => array( 'element' => "image_title_caption", 'value' => array( 'title-caption', 'title-only' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Title Custom Font Family", "crocal-extension" ),
					"param_name" => "image_title_custom_font_family",
					"value" => array(
						esc_html__( "Same as Typography", "crocal-extension" ) => '',
						esc_html__( "Custom Font Family 1", "crocal-extension" ) => 'custom-font-1',
						esc_html__( "Custom Font Family 2", "crocal-extension" ) => 'custom-font-2',
						esc_html__( "Custom Font Family 3", "crocal-extension" ) => 'custom-font-3',
						esc_html__( "Custom Font Family 4", "crocal-extension" ) => 'custom-font-4',

					),
					"description" => esc_html__( "Select a different font family, defined in Theme Options - Typography Options - Extras - Custom Font Family", "crocal-extension" ),
					"std" => '',
					"dependency" => array( 'element' => "image_title_caption", 'value' => array( 'title-caption', 'title-only' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Hovers Style", "crocal-extension" ),
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
					"description" => esc_html__( "Select the hover style for the gallery overview.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_title_caption", 'value' => array( 'title-caption', 'title-only', 'caption-only' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Content Background Color", "crocal-extension" ),
					"param_name" => "image_content_bg_color",
					'value' => array(
						esc_html__( 'White' , 'crocal-extension' ) => 'white',
						esc_html__( 'Black' , 'crocal-extension' ) => 'black',
					),
					"description" => esc_html__( "Select the background color for image content.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_hover_style", 'value' => array( 'hover-style-4', 'hover-style-5', 'hover-style-7' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
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
						esc_html__( "Green", "crocal-extension" ) => 'green',
						esc_html__( "Orange", "crocal-extension" ) => 'orange',
						esc_html__( "Red", "crocal-extension" ) => 'red',
						esc_html__( "Blue", "crocal-extension" ) => 'blue',
						esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
						esc_html__( "Purple", "crocal-extension" ) => 'purple',
					),
					"description" => esc_html__( "Choose the image color overlay.", "crocal-extension" ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Overlay Opacity", "crocal-extension" ),
					"param_name" => "overlay_opacity",
					"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
					"std" => '0',
					"description" => esc_html__( "Choose the opacity for the overlay.", "crocal-extension" ),
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
					'std' => 'none',
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Image Link Mode", "crocal-extension" ),
					"param_name" => "image_link_mode",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => 'none',
						esc_html__( "Image Popup", "crocal-extension" ) => 'popup',
						esc_html__( "Custom Link", "crocal-extension" ) => 'custom_link',
					),
					"description" => esc_html__( "Choose the image link mode.", "crocal-extension" ),
					'std' => 'none',
					"group" => esc_html__( "Extras", "crocal-extension" ),
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
					"dependency" => array( 'element' => "image_link_mode", 'value' => array( 'popup' ) ),
					"description" => esc_html__( "Select size for your popup image.", "crocal-extension" ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
					"std" => 'extra-extra-large',
				),
				array(
					'type' => 'exploded_textarea_safe',
					'heading' => __( 'Custom links', 'crocal-extension' ),
					'param_name' => 'custom_links',
					'description' => __( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'crocal-extension' ),
					'dependency' => array(
						'element' => 'image_link_mode',
						'value' => array( 'custom_link' ),
					),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Custom link target', 'crocal-extension' ),
					'param_name' => 'custom_links_target',
					'description' => __( 'Select where to open custom links.', 'crocal-extension' ),
					'dependency' => array(
						'element' => 'image_link_mode',
						'value' => array( 'custom_link' ),
					),
					"value" => array(
						esc_html__( "Same Window", "crocal-extension" ) => '_self',
						esc_html__( "New Window", "crocal-extension" ) => '_blank',
					),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_slider', 'crocal_ext_vce_slider_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_slider_shortcode_params( 'crocal_slider' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
