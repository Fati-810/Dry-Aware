<?php
/**
 * Counter Shortcode
 */

if( !function_exists( 'crocal_ext_vce_counter_shortcode' ) ) {

	function crocal_ext_vce_counter_shortcode( $atts, $content ) {

		$output = $link_start = $link_end = $retina_data = $data = $el_class = '';

		$combined_atts = $atts;

		extract(
			$combined_atts = shortcode_atts(
				array(
					'counter_start_val' => '0',
					'counter_end_val' => '100',
					'counter_prefix' => '',
					'counter_prefix_space' => '',
					'counter_suffix' => '',
					'counter_suffix_space' => '',
					'counter_decimal_points' => '0',
					'counter_decimal_separator' => '.',
					'counter_color' => 'primary-1',
					'counter_heading' => 'h2',
					'counter_custom_font_family' => '',
					'increase_counter_heading' => '100',
					'counter_thousands_separator_vis' => '',
					'counter_thousands_separator' => ',',
					'title' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'bottom_line' => '',
					'bottom_line_color' => 'primary-1',
					'bottom_line_color_custom' => '#e1e1e1',

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

					'inherit_align' => 'inherit',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$title_classes = array( 'eut-counter-title' );
		$title_classes[]  = 'eut-' . $heading;
		if ( !empty( $custom_font_family ) ) {
			$title_classes[]  = 'eut-' . $custom_font_family;
		}
		$title_class_string = implode( ' ', $title_classes );
		$counter_classes = array( 'eut-element' );

		array_push( $counter_classes, 'eut-counter' );
		array_push( $counter_classes, 'eut-align-' . $inherit_align );

		if ( !empty( $animation ) ) {
			array_push( $counter_classes, 'eut-animated-item' );
			array_push( $counter_classes, $animation);
			array_push( $counter_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $counter_classes, $el_class);
		}

		$counter_class_string = implode( ' ', $counter_classes );


		$counter_number = array( 'eut-counter-item' );

		array_push( $counter_number, 'eut-' . $counter_heading );
		array_push( $counter_number, 'eut-text-' . $counter_color );

		if ( !empty( $counter_custom_font_family ) ) {
			array_push( $counter_number, 'eut-' . $counter_custom_font_family );
		}

		if( '100' != $increase_counter_heading ){
			array_push( $counter_number, 'eut-increase-heading' );
			array_push( $counter_number, 'eut-heading-' . $increase_counter_heading );
		}

		$counter_number_class_string = implode( ' ', $counter_number );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		// Bottom Line Style
		$bottom_line_style = '';
		if( 'custom' == $bottom_line_color ) {
			$bottom_line_style .= ' color: ' . esc_attr( $bottom_line_color_custom ) . ';';
		}

		$output .= '<div class="' . esc_attr( $counter_class_string ) . '" style="' . $style . '"' . $data . '>';

		if ( !empty ( $icon_type ) ) {
			$output .=  crocal_ext_vce_get_icon( $combined_atts );
		}
		if ( !empty ( $bottom_line ) ) {
			$output .= '  <div class="eut-bottom-line eut-text-' . esc_attr( $bottom_line_color ) . '" style="' . esc_attr( $bottom_line_style ) . '"></div>';
		}

		if( 'yes' == $counter_prefix_space && !empty( $counter_prefix )  ) {
			$counter_prefix = $counter_prefix . ' ';
		}

		if( 'yes' == $counter_suffix_space && !empty( $counter_suffix ) ) {
			$counter_suffix = ' ' . $counter_suffix;
		}

		$counter_attributes = array();
		$counter_attributes[] = 'data-thousands-separator-vis="' . esc_attr( $counter_thousands_separator_vis ) . '"';
		$counter_attributes[] = 'data-thousands-separator="' . esc_attr( $counter_thousands_separator ) . '"';
		$counter_attributes[] = 'data-prefix="' . esc_attr( $counter_prefix ) . '"';
		$counter_attributes[] = 'data-suffix="' . esc_attr( $counter_suffix ) . '"';
		$counter_attributes[] = 'data-start-val="' . esc_attr( $counter_start_val ) . '"';
		$counter_attributes[] = 'data-end-val="' . esc_attr( $counter_end_val ) . '"';
		$counter_attributes[] = 'data-decimal-points="' . esc_attr( $counter_decimal_points ) . '"';
		$counter_attributes[] = 'data-decimal-separator="' . esc_attr( $counter_decimal_separator ) . '"';
		$counter_attributes[] = '';

		$output .= '  <div class="eut-counter-content">';
		$output .= '    <div class="' . esc_attr( $counter_number_class_string ) . '">';
		$output .= '      <span ' . implode( ' ', $counter_attributes ) . '>' . $counter_start_val. '</span>';
		$output .= '    </div>';
		$output .= '	<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">' . $title. '</' . tag_escape( $heading_tag ) . '>';
		$output .= '  </div>';

		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'crocal_counter', 'crocal_ext_vce_counter_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_counter_shortcode_params' ) ) {
	function crocal_ext_vce_counter_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Counter", "crocal-extension" ),
			"description" => esc_html__( "Add a counter with icon and title", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-counter",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array_merge (
				array(
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Counter Start Number", "crocal-extension" ),
						"param_name" => "counter_start_val",
						"value" => "0",
						"description" => esc_html__( "Enter counter start number.", "crocal-extension" ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Counter End Number", "crocal-extension" ),
						"param_name" => "counter_end_val",
						"value" => "100",
						"description" => esc_html__( "Enter counter end number.", "crocal-extension" ),
					),
					array(
						"type" => 'checkbox',
						"heading" => esc_html__( "Counter Thousands Separator Visiblility", "crocal-extension" ),
						"param_name" => "counter_thousands_separator_vis",
						"description" => esc_html__( "If selected, thousands separator will not be shown.", "crocal-extension" ),
						"value" => array( esc_html__( "Disable Thousands Separator.", "crocal-extension" ) => 'yes' ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Counter Thousands Separator", "crocal-extension" ),
						"param_name" => "counter_thousands_separator",
						"value" => ",",
						"description" => esc_html__( "Enter thousands separator.", "crocal-extension" ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Counter Decimal Points", "crocal-extension" ),
						"param_name" => "counter_decimal_points",
						"value" => "0",
						"description" => esc_html__( "Number of decimal points.", "crocal-extension" ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Counter Decimal Separator", "crocal-extension" ),
						"param_name" => "counter_decimal_separator",
						"value" => ".",
						"description" => esc_html__( "Enter decimal separator.", "crocal-extension" ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Counter Prefix", "crocal-extension" ),
						"param_name" => "counter_prefix",
						"value" => "",
						"description" => esc_html__( "Enter counter prefix.", "crocal-extension" ),
					),
					array(
						"type" => 'checkbox',
						"heading" => esc_html__( "Prefix space", "crocal-extension" ),
						"param_name" => "counter_prefix_space",
						"description" => esc_html__( "Add space after prefix", "crocal-extension" ),
						"value" => array( esc_html__( "Add space", "crocal-extension" ) => 'yes' ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Counter Suffix", "crocal-extension" ),
						"param_name" => "counter_suffix",
						"value" => "",
						"description" => esc_html__( "Enter counter suffix.", "crocal-extension" ),
					),
					array(
						"type" => 'checkbox',
						"heading" => esc_html__( "Suffix space", "crocal-extension" ),
						"param_name" => "counter_suffix_space",
						"description" => esc_html__( "Add space before suffix", "crocal-extension" ),
						"value" => array( esc_html__( "Add space", "crocal-extension" ) => 'yes' ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Counter Color", "crocal-extension" ),
						"param_name" => "counter_color",
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
						"description" => esc_html__( "Color of the counter.", "crocal-extension" ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Counter Size/Typography", "crocal-extension" ),
						"param_name" => "counter_heading",
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
						"description" => esc_html__( "Select counter text size.", "crocal-extension" ),
						"std" => 'h2',
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Increase Counter Size", "crocal-extension" ),
						"param_name" => "increase_counter_heading",
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
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Counter Custom Font Family", "crocal-extension" ),
						"param_name" => "counter_custom_font_family",
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
				),
				crocal_ext_vce_get_icon_params( $tag ),
				array(
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Add Bottom Line", "crocal-extension" ),
						"param_name" => "bottom_line",
						"value" => array(
							esc_html__( "No", "crocal-extension" ) => '',
							esc_html__( "Yes", "crocal-extension" ) => 'yes',
						),
						"dependency" => array( 'element' => 'icon_type', 'value_not_equal_to' => array( '' ) ),
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
						"type" => "textfield",
						"heading" => esc_html__( "Title", "crocal-extension" ),
						"param_name" => "title",
						"value" => "Sample Title",
						"description" => esc_html__( "Enter counter title.", "crocal-extension" ),
						"save_always" => true,
					),
					crocal_ext_vce_get_heading_tag( "h3" ),
					crocal_ext_vce_get_heading( "h3" ),
					crocal_ext_vce_get_custom_font_family(),
					crocal_ext_vce_add_inherit_align(),
					crocal_ext_vce_add_animation(),
					crocal_ext_vce_add_animation_delay(),
					crocal_ext_vce_add_animation_duration(),
					crocal_ext_vce_add_margin_bottom(),
					crocal_ext_vce_add_el_class(),
				)
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_counter', 'crocal_ext_vce_counter_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_counter_shortcode_params( 'crocal_counter' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
