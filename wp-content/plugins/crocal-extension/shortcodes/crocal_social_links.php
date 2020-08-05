<?php
/**
 * Social Links Shortcode
 */

if( !function_exists( 'crocal_ext_vce_social_links_shortcode' ) ) {

	function crocal_ext_vce_social_links_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'animation' => '',
					'inherit_align' => 'inherit',
					'shape_color' => 'primary-1',
					'social_type' => 'icon',
					'list_type' => 'vertical',
					'font_size' => 'link-text',
					'icon_size' => 'medium',
					'icon_shape' => 'no-shape',
					'shape_type' => 'simple',
					'icon_color' => 'primary-1',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);


		$social_classes = array( 'eut-element', 'eut-social', 'eut-align-' . $inherit_align );

		if ( !empty( $animation ) ) {
			array_push( $social_classes, 'eut-animated-item' );
			array_push( $social_classes, $animation);
			array_push( $social_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $social_classes, $el_class);
		}

		array_push( $social_classes, 'eut-' . $social_type . '-type');

		if ( 'list' == $social_type ) {
			array_push( $social_classes, 'eut-' . $list_type );
			array_push( $social_classes, 'eut-text-' . $icon_color );
		}

		$social_class_string = implode( ' ', $social_classes );

		$social_shape_classes = array();

		array_push( $social_shape_classes, 'eut-' . $icon_size );
		array_push( $social_shape_classes, 'eut-' . $icon_shape );

		if ( 'no-shape' != $icon_shape ) {
			array_push( $social_shape_classes, 'eut-with-shape' );
			array_push( $social_shape_classes, 'eut-' . $shape_type );
			if ( 'outline' != $shape_type ) {
				array_push( $social_shape_classes, 'eut-bg-' . $shape_color );
			} else {
				array_push( $social_shape_classes, 'eut-text-' . $shape_color );
				array_push( $social_shape_classes, 'eut-text-hover-' . $shape_color );
			}
		}

		$social_shape_class_string = implode( ' ', $social_shape_classes );


		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );
		global $crocal_eutf_social_list_extended;
		ob_start();

		if ( isset( $crocal_eutf_social_list_extended ) ) {

		?>
			<div class="<?php echo esc_attr( $social_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo $data; ?>>
				<ul>
				<?php
				foreach ( $crocal_eutf_social_list_extended as $social_item ) {

					$social_item_url = crocal_ext_vce_array_value( $atts, $social_item['url'] );

					if ( ! empty( $social_item_url ) ) {

						if( 'icon' == $social_type ) {

							if ( 'skype' == $social_item['id'] ) {
				?>
								<li>
									<a href="<?php echo esc_url( $social_item_url, array( 'skype', 'http', 'https' ) ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?>">
										<i class="eut-text-<?php echo esc_attr( $icon_color ); ?> <?php echo esc_attr( $social_item['class'] ); ?>"></i>
									</a>
								</li>
				<?php
							} else {
				?>
								<li>
									<a href="<?php echo esc_url( $social_item_url ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?>" target="_blank">
										<i class="eut-text-<?php echo esc_attr( $icon_color ); ?> <?php echo esc_attr( $social_item['class'] ); ?>"></i>
									</a>
								</li>
				<?php
							}
						} else {
							if ( 'skype' == $social_item['id'] ) {
				?>
								<li>
									<a href="<?php echo esc_url( $social_item_url, array( 'skype', 'http', 'https' ) ); ?>" class="eut-<?php echo esc_attr( $font_size ); ?>">
										<span><?php echo esc_attr( $social_item['title'] ); ?></span>
									</a>
								</li>
				<?php
							} else {
				?>
								<li>
									<a href="<?php echo esc_url( $social_item_url ); ?>" class="eut-<?php echo esc_attr( $font_size ); ?>" target="_blank">
										<span><?php echo esc_attr( $social_item['title'] ); ?></span>
									</a>
								</li>
				<?php
							}

						}

					}
				}
				?>
				</ul>
			</div>
		<?php
		}

		return ob_get_clean();

	}
	add_shortcode( 'crocal_social_links', 'crocal_ext_vce_social_links_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_social_links_shortcode_params' ) ) {
	function crocal_ext_vce_social_links_shortcode_params( $tag ) {

		$crocal_ext_vce_social_links_shortcode_params = array_merge(
			array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Icon Type", "crocal-extension" ),
					"param_name" => "social_type",
					"value" => array(
						esc_html__( "Icon", "crocal-extension" ) => 'icon',
						esc_html__( "List", "crocal-extension" ) => 'list',
					),
					"description" => '',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "List Type", "crocal-extension" ),
					"param_name" => "list_type",
					"value" => array(
						esc_html__( "Vertical", "crocal-extension" ) => 'vertical',
						esc_html__( "Horizontal", "crocal-extension" ) => 'horizontal',
					),
					"description" => '',
					"dependency" => array( 'element' => "social_type", 'value' => array( 'list' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Font Size", "crocal-extension" ),
					"param_name" => "font_size",
					"value" => array(
						esc_html__( "Link Text", "crocal-extension" ) => 'link-text',
						esc_html__( "Small Text", "crocal-extension" ) => 'small-text',
						esc_html__( "Paragraph Text", "crocal-extension" ) => 'paragraph-text',
						esc_html__( "Leader Text", "crocal-extension" ) => 'leader-text',
					),
					"description" => '',
					"dependency" => array( 'element' => "social_type", 'value' => array( 'list' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Icon size", "crocal-extension" ),
					"param_name" => "icon_size",
					"value" => array(
						esc_html__( "Large", "crocal-extension" ) => 'large',
						esc_html__( "Medium", "crocal-extension" ) => 'medium',
						esc_html__( "Small", "crocal-extension" ) => 'small',
					),
					"std" => 'medium',
					"description" => '',
					"dependency" => array( 'element' => "social_type", 'value' => array( 'icon' ) ),
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
					"description" => esc_html__( "Color of the social icon.", "crocal-extension" ),
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
					"dependency" => array( 'element' => "social_type", 'value' => array( 'icon' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Shape Color", "crocal-extension" ),
					"param_name" => "shape_color",
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
					"description" => esc_html__( "Color of the shape.", "crocal-extension" ),
					"dependency" => array( 'element' => "icon_shape", 'value' => array( 'square', 'round', 'circle' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Shape type", "crocal-extension" ),
					"param_name" => "shape_type",
					"value" => array(
						esc_html__( "Simple", "crocal-extension" ) => 'simple',
						esc_html__( "Outline", "crocal-extension" ) => 'outline',
					),
					"description" => esc_html__( "Select shape type.", "crocal-extension" ),
					"dependency" => array( 'element' => "icon_shape", 'value' => array( 'square', 'round', 'circle' ) ),
				),
				crocal_ext_vce_add_inherit_align(),
				crocal_ext_vce_add_animation(),
				crocal_ext_vce_add_animation_delay(),
				crocal_ext_vce_add_animation_duration(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
			),
			crocal_ext_vce_get_social_links_params()
		);

		return array(
			"name" => esc_html__( "Social Links", "crocal-extension" ),
			"description" => esc_html__( "Add social networking links.", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-social",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => $crocal_ext_vce_social_links_shortcode_params,
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_social_links', 'crocal_ext_vce_social_links_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_social_links_shortcode_params( 'crocal_social_links' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
