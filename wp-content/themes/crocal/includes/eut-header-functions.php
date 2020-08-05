<?php

/*
*	Header Helper functions
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

 /**
 * Print Logo
 */
function crocal_eutf_print_logo( $mode = 'default', $align = '' ) {

	if ( !empty( $align ) ) {
		$align = 'eut-position-' . $align;
	}
	$crocal_eutf_disable_logo = '';
	if ( is_singular() ) {
		$crocal_eutf_disable_logo = crocal_eutf_post_meta( '_crocal_eutf_disable_logo', $crocal_eutf_disable_logo );
	} else if( crocal_eutf_is_woo_shop() ) {
		$crocal_eutf_disable_logo = crocal_eutf_post_meta_shop( '_crocal_eutf_disable_logo', $crocal_eutf_disable_logo );
	}

	if ( 'yes' != $crocal_eutf_disable_logo ) {

		$logo_custom_link_url = crocal_eutf_option( 'logo_custom_link_url' );
		$logo_link_url = home_url( '/' );
		if( !empty( $logo_custom_link_url ) ) {
			$logo_link_url = $logo_custom_link_url;
		}

		if ( crocal_eutf_visibility( 'logo_as_text_enabled' ) ) {
?>
		<!-- Logo As Text-->
		<div class="eut-logo eut-logo-text <?php echo esc_attr( $align ); ?>">
			<a href="<?php echo esc_url( $logo_link_url ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
		</div>
<?php
		} else {
?>
		<!-- Logo -->
		<div class="eut-logo <?php echo esc_attr( $align ); ?>">
			<div class="eut-wrapper">
				<a href="<?php echo esc_url( $logo_link_url ); ?>">
<?php
				switch( $mode ) {
					case 'side':
						crocal_eutf_print_logo_data( 'logo_side', 'eut-logo-side' );
					break;
					case 'responsive':
						crocal_eutf_print_logo_data( 'logo_responsive', 'eut-logo-responsive'  );
					break;
					case 'crocal-sticky':
						crocal_eutf_print_logo_data( 'logo_sticky', 'eut-crocal-sticky');
					break;
					default:
						crocal_eutf_print_logo_data( 'logo', 'eut-default');
						crocal_eutf_print_logo_data( 'logo_light', 'eut-light');
						crocal_eutf_print_logo_data( 'logo_dark', 'eut-dark');
						crocal_eutf_print_logo_data( 'logo_sticky', 'eut-sticky');
					break;
				}
?>
				</a>
			</div>
		</div>
		<!-- End Logo -->
<?php
		}
	}
}

 /**
 * Get Logo Data
 */
function crocal_eutf_print_logo_data( $logo_id, $logo_class ) {

	$logo_url = crocal_eutf_option( $logo_id, '', 'url' );

	$logo_attributes = array();
	$logo_width = crocal_eutf_option( $logo_id, '', 'width' );
	$logo_height = crocal_eutf_option( $logo_id, '', 'height' );

	if ( !empty( $logo_width ) && !empty( $logo_height ) ) {
		$logo_attributes[] = 'width="' . esc_attr( $logo_width ) . '"';
		$logo_attributes[] = 'height="' . esc_attr( $logo_height ) . '"';
	}

	if ( !empty( $logo_url ) ) {
		$logo_url = str_replace( array( 'http:', 'https:' ), '', $logo_url );
?>
		<img class="<?php echo esc_attr( $logo_class ); ?>" src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>" <?php echo implode( ' ', $logo_attributes ); ?>>
<?php
	}

}


 /**
 * Prints correct title/subtitle for all cases
 */
function crocal_eutf_header_title() {
	global $post;
	$page_title = $page_description = $page_reversed = '';

	//Shop
	if( crocal_eutf_woocommerce_enabled() ) {

		if ( is_shop() && !is_search() ) {
			$post_id = wc_get_page_id( 'shop' );
			$page_title   = get_the_title( $post_id );
			$page_description = get_post_meta( $post_id, '_crocal_eutf_description', true );
			return array(
				'title' => $page_title,
				'description' => $page_description,
			);
		} else if( is_product_taxonomy() ) {
			$page_title  = single_term_title("", false);
			$page_description = category_description();
			return array(
				'title' => $page_title,
				'description' => $page_description,
			);
		}
	}

	//Events Calendar Overview Pages
	if ( crocal_eutf_events_calendar_is_overview() ) {
		if ( is_tax() ) {
			$page_title = single_term_title("", false);
			$page_description = term_description();
		} else {
			$page_title = tribe_get_events_title("", false);
			$page_description = '';
		}
		return array(
			'title' => $page_title,
			'description' => $page_description,
		);
	}

	//Main Pages
	if ( is_front_page() && is_home() ) {
		// Default homepage
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
		if ( 'custom' === crocal_eutf_option( 'blog_title' ) ) {
			$page_title = crocal_eutf_option( 'blog_custom_title' );
			$page_description = crocal_eutf_option( 'blog_custom_description' );
		}
	} else if ( is_front_page() ) {
		// static homepage
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
	} else if ( is_home() ) {
		// blog page
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
		if ( 'custom' === crocal_eutf_option( 'blog_title' ) ) {
			$page_title = crocal_eutf_option( 'blog_custom_title' );
			$page_description = crocal_eutf_option( 'blog_custom_description' );
		}
	} else if( is_search() ) {
		$page_description = esc_html__( 'Search Results for :', 'crocal' );
		$page_title = esc_attr( get_search_query() );
		$page_reversed = 'reversed';
	} else if ( is_singular() ) {
		$post_id = $post->ID;
		$page_title = get_the_title();
		$page_description = get_post_meta( $post_id, '_crocal_eutf_description', true );

		 if ( crocal_eutf_events_calendar_enabled() && is_singular( 'tribe_events' ) ) {
			$page_description = tribe_events_event_schedule_details( $post_id, '', '' );
			if ( tribe_get_cost() ) {
				$page_description .= '<span class="eut-event-cost">' . tribe_get_cost( null, true ) . '</span>';
			}
		} else if ( crocal_eutf_events_calendar_enabled() && is_singular( 'tribe_organizer' ) ) {
			$page_description = crocal_eutf_event_organizer_title_meta();
		}
	} else if ( is_archive() ) {
		//Post Categories
		if ( is_category() ) {
			$page_title = single_cat_title("", false);
			$page_description = category_description();
		} else if ( is_tag() ) {
			$page_title = single_tag_title("", false);
			$page_description = tag_description();
		} else if ( is_tax() ) {
			$page_title = single_term_title("", false);
			$page_description = term_description();
		} else if ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			$page_description = esc_html__( "Posts By :", 'crocal' );
			$page_title = $userdata->display_name;
			$page_reversed = 'reversed';
		} else if ( is_day() ) {
			$page_description = esc_html__( "Daily Archives :", 'crocal' );
			$page_title = get_the_time( 'l, F j, Y' );
			$page_reversed = 'reversed';
		} else if ( is_month() ) {
			$page_description = esc_html__( "Monthly Archives :", 'crocal' );
			$page_title = get_the_time( 'F Y' );
			$page_reversed = 'reversed';
		} else if ( is_year() ) {
			$page_description = esc_html__( "Yearly Archives :", 'crocal' );
			$page_title = get_the_time( 'Y' );
			$page_reversed = 'reversed';
		}  else if ( is_post_type_archive( 'tribe_events' ) && crocal_eutf_events_calendar_enabled() ) {
			$page_title = tribe_get_events_title("", false);
		} else {
			$page_title = esc_html__( "Archives", 'crocal' );
		}
	} else {
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
	}

	return array(
		'title' => $page_title,
		'description' => $page_description,
		'reversed' => $page_reversed,
	);


}

 /**
 * Check title visibility
 */
if ( !function_exists('crocal_eutf_check_title_visibility') ) {
	function crocal_eutf_check_title_visibility() {

		$blog_title = crocal_eutf_option( 'blog_title', 'sitetitle' );

		if ( is_front_page() && is_home() ) {
			// Default homepage
			if ( 'none' == $blog_title ) {
				return false;
			}
		} elseif ( is_front_page() ) {
			// static homepage
			if ( 'yes' == crocal_eutf_post_meta( '_crocal_eutf_disable_title' ) || ( crocal_eutf_is_woo_shop() && 'yes' == crocal_eutf_post_meta_shop( '_crocal_eutf_disable_title' ) ) ) {
				return false;
			}
		} elseif ( is_home() ) {
			// blog page
			if ( 'none' == $blog_title ) {
				return false;
			}
		} else {
			if ( ( is_singular() && 'yes' == crocal_eutf_post_meta( '_crocal_eutf_disable_title' ) ) || ( crocal_eutf_is_woo_shop() && 'yes' == crocal_eutf_post_meta_shop( '_crocal_eutf_disable_title' ) ) ) {
				return false;
			}
		}

		return true;

	}
}

/**
 * Prints side Header Background Image
 */
 if ( !function_exists('crocal_eutf_print_side_header_bg_image') ) {

	function crocal_eutf_print_side_header_bg_image() {

		if ( 'custom' == crocal_eutf_option( 'header_side_bg_mode' ) ) {
			$crocal_eutf_header_custom_bg = array(
				'bg_mode' => 'custom',
				'bg_image_id' => crocal_eutf_option( 'header_side_bg_image', '', 'id' ),
				'bg_position' => crocal_eutf_option( 'header_side_bg_position', 'center-center' ),
				'pattern_overlay' => crocal_eutf_option( 'header_side_pattern_overlay' ),
				'color_overlay' => crocal_eutf_option( 'header_side_color_overlay' ),
				'opacity_overlay' => crocal_eutf_option( 'header_side_opacity_overlay' ),
			);
			crocal_eutf_print_title_bg_image( $crocal_eutf_header_custom_bg );
		}

	}
}

function crocal_eutf_print_title_bg_image( $crocal_eutf_page_title = array() ) {

	$image_url = '';
	$bg_mode = crocal_eutf_array_value( $crocal_eutf_page_title, 'bg_mode', 'color' );

	if ( 'color' != $bg_mode ) {

		$bg_position = crocal_eutf_array_value( $crocal_eutf_page_title, 'bg_position', 'center-center' );

		$media_id = '0';

		if ( 'featured' == $bg_mode ) {
			$crocal_eutf_woo_shop = crocal_eutf_is_woo_shop();
			if ( is_singular() || $crocal_eutf_woo_shop ) {
				if ( $crocal_eutf_woo_shop ) {
					$id = wc_get_page_id( 'shop' );
				} else {
					$id = get_the_ID();
				}
				if( has_post_thumbnail( $id ) ) {
					$media_id = get_post_thumbnail_id( $id );
				}
			}
		} else if ( 'custom' ) {
			$media_id = crocal_eutf_array_value( $crocal_eutf_page_title, 'bg_image_id' );
		}
		$full_src = wp_get_attachment_image_src( $media_id, 'crocal-eutf-fullscreen' );
		$image_url = $full_src[0];

		if( !empty( $image_url ) ) {

			//Adaptive Background URL
			$image_url = crocal_eutf_get_adaptive_url( $media_id );

			echo '<div class="eut-background-wrapper">';
			echo '<div class="eut-bg-image eut-bg-' . esc_attr( $bg_position ) . ' eut-bg-image-id-' . esc_attr( $media_id ) . '" style="background-image: url(' . esc_url( $image_url ) . ');"></div>';
			crocal_eutf_print_overlay_container( $crocal_eutf_page_title );
			echo '</div>';
		}
	}

}

 /**
 * Prints title/subtitle ( Page )
 */
function crocal_eutf_print_header_title( $mode = 'page') {
	global $post;

	if ( crocal_eutf_check_title_visibility() ) {

        $item_type = str_replace ( '_' , '-', $mode );
		$crocal_eutf_page_title_id = 'eut-' . $item_type  . '-title';
		$crocal_eutf_page_title = array(
			'height' => crocal_eutf_option( $mode . '_title_height' ),
			'min_height' => crocal_eutf_option( $mode . '_title_min_height' ),
			'subheading_color' => crocal_eutf_option( $mode . '_subheading_color' ),
			'subheading_color_custom' => crocal_eutf_option( $mode . '_subheading_color_custom' ),
			'title_color' => crocal_eutf_option( $mode . '_title_color' ),
			'title_color_custom' => crocal_eutf_option( $mode . '_title_color_custom' ),
			'caption_color' => crocal_eutf_option( $mode . '_description_color' ),
			'caption_color_custom' => crocal_eutf_option( $mode . '_description_color_custom' ),
			'content_bg_color' => crocal_eutf_option( $mode . '_title_content_bg_color' ),
			'content_bg_color_custom' => crocal_eutf_option( $mode . '_title_content_bg_color_custom' ),
			'content_position' => crocal_eutf_option( $mode . '_title_content_position' ),
			'content_animation' => crocal_eutf_option( $mode . '_title_content_animation' ),
			'container_size' => crocal_eutf_option( $mode . '_title_container_size' ),
			'content_size' => crocal_eutf_option( $mode . '_title_content_size' ),
			'content_alignment' => crocal_eutf_option( $mode . '_title_content_alignment' ),
			'bg_mode' => crocal_eutf_option( $mode . '_title_bg_mode' ),
			'bg_image_id' => crocal_eutf_option( $mode . '_title_bg_image', '', 'id' ),
			'bg_position' => crocal_eutf_option( $mode . '_title_bg_position' ),
			'bg_color' => crocal_eutf_option( $mode . '_title_bg_color', 'dark' ),
			'bg_color_custom' => crocal_eutf_option( $mode . '_title_bg_color_custom' ),
			'pattern_overlay' => crocal_eutf_option( $mode . '_title_pattern_overlay' ),
			'color_overlay' => crocal_eutf_option( $mode . '_title_color_overlay' ),
			'color_overlay_custom' => crocal_eutf_option( $mode . '_title_color_overlay_custom' ),
			'opacity_overlay' => crocal_eutf_option( $mode . '_title_opacity_overlay' ),
		);

		$header_data = crocal_eutf_header_title();
		$header_title = isset( $header_data['title'] ) ? $header_data['title'] : '';
		$header_description = isset( $header_data['description'] ) ? $header_data['description'] : '';
		$header_reversed = isset( $header_data['reversed'] ) ? $header_data['reversed'] : '';

		if ( 'forum' == $mode && !is_singular() ) {
			$header_title = esc_html__( 'Forums' , 'crocal' );
		}

		$crocal_eutf_woo_shop = crocal_eutf_is_woo_shop();

		if ( is_singular() || $crocal_eutf_woo_shop  ) {
			if ( $crocal_eutf_woo_shop ) {
				$post_id = wc_get_page_id( 'shop' );
			} else {
				$post_id = $post->ID;
			}

			$crocal_eutf_custom_title_options = get_post_meta( $post_id, '_crocal_eutf_custom_title_options', true );
			$crocal_eutf_title_style = crocal_eutf_option( $mode . '_title_style' );
			$crocal_eutf_page_title_custom = crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'custom', $crocal_eutf_title_style );
			if ( 'custom' == $crocal_eutf_page_title_custom ) {
				$crocal_eutf_page_title = $crocal_eutf_custom_title_options;
			} else if ( 'simple' == $crocal_eutf_page_title_custom ) {
				return;
			}

		} else if ( is_tag() || is_category() || crocal_eutf_is_woo_category() || crocal_eutf_is_woo_tag() ) {
			$category_id = get_queried_object_id();
			$crocal_eutf_custom_title_options = crocal_eutf_get_term_meta( $category_id, '_crocal_eutf_custom_title_options' );
			$crocal_eutf_page_title_custom = crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'custom' );
			if ( 'custom' == $crocal_eutf_page_title_custom ) {
				$crocal_eutf_page_title = $crocal_eutf_custom_title_options;
			}
		}

		$crocal_eutf_wrapper_title_classes = array( 'eut-page-title' );

		$bg_mode = crocal_eutf_array_value( $crocal_eutf_page_title, 'bg_mode', 'color' );
		if ( 'color' == $bg_mode ) {
			$crocal_eutf_wrapper_title_classes[] = 'eut-with-title';
		} else {
			$crocal_eutf_wrapper_title_classes[] = 'eut-with-image';
		}

		$crocal_eutf_content_container_classes = array( 'eut-content' );
		$crocal_eutf_subheading_classes = array( 'eut-subheading', 'eut-title-categories', 'clearfix' );
		$crocal_eutf_title_classes = array( 'eut-title', 'eut-with-line' );
		$crocal_eutf_caption_classes = array( 'eut-description', 'clearfix' );
		$crocal_eutf_title_meta_classes = array( 'eut-title-meta-content' );
		$crocal_eutf_content_classes = array( 'eut-title-content-wrapper' );

		$content_position = crocal_eutf_array_value( $crocal_eutf_page_title, 'content_position', 'center-center' );
		$content_animation = crocal_eutf_array_value( $crocal_eutf_page_title, 'content_animation', 'fade-in' );
		$page_title_height = crocal_eutf_array_value( $crocal_eutf_page_title, 'height', '40' );
		$page_title_min_height = crocal_eutf_array_value( $crocal_eutf_page_title, 'min_height', '200' );

		$container_size = crocal_eutf_array_value( $crocal_eutf_page_title, 'container_size' );
		$crocal_eutf_content_container_classes[] = 'eut-align-' . $content_position;
		if ( 'large' == $container_size ) {
			$crocal_eutf_content_container_classes[] = 'eut-fullwidth';
		}

		if ( is_numeric( $page_title_height ) ) { //Custom Size
			$crocal_eutf_wrapper_title_classes[] = 'eut-custom-size';
		} else {
			$crocal_eutf_wrapper_title_classes[] = 'eut-' . $page_title_height . '-height';
		}

		$page_title_bg_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'bg_color', 'dark' );
		if ( 'custom' != $page_title_bg_color ) {
			$crocal_eutf_wrapper_title_classes[] = 'eut-bg-' . $page_title_bg_color;
		}

		$page_title_content_bg_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'content_bg_color', 'none' );
		$content_align = crocal_eutf_array_value( $crocal_eutf_page_title, 'content_alignment', 'center' );
		$content_size = crocal_eutf_array_value( $crocal_eutf_page_title, 'content_size', 'large' );
		if ( 'custom' != $page_title_content_bg_color ) {
			$crocal_eutf_content_classes[] = 'eut-bg-' . $page_title_content_bg_color;
		}
		$crocal_eutf_content_classes[] = 'eut-align-' . $content_align;
		$crocal_eutf_content_classes[] = 'eut-content-' . $content_size;

		$page_title_subheading_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'subheading_color', 'light' );
		if ( 'custom' != $page_title_subheading_color ) {
			$crocal_eutf_subheading_classes[] = 'eut-text-' . $page_title_subheading_color;
			$crocal_eutf_title_meta_classes[] = 'eut-text-' . $page_title_subheading_color;
		}

		$page_title_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'title_color', 'light' );
		if ( 'custom' != $page_title_color ) {
			$crocal_eutf_title_classes[] = 'eut-text-' . $page_title_color;
		}

		$page_title_caption_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'caption_color', 'light' );
		if ( 'custom' != $page_title_caption_color ) {
			$crocal_eutf_caption_classes[] = 'eut-text-' . $page_title_caption_color;
		}

		$crocal_eutf_wrapper_title_classes = implode( ' ', $crocal_eutf_wrapper_title_classes );
		$crocal_eutf_content_container_classes = implode( ' ', $crocal_eutf_content_container_classes );
		$crocal_eutf_title_classes = implode( ' ', $crocal_eutf_title_classes );
		$crocal_eutf_caption_classes = implode( ' ', $crocal_eutf_caption_classes );
		$crocal_eutf_subheading_classes = implode( ' ', $crocal_eutf_subheading_classes );
		$crocal_eutf_title_meta_classes = implode( ' ', $crocal_eutf_title_meta_classes );
		$crocal_eutf_content_classes = implode( ' ', $crocal_eutf_content_classes );

		if ( is_numeric( $page_title_height ) ) { //Custom Size
			$crocal_eutf_wrapper_style = 'height:' . esc_attr( $page_title_height ) . 'vh; min-height:' . esc_attr( $page_title_min_height ) . 'px;';
		} else {
			$crocal_eutf_wrapper_style = 'min-height:' . esc_attr( $page_title_min_height ) . 'px;';
		}
?>
	<!-- Page Title -->
	<div id="<?php echo esc_attr( $crocal_eutf_page_title_id ); ?>" class="<?php echo esc_attr( $crocal_eutf_wrapper_title_classes ); ?>" data-height="<?php echo esc_attr( $page_title_height ); ?>">
		<div class="eut-wrapper clearfix">
			<?php do_action( 'crocal_eutf_page_title_top' ); ?>
			<div class="<?php echo esc_attr( $crocal_eutf_content_container_classes ); ?>" data-animation="<?php echo esc_attr( $content_animation ); ?>">
				<div class="eut-container">
					<div class="<?php echo esc_attr( $crocal_eutf_content_classes ); ?>">
					<?php if ( empty( $header_reversed ) ) { ?>

						<?php if( 'post' == $mode && crocal_eutf_visibility( 'post_category_visibility', '1' ) ) { ?>
						<div class="<?php echo esc_attr( $crocal_eutf_subheading_classes ); ?>">
							<?php crocal_eutf_print_post_title_categories(); ?>
						</div>
						<?php } ?>

						<h1 class="<?php echo esc_attr( $crocal_eutf_title_classes ); ?>"><span><?php echo wp_kses_post( $header_title ); ?></span></h1>
						<?php if ( !empty( $header_description ) ) { ?>
						<div class="<?php echo esc_attr( $crocal_eutf_caption_classes ); ?>"><?php echo wp_kses_post( $header_description ); ?></div>
						<?php } ?>

						<?php if( 'post' == $mode ) { ?>
							<div class="<?php echo esc_attr( $crocal_eutf_title_meta_classes ); ?>">
								<?php crocal_eutf_print_post_title_meta(); ?>
							</div>
						<?php } ?>

					<?php } else { ?>
						<?php if ( !empty( $header_description ) ) { ?>
						<div class="<?php echo esc_attr( $crocal_eutf_caption_classes ); ?>"><?php echo wp_kses_post( $header_description ); ?></div>
						<?php } ?>
						<h1 class="<?php echo esc_attr( $crocal_eutf_title_classes ); ?>"><span><?php echo wp_kses_post( $header_title ); ?></span></h1>
					<?php } ?>
					</div>
				</div>
			</div>
			<?php do_action( 'crocal_eutf_page_title_bottom' ); ?>
		</div>
		<?php crocal_eutf_print_title_bg_image( $crocal_eutf_page_title ); ?>
	</div>
	<!-- End Page Title -->
<?php
	}
}

 /**
 * Prints Anchor Menu
 */
function crocal_eutf_print_anchor_menu( $mode = 'page') {

	$item_type = str_replace ( '_' , '-', $mode );
	$crocal_eutf_anchor_id = 'eut-' . $item_type  . '-anchor';
	$anchor_nav_menu = "";
    if ( is_singular() ) {
        $anchor_nav_menu = crocal_eutf_post_meta( '_crocal_eutf_anchor_navigation_menu' );
    } else if ( crocal_eutf_is_woo_shop() ) {
        $anchor_nav_menu = crocal_eutf_post_meta_shop( '_crocal_eutf_anchor_navigation_menu' );
    }
	$anchor_nav_menu = apply_filters( 'wpml_object_id', $anchor_nav_menu, 'nav_menu', TRUE  );

	if ( !empty( $anchor_nav_menu ) ) {

		$crocal_eutf_anchor_fullwidth = crocal_eutf_option( $mode . '_anchor_menu_fullwidth' );
		$crocal_eutf_anchor_alignment = crocal_eutf_option( $mode . '_anchor_menu_alignment', 'left' );

		$crocal_eutf_anchor_classes = array( 'eut-anchor-menu' );
		if ( '1' == $crocal_eutf_anchor_fullwidth ) {
			$crocal_eutf_anchor_classes[] = ' eut-fullwidth';
		}
		$crocal_eutf_anchor_classes[] = 'eut-align-' . $crocal_eutf_anchor_alignment ;
		$crocal_eutf_anchor_classes = implode( ' ', $crocal_eutf_anchor_classes );
?>
		<!-- ANCHOR MENU -->
		<div id="<?php echo esc_attr( $crocal_eutf_anchor_id ); ?>" class="<?php echo esc_attr( $crocal_eutf_anchor_classes ); ?>">
			<div class="eut-wrapper eut-anchor-wrapper">
				<div class="eut-container">
					<a href="#" class="eut-anchor-btn"><i class="eut-icon-menu"></i></a>
					<?php
					wp_nav_menu(
						array(
							'menu' => $anchor_nav_menu, /* menu id */
							'container' => false, /* no container */
							'walker' => new Crocal_Eutf_Simple_Navigation_Walker(),
						)
					);
					?>
				</div>
			</div>
		</div>
		<!-- END ANCHOR MENU -->
<?php
	}
}

 /**
 * Prints header breadcrumbs
 */
function crocal_eutf_print_header_breadcrumbs( $mode = 'page') {

	$crocal_eutf_disable_breadcrumbs = 'yes';

	if( crocal_eutf_visibility( $mode . '_breadcrumbs_enabled' ) ) {
		$crocal_eutf_disable_breadcrumbs = 'no';
		if ( is_singular() ) {
			$crocal_eutf_disable_breadcrumbs = crocal_eutf_post_meta( '_crocal_eutf_disable_breadcrumbs', $crocal_eutf_disable_breadcrumbs );
		} else if( crocal_eutf_is_woo_shop() ) {
			$crocal_eutf_disable_breadcrumbs = crocal_eutf_post_meta_shop( '_crocal_eutf_disable_breadcrumbs', $crocal_eutf_disable_breadcrumbs );
		}
	}

	if ( 'yes' != $crocal_eutf_disable_breadcrumbs  ) {

		$item_type = str_replace ( '_' , '-', $mode );
		$crocal_eutf_breadcrumbs_id = 'eut-' . $item_type  . '-breadcrumbs';
		$crocal_eutf_breadcrumbs_fullwidth = crocal_eutf_option( $mode . '_breadcrumbs_fullwidth' );
		$crocal_eutf_breadcrumbs_alignment = crocal_eutf_option( $mode . '_breadcrumbs_alignment', 'left' );

		$crocal_eutf_breadcrumbs_classes = array( 'eut-breadcrumbs', 'clearfix' );
		if ( '1' == $crocal_eutf_breadcrumbs_fullwidth ) {
			$crocal_eutf_breadcrumbs_classes[] = ' eut-fullwidth';
		}
		$crocal_eutf_breadcrumbs_classes[] = 'eut-align-' . $crocal_eutf_breadcrumbs_alignment ;
		$crocal_eutf_breadcrumbs_classes = implode( ' ', $crocal_eutf_breadcrumbs_classes );
?>
	<div id="<?php echo esc_attr( $crocal_eutf_breadcrumbs_id ); ?>" class="<?php echo esc_attr( $crocal_eutf_breadcrumbs_classes ); ?>">
		<div class="eut-breadcrumbs-wrapper">
			<div class="eut-container">
				<?php crocal_eutf_print_breadcrumbs(); ?>
			</div>
		</div>
	</div>
<?php
	}
}

/**
 * Prints header top bar text
 */
function crocal_eutf_print_header_top_bar_text( $text ) {
	if ( !empty( $text ) ) {
		$text = wpautop(preg_replace('/<\/?p\>/', "\n", $text)."\n");
?>
		<li class="eut-topbar-item eut-topbar-text-item"><?php echo do_shortcode( shortcode_unautop( $text ) ); ?></li>
<?php
	}
}

/**
 * Prints header top bar navigation
 */
function crocal_eutf_print_header_top_bar_nav( $position = 'left' ) {
?>
	<li class="eut-topbar-item">
		<nav class="eut-top-bar-menu eut-small-text eut-list-divider">
			<?php
				if( 'left' == $position ) {
					crocal_eutf_top_left_nav();
				} else {
					crocal_eutf_top_right_nav();
				}
			?>
		</nav>
	</li>
<?php
}

/**
 * Prints header top bar search icon
 */
function crocal_eutf_print_header_top_bar_search( $position = 'left' ) {
?>
	<li class="eut-topbar-item"><a href="#eut-search-modal" class="eut-icon-search eut-toggle-modal"></a></li>
<?php
}

/**
 * Prints header top bar form icon
 */
function crocal_eutf_print_header_top_bar_form( $position = 'left' ) {

	if( 'left' == $position ) {
		$modal_id = '#eut-top-left-form-modal';
	} else {
		$modal_id = '#eut-top-right-form-modal';
	}
?>
	<li class="eut-topbar-item"><a href="<?php echo esc_attr( $modal_id ); ?>" class="eut-icon-envelope eut-toggle-modal"></a></li>
<?php

}

/**
 * Prints header top bar socials
 */
function crocal_eutf_print_header_top_bar_socials( $options ) {

	global $crocal_eutf_social_list_extended;
	$social_options = crocal_eutf_option('social_options');
	if ( !empty( $options ) && !empty( $social_options ) ) {
		?>
			<li class="eut-topbar-item">
				<ul class="eut-social">
		<?php
		foreach ( $social_options as $key => $value ) {
			if ( isset( $options[$key] ) && 1 == $options[$key] && $value ) {
				if ( 'skype' == $key ) {
					echo '<li><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '" class="' . esc_attr( $crocal_eutf_social_list_extended[$key]['class'] ) . '"></a></li>';
				} else {
					echo '<li><a href="' . esc_url( $value ) . '" target="_blank" class="' . esc_attr( $crocal_eutf_social_list_extended[$key]['class'] ) . '"></a></li>';
				}
			}
		}
		?>
				</ul>
			</li>
		<?php
	}

}

/**
 * Prints header top bar language selector
 */
function crocal_eutf_print_header_top_bar_language_selector( $position = 'left' ) {

	if( 'left' == $position ) {
		$lang_style = crocal_eutf_option('top_bar_left_lang_style', 'dropdown' );
		$lang_content = crocal_eutf_option('top_bar_left_lang_content', 'flag-name' );
		$lang_hide_current_lang = crocal_eutf_option('top_bar_left_lang_hide_current_lang', 'no' );
	} else {
		$lang_style = crocal_eutf_option('top_bar_right_lang_style', 'dropdown' );
		$lang_content = crocal_eutf_option('top_bar_right_lang_content', 'flag-name' );
		$lang_hide_current_lang = crocal_eutf_option('top_bar_right_lang_hide_current_lang', 'no' );
	}

	//start language selector output buffer
    ob_start();

	$languages = '';

	//Polylang
	if( function_exists( 'pll_the_languages' ) ) {
		$languages = pll_the_languages( array( 'raw'=>1 ) );

		$lang_option_current = $lang_options = '';

		foreach ( $languages as $l ) {

			if ( !$l['current_lang'] ) {
				$lang_options .= '<li>';
				$lang_options .= '<a href="' . esc_url( $l['url'] ) . '" class="eut-language-item">';
				if ( $lang_content == 'flag-name' || $lang_content == 'flag' ) {
					$lang_options .= '<img src="' . esc_url( $l['flag'] ) . '" alt="' . esc_attr( $l['name'] ) . '"/>';
				}
				if ( $lang_content == 'flag-name' || $lang_content == 'name' ) {
					$lang_options .= esc_html( $l['name'] );
				}
				$lang_options .= '</a>';
				$lang_options .= '</li>';
			} else {
				if ( $lang_style == 'dropdown' ) {
					$lang_option_current .= '<a href="#" class="eut-language-item eut-no-link">';
					if ( $lang_content == 'flag-name' || $lang_content == 'flag' ) {
						$lang_option_current .= '<img src="' . esc_url( $l['flag'] ) . '" alt="' . esc_attr( $l['name'] ) . '"/>';
					}
					if ( $lang_content == 'flag-name' || $lang_content == 'name' ) {
						$lang_option_current .= esc_html( $l['name'] );
					}
					$lang_option_current .= '</a>';
				} else {
					if( 'no' == $lang_hide_current_lang ) {
						$lang_option_current .= '<li>';
						if ( $lang_content == 'flag-name' || $lang_content == 'flag' ) {
							$lang_option_current .= '<img src="' . esc_url( $l['flag'] ) . '" alt="' . esc_attr( $l['name'] ) . '"/>';
						}
						if ( $lang_content == 'flag-name' || $lang_content == 'name' ) {
							$lang_option_current .= esc_html( $l['name'] );
						}
						$lang_option_current .= '</li>';
					}
				}
			}
		}

	}

	//WPML
	if ( defined( 'ICL_SITEPRESS_VERSION' ) && defined( 'ICL_LANGUAGE_CODE' ) ) {

		$languages = icl_get_languages( 'skip_missing=0' );
		if ( ! empty( $languages ) ) {

			$lang_option_current = $lang_options = '';

			foreach ( $languages as $l ) {

				if ( !$l['active'] ) {
					$lang_options .= '<li>';
					$lang_options .= '<a href="' . esc_url( $l['url'] ) . '" class="eut-language-item">';
					if ( $lang_content == 'flag-name' || $lang_content == 'flag' ) {
						$lang_options .= '<img src="' . esc_url( $l['country_flag_url'] ) . '" alt="' . esc_attr( $l['language_code'] ) . '"/>';
					}
					if ( $lang_content == 'flag-name' || $lang_content == 'name' ) {
						$lang_options .= esc_html( $l['native_name'] );
					}
					$lang_options .= '</a>';
					$lang_options .= '</li>';
				} else {
					if ( $lang_style == 'dropdown' ) {
						$lang_option_current .= '<a href="#" class="eut-language-item eut-no-link">';
						if ( $lang_content == 'flag-name' || $lang_content == 'flag' ) {
							$lang_option_current .= '<img src="' . esc_url( $l['country_flag_url'] ) . '" alt="' . esc_attr( $l['language_code'] ) . '"/>';
						}
						if ( $lang_content == 'flag-name' || $lang_content == 'name' ) {
							$lang_option_current .= esc_html( $l['native_name'] );
						}
						$lang_option_current .= '</a>';
					} else {
						if( 'no' == $lang_hide_current_lang ) {
							$lang_option_current .= '<li>';
							if ( $lang_content == 'flag-name' || $lang_content == 'flag' ) {
								$lang_option_current .= '<img src="' . esc_url( $l['country_flag_url'] ) . '" alt="' . esc_attr( $l['language_code'] ) . '"/>';
							}
							if ( $lang_content == 'flag-name' || $lang_content == 'name' ) {
								$lang_option_current .= esc_html( $l['native_name'] );
							}
							$lang_option_current .= '</li>';
						}
					}
				}
			}
		}
	}
	if ( ! empty( $languages ) ) {

?>
	<li class="eut-topbar-item eut-language-style-<?php echo esc_attr( $lang_style ); ?> eut-language-content-<?php echo esc_attr( $lang_style ); ?>">
		<ul class="eut-language eut-small-text">
		   <?php if ( $lang_style == 'dropdown' ) { ?>
			<li>
				<?php echo wp_kses_post( $lang_option_current ); ?>
				<ul>
					<?php echo wp_kses_post( $lang_options ); ?>
				</ul>
			</li>
		   <?php } else { ?>
			<?php echo wp_kses_post( $lang_option_current ); ?>
			<?php echo wp_kses_post( $lang_options ); ?>
		   <?php } ?>

		</ul>
	</li>
<?php
	}
	//store the language selector buffer and clean
	$crocal_eutf_lang_selector_out = ob_get_clean();
	echo apply_filters( 'crocal_eutf_header_top_bar_language_selector', $crocal_eutf_lang_selector_out );
}

/**
 * Prints header top bar login
 */
function crocal_eutf_print_header_top_bar_login() {}


/**
 * Prints header top bar
 */
function crocal_eutf_print_header_top_bar() {

	if ( crocal_eutf_visibility( 'top_bar_enabled' ) ) {
		if ( ( is_singular() && 'yes' == crocal_eutf_post_meta( '_crocal_eutf_disable_top_bar' ) ) || ( crocal_eutf_is_woo_shop() && 'yes' == crocal_eutf_post_meta_shop( '_crocal_eutf_disable_top_bar' ) ) ) {
			return;
		}

		$section_type = crocal_eutf_option( 'top_bar_section_type', 'fullwidth-background' );
		$header_mode = crocal_eutf_option( 'header_mode', 'default' );
		$header_sticky_enable = crocal_eutf_option( 'header_sticky_enabled', 0 );
		$header_sticky_devices_enabled = crocal_eutf_option( 'header_sticky_devices_enabled', 0 );
		$top_bar_class = array('');
		if( 'fullwidth-element' == $section_type ) {
			$top_bar_class[] = 'eut-fullwidth';
		}
		if( $header_sticky_enable && 'side' != $header_mode ) {
			$top_bar_class[] = 'eut-sticky-topbar';
		}
		if( $header_sticky_devices_enabled ) {
			$top_bar_class[] = 'eut-device-sticky-topbar';
		}
		$top_bar_classes = implode( ' ', $top_bar_class );
?>

		<!-- Top Bar -->
		<div id="eut-top-bar" class="<?php echo esc_attr( $top_bar_classes ); ?>">
			<div class="eut-wrapper eut-top-bar-wrapper clearfix">
				<div class="eut-container">

					<?php
					if ( crocal_eutf_visibility( 'top_bar_left_enabled' ) ) {
					?>
					<ul class="eut-bar-content eut-left-side">
						<?php

							//Top Left First Item Hook
							do_action( 'crocal_eutf_header_top_bar_left_first_item' );

							//Top Left Options
							$top_bar_left_options = crocal_eutf_option('top_bar_left_options');

							if ( !empty( $top_bar_left_options ) ) {
								foreach ( $top_bar_left_options as $key => $value ) {
									if( !empty( $value ) && '0' != $value ) {

										switch( $key ) {
											case 'menu':
												crocal_eutf_print_header_top_bar_nav( 'left' );
											break;
											case 'search':
												crocal_eutf_print_header_top_bar_search( 'left' );
											break;
											case 'form':
												crocal_eutf_print_header_top_bar_form( 'left' );
											break;
											case 'text':
												$crocal_eutf_left_text = crocal_eutf_option('top_bar_left_text');
												crocal_eutf_print_header_top_bar_text( $crocal_eutf_left_text );
											break;
											case 'language':
												crocal_eutf_print_header_top_bar_language_selector( 'left' );
											break;
											case 'login':
												crocal_eutf_print_header_top_bar_login();
											break;
											case 'social':
												$top_bar_left_social_options = crocal_eutf_option('top_bar_left_social_options');
												crocal_eutf_print_header_top_bar_socials( $top_bar_left_social_options);
											break;
											default:
											break;
										}
									}
								}
							}

							//Top Left Last Item Hook
							do_action( 'crocal_eutf_header_top_bar_left_last_item' );

						?>
					</ul>
					<?php
						}
					?>

					<?php
					if ( crocal_eutf_visibility( 'top_bar_right_enabled' ) ) {
					?>
					<ul class="eut-bar-content eut-right-side">
						<?php

							//Top Right First Item Hook
							do_action( 'crocal_eutf_header_top_bar_right_first_item' );

							//Top Right Options
							$top_bar_right_options = crocal_eutf_option('top_bar_right_options');
							if ( !empty( $top_bar_right_options ) ) {
								foreach ( $top_bar_right_options as $key => $value ) {
									if( !empty( $value ) && '0' != $value ) {

										switch( $key ) {
											case 'menu':
												crocal_eutf_print_header_top_bar_nav( 'right' );
											break;
											case 'search':
												crocal_eutf_print_header_top_bar_search( 'right' );
											break;
											case 'form':
												crocal_eutf_print_header_top_bar_form( 'right' );
											break;
											case 'text':
												$crocal_eutf_right_text = crocal_eutf_option('top_bar_right_text');
												crocal_eutf_print_header_top_bar_text( $crocal_eutf_right_text );
											break;
											case 'language':
												crocal_eutf_print_header_top_bar_language_selector( 'right' );
											break;
											case 'login':
												crocal_eutf_print_header_top_bar_login();
											break;
											case 'social':
												$top_bar_right_social_options = crocal_eutf_option('top_bar_right_social_options');
												crocal_eutf_print_header_top_bar_socials( $top_bar_right_social_options );
											break;
											default:
											break;
										}
									}
								}
							}

							//Top Right Last Item Hook
							do_action( 'crocal_eutf_header_top_bar_right_last_item' );

						?>


					</ul>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		<!-- End Top Bar -->
<?php

	}
}

/**
 * Prints check header elements visibility
 */
function crocal_eutf_check_header_elements_visibility_any() {

	if ( !crocal_eutf_visibility( 'header_menu_options_enabled' ) ) {
		return false;
	}

	$header_menu_options = crocal_eutf_option('header_menu_options');
	if ( !empty( $header_menu_options ) ) {
		foreach ( $header_menu_options as $key => $value ) {
			if( !empty( $value ) && '0' != $value && crocal_eutf_check_header_elements_visibility( $key ) ) {
				return true;
			}
		}
	}
	return false;
}

function crocal_eutf_check_header_elements_visibility( $item = 'none' ) {

	$visibility = false;

	if ( crocal_eutf_visibility( 'header_menu_options_enabled' ) ) {

		if ( is_singular() ) {
			$crocal_eutf_disable_menu_items = crocal_eutf_post_meta( '_crocal_eutf_disable_menu_items' );
			if ( 'yes' == crocal_eutf_array_value( $crocal_eutf_disable_menu_items, $item  ) ) {
				return false;
			}
		}
		if ( crocal_eutf_is_woo_shop() ) {
			$crocal_eutf_disable_menu_items = crocal_eutf_post_meta_shop( '_crocal_eutf_disable_menu_items' );
			if ( 'yes' == crocal_eutf_array_value( $crocal_eutf_disable_menu_items, $item  ) ) {
				return false;
			}
		}

		$header_menu_options = crocal_eutf_option('header_menu_options');
		if ( !empty( $header_menu_options ) ) {
			if ( isset( $header_menu_options[ $item ] ) && !empty( $header_menu_options[ $item ] ) && '0' != $header_menu_options[ $item ] ) {
				$visibility = true;
			}
		}

	}

	return $visibility;
}

/**
 * Prints header elements e.g: social, language selector, search
 */
function crocal_eutf_print_header_elements() {

	if ( crocal_eutf_check_header_elements_visibility_any() ) {

		$header_menu_options = crocal_eutf_option('header_menu_options');
		$crocal_eutf_header_mode = crocal_eutf_option( 'header_mode', 'default' );

		$align = '';
		if ( 'side' != $crocal_eutf_header_mode ) {
			$align = 'eut-position-left';
		}

?>
		<!-- Header Elements -->
		<div class="eut-header-elements <?php echo esc_attr( $align ); ?>">
			<div class="eut-wrapper">
				<ul>
<?php

			$header_menu_social_mode = crocal_eutf_option('header_menu_social_mode', 'modal');
			do_action( 'crocal_eutf_header_elements_first_item' );

			if ( !empty( $header_menu_options ) ) {
				foreach ( $header_menu_options as $key => $value ) {
					if( !empty( $value ) && '0' != $value && crocal_eutf_check_header_elements_visibility( $key ) ) {
						if ( 'search' == $key ) {
						?>
							<li class="eut-header-element"><a href="#eut-search-modal" class="eut-toggle-modal"><span class="eut-item"><i class="eut-icon-search"></i></span></a></li>
						<?php
						} else if ( 'language' == $key ) {
						?>
							<li class="eut-header-element"><a href="#eut-language-modal" class="eut-toggle-modal"><span class="eut-item"><i class="eut-icon-globe"></i></span></a></li>
						<?php
						} else if ( 'login' == $key ) {
						} else if ( 'form' == $key ) {
						?>
							<li class="eut-header-element"><a href="#eut-menu-form-modal" class="eut-toggle-modal"><span class="eut-item"><i class="eut-icon-envelope"></i></span></a></li>
						<?php
						} else if ( 'cart' == $key && crocal_eutf_woocommerce_enabled() ) {
							global $woocommerce;
							if ( function_exists( 'wc_get_cart_url' ) ) {
								$get_cart_url = wc_get_cart_url();
							} else {
								$get_cart_url = WC()->cart->get_cart_url();
							}
						?>
							<li class="eut-header-element">
								<?php if ( is_page_template( 'page-templates/template-full-page.php' ) ) { ?>
								<a href="<?php echo esc_url( $get_cart_url ); ?>">
								<?php } else { ?>
								<a href="#eut-cart-area" class="eut-toggle-hiddenarea">
								<?php } ?>
									<span class="eut-item">
										<i class="eut-icon-shop"></i>
									</span>
								</a>
								<span class="eut-purchased-items"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
							</li>
						<?php
						} else if ( 'social' == $key ) {
							global $crocal_eutf_social_list_extended;
							$header_social_options = crocal_eutf_option('header_menu_social_options');
							$social_options = crocal_eutf_option('social_options');
							if( 'modal' == $header_menu_social_mode ) {
						?>
							<li class="eut-header-element"><a href="#eut-socials-modal" class="eut-toggle-modal"><span class="eut-item"><i class="eut-icon-socials"></i></span></a></li>
						<?php
							} else {

								if ( !empty( $header_social_options ) && !empty( $social_options ) ) {

									foreach ( $social_options as $key => $value ) {
										if ( isset( $header_social_options[$key] ) && 1 == $header_social_options[$key] && $value ) {
											if ( 'skype' == $key ) {
												echo '<li class="eut-header-element"><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '"><span class="eut-item"><i class="' . esc_attr( $crocal_eutf_social_list_extended[$key]['class'] ) . '"></i></span></a></li>';
											} else {
												echo '<li class="eut-header-element"><a href="' . esc_url( $value ) . '" target="_blank"><span class="eut-item"><i class="' . esc_attr( $crocal_eutf_social_list_extended[$key]['class'] ) . '"></i></span></a></li>';
											}
										}
									}

								}

							}
						}
					}
				}
			}

			do_action( 'crocal_eutf_header_elements_last_item' );
?>
				</ul>
			</div>
		</div>
		<!-- End Header Elements -->
<?php
	}

}

/**
 * Check header Text Visibility
 */
function crocal_eutf_header_text_visibility() {
	if ( is_singular() ) {
		if ( 'yes' == crocal_eutf_post_meta( '_crocal_eutf_disable_header_text' ) ) {
			return false;
		}
	}
	if ( crocal_eutf_is_woo_shop() ) {
		if ( 'yes' == crocal_eutf_post_meta_shop( '_crocal_eutf_disable_header_text' ) ) {
			return false;
		}
	}
	return true;
}

/**
 * Prints header Text
 */
function crocal_eutf_print_header_text() {

	$header_menu_text_element = crocal_eutf_option('header_menu_text_element');

	if ( crocal_eutf_header_text_visibility() && !empty( $header_menu_text_element ) ) {
	?>
		<div class="eut-header-elements eut-header-text-element eut-position-left">
			<div class="eut-wrapper">
				<div class="eut-item">
					<?php echo do_shortcode( $header_menu_text_element ); ?>
				</div>
			</div>
		</div>
	<?php
	}
}

/**
 * Prints header elements e.g: social, language selector, search
 */
function crocal_eutf_print_header_elements_responsive() {

	if ( crocal_eutf_check_header_elements_visibility_any() ) {
		$header_menu_options = crocal_eutf_option('header_menu_options');
		$header_menu_text_element = crocal_eutf_option('header_menu_text_element');

		do_action( 'crocal_eutf_header_elements_responsive_first_item' );

		foreach ( $header_menu_options as $key => $value ) {
			if( !empty( $value ) && '0' != $value && crocal_eutf_check_header_elements_visibility( $key ) ) {
				if ( 'search' == $key ) {
				?>
					<div class="eut-header-responsive-elements">
						<div class="eut-wrapper">
							<div class="eut-widget">
								<?php get_search_form(); ?>
							</div>
						</div>
					</div>
				<?php
				} else if ( 'language' == $key ) {
				?>
					<div class="eut-header-responsive-elements">
						<div class="eut-wrapper">
							<?php crocal_eutf_print_language_modal_selector(); ?>
						</div>
					</div>
				<?php
				} else if ( 'form' == $key ) {
				?>
					<div class="eut-header-responsive-elements">
						<div class="eut-wrapper">
							<div class="eut-newsletter">
							<?php
								$crocal_eutf_header_menu_type_form = crocal_eutf_option( 'header_menu_type_form', 'contact-form' );
								if( 'gravity-form' == $crocal_eutf_header_menu_type_form ) {
									crocal_eutf_print_gravity_form( 'header_menu_gravity_form' );
								} else {
									crocal_eutf_print_contact_form( 'header_menu_form' );
								}
							?>
							</div>
						</div>
					</div>
				<?php
				} else if ( 'social' == $key ) {
					$header_social_options = crocal_eutf_option('header_menu_social_options');
					$social_options = crocal_eutf_option('social_options');
					if ( !empty( $header_social_options ) && !empty( $social_options ) ) {
?>
						<!-- Responsive social Header Elements -->
						<div class="eut-header-responsive-elements">
							<div class="eut-wrapper">
								<ul>
<?php
									global $crocal_eutf_social_list_extended;
									foreach ( $social_options as $key => $value ) {
										if ( isset( $header_social_options[$key] ) && 1 == $header_social_options[$key] && $value ) {
											if ( 'skype' == $key ) {
												echo '<li class="eut-header-responsive-element"><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '"><span class="eut-item"><i class="' . esc_attr( $crocal_eutf_social_list_extended[$key]['class'] ) . '"></i></span></a></li>';
											} else {
												echo '<li class="eut-header-responsive-element"><a href="' . esc_url( $value ) . '" target="_blank"><span class="eut-item"><i class="' . esc_attr( $crocal_eutf_social_list_extended[$key]['class'] ) . '"></i></span></a></li>';
											}
										}
									}
?>
								</ul>
							</div>
						</div>
						<!-- End Social Header Elements -->
<?php
					}
				}
			}
		}
		if ( crocal_eutf_header_text_visibility() && !empty( $header_menu_text_element ) ) {
		?>
			<div class="eut-header-responsive-elements">
				<div class="eut-wrapper">
						<?php echo do_shortcode( $header_menu_text_element ); ?>
				</div>
			</div>
		<?php
		}
		do_action( 'crocal_eutf_header_elements_responsive_last_item' );
	}

}



/**
 * Prints Form modals
 */
function crocal_eutf_print_contact_form( $option = 'header_menu_form' ) {

	if ( class_exists('WPCF7') ) {
		$contact_form_id = crocal_eutf_option( $option );
		$contact_form_id = apply_filters( 'wpml_object_id', $contact_form_id, 'wpcf7_contact_form', TRUE  );
		if ( !empty( $contact_form_id ) ) {
			echo do_shortcode('[contact-form-7 id="' . esc_attr( $contact_form_id ) . '"]');
		}
	}

}
function crocal_eutf_print_gravity_form( $option = 'header_menu_gravity_form' ) {

	if ( class_exists('GFForms') ) {
		$contact_form_id = crocal_eutf_option( $option );
		if ( !empty( $contact_form_id ) ) {
			echo do_shortcode('[gravityform id="' . esc_attr( $contact_form_id ) . '" title="false" description="false" ajax="true"]');
		}
	}

}

function crocal_eutf_print_form_modals() {

	$crocal_eutf_left_type_form = crocal_eutf_option( 'top_bar_left_type_form', 'contact-form' );
	$crocal_eutf_right_type_form = crocal_eutf_option( 'top_bar_right_type_form', 'contact-form' );
	$crocal_eutf_header_menu_type_form = crocal_eutf_option( 'header_menu_type_form', 'contact-form' );
?>
		<div id="eut-top-left-form-modal" class="eut-modal">
			<div class="eut-modal-wrapper">
				<div class="eut-modal-content">
					<div class="eut-modal-form">
						<div class="eut-modal-item">
							<?php
								if( 'gravity-form' == $crocal_eutf_left_type_form ) {
									crocal_eutf_print_gravity_form( 'top_bar_left_gravity_form' );
								} else {
									crocal_eutf_print_contact_form( 'top_bar_left_form' );
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="eut-top-right-form-modal" class="eut-modal">
			<div class="eut-modal-wrapper">
				<div class="eut-modal-content">
					<div class="eut-modal-form">
						<div class="eut-modal-item">
							<?php
								if( 'gravity-form' == $crocal_eutf_right_type_form ) {
									crocal_eutf_print_gravity_form( 'top_bar_right_gravity_form' );
								} else {
									crocal_eutf_print_contact_form( 'top_bar_right_form' );
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="eut-menu-form-modal" class="eut-modal">
			<div class="eut-modal-wrapper">
				<div class="eut-modal-content">
					<div class="eut-modal-form">
						<div class="eut-modal-item">
							<?php
								if( 'gravity-form' == $crocal_eutf_header_menu_type_form ) {
									crocal_eutf_print_gravity_form( 'header_menu_gravity_form' );
								} else {
									crocal_eutf_print_contact_form( 'header_menu_form' );
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
}

/**
 * Prints Search modal
 */
function crocal_eutf_print_search_modal() {
?>
		<div id="eut-search-modal" class="eut-modal">
			<div class="eut-modal-wrapper">
				<div class="eut-modal-content">
					<div class="eut-modal-item">
						<?php echo crocal_eutf_modal_wpsearch(); ?>
					</div>
				</div>
			</div>
		</div>
<?php

}

/**
 * Prints header language selector
 * WPML/Polylang is required
 * Can be used to add custom php code for other translation flags.
 */
if( !function_exists( 'crocal_eutf_print_language_modal_selector' ) ) {
	function crocal_eutf_print_language_modal_selector() {

		//start language selector output buffer
		ob_start();
?>
		<ul class="eut-language">
<?php
		//Polylang
		if( function_exists( 'pll_the_languages' ) ) {
			$languages = pll_the_languages( array( 'raw'=>1 ) );
			if ( ! empty( $languages ) ) {
				foreach ( $languages as $l ) {
					echo '<li>';
					if ( !$l['current_lang'] ) {
						echo '<a href="' . esc_url( $l['url'] ) . '" class="eut-link-text">';
					} else {
						echo '<a href="#" class="eut-link-text active">';
					}
					echo esc_html( $l['name'] );

					echo '</a></li>';
				}
			}
		}

		//WPML
		if ( defined( 'ICL_SITEPRESS_VERSION' ) && defined( 'ICL_LANGUAGE_CODE' ) ) {
			$languages = icl_get_languages( 'skip_missing=0' );
			if ( ! empty( $languages ) ) {
				foreach ( $languages as $l ) {
					echo '<li>';
					if ( !$l['active'] ) {
						echo '<a href="' . esc_url( $l['url'] ) . '" class="eut-link-text">';
					} else {
						echo '<a href="#" class="eut-link-text active">';
					}
					echo esc_html( $l['native_name'] );

					echo '</a></li>';
				}
			}
		}
?>
		</ul>
<?php
		//store the language selector buffer and clean
		$crocal_eutf_lang_selector_out = ob_get_clean();
		echo apply_filters( 'crocal_eutf_language_modal_selector', $crocal_eutf_lang_selector_out );
	}
}

function crocal_eutf_print_language_modal() {
?>
	<div id="eut-language-modal" class="eut-modal">
		<div class="eut-modal-wrapper">
			<div class="eut-modal-content">
				<div class="eut-modal-item">
					<?php crocal_eutf_print_language_modal_selector(); ?>
				</div>
			</div>
		</div>
	</div>
<?php

}

function crocal_eutf_print_login_modal() {}
function crocal_eutf_print_login_responsive_button() {}

function crocal_eutf_print_social_modal() {

	$header_menu_options = crocal_eutf_option('header_menu_options');
	$header_menu_social_mode = crocal_eutf_option('header_menu_social_mode', 'modal');
	$show_social_modal = false;

	if ( !empty( $header_menu_options ) ) {
		if ( isset( $header_menu_options['social'] ) && !empty( $header_menu_options['social'] ) && '0' != $header_menu_options['social'] ) {
			if( 'modal' == $header_menu_social_mode ) {
				$show_social_modal = true;
			}
		}
	}


	if( $show_social_modal ) {

?>
	<div id="eut-socials-modal" class="eut-modal">
		<div class="eut-modal-wrapper">
			<div class="eut-modal-content eut-align-center">
				<div class="eut-modal-item">
		<?php
				$header_social_options = crocal_eutf_option('header_menu_social_options');
				$social_options = crocal_eutf_option('social_options');

					if ( !empty( $header_social_options ) && !empty( $social_options ) ) {
		?>
					<ul class="eut-social">
		<?php
						global $crocal_eutf_social_list_extended;
						foreach ( $social_options as $key => $value ) {
							if ( isset( $header_social_options[$key] ) && 1 == $header_social_options[$key] && $value ) {
								if ( 'skype' == $key ) {
									echo '<li><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '" class="' . esc_attr( $crocal_eutf_social_list_extended[$key]['class'] ) . '"></a></li>';
								} else {
									echo '<li><a href="' . esc_url( $value ) . '" target="_blank" class="' . esc_attr( $crocal_eutf_social_list_extended[$key]['class'] ) . '"></a></li>';
								}
							}
						}
		?>
					</ul>
		<?php
					}

		?>
				</div>
			</div>
		</div>
	</div>
<?php
	}
}

/**
 * Gets side area data
 */
function crocal_eutf_get_sidearea_data() {

	$crocal_eutf_sidebar_visibility = 'no';
	$crocal_eutf_sidebar_id = '';

	if ( ! is_singular() ) {
		//Overview Pages
		if( crocal_eutf_woocommerce_enabled() && is_woocommerce() ) {
			if ( is_shop() && !is_search() ) {
				$crocal_eutf_sidebar_visibility =  crocal_eutf_post_meta_shop( '_crocal_eutf_sidearea_visibility', crocal_eutf_option( 'page_sidearea_visibility' ) );
				$crocal_eutf_sidebar_id = crocal_eutf_post_meta_shop( '_crocal_eutf_sidearea_sidebar', crocal_eutf_option( 'page_sidearea_sidebar' ) );
			} else {
				$crocal_eutf_sidebar_visibility = crocal_eutf_option( 'product_tax_sidearea_visibility' );
				$crocal_eutf_sidebar_id = crocal_eutf_option( 'product_tax_sidearea_sidebar' );
			}
		} elseif ( crocal_eutf_events_calendar_is_overview() ) {
				$crocal_eutf_sidebar_visibility = crocal_eutf_option( 'event_tax_sidearea_visibility' );
				$crocal_eutf_sidebar_id = crocal_eutf_option( 'event_tax_sidearea_sidebar' );
		} else {
			$crocal_eutf_sidebar_visibility = crocal_eutf_option( 'blog_sidearea_visibility' );
			$crocal_eutf_sidebar_id = crocal_eutf_option( 'blog_sidearea_sidebar' );
		}
	} else {

		global $post;
		$post_id = $post->ID;
		$post_type = get_post_type( $post_id );

		switch( $post_type ) {
			case 'product':
				$crocal_eutf_sidebar_visibility =  crocal_eutf_post_meta( '_crocal_eutf_sidearea_visibility', crocal_eutf_option( 'product_sidearea_visibility' ) );
				$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidearea_sidebar', crocal_eutf_option( 'product_sidearea_sidebar' ) );
			break;
			case 'portfolio':
				$crocal_eutf_sidebar_visibility =  crocal_eutf_post_meta( '_crocal_eutf_sidearea_visibility', crocal_eutf_option( 'portfolio_sidearea_visibility' ) );
				$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidearea_sidebar', crocal_eutf_option( 'portfolio_sidearea_sidebar' ) );
			break;
			case 'post':
				$crocal_eutf_sidebar_visibility =  crocal_eutf_post_meta( '_crocal_eutf_sidearea_visibility', crocal_eutf_option( 'post_sidearea_visibility' ) );
				$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidearea_sidebar', crocal_eutf_option( 'post_sidearea_sidebar' ) );
			break;
			case 'tribe_events':
				$crocal_eutf_sidebar_visibility =  crocal_eutf_post_meta( '_crocal_eutf_sidearea_visibility', crocal_eutf_option( 'event_sidearea_visibility' ) );
				$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidearea_sidebar', crocal_eutf_option( 'event_sidearea_sidebar' ) );
			break;
			case 'page':
			default:
				$crocal_eutf_sidebar_visibility =  crocal_eutf_post_meta( '_crocal_eutf_sidearea_visibility', crocal_eutf_option( 'page_sidearea_visibility' ) );
				$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidearea_sidebar', crocal_eutf_option( 'page_sidearea_sidebar' ) );
			break;
		}
	}

	if( crocal_eutf_is_bbpress() ) {
		$crocal_eutf_sidebar_visibility = crocal_eutf_option( 'forum_sidearea_visibility' );
		$crocal_eutf_sidebar_id = crocal_eutf_option( 'forum_sidearea_sidebar' );
	}

	return array(
		'visibility' => $crocal_eutf_sidebar_visibility,
		'sidebar' => $crocal_eutf_sidebar_id,
	);
}

/**
 * Prints side area toggle button
 */
if( !function_exists( 'crocal_eutf_print_sidearea_button' ) ) {
	function crocal_eutf_print_sidearea_button( $sidearea_data ) {

		$crocal_eutf_sidebar_visibility = $sidearea_data['visibility'];
		$crocal_eutf_sidebar_id = $sidearea_data['sidebar'];

		if ( 'yes' == $crocal_eutf_sidebar_visibility ) {
?>
		<a href="#eut-sidearea" class="eut-sidearea-btn eut-toggle-sidearea eut-pullup-icon">
			<svg width="18px" height="18px" viewBox="0 0 18 18"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M0,8 L18,8 L18,10 L0,10 L0,8 Z M3,13 L15,13 L15,15 L3,15 L3,13 Z M3,3 L15,3 L15,5 L3,5 L3,3 Z" fill="#000000" fill-rule="nonzero"></path></g></svg>
		</a>

<?php
		}
	}
}

/**
 * Prints header hidden area toggle button
 */
function crocal_eutf_print_header_hiddenarea_button() {
	$crocal_eutf_responsive_menu_selection = crocal_eutf_option( 'menu_responsive_toggle_selection', 'icon' );
	$crocal_eutf_responsive_menu_text = crocal_eutf_option( 'menu_responsive_toggle_text');
?>
	<div class="eut-hidden-menu-btn eut-position-right">
		<div class="eut-header-element">
			<a href="#eut-hidden-menu" class="eut-toggle-hiddenarea">
				<?php if ( 'icon' == $crocal_eutf_responsive_menu_selection ) { ?>
				<span class="eut-item">
					<span></span>
					<span></span>
					<span></span>
				</span>
				<?php } else { ?>
				<span class="eut-item eut-with-text">
					<span class="eut-label">
						<?php echo esc_html( $crocal_eutf_responsive_menu_text ); ?>
					</span>
				</span>
				<?php } ?>
			</a>
		</div>
	</div>
<?php

}

/**
 * Prints Side Area
 */
function crocal_eutf_print_side_area( $sidearea_data ) {

	$crocal_eutf_sidebar_visibility = $sidearea_data['visibility'];
	$crocal_eutf_sidebar_id = $sidearea_data['sidebar'];

	if ( 'yes' == $crocal_eutf_sidebar_visibility ) {
?>
	<aside id="eut-sidearea" class="eut-side-area">
		<a class="eut-sidearea-close-btn eut-pullup-icon eut-hide" href="#">
			<svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon fill="#000000" fill-rule="nonzero" points="9.07106781 7.65685425 14.7279221 2 16.1421356 3.41421356 10.4852814 9.07106781 16.1421356 14.7279221 14.7279221 16.1421356 9.07106781 10.4852814 3.41421356 16.1421356 2 14.7279221 7.65685425 9.07106781 2 3.41421356 3.41421356 2"></polygon></g></svg>
		</a>
		<div class="eut-side-area-wrapper">
			<div class="eut-side-area-content">
				<?php
					if( is_active_sidebar( $crocal_eutf_sidebar_id ) ) {
						dynamic_sidebar( $crocal_eutf_sidebar_id );
					} else {
						if( current_user_can( 'administrator' ) ) {
							echo esc_html__( 'No widgets found in Side Area!', 'crocal'  ) . "<br/>" .
							"<a href='" . esc_url( admin_url() ) . "widgets.php'>" .
							esc_html__( "Activate Widgets", 'crocal' ) .
							"</a>";
						}
					}
				?>
			</div>

		</div>
	</aside>
<?php
	}
}

/**
 * Prints Shop Cart Responsive link
 */
function crocal_eutf_print_cart_responsive_link() {

	if ( crocal_eutf_woocommerce_enabled() && crocal_eutf_check_header_elements_visibility( 'cart' ) ) {

		global $woocommerce;

		if ( function_exists( 'wc_get_cart_url' ) ) {
			$get_cart_url = wc_get_cart_url();
		} else {
			$get_cart_url = WC()->cart->get_cart_url();
		}
?>
		<div class="eut-header-elements eut-position-right">
			<div class="eut-wrapper">
				<ul>
					<li class="eut-header-element">
						<a href="<?php echo esc_url( $get_cart_url ); ?>">
							<span class="eut-item">
								<i class="eut-icon-shop"></i>
							</span>
						</a>
						<span class="eut-purchased-items"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
					</li>
				</ul>
			</div>
		</div>

<?php

	}
}

/**
 * Prints Shop Cart
 */
function crocal_eutf_print_cart_area() {

	if ( crocal_eutf_woocommerce_enabled() && crocal_eutf_check_header_elements_visibility( 'cart' ) ) {

?>

		<div id="eut-cart-area" class="eut-hidden-area">
			<div class="eut-hiddenarea-wrapper">
				<!-- Close Button -->
				<div class="eut-close-btn-wrapper">
					<div class="eut-close-btn"><i class="eut-icon-close"></i></div>
				</div>
				<!-- End Close Button -->
				<div class="eut-hiddenarea-content">
					<div class="eut-shopping-cart-content"></div>
				</div>
			</div>
		</div>

<?php
	}

}

/**
 * Prints Hidden Menu
 */
function crocal_eutf_print_hidden_menu() {

	$crocal_eutf_hidden_menu_classes = array('eut-hidden-area');
	$crocal_eutf_menu_open_type = crocal_eutf_option( 'menu_responsive_open_type', 'toggle' );
	$crocal_eutf_menu_width = crocal_eutf_option( 'menu_responsive_width', 'small' );
	$crocal_eutf_menu_align = crocal_eutf_option( 'menu_responsive_align', 'left' );
	$crocal_eutf_hidden_menu_classes[] = 'eut-' . $crocal_eutf_menu_width . '-width';
	$crocal_eutf_hidden_menu_classes[] = 'eut-' . $crocal_eutf_menu_open_type . '-menu';
	$crocal_eutf_hidden_menu_classes[] = 'eut-align-' . $crocal_eutf_menu_align;
	$crocal_eutf_hidden_menu_classes = implode( ' ', $crocal_eutf_hidden_menu_classes );

	$crocal_eutf_menu_text = crocal_eutf_option( 'menu_responsive_text' );
?>
	<nav id="eut-hidden-menu" class="eut-hidden-area <?php echo esc_attr( $crocal_eutf_hidden_menu_classes ); ?>">
		<div class="eut-hiddenarea-wrapper">
			<!-- Close Button -->
			<div class="eut-close-btn-wrapper">
				<div class="eut-close-btn"><i class="eut-icon-close"></i></div>
			</div>
			<!-- End Close Button -->
			<div class="eut-hiddenarea-content">
				<?php
					$crocal_eutf_responsive_menu = crocal_eutf_get_responsive_nav();
					if ( 'disabled' != $crocal_eutf_responsive_menu && ( !empty( $crocal_eutf_responsive_menu ) || has_nav_menu( 'crocal_responsive_nav' ) ) ) {
				?>
				<div id="eut-responsive-menu-wrapper" class="eut-menu-wrapper">
					<?php crocal_eutf_responsive_nav( $crocal_eutf_responsive_menu ); ?>
				</div>
				<?php
						$hidden_wrapper_id = 'eut-responsive-hidden-menu-wrapper';
					} else {
						$hidden_wrapper_id = 'eut-hidden-menu-wrapper';
					}
				?>

				<div id="<?php echo esc_attr( $hidden_wrapper_id ); ?>" class="eut-menu-wrapper">
					<?php
						$crocal_eutf_main_menu = crocal_eutf_get_header_nav();
						if ( 'disabled' != $crocal_eutf_main_menu ) {
							crocal_eutf_header_nav( $crocal_eutf_main_menu );
						}
					?>
				</div>
				<?php if ( !empty( $crocal_eutf_menu_text ) ) { ?>
				<div class="eut-hidden-menu-text">
					<?php echo do_shortcode( $crocal_eutf_menu_text ); ?>
				</div>
				<?php } ?>
				<?php crocal_eutf_print_header_elements_responsive(); ?>
			</div>

		</div>
	</nav>
<?php

}

function crocal_eutf_print_item_nav_link( $post_id,  $direction, $title = '' ) {

	$icon_class = 'arrow-right';
	if ( 'prev' == $direction ) {
		$icon_class = 'arrow-left';
	}
?>
	<li><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="eut-icon-<?php echo esc_attr( $icon_class ); ?>" title="<?php echo esc_attr($title); ?>"></a></li>
<?php
}


/**
 * Check Theme Loader Visibility
 */
function crocal_eutf_check_theme_loader_visibility() {

	$crocal_eutf_theme_loader = '';

	if ( is_singular() ) {
		$crocal_eutf_theme_loader = crocal_eutf_post_meta( '_crocal_eutf_theme_loader' );
	}
	if ( crocal_eutf_is_woo_shop() ) {
		$crocal_eutf_theme_loader = crocal_eutf_post_meta_shop( '_crocal_eutf_theme_loader' );
	}

	if( empty( $crocal_eutf_theme_loader ) ) {
		return crocal_eutf_visibility( 'theme_loader' );
	} else {
		if ( 'yes' == $crocal_eutf_theme_loader ) {
			return true;
		} else {
			return false;
		}
	}

}
/**
 * Prints Theme Loader
 */
function crocal_eutf_print_theme_loader() {
	$page_transition = crocal_eutf_option('page_transition');
	$show_spinner = crocal_eutf_option('show_spinner');

	$crocal_eutf_loader_classes = array();
	if( 'none' != $page_transition ) {
		$crocal_eutf_loader_classes[] = 'eut-page-transition';
		$crocal_eutf_loader_classes[] = 'eut-' . $page_transition . '-transition';
	}

	$crocal_eutf_loader_classes = implode( ' ', $crocal_eutf_loader_classes );

	if ( crocal_eutf_check_theme_loader_visibility() ) {
?>
	<!-- LOADER -->
	<div id="eut-loader-overflow" class="<?php echo esc_attr( $crocal_eutf_loader_classes ); ?>">
		<?php if( '0' != $show_spinner ) { ?>
		<div class="eut-spinner"><div></div><div></div><div></div><div></div></div>
		<?php } ?>
	</div>
<?php
	}
}

function crocal_eutf_bottom_bar_area_css() {

	$custom_css_code = "";

	$crocal_area_id = crocal_eutf_option('bottom_bar_area');
	if ( is_singular() ) {
		$crocal_area_id = crocal_eutf_post_meta( '_crocal_eutf_bottom_bar_area', $crocal_area_id );
	}
	if( crocal_eutf_is_woo_shop() ) {
		$crocal_area_id = crocal_eutf_post_meta_shop( '_crocal_eutf_bottom_bar_area', $crocal_area_id );
	}
	$crocal_area_id = apply_filters( 'wpml_object_id', $crocal_area_id, 'area-item', TRUE  );
	if ( !empty( $crocal_area_id ) && 'none' != $crocal_area_id ) {
		$custom_css_code = get_post_meta( $crocal_area_id, '_wpb_shortcodes_custom_css', true );
		if ( ! empty( $custom_css_code ) ) {
			$custom_css_code = strip_tags( $custom_css_code );
		}
	}
	return $custom_css_code;
}

function crocal_eutf_shop_css() {
	$shop_id = $custom_css_code = '';
	if ( crocal_eutf_woocommerce_enabled() && is_shop() ) {
		$shop_id = wc_get_page_id( 'shop' );
	}
	if ( !empty( $shop_id ) ) {
		$custom_css_code = get_post_meta( $shop_id, '_wpb_shortcodes_custom_css', true );
		if ( ! empty( $custom_css_code ) ) {
			$custom_css_code = strip_tags( $custom_css_code );
		}
	}
	return $custom_css_code;
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
