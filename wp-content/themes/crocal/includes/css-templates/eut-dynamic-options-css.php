<?php
/**
 *  Dynamic css style
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */

$css = "";


/* =========================================================================== */

/* Body
/* Container Size
/* Boxed Size
/* Top Bar

/* Default Header
	/* - Default Header Colors
	/* - Default Header Menu Colors
	/* - Default Header Sub Menu Colors
	/* - Default Header Layout
	/* - Default Header Overlaping

/* Logo On Top Header
	/* - Logo On Top Header Colors
	/* - Logo On Top Header Menu Colors
	/* - Logo On Top Header Sub Menu Colors
	/* - Logo On Top Header Layout
	/* - Logo On Top Header Overlaping

/* Light Header
/* Dark Header

/* Sticky Header
	/* - Sticky Default Header
	/* - Sticky Logo On Top Header
	/* - Sticky Header Colors
	/* - Crocal Sticky Header

/* Side Area Colors
/* Modals Colors

/* Responsive Header
	/* - Header Layout
	/* - Responsive Menu
	/* - Responsive Header Elements

/* Spinner
/* Box Item
/* Primary Text Color
/* Primary Bg Color
/* Anchor Menu
/* Breadcrumbs
/* Main Content
	/* - Main Content Borders
	/* - Widget Colors

/* Bottom Bar Colors
/* Post Navigation Bar
/* Portfolio Navigation Bar
/* Single Post Tags & Categories
/* Footer
	/* - Widget Area
	/* - Footer Widget Colors
	/* - Footer Bar Colors

/* GDPR Privacy




/* =========================================================================== */


/* Body
============================================================================= */

$crocal_eutf_container_size_threshold = crocal_eutf_option( 'container_size', '1170' );
$crocal_eutf_container_size_threshold = filter_var( $crocal_eutf_container_size_threshold, FILTER_SANITIZE_NUMBER_INT );

$crocal_eutf_responsive_header_threshold = crocal_eutf_option( 'responsive_header_threshold', '1024' );
$crocal_eutf_responsive_header_threshold = filter_var( $crocal_eutf_responsive_header_threshold, FILTER_SANITIZE_NUMBER_INT );

$crocal_eutf_content_body_background = crocal_eutf_option( 'body_background', array( 'background-color' => '#171A1D' ) );
$css .= "
.eut-body {
	" . crocal_eutf_get_background_css( $crocal_eutf_content_body_background ) . "
}
";

if ( 'fixed' == crocal_eutf_array_value( $crocal_eutf_content_body_background, 'background-attachment' ) ) {
	$crocal_eutf_content_body_background['background-attachment'] = 'scroll';
	$css .= "
		.eut-body {
			clip: rect(auto auto auto auto);
		}
		.eut-body:before {
			" . crocal_eutf_get_background_css( $crocal_eutf_content_body_background ) . "
			content: '';
			position:fixed;
			top:0;
			width:100vw;
			height:100vh;
			left:0;
			right:0;
			z-index:-1;
		}
	";
}

/* Container Size
============================================================================= */
$css .= "

.eut-container,
#disqus_thread,
#eut-content.eut-left-sidebar .eut-content-wrapper,
#eut-content.eut-right-sidebar .eut-content-wrapper {
	max-width: " . crocal_eutf_option( 'container_size', 1170 ) . "px;
}

.eut-section.eut-container-width {
	max-width: " . crocal_eutf_option( 'container_size', 1170 ) . "px;
	display: block;
	margin-left: auto;
	margin-right: auto;
}


@media only screen and (max-width: " . esc_attr( $crocal_eutf_container_size_threshold + 60 ) . "px) {
	.eut-container,
	#disqus_thread,
	#eut-content.eut-left-sidebar .eut-content-wrapper,
	#eut-content.eut-right-sidebar .eut-content-wrapper {
		width: 90%;
		max-width: " . crocal_eutf_option( 'container_size', 1170 ) . "px;
	}
}

@media only screen and (min-width: 960px) {

	#eut-theme-wrapper.eut-header-side .eut-container,
	#eut-theme-wrapper.eut-header-side #eut-content.eut-left-sidebar .eut-content-wrapper,
	#eut-theme-wrapper.eut-header-side #eut-content.eut-right-sidebar .eut-content-wrapper {
		width: 90%;
		max-width: " . crocal_eutf_option( 'container_size', 1170 ) . "px;
	}

}

";

/* Boxed Size
============================================================================= */
$css .= "

body.eut-boxed #eut-theme-wrapper {
	width: 100%;
	max-width: " . crocal_eutf_option( 'boxed_size', 1220 ) . "px;
}

.eut-body.eut-boxed #eut-header.eut-fixed #eut-main-header,
.eut-body.eut-boxed #eut-crocal-sticky-header,
.eut-body.eut-boxed .eut-anchor-menu .eut-anchor-wrapper.eut-sticky,
.eut-body.eut-boxed #eut-footer.eut-fixed-footer,
.eut-body.eut-boxed #eut-top-bar.eut-fixed .eut-wrapper {
	max-width: " . crocal_eutf_option( 'boxed_size', 1220 ) . "px;
}

@media only screen and (max-width: 1200px) {

	.eut-body.eut-boxed #eut-header.eut-sticky-header #eut-main-header.eut-header-default,
	.eut-body.eut-boxed #eut-header.eut-sticky-header #eut-main-header #eut-bottom-header,
	.eut-body.eut-boxed #eut-header.eut-fixed #eut-main-header {
		max-width: 90%;
	}

	.eut-body.eut-boxed #eut-theme-wrapper,
	.eut-body.eut-boxed #eut-top-bar.eut-fixed .eut-wrapper,
	.eut-body.eut-boxed .eut-anchor-menu .eut-anchor-wrapper.eut-sticky,
	.eut-body.eut-boxed #eut-content.eut-right-sidebar .eut-content-wrapper,
	.eut-body.eut-boxed #eut-content.eut-left-sidebar .eut-content-wrapper	{
		max-width: 90%;
	}

    body.eut-boxed #eut-theme-wrapper {
        margin-top: 0;
        margin-bottom: 0;
    }

}

@media only screen and (max-width: 1023px) {
	.eut-body.eut-boxed #eut-content.eut-right-sidebar .eut-content-wrapper,
	.eut-body.eut-boxed #eut-content.eut-left-sidebar .eut-content-wrapper {
		max-width: 100%;
	}
}

";

/* Framed Size
============================================================================= */
$crocal_eutf_theme_layout = crocal_eutf_option( 'theme_layout', 'stretched' );
$crocal_eutf_frame_size = crocal_eutf_option( 'frame_size', 30 );
if ( 'framed' == $crocal_eutf_theme_layout ) {
	$css .= "

	@media only screen and (min-width: " . esc_attr( $crocal_eutf_responsive_header_threshold ) . "px) {
		body.eut-framed {
			margin: " . esc_attr( $crocal_eutf_frame_size ) . "px;
		}
		.eut-frame {
			background-color: " . crocal_eutf_option( 'frame_color' ) . ";
		}
		.eut-frame.eut-top {
			top: 0;
			left: 0;
			width: 100%;
			height: " . esc_attr( $crocal_eutf_frame_size ) . "px;
		}
		.eut-frame.eut-left {
			top: 0;
			left: 0;
			width: " . esc_attr( $crocal_eutf_frame_size ) . "px;
			height: 100%;
		}
		.eut-frame.eut-right {
			top: 0;
			right: 0;
			width: " . esc_attr( $crocal_eutf_frame_size ) . "px;
			height: 100%;
		}
		.eut-frame.eut-bottom {
			bottom: 0;
			left: 0;
			width: 100%;
			height: " . esc_attr( $crocal_eutf_frame_size ) . "px;
		}

		#eut-body.admin-bar .eut-frame.eut-top {
			top: 32px;
		}

		#eut-header.eut-fixed #eut-main-header,
		#eut-header.eut-fixed #eut-bottom-header,
		#eut-crocal-sticky-header,
		#eut-theme-wrapper:not(.eut-header-side) .eut-anchor-menu .eut-anchor-wrapper.eut-sticky {
			width: auto;
			left: " . esc_attr( $crocal_eutf_frame_size ) . "px;
			right: " . esc_attr( $crocal_eutf_frame_size ) . "px;
		}

		#eut-main-header.eut-header-side {
			top: " . esc_attr( $crocal_eutf_frame_size ) . "px;
			left: " . esc_attr( $crocal_eutf_frame_size ) . "px;
		}

		#eut-main-header.eut-header-side .eut-header-elements-wrapper {
			bottom: " . esc_attr( $crocal_eutf_frame_size ) . "px;
		}

		.eut-back-top {
			bottom: -" . esc_attr( $crocal_eutf_frame_size ) . "px;
			right: " . ( esc_attr( $crocal_eutf_frame_size ) + 20 ) . "px;
		}

		.eut-close-modal {
			top: " . ( esc_attr( $crocal_eutf_frame_size ) + 20 ) . "px;
			right: " . ( esc_attr( $crocal_eutf_frame_size ) + 20 ) . "px;
		}

		.eut-hiddenarea-wrapper {
			top: " . esc_attr( $crocal_eutf_frame_size ) . "px;
		}

		#fp-nav.right,
		#pp-nav.right {
			right: " . ( esc_attr( $crocal_eutf_frame_size ) + 20 ) . "px;
		}

		#eut-top-bar.eut-sticky-topbar.eut-fixed .eut-wrapper {
			top: " . esc_attr( $crocal_eutf_frame_size ) . "px;
		}

		.mfp-arrow {
			right: " . ( esc_attr( $crocal_eutf_frame_size ) + 20 ) . "px;
		}

		.mfp-arrow-left {
			top: 111px;
		}

		.mfp-arrow-right {
			top: 172px;
		}

		.eut-sidearea-btn {
			right:  " . ( esc_attr( $crocal_eutf_frame_size ) + 20 ) . "px;
			bottom:  " . ( esc_attr( $crocal_eutf_frame_size ) + 20 ) . "px;
		}

		.eut-sidearea-close-btn {
			right:  " . ( esc_attr( $crocal_eutf_frame_size ) + 20 ) . "px;
			top:  " . ( esc_attr( $crocal_eutf_frame_size ) + 20 ) . "px;
		}

	}
	";
}

/* Top Bar
============================================================================= */
$css .= "
#eut-top-bar .eut-wrapper {
	padding-top: " . crocal_eutf_option( 'top_bar_spacing', '', 'padding-top' ) . ";
	padding-bottom: " . crocal_eutf_option( 'top_bar_spacing', '', 'padding-bottom'  ) . ";
}

#eut-top-bar .eut-wrapper,
#eut-top-bar .eut-language > li > ul,
#eut-top-bar .eut-top-bar-menu ul.sub-menu {
	background-color: " . crocal_eutf_option( 'top_bar_bg_color' ) . ";
	color: " . crocal_eutf_option( 'top_bar_font_color' ) . ";
}

#eut-top-bar a {
	color: " . crocal_eutf_option( 'top_bar_link_color' ) . ";
}

#eut-top-bar a:hover {
	color: " . crocal_eutf_option( 'top_bar_hover_color' ) . ";
}

";


/* Default Header
============================================================================= */
$crocal_eutf_header_mode = crocal_eutf_option( 'header_mode', 'default' );
if ( 'default' == $crocal_eutf_header_mode ) {

	/* - Default Header Colors
	============================================================================= */

	$crocal_eutf_default_header_background_color = crocal_eutf_option( 'default_header_background_color', '#ffffff' );
	$crocal_eutf_default_header_border_color = crocal_eutf_option( 'default_header_border_color', '#000000' );
	$css .= "

	#eut-main-header {
		background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_default_header_background_color ) . "," . crocal_eutf_option( 'default_header_background_color_opacity', '1') . ");
	}

	#eut-main-header.eut-transparent,
	#eut-main-header.eut-light,
	#eut-main-header.eut-dark {
		background-color: transparent;
	}

	#eut-main-header.eut-header-default,
	.eut-header-elements {
		border-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_default_header_border_color ) . "," . crocal_eutf_option( 'default_header_border_color_opacity', '1') . ");
	}

	";

	/* - Default Header Menu Colors
	========================================================================= */
	$css .= "
	.eut-logo-text a,
	#eut-header .eut-main-menu .eut-wrapper > ul > li > a,
	.eut-header-element > a,
	.eut-header-element .eut-purchased-items,
	.eut-header-text-element,
	.eut-sidearea-btn.eut-out-canvas {
		color: " . crocal_eutf_option( 'default_header_menu_text_color' ) . ";
	}

	.eut-hidden-menu-btn a .eut-item:not(.eut-with-text) span {
		background-color: " . crocal_eutf_option( 'default_header_menu_text_color' ) . ";
	}

	.eut-logo-text a:hover,
	#eut-header .eut-main-menu .eut-wrapper > ul > li.eut-current > a,
	#eut-header .eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
	#eut-header .eut-main-menu .eut-wrapper > ul > li.current-menu-ancestor > a,
	#eut-header .eut-main-menu .eut-wrapper > ul > li:hover > a,
	.eut-header-element > a:hover {
		color: " . crocal_eutf_option( 'default_header_menu_text_hover_color' ) . ";
	}

	#eut-header .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-item > a span,
	#eut-header .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-ancestor > a span {
		border-color: " . crocal_eutf_option( 'default_header_menu_type_color' ) . ";
	}

	#eut-header .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li:hover > a span,
	#eut-header .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.active > a span {
		border-color: " . crocal_eutf_option( 'default_header_menu_type_color_hover' ) . ";
	}

	#eut-header .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li > a .eut-item:after {
		background-color: " . crocal_eutf_option( 'default_header_menu_type_color' ) . ";
	}

	#eut-header .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li:hover > a .eut-item:after,
	#eut-header .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li.active > a .eut-item:after {
		background-color: " . crocal_eutf_option( 'default_header_menu_type_color_hover' ) . ";
	}

	";


	/* - Default Header Sub Menu Colors
	========================================================================= */
	$css .= "
	#eut-header .eut-main-menu .eut-wrapper > ul > li ul  {
		background-color: " . crocal_eutf_option( 'default_header_submenu_bg_color' ) . ";
	}

	#eut-header .eut-main-menu .eut-wrapper > ul > li ul li a {
		color: " . crocal_eutf_option( 'default_header_submenu_text_color' ) . ";
	}

	#eut-header .eut-main-menu .eut-wrapper > ul > li ul li a:hover,
	#eut-header .eut-main-menu .eut-wrapper > ul > li ul li.current-menu-item > a,
	#eut-header .eut-main-menu .eut-wrapper > ul li li.current-menu-ancestor > a {
		color: " . crocal_eutf_option( 'default_header_submenu_text_hover_color' ) . ";
		background-color: " . crocal_eutf_option( 'default_header_submenu_text_bg_hover_color' ) . ";
	}

	#eut-header .eut-main-menu .eut-wrapper > ul > li.megamenu  ul > li.menu-item-has-children > a {
		color: " . crocal_eutf_option( 'default_header_submenu_column_text_color' ) . ";
		background-color: transparent;
	}

	#eut-header .eut-main-menu .eut-wrapper > ul > li.megamenu  ul > li.menu-item-has-children:hover > a {
		color: " . crocal_eutf_option( 'default_header_submenu_column_text_hover_color' ) . ";
	}

	#eut-header .eut-horizontal-menu ul.eut-menu li.megamenu > .sub-menu > li {
		border-color: " . crocal_eutf_option( 'default_header_submenu_border_color' ) . ";
	}

	#eut-header .eut-main-menu .eut-wrapper > ul > li ul li.eut-menu-type-button a {
		background-color: transparent;
	}

	";

	/* - Sub Menu Position
	========================================================================= */
	$crocal_eutf_submenu_top_position = crocal_eutf_option( 'submenu_top_position', '0' );
	if( 0 != $crocal_eutf_submenu_top_position ) {
		$css .= "
		#eut-header:not(.eut-sticky-header) .eut-horizontal-menu ul.eut-menu ul,
		#eut-header.eut-sticky-header[data-sticky='simple'] .eut-horizontal-menu ul.eut-menu ul  {
			margin-top: -" . crocal_eutf_option( 'submenu_top_position' ) . "px;
		}

		";
	}

	/* - Default Header Layout
	========================================================================= */
	$css .= "
	#eut-main-header,
	.eut-header-text-element,
	.eut-logo {
		height: " . crocal_eutf_option( 'header_height', 120 ) . "px;
	}

	.eut-logo a {
		height: " . crocal_eutf_option( 'logo_height', 20 ) . "px;
	}

	.eut-logo.eut-logo-text a {
		line-height: " . crocal_eutf_option( 'header_height', 120 ) . "px;
	}

	#eut-main-menu .eut-wrapper > ul > li > a,
	.eut-header-element > a,
	.eut-no-assigned-menu {
		line-height: " . crocal_eutf_option( 'header_height', 120 ) . "px;
	}

	.eut-logo .eut-wrapper img {
		padding-top: 0;
		padding-bottom: 0;
	}

	";

	/* Go to section Position */
	$css .= "
	#eut-theme-wrapper.eut-feature-below .eut-goto-section-wrapper {
		margin-bottom: " . crocal_eutf_option( 'header_height', 120 ) . "px;
	}
	";

	/* - Default Header Overlaping
	========================================================================= */
	$css .= "
	@media only screen and (min-width: " . esc_attr( $crocal_eutf_responsive_header_threshold ) . "px) {
		#eut-header.eut-overlapping + #eut-theme-content {
			top: -" . crocal_eutf_option( 'header_height', 120 ) . "px;
			margin-bottom: -" . crocal_eutf_option( 'header_height', 120 ) . "px;
		}

		#eut-feature-section + #eut-header.eut-overlapping {
			top: -" . crocal_eutf_option( 'header_height', 120 ) . "px;
		}

		#eut-header {
			height: " . crocal_eutf_option( 'header_height', 120 ) . "px;
		}
	}

	";


/* Logo On Top Header
============================================================================= */
} else if ( 'logo-top' == $crocal_eutf_header_mode ) {


	/* - Logo On Top Header Colors
	============================================================================= */
	$crocal_eutf_logo_top_logo_area_background_color = crocal_eutf_option( 'logo_top_header_logo_area_background_color', '#ffffff' );
	$crocal_eutf_logo_top_menu_area_background_color = crocal_eutf_option( 'logo_top_header_menu_area_background_color', '#ffffff' );
	$crocal_eutf_logo_top_border_color = crocal_eutf_option( 'logo_top_header_border_color', '#000000' );
	$css .= "

	#eut-main-header #eut-top-header {
		background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_logo_top_logo_area_background_color ) . "," . crocal_eutf_option( 'logo_top_header_logo_area_background_color_opacity', '1') . ");
	}

	#eut-main-header #eut-bottom-header {
		background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_logo_top_menu_area_background_color ) . "," . crocal_eutf_option( 'logo_top_header_menu_area_background_color_opacity', '1') . ");
		border-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_logo_top_border_color ) . "," . crocal_eutf_option( 'logo_top_header_border_color_opacity', '1') . ");
	}
	#eut-main-header {
		border-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_logo_top_border_color ) . "," . crocal_eutf_option( 'logo_top_header_border_color_opacity', '1') . ");
	}

	.eut-header-elements {
		border-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_logo_top_border_color ) . "," . crocal_eutf_option( 'logo_top_header_border_color_opacity', '1') . ");
	}

	#eut-main-header.eut-transparent #eut-top-header,
	#eut-main-header.eut-light #eut-top-header,
	#eut-main-header.eut-dark #eut-top-header,
	#eut-main-header.eut-transparent #eut-bottom-header,
	#eut-main-header.eut-light #eut-bottom-header,
	#eut-main-header.eut-dark #eut-bottom-header {
		background-color: transparent;
	}

	";

	/* - Logo On Top Header Menu Colors
	========================================================================= */
	$css .= "
	.eut-logo-text a,
	#eut-header .eut-main-menu .eut-wrapper > ul > li > a,
	.eut-header-element > a,
	.eut-header-text-element,
	.eut-header-element .eut-purchased-items {
		color: " . crocal_eutf_option( 'logo_top_header_menu_text_color' ) . ";
	}

	.eut-hidden-menu-btn a .eut-item:not(.eut-with-text) span {
		background-color: " . crocal_eutf_option( 'logo_top_header_menu_text_color' ) . ";
	}

	.eut-logo-text a:hover,
	#eut-header .eut-main-menu .eut-wrapper > ul > li.eut-current > a,
	#eut-header .eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
	#eut-header .eut-main-menu .eut-wrapper > ul > li.current-menu-ancestor > a,
	#eut-header .eut-main-menu .eut-wrapper > ul > li:hover > a,
	.eut-header-element > a:hover {
		color: " . crocal_eutf_option( 'logo_top_header_menu_text_hover_color' ) . ";
	}

	#eut-header .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-item > a span,
	#eut-header .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-ancestor > a span {
		border-color: " . crocal_eutf_option( 'logo_top_header_menu_type_color' ) . ";
	}

	#eut-header .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li:hover > a span,
	#eut-header .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.active > a span {
		border-color: " . crocal_eutf_option( 'logo_top_header_menu_type_color_hover' ) . ";
	}

	#eut-header .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li > a .eut-item:after {
		background-color: " . crocal_eutf_option( 'logo_top_header_menu_type_color' ) . ";
	}

	#eut-header .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li:hover > a .eut-item:after,
	#eut-header .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li.active > a .eut-item:after {
		background-color: " . crocal_eutf_option( 'logo_top_header_menu_type_color_hover' ) . ";
	}


	";


	/* - Logo On Top Header Sub Menu Colors
	========================================================================= */
	$css .= "
	#eut-header .eut-main-menu .eut-wrapper > ul > li ul  {
		background-color: " . crocal_eutf_option( 'logo_top_header_submenu_bg_color' ) . ";
	}

	#eut-header .eut-main-menu .eut-wrapper > ul > li ul li a {
		color: " . crocal_eutf_option( 'logo_top_header_submenu_text_color' ) . ";
	}

	#eut-header .eut-main-menu .eut-wrapper > ul > li ul li a:hover,
	#eut-header .eut-main-menu .eut-wrapper > ul > li ul li.current-menu-item > a,
	#eut-header .eut-main-menu .eut-wrapper > ul li li.current-menu-ancestor > a {
		color: " . crocal_eutf_option( 'logo_top_header_submenu_text_hover_color' ) . ";
		background-color: " . crocal_eutf_option( 'logo_top_header_submenu_text_bg_hover_color' ) . ";
	}

	#eut-header .eut-main-menu .eut-wrapper > ul > li.megamenu > ul > li > a {
		color: " . crocal_eutf_option( 'logo_top_header_submenu_column_text_color' ) . ";
		background-color: transparent;
	}

	#eut-header .eut-main-menu .eut-wrapper > ul > li.megamenu > ul > li:hover > a {
		color: " . crocal_eutf_option( 'logo_top_header_submenu_column_text_hover_color' ) . ";
	}

	#eut-header .eut-horizontal-menu ul.eut-menu li.megamenu > .sub-menu > li {
		border-color: " . crocal_eutf_option( 'logo_top_header_submenu_border_color' ) . ";
	}

	";

	/* - Logo On Top Header Layout
	========================================================================= */
	$crocal_eutf_header_height = intval( crocal_eutf_option( 'header_top_height', 120 ) ) + intval( crocal_eutf_option( 'header_bottom_height', 50 ) + 1 );
	$css .= "

	#eut-top-header,
	.eut-logo {
		height: " . crocal_eutf_option( 'header_top_height', 120 ) . "px;
	}

	@media only screen and (min-width: " . esc_attr( $crocal_eutf_responsive_header_threshold ) . "px) {
		#eut-header {
			height: " . esc_attr( $crocal_eutf_header_height ) . "px;
		}
	}

	.eut-logo a {
		height: " . crocal_eutf_option( 'header_top_logo_height', 30 ) . "px;
	}

	.eut-logo.eut-logo-text a {
		line-height: " . crocal_eutf_option( 'header_top_height', 120 ) . "px;
	}

	#eut-bottom-header,
	#eut-main-menu,
	.eut-header-text-element {
		height: " . ( crocal_eutf_option( 'header_bottom_height', 50 ) + 1 ) . "px;
	}

	#eut-main-menu .eut-wrapper > ul > li > a,
	.eut-header-element > a,
	.eut-no-assigned-menu {
		line-height: " . crocal_eutf_option( 'header_bottom_height', 50 ) . "px;
	}

	";

	/* Go to section Position */
	$css .= "
	#eut-theme-wrapper.eut-feature-below .eut-goto-section-wrapper {
		margin-bottom: " . esc_attr( $crocal_eutf_header_height ) . "px;
	}
	";

	/* - Logo On Top Header Overlaping
	========================================================================= */
	$css .= "

	@media only screen and (min-width: " . esc_attr( $crocal_eutf_responsive_header_threshold ) . "px) {
		#eut-header.eut-overlapping + #eut-theme-content {
			top: -" . esc_attr( $crocal_eutf_header_height ) . "px;
			margin-bottom: -" . esc_attr( $crocal_eutf_header_height ) . "px;
		}

		#eut-feature-section + #eut-header.eut-overlapping {
			top: -" . esc_attr( $crocal_eutf_header_height ) . "px;
		}

		.eut-feature-below #eut-feature-section:not(.eut-with-map) .eut-wrapper {
			margin-bottom: " . crocal_eutf_option( 'header_top_height', 120 ) . "px;
		}
	}

	";



} else {

	/* - Side Header Colors
	============================================================================= */
	$crocal_eutf_side_header_background_color = crocal_eutf_option( 'side_header_background_color', '#ffffff' );
	$css .= "
	#eut-main-header {
		background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_side_header_background_color ) . "," . crocal_eutf_option( 'side_header_background_color_opacity', '1') . ");
	}

	#eut-main-header.eut-transparent,
	#eut-main-header.eut-light,
	#eut-main-header.eut-dark {
		background-color: transparent;
	}

	";

	/* - Side Header Menu Colors
	========================================================================= */
	$css .= "
	.eut-logo-text a,
	#eut-main-menu .eut-wrapper > ul > li > a,
	.eut-header-element > a,
	.eut-header-element .eut-purchased-items,
	.eut-header-text-element {
		color: " . crocal_eutf_option( 'side_header_menu_text_color' ) . ";

	}

	.eut-hidden-menu-btn a .eut-item:not(.eut-with-text) span {
		background-color: " . crocal_eutf_option( 'side_header_menu_text_color' ) . ";
	}

	.eut-logo-text a:hover,
	#eut-main-menu .eut-wrapper > ul > li.active > a,
	#eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
	#eut-main-menu .eut-wrapper > ul > li.current-menu-ancestor > a,
	#eut-main-menu .eut-wrapper > ul > li > a:hover,
	.eut-header-element > a:hover ,
	#eut-main-menu .eut-wrapper > ul > li ul li.eut-goback a {
		color: " . crocal_eutf_option( 'side_header_menu_text_hover_color' ) . ";
	}

	";


	/* - Side Header Sub Menu Colors
	========================================================================= */
	$crocal_eutf_side_header_border_color = crocal_eutf_option( 'side_header_border_color', '#ffffff' );
	$css .= "

	#eut-main-menu .eut-wrapper > ul > li ul li a {
		color: " . crocal_eutf_option( 'side_header_submenu_text_color' ) . ";
	}

	#eut-main-menu .eut-wrapper > ul > li ul li a:hover,
	#eut-main-menu .eut-wrapper > ul > li ul li.current-menu-item > a,
	.eut-slide-menu ul.eut-menu .eut-arrow:hover {
		color: " . crocal_eutf_option( 'side_header_submenu_text_hover_color' ) . ";
	}

	#eut-main-menu.eut-vertical-menu  ul li,
	#eut-main-header.eut-header-side .eut-header-elements {
		border-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_side_header_border_color ) . "," . crocal_eutf_option( 'side_header_border_opacity', '1') . ");
	}

	";

	/* - Side Header Layout
	========================================================================= */
	$css .= "
	.eut-logo a {
		height: " . crocal_eutf_option( 'header_side_logo_height', 30 ) . "px;
	}
	#eut-main-header.eut-header-side .eut-logo {
		padding-top: " . crocal_eutf_option( 'header_side_logo_spacing', '', 'padding-top' ) . ";
		padding-bottom: " . crocal_eutf_option( 'header_side_logo_spacing', '', 'padding-bottom'  ) . ";
	}
	#eut-main-header.eut-header-side .eut-content,
	#eut-main-header.eut-header-side .eut-header-elements-wrapper {
		padding-left: " . crocal_eutf_option( 'header_side_spacing', '', 'padding-left' ) . ";
		padding-right: " . crocal_eutf_option( 'header_side_spacing', '', 'padding-right'  ) . ";
	}

	@media only screen and (min-width: " . esc_attr( $crocal_eutf_responsive_header_threshold ) . "px) {
		#eut-theme-wrapper.eut-header-side,
		#eut-footer.eut-fixed-footer {
			padding-left: " . crocal_eutf_option( 'header_side_width', 120 ) . "px;
		}

		.eut-body.rtl #eut-theme-wrapper.eut-header-side,
		.eut-body.rtl #eut-footer.eut-fixed-footer {
			padding-left: 0;
			padding-right: " . crocal_eutf_option( 'header_side_width', 120 ) . "px;
		}

		#eut-main-header.eut-header-side,
		#eut-main-header.eut-header-side .eut-content {
			width: " . crocal_eutf_option( 'header_side_width', 120 ) . "px;
		}

		.eut-body.eut-boxed #eut-theme-wrapper.eut-header-side #eut-main-header.eut-header-side,
		#eut-footer.eut-fixed-footer {
			margin-left: -" . crocal_eutf_option( 'header_side_width', 120 ) . "px;
		}

		.eut-body.eut-boxed.rtl #eut-theme-wrapper.eut-header-side #eut-main-header.eut-header-side,
		.eut-body.rtl #eut-footer.eut-fixed-footer {
			margin-left: 0;
			margin-right: -" . crocal_eutf_option( 'header_side_width', 120 ) . "px;
		}

		#eut-main-header.eut-header-side .eut-main-header-wrapper {
			width: " . intval( crocal_eutf_option( 'header_side_width', 120 ) + 30 ) . "px;
		}
		.eut-anchor-menu .eut-anchor-wrapper.eut-sticky {
			width: calc(100% - " . crocal_eutf_option( 'header_side_width', 120 ) . "px);
		}

		.eut-body.eut-boxed .eut-anchor-menu .eut-anchor-wrapper.eut-sticky {
			max-width: calc(" . crocal_eutf_option( 'boxed_size', 1220 ) . "px - " . crocal_eutf_option( 'header_side_width', 120 ) . "px);
		}
	}

	";
}

/* Menu Label
============================================================================= */
$css .= "
#eut-header .eut-main-menu .eut-item .label.eut-bg-default,
#eut-hidden-menu .eut-item .label.eut-bg-default {
	background-color: " . crocal_eutf_option( 'default_header_label_bg_color' ) . ";
	color: " . crocal_eutf_option( 'default_header_label_text_color' ) . ";
}
";

/* Light Header
============================================================================= */
$crocal_eutf_light_header_border_color = crocal_eutf_option( 'light_header_border_color', '#ffffff' );
$css .= "
#eut-main-header.eut-light .eut-logo-text a,
#eut-main-header.eut-light #eut-main-menu .eut-wrapper > ul > li > a,
#eut-main-header.eut-light .eut-header-element > a,
#eut-main-header.eut-light .eut-header-element .eut-purchased-items,
#eut-main-header.eut-light .eut-header-text-element,
#eut-main-header.eut-light .eut-sidearea-btn.eut-out-canvas {
	color: " . crocal_eutf_option( 'light_menu_text_color' ) . ";
}

#eut-main-header.eut-light .eut-hidden-menu-btn a .eut-item:not(.eut-with-text) span {
	background-color: " . crocal_eutf_option( 'light_menu_text_color' ) . ";
}

#eut-main-header.eut-light .eut-logo-text a:hover,
#eut-main-header.eut-light #eut-main-menu .eut-wrapper > ul > li.eut-current > a,
#eut-main-header.eut-light #eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
#eut-main-header.eut-light #eut-main-menu .eut-wrapper > ul > li:hover > a,
#eut-main-header.eut-light #eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
#eut-main-header.eut-light #eut-main-menu .eut-wrapper > ul > li.current-menu-ancestor > a,
#eut-main-header.eut-light .eut-header-element > a:hover {
	color: " . crocal_eutf_option( 'light_menu_text_hover_color' ) . ";
}

#eut-main-header.eut-light #eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-item > a span,
#eut-main-header.eut-light #eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-ancestor > a span,
#eut-main-header.eut-light #eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li:hover > a span {
	border-color: " . crocal_eutf_option( 'light_menu_type_color_hover' ) . ";
}

#eut-main-header.eut-light #eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li > a .eut-item:after,
#eut-main-header.eut-light #eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li:hover > a .eut-item:after {
	background-color: " . crocal_eutf_option( 'light_menu_type_color_hover' ) . ";
}

#eut-main-header.eut-light,
#eut-main-header.eut-light .eut-header-elements,
#eut-main-header.eut-header-default.eut-light,
#eut-main-header.eut-light #eut-bottom-header {
	border-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_light_header_border_color ) . "," . crocal_eutf_option( 'light_header_border_color_opacity', '1') . ");
}

";

/* Dark Header
============================================================================= */
$crocal_eutf_dark_header_border_color = crocal_eutf_option( 'dark_header_border_color', '#ffffff' );
$css .= "
#eut-main-header.eut-dark .eut-logo-text a,
#eut-main-header.eut-dark #eut-main-menu .eut-wrapper > ul > li > a,
#eut-main-header.eut-dark .eut-header-element > a,
#eut-main-header.eut-dark .eut-header-element .eut-purchased-items,
#eut-main-header.eut-dark .eut-header-text-element,
#eut-main-header.eut-dark .eut-sidearea-btn.eut-out-canvas {
	color: " . crocal_eutf_option( 'dark_menu_text_color' ) . ";
}

#eut-main-header.eut-dark .eut-hidden-menu-btn a .eut-item:not(.eut-with-text) span {
	background-color: " . crocal_eutf_option( 'dark_menu_text_color' ) . ";
}

#eut-main-header.eut-dark .eut-logo-text a:hover,
#eut-main-header.eut-dark #eut-main-menu .eut-wrapper > ul > li.eut-current > a,
#eut-main-header.eut-dark #eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
#eut-main-header.eut-dark #eut-main-menu .eut-wrapper > ul > li:hover > a,
#eut-main-header.eut-dark #eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
#eut-main-header.eut-dark #eut-main-menu .eut-wrapper > ul > li.current-menu-ancestor > a,
#eut-main-header.eut-dark .eut-header-element > a:hover {
	color: " . crocal_eutf_option( 'dark_menu_text_hover_color' ) . ";
}

#eut-main-header.eut-dark #eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-item > a span,
#eut-main-header.eut-dark #eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-ancestor > a span,
#eut-main-header.eut-dark #eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li:hover > a span {
	border-color: " . crocal_eutf_option( 'dark_menu_type_color_hover' ) . ";
}

#eut-main-header.eut-dark #eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li > a .eut-item:after,
#eut-main-header.eut-dark #eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li:hover > a .eut-item:after {
	background-color: " . crocal_eutf_option( 'dark_menu_type_color_hover' ) . ";
}

#eut-main-header.eut-dark,
#eut-main-header.eut-dark .eut-header-elements,
#eut-main-header.eut-header-default.eut-dark,
#eut-main-header.eut-dark #eut-bottom-header {
	border-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_dark_header_border_color ) . "," . crocal_eutf_option( 'dark_header_border_color_opacity', '1') . ");
}

";


/* - Advanced HiddenMenu Collors
============================================================================= */
if ( 'default' == $crocal_eutf_header_mode ) {
	$css .= "

	#eut-header.eut-header-hover:not(.eut-sticky-header) #eut-main-header {
		background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_default_header_background_color ) . "," . crocal_eutf_option( 'default_header_background_color_opacity', '1') . ") !important;
	}

	#eut-header.eut-header-hover:not(.eut-sticky-header) #eut-main-header.eut-header-default,
	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-header-elements {
		border-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_default_header_border_color ) . "," . crocal_eutf_option( 'default_header_border_color_opacity', '1') . ") !important;
	}

	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu .eut-wrapper > ul > li > a,
	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-header-element > a,
	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-header-element .eut-purchased-items {
		color: " . crocal_eutf_option( 'default_header_menu_text_color' ) . " !important;
	}

	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-hidden-menu-btn a .eut-item:not(.eut-with-text) span {
		background-color: " . crocal_eutf_option( 'default_header_menu_text_color' ) . " !important;
	}

	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu .eut-wrapper > ul > li.eut-current > a,
	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu .eut-wrapper > ul > li.current-menu-ancestor > a,
	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu .eut-wrapper > ul > li:hover > a,
	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-header-element > a:hover {
		color: " . crocal_eutf_option( 'default_header_menu_text_hover_color' ) . " !important;
	}

	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-item > a span,
	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-ancestor > a span {
		border-color: " . crocal_eutf_option( 'default_header_menu_type_color' ) . " !important;
	}

	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li:hover > a span,
	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.active > a span {
		border-color: " . crocal_eutf_option( 'default_header_menu_type_color_hover' ) . " !important;
	}

	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li > a .eut-item:after {
		background-color: " . crocal_eutf_option( 'default_header_menu_type_color' ) . " !important;
	}

	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li:hover > a .eut-item:after,
	#eut-header.eut-header-hover:not(.eut-sticky-header) .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li.active > a .eut-item:after {
		background-color: " . crocal_eutf_option( 'default_header_menu_type_color_hover' ) . " !important;
	}

	";
}

/* Sticky Header
============================================================================= */

	/* - Sticky Default Header
	========================================================================= */
	if ( 'default' == $crocal_eutf_header_mode ) {
		$css .= "
			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky,
			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky {
				height: " . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px;
			}

			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky .eut-logo,
			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky .eut-logo,
			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky .eut-header-text-element,
			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky .eut-header-text-element {
				height: " . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px;
			}

			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky .eut-logo a,
			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky .eut-logo a {
				height: " . crocal_eutf_option( 'header_sticky_shrink_logo_height', 20 ) . "px;
			}

			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky .eut-logo.eut-logo-text a,
			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky .eut-logo.eut-logo-text a {
				line-height: " . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px;
			}

			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky #eut-main-menu .eut-wrapper > ul > li > a,
			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky .eut-header-element > a,
			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky .eut-no-assigned-menu,

			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky #eut-main-menu .eut-wrapper > ul > li > a,
			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky .eut-header-element > a,
			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky .eut-no-assigned-menu {
				line-height: " . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px;
			}

			#eut-header.eut-header-positioned #eut-main-header.eut-scrollup-sticky {
				-webkit-transform: translateY(-" . crocal_eutf_option( 'header_height', 60 ) . "px);
				-moz-transform:    translateY(-" . crocal_eutf_option( 'header_height', 60 ) . "px);
				-ms-transform:     translateY(-" . crocal_eutf_option( 'header_height', 60 ) . "px);
				-o-transform:      translateY(-" . crocal_eutf_option( 'header_height', 60 ) . "px);
				transform:         translateY(-" . crocal_eutf_option( 'header_height', 60 ) . "px);
			}

			#eut-header.eut-scroll-down #eut-main-header.eut-scrollup-sticky {
				-webkit-transform: translateY(-" . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px);
				-moz-transform:    translateY(-" . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px);
				-ms-transform:     translateY(-" . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px);
				-o-transform:      translateY(-" . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px);
				transform:         translateY(-" . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px);
			}

			#eut-header.eut-scroll-up #eut-main-header.eut-scrollup-sticky {
				-webkit-transform: translate3d(0, 0, 0);
				-moz-transform:    translate3d(0, 0, 0);
				-ms-transform:     translate3d(0, 0, 0);
				-o-transform:      translate3d(0, 0, 0);
				transform:         translate3d(0, 0, 0);
			}

		";

	/* - Sticky Logo On Top Header
	========================================================================= */
	} else if ( 'logo-top' == $crocal_eutf_header_mode ) {
		$crocal_eutf_header_height = intval( crocal_eutf_option( 'header_sticky_shrink_height', 120 ) ) + intval( crocal_eutf_option( 'header_bottom_height', 50 ) );
		$css .= "

			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky #eut-bottom-header,
			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky #eut-bottom-header {
				height: " . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px;
			}

			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky #eut-main-menu .eut-wrapper > ul > li > a,
			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky .eut-header-element > a,
			#eut-header.eut-sticky-header #eut-main-header.eut-shrink-sticky .eut-no-assigned-menu,

			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky #eut-main-menu .eut-wrapper > ul > li > a,
			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky .eut-header-element > a,
			#eut-header.eut-sticky-header #eut-main-header.eut-scrollup-sticky .eut-no-assigned-menu {
				line-height: " . crocal_eutf_option( 'header_sticky_shrink_height', 60 ) . "px;
			}

			#eut-header.eut-header-positioned #eut-main-header.eut-scrollup-sticky #eut-bottom-header,
			#eut-header.eut-scroll-down #eut-main-header.eut-scrollup-sticky #eut-bottom-header {
				-webkit-transform: translateY(-" . crocal_eutf_option( 'header_bottom_height', 50 ) . "px);
				-moz-transform:    translateY(-" . crocal_eutf_option( 'header_bottom_height', 50 ) . "px);
				-ms-transform:     translateY(-" . crocal_eutf_option( 'header_bottom_height', 50 ) . "px);
				-o-transform:      translateY(-" . crocal_eutf_option( 'header_bottom_height', 50 ) . "px);
				transform:         translateY(-" . crocal_eutf_option( 'header_bottom_height', 50 ) . "px);
			}

			#eut-header.eut-scroll-up #eut-main-header.eut-scrollup-sticky #eut-bottom-header {
				-webkit-transform: translate3d(0, 0, 0);
				-moz-transform:    translate3d(0, 0, 0);
				-ms-transform:     translate3d(0, 0, 0);
				-o-transform:      translate3d(0, 0, 0);
				transform:         translate3d(0, 0, 0);
			}

		";
	}


	/* - Sticky Header Colors
	========================================================================= */
	$crocal_eutf_header_sticky_border_color = crocal_eutf_option( 'header_sticky_border_color', '#ffffff' );
	$crocal_eutf_header_sticky_background_color = crocal_eutf_option( 'header_sticky_background_color', '#ffffff' );
	$css .= "

	#eut-header.eut-sticky-header #eut-main-header:not(.eut-header-logo-top),
	#eut-header.eut-sticky-header #eut-main-header #eut-bottom-header {
		background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_header_sticky_background_color ) . "," . crocal_eutf_option( 'header_sticky_background_color_opacity', '1') . ");
	}

	#eut-header.eut-header-logo-top.eut-sticky-header #eut-main-header {
		background-color: transparent;
	}

	#eut-header.eut-sticky-header .eut-logo-text a,
	#eut-header.eut-sticky-header #eut-main-header #eut-main-menu .eut-wrapper > ul > li > a,
	#eut-header.eut-sticky-header #eut-main-header .eut-header-element > a,
	#eut-header.eut-sticky-header .eut-header-element .eut-purchased-items,
	#eut-header.eut-sticky-header .eut-header-text-element,
	#eut-header.eut-sticky-header .eut-sidearea-btn.eut-out-canvas {
		color: " . crocal_eutf_option( 'sticky_menu_text_color' ) . ";
	}

	#eut-header.eut-sticky-header .eut-logo-text a:hover,
	#eut-header.eut-sticky-header #eut-main-header #eut-main-menu .eut-wrapper > ul > li.eut-current > a,
	#eut-header.eut-sticky-header #eut-main-header #eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
	#eut-header.eut-sticky-header #eut-main-header #eut-main-menu .eut-wrapper > ul > li:hover > a,
	#eut-header.eut-sticky-header #eut-main-header #eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
	#eut-header.eut-sticky-header #eut-main-header #eut-main-menu .eut-wrapper > ul > li.current-menu-ancestor > a,
	#eut-header.eut-sticky-header #eut-main-header #eut-main-menu .eut-wrapper > ul > li.active > a,
	#eut-header.eut-sticky-header #eut-main-header .eut-header-element > a:hover {
		color: " . crocal_eutf_option( 'sticky_menu_text_hover_color' ) . ";
	}

	#eut-header.eut-sticky-header #eut-main-header .eut-hidden-menu-btn a .eut-item:not(.eut-with-text) span {
		background-color: " . crocal_eutf_option( 'sticky_menu_text_hover_color' ) . ";
	}

	#eut-header.eut-sticky-header #eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-item > a span,
	#eut-header.eut-sticky-header #eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li.current-menu-ancestor > a span {
		border-color: " . crocal_eutf_option( 'header_sticky_menu_type_color' ) . ";
	}

	#eut-header.eut-sticky-header #eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li:hover > a span {
		border-color: " . crocal_eutf_option( 'header_sticky_menu_type_color_hover' ) . ";
	}

	#eut-header.eut-sticky-header #eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li > a .eut-item:after {
		background-color: " . crocal_eutf_option( 'header_sticky_menu_type_color' ) . ";
	}

	#eut-header.eut-sticky-header #eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li:hover > a .eut-item:after {
		background-color: " . crocal_eutf_option( 'header_sticky_menu_type_color_hover' ) . ";
	}

	#eut-header.eut-sticky-header #eut-main-header.eut-header-default,
	#eut-header.eut-sticky-header #eut-main-header .eut-header-elements {
		border-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_header_sticky_border_color ) . "," . crocal_eutf_option( 'header_sticky_border_color_opacity', '1') . ");
	}

	";

	/* - Crocal Sticky Header
	========================================================================= */
	$css .= "

	#eut-crocal-sticky-header,
	#eut-crocal-sticky-header .eut-logo,
	#eut-crocal-sticky-header:before {
		height: " . crocal_eutf_option( 'header_sticky_shrink_height', 120 ) . "px;
	}

	#eut-crocal-sticky-header .eut-logo a {
		height: " . crocal_eutf_option( 'header_sticky_shrink_logo_height', 20 ) . "px;
	}

	#eut-crocal-sticky-header .eut-logo.eut-logo-text a {
		line-height: " . crocal_eutf_option( 'header_sticky_shrink_height', 120 ) . "px;
	}

	#eut-crocal-sticky-header .eut-main-menu .eut-wrapper > ul > li > a,
	#eut-crocal-sticky-header .eut-header-element > a,
	#eut-crocal-sticky-header .eut-no-assigned-menu {
		line-height: " . crocal_eutf_option( 'header_sticky_shrink_height', 120 ) . "px;
	}

	#eut-crocal-sticky-header:before,
	#eut-crocal-sticky-header .eut-logo,
	#eut-crocal-sticky-header .eut-header-element > a.eut-safe-button {
		background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_header_sticky_background_color ) . "," . crocal_eutf_option( 'header_sticky_background_color_opacity', '1') . ");
	}

	#eut-crocal-sticky-header .eut-logo,
	#eut-crocal-sticky-header .eut-header-element > a.eut-safe-button {
		min-width: " . crocal_eutf_option( 'header_sticky_shrink_height', 120 ) . "px;
	}

	#eut-crocal-sticky-header .eut-main-menu .eut-wrapper > ul > li > a,
	#eut-crocal-sticky-header .eut-header-element > a {
		color: " . crocal_eutf_option( 'sticky_menu_text_color' ) . ";
	}

	#eut-crocal-sticky-header .eut-hidden-menu-btn a .eut-item:not(.eut-with-text) span {
		background-color: " . crocal_eutf_option( 'sticky_menu_text_hover_color' ) . ";
	}

	#eut-crocal-sticky-header .eut-main-menu .eut-wrapper > ul > li.eut-current > a,
	#eut-crocal-sticky-header .eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
	#eut-crocal-sticky-header .eut-main-menu .eut-wrapper > ul > li:hover > a,
	#eut-crocal-sticky-header .eut-main-menu .eut-wrapper > ul > li.current-menu-item > a,
	#eut-crocal-sticky-header .eut-main-menu .eut-wrapper > ul > li.current-menu-ancestor > a,
	#eut-crocal-sticky-header .eut-main-menu .eut-wrapper > ul > li.active > a,
	#eut-crocal-sticky-header .eut-header-element > a:hover {
		color: " . crocal_eutf_option( 'sticky_menu_text_hover_color' ) . ";
	}

	#eut-crocal-sticky-header .eut-main-menu.eut-menu-type-button .eut-wrapper > ul > li:hover > a span {
		border-color: " . crocal_eutf_option( 'header_sticky_menu_type_color_hover' ) . ";
	}

	#eut-crocal-sticky-header .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li > a .eut-item:after {
		background-color: " . crocal_eutf_option( 'header_sticky_menu_type_color' ) . ";
	}

	#eut-crocal-sticky-header .eut-main-menu.eut-menu-type-underline .eut-wrapper > ul > li:hover > a .eut-item:after {
		background-color: " . crocal_eutf_option( 'header_sticky_menu_type_color_hover' ) . ";
	}

	";

/* Side Area Colors
============================================================================= */
$crocal_eutf_sidearea_bg_type = crocal_eutf_option( 'sliding_area_bg_type', 'color' );
$crocal_eutf_sidearea_gradient_color_1 = crocal_eutf_option( 'sliding_area_gradient_color_1', '#7072F7' );
$crocal_eutf_sidearea_gradient_color_2 = crocal_eutf_option( 'sliding_area_gradient_color_2', '#403BF0' );
$crocal_eutf_sidearea_gradient_direction = crocal_eutf_option( 'sliding_area_gradient_direction', '90' );
if ( 'gradient' == $crocal_eutf_sidearea_bg_type ) {
	$css .= "
	#eut-sidearea {
		background-color: " . esc_attr( $crocal_eutf_sidearea_gradient_color_1 ) . ";
		background: linear-gradient(" . esc_attr( $crocal_eutf_sidearea_gradient_direction ) . "deg," . esc_attr( $crocal_eutf_sidearea_gradient_color_1 ) . " 0%," . esc_attr( $crocal_eutf_sidearea_gradient_color_2 ) . " 100%);
	}
	";
} else {
	$css .= "
	#eut-sidearea {
		background-color: " . crocal_eutf_option( 'sliding_area_background_color' ) . ";
	}
	";
}

$css .= "

.eut-sidearea-btn {
	background-color: " . crocal_eutf_option( 'sliding_area_shape_color' ) . ";
}

.eut-sidearea-btn path {
	fill: " . crocal_eutf_option( 'sliding_area_icon_color' ) . ";
}

#eut-sidearea {
	color: " . crocal_eutf_option( 'sliding_area_text_color' ) . ";
}

#eut-sidearea .widget,
#eut-sidearea form,
#eut-sidearea form p,
#eut-sidearea form div,
#eut-sidearea form span {
	color: " . crocal_eutf_option( 'sliding_area_text_color' ) . ";
}

#eut-sidearea h1,
#eut-sidearea h2,
#eut-sidearea h3,
#eut-sidearea h4,
#eut-sidearea h5,
#eut-sidearea h6,
#eut-sidearea .widget .eut-widget-title {
	color: " . crocal_eutf_option( 'sliding_area_title_color' ) . ";
}

#eut-sidearea a:not(.eut-btn) {
	color: " . crocal_eutf_option( 'sliding_area_link_color' ) . ";
}

#eut-sidearea .widget li a .eut-arrow:after,
#eut-sidearea .widget li a .eut-arrow:before {
	color: " . crocal_eutf_option( 'sliding_area_link_color' ) . ";
}

#eut-sidearea a:not(.eut-btn):hover {
	color: " . crocal_eutf_option( 'sliding_area_link_hover_color' ) . ";
}

#eut-sidearea .eut-border,
#eut-sidearea form,
#eut-sidearea form p,
#eut-sidearea form div,
#eut-sidearea form span,
#eut-sidearea .widget a:not(.eut-btn),
#eut-sidearea .widget ul,
#eut-sidearea .widget li,
#eut-sidearea .widget table,
#eut-sidearea .widget table td,
#eut-sidearea .widget table th,
#eut-sidearea .widget table tr,
#eut-sidearea table,
#eut-sidearea tr,
#eut-sidearea td,
#eut-sidearea th,
#eut-sidearea .widget,
#eut-sidearea .widget ul,
#eut-sidearea .widget li,
#eut-sidearea .widget div,
#eut-theme-wrapper #eut-sidearea form,
#eut-theme-wrapper #eut-sidearea .wpcf7-form-control-wrap {
	border-color: " . crocal_eutf_option( 'sliding_area_border_color' ) . ";
}

";


/* Modals Colors
============================================================================= */
$crocal_eutf_modal_overflow_background_color = crocal_eutf_option( 'modal_overflow_background_color', '#000000' );
$css .= "

#eut-modal-overlay,
.mfp-bg,
#eut-loader-overflow {
	background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_modal_overflow_background_color ) . "," . crocal_eutf_option( 'modal_overflow_background_color_opacity', '0.9') . ");
}

.eut-page-curtain {
	background-color: #18252a;
}

#eut-theme-wrapper .eut-modal-content .eut-form-style-1:not(.eut-white-bg) h1,
#eut-theme-wrapper .eut-modal-content .eut-form-style-1:not(.eut-white-bg) h2,
#eut-theme-wrapper .eut-modal-content .eut-form-style-1:not(.eut-white-bg) h3,
#eut-theme-wrapper .eut-modal-content .eut-form-style-1:not(.eut-white-bg) h4,
#eut-theme-wrapper .eut-modal-content .eut-form-style-1:not(.eut-white-bg) h5,
#eut-theme-wrapper .eut-modal-content .eut-form-style-1:not(.eut-white-bg) h6,
#eut-theme-wrapper .eut-modal-content .eut-form-style-1:not(.eut-white-bg) .eut-modal-title,
.mfp-title,
.mfp-counter,
#eut-theme-wrapper .eut-modal-content .eut-heading-color {
	color: " . crocal_eutf_option( 'modal_title_color' ) . ";
}

#eut-theme-wrapper .eut-modal .eut-border,
#eut-theme-wrapper .eut-modal form,
#eut-theme-wrapper .eut-modal form p,
#eut-theme-wrapper .eut-modal form div,
#eut-theme-wrapper .eut-modal form span,
#eut-theme-wrapper .eut-login-modal-footer,
#eut-socials-modal .eut-social li a,
#eut-language-modal ul li a {
	color: " . crocal_eutf_option( 'modal_text_color' ) . ";
	border-color: " . crocal_eutf_option( 'modal_border_color' ) . ";
}
";

$crocal_eutf_close_cursor_color = crocal_eutf_option( 'modal_cursor_color_color', 'dark' );
if ( 'dark' == $crocal_eutf_close_cursor_color ) {
	$css .= "
	.eut-close-modal,
	button.mfp-arrow {
		color: #000000;
	}
	";
} else {
	$css .= "
	.eut-close-modal,
	button.mfp-arrow {
		color: #ffffff;
	}
	";
}

/* Media Popup Colors
============================================================================= */
$crocal_eutf_media_popup_overflow_background_color = crocal_eutf_option( 'media_popup_overflow_background_color', '#000000' );
$crocal_eutf_media_popup_toolbar_background_color = crocal_eutf_option( 'media_popup_toolbar_background_color', '#000000' );

$css .= "
.pswp__bg,
.mfp-bg.eut-media-popup,
.lg-backdrop {
	background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_media_popup_overflow_background_color ) . "," . crocal_eutf_option( 'media_popup_overflow_background_color_opacity', '1') . ");
}

.lg-actions .lg-next,
.lg-actions .lg-prev,
.lg-toolbar,
.lg-sub-html {
	background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_media_popup_toolbar_background_color ) . "," . crocal_eutf_option( 'media_popup_toolbar_background_color_opacity', '0.45') . ");
}
.lg-toolbar .lg-icon,
.lg-toolbar .lg-icon,
.lg-actions .lg-next,
.lg-actions .lg-prev,
.lg-sub-html,
#lg-counter {
	color: " . crocal_eutf_option( 'media_popup_toolbar_color', '#999') . ";
}
.lg-toolbar .lg-icon:hover,
.lg-actions .lg-next:hover,
.lg-actions .lg-prev:hover,
.lg-outer.lg-dropdown-active #lg-share {
	color: " . crocal_eutf_option( 'media_popup_toolbar_hover_color', '#ffffff') . ";
}
";

/* Responsive Header
============================================================================= */
$crocal_eutf_responsive_header_background_color = crocal_eutf_option( 'responsive_header_background_color', '#000000' );
$css .= "
#eut-responsive-header #eut-main-responsive-header {
	background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_responsive_header_background_color ) . "," . crocal_eutf_option( 'responsive_header_background_opacity', '1') . ");
}
";
	/* - Header Layout
	========================================================================= */
	$css .= "
	#eut-responsive-header {
		height: " . crocal_eutf_option( 'responsive_header_height' ) . "px;
	}

	#eut-responsive-header .eut-logo {
		height: " . crocal_eutf_option( 'responsive_header_height' ) . "px;
	}

	#eut-responsive-header .eut-header-element > a {
		line-height: " . crocal_eutf_option( 'responsive_header_height' ) . "px;
	}

	#eut-responsive-header .eut-logo a {
		height: " . crocal_eutf_option( 'responsive_logo_height' ) . "px;
	}

	#eut-responsive-header .eut-logo.eut-logo-text a {
		line-height: " . crocal_eutf_option( 'responsive_header_height' ) . "px;
	}

	#eut-responsive-header .eut-logo .eut-wrapper img {
		padding-top: 0;
		padding-bottom: 0;
	}
	";

	/* - Responsive Header / Responsive Menu
	========================================================================= */
	$css .= "

	@media only screen and (max-width: " . esc_attr( $crocal_eutf_responsive_header_threshold - 1 ) . "px) {
		#eut-main-header,
		#eut-bottom-header {
			display: none;
		}

		#eut-main-menu,
		#eut-responsive-hidden-menu-wrapper {
			display: none;
		}

		#eut-responsive-header {
			display: block;
		}
		.eut-header-responsive-elements {
			display: block;
		}

		#eut-logo.eut-position-center,
		#eut-logo.eut-position-center .eut-wrapper {
			position: relative;
			left: 0;
		}

		#eut-responsive-menu-wrapper {
			display: block;
		}
	}
	";

	/* - Responsive Header Overlaping
	========================================================================= */
	$css .= "

	@media only screen and (max-width: " . esc_attr( $crocal_eutf_responsive_header_threshold - 1 ) . "px) {
		#eut-header.eut-responsive-overlapping + #eut-theme-content {
			top: -" . crocal_eutf_option( 'responsive_header_height' ) . "px;
			margin-bottom: -" . crocal_eutf_option( 'responsive_header_height' ) . "px;
		}

		#eut-header.eut-responsive-overlapping + #eut-theme-content #eut-page-anchor {
			top: 0px;
			margin-bottom: 0px;
		}

		#eut-feature-section + #eut-header.eut-responsive-overlapping {
			top: -" . crocal_eutf_option( 'responsive_header_height' ) . "px;
		}

		#eut-header.eut-responsive-overlapping + #eut-theme-content .eut-page-title .eut-wrapper,
		#eut-header.eut-responsive-overlapping + #eut-theme-content #eut-feature-section .eut-wrapper {
			padding-top: " . crocal_eutf_option( 'responsive_header_height' ) . "px;
		}

	}
	";

	/* - Responsive Menu
	========================================================================= */
	$crocal_eutf_responsive_menu_overflow_background_color = crocal_eutf_option( 'responsive_menu_overflow_background_color', '#000000' );
	$css .= "

	#eut-hidden-menu {
		background-color: " . crocal_eutf_option( 'responsive_menu_background_color' ) . ";
	}

	#eut-hidden-menu a,
	#eut-hidden-menu.eut-slide-menu ul.eut-menu li > .eut-arrow	{
		color: " . crocal_eutf_option( 'responsive_menu_link_color' ) . ";
	}

	#eut-hidden-menu:not(.eut-slide-menu) ul.eut-menu li a .eut-arrow:after,
	#eut-hidden-menu:not(.eut-slide-menu) ul.eut-menu li a .eut-arrow:before {
		background-color: " . crocal_eutf_option( 'responsive_menu_link_color' ) . ";
	}

	#eut-hidden-menu ul.eut-menu li.open > a .eut-arrow:after,
	#eut-hidden-menu ul.eut-menu li.open > a .eut-arrow:before {
		background-color: " . crocal_eutf_option( 'responsive_menu_link_hover_color' ) . ";
	}

	#eut-hidden-menu.eut-slide-menu ul.eut-menu li > .eut-arrow:hover {
		color: " . crocal_eutf_option( 'responsive_menu_link_hover_color' ) . ";
	}

	#eut-theme-wrapper .eut-header-responsive-elements form,
	#eut-theme-wrapper .eut-header-responsive-elements form p,
	#eut-theme-wrapper .eut-header-responsive-elements form div,
	#eut-theme-wrapper .eut-header-responsive-elements form span {
		color: " . crocal_eutf_option( 'responsive_menu_link_color' ) . ";
	}

	#eut-hidden-menu a:hover,
	#eut-hidden-menu ul.eut-menu > li.current-menu-item > a,
	#eut-hidden-menu ul.eut-menu > li.current-menu-ancestor > a,
	#eut-hidden-menu ul.eut-menu li.current-menu-item > a,
	#eut-hidden-menu ul.eut-menu li.open > a {
		color: " . crocal_eutf_option( 'responsive_menu_link_hover_color' ) . ";
	}

	#eut-hidden-menu .eut-close-btn {
		color: " . crocal_eutf_option( 'responsive_menu_close_btn_color' ) . ";
	}

	#eut-hidden-menu ul.eut-menu li,
	#eut-hidden-menu ul.eut-menu li a,
	#eut-theme-wrapper .eut-header-responsive-elements form,
	#eut-theme-wrapper .eut-header-responsive-elements form p,
	#eut-theme-wrapper .eut-header-responsive-elements form div,
	#eut-theme-wrapper .eut-header-responsive-elements form span {
		border-color: " . crocal_eutf_option( 'responsive_menu_border_color' ) . ";
	}

	#eut-hidden-menu-overlay {
		background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_responsive_menu_overflow_background_color ) . "," . crocal_eutf_option( 'responsive_menu_overflow_background_color_opacity', '0.9') . ");
	}

	";

	/* - Responsive Header Elements
	========================================================================= */
	$css .= "
	#eut-responsive-header .eut-logo-text a,
	#eut-responsive-header .eut-header-element > a,
	#eut-responsive-header .eut-header-element .eut-purchased-items {
		color: " . crocal_eutf_option( 'responsive_header_elements_color' ) . ";
	}

	#eut-responsive-header .eut-logo-text a:hover,
	#eut-responsive-header .eut-header-element > a:hover {
		color: " . crocal_eutf_option( 'responsive_header_elements_hover_color' ) . ";
	}

	#eut-responsive-header .eut-hidden-menu-btn a .eut-item:not(.eut-with-text) span {
		background-color: " . crocal_eutf_option( 'responsive_header_elements_color' ) . ";
	}

	";


/* Spinner
============================================================================= */


$spinner_image_id = crocal_eutf_option( 'spinner_image', '', 'id' );
if ( empty( $spinner_image_id ) ) {
	$css .= "

	.eut-spinner {
		display: inline-block;
		position: absolute !important;
		top: 50%;
		left: 50%;
		margin-top: -32px;
		margin-left: -32px;
		text-indent: -9999em;
		-webkit-transform: translateZ(0);
		-ms-transform: translateZ(0);
		transform: translateZ(0);
	}
	.eut-spinner div {
		box-sizing: border-box;
		display: block;
		position: absolute;
		width: 51px;
		height: 51px;
		margin: 6px;
		border: 6px solid #fdd;
		border-radius: 50%;
		animation: eut_spinner_animation 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
		border-color: " . crocal_eutf_option( 'body_primary_1_color' ) . " transparent transparent transparent;
	}
	.eut-spinner div:nth-child(1) {
		animation-delay: -0.45s;
	}
	.eut-spinner div:nth-child(2) {
		animation-delay: -0.3s;
	}
	.eut-spinner div:nth-child(3) {
		animation-delay: -0.15s;
	}
	@keyframes eut_spinner_animation {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}

	";
} else {

	$spinner_src = wp_get_attachment_image_src( $spinner_image_id, 'full' );
	$spinner_image_url = $spinner_src[0];
	$spinner_width = $spinner_src[1];
	$spinner_height = $spinner_src[2];

	$css .= "

	.eut-spinner:not(.custom) {
		width: " . intval( $spinner_width ) . "px;
		height: " . intval( $spinner_height ) . "px;
		background-image: url(" . esc_url( $spinner_image_url ) . ");
		background-position: center center;
		display: inline-block;
		position: absolute;
		top: 50%;
		left: 50%;
		margin-top: -" . intval( $spinner_height / 2 ) . "px;
		margin-left: -" . intval( $spinner_width / 2 ) . "px;
	}

	";
}

/* Box Item
============================================================================= */
$css .= "
#eut-theme-wrapper .eut-box-item.eut-bg-white {
	color: #000000;
	color: rgba(0,0,0,0.30);
	background-color: #ffffff;
	-webkit-box-shadow: 0px 0px 50px 0px rgba(0,0,0,0.25);
	-moz-box-shadow: 0px 0px 50px 0px rgba(0,0,0,0.25);
	box-shadow: 0px 0px 50px 0px rgba(0,0,0,0.25);
}

#eut-theme-wrapper .eut-box-item.eut-bg-black {
	color: #ffffff;
	color: rgba(255,255,255,0.60);
	background-color: #000000;
	-webkit-box-shadow: 0px 0px 50px 0px rgba(0,0,0,0.25);
	-moz-box-shadow: 0px 0px 50px 0px rgba(0,0,0,0.25);
	box-shadow: 0px 0px 50px 0px rgba(0,0,0,0.25);
}

#eut-theme-wrapper .eut-box-item.eut-bg-white .eut-heading-color {
	color: #000000;
}

#eut-theme-wrapper .eut-box-item.eut-bg-black .eut-heading-color {
	color: #ffffff;
}

";



/* Anchor Menu
============================================================================= */

// Anchor Colors
$css .= "

.eut-anchor-menu .eut-anchor-wrapper,
.eut-anchor-menu .eut-container ul {
	background-color: " . crocal_eutf_option( 'page_anchor_menu_background_color' ) . ";
}

.eut-anchor-menu .eut-anchor-wrapper {
	border-color: " . crocal_eutf_option( 'page_anchor_menu_border_color' ) . ";
}

.eut-anchor-menu li a,
.eut-anchor-menu li:last-child a,
.eut-anchor-menu .eut-anchor-btn,
.eut-anchor-responsive.eut-anchor-menu .eut-container > ul > li > a {
	color: " . crocal_eutf_option( 'page_anchor_menu_text_color' ) . ";
	background-color: transparent;
	border-color: " . crocal_eutf_option( 'page_anchor_menu_border_color' ) . ";
}

.eut-anchor-menu li a:hover,
.eut-anchor-menu li:last-child a:hover,
.eut-anchor-responsive.eut-anchor-menu .eut-container > ul > li > a:hover {
	color: " . crocal_eutf_option( 'page_anchor_menu_text_hover_color' ) . ";
	background-color: " . crocal_eutf_option( 'page_anchor_menu_background_hover_color' ) . ";
	border-color: " . crocal_eutf_option( 'page_anchor_menu_border_color' ) . ";
}

.eut-anchor-menu a .eut-arrow:after,
.eut-anchor-menu a .eut-arrow:before {
	background-color: " . crocal_eutf_option( 'page_anchor_menu_text_hover_color' ) . ";
}

";

// Page Anchor Size
$css .= "

#eut-page-anchor {
	height: " . intval( crocal_eutf_option( 'page_anchor_menu_height', 120 ) + 2 ) . "px;
}

#eut-page-anchor .eut-anchor-wrapper {
	line-height: " . crocal_eutf_option( 'page_anchor_menu_height' ) . "px;
}

#eut-page-anchor.eut-anchor-menu .eut-anchor-btn {
	width: " . crocal_eutf_option( 'page_anchor_menu_height' ) . "px;
}

";

// Post Anchor Size
$css .= "

#eut-post-anchor {
	height: " . intval( crocal_eutf_option( 'post_anchor_menu_height', 120 ) + 2 ) . "px;
}

#eut-post-anchor .eut-anchor-wrapper {
	line-height: " . crocal_eutf_option( 'post_anchor_menu_height' ) . "px;
}

#eut-post-anchor.eut-anchor-menu .eut-anchor-btn {
	width: " . crocal_eutf_option( 'page_anchor_menu_height' ) . "px;
}

";

// Portfolio Anchor Size
$css .= "

#eut-portfolio-anchor {
	height: " . intval( crocal_eutf_option( 'portfolio_anchor_menu_height', 120 ) + 2 ) . "px;
}

#eut-portfolio-anchor .eut-anchor-wrapper {
	line-height: " . crocal_eutf_option( 'portfolio_anchor_menu_height' ) . "px;
}

#eut-portfolio-anchor.eut-anchor-menu .eut-anchor-btn {
	width: " . crocal_eutf_option( 'portfolio_anchor_menu_height' ) . "px;
}

";


/* Breadcrumbs
============================================================================= */
$css .= "
.eut-breadcrumbs {
	background-color: " . crocal_eutf_option( 'page_breadcrumbs_background_color' ) . ";
	border-color: " . crocal_eutf_option( 'page_breadcrumbs_border_color' ) . ";
}

.eut-breadcrumbs ul li {
	color: " . crocal_eutf_option( 'page_breadcrumbs_divider_color' ) . ";
}

.eut-breadcrumbs ul li a {
	color: " . crocal_eutf_option( 'page_breadcrumbs_text_color' ) . ";
}

.eut-breadcrumbs ul li a:hover {
	color: " . crocal_eutf_option( 'page_breadcrumbs_text_hover_color' ) . ";
}

";

// Page Breadcrumbs Size
$css .= "

#eut-page-breadcrumbs {
	line-height: " . crocal_eutf_option( 'page_breadcrumbs_height' ) . "px;
}

";

// Post Breadcrumbs Size
$css .= "

#eut-post-breadcrumbs {
	line-height: " . crocal_eutf_option( 'post_breadcrumbs_height' ) . "px;
}

";

// Portfolio Breadcrumbs Size
$css .= "

#eut-portfolio-breadcrumbs {
	line-height: " . crocal_eutf_option( 'portfolio_breadcrumbs_height' ) . "px;
}

";

// Product Breadcrumbs Size
$css .= "

#eut-product-breadcrumbs {
	line-height: " . crocal_eutf_option( 'product_breadcrumbs_height' ) . "px;
}

";

/* Main Content
============================================================================= */
	/* - Main Content Borders
	========================================================================= */
	$css .= "
	#eut-theme-wrapper .eut-border,
	a.eut-border,
	#eut-content table,
	#eut-content tr,
	#eut-content td,
	#eut-content th,
	#eut-theme-wrapper form,
	#eut-theme-wrapper form p,
	#eut-theme-wrapper .wpcf7-form-control-wrap,
	#eut-theme-wrapper label,
	#eut-content form div,
	.mfp-content form div,
	hr,
	.eut-hr.eut-element div,
	.eut-title-double-line span:before,
	.eut-title-double-line span:after,
	.eut-title-double-bottom-line span:after,
	.vc_tta.vc_general .vc_tta-panel-title,
	#eut-single-post-tags .eut-tags li a,
	#eut-single-post-categories .eut-categories li a {
		border-color: " . crocal_eutf_option( 'body_border_color' ) . " !important;
	}
	hr.is-style-dots:before {
		color: " . crocal_eutf_option( 'body_border_color' ) . " !important;
	}

	#eut-single-post-categories .eut-categories li a {
		background-color: " . crocal_eutf_option( 'body_border_color' ) . ";
	}

	";

	/* Primary Border */
	$css .= "
	.eut-border-primary-1,
	#eut-content .eut-blog-large .eut-blog-item.sticky ul.eut-post-meta,
	.eut-carousel-pagination-2 .eut-carousel .owl-controls .owl-page.active span,
	.eut-carousel-pagination-2 .eut-carousel .owl-controls.clickable .owl-page:hover span,
	.eut-carousel-pagination-2.eut-testimonial .owl-controls .owl-page.active span,
	.eut-carousel-pagination-2.eut-testimonial .owl-controls.clickable .owl-page:hover span,
	.eut-carousel-pagination-2 .eut-flexible-carousel .owl-controls .owl-page.active span,
	.eut-carousel-pagination-2 .eut-flexible-carousel .owl-controls.clickable .owl-page:hover span,
	#eut-content .eut-read-more:after,
	#eut-content .more-link:after,
	.eut-blog-large .eut-blog-item.sticky .eut-blog-item-inner:after,
	.eut-quote-text,
	blockquote p {
		border-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	}
	";

	/* - Widget Colors
	========================================================================= */
	$css .= "
	.widget,
	.widget ul,
	.widget li,
	.widget div {
		border-color: " . crocal_eutf_option( 'body_border_color' ) . ";
	}

	.eut-widget.eut-social li a.eut-outline:hover {
		border-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	}
	.widget:not(.eut-social) a:not(.eut-outline):not(.eut-btn):hover,
	.widget.widget_nav_menu li.open > a {
		color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	}
	";



/* Post Navigation Bar
============================================================================= */
$css .= "
#eut-post-bar.eut-layout-1 {
	padding-top: " . crocal_eutf_option( 'post_nav_spacing', '', 'padding-top' ) . ";
	padding-bottom: " . crocal_eutf_option( 'post_nav_spacing', '', 'padding-bottom'  ) . ";
	background-color: " . crocal_eutf_option( 'post_bar_background_color', '#000000'  ) . ";
	border-color: " . crocal_eutf_option( 'post_bar_border_color', '#000000'  ) . " !important;
}

#eut-post-bar.eut-layout-1 .eut-nav-item {
	color: " . crocal_eutf_option( 'post_bar_nav_title_color', '#ffffff'  ) . ";
}

#eut-post-bar.eut-layout-1 .eut-nav-item .eut-arrow {
	color: " . crocal_eutf_option( 'post_bar_arrow_color', '#ffffff'  ) . ";
}

#eut-post-bar .eut-backlink {
	background-color: " . crocal_eutf_option( 'post_bar_backlink_background', '#ffffff'  ) . ";
}

#eut-post-bar .eut-backlink svg {
	fill: " . crocal_eutf_option( 'post_bar_backlink_color', '#000000'  ) . ";
}

";

/* Portfolio Navigation Bar
============================================================================= */
$css .= "
#eut-portfolio-bar.eut-layout-1 {
	padding-top: " . crocal_eutf_option( 'portfolio_nav_spacing', '', 'padding-top' ) . ";
	padding-bottom: " . crocal_eutf_option( 'portfolio_nav_spacing', '', 'padding-bottom'  ) . ";
	background-color: " . crocal_eutf_option( 'portfolio_bar_background_color', '#000000'  ) . ";
	border-color: " . crocal_eutf_option( 'portfolio_bar_border_color', '#000000'  ) . " !important;
}

#eut-portfolio-bar.eut-layout-1 .eut-nav-item {
	color: " . crocal_eutf_option( 'portfolio_bar_nav_title_color', '#ffffff'  ) . ";
}

#eut-portfolio-bar.eut-layout-1 .eut-nav-item .eut-arrow {
	color: " . crocal_eutf_option( 'portfolio_bar_arrow_color', '#ffffff'  ) . ";
}

#eut-portfolio-bar .eut-backlink {
	background-color: " . crocal_eutf_option( 'portfolio_bar_backlink_background', '#ffffff'  ) . ";
}

#eut-portfolio-bar .eut-backlink svg {
	fill: " . crocal_eutf_option( 'portfolio_bar_backlink_color', '#000000'  ) . ";
}


#eut-portfolio-bar.eut-layout-3 {
	background-color: " . crocal_eutf_option( 'portfolio_bar_background_color', '#000000'  ) . ";
	border-color: " . crocal_eutf_option( 'portfolio_bar_border_color', '#000000'  ) . " !important;
}

#eut-portfolio-bar.eut-layout-3 .eut-title {
	color: " . crocal_eutf_option( 'portfolio_bar_nav_title_color', '#ffffff'  ) . ";
}

";

/* Primary Text Color
============================================================================= */
$css .= "
::-moz-selection {
    color: #ffffff;
    background: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
}

::selection {
    color: #ffffff;
    background: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
}
";

//Gradient Colors Clear
$css .= "
	.eut-gradient-overlay.eut-gradient-opacity-0:after {
		background-image: none;
	}
";

function crocal_eutf_print_css_colors() {

	$crocal_eutf_colors = crocal_eutf_get_color_array();

	$css = '';

	foreach ( $crocal_eutf_colors as $key => $value ) {

		$font_color = '#ffffff';
		if( 'white' == $key || 'light' == $key ) {
			$font_color = '#000000';
		}

		// Headings Color
		$css .= "
			.eut-headings-" . esc_attr( $key ) . " h1,
			.eut-headings-" . esc_attr( $key ) . " h2,
			.eut-headings-" . esc_attr( $key ) . " h3,
			.eut-headings-" . esc_attr( $key ) . " h4,
			.eut-headings-" . esc_attr( $key ) . " h5,
			.eut-headings-" . esc_attr( $key ) . " h6,
			.eut-headings-" . esc_attr( $key ) . " .eut-heading-color,
			.eut-inner-section.eut-headings-" . esc_attr( $key ) . " h1,
			.eut-inner-section.eut-headings-" . esc_attr( $key ) . " h2,
			.eut-inner-section.eut-headings-" . esc_attr( $key ) . " h3,
			.eut-inner-section.eut-headings-" . esc_attr( $key ) . " h4,
			.eut-inner-section.eut-headings-" . esc_attr( $key ) . " h5,
			.eut-inner-section.eut-headings-" . esc_attr( $key ) . " h6,
			.eut-inner-section.eut-headings-" . esc_attr( $key ) . " .eut-heading-color,
			.eut-column.eut-headings-" . esc_attr( $key ) . " h1,
			.eut-column.eut-headings-" . esc_attr( $key ) . " h2,
			.eut-column.eut-headings-" . esc_attr( $key ) . " h3,
			.eut-column.eut-headings-" . esc_attr( $key ) . " h4,
			.eut-column.eut-headings-" . esc_attr( $key ) . " h5,
			.eut-column.eut-headings-" . esc_attr( $key ) . " h6,
			.eut-column.eut-headings-" . esc_attr( $key ) . " .eut-heading-color,
			.eut-inner-section .eut-column-inner.eut-headings-" . esc_attr( $key ) . " h1,
			.eut-inner-section .eut-column-inner.eut-headings-" . esc_attr( $key ) . " h2,
			.eut-inner-section .eut-column-inner.eut-headings-" . esc_attr( $key ) . " h3,
			.eut-inner-section .eut-column-inner.eut-headings-" . esc_attr( $key ) . " h4,
			.eut-inner-section .eut-column-inner.eut-headings-" . esc_attr( $key ) . " h5,
			.eut-inner-section .eut-column-inner.eut-headings-" . esc_attr( $key ) . " h6,
			.eut-inner-section .eut-column-inner.eut-headings-" . esc_attr( $key ) . " .eut-heading-color {
				color: " . esc_attr( $value ) . ";
			}
		";

		// Text Color
		$css .= "
			#eut-sidearea .eut-text-" . esc_attr( $key ) . ",
			#eut-sidearea .eut-text-hover-" . esc_attr( $key ) . ":hover,
			#eut-sidearea a.eut-text-hover-" . esc_attr( $key ) . ":hover,
			#eut-sidearea a .eut-text-hover-" . esc_attr( $key ) . ":hover,

			#eut-theme-wrapper .eut-text-" . esc_attr( $key ) . ",
			#eut-theme-wrapper .eut-text-hover-" . esc_attr( $key ) . ":hover,
			#eut-theme-wrapper a.eut-text-hover-" . esc_attr( $key ) . ":hover,
			#eut-theme-wrapper a .eut-text-hover-" . esc_attr( $key ) . ":hover {
				color: " . esc_attr( $value ) . ";
			}

			.eut-text-" . esc_attr( $key ) . ".eut-svg-icon {
				stroke: " . esc_attr( $value ) . ";
			}
		";

		// Link Color
		$css .= "
			.eut-link-" . esc_attr( $key ) . " a,
			.eut-inner-section.eut-link-" . esc_attr( $key ) . " a,
			.eut-column.eut-link-" . esc_attr( $key ) . " a,
			.eut-inner-section .eut-column-inner.eut-link-" . esc_attr( $key ) . " a,

			.eut-link-" . esc_attr( $key ) . " .eut-menu-element .eut-arrow,

			.eut-link-" . esc_attr( $key ) . " .widget a:not(.eut-outline):not(.eut-btn),
			.eut-inner-section.eut-link-" . esc_attr( $key ) . " .widget a:not(.eut-outline):not(.eut-btn),
			.eut-column.eut-link-" . esc_attr( $key ) . " .widget a:not(.eut-outline):not(.eut-btn),
			.eut-inner-section .eut-column-inner.eut-link-" . esc_attr( $key ) . " .widget a:not(.eut-outline):not(.eut-btn) {
				color: " . esc_attr( $value ) . ";
			}

			.eut-link-hover-" . esc_attr( $key ) . " a:hover,
			.eut-inner-section.eut-link-hover-" . esc_attr( $key ) . " a:hover,
			.eut-column.eut-link-hover-" . esc_attr( $key ) . " a:hover,
			.eut-inner-section .eut-column-inner.eut-link-hover-" . esc_attr( $key ) . " a:hover,

			.eut-link-hover-" . esc_attr( $key ) . " .eut-menu-element .eut-arrow:hover,

			.eut-link-hover-" . esc_attr( $key ) . " .widget:not(.eut-social) a:not(.eut-outline):not(.eut-btn):hover,
			.eut-inner-section.eut-link-hover-" . esc_attr( $key ) . " .widget:not(.eut-social) a:not(.eut-outline):not(.eut-btn):hover,
			.eut-column.eut-link-hover-" . esc_attr( $key ) . " .widget:not(.eut-social) a:not(.eut-outline):not(.eut-btn):hover,
			.eut-inner-section .eut-column-inner.eut-link-hover-" . esc_attr( $key ) . " .widget:not(.eut-social) a:not(.eut-outline):not(.eut-btn):hover {
				color: " . esc_attr( $value ) . ";
			}
		";

		// Background Color
		$css .= "
			#eut-sidearea .eut-bg-" . esc_attr( $key ) . ",
			#eut-sidearea .eut-bg-hover-" . esc_attr( $key ) . ":hover,
			#eut-sidearea a.eut-bg-hover-" . esc_attr( $key ) . ":hover,
			#eut-sidearea a .eut-bg-hover-" . esc_attr( $key ) . ":hover,
			#eut-sidearea a:hover .eut-bg-hover-" . esc_attr( $key ) . ",

			#eut-theme-wrapper .eut-bg-" . esc_attr( $key ) . ",
			#eut-theme-wrapper .eut-bg-hover-" . esc_attr( $key ) . ":hover,
			#eut-theme-wrapper a.eut-bg-hover-" . esc_attr( $key ) . ":hover,
			#eut-theme-wrapper a .eut-bg-hover-" . esc_attr( $key ) . ":hover,
			#eut-theme-wrapper a:hover .eut-bg-hover-" . esc_attr( $key ) . ",
			.eut-filter.eut-filter-style-button.eut-filter-color-" . esc_attr( $key ) . " ul li.selected,
			#eut-theme-wrapper .eut-contact-form.eut-form-btn-bg-" . esc_attr( $key ) . " input[type='submit']:not(.eut-custom-btn),
			#eut-theme-wrapper .eut-contact-form.eut-form-btn-bg-hover-" . esc_attr( $key ) . " input[type='submit']:not(.eut-custom-btn):hover,
			#eut-theme-wrapper .eut-contact-form.eut-form-btn-bg-" . esc_attr( $key ) . " input:checked + .wpcf7-list-item-label:after {
				background-color: " . esc_attr( $value ) . ";
				border-color: " . esc_attr( $value ) . ";
				color: " . esc_attr( $font_color ) . ";
			}

			#eut-sidearea a.eut-btn-line.eut-bg-" . esc_attr( $key ) . ",
			#eut-theme-wrapper a.eut-btn-line.eut-bg-" . esc_attr( $key ) . ",
			#eut-theme-wrapper .eut-contact-form.eut-form-btn-outline.eut-form-btn-bg-" . esc_attr( $key ) . " input[type='submit']:not(.eut-custom-btn) {
				background-color: transparent;
				border-color: " . esc_attr( $value ) . ";
				color: " . esc_attr( $value ) . ";
			}

			#eut-sidearea a.eut-btn-line.eut-bg-hover-" . esc_attr( $key ) . ":hover,

			#eut-theme-wrapper a.eut-btn-line.eut-bg-hover-" . esc_attr( $key ) . ":hover,
			#eut-theme-wrapper .eut-contact-form.eut-form-btn-outline.eut-form-btn-bg-hover-" . esc_attr( $key ) . " input[type='submit']:not(.eut-custom-btn):hover {
				background-color: " . esc_attr( $value ) . ";
				border-color: " . esc_attr( $value ) . ";
				color: " . esc_attr( $font_color ) . ";
			}

			#eut-theme-wrapper .eut-menu-type-button.eut-" . esc_attr( $key ) . " > a .eut-item,
			#eut-theme-wrapper .eut-menu-type-button.eut-hover-" . esc_attr( $key ) . " > a:hover .eut-item {
				background-color: " . esc_attr( $value ) . ";
				color: " . esc_attr( $font_color ) . ";
			}
		";

		//Gradient Colors
		$gradient_opacity_sizes = array( '10', '20', '30', '40', '50', '60', '70', '80', '90', '100'  );
		foreach ( $gradient_opacity_sizes as $size ) {
			$opacity = $size / 100;
			$css .= "
				.eut-gradient-overlay.eut-gradient-opacity-" . esc_attr( $size ) . ".eut-gradient-" . esc_attr( $key ) . ":after {
					background-image: -webkit-linear-gradient(-180deg, rgba(" . crocal_eutf_hex2rgb( $value ) . ",0.00) 0%, rgba(" . crocal_eutf_hex2rgb( $value ) . "," . esc_attr( $opacity ) . ") 100%);
					background-image: -moz-linear-gradient(-180deg, rgba(" . crocal_eutf_hex2rgb( $value ) . ",0.00) 0%, rgba(" . crocal_eutf_hex2rgb( $value ) . "," . esc_attr( $opacity ) . ") 100%);
					background-image: -ms-linear-gradient(-180deg, rgba(" . crocal_eutf_hex2rgb( $value ) . ",0.00) 0%, rgba(" . crocal_eutf_hex2rgb( $value ) . "," . esc_attr( $opacity ) . ") 100%);
					background-image: -o-linear-gradient(-180deg, rgba(" . crocal_eutf_hex2rgb( $value ) . ",0.00) 0%, rgba(" . crocal_eutf_hex2rgb( $value ) . "," . esc_attr( $opacity ) . ") 100%);
					background-image: linear-gradient(-180deg, rgba(" . crocal_eutf_hex2rgb( $value ) . ",0.00) 0%, rgba(" . crocal_eutf_hex2rgb( $value ) . "," . esc_attr( $opacity ) . ") 100%);
				}
			";
		}
		foreach ( $crocal_eutf_colors as $key2 => $value2 ) {
			$css .= "
				.eut-btn-gradient.eut-gradient-1-" . esc_attr( $key ) . ".eut-gradient-2-" . esc_attr( $key2 ) . ":before {
					background: " . esc_attr( $value ) . ";
					background: -moz-linear-gradient(left, " . esc_attr( $value ) . " 0%, " . esc_attr( $value2 ) . " 100%);
					background: -webkit-linear-gradient(left, " . esc_attr( $value ) . " 0%, " . esc_attr( $value2 ) . " 100%);
					background: linear-gradient(to right, " . esc_attr( $value ) . " 0%, " . esc_attr( $value2 ) . " 100%);
				}
			";
			$css .= "
				.eut-title-gradient.eut-gradient-1-" . esc_attr( $key ) . ".eut-gradient-2-" . esc_attr( $key2 ) . " > span {
					color: " . esc_attr( $value ) . ";
					background-image: -moz-linear-gradient(-45deg, " . esc_attr( $value ) . " 0%, " . esc_attr( $value2 ) . " 100%);
					background-image: -webkit-linear-gradient(-45deg, " . esc_attr( $value ) . " 0%, " . esc_attr( $value2 ) . " 100%);
					background-image: linear-gradient(135deg, " . esc_attr( $value ) . " 0%, " . esc_attr( $value2 ) . " 100%);
				}
			";
		}

		//Gutenberg Editor Colors
		$css .= "
			#eut-theme-wrapper .has-" . esc_attr( $key ) . "-color {
				color: " . esc_attr( $value ) . ";
			}
			#eut-theme-wrapper .has-" . esc_attr( $key ) . "-background-color {
				background-color: " . esc_attr( $value ) . ";
			}
		";

	}

	return $css;
}

$css .= crocal_eutf_print_css_colors();

/* Light Text Color
============================================================================= */
$css .= "
.eut-carousel-style-2 .eut-blog-carousel .eut-post-title,
.eut-carousel-style-2 .eut-blog-carousel ul.eut-post-meta a,
.eut-blog .eut-blog-item.eut-style-2 ul.eut-post-meta a {
	color: #ffffff;
}
";
/* Primary Text Color
============================================================================= */
$css .= "
.eut-blog ul.eut-post-meta a:hover,
#eut-content .widget.widget_nav_menu li.current-menu-item a,
#eut-content .widget.widget_nav_menu li a:hover,
blockquote:before {
	color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
}
.eut-blog .eut-post-meta-wrapper li a:hover,
.eut-search button[type='submit']:hover,
.widget.widget_calendar table tbody a,
blockquote > p:before {
	color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
}
";


/* Primary Bg Color
============================================================================= */
/* Primary Background */
$css .= "
#eut-theme-wrapper .eut-widget.eut-social li a.eut-outline:hover,
#eut-theme-wrapper .eut-with-line:after,
#eut-single-post-tags .eut-tags li a:hover,
#eut-single-post-categories .eut-categories li a:hover,
#eut-socials-modal .eut-social li a:hover,
.eut-hover-underline:after,
.eut-language-element ul li a:hover,
.eut-language-element ul li a.active,
#eut-language-modal ul li a:hover,
#eut-language-modal ul li a.active,
.eut-tabs-title .eut-tab-title.active .eut-title:after,
#eut-section-nav .eut-nav-item.active:after,
#eut-section-nav .eut-nav-item:hover:after,
.eut-vertical-tab .eut-tab-title.active:before,
#eut-post-title .eut-categories li a:hover,
#eut-feature-section .eut-categories li a:hover,
.eut-single-post-tags ul li a:hover,
.eut-widget.eut-latest-news .eut-without-thumb:hover:after {
	background-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	border-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	color: #ffffff;
}
";

$css .= "
.eut-sidearea-close-btn polygon {
	fill: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
}
";

/* Footer
============================================================================= */

	/* - Widget Area
	========================================================================= */
	$css .= "
	#eut-footer .eut-widget-area {
		background-color: " . crocal_eutf_option( 'footer_widgets_bg_color' ) . ";
	}
	";
	/* - Footer Widget Colors
	========================================================================= */
	$css .= "
	#eut-footer .eut-widget-area .widget .eut-widget-title,
	#eut-footer .eut-widget-area h1,
	#eut-footer .eut-widget-area h2,
	#eut-footer .eut-widget-area h3,
	#eut-footer .eut-widget-area h4,
	#eut-footer .eut-widget-area h5,
	#eut-footer .eut-widget-area h6 {
		color: " . crocal_eutf_option( 'footer_widgets_headings_color' ) . ";
	}

	#eut-footer .eut-widget-area .widget,
	#eut-footer .eut-widget-area form,
	#eut-footer .eut-widget-area form p,
	#eut-footer .eut-widget-area form div,
	#eut-footer .eut-widget-area form span {
		color: " . crocal_eutf_option( 'footer_widgets_font_color' ) . ";
	}

	#eut-footer .eut-widget-area,
	#eut-footer .eut-widget-area .eut-container,
	#eut-footer .eut-widget-area .widget,
	#eut-footer .eut-widget-area .widget a:not(.eut-outline):not(.eut-btn),
	#eut-footer .eut-widget-area .widget ul,
	#eut-footer .eut-widget-area .widget li,
	#eut-footer .eut-widget-area .widget div,
	#eut-footer .eut-widget-area table,
	#eut-footer .eut-widget-area tr,
	#eut-footer .eut-widget-area td,
	#eut-footer .eut-widget-area th,
	#eut-footer .eut-widget-area form,
	#eut-footer .eut-widget-area .wpcf7-form-control-wrap,
	#eut-footer .eut-widget-area label,
	#eut-footer .eut-widget-area .eut-border,
	#eut-footer .eut-widget-area form,
	#eut-footer .eut-widget-area form p,
	#eut-footer .eut-widget-area form div,
	#eut-footer .eut-widget-area form span {
		border-color: " . crocal_eutf_option( 'footer_widgets_border_color' ) . ";
	}

	#eut-footer .widget a:not(.eut-outline):not(.eut-btn) {
		color: " . crocal_eutf_option( 'footer_widgets_link_color' ) . ";
	}

	#eut-footer .widget:not(.widget_tag_cloud) a:not(.eut-outline):not(.eut-btn):hover,
	#eut-footer .widget.widget_nav_menu li.open > a {
		color: " . crocal_eutf_option( 'footer_widgets_hover_color' ) . ";
	}

	";
	/* - Footer Bar Colors
	========================================================================= */
	$crocal_eutf_footer_bar_background_color = crocal_eutf_option( 'footer_bar_bg_color', '#000000' );
	$css .= "
	#eut-footer .eut-footer-bar {
		color: " . crocal_eutf_option( 'footer_bar_font_color' ) . ";
		background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_footer_bar_background_color ) . "," . crocal_eutf_option( 'footer_bar_bg_color_opacity', '1') . ");
	}

	#eut-footer .eut-footer-bar a {
		color: " . crocal_eutf_option( 'footer_bar_link_color' ) . ";
	}

	#eut-footer .eut-footer-bar a:hover {
		color: " . crocal_eutf_option( 'footer_bar_hover_color' ) . ";
	}
	";

	/* - Back To Top Colors
	========================================================================= */
	$css .= "
	.eut-back-top .eut-wrapper-color {
		background-color: " . crocal_eutf_option( 'back_to_top_shape_color' ) . ";
	}

	.eut-back-top .eut-back-top-icon polygon {
		fill: " . crocal_eutf_option( 'back_to_top_icon_color' ) . ";
	}
	";

/* Tag Cloud
============================================================================= */
if ( '1' != crocal_eutf_option( 'wp_tagcloud', '0' ) ) {
	$css .= "
	.widget.widget_tag_cloud a {
		display: inline-block;
		margin-bottom: 4px;
		margin-right: 4px;
		border: 1px solid;
		border-color: inherit;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		line-height: 1.2em;
		padding: 5px 10px;
		color: inherit;
		-webkit-transition : all .3s;
		-moz-transition    : all .3s;
		-ms-transition     : all .3s;
		-o-transition      : all .3s;
		transition         : all .3s;
	}

	#eut-theme-wrapper .widget.widget_tag_cloud a {
		border-color: " . crocal_eutf_option( 'body_border_color' ) . ";
	}

	#eut-theme-wrapper .widget.widget_tag_cloud a:hover,
	#eut-theme-wrapper #eut-sidearea .widget.widget_tag_cloud a:hover {
		background-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
		border-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
		color: #ffffff;
	}

	#eut-theme-wrapper #eut-sidearea .widget.widget_tag_cloud a {
		border-color: " . crocal_eutf_option( 'sliding_area_border_color' ) . ";
	}

	#eut-footer .eut-widget-area .widget.widget_tag_cloud a:hover {
		background-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
		border-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
		color: #ffffff;
	}
	";
} else {
	$css .= "
	.widget.widget_tag_cloud a {
		display: inline-block;
		vertical-align: middle;
		margin-bottom: 4px;
		margin-right: 8px;
		line-height: 1.4;
		-webkit-transition : all .3s;
		-moz-transition    : all .3s;
		-ms-transition     : all .3s;
		-o-transition      : all .3s;
		transition         : all .3s;
	}

	#eut-footer .eut-widget-area .widget.widget_tag_cloud a:hover {
		color: " . crocal_eutf_option( 'footer_widgets_hover_color' ) . ";
	}
	";
}


/* GDPR Privacy
============================================================================= */
$crocal_eutf_privacy_bar_bg_color = crocal_eutf_option( 'privacy_bar_bg_color', '#000000' );
$css .= "

#eut-privacy-bar {
	background-color: rgba(" . crocal_eutf_hex2rgb( $crocal_eutf_privacy_bar_bg_color ) . "," . crocal_eutf_option( 'privacy_bar_bg_opacity', '0.90') . ");
	color: " . crocal_eutf_option( 'privacy_bar_text_color' ) . ";
}

.eut-privacy-agreement {
	background-color: " . crocal_eutf_option( 'privacy_bar_button_bg_color' ) . ";
	color: " . crocal_eutf_option( 'privacy_bar_button_text_color' ) . ";
}

.eut-privacy-refresh-btn {
	background-color: " . crocal_eutf_option( 'privacy_modal_button_bg_color' ) . ";
	color: " . crocal_eutf_option( 'privacy_modal_button_text_color' ) . ";
}

.eut-privacy-preferences {
	background-color: transparent;
	color: " . crocal_eutf_option( 'privacy_bar_text_color' ) . ";
}

.eut-privacy-agreement:hover {
	background-color: " . crocal_eutf_option( 'privacy_bar_button_bg_hover_color' ) . ";
}

.eut-privacy-refresh-btn:hover {
	background-color: " . crocal_eutf_option( 'privacy_modal_button_bg_hover_color' ) . ";
}

.eut-privacy-switch .eut-switch input[type='checkbox']:checked + .eut-switch-slider {
    background-color: " . crocal_eutf_option( 'privacy_modal_button_bg_color' ) . ";
}

";



/* Composer Front End Fix*/
$css .= "

.compose-mode .vc_element .eut-row {
    margin-top: 30px;
}

.compose-mode .vc_vc_column .wpb_column {
    width: 100% !important;
    margin-bottom: 30px;
    border: 1px dashed rgba(125, 125, 125, 0.4);
}

.compose-mode .vc_controls > .vc_controls-out-tl {
    left: 15px;
}

.compose-mode .vc_controls > .vc_controls-bc {
    bottom: 15px;
}

.compose-mode .vc_welcome .vc_buttons {
    margin-top: 60px;
}

.compose-mode .eut-image img {
    opacity: 1;
}

.compose-mode .vc_controls > div {
    z-index: 9;
}
.compose-mode .eut-bg-image {
    opacity: 1;
}

.compose-mode #eut-theme-wrapper .eut-section.eut-fullwidth-background,
.compose-mode #eut-theme-wrapper .eut-section.eut-fullwidth-element {
	visibility: visible;
}

.compose-mode .eut-animated-item {
	opacity: 1;
}

.compose-mode .eut-isotope-item-inner.eut-fade-in,
.compose-mode .eut-isotope-item-inner.eut-fade-in-up,
.compose-mode .eut-isotope-item-inner.eut-fade-in-down,
.compose-mode .eut-isotope-item-inner.eut-fade-in-left,
.compose-mode .eut-isotope-item-inner.eut-fade-in-right,
.compose-mode .eut-isotope-item-inner.eut-zoom-in {
	opacity: 1;
}

.compose-mode #eut-theme-wrapper .eut-isotope .eut-isotope-container {
    visibility: visible;
}

.compose-mode .eut-clipping-animation,
.compose-mode .eut-clipping-animation .eut-clipping-content,
.compose-mode .eut-appear-animation {
    visibility: visible;
    opacity: 1;
}

";

$crocal_eutf_gap_size = array (
	array(
		'gap' => '5',
	),
	array(
		'gap' => '10',
	),
	array(
		'gap' => '15',
	),
	array(
		'gap' => '20',
	),
	array(
		'gap' => '25',
	),
	array(
		'gap' => '30',
	),
	array(
		'gap' => '35',
	),
	array(
		'gap' => '40',
	),
	array(
		'gap' => '45',
	),
	array(
		'gap' => '50',
	),
	array(
		'gap' => '55',
	),
	array(
		'gap' => '60',
	),
);

function crocal_eutf_print_gap_size( $crocal_eutf_gap_size = array()) {

	$css = '';

	foreach ( $crocal_eutf_gap_size as $size ) {

		$crocal_eutf_gap_size = $size['gap'];
		$crocal_eutf_gap_half_size = $size['gap'] * 0.5;

		$css .= "

			.eut-row.eut-columns-gap-" . esc_attr( $size['gap'] ) . " {
				margin-left: -" . esc_attr( $crocal_eutf_gap_half_size ) . "px;
				margin-right: -" . esc_attr( $crocal_eutf_gap_half_size ) . "px;
			}
			.eut-row.eut-columns-gap-" . esc_attr( $size['gap'] ) . " .eut-column {
				padding-left: " . esc_attr( $crocal_eutf_gap_half_size ) . "px;
				padding-right: " . esc_attr( $crocal_eutf_gap_half_size ) . "px;
			}

			.eut-section.eut-fullwidth .eut-row.eut-columns-gap-" . esc_attr( $size['gap'] ) . " {
				padding-left: " . esc_attr( $crocal_eutf_gap_half_size ) . "px;
				padding-right: " . esc_attr( $crocal_eutf_gap_half_size ) . "px;
			}

			.eut-section.eut-container-width .eut-row.eut-columns-gap-" . esc_attr( $size['gap'] ) . " {
				padding-left: " . esc_attr( $crocal_eutf_gap_size ) . "px;
				padding-right: " . esc_attr( $crocal_eutf_gap_size ) . "px;
			}

			.eut-row-inner.eut-columns-gap-" . esc_attr( $size['gap'] ) . " {
				margin-left: -" . esc_attr( $crocal_eutf_gap_half_size ) . "px;
				margin-right: -" . esc_attr( $crocal_eutf_gap_half_size ) . "px;
			}

			.eut-row-inner.eut-columns-gap-" . esc_attr( $size['gap'] ) . " .eut-column-inner {
				padding-left: " . esc_attr( $crocal_eutf_gap_half_size ) . "px;
				padding-right: " . esc_attr( $crocal_eutf_gap_half_size ) . "px;
			}

			@media only screen and (min-width: 960px) and (max-width: 1200px) {
				.eut-row.eut-tablet-vertical-gap-" . esc_attr( $size['gap'] ) . " .eut-column {
					margin-top: " . esc_attr( $crocal_eutf_gap_size ) . "px;
				}
				.eut-row.eut-tablet-vertical-gap-" . esc_attr( $size['gap'] ) . " {
					margin-top: -" . esc_attr( $crocal_eutf_gap_size ) . "px;
				}

				.eut-row-inner.eut-tablet-vertical-gap-" . esc_attr( $size['gap'] ) . " .eut-column-inner {
					margin-top: " . esc_attr( $crocal_eutf_gap_size ) . "px;
				}
				.eut-row-inner.eut-tablet-vertical-gap-" . esc_attr( $size['gap'] ) . " {
					margin-top: -" . esc_attr( $crocal_eutf_gap_size ) . "px;
				}
			}

			@media only screen and (min-width: 768px) and (max-width: 959px) {
				.eut-row.eut-tablet-sm-vertical-gap-" . esc_attr( $size['gap'] ) . " .eut-column {
					margin-top: " . esc_attr( $crocal_eutf_gap_size ) . "px;
				}
				.eut-row.eut-tablet-sm-vertical-gap-" . esc_attr( $size['gap'] ) . " {
					margin-top: -" . esc_attr( $crocal_eutf_gap_size ) . "px;
				}

				.eut-row-inner.eut-tablet-sm-vertical-gap-" . esc_attr( $size['gap'] ) . " .eut-column-inner {
					margin-top: " . esc_attr( $crocal_eutf_gap_size ) . "px;
				}
				.eut-row-inner.eut-tablet-sm-vertical-gap-" . esc_attr( $size['gap'] ) . " {
					margin-top: -" . esc_attr( $crocal_eutf_gap_size ) . "px;
				}
			}

			@media only screen and (max-width: 767px) {
				.eut-row.eut-mobile-vertical-gap-" . esc_attr( $size['gap'] ) . " .eut-column {
					margin-top: " . esc_attr( $crocal_eutf_gap_size ) . "px;
				}
				.eut-row.eut-mobile-vertical-gap-" . esc_attr( $size['gap'] ) . " {
					margin-top: -" . esc_attr( $crocal_eutf_gap_size ) . "px;
				}

				.eut-row-inner.eut-mobile-vertical-gap-" . esc_attr( $size['gap'] ) . " .eut-column-inner {
					margin-top: " . esc_attr( $crocal_eutf_gap_size ) . "px;
				}
				.eut-row-inner.eut-mobile-vertical-gap-" . esc_attr( $size['gap'] ) . " {
					margin-top: -" . esc_attr( $crocal_eutf_gap_size ) . "px;
				}
			}

		";

	}

	return $css;
}

$css .= crocal_eutf_print_gap_size( $crocal_eutf_gap_size );

$crocal_eutf_space_size_array = array (
	array(
		'id' => '1x',
		'percentage' => 1,
	),
	array(
		'id' => '2x',
		'percentage' => 2,
	),
	array(
		'id' => '3x',
		'percentage' => 3,
	),
	array(
		'id' => '4x',
		'percentage' => 4,
	),
	array(
		'id' => '5x',
		'percentage' => 5,
	),
	array(
		'id' => '6x',
		'percentage' => 6,
	),
);

function crocal_eutf_print_space_size( $space_size_array = array() , $ratio = 1 ) {

	$default_space_size = 30;
	$min_space_size = 30;

	$css = '';

	foreach ( $space_size_array as $size ) {

		$space_size = ( $default_space_size * $size['percentage'] ) * $ratio;
		if ( $space_size < $default_space_size ) {
			$space_size = $min_space_size;
		}
		$css .= "
			#eut-theme-wrapper .eut-padding-top-" . esc_attr( $size['id'] ) . "{ padding-top: " . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-padding-bottom-" . esc_attr( $size['id'] ) . "{ padding-bottom: " . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-margin-top-" . esc_attr( $size['id'] ) . "{ margin-top: " . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-margin-bottom-" . esc_attr( $size['id'] ) . "{ margin-bottom: " . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-height-" . esc_attr( $size['id'] ) . "{ height: " . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-top-" . esc_attr( $size['id'] ) . "{ top: " . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-left-" . esc_attr( $size['id'] ) . "{ left: " . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-right-" . esc_attr( $size['id'] ) . "{ right: " . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-bottom-" . esc_attr( $size['id'] ) . "{ bottom: " . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-top-minus-" . esc_attr( $size['id'] ) . "{ top: -" . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-left-minus-" . esc_attr( $size['id'] ) . "{ left: -" . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-right-minus-" . esc_attr( $size['id'] ) . "{ right: -" . esc_attr( $space_size ) . "px; }
			#eut-theme-wrapper .eut-bottom-minus-" . esc_attr( $size['id'] ) . "{ bottom: -" . esc_attr( $space_size ) . "px; }

			#eut-theme-wrapper .eut-padding-none { padding: 0px !important; }
			#eut-theme-wrapper .eut-margin-none { margin: 0px !important; }
		";

	}

	return $css;
}

$css .= crocal_eutf_print_space_size( $crocal_eutf_space_size_array, 1 );

$css .= "
	@media only screen and (max-width: 1200px) {
		" . crocal_eutf_print_space_size( $crocal_eutf_space_size_array, 0.8 ). "
	}
	@media only screen and (max-width: 768px) {
		" . crocal_eutf_print_space_size( $crocal_eutf_space_size_array, 0.6 ). "
	}
";


$crocal_eutf_sidebar_size = crocal_eutf_option( 'sidebar_size', '30' );
$crocal_eutf_content_size = intval( 100 - $crocal_eutf_sidebar_size );

$css .= "
	#eut-content.eut-left-sidebar #eut-main-content { width: " . esc_attr( $crocal_eutf_content_size ) . "%; }
	#eut-content.eut-right-sidebar #eut-main-content { width: " . esc_attr( $crocal_eutf_content_size ) . "%; }
	#eut-content.eut-left-sidebar #eut-sidebar { width: " . esc_attr( $crocal_eutf_sidebar_size ) . "%; }
	#eut-content.eut-right-sidebar #eut-sidebar { width: " . esc_attr( $crocal_eutf_sidebar_size ) . "%; }

	@media only screen and (max-width: 1023px) {

		#eut-content.eut-left-sidebar #eut-main-content,
		#eut-content.eut-right-sidebar #eut-main-content {
			width: auto;
		}

		#eut-content.eut-left-sidebar #eut-sidebar,
		#eut-content.eut-right-sidebar #eut-sidebar {
			width: 90%;
		}

	}
";

$crocal_eutf_content_sidebar_space = crocal_eutf_option( 'content_sidebar_space', '60' );

if ( is_rtl() ) {
	$css .= "
		#eut-content.eut-right-sidebar #eut-main-content { padding-left: " . esc_attr( $crocal_eutf_content_sidebar_space ) . "px; }
		#eut-content.eut-left-sidebar #eut-main-content { padding-right: " . esc_attr( $crocal_eutf_content_sidebar_space ) . "px; }
	";
} else {
	$css .= "
		#eut-content.eut-right-sidebar #eut-main-content { padding-right: " . esc_attr( $crocal_eutf_content_sidebar_space ) . "px; }
		#eut-content.eut-left-sidebar #eut-main-content { padding-left: " . esc_attr( $crocal_eutf_content_sidebar_space ) . "px; }
	";
}

$css .= "
	@media only screen and (max-width: 1023px) {

		#eut-content.eut-right-sidebar #eut-main-content,
		#eut-content.eut-right-sidebar #eut-main-content {
			padding-left: 0;
			padding-right: 0;
		}
	}
";

// output dynamic css
echo crocal_eutf_compress_css( $css );

//Omit closing PHP tag to avoid accidental whitespace output errors.
