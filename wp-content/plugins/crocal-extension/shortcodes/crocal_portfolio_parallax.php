<?php
/**
 * Portfolio Parallax Shortcode
 */

if( !function_exists( 'crocal_ext_vce_portfolio_parallax_shortcode' ) ) {

	function crocal_ext_vce_portfolio_parallax_shortcode( $atts, $content ) {

		$output = $el_class = $data_string = $auto_excerpt = '';

		extract(
			shortcode_atts(
				array(
					'portfolio_categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'post_type' => 'portfolio',
					'image_mode' => 'landscape-medium',
					'heading_tag' => 'h3',
					'heading' => 'h5',
					'custom_font_family' => '',
					'read_more_title' => 'Read More',
					'content_bg' => 'white',
					'disable_pagination' => '',
					'hide_like' => '',
					'posts_per_page' => '12',
					'order_by' => 'date',
					'order' => 'DESC',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$portfolio_parallax_classes = array( 'eut-element', 'eut-portfolio-crocal-style' );
		if ( !empty ( $el_class ) ) {
			$portfolio_parallax_classes[] = $el_class;
		}
		if ( 'loop' == $image_mode ) {
			$portfolio_parallax_classes[] = 'eut-loop-mode';
		}
		$portfolio_parallax_class_string = implode( ' ', $portfolio_parallax_classes );

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
				'post_type' => 'portfolio',
				'post_status'=>'publish',
				'paged' => $paged,
				'post__in' => $include_ids,
				'posts_per_page' => $posts_per_page,
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
				'posts_per_page' => $posts_per_page,
				'orderby' => $order_by,
				'order' => $order,
			);
		}

		$image_mode_size = crocal_ext_vce_get_image_size( $image_mode );
		$image_html = crocal_ext_vce_get_fallback_image( $image_mode_size );

		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) :

?>
		<div class="<?php echo esc_attr( $portfolio_parallax_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>">

<?php
		$index = 0;
		while ( $query->have_posts() ) : $query->the_post();

		if ( 'loop' == $image_mode ) {
			$index++;
			$image_mode_size = crocal_ext_vce_get_image_size( 'loop', $index );
			$image_html = crocal_ext_vce_get_fallback_image( $image_mode_size );
		}

		$title_classes = array( 'eut-title', 'eut-heading-color' );
		$title_classes[]  = 'eut-' . $heading;
		if ( !empty( $custom_font_family ) ) {
			$title_classes[]  = 'eut-' . $custom_font_family;
		}
		$title_class_string = implode( ' ', $title_classes );
?>
			<div class="eut-portfolio-item eut-paraller-wrapper">
				<?php if( 'yes' != $hide_like && function_exists( 'crocal_eutf_social_like' ) ) { ?>
					<?php crocal_eutf_social_like( 'portfolio', 'icon'); ?>
				<?php } ?>
				<div class="eut-media eut-image-hover">
					<a class="eut-item-url" href="<?php echo esc_url( get_permalink() ); ?>"></a>
					<div class="eut-bg-dark eut-hover-overlay eut-opacity-20"></div>
					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail( $image_mode_size ); ?>
					<?php } else { ?>
						<?php echo $image_html; ?>
					<?php } ?>
				</div>
				<div class="eut-content eut-box-item eut-bg-<?php echo esc_attr( $content_bg ); ?> eut-paraller" data-limit="1x">
					<?php the_title( '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '">', '</' . tag_escape( $heading_tag ) . '>' ); ?>
					<div class="eut-description"><?php echo crocal_ext_vce_excerpt( '15' ); ?></div>
					<?php if ( !empty( $read_more_title ) ) { ?>
					<a href="<?php echo esc_url( get_permalink() ); ?>" target="_self" class="eut-read-more eut-link-text"><?php echo esc_html( $read_more_title ); ?></a>
					<?php } ?>
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
<?php
		else :
		endif;

		wp_reset_postdata();

		return ob_get_clean();


	}
	add_shortcode( 'crocal_portfolio_parallax', 'crocal_ext_vce_portfolio_parallax_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_portfolio_parallax_shortcode_params' ) ) {
	function crocal_ext_vce_portfolio_parallax_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Portfolio Parallax", "crocal-extension" ),
			"description" => esc_html__( "Display a parallax portfolio", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-portfolio-parallax",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Number of Posts", "crocal-extension" ),
					"param_name" => "posts_per_page",
					"value" => "12",
					"description" => esc_html__( "Enter how many posts you want to display.", "crocal-extension" ),
				),
				crocal_ext_vce_get_heading_tag( "h3" ),
				crocal_ext_vce_get_heading( "h5" ),
				crocal_ext_vce_get_custom_font_family(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Size", "crocal-extension" ),
					"param_name" => "image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Landscape Medium Crop', 'crocal-extension' ) => 'landscape-medium',
						esc_html__( 'Portrait Small Crop', 'crocal-extension' ) => 'portrait',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Loop Crop', 'crocal-extension' ) => 'loop',
					) ),
					"description" => esc_html__( "Select your Image size.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Read More Title", "crocal-extension" ),
					"param_name" => "read_more_title",
					"value" => "Read More",
					"description" => esc_html__( "Enter the title for your link.", "crocal-extension" ),
					"save_always" => true,
				),
				array(
					"type" => 'dropdown',
					"heading" => esc_html__( "Content Background", "crocal-extension" ),
					"param_name" => "content_bg",
					"description" => esc_html__( "Selected background color for your content.", "crocal-extension" ),
					"value" => array(
						esc_html__( "White", "crocal-extension" ) => 'white',
						esc_html__( "Black", "crocal-extension" ) => 'black',
						esc_html__( "None", "crocal-extension" ) => 'none',
					),
				),
				crocal_ext_vce_add_order_by(),
				crocal_ext_vce_add_order(),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Disable Pagination", "crocal-extension" ),
					"param_name" => "disable_pagination",
					"description" => esc_html__( "If selected, pagination will not be shown.", "crocal-extension" ),
					"value" => array( esc_html__( "Disable Pagination.", "crocal-extension" ) => 'yes' ),
					"group" => esc_html__( "Extras", "crocal-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Hide Like", "crocal-extension" ),
					"param_name" => "hide_like",
					"description" => esc_html__( "If selected, portfolio likes will be hidden", "crocal-extension" ),
					"value" => array( esc_html__( "Hide Like.", "crocal-extension" ) => 'yes' ),
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
					"param_name" => "portfolio_categories",
					"value" => crocal_ext_vce_get_portfolio_categories(),
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
	vc_lean_map( 'crocal_portfolio_parallax', 'crocal_ext_vce_portfolio_parallax_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_portfolio_parallax_shortcode_params( 'crocal_portfolio_parallax' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
