<?php
/**
 * Modal Shortcode
 */

if( !function_exists( 'crocal_ext_vce_modal_shortcode' ) ) {

	function crocal_ext_vce_modal_shortcode( $attr, $content ) {

		$output = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'modal_id' => '',
					'modal_mode' => 'full',
					'content_bg_color' => 'white',
					'font_color'      => '',
					'heading_color' => '',
					'content_size' => 'large',
					'el_class' => '',
				),
				$attr
			)
		);

		$modal_classes = array( 'eut-modal-element', 'mfp-hide' );
		if( !empty( $el_class ) ) {
			$modal_classes[] = $el_class;
		}


		if ( 'dialog' == $modal_mode ) {
			$modal_classes[] = 'eut-modal-dialog';
			$modal_classes[] = 'eut-bg-' . $content_bg_color;
			$modal_classes[] = 'eut-drop-shadow';
			$modal_classes[] = 'eut-content-' . $content_size;
		}
		if ( !empty ( $heading_color ) ) {
			$modal_classes[] = 'eut-headings-' . $heading_color;
		}
		$modal_classes_string = implode( ' ', $modal_classes );

		$wrapper_attributes = array();
		$wrapper_attributes[] = 'class="' . esc_attr( $modal_classes_string ) . '"';
		$wrapper_attributes[] = 'id="' . esc_attr( $modal_id ) . '"';

		$style = crocal_ext_vce_build_shortcode_style(
			array(
				'font_color' => $font_color,
			)
		);
		if( !empty( $style ) ) {
			$wrapper_attributes[] = $style;
		}


		ob_start();

		?>
			<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
				<div class="eut-section eut-modal-section">
					<div class="eut-container">
						<div class="eut-row eut-columns-gap-30">
							<div class="eut-column eut-column-1">
							<?php
								if ( !empty( $content ) ) {
									echo do_shortcode( $content );
								}
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		return ob_get_clean();

	}
	add_shortcode( 'crocal_modal', 'crocal_ext_vce_modal_shortcode' );

}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_crocal_modal extends WPBakeryShortCodesContainer {
    }
}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_modal_shortcode_params' ) ) {
	function crocal_ext_vce_modal_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Modal", "crocal-extension" ),
			"description" => esc_html__( "Add a modal with elements", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon" => "icon-wpb-eut-modal",
			"category" => esc_html__( "Content", "js_composer" ),
			"content_element" => true,
			"controls" => "full",
			"show_settings_on_create" => true,
			"as_parent" => array('except' => 'vc_tta_section,crocal_modal'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Modal ID", "crocal-extension" ),
					"param_name" => "modal_id",
					"admin_label" => true,
					"description" => esc_html__( "Enter a unique id to trigger the modal from a link or button. In your link use class: eut-modal-popup and href: # following the Modal ID.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Modal Mode", "crocal-extension" ),
					"param_name" => "modal_mode",
					"value" => array(
						esc_html__( "Full", "crocal-extension" ) => 'full',
						esc_html__( "Dialog", "crocal-extension" ) => 'dialog',
					),
					"description" => esc_html__( "Select your modal mode.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Content Size", "crocal-extension" ),
					"param_name" => "content_size",
					"value" => array(
						esc_html__( "Large", "crocal-extension" ) => 'large',
						esc_html__( "Medium", "crocal-extension" ) => 'medium',
						esc_html__( "Small", "crocal-extension" ) => 'small',
					),
					"description" => esc_html__( "Select the content size of your modal.", "crocal-extension" ),
					"dependency" => array( 'element' => "modal_mode", 'value' => array( 'dialog' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Background Color", "crocal-extension" ),
					"param_name" => "content_bg_color",
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
					"description" => esc_html__( "Background color of the modal dialog.", "crocal-extension" ),
					"dependency" => array( 'element' => "modal_mode", 'value' => array( 'dialog' ) ),
					'std' => 'white',
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__( "Font Color", "crocal-extension" ),
					"param_name" => "font_color",
					"description" => esc_html__("Select font color", 'crocal-extension' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Heading Color", "crocal-extension" ),
					"param_name" => "heading_color",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Default", "crocal-extension" ) => '',
						esc_html__( "Dark", "crocal-extension" ) => 'dark',
						esc_html__( "Light", "crocal-extension" ) => 'light',
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
					),
					"description" => esc_html__( "Heading color of the modal.", "crocal-extension" ),
					'std' => '',
				),
				crocal_ext_vce_add_el_class(),
			),
			"js_view" => 'VcColumnView',
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_modal', 'crocal_ext_vce_modal_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_modal_shortcode_params( 'crocal_modal' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
