<?php
/**
 * Testimonial Shortcode
 */

if( !function_exists( 'crocal_ext_vce_testimonial_shortcode' ) ) {

	function crocal_ext_vce_testimonial_shortcode( $atts, $content ) {

		$allow_filter = $class_fullwidth = $slider_data = $output = $el_class = '';

		$combined_atts = $atts;
		extract(
			$combined_atts = shortcode_atts(
				array(
					'categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'testimonial_mode' => 'carousel',
					'crocal_image_mode' => 'portrait',
					'columns_large_screen' => '3',
					'columns' => '3',
					'columns_tablet_landscape' => '2',
					'columns_tablet_portrait' => '2',
					'columns_mobile' => '1',
					'item_gutter' => 'yes',
					'gutter_size' => '40',
					'items_to_show' => '20',
					'order_by' => 'date',
					'order' => 'DESC',
					'shape' => 'square',
					'shadow' => '',
					'disable_pagination' => '',

					'icon_type' => '',
					'icon_size' => 'medium',
					'icon_library' => 'fontawesome',
					'icon_fontawesome' => 'fa fa-adjust',
					'icon_openiconic' => 'vc-oi vc-oi-dial',
					'icon_typicons' => 'typcn typcn-adjust-brightness',
					'icon_entypo' => 'entypo-icon entypo-icon-note',
					'icon_linecons' => 'vc_li vc_li-heart',
					'icon_simplelineicons' => 'smp-icon-user',
					'icon_etlineicons' => 'et-icon-mobile',
					'icon_shape' => 'no-shape',
					'icon_shape_type' => 'simple',
					'icon_svg' => '',
					'icon_svg_animation_duration' => '100',
					'icon_color' => 'primary-1',
					'icon_color_custom' => '#e1e1e1',
					'icon_shape_color' => 'grey',
					'icon_shape_color_custom' => '#e1e1e1',
					'icon_image' => '',
					'retina_icon_image' => '',					
					
					'show_image' => 'no',
					'margin_bottom' => '',
					'slideshow_speed' => '3000',
					'pagination_speed' => '400',
					'carousel_pagination' => 'yes',
					'pagination_color' => 'dark',
					'transition' => 'slide',
					'auto_play' => 'yes',
					'pause_hover' => 'no',
					'auto_height' => 'no',
					'animation' => 'eut-zoom-in',
					'align' => 'left',
					'text_style' => 'none',
					'el_class' => '',
				),
				$atts
			)
		);

		$testimonial_classes = array( 'eut-element', 'eut-testimonial' );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$data_string = '';

		switch( $testimonial_mode ) {
			case 'masonry':
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
					array_push( $testimonial_classes, 'eut-with-gap' );
				}
				array_push( $testimonial_classes, 'eut-layout-3' );
				array_push( $testimonial_classes, 'eut-isotope' );
				array_push( $testimonial_classes, 'eut-align-' . $align );
				if ( 'none' != $text_style ) {
					array_push( $testimonial_classes, 'eut-' . $text_style );
				}
				break;
			case 'carousel':
			default:
				$data_string .= ' data-slider-transition="' . esc_attr( $transition ) . '"';
				$data_string .= ' data-slider-autoplay="' . esc_attr( $auto_play ) . '"';
				$data_string .= ' data-slider-speed="' . esc_attr( $slideshow_speed ) . '"';
				$data_string .= ' data-slider-pause="' . esc_attr( $pause_hover ) . '"';
				$data_string .= ' data-pagination-speed="' . esc_attr( $pagination_speed ) . '"';
				$data_string .= ' data-slider-autoheight="' . esc_attr( $auto_height ) . '"';
				$data_string .= ' data-pagination="' . esc_attr( $carousel_pagination ) . '"';
				$data_string .= ' data-pagination-color="' . esc_attr( $pagination_color ) . '"';
				array_push( $testimonial_classes, 'eut-carousel-element' );
				array_push( $testimonial_classes, 'owl-carousel' );
				array_push( $testimonial_classes, 'eut-layout-1' );
				array_push( $testimonial_classes, 'eut-align-' . $align );
				if ( 'none' != $text_style ) {
					array_push( $testimonial_classes, 'eut-' . $text_style );
				}
				array_push( $testimonial_classes, 'eut-carousel-pagination-1' );
				$disable_pagination = 'yes';
				break;

		}

		if ( !empty ( $el_class ) ) {
			array_push( $testimonial_classes, $el_class);
		}

		$testimonial_class_string = implode( ' ', $testimonial_classes );

		// Item Classes
		$testimonial_item_classes = array( 'eut-testimonial-element' );
		array_push( $testimonial_item_classes, 'eut-bg-white' );
		if ( 'square' != $shape ) {
			array_push( $testimonial_item_classes, 'eut-' . $shape );
		}

		if ( !empty( $shadow ) ) {
			array_push( $testimonial_item_classes, 'eut-' . $shadow );
			array_push( $testimonial_item_classes, 'eut-with-shadow' );
		}

		$testimonial_item_class_string = implode( ' ', $testimonial_item_classes );

		$testimonial_cat = "";

		if ( !empty( $categories ) ) {
			$testimonial_category_list = explode( ",", $categories );
			foreach ( $testimonial_category_list as $testimonial_list ) {
				$testimonial_term = get_term( $testimonial_list, 'testimonial_category' );
				$testimonial_cat = $testimonial_cat.$testimonial_term->slug . ', ';
			}
		}

		$paged = 1;

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
				'post_type' => 'testimonial',
				'post_status'=>'publish',
				'paged' => $paged,
				'post__in' => $include_ids,
				'posts_per_page' => $items_to_show,
				'orderby' => $order_by,
				'order' => $order,
			);
		} else {
			$args = array(
				'post_type' => 'testimonial',
				'post_status'=>'publish',
				'paged' => $paged,
				'testimonial_category' => $testimonial_cat,
				'post__not_in' => $exclude_ids,
				'posts_per_page' => $items_to_show,
				'orderby' => $order_by,
				'order' => $order,
			);
		}

		$image_size = 'thumbnail';

		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) :

		?>
			<div class="<?php echo esc_attr( $testimonial_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo $data_string; ?>>

				<?php if ( 'masonry' == $testimonial_mode ) { ?>
				<div class="eut-isotope-container">
				<?php } ?>

		<?php
		while ( $query->have_posts() ) : $query->the_post();


		$name =  crocal_ext_vce_post_meta( '_crocal_eutf_testimonial_name' );
		$identity =  crocal_ext_vce_post_meta( '_crocal_eutf_testimonial_identity' );

		if ( !empty( $name ) && !empty( $identity ) && 'carousel' == $testimonial_mode ) {
			$identity = ' - ' . $identity;
		}

			if ( 'carousel' == $testimonial_mode ) {
		?>
				<div <?php post_class( 'eut-testimonial-element' ); ?>>
					<?php if ( 'yes' == $show_image && has_post_thumbnail() ) { ?>
							<div class="eut-testimonial-thumb"><?php the_post_thumbnail( $image_size ); ?></div>
					<?php } ?>
					<div class="eut-testimonial-content">
						<?php echo apply_filters('crocal_ext_the_content', get_the_content() ); ?>
						<?php if ( !empty( $name ) || !empty( $identity ) ) { ?>
						<div class="eut-small-text eut-heading-color eut-testimonial-name"><?php echo esc_html( $name ); ?><span class="eut-identity"><?php echo esc_html( $identity ); ?></span></div>
						<?php } ?>
					</div>
				</div>
		<?php
			} else if ( 'masonry' == $testimonial_mode ) {

		?>
				<div <?php post_class( 'eut-isotope-item eut-testimonial-item' ); ?>>
					<div class="eut-isotope-item-inner <?php echo esc_attr( $animation ); ?>">
						<div class="<?php echo esc_attr( $testimonial_item_class_string ); ?>">
		<?php
						if ( !empty ( $icon_type ) ) {
							if ( 'image' == $icon_type ) {
								if ( !empty( $icon_image ) ) {
									$img_id = preg_replace('/[^\d]/', '', $icon_image);
									$img_src = wp_get_attachment_image_src( $img_id, 'full' );
									$img_url = $img_src[0];
									$image_srcset = '';
									if ( !empty( $retina_icon_image ) ) {
										$img_retina_id = preg_replace('/[^\d]/', '', $retina_icon_image);
										$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
										$retina_url = $img_retina_src[0];
										$image_srcset = $img_url . ' 1x,' . $retina_url . ' 2x';
										$image_html = crocal_ext_vce_get_attachment_image( $img_id, 'full' , "", array( 'srcset'=> $image_srcset, 'data-column-space' => '100%' ) );
									} else {
										$image_html = crocal_ext_vce_get_attachment_image( $img_id, 'full', "", array( 'data-column-space' => '100%' ) );
									}
								} else {
									$image_html = crocal_ext_vce_get_fallback_image( 'thumbnail' );
								}

								echo '<div class="eut-single-icon eut-image-icon eut-' . esc_attr( $icon_size ) . '">' . $image_html . '</div>';

							} else {
								echo crocal_ext_vce_get_icon( $combined_atts );
							}
						}		
		?>
							<div class="eut-testimonial-content">
								<?php echo apply_filters('crocal_ext_the_content', get_the_content() ); ?>
							</div>
							<div class="eut-testimonial-author">
								<?php if ( 'yes' == $show_image && has_post_thumbnail() ) { ?>
										<div class="eut-testimonial-thumb"><?php the_post_thumbnail( $image_size ); ?></div>
								<?php } ?>
								<?php if ( !empty( $name ) || !empty( $identity ) ) { ?>
								<div class="eut-testimonial-name"><span class="eut-link-text eut-heading-color"><?php echo esc_html( $name ); ?></span><span class="eut-text-primary-1"><?php echo esc_html( $identity ); ?></span></div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>

		<?php
			} else {
				$image_size = crocal_ext_vce_get_image_size( $crocal_image_mode );
		?>
				<div <?php post_class( 'eut-testimonial-element' ); ?>>
					<div class="eut-testimonial-thumb">
					<?php
						if( has_post_thumbnail() ) {
							the_post_thumbnail( $image_size );
						} else {
							echo crocal_ext_vce_get_fallback_image( $image_size );
						}
					?>
					</div>
					<i class="eut-testimonial-icon eut-icon-quote eut-bg-primary-1 eut-paraller" data-limit="2x"></i>
					<div class="eut-testimonial-content eut-box-item eut-bg-white eut-paraller" data-limit="1x">
						<?php echo apply_filters('crocal_ext_the_content', get_the_content() ); ?>
						<?php if ( !empty( $name ) || !empty( $identity ) ) { ?>
						<div class="eut-small-text eut-heading-color eut-testimonial-name"><?php echo esc_html( $name ); ?><span class="eut-text-primary-1"><?php echo esc_html( $identity ); ?></span></div>
						<?php } ?>
					</div>
				</div>
		<?php
			}

		endwhile;

		?>
				<?php if ( 'masonry' == $testimonial_mode ) { ?>
				</div>
				<?php } ?>
<?php
			if ( 'yes' != $disable_pagination ) {
				$total = $query->max_num_pages;
				$big = 999999999; // need an unlikely integer
				if( $total > 1 )  {
					 echo '<div class="eut-pagination eut-pagination-text eut-heading-color">';

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
	add_shortcode( 'crocal_testimonial', 'crocal_ext_vce_testimonial_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_testimonial_shortcode_params' ) ) {
	function crocal_ext_vce_testimonial_shortcode_params( $tag ) {
		
		$crocal_ext_vce_testimonial_shortcode_params = array_merge(
			array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Testimonial Mode", "crocal-extension" ),
					"param_name" => "testimonial_mode",
					"value" => array(
						esc_html__( "Carousel", "crocal-extension" ) => 'carousel',
						esc_html__( "Masonry", "crocal-extension" ) => 'masonry',
					),
					"description" => esc_html__( "Select your testimonial type.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Large Screen Columns", "crocal-extension" ),
					"param_name" => "columns_large_screen",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select column on large devices.", "crocal-extension" ),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Columns", "crocal-extension" ),
					"param_name" => "columns",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select number of columns.", "crocal-extension" ),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Landscape Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_landscape",
					"value" => array( '2', '3', '4' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, landscape orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Portrait Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_portrait",
					"value" => array( '2', '3', '4' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, portrait orientation.", "crocal-extension" ),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Mobile Columns", "crocal-extension" ),
					"param_name" => "columns_mobile",
					"value" => array( '1', '2' ),
					"std" => '1',
					"description" => esc_html__( "Select responsive column on mobile devices.", "crocal-extension" ),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ),
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
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Gutter Size", "crocal-extension" ),
					"param_name" => "gutter_size",
					"value" => '40',
					"dependency" => array( 'element' => "item_gutter", 'value' => array( 'yes' ) ),
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
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ),
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
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ),
				),
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
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ),
					"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "crocal-extension" ),
					"std" => "eut-zoom-in",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Items to show", "crocal-extension" ),
					"param_name" => "items_to_show",
					"value" => '20',
					"description" => esc_html__( "Maximum Testimonial Items to Show", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Disable Pagination", "crocal-extension" ),
					"param_name" => "disable_pagination",
					"description" => esc_html__( "If selected, pagination will not be shown.", "crocal-extension" ),
					"value" => array( esc_html__( "Disable Pagination.", "crocal-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ),
				),
				crocal_ext_vce_add_order_by(),
				crocal_ext_vce_add_order(),
			),
			crocal_ext_vce_get_icon_params( $tag, array( 'element' => "testimonial_mode", 'value' => array( 'masonry' ) ) ),
			array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Show Featured Image", "crocal-extension" ),
					"param_name" => "show_image",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => 'no',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'carousel', 'masonry' ) ),
					"std" => 'no',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Autoplay", "crocal-extension" ),
					"param_name" => "auto_play",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Slideshow Speed", "crocal-extension" ),
					"param_name" => "slideshow_speed",
					"value" => '3000',
					"description" => esc_html__( "Slideshow Speed in ms.", "crocal-extension" ),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Transition", "crocal-extension" ),
					"param_name" => "transition",
					"value" => array(
						esc_html__( "Slide", "crocal-extension" ) => 'slide',
						esc_html__( "Fade", "crocal-extension" ) => 'fade',
					),
					"description" => esc_html__( "Transition Effect.", "crocal-extension" ),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Pause on Hover", "crocal-extension" ),
					"param_name" => "pause_hover",
					"value" => array( esc_html__( "If selected, testimonial will be paused on hover", "crocal-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Auto Height", "crocal-extension" ),
					"param_name" => "auto_height",
					"value" => array( esc_html__( "Select if you want smooth auto height", "crocal-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Carousel Pagination", "crocal-extension" ),
					"param_name" => "carousel_pagination",
					"value" => array(
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
						esc_html__( "No", "crocal-extension" ) => 'no',
					),
					"std" => "yes",
					"dependency" => array( 'element' => "testimonial_mode", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Pagination Color", "crocal-extension" ),
					"param_name" => "pagination_color",
					'value' => array(
						esc_html__( 'Dark' , 'crocal-extension' ) => 'dark',
						esc_html__( 'Light' , 'crocal-extension' ) => 'light',
					),
					"description" => esc_html__( "Select the Pagination color.", "crocal-extension" ),
					"dependency" => array( 'element' => "carousel_pagination", 'value' => array( 'yes' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Text Style", "crocal-extension" ),
					"param_name" => "text_style",
					"value" => array(
						esc_html__( "None", "crocal-extension" ) => '',
						esc_html__( "Leader", "crocal-extension" ) => 'leader-text',
						esc_html__( "Subtitle", "crocal-extension" ) => 'subtitle',
						esc_html__( "Quote", "crocal-extension" ) => 'quote-text',
						esc_html__( "Small Text", "crocal-extension" ) => 'small-text',
					),
					"description" => 'Select your text style',
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
				),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
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
					"heading" => __("Testimonial Categories", "crocal-extension" ),
					"param_name" => "categories",
					"value" => crocal_ext_vce_get_testimonial_categories(),
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
			)
		);
		
		return array(
			"name" => esc_html__( "Testimonial", "crocal-extension" ),
			"description" => esc_html__( "Add a captivating testimonial slider", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-testimonial",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => $crocal_ext_vce_testimonial_shortcode_params,
		);		
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_testimonial', 'crocal_ext_vce_testimonial_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_testimonial_shortcode_params( 'crocal_testimonial' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.

