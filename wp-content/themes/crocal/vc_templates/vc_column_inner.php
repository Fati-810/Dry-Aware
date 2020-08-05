<?php

	$output = $out_pattern = $out_overlay = $out_image_bg = $out_video_bg = '';

	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
	$combined_atts = $atts;
	extract( $atts );

	switch( $width ) {
		case '1/12':
			$shortcode_column = '1-12';
			break;
		case '1/6':
			$shortcode_column = '1-6';
			break;
		case '1/4':
			$shortcode_column = '1-4';
			break;
		case '1/3':
			$shortcode_column = '1-3';
			break;
		case '5/12':
			$shortcode_column = '5-12';
			break;
		case '1/2':
			$shortcode_column = '1-2';
			break;
		case '7/12':
			$shortcode_column = '7-12';
			break;
		case '2/3':
		case '4/6':
			$shortcode_column = '2-3';
			break;
		case '3/4':
			$shortcode_column = '3-4';
			break;
		case '5/6':
			$shortcode_column = '5-6';
			break;
		case '11/12':
			$shortcode_column = '11-12';
			break;
		case '1/5':
			$shortcode_column = '1-5';
			break;
		case '2/5':
			$shortcode_column = '2-5';
			break;
		case '3/5':
			$shortcode_column = '3-5';
			break;
		case '4/5':
			$shortcode_column = '4-5';
			break;
		case '1/1':
		default :
			$shortcode_column = '1';
			break;
	}

	$column_classes = array( 'eut-column-inner', 'wpb_column', 'eut-bookmark' );
	$column_classes[] = 'eut-column-' . $shortcode_column;

	if ( !empty ( $rc_heading_color ) ) {
		$column_classes[] = 'eut-headings-' . $rc_heading_color;
	}

	if( empty ( $rc_link_color ) ) {
		$rc_link_color = 'default';
	}

	if( empty ( $rc_link_hover_color ) ) {
		$rc_link_hover_color = 'default';
	}

	if( 'default' != $rc_link_color || 'default' != $rc_link_hover_color ) {
		$column_classes[] = 'eut-link-' . $rc_link_color;
		$column_classes[] = 'eut-link-hover-' . $rc_link_hover_color;
	}

	if( 'yes' == $full_height ) {
		$column_classes[] = 'eut-column-fullheight';
	}

	if( !empty ( $expand_column_bg ) ) {
		$column_classes[] = 'eut-expand-bg';
		$column_classes[] = 'eut-' . $expand_column_bg;
	}
	if( !empty ( $tablet_expand_column_bg ) ) {
		$column_classes[] = 'eut-tablet-landscape-reset-expand-bg';
	}
	if( !empty ( $tablet_sm_expand_column_bg ) ) {
		$column_classes[] = 'eut-tablet-portrait-reset-expand-bg';
	}
	if( !empty ( $mobile_expand_column_bg ) ) {
		$column_classes[] = 'eut-mobile-reset-expand-bg';
	}

	//Color Overlay
	if ( 'image' == $rc_bg_type || 'hosted_video' == $rc_bg_type || 'video' == $rc_bg_type  ) {

		if ( !empty ( $rc_bg_color_overlay ) && 'custom' != $rc_bg_color_overlay && 'gradient' != $rc_bg_color_overlay  ) {

			//Overlay Classes
			$overlay_classes = array();
			$overlay_classes[] = 'eut-bg-overlay eut-bg-' . $rc_bg_color_overlay;
			if ( !empty ( $rc_bg_opacity_overlay ) ) {
				$overlay_classes[] = 'eut-opacity-' . $rc_bg_opacity_overlay;
			}
			$overlay_string = implode( ' ', $overlay_classes );
			$out_overlay .= '  <div class="' . esc_attr( $overlay_string ) .'"></div>';
		}

		//Custom - Gradient
		if ( 'custom' == $rc_bg_color_overlay ||  'gradient' == $rc_bg_color_overlay ) {
			$overlay_attributes = array();
			if ( 'custom' == $rc_bg_color_overlay ) {
				$overlay_style = crocal_eutf_build_shortcode_style(
					array(
						'bg_color' => $rc_bg_color_overlay_custom,
					)
				);
			} else { //gradient
				$overlay_style = crocal_eutf_build_shortcode_style(
					array(
						'bg_color' => $rc_bg_gradient_overlay_custom_1,
						'bg_gradient_color_1' => $rc_bg_gradient_overlay_custom_1,
						'bg_gradient_color_2' => $rc_bg_gradient_overlay_custom_2,
						'bg_gradient_direction' => $rc_bg_gradient_overlay_direction,
					)
				);
			}
			$overlay_attributes[] = $overlay_style;
			$overlay_attributes[] = 'class="eut-bg-overlay"';
			$out_overlay .= '<div ' . implode( ' ', $overlay_attributes ) . '></div>';
		}
	}
	// Pattern Overlay
	if ( !empty ( $rc_bg_pattern_overlay ) ) {
		$out_pattern .= '  <div class="eut-pattern"></div>';
	}

	//Background Image Classes
	$bg_image_classes = array( 'eut-bg-image' );
	if( 'horizontal-parallax-lr' == $rc_bg_image_type || 'horizontal-parallax-rl' == $rc_bg_image_type || 'horizontal' == $rc_bg_image_type ){
		$bg_image_classes[] = 'eut-bg-center-' . $rc_bg_image_vertical_position;
	}
	if( '' == $rc_bg_image_type || 'none' == $rc_bg_image_type || 'pattern' == $rc_bg_image_type ){
		$bg_image_classes[] = 'eut-bg-' . $rc_bg_position;
		if ( !empty( $rc_bg_tablet_sm_position ) ) {
			$bg_image_classes[] = 'eut-bg-tablet-sm-' . $rc_bg_tablet_sm_position;
		}
	}
	if( $rc_bg_image > 0 ){
		$bg_image_classes[] = 'eut-bg-image-id-' . $rc_bg_image ;
	}
	$bg_image_string = implode( ' ', $bg_image_classes );

	//Background Image
	$img_style = crocal_eutf_build_shortcode_img_style( $rc_bg_image ,$rc_bg_image_size );
	if ( ( 'image' == $rc_bg_type || 'hosted_video' == $rc_bg_type || 'video' == $rc_bg_type ) && !empty ( $rc_bg_image ) ) {
		$out_image_bg .= '  <div class="' . esc_attr( $bg_image_string ) . '"  ' . $img_style . '></div>';
	}

	//Background Video
	if ( 'hosted_video' == $rc_bg_type && ( !empty ( $rc_bg_video_webm ) || !empty ( $rc_bg_video_mp4 ) || !empty ( $rc_bg_video_ogv ) ) ) {

		$has_video_bg = true;
		$video_poster = $playsinline = '';
		$muted = 'yes';
		if ( wp_is_mobile() ) {
			if ( 'yes' == $rc_bg_video_device ) {
				$video_poster = crocal_eutf_vc_shortcode_img_url( $rc_bg_image ,$rc_bg_image_size );
				$muted = 'yes';
				$playsinline = 'yes';
			} else {
				$has_video_bg = false;
			}
		}
		if ( $has_video_bg ) {
			$video_settings = array(
				'preload' => 'auto',
				'autoplay' => 'yes',
				'loop' => $rc_bg_video_loop,
				'muted' => $muted,
				'poster' => $video_poster,
				'playsinline' => $playsinline,
			);
			$out_video_bg .= '<div class="eut-bg-video eut-html5-bg-video" data-video-device="' . esc_attr( $rc_bg_video_device ) .'">';
			$out_video_bg .= '<video data-autoplay ' . crocal_eutf_print_media_video_settings( $video_settings ) . '>';
			if ( !empty ( $rc_bg_video_webm ) ) {
				$out_video_bg .=  '<source src="' . esc_url( $rc_bg_video_webm ) . '" type="video/webm">';
			}
			if ( !empty ( $rc_bg_video_mp4 ) ) {
				$out_video_bg .=  '<source src="' . esc_url( $rc_bg_video_mp4 ) . '" type="video/mp4">';
			}
			if ( !empty ( $rc_bg_video_ogv ) ) {
				$out_video_bg .=  '<source src="' . esc_url( $rc_bg_video_ogv ) . '" type="video/ogg">';
			}
			$out_video_bg .= '</video>';
			$out_video_bg .= '</div>';
		}
	}

	//YouTube/Vimeo Video
	$out_video_bg_url = '';
	$has_video_bg = ( 'video' == $rc_bg_type && ! empty( $rc_bg_video_url ) );
	if ( $has_video_bg ) {
		if ( crocal_eutf_extract_youtube_id( $rc_bg_video_url ) ) {
			wp_enqueue_script( 'youtube-iframe-api' );
			$out_video_bg_url .= '<div class="eut-bg-video eut-yt-bg-video" data-video-bg-url="' . esc_attr( $rc_bg_video_url ) . '"></div>';
			if ( !empty( $rc_bg_video_button ) ) {
				$out_video_bg_url .= '<a class="eut-video-popup eut-bg-video-button-' . esc_attr( $rc_bg_video_button ) . '" href="' . esc_url( $rc_bg_video_url ) . '">';
				$out_video_bg_url .= crocal_eutf_get_video_icon( 'white', $rc_bg_video_button_position );
				$out_video_bg_url .= '</a>';
			}
		} else {
			wp_enqueue_script( 'vimeo-api' );
			$wrapper_attributes = array();
			$wrapper_attributes[] = 'id="' . esc_attr( uniqid('vimeo-') ) . '"';
			$wrapper_attributes[] = 'data-vimeo-url="' . esc_attr( $rc_bg_video_url ) . '"';
			$wrapper_attributes[] = 'data-vimeo-autoplay="true"';
			$wrapper_attributes[] = 'data-vimeo-autopause="false"';
			$wrapper_attributes[] = 'data-vimeo-loop="true"';
			$wrapper_attributes[] = 'data-vimeo-background="true"';
			$wrapper_attributes[] = 'data-vimeo-muted="true"';

			$wrapper_attributes[] = 'class="eut-bg-video eut-vimeo-bg-video"';
			$out_video_bg_url .= '<div '. implode( ' ', $wrapper_attributes ) . '></div>';
			if ( !empty( $rc_bg_video_button ) ) {
				$out_video_bg_url .= '<a class="eut-video-popup eut-bg-video-button-' . esc_attr( $rc_bg_video_button ) . '" href="' . esc_url( $rc_bg_video_url ) . '">';
				$out_video_bg_url .= crocal_eutf_get_video_icon( 'white', $rc_bg_video_button_position );
				$out_video_bg_url .= '</a>';
			}
		}
	}
	$css_custom = crocal_eutf_vc_shortcode_custom_css_class( $css, '' );


	if( vc_settings()->get( 'not_responsive_css' ) != '1') {

		if ( !empty( $desktop_hide ) ) {
			$column_classes[] = 'eut-desktop-column-' . $desktop_hide;
		}
		if ( !empty( $tablet_width ) ) {
			$column_classes[] = 'eut-tablet-column-' . $tablet_width;
		}
		if ( !empty( $tablet_sm_width ) ) {
			$column_classes[] = 'eut-tablet-sm-column-' . $tablet_sm_width;
		} else {
			if ( !empty( $tablet_width ) ) {
				$column_classes[] = 'eut-tablet-sm-column-' . $tablet_width;
			}
		}
		if ( !empty( $mobile_width ) ) {
			$column_classes[] = 'eut-mobile-column-' . $mobile_width;
		}
	}

	if ( !empty ( $responsive_class ) ) {
		$column_classes[] = $responsive_class;
	}
	if ( $column_effect != 'none' ) {
		$column_classes[] = 'eut-parallax-effect';
	}

	$data_effect_string = '';

	switch( $column_effect ) {
		case 'vertical-parallax':
			$data_effect_string = ' data-parallax-effect="vertical-parallax" data-sensitive="' . esc_attr( $column_effect_sensitive ) . '" data-limit="' . esc_attr( $column_effect_limit ) . '" data-invert="' . esc_attr( $column_effect_invert ) . '"';
			if ( $tablet_landscape_column_effect == 'none' ) {
				$data_effect_string .= ' data-tablet-landscape-parallax-effect="none"';
			}
			if ( $tablet_portrait_column_effect == 'none' ) {
				$data_effect_string .= ' data-tablet-portrait-parallax-effect="none"';
			}
			if ( $mobile_column_effect == 'none' ) {
				$data_effect_string .= ' data-mobile-parallax-effect="none"';
			}
			break;
		case 'mouse-move-x-y':
			$data_effect_string = ' data-parallax-effect="mouse-move-x-y" data-sensitive="' . esc_attr( $column_effect_sensitive ) . '" data-limit="' . esc_attr( $column_effect_limit ) . '" data-invert="' . esc_attr( $column_effect_invert ) . '"';
			break;
		case 'mouse-move-x':
			$data_effect_string = ' data-parallax-effect="mouse-move-x" data-sensitive="' . esc_attr( $column_effect_sensitive ) . '" data-limit="' . esc_attr( $column_effect_limit ) . '" data-invert="' . esc_attr( $column_effect_invert ) . '"';
			break;
		case 'mouse-move-y':
			$data_effect_string = ' data-parallax-effect="mouse-move-y" data-sensitive="' . esc_attr( $column_effect_sensitive ) . '" data-limit="' . esc_attr( $column_effect_limit ) . '" data-invert="' . esc_attr( $column_effect_invert ) . '"';
			break;
		default:
			$data_effect_string = '';
			break;
	}


	if( $position_top != '' || $position_left != '' || $position_right != '' || $position_bottom != '' ) {
		$column_classes[] = 'eut-custom-position';
	}

	if( $tablet_landscape_column_positions == 'none' ) {
		$column_classes[] = 'eut-tablet-landscape-position-none';
	}

	if( $tablet_portrait_column_positions == 'none' ) {
		$column_classes[] = 'eut-tablet-portrait-position-none';
	}

	if( $mobile_column_positions == 'none' ) {
		$column_classes[] = 'eut-mobile-position-none';
	}

	if( $position_top != '' ) {
		$column_classes[] = 'eut-top-' . $position_top;
	}
	if( $position_left != '' ) {
		$column_classes[] = 'eut-left-' . $position_left;
	}
	if( $position_right != '' ) {
		$column_classes[] = 'eut-right-' . $position_right;
	}
	if( $position_bottom != '' ) {
		$column_classes[] = 'eut-bottom-' . $position_bottom;
	}

	if( $horizontal_content_position != 'left' ) {
		$column_classes[] = 'eut-horizontal-position-' . $horizontal_content_position;
	}

	if( $vertical_content_position != 'top' ) {
		$column_classes[] = 'eut-vertical-position-' . $vertical_content_position;
	}

	if( 'horizontal-parallax-lr' == $rc_bg_image_type || 'horizontal-parallax-rl' == $rc_bg_image_type ){
		$column_classes[] = 'eut-' . $rc_bg_image_type;
		$column_classes[] = 'eut-bg-parallax';
	} else {
		if( !empty($rc_bg_image_type) ) {
			$column_classes[] = 'eut-bg-' . $rc_bg_image_type;
		}		
	}

	if( 'reset' == $tablet_content_width ){
		$column_classes[] = 'eut-tablet-reset-content-width';
	}

	if( 'reset' == $tablet_sm_content_width ){
		$column_classes[] = 'eut-tablet-sm-reset-content-width';
	}

	if( 'reset' == $mobile_content_width ){
		$column_classes[] = 'eut-mobile-reset-content-width';
	}

	if( 'left' != $text_align ){
		$column_classes[] = 'eut-align-' . $text_align;
	}

	if( !empty ($tablet_text_align) ){
		$column_classes[] = 'eut-tablet-align-' . $tablet_text_align;
	}

	if( !empty ($tablet_sm_text_align) ){
		$column_classes[] = 'eut-tablet-sm-align-' . $tablet_sm_text_align;
	}

	if( !empty ($mobile_text_align) ){
		$column_classes[] = 'eut-mobile-align-' . $mobile_text_align;
	}

	if( !empty( $clipping_animation ) ) {
		$column_classes[] = 'eut-clipping-animation';
		$column_classes[] = 'eut-' . $clipping_animation;
	}
	if( 'colored-clipping-up' == $clipping_animation || 'colored-clipping-down' == $clipping_animation || 'colored-clipping-left' == $clipping_animation || 'colored-clipping-right' == $clipping_animation ) {
		$column_classes[] = 'eut-colored-clipping';
	}

	if ( !empty ( $el_class ) ) {
		$column_classes[] = $el_class;
	}

	$column_string = implode( ' ', $column_classes );

	$wrapper_attributes = array();
	$wrapper_attributes[] = 'class="' . esc_attr( $column_string ) . '"';

	$style = crocal_eutf_build_shortcode_style(
		array(
			'font_color' => $rc_font_color,
			'z_index' => $z_index,
		)
	);

	if ( ! empty( $el_id ) ) {
		$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
	}

	if( !empty( $style ) ) {
		$wrapper_attributes[] = $style;
	}

	if( 'parallax' == $rc_bg_image_type || 'horizontal-parallax-lr' == $rc_bg_image_type || 'horizontal-parallax-rl' == $rc_bg_image_type ){
		$wrapper_attributes[] = 'data-parallax-threshold="' . esc_attr( $rc_bg_parallax_threshold ) . '"';
	}

	if( !empty( $clipping_animation ) ) {
		$wrapper_attributes[] = ' data-delay="' . esc_attr( $animation_delay ) . '"';
	}

	if( 'colored-clipping-up' == $clipping_animation || 'colored-clipping-down' == $clipping_animation || 'colored-clipping-left' == $clipping_animation || 'colored-clipping-right' == $clipping_animation ) {
		$wrapper_attributes[] = ' data-clipping-color="' . esc_attr( $clipping_animation_colors ) . '"';
	}

	$column_wrapper_classes = array( 'eut-column-wrapper-inner' );
	if ( !empty( $css_custom ) ) {
		$column_wrapper_classes[] = $css_custom;
	}

	if ( !empty ( $el_wrapper_class ) ) {
		$column_wrapper_classes[] = $el_wrapper_class;
	}

	//Shadow
	if( 'no' != $rc_add_shadow ){
		$column_wrapper_classes[] = 'eut-' . $rc_add_shadow;
		$column_wrapper_classes[] = 'eut-with-shadow';
	}

	$column_wrapper_string = implode( ' ', $column_wrapper_classes );


	//Column wrapper
	$column_wrapper_attributes = array();
	$column_wrapper_attributes[] = 'class="' . esc_attr( $column_wrapper_string ) . '"';

	if ( 'gradient' != $rc_bg_type ) {
		$rc_bg_gradient_color_1 = $rc_bg_gradient_color_2 = $rc_bg_gradient_direction = "";
	}
	if ( 'gradient' == $rc_bg_type || 'animated-color' == $rc_bg_type ) {
		$rc_bg_color = "";
	}

	$column_style = crocal_eutf_build_shortcode_style(
		array(
			'bg_color' => $rc_bg_color,
			'bg_gradient_color_1' => $rc_bg_gradient_color_1,
			'bg_gradient_color_2' => $rc_bg_gradient_color_2,
			'bg_gradient_direction' => $rc_bg_gradient_direction,
		)
	);
	if( !empty( $column_style ) ) {
		$column_wrapper_attributes[] = $column_style;
	}

	$content_attributes = array();
	$content_style = crocal_eutf_build_shortcode_style(
		array(
			'content_width' => $content_width,
			'custom_content_width' => $custom_content_width,
		)
	);

	if( !empty( $content_style ) ) {
		$content_attributes[] = $content_style;
	}

	if ( !empty( $block_content ) && !crocal_eutf_is_privacy_key_enabled( $block_content ) ) {
		$column_content = crocal_eutf_privacy_disable_fallback( $block_content );
	} else {
		$column_content = do_shortcode( $content );
	}

	echo '<div ' . implode( ' ', $wrapper_attributes ) . ' ' . $data_effect_string . '>';
	echo '<div ' . implode( ' ', $column_wrapper_attributes ) . '>';
	echo '<div class="eut-column-inner-content" ' . implode( ' ', $content_attributes ) . '>' . $column_content . '</div>';
	echo '<div class="eut-background-wrapper">' . $out_video_bg_url . $out_image_bg . $out_video_bg . $out_overlay . $out_pattern . '</div>';
	echo '</div>';
	echo '</div>';

//Omit closing PHP tag to avoid accidental whitespace output errors.
