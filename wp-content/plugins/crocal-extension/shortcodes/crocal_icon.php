<?php
/**
 * Icon Shortcode
 */

if( !function_exists( 'crocal_ext_vce_icon_shortcode' ) ) {

	function crocal_ext_vce_icon_shortcode( $atts, $content ) {

		$output = $link_start = $link_end = $video_link_start = $video_link_end = $retina_data = $text_style_class = $data = $el_class = '';

		$combined_atts = $atts;
		extract(
			$combined_atts = shortcode_atts(
				array(
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
					'icon_shape_color' => 'grey',
					'icon_shape_color_custom' => '#e1e1e1',
					'inherit_align' => 'inherit',
					'icon_hover_effect' => 'no',
					'link' => '',
					'video_link' => '',
					'link_class' => '',
					'title' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
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

		$icon_element_classes = array( 'eut-element' );
		array_push( $icon_element_classes, 'eut-align-' . $inherit_align );

		if( !empty( $icon_animated_effect ) ) {
			array_push( $icon_element_classes, 'eut-animated-effect-' . $icon_animated_effect );
		}

		if ( !empty( $animation ) ) {
			array_push( $icon_element_classes, 'eut-animated-item' );
			array_push( $icon_element_classes, $animation);
			array_push( $icon_element_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $icon_element_classes, $el_class);
		}

		$icon_element_class_string = implode( ' ', $icon_element_classes );


		$title_classes = array( 'eut-video-icon-title' );
		$title_classes[]  = 'eut-' . $heading;
		if ( !empty( $custom_font_family ) ) {
			$title_classes[]  = 'eut-' . $custom_font_family;
		}
		$title_class_string = implode( ' ', $title_classes );


		if ( crocal_ext_vce_has_link( $link ) ) {
			$link_attributes = crocal_ext_vce_get_link_attributes( $link, $link_class );
			$link_start = '<a ' . implode( ' ', $link_attributes ) . '>';
			$link_end = '</a>';
		}

		if ( !empty ( $video_link ) ) {
			$video_link_start = '<a class="eut-video-popup" href="' . esc_url( $video_link ) . '">';
			$video_link_end = '</a>';
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );


		$output .= '<div class="' . esc_attr( $icon_element_class_string ) . '" style="' . $style . '"' . $data . '>';
		if ( 'theme_icons' != $icon_type ) {
			$output .= $link_start;
			$output .=  crocal_ext_vce_get_icon( $combined_atts );
			$output .= $link_end;
		} else {
			$output .= $video_link_start;
			$output .= '<div class="eut-single-icon">';
			$output .= crocal_ext_vce_get_video_icon( $icon_color, 'position-relative', $icon_size );
			if ( !empty ( $title ) ) {
				$output .= '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">' . $title. '</' . tag_escape( $heading_tag ) . '>';
			}
			$output .= '</div>';
			$output .= $video_link_end;
		}
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'crocal_icon', 'crocal_ext_vce_icon_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_icon_shortcode_params' ) ) {
	function crocal_ext_vce_icon_shortcode_params( $tag ) {

		return array(
			"name" => esc_html__( "Icon", "crocal-extension" ),
			"description" => esc_html__( "Add an icon", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-icon",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array_merge(
				array(
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Icon Type", "crocal-extension" ),
						"param_name" => "icon_type",
						"value" => array(
							esc_html__( "Icon", "crocal-extension" ) => 'icon',
							esc_html__( "Animated SVG", "crocal-extension" ) => 'icon_svg',
							esc_html__( "Video Icon", "crocal-extension" ) => 'theme_icons',
						),
						"description" => '',
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Icon size", "crocal-extension" ),
						"param_name" => "icon_size",
						"value" => array(
							esc_html__( "Extra Large", "crocal-extension" ) => 'extra-large',
							esc_html__( "Large", "crocal-extension" ) => 'large',
							esc_html__( "Medium", "crocal-extension" ) => 'medium',
							esc_html__( "Small", "crocal-extension" ) => 'small',
						),
						"std" => 'medium',
						"description" => '',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Icon library', 'crocal-extension' ),
						'value' => array(
							esc_html__( 'Font Awesome', 'crocal-extension' ) => 'fontawesome',
							esc_html__( 'Open Iconic', 'crocal-extension' ) => 'openiconic',
							esc_html__( 'Typicons', 'crocal-extension' ) => 'typicons',
							esc_html__( 'Entypo', 'crocal-extension' ) => 'entypo',
							esc_html__( 'Linecons', 'crocal-extension' ) => 'linecons',
							esc_html__( 'Simple Line Icons', 'crocal-extension' ) => 'simplelineicons',
							esc_html__( 'Elegant Line Icons', 'crocal-extension' ) => 'etlineicons',
						),
						'param_name' => 'icon_library',
						'description' => esc_html__( 'Select icon library.', 'crocal-extension' ),
						"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon' ) ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'crocal-extension' ),
						'param_name' => 'icon_fontawesome',
						'value' => 'fa fa-adjust',
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'icon_library',
							'value' => 'fontawesome',
						),
						'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'crocal-extension' ),
						'param_name' => 'icon_openiconic',
						'value' => 'vc-oi vc-oi-dial',
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'openiconic',
							'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'icon_library',
							'value' => 'openiconic',
						),
						'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'crocal-extension' ),
						'param_name' => 'icon_typicons',
						'value' => 'typcn typcn-adjust-brightness',
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'typicons',
							'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'icon_library',
							'value' => 'typicons',
						),
						'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'crocal-extension' ),
						'param_name' => 'icon_entypo',
						'value' => 'entypo-icon entypo-icon-note',
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'entypo',
							'iconsPerPage' => 300, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'icon_library',
							'value' => 'entypo',
						),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'crocal-extension' ),
						'param_name' => 'icon_linecons',
						'value' => 'vc_li vc_li-heart',
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'linecons',
							'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'icon_library',
							'value' => 'linecons',
						),
						'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'crocal-extension' ),
						'param_name' => 'icon_simplelineicons',
						'value' => 'smp-icon-user',
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'simplelineicons',
							'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'icon_library',
							'value' => 'simplelineicons',
						),
						'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'crocal-extension' ),
						'param_name' => 'icon_etlineicons',
						'value' => 'et-icon-mobile',
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'etlineicons',
							'iconsPerPage' => 100,
						),
						'dependency' => array(
							'element' => 'icon_library',
							'value' => 'etlineicons',
						),
						'description' => esc_html__( 'Select icon from library.', 'crocal-extension' ),
					),
					array(
						"type" => "attach_image",
						"heading" => esc_html__( "Icon SVG", "crocal-extension" ),
						"param_name" => "icon_svg",
						"value" => '',
						"description" => esc_html__( "Select an svg icon. Note: SVG mime type must be enabled in WordPress", "crocal-extension" ),
						"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon_svg' ) ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__('SVG Animation Duration', 'crocal-extension'),
						"param_name" => "icon_svg_animation_duration",
						"value" => '100',
						"description" => esc_html__( "Add delay in milliseconds.", "crocal-extension" ),
						"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon_svg' ) ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Icon Color", "crocal-extension" ),
						"param_name" => "icon_color",
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
						"description" => esc_html__( "Color of the icon.", "crocal-extension" ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Icon shape", "crocal-extension" ),
						"param_name" => "icon_shape",
						"value" => array(
							esc_html__( "None", "crocal-extension" ) => 'no-shape',
							esc_html__( "Square", "crocal-extension" ) => 'square',
							esc_html__( "Round", "crocal-extension" ) => 'round',
							esc_html__( "Circle", "crocal-extension" ) => 'circle',
						),
						"description" => '',
						"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon', 'icon_svg' ) ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Shape type", "crocal-extension" ),
						"param_name" => "icon_shape_type",
						"value" => array(
							esc_html__( "Simple", "crocal-extension" ) => 'simple',
							esc_html__( "Outline", "crocal-extension" ) => 'outline',
						),
						"description" => esc_html__( "Select shape type.", "crocal-extension" ),
						"dependency" => array( 'element' => "icon_shape", 'value' => array( 'square', 'round', 'circle' ) ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Icon Shape Color", "crocal-extension" ),
						"param_name" => "icon_shape_color",
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
						'std' => 'grey',
						"description" => esc_html__( "This affects to the Background of the simple shape type. Alternatively, affects to the line shape type.", "crocal-extension" ),
						"dependency" => array( 'element' => "icon_shape", 'value' => array( 'square', 'round', 'circle' ) ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( "Custom Icon Shape Color", "crocal-extension" ),
						'param_name' => 'icon_shape_color_custom',
						'description' => esc_html__( "Select a custom color for your icon shape.", "crocal-extension" ),
						'std' => '#e1e1e1',
						"dependency" => array( 'element' => "icon_shape_color", 'value' => array( 'custom' ) ),
					),
					array(
						"type" => 'checkbox',
						"heading" => esc_html__( "Enable Hover Effect", "crocal-extension" ),
						"param_name" => "icon_hover_effect",
						"value" => array( esc_html__( "If selected, you will have hover effect.", "crocal-extension" ) => 'yes' ),
						"dependency" => array( 'element' => "icon_shape", 'value' => array( 'square', 'round', 'circle' ) ),
					),
					crocal_ext_vce_add_inherit_align(),
					array(
						"type" => "vc_link",
						"heading" => esc_html__( "Link", "crocal-extension" ),
						"param_name" => "link",
						"value" => "",
						"description" => esc_html__( "Enter link.", "crocal-extension" ),
						"dependency" => array( 'element' => 'icon_type', 'value_not_equal_to' => array( 'theme_icons' ) ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Link Class", "crocal-extension" ),
						"param_name" => "link_class",
						"value" => "",
						"description" => esc_html__( "Enter extra class name for your link.", "crocal-extension" ),
						"dependency" => array( 'element' => 'icon_type', 'value_not_equal_to' => array( 'theme_icons' ) ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Video Link", "crocal-extension" ),
						"param_name" => "video_link",
						"value" => "",
						"description" => esc_html__( "Type video URL e.g Vimeo/YouTube.", "crocal-extension" ),
						"dependency" => array( 'element' => "icon_type", 'value' => array( 'theme_icons' ) ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Title", "crocal-extension" ),
						"param_name" => "title",
						"value" => "",
						"description" => esc_html__( "Enter your title.", "crocal-extension" ),
						"save_always" => true,
						"dependency" => array( 'element' => "icon_type", 'value' => array( 'theme_icons' ) ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Title Tag", "crocal-extension" ),
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
						"description" => esc_html__( "Title Tag for SEO", "crocal-extension" ),
						"dependency" => array( 'element' => "icon_type", 'value' => array( 'theme_icons' ) ),
						"std" => "h3",
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Title Size/Typography", "crocal-extension" ),
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
						"description" => esc_html__( "Title size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
						"dependency" => array( 'element' => "icon_type", 'value' => array( 'theme_icons' ) ),
						"std" => "h3",
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__( "Custom Font Family", "crocal-extension" ),
						"param_name" => "custom_font_family",
						"value" => array(
							esc_html__( "Same as Typography", "crocal-extension" ) => '',
							esc_html__( "Custom Font Family 1", "crocal-extension" ) => 'custom-font-1',
							esc_html__( "Custom Font Family 2", "crocal-extension" ) => 'custom-font-2',
							esc_html__( "Custom Font Family 3", "crocal-extension" ) => 'custom-font-3',
							esc_html__( "Custom Font Family 4", "crocal-extension" ) => 'custom-font-4',

						),
						"description" => esc_html__( "Select a different font family, defined in Theme Options - Typography Options - Extras - Custom Font Family", "crocal-extension" ),
						"dependency" => array( 'element' => "icon_type", 'value' => array( 'theme_icons' ) ),
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
	vc_lean_map( 'crocal_icon', 'crocal_ext_vce_icon_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_icon_shortcode_params( 'crocal_icon' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
