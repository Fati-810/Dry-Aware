<?php
/**
 * Portfolio Carousel Shortcode
 */

if( !function_exists( 'crocal_ext_vce_portfolio_carousel_shortcode' ) ) {

	function crocal_ext_vce_portfolio_carousel_shortcode( $attr, $content ) {

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
					'portfolio_link_type' => 'item',
					'image_popup_size' => 'extra-extra-large',
					'portfolio_overview_type' => '',
					'item_gutter' => 'yes',
					'gutter_size' => '30',
					'items_per_page' => '4',
					'items_tablet_landscape' => '3',
					'items_tablet_portrait' => '3',
					'items_mobile' => '1',
					'items_to_show' => '12',
					'hide_portfolio_like' => '',
					'portfolio_title_caption' => 'title-caption',
					'portfolio_title_heading_tag' => 'h3',
					'portfolio_title_heading' => 'h6',
					'heading_auto_size' => 'no',
					'portfolio_style' => 'hover-style-1',
					'content_bg_color' => 'white',
					'zoom_effect' => 'none',
					'grayscale_effect' => 'none',
					'overlay_color' => 'light',
					'overlay_opacity' => '90',
					'order_by' => 'date',
					'order' => 'DESC',
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
		$data_string .= ' data-slider-loop="' . esc_attr( $loop ) . '"';
		if ( 'yes' == $item_gutter ) {
			$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
		}

		// Portfolio Classes
		$portfolio_classes = array( 'eut-element' );
		array_push( $portfolio_classes, 'eut-carousel' );
		array_push( $portfolio_classes, 'eut-' . $carousel_layout );
		if ( 'popup' == $portfolio_link_type ) {
			array_push( $portfolio_classes, 'eut-gallery-popup' );
		}
		if ( 'yes' == $item_gutter ) {
			array_push( $portfolio_classes, 'eut-with-gap' );
		}
		if ( !empty ( $el_class ) ) {
			array_push( $portfolio_classes, $el_class);
		}
		$portfolio_class_string = implode( ' ', $portfolio_classes );

		// Image Effect
		$image_effect_classes = array( 'eut-image-hover', 'eut-media' );
		if ( 'none' != $zoom_effect ) {
			array_push( $image_effect_classes, 'eut-zoom-' . $zoom_effect );
		}
		if ( 'none' != $grayscale_effect ) {
			array_push( $image_effect_classes, 'eut-' . $grayscale_effect );
		}
		$image_effect_class_string = implode( ' ', $image_effect_classes );

		$image_popup_size_mode = 'extra-extra-large';
		if ( 'popup' == $portfolio_link_type ) {
			$image_popup_size_mode = crocal_ext_vce_get_image_size( $image_popup_size );
		}

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$portfolio_cat = "";
		$portfolio_category_ids = array();

		if( ! empty( $categories ) ) {
			$portfolio_category_ids = explode( ",", $categories );
			foreach ( $portfolio_category_ids as $category_id ) {
				$category_term = get_term( $category_id, 'portfolio_category' );
				if ( isset( $category_term) ) {
					$portfolio_cat = $portfolio_cat.$category_term->slug . ', ';
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
				'post_type' => 'portfolio',
				'post_status'=>'publish',
				'paged' => $paged,
				'post__in' => $include_ids,
				'posts_per_page' => $items_to_show,
				'orderby' => $order_by,
				'order' => $order,
			);
		} else {
			$args = array(
				'post_type' => 'portfolio',
				'post_status'=>'publish',
				'paged' => $paged,
				'portfolio_category' => $portfolio_cat,
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
			<div class="<?php echo esc_attr( $portfolio_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>">
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
			<div class="eut-carousel-element eut-portfolio owl-carousel"<?php echo $data_string; ?>>
<?php


		$portfolio_index = 0;

		while ( $query->have_posts() ) : $query->the_post();
			$image_size = 'crocal-eutf-small-rect-horizontal';
			$portfolio_index++;
			$portfolio_extra_class = '';

			$caption = get_post_meta( get_the_ID(), '_crocal_eutf_description', true );
			$link_mode = get_post_meta( get_the_ID(), '_crocal_eutf_portfolio_link_mode', true );
			$link_url = get_post_meta( get_the_ID(), '_crocal_eutf_portfolio_link_url', true );
			$new_window = get_post_meta( get_the_ID(), '_crocal_eutf_portfolio_link_new_window', true );
			$link_class = get_post_meta( get_the_ID(), '_crocal_eutf_portfolio_link_extra_class', true );

			//Check Title and Caption
			$show_title = $show_caption = $show_title_or_caption = 'no';
			if ( 'none' != $portfolio_title_caption && 'caption-only' != $portfolio_title_caption ) {
				$show_title = $show_title_or_caption = 'yes';
			}
			if ( !empty( $caption ) && 'none' != $portfolio_title_caption && 'title-only' != $portfolio_title_caption ) {
				$show_caption = $show_title_or_caption = 'yes';
			}

			if( 'no' == $show_title_or_caption ){
				$portfolio_style = 'hover-style-none';
			}

			$image_size = crocal_ext_vce_get_image_size( $carousel_image_mode );
			$portfolio_extra_class = 'eut-portfolio-item';

			// Hide Portfolio Like
			if( 'hover-style-1' == $portfolio_style || 'hover-style-4' == $portfolio_style || 'hover-style-5' == $portfolio_style || 'hover-style-6' == $portfolio_style ){
				$hide_portfolio_like = 'yes';
			}

			//Portfolio Link
			$portfolio_link_exists = true;
			$eut_target = '_self';
			if( !empty( $new_window ) ) {
				$eut_target = '_blank';
			}

			ob_start();

			if ( 'popup' == $portfolio_link_type ) {
			?><a class="eut-item-url" href="<?php crocal_ext_vce_print_portfolio_image( $image_popup_size_mode, 'link' ); ?>"><?php
			}  else if ( 'custom-link' == $portfolio_link_type ) {
				if ( '' == $link_mode )	{
			?><a class="eut-item-url" href="<?php echo esc_url( get_permalink() ); ?>"><?php
				} else if ( 'link' == $link_mode && !empty( $link_url ) ) {
			?><a class="eut-item-url <?php echo esc_attr( $link_class ); ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $eut_target ); ?>"><?php
				} else {
					$portfolio_link_exists = false;
				}
			} else {
			?><a class="eut-item-url" href="<?php echo esc_url( get_permalink() ); ?>"><?php
			}

			$link_start = ob_get_clean();

			if ( $portfolio_link_exists ) {
				$link_end = '</a>';
			} else {
				$link_end = '';
			}

			// Portfolio Content Classes
			$portfolio_content_classes = array( 'eut-content' );
			if ( 'yes' == $show_title_or_caption ) {
				if( 'hover-style-7' == $portfolio_style ){
					array_push( $portfolio_content_classes, 'eut-align-left');
				} else {
					array_push( $portfolio_content_classes, 'eut-align-center');
				}
				if( 'hover-style-4' == $portfolio_style || 'hover-style-5' == $portfolio_style || 'hover-style-7' == $portfolio_style ){
					array_push( $portfolio_content_classes, 'eut-box-item eut-bg-' . $content_bg_color );
				}
			}
			$portfolio_content_class_string = implode( ' ', $portfolio_content_classes );

			//Portfolio Title & Caption Color
			$text_color = 'white';
			$title_color = 'white';
			if( 'hover-style-1' == $portfolio_style ){
				$text_color = 'inherit';
				$title_color = 'inherit';
			} elseif( 'hover-style-2' == $portfolio_style || 'hover-style-3' == $portfolio_style ){
				if( 'light' == $overlay_color ) {
					$text_color = 'content';
					$title_color = 'black';
				}
			}
			if( 'hover-style-4' == $portfolio_style || 'hover-style-5' == $portfolio_style || 'hover-style-7' == $portfolio_style ){
				$text_color = 'inherit';
				if( 'white' == $content_bg_color ){
					$title_color = 'black';
				} else {
					$title_color = 'white';
				}
			}

			//Portfolio Custom Overview
			if ( 'custom-overview' == $portfolio_overview_type ) {
				$overview_mode = get_post_meta( get_the_ID(), '_crocal_eutf_portfolio_overview_mode', true );
				$overview_text = get_post_meta( get_the_ID(), '_crocal_eutf_portfolio_overview_text', true );
				$overview_text_heading = get_post_meta( get_the_ID(), '_crocal_eutf_portfolio_overview_text_heading', true );
				$overview_bg_color = 'none';
				if ( 'color' == $overview_mode ) {
					$overview_color = get_post_meta( get_the_ID(), '_crocal_eutf_portfolio_overview_color', true );
					if ( empty( $overview_color ) ) {
						$overview_color = 'black';
					}
					$overview_bg_color = get_post_meta( get_the_ID(), '_crocal_eutf_portfolio_overview_bg_color', true );
					if ( empty( $overview_bg_color ) ) {
						$overview_bg_color = 'primary-1';
					}
					if ( empty( $overview_text_heading ) ) {
						$overview_text_heading = 'h3';
					}
					$portfolio_extra_class .= ' eut-bg-overview';
				}
			} else {
				$overview_bg_color = 'none';
				$overview_mode = '';
			}

			$image_atts = array( 'data-column-space' => '100' );

?>

				<div class="eut-carousel-item">
					<article id="portfolio-<?php the_ID(); ?><?php echo uniqid('-'); ?>" <?php post_class( $portfolio_extra_class ); ?>>
						<div class="eut-carousel-item eut-hover-item eut-<?php echo esc_attr( $portfolio_style ); ?>">
						<?php
							if ( 'color' != $overview_mode ) {
								if ( 'hover-style-1' == $portfolio_style ) {
							?>
									<figure class="<?php echo esc_attr( $image_effect_class_string ); ?>">
										<?php echo $link_start . $link_end; ?>
										<div class="eut-bg-<?php echo esc_attr( $overlay_color ); ?> eut-hover-overlay eut-opacity-<?php echo esc_attr( $overlay_opacity ); ?>"></div>
										<?php crocal_ext_vce_print_portfolio_image( $image_size, '', $image_atts ); ?>
										<figcaption></figcaption>
									</figure>
									<?php if( 'yes' == $show_title_or_caption ) { ?>
									<div class="<?php echo esc_attr( $portfolio_content_class_string ); ?>">
										<?php if( 'yes' == $show_title ) { ?>
										<<?php echo tag_escape( $portfolio_title_heading_tag ); ?> class="eut-title eut-text-<?php echo esc_attr( $title_color ); ?> eut-<?php echo esc_attr( $portfolio_title_heading ); ?>"><?php the_title(); ?></<?php echo tag_escape( $portfolio_title_heading_tag ); ?>>
										<?php } ?>
										<?php if( 'yes' == $show_caption ) { ?>
										<div class="eut-description eut-text-content"><?php echo wp_kses_post( $caption ); ?></div>
										<?php } ?>
									</div>
									<?php } ?>
							<?php
								} else {
							?>
									<figure class="<?php echo esc_attr( $image_effect_class_string ); ?>">
										<?php echo $link_start . $link_end; ?>
										<?php if ( 'hover-style-6' != $portfolio_style ) { ?>
											<div class="eut-bg-<?php echo esc_attr( $overlay_color ); ?> eut-hover-overlay eut-opacity-<?php echo esc_attr( $overlay_opacity ); ?>"></div>
										<?php } else { ?>
											<div class="eut-gradient-overlay eut-gradient-<?php echo esc_attr( $overlay_color ); ?> eut-gradient-opacity-<?php echo esc_attr( $overlay_opacity ); ?> "></div>
										<?php } ?>
										<?php crocal_ext_vce_print_portfolio_image( $image_size, '', $image_atts ); ?>
										<?php if( 'yes' == $show_title_or_caption ) { ?>
										<figcaption class="<?php echo esc_attr( $portfolio_content_class_string ); ?>">
											<?php if( 'yes' == $show_title ) { ?>
											<<?php echo tag_escape( $portfolio_title_heading_tag ); ?> class="eut-title eut-text-<?php echo esc_attr( $title_color ); ?> eut-<?php echo esc_attr( $portfolio_title_heading ); ?>"><?php the_title(); ?></<?php echo tag_escape( $portfolio_title_heading_tag ); ?>>
											<?php } ?>
											<?php if( 'yes' == $show_caption ) { ?>
											<div class="eut-description eut-small-text eut-text-<?php echo esc_attr( $text_color ); ?>"><?php echo wp_kses_post( $caption ); ?></div>
											<?php } ?>
											<?php
												if( function_exists( 'crocal_eutf_print_portfolio_like_counter' ) && 'yes' != $hide_portfolio_like ) {
													crocal_eutf_print_portfolio_like_counter( $text_color );
												}
											?>
										</figcaption>
										<?php } else { ?>
										<figcaption></figcaption>
										<?php } ?>
									</figure>
							<?php
								}
							} else {
							?>
								<figure class="eut-image-hover eut-media eut-bg-<?php echo esc_attr( $overview_bg_color ); ?>">
									<?php echo $link_start . $link_end; ?>
									<?php crocal_ext_vce_print_portfolio_image( $image_size, '', $image_atts ); ?>
									<?php if( 'yes' == $show_title_or_caption ) { ?>
									<figcaption class="eut-content eut-align-center eut-custom-overview">
										<?php if( 'yes' == $show_title ) { ?>
										<<?php echo tag_escape( $portfolio_title_heading_tag ); ?> class="eut-title eut-text-<?php echo esc_attr( $overview_color ); ?> eut-<?php echo esc_attr( $overview_text_heading ); ?>"><?php the_title(); ?></<?php echo tag_escape( $portfolio_title_heading_tag ); ?>>
										<?php } ?>
										<?php if( !empty( $overview_text) ) { ?>
										<div class="eut-description eut-text-<?php echo esc_attr( $overview_color ); ?>"><?php echo wp_kses_post( $overview_text ); ?></div>
										<?php } ?>
									</figcaption>
									<?php } else { ?>
									<figcaption></figcaption>
									<?php } ?>
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
	add_shortcode( 'crocal_portfolio_carousel', 'crocal_ext_vce_portfolio_carousel_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_portfolio_carousel_shortcode_params' ) ) {
	function crocal_ext_vce_portfolio_carousel_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Portfolio Carousel", "crocal-extension" ),
			"description" => esc_html__( "Display Portfolio Carousel", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-portfolio",
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
					"value" => '30',
					"dependency" => array( 'element' => "item_gutter", 'value' => array( 'yes' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Items to show", "crocal-extension" ),
					"param_name" => "items_to_show",
					"value" => '12',
					"description" => esc_html__( "Maximum Portfolio Items to Show", "crocal-extension" ),
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
					"type" => "textfield",
					"heading" => esc_html__( "Slideshow Speed", "crocal-extension" ),
					"param_name" => "slideshow_speed",
					"value" => '3000',
					"description" => esc_html__( "Slideshow Speed in ms.", "crocal-extension" ),
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
				// Titles and Hovers
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Title & Description Visibility", "crocal-extension" ),
					"param_name" => "portfolio_title_caption",
					'value' => array(
						esc_html__( 'None' , 'crocal-extension' ) => 'none',
						esc_html__( 'Title and Description' , 'crocal-extension' ) => 'title-caption',
						esc_html__( 'Title Only' , 'crocal-extension' ) => 'title-only',
						esc_html__( 'Description Only' , 'crocal-extension' ) => 'caption-only',
					),
					"std" => 'title-caption',
					"description" => esc_html__( "Define the visibility for your portfolio title - description.", "crocal-extension" ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Portfolio Title Tag", "crocal-extension" ),
					"param_name" => "portfolio_title_heading_tag",
					"value" => array(
						esc_html__( "h1", "crocal-extension" ) => 'h1',
						esc_html__( "h2", "crocal-extension" ) => 'h2',
						esc_html__( "h3", "crocal-extension" ) => 'h3',
						esc_html__( "h4", "crocal-extension" ) => 'h4',
						esc_html__( "h5", "crocal-extension" ) => 'h5',
						esc_html__( "h6", "crocal-extension" ) => 'h6',
						esc_html__( "div", "crocal-extension" ) => 'div',
					),
					"description" => esc_html__( "Portfolio Title Tag for SEO", "crocal-extension" ),
					"std" => 'h3',
					"dependency" => array( 'element' => "portfolio_title_caption", 'value' => array( 'title-caption', 'title-only' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Portfolio Title Size/Typography", "crocal-extension" ),
					"param_name" => "portfolio_title_heading",
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
					"description" => esc_html__( "Portfolio Title size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
					"std" => 'h6',
					"dependency" => array( 'element' => "portfolio_title_caption", 'value' => array( 'title-caption', 'title-only' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Portfolio Style - Hovers", "crocal-extension" ),
					"param_name" => "portfolio_style",
					'value' => array(
						esc_html__( 'Content Below Image' , 'crocal-extension' ) => 'hover-style-1',
						esc_html__( 'Top Down Animated Content' , 'crocal-extension' ) => 'hover-style-2',
						esc_html__( 'Left Right Animated Content' , 'crocal-extension' ) => 'hover-style-3',
						esc_html__( 'Static Box Content' , 'crocal-extension' ) => 'hover-style-4',
						esc_html__( 'Animated Box Content' , 'crocal-extension' ) => 'hover-style-5',
						esc_html__( 'Gradient Overlay' , 'crocal-extension' ) => 'hover-style-6',
						esc_html__( 'Animated Right Corner Box Content' , 'crocal-extension' ) => 'hover-style-7',
					),
					"description" => esc_html__( "Select the hover style for the portfolio overview.", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_title_caption", 'value' => array( 'title-caption', 'title-only', 'caption-only' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Portfolio Likes", "crocal-extension" ),
					"param_name" => "hide_portfolio_like",
					"value" => array( esc_html__( "If selected, portfolio likes will be hidden", "crocal-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "portfolio_style", 'value' => array( 'hover-style-2', 'hover-style-3', 'hover-style-7' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Content Background Color", "crocal-extension" ),
					"param_name" => "content_bg_color",
					'value' => array(
						esc_html__( 'White' , 'crocal-extension' ) => 'white',
						esc_html__( 'Black' , 'crocal-extension' ) => 'black',
					),
					"description" => esc_html__( "Select the background color for portfolio item content.", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_style", 'value' => array( 'hover-style-4', 'hover-style-5', 'hover-style-7' ) ),
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
						esc_html__( "Green", "crocal-extension" ) => 'green',
						esc_html__( "Orange", "crocal-extension" ) => 'orange',
						esc_html__( "Red", "crocal-extension" ) => 'red',
						esc_html__( "Blue", "crocal-extension" ) => 'blue',
						esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
						esc_html__( "Purple", "crocal-extension" ) => 'purple',
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
					"type" => "dropdown",
					"heading" => esc_html__( "Link Type", "crocal-extension" ),
					"param_name" => "portfolio_link_type",
					'value' => array(
						esc_html__( 'Classic Portfolio' , 'crocal-extension' ) => 'item',
						esc_html__( 'Gallery Usage' , 'crocal-extension' ) => 'popup',
						esc_html__( 'Custom Link' , 'crocal-extension' ) => 'custom-link',
					),
					"description" => esc_html__( "Select the link type of your portfolio items.", "crocal-extension" ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Popup Size", "crocal-extension" ),
					"param_name" => "image_popup_size",
					'value' => array(
						esc_html__( 'Large' , 'crocal-extension' ) => 'large',
						esc_html__( 'Extra Extra Large' , 'crocal-extension' ) => 'extra-extra-large',
						esc_html__( 'Full' , 'crocal-extension' ) => 'full',
					),
					"std" => 'extra-extra-large',
					"dependency" => array( 'element' => "portfolio_link_type", 'value' => array( 'popup' ) ),
					"description" => esc_html__( "Select size for your popup image.", "crocal-extension" ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Overview Type", "crocal-extension" ),
					"param_name" => "portfolio_overview_type",
					'value' => array(
						esc_html__( 'Default' , 'crocal-extension' ) => '',
						esc_html__( 'Custom Overview' , 'crocal-extension' ) => 'custom-overview',
					),
					"dependency" => array( 'element' => "portfolio_style", 'value' => array( 'hover-style-2', 'hover-style-3', 'hover-style-4', 'hover-style-5', 'hover-style-6', 'hover-style-7' ) ),
					"description" => esc_html__( "Select the overview type of your portfolio items.", "crocal-extension" ),
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
					"heading" => __("Portfolio Categories", "crocal-extension" ),
					"param_name" => "categories",
					"value" => crocal_ext_vce_get_portfolio_categories(),
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
	vc_lean_map( 'crocal_portfolio_carousel', 'crocal_ext_vce_portfolio_carousel_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_portfolio_carousel_shortcode_params( 'crocal_portfolio_carousel' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
