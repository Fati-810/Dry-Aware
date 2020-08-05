<?php
/**
 * Team Shortcode
 */

if( !function_exists( 'crocal_ext_vce_team_shortcode' ) ) {

	function crocal_ext_vce_team_shortcode( $attr, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'image' => '',
					'retina_image' => '',
					'image_size' => '',
					'team_layout' => 'layout-1',
					'zoom_effect' => 'none',
					'overlay_color' => 'light',
					'overlay_opacity' => '90',
					'name' => '',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'identity' => '',
					'shadow' => '',
					'radius' => '',
					'content_bg' => 'white',
					'social_facebook' => '',
					'social_twitter' => '',
					'social_linkedin' => '',
					'social_xing' => '',
					'social_instagram' => '',
					'social_youtube' => '',
					'social_vimeo' => '',
					'email' => '',
					'align' => 'left',
					'link' => '',
					'link_class' => '',
					'animation' => '',
					'animation_delay' => '200',
					'animation_duration' => 'normal',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$attr
			)
		);

		$heading_class = 'eut-' . $heading;
		if ( !empty( $custom_font_family ) ) {
			$heading_class .= ' eut-' . $custom_font_family;
		}

		$image_mode_size = crocal_ext_vce_get_image_size( $image_size );

		//Team Title & Caption Color
		$text_color = 'light';
		if( 'light' == $overlay_color ) {
			$text_color = 'dark';
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		if ( !empty( $image ) ) {
			$id = preg_replace('/[^\d]/', '', $image);
			$thumb_src = wp_get_attachment_image_src( $id, $image_mode_size );
			$thumb_url = $thumb_src[0];
			$image_srcset = '';

			if ( !empty( $retina_image ) && empty( $image_size ) ) {
				$img_retina_id = preg_replace('/[^\d]/', '', $retina_image);
				$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
				$retina_url = $img_retina_src[0];
				$image_srcset = $thumb_url . ' 1x,' . $retina_url . ' 2x';
				$image_html = crocal_ext_vce_get_attachment_image( $id, $image_mode_size , "", array( 'srcset'=> $image_srcset ) );
			} else {
				$image_html = crocal_ext_vce_get_attachment_image( $id, $image_mode_size );
			}

		} else {
			$image_html = crocal_ext_vce_get_fallback_image( $image_mode_size );
		}

		$email_string =  apply_filters( 'crocal_eutf_vce_string_email', esc_html__( 'E-mail', 'crocal-extension' ) );

		// Link Classes
		$link_classes = array( 'eut-text-hover-primary-1' );

		if ( 'layout-1' == $team_layout ){
			array_push( $link_classes, 'eut-bg-white' );
		}

		$link_class_string = implode( ' ', $link_classes );


		$links = '';
		if ( !empty( $social_facebook ) ) {
			$links .= '<li><a href="' . esc_url( $social_facebook ) . '" target="_blank" class="' . esc_attr( $link_class_string ) . '"><i class="fab fa-facebook-f"></i></a></li>';
		}
		if ( !empty( $social_twitter ) ) {
			$links .= '<li><a href="' . esc_url( $social_twitter ) . '" target="_blank" class="' . esc_attr( $link_class_string ) . '"><i class="fab fa-twitter"></i></a></li>';
		}
		if ( !empty( $social_linkedin ) ) {
			$links .= '<li><a href="' . esc_url( $social_linkedin ) . '" target="_blank" class="' . esc_attr( $link_class_string ) . '"><i class="fab fa-linkedin-in"></i></a></li>';
		}
		if ( !empty( $social_xing ) ) {
			$links .= '<li><a href="' . esc_url( $social_xing ) . '" target="_blank" class="' . esc_attr( $link_class_string ) . '"><i class="fab fa-xing"></i></a></li>';
		}	
		if ( !empty( $social_instagram ) ) {
			$links .= '<li><a href="' . esc_url( $social_instagram ) . '" target="_blank" class="' . esc_attr( $link_class_string ) . '"><i class="fab fa-instagram"></i></a></li>';
		}
		if ( !empty( $social_youtube ) ) {
			$links .= '<li><a href="' . esc_url( $social_youtube ) . '" target="_blank" class="' . esc_attr( $link_class_string ) . '"><i class="fab fa-youtube"></i></a></li>';
		}
		if ( !empty( $social_vimeo ) ) {
			$links .= '<li><a href="' . esc_url( $social_vimeo ) . '" target="_blank" class="' . esc_attr( $link_class_string ) . '"><i class="fab fa-vimeo"></i></a></li>';
		}
		if ( !empty( $email ) ) {
			$links .= '<li><a href="mailto:' . antispambot( $email ) . '" class="' . esc_attr( $link_class_string ) . '"><i class="fas fa-envelope"></i></a></li>';
		}

		$team_classes = array( 'eut-element' );

		array_push( $team_classes, 'eut-' . $team_layout);

		if ( !empty( $animation ) ) {
			array_push( $team_classes, 'eut-animated-item' );
			array_push( $team_classes, $animation);
			array_push( $team_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $team_classes, $el_class);
		}

		if ( 'layout-2' == $team_layout ){
			array_push( $team_classes, 'eut-with-parallax-effect');
			array_push( $team_classes, 'eut-paraller-wrapper');
			array_push( $team_classes, 'eut-align-' . $align );
		}

		$team_class_string = implode( ' ', $team_classes );


		// Image Classes
		$image_classes = array( 'eut-image-hover' );

		if ( 'none' != $zoom_effect ){
			array_push( $image_classes, 'eut-zoom-' . $zoom_effect );
		}
		if ( !empty( $shadow ) ) {
			array_push( $image_classes, 'eut-' . $shadow);
		}
		if ( !empty( $radius ) ) {
			array_push( $image_classes, 'eut-' . $radius);
		}

		$image_class_string = implode( ' ', $image_classes );



		$has_link = crocal_ext_vce_has_link( $link );

		$link_team_class = 'eut-team-url';
		if( !empty( $link_class ) )  {
			$link_team_class .= ' ' . $link_class;
		}
		$link_attributes = crocal_ext_vce_get_link_attributes( $link, $link_class );
		$link_team_attributes = crocal_ext_vce_get_link_attributes( $link, $link_team_class );

		ob_start();

		?>

		<?php
		if ( 'layout-1' == $team_layout ) {
		?>
		<div class="eut-team <?php echo esc_attr( $team_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo $data; ?>>
			<figure class="<?php echo esc_attr( $image_class_string ); ?>">
				<?php
					if ( $has_link ) {
						echo '<a ' . implode( ' ', $link_team_attributes ) . '></a>';
					}
				?>
				<div class="eut-team-person">
					<div class="eut-bg-<?php echo esc_attr( $overlay_color ); ?> eut-hover-overlay eut-opacity-<?php echo esc_attr( $overlay_opacity ); ?>"></div>
					<?php echo $image_html; ?>
				</div>
				<figcaption>
					<ul class="eut-team-social eut-align-center">
						<?php echo $links; ?>
					</ul>
				</figcaption>
			</figure>
			<div class="eut-team-description eut-align-center">
				<?php if ( !empty( $identity ) ) { ?>
				<div class="eut-team-identity eut-small-text"><?php echo wp_kses_post( $identity ); ?></div>
				<?php } ?>
				<?php if ( $has_link ) { ?>
				<a <?php echo implode( ' ', $link_attributes ); ?>>
				<<?php echo tag_escape( $heading_tag ); ?> class="eut-team-name eut-text-hover-primary-1 <?php echo esc_attr( $heading_class ); ?>"><?php echo $name; ?></<?php echo tag_escape( $heading_tag ); ?>>
				</a>
				<?php } else { ?>
				<<?php echo tag_escape( $heading_tag ); ?> class="eut-team-name <?php echo esc_attr( $heading_class ); ?>"><?php echo $name; ?></<?php echo tag_escape( $heading_tag ); ?>>
				<?php } ?>
			</div>
		</div>
		<?php
			} else {
		?>
		<div class="eut-team <?php echo esc_attr( $team_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo $data; ?>>

			<figure class="<?php echo esc_attr( $image_class_string ); ?>">
				<?php
					if ( $has_link ) {
						echo '<a ' . implode( ' ', $link_team_attributes ) . '></a>';
					}
				?>
				<div class="eut-team-person">
					<div class="eut-bg-<?php echo esc_attr( $overlay_color ); ?> eut-hover-overlay eut-opacity-<?php echo esc_attr( $overlay_opacity ); ?>"></div>
					<?php echo $image_html; ?>
				</div>
			</figure>
			<div class="eut-team-description eut-align-left eut-box-item eut-bg-<?php echo esc_attr( $content_bg ); ?> eut-paraller" data-limit="1x">
				<?php if ( !empty( $identity ) ) { ?>
				<div class="eut-team-identity eut-link-text"><?php echo $identity; ?></div>
				<?php } ?>
				<?php if ( $has_link ) { ?>
				<a <?php echo implode( ' ', $link_attributes ); ?>>
				<<?php echo tag_escape( $heading_tag ); ?> class="eut-team-name eut-heading-color eut-text-hover-primary-1 <?php echo esc_attr( $heading_class ); ?>"><?php echo $name; ?></<?php echo tag_escape( $heading_tag ); ?>>
				</a>
				<?php } else { ?>
				<<?php echo tag_escape( $heading_tag ); ?> class="eut-team-name eut-heading-color <?php echo esc_attr( $heading_class ); ?>"><?php echo $name; ?></<?php echo tag_escape( $heading_tag ); ?>>
				<?php } ?>
				<?php if ( !empty( $content ) ) { ?>
				<p><?php echo crocal_ext_vce_unautop( $content ); ?></p>
				<?php } ?>
				<ul class="eut-team-social eut-responsive-team-socials">
					<?php echo $links; ?>
				</ul>
			</div>
			<ul class="eut-team-social eut-align-center">
				<?php echo $links; ?>
			</ul>
		</div>
		<?php
			}
		?>

		<?php

		return ob_get_clean();

	}
	add_shortcode( 'crocal_team', 'crocal_ext_vce_team_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_team_shortcode_params' ) ) {
	function crocal_ext_vce_team_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Team", "crocal-extension" ),
			"description" => esc_html__( "Show your team members", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-team",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Size", "crocal-extension" ),
					"param_name" => "image_size",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Full ( Custom )', 'crocal-extension' ) => '',
						esc_html__( 'Square Small Crop', 'crocal-extension' ) => 'square',
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
					) ),
					"description" => esc_html__( "Select your Image Size.", "crocal-extension" ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Image", "crocal-extension" ),
					"param_name" => "image",
					"value" => '',
					"description" => esc_html__( "Select an image.", "crocal-extension" ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Retina Image", "crocal-extension" ),
					"param_name" => "retina_image",
					"value" => '',
					"description" => esc_html__( "Select a 2x image.", "crocal-extension" ),
					"dependency" => array( 'element' => "image_size", 'value' => array( '' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Name", "crocal-extension" ),
					"param_name" => "name",
					"value" => "John Smith",
					"description" => esc_html__( "Enter your team name.", "crocal-extension" ),
					"save_always" => true,
					"admin_label" => true,
				),
				crocal_ext_vce_get_heading_tag( "h3" ),
				crocal_ext_vce_get_heading( "h3" ),
				crocal_ext_vce_get_custom_font_family(),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Identity", "crocal-extension" ),
					"param_name" => "identity",
					"value" => "",
					"description" => esc_html__( "Enter your team identity/profession e.g: Designer", "crocal-extension" ),
				),
				crocal_ext_vce_add_shadow(),
				crocal_ext_vce_add_radius(),
/* 				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Team Style", "crocal-extension" ),
					"param_name" => "team_layout",
					"value" => array(
						esc_html__( "Classic Style", "crocal-extension" ) => 'layout-1',
						esc_html__( "Crocal Style", "crocal-extension" ) => 'layout-2',
					),
					"description" => esc_html__( "Style of the team.", "crocal-extension" ),
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__( "Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "Sample Text",
					"description" => esc_html__( "Enter your text.", "crocal-extension" ),
					"dependency" => array( 'element' => "team_layout", 'value' => array( 'layout-2' ) ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Content Background", "crocal-extension" ),
					"param_name" => "content_bg",
					"description" => esc_html__( "Selected background color for your image text content.", "crocal-extension" ),
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => 'none',
						esc_html__( "White", "crocal-extension" ) => 'white',
						esc_html__( "Black", "crocal-extension" ) => 'black',
					),
					'std' => 'white',
					"dependency" => array( 'element' => "team_layout", 'value' => array( 'layout-2' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Align", "crocal-extension" ),
					"param_name" => "align",
					"value" => array(
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
					),
					"description" => '',
					"dependency" => array( 'element' => "team_layout", 'value' => array( 'layout-2' ) ),
				), */
				crocal_ext_vce_add_animation(),
				crocal_ext_vce_add_animation_delay(),
				crocal_ext_vce_add_animation_duration(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Zoom Effect", "crocal-extension" ),
					"param_name" => "zoom_effect",
					"value" => array(
						esc_html__( "Zoom In", "crocal-extension" ) => 'in',
						esc_html__( "Zoom Out", "crocal-extension" ) => 'out',
						esc_html__( "None", "crocal-extension" ) => 'none',
					),
					"description" => esc_html__( "Choose the image zoom effect.", "crocal-extension" ),
					"group" => esc_html__( "Image Hovers", "crocal-extension" ),
					'std' => 'none',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Overlay Color", "crocal-extension" ),
					"param_name" => "overlay_color",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Light", "crocal-extension" ) => 'light',
						esc_html__( "Dark", "crocal-extension" ) => 'dark',
						esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
						esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
						esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
						esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
						esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
						esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
					),
					"description" => esc_html__( "Choose the image color overlay.", "crocal-extension" ),
					"group" => esc_html__( "Image Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Overlay Opacity", "crocal-extension" ),
					"param_name" => "overlay_opacity",
					"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
					"std" => '90',
					"description" => esc_html__( "Choose the opacity for the overlay.", "crocal-extension" ),
					"group" => esc_html__( "Image Hovers", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Facebook", "crocal-extension" ),
					"param_name" => "social_facebook",
					"value" => "",
					"description" => esc_html__( "Enter facebook URL. Clear input if you don't want to display.", "crocal-extension" ),
					"group" => esc_html__( "Socials & Link", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Twitter", "crocal-extension" ),
					"param_name" => "social_twitter",
					"value" => "",
					"description" => esc_html__( "Enter twitter URL. Clear input if you don't want to display.", "crocal-extension" ),
					"group" => esc_html__( "Socials & Link", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Linkedin", "crocal-extension" ),
					"param_name" => "social_linkedin",
					"value" => "",
					"description" => esc_html__( "Enter linkedin URL. Clear input if you don't want to display.", "crocal-extension" ),
					"group" => esc_html__( "Socials & Link", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Xing", "crocal-extension" ),
					"param_name" => "social_xing",
					"value" => "",
					"description" => esc_html__( "Enter Xing URL. Clear input if you don't want to display.", "crocal-extension" ),
					"group" => esc_html__( "Socials & Link", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Instagram", "crocal-extension" ),
					"param_name" => "social_instagram",
					"value" => "",
					"description" => esc_html__( "Enter instagram URL. Clear input if you don't want to display.", "crocal-extension" ),
					"group" => esc_html__( "Socials & Link", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "YouTube", "crocal-extension" ),
					"param_name" => "social_youtube",
					"value" => "",
					"description" => esc_html__( "Enter YouTube URL. Clear input if you don't want to display.", "crocal-extension" ),
					"group" => esc_html__( "Socials & Link", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Vimeo", "crocal-extension" ),
					"param_name" => "social_vimeo",
					"value" => "",
					"description" => esc_html__( "Enter Vimeo URL. Clear input if you don't want to display.", "crocal-extension" ),
					"group" => esc_html__( "Socials & Link", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Email", "crocal-extension" ),
					"param_name" => "email",
					"value" => "",
					"description" => esc_html__( "Enter your email. Clear input if you don't want to display.", "crocal-extension" ),
					"group" => esc_html__( "Socials & Link", "crocal-extension" ),
				),
				array(
					"type" => "vc_link",
					"heading" => esc_html__( "Link", "crocal-extension" ),
					"param_name" => "link",
					"value" => "",
					"description" => esc_html__( "Enter link.", "crocal-extension" ),
					"group" => esc_html__( "Socials & Link", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Link Class", "crocal-extension" ),
					"param_name" => "link_class",
					"value" => "",
					"description" => esc_html__( "Enter extra class name for your link.", "crocal-extension" ),
					"group" => esc_html__( "Socials & Link", "crocal-extension" ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_team', 'crocal_ext_vce_team_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_team_shortcode_params( 'crocal_team' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
