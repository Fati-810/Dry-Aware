<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'theme' == crocal_eutf_option( 'product_image_thumb_style', 'theme' ) ) {

	global $post, $product;

	$attachment_ids = $product->get_gallery_image_ids();

	if ( $attachment_ids && has_post_thumbnail() ) {
		?>
		<div class="thumbnails">
			<div class="eut-thumbnails-wrapper">
				<div class="eut-thumbnails-inner">
		<?php
		foreach ( $attachment_ids as $attachment_id ) {
			$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
			$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'thumbnail');
			$thumbnail_size = 'thumbnail';


			//Check Title and Caption
			$image_title_caption = crocal_eutf_option( 'product_gallery_title_caption', 'none' );
			$product_image_title = $product_image_caption = '';
			$image_title = get_post_field( 'post_title', $attachment_id );
			$image_caption = get_post_field( 'post_excerpt', $attachment_id );
			$attributes      = array(
				'title'                   => $image_title,
				'data-caption'            => $image_caption,
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
				'data-column-space'       => '100',
				'data-lazyload' => 'no',
			);

			$link_data = '';

			$data_html = '';
			if ( !empty( $image_title ) && 'none' != $image_title_caption && 'caption-only' != $image_title_caption ) {
				$data_html .= '<span class="eut-title">' . $image_title . '</span>';
			}
			if ( !empty( $image_caption ) && 'none' != $image_title_caption && 'title-only' != $image_title_caption ) {
				$data_html .= '<span class="eut-caption">' . $image_caption . '</span>';
			}
			if ( !empty( $data_html ) ) {
				$link_data .= ' data-sub-html="' . esc_attr( $data_html ) . '"';
			}
			if( crocal_eutf_visibility( 'product_gallery_woo_lightbox' ) ) {
				$link_data .= ' data-size="' . esc_attr( $full_size_image[1] ) . 'x' . esc_attr( $full_size_image[2] ) . '"';
			}

			$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="eut-thumb-item eut-popup-item">';
			$html .= '<a class="eut-popup-link" href="' . esc_url( $full_size_image[0] ) . '" ' . $link_data . '>';
			$html .= wp_get_attachment_image( $attachment_id, $thumbnail_size, false, $attributes );
			$html .= '</a>';
			$html .= '</div>';

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
		}
		?>
				</div>
			</div>
		</div>
		<?php
	}
} else {
	if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
		return;
	}

	global $product;

	$attachment_ids = $product->get_gallery_image_ids();

	if ( $attachment_ids && has_post_thumbnail() ) {
		foreach ( $attachment_ids as $attachment_id ) {
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id  ), $attachment_id );
		}
	}
}
//Omit closing PHP tag to avoid accidental whitespace output errors.
