<?php
/**
 * Fancy Box Shortcode
 */

if( !function_exists( 'crocal_ext_vce_fancy_box_shortcode' ) ) {

	function crocal_ext_vce_fancy_box_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'title_color' => '',
					'title_color_custom' => '#e1e1e1',
					'text_color' => '',
					'text_color_custom' => '#e1e1e1',
					'text_style' => 'none',
					'fancy_box_align' => 'left',
					'align' => 'left',
					'read_more_title' => '',
					'read_more_link' => '',
					'radius' => '5',
					'read_more_class' => '',
					'content_bg' => '',
					'content_bg_hover' => 'primary-1',
					'icon_library' => 'fontawesome',
					'icon_fontawesome' => 'fa fa-adjust',
					'icon_openiconic' => 'vc-oi vc-oi-dial',
					'icon_typicons' => 'typcn typcn-adjust-brightness',
					'icon_entypo' => 'entypo-icon entypo-icon-note',
					'icon_linecons' => 'vc_li vc_li-heart',
					'icon_simplelineicons' => 'smp-icon-user',
					'icon_etlineicons' => 'et-icon-mobile',
					'icon_type' => '',
					'icon_size' => 'medium',
					'icon_color' => 'primary-1',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		// Fancy Box Title Classes
		$title_classes = array( 'eut-title', 'eut-heading-color' );
		$title_classes[]  = 'eut-' . $heading;
		if ( !empty( $custom_font_family ) ) {
			$title_classes[]  = 'eut-' . $custom_font_family;
		}
		if( !empty( $title_color ) && 'custom' != $title_color ){
			$title_classes[]  = 'eut-text-' . $title_color;
		}
		$title_class_string = implode( ' ', $title_classes );

		$title_style = '';
		if( 'custom' == $title_color ){
			$title_style = ' color: ' . esc_attr( $title_color_custom ) . ';';
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );


		// Fancy Box Classes
		$fancy_box_classes = array( 'eut-element', 'eut-fancy-box' );

		if ( !empty( $content_bg ) ) {
			$fancy_box_classes[]  = 'eut-bg-' . $content_bg;
		}
		if ( !empty( $radius ) ) {
			$fancy_box_classes[]  = 'eut-' . $radius;
		}
		if( !empty( $text_color ) && 'custom' != $title_color ){
			$fancy_box_classes[]  = 'eut-text-' . $text_color;
		}

		if ( 'white' == $content_bg_hover ) {
			$fancy_box_classes[]  = 'eut-fancy-box-text-black';
		}

		if ( !empty( $animation ) ) {
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
			$fancy_box_classes[] = 'eut-animated-item';
			$fancy_box_classes[] = $animation;
			$fancy_box_classes[] = 'eut-duration-' . $animation_duration;
		}

		$fancy_box_classes[]  = 'eut-align-' . $align;

		$fancy_box_class_string = implode( ' ', $fancy_box_classes );

		if( 'custom' == $text_color ){
			$style .= ' color: ' . esc_attr( $text_color_custom ) . ';';
		}


		// Paragraph
		$text_style_class = array( 'eut-description' );
		if ( 'none' != $text_style ) {
			$text_style_class[]  = 'eut-' . $text_style;
		}

		$text_style_class_string = implode( ' ', $text_style_class );

		// Fancy Box Bg Classes
		$fancy_box_bg_classes = array( 'eut-fancy-box-bg' );

		if ( !empty( $radius ) ) {
			$fancy_box_bg_classes[]  = 'eut-' . $radius;
		}
		$fancy_box_bg_classes[]  = 'eut-bg-' . $content_bg_hover;

		$fancy_box_bg_class_string = implode( ' ', $fancy_box_bg_classes );

		// Fancy Box Icon Classes
		$icon_classes = array();
		if ( 'icon' == $icon_type ) {
			$icon_class = isset( ${"icon_" . $icon_library} ) ? esc_attr( ${"icon_" . $icon_library} ) : 'fa fa-adjust';
			if ( function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
				vc_icon_element_fonts_enqueue( $icon_library );
			}
			array_push( $icon_classes, $icon_class );
			array_push( $icon_classes, 'eut-text-' . $icon_color );
			array_push( $icon_classes, 'eut-' . $icon_size );
		}

		$icon_class_string = implode( ' ', $icon_classes );

		$output .= '<div class="' . esc_attr( $fancy_box_class_string ) . '" style="' . $style . '"' . $data . '>';
		$output .= '  <div class="eut-fancy-box-inner">';

		if ( 'icon' == $icon_type ) {
			$output .= '  <div class="eut-fancy-box-icon">';
			$output .= '  <i class="' . esc_attr( $icon_class_string ) . '"></i>';
			$output .= '  </div>';
		}

		if ( !empty( $title ) ) {
			$output .= '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '" style="' . $title_style . '">' . $title. '</' . tag_escape( $heading_tag ) . '>';
		}
		if ( !empty( $content ) ) {
			$output .= '  <p class="' . esc_attr( $text_style_class_string ) . '">' . do_shortcode( $content ) . '</p>';
		}
		if ( !empty( $read_more_title ) && crocal_ext_vce_has_link( $read_more_link ) ) {
			$output .= '<div class="eut-link-text eut-fancy-box-read-more">';
			$output .= $read_more_title ;
			$output .= '</div>';
		}
		$output .= '  </div>';
		if ( crocal_ext_vce_has_link( $read_more_link ) ) {
			$link_class_string = 'eut-item-url ' . esc_attr( $read_more_class );
			$link_attributes = crocal_ext_vce_get_link_attributes( $read_more_link, $link_class_string );
			$output .= '<a ' . implode( ' ', $link_attributes ) . '></a>';
		}
		$output .= '  <div class="' . esc_attr( $fancy_box_bg_class_string ) . '"></div>';
		$output .= '</div>';


		return $output;
	}
	add_shortcode( 'crocal_fancy_box', 'crocal_ext_vce_fancy_box_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_fancy_box_shortcode_params' ) ) {
	function crocal_ext_vce_fancy_box_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Fancy Box", "crocal-extension" ),
			"description" => esc_html__( "Combine image or video with text and button", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-fancy-box",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
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
					"type" => "dropdown",
					"heading" => esc_html__( "Title Color", "crocal-extension" ),
					"param_name" => "title_color",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Inherit", "crocal-extension" ) => '',
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
						esc_html__( "Dark Grey", "crocal-extension" ) => 'dark-grey',
						esc_html__( "White", "crocal-extension" ) => 'white',
						esc_html__( "Custom", "crocal-extension" ) => 'custom',
					),
					"description" => esc_html__( "Select the color of your title.", "crocal-extension" ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Custom Title Color", "crocal-extension" ),
					'param_name' => 'title_color_custom',
					'description' => esc_html__( "Select a custom color for your title", "crocal-extension" ),
					'std' => '#e1e1e1',
					"dependency" => array( 'element' => "title_color", 'value' => array( 'custom' ) ),
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__( "Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "",
					"description" => esc_html__( "Enter your text.", "crocal-extension" ),
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
					"type" => "dropdown",
					"heading" => esc_html__( "Text Color", "crocal-extension" ),
					"param_name" => "text_color",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Inherit", "crocal-extension" ) => '',
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
						esc_html__( "Dark Grey", "crocal-extension" ) => 'dark-grey',
						esc_html__( "Light Grey", "crocal-extension" ) => 'light-grey',
						esc_html__( "White", "crocal-extension" ) => 'white',
						esc_html__( "Custom", "crocal-extension" ) => 'custom',
					),
					"description" => esc_html__( "Select the color of your title.", "crocal-extension" ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Custom Text Color", "crocal-extension" ),
					'param_name' => 'text_color_custom',
					'description' => esc_html__( "Select a custom color for your title", "crocal-extension" ),
					'std' => '#e1e1e1',
					"dependency" => array( 'element' => "text_color", 'value' => array( 'custom' ) ),
				),
				crocal_ext_vce_add_align(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Background Color", "crocal-extension" ),
					"param_name" => "content_bg",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Transparent", "crocal-extension" ) => '',
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
						esc_html__( "Grey", "crocal-extension" ) => 'grey',
						esc_html__( "Dark Grey", "crocal-extension" ) => 'dark-grey',
						esc_html__( "Light Grey", "crocal-extension" ) => 'light-grey',
						esc_html__( "Black", "crocal-extension" ) => 'black',
						esc_html__( "White", "crocal-extension" ) => 'white',
					),
					"description" => esc_html__( "Background color of the fancy box.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Hover Background Color", "crocal-extension" ),
					"param_name" => "content_bg_hover",
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
						esc_html__( "Grey", "crocal-extension" ) => 'grey',
						esc_html__( "Dark Grey", "crocal-extension" ) => 'dark-grey',
						esc_html__( "Light Grey", "crocal-extension" ) => 'light-grey',
						esc_html__( "Black", "crocal-extension" ) => 'black',
						esc_html__( "White", "crocal-extension" ) => 'white',
					),
					"description" => esc_html__( "Background color of the fancy box.", "crocal-extension" ),
				),
				crocal_ext_vce_add_radius( "5" ),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Read More Title", "crocal-extension" ),
					"param_name" => "read_more_title",
					"value" => "",
					"description" => esc_html__( "Enter your title for your link.", "crocal-extension" ),
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( "Read More Link", "crocal-extension" ),
					"param_name" => "read_more_link",
					"value" => "",
					"description" => esc_html__( "Enter read more link.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Read More Link Class", "crocal-extension" ),
					"param_name" => "read_more_class",
					"value" => "",
					"description" => esc_html__( "Enter extra class name for your link.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Icon type", "crocal-extension" ),
					"param_name" => "icon_type",
					"value" => array(
						esc_html__( "No Icon", "crocal-extension" ) => '',
						esc_html__( "Icon", "crocal-extension" ) => 'icon',
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
					"dependency" => array( 'element' => 'icon_type', 'value_not_equal_to' => array( '' ) ),
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
						esc_html__( "Dark Grey", "crocal-extension" ) => 'dark-grey',
						esc_html__( "Light Grey", "crocal-extension" ) => 'light-grey',
						esc_html__( "White", "crocal-extension" ) => 'white',
					),
					"description" => esc_html__( "Color of the icon.", "crocal-extension" ),
					"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon' ) ),
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
	vc_lean_map( 'crocal_fancy_box', 'crocal_ext_vce_fancy_box_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_fancy_box_shortcode_params( 'crocal_fancy_box' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
