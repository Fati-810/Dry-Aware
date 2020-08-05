<?php
/**
 * Blog Shortcode
 */

if( !function_exists( 'crocal_ext_vce_blog_shortcode' ) ) {

	function crocal_ext_vce_blog_shortcode( $atts, $content ) {

		$output = $el_class = $allow_filter = $data_string = '';

		extract(
			shortcode_atts(
				array(
					'categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'blog_mode' => 'blog-large',
					'blog_shadow_style' => 'shadow-mode',
					'blog_media_area' => 'yes',
					'blog_image_mode' => 'landscape-large-wide',
					'blog_grid_image_mode' => 'landscape',
					'blog_masonry_image_mode' => 'medium',
					'post_title_heading_tag' => 'h2',
					'post_title_heading' => 'auto',
					'blog_image_prio' => '',
					'columns_large_screen' => '3',
					'columns' => '3',
					'columns_tablet_landscape' => '2',
					'columns_tablet_portrait' => '2',
					'columns_mobile' => '1',
					'item_gutter' => 'yes',
					'gutter_size' => '40',
					'auto_excerpt' => '',
					'excerpt_length' => '55',
					'excerpt_more' => '',
					'hide_author' => '',
					'hide_date' => '',
					'hide_comments' => '',
					'hide_like' => '',
					'hide_excerpt' => '',
					'hide_categories' => 'yes',
					'posts_per_page' => '10',
					'order_by' => 'date',
					'order' => 'DESC',
					'display_style' => 'pagination',
					'display_large_style' => 'pagination',
					'load_more_title' => 'Load More',
					'blog_filter' => '',
					'filter_style' => 'simple',
					'filter_shape' => 'square',
					'filter_color' => 'primary-1',
					'blog_filter_align' => 'left',
					'filter_order_by' => '',
					'filter_order' => 'ASC',
					'filter_gototop' => 'yes',
					'animation' => '',
					'margin_bottom' => '',
					'el_class' => '',
					'el_id' => 'default-id',
				),
				$atts
			)
		);

		$el_id = 'el-' . $el_id;

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$blog_classes = array( 'eut-element' );


		switch( $blog_mode ) {

			case 'masonry':
				$data_string .= ' data-display-style="' . esc_attr( $display_style ) . '"';
				$data_string .= ' data-columns="' . esc_attr( $columns ) . '"';
				$data_string .= ' data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '"';
				$data_string .= ' data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '"';
				$data_string .= ' data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '"';
				$data_string .= ' data-columns-mobile="' . esc_attr( $columns_mobile ) . '"';
				$data_string .= ' data-layout="masonry"';
				if ( 'yes' == $item_gutter ) {
					$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
				}
				break;
			case 'grid':
				$data_string .= ' data-display-style="' . esc_attr( $display_style ) . '"';
				$data_string .= ' data-columns="' . esc_attr( $columns ) . '"';
				$data_string .= ' data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '"';
				$data_string .= ' data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '"';
				$data_string .= ' data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '"';
				$data_string .= ' data-columns-mobile="' . esc_attr( $columns_mobile ) . '"';
				$data_string .= ' data-layout="fitRows"';
				if ( 'yes' == $item_gutter ) {
					$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
				}
				break;
			case 'blog-small':
				$data_string .= ' data-display-style="' . esc_attr( $display_style ) . '"';
				$data_string .= ' data-columns="1"';
				$data_string .= ' data-columns-large-screen="1"';
				$data_string .= ' data-columns-tablet-landscape="1"';
				$data_string .= ' data-columns-tablet-portrait="1"';
				$data_string .= ' data-columns-mobile="1"';
				$data_string .= ' data-layout="fitRows"';
				break;
			case 'blog-large':
				$data_string .= ' data-display-style="' . esc_attr( $display_large_style ) . '"';
				$data_string .= '';
				break;
			default:
				$data_string .= '';
				break;
		}

		array_push( $blog_classes, crocal_ext_vce_get_blog_class( $blog_mode ) );
		if ( !empty ( $el_class ) ) {
			array_push( $blog_classes, $el_class);
		}

		if ( 'shadow-mode' == $blog_shadow_style && ( 'masonry' == $blog_mode || 'grid' == $blog_mode ) ) {
			array_push( $blog_classes, 'eut-with-shadow' );
		}

		$blog_class_string = implode( ' ', $blog_classes );

		$paged = 1;

		$disable_pagination = '';
		if ( 'blog-large' == $blog_mode ) {
			if ( empty( $display_large_style ) ) {
				$disable_pagination = 'yes';
			}
		} else {
			if ( empty( $display_style ) ) {
				$disable_pagination = 'yes';
			}
		}

		if ( 'yes' != $disable_pagination ) {
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
				'post_type' => 'post',
				'post_status'=>'publish',
				'posts_per_page' => $posts_per_page,
				'post__in' => $include_ids,
				'paged' => $paged,
				'ignore_sticky_posts' => 1,
				'orderby' => $order_by,
				'order' => $order,
			);
			$blog_filter = 'no';
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

		if ( 'blog-large' != $blog_mode ) {
			$allow_filter = 'yes';
		}

		$image_atts = array( 'data-column-space' => '100' );

		ob_start();

		if ( $query->have_posts() ) :

?>
		<div id="<?php echo esc_attr( $el_id ); ?>" class="<?php echo esc_attr( $blog_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>" <?php echo $data_string; ?>>
<?php
		//Category Filter
		if ( 'yes' == $blog_filter && 'yes' == $allow_filter ) {

			$filter_classes = array( 'eut-filter' );

			array_push( $filter_classes, 'eut-filter-style-' . $filter_style );
			array_push( $filter_classes, 'eut-align-' . $blog_filter_align);
			array_push( $filter_classes, 'eut-link-text');

			if ( 'button' == $filter_style ) {
				array_push( $filter_classes, 'eut-link-text');
				array_push( $filter_classes, 'eut-filter-shape-' . $filter_shape );
				array_push( $filter_classes, 'eut-filter-color-' . $filter_color );
			}

			$filter_class_string = implode( ' ', $filter_classes );

			$category_filter_list = array();
			$category_filter_array = array();
			$all_string =  apply_filters( 'crocal_eutf_vce_blog_string_all_categories', __( 'All', 'crocal-extension' ) );
			$category_filter_string = '<li data-filter="*" class="selected"><span>' . esc_html( $all_string ) . '</span></li>';
			$category_filter_add = false;
			while ( $query->have_posts() ) : $query->the_post();

				if ( $blog_categories = get_the_terms( get_the_ID(), 'category' ) ) {

					foreach($blog_categories as $category_term){
						$category_filter_add = false;
						if ( !in_array($category_term->term_id, $category_filter_list) ) {
							if( ! empty( $blog_category_ids ) ) {
								if ( in_array($category_term->term_id, $blog_category_ids) ) {
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

		$image_size = 'crocal-eutf-small-rect-horizontal';

		if ( 'grid' == $blog_mode || 'blog-small' == $blog_mode ) {
			$blog_image_mode = $blog_grid_image_mode;
		} else if ( 'masonry' == $blog_mode ) {
			$blog_image_mode = $blog_masonry_image_mode;
		}

		if ( 'blog-large' == $blog_mode ) {
?>
			<div class="eut-standard-container">
<?php
		} else {
?>
			<div class="eut-isotope-container">
<?php
		}

		$crocal_ext_isotope_start = $crocal_ext_isotope_end = '';
		if ( 'blog-large' != $blog_mode ) {
			if ( !empty( $animation ) ) {
				$crocal_ext_isotope_start = '<div class="eut-blog-item-inner eut-isotope-item-inner ' . esc_attr( $animation ) . '">';
			} else {
				$crocal_ext_isotope_start = '<div class="eut-blog-item-inner eut-isotope-item-inner">';
			}
			$crocal_ext_isotope_end = '</div>';
		} else {
			if ( !empty( $animation ) ) {
				$crocal_ext_isotope_start = '<div class="eut-blog-item-inner eut-isotope-item-inner eut-animated-item ' . esc_attr( $animation ) . '" data-delay="200">';
			} else {
				$crocal_ext_isotope_start = '<div class="eut-blog-item-inner eut-isotope-item-inner">';
			}
			$crocal_ext_isotope_end = '</div>';
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

			$bg_post_size = crocal_ext_vce_post_format_bg_size( $blog_mode, $post_format );
			$crocal_ext_post_class .= ' eut-bg-size-' . $bg_post_size;
?>
			<article <?php post_class( $crocal_ext_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
				<?php echo $crocal_ext_isotope_start; ?>

					<?php if ( 'link' != $post_format && 'quote' != $post_format ) { ?>
						<?php
							if ( $bg_post_mode ) {
								crocal_ext_vce_print_post_bg_media( $blog_mode, $post_format );
							} else {
								if ( 'yes' == $blog_media_area ) {
									crocal_ext_vce_print_post_feature_media( $blog_mode, $post_format, $blog_image_mode, $blog_image_prio, $image_atts );
								}
							}
						?>
						<div class="eut-post-content-wrapper">
							<div class="eut-post-content">
								<div class="eut-post-header">
									<?php if ( $bg_post_mode &&  'video' == $post_format ) { ?>
									<?php crocal_ext_vce_print_post_video_popup(); ?>
									<?php } ?>
									<?php crocal_ext_vce_print_structured_data(); ?>
									<?php if ( 'yes' != $hide_date || 'yes' != $hide_author || 'yes' != $hide_comments || 'yes' != $hide_like ) { ?>
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
									<?php } ?>
									<?php
									if ( 'yes' != $hide_categories ) {
										crocal_ext_vce_print_post_categories();
									}
									?>
									<?php crocal_ext_vce_print_post_title( $blog_mode, $post_format, $post_title_heading_tag, $post_title_heading ); ?>
								</div>
								<?php crocal_ext_vce_print_post_excerpt( $blog_mode, $post_format, $auto_excerpt, $excerpt_length, $excerpt_more ); ?>
							</div>
						</div>
					<?php
					 } else {
				 	?>
						<?php crocal_ext_vce_print_post_loop( $blog_mode, $post_format, $post_title_heading_tag, $post_title_heading, $auto_excerpt, $excerpt_length, $excerpt_more ); ?>
						<?php crocal_ext_vce_print_structured_data(); ?>
					<?php }?>

				<?php echo $crocal_ext_isotope_end; ?>
			</article>

<?php

		endwhile;
?>
			</div>
<?php
			if ( 'yes' != $disable_pagination ) {
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
	add_shortcode( 'crocal_blog', 'crocal_ext_vce_blog_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_blog_shortcode_params' ) ) {
	function crocal_ext_vce_blog_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Blog", "crocal-extension" ),
			"description" => esc_html__( "Display a Blog element in multiple styles", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-blog",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Blog Mode", "crocal-extension" ),
					"param_name" => "blog_mode",
					"admin_label" => true,
					'value' => array(
						esc_html__( 'Large Media', 'crocal-extension' ) => 'blog-large',
						esc_html__( 'Small Media', 'crocal-extension' ) => 'blog-small',
						esc_html__( 'Masonry' , 'crocal-extension' ) => 'masonry',
						esc_html__( 'Grid' , 'crocal-extension' ) => 'grid',
					),
					"description" => esc_html__( "Select your Blog Mode.", "crocal-extension" ),
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
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Size", "crocal-extension" ),
					"param_name" => "blog_image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Landscape Large Wide Crop', 'crocal-extension' ) => 'landscape-large-wide',
						esc_html__( 'Landscape Medium Crop', 'crocal-extension' ) => 'landscape-medium',
						esc_html__( 'Resize ( Extra Extra Large )' , 'crocal-extension' ) => 'extra-extra-large',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
					) ),
					'std' => '',
					"description" => esc_html__( "Select your Blog Image Size.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'blog-large' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Grid Image Size", "crocal-extension" ),
					"param_name" => "blog_grid_image_mode",
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
					"description" => esc_html__( "Select your Blog Grid Image Size.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'blog-small', 'grid' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Masonry Image Size", "crocal-extension" ),
					"param_name" => "blog_masonry_image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
					) ),
					'std' => 'medium',
					"description" => esc_html__( "Select your Blog Masonry Image Size.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'masonry' ) ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Featured Image Priority", "crocal-extension" ),
					"param_name" => "blog_image_prio",
					"description" => esc_html__( "Featured image is displayed instead of media element", "crocal-extension" ),
					"value" => array( esc_html__( "Featured Image Priority", "crocal-extension" ) => 'yes' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Large Screen Columns", "crocal-extension" ),
					"param_name" => "columns_large_screen",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select your Blog Columns.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Columns", "crocal-extension" ),
					"param_name" => "columns",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select your Blog Columns.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Landscape Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_landscape",
					"value" => array( '2', '3', '4' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, landscape orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Portrait Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_portrait",
					"value" => array( '2', '3', '4' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, portrait orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Mobile Columns", "crocal-extension" ),
					"param_name" => "columns_mobile",
					"value" => array( '1', '2' ),
					"std" => '1',
					"description" => esc_html__( "Select responsive column on mobile devices.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Auto excerpt", "crocal-extension" ),
					"param_name" => "auto_excerpt",
					"description" => esc_html__( "Adds automatic excerpt to all posts in Large Media style. If auto excerpt is not selected, blog will show all content, a desired 'cut-off' point can be inserted in each post with more quicktag.", "crocal-extension" ),
					"value" => array( esc_html__( "Activate auto excerpt.", "crocal-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'blog-large' ) ),
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
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Gutter Size", "crocal-extension" ),
					"param_name" => "gutter_size",
					"value" => '40',
					"dependency" => array( 'element' => "item_gutter", 'value' => array( 'yes' ) ),
				),
				array(
					"type" => 'textfield',
					"heading" => esc_html__( "Excerpt length", "crocal-extension" ),
					"param_name" => "excerpt_length",
					"description" => esc_html__( "Type how many words you want to display in your post excerpts.", "crocal-extension" ),
					"value" => '55',
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Read more", "crocal-extension" ),
					"param_name" => "excerpt_more",
					"description" => esc_html__( "Adds a read more button after the excerpt or more quicktag", "crocal-extension" ),
					"value" => array( esc_html__( "Add more button", "crocal-extension" ) => 'yes' ),
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
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'blog-large', 'blog-small','grid', 'masonry' ) ),
					"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "crocal-extension" ),
					"std" => "",
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
				//Titles & Styles
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Blog Style", "crocal-extension" ),
					"param_name" => "blog_shadow_style",
					'value' => array(
						esc_html__( 'With Shadow', 'crocal-extension' ) => 'shadow-mode',
						esc_html__( 'Without Shadow', 'crocal-extension' ) => 'no-shadow-mode',
					),
					"description" => esc_html__( "Select your Blog Style.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'grid', 'masonry' ) ),
					"group" => esc_html__( "Titles & Styles", "crocal-extension" ),
				),
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
					"std" => 'h2',
					"group" => esc_html__( "Titles & Styles", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Post Title Size/Typography", "crocal-extension" ),
					"param_name" => "post_title_heading",
					"value" => array(
						esc_html__( "Auto", "crocal-extension" ) => 'auto',
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
					"std" => 'auto',
					"group" => esc_html__( "Titles & Styles", "crocal-extension" ),
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
					"heading" => esc_html__( "Posts per Page", "crocal-extension" ),
					"param_name" => "posts_per_page",
					"value" => "10",
					"description" => esc_html__( "Enter how many posts per page you want to display.", "crocal-extension" ),
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
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'blog-small','grid', 'masonry' ) ),
					'edit_field_class' => 'vc_col-sm-6',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Display Style", "crocal-extension" ),
					"param_name" => "display_large_style",
					"value" => array(
						esc_html__( "Show All", "crocal-extension" ) => '',
						esc_html__( "Pagination", "crocal-extension" ) => 'pagination',
					),
					"std" => 'pagination',
					"description" => esc_html__( "Select Show All or define your pagination style.", "crocal-extension" ),
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'blog-large' ) ),
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
					"type" => 'crocal_param_label',
					"heading" => esc_html__( "Extras", 'crocal-extension'),
					"description" => esc_html__( "Extras display settings", "crocal-extension" ),
					"param_name" => "label_extras",
					'value' => '',
					'std' => '',
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Author", "crocal-extension" ),
					"param_name" => "hide_author",
					"description" => esc_html__( "If selected, blog overview will not show author.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Author.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Date", "crocal-extension" ),
					"param_name" => "hide_date",
					"description" => esc_html__( "If selected, blog overview will not show date.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Date.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Comments", "crocal-extension" ),
					"param_name" => "hide_comments",
					"description" => esc_html__( "If selected, blog overview will not show comments.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Comments.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Like", "crocal-extension" ),
					"param_name" => "hide_like",
					"description" => esc_html__( "If selected, blog overview will not show like.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Like.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Categories", "crocal-extension" ),
					"param_name" => "hide_categories",
					"description" => esc_html__( "If selected, blog overview will not show categories.", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Categories.", "crocal-extension" ) => 'yes' ),
					"std" => 'yes',
					"group" => esc_html__( "Pagination & Extras", "crocal-extension" ),
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Filter", "crocal-extension" ),
					"param_name" => "blog_filter",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"description" => esc_html__( "If selected, an isotope filter will be displayed.", "crocal-extension" ) . " " . esc_html__( "Enable Blog Filter ( Only for All or Multiple Categories )", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_mode", 'value' => array( 'blog-small', 'grid', 'masonry' ) ),
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
					"dependency" => array( 'element' => "blog_filter", 'value' => array( 'yes' ) ),
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
					"dependency" => array( 'element' => "blog_filter", 'value' => array( 'yes' ) ),
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
					"dependency" => array( 'element' => "blog_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
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
					"param_name" => "blog_filter_align",
					"value" => array(
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
						esc_html__( "Center", "crocal-extension" ) => 'center',
					),
					"description" => '',
					"dependency" => array( 'element' => "blog_filter", 'value' => array( 'yes' ) ),
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
					"dependency" => array( 'element' => "blog_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
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
	vc_lean_map( 'crocal_blog', 'crocal_ext_vce_blog_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_blog_shortcode_params( 'crocal_blog' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
