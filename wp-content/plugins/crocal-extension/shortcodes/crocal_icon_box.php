<?php
/**
 * Icon Box Shortcode
 */

if( !function_exists( 'crocal_ext_vce_icon_box_shortcode' ) ) {

	function crocal_ext_vce_icon_box_shortcode( $atts, $content ) {

		$output = $retina_data = $data = $el_class = '';

		$combined_atts = $atts;
		extract(
			$combined_atts = shortcode_atts(
				array(
					'title' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'icon_box_type' => 'top-icon',
					'icon_top_align' => 'center',
					'icon_side_align' => 'left',

					'icon_type' => 'icon',
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

					'icon_animation' => 'no',
					'icon_hover_effect' => 'no',
					'icon_char' => '',
					'icon_image' => '',
					'retina_icon_image' => '',
					'text_style' => 'none',
					'link' => '',
					'link_class' => '',
					'icon_animated_effect' => '',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$heading_class = 'eut-' . $heading;

		$icon_box_classes = array( 'eut-element' );

		array_push( $icon_box_classes, 'eut-box-icon' );
		array_push( $icon_box_classes, 'eut-' . $icon_box_type );

		if( $icon_box_type == 'top-icon' ){
			array_push( $icon_box_classes, 'eut-align-' . $icon_top_align );
		} else {
			array_push( $icon_box_classes, 'eut-align-' . $icon_side_align );
		}

		if ( !empty( $animation ) ) {
			array_push( $icon_box_classes, 'eut-animated-item' );
			array_push( $icon_box_classes, $animation);
			array_push( $icon_box_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( 'yes' == $icon_animation ) {
			array_push( $icon_box_classes, 'eut-advanced-hover' );
		}
		if ( !empty ( $el_class ) ) {
			array_push( $icon_box_classes, $el_class);
		}

		if( 'yes' == $icon_hover_effect && 'no-shape' != $icon_shape ) {
			array_push( $icon_box_classes, 'eut-hover-effect' );
		}

		if( !empty( $icon_animated_effect ) ) {
			array_push( $icon_box_classes, 'eut-animated-effect-' . $icon_animated_effect );
		}

		$icon_box_class_string = implode( ' ', $icon_box_classes );


		// Paragraph
		$text_style_class = '';
		if ( 'none' != $text_style ) {
			$text_style_class = 'eut-' .$text_style;
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $icon_box_class_string ) . '" style="' . $style . '"' . $data . '>';

		if ( crocal_ext_vce_has_link( $link ) ) {
			$link_class_string = 'eut-item-url ' . esc_attr( $link_class );
			$link_attributes = crocal_ext_vce_get_link_attributes( $link, $link_class_string );
			$output .= '<a ' . implode( ' ', $link_attributes ) . '></a>';
		}

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

		$output .= '<div class="eut-box-content">';
		if ( !empty( $title ) ) {

			$title_classes = array( 'eut-box-title' );
			$title_classes[]  = 'eut-' . $heading;
			if ( !empty( $custom_font_family ) ) {
				$title_classes[]  = 'eut-' . $custom_font_family;
			}
			$title_class_string = implode( ' ', $title_classes );

		$output .= '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">' . $title. '</' . tag_escape( $heading_tag ) . '>';
		}
		if ( !empty( $content ) ) {
			$output .= '  <p class="' . esc_attr( $text_style_class ) . '">' . crocal_ext_vce_unautop( $content ) . '</p>';
		}
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'crocal_icon_box', 'crocal_ext_vce_icon_box_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_icon_box_shortcode_params' ) ) {
	function crocal_ext_vce_icon_box_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Icon Box", "crocal-extension" ),
			"description" => esc_html__( "Add an icon, character or image with title and text", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-icon-box",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array_merge(
				array(
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Icon Box Type", "crocal-extension" ),
						"param_name" => "icon_box_type",
						"value" => array(
							esc_html__( "Top Icon", "crocal-extension" ) => 'top-icon',
							esc_html__( "Side Icon", "crocal-extension" ) => 'side-icon',
						),
						'description' => esc_html__( 'Select icon box type.', 'crocal-extension' ),
						"admin_label" => true,
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Alignment", "crocal-extension" ),
						"param_name" => "icon_top_align",
						"value" => array(
							esc_html__( "Left", "crocal-extension" ) => 'left',
							esc_html__( "Center", "crocal-extension" ) => 'center',
							esc_html__( "Right", "crocal-extension" ) => 'right',
						),
						"std" => 'center',
						"dependency" => array( 'element' => "icon_box_type", 'value' => array( 'top-icon' ) ),
						"description" => '',
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Alignment", "crocal-extension" ),
						"param_name" => "icon_side_align",
						"value" => array(
							esc_html__( "Left", "crocal-extension" ) => 'left',
							esc_html__( "Right", "crocal-extension" ) => 'right',
						),
						"dependency" => array( 'element' => "icon_box_type", 'value' => array( 'side-icon' ) ),
						"description" => '',
					),
				),
				crocal_ext_vce_get_icon_params( $tag ),
				array(
					array(
						"type" => 'checkbox',
						"heading" => esc_html__( "Enable Advanced Hover", "crocal-extension" ),
						"param_name" => "icon_animation",
						"value" => array( esc_html__( "If selected, you will have advanced hover.", "crocal-extension" ) => 'yes' ),
						"dependency" => array( 'element' => "icon_box_type", 'value' => array( 'top-icon' ) ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Character", "crocal-extension" ),
						"param_name" => "icon_char",
						"value" => "A",
						"description" => esc_html__( "Type a single character.", "crocal-extension" ),
						"dependency" => array( 'element' => "icon_type", 'value' => array( 'char' ) ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Title", "crocal-extension" ),
						"param_name" => "title",
						"value" => "",
						"description" => esc_html__( "Enter icon box title.", "crocal-extension" ),
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
						"description" => esc_html__( "Enter your content.", "crocal-extension" ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Text Style", "crocal-extension" ),
						"param_name" => "text_style",
						"value" => array(
							esc_html__( "None", "crocal-extension" ) => '',
							esc_html__( "Leader", "crocal-extension" ) => 'leader-text',
							esc_html__( "Subtitle", "crocal-extension" ) => 'subtitle',
							esc_html__( "Small Text", "crocal-extension" ) => 'small-text',
						),
						"description" => 'Select your text style',
					),
					array(
						"type" => "vc_link",
						"heading" => esc_html__( "Link", "crocal-extension" ),
						"param_name" => "link",
						"value" => "",
						"description" => esc_html__( "Enter link.", "crocal-extension" ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Link Class", "crocal-extension" ),
						"param_name" => "link_class",
						"value" => "",
						"description" => esc_html__( "Enter extra class name for your link.", "crocal-extension" ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Looping Animated Icon Effect', 'crocal-extension' ),
						'value' => array(
							esc_html__( 'No', 'crocal-extension' ) => '',
							esc_html__( 'Up Down', 'crocal-extension' ) => 'up-down',
							esc_html__( 'Left Right', 'crocal-extension' ) => 'left-right',
							esc_html__( 'Pulse', 'crocal-extension' ) => 'pulse',
						),
						'param_name' => 'icon_animated_effect',
						'description' => esc_html__( 'Select the looping animation of the icon.', 'crocal-extension' ),
					),
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
	vc_lean_map( 'crocal_icon_box', 'crocal_ext_vce_icon_box_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_icon_box_shortcode_params( 'crocal_icon_box' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
