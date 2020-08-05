<?php
/**
 *  Dynamic singular css style
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */

 $css = "";

 /* Singular Dynamic rules
============================================================================= */

if ( is_singular( 'post' ) ) {
	$crocal_eutf_width = crocal_eutf_post_meta( '_crocal_eutf_post_content_width', crocal_eutf_option( 'post_content_width', 'small' ) );
	$crocal_eutf_post_content_width = crocal_eutf_array_value( crocal_eutf_get_post_width_array(), $crocal_eutf_width, crocal_eutf_option( 'container_size', 1170 ) );

$css .= "

.single-post #eut-content:not(.eut-right-sidebar):not(.eut-left-sidebar) #eut-single-content .eut-container,
#eut-comment-form .eut-container,
#eut-no-comments .eut-container,
#eut-comments.eut-container {
	max-width: " . esc_attr( $crocal_eutf_post_content_width ) . "px;
}

";

} elseif ( is_singular( 'portfolio' ) ) {
	$crocal_eutf_media_margin_bottom = crocal_eutf_post_meta( '_crocal_eutf_portfolio_media_margin_bottom' );
	if( '' != $crocal_eutf_media_margin_bottom ) {
		$css .= "#eut-single-media.eut-portfolio-media {";
		$css .= 'margin-bottom: '. ( preg_match('/(px|em|\%|pt|cm)$/', $crocal_eutf_media_margin_bottom) ? esc_attr( $crocal_eutf_media_margin_bottom ) : esc_attr( $crocal_eutf_media_margin_bottom ) . 'px').';';
		$css .= "}";
	}
} elseif ( is_singular( 'tribe_events' ) ) {
	$crocal_eutf_width = crocal_eutf_post_meta( '_crocal_eutf_post_content_width', crocal_eutf_option( 'event_content_width', 'large' ) );
	$crocal_eutf_post_content_width = crocal_eutf_array_value( crocal_eutf_get_post_width_array(), $crocal_eutf_width, crocal_eutf_option( 'container_size', 1170 ) );
$css .= "

#eut-content:not(.eut-right-sidebar):not(.eut-left-sidebar) .eut-container {
	max-width: " . esc_attr( $crocal_eutf_post_content_width ) . "px;
}

";

} elseif ( is_singular( 'product' ) ) {
	$crocal_eutf_width = crocal_eutf_post_meta( '_crocal_eutf_post_content_width', crocal_eutf_option( 'product_content_width', 'medium' ) );
	$crocal_eutf_post_content_width = crocal_eutf_array_value( crocal_eutf_get_post_width_array(), $crocal_eutf_width, crocal_eutf_option( 'container_size', 1170 ) );
$css .= "

.single-product #eut-content:not(.eut-right-sidebar):not(.eut-left-sidebar) .eut-container,
.single-product .woocommerce-Tabs-panel:not(.woocommerce-Tabs-panel--description) {
	max-width: " . esc_attr( $crocal_eutf_post_content_width ) . "px;
	width: 90%;
}

";

}

/* Main Content Skin Options
============================================================================= */

$crocal_eutf_content_skin_options = array();
if ( is_singular() ) {
	$crocal_eutf_content_skin_options = crocal_eutf_post_meta( '_crocal_eutf_content_skin_options' );
} else if ( crocal_eutf_is_woo_shop() ) {
	$crocal_eutf_content_skin_options = crocal_eutf_post_meta_shop( '_crocal_eutf_content_skin_options' );
}

$crocal_eutf_content_skin = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'skin' );

switch( $crocal_eutf_content_skin ) {
	case 'custom':
		$crocal_eutf_content_background = $crocal_eutf_content_skin_options;
		$crocal_eutf_widget_title_color = $crocal_eutf_content_heading_color = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'heading_color', '#000000' );
		$crocal_eutf_content_text_color = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'text_color', '#888888' );
		$crocal_eutf_content_heading_color = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'heading_color', '#000000' );
		$crocal_eutf_content_link_color = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'link_color', '#000000' );
		$crocal_eutf_content_link_hover_color = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'link_hover_color', '#01B5ED' );
	break;
	case 'light':
		$crocal_eutf_content_background = array( 'background-color' => '#ffffff' );
		$crocal_eutf_content_heading_color = "#000000";
		$crocal_eutf_widget_title_color = "#000000";
		$crocal_eutf_content_text_color = "#000000";
		$crocal_eutf_content_heading_color = "#000000";
		$crocal_eutf_content_link_color = "#000000";
		$crocal_eutf_content_link_hover_color = "#01B5ED";
	break;
	case 'dark':
		$crocal_eutf_content_background = array( 'background-color' => '#000000' );
		$crocal_eutf_content_heading_color = "#ffffff";
		$crocal_eutf_widget_title_color = "#ffffff";
		$crocal_eutf_content_text_color = "#ffffff";
		$crocal_eutf_content_heading_color = "#ffffff";
		$crocal_eutf_content_link_color = "#ffffff";
		$crocal_eutf_content_link_hover_color = "#01B5ED";
	break;
	default:
		if( is_404() ) {
			$crocal_eutf_content_background = crocal_eutf_option( '404_content_background', array( 'background-color' => '#ffffff' ) );
		} else {
			$crocal_eutf_content_background = crocal_eutf_option( 'content_background', array( 'background-color' => '#ffffff' ) );
		}
		$crocal_eutf_content_heading_color = crocal_eutf_option( 'body_heading_color' );
		$crocal_eutf_content_text_color = crocal_eutf_option( 'body_text_color' );
		$crocal_eutf_widget_title_color = crocal_eutf_option( 'widget_title_color' );
		$crocal_eutf_content_heading_color = crocal_eutf_option( 'body_heading_color' );
		$crocal_eutf_content_link_color = crocal_eutf_option( 'body_text_link_color' );
		$crocal_eutf_content_link_hover_color = crocal_eutf_option( 'body_text_link_hover_color' );
	break;
}

$css .= "
	#eut-theme-content {
		" . crocal_eutf_get_background_css( $crocal_eutf_content_background ) . "
	}
";

if ( 'fixed' == crocal_eutf_array_value( $crocal_eutf_content_background, 'background-attachment' ) ) {
	$crocal_eutf_content_background['background-attachment'] = 'scroll';
	$css .= "
		#eut-theme-content {
			clip: rect(auto auto auto auto);
		}
		#eut-theme-content:before {
			" . crocal_eutf_get_background_css( $crocal_eutf_content_background ) . "
			content: '';
			position:fixed;
			top:0;
			width:100vw;
			height:auto;
			left:0;
			right:0;
			z-index:-1;
		}
	";
}




/* Link Colors */

$css .= "
a {
	color: " . esc_attr( $crocal_eutf_content_link_color ) . ";

}

a:hover {
	color: " . esc_attr( $crocal_eutf_content_link_hover_color ) . ";
}
";

/* Text Colors */

$css .= "
body,
.eut-text-content,
.eut-text-content a,
table,
.eut-blog .eut-blog-item:not(.eut-style-2) {
	color: " . esc_attr( $crocal_eutf_content_text_color ) . ";
}

";

/* - Widget Colors
========================================================================= */
$css .= "
#eut-content .widget .eut-widget-title {
	color: " . esc_attr( $crocal_eutf_widget_title_color ) . ";
}
.widget {
	color: " . esc_attr( $crocal_eutf_content_text_color ) . ";
}
.widget a:not(.eut-outline):not(.eut-btn) {
	color: " . esc_attr( $crocal_eutf_content_text_color ) . ";
}
";

/* Headings Colors */

$css .= "

h1,h2,h3,h4,h5,h6,
.eut-h1,
.eut-h2,
.eut-h3,
.eut-h4,
.eut-h5,
.eut-h6,
.eut-heading-color,
.eut-heading-hover-color:hover,
p.eut-dropcap:first-letter,
h3#reply-title,
.eut-blog .eut-blog-item:not(.eut-style-2) .eut-post-title {
	color: " . esc_attr( $crocal_eutf_content_heading_color ) . ";
}
";

/* Product Area Colors
============================================================================= */

function crocal_eutf_get_product_area_css() {

$css = '';

	$crocal_eutf_colors = crocal_eutf_get_color_array();

	$mode = 'product';
	$crocal_eutf_area_colors = array(
		'bg_color' => crocal_eutf_option( $mode . '_area_bg_color', '#eeeeee' ),
		'headings_color' => crocal_eutf_option( $mode . '_area_headings_color', '#000000' ),
		'font_color' => crocal_eutf_option( $mode . '_area_font_color', '#999999' ),
		'link_color' => crocal_eutf_option( $mode . '_area_link_color', '#FF7D88' ),
		'hover_color' => crocal_eutf_option( $mode . '_area_hover_color', '#000000' ),
		'border_color' => crocal_eutf_option( $mode . '_area_border_color', '#e0e0e0' ),
		'button_color' => crocal_eutf_option( $mode . '_area_button_color', 'primary-1' ),
		'button_hover_color' => crocal_eutf_option( $mode . '_area_button_hover_color', 'black' ),
	);

	$crocal_eutf_single_area_colors = crocal_eutf_post_meta( '_crocal_eutf_area_colors' );
	$crocal_eutf_single_area_colors_custom = crocal_eutf_array_value( $crocal_eutf_single_area_colors, 'custom' );

	if ( 'custom' == $crocal_eutf_single_area_colors_custom ) {
		$crocal_eutf_area_colors = $crocal_eutf_single_area_colors;
	}


$css .= "

.eut-product-area-wrapper {
	background-color: " . crocal_eutf_array_value( $crocal_eutf_area_colors, 'bg_color' ) . ";
	color: " . crocal_eutf_array_value( $crocal_eutf_area_colors, 'font_color' ) . ";
	border-color: " . crocal_eutf_array_value( $crocal_eutf_area_colors, 'border_color' ) . ";
}

#eut-theme-wrapper .eut-product-area-wrapper table {
	color: " . crocal_eutf_array_value( $crocal_eutf_area_colors, 'font_color' ) . ";
}

#eut-theme-wrapper .eut-product-area-wrapper .eut-border,
#eut-theme-wrapper .eut-product-area-wrapper form,
#eut-theme-wrapper .eut-product-area-wrapper .quantity,
#eut-theme-wrapper .eut-product-area-wrapper table,
#eut-theme-wrapper .eut-product-area-wrapper tr,
.eut-product-area-wrapper .eut-product-form,
#eut-entry-summary,
#eut-theme-wrapper .summary input,
#eut-theme-wrapper .summary select {
	border-color: " . crocal_eutf_array_value( $crocal_eutf_area_colors, 'border_color' ) . ";
}

.eut-product-area-wrapper a {
	color: " . crocal_eutf_array_value( $crocal_eutf_area_colors, 'link_color' ) . ";
}

.eut-product-area-wrapper a:hover {
	color: " . crocal_eutf_array_value( $crocal_eutf_area_colors, 'hover_color' ) . ";
}

.eut-product-area-wrapper h1,
.eut-product-area-wrapper h2,
.eut-product-area-wrapper h3,
.eut-product-area-wrapper h4,
.eut-product-area-wrapper h5,
.eut-product-area-wrapper h6,
.eut-product-area-wrapper .eut-h1,
.eut-product-area-wrapper .eut-h2,
.eut-product-area-wrapper .eut-h3,
.eut-product-area-wrapper .eut-h4,
.eut-product-area-wrapper .eut-h5,
.eut-product-area-wrapper .eut-h6,
.eut-product-area-wrapper .eut-heading-color {
    color: " . crocal_eutf_array_value( $crocal_eutf_area_colors, 'headings_color' ) . ";
}

";

$default_button_color = crocal_eutf_option( 'body_primary_1_color' );
$area_button_color = crocal_eutf_array_value( $crocal_eutf_area_colors, 'button_color' );
$button_color = crocal_eutf_array_value( $crocal_eutf_colors, $area_button_color, $default_button_color);
$area_button_hover_color = crocal_eutf_array_value( $crocal_eutf_area_colors, 'button_hover_color' );
$button_hover_color = crocal_eutf_array_value( $crocal_eutf_colors, $area_button_hover_color, '#000000');

$crocal_button_css = "";
$crocal_button_css .= "#eut-theme-wrapper .eut-product-area-wrapper .single_add_to_cart_button {";
$crocal_button_css .= "background-color: " . esc_attr( $button_color ) . ";";
if ( 'white' == $area_button_color ) {
	$crocal_button_css .= "color: #bababa;";
} else {
	$crocal_button_css .= "color: #ffffff;";
}
$crocal_button_css .= "}";

$crocal_button_css .= "#eut-theme-wrapper .eut-product-area-wrapper .single_add_to_cart_button:hover {";
$crocal_button_css .= "background-color: " . esc_attr( $button_hover_color ) . ";";
if ( 'white' == $area_button_hover_color ) {
	$crocal_button_css .= "color: #bababa;";
} else {
	$crocal_button_css .= "color: #ffffff;";
}
$crocal_button_css .= "}";

$css .= $crocal_button_css;

return $css;

}

if ( is_singular( 'product' ) ) {
	$css .= crocal_eutf_get_product_area_css();
}

/* Paddings
============================================================================= */

function crocal_eutf_print_space_css( $type = 'padding-top', $multiplier = '3x', $padding = '', $ratio = 1 ) {

	$default_space_size = 30;
	$min_space_size = 30;

	$css = '';
	if ( 'custom' == $multiplier) {
		if( 1 == $ratio ) {
			if( '' == $padding ) {
				$padding = '0';
			}
			$css .= esc_attr( $type ) . ': '. ( preg_match('/(px|em|\%|pt|cm)$/', $padding) ? esc_attr( $padding ) : esc_attr( $padding ) . 'px').';';
		}
	} else if ( 'none' == $multiplier) {
		$css .= esc_attr( $type ) . ': 0;';
	} else {
		$multiplier = filter_var( $multiplier, FILTER_SANITIZE_NUMBER_INT );
		$space_size = $default_space_size * $multiplier * $ratio;
		if ( $space_size < $default_space_size ) {
			$space_size = $min_space_size;
		}
		$css .= esc_attr( $type ) . ': ' . esc_attr( $space_size ) . 'px;';
	}

	return $css;
}

$crocal_eutf_padding_top_multiplier = '3x';
$crocal_eutf_padding_bottom_multiplier = '3x';
$crocal_eutf_padding_top = $crocal_eutf_padding_bottom = '';

if ( is_singular() || crocal_eutf_is_woo_shop() ) {

	if ( crocal_eutf_is_woo_shop() ) {
		$crocal_eutf_padding_top_multiplier = crocal_eutf_post_meta_shop( '_crocal_eutf_padding_top_multiplier' );
		$crocal_eutf_padding_top = crocal_eutf_post_meta_shop( '_crocal_eutf_padding_top' );
		if ( empty( $crocal_eutf_padding_top_multiplier ) ) {
			$crocal_eutf_padding_top_multiplier = crocal_eutf_option( 'page_padding_top_multiplier', 'x3' );
			$crocal_eutf_padding_top = crocal_eutf_option( 'page_padding_top' );
		}
		$crocal_eutf_padding_bottom_multiplier = crocal_eutf_post_meta_shop( '_crocal_eutf_padding_bottom_multiplier' );
		$crocal_eutf_padding_bottom = crocal_eutf_post_meta_shop( '_crocal_eutf_padding_top' );
		if ( empty( $crocal_eutf_padding_bottom_multiplier ) ) {
			$crocal_eutf_padding_bottom_multiplier = crocal_eutf_option( 'page_padding_bottom_multiplier', 'x3' );
			$crocal_eutf_padding_bottom = crocal_eutf_option( 'page_padding_bottom' );
		}
	} else {
		if ( is_singular( 'post' ) ) {
			$mode = 'post';
		} else if ( is_singular( 'portfolio' ) ) {
			$mode = 'portfolio';
		} else if ( is_singular( 'product' ) ) {
			$mode = 'product';
		} else if ( is_singular( 'tribe_events' ) ) {
			$mode = 'event';
		} else {
			$mode = 'page';
		}
		$crocal_eutf_padding_top_multiplier = crocal_eutf_post_meta( '_crocal_eutf_padding_top_multiplier' );
		$crocal_eutf_padding_top = crocal_eutf_post_meta( '_crocal_eutf_padding_top' );
		if ( empty( $crocal_eutf_padding_top_multiplier ) ) {
			$crocal_eutf_padding_top_multiplier = crocal_eutf_option( $mode . '_padding_top_multiplier', 'x3' );
			$crocal_eutf_padding_top = crocal_eutf_option( $mode . '_padding_top' );
		}
		$crocal_eutf_padding_bottom_multiplier = crocal_eutf_post_meta( '_crocal_eutf_padding_bottom_multiplier' );
		$crocal_eutf_padding_bottom = crocal_eutf_post_meta( '_crocal_eutf_padding_top' );
		if ( empty( $crocal_eutf_padding_bottom_multiplier ) ) {
			$crocal_eutf_padding_bottom_multiplier = crocal_eutf_option( $mode . '_padding_bottom_multiplier', 'x3' );
			$crocal_eutf_padding_bottom = crocal_eutf_option( $mode . '_padding_bottom' );
		}
	}
}

$ratio = 1;
$css .= "#eut-main-content .eut-main-content-wrapper, #eut-sidebar {";
$css .= crocal_eutf_print_space_css( 'padding-top', $crocal_eutf_padding_top_multiplier, $crocal_eutf_padding_top, $ratio );
$css .= crocal_eutf_print_space_css( 'padding-bottom', $crocal_eutf_padding_bottom_multiplier, $crocal_eutf_padding_bottom, $ratio );
$css .= "}";
if ( is_singular( 'portfolio' ) ) {
	$css .= "#eut-single-media.eut-portfolio-media.eut-without-sidebar {";
	$css .= crocal_eutf_print_space_css( 'padding-top', $crocal_eutf_padding_top_multiplier, $crocal_eutf_padding_top, $ratio );
	$css .= "}";
	$css .= "#eut-single-media.eut-portfolio-media.eut-with-sidebar {";
	$css .= crocal_eutf_print_space_css( 'padding-bottom', $crocal_eutf_padding_top_multiplier, $crocal_eutf_padding_top, $ratio );
	$css .= "}";
}

$ratio = 0.8;
$css .= "@media only screen and (max-width: 1200px) {";
$css .= "#eut-main-content .eut-main-content-wrapper, #eut-sidebar {";
$css .= crocal_eutf_print_space_css( 'padding-top', $crocal_eutf_padding_top_multiplier, $crocal_eutf_padding_top, $ratio );
$css .= crocal_eutf_print_space_css( 'padding-bottom', $crocal_eutf_padding_bottom_multiplier, $crocal_eutf_padding_bottom, $ratio );
$css .= "}";
if ( is_singular( 'portfolio' ) ) {
	$css .= "#eut-single-media.eut-portfolio-media.eut-without-sidebar {";
	$css .= crocal_eutf_print_space_css( 'padding-top', $crocal_eutf_padding_top_multiplier, $crocal_eutf_padding_top, $ratio );
	$css .= "}";
	$css .= "#eut-single-media.eut-portfolio-media.eut-with-sidebar {";
	$css .= crocal_eutf_print_space_css( 'padding-bottom', $crocal_eutf_padding_top_multiplier, $crocal_eutf_padding_top, $ratio );
	$css .= "}";
}
$css .= "}";

$ratio = 0.6;
$css .= "@media only screen and (max-width: 768px) {";
$css .= "#eut-main-content .eut-main-content-wrapper, #eut-sidebar {";
$css .= crocal_eutf_print_space_css( 'padding-top', $crocal_eutf_padding_top_multiplier, $crocal_eutf_padding_top, $ratio );
$css .= crocal_eutf_print_space_css( 'padding-bottom', $crocal_eutf_padding_bottom_multiplier, $crocal_eutf_padding_bottom, $ratio );
$css .= "}";
if ( is_singular( 'portfolio' ) ) {
	$css .= "#eut-single-media.eut-portfolio-media.eut-without-sidebar {";
	$css .= crocal_eutf_print_space_css( 'padding-top', $crocal_eutf_padding_top_multiplier, $crocal_eutf_padding_top, $ratio );
	$css .= "}";
	$css .= "#eut-single-media.eut-portfolio-media.eut-with-sidebar {";
	$css .= crocal_eutf_print_space_css( 'padding-bottom', $crocal_eutf_padding_top_multiplier, $crocal_eutf_padding_top, $ratio );
	$css .= "}";
}
$css .= "}";

// output dynamic css
echo crocal_eutf_compress_css( $css );


 //Omit closing PHP tag to avoid accidental whitespace output errors.
