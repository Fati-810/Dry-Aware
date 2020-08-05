<?php
/**
 * Content Carousel Shortcode
 */

if( !function_exists( 'crocal_ext_vce_content_carousel_shortcode' ) ) {

	function crocal_ext_vce_content_carousel_shortcode( $atts, $content ) {

		$output = $el_class = $data_string = $auto_excerpt = '';

		extract(
			shortcode_atts(
				array(
					'categories' => '',
					'portfolio_categories' => '',
					'product_categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'carousel_layout' => 'layout-1',
					'post_type' => 'post',
					'item_gutter' => 'yes',
					'gutter_size' => '40',
					'image_mode' => 'landscape',
					'heading_tag' => 'h3',
					'heading' => 'h5',
					'custom_font_family' => '',
					'read_more_title' => 'Read More',
					'slideshow_speed' => '3500',
					'navigation_type' => '1',
					'navigation_color' => 'dark',
					'pause_hover' => 'no',
					'auto_play' => 'yes',
					'auto_height' => 'no',
					'hide_author' => '',
					'hide_date' => '',
					'hide_like' => '',
					'items_per_page' => '4',
					'items_tablet_landscape' => '3',
					'items_tablet_portrait' => '3',
					'items_mobile' => '1',
					'order_by' => 'date',
					'order' => 'DESC',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );


		$post_type_class = '';
		if ( 'portfolio' == $post_type ) {
			$post_type_class = 'eut-portfolio-slider';
		} elseif ( 'product' == $post_type ) {
			$post_type_class = 'eut-product-slider';
		} else {
			$post_type_class = 'eut-blog eut-blog-carousel';
		}

		$content_carousel_classes = array( 'eut-element', 'eut-carousel');
		if ( 'yes' == $item_gutter ) {
				$content_carousel_classes[] = 'eut-with-gap';
			}
		if ( !empty ( $el_class ) ) {
			$content_carousel_classes[] = $el_class;
		}
		$content_carousel_classes[] = $post_type_class;
		$content_carousel_class_string = implode( ' ', $content_carousel_classes );

		$exclude_ids = array();
		if( !empty( $exclude_posts ) ){
			$exclude_ids = explode( ',', $exclude_posts );
		}

		$include_ids = array();
		if( !empty( $include_posts ) ){
			$include_ids = explode( ',', $include_posts );
		}

		if ( 'portfolio' == $post_type ) {

			$portfolio_cat = "";
			$portfolio_category_ids = array();

			if( ! empty( $portfolio_categories ) ) {
				$portfolio_category_ids = explode( ",", $portfolio_categories );
				foreach ( $portfolio_category_ids as $category_id ) {
					$category_term = get_term( $category_id, 'portfolio_category' );
					if ( isset( $category_term) ) {
						$portfolio_cat = $portfolio_cat.$category_term->slug . ', ';
					}
				}
			}

			if( !empty( $include_posts ) ){
				$args = array(
					'post_type' => 'portfolio',
					'post_status'=>'publish',
					'paged' => 1,
					'post__in' => $include_ids,
					'posts_per_page' => $items_per_page,
					'orderby' => $order_by,
					'order' => $order,
				);
			} else {
				$args = array(
					'post_type' => 'portfolio',
					'post_status'=>'publish',
					'paged' => 1,
					'portfolio_category' => $portfolio_cat,
					'posts_per_page' => $items_per_page,
					'post__not_in' => $exclude_ids,
					'orderby' => $order_by,
					'order' => $order,
				);
			}

		} elseif ( 'product' == $post_type ) {
			$product_cat = "";
			$product_category_ids = array();

			if( ! empty( $product_categories ) ) {
				$product_category_ids = explode( ",", $product_categories );
				foreach ( $product_category_ids as $category_id ) {
					$category_term = get_term( $category_id, 'product_cat' );
					if ( isset( $category_term) ) {
						$product_cat = $product_cat.$category_term->slug . ', ';
					}
				}
			}

			if( !empty( $include_posts ) ){
				$args = array(
					'post_type' => 'product',
					'post_status'=>'publish',
					'posts_per_page' => $items_per_page,
					'post__in' => $include_ids,
					'paged' => 1,
					'orderby' => $order_by,
					'order' => $order,
				);
			} else {
				$args = array(
					'post_type' => 'product',
					'post_status'=>'publish',
					'posts_per_page' => $items_per_page,
					'post__not_in' => $exclude_ids,
					'product_cat' => $product_cat,
					'paged' => 1,
					'orderby' => $order_by,
					'order' => $order,
				);
			}
		} else {
			if( !empty( $include_posts ) ){
				$args = array(
					'post_type' => 'post',
					'post_status'=>'publish',
					'posts_per_page' => $items_per_page,
					'post__in' => $include_ids,
					'paged' => 1,
					'ignore_sticky_posts' => 1,
					'orderby' => $order_by,
					'order' => $order,
				);
			} else {
				$args = array(
					'post_type' => 'post',
					'post_status'=>'publish',
					'posts_per_page' => $items_per_page,
					'cat' => $categories,
					'post__not_in' => $exclude_ids,
					'paged' => 1,
					'ignore_sticky_posts' => 1,
					'orderby' => $order_by,
					'order' => $order,
				);
			}
		}

		$image_mode_size = crocal_ext_vce_get_image_size( $image_mode );

		$wrapper_attributes = array();
		$wrapper_attributes[] = 'class="eut-carousel owl-carousel eut-carousel-element"';

		$wrapper_attributes[] = 'data-items="' . esc_attr( $items_per_page ) . '"';
		$wrapper_attributes[] = 'data-items-tablet-landscape="' . esc_attr( $items_tablet_landscape ) . '"';
		$wrapper_attributes[] = 'data-items-tablet-portrait="' . esc_attr( $items_tablet_portrait ) . '"';
		$wrapper_attributes[] = 'data-items-mobile="' . esc_attr( $items_mobile ) . '"';
		
		$wrapper_attributes[] = 'data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
		$wrapper_attributes[] = 'data-slider-pause="' . esc_attr( $pause_hover ) . '"';
		$wrapper_attributes[] = 'data-slider-autoplay="' . esc_attr( $auto_play ) . '"';
		$wrapper_attributes[] = 'data-slider-autoheight="' . esc_attr( $auto_height ) . '"';
		$wrapper_attributes[] = 'data-pagination-color="' . esc_attr( $navigation_color ) . '"';
		$wrapper_attributes[] = 'data-pagination-speed="' . esc_attr( $carousel_pagination_speed ) . '"';
		$wrapper_attributes[] = 'data-pagination="' . esc_attr( $carousel_pagination ) . '"';
		$wrapper_attributes[] = 'data-slider-loop="' . esc_attr( $loop ) . '"';
		
		if ( 'yes' == $item_gutter ) {
			$wrapper_attributes[] = 'data-gutter-size="' . esc_attr( $gutter_size ) . '"';
		}

		$title_classes = array( 'eut-title' );
		$title_classes[]  = 'eut-' . $heading;
		if ( !empty( $custom_font_family ) ) {
			$title_classes[]  = 'eut-' . $custom_font_family;
		}
		$title_class_string = implode( ' ', $title_classes );

		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) :

?>
		<div class="<?php echo esc_attr( $content_carousel_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>">
			<div class="eut-element eut-carousel-wrapper">
				<?php echo crocal_ext_vce_element_navigation( $navigation_type, $navigation_color, 'carousel' ); ?>
				<div <?php echo implode( ' ', $wrapper_attributes ); ?>>

<?php
		while ( $query->have_posts() ) : $query->the_post();
			$post_id = get_the_ID();
?>
					<div class="eut-slider-item">
						<figure>
							<div class="eut-media">
								<?php if ( has_post_thumbnail() ) { ?>
									<?php the_post_thumbnail( $image_mode_size ); ?>
								<?php } else { ?>
									<?php echo crocal_ext_vce_get_fallback_image( $image_mode_size ); ?>
								<?php } ?>
							</div>
						</figure>
						<div class="eut-slider-content" data-limit="1x">
							<div class="eut-slider-content-wrapper">
								<?php the_title( '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">', '</' . tag_escape( $heading_tag ) . '>' ); ?>
								<?php if( 'post' == $post_type ) { ?>

										<ul class="eut-post-meta">
										<?php if ( 'yes' != $hide_author ) { ?>
												<li class="eut-post-author"><?php the_author(); ?></li>
										<?php } ?>
										<?php if ( 'yes' != $hide_date ) { ?>
											<?php echo crocal_ext_vce_print_list_date(); ?>
										<?php } ?>
										<?php
											if( 'yes' != $hide_like && function_exists( 'crocal_eutf_social_like' ) ) {
												crocal_eutf_social_like( $post_type );
											}
										?>
										</ul>
										<div class="eut-description"><?php echo crocal_ext_vce_excerpt( '15' ); ?></div>
								<?php } else { ?>
									<div class="eut-description"><?php echo crocal_ext_vce_excerpt( '15' ); ?></div>
								<?php } ?>
								<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="eut-read-more eut-link-text"><?php echo esc_html( $read_more_title ); ?></a>
							</div>
						</div>
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
	add_shortcode( 'crocal_content_carousel', 'crocal_ext_vce_content_carousel_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_content_carousel_shortcode_params' ) ) {
	function crocal_ext_vce_content_carousel_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Carousel with Content", "crocal-extension" ),
			"description" => esc_html__( "Display a slider with content", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-content-slider",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Post Type", "crocal-extension" ),
					"param_name" => "post_type",
					'value' => array(
						esc_html__( 'Post', 'crocal-extension' ) => 'post',
						esc_html__( 'Portfolio', 'crocal-extension' ) => 'portfolio',
						esc_html__( 'Product', 'crocal-extension' ) => 'product',
					),
					"description" => esc_html__( "Select the post type.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Number of Posts", "crocal-extension" ),
					"param_name" => "items_per_page",
					"value" => array( '2','3','4','5','6','7','8' ),
					"description" => esc_html__( "Enter how many items you want to display.", "crocal-extension" ),
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
					"value" => array( '2', '3', '4' ),
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
					"heading" => esc_html__( "Gutter between images", "crocal-extension" ),
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
					"value" => '40',
					"dependency" => array( 'element' => "item_gutter", 'value' => array( 'yes' ) ),
				),
				crocal_ext_vce_get_heading_tag( "h3" ),
				crocal_ext_vce_get_heading( "h5" ),
				crocal_ext_vce_get_custom_font_family(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Size", "crocal-extension" ),
					"param_name" => "image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Square Small Crop', 'crocal-extension' ) => 'square',
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
					) ),
					"std" => "landscape",
					"description" => esc_html__( "Select your Image size.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Read More Title", "crocal-extension" ),
					"param_name" => "read_more_title",
					"value" => "",
					"description" => esc_html__( "Enter the title for your link.", "crocal-extension" ),
				),
/* 				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Parallax", "crocal-extension" ),
					"param_name" => "parallax",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"std" => "no",
				), */
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Autoplay", "crocal-extension" ),
					"param_name" => "auto_play",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
				),
				crocal_ext_vce_add_slideshow_speed(),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Pause on Hover", "crocal-extension" ),
					"param_name" => "pause_hover",
					"value" => array( esc_html__( "If selected, slider will be paused on hover", "crocal-extension" ) => 'yes' ),
				),
				crocal_ext_vce_add_auto_height(),
				crocal_ext_vce_add_navigation_type(),
				crocal_ext_vce_add_navigation_color(),
				crocal_ext_vce_add_order_by(),
				crocal_ext_vce_add_order(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Author", "crocal-extension" ),
					"param_name" => "hide_author",
					"description" => esc_html__( "If selected, blog overview will not show author.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Author.", "crocal-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "post_type", 'value' => array( 'post' ) ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Date", "crocal-extension" ),
					"param_name" => "hide_date",
					"description" => esc_html__( "If selected, blog overview will not show date.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Date.", "crocal-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "post_type", 'value' => array( 'post' ) ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Like", "crocal-extension" ),
					"param_name" => "hide_like",
					"description" => esc_html__( "If selected, blog overview will not show like.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Like.", "crocal-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "post_type", 'value' => array( 'post' ) ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
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
					"heading" => esc_html__( "Categories", "crocal-extension" ),
					"param_name" => "categories",
					"value" => crocal_ext_vce_get_post_categories(),
					"description" => esc_html__( "Select all or multiple categories.", "crocal-extension" ),
					"dependency" => array( 'element' => "post_type", 'value' => array( 'post' ) ),
					"group" => esc_html__( "Categories", "crocal-extension" ),
				),
				array(
					"type" => "crocal_ext_multi_checkbox",
					"heading" => __("Portfolio Categories", "crocal-extension" ),
					"param_name" => "portfolio_categories",
					"value" => crocal_ext_vce_get_portfolio_categories(),
					"description" => esc_html__( "Select all or multiple categories.", "crocal-extension" ),
					"dependency" => array( 'element' => "post_type", 'value' => array( 'portfolio' ) ),
					"group" => esc_html__( "Categories", "crocal-extension" ),
				),
				array(
					"type" => "crocal_ext_multi_checkbox",
					"heading" => __("Product Categories", "crocal-extension" ),
					"param_name" => "product_categories",
					"value" => crocal_ext_vce_get_product_categories(),
					"description" => esc_html__( "Select all or multiple categories.", "crocal-extension" ),
					"dependency" => array( 'element' => "post_type", 'value' => array( 'product' ) ),
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
	vc_lean_map( 'crocal_content_carousel', 'crocal_ext_vce_content_carousel_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_content_carousel_shortcode_params( 'crocal_content_carousel' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
