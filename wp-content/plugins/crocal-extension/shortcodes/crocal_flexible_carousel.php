<?php
/**
 * Flexible Carousel Shortcode
 */

if( !function_exists( 'crocal_ext_vce_flexible_carousel_shortcode' ) ) {

	function crocal_ext_vce_flexible_carousel_shortcode( $attr, $content ) {

		$allow_filter = $class_fullwidth = $slider_data = $output = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'items_per_page' => '4',
					'items_tablet_landscape' => '4',
					'items_tablet_portrait' => '2',
					'items_mobile' => '1',
					'margin_bottom' => '',
					'slideshow_speed' => '3000',
					'pagination' => 'no',
					'pagination_speed' => '400',
					'auto_play' => 'yes',
					'pause_hover' => 'no',
					'auto_height' => 'no',
					'item_gutter' => 'yes',
					'navigation_type' => '1',
					'navigation_color' => 'dark',
					'el_class' => '',
				),
				$attr
			)
		);

		$data_string = '';
		$data_string .= ' data-items="' . esc_attr( $items_per_page ) . '" data-items-tablet-landscape="' . esc_attr( $items_tablet_landscape ) . '" data-items-tablet-portrait="' . esc_attr( $items_tablet_portrait ) . '" data-items-mobile="' . esc_attr( $items_mobile ) . '"';
		$data_string .= ' data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
		$data_string .= ' data-pagination-speed="' . esc_attr( $pagination_speed ) . '"';
		$data_string .= ' data-pagination="' . esc_attr( $pagination ) . '"';
		$data_string .= ' data-pagination-color="' . esc_attr( $navigation_color ) . '"';
		$data_string .= ' data-slider-autoheight="' . esc_attr( $auto_height ) . '"';
		$data_string .= ' data-slider-pause="' . esc_attr( $pause_hover ) . '"';
		$data_string .= ' data-slider-autoplay="' . esc_attr( $auto_play ) . '"';


		//Carousel Element
		$flexible_carousel_classes = array( 'eut-element', 'eut-flexible-carousel', 'eut-carousel', 'eut-layout-1' );
		if ( 'yes' == $item_gutter ) {
			array_push( $flexible_carousel_classes, 'eut-with-gap' );
		}

		$flexible_carousel_class_string = implode( ' ', $flexible_carousel_classes );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$output = "";

		$output .= '<div class="' . esc_attr( $flexible_carousel_class_string ) . '" style="' . $style . '">';
		$output .= '<div class="eut-carousel-wrapper">';
		$output .=   crocal_ext_vce_element_navigation( $navigation_type, $navigation_color, 'carousel' );
		$output .= '	<div class="eut-flexible-carousel-element owl-carousel ' . esc_attr( $el_class ) . '"' . $data_string . '>';
		if ( !empty( $content ) ) {
			$output .= do_shortcode( $content );
		}
		$output .= '	</div>';
		$output .= '  </div>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'crocal_flexible_carousel', 'crocal_ext_vce_flexible_carousel_shortcode' );

}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_crocal_flexible_carousel extends WPBakeryShortCodesContainer {
    }
}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_flexible_carousel_shortcode_params' ) ) {
	function crocal_ext_vce_flexible_carousel_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Flexible Carousel", "crocal-extension" ),
			"description" => esc_html__( "Add a flexible carousel with elements", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon" => "icon-wpb-eut-flexible-carousel",
			"category" => esc_html__( "Content", "js_composer" ),
			"content_element" => true,
			"controls" => "full",
			"show_settings_on_create" => true,
			"as_parent" => array('only' => 'vc_row,vc_column,vc_row_inner,vc_column_inner,vc_column_text,vc_custom_heading,vc_empty_space,crocal_single_image,crocal_button,crocal_image_text,crocal_team,crocal_divider,crocal_icon,crocal_icon_box,crocal_social,crocal_callout,crocal_slogan,crocal_title'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items per page", "crocal-extension" ),
					"param_name" => "items_per_page",
					"value" => array( '1', '2', '3', '4', '5', '6' ),
					"description" => esc_html__( "Number of items per page", "crocal-extension" ),
					"std" => '4',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Landscape Items per page", "crocal-extension" ),
					"param_name" => "items_tablet_landscape",
					"value" => array( '1', '2', '3', '4', '5', '6' ),
					"description" => esc_html__( "Number of items per page on tablet devices, landscape orientation.", "crocal-extension" ),
					"std" => '4',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Portrait Items per page", "crocal-extension" ),
					"param_name" => "items_tablet_portrait",
					"value" => array( '1', '2', '3', '4', '5', '6' ),
					"description" => esc_html__( "Number of items per page on tablet devices, landscape portrait.", "crocal-extension" ),
					"std" => '2',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Mobile Items per page", "crocal-extension" ),
					"param_name" => "items_mobile",
					"value" => array( '1', '2' ),
					"description" => esc_html__( "Number of items per page on mobile devices.", "crocal-extension" ),
					"std" => '1',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Gutter between items", "crocal-extension" ),
					"param_name" => "item_gutter",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"description" => esc_html__( "Add gutter among items.", "crocal-extension" ),
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
					"type" => "dropdown",
					"heading" => esc_html__( "Pagination", "crocal-extension" ),
					"param_name" => "pagination",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => 'no',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"std" => "no",
				),
				crocal_ext_vce_add_pagination_speed(),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Pause on Hover", "crocal-extension" ),
					"param_name" => "pause_hover",
					"value" => array( esc_html__( "If selected, carousel will be paused on hover", "crocal-extension" ) => 'yes' ),
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
				),
				crocal_ext_vce_add_auto_height(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
			),
			"js_view" => 'VcColumnView',
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_flexible_carousel', 'crocal_ext_vce_flexible_carousel_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_flexible_carousel_shortcode_params( 'crocal_flexible_carousel' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
