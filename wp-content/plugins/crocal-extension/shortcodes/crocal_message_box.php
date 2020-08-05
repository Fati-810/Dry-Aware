<?php
/**
 * Message Box Shortcode
 */

if( !function_exists( 'crocal_ext_vce_message_box_shortcode' ) ) {

	function crocal_ext_vce_message_box_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'add_icon' => '',
					'icon_library' => 'fontawesome',
					'icon_fontawesome' => 'fa fa-info-circle',
					'icon_openiconic' => 'vc-oi vc-oi-dial',
					'icon_typicons' => 'typcn typcn-adjust-brightness',
					'icon_entypo' => 'entypo-icon entypo-icon-note',
					'icon_linecons' => 'vc_li vc_li-heart',
					'icon_simplelineicons' => 'smp-icon-user',
					'icon_etlineicons' => 'et-icon-mobile',
					'bg_color' => 'green',
					'bg_hover_color' => 'green',
					'remove_close' => '',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$message_box_classes = array( 'eut-element', 'eut-message' );

		array_push( $message_box_classes, 'eut-bg-' . $bg_color );
		array_push( $message_box_classes, 'eut-bg-hover-' . $bg_hover_color );

		if ( !empty( $animation ) ) {
			array_push( $message_box_classes, 'eut-animated-item' );
			array_push( $message_box_classes, $animation);
			array_push( $message_box_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $message_box_classes, $el_class);
		}

		$message_box_class_string = implode( ' ', $message_box_classes );

		if( 'yes' == $add_icon ) {
			$icon_class = isset( ${"icon_" . $icon_library} ) ? esc_attr( ${"icon_" . $icon_library} ) : 'fa fa-adjust';
			if ( function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
				vc_icon_element_fonts_enqueue( $icon_library );
			}
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $message_box_class_string ) . '" style="' . $style . '"' . $data . '>';
		if( 'yes' == $add_icon ) {
			$output .= '  <i class="eut-message-icon '. esc_attr( $icon_class ) . '"></i>';
		}
		$output .= '  <p>' . do_shortcode( $content ) . '</p>';
		if ( 'yes' != $remove_close ) {
			$output .= '  <i class="eut-close"></i>';
		}
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'crocal_message_box', 'crocal_ext_vce_message_box_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_message_box_shortcode_params' ) ) {
	function crocal_ext_vce_message_box_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Message Box", "crocal-extension" ),
			"description" => esc_html__( "Info text with icons", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-message-box",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Add icon?", "crocal-extension" ),
					"param_name" => "add_icon",
					"value" => array( esc_html__( "Select if you want to show an icon", "crocal-extension" ) => 'yes' ),
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
					"dependency" => array( 'element' => "add_icon", 'value' => array( 'yes' ) ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'crocal-extension' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-info-circle',
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
					"type" => "textarea",
					"heading" => esc_html__( "Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "Sample Text",
					"description" => esc_html__( "Enter your content.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Background Color", "crocal-extension" ),
					"param_name" => "bg_color",
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
					"description" => esc_html__( "Background color of the box.", "crocal-extension" ),
					'std' => 'green',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Background Hover Color", "crocal-extension" ),
					"param_name" => "bg_hover_color",
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
					"description" => esc_html__( "Background hover color of the box.", "crocal-extension" ),
					'std' => 'green',
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Remove Close Button", "crocal-extension" ),
					"param_name" => "remove_close",
					"value" => array( esc_html__( "If selected, close button will be removed", "crocal-extension" ) => 'yes' ),
				),
				crocal_ext_vce_add_animation(),
				crocal_ext_vce_add_animation_delay(),
				crocal_ext_vce_add_animation_duration(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_message_box', 'crocal_ext_vce_message_box_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_message_box_shortcode_params( 'crocal_message_box' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
