<?php

/*
 *	Blog Helper functions
 *
 * 	@version	1.0
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */


 /**
 * Prints excerpt
 */
function crocal_eutf_print_post_excerpt( $post_format = 'standard' ) {

	$excerpt_length = crocal_eutf_option( 'blog_excerpt_length' );
	$excerpt_more = crocal_eutf_option( 'blog_excerpt_more' );


	if ( 'large' != crocal_eutf_option( 'blog_mode', 'large' ) ) {
		$excerpt_length = crocal_eutf_option( 'blog_excerpt_length_small' );
		$excerpt_auto = '1';
	} else {
		$excerpt_length = crocal_eutf_option( 'blog_excerpt_length' );
		$excerpt_auto = crocal_eutf_option( 'blog_auto_excerpt' );
	}

	if ( 'link' ==  $post_format || 'quote' ==  $post_format ) {
		$excerpt_more = 0;
		$excerpt_auto = '1';
	}

	if ( '1' == $excerpt_auto ) {
		if ( 'quote' ==  $post_format ) {
			echo crocal_eutf_quote_excerpt( $excerpt_length );
		} else {
			echo crocal_eutf_excerpt( $excerpt_length, $excerpt_more  );
		}
	} else {
		if ( '1' == $excerpt_more ) {
			the_content( esc_html__( 'read more', 'crocal' ) );
		} else {
			the_content( '' );
		}
	}

}

function crocal_eutf_isotope_inner_before() {
	$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );
	$blog_animation = crocal_eutf_option( 'blog_animation', 'none' );

	$wrapper_attributes = array();

	$classes = array( 'eut-blog-item-inner', 'eut-isotope-item-inner' );
	if ( 'none' != $blog_animation ) {
		if ( 'large' == $blog_mode )  {
			$classes[] = 'eut-animated-item';
		}
		$classes[] = $blog_animation;
	}
	$class_string = implode( ' ', $classes );
	$wrapper_attributes[] = 'class="' . esc_attr( $class_string ) . '"';


	if ( 'none' != $blog_animation ) {
		if ( 'large' == $blog_mode )  {
			$wrapper_attributes[] = 'data-delay="200"';
		}
	}

	echo '<div ' . implode( ' ', $wrapper_attributes ) .'>';
}

function crocal_eutf_isotope_inner_after() {
	echo '</div>';
}
add_action( 'crocal_eutf_inner_post_loop_item_before', 'crocal_eutf_isotope_inner_before' );
add_action( 'crocal_eutf_inner_post_loop_item_after', 'crocal_eutf_isotope_inner_after' );

function crocal_eutf_get_loop_title_heading_tag() {

	$heading = crocal_eutf_option( 'blog_heading_tag', 'auto' );
	$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );

	if( 'auto' != $heading ) {
		$title_tag = $heading;
	} else {
		$title_tag = 'h3';
		if( 'large' == $blog_mode || 'small' == $blog_mode  ) {
			$title_tag = 'h2';
		}
	}
	return $title_tag;
}

function crocal_eutf_get_loop_title_heading() {

	$heading = crocal_eutf_option( 'blog_heading', 'auto' );
	$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );

	if( 'auto' != $heading ) {
		$heading_class = $heading;
	} else {
		$heading_class = 'h3';
		if( 'large' == $blog_mode || 'small' == $blog_mode  ) {
			$heading_class = 'h2';
		}
	}
	return $heading_class;
}

function crocal_eutf_loop_post_title( $class = "eut-post-title" ) {
	$title_tag = crocal_eutf_get_loop_title_heading_tag();
	$title_class = crocal_eutf_get_loop_title_heading();
	the_title( '<' . tag_escape( $title_tag ) . ' class="' . esc_attr( $class ). ' eut-' . esc_attr( $title_class ) . '" itemprop="name headline">', '</' . tag_escape( $title_tag ) . '>' );
}function crocal_eutf_loop_post_title_link() {
	$title_tag = crocal_eutf_get_loop_title_heading_tag();
	$title_class = crocal_eutf_get_loop_title_heading();
	the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><' . tag_escape( $title_tag ) . ' class="eut-post-title eut-' . esc_attr( $title_class ) . '" itemprop="name headline">', '</' . tag_escape( $title_tag ) . '></a>' );
}
function crocal_eutf_loop_post_title_hidden() {
	$title_tag = crocal_eutf_get_loop_title_heading_tag();
	the_title( '<' . tag_escape( $title_tag ) . ' class="eut-hidden" itemprop="name headline">', '</' . tag_escape( $title_tag ) . '>' );
}


add_action( 'crocal_eutf_inner_post_loop_item_title', 'crocal_eutf_loop_post_title' );
add_action( 'crocal_eutf_inner_post_loop_item_title_link', 'crocal_eutf_loop_post_title_link' );
add_action( 'crocal_eutf_inner_post_loop_item_title_hidden', 'crocal_eutf_loop_post_title_hidden' );

 /**
 * Prints Single Post Title
 */
function crocal_eutf_print_post_simple_title() {
	global $post;
	if ( crocal_eutf_check_title_visibility() ) {

		$post_id = $post->ID;
		$crocal_eutf_custom_title_options = get_post_meta( $post_id, '_crocal_eutf_custom_title_options', true );

		$crocal_eutf_title_style = crocal_eutf_option( 'post_title_style' );
		$crocal_eutf_page_title_custom = crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'custom', $crocal_eutf_title_style );
		if ( 'simple' == $crocal_eutf_page_title_custom ) {
			echo '<div class="eut-post-title-wrapper eut-margin-bottom-1x">';
			echo '<div class="eut-container">';
			the_title( '<h1 class="eut-single-simple-title" itemprop="name headline">', '</h1>' );
			crocal_eutf_print_post_title_meta( 'simple' );
			echo '</div>';
			echo '</div>';
		} else {
			the_title( '<h2 class="eut-hidden" itemprop="name headline">', '</h2>' );
		}
	} else {
		the_title( '<h2 class="eut-hidden" itemprop="name headline">', '</h2>' );
	}
}


/**
 * Gets Blog Class
 */
function crocal_eutf_get_blog_class() {

	$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );
	$blog_shadow_style = crocal_eutf_option( 'blog_shadow_style', 'shadow-mode' );
	switch( $blog_mode ) {

		case 'small':
			$crocal_eutf_blog_mode_class = 'eut-blog eut-blog-columns eut-blog-small eut-isotope';
			break;
		case 'masonry':
			$crocal_eutf_blog_mode_class = 'eut-blog eut-blog-columns eut-blog-masonry eut-isotope eut-with-gap';
			break;
		case 'grid':
			$crocal_eutf_blog_mode_class = 'eut-blog eut-blog-columns eut-blog-grid eut-isotope eut-with-gap';
			break;
		case 'large':
		default:
			$crocal_eutf_blog_mode_class = 'eut-blog eut-blog-large eut-non-isotope';
			break;
	}

	if ( 'shadow-mode' == $blog_shadow_style && ( 'masonry' == $blog_mode || 'grid' == $blog_mode ) ) {
		$crocal_eutf_blog_mode_class .= ' eut-with-shadow';
	}

	return $crocal_eutf_blog_mode_class;

}
/**
 * Gets post class
 */
function crocal_eutf_get_post_class( $extra_class = '' ) {

	$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );
	$post_classes = array( 'eut-blog-item' );
	if ( !empty( $extra_class ) ){
		$post_classes[] = $extra_class;
	}

	switch( $blog_mode ) {

		case 'small':
			$post_classes[] = 'eut-small-post';
			$post_classes[] = 'eut-isotope-item';
			break;

		case 'masonry':
		case 'grid':
			$post_classes[] = 'eut-isotope-item';
			break;
		default:
			$post_classes[] = 'eut-big-post';
			$post_classes[] = 'eut-non-isotope-item';
			break;
	}

	return implode( ' ', $post_classes );

}

/**
 * Prints post item data
 */
function crocal_eutf_print_blog_data() {

	$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );
	$columns_large_screen = crocal_eutf_option( 'blog_columns_large_screen', '3' );
	$columns = crocal_eutf_option( 'blog_columns', '3' );
	$columns_tablet_landscape  = crocal_eutf_option( 'blog_columns_tablet_landscape', '2' );
	$columns_tablet_portrait  = crocal_eutf_option( 'blog_columns_tablet_portrait', '2' );
	$columns_mobile  = crocal_eutf_option( 'blog_columns_mobile', '1' );
	$gutter = crocal_eutf_option( 'blog_gutter', 'yes' );
	$gutter_size = crocal_eutf_option( 'blog_gutter_size', '30' );
	$display_style = crocal_eutf_option( 'blog_display_style', 'pagination' );
	if ( 'large' == $blog_mode ) {
		$display_style = 'pagination';
	}
	if( 'yes' != $gutter ) {
		$gutter_size = 0;
	}

	$wrapper_attributes = array();
	$wrapper_attributes[] = 'data-display-style="' . esc_attr( $display_style ) . '"';

	switch( $blog_mode ) {

		case 'masonry':
			$wrapper_attributes[] = 'data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '"';
			$wrapper_attributes[] = 'data-columns="' . esc_attr( $columns ) . '"';
			$wrapper_attributes[] = 'data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '"';
			$wrapper_attributes[] = 'data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '"';
			$wrapper_attributes[] = 'data-columns-mobile="' . esc_attr( $columns_mobile ) . '"';
			$wrapper_attributes[] = 'data-layout="masonry"';
			$wrapper_attributes[] = 'data-gutter-size="' . esc_attr( $gutter_size ) . '"';
			break;
		case 'grid':
			$wrapper_attributes[] = 'data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '"';
			$wrapper_attributes[] = 'data-columns="' . esc_attr( $columns ) . '"';
			$wrapper_attributes[] = 'data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '"';
			$wrapper_attributes[] = 'data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '"';
			$wrapper_attributes[] = 'data-columns-mobile="' . esc_attr( $columns_mobile ) . '"';
			$wrapper_attributes[] = 'data-layout="fitRows"';
			$wrapper_attributes[] = 'data-gutter-size="' . esc_attr( $gutter_size ) . '"';
			break;
		case 'small':
			$wrapper_attributes[] = 'data-columns-large-screen="1"';
			$wrapper_attributes[] = 'data-columns="1"';
			$wrapper_attributes[] = 'data-columns-tablet-landscape="1"';
			$wrapper_attributes[] = 'data-columns-tablet-portrait="1"';
			$wrapper_attributes[] = 'data-columns-mobile="1"';
			$wrapper_attributes[] = 'data-layout="fitRows"';
			break;
		default:
			break;
	}

	echo implode( ' ', $wrapper_attributes );

}

 /**
 * Prints post feature media
 */
function crocal_eutf_print_post_feature_media( $post_type ) {

	if ( !crocal_eutf_visibility( 'blog_media_area', '1' ) ){
		return;
	}
	$blog_image_prio = crocal_eutf_option( 'blog_image_prio', 'no' );
	$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );

	if ( 'yes' == $blog_image_prio && has_post_thumbnail() ) {
		crocal_eutf_print_post_feature_image();
	} else {

		switch( $post_type ) {
			case 'audio':
				crocal_eutf_print_post_audio();
				break;
			case 'video':
				crocal_eutf_print_post_video();
				break;
			case 'gallery':
				$slider_items = crocal_eutf_post_meta( '_crocal_eutf_post_slider_items' );
				switch( $blog_mode ) {
					case 'large':
						$image_size = 'crocal-eutf-large-rect-horizontal';
						break;
					default:
						$image_size  = 'crocal-eutf-small-rect-horizontal';
						break;
				}
				if ( !empty( $slider_items ) ) {
					crocal_eutf_print_gallery_slider( 'blog-slider', $slider_items, $image_size );
				}
				break;
			default:
				crocal_eutf_print_post_feature_image();
				break;
		}
	}

}


function crocal_eutf_get_blog_image_atts() {

	$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );
	$columns_large_screen = crocal_eutf_option( 'blog_columns_large_screen', '5' );
	$columns = crocal_eutf_option( 'blog_columns', '4' );
	$columns_tablet_landscape  = crocal_eutf_option( 'blog_columns_tablet_landscape', '4' );
	$columns_tablet_portrait  = crocal_eutf_option( 'blog_columns_tablet_portrait', '2' );
	$columns_mobile  = crocal_eutf_option( 'blog_columns_mobile', '1' );

	$image_atts = array();

	switch( $blog_mode ) {

		case 'masonry':
		case 'grid':
				$image_atts['data-gutter-size'] = 15;
				$image_atts['data-columns-large-screen'] = $columns_large_screen;
				$image_atts['data-columns'] = $columns;
				$image_atts['data-columns-tablet-landscape'] = $columns_tablet_landscape;
				$image_atts['data-columns-tablet-portrait'] = $columns_tablet_portrait;
				$image_atts['data-columns-mobile'] = $columns_mobile;
			break;
		default:
			break;
	}

	return $image_atts;

}

 /**
 * Prints post feature image
 */
function crocal_eutf_print_post_feature_image() {

	$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );
	$blog_image_mode = crocal_eutf_option( 'blog_image_mode', 'landscape-large-wide' );
	$blog_grid_image_mode = crocal_eutf_option( 'blog_grid_image_mode', 'landscape' );
	$blog_masonry_image_mode = crocal_eutf_option( 'blog_masonry_image_mode', 'medium' );

	if ( 'grid' == $blog_mode || 'small' == $blog_mode ) {
		$blog_image_mode = $blog_grid_image_mode;
	} else if ( 'masonry' == $blog_mode ) {
		$blog_image_mode = $blog_masonry_image_mode;
	}

	$image_size = crocal_eutf_get_image_size( $blog_image_mode );

	$image_href = get_permalink();

	if ( has_post_thumbnail() ) {
	$image_atts = crocal_eutf_get_blog_image_atts();
?>
	<div class="eut-media clearfix">
		<a href="<?php echo esc_url( $image_href ); ?>"><?php crocal_eutf_the_post_thumbnail( $image_size, $image_atts ); ?></a>
	</div>
<?php
	}

}

 /**
 * Prints post meta area
 */
if ( !function_exists('crocal_eutf_print_post_meta_top') ) {
	function crocal_eutf_print_post_meta_top() {
?>
			<div class="eut-post-header">
				<ul class="eut-post-meta">
					<?php crocal_eutf_print_post_author_by( 'list'); ?>
					<?php crocal_eutf_print_post_date( 'list' ); ?>
					<?php crocal_eutf_print_post_loop_comments(); ?>
					<?php crocal_eutf_print_like_counter_overview(); ?>
				</ul>
				<?php do_action( 'crocal_eutf_inner_post_loop_item_title_link' ); ?>
			</div>
<?php

	}
}


/**
 * Prints Post Tags
 */
function crocal_eutf_print_post_tags() {
	global $post;
	$post_id = $post->ID;
?>
	<?php if ( crocal_eutf_visibility( 'post_tag_visibility', '1' ) ) { ?>

		<div class="eut-single-post-tags eut-padding-bottom-2x">
			<?php the_tags('<ul class="eut-tags eut-link-text eut-heading-color"><li>','</li><li>','</li></ul>'); ?>
		</div>

	<?php } ?>

<?php
}


 /**
 * Prints Post Title Categories
 */
function crocal_eutf_print_post_title_categories( $post_id = null) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$post_terms = wp_get_object_terms( $post_id, 'category', array( 'fields' => 'ids' ) );
	if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
		$term_ids = implode( ',' , $post_terms );
		echo '<ul class="eut-categories">';
		echo wp_list_categories( 'title_li=&style=list&echo=0&hierarchical=0&taxonomy=category&include=' . $term_ids );
		echo '</ul>';
	}
}

 /**
 * Prints Post Title Categories Simple
 */
function crocal_eutf_print_post_title_categories_simple( $post_id = null) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$post_terms = wp_get_object_terms( $post_id, 'category', array( 'fields' => 'ids' ) );
	if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
		echo '<li class="eut-post-categories">';
		esc_html_e( 'in', 'crocal' );
		echo ' ';
		the_category( ', ' );
		echo '</li>';
	}
}


 /**
 * Prints Post Title Meta
 */

function crocal_eutf_print_post_title_meta( $mode = "") {

$meta_class = "eut-post-meta";
if ( 'simple' == $mode ) {
	$meta_class .= " eut-link-text";
}
?>
	<ul class="<?php echo esc_attr( $meta_class ); ?>">
		<?php crocal_eutf_print_post_author_by( 'list'); ?>
		<?php crocal_eutf_print_post_date( 'list'); ?>
		<?php crocal_eutf_print_post_loop_comments(); ?>
		<?php crocal_eutf_print_like_counter_overview( 'single' ); ?>
		<?php if ( 'simple' == $mode && crocal_eutf_visibility( 'post_category_visibility', '1' ) ) { ?>
		<?php crocal_eutf_print_post_title_categories_simple(); ?>
		<?php } ?>
	</ul>
<?php
}

 /**
 * Prints Post Title Meta
 */

function crocal_eutf_print_feature_post_title_meta( $post_id = null ) {

	if( $post_id ) {
		$post_author_id = get_post_field( 'post_author', $post_id );
		$userdata = get_userdata( $post_author_id );
		$post_comments_number = get_comments_number( $post_id );
		$post_likes = crocal_eutf_option( 'post_social', '', 'eut-likes' );

?>
	<div class="eut-title-meta">
		<ul class="eut-post-meta eut-small-text">
			<?php if ( crocal_eutf_visibility( 'blog_author_visibility', '1' ) ) { ?>
			<li class="eut-post-author"></i>
				<span><?php echo esc_html( $userdata->display_name ); ?></span>
			</li>
			<?php } ?>
			<?php if ( crocal_eutf_visibility( 'blog_date_visibility' ) ) { ?>
			<li class="eut-post-date"></i>
				<time datetime="<?php echo esc_attr( get_the_date( 'c', $post_id  ) ); ?>"><?php echo esc_html( get_the_date( '', $post_id  ) ); ?></time>
			</li>
			<?php } ?>
		</ul>
	</div>
<?php
	}
}


 /**
 * Prints post author by
 */
function crocal_eutf_print_post_author_by( $mode = '') {

	if ( crocal_eutf_visibility( 'blog_author_visibility', '1' ) ) {

		if( 'list' == $mode ) {
			echo '<li class="eut-post-author">';
			echo '<span>' . get_the_author_link() . '</span>';
			echo '</li>';
		} else {
			echo '<div class="eut-post-author">';
			echo '<span>' . get_the_author_link() . '</span>';
			echo '</div>';
		}
	}
}



 /**
 * Prints like counter for overview pages
 */
function crocal_eutf_print_like_counter_overview( $mode = '' ) {

	if( crocal_eutf_visibility( 'blog_like_visibility', '1' ) ) {
		crocal_eutf_print_like_counter( $mode );
	}

}

 /**
 * Prints like counter
 */
function crocal_eutf_print_like_counter( $mode = '' ) {

	$post_likes = crocal_eutf_option( 'post_social', '', 'eut-likes' );
	if ( !empty( $post_likes  ) ) {
		global $post;
		$post_id = $post->ID;
		if ( 'single' == $mode ) {
?>
		<li class="eut-like-counter <?php echo crocal_eutf_likes( $post_id, 'status' ); ?>"><span><?php echo crocal_eutf_likes( $post_id ); ?></span></li>
<?php
		} else {
?>
		<li class="eut-like-counter <?php echo crocal_eutf_likes( $post_id, 'status' ); ?>"><span><?php echo crocal_eutf_likes( $post_id ); ?></span></li>
<?php
		}
	}

}

/**
 * Prints post date
 */
if ( !function_exists('crocal_eutf_print_post_date') ) {
	function crocal_eutf_print_post_date( $mode = '' ) {
		if ( crocal_eutf_visibility( 'blog_date_visibility' ) ) {
			$class = "";
			if( 'list' == $mode ) {
				echo '<li class="eut-post-date">';
			} else if ( 'quote' == $mode ) {
				$class = "eut-post-date eut-small-text eut-circle-arrow";
			} else if ( 'default' == $mode ) {
				$class = "eut-post-date eut-link-text eut-text-primary-1";
			}
			global $post;
?>
		<time class="<?php echo esc_attr( $class ); ?>" datetime="<?php echo mysql2date( 'c', $post->post_date ); ?>">
			<?php echo esc_html( get_the_date() ); ?>
		</time>
<?php
			if( 'list' == $mode ) {
				echo '</li>';
			}
		}
	}
}

function crocal_eutf_print_post_loop_comments() {
	if ( crocal_eutf_visibility( 'blog_comments_visibility' ) ) {
?>
	<li class="eut-post-comments"><span><?php comments_number(); ?></span></li>
	<?php
	}
}

function crocal_eutf_print_post_loop_categories() {
	if ( crocal_eutf_visibility( 'blog_categories_visibility' ) ) {
		global $post;
		$post_id = $post->ID;
		$post_terms = wp_get_object_terms( $post_id, 'category', array( 'fields' => 'ids' ) );
		if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
			$term_ids = implode( ',' , $post_terms );
			echo '<ul class="eut-categories">';
			echo wp_list_categories( 'title_li=&style=list&echo=0&hierarchical=0&taxonomy=category&include=' . $term_ids );
			echo '</ul>';
		}
	}
}

/**
 * Prints post feature bg image container
 */
function crocal_eutf_print_post_bg_image_container( $options ) {

	$bg_color = crocal_eutf_array_value( $options, 'bg_color' );
	$bg_hover_color = crocal_eutf_array_value( $options, 'bg_hover_color' );
	$bg_opacity = crocal_eutf_array_value( $options, 'bg_opacity', '80' );
	$mode = crocal_eutf_array_value( $options, 'mode' );
	$overlay = true;

	$link_classes = array();
	$link_classes[] = 'eut-bg-' . $bg_color;
	if( !empty( $bg_hover_color ) ){
		$link_classes[] = 'eut-bg-hover-' . $bg_hover_color;
	}
	$link_classes[] = 'eut-bg-overlay';
	if ( has_post_thumbnail() ) {
		$link_classes[] = 'eut-opacity-' . $bg_opacity;
		if ( 'none' == $bg_opacity || '0' == $bg_opacity ) {
			$overlay = false;
		}
	} else {
		$link_classes[] = 'eut-opacity-100';
	}
	$link_class_string = implode( ' ', $link_classes );

?>
	<div class="eut-media eut-bg-wrapper">
		<?php
			if ( 'image' == $mode ) {
				crocal_eutf_print_post_image( $options );
			} else {
				crocal_eutf_print_post_bg_image();
			}
		?>
		<?php if( $overlay ) { ?>
		<div class="<?php echo esc_attr( $link_class_string ); ?>"></div>
		<?php } ?>
	</div>
<?php
}

function crocal_eutf_print_post_image( $options = array() ) {

	$image_size = crocal_eutf_array_value( $options, 'image_size', 'crocal-eutf-fullscreen' );

	if ( has_post_thumbnail() ) {
		crocal_eutf_the_post_thumbnail( $image_size );
	} else {
		$image_src = get_template_directory_uri() . '/images/transparent/' . $image_size . '.png';
?>
		<img class="attachment-<?php echo esc_attr( $image_size ); ?>" src="<?php echo esc_url( $image_src ); ?>" alt="<?php the_title_attribute(); ?>"/>
<?php
	}
}


function crocal_eutf_print_post_bg_image( $image_size = 'crocal-eutf-fullscreen' ) {
	if ( has_post_thumbnail() ) {
		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$attachment_src = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
		$image_url = $attachment_src[0];
?>
		<div class="eut-bg-image" style="background-image: url(<?php echo esc_url( $image_url ); ?>);"></div>
<?php
	}
}

/**
 * Prints author avatar
 */
function crocal_eutf_print_post_author() {
	global $post;
	$post_id = $post->ID;
	$post_type = get_post_type( $post_id );

	if ( 'page' == $post_type ||  'portfolio' == $post_type  ) {
		return;
	}
?>
	<div class="eut-post-author">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?>
	</div>
<?php

}

/**
 * Prints audio shortcode of post format audio
 */
function crocal_eutf_print_post_audio() {
	global $wp_embed;

	$audio_mode = crocal_eutf_post_meta( '_crocal_eutf_post_type_audio_mode' );
	$audio_mp3 = crocal_eutf_post_meta( '_crocal_eutf_post_audio_mp3' );
	$audio_ogg = crocal_eutf_post_meta( '_crocal_eutf_post_audio_ogg' );
	$audio_wav = crocal_eutf_post_meta( '_crocal_eutf_post_audio_wav' );
	$audio_embed = crocal_eutf_post_meta( '_crocal_eutf_post_audio_embed' );

	$audio_output = '';

	if( empty( $audio_mode ) && !empty( $audio_embed ) ) {
		echo '<div class="eut-media">' . $audio_embed . '</div>';
	} else {
		if ( !empty( $audio_mp3 ) || !empty( $audio_ogg ) || !empty( $audio_wav ) ) {

			$audio_output .= '[audio ';

			if ( !empty( $audio_mp3 ) ) {
				$audio_output .= 'mp3="'. esc_url( $audio_mp3 ) .'" ';
			}
			if ( !empty( $audio_ogg ) ) {
				$audio_output .= 'ogg="'. esc_url( $audio_ogg ) .'" ';
			}
			if ( !empty( $audio_wav ) ) {
				$audio_output .= 'wav="'. esc_url( $audio_wav ) .'" ';
			}

			$audio_output .= ']';

			echo '<div class="eut-media">';
			echo  do_shortcode( $audio_output );
			echo '</div>';
		}
	}

}

/**
 * Prints video of the video post format
 */
function crocal_eutf_print_post_video() {

	$video_mode = crocal_eutf_post_meta( '_crocal_eutf_post_type_video_mode' );
	$video_webm = crocal_eutf_post_meta( '_crocal_eutf_post_video_webm' );
	$video_mp4 = crocal_eutf_post_meta( '_crocal_eutf_post_video_mp4' );
	$video_ogv = crocal_eutf_post_meta( '_crocal_eutf_post_video_ogv' );
	$video_poster = crocal_eutf_post_meta( '_crocal_eutf_post_video_poster' );
	$video_embed = crocal_eutf_post_meta( '_crocal_eutf_post_video_embed' );

	crocal_eutf_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed, $video_poster );
}

/**
 * Prints video popup of the video post format
 */
function crocal_eutf_print_post_video_popup() {

	$video_mode = crocal_eutf_post_meta( '_crocal_eutf_post_type_video_mode' );

	if( empty( $video_mode ) ) {
		$video_embed = crocal_eutf_post_meta( '_crocal_eutf_post_video_embed' );
		if ( !empty( $video_embed ) ) {
?>
	<a class="eut-video-popup eut-post-icon" href="<?php echo esc_url( $video_embed ); ?>">
		<?php echo crocal_eutf_get_video_icon(); ?>
	</a>
<?php
		}
	} else {
		$video_webm = crocal_eutf_post_meta( '_crocal_eutf_post_video_webm' );
		$video_mp4 = crocal_eutf_post_meta( '_crocal_eutf_post_video_mp4' );
		$video_ogv = crocal_eutf_post_meta( '_crocal_eutf_post_video_ogv' );
		$video_id = uniqid('eut-video-id-');
		if ( !empty( $video_webm ) || !empty( $video_mp4 ) || !empty( $video_ogv ) ) {
?>
	<a class="eut-html5-video-popup eut-post-icon" href="#<?php echo esc_attr( $video_id ); ?>">
		<i class="eut-icon-video"></i>
		<svg class="eut-animated-circle" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60"><circle fill="none" stroke="#ffffff" stroke-width="2" cx="30" cy="30" r="29" transform="rotate(-90 30 30)"/></svg>
		<div id="<?php echo esc_attr( $video_id ); ?>" class="eut-html5-video-popup-container mfp-hide">
			<?php crocal_eutf_print_post_video(); ?>
		</div>
	</a>
<?php
		}
	}
}


function crocal_eutf_get_related_posts( $max_posts = 3 ) {

	$crocal_eutf_tag_ids = array();

	$crocal_eutf_tags_list = get_the_tags();
	if ( ! empty( $crocal_eutf_tags_list ) ) {
		foreach ( $crocal_eutf_tags_list as $tag ) {
			array_push( $crocal_eutf_tag_ids, $tag->term_id );
		}
	}
	$exclude_ids = array( get_the_ID() );
	$tag_found = false;

	$query = array();
	if ( ! empty( $crocal_eutf_tag_ids ) ) {
		$args = array(
			'tag__in' => $crocal_eutf_tag_ids,
			'post__not_in' => $exclude_ids,
			'posts_per_page' => $max_posts,
			'paged' => 1,
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$tag_found = true;
		}
	}

	wp_reset_postdata();

	if ( $tag_found ) {
		return $query;
	} else {
		return array();
	}
}

/**
 * Prints related posts ( Single Post )
 */
function crocal_eutf_print_related_posts( $query = array() ) {

	if ( !empty( $query ) ) {
		$eut_related_title_first = crocal_eutf_option( 'post_related_title_first' );
		$eut_related_title_second = crocal_eutf_option( 'post_related_title_second' );
?>

	<div id="eut-related-post" class="eut-related eut-border">
		<div class="eut-wrapper">
			<?php if( !empty( $eut_related_title_first ) ||  !empty( $eut_related_title_second ) ) { ?>
			<div class="eut-related-title">
				<?php if( !empty( $eut_related_title_first ) ) { ?>
				<div class="eut-description eut-link-text eut-align-center"><?php echo esc_html( $eut_related_title_first ); ?></div>
				<?php } ?>
				<?php if( !empty( $eut_related_title_second ) ) { ?>
				<div class="eut-title eut-h5 eut-align-center"><?php echo esc_html( $eut_related_title_second ); ?></div>
				<?php } ?>
			</div>
			<?php } ?>
			<div class="eut-section eut-row-section eut-equal-columns">
				<div class="eut-container">
					<div class="eut-row eut-bookmark eut-columns-gap-default eut-mobile-vertical-gap-30">

<?php
	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
		get_template_part( 'templates/post', 'related' );
	endwhile;
	else :
	endif;
?>
					</div>
				</div>
			</div>


		</div>
	</div>
<?php
	}

	wp_reset_postdata();
}


/**
 * Likes ajax callback ( used in Single Post )
 */
function crocal_eutf_likes_callback( $post_id ) {
	
	check_ajax_referer( 'crocal-eutf-likes', '_eutf_nonce' );

	$likes = 0;
	$status = "";

	if ( isset( $_POST['eut_likes_id'] ) ) {
		$post_id = sanitize_text_field( $_POST['eut_likes_id'] );
		$response = crocal_eutf_likes( $post_id, 'update' );
	} else {
		$response = array(
			'status' => $status,
			'likes' => $likes,
		);
	}
	wp_send_json( $response );

	die();
}

add_action( 'wp_ajax_crocal_eutf_likes_callback', 'crocal_eutf_likes_callback' );
add_action( 'wp_ajax_nopriv_crocal_eutf_likes_callback', 'crocal_eutf_likes_callback' );

function crocal_eutf_likes( $post_id, $action = 'get' ) {

	$status = '';

	if( !is_numeric( $post_id ) ) {
		$likes = 0;
	} else {
		$likes = get_post_meta( $post_id, '_crocal_eutf_likes', true );
	}

	if( !$likes || !is_numeric( $likes ) ) {
		$likes = 0;
	}

	if ( 'update' == $action ) {

		if( is_numeric( $post_id ) ) {
			if ( isset( $_COOKIE['_crocal_eutf_likes_' . $post_id] ) ) {
				unset( $_COOKIE['_crocal_eutf_likes_' . $post_id] );
				setcookie( '_crocal_eutf_likes_' . $post_id, "", 1, '/' );
				if( 0 != $likes ) {
					$likes--;
					update_post_meta( $post_id, '_crocal_eutf_likes', $likes );
				}

			} else {
				$likes++;
				update_post_meta( $post_id, '_crocal_eutf_likes', $likes );
				setcookie('_crocal_eutf_likes_' . $post_id, $post_id, time()*20, '/');
				$status = 'active';
			}
		}

		return $response = array(
			'status' => $status,
			'likes' => $likes,
		);

	} elseif ( 'status' == $action ) {
		if( is_numeric( $post_id ) ) {
			if ( isset( $_COOKIE['_crocal_eutf_likes_' . $post_id] ) && 0 != $likes) {
				$status = 'active';
			}
		}
		return $status;
	} elseif ( 'number' == $action ) {
		return $likes;
	}

	return crocal_eutf_likes_text( $likes );
}

function crocal_eutf_likes_text( $number ) {
	if ( $number > 1 ) {
		$output = sprintf( _n( '%s Like', '%s Likes', $number, 'crocal' ), number_format_i18n( $number ) );
	} elseif ( $number == 0 ) {
		$output = esc_html__( 'No Likes', 'crocal' );
	} else { // must be one
		$output = esc_html__( '1 Like', 'crocal'  );
	}
	return apply_filters( 'crocal_eutf_likes_text', $output, $number );
}


 /**
 * Prints About Author ( Post )
 */
 if ( !function_exists('crocal_eutf_print_post_about_author') ) {
	function crocal_eutf_print_post_about_author() {

	$eut_post_author_intro_text = crocal_eutf_option( 'post_author_intro_text' );
	$eut_post_author_description = get_the_author_meta( 'user_description' );

	$post_author_classes = array( 'eut-about-author', 'eut-border', 'eut-padding-top-2x', 'eut-padding-bottom-2x' );
	$post_author_class_string = implode( ' ', $post_author_classes );
?>
	<?php if ( crocal_eutf_visibility( 'post_author_visibility' ) && !empty( $eut_post_author_description ) ) { ?>
		<!-- About Author -->
		<div class="<?php echo esc_attr( $post_author_class_string ); ?>">
			<div class="eut-author-image">
				<?php echo get_avatar( get_the_author_meta('ID'), 90 ); ?>
			</div>
			<div class="eut-author-info">
				<?php if( !empty( $eut_post_author_intro_text ) ) { ?>
				<div class="eut-about-author-text eut-small-text">
					<?php echo esc_html( $eut_post_author_intro_text ) . '  '; ?>
				</div>
				<?php } ?>
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					<h2 class="eut-title eut-h5"><?php the_author_link(); ?></h2>
				</a>
				<p><?php echo get_the_author_meta( 'user_description' ); ?></p>
			</div>
		</div>
		<!-- End About Author -->
	<?php } ?>
<?php
	}
}

/**
 * Prints post structured data
 */
if ( !function_exists( 'crocal_eutf_print_post_structured_data' ) ) {
	function crocal_eutf_print_post_structured_data( $args = array() ) {

		if ( has_post_thumbnail() ) {
			$url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full') ;
			$image_url = $url[0];
			$image_width = $url[1];
			$image_height = $url[2];

		} else {
			$image_url = get_template_directory_uri() . '/images/empty/thumbnail.jpg';
			$image_width = 150;
			$image_height = 150;
		}
	?>
		<span class="eut-hidden">
			<span class="eut-structured-data entry-title"><?php the_title(); ?></span>
			<span class="eut-structured-data" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
			   <span itemprop='url' ><?php echo esc_url( $image_url ); ?></span>
			   <span itemprop='height' ><?php echo esc_html( $image_width ); ?></span>
			   <span itemprop='width' ><?php echo esc_html( $image_height ); ?></span>
			</span>
			<?php if ( crocal_eutf_visibility( 'blog_author_visibility', '1' ) ) { ?>
			<span class="eut-structured-data vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<span itemprop="name" class="fn"><?php the_author(); ?></span>
			</span>
			<span class="eut-structured-data" itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
				<span itemprop='name'><?php the_author(); ?></span>
				<span itemprop='logo' itemscope itemtype='http://schema.org/ImageObject'>
					<span itemprop='url'><?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ); ?></span>
				</span>
			</span>
			<?php } else { ?>
			<span class="eut-structured-data vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<span itemprop="name" class="fn"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			</span>
			<span class="eut-structured-data" itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
				<span itemprop='name'><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				<span itemprop='logo' itemscope itemtype='http://schema.org/ImageObject'>
					<span itemprop='url'><?php echo esc_url( $image_url ); ?></span>
				</span>
			</span>
			<?php } ?>
			<time class="eut-structured-data date published" itemprop="datePublished" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
			<time class="eut-structured-data date updated" itemprop="dateModified"  datetime="<?php echo get_the_modified_time('c'); ?>"><?php echo get_the_modified_date(); ?></time>
			<span class="eut-structured-data" itemprop="mainEntityOfPage" itemscope itemtype="http://schema.org/WebPage" itemid="<?php echo esc_url( get_permalink() ); ?>"></span>
		</span>
	<?php
	}
}


//Omit closing PHP tag to avoid accidental whitespace output errors.
