<?php
/**
 * Product Shortcode
 */

if( !function_exists( 'crocal_ext_vce_products_shortcode' ) ) {

	function crocal_ext_vce_products_shortcode( $attr, $content ) {

		$product_row_start = $class_fullwidth = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'product_mode' => 'grid',
					'columns_large_screen' => '3',
					'columns' => '3',
					'columns_tablet_landscape' => '2',
					'columns_tablet_portrait' => '2',
					'columns_mobile' => '1',
					'grid_image_mode' => 'landscape',
					'masonry_image_mode' => 'large',
					'product_filter' => '',
					'filter_style' => 'simple',
					'filter_shape' => 'square',
					'filter_color' => 'primary-1',
					'product_filter_align' => 'left',
					'filter_order_by' => '',
					'filter_order' => 'ASC',
					'filter_gototop' => 'yes',
					'item_gutter' => 'yes',
					'gutter_size' => '30',
					'items_per_page' => '12',
					'display_style' => 'pagination',
					'load_more_title' => 'Load More',
					'shadow' => '',
					'radius' => '',
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
					'animation' => 'eut-zoom-in',
					'margin_bottom' => '',
					'el_class' => '',
					'el_id' => 'default-id',
				),
				$attr
			)
		);
		$el_id = 'el-' . $el_id;

		$product_classes = array( 'eut-element' );

		$data_string = '';
		$data_string .= ' data-display-style="' . esc_attr( $display_style ) . '"';

		switch( $product_mode ) {
			case 'masonry':
				$product_row_start = '<div class="eut-isotope-container">';
				$data_string .= ' data-columns="' . esc_attr( $columns ) . '"';
				$data_string .= ' data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '"';
				$data_string .= ' data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '"';
				$data_string .= ' data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '"';
				$data_string .= ' data-columns-mobile="' . esc_attr( $columns_mobile ) . '"';
				$data_string .= ' data-layout="masonry"';
				if ( 'yes' == $item_gutter ) {
					$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
				}
				if ( 'yes' == $item_gutter ) {
					array_push( $product_classes, 'eut-with-gap' );
				}
				array_push( $product_classes, 'eut-product' );
				array_push( $product_classes, 'eut-isotope' );
				break;
			case 'grid':
			default:
				$product_row_start = '<div class="eut-isotope-container">';
				$data_string .= ' data-columns="' . esc_attr( $columns ) . '"';
				$data_string .= ' data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '"';
				$data_string .= ' data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '"';
				$data_string .= ' data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '"';
				$data_string .= ' data-columns-mobile="' . esc_attr( $columns_mobile ) . '"';
				$data_string .= ' data-layout="fitRows"';
				if ( 'yes' == $item_gutter ) {
					$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
				}
				if ( 'yes' == $item_gutter ) {
					array_push( $product_classes, 'eut-with-gap' );
				}
				array_push( $product_classes, 'eut-product' );
				array_push( $product_classes, 'eut-isotope' );
				break;
		}

		$isotope_inner_item_classes = array( 'eut-isotope-item-inner', 'eut-hover-item' );

		if ( !empty( $animation ) ) {
			array_push( $isotope_inner_item_classes, $animation);
		}

		array_push( $isotope_inner_item_classes, 'eut-product-' . $product_style);

		$isotope_inner_item_class_string = implode( ' ', $isotope_inner_item_classes );

		// Image Effect
		$image_effect_classes = array( 'eut-image-hover' );
		if ( 'none' != $zoom_effect ) {
			array_push( $image_effect_classes, 'eut-zoom-' . $zoom_effect );
		}
		if ( 'none' != $grayscale_effect ) {
			array_push( $image_effect_classes, 'eut-' . $grayscale_effect );
		}

		if( 'hover-style-2' == $product_style ){
			if ( 'light' == $overlay_color ) {
				array_push( $image_effect_classes, 'eut-text-black' );
			} else {
				array_push( $image_effect_classes, 'eut-text-white' );
			}
			if ( !empty( $radius ) ) {
				array_push( $image_effect_classes, 'eut-' . $radius);
			}

			if ( !empty( $shadow ) ) {
				array_push( $image_effect_classes, 'eut-' . $shadow);
			}
		}

		$image_effect_class_string = implode( ' ', $image_effect_classes );


		// Media Classes
		$media_classes = array( 'eut-media' );
		if( 'hover-style-1' == $product_style ){
			if ( !empty( $radius ) ) {
				array_push( $media_classes, 'eut-' . $radius);
			}

			if ( !empty( $shadow ) ) {
				array_push( $media_classes, 'eut-' . $shadow);
			}
		}
		$media_class_string = implode( ' ', $media_classes );


		if ( !empty ( $el_class ) ) {
			array_push( $product_classes, $el_class);
		}
		$product_class_string = implode( ' ', $product_classes );

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
				'post_type' => 'product',
				'post_status'=>'publish',
				'paged' => $paged,
				'post__in' => $include_ids,
				'posts_per_page' => $items_per_page,
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
				'posts_per_page' => $items_per_page,
				'orderby' => $order_by,
				'order' => $order,
			);
		}

		$query = new WP_Query( $args );
		ob_start();
		if ( $query->have_posts() ) :
		?>
			<div id="<?php echo esc_attr( $el_id ); ?>" class="<?php echo esc_attr( $product_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo $data_string; ?>>
		<?php

		if ( 'yes' == $product_filter ) {

			$filter_classes = array( 'eut-filter' );

			array_push( $filter_classes, 'eut-filter-style-' . $filter_style );
			array_push( $filter_classes, 'eut-align-' . $product_filter_align);
			array_push( $filter_classes, 'eut-link-text');

			if ( 'button' == $filter_style ) {
				array_push( $filter_classes, 'eut-link-text');
				array_push( $filter_classes, 'eut-filter-shape-' . $filter_shape );
				array_push( $filter_classes, 'eut-filter-color-' . $filter_color );
			}

			$filter_class_string = implode( ' ', $filter_classes );

			$category_prefix = '.product_cat-';
			$category_filter_list = array();
			$category_filter_array = array();
			$all_string =  apply_filters( 'crocal_eutf_vce_product_string_all_categories', esc_html__( 'All', 'crocal-extension' ) );
			$category_filter_string = '<li data-filter="*" class="selected"><span>' . esc_html( $all_string ) . '</span></li>';
			$category_filter_add = false;
			while ( $query->have_posts() ) : $query->the_post();

				if ( $product_categories = get_the_terms( get_the_ID(), 'product_cat' ) ) {

					foreach($product_categories as $category_term){
						$category_filter_add = false;
						if ( !in_array($category_term->term_id, $category_filter_list) ) {
							if( ! empty( $product_category_ids ) ) {
								if ( in_array($category_term->term_id, $product_category_ids) ) {
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

			<?php echo $product_row_start; ?>

		<?php

		$product_index = 0;

		while ( $query->have_posts() ) : $query->the_post();
			$image_size = 'crocal-eutf-small-rect-horizontal';
			$product_index++;
			$product_extra_class = '';

			$product_extra_class = 'eut-isotope-item eut-product-item ';

			if ( 'masonry' == $product_mode ) {
				//Masonry
				if( 'medium_large' == $masonry_image_mode ) {
					$product_extra_class .= 'eut-image-square';
					$image_size = 'medium_large';
				} elseif( 'medium' == $masonry_image_mode ) {
					$product_extra_class .= 'eut-image-square';
					$image_size = 'medium';
				} else {
					$product_extra_class .= 'eut-image-square';
					$image_size = 'large';
				}
			} else {
				$image_size = crocal_ext_vce_get_image_size( $grid_image_mode );
			}

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

					<article id="product-<?php the_ID(); ?><?php echo uniqid('-'); ?>" <?php post_class( $product_extra_class ); ?>>
						<div class="<?php echo esc_attr( $isotope_inner_item_class_string ); ?>">
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
	add_shortcode( 'crocal_products', 'crocal_ext_vce_products_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_products_shortcode_params' ) ) {
	function crocal_ext_vce_products_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Products", "crocal-extension" ),
			"description" => esc_html__( "Display product element in multiple styles", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-product",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Product Mode", "crocal-extension" ),
					"param_name" => "product_mode",
					"admin_label" => true,
					'value' => array(
						esc_html__( 'Grid' , 'crocal-extension' ) => 'grid',
						esc_html__( 'Masonry' , 'crocal-extension' ) => 'masonry',
					),
					"description" => esc_html__( "Select your product mode", "crocal-extension" ),
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
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'grid' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Masonry Image Size", "crocal-extension" ),
					"param_name" => "masonry_image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
					) ),
					'std' => 'large',
					"description" => esc_html__( "Select your Masonry Image Size.", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Large Screen Columns", "crocal-extension" ),
					"param_name" => "columns_large_screen",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select your Products Columns.", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Columns", "crocal-extension" ),
					"param_name" => "columns",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select your Products Columns.", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Landscape Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_landscape",
					"value" => array( '2', '3', '4' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, landscape orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Portrait Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_portrait",
					"value" => array( '2', '3', '4' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, portrait orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Mobile Columns", "crocal-extension" ),
					"param_name" => "columns_mobile",
					"value" => array( '1', '2' ),
					"std" => '1',
					"description" => esc_html__( "Select responsive column on mobile devices.", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'grid', 'masonry' ) ),
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
				crocal_ext_vce_add_shadow(),
				crocal_ext_vce_add_radius(),
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
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'grid', 'masonry' ) ),
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
					"type" => 'crocal_param_label',
					"heading" => esc_html__( "Pagination", 'crocal-extension'),
					"description" => esc_html__( "Define the items to show per page or the total items number according to the selected display style.", "crocal-extension" ),
					"param_name" => "label_pagination",
					'value' => '',
					'std' => '',
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
					"description" => esc_html__( "Select Show All or define your pagination style.", "crocal-extension" ),
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
					"type" => "dropdown",
					"heading" => esc_html__( "Overlay Opacity", "crocal-extension" ),
					"param_name" => "overlay_opacity",
					"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
					"std" => '90',
					"description" => esc_html__( "Choose the opacity for the overlay.", "crocal-extension" ),
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Filter", "crocal-extension" ),
					"param_name" => "product_filter",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"description" => esc_html__( "If selected, an isotope filter will be displayed.", "crocal-extension" ) . " " . esc_html__( "Enable product Filter ( Only for All or Multiple Categories )", "crocal-extension" ),
					"dependency" => array( 'element' => "product_mode", 'value' => array( 'grid', 'masonry' ) ),
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
					"dependency" => array( 'element' => "product_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Order", "crocal-extension" ),
					"param_name" => "filter_order",
					"value" => array(
						esc_html__( "Ascending", "crocal-extension" ) => 'ASC',
						esc_html__( "Descending", "crocal-extension" ) => 'DESC',
					),
					"dependency" => array( 'element' => "product_filter", 'value' => array( 'yes' ) ),
					"description" => '',
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Style", "crocal-extension" ),
					"param_name" => "filter_style",
					"value" => array(
						esc_html__( "Simple", "crocal-extension" ) => 'simple',
						esc_html__( "Button", "crocal-extension" ) => 'button',

					),
					"dependency" => array( 'element' => "product_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Alignment", "crocal-extension" ),
					"param_name" => "product_filter_align",
					"value" => array(
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
						esc_html__( "Center", "crocal-extension" ) => 'center',
					),
					"description" => '',
					"dependency" => array( 'element' => "product_filter", 'value' => array( 'yes' ) ),
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
					"dependency" => array( 'element' => "product_filter", 'value' => array( 'yes' ) ),
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
	vc_lean_map( 'crocal_products', 'crocal_ext_vce_products_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_products_shortcode_params( 'crocal_products' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
