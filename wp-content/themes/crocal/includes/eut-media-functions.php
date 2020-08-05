<?php

/*
 *	Media functions
 *
 * 	@version	1.0
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */


 /**
 * Generic function that prints a slider/carousel navigation
 */
function crocal_eutf_element_navigation( $navigation_type = 0, $navigation_color = 'dark' ) {

	$output = '';

	if ( 1 == $navigation_type ) {
	$output .= '<div class="eut-carousel-navigation eut-' . esc_attr( $navigation_color ) . ' eut-navigation-' . esc_attr( $navigation_type ) . '">';
	$output .= '	<div class="eut-carousel-buttons">';
	$output .= '		<div class="eut-carousel-prev">';
	$output .= '			<i class="eut-icon-nav-left-large"></i>';
	$output .= '		</div>';
	$output .= '		<div class="eut-carousel-next">';
	$output .= '			<i class="eut-icon-nav-right-large"></i>';
	$output .= '		</div>';
	$output .= '	</div>';
	$output .= '</div>';
	} else if ( 2 == $navigation_type ) {
		$output .= '<ul class="eut-slider-numbers"></ul>';
	}

	return 	$output;

}

/**
 * Generic function that prints a slider or gallery
 */
function crocal_eutf_print_gallery_slider( $gallery_mode, $slider_items , $image_size_slider = 'crocal-eutf-large-rect-horizontal', $extra_class = "") {

	if ( empty( $slider_items ) ) {
		return;
	}
	$image_link_mode = "";

	$image_size_gallery_thumb = 'crocal-eutf-small-rect-horizontal';
	if( 'gallery-vertical' == $gallery_mode ) {
		$image_size_gallery_thumb = $image_size_slider;
	}

	if ( 'gallery' == $gallery_mode || '' == $gallery_mode ) {

		$columns_large_screen = 3;
		$columns = 3;
		$columns_tablet_landscape  = 2;
		$columns_tablet_portrait  = 2;
		$columns_mobile  = 1;
		$gutter_size = 30;
		if ( is_singular( 'portfolio' ) ) {
			$portfolio_media_fullwidth = crocal_eutf_post_meta( '_crocal_eutf_portfolio_media_fullwidth' );
			if ( 'yes' == $portfolio_media_fullwidth ) {
				$columns_large_screen = 4;
				$columns = 4;
			}
			$image_link_mode = crocal_eutf_post_meta( '_crocal_eutf_portfolio_media_image_link_mode' );
		}

		$wrapper_attributes = array();

		$gallery_classes = array( 'eut-gallery' , 'eut-isotope', 'eut-with-gap' );
		if( empty( $image_link_mode ) ){
			$gallery_classes[] = 'eut-gallery-popup';
		}
		$gallery_class_string = implode( ' ', $gallery_classes );

		$wrapper_attributes[] = 'class="' . esc_attr( $gallery_class_string ) . '"';
		$wrapper_attributes[] = 'data-gutter-size="' . esc_attr( $gutter_size ) . '"';
		$wrapper_attributes[] = 'data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '"';
		$wrapper_attributes[] = 'data-columns="' . esc_attr( $columns ) . '"';
		$wrapper_attributes[] = 'data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '"';
		$wrapper_attributes[] = 'data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '"';
		$wrapper_attributes[] = 'data-columns-mobile="' . esc_attr( $columns_mobile ) . '"';
		$wrapper_attributes[] = 'data-layout="fitRows"';
?>
		<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
			<div class="eut-isotope-container">
<?php

		foreach ( $slider_items as $slider_item ) {

			$media_id = $slider_item['id'];
			$full_src = wp_get_attachment_image_src( $media_id, 'crocal-eutf-fullscreen' );
			$image_full_url = $full_src[0];

			$caption = get_post_field( 'post_excerpt', $media_id );
			$figcaption = '';
			if	( !empty( $caption ) ) {
				$figcaption = wptexturize( $caption );
			}
?>
				<div class="eut-isotope-item eut-hover-item eut-hover-style-none">
					<div class="eut-isotope-item-inner">
					<?php if( empty( $image_link_mode ) ){ ?>
						<figure class="eut-image-hover eut-zoom-none">
							<a class="eut-item-url" data-title="<?php echo esc_attr( $figcaption ); ?>" href="<?php echo esc_url( $image_full_url ); ?>"></a>
							<div class="eut-hover-overlay eut-bg-light eut-opacity-30"></div>
							<div class="eut-media">
								<?php echo crocal_eutf_get_attachment_image( $media_id, $image_size_gallery_thumb ); ?>
							</div>
						</figure>
					<?php } else { ?>
						<figure class="eut-zoom-none">
							<div class="eut-media">
								<?php echo crocal_eutf_get_attachment_image( $media_id, $image_size_gallery_thumb ); ?>
							</div>
						</figure>
					<?php } ?>
					</div>
				</div>
<?php

		}
?>
			</div>
		</div>
<?php


	} elseif ( 'gallery-vertical' == $gallery_mode ) {

		if ( is_singular( 'portfolio' ) ) {
			$image_link_mode = crocal_eutf_post_meta( '_crocal_eutf_portfolio_media_image_link_mode' );
		}

?>
		<div class="eut-media">
			<ul class="eut-post-gallery eut-post-gallery-popup <?php echo esc_attr( $extra_class ); ?>">
<?php

		foreach ( $slider_items as $slider_item ) {

			$media_id = $slider_item['id'];
			$full_src = wp_get_attachment_image_src( $media_id, 'crocal-eutf-fullscreen' );
			$image_full_url = $full_src[0];

			$caption = get_post_field( 'post_excerpt', $media_id );
			$figcaption = '';
			if	( !empty( $caption ) ) {
				$figcaption = wptexturize( $caption );
			}
			if( empty( $image_link_mode ) ){
				echo '<li class="eut-image-hover">';
				echo '<a data-title="' . esc_attr( $figcaption ) . '" href="' . esc_url( $image_full_url ) . '">';
				echo crocal_eutf_get_attachment_image( $media_id, $image_size_gallery_thumb );
				echo '</a>';
				echo '</li>';
			} else {
				echo '<li>';
				echo crocal_eutf_get_attachment_image( $media_id, $image_size_gallery_thumb );
				echo '</li>';
			}
		}
?>
			</ul>
		</div>
<?php

	} else {

		$slider_settings = array();
		if ( is_singular( 'post' ) || is_singular( 'portfolio' ) ) {
			if ( is_singular( 'post' ) ) {
				$slider_settings = crocal_eutf_post_meta( '_crocal_eutf_post_slider_settings' );
			} else {
				$slider_settings = crocal_eutf_post_meta( '_crocal_eutf_portfolio_slider_settings' );
			}
		}
		$slider_speed = crocal_eutf_array_value( $slider_settings, 'slideshow_speed', '2500' );
		$slider_dir_nav = crocal_eutf_array_value( $slider_settings, 'direction_nav', '1' );
		$slider_dir_nav_color = crocal_eutf_array_value( $slider_settings, 'direction_nav_color', 'dark' );

		$image_atts = array();
		if( 'blog-slider' == $gallery_mode ) {
			$image_atts = crocal_eutf_get_blog_image_atts();
		}

?>
		<div class="eut-media clearfix">
			<div class="eut-element eut-slider eut-layout-1">
				<div class="eut-carousel-wrapper eut-<?php echo esc_attr( $slider_dir_nav_color ); ?>">
					<?php echo crocal_eutf_element_navigation( $slider_dir_nav, $slider_dir_nav_color ); ?>
					<div class="eut-slider-element owl-carousel " data-slider-speed="<?php echo esc_attr( $slider_speed ); ?>" data-slider-pause="yes" data-slider-autoheight="no" data-pagination-color="<?php echo esc_attr( $slider_dir_nav_color ); ?>">
<?php
						foreach ( $slider_items as $slider_item ) {
							$media_id = $slider_item['id'];
							echo '<div class="eut-slider-item">';
							echo crocal_eutf_get_attachment_image( $media_id, $image_size_slider, '', $image_atts );
							echo '</div>';

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
 * Generic function that prints video settings ( HTML5 )
 */

if ( !function_exists( 'crocal_eutf_print_media_video_settings' ) ) {
	function crocal_eutf_print_media_video_settings( $video_settings ) {
		$video_attr = '';

		if ( !empty( $video_settings ) ) {

			$video_poster = crocal_eutf_array_value( $video_settings, 'poster' );
			$video_preload = crocal_eutf_array_value( $video_settings, 'preload', 'metadata' );

			if( 'yes' == crocal_eutf_array_value( $video_settings, 'controls' ) ) {
				$video_attr .= ' controls';
			}
			if( 'yes' == crocal_eutf_array_value( $video_settings, 'loop' ) ) {
				$video_attr .= ' loop="loop"';
			}
			if( 'yes' ==  crocal_eutf_array_value( $video_settings, 'muted' ) ) {
				$video_attr .= ' muted="muted"';
			}
			if( 'yes' == crocal_eutf_array_value( $video_settings, 'playsinline' ) ) {
				$video_attr .= ' playsinline';
			}
			if( 'yes' == crocal_eutf_array_value( $video_settings, 'autoplay' ) ) {
				$video_attr .= ' autoplay="autoplay"';
			}
			if( !empty( $video_poster ) ) {
				$video_attr .= ' poster="' . esc_url( $video_poster ) . '"';
			}
			$video_attr .= ' preload="' . esc_attr( $video_preload ) . '"';

		}
		return $video_attr;
	}
}

/**
 * Generic function that prints a video ( Embed or HTML5 )
 */
function crocal_eutf_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed, $video_poster = '' ) {
	global $wp_embed;
	$video_output = '';

	if( empty( $video_mode ) ) {
		if ( !empty( $video_embed ) ) {
			echo '<div class="eut-media">' . $wp_embed->run_shortcode( '[embed]' . $video_embed . '[/embed]' ) . '</div>';
		}
	} elseif( 'code' == $video_mode ) {
		if ( !empty( $video_embed ) ) {
			echo '<div class="eut-media">' . $video_embed . '</div>';
		}
	} else {
		if ( !empty( $video_webm ) || !empty( $video_mp4 ) || !empty( $video_ogv ) ) {

			$video_settings = array(
				'controls' => 'yes',
				'poster' => $video_poster,
			);
			$video_settings = apply_filters( 'crocal_eutf_media_video_settings', $video_settings );

			echo '<div class="eut-media">';
			echo '<video ' . crocal_eutf_print_media_video_settings( $video_settings ) . ' >';

			if ( !empty( $video_webm ) ) {
				echo '<source src="' . esc_url( $video_webm ) . '" type="video/webm">';
			}
			if ( !empty( $video_mp4 ) ) {
				echo '<source src="' . esc_url( $video_mp4 ) . '" type="video/mp4">';
			}
			if ( !empty( $video_ogv ) ) {
				echo '<source src="' . esc_url( $video_ogv ) . '" type="video/ogg">';
			}
			echo '</video>';
			echo '</div>';

		}
	}

}

/**
 * Print video icon
 */
function crocal_eutf_get_video_icon( $color = 'white', $position = '', $size = 'large' ) {
	$icon_classes[] = 'eut-video-icon';
	$icon_classes[]  = 'eut-bg-' . $color;
	$icon_classes[]  = 'eut-' . $size;
	if ( !empty( $position ) ) {
		$icon_classes[]  = 'eut-icon-' . $position;
	}
	$icon_class_string = implode( ' ', $icon_classes );

	$icon_color = '#ffffff';
	if( 'white' == $color || 'grey' == $color ) {
		$icon_color = '#000000';
	}

	$icon_output = '';
	$icon_output .= '<div class="' . esc_attr( $icon_class_string ) . '">';
	$icon_output .= '<svg width="12px" height="18px" viewBox="0 0 12 18"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g fill="' . esc_attr( $icon_color ) . '"><path d="M10.9715108,7.0754156 C12.3431347,8.1381711 12.3425247,9.86171086 10.9715108,10.9239937 L2.48354473,17.5006018 C1.11192085,18.5633573 0,17.8747584 0,15.9584704 L0,2.04093894 C0,0.126487777 1.11253086,-0.563475326 2.48354473,0.498807534 L10.9715108,7.0754156 Z"></path></g></g></svg>';
	$icon_output .= '</div>';

	return $icon_output;
}


function crocal_eutf_get_image_size( $image_mode = 'large' ) {

	switch( $image_mode ) {
		case 'thumbnail':
			$image_size = 'thumbnail';
		break;
		case 'medium':
			$image_size = 'medium';
		break;
		case 'medium_large':
			$image_size = 'medium_large';
		break;
		case 'large':
			$image_size = 'large';
		break;
		case 'square':
			$image_size = 'crocal-eutf-small-square';
		break;
		case 'landscape':
			$image_size = 'crocal-eutf-small-rect-horizontal';
		break;
		case 'landscape-medium':
			$image_size = 'crocal-eutf-medium-rect-horizontal';
		break;
		case 'portrait':
			$image_size = 'crocal-eutf-small-rect-vertical';
		break;
		case 'portrait-medium':
			$image_size = 'crocal-eutf-medium-rect-vertical';
		break;
		case 'landscape-large-wide':
			$image_size = 'crocal-eutf-large-rect-horizontal';
		break;
		case 'fullscreen':
		case 'extra-extra-large':
			$image_size = 'crocal-eutf-fullscreen';
		break;
		case 'full':
			$image_size = 'full';
		break;
		default:
			$image_size = 'large';
		break;
	}

	return $image_size;

}

function crocal_eutf_get_fallback_image_attr( $size = 'crocal-eutf-small-rect-horizontal' ) {

	$image_atts = array();

	switch( $size ) {
		case 'thumbnail':
			$image_atts['width'] = "150";
			$image_atts['height'] = "150";
		break;
		case 'medium':
			$image_atts['width'] = "300";
			$image_atts['height'] = "300";
		break;
		case 'large':
			$image_atts['width'] = "1024";
			$image_atts['height'] = "768";
		break;
		case 'crocal-eutf-small-square':
			$image_atts['width'] = "560";
			$image_atts['height'] = "560";
		break;
		case 'crocal-eutf-medium-square':
			$image_atts['width'] = "900";
			$image_atts['height'] = "900";
		break;
		case 'crocal-eutf-small-rect-horizontal':
			$image_atts['width'] = "560";
			$image_atts['height'] = "420";
		break;
		case 'crocal-eutf-medium-rect-horizontal':
			$image_atts['width'] = "900";
			$image_atts['height'] = "675";
		break;
		case 'crocal-eutf-small-rect-vertical':
			$image_atts['width'] = "560";
			$image_atts['height'] = "745";
		break;
		case 'crocal-eutf-medium-rect-vertical':
			$image_atts['width'] = "840";
			$image_atts['height'] = "1120";
		break;
		case 'crocal-eutf-fullscreen':
		default:
			$size = 'full';
			$image_atts['width'] = "1920";
			$image_atts['height'] = "1080";
		break;
	}
	$placeholder_mode = crocal_eutf_option( 'placeholder_mode', 'dummy' );
	$placeholder_mode =  apply_filters( 'crocal_eutf_placeholder_mode', $placeholder_mode );
	switch( $placeholder_mode ) {
		case 'placehold':
			$image_atts['url'] = 'https://placehold.it/' . $image_atts['width'] . 'x' . $image_atts['height'];
		break;
		case 'unsplash':
			$image_atts['url'] = 'https://source.unsplash.com/category/people/' . $image_atts['width'] . 'x' . $image_atts['height'] . '?sig=' . uniqid();
		break;
		case 'dummy':
		default:
			$image_atts['url'] =  get_template_directory_uri() . '/images/empty/' . $size . '.jpg';
		break;
	}
	$image_atts['class'] = 'attachment-' . $size . ' size-' . $size ;
	$image_atts['alt'] = "Dummy Image";

	return $image_atts;

}

function crocal_eutf_get_fallback_image( $size = 'crocal-eutf-small-rect-horizontal', $mode = '' ) {
	$html = '';
	$image_atts = crocal_eutf_get_fallback_image_attr( $size );
	if( 'url' == $mode ) {
		$html = $image_atts['url'];
	} else {
		$html = '<img class="' . esc_attr( $image_atts['class'] ) . '" alt="' . esc_attr( $image_atts['alt'] ) . '" src="' . esc_url( $image_atts['url'] ) . '" width="' . esc_attr( $image_atts['width'] ) . '" height="' . esc_attr( $image_atts['height'] ) . '">';
	}
	return $html;
}

function crocal_eutf_get_all_image_sizes() {
    global $_wp_additional_image_sizes;
    $default_image_sizes = get_intermediate_image_sizes();
    foreach ( $default_image_sizes as $size ) {
        $image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
        $image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
        $image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
    }
    if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
        $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
    }
    return $image_sizes;
}

function crocal_eutf_attachment_image_attributes( $attr, $image ) {

	if ( isset( $attr['data-eutf-filter'] ) ) {
		$image_load_mode = crocal_eutf_option( 'image_load_mode', 'default' );
		$image_lazyload = isset($attr['data-lazyload']) ? $attr['data-lazyload'] : 'auto';

		if( 'lazyload' == $image_load_mode && 'auto' == $image_lazyload ) {
			$image_lazyload = 'yes';
		}

		if( 'yes' == $image_lazyload ) {
			$attr['class']          = $attr['class'] . ' eut-lazy-load lazyload';
			$attr['data-src']       = $attr['src'];
			$attr['data-sizes']     = 'auto';
			$attr['data-srcset']    = isset($attr['srcset']) ? $attr['srcset'] : '';
			if ( !empty( $attr['data-srcset'] ) ) {
				$attr['srcset']         = get_template_directory_uri() . '/images/empty/empty.png';
			}
			$attr['data-expand']   = 1;
			unset($attr['sizes']);
		}
		unset($attr['data-column-space']);
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes' , 'crocal_eutf_attachment_image_attributes', 10, 2 );

function crocal_eutf_get_attachment_image( $id, $size = 'thumbnail', $icon = false, $attr = array() ) {
	$html = '';
	if ( !is_array( $attr ) ) {
		$attr = array();
	}
	$attr['data-eutf-filter'] = 'yes';
	$html .= crocal_eutf_get_image_wrapper_start( $id, $size, $attr );
	$html .= wp_get_attachment_image( $id, $size , $icon, $attr );
	$html .= crocal_eutf_get_image_wrapper_end();
	return $html;
}

function crocal_eutf_get_the_post_thumbnail( $post_id , $size = 'thumbnail', $attr = array()  ) {
	$html = '';
	if ( !is_array( $attr ) ) {
		$attr = array();
	}
	$attr['data-eutf-filter'] = 'yes';
	$id = get_post_thumbnail_id( $post_id );
	$html .= crocal_eutf_get_image_wrapper_start( $id, $size, $attr );
	$html .= get_the_post_thumbnail( $post_id, $size , $attr );
	$html .= crocal_eutf_get_image_wrapper_end();
	return $html;
}

function crocal_eutf_the_post_thumbnail( $size = 'thumbnail', $attr = array() ) {
	if ( !is_array( $attr ) ) {
		$attr = array();
	}
	$attr['data-eutf-filter'] = 'yes';
	$id = get_post_thumbnail_id();
	echo crocal_eutf_get_image_wrapper_start( $id, $size, $attr );
	the_post_thumbnail( $size , $attr );
	echo crocal_eutf_get_image_wrapper_end();
}

function crocal_eutf_get_image_wrapper_start( $id = 0, $size = 'thumbnail', $attr = array() ) {
	$html = '';
	$img_width = $img_height = $percentage = 0;
	$img_src = wp_get_attachment_image_src( $id, $size );
	if ( $img_src ) {
		$img_width = $img_src[1];
		$img_height = $img_src[2];
		$percentage = round($img_height / $img_width * 100, 3);
	}

	$thumbnail_wrapper_attributes = array();
	$thumbnail_wrapper_attributes[] = crocal_eutf_build_media_style(
		array(
			'max_width' => $img_width,
		)
	);
	$thumbnail_attributes = array();
	$thumbnail_attributes[] = crocal_eutf_build_media_style(
		array(
			'padding_top' => $percentage . '%',
		)
	);

	$column_space = crocal_eutf_array_value( $attr, 'data-column-space', 'auto' );
	if ( 'auto' != $column_space ){
		$html .= '<div class="eut-thumbnail-wrapper">';
	} else {
		$html .= '<div class="eut-thumbnail-wrapper" ' . implode( ' ', $thumbnail_wrapper_attributes ) . '>';
	}
	$html .= '<div class="eut-thumbnail" ' . implode( ' ', $thumbnail_attributes ) . '>';
	return $html;
}

function crocal_eutf_get_image_wrapper_end() {
	$html = '';
	$html .= '</div>';
	$html .= '</div>';
	return $html;
}

function crocal_eutf_build_media_style( $item = array() ) {
	$padding_top = crocal_eutf_array_value( $item, 'padding_top');
	$padding_bottom = crocal_eutf_array_value( $item, 'padding_bottom' );
	$max_width = crocal_eutf_array_value( $item, 'max_width' );

	$data = '';

	if( $padding_top != '' ) {
		$data .= 'padding-top: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $padding_top) ? $padding_top : $padding_top.'px').';';
	}
	if( $padding_bottom != '' ) {
		$data .= 'padding-bottom: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $padding_bottom) ? $padding_bottom : $padding_bottom.'px').';';
	}
	if( $max_width != '' ) {
		$data .= 'max-width: '.(preg_match('/(px|em|\%|pt|cm|vh|vw)$/', $max_width) ? $max_width : $max_width.'px').';';
	}

	return empty($data) ? $data : ' style="'. esc_attr( $data ) .'"';
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
