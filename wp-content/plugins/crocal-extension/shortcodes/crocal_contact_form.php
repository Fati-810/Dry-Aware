<?php
/**
 * Contact Form Shortcode
 */

if( !function_exists( 'crocal_ext_vce_contact_form_shortcode' ) ) {

	function crocal_ext_vce_contact_form_shortcode( $atts, $content ) {

		$output = '';

		extract(
			shortcode_atts(
				array(
					'id' => '',
					'font_size' => '13',
					'inputs_shape' => '',
					'inputs_bg_color' => '',
					'inputs_bg_color_custom' => '#e1e1e1',
					'inputs_text_color' => '#000000',
					'inputs_placeholder_color' => '#000000',
					'inputs_borders' => 'solid',
					'inputs_border_color' => '#eaeaea',

					'inputs_focus_bg_color' => '',
					'inputs_focus_bg_color_custom' => '#e1e1e1',
					'inputs_focus_text_color' => '#000000',
					'inputs_focus_placeholder_color' => '#000000',
					'inputs_focus_border_color' => '#eaeaea',


					'button_type' => 'simple',
					'button_shape' => 'square',
					'button_shadow' => '',
					'button_color' => 'primary-1',
					'button_hover_color' => 'black',
					'button_size' => 'medium',
				),
				$atts
			)
		);

		if ( !empty( $id ) ) {
			$uid = uniqid();

			// Form Classes
			$form_classes = array( 'eut-element', 'eut-contact-form' );

			$form_classes[] = 'eut-contact-form-' . $uid;
			$form_classes[] = 'eut-form-btn-' . $button_type;
			$form_classes[] = 'eut-form-btn-' . $button_shape;
			$form_classes[] = 'eut-form-btn-bg-' . $button_color;
			$form_classes[] = 'eut-form-btn-bg-hover-' . $button_hover_color;
			$form_classes[] = 'eut-form-btn-' . $button_size;
			if( !empty( $button_shadow )) {
				$form_classes[] = 'eut-form-btn-shadow-' . $button_shadow;
			}

			$form_class_string = implode( ' ', $form_classes );

			// Form Css
			$form_css = array();
			if ( 'round' == $inputs_shape ) {
				$form_css[] = '-webkit-border-radius: 3px';
				$form_css[] = 'border-radius: 3px';
			}
			if ( 'extra-round' == $inputs_shape ) {
				$form_css[] = '-webkit-border-radius: 50px';
				$form_css[] = 'border-radius: 50px';
			}
			if ( 'solid' == $inputs_borders ) {
				$form_css[] = 'border-width: 1px';
				$form_css[] = 'border-style: solid';
				$form_css[] = 'border-color: ' . esc_attr( $inputs_border_color ) . ';';
			} else if ( 'underline' == $inputs_borders ) {
				$form_css[] = 'border-color: transparent';
				$form_css[] = 'border-bottom-width: 1px';
				$form_css[] = 'border-bottom-style: solid';
				$form_css[] = 'border-bottom-color: ' . esc_attr( $inputs_border_color ) . ';';
			} else {
				$form_css[] = 'border-color: transparent';
			}

			if ( 'custom' == $inputs_bg_color ) {
				$form_css[] = 'background-color: ' . esc_attr( $inputs_bg_color_custom ) . ';';
			} else {
				$form_css[] = 'background-color: transparent;';
			}

			$form_css[] = 'color: ' . esc_attr( $inputs_text_color ) . ';';
			$form_css[] = 'font-size: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $font_size) ? $font_size : $font_size.'px').';';



			// Form ::focus Css
			$form_focus_css = array();

			if ( 'solid' == $inputs_borders ) {
				$form_focus_css[] = 'border-color: ' . esc_attr( $inputs_focus_border_color ) . ';';
			} else if ( 'underline' == $inputs_borders ) {
				$form_focus_css[] = 'border-bottom-color: ' . esc_attr( $inputs_focus_border_color ) . ';';
			} else {
				$form_focus_css[] = 'border-color: transparent';
			}

			if ( 'custom' == $inputs_focus_bg_color ) {
				$form_focus_css[] = 'background-color: ' . esc_attr( $inputs_focus_bg_color_custom ) . ';';
			} else {
				$form_focus_css[] = 'background-color: transparent;';
			}

			$form_focus_css[] = 'color: ' . esc_attr( $inputs_focus_text_color ) . ';';


			$output .= '<div class="' . esc_attr( $form_class_string ) . '">';
			$output .= do_shortcode('[contact-form-7 id="' . esc_attr( $id ) . '"]');
			$output .= '</div>';

			$output .= '<style type="text/css">';

			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' input,';
			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' textarea,';
			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' select,';
			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' .wpcf7-list-item-label:before {';
			$output .= implode( ';', $form_css ) . ';';
			$output .= '}';
			$output .= '.wpcf7-form .wpcf7-list-item-label:before {';
			$output .= 'border-color: ' . esc_attr( $inputs_border_color ) . ' !important;';
			$output .= '}';

			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' input:focus,';
			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' textarea:focus,';
			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' select:focus {';
			$output .= implode( ';', $form_focus_css ) . ';';
			$output .= '}';

			// Place Holder
			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' ::-webkit-input-placeholder {';
			$output .= 'color: ' . esc_attr( $inputs_placeholder_color ) . ';';
			$output .= '}';

			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' :-moz-placeholder {';
			$output .= 'color: ' . esc_attr( $inputs_placeholder_color ) . ';';
			$output .= '}';

			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' ::-moz-placeholder {';
			$output .= 'color: ' . esc_attr( $inputs_placeholder_color ) . ';';
			$output .= '}';

			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' :-ms-input-placeholder {';
			$output .= 'color: ' . esc_attr( $inputs_placeholder_color ) . ';';
			$output .= '}';

			// Place Holder ::focus
			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' :focus::-webkit-input-placeholder {';
			$output .= 'color: ' . esc_attr( $inputs_focus_placeholder_color ) . ';';
			$output .= '}';

			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' :focus:-moz-placeholder {';
			$output .= 'color: ' . esc_attr( $inputs_focus_placeholder_color ) . ';';
			$output .= '}';

			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' :focus::-moz-placeholder {';
			$output .= 'color: ' . esc_attr( $inputs_focus_placeholder_color ) . ';';
			$output .= '}';

			$output .= '.eut-contact-form.eut-contact-form-' . $uid . ' :focus:-ms-input-placeholder {';
			$output .= 'color: ' . esc_attr( $inputs_focus_placeholder_color ) . ';';
			$output .= '}';

			$output .= '</style>';
		}

		return $output;
	}
	add_shortcode( 'crocal_contact_form', 'crocal_ext_vce_contact_form_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_contact_form_shortcode_params' ) ) {
	function crocal_ext_vce_contact_form_shortcode_params( $tag ) {

		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		$contact_forms = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[ $cform->post_title ] = $cform->ID;
			}
		} else {
			$contact_forms[ esc_html__( 'No contact forms found', 'crocal-extension' ) ] = 0;
		}

		return array(
			"name" => esc_html__( "Custom Contact Form 7", "crocal-extension" ),
			"description" => esc_html__( "Place Contact Form 7", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-contactform7",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Select Contact Form", "crocal-extension"),
					"param_name" => "id",
					"value" => $contact_forms,
					"description" => esc_html__("Choose previously created contact form from the drop down list.", 'crocal-extension' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Font Size", "crocal-extension" ),
					"param_name" => "font_size",
					"value" => "13",
					"description" => esc_html__( "Enter the font size for your contact form (Note: CSS measurement units allowed).", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Inputs Shape", "crocal-extension"),
					"param_name" => "inputs_shape",
					"value" => array(
						esc_html__( "Square", "crocal-extension" ) => "",
						esc_html__( "Round", "crocal-extension" ) => "round",
						esc_html__( "Extra Round", "crocal-extension" ) => "extra-round",
					),
					"description" => esc_html__("Select the shape for your contact form inputs.", 'crocal-extension' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Input Fields Background", "crocal-extension"),
					"param_name" => "inputs_bg_color",
					"value" => array(
						esc_html__( "Transparent", "crocal-extension" ) => "",
						esc_html__( "Custom", "crocal-extension" ) => 'custom',
					),
					"description" => esc_html__("Select the background color for your contact form inputs.", 'crocal-extension' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Custom Background Color", "crocla-extension" ),
					'param_name' => 'inputs_bg_color_custom',
					'description' => esc_html__( "Select a custom background color for your contact form inputs", "crocla-extension" ),
					'std' => '#e1e1e1',
					"dependency" => array( 'element' => "inputs_bg_color", 'value' => array( 'custom' ) ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Input Fields Text Color", "crocla-extension" ),
					'param_name' => 'inputs_text_color',
					'description' => esc_html__( "Select a text color for your contact form inputs", "crocla-extension" ),
					'std' => '#000000',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Input Fields Placeholder Color", "crocla-extension" ),
					'param_name' => 'inputs_placeholder_color',
					'description' => esc_html__( "Select a placeholder color for your contact form inputs", "crocla-extension" ),
					'std' => '#000000',
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Inputs Fields Borders", "crocal-extension"),
					"param_name" => "inputs_borders",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => "",
						esc_html__( "Solid", "crocal-extension" ) => "solid",
						esc_html__( "Underline", "crocal-extension" ) => "underline",
					),
					'std' => 'solid',
					"description" => esc_html__("Select the shape for your contact form inputs.", 'crocal-extension' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Input Fields Borders Color", "crocla-extension" ),
					'param_name' => 'inputs_border_color',
					'description' => esc_html__( "Select a border color for your contact form inputs", "crocla-extension" ),
					'std' => '#eaeaea',
					"dependency" => array( 'element' => "inputs_borders", 'value' => array( 'solid', 'underline' ) ),
				),






				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Input Fields Background", "crocal-extension"),
					"param_name" => "inputs_focus_bg_color",
					"value" => array(
						esc_html__( "Transparent", "crocal-extension" ) => "",
						esc_html__( "Custom", "crocal-extension" ) => 'custom',
					),
					"description" => esc_html__("Select the background color for your contact form inputs.", 'crocal-extension' ),
					"group" => esc_html__( "Focus", "crocal-extension" ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Custom Background Color", "crocla-extension" ),
					'param_name' => 'inputs_focus_bg_color_custom',
					'description' => esc_html__( "Select a custom background color for your contact form inputs", "crocla-extension" ),
					'std' => '#e1e1e1',
					"dependency" => array( 'element' => "inputs_focus_bg_color", 'value' => array( 'custom' ) ),
					"group" => esc_html__( "Focus", "crocal-extension" ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Input Fields Text Color", "crocla-extension" ),
					'param_name' => 'inputs_focus_text_color',
					'description' => esc_html__( "Select a text color for your contact form inputs", "crocla-extension" ),
					'std' => '#000000',
					'edit_field_class' => 'vc_col-sm-6',
					"group" => esc_html__( "Focus", "crocal-extension" ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Input Fields Placeholder Color", "crocla-extension" ),
					'param_name' => 'inputs_focus_placeholder_color',
					'description' => esc_html__( "Select a placeholder color for your contact form inputs", "crocla-extension" ),
					'std' => '#000000',
					'edit_field_class' => 'vc_col-sm-6',
					"group" => esc_html__( "Focus", "crocal-extension" ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( "Input Fields Borders Color", "crocla-extension" ),
					'param_name' => 'inputs_focus_border_color',
					'description' => esc_html__( "Select a border color for your contact form inputs", "crocla-extension" ),
					'std' => '#eaeaea',
					"dependency" => array( 'element' => "inputs_borders", 'value' => array( 'solid', 'underline' ) ),
					"group" => esc_html__( "Focus", "crocal-extension" ),
				),






				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Button Type", "crocal-extension"),
					"param_name" => "button_type",
					"value" => array(
						esc_html__( "Simple", "crocal-extension" ) => "simple",
						esc_html__( "Outline", "crocal-extension" ) => "outline",
					),
					'std' => 'simple',
					"description" => esc_html__( "Select button type.", "crocal-extension" ),
					"group" => esc_html__( "Button", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Button Color", "crocal-extension" ),
					"param_name" => "button_color",
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
					"description" => esc_html__( "Color of the button.", "crocal-extension" ),
					"dependency" => array( 'element' => "button_type", 'value' => array( 'simple', 'outline' ) ),
					'edit_field_class' => 'vc_col-sm-6',
					"group" => esc_html__( "Button", "crocal-extension" ),
					"std" => 'primary-1',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Button Hover Color", "crocal-extension" ),
					"param_name" => "button_hover_color",
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
					"description" => esc_html__( "Color of the button.", "crocal-extension" ),
					"dependency" => array( 'element' => "button_type", 'value' => array( 'simple', 'outline' ) ),
					'edit_field_class' => 'vc_col-sm-6',
					"group" => esc_html__( "Button", "crocal-extension" ),
					"std" => 'black',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Button Size", "crocal-extension" ),
					"param_name" => "button_size",
					"value" => array(
						esc_html__( "Extra Small", "crocal-extension" ) => 'extrasmall',
						esc_html__( "Small", "crocal-extension" ) => 'small',
						esc_html__( "Medium", "crocal-extension" ) => 'medium',
						esc_html__( "Large", "crocal-extension" ) => 'large',
						esc_html__( "Extra Large", "crocal-extension" ) => 'extralarge',
					),
					"description" => '',
					"std" => 'medium',
					"group" => esc_html__( "Button", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Button Shape", "crocal-extension" ),
					"param_name" => "button_shape",
					"value" => array(
						esc_html__( "Square", "crocal-extension" ) => 'square',
						esc_html__( "Round", "crocal-extension" ) => 'round',
						esc_html__( "Extra Round", "crocal-extension" ) => 'extra-round',
					),
					"dependency" => array( 'element' => "button_type", 'value' => array( 'simple', 'outline', 'gradient' ) ),
					"description" => '',
					"std" => '',
					"group" => esc_html__( "Button", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Button Shadow", "crocal-extension" ),
					"param_name" => "button_shadow",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => '',
						esc_html__( "Small", "crocal-extension" ) => 'small',
						esc_html__( "Medium", "crocal-extension" ) => 'medium',
						esc_html__( "Large", "crocal-extension" ) => 'large',
					),
					"dependency" => array( 'element' => "button_type", 'value' => array( 'simple', 'gradient' ) ),
					"description" => '',
					"std" => 'square',
					"group" => esc_html__( "Button", "crocal-extension" ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_contact_form', 'crocal_ext_vce_contact_form_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_contact_form_shortcode_params( 'crocal_contact_form' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
