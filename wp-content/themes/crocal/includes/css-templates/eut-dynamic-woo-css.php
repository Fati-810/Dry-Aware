<?php
/**
 *  Dynamic css style for WooCommerce
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */

$css = "";


/* Container Size
============================================================================= */
$css .= "

.woocommerce .woocommerce-error,
.woocommerce .woocommerce-info,
.woocommerce .woocommerce-message {
	max-width: " . crocal_eutf_option( 'container_size', 1170 ) . "px;
}

";


/* Cart Area Colors
============================================================================= */
$eut_mini_cart_overflow_background_color = crocal_eutf_option( 'mini_cart_overflow_background_color', '#000000' );
$css .= "
#eut-cart-area {
	background-color: " . crocal_eutf_option( 'mini_cart_background_color' ) . ";
	color: " . crocal_eutf_option( 'mini_cart_text_color' ) . ";
}

#eut-cart-area .eut-empty-cart .eut-h6,
#eut-cart-area .eut-cart-total {
	color: " . crocal_eutf_option( 'mini_cart_text_color' ) . ";
}

#eut-cart-area .cart-item-content a,
#eut-cart-area .eut-empty-cart a {
	color: " . crocal_eutf_option( 'mini_cart_link_color' ) . ";
}

#eut-cart-area .cart-item-content a:hover,
#eut-cart-area .eut-empty-cart a:hover {
	color: " . crocal_eutf_option( 'mini_cart_link_hover_color' ) . ";
}

#eut-cart-area .eut-border {
	border-color: " . crocal_eutf_option( 'mini_cart_border_color' ) . " !important;
}

#eut-cart-area-overlay {
	background-color: rgba(" . crocal_eutf_hex2rgb( $eut_mini_cart_overflow_background_color ) . "," . crocal_eutf_option( 'mini_cart_overflow_background_color_opacity', '0.9') . ");
}

";


/* Primary Background */
$css .= "

.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.eut-product-item span.onsale {
	background-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	color: #ffffff;
}

";


/* Primary Color */
$css .= "

.woocommerce nav.woocommerce-pagination ul li span.current,
nav.woocommerce-pagination ul li a:hover,
.woocommerce-MyAccount-navigation ul li a:hover,
.woocommerce .widget_layered_nav ul li.chosen a:before,
.woocommerce .widget_layered_nav_filters ul li a:before,
.eut-product-area .price .woocommerce-Price-amount {
	color: " . crocal_eutf_option( 'body_primary_1_color' ) . "!important;
}

";



/* Primary Border */
$css .= "

#eut-entry-summary .price del:after {
	border-color: " . crocal_eutf_option( 'body_primary_1_color' ) . "!important;
}

";


/* Content Color
============================================================================= */
$css .= "

nav.woocommerce-pagination ul li a {
	color: " . crocal_eutf_option( 'body_text_color' ) . ";
}

";


/* Headers Color
============================================================================= */
$css .= "

.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
.eut-product-item .eut-add-to-cart-btn a.add_to_cart_button:before,
.woocommerce form .form-row label {
	color: " . crocal_eutf_option( 'body_heading_color' ) . ";
}

";

// Product Anchor Size
$css .= "

#eut-product-anchor {
	height: " . intval( crocal_eutf_option( 'product_anchor_menu_height', 120 ) + 2 ) . "px;
}

#eut-product-anchor .eut-anchor-wrapper {
	line-height: " . crocal_eutf_option( 'product_anchor_menu_height' ) . "px;
}

#eut-product-anchor.eut-anchor-menu .eut-anchor-btn {
	width: " . crocal_eutf_option( 'product_anchor_menu_height' ) . "px;
}

";

/* Borders
============================================================================= */
$css .= "

.woocommerce-tabs,
.woocommerce #reviews #review_form_wrapper,
.woocommerce-page #reviews #review_form_wrapper,
.woocommerce-MyAccount-navigation ul li,
#eut-theme-wrapper .widget.woocommerce li,
#eut-theme-wrapper .woocommerce table,
#eut-theme-wrapper .woocommerce table tr,
#eut-theme-wrapper .woocommerce table th,
#eut-theme-wrapper .woocommerce table td,
.woocommerce table.shop_attributes,
.woocommerce table.shop_attributes tr,
.woocommerce table.shop_attributes th,
.woocommerce table.shop_attributes td,
.woocommerce-input-wrapper,
.woocommerce-input-wrapper .selection {
	border-color: " . crocal_eutf_option( 'body_border_color' ) . ";
}

";


/* H5 */
$css .= "
.woocommerce .cart-collaterals .cross-sells > h2,
.woocommerce-page .cart-collaterals .cross-sells > h2,
.woocommerce .cart-collaterals .cart_totals h2,
.woocommerce-Reviews-title {
	font-family: " . crocal_eutf_option( 'h5_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'h5_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'h5_font', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'h5_font', ' none', 'text-transform'  ) . ";
	font-size: " . crocal_eutf_option( 'h5_font', '18px', 'font-size'  ) . ";
	line-height: " . crocal_eutf_option( 'h5_font', '20px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'h5_font', '0px', 'letter-spacing'  ) . "
}
";

/* H6 */
$css .= "

.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta {
	font-family: " . crocal_eutf_option( 'h6_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'h6_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'h6_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'h6_font', '56px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'h6_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'h6_font', '60px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'h6_font', '0px', 'letter-spacing'  ) . "
}

";


/* Special Text */
$css .= "



";


/* Small Text */
$css .= "

.woocommerce span.onsale,
.widget.woocommerce .chosen,
.widget.woocommerce .price_label,
.eut-add-cart-wrapper a {
	font-family: " . crocal_eutf_option( 'small_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'small_text', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'small_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'small_text', '34px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'small_text', 'none', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'small_text', '0px', 'letter-spacing'  ) . "
}


";

/* Link Text */
$css .= "

.woocommerce-pagination,
.woocommerce form .eut-billing-content .form-row label,
.eut-woo-error a.button,
.eut-woo-info a.button,
.eut-woo-message a.button,
.woocommerce-review-link,
.woocommerce #eut-theme-wrapper #respond input#submit,
.woocommerce #eut-theme-wrapper a.button,
.woocommerce #eut-theme-wrapper button.button,
.woocommerce #eut-theme-wrapper input.button,
.woocommerce-MyAccount-content a.button,
.woocommerce .woocommerce-error a.button,
.woocommerce .woocommerce-info a.button,
.woocommerce .woocommerce-message a.button,
.woocommerce .woocommerce-Reviews .comment-form-rating label,
.woocommerce-tabs .tabs li a {
	font-family: " . crocal_eutf_option( 'link_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'link_text', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'link_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'link_text', '13px', 'font-size'  ) . " !important;
	text-transform: " . crocal_eutf_option( 'link_text', 'uppercase', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'link_text', '0px', 'letter-spacing'  ) . "
}

";

/* Product Navigation Bar
============================================================================= */
$css .= "
#eut-product-bar.eut-layout-1 {
	padding-top: " . crocal_eutf_option( 'product_nav_spacing', '', 'padding-top' ) . ";
	padding-bottom: " . crocal_eutf_option( 'product_nav_spacing', '', 'padding-bottom'  ) . ";
	background-color: " . crocal_eutf_option( 'product_bar_background_color', '#000000'  ) . ";
	border-color: " . crocal_eutf_option( 'product_bar_border_color', '#000000'  ) . " !important;
}

#eut-product-bar.eut-layout-1 .eut-nav-item {
	color: " . crocal_eutf_option( 'product_bar_nav_title_color', '#ffffff'  ) . ";
}

#eut-product-bar.eut-layout-1 .eut-nav-item .eut-arrow {
	color: " . crocal_eutf_option( 'product_bar_arrow_color', '#ffffff'  ) . ";
}

#eut-product-bar .eut-backlink {
	background-color: " . crocal_eutf_option( 'product_bar_backlink_background', '#ffffff'  ) . ";
}

#eut-product-bar .eut-backlink svg {
	fill: " . crocal_eutf_option( 'product_bar_backlink_color', '#000000'  ) . ";
}

";

// output dynamic css
echo crocal_eutf_compress_css( $css );

//Omit closing PHP tag to avoid accidental whitespace output errors.
