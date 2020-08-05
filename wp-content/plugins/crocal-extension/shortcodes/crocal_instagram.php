<?php
/**
 * Instagram Shortcode
 */

if( !function_exists( 'crocal_ext_vce_instagram_shortcode' ) ) {

	function crocal_ext_vce_instagram_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'access_token' => '',
					'user_id' => '',
					'username' => '',
					'limit' => '9',
					'image_size' => 'large',
					'columns_large_screen' => '3',
					'columns' => '3',
					'columns_tablet_landscape' => '2',
					'columns_tablet_portrait' => '2',
					'columns_mobile' => '1',
					'item_gutter' => 'yes',
					'gutter_size' => '40',
					'order_by' => 'none',
					'order' => 'ASC',
					'target' => '_blank',
					'cache' => 'yes',
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


		$instagram_classes = array( 'eut-element', 'eut-gallery' , 'eut-isotope', 'eut-instagram-feed', 'eut-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $instagram_classes, 'eut-animated-item' );
			array_push( $instagram_classes, $animation);
			array_push( $instagram_classes, 'eut-duration-' . $animation_duration );
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( 'yes' == $item_gutter ) {
			array_push( $instagram_classes, 'eut-with-gap' );
		}
		if ( !empty( $el_class ) ) {
			array_push( $instagram_classes, $el_class);
		}
		$instagram_class_string = implode( ' ', $instagram_classes );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );


		switch( $image_size ) {
			case 'medium':
				$image_width = "320";
				$image_height = "320";
				break;
			case 'large':
				$image_width = "640";
				$image_height = "640";
				break;
			case 'thumbnail':
			default:
				$image_width = "150";
				$image_height = "150";
				break;
		}

		$data_string = ' data-columns="' . esc_attr( $columns ) . '" data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '" data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '" data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '" data-columns-mobile="' . esc_attr( $columns_mobile ) . '" data-layout="fitRows"';
		if ( 'yes' == $item_gutter ) {
			$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
		}

		ob_start();

		if ( !empty( $username ) ) {
			$media_array = array();
			if( function_exists( 'crocal_ext_get_instagram_array' ) ) {
				$cache_val = 0;
				if( 'yes' == $cache ) {
					$cache_val = 1;
				}
				$media_array = crocal_ext_get_instagram_array( $username, $limit, $order_by, $order, $cache_val, $access_token, $user_id  );
			}
			$output = '';

			if ( is_wp_error( $media_array ) ) {

			   echo wp_kses_post( $media_array->get_error_message() );

			} else {

			?>
			<div class="<?php echo esc_attr( $instagram_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo $data_string; ?>>
				<div class="eut-isotope-container">
			<?php
				if ( !empty( $media_array ) ) {
					foreach ( $media_array as $item ) {
						$image_url = $item[ $image_size ]['url'];
						if ( !isset( $image_url ) ) {
							$image_url = $item[ 'thumbnail' ]['url'];
							$image_width  = $item[ 'thumbnail' ]['width'];
							$image_height  = $item[ 'thumbnail' ]['height'];
						} else {
							$image_width  = $item[ $image_size ]['width'];
							$image_height  = $item[ $image_size ]['height'];
						}
			?>
					<div class="eut-isotope-item eut-hover-item eut-hover-style-none">
						<div class="eut-isotope-item-inner <?php echo esc_attr( $animation ); ?>">
							<figure class="eut-image-hover eut-zoom-none">
								<a class="eut-item-url" href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target ); ?>"></a>
								<div class="eut-bg-wrapper-item">
									<div class="eut-bg-wrapper eut-small-square">
										<div class="eut-bg-image" style="background-image: url(<?php echo esc_url( $image_url ); ?>);"></div>
									</div>
									<img width="<?php echo esc_attr( $image_width ); ?>" height="<?php echo esc_attr( $image_height ); ?>" src="<?php echo esc_url( $image_url ); ?>"  alt="<?php echo esc_attr( $item['description'] ); ?>" title="<?php echo esc_attr( $item['description'] ); ?>"/>
								</div>
							</figure>
						</div>
					</div>
			<?php
					}
				}
			?>
				</div>
			</div>
			<?php
			}
		}

		return ob_get_clean();

	}
	add_shortcode( 'crocal_instagram', 'crocal_ext_vce_instagram_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_instagram_shortcode_params' ) ) {
	function crocal_ext_vce_instagram_shortcode_params( $tag ) {

		$access_token_url = "http://euthemians.com/instagram-feed/";

		return array(
			"name" => esc_html__( "Instagram Feed", "crocal-extension" ),
			"description" => esc_html__( "Display images from your instagram account", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-instagram",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Access Token", "crocal-extension" ),
					"param_name" => "access_token",
					"value" => "",
					"description" => esc_html__( "Enter your instagram Access Token.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "User ID", "crocal-extension" ),
					"param_name" => "user_id",
					"value" => "",
					"description" => esc_html__( "Enter your instagram User ID.", "crocal-extension" ). '<br><a href="' . esc_url( $access_token_url ) .'" target="_blank">' . esc_html__( 'Get Access Token and User ID', 'crocal-extension' ) . '</a>',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Username", "crocal-extension" ),
					"param_name" => "username",
					"value" => "",
					"description" => esc_html__( "Enter your instagram username.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Size", "crocal-extension" ),
					"param_name" => "image_size",
					"value" => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( "Thumbnail ( 150x150 )", "crocal-extension" ) => 'thumbnail',
						esc_html__( "Medium ( 320x320 )", "crocal-extension" ) => 'medium',
						esc_html__( "Large ( 640x640 )", "crocal-extension" ) => 'large',
					) ),
					"std" => 'large',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Large Screen Columns", "crocal-extension" ),
					"param_name" => "columns_large_screen",
					"value" => array( '2', '3', '4', '5', '6', '7', '8', '9', '10' ),
					"std" => '3',
					"description" => esc_html__( "Select number of columns for large screens.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Columns", "crocal-extension" ),
					"param_name" => "columns",
					"value" => array( '2', '3', '4', '5', '6', '7', '8', '9', '10' ),
					"std" => '3',
					"description" => esc_html__( "Select number of columns.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Landscape Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_landscape",
					"value" => array( '2', '3', '4', '5', '6', '7', '8', '9', '10' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, landscape orientation.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Portrait Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_portrait",
					"value" => array( '2', '3', '4', '5', '6', '7', '8', '9', '10' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, portrait orientation.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Mobile Columns", "crocal-extension" ),
					"param_name" => "columns_mobile",
					"value" => array( '1', '2' ),
					"std" => '1',
					"description" => esc_html__( "Select responsive column on mobile devices.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Gutter between images", "crocal-extension" ),
					"param_name" => "item_gutter",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"description" => esc_html__( "Add gutter among images.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Gutter Size", "crocal-extension" ),
					"param_name" => "gutter_size",
					"value" => '40',
					"dependency" => array( 'element' => "item_gutter", 'value' => array( 'yes' ) ),
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__( "Number of Images", "crocal-extension" ),
					"param_name" => "limit",
					"value" => "9",
					"description" => esc_html__( "Enter number of images to show.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Order By", "crocal-extension" ),
					"param_name" => "order_by",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => 'none',
						esc_html__( "Recent", "crocal-extension" ) => 'datetime',
						esc_html__( "Likes", "crocal-extension" ) => 'likes',
						esc_html__( "Comments", "crocal-extension" ) => 'comments',
					),
					"std" => 'none',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Order", "crocal-extension" ),
					"param_name" => "order",
					"value" => array(
						esc_html__( "Ascending", "crocal-extension" ) => 'ASC',
						esc_html__( "Descending", "crocal-extension" ) => 'DESC',
					),
					"std" => 'ASC',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Link Target", "crocal-extension" ),
					"param_name" => "target",
					"value" => array(
						esc_html__( "New Page", "crocal-extension" ) => '_blank',
						esc_html__( "Same Page", "crocal-extension" ) => '_self',
					),
					"std" => '_blank',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Caching", "crocal-extension" ),
					"param_name" => "cache",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"description" => esc_html__( "Note: Select caching if you want to test your configuration. It is recommended to leave caching enabled to increase performance. Caching timeout is 60 minutes.", "crocal-extension" ),
					"std" => 'yes',
				),
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
	vc_lean_map( 'crocal_instagram', 'crocal_ext_vce_instagram_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_instagram_shortcode_params( 'crocal_instagram' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
