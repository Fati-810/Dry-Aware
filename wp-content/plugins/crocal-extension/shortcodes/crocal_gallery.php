<?php
/**
 * Gallery Shortcode
 */

if( !function_exists( 'crocal_ext_vce_gallery_shortcode' ) ) {

	function crocal_ext_vce_gallery_shortcode( $attr, $content ) {

		$output = $start_block = $end_block = $item_class = $class_fullwidth = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'text_style' => 'none',
					'align' => 'left',
					'ids' => '',
					'gallery_mode' => 'grid',
					'grid_image_mode' => 'square',
					'masonry_image_mode' => '',
					'image_link_mode' => 'popup',
					'image_popup_size' => 'extra-extra-large',
					'carousel_image_mode' => 'landscape',
					'columns_large_screen' => '3',
					'columns' => '3',
					'columns_tablet_landscape' => '2',
					'columns_tablet_portrait' => '2',
					'columns_mobile' => '1',
					'item_gutter' => 'yes',
					'gutter_size' => '40',
					'shadow' => '',
					'radius' => '',
					'image_title_caption' => 'none',
					'image_title_heading_tag' => 'h3',
					'image_title_heading' => 'h3',
					'image_title_custom_font_family' => '',
					'image_hover_style' => 'hover-style-1',
					'image_content_bg_color' => 'white',
					'zoom_effect' => 'none',
					'grayscale_effect' => 'none',
					'overlay_color' => 'light',
					'overlay_opacity' => '90',
					'items_per_page' => '4',
					'items_tablet_landscape' => '3',
					'items_tablet_portrait' => '3',
					'items_mobile' => '1',

					'stage_padding' => '250',
					'stage_padding_large_screen' => '100',
					'stage_padding_tablet_landscape' => '200',
					'stage_padding_tablet_portrait' => '100',
					'stage_padding_mobile' => '30',

					'slideshow_speed' => '3000',
					'loop' => 'yes',
					'auto_play' => 'yes',
					'navigation_type' => '1',
					'navigation_color' => 'dark',
					'pause_hover' => 'no',
					'carousel_pagination' => 'no',
					'carousel_pagination_speed' => '400',
					'animation' => 'eut-zoom-in',
					'margin_bottom' => '',
					'el_class' => '',
					'multi_popup_links' => '',
					'custom_links' => '',
					'custom_links_target' => '_self',
					'gallery_filter' => '',
					'filter_values' => '',
					'filter_style' => 'simple',
					'filter_shape' => 'square',
					'filter_color' => 'primary-1',
					'filter_align' => 'left',
					'filter_order_by' => '',
					'filter_order' => 'ASC',
					'filter_gototop' => 'yes',
				),
				$attr
			)
		);

		$attachments = explode( ",", $ids );

		if ( empty( $attachments ) ) {
			return '';
		}

		// Image Effect
		$image_effect_classes = array( 'eut-image-hover' );
		if ( 'none' != $zoom_effect ) {
			array_push( $image_effect_classes, 'eut-zoom-' . $zoom_effect );
		}
		if ( 'none' != $grayscale_effect ) {
			array_push( $image_effect_classes, 'eut-' . $grayscale_effect );
		}
		if ( !empty( $shadow ) ) {
			array_push( $image_effect_classes, 'eut-' . $shadow );
		}
		if ( !empty( $radius ) ) {
			array_push( $image_effect_classes, 'eut-' . $radius );
		}
		$image_effect_class_string = implode( ' ', $image_effect_classes );

		//Gallery Classes
		$gallery_classes = array( 'eut-element', 'eut-gallery' , 'eut-isotope' );


		$multi_popup_data = array();

		if ( 'custom_link' == $image_link_mode ) {
			$custom_links = vc_value_from_safe( $custom_links );
			$custom_links = explode( ',', $custom_links );
		} elseif ( 'popup' == $image_link_mode ) {
			array_push( $gallery_classes, 'eut-gallery-popup' );
		} elseif ( 'multi_popup' == $image_link_mode ) {
			array_push( $gallery_classes, 'eut-gallery-popup' );
			$multi_popup_links = vc_value_from_safe( $multi_popup_links );

			if( !empty( $multi_popup_links ) ) {
				$multi_popup_lines = explode( ',', $multi_popup_links );
				foreach ($multi_popup_lines as $line) {
					$new_line = array();
					$data = explode("|", $line);
					$index = isset( $data[0] ) && !empty( $data[0] ) ? $data[0] : 1;
					$url = isset( $data[1] ) && !empty( $data[1] ) ? $data[1] : '#';
					$multi_popup_data[$index] = $url;
				}
			}
		}

		//Gallery Carousel Classes
		$gallery_carousel_classes = array( 'eut-element', 'eut-carousel' );

		if ( !empty( $el_class ) ) {
			array_push( $gallery_classes, $el_class);
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$data_string = '';

		$allow_filter = 'yes';
		$data_lazyload = 'auto';
		switch( $gallery_mode ) {
			case 'masonry':
				$data_string = ' data-columns="' . esc_attr( $columns ) . '" data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '" data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '" data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '" data-columns-mobile="' . esc_attr( $columns_mobile ) . '" data-layout="masonry"';
				if ( 'yes' == $item_gutter ) {
					$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
				}
				if ( 'yes' == $item_gutter ) {
					array_push( $gallery_classes, 'eut-with-gap' );
				}
				break;
			case 'carousel':
				$data_string .= ' data-items="' . esc_attr( $items_per_page ) . '"';
				$data_string .= ' data-items-tablet-landscape="' . esc_attr( $items_tablet_landscape ) . '"';
				$data_string .= ' data-items-tablet-portrait="' . esc_attr( $items_tablet_portrait ) . '"';
				$data_string .= ' data-items-mobile="' . esc_attr( $items_mobile ) . '"';
				$data_string .= ' data-slider-autoplay="' . esc_attr( $auto_play ) . '"';
				$data_string .= ' data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
				$data_string .= ' data-slider-pause="' . esc_attr( $pause_hover ) . '"';
				$data_string .= ' data-pagination-speed="' . esc_attr( $carousel_pagination_speed ) . '"';
				$data_string .= ' data-pagination="' . esc_attr( $carousel_pagination ) . '"';
				$data_string .= ' data-pagination-color="' . esc_attr( $navigation_color ) . '"';
				$data_string .= ' data-slider-loop="' . esc_attr( $loop ) . '"';
				if ( 'yes' == $item_gutter ) {
					$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
					array_push( $gallery_carousel_classes, 'eut-with-gap' );
				}
				$allow_filter = 'no';
				$data_lazyload = 'no';
				break;
			case 'advanced-carousel':
				$data_string .= ' data-stage-padding="' . esc_attr( $stage_padding ) . '"';
				$data_string .= ' data-stage-padding-large-screen="' . esc_attr( $stage_padding_large_screen ) . '"';
				$data_string .= ' data-stage-padding-tablet-landscape="' . esc_attr( $stage_padding_tablet_landscape ) . '"';
				$data_string .= ' data-stage-padding-tablet-portrait="' . esc_attr( $stage_padding_tablet_portrait ) . '"';
				$data_string .= ' data-stage-padding-mobile="' . esc_attr( $stage_padding_mobile ) . '"';
				$data_string .= ' data-slider-autoplay="' . esc_attr( $auto_play ) . '"';
				$data_string .= ' data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
				$data_string .= ' data-slider-pause="' . esc_attr( $pause_hover ) . '"';
				$data_string .= ' data-pagination-speed="' . esc_attr( $carousel_pagination_speed ) . '"';
				$data_string .= ' data-pagination="' . esc_attr( $carousel_pagination ) . '"';
				$data_string .= ' data-pagination-color="' . esc_attr( $navigation_color ) . '"';
				$data_string .= ' data-slider-loop="' . esc_attr( $loop ) . '"';
				if ( 'yes' == $item_gutter ) {
					$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
					array_push( $gallery_carousel_classes, 'eut-with-gap' );
				}
				$allow_filter = 'no';
				$data_lazyload = 'no';
				break;
			case 'grid':
			default:
				$data_string = ' data-columns="' . esc_attr( $columns ) . '" data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '" data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '" data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '" data-columns-mobile="' . esc_attr( $columns_mobile ) . '" data-layout="fitRows"';
				if ( 'yes' == $item_gutter ) {
					$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
				}
				if ( 'yes' == $item_gutter ) {
					array_push( $gallery_classes, 'eut-with-gap' );
				}
				break;
		}
		$gallery_class_string = implode( ' ', $gallery_classes );
		$gallery_carousel_class_string = implode( ' ', $gallery_carousel_classes );


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


		$title_classes = array( 'eut-title' );
		$title_classes[]  = 'eut-' . $heading;
		if ( !empty( $custom_font_family ) ) {
			$title_classes[]  = 'eut-' . $custom_font_family;
		}
		$title_class_string = implode( ' ', $title_classes );

		$image_title_classes = array( 'eut-title' );
		$image_title_classes[]  = 'eut-' . $image_title_heading;
		$image_title_classes[]  = 'eut-text-' . $title_color;
		if ( !empty( $image_title_custom_font_family ) ) {
			$image_title_classes[]  = 'eut-' . $image_title_custom_font_family;
		}
		$image_title_class_string = implode( ' ', $image_title_classes );

		if ( 'carousel' == $gallery_mode ) {
			//Gallery Output ( carousel )

			$image_size = crocal_ext_vce_get_image_size( $carousel_image_mode );

			$output .= '<div class="' . esc_attr( $gallery_carousel_class_string ) . '" style="' . $style . '">';
			$output .= '  <div class="eut-carousel-wrapper">';

			$output .= crocal_ext_vce_element_navigation( $navigation_type, $navigation_color, 'carousel' );
			if ( 'popup' == $image_link_mode || 'multi_popup' == $image_link_mode ) {
				$output .= '    <div class="eut-carousel-element owl-carousel eut-gallery-popup ' . esc_attr( $el_class ) . '"' . $data_string . '>';
			} else {
				$output .= '    <div class="eut-carousel-element owl-carousel ' . esc_attr( $el_class ) . '"' . $data_string . '>';
			}
		} else if ( 'advanced-carousel' == $gallery_mode ) {
			//Gallery Output ( carousel )

			$image_size = crocal_ext_vce_get_image_size( $carousel_image_mode );

			$output .= '<div class="' . esc_attr( $gallery_carousel_class_string ) . '" style="' . $style . '">';

			$output .= '  <div class="eut-carousel-wrapper">';

			if ( 'popup' == $image_link_mode || 'multi_popup' == $image_link_mode ) {
				$output .= '    <div class="eut-advanced-carousel owl-carousel eut-gallery-popup ' . esc_attr( $el_class ) . '"' . $data_string . '>';
			} else {
				$output .= '    <div class="eut-advanced-carousel owl-carousel ' . esc_attr( $el_class ) . '"' . $data_string . '>';
			}
		} else {
			//Gallery Output ( grid / masonry)

			if ( 'masonry' == $gallery_mode ) {
				$image_size = crocal_ext_vce_get_image_size( $masonry_image_mode );
			} else {
				$image_size = crocal_ext_vce_get_image_size( $grid_image_mode );
			}

			$output .= '<div class="' . esc_attr( $gallery_class_string ) . '" style="' . $style . '"' . $data_string . '>';

			if ( 'yes' == $gallery_filter && 'yes' == $allow_filter ) {

				$category_filter_prefix = 'gallery-category-';
				$category_filter_classes = array();

				$category_filter_list = array();
				$gallery_categories = array();

				$filter_values = explode( ',', $filter_values );
				$filter_index = 0;
				$image_index = 0;

				foreach( $filter_values as $filter_value){
					$image_categories = explode( '|', $filter_value );
					$category_filter_classes[$image_index] = "";
					foreach( $image_categories as $image_category ){
						if ( !in_array( $image_category, $category_filter_list ) ) {
							$category_filter_list[] = $image_category;
							$gallery_categories[] = array(
								'term_id' => $filter_index,
								'slug' => sanitize_html_class( $image_category, $filter_index  + 1 ),
								'name' => $image_category,
							);
							$category_filter_classes[$image_index] .= " " . $category_filter_prefix . sanitize_html_class( $image_category, $filter_index + 1 );
							$filter_index++;
						} else {
							$index = array_search( $image_category, $category_filter_list );
							$category_filter_classes[$image_index] .= " " . $category_filter_prefix . sanitize_html_class( $image_category, $index + 1 );
						}
					}
					$image_index++;
				}

				$filter_classes = array( 'eut-filter' );

				array_push( $filter_classes, 'eut-filter-style-' . $filter_style );
				array_push( $filter_classes, 'eut-align-' . $filter_align);
				array_push( $filter_classes, 'eut-link-text');

				if ( 'button' == $filter_style ) {
					array_push( $filter_classes, 'eut-link-text');
					array_push( $filter_classes, 'eut-filter-shape-' . $filter_shape );
					array_push( $filter_classes, 'eut-filter-color-' . $filter_color );
				}

				$filter_class_string = implode( ' ', $filter_classes );

				$category_prefix = '.gallery-category-';
				$category_filter_array = array();
				$all_string =  apply_filters( 'crocal_eutf_vce_gallery_string_all_categories', esc_html__( 'All', 'crocal-extension' ) );
				$category_filter_string = '<li data-filter="*" class="selected"><span>' . esc_html( $all_string ) . '</span></li>';
				$category_filter_add = false;

				foreach($gallery_categories as $category_term){
					if ( 'title' == $filter_order_by ) {
						$filter_by = $category_term['name'];
					} else {
						$filter_by = $category_term['term_id'];
					}
					$category_filter_array[$filter_by] = $category_term;
				}

				if ( count( $category_filter_array ) > 1 ) {
					if ( '' != $filter_order_by ) {
						if ( 'ASC' == $filter_order ) {
							ksort( $category_filter_array );
						} else {
							krsort( $category_filter_array );
						}
					}
					foreach($category_filter_array as $category_filter){
						$category_filter_string .= '<li data-filter="' . $category_prefix . $category_filter['slug'] . '"><span>' . $category_filter['name'] . '</span></li>';
					}

					$output .= '<div class="' . esc_attr( $filter_class_string ) . '" data-gototop="' . esc_attr( $filter_gototop ) . '">';
					$output .= '<ul>';
					$output .= $category_filter_string;
					$output .= '</ul>';
					$output .= '</div>';
				}
			}

			$output .= '  <div class="eut-isotope-container">';
		}

			$gallery_index = 0;
			$i = -1;
			$image_size_class = '';

			$image_popup_size_mode = crocal_ext_vce_get_image_size( $image_popup_size );

			foreach ( $attachments as $id ) {

				$gallery_index++;
				$i++;

				if ( 'masonry' == $gallery_mode && empty( $masonry_image_mode ) ) {
					$crocal_ext_masonry_data = crocal_ext_vce_get_masonry_data( $gallery_index, $columns );
					$image_size_class = ' ' . $crocal_ext_masonry_data['class'];
					$image_size = $crocal_ext_masonry_data['image_size'];
				}

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
				$data_html = '';
				if( 'yes' == $show_title ){
					$data_html .= '<span class="eut-title">' . $image_title . '</span>';
				}
				if( 'yes' == $show_caption ){
					$data_html .= '<span class="eut-caption">' . $image_caption . '</span>';
				}
				if ( !empty( $data_html ) ) {
					$link_data .= ' data-sub-html="' . esc_attr( $data_html ) . '"';
				}
				if ( 'popup' == $image_link_mode ) {
					$link_data .= ' data-size="' . esc_attr( $full_src[1] ) . 'x' . esc_attr( $full_src[2] ) . '"';
				}

				if ( 'carousel' == $gallery_mode || 'advanced-carousel' == $gallery_mode ) {
					$output .= '<div class="eut-carousel-item eut-hover-item eut-' . esc_attr( $image_hover_style ) . '">';
				} else {

					$image_categories_classes = "";
					if ( 'yes' == $gallery_filter && isset( $category_filter_classes[ $i ] ) && !empty(  $category_filter_classes[ $i ] )  ) {
						$image_categories_classes .= $category_filter_classes[ $i ];
					}

					$output .= '<div class="eut-isotope-item eut-hover-item eut-' . esc_attr( $image_hover_style ) . '' . $image_size_class . $image_categories_classes . '">';
					if ( !empty( $animation ) ) {
						$output .= '<div class="eut-isotope-item-inner ' . esc_attr( $animation ) . '">';
					}
				}

				//Figure
				$output .= '  <figure class="' . esc_attr( $image_effect_class_string ) . '">';

				if ( 'popup' == $image_link_mode ) {
					$output .= '<a class="eut-item-url" href="' . esc_url( $full_src[0] ) . '" ' . $link_data . '></a>';
				} elseif ( 'multi_popup' == $image_link_mode ) {
					 if( !empty( $multi_popup_data ) && isset( $multi_popup_data[ $gallery_index ] ) && !empty(  $multi_popup_data[ $gallery_index ] ) ) {
						 $output .= '<a class="eut-item-url" href="' . esc_url( $multi_popup_data[ $gallery_index ] ) . '" ' . $link_data . '></a>';
						 $output .= crocal_ext_vce_get_video_icon( 'primary-1' );
					 } else {
						 $output .= '<a class="eut-item-url" href="' . esc_url( $full_src[0] ) . '" ' . $link_data . '></a>';
					 }
				} elseif ( 'custom_link' == $image_link_mode && isset( $custom_links[ $i ] ) && !empty(  $custom_links[ $i ] )  ) {
					$output .= '<a class="eut-item-url" href="' . esc_url( $custom_links[ $i ] ) . '" target="' . esc_attr( $custom_links_target ) . '" ' . $link_data . '></a>';
				}
				if( 'hover-style-6' != $image_hover_style ){
					$output .= '<div class="eut-hover-overlay eut-bg-' . esc_attr( $overlay_color ) . ' eut-opacity-' . esc_attr( $overlay_opacity ) . '"></div>';
				} else {
					$output .= '<div class="eut-gradient-overlay eut-gradient-' . esc_attr( $overlay_color ) . ' eut-gradient-opacity-' . esc_attr( $overlay_opacity ) .'"></div>';
				}

				$output .= '<div class="eut-media">';
				$output .= crocal_ext_vce_get_attachment_image( $id, $image_size , "", array( 'data-column-space' => 100, 'data-lazyload' => $data_lazyload ) );
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

				if ( 'carousel' == $gallery_mode || 'advanced-carousel' == $gallery_mode ) {
					$output .= '</div>';
				} else {
					if ( !empty( $animation ) ) {
						$output .= '</div>';
					}
					$output .= '</div>';
				}

			}

		if ( 'carousel' == $gallery_mode || 'advanced-carousel' == $gallery_mode ) {
			$output .= '	  </div>';
			$output .= '	</div>';
			$output .= '</div>';
		} else {
			$output .= '  </div>';
			$output .= '</div>';
		}

		return $output;

	}
	add_shortcode( 'crocal_gallery', 'crocal_ext_vce_gallery_shortcode' );

}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Crocal_Gallery extends WPBakeryShortCode {
		public function singleParamHtmlHolder( $param, $value ) {
			$output = '';
			$output = parent::singleParamHtmlHolder( $param, $value );
			$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
			if ( 'ids' === $param_name ) {
				$images_ids = empty( $value ) ? array() : explode( ',', trim( $value ) );
				$output .= '<ul class="attachment-thumbnails' . ( empty( $images_ids ) ? ' image-exists' : '' ) . '" data-name="' . esc_attr( $param_name ) . '">';
				foreach ( $images_ids as $image ) {
					$img = wpb_getImageBySize( array(
						'attach_id' => (int) $image,
						'thumb_size' => 'thumbnail',
					) );
					$output .= ( $img ? '<li>' . $img['thumbnail'] . '</li>' : '<li><img width="150" height="150" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail" alt="" title="" /></li>' );
				}
				$output .= '</ul>';
				$output .= '<a href="javascript:;" class="column_edit_trigger' . ( ! empty( $images_ids ) ? ' image-exists' : '' ) . '">' . esc_html__( 'Add images', 'js_composer' ) . '</a>';
			}
			return $output;
		}
	}
}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_gallery_shortcode_params' ) ) {
	function crocal_ext_vce_gallery_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Gallery", "crocal-extension" ),
			"description" => esc_html__( "Numerous styles, multiple columns for galleries", "crocal-extension" ),
			"base" => $tag,
			"class" => "wpb_vc_gallery",
			"icon"      => "icon-wpb-eut-gallery",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type"			=> "attach_images",
					"class"			=> "",
					"heading"		=> esc_html__( "Attach Images", "crocal-extension" ),
					"param_name"	=> "ids",
					"value" => '',
					"description"	=> esc_html__( "Select your gallery images.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Grid Image Size", "crocal-extension" ),
					"param_name" => "grid_image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Square Small Crop', 'crocal-extension' ) => 'square',
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Landscape Medium Crop', 'crocal-extension' ) => 'landscape-medium',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
						esc_html__( 'Portrait Medium Crop', 'crocal-extension' ) => 'portrait-medium',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
					) ),
					'std' => 'square',
					"description" => esc_html__( "Select your Grid Image Size.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'grid' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Masonry Image Size", "crocal-extension" ),
					"param_name" => "masonry_image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Autocrop', 'crocal-extension' ) => '',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
					) ),
					'std' => '',
					"description" => esc_html__( "Select your Masonry Image Size.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Image Size", "crocal-extension" ),
					"param_name" => "carousel_image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Square Small Crop', 'crocal-extension' ) => 'square',
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Landscape Medium Crop', 'crocal-extension' ) => 'landscape-medium',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
						esc_html__( 'Portrait Medium Crop', 'crocal-extension' ) => 'portrait-medium',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
					) ),
					'std' => 'landscape',
					"description" => esc_html__( "Select your Carousel Image Size.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel', 'advanced-carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Gallery Mode", "crocal-extension" ),
					"param_name" => "gallery_mode",
					"value" => array(
						esc_html__( "Grid", "crocal-extension" ) => 'grid',
						esc_html__( "Masonry", "crocal-extension" ) => 'masonry',
						esc_html__( "Carousel", "crocal-extension" ) => 'carousel',
						esc_html__( "Advanced Carousel", "crocal-extension" ) => 'advanced-carousel',
					),
					"description" => esc_html__( "Select your gallery mode.", "crocal-extension" ),
					"admin_label" => true,
				),
				//Gallery ( grid /masonry )
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Large Screen Columns", "crocal-extension" ),
					"param_name" => "columns_large_screen",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select your Blog Columns.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Columns", "crocal-extension" ),
					"param_name" => "columns",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select number of columns.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Landscape Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_landscape",
					"value" => array( '2', '3', '4' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, landscape orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Portrait Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_portrait",
					"value" => array( '2', '3', '4'  ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, portrait orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Mobile Columns", "crocal-extension" ),
					"param_name" => "columns_mobile",
					"value" => array( '1', '2' ),
					"std" => '1',
					"description" => esc_html__( "Select responsive column on mobile devices.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Gutter between images", "crocal-extension" ),
					"param_name" => "item_gutter",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"description" => esc_html__( "Add gutter among images.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Gutter Size", "crocal-extension" ),
					"param_name" => "gutter_size",
					"value" => '40',
					"dependency" => array( 'element' => "item_gutter", 'value' => array( 'yes' ) ),
				),
				//Gallery ( carousel )
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items per page", "crocal-extension" ),
					"param_name" => "items_per_page",
					"value" => array( '2', '3', '4', '5', '6' ),
					"description" => esc_html__( "Number of images per page", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel' ) ),
					"std" => '4',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items Tablet Landscape", "crocal-extension" ),
					"param_name" => "items_tablet_landscape",
					"value" => array( '2', '3', '4' ),
					"std" => '3',
					"description" => esc_html__( "Select number of items on tablet devices, landscape orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items Tablet Portrait", "crocal-extension" ),
					"param_name" => "items_tablet_portrait",
					"value" => array( '2', '3', '4'  ),
					"std" => '3',
					"description" => esc_html__( "Select number of items on tablet devices, portrait orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items Mobile", "crocal-extension" ),
					"param_name" => "items_mobile",
					"value" => array( '1', '2' ),
					"std" => '1',
					"description" => esc_html__( "Select number of items on mobile devices.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Large Screen Stage Padding", "crocal-extension" ),
					"param_name" => "stage_padding_large_screen",
					"value" => '100',
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'advanced-carousel' ) ),
					"description" => esc_html__( "Set left and right padding style (in pixels) onto stage-wrapper.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Stage Padding", "crocal-extension" ),
					"param_name" => "stage_padding",
					"value" => '250',
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'advanced-carousel' ) ),
					"description" => esc_html__( "Set left and right padding style (in pixels) onto stage-wrapper.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Tablet Landscape Stage Padding", "crocal-extension" ),
					"param_name" => "stage_padding_tablet_landscape",
					"value" => '200',
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'advanced-carousel' ) ),
					"description" => esc_html__( "Set left and right padding style (in pixels) onto stage-wrapper.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Tablet Portrait Stage Padding", "crocal-extension" ),
					"param_name" => "stage_padding_tablet_portrait",
					"value" => '100',
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'advanced-carousel' ) ),
					"description" => esc_html__( "Set left and right padding style (in pixels) onto stage-wrapper.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Mobile Stage Padding", "crocal-extension" ),
					"param_name" => "stage_padding_mobile",
					"value" => '30',
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'advanced-carousel' ) ),
					"description" => esc_html__( "Set left and right padding style (in pixels) onto stage-wrapper.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Loop", "crocal-extension" ),
					"param_name" => "loop",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel', 'advanced-carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Autoplay", "crocal-extension" ),
					"param_name" => "auto_play",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel', 'advanced-carousel' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Slideshow Speed", "crocal-extension" ),
					"param_name" => "slideshow_speed",
					"value" => '3000',
					"description" => esc_html__( "Slideshow Speed in ms.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel', 'advanced-carousel' ) ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Pause on Hover", "crocal-extension" ),
					"param_name" => "pause_hover",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"std" => "no",
					"description" => esc_html__( "If selected, carousel will be paused on hover", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel', 'advanced-carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Navigation Type", "crocal-extension" ),
					"param_name" => "navigation_type",
					'value' => array(
						esc_html__( 'Style 1' , 'crocal-extension' ) => '1',
						esc_html__( 'No Navigation' , 'crocal-extension' ) => '0',
					),
					"description" => esc_html__( "Select your Navigation type.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Navigation Color", "crocal-extension" ),
					"param_name" => "navigation_color",
					'value' => array(
						esc_html__( 'Dark' , 'crocal-extension' ) => 'dark',
						esc_html__( 'Light' , 'crocal-extension' ) => 'light',
					),
					"description" => esc_html__( "Select the background Navigation color.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Pagination", "crocal-extension" ),
					"param_name" => "carousel_pagination",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => 'no',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"std" => "no",
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel', 'advanced-carousel' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Carousel Pagination Speed", "crocal-extension" ),
					"param_name" => "carousel_pagination_speed",
					"value" => '400',
					"description" => esc_html__( "Pagination Speed in ms.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'carousel', 'advanced-carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Add Shadow", "crocal-extension"),
					"param_name" => "shadow",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => "",
						esc_html__( "Small Shadow", "crocal-extension" ) => "small-shadow",
						esc_html__( "Medium Shadow", "crocal-extension" ) => "medium-shadow",
						esc_html__( "Large Shadow", "crocal-extension" ) => "large-shadow",
					),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'grid', 'masonry', 'advanced-carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Radius", "crocal-extension"),
					"param_name" => "radius",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => "",
						esc_html__( "Radius 3px", "crocal-extension" ) => 'radius-3',
						esc_html__( "Radius 5px", "crocal-extension" ) => 'radius-5',
						esc_html__( "Radius 10px", "crocal-extension" ) => 'radius-10',
						esc_html__( "Radius 15px", "crocal-extension" ) => 'radius-15',
						esc_html__( "Radius 20px", "crocal-extension" ) => 'radius-20',
						esc_html__( "Radius 25px", "crocal-extension" ) => 'radius-25',
						esc_html__( "Radius 30px", "crocal-extension" ) => 'radius-30',
						esc_html__( "Radius 35px", "crocal-extension" ) => 'radius-35',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "CSS Animation", "crocal-extension"),
					"param_name" => "animation",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Fade In", "crocal-extension" ) => "eut-fade-in",
						esc_html__( "Fade In Up", "crocal-extension" ) => "eut-fade-in-up",
						esc_html__( "Fade In Down", "crocal-extension" ) => "eut-fade-in-down",
						esc_html__( "Fade In Left", "crocal-extension" ) => "eut-fade-in-left",
						esc_html__( "Fade In Right", "crocal-extension" ) => "eut-fade-in-right",
						esc_html__( "Zoom In", "crocal-extension" ) => "eut-zoom-in",
					),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'grid', 'masonry' ) ),
					"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "crocal-extension" ),
					"std" => "eut-zoom-in",
				),
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
					"std" => '90',
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
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Image Link Mode", "crocal-extension" ),
					"param_name" => "image_link_mode",
					"value" => array(
						esc_html__( "Image Popup", "crocal-extension" ) => 'popup',
						esc_html__( "Multi Popup", "crocal-extension" ) => 'multi_popup',
						esc_html__( "Custom Link", "crocal-extension" ) => 'custom_link',
						esc_html__( "None", "crocal-extension" ) => 'none',
					),
					"description" => esc_html__( "Choose the image link mode.", "crocal-extension" ),
					'std' => 'popup',
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
					"dependency" => array( 'element' => "image_link_mode", 'value' => array( 'popup', 'multi_popup' ) ),
					"description" => esc_html__( "Select size for your popup image.", "crocal-extension" ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
					"std" => 'extra-extra-large',
				),
				array(
					'type' => 'exploded_textarea_safe',
					'heading' => __( 'Multi Popup links ( Image/Video )', 'crocal-extension' ),
					'param_name' => 'multi_popup_links',
					'description' => __( 'Enter only the video links for certain images in the format index|url  (Note: divide links with linebreaks (Enter)) . Example: 1|https://www.youtube.com/watch?v=QnSSSHWuDTc', 'crocal-extension' ),
					'dependency' => array(
						'element' => 'image_link_mode',
						'value' => array( 'multi_popup' ),
					),
					"group" => esc_html__( "Extras", "crocal-extension" ),
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
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Filter", "crocal-extension" ),
					"param_name" => "gallery_filter",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"description" => esc_html__( "If selected, an isotope filter will be displayed.", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_mode", 'value' => array( 'grid', 'masonry' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					'type' => 'exploded_textarea',
					'heading' => __( 'Filter categories', 'crocal-extension' ),
					'param_name' => 'filter_values',
					'description' => __( 'Enter categories for each image (Note: divide categories with |, separate images with linebreaks (Enter)).', 'crocal-extension' ),
					"dependency" => array( 'element' => "gallery_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Order By", "crocal-extension" ),
					"param_name" => "filter_order_by",
					"value" => array(
						esc_html__( "Default ( Unordered )", "crocal-extension" ) => '',
						esc_html__( "Title", "crocal-extension" ) => 'title',
					),
					"description" => '',
					"dependency" => array( 'element' => "gallery_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Order", "crocal-extension" ),
					"param_name" => "filter_order",
					"value" => array(
						esc_html__( "Ascending", "crocal-extension" ) => 'ASC',
						esc_html__( "Descending", "crocal-extension" ) => 'DESC',
					),
					"dependency" => array( 'element' => "gallery_filter", 'value' => array( 'yes' ) ),
					"description" => '',
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Alignment", "crocal-extension" ),
					"param_name" => "filter_align",
					"value" => array(
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
						esc_html__( "Center", "crocal-extension" ) => 'center',
					),
					"description" => '',
					"dependency" => array( 'element' => "gallery_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Filter Go To Top", "crocal-extension" ),
					"param_name" => "filter_gototop",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"std" => "yes",
					"description" => esc_html__( "Animate to the top of the filter after clicking ( Excludes Infinite Scroll and Load more ).", "crocal-extension" ),
					"dependency" => array( 'element' => "gallery_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Style", "crocal-extension" ),
					"param_name" => "filter_style",
					"value" => array(
						esc_html__( "Simple", "crocal-extension" ) => 'simple',
						esc_html__( "Button", "crocal-extension" ) => 'button',

					),
					"dependency" => array( 'element' => "gallery_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Shape", "crocal-extension" ),
					"param_name" => "filter_shape",
					"value" => array(
						esc_html__( "Square", "crocal-extension" ) => 'square',
						esc_html__( "Round", "crocal-extension" ) => 'round',
						esc_html__( "Extra Round", "crocal-extension" ) => 'extra-round',
					),
					"dependency" => array( 'element' => "filter_style", 'value' => array( 'button' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_gallery', 'crocal_ext_vce_gallery_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_gallery_shortcode_params( 'crocal_gallery' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
