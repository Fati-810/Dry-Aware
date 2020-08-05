<?php
/**
 * Content Slider Shortcode
 */

if( !function_exists( 'crocal_ext_vce_content_slider_shortcode' ) ) {

	function crocal_ext_vce_content_slider_shortcode( $atts, $content ) {

		$output = $el_class = $data_string = $auto_excerpt = '';

		extract(
			shortcode_atts(
				array(
					'categories' => '',
					'portfolio_categories' => '',
					'product_categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'post_type' => 'post',
					'image_mode' => 'landscape',
					'shape' => 'square',
					'shadow' => '',
					'heading_tag' => 'h3',
					'heading' => 'h5',
					'text_color' => 'white',
					'overlay_color' => 'dark',
					'overlay_opacity' => '90',
					'read_more_title' => 'Read More',
					'slideshow_speed' => '3500',
					'pause_hover' => 'no',
					'auto_play' => 'yes',
					'hide_author' => '',
					'hide_date' => '',
					'hide_like' => '',
					'posts_per_page' => '4',
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
			$post_type_class = 'eut-blog-slider';
		}

		$content_slider_classes = array( 'eut-element', 'eut-slider', 'eut-content-slider' );
		if ( !empty ( $el_class ) ) {
			$content_slider_classes[] = $el_class;
		}
		$content_slider_classes[] = $post_type_class;
		$content_slider_classes[] = 'eut-text-' . $text_color;
		$content_slider_classes[] = 'eut-headings-' . $text_color;

		if ( 'square' != $shape ) {
			$content_slider_classes[] = 'eut-' . $shape;
		}

		if ( !empty( $shadow ) ) {
			$content_slider_classes[] = 'eut-' . $shadow;
			$content_slider_classes[] = 'eut-with-shadow';
		}

		$content_slider_class_string = implode( ' ', $content_slider_classes );

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
					'posts_per_page' => $posts_per_page,
					'orderby' => $order_by,
					'order' => $order,
				);
			} else {
				$args = array(
					'post_type' => 'portfolio',
					'post_status'=>'publish',
					'paged' => 1,
					'portfolio_category' => $portfolio_cat,
					'posts_per_page' => $posts_per_page,
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
					'posts_per_page' => $posts_per_page,
					'post__in' => $include_ids,
					'paged' => 1,
					'orderby' => $order_by,
					'order' => $order,
				);
			} else {
				$args = array(
					'post_type' => 'product',
					'post_status'=>'publish',
					'posts_per_page' => $posts_per_page,
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
					'posts_per_page' => $posts_per_page,
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
					'posts_per_page' => $posts_per_page,
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
		$wrapper_attributes[] = 'class="eut-slider-element owl-carousel eut-add-counter eut-carousel-element"';
		$wrapper_attributes[] = 'data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
		$wrapper_attributes[] = 'data-slider-pause="' . esc_attr( $pause_hover ) . '"';
		$wrapper_attributes[] = 'data-slider-autoplay="' . esc_attr( $auto_play ) . '"';
		$wrapper_attributes[] = 'data-slider-autoheight="no"';

		$image_html = crocal_ext_vce_get_fallback_image( $image_mode_size );

		$title_classes = array( 'eut-title' );
		$title_classes[]  = 'eut-' . $heading;
		$title_class_string = implode( ' ', $title_classes );

		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) :

?>
		<div class="<?php echo esc_attr( $content_slider_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>">
			<div class="eut-element eut-carousel-wrapper">
				<div <?php echo implode( ' ', $wrapper_attributes ); ?>>

<?php
		while ( $query->have_posts() ) : $query->the_post();
			$post_id = get_the_ID();
?>
					<div class="eut-slider-item">
						<?php if ( has_post_thumbnail() ) {
							$bg_options = array(
								'bg_color' => $overlay_color,
								'bg_opacity' => $overlay_opacity
							);
							crocal_ext_vce_post_bg_image_container( $bg_options );
						} ?>
						<div class="eut-slider-content">
							<div class="eut-slider-content-wrapper">
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
								<?php } ?>
								<?php the_title( '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">', '</' . tag_escape( $heading_tag ) . '>' ); ?>
								<div class="eut-description"><?php echo crocal_ext_vce_excerpt( '15' ); ?></div>
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
	add_shortcode( 'crocal_content_slider', 'crocal_ext_vce_content_slider_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_content_slider_shortcode_params' ) ) {
	function crocal_ext_vce_content_slider_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Slider with Content", "crocal-extension" ),
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
					"param_name" => "posts_per_page",
					"value" => array( '2','3','4','5','6','7','8' ),
					"description" => esc_html__( "Enter how many posts you want to display.", "crocal-extension" ),
					"std" => '4',
				),
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
					"type" => "dropdown",
					"heading" => esc_html__( "Shape", "crocal-extension" ),
					"param_name" => "shape",
					"value" => array(
						esc_html__( "Square", "crocal-extension" ) => 'square',
						esc_html__( "Radius 3px", "crocal-extension" ) => 'radius-3',
						esc_html__( "Radius 5px", "crocal-extension" ) => 'radius-5',
						esc_html__( "Radius 10px", "crocal-extension" ) => 'radius-10',
						esc_html__( "Radius 15px", "crocal-extension" ) => 'radius-15',
						esc_html__( "Radius 20px", "crocal-extension" ) => 'radius-20',
						esc_html__( "Radius 25px", "crocal-extension" ) => 'radius-25',
						esc_html__( "Radius 30px", "crocal-extension" ) => 'radius-30',
						esc_html__( "Radius 35px", "crocal-extension" ) => 'radius-35',
					),
					"description" => '',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Add Shadow", "crocal-extension" ),
					"param_name" => "shadow",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Small", "crocal-extension" ) => 'small-shadow',
						esc_html__( "Medium", "crocal-extension" ) => 'medium-shadow',
						esc_html__( "Large", "crocal-extension" ) => 'large-shadow',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Read More Title", "crocal-extension" ),
					"param_name" => "read_more_title",
					"value" => "",
					"description" => esc_html__( "Enter the title for your link.", "crocal-extension" ),
				),
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
				crocal_ext_vce_add_order_by(),
				crocal_ext_vce_add_order(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Slider Title Tag", "crocal-extension" ),
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
					"description" => esc_html__( "Slider Title Tag for SEO", "crocal-extension" ),
					"std" => 'h3',
					"group" => esc_html__( "Titles & Overlay", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Slider Title Size/Typography", "crocal-extension" ),
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
					"description" => esc_html__( "Slider Title size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
					"std" => 'h5',
					"group" => esc_html__( "Titles & Overlay", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Text Color", "crocal-extension" ),
					"param_name" => "text_color",
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
					'std' => 'white',
					"group" => esc_html__( "Titles & Overlay", "crocal-extension" ),
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
						esc_html__( "Green", "crocal-extension" ) => 'green',
						esc_html__( "Orange", "crocal-extension" ) => 'orange',
						esc_html__( "Red", "crocal-extension" ) => 'red',
						esc_html__( "Blue", "crocal-extension" ) => 'blue',
						esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
						esc_html__( "Purple", "crocal-extension" ) => 'purple',
					),
					"std" => 'dark',
					"description" => esc_html__( "Choose the image color overlay.", "crocal-extension" ),
					"group" => esc_html__( "Titles & Overlay", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Overlay Opacity", "crocal-extension" ),
					"param_name" => "overlay_opacity",
					"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
					"std" => '90',
					"description" => esc_html__( "Choose the opacity for the overlay.", "crocal-extension" ),
					"group" => esc_html__( "Titles & Overlay", "crocal-extension" ),
				),
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
	vc_lean_map( 'crocal_content_slider', 'crocal_ext_vce_content_slider_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_content_slider_shortcode_params( 'crocal_content_slider' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
