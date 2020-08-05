<?php
/**
 * Events Shortcode
 */

if( !function_exists( 'crocal_ext_vce_events_shortcode' ) ) {

	function crocal_ext_vce_events_shortcode( $attr, $content ) {

		$event_row_start = $allow_filter = $class_fullwidth = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'columns_large_screen' => '3',
					'columns' => '3',
					'columns_tablet_landscape' => '2',
					'columns_tablet_portrait' => '2',
					'columns_mobile' => '1',
					'grid_image_mode' => 'landscape',
					'event_filter' => '',
					'filter_style' => 'simple',
					'filter_shape' => 'square',
					'filter_color' => 'primary-1',
					'event_filter_align' => 'left',
					'filter_order_by' => '',
					'filter_order' => 'ASC',
					'filter_gototop' => 'yes',
					'item_gutter' => 'yes',
					'gutter_size' => '30',
					'item_spinner' => 'no',
					'items_to_show' => '12',
					'event_title_heading_tag' => 'h3',
					'event_title_heading' => 'h3',
					'overlay_color' => 'light',
					'overlay_opacity' => '90',
					'order_by' => 'date',
					'order' => 'DESC',
					'disable_pagination' => '',
					'animation' => 'eut-zoom-in',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$attr
			)
		);

		$event_classes = array( 'eut-element' );
		$data_string = '';

		$event_row_start = '<div class="eut-isotope-container">';

		$data_string = ' data-spinner="' . esc_attr( $item_spinner ) . '" data-columns="' . esc_attr( $columns ) . '" data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '" data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '" data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '" data-columns-mobile="' . esc_attr( $columns_mobile ) . '" data-layout="fitRows"';
		if ( 'yes' == $item_gutter ) {
			$data_string .= ' data-gutter-size="' . esc_attr( $gutter_size ) . '"';
		}
		if ( 'yes' == $item_gutter ) {
			array_push( $event_classes, 'eut-with-gap' );
		}
		array_push( $event_classes, 'eut-event' );
		array_push( $event_classes, 'eut-event-grid' );
		array_push( $event_classes, 'eut-isotope' );

		$allow_filter = 'yes';

		$isotope_inner_item_classes = array( 'eut-event-item-inner', 'eut-isotope-item-inner', 'eut-hover-item' );

		if ( !empty( $animation ) ) {
			array_push( $isotope_inner_item_classes, $animation);
		}

		$isotope_inner_item_class_string = implode( ' ', $isotope_inner_item_classes );


		if ( !empty ( $el_class ) ) {
			array_push( $event_classes, $el_class);
		}
		$event_class_string = implode( ' ', $event_classes );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$event_category_ids = array();
		$event_category_slugs = array();

		if( ! empty( $categories ) ) {
			$event_category_ids = explode( ",", $categories );
			foreach ( $event_category_ids as $category_id ) {
				$category_term = get_term( $category_id, 'tribe_events_cat' );
				if ( isset( $category_term) ) {
					$event_category_slugs[] = $category_term->slug;
				}
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
				'post_type' => 'tribe_events',
				'post_status'=>'publish',
				'paged' => $paged,
				'post__in' => $include_ids,
				'posts_per_page' => $items_to_show,
				'orderby' => $order_by,
				'order' => $order,
			);
			$event_filter = 'no';
		} else {
			if( !empty( $event_category_slugs ) ) {
				$args = array(
					'post_type' => 'tribe_events',
					'post_status'=>'publish',
					'paged' => $paged,
					'tax_query' => array(
					  array(
						  'taxonomy' => 'tribe_events_cat',
						  'field' => 'slug',
						  'terms' => $event_category_slugs,
						  'operator' => 'IN'
					  ),
					),
					'post__not_in' => $exclude_ids,
					'posts_per_page' => $items_to_show,
					'orderby' => $order_by,
					'order' => $order,
				);
			} else {
				$args = array(
					'post_type' => 'tribe_events',
					'post_status'=>'publish',
					'paged' => $paged,
					'post__not_in' => $exclude_ids,
					'posts_per_page' => $items_to_show,
					'orderby' => $order_by,
					'order' => $order,
				);
			}
		}


		$query = new WP_Query( $args );
		ob_start();

		if ( $query->have_posts() ) :
		?>
			<div class="<?php echo esc_attr( $event_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>"<?php echo $data_string; ?>>
		<?php

		if ( 'yes' == $event_filter && 'yes' == $allow_filter ) {

			$filter_classes = array( 'eut-filter' );

			array_push( $filter_classes, 'eut-filter-style-' . $filter_style );
			array_push( $filter_classes, 'eut-align-' . $event_filter_align);
			array_push( $filter_classes, 'eut-link-text');

			if ( 'button' == $filter_style ) {
				array_push( $filter_classes, 'eut-link-text');
				array_push( $filter_classes, 'eut-filter-shape-' . $filter_shape );
				array_push( $filter_classes, 'eut-filter-color-' . $filter_color );
			}

			$filter_class_string = implode( ' ', $filter_classes );

			$category_prefix = '.tribe-events-category-';
			$category_filter_list = array();
			$category_filter_array = array();
			$all_string =  apply_filters( 'crocal_eutf_vce_event_string_all_categories', esc_html__( 'All', 'crocal-extension' ) );
			$category_filter_string = '<li data-filter="*" class="selected"><span>' . esc_html( $all_string ) . '</span></li>';
			$category_filter_add = false;
			while ( $query->have_posts() ) : $query->the_post();

				if ( $event_categories = get_the_terms( get_the_ID(), 'tribe_events_cat' ) ) {

					foreach($event_categories as $category_term){
						$category_filter_add = false;
						if ( !in_array($category_term->term_id, $category_filter_list) ) {
							if( ! empty( $event_category_ids ) ) {
								if ( in_array($category_term->term_id, $event_category_ids) ) {
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

			<?php echo $event_row_start; ?>

		<?php

		$event_index = 0;

		while ( $query->have_posts() ) : $query->the_post();
			$image_size = 'crocal-eutf-small-rect-horizontal';
			$event_index++;
			$event_extra_class = '';

			//Grid - Default
			$event_extra_class = 'eut-isotope-item eut-event-item';
			$image_size = crocal_ext_vce_get_image_size( $grid_image_mode );

?>
			<div id="eut-tribe-events-event-<?php the_ID(); ?><?php echo uniqid('-'); ?>" class="<?php tribe_events_event_classes(); ?> <?php echo esc_attr( $event_extra_class ); ?>">

				<div class="<?php echo esc_attr( $isotope_inner_item_class_string ); ?>">
					<div class="eut-image-hover">
						<div class="eut-media">
							<a class="eut-item-url" href="<?php echo esc_url( get_permalink() ); ?>"></a>
							<div class="eut-bg-<?php echo esc_attr( $overlay_color ); ?> eut-hover-overlay eut-opacity-<?php echo esc_attr( $overlay_opacity ); ?>"></div>
							<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( $image_size );
								}
							?>
						</div>
						<div class="eut-event-content-wrapper">
							<div class="eut-event-content">
								<a href="<?php echo esc_url( tribe_get_event_link() ); ?>">
									<<?php echo tag_escape( $event_title_heading_tag ); ?> class="eut-title eut-<?php echo esc_attr( $event_title_heading ); ?>"><?php the_title(); ?></<?php echo tag_escape( $event_title_heading_tag ); ?>>
								</a>
								<div class="tribe-event-schedule-details">
									<?php echo tribe_events_event_schedule_details() ?>
								</div>
								<?php if ( tribe_get_cost() ) : ?>
									<div class="tribe-events-event-cost">
										<span><?php echo tribe_get_cost( null, true ); ?></span>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php

		endwhile;
?>
				</div>
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
	add_shortcode( 'crocal_events', 'crocal_ext_vce_events_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_events_shortcode_params' ) ) {
	function crocal_ext_vce_events_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Events", "crocal-extension" ),
			"description" => esc_html__( "Display event element in multiple styles", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-event",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
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
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Large Screen Columns", "crocal-extension" ),
					"param_name" => "columns_large_screen",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select your Events Columns.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Columns", "crocal-extension" ),
					"param_name" => "columns",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select your Events Columns.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Landscape Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_landscape",
					"value" => array( '2', '3', '4' ),
					"std" => '2',
					"description" => esc_html__( "Select responsive column on tablet devices, landscape orientation.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Tablet Portrait Columns", "crocal-extension" ),
					"param_name" => "columns_tablet_portrait",
					"value" => array( '2', '3', '4' ),
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
					"value" => '30',
					"dependency" => array( 'element' => "item_gutter", 'value' => array( 'yes' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Items to show", "crocal-extension" ),
					"param_name" => "items_to_show",
					"value" => '12',
					"description" => esc_html__( "Maximum event Items to Show", "crocal-extension" ),
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
					"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "crocal-extension" ),
					"std" => "eut-zoom-in",
				),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Event Title Tag", "crocal-extension" ),
					"param_name" => "event_title_heading_tag",
					"value" => array(
						esc_html__( "h1", "crocal-extension" ) => 'h1',
						esc_html__( "h2", "crocal-extension" ) => 'h2',
						esc_html__( "h3", "crocal-extension" ) => 'h3',
						esc_html__( "h4", "crocal-extension" ) => 'h4',
						esc_html__( "h5", "crocal-extension" ) => 'h5',
						esc_html__( "h6", "crocal-extension" ) => 'h6',
						esc_html__( "div", "crocal-extension" ) => 'div',
					),
					"description" => esc_html__( "event Title Tag for SEO", "crocal-extension" ),
					"std" => 'h3',
					"group" => esc_html__( "Titles & Hovers", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Event Title Size/Typography", "crocal-extension" ),
					"param_name" => "event_title_heading",
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
					"description" => esc_html__( "event Title size and typography, defined in Theme Options - Typography Options", "crocal-extension" ),
					"std" => 'h3',
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
					"type" => 'checkbox',
					"heading" => esc_html__( "Enable Loader", "crocal-extension" ),
					"param_name" => "item_spinner",
					"description" => esc_html__( "If selected, this will enable a graphic spinner before load.", "crocal-extension" ),
					"value" => array( esc_html__( "Enable Loader.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Disable Pagination", "crocal-extension" ),
					"param_name" => "disable_pagination",
					"description" => esc_html__( "If selected, pagination will not be shown.", "crocal-extension" ),
					"value" => array( esc_html__( "Disable Pagination.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
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
					"param_name" => "event_filter",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => '',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"description" => esc_html__( "If selected, an isotope filter will be displayed.", "crocal-extension" ) . " " . esc_html__( "Enable event Filter ( Only for All or Multiple Categories )", "crocal-extension" ),
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
					"dependency" => array( 'element' => "event_filter", 'value' => array( 'yes' ) ),
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
					"dependency" => array( 'element' => "event_filter", 'value' => array( 'yes' ) ),
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
					"dependency" => array( 'element' => "event_filter", 'value' => array( 'yes' ) ),
					"group" => esc_html__( "Filters", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Filter Alignment", "crocal-extension" ),
					"param_name" => "event_filter_align",
					"value" => array(
						esc_html__( "Left", "crocal-extension" ) => 'left',
						esc_html__( "Right", "crocal-extension" ) => 'right',
						esc_html__( "Center", "crocal-extension" ) => 'center',
					),
					"description" => '',
					"dependency" => array( 'element' => "event_filter", 'value' => array( 'yes' ) ),
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
					"dependency" => array( 'element' => "event_filter", 'value' => array( 'yes' ) ),
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
					"heading" => __("Event Categories", "crocal-extension" ),
					"param_name" => "categories",
					"value" => crocal_ext_vce_get_event_categories(),
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
	vc_lean_map( 'crocal_events', 'crocal_ext_vce_events_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_events_shortcode_params( 'crocal_events' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
