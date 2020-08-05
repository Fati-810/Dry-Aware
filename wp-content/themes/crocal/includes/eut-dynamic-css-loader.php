<?php
/**
 *  Add Dynamic css to header
 *  @version	1.0
 *  @author		Euthemians Team
 *  @URI		http://euthemians.com
 */

if ( !function_exists( 'crocal_eutf_load_dynamic_css' ) ) {
	function crocal_eutf_load_dynamic_css() {

		crocal_eutf_dynamic_singular_css();

 		if (  1 == crocal_eutf_option( 'css_generation' ) && !is_customize_preview() ) {
			if ( ! file_exists( crocal_eutf_get_css_file_path() ) ) {
				crocal_eutf_generate_dynamic_css_file();
			}
			wp_enqueue_style( 'crocal-eutf-dynamic-style', crocal_eutf_get_css_file_url() , null );
		} else {
			crocal_eutf_dynamic_options_css( 'inline' );
		}
	}
}

if ( !function_exists( 'crocal_eutf_dynamic_options_css' ) ) {

	function crocal_eutf_dynamic_options_css( $mode = '' ) {
		$css = "";
		//CSS Templates
		$css .= crocal_eutf_get_css_template( 'eut-dynamic-typography-css');
		$css .= crocal_eutf_get_css_template( 'eut-dynamic-options-css');
		if ( empty( $mode ) || crocal_eutf_woocommerce_enabled() ) {
			$css .= crocal_eutf_get_css_template( 'eut-dynamic-woo-css');
		}
		if ( empty( $mode ) || crocal_eutf_events_calendar_enabled() ) {
			$css .= crocal_eutf_get_css_template( 'eut-dynamic-event-css');
		}
		if ( empty( $mode ) || crocal_eutf_bbpress_enabled() ) {
			$css .= crocal_eutf_get_css_template( 'eut-dynamic-bbpress-css');
		}

		//Custom Button Style
		$css .= crocal_eutf_get_global_button_style();
		$css .= crocal_eutf_get_global_shape_style();

		//Custom CSS
		$css .= crocal_eutf_option( 'css_code' );

		if( 'inline' == $mode ) {
			wp_add_inline_style( 'crocal-eutf-custom-style', crocal_eutf_compress_css( $css ) );
		} else {
			return crocal_eutf_compress_css( $css );
		}

	}
}

 /**
 * Load custom dynamic css from posts and taxonomies
 */
if ( !function_exists( 'crocal_eutf_dynamic_singular_css' ) ) {

	function crocal_eutf_dynamic_singular_css() {

		$css = '';
		$css .= crocal_eutf_shop_css();
		$css .= crocal_eutf_bottom_bar_area_css();
		$css .= crocal_eutf_get_css_template( 'eut-dynamic-singular-css' );
		$css .= crocal_eutf_add_custom_page_css();
		if ( ! empty( $css ) ) {
			wp_add_inline_style( 'crocal-eutf-custom-style', crocal_eutf_compress_css( $css ) );
		}
	}
}

 /**
 * Get color array used in theme from theme options and predefined colors
 */
function crocal_eutf_get_color_array() {
	return array(
		'primary-1' => crocal_eutf_option( 'body_primary_1_color' ),
		'primary-2' => crocal_eutf_option( 'body_primary_2_color' ),
		'primary-3' => crocal_eutf_option( 'body_primary_3_color' ),
		'primary-4' => crocal_eutf_option( 'body_primary_4_color' ),
		'primary-5' => crocal_eutf_option( 'body_primary_5_color' ),
		'primary-6' => crocal_eutf_option( 'body_primary_6_color' ),
		'dark' => '#000000',
		'black' => '#000000',
		'light' => '#ffffff',
		'white' => '#ffffff',
		'green' => '#6ECA09',
		'red' => '#D0021B',
		'orange' => '#FAB901',
		'aqua' => '#28d2dc',
		'blue' => '#15c7ff',
		'purple' => '#7639e2',
		'grey' => '#808080',
		'dark-grey' => '#252525',
		'light-grey' => '#FAFAFA',
	);
}

function crocal_eutf_add_custom_page_css( $id = null ) {

	$crocal_eutf_custom_css = '';
	$crocal_eutf_woo_shop = crocal_eutf_is_woo_shop();

	if ( is_front_page() && is_home() ) {
		// Default homepage
		$mode = 'blog';
	} else if ( is_front_page() ) {
		// static homepage
		$mode = 'page';
	} else if ( is_home() ) {
		// blog page
		$mode = 'blog';
	} else if ( is_search() ) {
		$mode = 'search_page';
	} else if ( crocal_eutf_is_bbpress() ) {
		$mode = 'forum';
	} else if ( is_singular() || $crocal_eutf_woo_shop ) {
		if ( is_singular( 'post' ) ) {
			$mode = 'post';
		} else if ( is_singular( 'portfolio' ) ) {
			$mode = 'portfolio';
		} else if ( is_singular( 'product' ) ) {
			$mode = 'product';
		} else if ( is_singular( 'tribe_events' ) ) {
			$mode = 'event';
		} else if ( is_singular( 'tribe_organizer' ) || is_singular( 'tribe_venue' ) ) {
			$mode = 'event_tax';
		} else {
			$mode = 'page';
		}
	} else if ( is_archive() ) {
		if( crocal_eutf_is_woo_tax() ) {
			$mode = 'product_tax';
		} else if ( crocal_eutf_events_calendar_is_overview() || is_post_type_archive( 'tribe_events' ) ) {
			$mode = 'event_tax';
		} else {
			$mode = 'blog';
		}

	} else {
		$mode = 'page';
	}

	$crocal_eutf_page_title = array(
		'bg_color' => crocal_eutf_option( $mode . '_title_bg_color', 'dark' ),
		'bg_color_custom' => crocal_eutf_option( $mode . '_title_bg_color_custom', '#000000' ),
		'content_bg_color' => crocal_eutf_option( $mode . '_title_content_bg_color', 'none' ),
		'content_bg_color_custom' => crocal_eutf_option( $mode . '_title_content_bg_color_custom', '#ffffff' ),
		'title_color' => crocal_eutf_option( $mode . '_title_color', 'light' ),
		'title_color_custom' => crocal_eutf_option( $mode . '_title_color_custom', '#ffffff' ),
		'caption_color' => crocal_eutf_option( $mode . '_description_color', 'light' ),
		'caption_color_custom' => crocal_eutf_option( $mode . '_description_color_custom', '#ffffff' ),
		'color_overlay' => crocal_eutf_option( $mode . '_title_color_overlay' ),
		'color_overlay_custom' => crocal_eutf_option( $mode . '_title_color_overlay_custom' ),
		'opacity_overlay' => crocal_eutf_option( $mode . '_title_opacity_overlay' ),
	);

	if ( is_tag() || is_category() || crocal_eutf_is_woo_category() || crocal_eutf_is_woo_tag() ) {
		$category_id = get_queried_object_id();
		$crocal_eutf_custom_title_options = crocal_eutf_get_term_meta( $category_id, '_crocal_eutf_custom_title_options' );
		$crocal_eutf_page_title_custom = crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'custom' );
		if ( 'custom' == $crocal_eutf_page_title_custom ) {
			$crocal_eutf_page_title = $crocal_eutf_custom_title_options;
		}
	}


	if ( is_singular() || $crocal_eutf_woo_shop ) {

		if ( ! $id ) {
			if ( $crocal_eutf_woo_shop ) {
				$id = wc_get_page_id( 'shop' );
			} else {
				$id = get_the_ID();
			}
		}
		if ( $id ) {

			//Custom Title
			$crocal_eutf_custom_title_options = get_post_meta( $id, '_crocal_eutf_custom_title_options', true );
			$crocal_eutf_page_title_custom = crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'custom' );
			if ( !empty( $crocal_eutf_page_title_custom ) ) {
				$crocal_eutf_page_title = $crocal_eutf_custom_title_options;
			}

			//Feature Section
			$feature_section = get_post_meta( $id, '_crocal_eutf_feature_section', true );
			$feature_settings = crocal_eutf_array_value( $feature_section, 'feature_settings' );
			$feature_element = crocal_eutf_array_value( $feature_settings, 'element' );

			if ( !empty( $feature_element ) ) {

				switch( $feature_element ) {

					case 'title':
					case 'image':
					case 'video':
					case 'youtube':
						$single_item = crocal_eutf_array_value( $feature_section, 'single_item' );
						if ( !empty( $single_item ) ) {
							$crocal_eutf_custom_css .= crocal_eutf_get_feature_title_css( $single_item );
						}
						break;
					case 'slider':
						$slider_items = crocal_eutf_array_value( $feature_section, 'slider_items' );
						if ( !empty( $slider_items ) ) {
							foreach ( $slider_items as $item ) {
								$crocal_eutf_custom_css .= crocal_eutf_get_feature_title_css( $item, 'slider' );
							}
						}
						break;
					default:
						break;

				}

				if( 'revslider' != $feature_element ) {
					$crocal_eutf_custom_css .= crocal_eutf_get_feature_bg_css( $feature_settings );
				}
			}
		}
	}

	$crocal_eutf_custom_css .= crocal_eutf_get_title_css( $crocal_eutf_page_title );

	return $crocal_eutf_custom_css ;
}

function crocal_eutf_get_feature_bg_css( $feature_settings  ) {
	$crocal_eutf_custom_css = '';

	//Background Color
	$bg_color = crocal_eutf_array_value( $feature_settings, 'bg_color', 'dark' );

	if ( 'gradient' == $bg_color ) {
		$bg_gradient_color_1  = crocal_eutf_array_value( $feature_settings, 'bg_gradient_color_1', '#034e90' );
		$bg_gradient_color_1_rgba = crocal_eutf_get_hex2rgba( $bg_gradient_color_1 , 1 );
		$bg_gradient_color_2  = crocal_eutf_array_value( $feature_settings, 'bg_gradient_color_2', '#19b4d7' );
		$bg_gradient_color_2_rgba = crocal_eutf_get_hex2rgba( $bg_gradient_color_2 , 1 );
		$bg_gradient_direction  = crocal_eutf_array_value( $feature_settings, 'bg_gradient_direction', '90' );
	} else {
		$bg_color_custom = crocal_eutf_array_value( $feature_settings, 'bg_color_custom', '#000000' );
		$bg_color_custom = crocal_eutf_get_color( $bg_color, $bg_color_custom );
	}

	$feature_size = crocal_eutf_array_value( $feature_settings, 'size' );
	$feature_height = crocal_eutf_array_value( $feature_settings, 'height', '60' );
	$feature_min_height = crocal_eutf_array_value( $feature_settings, 'min_height', '200' );

	$crocal_eutf_custom_css .= '#eut-feature-section {';
	if ( 'gradient' == $bg_color ) {
		$crocal_eutf_custom_css .= crocal_eutf_get_css_color( 'background', $bg_gradient_color_1_rgba );
		$crocal_eutf_custom_css .= 'background: linear-gradient(' . $bg_gradient_direction . 'deg,' . $bg_gradient_color_1_rgba . ' 0%,' . $bg_gradient_color_2_rgba .' 100%);';
	} else {
		$crocal_eutf_custom_css .= 'background-color: ' . esc_attr( $bg_color_custom ) . ';';
	}
	if ( !empty($feature_size) ) {
		$crocal_eutf_custom_css .= 'min-height:' . esc_attr( $feature_min_height ) . 'px;';
	}
	$crocal_eutf_custom_css .= '}';

	if ( !empty($feature_size) ) {
		$crocal_eutf_custom_css .= '#eut-feature-section .eut-wrapper {';
		if ( is_numeric( $feature_height ) ) { //Custom Size
			$crocal_eutf_custom_css .= 'height:' . esc_attr( $feature_height ) . 'vh; min-height:' . esc_attr( $feature_min_height ) . 'px;';
		} else {
			$crocal_eutf_custom_css .= 'min-height:' . esc_attr( $feature_min_height ) . 'px;';
		}
		$crocal_eutf_custom_css .= '}';
	}

	//Separator
	$separator_bottom = crocal_eutf_array_value( $feature_settings, 'separator_bottom' );
	if( !empty ( $separator_bottom ) ) {
		$separator_bottom_size = crocal_eutf_array_value( $feature_settings, 'separator_bottom_size' );
		$crocal_eutf_custom_css .= '#eut-feature-section .eut-separator-bottom {';
		$crocal_eutf_custom_css .= 'height:' . esc_attr( $separator_bottom_size ) . ';';
		$crocal_eutf_custom_css .= '}';
	}


	return $crocal_eutf_custom_css;
}


function crocal_eutf_get_feature_title_css( $item, $type = 'single' ) {

	$crocal_eutf_custom_css = '';
	$custom_class = '';

	if( 'slider' == $type ) {
		$id = crocal_eutf_array_value( $item, 'id' );
		if ( !empty( $id ) ) {
			$custom_class = ' .eut-slider-item-id-' . $id ;
		}
	}

	$content_bg_color = crocal_eutf_array_value( $item, 'content_bg_color', 'none' );
	if ( 'custom' == $content_bg_color ) {
		$content_bg_color_custom = crocal_eutf_array_value( $item, 'content_bg_color_custom', '#ffffff' );
		$crocal_eutf_custom_css .= '#eut-feature-section' . esc_attr( $custom_class ) . ' .eut-title-content-wrapper {';
		$crocal_eutf_custom_css .= crocal_eutf_get_css_color( 'background-color', $content_bg_color_custom );
		$crocal_eutf_custom_css .= '}';
	}

	$subheading_color = crocal_eutf_array_value( $item, 'subheading_color', 'light' );
	if ( 'custom' == $subheading_color ) {
		$subheading_color_custom = crocal_eutf_array_value( $item, 'subheading_color_custom', '#ffffff' );
		$crocal_eutf_custom_css .= '#eut-feature-section' . esc_attr( $custom_class ) . ' .eut-subheading, #eut-feature-section' . esc_attr( $custom_class ) . ' .eut-title-meta {';
		$crocal_eutf_custom_css .= crocal_eutf_get_css_color( 'color', $subheading_color_custom );
		$crocal_eutf_custom_css .= '}';
	}

	$title_color = crocal_eutf_array_value( $item, 'title_color', 'light' );
	if ( 'custom' == $title_color ) {
		$title_color_custom = crocal_eutf_array_value( $item, 'title_color_custom', '#ffffff' );
		$crocal_eutf_custom_css .= '#eut-feature-section' . esc_attr( $custom_class ) . ' .eut-title {';
		$crocal_eutf_custom_css .= crocal_eutf_get_css_color( 'color', $title_color_custom );
		$crocal_eutf_custom_css .= '}';
	}

	$caption_color = crocal_eutf_array_value( $item, 'caption_color', 'light' );
	if ( 'custom' == $caption_color ) {
		$caption_color_custom = crocal_eutf_array_value( $item, 'caption_color_custom', '#ffffff' );
		$crocal_eutf_custom_css .= '#eut-feature-section' . esc_attr( $custom_class ) . ' .eut-description {';
		$crocal_eutf_custom_css .= crocal_eutf_get_css_color( 'color', $caption_color_custom );
		$crocal_eutf_custom_css .= '}';
	}

	$media_id = crocal_eutf_array_value( $item, 'content_image_id', '0' );
	$media_max_height = crocal_eutf_array_value( $item, 'content_image_max_height', '150' );
	$media_responsive_max_height = crocal_eutf_array_value( $item, 'content_image_responsive_max_height', '50' );

	if( '0' != $media_id ) {
		$crocal_eutf_custom_css .= '#eut-feature-section' . esc_attr( $custom_class ) . ' .eut-content .eut-graphic img  {';
		$crocal_eutf_custom_css .= 'max-height:' . esc_attr( $media_max_height ) .'px;';
		$crocal_eutf_custom_css .= '}';

		$crocal_eutf_custom_css .= '@media only screen and (max-width: 768px) {';
		$crocal_eutf_custom_css .= '#eut-feature-section' . esc_attr( $custom_class ) . ' .eut-content .eut-graphic img  {';
		$crocal_eutf_custom_css .= 'max-height:' . esc_attr( $media_responsive_max_height ) .'px;';
		$crocal_eutf_custom_css .= '}';
		$crocal_eutf_custom_css .= '}';
	}

	//Arrow
	$arrow_enabled = crocal_eutf_array_value( $item, 'arrow_enabled', 'no' );
	if( 'no' != $arrow_enabled ) {
		$arrow_color = crocal_eutf_array_value( $item, 'arrow_color', 'light' );
		$arrow_color_custom = crocal_eutf_array_value( $item, 'arrow_color_custom', '#ffffff' );
		$arrow_color_custom = crocal_eutf_get_color( $arrow_color, $arrow_color_custom );

		$crocal_eutf_custom_css .= '#eut-feature-section' . esc_attr( $custom_class ) . ' .eut-goto-section {';
		$crocal_eutf_custom_css .= 'color:' . esc_attr( $arrow_color_custom ) .';';
		$crocal_eutf_custom_css .= '}';
	}
	//Overlay
	$color_overlay = crocal_eutf_array_value( $item, 'color_overlay', 'dark' );
	$opacity_overlay = crocal_eutf_array_value( $item, 'opacity_overlay', '0' );

	if ( 'gradient' == $color_overlay ) {
		$gradient_overlay_custom_1 = crocal_eutf_array_value( $item, 'gradient_overlay_custom_1', '#034e90' );
		$gradient_overlay_custom_1_opacity = crocal_eutf_array_value( $item, 'gradient_overlay_custom_1_opacity', '0.90' );
		$gradient_overlay_custom_1_rgba = crocal_eutf_get_hex2rgba( $gradient_overlay_custom_1 , $gradient_overlay_custom_1_opacity );
		$gradient_overlay_custom_2 = crocal_eutf_array_value( $item, 'gradient_overlay_custom_2', '#19b4d7' );
		$gradient_overlay_custom_2_opacity = crocal_eutf_array_value( $item, 'gradient_overlay_custom_2_opacity', '0.90' );
		$gradient_overlay_custom_2_rgba = crocal_eutf_get_hex2rgba( $gradient_overlay_custom_2 , $gradient_overlay_custom_2_opacity );
		$gradient_overlay_direction  = crocal_eutf_array_value( $item, 'gradient_overlay_direction', '90' );
	} else {
		$color_overlay_custom = crocal_eutf_array_value( $item, 'color_overlay_custom', '#000000' );
		$color_overlay_custom = crocal_eutf_get_color( $color_overlay, $color_overlay_custom );
		$overlay_rgba = crocal_eutf_get_hex2rgba( $color_overlay_custom , $opacity_overlay );
	}
	if ( 'gradient' == $color_overlay ) {
		$crocal_eutf_custom_css .= '#eut-feature-section' . esc_attr( $custom_class ) . ' .eut-bg-overlay {';
		$crocal_eutf_custom_css .= 'background:' . esc_attr( $gradient_overlay_custom_1_rgba ) . ';';
		$crocal_eutf_custom_css .= 'background: linear-gradient(' . esc_attr( $gradient_overlay_direction ) . 'deg,' . esc_attr( $gradient_overlay_custom_1_rgba ) . ' 0%,' . esc_attr( $gradient_overlay_custom_2_rgba ) . ' 100%);';
		$crocal_eutf_custom_css .= '}';
	} else {
		if ( '0' != $opacity_overlay && !empty( $opacity_overlay ) ) {
			$crocal_eutf_custom_css .= '#eut-feature-section' . esc_attr( $custom_class ) . ' .eut-bg-overlay {';
			$crocal_eutf_custom_css .= 'background-color:' . esc_attr( $overlay_rgba ) . ';';
			$crocal_eutf_custom_css .= '}';
		}
	}

	return $crocal_eutf_custom_css;

}

function crocal_eutf_get_title_css( $title ) {
	$crocal_eutf_custom_css = '';

	$bg_color = crocal_eutf_array_value( $title, 'bg_color', 'dark' );
	if ( 'custom' == $bg_color ) {
		$bg_color_custom = crocal_eutf_array_value( $title, 'bg_color_custom', '#000000' );
		$crocal_eutf_custom_css .= '.eut-page-title {';
		$crocal_eutf_custom_css .= crocal_eutf_get_css_color( 'background-color', $bg_color_custom );
		$crocal_eutf_custom_css .= '}';
	}

	$content_bg_color = crocal_eutf_array_value( $title, 'content_bg_color', 'none' );
	if ( 'custom' == $content_bg_color ) {
		$content_bg_color_custom = crocal_eutf_array_value( $title, 'content_bg_color_custom', '#ffffff' );
		$crocal_eutf_custom_css .= '.eut-page-title .eut-title-content-wrapper {';
		$crocal_eutf_custom_css .= crocal_eutf_get_css_color( 'background-color', $content_bg_color_custom );
		$crocal_eutf_custom_css .= '}';
	}

	$subheading_color = crocal_eutf_array_value( $title, 'subheading_color', 'light' );
	if ( 'custom' == $subheading_color ) {
		$subheading_color_custom = crocal_eutf_array_value( $title, 'subheading_color_custom', '#ffffff' );
		$crocal_eutf_custom_css .= '.eut-page-title .eut-title-categories, .eut-page-title .eut-title-meta {';
		$crocal_eutf_custom_css .= crocal_eutf_get_css_color( 'color', $subheading_color_custom );
		$crocal_eutf_custom_css .= '}';
	}

	$title_color = crocal_eutf_array_value( $title, 'title_color', 'light' );
	if ( 'custom' == $title_color ) {
		$title_color_custom = crocal_eutf_array_value( $title, 'title_color_custom', '#ffffff' );
		$crocal_eutf_custom_css .= '.eut-page-title .eut-title, .eut-page-title .eut-title-meta {';
		$crocal_eutf_custom_css .= crocal_eutf_get_css_color( 'color', $title_color_custom );
		$crocal_eutf_custom_css .= '}';
	}

	$caption_color = crocal_eutf_array_value( $title, 'caption_color', 'light' );
	if ( 'custom' == $caption_color ) {
		$caption_color_custom = crocal_eutf_array_value( $title, 'caption_color_custom', '#ffffff' );
		$crocal_eutf_custom_css .= '.eut-page-title .eut-description {';
		$crocal_eutf_custom_css .= crocal_eutf_get_css_color( 'color', $caption_color_custom );
		$crocal_eutf_custom_css .= '}';
	}

	$page_title_height = crocal_eutf_array_value( $title, 'height', '40' );
	$page_title_min_height = crocal_eutf_array_value( $title, 'min_height', '200' );

	$crocal_eutf_custom_css .= '.eut-page-title {';
	$crocal_eutf_custom_css .= 'min-height:' . esc_attr( $page_title_min_height ) . 'px;';
	$crocal_eutf_custom_css .= '}';

	$crocal_eutf_custom_css .= '.eut-page-title .eut-wrapper {';
	if ( is_numeric( $page_title_height ) ) { //Custom Size
		$crocal_eutf_custom_css .= 'height:' . esc_attr( $page_title_height ) . 'vh; min-height:' . esc_attr( $page_title_min_height ) . 'px;';
	} else {
		$crocal_eutf_custom_css .= 'min-height:' . esc_attr( $page_title_min_height ) . 'px;';
	}
	$crocal_eutf_custom_css .= '}';

	//Overlay
	$color_overlay = crocal_eutf_array_value( $title, 'color_overlay', 'dark' );
	$opacity_overlay = crocal_eutf_array_value( $title, 'opacity_overlay', '0' );
	$color_overlay_custom = crocal_eutf_array_value( $title, 'color_overlay_custom', '#000000' );
	$color_overlay_custom = crocal_eutf_get_color( $color_overlay, $color_overlay_custom );
	$overlay_rgba = crocal_eutf_get_hex2rgba( $color_overlay_custom , $opacity_overlay );
	if ( '0' != $opacity_overlay && !empty( $opacity_overlay ) ) {
		$crocal_eutf_custom_css .= '.eut-page-title .eut-bg-overlay {';
		$crocal_eutf_custom_css .= 'background-color:' . esc_attr( $overlay_rgba ) . ';';
		$crocal_eutf_custom_css .= '}';
	}

	return $crocal_eutf_custom_css;
}



 /**
 * Get Button classes
 */
function crocal_eutf_get_button_classes() {
	$classes = array(
		'.eut-modal input[type="submit"]:not(.eut-custom-btn)',
		'.wpcf7 input[type="submit"]:not(.eut-custom-btn)',
		'#eut-theme-wrapper .eut-btn-theme-style button:not(.eut-custom-btn)',
		'#eut-theme-wrapper .eut-btn-theme-style input[type="button"]:not(.eut-custom-btn)',
		'#eut-theme-wrapper .eut-btn-theme-style input[type="submit"]:not(.eut-custom-btn)',
		'#eut-theme-wrapper .eut-btn-theme-style input[type="reset"]:not(.eut-custom-btn)',
		'#eut-comment-submit-button',
		'#eut-theme-wrapper .woocommerce .checkout-button',
		'#eut-theme-wrapper .woocommerce .woocommerce-cart-form button',
		'#eut-theme-wrapper .woocommerce .woocommerce-form-coupon button',
		'#eut-theme-wrapper .woocommerce .woocommerce-checkout-payment button',
		'#eut-woo-review-submit',
		'.post-password-form input[type="submit"]',
		'.eut-portfolio-details-btn.eut-btn:not(.eut-custom-btn)',
		'.gform_body input[type="button"]',
		'.gform_body input[type="submit"]',
		'.gform_body input[type="reset"]',
		'#tribe-bar-form .tribe-bar-submit input[type=submit]',
		'.bbp-submit-wrapper button',
		'#bbpress-forums #bbp_search_submit',
	);

	return apply_filters( 'crocal_eutf_button_classes', $classes );
}

function crocal_eutf_get_button_hover_classes() {
	$array = crocal_eutf_get_button_classes();
	foreach ($array as &$value){
	    $value .= ':hover';
	}

	return $array;
}

function crocal_eutf_get_global_button_style() {

	$crocal_eutf_custom_css = "";

	$button_type = crocal_eutf_option( 'button_type', 'simple' );
	$button_shape = crocal_eutf_option( 'button_shape', 'square' );
	$button_color = crocal_eutf_option( 'button_color', 'primary-1' );
	$button_hover_color = crocal_eutf_option( 'button_hover_color', 'black' );

	$crocal_eutf_colors = crocal_eutf_get_color_array();

	$crocal_eutf_custom_css .= implode( ',', crocal_eutf_get_button_classes() ) . "{";
	$crocal_eutf_custom_css .= "
		display: inline-block;
		padding: 0.857em 1.714em;
		min-width: 10em;
		line-height: 1.4;
		position: relative;
		-webkit-border-radius: 0;
		border-radius: 0;
		z-index: 2;
		vertical-align: top;
		outline: 0;
		text-align: center;
		cursor: pointer;
		border: 1px solid transparent;
		box-sizing: border-box;
		word-wrap: break-word;
		-webkit-appearance: none;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		text-decoration: none;
		position: relative;
		overflow: hidden;
		-webkit-transition : color .5s ease, background-color .5s ease, border-color .5s ease;
		-moz-transition    : color .5s ease, background-color .5s ease, border-color .5s ease;
		-o-transition      : color .5s ease, background-color .5s ease, border-color .5s ease;
		-ms-transition     : color .5s ease, background-color .5s ease, border-color .5s ease;
		transition         : color .5s ease, background-color .5s ease, border-color .5s ease;
		-ms-touch-action: manipulation;
		touch-action: manipulation;
	";
		switch( $button_shape ) {
			case "round":
				$crocal_eutf_custom_css .= "-webkit-border-radius: 3px;";
				$crocal_eutf_custom_css .= "border-radius: 3px;";
			break;
			case "extra-round":
				$crocal_eutf_custom_css .= "-webkit-border-radius: 50px;";
				$crocal_eutf_custom_css .= "border-radius: 50px;";
			break;
			case "square":
			default:
			break;
		}

		$default_color = crocal_eutf_option( 'body_primary_1_color' );
		$color = crocal_eutf_array_value( $crocal_eutf_colors, $button_color, $default_color );

		if ( "outline" == $button_type ) {

			$crocal_eutf_custom_css .= "border: 2px solid;";
			$crocal_eutf_custom_css .= "background-color: transparent;";
			$crocal_eutf_custom_css .= "border-color: " . esc_attr( $color ) . ";";
			$crocal_eutf_custom_css .= "color: " . esc_attr( $color ) . ";";

		} else {
			$crocal_eutf_custom_css .= "background-color: " . esc_attr( $color ) . ";";
			if ( 'white' == $button_color ) {
				$crocal_eutf_custom_css .= "color: #bababa;";
			} else {
				$crocal_eutf_custom_css .= "color: #ffffff;";
			}
		}

	$crocal_eutf_custom_css .= "}";

	$crocal_eutf_custom_css .= implode( ',', crocal_eutf_get_button_hover_classes() ) . "{";

	$hover_color = crocal_eutf_array_value( $crocal_eutf_colors, $button_hover_color, "#bababa" );

	if ( "outline" == $button_type ) {

		$crocal_eutf_custom_css .= "background-color: " . esc_attr( $hover_color ) . ";";
		$crocal_eutf_custom_css .= "border-color: " . esc_attr( $hover_color ) . ";";
		if ( 'white' == $button_hover_color ) {
			$crocal_eutf_custom_css .= "color: #bababa;";
		} else {
			$crocal_eutf_custom_css .= "color: #ffffff;";
		}

	} else {
		$crocal_eutf_custom_css .= "background-color: " . esc_attr( $hover_color ) . ";";
		if ( 'white' == $button_hover_color ) {
			$crocal_eutf_custom_css .= "color: #bababa;";
		} else {
			$crocal_eutf_custom_css .= "color: #ffffff;";
		}
	}

	$crocal_eutf_custom_css .= "}";

	return $crocal_eutf_custom_css;
}


function crocal_eutf_get_global_shape_style() {
	$crocal_eutf_custom_css = "";

	$global_shape = crocal_eutf_option( 'button_shape', 'square' );

	$crocal_eutf_custom_css .= "#eut-related-post .eut-related-title, .eut-nav-btn a, #eut-single-post-categories .eut-categories li a, #eut-theme-wrapper .eut-search:not(.eut-search-modal) input[type='text'], #eut-socials-modal .eut-social li a, .eut-pagination ul li, .eut-dropcap span.eut-style-2, .eut-menu-type-button > a .eut-item {";
	switch( $global_shape ) {
		case "round":
			$crocal_eutf_custom_css .= "-webkit-border-radius: 3px !important;";
			$crocal_eutf_custom_css .= "border-radius: 3px !important;";
		break;
		case "extra-round":
			$crocal_eutf_custom_css .= "-webkit-border-radius: 50px !important;";
			$crocal_eutf_custom_css .= "border-radius: 50px !important;";
		break;
		case "square":
		default:
		break;
	}
	$crocal_eutf_custom_css .= "}";

	return $crocal_eutf_custom_css;

}

function crocal_eutf_get_background_css( $value = array() ) {

	$css = '';

	if ( ! empty( $value ) && is_array( $value ) ) {
		foreach ( $value as $key => $value ) {
			if ( ! empty( $value ) && $key != "media" && $key != "skin" && $key != "heading_color" && $key != "text_color"  ) {
				if ( $key == "background-image" ) {
					$css .= $key . ":url('" . $value . "');";
				} else {
					$css .= $key . ":" . $value . ";";
				}
			}
		}
	}

	return $css;
}

 /**
 * Add dynamic CSS for Page Builder
 */
function crocal_eutf_load_dynamic_selector_css() {

	$colors = crocal_eutf_get_color_array();
	$css = '';
	foreach ( $colors as $key => $value ) {
		$font_color = '#ffffff';
		if( 'white' == $key || 'light' == $key ) {
			$font_color = '#000000';
		}
		$css .= "
			.eut-colored-dropdown ." . esc_attr( $key ) . " {
				background-color: " . esc_attr( $value ) . ";
				color: " . esc_attr( $font_color ) . ";
			}
		";
	}
	wp_add_inline_style( 'crocal-ext-vc-elements', crocal_eutf_compress_css( $css ) );

}
add_action( 'admin_enqueue_scripts' , 'crocal_eutf_load_dynamic_selector_css', 11 );

//Omit closing PHP tag to avoid accidental whitespace output errors.
