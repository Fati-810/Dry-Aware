<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'theme' == crocal_eutf_option( 'product_image_thumb_style', 'theme' ) ) {

	global $post, $product;
	$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
	$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );


	$custom_image_id = crocal_eutf_post_meta( '_crocal_eutf_area_image_id' );
	if( $custom_image_id ) {
		$post_thumbnail_id = $custom_image_id;
	} else {
		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
	}


	$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
	$thumbnail_size_image  = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );


	$eut_gallery_class = 'eut-no-popup';
	if( crocal_eutf_visibility( 'product_gallery_woo_lightbox' ) ) {
		$eut_gallery_class = 'eut-woo-light-gallery-popup';
	}
	$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
		$eut_gallery_class,
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
		'eut-product-images',
	) );
	?>
	<div id="eut-product-feature-image" class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
			<?php

			//Check Title and Caption
			$image_title_caption = crocal_eutf_option( 'product_gallery_title_caption', 'none' );
			$product_image_title = $product_image_caption = '';
			$image_title = get_post_field( 'post_title', $post_thumbnail_id );
			$image_caption = get_post_field( 'post_excerpt', $post_thumbnail_id );

			$image_size = apply_filters( 'single_product_large_thumbnail_size', 'woocommerce_single' );

			$image_classes = array();
			$image_classes[] = 'wp-post-image';
			$image_classes[] = 'attachment-' . $image_size;
			$image_classes[] = 'size-' . $image_size;
			$image_class_string = implode( ' ', $image_classes );

			$attributes = array(
				'title'                   => $image_title,
				'data-caption'            => $image_caption,
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
				'data-column-space'       => '100',
				'data-lazyload' => 'no',
				'class'                   => $image_class_string,
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

			if ( has_post_thumbnail() ) {
				$html  = '<div data-thumb="' . esc_url( $thumbnail_size_image[0] ) . '" class="eut-product-image woocommerce-product-gallery__image eut-popup-item">';
				$html .=  '<a class="eut-popup-link" href="' . esc_url( $full_size_image[0] ) . '" ' . $link_data . '>';
				$html .= wp_get_attachment_image( $post_thumbnail_id, $image_size, false, $attributes );
				$html .= '</a>';
				$html .= '</div>';
			} else {
				$html  = '<div class="eut-product-image woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src('woocommerce_single') ), esc_attr__( 'Awaiting product image', 'crocal' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

			?>

<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	</div>
<?php
} else {

	if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
		return;
	}

	global $product;

	$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
	$post_thumbnail_id = $product->get_image_id();
	$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	) );
	?>
	<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
		<figure class="woocommerce-product-gallery__wrapper">
			<?php
			if ( has_post_thumbnail() ) {
				$html  = wc_get_gallery_image_html( $post_thumbnail_id, true );
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src('woocommerce_single') ), esc_attr__( 'Awaiting product image', 'crocal' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

			do_action( 'woocommerce_product_thumbnails' );
			?>
		</figure>
	</div>

<?php
}

//Omit closing PHP tag to avoid accidental whitespace output errors.