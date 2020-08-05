<?php

	$output = $out_pattern = $out_overlay = $out_image_bg = $out_video_bg = '';

	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
	$combined_atts = $atts;
	extract( $atts );

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

	//Section Classses
	$section_classes = array( 'eut-section', 'eut-row-section' );

	//Disable Element
	if ( 'yes' === $disable_element ) {
		if ( vc_is_page_editable() ) {
			$section_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
		} else {
			return '';
		}
	}

	// Section Type
	$section_classes[] = 'eut-' . $section_type ;

	// Extra Class
	if ( !empty ( $el_class ) ) {
		$section_classes[] = $el_class;
	}

	// Height
	if( 'auto' != $height_ratio || !empty ($min_height) ){
		$section_classes[] = 'eut-percentage-height';
		$section_classes[] = 'eut-loading-height';
	}

	// Padding
	if ( !empty ( $padding_top_multiplier ) && 'custom' != $padding_top_multiplier  ) {
		$section_classes[] = 'eut-padding-top-' . $padding_top_multiplier;
	} else if( 'custom' != $padding_top_multiplier ) {
		$padding_top ="";
	}
	if ( !empty ( $padding_bottom_multiplier ) && 'custom' != $padding_bottom_multiplier ) {
		$section_classes[] = 'eut-padding-bottom-' . $padding_bottom_multiplier;
	} else if( 'custom' != $padding_bottom_multiplier ) {
		$padding_bottom ="";
	}

	// Headings
	if ( !empty ( $rc_heading_color ) ) {
		$section_classes[] = 'eut-headings-' . $rc_heading_color;
	}

	if( empty ( $rc_link_color ) ) {
		$rc_link_color = 'default';
	}

	if( empty ( $rc_link_hover_color ) ) {
		$rc_link_hover_color = 'default';
	}

	if( 'default' != $rc_link_color || 'default' != $rc_link_hover_color ) {
		$section_classes[] = 'eut-link-' . $rc_link_color;
		$section_classes[] = 'eut-link-hover-' . $rc_link_hover_color;
	}

	//Background
	if( 'horizontal-parallax-lr' == $rc_bg_image_type || 'horizontal-parallax-rl' == $rc_bg_image_type ){
		$section_classes[] = 'eut-' . $rc_bg_image_type;
		$section_classes[] = 'eut-bg-parallax';
	} else {
		if( !empty($rc_bg_image_type) ) {
			$section_classes[] = 'eut-bg-' . $rc_bg_image_type;
		}
	}

	// Equal Columns
	if( 'equal' == $equal_column_height ) {
		$section_classes[] = 'eut-equal-columns';
	}
	if( !empty ($tablet_landscape_equal_column_height) ){
		$section_classes[] = 'eut-tablet-landscape-not-equal-columns';
	}
	if( !empty ($tablet_portrait_equal_column_height) ){
		$section_classes[] = 'eut-tablet-portrait-not-equal-columns';
	}

	// Separator
	if( !empty ( $separator_type ) ) {
		$section_classes[] = 'eut-separator-section';
	}

	// Visibility
	if( vc_settings()->get( 'not_responsive_css' ) != '1') {
		if ( !empty( $desktop_visibility ) ) {
			$section_classes[] = 'eut-desktop-row-hide';
		}
		if ( !empty( $tablet_visibility ) ) {
			$section_classes[] = 'eut-tablet-row-hide';
		}
		if ( !empty( $tablet_sm_visibility ) ) {
			$section_classes[] = 'eut-tablet-sm-row-hide';
		}
		if ( !empty( $mobile_visibility ) ) {
			$section_classes[] = 'eut-mobile-row-hide';
		}
	}

	//Shadow
	if( 'no' != $rc_add_shadow ){
		$section_classes[] = 'eut-' . $rc_add_shadow;
	}

	$section_classes = apply_filters( 'crocal_eutf_row_section_classes', $section_classes , $atts );

	$section_string = implode( ' ', $section_classes );


	// Wrapper
	$wrapper_attributes = array();

	$wrapper_attributes[] = 'class="' . esc_attr( $section_string ) . '"';

	if ( is_page_template( 'page-templates/template-full-page.php' ) ) {
		$scrolling_lock_anchors = crocal_eutf_post_meta( '_crocal_eutf_scrolling_lock_anchors', 'yes' );
		if( 'no' == $scrolling_lock_anchors ) {
			$section_uniqid = uniqid('eut-scrolling-section-');
			if ( !empty ( $section_id ) ) {
				$wrapper_attributes[] = 'data-anchor="' . esc_attr( $section_id ) . '"';
			} else {
				$wrapper_attributes[] = 'data-anchor="' . esc_attr( $section_uniqid ) . '"';
			}
		}
		$wrapper_attributes[] = 'data-anchor-tooltip="' . esc_attr( $scroll_section_title ) . '"';
		$wrapper_attributes[] = 'data-header-color="' . esc_attr( $scroll_header_style ) . '"';
	} else {
		if ( !empty ( $section_id ) ) {
			$wrapper_attributes[] = 'id="' . esc_attr( $section_id ) . '"';
		}
	}

	if ( is_page_template( 'page-templates/template-section-nav.php' ) ) {
		$section_uniqid = uniqid('eut-scrolling-section-');
		if ( !empty ( $section_id ) ) {
			$wrapper_attributes[] = 'data-anchor="' . esc_attr( $section_id ) . '"';
		} else {
			$wrapper_attributes[] = 'data-anchor="' . esc_attr( $section_uniqid ) . '"';
		}
		$wrapper_attributes[] = 'data-anchor-tooltip="' . esc_attr( $scroll_section_title ) . '"';
		$wrapper_attributes[] = 'data-header-color="' . esc_attr( $scroll_header_style ) . '"';
	}

	// Parallax
	if( 'parallax' == $rc_bg_image_type || 'horizontal-parallax-lr' == $rc_bg_image_type || 'horizontal-parallax-rl' == $rc_bg_image_type ){
		$wrapper_attributes[] = 'data-parallax-threshold="' . esc_attr( $rc_bg_parallax_threshold ) . '"';
	}

	// Height Ratio
	if( 'auto' != $height_ratio ){
		$wrapper_attributes[] = 'data-height-ratio="' . esc_attr( $height_ratio ) . '"';
	}
	if( 'inherit' != $tablet_height_ratio ){
		$wrapper_attributes[] = 'data-tablet-height-ratio="' . esc_attr( $tablet_height_ratio ) . '"';
	}
	if( 'inherit' != $tablet_sm_height_ratio ){
		$wrapper_attributes[] = 'data-tablet-sm-height-ratio="' . esc_attr( $tablet_sm_height_ratio ) . '"';
	}
	if( 'inherit' != $mobile_height_ratio ){
		$wrapper_attributes[] = 'data-mobile-height-ratio="' . esc_attr( $mobile_height_ratio ) . '"';
	}
	if( !empty ($min_height) ){
		$wrapper_attributes[] = 'data-min-height="' . esc_attr( $min_height ) . '"';
	}

	if ( 'gradient' != $rc_bg_type ) {
		$rc_bg_gradient_color_1 = $rc_bg_gradient_color_2 = $rc_bg_gradient_direction = "";
	}
	if ( 'gradient' == $rc_bg_type || 'animated-color' == $rc_bg_type ) {
		$rc_bg_color = "";
	}

	$style = crocal_eutf_build_shortcode_style(
		array(
			'bg_color' => $rc_bg_color,
			'bg_gradient_color_1' => $rc_bg_gradient_color_1,
			'bg_gradient_color_2' => $rc_bg_gradient_color_2,
			'bg_gradient_direction' => $rc_bg_gradient_direction,
			'font_color' => $rc_font_color,
			'padding_top' => $padding_top,
			'padding_bottom' => $padding_bottom,
			'margin_bottom' => $rc_margin_bottom,
		)
	);

	if( !empty( $style ) ) {
		$wrapper_attributes[] = $style;
	}

	$row_classes = array( 'eut-row', 'eut-bookmark' );
	if( !empty( $columns_gap ) ) {
		$row_classes[] = 'eut-columns-gap-' . $columns_gap;
	}
	if( 'none' != $tablet_columns_vertical_gap ) {
		$row_classes[] = 'eut-tablet-vertical-gap-' . $tablet_columns_vertical_gap;
	}
	if( 'none' != $tablet_sm_columns_vertical_gap ) {
		$row_classes[] = 'eut-tablet-sm-vertical-gap-' . $tablet_sm_columns_vertical_gap;
	}
	if( 'none' != $mobile_columns_vertical_gap ) {
		$row_classes[] = 'eut-mobile-vertical-gap-' . $mobile_columns_vertical_gap;
	}
	if( 'auto' != $height_ratio || !empty ($min_height) ){
		$row_classes[] = 'eut-percentage-content';
	}
	if ( !empty ( $el_wrapper_class ) ) {
		$row_classes[] = $el_wrapper_class;
	}

	if ( 'yes' == $rtl_reverse ) {
		$row_classes[] = 'eut-rtl-columns-reverse';
	}

	$row_css_string = implode( ' ', $row_classes );



	$bg_wrapper_classes = array( 'eut-background-wrapper' );
	if ( !empty ( $rc_bg_image_scroll_effect ) ) {
		$bg_wrapper_classes[] = 'eut-opacity-' . $rc_bg_image_initial_opacity;
		$bg_wrapper_classes[] = 'eut-bg-scroll-effect';
	}
	$bg_wrapper_class_string = implode( ' ', $bg_wrapper_classes );

	$bg_wrapper_attributes = array();
	$bg_wrapper_attributes[] = 'class="' . esc_attr( $bg_wrapper_class_string ) . '"';
	if ( !empty ( $rc_bg_image_scroll_effect ) ) {
		$bg_wrapper_attributes[] = 'data-initial-opacity="' . esc_attr( $rc_bg_image_initial_opacity ) . '"';
		$bg_wrapper_attributes[] = 'data-final-opacity="' . esc_attr( $rc_bg_image_final_opacity ) . '"';
		$bg_wrapper_attributes[] = 'data-opacity-offset="' . esc_attr( $rc_bg_image_scroll_effect_offset ) . '"';
	}


	// Top Separators
	$separator_svg_top = crocal_eutf_build_separator( $separator_top, $separator_top_color );
	// Bottom Separators
	$separator_svg_bottom = crocal_eutf_build_separator( $separator_bottom, $separator_bottom_color );

	$wrapper_attributes = apply_filters( 'crocal_eutf_row_wrapper_attributes', $wrapper_attributes , $atts );

	//Section Output
	echo '<div ' . implode( ' ', $wrapper_attributes ) . '>';

	echo apply_filters( 'crocal_eutf_row_code_top', '', $atts );

	if( !empty ( $separator_top ) ) {
		$separator_attributes = array();
		$separator_style = crocal_eutf_build_shortcode_style(
			array(
				'height' => $separator_top_size,
			)
		);
		$separator_attributes[] = $separator_style;

		echo '<div class="eut-separator-top" ' . implode( ' ', $separator_attributes ) . '>' . $separator_svg_top . '</div>';
	}
	echo '<div class="eut-container"><div class="' . esc_attr( $row_css_string ) . '">' . do_shortcode( $content ) . '</div></div>';
	echo '<div ' . implode( ' ', $bg_wrapper_attributes ) . '>' . $out_video_bg_url . $out_image_bg . $out_video_bg . $out_overlay . $out_pattern . '</div>';
	if( !empty ( $separator_bottom ) ) {
		$separator_attributes = array();
		$separator_style = crocal_eutf_build_shortcode_style(
			array(
				'height' => $separator_bottom_size,
			)
		);
		$separator_attributes[] = $separator_style;
		echo '<div class="eut-separator-bottom" ' . implode( ' ', $separator_attributes ) . '>' . $separator_svg_bottom . '</div>';
	}

	echo apply_filters( 'crocal_eutf_row_code_bottom', '', $atts );

	echo '</div>';


//Omit closing PHP tag to avoid accidental whitespace output errors.
