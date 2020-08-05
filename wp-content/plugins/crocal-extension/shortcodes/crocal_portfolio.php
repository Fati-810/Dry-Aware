<?php
/**
 * Portfolio Shortcode
 */

if( !function_exists( 'crocal_ext_vce_portfolio_shortcode' ) ) {

	function crocal_ext_vce_portfolio_shortcode( $attr, $content ) {

		$portfolio_row_start = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'portfolio_mode' => 'grid',
					'columns_large_screen' => '3',
					'columns' => '3',
					'columns_tablet_landscape' => '2',
					'columns_tablet_portrait' => '2',
					'columns_mobile' => '1',
					'grid_image_mode' => 'landscape',
					'masonry_image_mode' => '',
					'portfolio_link_type' => 'item',
					'image_popup_size' => 'extra-extra-large',
					'portfolio_overview_type' => '',
					'portfolio_filter' => '',
					'filter_style' => 'simple',
					'filter_shape' => 'square',
					'filter_color' => 'primary-1',
					'portfolio_filter_align' => 'left',
					'filter_order_by' => '',
					'filter_order' => 'ASC',
					'filter_gototop' => 'yes',
					'gutter_size' => '30',
					'items_per_page' => '12',
					'display_style' => 'pagination',
					'load_more_title' => 'Load More',
					'hide_portfolio_like' => '',
					'portfolio_title_caption' => 'title-caption',
					'portfolio_title_heading_tag' => 'h3',
					'portfolio_title_heading' => 'h4',
					'portfolio_style' => 'hover-style-1',
					'heading_auto_size' => 'no',
					'content_bg_color' => 'white',
					'zoom_effect' => 'none',
					'grayscale_effect' => 'none',
					'overlay_color' => 'light',
					'overlay_opacity' => '90',
					'order_by' => 'date',
					'order' => 'DESC',
					'animation' => 'eut-zoom-in',
					'margin_bottom' => '',
					'el_class' => '',
					'el_id' => 'default-id',
				),
				$attr
			)
		);
		$el_id = 'el-' . $el_id;


		// Portfolio Clasees
		$portfolio_classes = array( 'eut-element' );
		$data_string = '';
		$data_string .= ' data-display-style="' . esc_attr( $display_style ) . '"';

		switch( $portfolio_mode ) {
			case 'masonry':
				$portfolio_row_start = '<div class="eut-isotope-container">';
				if ( 'popup' == $portfolio_link_type ) {
					$portfolio_row_start = '<div class="eut-isotope-container eut-gallery-popup">';
				}
				$data_string .= ' data-columns="' . esc_attr( $columns ) . '"';
				$data_string .= ' data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '"';
				$data_string .= ' data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '"';
				$data_string .= ' data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '"';
				$data_string .= ' data-columns-mobile="' . esc_attr( $columns_mobile ) . '"';
				$data_string .= ' data-layout="masonry"';
				if ( !empty ( $gutter_size ) ) {
					$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
				}
				if ( !empty ( $gutter_size ) ) {
					array_push( $portfolio_classes, 'eut-with-gap' );
				}
				if ( 'yes' == $heading_auto_size ) {
					array_push( $portfolio_classes, 'eut-auto-headings' );
				}
				array_push( $portfolio_classes, 'eut-portfolio' );
				array_push( $portfolio_classes, 'eut-isotope' );
				break;
			case 'grid':
			default:
				$portfolio_row_start = '<div class="eut-isotope-container">';
				if ( 'popup' == $portfolio_link_type ) {
					$portfolio_row_start = '<div class="eut-isotope-container eut-gallery-popup">';
				}
				$data_string .= ' data-columns="' . esc_attr( $columns ) . '"';
				$data_string .= ' data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '"';
				$data_string .= ' data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '"';
				$data_string .= ' data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '"';
				$data_string .= ' data-columns-mobile="' . esc_attr( $columns_mobile ) . '"';
				$data_string .= ' data-layout="fitRows"';
				if ( !empty ( $gutter_size ) ) {
					$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
				}
				if ( !empty ( $gutter_size ) ) {
					array_push( $portfolio_classes, 'eut-with-gap' );
				}
				array_push( $portfolio_classes, 'eut-portfolio' );
				array_push( $portfolio_classes, 'eut-isotope' );
				break;
		}

		if ( !empty ( $el_class ) ) {
			array_push( $portfolio_classes, $el_class);
		}
		$portfolio_class_string = implode( ' ', $portfolio_classes );

		// Isotope Clasees
		$isotope_inner_item_classes = array( 'eut-isotope-item-inner', 'eut-hover-item' );
		if ( !empty( $animation ) ) {
			array_push( $isotope_inner_item_classes, $animation);
		}
		if( 'none' == $portfolio_title_caption ){
			$portfolio_style = 'hover-style-none';
			array_push( $isotope_inner_item_classes, 'eut-hover-style-none' );
		} else {
			array_push( $isotope_inner_item_classes, 'eut-' . $portfolio_style);
		}
		$isotope_inner_item_class_string = implode( ' ', $isotope_inner_item_classes );

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

		if ( ! empty( $display_style ) ) {
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			}
		}

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
				'posts_per_page' => $items_per_page,
				'orderby' => $order_by,
				'order' => $order,
			);
			$portfolio_filter = 'no';
		} else {
			$args = array(
				'post_type' => 'portfolio',
				'post_status'=>'publish',
				'paged' => $paged,
				'portfolio_category' => $portfolio_cat,
				'post__not_in' => $exclude_ids,
				'posts_per_page' => $items_per_page,
				'orderby' => $order_by,
				'order' => $order,
			);
		}

		$query = new WP_Query( $args );
		ob_start();
		if ( $query->have_posts() ) :
		?>
			<div id="<?php echo esc_attr( $el_id ); ?>" class="<?php echo esc_attr( $portfolio_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo $data_string; ?>>
		<?php

		if ( 'yes' == $portfolio_filter ) {

			$filter_classes = array( 'eut-filter' );

			array_push( $filter_classes, 'eut-filter-style-' . $filter_style );
			array_push( $filter_classes, 'eut-align-' . $portfolio_filter_align);
			array_push( $filter_classes, 'eut-link-text');

			if ( 'button' == $filter_style ) {
				array_push( $filter_classes, 'eut-link-text');
				array_push( $filter_classes, 'eut-filter-shape-' . $filter_shape );
				array_push( $filter_classes, 'eut-filter-color-' . $filter_color );
			}

			$filter_class_string = implode( ' ', $filter_classes );


			$category_prefix = '.portfolio_category-';
			$category_filter_list = array();
			$category_filter_array = array();
			$all_string =  apply_filters( 'crocal_eutf_vce_portfolio_string_all_categories', esc_html__( 'All', 'crocal-extension' ) );
			$category_filter_string = '<li data-filter="*" class="selected"><span>' . esc_html( $all_string ) . '</span></li>';
			$category_filter_add = false;
			while ( $query->have_posts() ) : $query->the_post();

				if ( $portfolio_categories = get_the_terms( get_the_ID(), 'portfolio_category' ) ) {

					foreach($portfolio_categories as $category_term){
						$category_filter_add = false;
						if ( !in_array($category_term->term_id, $category_filter_list) ) {
							if( ! empty( $portfolio_category_ids ) ) {
								if ( in_array($category_term->term_id, $portfolio_category_ids) ) {
									$category_filter_add = true;
								}
							} else {
								$category_filter_add = true;
							}
							if ( $category_filter_add ) {
								$category_filter_list[] = $category_term->term_id;
								if ( 'title' == $filter_order_by ) {
									$category_filter_array[$category_term->name] = $category_term;
								} elseif ( 'slug' == $filter_order_by )  {
									$category_filter_array[$category_term->slug] = $category_term;
								} else {
									$category_filter_array[$category_term->term_id] = $category_term;
								}
							}
						}
					}
				}

			endwhile;


			if ( count( $category_filter_array ) > 1 ) {
				if ( '' != $filter_order_by ) {
					if ( 'ASC' == $filter_order ) {
						ksort( $category_filter_array );
					} else {
						krsort( $category_filter_array );
					}
				}
				foreach($category_filter_array as $category_filter){
					$term_class = sanitize_html_class( $category_filter->slug, $category_filter->term_id );
					if ( is_numeric( $term_class ) || ! trim( $term_class, '-' ) ) {
						$term_class = $category_filter->term_id;
					}

					$category_filter_string .= '<li data-filter="' . $category_prefix . $term_class . '"><span>' . $category_filter->name . '</span></li>';
				}

		?>
				<div class="<?php echo esc_attr( $filter_class_string ); ?>" data-gototop="<?php echo esc_attr( $filter_gototop ); ?>">
					<ul>
						<?php echo $category_filter_string; ?>
					</ul>
				</div>
		<?php
			}
		}
		?>

			<?php echo $portfolio_row_start; ?>

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

			$image_size = 'crocal-eutf-small-square';
			$portfolio_extra_class = 'eut-isotope-item eut-portfolio-item ';

			if ( 'masonry' == $portfolio_mode ) {
				//Masonry
				if ( 'resize' == $masonry_image_mode || 'large' == $masonry_image_mode ) {
					$portfolio_extra_class .= 'eut-image-square';
					$image_size = 'large';
				} elseif( 'medium_large' == $masonry_image_mode ) {
					$portfolio_extra_class .= 'eut-image-square';
					$image_size = 'medium_large';
				} elseif( 'medium' == $masonry_image_mode ) {
					$portfolio_extra_class .= 'eut-image-square';
					$image_size = 'medium';
				} elseif( 'custom' == $masonry_image_mode ) {
					$masonry_size = get_post_meta( get_the_ID(), '_crocal_eutf_portfolio_media_masonry_size', true );
					$eut_masonry_data = crocal_ext_vce_get_custom_masonry_data( $masonry_size );
					$portfolio_extra_class .= $eut_masonry_data['class'];
					$image_size = $eut_masonry_data['image_size'];
				} else {
					$eut_masonry_data = crocal_ext_vce_get_masonry_data( $portfolio_index, $columns );
					$portfolio_extra_class .= $eut_masonry_data['class'];
					$image_size = $eut_masonry_data['image_size'];
				}
			} else {
				$image_size = crocal_ext_vce_get_image_size( $grid_image_mode );
			}


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
					<article id="portfolio-<?php the_ID(); ?><?php echo uniqid('-'); ?>" <?php post_class( $portfolio_extra_class ); ?>>
						<div class="<?php echo esc_attr( $isotope_inner_item_class_string ); ?>">
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
<?php
		endwhile;
?>
				</div>
<?php
			if ( ! empty( $display_style ) ) {
				$total = $query->max_num_pages;
				$big = 999999999; // need an unlikely integer
				if( $total > 1 )  {
					if( 'infinite-scroll' == $display_style || 'load-more' == $display_style ){
						echo '<div class="eut-infinite-pagination">';
					} else {
						echo '<div class="eut-pagination eut-pagination-text eut-heading-color">';
					}

					 if( get_option('permalink_structure') ) {
						 $format = 'page/%#%/';
					 } else {
						 $format = '&paged=%#%';
					 }
					 echo paginate_links(array(
						'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'		=> $format,
						'current'		=> max( 1, $paged ),
						'total'			=> $total,
						'mid_size'		=> 2,
						'type'			=> 'list',
						'prev_text'	=> '<i class="eut-icon-nav-left"></i>',
						'next_text'	=> '<i class="eut-icon-nav-right"></i>',
						'add_args' => false,
					 ));
					 echo '</div>';

					if( 'infinite-scroll' == $display_style ){
					echo '<div class="eut-infinite-page-load">
							<div class="eut-loader-ellips">
								<span class="eut-loader-ellips-dot"></span>
								<span class="eut-loader-ellips-dot"></span>
								<span class="eut-loader-ellips-dot"></span>
								<span class="eut-loader-ellips-dot"></span>
							</div>
						</div>';
					}
					if ( 'load-more' == $display_style ) {
						echo '<div class="eut-infinite-button-wrapper">
							    <div class="eut-infinite-button eut-link-text">' . esc_html( $load_more_title ) . '
							    	<div class="eut-infinite-page-load eut-infinite-spinner">
										<div class="eut-bounce1"></div>
										<div class="eut-bounce2"></div>
										<div class="eut-bounce3"></div>
									</div>
								</div>
							</div>';
					}
				}
			}
?>
	</div>
		<?php

		else :
		endif;
		wp_reset_postdata();

		return ob_get_clean();

	}
	add_shortcode( 'crocal_portfolio', 'crocal_ext_vce_portfolio_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_portfolio_shortcode_params' ) ) {
	function crocal_ext_vce_portfolio_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Portfolio", "crocal-extension" ),
			"description" => esc_html__( "Display Portfolio element in multiple styles", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-portfolio",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Portfolio Mode", "crocal-extension" ),
					"param_name" => "portfolio_mode",
					"admin_label" => true,
					'value' => array(
						esc_html__( 'Grid' , 'crocal-extension' ) => 'grid',
						esc_html__( 'Masonry' , 'crocal-extension' ) => 'masonry',
					),
					"description" => esc_html__( "Select your portfolio mode", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Grid Image Size", "crocal-extension" ),
					"param_name" => "grid_image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Square Small Crop', 'crocal-extension' ) => 'square',
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Landscape Medium Crop', 'crocal-extension' ) => 'landscape-medium',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
						esc_html__( 'Portrait Medium Crop', 'crocal-extension' ) => 'portrait-medium',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
					) ),
					'std' => 'landscape',
					"description" => esc_html__( "Select your Grid Image Size.", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_mode", 'value' => array( 'grid' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Masonry Image Size", "crocal-extension" ),
					"param_name" => "masonry_image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Auto Crop', 'crocal-extension' ) => '',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
						esc_html__( 'Custom', 'crocal-extension' ) => 'custom',
					) ),
					"description" => esc_html__( "Select your Masonry Image Size.", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_mode", 'value' => array( 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Large Screen Columns", "crocal-extension" ),
					"param_name" => "columns_large_screen",
					"value" => array( '1', '2', '3', '4', '5', '6' ),
					"std" => '3',
					"description" => esc_html__( "Select your Portfolio Columns.", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_mode", 'value' => array( 'grid', 'masonry' ) ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Columns", "crocal-extension" ),
					"param_name" => "columns",
					"value" => array( '1', '2', '3', '4', '5', '6' ),
					"std" => '3',
					"description" => esc_html__( "Select your Portfolio Columns.", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_mode", 'value' => array( 'grid', 'masonry' ) ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Landscape Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_landscape",
					"value" => array( '1', '2', '3', '4', '5', '6' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, landscape orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_mode", 'value' => array( 'grid', 'masonry' ) ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Portrait Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_portrait",
					"value" => array( '1', '2', '3', '4', '5', '6' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, portrait orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_mode", 'value' => array( 'grid', 'masonry' ) ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Mobile Columns", "crocal-extension" ),
					"param_name" => "columns_mobile",
					"value" => array( '1', '2', '3' ),
					"std" => '1',
					"description" => esc_html__( "Select responsive column on mobile devices.", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_mode", 'value' => array( 'grid', 'masonry' ) ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Gutter between items", "crocal-extension" ),
					"param_name" => "gutter_size",
					"value" => '30',
					"description" => esc_html__( "Leave this field blank or set it to 0 to collapse items.", "crocal-extension" ),
				),
				crocal_ext_vce_add_order_by(),
				crocal_ext_vce_add_order(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "CSS Animation", "crocal-extension"),
					"param_name" => "animation",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Fade In", "crocal-extension" ) => "eut-fade-in",
						esc_html__( "Fade In Up", "crocal-extension" ) => "eut-fade-in-up",
						esc_html__( "Fade In Down", "crocal-extension" ) => "eut-fade-in-down",
						esc_html__( "Fade In Left", "crocal-extension" ) => "eut-fade-in-left",
						esc_html__( "Fade In Right", "crocal-extension" ) => "eut-fade-in-right",
						esc_html__( "Zoom In", "crocal-extension" ) => "eut-zoom-in",
					),
					"dependency" => array( 'element' => "portfolio_mode", 'value' => array( 'grid', 'masonry' ) ),
					"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "crocal-extension" ),
					"std" => "eut-zoom-in",
				),
				crocal_ext_vce_add_margin_bottom(),
				array(
					"type" => "el_id",
					"heading" => esc_html__( "Element ID", "crocal-extension" ),
					'description' => esc_html__( "Enter element ID (Note: make sure it is unique)", "crocal-extension" ),
					"param_name" => "el_id",
					'settings' => array(
						'auto_generate' => true,
					),
				),
				crocal_ext_vce_add_el_class(),
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
					'edit_field_class' => 'vc_col-sm-6',
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
					"std" => 'h4',
					"dependency" => array( 'element' => "portfolio_title_caption", 'value' => array( 'title-caption', 'title-only' ) ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
					'edit_field_class' => 'vc_col-sm-6',
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
					"heading" => esc_html__( "Title/Description Auto Resize", "crocal-extension" ),
					"param_name" => "heading_auto_size",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => 'no',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"description" => esc_html__( "If selected title/description will be automatically resized according to media width", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_mode", 'value' => array( 'masonry' ) ),
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
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
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
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
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
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Items per page", "crocal-extension" ),
					"param_name" => "items_per_page",
					"value" => '12',
					"description" => esc_html__( "Enter how many items per page you want to display.", "crocal-extension" ),
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Display Style", "crocal-extension" ),
					"param_name" => "display_style",
					"value" => array(
						esc_html__( "Show All", "crocal-extension" ) => '',
						esc_html__( "Pagination", "crocal-extension" ) => 'pagination',
						esc_html__( "Load More", "crocal-extension" ) => 'load-more',
						esc_html__( "Infinite Scroll", "crocal-extension" ) => 'infinite-scroll',
					),
					"std" => 'pagination',
					"description" => esc_html__( "Select display style", "crocal-extension" ),
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Load More Title", "crocal-extension" ),
					"param_name" => "load_more_title",
					"value" => 'Load More',
					"description" => esc_html__( "Title for load more.", "crocal-extension" ),
					"dependency" => array( 'element' => "display_style", 'value' => array( 'load-more' ) ),
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Filter", "crocal-extension" ),
					"param_name" => "portfolio_filter",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"description" => esc_html__( "If selected, an isotope filter will be displayed.", "crocal-extension" ) . " " . esc_html__( "Enable Portfolio Filter ( Only for All or Multiple Categories )", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_mode", 'value' => array( 'grid', 'masonry' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Order By", "crocal-extension" ),
					"param_name" => "filter_order_by",
					"value" => array(
						esc_html__( "Default ( Unordered )", "crocal-extension" ) => '',
						esc_html__( "ID", "crocal-extension" ) => 'id',
						esc_html__( "Slug", "crocal-extension" ) => 'slug',
						esc_html__( "Title", "crocal-extension" ) => 'title',
					),
					"description" => '',
					"dependency" => array( 'element' => "portfolio_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Order", "crocal-extension" ),
					"param_name" => "filter_order",
					"value" => array(
						esc_html__( "Ascending", "crocal-extension" ) => 'ASC',
						esc_html__( "Descending", "crocal-extension" ) => 'DESC',
					),
					"dependency" => array( 'element' => "portfolio_filter", 'value' => array( 'yes' ) ),
					"description" => '',
					"group" => esc_html__( "Filters", "crocal-extension" ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Style", "crocal-extension" ),
					"param_name" => "filter_style",
					"value" => array(
						esc_html__( "Simple", "crocal-extension" ) => 'simple',
						esc_html__( "Button", "crocal-extension" ) => 'button',

					),
					"dependency" => array( 'element' => "portfolio_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Shape", "crocal-extension" ),
					"param_name" => "filter_shape",
					"value" => array(
						esc_html__( "Square", "crocal-extension" ) => 'square',
						esc_html__( "Round", "crocal-extension" ) => 'round',
						esc_html__( "Extra Round", "crocal-extension" ) => 'extra-round',
					),
					"dependency" => array( 'element' => "filter_style", 'value' => array( 'button' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Color", "crocal-extension" ),
					"param_name" => "filter_color",
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
					"dependency" => array( 'element' => "filter_style", 'value' => array( 'button' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Alignment", "crocal-extension" ),
					"param_name" => "portfolio_filter_align",
					"value" => array(
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
						esc_html__( "Center", "crocal-extension" ) => 'center',
					),
					"description" => '',
					"dependency" => array( 'element' => "portfolio_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Filter Go To Top", "crocal-extension" ),
					"param_name" => "filter_gototop",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"std" => "yes",
					"description" => esc_html__( "Animate to the top of the filter after clicking ( Excludes Infinite Scroll and Load more ).", "crocal-extension" ),
					"dependency" => array( 'element' => "portfolio_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
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
	vc_lean_map( 'crocal_portfolio', 'crocal_ext_vce_portfolio_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_portfolio_shortcode_params( 'crocal_portfolio' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
