<?php
/**
 * Pricing Table Shortcode
 */

if( !function_exists( 'crocal_ext_vce_pricing_table_shortcode' ) ) {

	function crocal_ext_vce_pricing_table_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		$combined_atts = $atts;
		extract(
			$combined_atts = shortcode_atts(
				array(
					'title' => '',
					'description' => '',
					'heading_tag' => 'h3',
					'heading' => 'h2',
					'increase_heading' => '100',
					'increase_heading_reset' => '',
					'custom_font_family' => '',
					'price' => '',
					'interval' => '',
					'values' => '',
					'price_color' => 'black',
					'bottom_line' => '',
					'bottom_line_color' => 'primary-1',
					'bottom_line_color_custom' => '#e1e1e1',
					'shape' => 'square',
					'shadow' => '',

					'icon_type' => '',
					'icon_size' => 'medium',
					'icon_library' => 'fontawesome',
					'icon_fontawesome' => 'fa fa-adjust',
					'icon_openiconic' => 'vc-oi vc-oi-dial',
					'icon_typicons' => 'typcn typcn-adjust-brightness',
					'icon_entypo' => 'entypo-icon entypo-icon-note',
					'icon_linecons' => 'vc_li vc_li-heart',
					'icon_simplelineicons' => 'smp-icon-user',
					'icon_etlineicons' => 'et-icon-mobile',
					'icon_shape' => 'no-shape',
					'icon_shape_type' => 'simple',
					'icon_svg' => '',
					'icon_svg_animation_duration' => '100',
					'icon_color' => 'primary-1',
					'icon_color_custom' => '#e1e1e1',
					'icon_shape_color' => 'grey',
					'icon_shape_color_custom' => '#e1e1e1',
					'icon_image' => '',
					'retina_icon_image' => '',

					'button_text' => '',
					'button_link' => '',
					'button_type' => 'simple',
					'button_size' => 'medium',
					'button_color' => 'primary-1',
					'button_hover_color' => 'black',
					'button_line_color' => 'primary-1',
					'button_gradient_color_1' => 'primary-1',
					'button_gradient_color_2' => 'primary-2',
					'button_shape' => 'square',
					'button_shadow' => '',
					'button_class' => '',
					'btn_add_icon' => '',
					'btn_icon_library' => 'fontawesome',
					'btn_icon_fontawesome' => 'fa fa-adjust',
					'btn_icon_openiconic' => 'vc-oi vc-oi-dial',
					'btn_icon_typicons' => 'typcn typcn-adjust-brightness',
					'btn_icon_entypo' => 'entypo-icon entypo-icon-note',
					'btn_icon_linecons' => 'vc_li vc_li-heart',
					'btn_icon_simplelineicons' => 'smp-icon-user',
					'btn_icon_etlineicons' => 'et-icon-mobile',
					'content_bg' => 'white',
					'align' => 'left',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$title_classes = array( 'eut-price' );

		array_push( $title_classes, 'eut-align-' . $heading );
		array_push( $title_classes, 'eut-text-' . $price_color );

		if( '100' != $increase_heading ){
			if( !empty( $increase_heading_reset ) ) {
				$title_classes = crocal_ext_vce_increase_heading_reset( $increase_heading_reset, $title_classes );
			}
			array_push( $title_classes, 'eut-increase-heading' );
			array_push( $title_classes, 'eut-heading-' . $increase_heading );
		}

		if ( !empty( $custom_font_family ) ) {
			array_push( $title_classes, 'eut-' . $custom_font_family );
		}

		$title_class_string = implode( ' ', $title_classes );

		$button_options = array(
			'button_text'  => $button_text,
			'button_link'  => $button_link,
			'button_type'  => $button_type,
			'button_size'  => $button_size,
			'button_color' => $button_color,
			'button_hover_color' => $button_hover_color,
			'button_line_color' => $button_line_color,
			'button_gradient_color_1' => $button_gradient_color_1,
			'button_gradient_color_2' => $button_gradient_color_2,
			'button_shape' => $button_shape,
			'button_shadow' => $button_shadow,
			'button_class' => $button_class,
			'btn_add_icon' => $btn_add_icon,
			'btn_icon_library' => $btn_icon_library,
			'btn_icon_fontawesome' => $btn_icon_fontawesome,
			'btn_icon_openiconic' => $btn_icon_openiconic,
			'btn_icon_typicons' => $btn_icon_typicons,
			'btn_icon_entypo' => $btn_icon_entypo,
			'btn_icon_linecons' => $btn_icon_linecons,
			'btn_icon_simplelineicons' => $btn_icon_simplelineicons,
			'btn_icon_etlineicons' => $btn_icon_etlineicons,
		);
		$button = crocal_ext_vce_get_button( $button_options );

		//Pricing Table Classes
		$pricing_classes = array( 'eut-element', 'eut-pricing-table' );
		if ( !empty( $animation ) ) {
			array_push( $pricing_classes, 'eut-animated-item' );
			array_push( $pricing_classes, $animation);
			array_push( $pricing_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		array_push( $pricing_classes, 'eut-align-' . $align);

		if ( !empty ( $el_class ) ) {
			array_push( $pricing_classes, $el_class);
		}

		if( 'none' != $content_bg ){
			array_push( $pricing_classes, 'eut-bg-' . $content_bg );
		}

		if ( 'square' != $shape ) {
			array_push( $pricing_classes, 'eut-' . $shape );
		}

		if ( !empty( $shadow ) ) {
			array_push( $pricing_classes, 'eut-' . $shadow );
			array_push( $pricing_classes, 'eut-with-shadow' );
		}

		$pricing_class_string = implode( ' ', $pricing_classes );

		//Pricing Title Classes
		$pricing_title_classes = array( 'eut-pricing-title', 'eut-h6' );
		if( 'black' == $content_bg ){
			array_push( $pricing_title_classes, 'eut-text-light' );
		}
		$pricing_title_class_string = implode( ' ', $pricing_title_classes );

		//Pricing Interval Classes
		$pricing_intervalclasses = array( 'eut-interval', 'eut-h6' );
		if( 'black' == $content_bg ){
			array_push( $pricing_intervalclasses, 'eut-text-light' );
		}
		$pricing_intervalclass_string = implode( ' ', $pricing_intervalclasses );


		//Pricing Lines
		$pricing_lines = explode(",", $values);

		$pricing_lines_data = array();
		foreach ($pricing_lines as $line) {
			$new_line = array();
			$data_line = explode("|", $line);
			$new_line['value1'] = isset( $data_line[0] ) && !empty( $data_line[0] ) ? $data_line[0] : '';
			$new_line['value2'] = isset( $data_line[1] ) && !empty( $data_line[1] ) ? $data_line[1] : '';
			$pricing_lines_data[] = $new_line;
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		// Bottom Line Style
		$bottom_line_style = '';
		if( 'custom' == $bottom_line_color ) {
			$bottom_line_style .= ' color: ' . esc_attr( $bottom_line_color_custom ) . ';';
		}

		$output .= '<div class="' . esc_attr( $pricing_class_string ) . '" style="' . $style . '"' . $data . '>';
		$output .= '  <div class="eut-pricing-header">';
		$output .= '    <div class="' . esc_attr( $pricing_title_class_string ) . '">' . $title . '</div>';
		$output .= '    <div class="eut-pricing-description eut-small-text">' . $description . '</div>';
		if ( !empty ( $icon_type ) ) {
			if ( 'image' == $icon_type ) {
				if ( !empty( $icon_image ) ) {
					$img_id = preg_replace('/[^\d]/', '', $icon_image);
					$img_src = wp_get_attachment_image_src( $img_id, 'full' );
					$img_url = $img_src[0];
					$image_srcset = '';
					if ( !empty( $retina_icon_image ) ) {
						$img_retina_id = preg_replace('/[^\d]/', '', $retina_icon_image);
						$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
						$retina_url = $img_retina_src[0];
						$image_srcset = $img_url . ' 1x,' . $retina_url . ' 2x';
						$image_html = crocal_ext_vce_get_attachment_image( $img_id, 'full' , "", array( 'srcset'=> $image_srcset, 'data-column-space' => '100%' ) );
					} else {
						$image_html = crocal_ext_vce_get_attachment_image( $img_id, 'full', "", array( 'data-column-space' => '100%' ) );
					}
				} else {
					$image_html = crocal_ext_vce_get_fallback_image( 'thumbnail' );
				}

				$output .= '<div class="eut-single-icon eut-image-icon eut-' . esc_attr( $icon_size ) . '">';
				$output .= $image_html;
				$output .= '</div>';

			} else {
				$output .=  crocal_ext_vce_get_icon( $combined_atts );
			}
		}
		$output .= '  </div>';
		$output .= '  <div class="eut-pricing-content">';
		$output .= '    <' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">';
		$output .= '<span>' . $price;
		$output .= '</span>';
		$output .= '     <span class="' . esc_attr( $pricing_intervalclass_string ) . '">' . $interval . '</span>';
		$output .= '   </' . tag_escape( $heading_tag ) . '>';
		$output .= '  </div>';
		if ( !empty ( $bottom_line ) ) {
			$output .= '  <div class="eut-bottom-line eut-text-' . esc_attr( $bottom_line_color ) . '" style="' . esc_attr( $bottom_line_style ) . '"></div>';
		}
	    $output .= '  <ul>';
		foreach($pricing_lines_data as $line) {
			$output .= '<li><strong>' .  $line['value1'] . ' </strong>' .  $line['value2'] . '</li>';
		}
		$output .= '  </ul>';
		$output .= $button;
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'crocal_pricing_table', 'crocal_ext_vce_pricing_table_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_pricing_table_shortcode_params' ) ) {
	function crocal_ext_vce_pricing_table_shortcode_params( $tag ) {

		$crocal_ext_vce_pricing_table_shortcode_params = array_merge(
			array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", "crocal-extension" ),
					"param_name" => "title",
					"value" => "Title",
					"save_always" => true,
					"description" => esc_html__( "Enter your title here.", "crocal-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Description", "crocal-extension" ),
					"param_name" => "description",
					"value" => "",
					"save_always" => true,
					"description" => esc_html__( "Enter your description here.", "crocal-extension" ),
					"admin_label" => false,
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Price", "crocal-extension" ),
					"param_name" => "price",
					"value" => "$0",
					"save_always" => true,
					"description" => esc_html__( "Enter your price here. eg $80.", "crocal-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Price Tag", "crocal-extension" ),
					"param_name" => "heading_tag",
					"value" => array(
						esc_html__( "h1", "crocal-extension" ) => 'h1',
						esc_html__( "h2", "crocal-extension" ) => 'h2',
						esc_html__( "h3", "crocal-extension" ) => 'h3',
						esc_html__( "h4", "crocal-extension" ) => 'h4',
						esc_html__( "h5", "crocal-extension" ) => 'h5',
						esc_html__( "h6", "crocal-extension" ) => 'h6',
						esc_html__( "div", "crocal-extension" ) => 'div',
					),
					"description" => esc_html__( "Price Tag for SEO", "crocal-extension" ),
					"std" => 'h3',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Price Size/Typography", "crocal-extension" ),
					"param_name" => "heading",
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
					"description" => esc_html__( "Price size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
					"std" => 'h3',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Increase Price Heading Size", "crocal-extension" ),
					"param_name" => "increase_heading",
					"value" => array(
						esc_html__( "100%", "crocal-extension" ) => '100',
						esc_html__( "120%", "crocal-extension" ) => '120',
						esc_html__( "140%", "crocal-extension" ) => '140',
						esc_html__( "160%", "crocal-extension" ) => '160',
						esc_html__( "180%", "crocal-extension" ) => '180',
						esc_html__( "200%", "crocal-extension" ) => '200',
						esc_html__( "250%", "crocal-extension" ) => '250',
						esc_html__( "300%", "crocal-extension" ) => '300',
					),
					"description" => esc_html__( "Set the percentage you want to increase your Headings size.", "crocal-extension" ),
				),
				crocal_ext_vce_get_heading_increase_reset(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Price Custom Font Family", "crocal-extension" ),
					"param_name" => "custom_font_family",
					"value" => array(
						esc_html__( "Same as Typography", "crocal-extension" ) => '',
						esc_html__( "Custom Font Family 1", "crocal-extension" ) => 'custom-font-1',
						esc_html__( "Custom Font Family 2", "crocal-extension" ) => 'custom-font-2',
						esc_html__( "Custom Font Family 3", "crocal-extension" ) => 'custom-font-3',
						esc_html__( "Custom Font Family 4", "crocal-extension" ) => 'custom-font-4',

					),
					"description" => esc_html__( "Select a different font family, defined in Theme Options - Typography Options - Extras - Custom Font Family", "crocal-extension" ),
					"std" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Interval", "crocal-extension" ),
					"param_name" => "interval",
					"value" => "/month",
					"save_always" => true,
					"description" => esc_html__( "Enter interval period here. e.g: /month, per month, per year.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Add Bottom Line", "crocal-extension" ),
					"param_name" => "bottom_line",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Bottom Line Color", "crocal-extension" ),
					"param_name" => "bottom_line_color",
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
						esc_html__( "Custom", "crocal-extension" ) => 'custom',
					),
					"description" => esc_html__( "Color of the bottom line.", "crocal-extension" ),
					"dependency" => array( 'element' => "bottom_line", 'value' => array( 'yes' ) ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Custom Bottom Line Color", "crocal-extension" ),
					'param_name' => 'bottom_line_color_custom',
					'description' => esc_html__( "Select a custom color for your bottom line", "crocal-extension" ),
					'std' => '#e1e1e1',
					"dependency" => array( 'element' => "bottom_line_color", 'value' => array( 'custom' ) ),
				),
				array(
					"type" => "exploded_textarea",
					"heading" => __("Attributes", "crocal-extension"),
					"param_name" => "values",
					"description" => esc_html__( "Input attribute values. Divide values with linebreaks (Enter). Example: 100|Users.", "crocal-extension" ),
					"value" => "100|Users,8 Gig|Disc Space,Unlimited|Data Transfer",
					"save_always" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Price Color", "crocal-extension" ),
					"param_name" => "price_color",
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
					),
					'std' => 'black',
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Content Background", "crocal-extension" ),
					"param_name" => "content_bg",
					"description" => esc_html__( "Selected background color for your image text content.", "crocal-extension" ),
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => 'none',
						esc_html__( "White", "crocal-extension" ) => 'white',
						esc_html__( "Black", "crocal-extension" ) => 'black',
					),
					'std' => 'white',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Shape", "crocal-extension" ),
					"param_name" => "shape",
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
					),
					"description" => '',
					"dependency" => array( 'element' => "content_bg", 'value' => array( 'white', 'black' ) ),
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
					"dependency" => array( 'element' => "content_bg", 'value' => array( 'white', 'black' ) ),
				),
			),
			crocal_ext_vce_get_icon_params( $tag ),
			array(
				crocal_ext_vce_add_align(),
				crocal_ext_vce_add_animation(),
				crocal_ext_vce_add_animation_delay(),
				crocal_ext_vce_add_animation_duration(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
			),
			crocal_ext_vce_get_button_params()
		);

		return array(
			"name" => esc_html__( "Pricing Table", "crocal-extension" ),
			"description" => esc_html__( "Stylish pricing tables", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-pricing-table",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => $crocal_ext_vce_pricing_table_shortcode_params,
		);

	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_pricing_table', 'crocal_ext_vce_pricing_table_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_pricing_table_shortcode_params( 'crocal_pricing_table' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.

