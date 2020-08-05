<?php
/**
 * Product Carousel Shortcode
 */

if( !function_exists( 'crocal_ext_vce_products_carousel_shortcode' ) ) {

	function crocal_ext_vce_products_carousel_shortcode( $attr, $content ) {

		$el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'text_style' => 'none',
					'align' => 'left',
					'categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'carousel_layout' => 'layout-1',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'carousel_image_mode' => 'landscape',
					'item_gutter' => 'yes',
					'gutter_size' => '30',
					'items_per_page' => '4',
					'items_tablet_landscape' => '3',
					'items_tablet_portrait' => '3',
					'items_mobile' => '1',
					'items_to_show' => '12',
					'product_title_heading_tag' => 'h3',
					'product_title_heading' => 'h3',
					'product_style' => 'hover-style-1',
					'second_image_effect' => 'yes',
					'zoom_effect' => 'none',
					'grayscale_effect' => 'none',
					'overlay_color' => 'light',
					'overlay_opacity' => '90',
					'order_by' => 'date',
					'order' => 'DESC',
					'slideshow_speed' => '3000',
					'auto_play' => 'yes',
					'navigation_type' => '1',
					'navigation_color' => 'dark',
					'pause_hover' => 'no',
					'radius' => '',
					'carousel_pagination' => 'no',
					'carousel_pagination_speed' => '400',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$attr
			)
		);

		$data_string = '';
		$data_string .= ' data-items="' . esc_attr( $items_per_page ) . '"';
		$data_string .= ' data-items-tablet-landscape="' . esc_attr( $items_tablet_landscape ) . '"';
		$data_string .= ' data-items-tablet-portrait="' . esc_attr( $items_tablet_portrait ) . '"';
		$data_string .= ' data-items-mobile="' . esc_attr( $items_mobile ) . '"';

		$data_string .= ' data-slider-autoplay="' . esc_attr( $auto_play ) . '"';
		$data_string .= ' data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
		$data_string .= ' data-slider-pause="' . esc_attr( $pause_hover ) . '"';
		$data_string .= ' data-pagination-speed="' . esc_attr( $carousel_pagination_speed ) . '"';
		$data_string .= ' data-pagination="' . esc_attr( $carousel_pagination ) . '"';
		if ( 'yes' == $item_gutter ) {
			$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
		}

		//Product Classes
		$product_classes = array( 'eut-element' );
		array_push( $product_classes, 'eut-carousel' );
		array_push( $product_classes, 'eut-' . $carousel_layout );

		if ( 'yes' == $item_gutter ) {
			array_push( $product_classes, 'eut-with-gap' );
		}
		if ( !empty ( $el_class ) ) {
			array_push( $product_classes, $el_class);
		}
		$product_class_string = implode( ' ', $product_classes );

		// Image Effect
		$image_effect_classes = array( 'eut-image-hover' );
		if ( 'none' != $zoom_effect ) {
			array_push( $image_effect_classes, 'eut-zoom-' . $zoom_effect );
		}
		if ( 'none' != $grayscale_effect ) {
			array_push( $image_effect_classes, 'eut-' . $grayscale_effect );
		}

		if( 'hover-style-2' == $product_style ){
			if( 'light' == $overlay_color ){
				array_push( $image_effect_classes, 'eut-text-black' );
			} else {
				array_push( $image_effect_classes, 'eut-text-white' );
			}
			if ( !empty( $radius ) ) {
				array_push( $image_effect_classes, 'eut-' . $radius);
			}
		}

		$image_effect_class_string = implode( ' ', $image_effect_classes );


		// Media Classes
		$media_classes = array( 'eut-media' );
		if ( !empty( $radius && 'hover-style-1' == $product_style ) ) {
			array_push( $media_classes, 'eut-' . $radius);
		}
		$media_class_string = implode( ' ', $media_classes );


		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$product_cat = "";
		$product_category_ids = array();

		if( ! empty( $categories ) ) {
			$product_category_ids = explode( ",", $categories );
			foreach ( $product_category_ids as $category_id ) {
				$category_term = get_term( $category_id, 'product_cat' );
				if ( isset( $category_term) ) {
					$product_cat = $product_cat.$category_term->slug . ', ';
				}
			}
		}

		$paged = 1;

		$exclude_ids = array();
		if( !empty( $exclude_posts ) ){
			$exclude_ids = explode( ',', $exclude_posts );
		}

		$include_ids = array();
		if( !empty( $include_posts ) ){
			$include_ids = explode( ',', $include_posts );
			$args = array(
				'post_type' => 'product',
				'post_status'=>'publish',
				'paged' => $paged,
				'post__in' => $include_ids,
				'posts_per_page' => $items_to_show,
				'orderby' => $order_by,
				'order' => $order,
			);
			$product_filter = 'no';
		} else {
			$args = array(
				'post_type' => 'product',
				'post_status'=>'publish',
				'paged' => $paged,
				'product_cat' => $product_cat,
				'post__not_in' => $exclude_ids,
				'posts_per_page' => $items_to_show,
				'orderby' => $order_by,
				'order' => $order,
			);
		}

		$query = new WP_Query( $args );
		ob_start();
		if ( $query->have_posts() ) :
		?>
			<div class="<?php echo esc_attr( $product_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>">
		<?php
			//Carousel Navigation
			if( 'layout-2' == $carousel_layout ){
				echo '<div class="eut-carousel-info-wrapper eut-align-' . esc_attr( $align ) . '">';
				echo '  <div class="eut-carousel-info">';
				if( !empty( $title ) ){
					$title_classes = array( 'eut-title' );
					$title_classes[]  = 'eut-' . $heading;
					if ( !empty( $custom_font_family ) ) {
						$title_classes[]  = 'eut-' . $custom_font_family;
					}
					$title_class_string = implode( ' ', $title_classes );
					echo'    <' . tag_escape( $heading_tag ) .' class="' . esc_attr( $title_class_string ) . '">' . $title . '</' . tag_escape( $heading_tag ) .'>';
				}
				if ( !empty( $content ) ) {
					echo '    <p class="eut-description eut-' . esc_attr( $text_style ) . '">' . crocal_ext_vce_unautop( $content ) . '</p>';
				}
				echo '  </div>';
				echo crocal_ext_vce_element_navigation( $navigation_type, $navigation_color, 'carousel' );
				echo '</div>';
			}
			echo '  <div class="eut-carousel-wrapper">';
			if( 'layout-1' == $carousel_layout ){
				echo crocal_ext_vce_element_navigation( $navigation_type, $navigation_color, 'carousel' );
			}
?>
			<div class="eut-carousel-element eut-product owl-carousel"<?php echo $data_string; ?>>
<?php

		$product_index = 0;

		while ( $query->have_posts() ) : $query->the_post();
			$image_size = 'crocal-eutf-small-rect-horizontal';
			$product_index++;
			$product_extra_class = '';

			$image_size = crocal_ext_vce_get_image_size( $carousel_image_mode );
			$product_extra_class = 'eut-product-item';

			//Second Image Classes
			$image_classes = array();
			$image_classes[] = 'attachment-' . $image_size;
			$image_classes[] = 'size-' . $image_size;
			$image_classes[] = 'eut-product-thumbnail-second';
			$image_class_string = implode( ' ', $image_classes );

			//Second Product Image
			global $product;
			if ( method_exists( $product, 'get_gallery_image_ids' ) ) {
				$attachment_ids = $product->get_gallery_image_ids();
			} else {
				$attachment_ids = $product->get_gallery_attachment_ids();
			}
			$product_thumb_second_id = '';

			if ( $attachment_ids ) {
				$loop = 0;
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					if (!$image_link) {
						continue;
					}
					$loop++;
					$product_thumb_second_id = $attachment_id;
					if ($loop == 1) {
						break;
					}
				}
			}

?>
				<div class="eut-carousel-item">
					<article id="product-<?php the_ID(); ?><?php echo uniqid('-'); ?>" <?php post_class( $product_extra_class ); ?>>
						<div class="eut-carousel-item eut-hover-item eut-product-<?php echo esc_attr( $product_style ); ?>">
							<?php woocommerce_show_product_loop_sale_flash(); ?>
						<?php
							if ( 'hover-style-1' == $product_style ) {
						?>
							<div class="eut-product-added-icon eut-icon-shop eut-bg-primary-1"></div>
							<figure class="<?php echo esc_attr( $image_effect_class_string ); ?>">
								<div class="<?php echo esc_attr( $media_class_string ); ?>">
									<div class="eut-add-cart-wrapper">
										<div class="eut-add-cart-button">
											<?php woocommerce_template_loop_add_to_cart(); ?>
										</div>
									</div>
									<a class="eut-item-url" href="<?php echo esc_url( get_permalink() ); ?>"></a>
									<div class="eut-bg-<?php echo esc_attr( $overlay_color ); ?> eut-hover-overlay eut-opacity-<?php echo esc_attr( $overlay_opacity ); ?>"></div>
									<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( $image_size );
										} elseif ( wc_placeholder_img_src() ) {
											echo wc_placeholder_img( $image_size );
										}
										if ( 'yes' == $second_image_effect && !empty( $product_thumb_second_id ) ) {
											echo wp_get_attachment_image( $product_thumb_second_id, $image_size , "", array( 'class' => $image_class_string ) );
										}
									?>
								</div>
								<figcaption class="eut-content eut-align-center">
									<a href="<?php echo esc_url( get_permalink() ); ?>">
										<<?php echo tag_escape( $product_title_heading_tag ); ?> class="eut-title eut-<?php echo esc_attr( $product_title_heading ); ?>"><?php the_title(); ?></<?php echo tag_escape( $product_title_heading_tag ); ?>>
									</a>
									<?php woocommerce_template_loop_price(); ?>
								</figcaption>
							</figure>
						<?php
							} else {
						?>
							<figure class="<?php echo esc_attr( $image_effect_class_string ); ?>">
								<div class="<?php echo esc_attr( $media_class_string ); ?>">
									<div class="eut-add-cart-wrapper">
										<div class="eut-add-cart-button">
											<?php woocommerce_template_loop_add_to_cart(); ?>
										</div>
									</div>
									<a class="eut-item-url" href="<?php echo esc_url( get_permalink() ); ?>"></a>
									<div class="eut-bg-<?php echo esc_attr( $overlay_color ); ?> eut-hover-overlay eut-opacity-<?php echo esc_attr( $overlay_opacity ); ?>"></div>
									<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( $image_size );
										} elseif ( wc_placeholder_img_src() ) {
											echo wc_placeholder_img( $image_size );
										}
										if ( 'yes' == $second_image_effect && !empty( $product_thumb_second_id ) ) {
											echo wp_get_attachment_image( $product_thumb_second_id, $image_size , "", array( 'class' => $image_class_string ) );
										}
									?>
								</div>
								<figcaption class="eut-content">
									<<?php echo tag_escape( $product_title_heading_tag ); ?> class="eut-title eut-<?php echo esc_attr( $product_title_heading ); ?>"><?php the_title(); ?></<?php echo tag_escape( $product_title_heading_tag ); ?>>
									<?php woocommerce_template_loop_price(); ?>
								</figcaption>
							</figure>

						<?php
							}
						?>

						</div>

					</article>
				</div>
<?php
		endwhile;
?>
			</div>
		</div>
	</div>

		<?php

		else :
		endif;
		wp_reset_postdata();

		return ob_get_clean();

	}
	add_shortcode( 'crocal_products_carousel', 'crocal_ext_vce_products_carousel_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_products_carousel_shortcode_params' ) ) {
	function crocal_ext_vce_products_carousel_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Products Carousel", "crocal-extension" ),
			"description" => esc_html__( "Display product carousel element", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-product",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Image Size", "crocal-extension" ),
					"param_name" => "carousel_image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Square Small Crop', 'crocal-extension' ) => 'square',
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
					) ),
					'std' => 'landscape',
					"description" => esc_html__( "Select your Carousel Image Size.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items per page", "crocal-extension" ),
					"param_name" => "items_per_page",
					"value" => array( '2', '3', '4', '5' ),
					"description" => esc_html__( "Number of items per page", "crocal-extension" ),
					"std" => '4',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items Tablet Landscape", "crocal-extension" ),
					"param_name" => "items_tablet_landscape",
					"value" => array( '2', '3', '4' ),
					"std" => '3',
					"description" => esc_html__( "Select number of items on tablet devices, landscape orientation.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items Tablet Portrait", "crocal-extension" ),
					"param_name" => "items_tablet_portrait",
					"value" => array( '2', '3', '4'  ),
					"std" => '3',
					"description" => esc_html__( "Select number of items on tablet devices, portrait orientation.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items Mobile", "crocal-extension" ),
					"param_name" => "items_mobile",
					"value" => array( '1', '2' ),
					"std" => '1',
					"description" => esc_html__( "Select number of items on mobile devices.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Gutter between items", "crocal-extension" ),
					"param_name" => "item_gutter",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"description" => esc_html__( "Add gutter among items.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Gutter Size", "crocal-extension" ),
					"param_name" => "gutter_size",
					"value" => '30',
					"dependency" => array( 'element' => "item_gutter", 'value' => array( 'yes' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Items to show", "crocal-extension" ),
					"param_name" => "items_to_show",
					"value" => '12',
					"description" => esc_html__( "Maximum product Items to Show", "crocal-extension" ),
				),
				crocal_ext_vce_add_radius(),
				crocal_ext_vce_add_order_by(),
				crocal_ext_vce_add_order(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				//Navigation
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Layout", "crocal-extension" ),
					"param_name" => "carousel_layout",
					"value" => array(
						esc_html__( "Classic", "crocal-extension" ) => 'layout-1',
						esc_html__( "With title and description", "crocal-extension" ) => 'layout-2',
					),
					"description" => 'Select your layout for Carousel Element',
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'carousel' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", "crocal-extension" ),
					"param_name" => "title",
					"value" => "Sample Title",
					"description" => esc_html__( "Enter your title here.", "crocal-extension" ),
					"save_always" => true,
					"dependency" => array( 'element' => "carousel_layout", 'value' => array( 'layout-2' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
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
					"std" => 'h3',
					"dependency" => array( 'element' => "carousel_layout", 'value' => array( 'layout-2' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
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
					"std" => 'h3',
					"dependency" => array( 'element' => "carousel_layout", 'value' => array( 'layout-2' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Title Custom Font Family", "crocal-extension" ),
					"param_name" => "custom_font_family",
					"value" => array(
						esc_html__( "Same as Typography", "crocal-extension" ) => '',
						esc_html__( "Custom Font Family 1", "crocal-extension" ) => 'custom-font-1',
						esc_html__( "Custom Font Family 2", "crocal-extension" ) => 'custom-font-2',
						esc_html__( "Custom Font Family 3", "crocal-extension" ) => 'custom-font-3',
						esc_html__( "Custom Font Family 4", "crocal-extension" ) => 'custom-font-4',

					),
					"description" => esc_html__( "Select a different font family, defined in Theme Options - Typography Options - Extras - Custom Font Family", "crocal-extension" ),
					"std" => '',
					"dependency" => array( 'element' => "carousel_layout", 'value' => array( 'layout-2' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__( "Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "",
					"description" => esc_html__( "Type your text.", "crocal-extension" ),
					"dependency" => array( 'element' => "carousel_layout", 'value' => array( 'layout-2' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Text Style", "crocal-extension" ),
					"param_name" => "text_style",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => '',
						esc_html__( "Leader", "crocal-extension" ) => 'leader-text',
						esc_html__( "Subtitle", "crocal-extension" ) => 'subtitle',
					),
					"description" => 'Select your text style',
					"dependency" => array( 'element' => "carousel_layout", 'value' => array( 'layout-2' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Alignment", "crocal-extension" ),
					"param_name" => "align",
					"value" => array(
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
						esc_html__( "Center", "crocal-extension" ) => 'center',
					),
					"description" => '',
					"dependency" => array( 'element' => "carousel_layout", 'value' => array( 'layout-2' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Autoplay", "crocal-extension" ),
					"param_name" => "auto_play",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'carousel' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Slideshow Speed", "crocal-extension" ),
					"param_name" => "slideshow_speed",
					"value" => '3000',
					"description" => esc_html__( "Slideshow Speed in ms.", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'carousel' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Pause on Hover", "crocal-extension" ),
					"param_name" => "pause_hover",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"std" => "no",
					"description" => esc_html__( "If selected, carousel will be paused on hover", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'carousel' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Navigation Type", "crocal-extension" ),
					"param_name" => "navigation_type",
					'value' => array(
						esc_html__( 'Style 1' , 'crocal-extension' ) => '1',
						esc_html__( 'No Navigation' , 'crocal-extension' ) => '0',
					),
					"description" => esc_html__( "Select your Navigation type.", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'carousel' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Navigation Color", "crocal-extension" ),
					"param_name" => "navigation_color",
					'value' => array(
						esc_html__( 'Dark' , 'crocal-extension' ) => 'dark',
						esc_html__( 'Light' , 'crocal-extension' ) => 'light',
					),
					"description" => esc_html__( "Select the background Navigation color.", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'carousel' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Pagination", "crocal-extension" ),
					"param_name" => "carousel_pagination",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => 'no',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"std" => "no",
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'carousel' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Carousel Pagination Speed", "crocal-extension" ),
					"param_name" => "carousel_pagination_speed",
					"value" => '400',
					"description" => esc_html__( "Pagination Speed in ms.", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'carousel' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				//Titles & Hovers
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Product Title Tag", "crocal-extension" ),
					"param_name" => "product_title_heading_tag",
					"value" => array(
						esc_html__( "h1", "crocal-extension" ) => 'h1',
						esc_html__( "h2", "crocal-extension" ) => 'h2',
						esc_html__( "h3", "crocal-extension" ) => 'h3',
						esc_html__( "h4", "crocal-extension" ) => 'h4',
						esc_html__( "h5", "crocal-extension" ) => 'h5',
						esc_html__( "h6", "crocal-extension" ) => 'h6',
						esc_html__( "div", "crocal-extension" ) => 'div',
					),
					"description" => esc_html__( "product Title Tag for SEO", "crocal-extension" ),
					"std" => 'h3',
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Product Title Size/Typography", "crocal-extension" ),
					"param_name" => "product_title_heading",
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
					"description" => esc_html__( "product Title size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
					"std" => 'h3',
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Product Style - Hovers", "crocal-extension" ),
					"param_name" => "product_style",
					'value' => array(
						esc_html__( 'Content Below Image' , 'crocal-extension' ) => 'hover-style-1',
						esc_html__( 'Top Down Animated Content' , 'crocal-extension' ) => 'hover-style-2',
					),
					"description" => esc_html__( "Select the hover style for the product overview.", "crocal-extension" ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Second Image Effect", "crocal-extension" ),
					"param_name" => "second_image_effect",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"description" => esc_html__( "Choose if you want second image effect.", "crocal-extension" ),
					'std' => 'yes',
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
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
					'std' => 'none',
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Grayscale Effect", "crocal-extension" ),
					"param_name" => "grayscale_effect",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => 'none',
						esc_html__( "Grayscale Image", "crocal-extension" ) => 'grayscale-image',
						esc_html__( "Colored on Hover", "crocal-extension" ) => 'grayscale-image-hover',
					),
					"description" => esc_html__( "Choose the grayscale effect.", "crocal-extension" ),
					'std' => 'none',
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
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
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Overlay Opacity", "crocal-extension" ),
					"param_name" => "overlay_opacity",
					"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
					"std" => '90',
					"description" => esc_html__( "Choose the opacity for the overlay.", "crocal-extension" ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Exclude Posts", "crocal-extension" ),
					"param_name" => "exclude_posts",
					"value" => '',
					"description" => esc_html__( "Type the post ids you want to exclude separated by comma ( , ).", "crocal-extension" ),
					"group" => esc_html__( "Categories", "crocal-extension" ),
				),
				array(
					"type" => "crocal_ext_multi_checkbox",
					"heading" => __("Product Categories", "crocal-extension" ),
					"param_name" => "categories",
					"value" => crocal_ext_vce_get_product_categories(),
					"description" => esc_html__( "Select all or multiple categories.", "crocal-extension" ),
					"admin_label" => true,
					"group" => esc_html__( "Categories", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Include Specific Posts", "crocal-extension" ),
					"param_name" => "include_posts",
					"value" => '',
					"description" => esc_html__( "Type the specific post ids you want to include separated by comma ( , ). Note: If you define specific post ids, Exclude Posts and Categories will have no effect.", "crocal-extension" ),
					"group" => esc_html__( "Categories", "crocal-extension" ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_products_carousel', 'crocal_ext_vce_products_carousel_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_products_carousel_shortcode_params( 'crocal_products_carousel' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
