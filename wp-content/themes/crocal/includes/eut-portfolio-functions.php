<?php

/*
*	Portfolio Helper functions
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/


/**
 * Prints portfolio feature image
 */
function crocal_eutf_print_portfolio_feature_image( $image_size = 'large', $second_image_id = "" ) {

	if( empty( $second_image_id ) ) {
		if ( has_post_thumbnail() ) {
?>
		<div class="eut-media clearfix">
			<?php crocal_eutf_the_post_thumbnail( $image_size ); ?>
		</div>
<?php

		}
	} else {
?>
		<div class="eut-media clearfix">
			<?php echo crocal_eutf_get_attachment_image( $second_image_id, $image_size ); ?>
		</div>
<?php

	}



}

/**
 * Prints Portfolio socials if used
 */
function crocal_eutf_print_portfolio_media() {
	global $post;
	$post_id = $post->ID;

	$portfolio_media = crocal_eutf_post_meta( '_crocal_eutf_portfolio_media_selection' );
	$portfolio_image_mode = crocal_eutf_post_meta( '_crocal_eutf_portfolio_media_image_mode' );
	$portfolio_media_fullwidth = crocal_eutf_post_meta( '_crocal_eutf_portfolio_media_fullwidth' );
	$image_size_slider = 'crocal-eutf-large-rect-horizontal';
	if ( 'resize' == $portfolio_image_mode || 'yes' == $portfolio_media_fullwidth ) {
		if( crocal_eutf_option( 'has_sidebar' ) ) {
			$image_size_slider = "large";
		} else {
			$image_size_slider = "crocal-eutf-fullscreen";
		}
	}

	switch( $portfolio_media ) {

		case 'slider':
			$slider_items = crocal_eutf_post_meta( '_crocal_eutf_portfolio_slider_items' );
			crocal_eutf_print_gallery_slider( 'slider', $slider_items, $image_size_slider );
			break;
		case 'gallery':
			$slider_items = crocal_eutf_post_meta( '_crocal_eutf_portfolio_slider_items' );
			crocal_eutf_print_gallery_slider( 'gallery', $slider_items, '', 'eut-classic-style' );
			break;
		case 'gallery-vertical':
			$slider_items = crocal_eutf_post_meta( '_crocal_eutf_portfolio_slider_items' );
			crocal_eutf_print_gallery_slider( 'gallery-vertical', $slider_items, $image_size_slider, 'eut-vertical-style' );
			break;
		case 'video':
			crocal_eutf_print_portfolio_video();
			break;
		case 'video-html5':
			crocal_eutf_print_portfolio_video( 'html5' );
			break;
		case 'video-code':
			crocal_eutf_print_portfolio_video( 'code' );
			break;
		case 'none':
			break;
		default:
			if( crocal_eutf_option( 'has_sidebar' ) ) {
				$image_size = "large";
			} else {
				$image_size = "crocal-eutf-fullscreen";
			}

			$second_image = crocal_eutf_post_meta( '_crocal_eutf_second_featured_image' );
			if ( 'second-image' == $portfolio_media ) {
				if( !empty( $second_image ) ) {
					crocal_eutf_print_portfolio_feature_image( $image_size, $second_image );
				}
			} else {
				crocal_eutf_print_portfolio_feature_image( $image_size );
			}

			break;

	}
}


/**
 * Prints video of the portfolio media
 */
function crocal_eutf_print_portfolio_video( $video_mode = '' ) {

	$video_webm = crocal_eutf_post_meta( '_crocal_eutf_portfolio_video_webm' );
	$video_mp4 = crocal_eutf_post_meta( '_crocal_eutf_portfolio_video_mp4' );
	$video_ogv = crocal_eutf_post_meta( '_crocal_eutf_portfolio_video_ogv' );
	$video_poster = crocal_eutf_post_meta( '_crocal_eutf_portfolio_video_poster' );
	$video_embed = crocal_eutf_post_meta( '_crocal_eutf_portfolio_video_embed' );

	if( 'code' == $video_mode ) {
		$video_embed = crocal_eutf_post_meta( '_crocal_eutf_portfolio_video_code' );
	}

	crocal_eutf_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed, $video_poster );
}

 /**
 * Prints portfolio like counter
 */
function crocal_eutf_print_portfolio_like_counter( $counter_color = 'content' ) {

	$post_likes = crocal_eutf_option( 'portfolio_social', '', 'eut-likes' );
	if ( !empty( $post_likes  ) ) {
		global $post;
		$post_id = $post->ID;
		$active = crocal_eutf_likes( $post_id, 'status' );
		$icon = 'far fa-heart';
		if( 'active' == $active ) {
			$icon = 'fas fa-heart';
		}
?>
		<div class="eut-like-counter eut-link-text eut-text-<?php echo esc_attr( $counter_color ); ?>"><i class="<?php echo esc_attr( $icon ); ?>"></i><span><?php echo crocal_eutf_likes( $post_id ); ?></span></div>
<?php
	}

}


/**
 * Check Portfolio details if used
 */

function crocal_eutf_check_portfolio_details() {
	global $post;
	$post_id = $post->ID;

	$eut_portfolio_details = crocal_eutf_post_meta( '_crocal_eutf_details', '' );
	$portfolio_fields = get_the_terms( $post_id, 'portfolio_field' );

	if ( !empty( $eut_portfolio_details ) || ! empty( $portfolio_fields ) ) {
		return true;
	}

	$eut_social_bar_layout = crocal_eutf_post_meta( '_crocal_eutf_social_bar_layout', crocal_eutf_option( 'portfolio_social_bar_layout', 'layout-1' ) );
	if( 'layout-2' == $eut_social_bar_layout && crocal_eutf_social_bar ( 'portfolio', 'check' ) ) {
		return true;
	}
	return false;

}

/**
 * Prints Portfolio details
 */
if ( !function_exists('crocal_eutf_print_portfolio_details') ) {
	function crocal_eutf_print_portfolio_details() {
		global $post;
		$post_id = $post->ID;

		$heading_tag = crocal_eutf_option( 'portfolio_details_heading_tag', 'div' );
		$eut_portfolio_details_title = crocal_eutf_post_meta( '_crocal_eutf_details_title', crocal_eutf_option( 'portfolio_details_text' ) );
		$eut_portfolio_details = crocal_eutf_post_meta( '_crocal_eutf_details', '' );
		$portfolio_fields = get_the_terms( $post_id, 'portfolio_field' );

		$link_text = crocal_eutf_post_meta( '_crocal_eutf_details_link_text', crocal_eutf_option( 'portfolio_details_link_text' ) );
		$link_url = crocal_eutf_post_meta( '_crocal_eutf_details_link_url' );
		$link_new_window = crocal_eutf_post_meta( '_crocal_eutf_details_link_new_window' );
		$link_extra_class = crocal_eutf_post_meta( '_crocal_eutf_details_link_extra_class' );

		$link_classes = array( 'eut-portfolio-details-btn', 'eut-btn' );
		if( !empty( $link_extra_class ) ){
			array_push( $link_classes,  $link_extra_class );
		}
		if ( ! empty( $portfolio_fields ) ) {
			array_push( $link_classes,  'eut-margin-bottom-1x' );
		}
		$link_class_string = implode( ' ', $link_classes );

	?>

		<!-- Portfolio Info -->
		<div class="eut-portfolio-info eut-border">
			<?php
			if ( !empty( $eut_portfolio_details ) ) {
			?>
			<!-- Portfolio Description -->
			<div class="eut-portfolio-description eut-border">
				<<?php echo tag_escape( $heading_tag ); ?> class="eut-h5 eut-widget-title"><?php echo wp_kses_post( $eut_portfolio_details_title ); ?></<?php echo tag_escape( $heading_tag ); ?>>
				<p><?php echo do_shortcode( wp_kses_post( $eut_portfolio_details ) ) ?></p>
				<?php
					// Portfolio Link
					if( !empty( $link_url )  ) {
						$link_target = "_self";
						if( !empty( $link_new_window )  ) {
							$link_target = "_blank";
						}
					?>
					<a href="<?php echo esc_url( $link_url ); ?>" class="<?php echo esc_attr( $link_class_string ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_text ); ?></a>
					<?php
					}
					?>
			</div>
			<!-- End Portfolio Description -->
			<?php
			}
			?>
			<?php
			if ( ! empty( $portfolio_fields ) ) {
			?>
			<!-- Fields -->
			<ul class="eut-portfolio-fields eut-border">
				<?php
					foreach( $portfolio_fields as $field ) {
						echo '<li class="eut-fields-title">';
						if ( !empty( $field->description ) ) {
							echo '<span class="eut-fields-description eut-heading-color eut-link-text eut-field-label">' . wp_kses_post( $field->description ) . '</span>';
						}
						echo '<span class="eut-small-text">' . esc_html( $field->name ) . '</span>';
						echo '</li>';
					}
				?>
			</ul>
			<!-- End Fields -->
			<?php
			}

			$eut_social_bar_layout = crocal_eutf_post_meta( '_crocal_eutf_social_bar_layout', crocal_eutf_option( 'portfolio_social_bar_layout', 'layout-1' ) );
			if( 'layout-2' == $eut_social_bar_layout ) {
				crocal_eutf_social_bar ( 'portfolio', 'layout-2' );
			}

			?>
		</div>
		<!-- End Portfolio Info -->
	<?php

	}
}

/**
 * Prints Portfolio Recents items. ( Classic Layout )
 */
function crocal_eutf_print_recent_portfolio_items_classic() {

	$exclude_ids = array( get_the_ID() );
	$args = array(
		'post_type' => 'portfolio',
		'post_status'=>'publish',
		'post__not_in' => $exclude_ids ,
		'posts_per_page' => 3,
		'paged' => 1,
	);


	$query = new WP_Query( $args );

	$eut_portfolio_recent_title = crocal_eutf_option( 'portfolio_recent_title' );

	if ( $query->have_posts() ) {
?>

	<!-- Related -->
	<div id="eut-portfolio-related" class="eut-related eut-border eut-padding-top-4x eut-padding-bottom-4x">
		<div class="eut-wrapper">
			<?php if( !empty( $eut_portfolio_recent_title ) ) { ?>
			<div class="eut-description eut-link-text eut-align-center"><?php echo esc_html( $eut_portfolio_recent_title); ?></div>
			<?php } ?>
			<div class="eut-section eut-row-section eut-equal-columns">
				<div class="eut-container">
					<div class="eut-row eut-bookmark eut-columns-gap-default eut-mobile-vertical-gap-30">
		<?php
			if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
				get_template_part( 'templates/portfolio', 'recent' );
			endwhile;
			else :
			endif;
		?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Related -->
<?php
		wp_reset_postdata();
	}
}

/**
 * Prints Portfolio Recents items. ( Crocal Layout )
 */
function crocal_eutf_print_recent_portfolio_items_crocal() {

	$exclude_ids = array( get_the_ID() );
	$args = array(
		'post_type' => 'portfolio',
		'post_status'=>'publish',
		'post__not_in' => $exclude_ids ,
		'posts_per_page' => 2,
		'paged' => 1,
	);


	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
?>

	<!-- Related -->
	<div class="eut-post-bar-item eut-post-related">
		<?php
			if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
				get_template_part( 'templates/portfolio', 'recent' );
			endwhile;
			else :
			endif;
		?>
	</div>
	<!-- End Related -->
<?php
		wp_reset_postdata();
	}
}


/**
 * Prints Portfolio Feature Image
 */
function crocal_eutf_print_portfolio_image( $image_size = 'crocal-eutf-small-square', $mode = '', $atts = array() ) {

	if ( has_post_thumbnail() ) {
		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$attachment_src = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
		$image_src = $attachment_src[0];
		if ( 'link' == $mode ){
			echo esc_url( $image_src );
		} else {
			if ( 'color' == $mode ){
				$image_src = get_template_directory_uri() . '/images/transparent/' . $image_size . '.png';
?>
				<img src="<?php echo esc_url( $image_src ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="<?php echo esc_attr( $attachment_src[1] ); ?>" height="<?php echo esc_attr( $attachment_src[2] ); ?>"/>
<?php
			} else {
				echo crocal_eutf_get_attachment_image( $post_thumbnail_id, $image_size, '', $atts );
			}

		}
	} else {
		$image_src = get_template_directory_uri() . '/images/empty/' . $image_size . '.jpg';
		if ( 'link' == $mode ){
			echo esc_url( $image_src );
		} else {
			if ( 'color' == $mode ){
				$image_src = get_template_directory_uri() . '/images/transparent/' . $image_size . '.png';
			}
?>
		<img src="<?php echo esc_url( $image_src ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>"/>
<?php
		}
	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
