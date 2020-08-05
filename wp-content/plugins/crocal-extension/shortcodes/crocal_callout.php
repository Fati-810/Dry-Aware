<?php
/**
 * Callout Shortcode
 */

if( !function_exists( 'crocal_ext_vce_callout_shortcode' ) ) {

	function crocal_ext_vce_callout_shortcode( $atts, $content ) {

		$output = $button = $data = $class_leader = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'btn_position' => 'btn-right',
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
					'leader_text' => '',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$title_classes = array( 'eut-callout-content' );
		$title_classes[]  = 'eut-' . $heading;
		if ( !empty( $custom_font_family ) ) {
			$title_classes[]  = 'eut-' . $custom_font_family;
		}
		$title_class_string = implode( ' ', $title_classes );

		if ( 'yes' == $leader_text ) {
			$class_leader = 'eut-leader-text';
		}

		//Button
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

		$callout_classes = array( 'eut-element', 'eut-callout' );

		if ( !empty( $animation ) ) {
			array_push( $callout_classes, 'eut-animated-item' );
			array_push( $callout_classes, $animation);
			array_push( $callout_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $callout_classes, $el_class);
		}

		array_push( $callout_classes, 'eut-' . $btn_position );

		$callout_class_string = implode( ' ', $callout_classes );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $callout_class_string ) . '" style="' . $style . '"' . $data . '>';
		$output .= '  <div class="eut-callout-wrapper">';
		if ( !empty( $title ) ) {
			$output .= '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">' . $title . '</' . tag_escape( $heading_tag ) . '>';
		}
		if ( !empty( $content ) ) {
		$output .= '    <p class="'. esc_attr( $class_leader ) . '">' . crocal_ext_vce_unautop( $content ) . '</p>';
		}
		$output .= '  </div>';
		$output .= '  <div class="eut-button-wrapper">';
		$output .= $button;
		$output .= '  </div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'crocal_callout', 'crocal_ext_vce_callout_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_callout_shortcode_params' ) ) {
	function crocal_ext_vce_callout_shortcode_params( $tag ) {
		$crocal_ext_vce_callout_shortcode_btn_params = crocal_ext_vce_get_button_params();
		$crocal_ext_vce_callout_shortcode_params = array_merge(
			array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", "crocal-extension" ),
					"param_name" => "title",
					"value" => "",
					"description" => esc_html__( "Enter your title.", "crocal-extension" ),
					"admin_label" => true,
				),
				crocal_ext_vce_get_heading_tag( "h3" ),
				crocal_ext_vce_get_heading( "h3" ),
				crocal_ext_vce_get_custom_font_family(),
				array(
					"type" => "textarea",
					"heading" => esc_html__( "Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "",
					"description" => esc_html__( "Enter your text.", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Leader Text", "crocal-extension" ),
					"param_name" => "leader_text",
					"description" => esc_html__( "If selected, text will be shown as leader", "crocal-extension" ),
					"value" => array( esc_html__( "Make text leader", "crocal-extension" ) => 'yes' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Button Position", "crocal-extension" ),
					"param_name" => "btn_position",
					"value" => array(
						esc_html__( "Right", "crocal-extension" ) => 'btn-right',
						esc_html__( "Bottom", "crocal-extension" ) => 'btn-bottom',
					),
					"description" => esc_html__( "Select the position of the button.", "crocal-extension" ),
					"group" => esc_html__( "Button", "crocal-extension" ),
				),
				crocal_ext_vce_add_animation(),
				crocal_ext_vce_add_animation_delay(),
				crocal_ext_vce_add_animation_duration(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
			),
			$crocal_ext_vce_callout_shortcode_btn_params
		);

		return array(
			"name" => esc_html__( "Callout", "crocal-extension" ),
			"description" => esc_html__( "Two different styles for interesting callouts", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-callout",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => $crocal_ext_vce_callout_shortcode_params,
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_callout', 'crocal_ext_vce_callout_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_callout_shortcode_params( 'crocal_callout' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
