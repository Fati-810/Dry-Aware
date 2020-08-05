<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Extra post classes
$classes = array();

//Second Product Image
if ( method_exists( $product, 'get_gallery_image_ids' ) ) {
	$attachment_ids = $product->get_gallery_image_ids();
} else {
	$attachment_ids = $product->get_gallery_attachment_ids();
}
$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'shop_catalog' );

//Second Image Classes
$image_classes = array();
$image_classes[] = 'attachment-' . $image_size;
$image_classes[] = 'size-' . $image_size;
$image_classes[] = 'eut-product-thumbnail-second';
$image_class_string = implode( ' ', $image_classes );

$product_thumb_second_id = '';

if ( $attachment_ids ) {
	$loop = 0;
	foreach ( $attachment_ids as $attachment_id ) {
		$image_link = wp_get_attachment_url( $attachment_id );
		if (!$image_link) {
			continue;
		}
		$loop++;
		$product_thumb_second_id = $attachment_id;
		if ($loop == 1) {
			break;
		}
	}
}

$shadow = crocal_eutf_option( 'product_overview_image_shadow', 'none' );
$radius = crocal_eutf_option( 'product_overview_image_radius', 'none' );
$grayscale_effect = crocal_eutf_option( 'product_overview_image_grayscale_effect', 'none' );

$image_effect = crocal_eutf_option( 'product_overview_image_effect', 'second' );
$zoom_effect = crocal_eutf_option( 'product_overview_image_zoom_effect', 'none' );
$hover_style = crocal_eutf_option( 'product_overview_hover_style', 'hover-style-1' );

if ( 'second' == $image_effect && !empty( $product_thumb_second_id ) ) {
	$classes[] = 'eut-with-second-image';
}
$classes[] = 'eut-isotope-item';
$classes[] = 'eut-product-item';

$product_title_heading_tag = crocal_eutf_option( 'product_overview_heading_tag', 'h4' );
$product_title_heading = crocal_eutf_option( 'product_overview_heading', 'h4' );
$overlay_color = crocal_eutf_option( 'product_overview_overlay_color', 'light' );
$overlay_opacity = crocal_eutf_option( 'product_overview_overlay_opacity', '90' );

// Image Effect
$image_effect_classes = array( 'eut-image-hover' );
if ( 'none' != $zoom_effect ) {
	array_push( $image_effect_classes, 'eut-zoom-' . $zoom_effect );
}
if ( 'none' != $grayscale_effect ) {
	array_push( $image_effect_classes, 'eut-' . $grayscale_effect );
}

if( 'hover-style-2' == $hover_style ){
	if ( 'light' == $overlay_color ) {
		array_push( $image_effect_classes, 'eut-text-black' );
	} else {
		array_push( $image_effect_classes, 'eut-text-white' );
	}
	if ( !empty( $radius ) && 'none' != $radius ) {
		array_push( $image_effect_classes, 'eut-' . $radius);
	}

	if ( !empty( $shadow ) && 'none' != $shadow ) {
		array_push( $image_effect_classes, 'eut-' . $shadow);
	}
}
$image_effect_class_string = implode( ' ', $image_effect_classes );

// Media Classes
$media_classes = array( 'eut-media' );
if( 'hover-style-1' == $hover_style ){
	if ( 'none' != $radius ) {
		array_push( $media_classes, 'eut-' . $radius);
	}

	if ( 'none' != $shadow ) {
		array_push( $media_classes, 'eut-' . $shadow);
	}
}
$media_class_string = implode( ' ', $media_classes );

//Remove Actions
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' , 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

?>
<div <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="eut-isotope-item-inner eut-hover-item eut-product-<?php echo esc_attr( $hover_style ); ?>">

	<?php if ( 'hover-style-1' == $hover_style ) { ?>
		<div class="eut-product-added-icon eut-icon-shop eut-bg-primary-1"></div>
	<?php } ?>
		<figure class="<?php echo esc_attr( $image_effect_class_string ); ?>">
			<div class="<?php echo esc_attr( $media_class_string ); ?>">
				<div class="eut-add-cart-wrapper">
					<div class="eut-add-cart-button">
						<?php woocommerce_template_loop_add_to_cart(); ?>
					</div>
				</div>
				<a class="eut-item-url" href="<?php echo esc_url( get_permalink() ); ?>"></a>
				<div class="eut-bg-<?php echo esc_attr( $overlay_color ); ?> eut-hover-overlay eut-opacity-<?php echo esc_attr( $overlay_opacity ); ?>"></div>
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					if ( 'second' == $image_effect && !empty( $product_thumb_second_id ) ) {
						echo wp_get_attachment_image( $product_thumb_second_id, $image_size , "", array( 'class' => $image_class_string ) );
					}
				?>
			</div>

			<?php if ( 'hover-style-1' == $hover_style ) { ?>
			<figcaption class="eut-content eut-align-center">
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<<?php echo tag_escape( $product_title_heading_tag ); ?> class="eut-title eut-<?php echo esc_attr( $product_title_heading ); ?>"><?php the_title(); ?></<?php echo tag_escape( $product_title_heading_tag ); ?>>
				</a>
			<?php } else { ?>
			<figcaption class="eut-content">
					<<?php echo tag_escape( $product_title_heading_tag ); ?> class="eut-title eut-<?php echo esc_attr( $product_title_heading ); ?>"><?php the_title(); ?></<?php echo tag_escape( $product_title_heading_tag ); ?>>
			<?php } ?>
				<?php
					/**
					 * woocommerce_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );

					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			</figcaption>
		</figure>
	</div>

	<?php

		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );

	?>

</div>
