<?php

/*
*	Woocommerce helper functions and configuration
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

/**
 * Helper function to check if woocommerce is enabled
 */
function crocal_eutf_woocommerce_enabled() {

	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
	return false;

}

function crocal_eutf_is_woo_shop() {
	if ( crocal_eutf_woocommerce_enabled() && is_shop() && !is_search() ) {
		return true;
	}
	return false;
}

function crocal_eutf_is_woo_tax() {
	if ( crocal_eutf_woocommerce_enabled() && is_product_taxonomy() ) {
		return true;
	}
	return false;
}

function crocal_eutf_is_woo_category() {
	if ( crocal_eutf_woocommerce_enabled() && is_product_category() ) {
		return true;
	}
	return false;
}

function crocal_eutf_is_woo_tag() {
	if ( crocal_eutf_woocommerce_enabled() && is_product_tag() ) {
		return true;
	}
	return false;
}




//If woocomerce plugin is not enabled return
if ( !crocal_eutf_woocommerce_enabled() ) {
	return false;
}

//Add Theme support for woocommerce
add_theme_support( 'woocommerce' );

/**
 * Helper function to get shop custom fields with fallback
 */
function crocal_eutf_post_meta_shop( $id, $fallback = false ) {
	$post_id = wc_get_page_id( 'shop' );
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

/**
 * Helper function to skin Product Search
 */
function crocal_eutf_woo_product_search( $form ) {
	$new_custom_id = uniqid( 'eut_product_search_' );
	$form =  '<form class="eut-search" method="get" action="' . esc_url( home_url( '/' ) ) . '" >';
	$form .= '  <button type="submit" class="eut-search-btn eut-custom-btn"><i class="eut-icon-search"></i></button>';
	$form .= '  <input type="text" class="eut-search-textfield" id="' . esc_attr( $new_custom_id ) . '" value="' . get_search_query() . '" name="s" placeholder="' . esc_attr__( 'Search for ...', 'crocal' ) . '" />';
	$form .= '  <input type="hidden" name="post_type" value="product" />';
	$form .= '</form>';
	return $form;
}

/**
 * Helper function to update cart count on header icon via ajax
 */

function crocal_eutf_woo_mini_cart( $args = array() ) {

	$defaults = array(
		'list_class' => ''
	);

	$args = wp_parse_args( $args, $defaults );

	wc_get_template( 'cart/eut-mini-cart.php', $args );
}

function crocal_eutf_woo_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
?>
	<span class="eut-purchased-items"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
<?php
	$fragments['span.eut-purchased-items'] = ob_get_clean();

	ob_start();
	crocal_eutf_woo_mini_cart();
	$mini_cart = ob_get_clean();

	$fragments['div.eut-shopping-cart-content'] = '<div class="eut-shopping-cart-content">' . $mini_cart . '</div>';

	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'crocal_eutf_woo_header_add_to_cart_fragment');


function crocal_eutf_woo_product_review_comment_form_args( $comment_form ) {
	$comment_form['id_submit'] = 'eut-woo-review-submit';
	return $comment_form;
}
add_filter( 'woocommerce_product_review_comment_form_args', 'crocal_eutf_woo_product_review_comment_form_args' );



/**
 * Function to modify columns number on product thumbnails
 */
function crocal_eutf_woo_product_thumbnails_columns() {
	$columns = crocal_eutf_option( 'product_thumbnails_columns', '4' );
	return $columns;
}

/**
 * Function to add before main woocommerce content
 */
function crocal_eutf_woo_before_main_content() {

	if ( is_shop() && !is_search() ) {
		crocal_eutf_print_header_title( 'page' );
		crocal_eutf_print_header_breadcrumbs( 'page' );
		crocal_eutf_print_anchor_menu( 'page' );
	} elseif( is_product() ) {
		//Printed in single product Template
	}  elseif( is_product_taxonomy() ) {
		crocal_eutf_print_header_title( 'product_tax' );
		crocal_eutf_print_header_breadcrumbs( 'product' );
	} else {
		crocal_eutf_print_header_title( 'page' );
		crocal_eutf_print_header_breadcrumbs( 'page' );
	}
?>

	<!-- CONTENT -->
	<div id="eut-content" class="clearfix <?php echo crocal_eutf_sidebar_class( 'shop' ); ?>">
		<div class="eut-content-wrapper">
			<!-- MAIN CONTENT -->
			<div id="eut-main-content" role="main">
				<div class="eut-main-content-wrapper clearfix">
<?php
		if ( is_shop() ) {
			$post_id = wc_get_page_id( 'shop' );
			$content = get_post_field( 'post_content', $post_id );
			if( !empty( $content ) ) {
				if( !has_shortcode( $content, 'vc_row') ) {
					echo '<div class="eut-container">' . apply_filters( 'the_content', $content )  . '</div>';
				} else {
					echo apply_filters( 'the_content', $content );
				}
			}
		}
		if( !is_product() ) {
?>
					<div class="eut-container">
<?php
		}

}

/**
 * Function to add after main woocommerce content
 */
function crocal_eutf_woo_after_main_content() {
		if( !is_product() ) {
?>
					</div>
<?php
		}
?>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<?php crocal_eutf_set_current_view( 'shop' ); ?>
			<?php get_sidebar(); ?>
		</div>
	</div>
	<!-- END CONTENT -->
<?php
}

/**
 * Functions to add content wrapper
 */
function crocal_eutf_woo_before_container() {
?>
	<div class="eut-container">
<?php
}
function crocal_eutf_woo_after_container() {
?>
	</div>
<?php
}

function crocal_eutf_woo_single_title() {
?>
	<div itemprop="name" class="eut-hidden product_title entry-title"><?php the_title(); ?></div>
<?php
}

function crocal_eutf_woo_add_to_cart_class( $product ) {

	$product_get_type = method_exists( $product, 'get_type' ) ? $product->get_type() : $product->product_type;

	return implode( ' ', array_filter( array(
			'product_type_' . $product_get_type,
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
	) ) );

}

function crocal_eutf_woo_loop_add_to_cart_args( $args, $product ) {

	$ajax_add = '';
	if ( method_exists( 'WC_Product', 'supports' ) ) {
		$ajax_add = $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '';
	}

	$product_get_type = method_exists( $product, 'get_type' ) ? $product->get_type() : $product->product_type;

	$args['class'] = implode( ' ', array_filter( array(
			'product_type_' . $product_get_type,
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			$ajax_add
	) ) );
	return $args;

}
add_filter( 'woocommerce_loop_add_to_cart_args', 'crocal_eutf_woo_loop_add_to_cart_args', 10, 2 );



function crocal_eutf_print_product_social() {
	if ( crocal_eutf_social_bar ( 'product', 'check' ) ) {
?>
	<div id="eut-socials-section" class="eut-align-center clearfix">
		<div class="eut-container">
		<?php crocal_eutf_social_bar ( 'product', 'layout-2', 'text' ); ?>
		</div>
	</div>
<?php
	}
}
add_action('crocal_eutf_woocommerce_after_single_product_sections', 'crocal_eutf_print_product_social', 39);

function crocal_eutf_print_product_bar() {
	crocal_eutf_nav_bar( 'product' );
}
add_action('crocal_eutf_woocommerce_after_single_product_sections', 'crocal_eutf_print_product_bar', 40);




function crocal_eutf_woo_loop_columns( $columns ) {
	$columns = crocal_eutf_option( 'product_loop_columns', '4' );
	return $columns;
}
add_filter('loop_shop_columns', 'crocal_eutf_woo_loop_columns');


function crocal_eutf_woo_loop_shop_per_page( $items ) {
	$items = crocal_eutf_option( 'product_loop_shop_per_page', '12' );
	return $items;
}
add_filter( 'loop_shop_per_page', 'crocal_eutf_woo_loop_shop_per_page', 20 );


function crocal_eutf_woo_related_args( $args ) {
	$args = array(
		'posts_per_page' 	=> 3,
		'columns' 			=> 3,
		'orderby' 			=> 'rand'
	);
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'crocal_eutf_woo_related_args' );


function crocal_eutf_woo_large_thumbnail_size ( $size ) {

	$product_size = crocal_eutf_option( 'product_image_size' );
	if( 'default' != $product_size ) {
		$size = crocal_eutf_get_image_size( $product_size );
	}
	return $size;
}
add_filter( 'single_product_large_thumbnail_size', 'crocal_eutf_woo_large_thumbnail_size' );

function crocal_eutf_woo_archive_thumbnail_size ( $size ) {
	$product_size = crocal_eutf_option( 'product_overview_image_size' );
	if( 'default' != $product_size ) {
		$size = crocal_eutf_get_image_size( $product_size );
	}
	return $size;
}
add_filter( 'single_product_archive_thumbnail_size', 'crocal_eutf_woo_archive_thumbnail_size' );

function crocal_eutf_woo_gallery_thumbnail_size ( $size ) {
	return 'thumbnail';
}
add_filter( 'woocommerce_gallery_thumbnail_size', 'crocal_eutf_woo_gallery_thumbnail_size' );

function crocal_eutf_woo_theme_setup() {

	if( crocal_eutf_visibility( 'product_gallery_woo_zoom' ) ) {
		add_theme_support( 'wc-product-gallery-zoom' );
	}


	if( 'woo' == crocal_eutf_option( 'product_image_thumb_style', 'theme' ) ) {
		if ( crocal_eutf_visibility( 'product_gallery_woo_lightbox' )  ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
		if( crocal_eutf_visibility( 'product_gallery_woo_slider' ) ) {
			add_theme_support( 'wc-product-gallery-slider' );
		}
	}

}
add_action( 'after_setup_theme', 'crocal_eutf_woo_theme_setup' );

/**
 * Overwrite the WooCommerce actions and filters
 */

//Remove Content Wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
//Add Content Wrappers
add_action('woocommerce_before_main_content', 'crocal_eutf_woo_before_main_content', 10);
add_action('woocommerce_after_main_content', 'crocal_eutf_woo_after_main_content', 10);

//Remove Archive/Shop/{Product Title Description
add_filter( 'woocommerce_show_page_title', '__return_false' );
add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_empty_string' );

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );


//Wrapper woocommerce_upsell_display
add_action( 'woocommerce_after_single_product_summary', 'crocal_eutf_woo_before_container', 14 );
add_action( 'woocommerce_after_single_product_summary', 'crocal_eutf_woo_after_container', 16 );

//General Woo
add_filter( 'get_product_search_form', 'crocal_eutf_woo_product_search' );
add_filter( 'woocommerce_product_thumbnails_columns', 'crocal_eutf_woo_product_thumbnails_columns' );

//Loop add to cart
add_action( 'crocal_eutf_woocommerce_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10 );

//Omit closing PHP tag to avoid accidental whitespace output errors.
