<?php

/*
*	Feature Helper functions
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/


/**
 * Get Validate Header Style
 */

function crocal_eutf_validate_header_style( $crocal_eutf_header_style ) {

	$header_styles = array( 'default', 'dark', 'light' );
	if ( !in_array( $crocal_eutf_header_style, $header_styles ) ) {
		$crocal_eutf_header_style = 'default';
	}
	return $crocal_eutf_header_style;

}

/**
 * Get Header Feature Header Section Data
 */

function crocal_eutf_get_feature_header_data() {
	global $post;

	$crocal_eutf_header_position = 'above';
	if( crocal_eutf_is_woo_tax() ) {
		$crocal_eutf_header_style = crocal_eutf_option( 'product_tax_header_style', 'default' );
		$crocal_eutf_header_overlapping = crocal_eutf_option( 'product_tax_header_overlapping', 'no' );

	} elseif ( crocal_eutf_events_calendar_is_overview() || is_post_type_archive( 'tribe_events' ) ) {
		$crocal_eutf_header_style = crocal_eutf_option( 'event_tax_header_style', 'default' );
		$crocal_eutf_header_overlapping = crocal_eutf_option( 'event_tax_header_overlapping', 'no' );
	} else {
		$crocal_eutf_header_style = crocal_eutf_option( 'blog_header_style', 'default' );
		$crocal_eutf_header_overlapping = crocal_eutf_option( 'blog_header_overlapping', 'no' );
	}

	$feature_size = '';

	$crocal_eutf_woo_shop = crocal_eutf_is_woo_shop();

	if ( is_search() ) {
		$crocal_eutf_header_style =  crocal_eutf_option( 'search_page_header_style' );
		$crocal_eutf_header_overlapping =  crocal_eutf_option( 'search_page_header_overlapping' );
	}

	if ( is_singular() || $crocal_eutf_woo_shop ) {

		if ( $crocal_eutf_woo_shop ) {
			$post_id = wc_get_page_id( 'shop' );
		} else {
			$post_id = $post->ID;
		}
		$post_type = get_post_type( $post_id );

		switch( $post_type ) {
			case 'product':
				$crocal_eutf_header_style =  crocal_eutf_post_meta( '_crocal_eutf_header_style', crocal_eutf_option( 'product_header_style' ) );
				$crocal_eutf_header_overlapping =  crocal_eutf_post_meta( '_crocal_eutf_header_overlapping', crocal_eutf_option( 'product_header_overlapping' ) );
			break;
			case 'portfolio':
				$crocal_eutf_header_style =  crocal_eutf_post_meta( '_crocal_eutf_header_style', crocal_eutf_option( 'portfolio_header_style' ) );
				$crocal_eutf_header_overlapping =  crocal_eutf_post_meta( '_crocal_eutf_header_overlapping', crocal_eutf_option( 'portfolio_header_overlapping' ) );
			break;
			case 'post':
				$crocal_eutf_header_style =  crocal_eutf_post_meta( '_crocal_eutf_header_style', crocal_eutf_option( 'post_header_style' ) );
				$crocal_eutf_header_overlapping =  crocal_eutf_post_meta( '_crocal_eutf_header_overlapping', crocal_eutf_option( 'post_header_overlapping' ) );
			break;
			case 'tribe_events':
				$crocal_eutf_header_style =  crocal_eutf_post_meta( '_crocal_eutf_header_style', crocal_eutf_option( 'event_header_style' ) );
				$crocal_eutf_header_overlapping =  crocal_eutf_post_meta( '_crocal_eutf_header_overlapping', crocal_eutf_option( 'event_header_overlapping' ) );
			break;
			case 'tribe_organizer':
			case 'tribe_venue':
				$crocal_eutf_header_style = 'default';
				$crocal_eutf_header_overlapping = 'no';
			break;
			case 'page':
			default:
				if ( $crocal_eutf_woo_shop ) {
					$crocal_eutf_header_style =  crocal_eutf_post_meta_shop( '_crocal_eutf_header_style', crocal_eutf_option( 'page_header_style' ) );
					$crocal_eutf_header_overlapping =  crocal_eutf_post_meta_shop( '_crocal_eutf_header_overlapping', crocal_eutf_option( 'page_header_overlapping' ) );
				} else {
					$crocal_eutf_header_style =  crocal_eutf_post_meta( '_crocal_eutf_header_style', crocal_eutf_option( 'page_header_style' ) );
					$crocal_eutf_header_overlapping =  crocal_eutf_post_meta( '_crocal_eutf_header_overlapping', crocal_eutf_option( 'page_header_overlapping' ) );
				}
			break;
		}

		//Force Overlapping for Scrolling Full Width Sections Template
		if ( is_page_template( 'page-templates/template-full-page.php' ) ) {
			$crocal_eutf_header_overlapping = 'yes';
		} else {

			$feature_section_post_types = crocal_eutf_option( 'feature_section_post_types');

			if ( !empty( $feature_section_post_types ) && in_array( $post_type, $feature_section_post_types ) ) {

				$feature_section = get_post_meta( $post_id, '_crocal_eutf_feature_section', true );
				$feature_settings = crocal_eutf_array_value( $feature_section, 'feature_settings' );
				$feature_element = crocal_eutf_array_value( $feature_settings, 'element' );

				if ( !empty( $feature_element ) ) {

					$feature_single_item = crocal_eutf_array_value( $feature_section, 'single_item' );
					$crocal_eutf_header_position = crocal_eutf_array_value( $feature_settings, 'header_position' );
					if ( 'slider' ==  $feature_element ) {

						$slider_items = crocal_eutf_array_value( $feature_section, 'slider_items' );
						if ( !empty( $slider_items ) ) {
							$crocal_eutf_header_style = isset( $slider_items[0]['header_style'] ) ? $slider_items[0]['header_style'] : 'default';
						}

					}
				}
			}
		}
	}
	if( crocal_eutf_is_bbpress() ) {
		$crocal_eutf_header_style =  crocal_eutf_option( 'forum_header_style' );
		$crocal_eutf_header_overlapping =  crocal_eutf_option( 'forum_header_overlapping' );
	}

	if( is_404() ) {
		$crocal_eutf_header_style =  crocal_eutf_option( 'page_404_header_style' );
		$crocal_eutf_header_overlapping =  crocal_eutf_option( 'page_404_header_overlapping' );
	}

	return array(
		'data_overlap' => $crocal_eutf_header_overlapping,
		'data_header_position' => $crocal_eutf_header_position,
		'header_style' => crocal_eutf_validate_header_style( $crocal_eutf_header_style ),
	);

}

/**
 * Prints Header Feature Section Page/Post/Portfolio
 */
function crocal_eutf_print_header_feature() {

	//Skip for  Scrolling Full Width Sections Template
	if ( is_page_template( 'page-templates/template-full-page.php' ) ) {
		return false;
	}

	global $post;

	$crocal_eutf_woo_shop = crocal_eutf_is_woo_shop();

	if ( is_singular() || $crocal_eutf_woo_shop ) {

		if ( $crocal_eutf_woo_shop ) {
			$post_id = wc_get_page_id( 'shop' );
		} else {
			$post_id = $post->ID;
		}
		$post_type = get_post_type( $post_id );
		$feature_section_post_types = crocal_eutf_option( 'feature_section_post_types');
		if ( !empty( $feature_section_post_types ) && in_array( $post_type, $feature_section_post_types ) ) {

			$feature_section = get_post_meta( $post_id, '_crocal_eutf_feature_section', true );
			$feature_settings = crocal_eutf_array_value( $feature_section, 'feature_settings' );
			$feature_element = crocal_eutf_array_value( $feature_settings, 'element' );

			if ( !empty( $feature_element ) ) {

				$feature_single_item = crocal_eutf_array_value( $feature_section, 'single_item' );

				switch( $feature_element ) {
					case 'title':
						if ( !empty( $feature_single_item ) ) {
							crocal_eutf_print_header_feature_single( $feature_settings, $feature_single_item, 'title' );
						}
						break;
					case 'image':
						if ( !empty( $feature_single_item ) ) {
							crocal_eutf_print_header_feature_single( $feature_settings, $feature_single_item, 'image' );
						}
						break;
					case 'video':
						if ( !empty( $feature_single_item ) ) {
							crocal_eutf_print_header_feature_single( $feature_settings, $feature_single_item, 'video' );
						}
						break;
					case 'youtube':
						if ( !empty( $feature_single_item ) ) {
							crocal_eutf_print_header_feature_single( $feature_settings, $feature_single_item, 'youtube' );
						}
						break;
					case 'slider':
						$slider_items = crocal_eutf_array_value( $feature_section, 'slider_items' );
						$slider_settings = crocal_eutf_array_value( $feature_section, 'slider_settings' );
						if ( !empty( $slider_items ) ) {
							crocal_eutf_print_header_feature_slider( $feature_settings, $slider_items, $slider_settings );
						}
						break;
					case 'map':
						$map_items = crocal_eutf_array_value( $feature_section, 'map_items' );
						$map_settings = crocal_eutf_array_value( $feature_section, 'map_settings' );
						if ( !empty( $map_items ) ) {
							crocal_eutf_print_header_feature_map( $feature_settings, $map_items, $map_settings );
						}
						break;
					case 'revslider':
						$revslider_alias = crocal_eutf_array_value( $feature_section, 'revslider_alias' );
						if ( !empty( $revslider_alias ) ) {
							crocal_eutf_print_header_feature_revslider( $feature_settings, $revslider_alias, $feature_single_item );
						}
						break;
					default:
						break;

				}
			}
		}
	}
}


/**
 * Prints Overlay Container
 */
function crocal_eutf_print_overlay_container( $item ) {

	$pattern_overlay = crocal_eutf_array_value( $item, 'pattern_overlay' );
	$color_overlay = crocal_eutf_array_value( $item, 'color_overlay', 'dark' );
	$opacity_overlay = crocal_eutf_array_value( $item, 'opacity_overlay', '0' );

	if ( 'default' == $pattern_overlay ) {
		echo '<div class="eut-pattern"></div>';
	}
	$overlay_classes = array('eut-bg-overlay');
	$overlay_string = implode( ' ', $overlay_classes );
	if ( 'gradient' == $color_overlay ) {
		echo '<div class="' . esc_attr( $overlay_string ) . '"></div>';
	} else {
		if ( '0' != $opacity_overlay && !empty( $opacity_overlay ) ) {
			echo '<div class="' . esc_attr( $overlay_string ) . '"></div>';
		}
	}
}

/**
 * Prints Background Image Container
 */
function crocal_eutf_print_bg_image_container( $item ) {

	$bg_position = crocal_eutf_array_value( $item, 'bg_position', 'center-center' );
	$bg_tablet_sm_position = crocal_eutf_array_value( $item, 'bg_tablet_sm_position' );

	$bg_image_id = crocal_eutf_array_value( $item, 'bg_image_id' );
	$bg_image_size = crocal_eutf_array_value( $item, 'bg_image_size' );

	$full_src = wp_get_attachment_image_src( $bg_image_id, 'crocal-eutf-fullscreen' );
	$image_url = $full_src[0];
	if( !empty( $image_url ) ) {

		//Adaptive Background URL

		if ( empty ( $bg_image_size ) ) {
			$bg_image_size = crocal_eutf_option( 'feature_section_bg_size' );
		}

		$image_url = crocal_eutf_get_adaptive_url( $bg_image_id, $bg_image_size );

		$bg_image_classes = array( 'eut-bg-image' );
		$bg_image_classes[] = 'eut-bg-' . $bg_position;
		if ( !empty( $bg_tablet_sm_position ) ) {
			$bg_image_classes[] = 'eut-bg-tablet-sm-' . $bg_tablet_sm_position;
		}
		$bg_image_classes[] = 'eut-bg-image-id-' . $bg_image_id;

		$bg_image_classes_string = implode( ' ', $bg_image_classes );

		echo '<div class="' . esc_attr( $bg_image_classes_string ) . '" style="background-image: url(' . esc_url( $image_url ) . ');"></div>';
	}

}


/**
 * Prints Background Video Container
 */
function crocal_eutf_print_bg_video_container( $item ) {

	$bg_video_webm = crocal_eutf_array_value( $item, 'video_webm' );
	$bg_video_mp4 = crocal_eutf_array_value( $item, 'video_mp4' );
	$bg_video_ogv = crocal_eutf_array_value( $item, 'video_ogv' );
	$bg_video_poster = crocal_eutf_array_value( $item, 'video_poster', 'no' );
	$bg_video_device = crocal_eutf_array_value( $item, 'video_device', 'no' );
	$bg_image_id = crocal_eutf_array_value( $item, 'bg_image_id' );

	$loop = crocal_eutf_array_value( $item, 'video_loop', 'yes' );
	$muted = crocal_eutf_array_value( $item, 'video_muted', 'yes' );

	$full_src = wp_get_attachment_image_src( $bg_image_id, 'crocal-eutf-fullscreen' );
	$image_url = esc_url( $full_src[0] );

	$video_poster = $playsinline = '';

	if ( !empty( $image_url ) && 'yes' == $bg_video_poster ) {
		$video_poster = $image_url;
	}
	if ( wp_is_mobile() ) {
		if ( 'yes' == $bg_video_device ) {
			if( !empty( $image_url ) ) {
				$video_poster = $image_url;
			}
			$muted = 'yes';
			$playsinline = 'yes';
		} else {
			return;
		}
	}
	if ( crocal_eutf_browser_webkit_check() ) {
		$muted = 'yes';
	}
	$video_settings = array(
		'preload' => 'auto',
		'autoplay' => 'yes',
		'loop' => $loop,
		'muted' => $muted,
		'poster' => $video_poster,
		'playsinline' => $playsinline,
	);

	$video_settings = apply_filters( 'crocal_eutf_feature_video_settings', $video_settings );


	if ( !empty ( $bg_video_webm ) || !empty ( $bg_video_mp4 ) || !empty ( $bg_video_ogv ) ) {
?>
		<div class="eut-bg-video eut-html5-bg-video" data-video-device="<?php echo esc_attr( $bg_video_device ); ?>">
			<video <?php echo crocal_eutf_print_media_video_settings( $video_settings );?>>
			<?php if ( !empty ( $bg_video_webm ) ) { ?>
				<source src="<?php echo esc_url( $bg_video_webm ); ?>" type="video/webm">
			<?php } ?>
			<?php if ( !empty ( $bg_video_mp4 ) ) { ?>
				<source src="<?php echo esc_url( $bg_video_mp4 ); ?>" type="video/mp4">
			<?php } ?>
			<?php if ( !empty ( $bg_video_ogv ) ) { ?>
				<source src="<?php echo esc_url( $bg_video_ogv ); ?>" type="video/ogg">
			<?php } ?>
			</video>
		</div>
<?php
	}

}

/**
 * Prints Background YouTube/Vimeo Container
 */
function crocal_eutf_print_bg_youtube_container( $item ) {
	$video_url = crocal_eutf_array_value( $item, 'video_url' );
	$video_start = crocal_eutf_array_value( $item, 'video_start' );
	$video_end = crocal_eutf_array_value( $item, 'video_end' );

	if( empty( $video_url ) ) {
		return;
	}
	if ( crocal_eutf_extract_youtube_id( $video_url ) ) {
		wp_enqueue_script( 'youtube-iframe-api' );
		$wrapper_attributes = array();
		$wrapper_attributes[] = 'data-video-bg-url="' . esc_attr( $video_url ) . '"';
		if ( !empty( $video_start ) ) {
			$wrapper_attributes[] = 'data-video-start="' . esc_attr( $video_start ) . '"';
		}
		if ( !empty( $video_end ) ) {
			$wrapper_attributes[] = 'data-video-end="' . esc_attr( $video_end ) . '"';
		}
		$wrapper_attributes[] = 'class="eut-bg-video eut-yt-bg-video"';
?>
		<div <?php echo implode( ' ', $wrapper_attributes ); ?>></div>
<?php
	} elseif ( false !== strpos( $video_url, 'vimeo.com' ) ) {
		wp_enqueue_script( 'vimeo-api' );
		$wrapper_attributes = array();
		$wrapper_attributes[] = 'id="' . esc_attr( uniqid('vimeo-') ) . '"';
		$wrapper_attributes[] = 'data-vimeo-url="' . esc_attr( $video_url ) . '"';
		$wrapper_attributes[] = 'data-vimeo-autoplay="true"';
		$wrapper_attributes[] = 'data-vimeo-autopause="false"';
		$wrapper_attributes[] = 'data-vimeo-loop="true"';
		$wrapper_attributes[] = 'data-vimeo-background="true"';
		$wrapper_attributes[] = 'data-vimeo-muted="true"';

		$wrapper_attributes[] = 'class="eut-bg-video eut-vimeo-bg-video"';
?>
		<div <?php echo implode( ' ', $wrapper_attributes ); ?>></div>
<?php
	}
}

/**
 * Prints Bottom Separator Container
 */
function crocal_eutf_print_bottom_seperator_container( $feature_settings ) {
	$separator_bottom = crocal_eutf_array_value( $feature_settings, 'separator_bottom' );
	$separator_bottom_color = crocal_eutf_array_value( $feature_settings, 'separator_bottom_color' );
	$separator_bottom_size = crocal_eutf_array_value( $feature_settings, 'separator_bottom_size' );

	if( !empty ( $separator_bottom ) ) {
		echo '<div class="eut-separator-bottom">';
		echo crocal_eutf_build_separator( $separator_bottom, $separator_bottom_color );
		echo '</div>';
	}
}

/**
 * Get Feature Section data
 */
function crocal_eutf_get_feature_data( $feature_settings, $item_type, $item_effect = '', $el_class = '' ) {

	$wrapper_attributes = array();

	//Data and Style
	if( 'revslider' != $item_type ) {
		$feature_size = crocal_eutf_array_value( $feature_settings, 'size' );
		$feature_height = crocal_eutf_array_value( $feature_settings, 'height', '60' );
		if ( !empty($feature_size) ) {
			if ( empty( $feature_height ) ) {
				$feature_height = "60";
			}
			$wrapper_attributes[] = 'data-height="' . esc_attr( $feature_height ) . '"';
		}
	}

	//Classes
	$feature_item_classes = array( 'eut-with-' . $item_type  );

	if( 'revslider' != $item_type ) {
		if ( empty( $feature_size ) ) {
			$feature_item_classes[] = 'eut-fullscreen';
		} else {
			if ( is_numeric( $feature_height ) ) { //Custom Size
				$feature_item_classes[] = 'eut-custom-size';
			} else {
				$feature_item_classes[] = 'eut-' . $feature_height . '-height';
			}
		}

		if ( !empty( $item_effect ) ) {
			$feature_item_classes[] = 'eut-bg-' . $item_effect;
		}
	}

	if ( !empty ( $el_class ) ) {
		$feature_item_classes[] = $el_class;
	}
	$feature_item_class_string = implode( ' ', $feature_item_classes );

	//Add Classes
	$wrapper_attributes[] = 'class="' . esc_attr( $feature_item_class_string ) . '"';

	return $wrapper_attributes;
}

/**
 * Prints Header Section Feature Single Item
 */
function crocal_eutf_print_header_feature_single( $feature_settings, $item, $item_type  ) {

	if( 'image' == $item_type ) {
		$item_effect = crocal_eutf_array_value( $item, 'image_effect' );
	} elseif( 'video' == $item_type ) {
		$item_effect = crocal_eutf_array_value( $item, 'video_effect' );
	} else {
		$item_effect = '';
	}

	$el_class = crocal_eutf_array_value( $item, 'el_class' );

	$feature_data = crocal_eutf_get_feature_data( $feature_settings, $item_type, $item_effect, $el_class );

?>
	<div id="eut-feature-section" <?php echo implode( ' ', $feature_data ); ?>>
		<div class="eut-wrapper clearfix">
			<?php crocal_eutf_print_header_feature_content( $feature_settings, $item, $item_type ); ?>
		</div>
		<div class="eut-background-wrapper">
		<?php
			if( 'image' == $item_type || 'video' == $item_type || 'youtube' == $item_type ) {
				crocal_eutf_print_bg_image_container( $item );
			}
			if( 'video' == $item_type ) {
				crocal_eutf_print_bg_video_container( $item );
			}
			if( 'youtube' == $item_type ) {
				crocal_eutf_print_bg_youtube_container( $item );
			}
			crocal_eutf_print_overlay_container( $item  );
		?>
		</div>
		<?php crocal_eutf_print_bottom_seperator_container( $feature_settings ); ?>
	</div>
<?php
}

/**
 * Prints Feature Slider
 */
function crocal_eutf_print_header_feature_slider( $feature_settings, $slider_items, $slider_settings ) {

	$slider_speed = crocal_eutf_array_value( $slider_settings, 'slideshow_speed', '3500' );
	$slider_pause = crocal_eutf_array_value( $slider_settings, 'slider_pause', 'no' );
	$slider_transition = crocal_eutf_array_value( $slider_settings, 'transition', 'slide' );
	$slider_dir_nav = crocal_eutf_array_value( $slider_settings, 'direction_nav', '1' );
	$slider_effect = crocal_eutf_array_value( $slider_settings, 'slider_effect', '' );
	$slider_pagination = crocal_eutf_array_value( $slider_settings, 'pagination', 'yes' );

	$feature_data = crocal_eutf_get_feature_data( $feature_settings, 'slider', $slider_effect  );

	$crocal_eutf_header_style = isset( $slider_items[0]['header_style'] ) ? $slider_items[0]['header_style'] : 'default';

?>
	<div id="eut-feature-section" <?php echo implode( ' ', $feature_data ); ?>>

		<?php echo crocal_eutf_element_navigation( $slider_dir_nav, $crocal_eutf_header_style ); ?>

		<div id="eut-feature-slider" class="eut-<?php echo esc_attr( $crocal_eutf_header_style ); ?>" data-slider-speed="<?php echo esc_attr( $slider_speed ); ?>" data-pagination="<?php echo esc_attr( $slider_pagination ); ?>" data-slider-pause="<?php echo esc_attr( $slider_pause ); ?>" data-slider-transition="<?php echo esc_attr( $slider_transition ); ?>">

<?php

			foreach ( $slider_items as $item ) {

				$header_style = crocal_eutf_array_value( $item, 'header_style', 'default' );
				$crocal_eutf_header_style = crocal_eutf_validate_header_style( $header_style );

				$slide_type = crocal_eutf_array_value( $item, 'type' );
				$slide_post_id = crocal_eutf_array_value( $item, 'post_id' );
				if( 'post' == $slide_type &&  !empty( $slide_post_id ) ) {
					if( has_post_thumbnail( $slide_post_id ) && empty( $item['bg_image_id'] ) ) {
						$item['bg_image_id'] = get_post_thumbnail_id( $slide_post_id );
					}
				}

				$el_class = crocal_eutf_array_value( $item, 'el_class' );
				$el_id = crocal_eutf_array_value( $item, 'id', uniqid() );

?>
				<div class="eut-slider-item eut-slider-item-id-<?php echo esc_attr( $el_id ); ?> <?php echo esc_attr( $el_class ); ?>" data-header-color="<?php echo esc_attr( $crocal_eutf_header_style ); ?>">
					<div class="eut-wrapper clearfix">
						<?php crocal_eutf_print_header_feature_content( $feature_settings, $item ); ?>
					</div>
					<div class="eut-background-wrapper">
					<?php
						crocal_eutf_print_bg_image_container( $item );
						crocal_eutf_print_overlay_container( $item  );
					?>
					</div>
				</div>
<?php
			}
?>
		</div>
		<?php crocal_eutf_print_bottom_seperator_container( $feature_settings ); ?>
	</div>
<?php

}

/**
 * Prints Header Feature Map
 */
function crocal_eutf_print_header_feature_map( $feature_settings, $map_items, $map_settings ) {

	wp_enqueue_script( 'crocal-eutf-maps-script');

	$feature_data = crocal_eutf_get_feature_data( $feature_settings, 'map' );

	$map_marker_type = crocal_eutf_array_value( $map_settings, 'marker_type' );
	$map_marker_bg_color = crocal_eutf_array_value( $map_settings, 'marker_bg_color', 'primary-1' );
	$map_marker_width = $map_marker_height = '';
	if ( empty( $map_marker_type ) ) {
		$global_marker = crocal_eutf_array_value( $map_settings, 'marker' );
		if ( empty( $global_marker ) ) {
			$map_marker = get_template_directory_uri() . '/images/markers/markers.png';
			$map_marker_width = '38';
			$map_marker_height = '60';
		} else {
			$id = preg_replace('/[^\d]/', '', $global_marker);
			$full_src = wp_get_attachment_image_src( $id, 'full' );
			$map_marker = $full_src[0];
			$map_marker_width = $full_src[1];
			$map_marker_height = $full_src[2];
		}
		$point_type = 'image';
		$point_bg_color = '';
	} else {
		$map_marker = get_template_directory_uri() . '/images/markers/transparent.png';
		$point_type = $map_marker_type;
		$point_bg_color = $map_marker_bg_color;
	}

	$map_zoom = crocal_eutf_array_value( $map_settings, 'zoom', 14 );
	$map_disable_style = crocal_eutf_array_value( $map_settings, 'disable_style', 'no' );

	$map_lat = crocal_eutf_array_value( $map_items[0], 'lat', '51.516221' );
	$map_lng = crocal_eutf_array_value( $map_items[0], 'lng', '-0.136986' );

?>
	<div id="eut-feature-section" <?php echo implode( ' ', $feature_data ); ?>>
		<div class="eut-map eut-wrapper clearfix" data-lat="<?php echo esc_attr( $map_lat ); ?>" data-lng="<?php echo esc_attr( $map_lng ); ?>" data-zoom="<?php echo esc_attr( $map_zoom ); ?>" data-disable-style="<?php echo esc_attr( $map_disable_style ); ?>"><?php echo apply_filters( 'crocal_eutf_privacy_gmap_fallback', '', $map_lat, $map_lng ); ?></div>
		<?php
			foreach ( $map_items as $map_item ) {
				crocal_eutf_print_feature_map_point( $map_item, $map_marker, $map_marker_width, $map_marker_height, $point_type, $point_bg_color );
			}
		?>
		<?php crocal_eutf_print_bottom_seperator_container( $feature_settings ); ?>
	</div>
<?php
}

function crocal_eutf_print_feature_map_point( $map_item, $default_marker, $default_marker_width, $default_marker_height, $point_type = 'image', $point_bg_color = ''  ) {

	$map_lat = crocal_eutf_array_value( $map_item, 'lat', '51.516221' );
	$map_lng = crocal_eutf_array_value( $map_item, 'lng', '-0.136986' );
	$map_marker = crocal_eutf_array_value( $map_item, 'marker' );
	if ( !empty( $map_marker ) ) {
		$point_type = 'image';
		$id = preg_replace('/[^\d]/', '', $map_marker);
		$full_src = wp_get_attachment_image_src( $id, 'full' );
		$point_marker = $full_src[0];
		$point_marker_width = $full_src[1];
		$point_marker_height = $full_src[2];
	} else {
		$point_marker = $default_marker;
		$point_marker_width = $default_marker_width;
		$point_marker_height = $default_marker_height;
	}

	$map_title = crocal_eutf_array_value( $map_item, 'title' );
	$map_infotext = crocal_eutf_array_value( $map_item, 'info_text','' );
	$map_infotext_open = crocal_eutf_array_value( $map_item, 'info_text_open', 'no' );

	$button_text = crocal_eutf_array_value( $map_item, 'button_text' );
	$button_url = crocal_eutf_array_value( $map_item, 'button_url' );
	$button_target = crocal_eutf_array_value( $map_item, 'button_target', '_self' );
	$button_class = crocal_eutf_array_value( $map_item, 'button_class' );

	$map_point_attributes = array();
	$map_point_attributes[] = 'data-point-lat="' . esc_attr( $map_lat ) . '"';
	$map_point_attributes[] = 'data-point-lng="' . esc_attr( $map_lng ) . '"';
	$map_point_attributes[] = 'data-point-title="' . esc_attr( $map_title ) . '"';
	$map_point_attributes[] = 'data-point-open="' . esc_attr( $map_infotext_open ) . '"';
	$map_point_attributes[] = 'data-point-type="' . esc_attr( $point_type ) . '"';
	$map_point_attributes[] = 'data-point-marker-width="' . esc_attr( $point_marker_width ) . '"';
	$map_point_attributes[] = 'data-point-marker-height="' . esc_attr( $point_marker_height ) . '"';
	if( 'image' != $point_type ) {
		$map_point_attributes[] = 'data-point-bg-color="' . esc_attr( $point_bg_color ) . '"';
	}

?>
	<div class="eut-map-point eut-hidden" data-point-marker="<?php echo esc_url( $point_marker ); ?>" <?php echo implode( ' ', $map_point_attributes ); ?>>
		<?php if ( !empty( $map_title ) || !empty( $map_infotext ) || !empty( $button_text ) ) { ?>
		<div class="eut-map-infotext">
			<?php if ( !empty( $map_title ) ) { ?>
			<h6 class="eut-infotext-title"><?php echo esc_html( $map_title ); ?></h6>
			<?php } ?>
			<?php if ( !empty( $map_infotext ) ) { ?>
			<p class="eut-infotext-description"><?php echo wp_kses_post( $map_infotext ); ?></p>
			<?php } ?>
			<?php if ( !empty( $button_text ) ) { ?>
			<a class="eut-infotext-link <?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_text ); ?></a>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
<?php

}

/**
 * Prints Header Feature Revolution Slider
 */
function crocal_eutf_print_header_feature_revslider( $feature_settings, $revslider_alias, $item  ) {

	$el_class = crocal_eutf_array_value( $item, 'el_class' );
	$feature_data = crocal_eutf_get_feature_data( $feature_settings, 'revslider', '', $el_class );

?>
	<div id="eut-feature-section" <?php echo implode( ' ', $feature_data ); ?>>
		<?php echo do_shortcode( '[rev_slider ' . $revslider_alias . ']' ); ?>
	</div>

<?php
}

/**
 * Prints Header Feature Go to Section ( Bottom Arrow )
 */
if ( !function_exists('crocal_eutf_print_feature_go_to_section') ) {
	function crocal_eutf_print_feature_go_to_section( $feature_settings, $item ) {

		$arrow_enabled = crocal_eutf_array_value( $item, 'arrow_enabled', 'no' );
		$arrow_text = crocal_eutf_array_value( $item, 'arrow_text' );

		if( 'yes' == $arrow_enabled ) {
?>
		<div class="eut-goto-section-wrapper">
			<div class="eut-container">
				<i class="eut-goto-section eut-icon-nav-down"></i>
			</div>
		</div>
<?php
		} else if( 'text' == $arrow_enabled ) {
?>
		<div class="eut-goto-section-wrapper">
			<div class="eut-container">
				<div class="eut-goto-section eut-small-text eut-goto-section-text">
					<?php echo esc_html( $arrow_text ); ?>
				</div>
			</div>
		</div>
<?php
		}

	}
}

/**
 * Prints Header Feature Content Image
 */
function crocal_eutf_print_feature_content_image( $item ) {

	$media_id = crocal_eutf_array_value( $item, 'content_image_id', '0' );
	$media_size = crocal_eutf_array_value( $item, 'content_image_size', 'medium' );

	if( !empty( $media_id ) ) {
?>
		<div class="eut-graphic">
			<?php echo wp_get_attachment_image( $media_id, $media_size ); ?>
		</div>
<?php
	}

}


/**
 * Prints Header Section Feature Content
 */
function crocal_eutf_print_header_feature_content( $feature_settings, $item, $mode = ''  ) {

	$feature_size = crocal_eutf_array_value( $feature_settings, 'size' );

	$title = crocal_eutf_array_value( $item, 'title' );
	$caption = crocal_eutf_array_value( $item, 'caption' );
	$subheading = crocal_eutf_array_value( $item, 'subheading' );

	$subheading_tag = crocal_eutf_array_value( $item, 'subheading_tag', 'div' );
	$title_tag = crocal_eutf_array_value( $item, 'title_tag', 'div' );
	$caption_tag = crocal_eutf_array_value( $item, 'caption_tag', 'div' );

	$crocal_eutf_content_container_classes = array( 'eut-content' );
	$crocal_eutf_subheading_classes = array( 'eut-subheading', 'eut-title-categories' );
	$crocal_eutf_title_classes = array( 'eut-title' );
	$crocal_eutf_caption_classes = array( 'eut-description' );
	$crocal_eutf_title_meta_classes = array( 'eut-title-meta-content', 'eut-link-text' );
	$crocal_eutf_content_classes = array( 'eut-title-content-wrapper' );


	//Content Container Classes
	$content_position = crocal_eutf_array_value( $item, 'content_position', 'center-center' );
	$container_size = crocal_eutf_array_value( $item, 'container_size' );
	$crocal_eutf_content_container_classes[] = 'eut-align-' . $content_position;
	if ( 'large' == $container_size ) {
		$crocal_eutf_content_container_classes[] = 'eut-fullwidth';
	}

	$content_bg_color = crocal_eutf_array_value( $item, 'content_bg_color', 'none' );
	$content_align = crocal_eutf_array_value( $item, 'content_align', 'center' );
	$content_size = crocal_eutf_array_value( $item, 'content_size', 'large' );
	if ( 'custom' != $content_bg_color ) {
		$crocal_eutf_content_classes[] = 'eut-bg-' . $content_bg_color;
	}
	$crocal_eutf_content_classes[] = 'eut-align-' . $content_align;
	$crocal_eutf_content_classes[] = 'eut-content-' . $content_size;


	$subheading_color = crocal_eutf_array_value( $item, 'subheading_color', 'light' );
	$title_color = crocal_eutf_array_value( $item, 'title_color', 'light' );
	$caption_color = crocal_eutf_array_value( $item, 'caption_color', 'light' );

	$subheading_family = crocal_eutf_array_value( $item, 'subheading_family' );
	$title_family = crocal_eutf_array_value( $item, 'title_family' );
	$caption_family = crocal_eutf_array_value( $item, 'caption_family' );

	if ( !empty( $subheading_family ) ) {
		$crocal_eutf_subheading_classes[] = 'eut-' . $subheading_family;
	}
	if ( !empty( $title_family ) ) {
		$crocal_eutf_title_classes[] = 'eut-' . $title_family;
	}
	if ( !empty( $caption_family ) ) {
		$crocal_eutf_caption_classes[] = 'eut-' . $caption_family;
	}

	if ( 'custom' != $subheading_color ) {
		$crocal_eutf_subheading_classes[] = 'eut-text-' . $subheading_color;
		$crocal_eutf_title_meta_classes[] = 'eut-text-' . $subheading_color;
	}
	if ( 'custom' != $title_color ) {
		$crocal_eutf_title_classes[] = 'eut-text-' . $title_color;
	}
	if ( 'custom' != $caption_color ) {
		$crocal_eutf_caption_classes[] = 'eut-text-' . $caption_color;
	}

	$crocal_eutf_content_container_classes = implode( ' ', $crocal_eutf_content_container_classes );
	$crocal_eutf_subheading_classes = implode( ' ', $crocal_eutf_subheading_classes );
	$crocal_eutf_title_classes = implode( ' ', $crocal_eutf_title_classes );
	$crocal_eutf_caption_classes = implode( ' ', $crocal_eutf_caption_classes );
	$crocal_eutf_title_meta_classes = implode( ' ', $crocal_eutf_title_meta_classes );
	$crocal_eutf_content_classes = implode( ' ', $crocal_eutf_content_classes );

	$content_animation = crocal_eutf_array_value( $item, 'content_animation', 'fade-in' );

	$button = crocal_eutf_array_value( $item, 'button' );
	$button2 = crocal_eutf_array_value( $item, 'button2' );

	$button_text = crocal_eutf_array_value( $button, 'text' );
	$button_text2 = crocal_eutf_array_value( $button2, 'text' );

	$slide_type = crocal_eutf_array_value( $item, 'type' );
	$slide_post_id = crocal_eutf_array_value( $item, 'post_id' );
	if( 'post' == $slide_type &&  !empty( $slide_post_id ) ) {
		$title = get_the_title ( $slide_post_id  );
		$caption = get_post_meta( $slide_post_id, '_crocal_eutf_description', true );
		$link_url = get_permalink( $slide_post_id ) ;
	}

?>
	<div class="<?php echo esc_attr( $crocal_eutf_content_container_classes ); ?>" data-animation="<?php echo esc_attr( $content_animation ); ?>">
		<div class="eut-container">
			<div class="<?php echo esc_attr( $crocal_eutf_content_classes ); ?>">
			<?php if ( 'post' == $slide_type &&  !empty( $slide_post_id ) ) { ?>
				<?php if ( 'post' == get_post_type( $slide_post_id ) ) { ?>
				<div class="<?php echo esc_attr( $crocal_eutf_subheading_classes ); ?>">
					<?php crocal_eutf_print_post_title_categories( $slide_post_id ); ?>
				</div>
				<?php } ?>
				<a href="<?php echo esc_url( $link_url ); ?>">
					<<?php echo tag_escape( $title_tag ); ?> class="<?php echo esc_attr( $crocal_eutf_title_classes ); ?>"><span><?php echo wp_kses_post( $title ); ?></span></<?php echo tag_escape( $title_tag ); ?>>
				</a>
				<?php if ( !empty( $caption ) ) { ?>
				<<?php echo tag_escape( $caption_tag ); ?> class="<?php echo esc_attr( $crocal_eutf_caption_classes ); ?>"><span><?php echo wp_kses_post( $caption ); ?></span></<?php echo tag_escape( $caption_tag ); ?>>
				<?php } ?>
				<?php if ( 'post' == get_post_type( $slide_post_id ) ) { ?>
				<div class="<?php echo esc_attr( $crocal_eutf_title_meta_classes ); ?>">
				<?php crocal_eutf_print_feature_post_title_meta( $slide_post_id ); ?>
				</div>
				<?php } ?>
			<?php } else { ?>
				<?php crocal_eutf_print_feature_content_image( $item ); ?>
				<?php if ( !empty( $subheading ) ) { ?>
				<<?php echo tag_escape( $subheading_tag ); ?> class="<?php echo esc_attr( $crocal_eutf_subheading_classes ); ?>"><span><?php echo wp_kses_post( $subheading ); ?></span></<?php echo tag_escape( $subheading_tag ); ?>>
				<?php } ?>
				<?php if ( !empty( $title ) ) { ?>
				<<?php echo tag_escape( $title_tag ); ?> class="<?php echo esc_attr( $crocal_eutf_title_classes ); ?>"><span><?php echo wp_kses_post( $title ); ?></span></<?php echo tag_escape( $title_tag ); ?>>
				<?php } ?>
				<?php if ( !empty( $caption ) ) { ?>
				<<?php echo tag_escape( $caption_tag ); ?> class="<?php echo esc_attr( $crocal_eutf_caption_classes ); ?>"><span><?php echo wp_kses_post( $caption ); ?></span></<?php echo tag_escape( $caption_tag ); ?>>
				<?php } ?>

				<?php
					if( 'title' != $mode && ( !empty( $button_text ) || !empty( $button_text2 ) ) ) {
					$btn1_class = $btn2_class = 'eut-btn-1';
					if ( !empty( $button_text ) && !empty( $button_text2 ) ) {
						$btn2_class = 'eut-btn-2';
					}
				?>
					<div class="eut-button-wrapper">
						<?php crocal_eutf_print_feature_button( $button, $btn1_class ); ?>
						<?php crocal_eutf_print_feature_button( $button2, $btn2_class ); ?>
					</div>
				<?php
					}
				?>
			<?php } ?>
			</div>
		</div>
		<?php crocal_eutf_print_feature_go_to_section( $feature_settings, $item ); ?>
	</div>
<?php
}

/**
 * Prints Header Feature Button
 */
function crocal_eutf_print_feature_button( $item, $extra_class = 'eut-btn-1' ) {

	$button_id = crocal_eutf_array_value( $item, 'id' );
	$button_text = crocal_eutf_array_value( $item, 'text' );
	$button_url = crocal_eutf_array_value( $item, 'url' );
	$button_type = crocal_eutf_array_value( $item, 'type' );
	$button_size = crocal_eutf_array_value( $item, 'size', 'medium' );
	$button_color = crocal_eutf_array_value( $item, 'color', 'primary-1' );
	$button_hover_color = crocal_eutf_array_value( $item, 'hover_color', 'black' );
	$button_gradient_color_1 = crocal_eutf_array_value( $item, 'gradient_1_color', 'primary-1' );
	$button_gradient_color_2 = crocal_eutf_array_value( $item, 'gradient_2_color', 'primary-2' );
	$button_shape = crocal_eutf_array_value( $item, 'shape', 'square' );
	$button_shadow = crocal_eutf_array_value( $item, 'shadow' );
	$button_target = crocal_eutf_array_value( $item, 'target', '_self' );
	$button_class = crocal_eutf_array_value( $item, 'class' );

	if ( !empty( $button_text ) ) {

		//Button Classes
		$button_classes = array( 'eut-btn' );

		$button_classes[] = $extra_class;
		$button_classes[] = 'eut-btn-' . $button_size;
		$button_classes[] = 'eut-' . $button_shape;
		if ( !empty( $button_shadow ) ) {
			$button_classes[] = 'eut-shadow-' . $button_shadow;
		}
		if ( 'outline' == $button_type ) {
			$button_classes[] = 'eut-btn-line';
		}
		if ( !empty( $button_class ) ) {
			$button_classes[] = $button_class;
		}
		if ( 'gradient' == $button_type ) {
			$uid = $button_id;
			$button_classes[] = 'eut-btn-gradient';
			$button_classes[] = 'eut-btn-' . $uid;
			$button_classes[] = 'eut-bg-' . $button_hover_color;
			$button_classes[] = 'eut-bg-hover-' . $button_hover_color;
			$button_classes[] = 'eut-gradient-1-' . $button_gradient_color_1;
			$button_classes[] = 'eut-gradient-2-' . $button_gradient_color_2;
		} else {
			$button_classes[] = 'eut-bg-' . $button_color;
			$button_classes[] = 'eut-bg-hover-' . $button_hover_color;
		}

		$button_class_string = implode( ' ', $button_classes );

		if ( !empty( $button_url ) ) {
			$url = $button_url;
			$target = $button_target;
		} else {
			$url = "#";
			$target= "_self";
		}

?>
		<a class="<?php echo esc_attr( $button_class_string ); ?>" href="<?php echo esc_url( $url ); ?>"  target="<?php echo esc_attr( $target ); ?>">
			<span><?php echo esc_html( $button_text ); ?></span>
		</a>
<?php

	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
