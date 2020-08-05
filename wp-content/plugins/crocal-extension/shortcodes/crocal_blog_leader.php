<?php
/**
 * Blog Leader Shortcode
 */

if( !function_exists( 'crocal_ext_vce_blog_leader_shortcode' ) ) {

	function crocal_ext_vce_blog_leader_shortcode( $atts, $content ) {

		$output = $el_class = $data_string = $auto_excerpt = '';

		extract(
			shortcode_atts(
				array(
					'categories' => '',
					'exclude_posts' => '',
					'include_posts' => '',
					'blog_leader_style' => '',
					'leader_bg_color' => 'black',
					'leader_bg_opacity' => '70',
					'heading_tag' => 'h2',
					'heading' => 'auto',
					'blog_image_mode' => 'landscape',
					'excerpt_length' => '30',
					'excerpt_more' => '',
					'hide_author' => '',
					'hide_date' => '',
					'hide_comments' => '',
					'hide_like' => '',
					'posts_per_page' => '4',
					'order_by' => 'date',
					'order' => 'DESC',
					'animation' => 'eut-zoom-in',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$blog_mode = 'leader';
		$blog_image_prio = 'yes';

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$blog_classes = array( 'eut-element', 'eut-blog-leader', 'eut-layout-1' );

		if ( !empty ( $el_class ) ) {
			array_push( $blog_classes, $el_class);
		}

		if( 'crocal' == $blog_leader_style ) {
			array_push( $blog_classes, 'eut-crocal-style' );
		}
		array_push( $blog_classes, 'eut-blog-items-' . $posts_per_page );


		$blog_class_string = implode( ' ', $blog_classes );

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
				'post__not_in' => $exclude_ids,
				'cat' => $categories,
				'paged' => 1,
				'ignore_sticky_posts' => 1,
				'orderby' => $order_by,
				'order' => $order,
			);
		}

		$query = new WP_Query( $args );


		ob_start();

		if ( $query->have_posts() ) :

?>
		<div class="<?php echo esc_attr( $blog_class_string ); ?>" style="<?php echo esc_attr( $style ); ?>">
<?php

		$animation_class  = '';
		if ( !empty( $animation ) ) {
			$animation_class = 'eut-animated-item ' . esc_attr( $animation );
		}

		$index = 0;

		$total = $query->post_count;

		while ( $query->have_posts() ) : $query->the_post();


			$post_format = get_post_format();
			$bg_post_mode = crocal_ext_vce_is_post_bg( $blog_mode, $post_format );

			$index++;
			$crocal_ext_post_class = 'eut-blog-item';
			$crocal_leader_class = 'eut-post-leader';

			if( 1 == $index  ) {
				if( 'crocal' == $blog_leader_style && 'primary-1' == $leader_bg_color ) {
					$crocal_leader_class .= ' eut-with-primary-bg';
				}
				if( 1 == $total ) {
					$crocal_leader_class .= ' eut-post-leader-only';
				}
				echo '<div class="' . esc_attr( $crocal_leader_class ) . '">';
			} else if( 2 == $index ) {
				echo '<div class="eut-post-list">';
			}
?>

				<article <?php post_class( $crocal_ext_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
					<div class="eut-blog-item-inner <?php echo esc_attr( $animation_class ); ?>">

							<?php
								if( 1 == $index && 'crocal' == $blog_leader_style ) {
									$bg_options = array(
										'bg_color' => $leader_bg_color,
										'bg_opacity' => $leader_bg_opacity,
									);
									crocal_ext_vce_post_bg_image_container( $bg_options );
								} else {
									crocal_ext_vce_print_post_feature_media( $blog_mode, $post_format, $blog_image_mode, $blog_image_prio );
								}

							?>
							<div class="eut-post-content">
								<div class="eut-post-header">
									<?php if( 1 == $index ) { ?>
										<?php if ( 'yes' != $hide_date || 'yes' != $hide_author || 'yes' != $hide_comments || 'yes' != $hide_like ) { ?>
											<ul class="eut-post-meta">
											<?php
												if ( 'yes' != $hide_author ) {
													crocal_ext_vce_print_post_author_by( $blog_mode );
												}
												if ( 'yes' != $hide_date ) {
													crocal_ext_vce_print_post_date('list');
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
										<?php crocal_ext_vce_print_post_title( $blog_mode, $post_format, $heading_tag, $heading ); ?>
										<?php crocal_ext_vce_print_structured_data(); ?>
									<?php } else { ?>
										<?php if ( 'yes' != $hide_date ) { ?>
											<ul class="eut-post-meta">
											<?php
												if ( 'yes' != $hide_date ) {
													crocal_ext_vce_print_post_date('list');
												}
											?>
											</ul>
										<?php } ?>
										<?php crocal_ext_vce_print_post_title( $blog_mode, $post_format, $heading_tag, 'h5' ); ?>
										<?php crocal_ext_vce_print_structured_data(); ?>
									<?php } ?>

								</div>
								<?php crocal_ext_vce_print_post_excerpt( $blog_mode, $post_format, $auto_excerpt, $excerpt_length, $excerpt_more ); ?>
							</div>

					</div>
				</article>

<?php
		if( 1 == $index ){
			echo '</div>';
		}

		endwhile;

		if( $index > 1 ){
			echo '</div>';
		}
?>
		</div>
<?php
		else :
		endif;

		wp_reset_postdata();

		return ob_get_clean();


	}
	add_shortcode( 'crocal_blog_leader', 'crocal_ext_vce_blog_leader_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_blog_leader_shortcode_params' ) ) {
	function crocal_ext_vce_blog_leader_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Blog Leader", "crocal-extension" ),
			"description" => esc_html__( "Display a Blog element in leader style", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-blog-leader",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Number of Posts", "crocal-extension" ),
					"param_name" => "posts_per_page",
					"value" => array(
						esc_html__( "Leader Only", "crocal-extension" ) => '1',
						esc_html__( "Leader + 2 columns", "crocal-extension" ) => '3',
						esc_html__( "Leader + 3 columns", "crocal-extension" ) => '4',
						esc_html__( "Leader + 4 columns", "crocal-extension" ) => '5',
					),
					"description" => esc_html__( "Enter how many posts you want to display.", "crocal-extension" ),
					"std" => '4',
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Mode", "crocal-extension" ),
					"param_name" => "blog_image_mode",
					'value' => apply_filters( 'crocal_ext_image_options', array(
						esc_html__( 'Landscape Small Crop', 'crocal-extension' ) => 'landscape',
						esc_html__( 'Resize ( Large )', 'crocal-extension' ) => 'large',
						esc_html__( 'Resize ( Medium Large )', 'crocal-extension' ) => 'medium_large',
						esc_html__( 'Resize ( Medium )', 'crocal-extension' ) => 'medium',
					) ),
					"description" => esc_html__( "Select your Blog Image Mode.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Leader Style", "crocal-extension" ),
					"param_name" => "blog_leader_style",
					'value' => array(
						esc_html__( 'Classic', 'crocal-extension' ) => '',
						esc_html__( 'Crocal', 'crocal-extension' ) => 'crocal',
					),
					"description" => esc_html__( "Select your Post Leader Style.", "crocal-extension" ),
					"group" => esc_html__( "Titles & Styles", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Leader Background Color", "crocal-extension" ),
					"param_name" => "leader_bg_color",
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
					),
					'std' => 'black',
					"description" => esc_html__( "This affects the Background of the item.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_leader_style", 'value' => array( 'crocal' ) ),
					"group" => esc_html__( "Titles & Styles", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Leader Background Opacity", "crocal-extension" ),
					"param_name" => "leader_bg_opacity",
					"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
					"std" => '70',
					"description" => esc_html__( "Choose the opacity for the overlay.", "crocal-extension" ),
					"dependency" => array( 'element' => "blog_leader_style", 'value' => array( 'crocal' ) ),
					"group" => esc_html__( "Titles & Styles", "crocal-extension" ),
				),
				//Titles & Styles
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Post Title Tag", "crocal-extension" ),
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
					"description" => esc_html__( "Post Title Tag for SEO", "crocal-extension" ),
					"std" => 'h2',
					"group" => esc_html__( "Titles & Styles", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Post Title Size/Typography", "crocal-extension" ),
					"param_name" => "heading",
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
					"type" => 'textfield',
					"heading" => esc_html__( "Excerpt length", "crocal-extension" ),
					"param_name" => "excerpt_length",
					"description" => esc_html__( "Type how many words you want to display in your post excerpts.", "crocal-extension" ),
					"value" => '30',
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
					"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "crocal-extension" ),
					"std" => "eut-zoom-in",
				),
				crocal_ext_vce_add_order_by(),
				crocal_ext_vce_add_order(),
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
					"heading" => esc_html__( "Categories", "crocal-extension" ),
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
	vc_lean_map( 'crocal_blog_leader', 'crocal_ext_vce_blog_leader_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_blog_leader_shortcode_params( 'crocal_blog_leader' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
