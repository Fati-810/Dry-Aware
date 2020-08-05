<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Remove Single Product Hooks
remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );


?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }

?>

<?php

if ( crocal_eutf_check_title_visibility() ) {
	global $post;
	$post_id = $post->ID;
	$crocal_eutf_custom_title_options = get_post_meta( $post_id, '_crocal_eutf_custom_title_options', true );
	$crocal_eutf_title_style = crocal_eutf_option( 'product_title_style' );
	$crocal_eutf_page_title_custom = crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'custom', $crocal_eutf_title_style );
	if ( 'simple' == $crocal_eutf_page_title_custom ) {
		//Show Default Woo title
	} else {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	}
} else {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
}
//Add Single Product Hooks

add_action( 'woocommerce_single_product_summary', 'crocal_eutf_woo_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'wc_print_notices', 35 );

// Price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 4 );

// Rating
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 3 );


//Section Classes
$vertical_position = 'top';
$section_classes = array( 'eut-section' );
if( 'theme' == crocal_eutf_option( 'product_image_thumb_style', 'theme' ) && '1' == crocal_eutf_option( 'product_image_middle', '1' ) ) {
	$vertical_position = 'middle';
}

$section_type = crocal_eutf_option( 'product_area_section_type', 'fullwidth-background' );
$section_type = crocal_eutf_post_meta( '_crocal_eutf_area_section_type', $section_type );
if( 'fullwidth-element' == $section_type ) {
	$section_classes[] = 'eut-fullwidth';
}
$padding_top_multiplier = crocal_eutf_option( 'product_area_padding_top_multiplier', '3x' );
$padding_top_multiplier = crocal_eutf_post_meta( '_crocal_eutf_area_padding_top_multiplier', $padding_top_multiplier );
if ( !empty ( $padding_top_multiplier ) ) {
	$section_classes[] = 'eut-padding-top-' . $padding_top_multiplier;
}
$padding_bottom_multiplier = crocal_eutf_option( 'product_area_padding_bottom_multiplier', '3x' );
$padding_bottom_multiplier = crocal_eutf_post_meta( '_crocal_eutf_area_padding_bottom_multiplier', $padding_bottom_multiplier );
if ( !empty ( $padding_bottom_multiplier ) ) {
	$section_classes[] = 'eut-padding-bottom-' . $padding_bottom_multiplier;
}
$section_string = implode( ' ', $section_classes );

?>

<div id="product-<?php the_ID(); ?>" <?php post_class('eut-product-area'); ?>>
	<div class="eut-wrapper eut-product-area-wrapper">
		<div class="<?php echo esc_attr( $section_string ); ?>" data-tablet-portrait-equal-columns="false" data-mobile-equal-columns="false">
			<div class="eut-container">
				<div class="eut-row eut-columns-gap-50 eut-tablet-vertical-gap-30 eut-tablet-sm-vertical-gap-30 eut-mobile-vertical-gap-30">
					<div class="eut-column eut-column-1-2 eut-tablet-sm-column-1 eut-vertical-position-<?php echo esc_attr( $vertical_position ); ?>">
						<div class="eut-column-wrapper">
							<div class="eut-column-content">
							<?php
								/**
								 * woocommerce_before_single_product_summary hook
								 *
								 * @hooked woocommerce_show_product_sale_flash - 10
								 * @hooked woocommerce_show_product_images - 20
								 */
								do_action( 'woocommerce_before_single_product_summary' );
							?>
							</div>
						</div>
					</div>
					<div class="eut-column-summary eut-column eut-column-1-2 eut-tablet-sm-column-1 eut-vertical-position-<?php echo esc_attr( $vertical_position ); ?>">
						<div class="eut-column-wrapper">
							<div class="eut-column-content">
								<div id="eut-entry-summary" class="summary entry-summary eut-bookmark">

									<?php
										/**
										 * woocommerce_single_product_summary hook
										 *
										 * @hooked woocommerce_template_single_title - 5
										 * @hooked woocommerce_template_single_rating - 10
										 * @hooked woocommerce_template_single_price - 10
										 * @hooked woocommerce_template_single_excerpt - 20
										 * @hooked woocommerce_template_single_add_to_cart - 30
										 * @hooked woocommerce_template_single_meta - 40
										 * @hooked woocommerce_template_single_sharing - 50
										 * @hooked WC_Structured_Data::generate_product_data() - 60
										 */
										do_action( 'woocommerce_single_product_summary' );
									?>

								</div><!-- .summary -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' );

//Omit closing PHP tag to avoid accidental whitespace output errors.

