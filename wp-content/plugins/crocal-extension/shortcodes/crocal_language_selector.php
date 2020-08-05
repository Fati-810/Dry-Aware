<?php
/**
 * Language selector Shortcode
 */

if( !function_exists( 'crocal_ext_vce_language_selector_shortcode' ) ) {

	function crocal_ext_vce_language_selector_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
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


		$language_selector_classes = array( 'eut-element', 'eut-language-element', 'eut-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $language_selector_classes, 'eut-animated-item' );
			array_push( $language_selector_classes, $animation);
			array_push( $language_selector_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $language_selector_classes, $el_class);
		}
		$language_selector_class_string = implode( ' ', $language_selector_classes );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );
		ob_start();

		?>
			<div class="<?php echo esc_attr( $language_selector_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo $data; ?>>
			<?php
				if( function_exists( 'crocal_eutf_print_language_modal_selector' ) ) {
					crocal_eutf_print_language_modal_selector();
				}
			?>
			</div>
		<?php

		return ob_get_clean();

	}
	add_shortcode( 'crocal_language_selector', 'crocal_ext_vce_language_selector_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_language_selector_shortcode_params' ) ) {
	function crocal_ext_vce_language_selector_shortcode_params( $tag ) {

		return array(
			"name" => esc_html__( "Language Selector", "crocal-extension" ),
			"description" => esc_html__( "Place your language selector", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-languages",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				crocal_ext_vce_add_align(),
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
	vc_lean_map( 'crocal_language_selector', 'crocal_ext_vce_language_selector_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_language_selector_shortcode_params( 'crocal_language_selector' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
