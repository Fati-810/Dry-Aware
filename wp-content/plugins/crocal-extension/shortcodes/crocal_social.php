<?php
/**
 * Social Share Shortcode
 */

if( !function_exists( 'crocal_ext_vce_social_shortcode' ) ) {

	function crocal_ext_vce_social_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'social_email' => '',
					'social_facebook' => '',
					'social_twitter' => '',
					'social_linkedin' => '',
					'social_reddit' => '',
					'social_pinterest' => '',
					'social_tumblr' => '',
					'likes' => '',
					'animation' => '',
					'inherit_align' => 'iherit',
					'shape_color' => 'primary-1',
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


		$social_classes = array( 'eut-element', 'eut-social', 'eut-icon-type', 'eut-align-' . $inherit_align );

		if ( !empty( $animation ) ) {
			array_push( $social_classes, 'eut-animated-item' );
			array_push( $social_classes, $animation);
			array_push( $social_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $social_classes, $el_class);
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

		$crocal_ext_permalink = get_permalink();
		$crocal_ext_title = get_the_title();
		$page_email_string = 'mailto:?subject=' . $crocal_ext_title . '&body=' . $crocal_ext_title . ': ' . $crocal_ext_permalink;

		$image_size = 'large';
		if ( has_post_thumbnail() ) {
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$attachment_src = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
			$crocal_ext_image_url = $attachment_src[0];
		} else {
			$crocal_ext_image_url = get_template_directory_uri() . '/images/empty/' . $image_size . '.jpg';
		}

		ob_start();

		?>
			<div class="<?php echo esc_attr( $social_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo $data; ?>>
				<ul>
					<?php if ( !empty( $social_email  ) ) { ?>
					<li><a href="<?php echo esc_url( $page_email_string ); ?>" title="<?php echo esc_attr( $crocal_ext_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> eut-social-share-email"><i class="eut-text-<?php echo esc_attr( $icon_color ); ?> fas fa-envelope"></i></a></li>
					<?php } ?>
					<?php if ( !empty( $social_facebook ) ) { ?>
					<li><a href="<?php echo esc_url( $crocal_ext_permalink ); ?>" title="<?php echo esc_attr( $crocal_ext_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> eut-social-share-facebook"><i class="eut-text-<?php echo esc_attr( $icon_color ); ?> fab fa-facebook-f"></i></a></li>
					<?php } ?>
					<?php if ( !empty( $social_twitter ) ) { ?>
					<li><a href="<?php echo esc_url( $crocal_ext_permalink ); ?>" title="<?php echo esc_attr( $crocal_ext_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> eut-social-share-twitter"><i class="eut-text-<?php echo esc_attr( $icon_color ); ?> fab fa-twitter"></i></a></li>
					<?php } ?>
					<?php if ( !empty( $social_linkedin ) ) { ?>
					<li><a href="<?php echo esc_url( $crocal_ext_permalink ); ?>" title="<?php echo esc_attr( $crocal_ext_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> eut-social-share-linkedin"><i class="eut-text-<?php echo esc_attr( $icon_color ); ?> fab fa-linkedin-in"></i></a></li>
					<?php } ?>
					<?php if ( !empty( $social_reddit ) ) { ?>
					<li><a href="<?php echo esc_url( $crocal_ext_permalink ); ?>" title="<?php echo esc_attr( $crocal_ext_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> eut-social-share-reddit"><i class="eut-text-<?php echo esc_attr( $icon_color ); ?> fab fa-reddit"></i></a></li>
					<?php } ?>
					<?php if ( !empty( $social_pinterest  ) ) { ?>
					<li><a href="<?php echo esc_url( $crocal_ext_permalink ); ?>" title="<?php echo esc_attr( $crocal_ext_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> eut-social-share-pinterest" data-pin-img="<?php echo esc_url( $crocal_ext_image_url ); ?>" ><i class="eut-text-<?php echo esc_attr( $icon_color ); ?> fab fa-pinterest"></i></a></li>
					<?php } ?>
					<?php if ( !empty( $social_tumblr  ) ) { ?>
					<li><a href="<?php echo esc_url( $crocal_ext_permalink ); ?>" title="<?php echo esc_attr( $crocal_ext_title ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?> eut-social-share-tumblr"><i class="eut-text-<?php echo esc_attr( $icon_color ); ?> fab fa-tumblr"></i></a></li>
					<?php } ?>

					<?php if ( !empty( $likes ) && function_exists( 'crocal_eutf_likes' ) ) {
						global $post;
						$post_id = $post->ID;
					?>
					<li><a href="#" class="<?php echo esc_attr( $social_shape_class_string ); ?> eut-like-counter-link" data-post-id="<?php echo esc_attr( $post_id ); ?>"><i class="eut-text-<?php echo esc_attr( $icon_color ); ?> fa fa-heart"></i><span class="eut-like-counter"><?php echo crocal_eutf_likes( $post_id, 'number' ); ?></span></a></li>
					<?php } ?>

				</ul>
			</div>
		<?php

		return ob_get_clean();

	}
	add_shortcode( 'crocal_social', 'crocal_ext_vce_social_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_social_shortcode_params' ) ) {
	function crocal_ext_vce_social_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Social Share", "crocal-extension" ),
			"description" => esc_html__( "Place your preferred social", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-social",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "E-mail", "crocal-extension" ),
					"param_name" => "social_email",
					"description" => esc_html__( "Share with E-mail", "crocal-extension" ),
					"value" => array( esc_html__( "Show E-mail social share", "crocal-extension" ) => 'yes' ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Facebook", "crocal-extension" ),
					"param_name" => "social_facebook",
					"description" => esc_html__( "Share in Facebook", "crocal-extension" ),
					"value" => array( esc_html__( "Show Facebook social share", "crocal-extension" ) => 'yes' ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Twitter", "crocal-extension" ),
					"param_name" => "social_twitter",
					"description" => esc_html__( "Share in Twitter", "crocal-extension" ),
					"value" => array( esc_html__( "Show Twitter social share", "crocal-extension" ) => 'yes' ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Linkedin", "crocal-extension" ),
					"param_name" => "social_linkedin",
					"description" => esc_html__( "Share in Linkedin", "crocal-extension" ),
					"value" => array( esc_html__( "Show Linkedin social share", "crocal-extension" ) => 'yes' ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "reddit", "crocal-extension" ),
					"param_name" => "social_reddit",
					"description" => esc_html__( "Submit in reddit", "crocal-extension" ),
					"value" => array( esc_html__( "Show reddit social share", "crocal-extension" ) => 'yes' ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Pinterest", "crocal-extension" ),
					"param_name" => "social_pinterest",
					"description" => esc_html__( "Submit in Pinterest (Featured Image is used as image)", "crocal-extension" ),
					"value" => array( esc_html__( "Show Pinterest social share", "crocal-extension" ) => 'yes' ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Tumblr", "crocal-extension" ),
					"param_name" => "social_tumblr",
					"description" => esc_html__( "Submit in Tumblr", "crocal-extension" ),
					"value" => array( esc_html__( "Show Tumblr social share", "crocal-extension" ) => 'yes' ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "(Euthemians) Likes", "crocal-extension" ),
					"param_name" => "likes",
					"description" => esc_html__( "(Euthemians) Likes", "crocal-extension" ),
					"value" => array( esc_html__( "Show (Euthemians) Likes", "crocal-extension" ) => 'yes' ),
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
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_social', 'crocal_ext_vce_social_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_social_shortcode_params( 'crocal_social' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
