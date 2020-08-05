<?php
/**
 * Slogan Shortcode
 */

if( !function_exists( 'crocal_ext_vce_slogan_shortcode' ) ) {

	function crocal_ext_vce_slogan_shortcode( $atts, $content ) {

		$output = $data = $el_class = $text_style_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading_tag' => 'h2',
					'heading' => 'h2',
					'custom_font_family' => '',
					'gradient_color' => '',
					'gradient_color_1' => 'primary-1',
					'gradient_color_2' => 'primary-2',
					'increase_heading' => '100',
					'increase_heading_reset' => '',
					'line_type' => 'no-line',
					'line_width' => '50',
					'line_height' => '2',
					'line_color' => 'primary-1',
					'subtitle' => '',
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
					'button2_text' => '',
					'button2_link' => '',
					'button2_type' => 'simple',
					'button2_size' => 'medium',
					'button2_color' => 'primary-1',
					'button2_hover_color' => 'black',
					'button2_line_color' => 'primary-1',
					'button2_gradient_color_1' => 'primary-1',
					'button2_gradient_color_2' => 'primary-2',
					'button2_shape' => 'square',
					'button2_shadow' => '',
					'button2_class' => '',
					'btn2_add_icon' => '',
					'btn2_icon_library' => 'fontawesome',
					'btn2_icon_fontawesome' => 'fa fa-adjust',
					'btn2_icon_openiconic' => 'vc-oi vc-oi-dial',
					'btn2_icon_typicons' => 'typcn typcn-adjust-brightness',
					'btn2_icon_entypo' => 'entypo-icon entypo-icon-note',
					'btn2_icon_linecons' => 'vc_li vc_li-heart',
					'btn2_icon_simplelineicons' => 'smp-icon-user',
					'btn2_icon_etlineicons' => 'et-icon-mobile',
					'text_style' => 'none',
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
		//Title
		if ( !empty( $title ) ) {
			//Title Classes
			$title_classes = array( 'eut-slogan-title' );

			array_push( $title_classes, 'eut-align-' . $inherit_align );
			array_push( $title_classes, 'eut-' . $heading );

			if ( !empty( $custom_font_family ) ) {
				array_push( $title_classes, 'eut-' . $custom_font_family );
			}

			if( '100' != $increase_heading ){
				if( !empty( $increase_heading_reset ) ) {
					$title_classes = crocal_ext_vce_increase_heading_reset( $increase_heading_reset, $title_classes );
				}
				array_push( $title_classes, 'eut-increase-heading' );
				array_push( $title_classes, 'eut-heading-' . esc_attr( $increase_heading ) );
			}

			if ( !empty( $gradient_color ) ) {
				array_push( $title_classes, 'eut-title-gradient' );
				array_push( $title_classes, 'eut-gradient-1-' . $gradient_color_1 );
				array_push( $title_classes, 'eut-gradient-2-' . $gradient_color_2 );
			}

			$title_class_string = implode( ' ', $title_classes );
		}

		//Slogan
		$slogan_classes = array( 'eut-element', 'eut-slogan', 'eut-align-' . $inherit_align );

		if ( !empty( $animation ) ) {
			array_push( $slogan_classes, 'eut-animated-item' );
			array_push( $slogan_classes, $animation);
			array_push( $slogan_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $slogan_classes, $el_class);
		}

		$slogan_class_string = implode( ' ', $slogan_classes );

		// Paragraph
		if ( 'none' != $text_style ) {
			$text_style_class = 'eut-' .$text_style;
		}

		//First Button
		$button1_options = array(
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
		$button1 = crocal_ext_vce_get_button( $button1_options );
		//Second Button
		$button2_options = array(
			'button_text'  => $button2_text,
			'button_link'  => $button2_link,
			'button_type'  => $button2_type,
			'button_size'  => $button2_size,
			'button_color' => $button2_color,
			'button_hover_color' => $button2_hover_color,
			'button_line_color' => $button2_line_color,
			'button_gradient_color_1' => $button2_gradient_color_1,
			'button_gradient_color_2' => $button2_gradient_color_2,
			'button_shape' => $button2_shape,
			'button_shadow' => $button2_shadow,
			'button_class' => $button2_class,
			'btn_add_icon' => $btn2_add_icon,
			'btn_icon_library' => $btn2_icon_library,
			'btn_icon_fontawesome' => $btn2_icon_fontawesome,
			'btn_icon_openiconic' => $btn2_icon_openiconic,
			'btn_icon_typicons' => $btn2_icon_typicons,
			'btn_icon_entypo' => $btn2_icon_entypo,
			'btn_icon_linecons' => $btn2_icon_linecons,
			'btn_icon_simplelineicons' => $btn2_icon_simplelineicons,
			'btn_icon_etlineicons' => $btn2_icon_etlineicons,
		);
		$button2 = crocal_ext_vce_get_button( $button2_options );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $slogan_class_string ) . '" style="' . $style. '"' . $data . '>';
		if ( !empty( $subtitle ) ) {
			$output .= '<div class="eut-subtitle">' . $subtitle . '</div>';
		}
		if ( !empty( $title ) ) {
			$output .= '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">';
			$output .= '<span>';
			$output .= $title;
			if( 'line' == $line_type ) {
				$line_style = '';
				$line_style .= 'width: '.(preg_match('/(px|em|\%|pt|cm)$/', $line_width) ? $line_width : $line_width.'px').';';
				$line_style .= 'height: '. $line_height. 'px;';
				$output .=   '<span class="eut-title-line eut-bg-' . esc_attr( $line_color ) . '" style="' . esc_attr( $line_style ) . '"></span>';
			}
			$output .= '</span>';
			$output .= '</' . tag_escape( $heading_tag ) . '>';
		}
		if ( !empty( $content ) ) {
			$output .= '  <p class="' . esc_attr( $text_style_class ) . '">' . crocal_ext_vce_unautop( $content ) . '</p>';
		}

		if ( !empty( $button1 ) || !empty( $button2 ) ) {
			$output .= '<div class="eut-btn-wrapper">';
			$output .= $button1;
			$output .= $button2;
			$output .= '</div>';
		}
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'crocal_slogan', 'crocal_ext_vce_slogan_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_slogan_shortcode_params' ) ) {
	function crocal_ext_vce_slogan_shortcode_params( $tag ) {

		$crocal_ext_vce_slogan_shortcode_btn1_params = crocal_ext_vce_get_button_params('first');
		$crocal_ext_vce_slogan_shortcode_btn2_params = crocal_ext_vce_get_button_params('second', '2');
		$crocal_ext_vce_slogan_shortcode_params = array_merge(
			array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", "crocal-extension" ),
					"param_name" => "title",
					"value" => "Sample Title",
					"description" => esc_html__( "Enter your title here.", "crocal-extension" ),
					"save_always" => true,
					"admin_label" => true,
				),
				crocal_ext_vce_get_heading_tag( "h2" ),
				crocal_ext_vce_get_heading( "h2" ),
				crocal_ext_vce_get_heading_increase(),
				crocal_ext_vce_get_heading_increase_reset(),
				crocal_ext_vce_get_custom_font_family(),
				crocal_ext_vce_get_gradient_color(),
				crocal_ext_vce_get_gradient_color_1(),
				crocal_ext_vce_get_gradient_color_2(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Line type", "crocal-extension" ),
					"param_name" => "line_type",
					"value" => array(
						esc_html__( "No Line", "crocal-extension" ) => 'no-line',
						esc_html__( "With Line", "crocal-extension" ) => 'line',
					),
					"description" => esc_html__( "Line Type of the title.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Line Width", "crocal-extension" ),
					"param_name" => "line_width",
					"value" => "50",
					"description" => esc_html__( "Enter the width for your line (Note: CSS measurement units allowed).", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value' => array( 'line' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Line Height", "crocal-extension" ),
					"param_name" => "line_height",
					"value" => array( '1', '2', '3', '4' , '5', '6', '7', '8', '9' , '10' ),
					"std" => '2',
					"description" => esc_html__( "Enter the hight for your line in px.", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value' => array( 'line' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Line Color", "crocal-extension" ),
					"param_name" => "line_color",
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
					"description" => esc_html__( "Color for the line.", "crocal-extension" ),
					"dependency" => array( 'element' => "line_type", 'value' => array( 'line' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Sub-Title", "crocal-extension" ),
					"param_name" => "subtitle",
					"value" => "",
					"description" => esc_html__( "Enter your sub-title here.", "crocal-extension" ),
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__( "Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "",
					"description" => esc_html__( "Type your text.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Text Style", "crocal-extension" ),
					"param_name" => "text_style",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => '',
						esc_html__( "Leader", "crocal-extension" ) => 'leader-text',
						esc_html__( "Subtitle", "crocal-extension" ) => 'subtitle',
					),
					"description" => 'Select your text style',
				),
				crocal_ext_vce_add_inherit_align(),
				crocal_ext_vce_add_animation(),
				crocal_ext_vce_add_animation_delay(),
				crocal_ext_vce_add_animation_duration(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
			),
			$crocal_ext_vce_slogan_shortcode_btn1_params,
			$crocal_ext_vce_slogan_shortcode_btn2_params
		);

		return array(
			"name" => esc_html__( "Slogan", "crocal-extension" ),
			"description" => esc_html__( "Create easily appealing slogans", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-slogan",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => $crocal_ext_vce_slogan_shortcode_params,
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_slogan', 'crocal_ext_vce_slogan_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_slogan_shortcode_params( 'crocal_slogan' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
