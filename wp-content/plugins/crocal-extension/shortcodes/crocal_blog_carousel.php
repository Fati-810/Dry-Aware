<?php
/**
 * Blog Shortcode
 */

if( !function_exists( 'crocal_ext_vce_blog_carousel_shortcode' ) ) {

	function crocal_ext_vce_blog_carousel_shortcode( $atts, $content ) {

		$output = $el_class = $data_string = '';

		extract(
			shortcode_atts(
				array(
					'carousel_mode' => 'simple',
					'title' => '',
					'text_style' => 'none',
					'align' => 'left',
					'heading_tag' => 'h3',
					'heading' => 'h3',
					'custom_font_family' => '',
					'categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'carousel_layout' => 'layout-1',
					'blog_media_area' => 'yes',
					'carousel_image_mode' => 'landscape',
					'post_title_heading_tag' => 'h2',
					'post_title_heading' => 'h6',
					'carousel_style' => '1',
					'carousel_bg_color' => 'black',
					'carousel_bg_opacity' => '40',
					'item_gutter' => 'yes',
					'gutter_size' => '40',
					'excerpt_length' => '15',
					'hide_author' => '',
					'hide_date' => '',
					'hide_comments' => '',
					'hide_like' => '',
					'hide_excerpt' => '',
					'hide_categories' => 'yes',
					'posts_per_page' => '10',
					'order_by' => 'date',
					'order' => 'DESC',
					'items_per_page' => '4',
					'items_tablet_landscape' => '3',
					'items_tablet_portrait' => '3',
					'items_mobile' => '1',

					'stage_padding' => '400',
					'stage_padding_large_screen' => '300',
					'stage_padding_tablet_landscape' => '200',
					'stage_padding_tablet_portrait' => '100',
					'stage_padding_mobile' => '30',

					'slideshow_speed' => '3000',
					'loop' => 'yes',
					'auto_play' => 'yes',
					'navigation_type' => '1',
					'navigation_color' => 'dark',
					'pause_hover' => 'no',
					'carousel_pagination' => 'no',
					'carousel_pagination_speed' => '400',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$blog_mode = 'carousel';
		$auto_excerpt = '';
		$excerpt_more = '';

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$blog_classes = array( 'eut-element' );
		$blog_classes[] = 'eut-carousel';
		$blog_classes[] = 'eut-' . $carousel_layout;
		$blog_classes[] = 'eut-carousel-style-' . $carousel_style ;
		if ( 'yes' == $item_gutter ) {
			$blog_classes[] = 'eut-with-gap';
		}
		$blog_classes[] = crocal_ext_vce_get_blog_class( $blog_mode );
		if ( !empty ( $el_class ) ) {
			$blog_classes[] = $el_class;
		}
		if ( 'advanced-carousel' == $carousel_mode ) {
			$blog_classes[] = 'eut-carousel-style-2' ;
		}
		$blog_class_string = implode( ' ', $blog_classes );

		$paged = 1;

		$exclude_ids = array();
		if( !empty( $exclude_posts ) ){
			$exclude_ids = explode( ',', $exclude_posts );
		}

		$include_ids = array();
		if( !empty( $include_posts ) ){
			$include_ids = explode( ',', $include_posts );
			$args = array(
				'post_type' => 'post',
				'post_status'=>'publish',
				'posts_per_page' => $posts_per_page,
				'post__in' => $include_ids,
				'paged' => $paged,
				'ignore_sticky_posts' => 1,
				'orderby' => $order_by,
				'order' => $order,
			);
		} else {
			$args = array(
				'post_type' => 'post',
				'post_status'=>'publish',
				'posts_per_page' => $posts_per_page,
				'post__not_in' => $exclude_ids,
				'cat' => $categories,
				'paged' => $paged,
				'ignore_sticky_posts' => 1,
				'orderby' => $order_by,
				'order' => $order,
			);
		}

		$query = new WP_Query( $args );

		$blog_category_ids = array();

		if( ! empty( $categories ) ) {
			$blog_category_ids = explode( ",", $categories );
		}
		$category_prefix = '.category-';

		$image_atts = array();

		ob_start();

		if ( $query->have_posts() ) :

?>
		<div class="<?php echo esc_attr( $blog_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>">
<?php

		$image_size = 'crocal-eutf-small-rect-horizontal';

		if( 'advanced-carousel' == $carousel_mode ) {
			$data_string .= ' data-stage-padding="' . esc_attr( $stage_padding ) . '"';
			$data_string .= ' data-stage-padding-large-screen="' . esc_attr( $stage_padding_large_screen ) . '"';
			$data_string .= ' data-stage-padding-tablet-landscape="' . esc_attr( $stage_padding_tablet_landscape ) . '"';
			$data_string .= ' data-stage-padding-tablet-portrait="' . esc_attr( $stage_padding_tablet_portrait ) . '"';
			$data_string .= ' data-stage-padding-mobile="' . esc_attr( $stage_padding_mobile ) . '"';
		} else {
			$data_string .= ' data-items="' . esc_attr( $items_per_page ) . '"';
			$data_string .= ' data-items-tablet-landscape="' . esc_attr( $items_tablet_landscape ) . '"';
			$data_string .= ' data-items-tablet-portrait="' . esc_attr( $items_tablet_portrait ) . '"';
			$data_string .= ' data-items-mobile="' . esc_attr( $items_mobile ) . '"';
		}

		$data_string .= ' data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
		$data_string .= ' data-slider-pause="' . esc_attr( $pause_hover ) . '"';
		$data_string .= ' data-pagination-speed="' . esc_attr( $carousel_pagination_speed ) . '"';
		$data_string .= ' data-pagination="' . esc_attr( $carousel_pagination ) . '"';
		$data_string .= ' data-slider-loop="' . esc_attr( $loop ) . '"';
		$data_string .= ' data-slider-autoplay="' . esc_attr( $auto_play ) . '"';

		if ( 'yes' == $item_gutter ) {
			$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
		}
		if( 'square' == $carousel_image_mode ) {
			$image_size = 'crocal-eutf-small-square';
		} elseif( 'portrait' == $carousel_image_mode ) {
			$image_size = 'crocal-eutf-small-rect-vertical';
		} else {
			$image_size = 'crocal-eutf-small-rect-horizontal';
		}

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
		if( 'layout-1' == $carousel_layout && 'advanced-carousel' != $carousel_mode ){
			echo crocal_ext_vce_element_navigation( $navigation_type, $navigation_color, 'carousel' );
		}

		if ( 'advanced-carousel' == $carousel_mode ) {
?>
			<div class="eut-blog eut-blog-carousel eut-advanced-carousel owl-carousel"<?php echo $data_string; ?>>
<?php
		} else {
?>
			<div class="eut-blog eut-blog-carousel eut-carousel-element owl-carousel"<?php echo $data_string; ?>>
<?php
		}

		while ( $query->have_posts() ) : $query->the_post();

			$post_format = get_post_format();
			$bg_post_mode = crocal_ext_vce_is_post_bg( $blog_mode, $post_format );

			if ( 'link' == $post_format || 'quote' == $post_format ) {
				$crocal_ext_post_class = crocal_ext_vce_get_post_class( $blog_mode, 'eut-style-2' );
			} else {
				if ( $bg_post_mode ) {
					$crocal_ext_post_class = crocal_ext_vce_get_post_class( $blog_mode, 'eut-style-2' );
				} else {
					$crocal_ext_post_class = crocal_ext_vce_get_post_class( $blog_mode );
				}
			}

				if ( '1' == $carousel_style && 'advanced-carousel' != $carousel_mode ) {
?>
				<div class="eut-carousel-item">
					<article <?php post_class( 'eut-post-item' ); ?> itemscope itemType="http://schema.org/BlogPosting">
						<?php
							if ( 'yes' == $blog_media_area ) {
								crocal_ext_vce_print_carousel_media( $carousel_image_mode, $image_atts );
							}
						?>
						<div class="eut-post-content">
							<ul class="eut-post-meta">
								<?php
									if ( 'yes' != $hide_author ) {
										crocal_ext_vce_print_post_author_by( $blog_mode );
									}
									if ( 'yes' != $hide_date ) {
										crocal_ext_vce_print_post_date( 'list' );
									}
									if ( 'yes' != $hide_comments ) {
										crocal_ext_vce_print_post_comments();
									}
									if( 'yes' != $hide_like && function_exists( 'crocal_eutf_print_like_counter' ) ) {
										crocal_eutf_print_like_counter();
									}
								?>
							</ul>
							<?php
							if ( 'yes' != $hide_categories ) {
								crocal_ext_vce_print_post_categories();
							}
							?>							
							<?php crocal_ext_vce_print_post_title( $blog_mode, $post_format, $post_title_heading_tag, $post_title_heading ); ?>
							<?php crocal_ext_vce_print_structured_data(); ?>
							<?php
								if ( 'yes' != $hide_excerpt ) {
									crocal_ext_vce_print_post_excerpt( $blog_mode, $post_format, $auto_excerpt, $excerpt_length, $excerpt_more );
								}
							?>
						</div>
					</article>
				</div>
<?php
				} else {
?>
				<div class="eut-carousel-item">
					<article <?php post_class( 'eut-post-item' ); ?> itemscope itemType="http://schema.org/BlogPosting">
						<?php
							$bg_options = array(
								'bg_color' => $carousel_bg_color,
								'bg_opacity' => $carousel_bg_opacity
							);
							crocal_ext_vce_post_bg_image_container( $bg_options );
						?>
						<div class="eut-post-content eut-text-light">
							<ul class="eut-post-meta">
								<?php
									if ( 'yes' != $hide_author ) {
										crocal_ext_vce_print_post_author_by( $blog_mode );
									}
									if ( 'yes' != $hide_date ) {
										crocal_ext_vce_print_post_date( 'list' );
									}
									if ( 'yes' != $hide_comments ) {
										crocal_ext_vce_print_post_comments();
									}
									if( 'yes' != $hide_like && function_exists( 'crocal_eutf_print_like_counter' ) ) {
										crocal_eutf_print_like_counter();
									}
								?>
							</ul>
							<?php
							if ( 'yes' != $hide_categories ) {
								crocal_ext_vce_print_post_categories();
							}
							?>							
							<?php crocal_ext_vce_print_post_title( $blog_mode, $post_format, $post_title_heading_tag, $post_title_heading ); ?>
							<?php crocal_ext_vce_print_structured_data(); ?>
							<?php
								if ( 'yes' != $hide_excerpt ) {
									crocal_ext_vce_print_post_excerpt( $blog_mode, $post_format, $auto_excerpt, $excerpt_length, $excerpt_more );
								}
							?>
						</div>
					</article>
				</div>
<?php
				}
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
	add_shortcode( 'crocal_blog_carousel', 'crocal_ext_vce_blog_carousel_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_blog_carousel_shortcode_params' ) ) {
	function crocal_ext_vce_blog_carousel_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Blog Carousel", "crocal-extension" ),
			"description" => esc_html__( "Display a Blog Carousel element", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-blog",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Mode", "crocal-extension" ),
					"param_name" => "carousel_mode",
					'value' => array(
						esc_html__( 'Simple', 'crocal-extension' ) => 'simple-carousel',
						esc_html__( 'Advanced', 'crocal-extension' ) => 'advanced-carousel',
					),
					'std' => '1',
					"description" => esc_html__( "Select your Carousel Mode.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Style", "crocal-extension" ),
					"param_name" => "carousel_style",
					'value' => array(
						esc_html__( 'Content below image', 'crocal-extension' ) => '1',
						esc_html__( 'Content inside image', 'crocal-extension' ) => '2',
					),
					'std' => '1',
					"description" => esc_html__( "Select your Carousel Style.", "crocal-extension" ),
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'simple-carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Media Area Visibility", "crocal-extension" ),
					"param_name" => "blog_media_area",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"std" => "yes",
					"description" => esc_html__( "Select if you want to enable/disable media area", "crocal-extension" ),
					"dependency" => array( 'element' => "carousel_style", 'value' => array( '1' ) ),
				),
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
					"dependency" => array( 'element' => "blog_media_area", 'value' => array( 'yes' ) ),
				),
				array(
					"type" => 'textfield',
					"heading" => esc_html__( "Excerpt length", "crocal-extension" ),
					"param_name" => "excerpt_length",
					"description" => esc_html__( "Type how many words you want to display in your post excerpts.", "crocal-extension" ),
					"value" => '15',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items per page", "crocal-extension" ),
					"param_name" => "items_per_page",
					"value" => array( '2', '3', '4', '5' ),
					"description" => esc_html__( "Number of items per page", "crocal-extension" ),
					"std" => '4',
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'simple-carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items Tablet Landscape", "crocal-extension" ),
					"param_name" => "items_tablet_landscape",
					"value" => array( '2', '3', '4' ),
					"std" => '3',
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'simple-carousel' ) ),
					"description" => esc_html__( "Select number of items on tablet devices, landscape orientation.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items Tablet Portrait", "crocal-extension" ),
					"param_name" => "items_tablet_portrait",
					"value" => array( '2', '3', '4'  ),
					"std" => '3',
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'simple-carousel' ) ),
					"description" => esc_html__( "Select number of items on tablet devices, portrait orientation.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Items Mobile", "crocal-extension" ),
					"param_name" => "items_mobile",
					"value" => array( '1', '2' ),
					"std" => '1',
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'simple-carousel' ) ),
					"description" => esc_html__( "Select number of items on mobile devices.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Large Screen Stage Padding", "crocal-extension" ),
					"param_name" => "stage_padding_large_screen",
					"value" => '300',
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'advanced-carousel' ) ),
					"description" => esc_html__( "Set left and right padding style (in pixels) onto stage-wrapper.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Stage Padding", "crocal-extension" ),
					"param_name" => "stage_padding",
					"value" => '400',
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'advanced-carousel' ) ),
					"description" => esc_html__( "Set left and right padding style (in pixels) onto stage-wrapper.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Tablet Landscape Stage Padding", "crocal-extension" ),
					"param_name" => "stage_padding_tablet_landscape",
					"value" => '200',
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'advanced-carousel' ) ),
					"description" => esc_html__( "Set left and right padding style (in pixels) onto stage-wrapper.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Tablet Portrait Stage Padding", "crocal-extension" ),
					"param_name" => "stage_padding_tablet_portrait",
					"value" => '100',
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'advanced-carousel' ) ),
					"description" => esc_html__( "Set left and right padding style (in pixels) onto stage-wrapper.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Mobile Stage Padding", "crocal-extension" ),
					"param_name" => "stage_padding_mobile",
					"value" => '30',
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'advanced-carousel' ) ),
					"description" => esc_html__( "Set left and right padding style (in pixels) onto stage-wrapper.", "crocal-extension" ),
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
					"value" => '40',
					"dependency" => array( 'element' => "item_gutter", 'value' => array( 'yes' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Items to show", "crocal-extension" ),
					"param_name" => "posts_per_page",
					"value" => "10",
					"description" => esc_html__( "Maximum Items to Show", "crocal-extension" ),
				),
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
						esc_html__( "Top Navigation with Title/Text", "crocal-extension" ) => 'layout-2',
					),
					"description" => 'Select your layout for Carousel Element',
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'simple-carousel' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Carousel Title", "crocal-extension" ),
					"param_name" => "title",
					"value" => "Sample Title",
					"description" => esc_html__( "Enter your carousel title here.", "crocal-extension" ),
					"save_always" => true,
					"dependency" => array( 'element' => "carousel_layout", 'value' => array( 'layout-2' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Title Tag", "crocal-extension" ),
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
					"heading" => esc_html__( "Carousel Title Size/Typography", "crocal-extension" ),
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
					"description" => esc_html__( "Carousel Title size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
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
					"heading" => esc_html__( "Carousel Text", "crocal-extension" ),
					"param_name" => "content",
					"value" => "",
					"description" => esc_html__( "Type your text.", "crocal-extension" ),
					"dependency" => array( 'element' => "carousel_layout", 'value' => array( 'layout-2' ) ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Text Style", "crocal-extension" ),
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
					"heading" => esc_html__( "Carousel Alignment", "crocal-extension" ),
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
					"heading" => esc_html__( "Navigation Type", "crocal-extension" ),
					"param_name" => "navigation_type",
					'value' => array(
						esc_html__( 'Style 1' , 'crocal-extension' ) => '1',
						esc_html__( 'No Navigation' , 'crocal-extension' ) => '0',
					),
					"description" => esc_html__( "Select your Navigation type.", "crocal-extension" ),
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'simple-carousel' ) ),
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
					"dependency" => array( 'element' => "carousel_mode", 'value' => array( 'simple-carousel' ) ),
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
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Carousel Pagination Speed", "crocal-extension" ),
					"param_name" => "carousel_pagination_speed",
					"value" => '400',
					"description" => esc_html__( "Pagination Speed in ms.", "crocal-extension" ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Slideshow Speed", "crocal-extension" ),
					"param_name" => "slideshow_speed",
					"value" => '3000',
					"description" => esc_html__( "Slideshow Speed in ms.", "crocal-extension" ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Loop", "crocal-extension" ),
					"param_name" => "loop",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
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
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Pause on Hover", "crocal-extension" ),
					"param_name" => "pause_hover",
					"value" => array( esc_html__( "If selected, carousel will be paused on hover", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Navigation", "crocal-extension" ),
				),
				//Titles & Styles
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Post Title Tag", "crocal-extension" ),
					"param_name" => "post_title_heading_tag",
					"value" => array(
						esc_html__( "h1", "crocal-extension" ) => 'h1',
						esc_html__( "h2", "crocal-extension" ) => 'h2',
						esc_html__( "h3", "crocal-extension" ) => 'h3',
						esc_html__( "h4", "crocal-extension" ) => 'h4',
						esc_html__( "h5", "crocal-extension" ) => 'h5',
						esc_html__( "h6", "crocal-extension" ) => 'h6',
						esc_html__( "div", "crocal-extension" ) => 'div',
					),
					"description" => esc_html__( "Post Title Tag for SEO", "crocal-extension" ),
					"std" => 'h3',
					"group" => esc_html__( "Titles", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Post Title Size/Typography", "crocal-extension" ),
					"param_name" => "post_title_heading",
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
					"description" => esc_html__( "Post Title size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
					"std" => 'h6',
					"group" => esc_html__( "Titles", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Excerpt", "crocal-extension" ),
					"param_name" => "hide_excerpt",
					"description" => esc_html__( "If selected, blog overview will not show excerpt.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Excerpt.", "crocal-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "carousel_style", 'value' => array( '1' ) ),
					"group" => esc_html__( "Titles", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Background Color", "crocal-extension" ),
					"param_name" => "carousel_bg_color",
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
						esc_html__( "Dark Grey", "crocal-extension" ) => 'dark-grey',
					),
					'std' => 'black',
					"description" => esc_html__( "This affects the Background of the item.", "crocal-extension" ),
					"group" => esc_html__( "Titles", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Background Opacity", "crocal-extension" ),
					"param_name" => "carousel_bg_opacity",
					"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
					"std" => '40',
					"description" => esc_html__( "Choose the opacity for the overlay.", "crocal-extension" ),
					"group" => esc_html__( "Titles", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Author", "crocal-extension" ),
					"param_name" => "hide_author",
					"description" => esc_html__( "If selected, blog overview will not show author.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Author.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Date", "crocal-extension" ),
					"param_name" => "hide_date",
					"description" => esc_html__( "If selected, blog overview will not show date.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Date.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Comments", "crocal-extension" ),
					"param_name" => "hide_comments",
					"description" => esc_html__( "If selected, blog overview will not show comments.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Comments.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Like", "crocal-extension" ),
					"param_name" => "hide_like",
					"description" => esc_html__( "If selected, blog overview will not show like.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Like.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Categories", "crocal-extension" ),
					"param_name" => "hide_categories",
					"description" => esc_html__( "If selected, blog overview will not show categories.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Categories.", "crocal-extension" ) => 'yes' ),
					"std" => 'yes',
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),					
				array(
					"type" => "textfield",
					"heading" => esc_html__("Exclude Posts", "crocal-extension" ),
					"param_name" => "exclude_posts",
					"value" => '',
					"description" => esc_html__( "Type the post ids you want to exclude separated by comma ( , ).", "crocal-extension" ),
					"group" => esc_html__( "Categories", "crocal-extension" ),
				),
				array(
					"type" => "crocal_ext_multi_checkbox",
					"heading" => esc_html__("Categories", "crocal-extension" ),
					"param_name" => "categories",
					"value" => crocal_ext_vce_get_post_categories(),
					"description" => esc_html__( "Select all or multiple categories.", "crocal-extension" ),
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
	vc_lean_map( 'crocal_blog_carousel', 'crocal_ext_vce_blog_carousel_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_blog_carousel_shortcode_params( 'crocal_blog_carousel' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
