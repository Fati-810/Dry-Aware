<?php
/**
 *  Dynamic typography css style
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */

$typo_css = "";

/**
 * Typography
 * ----------------------------------------------------------------------------
 */

$typo_css .= "

body {
	font-size: " . crocal_eutf_option( 'body_font', '14px', 'font-size'  ) . ";
	font-family: " . crocal_eutf_option( 'body_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'body_font', 'normal', 'font-weight'  ) . ";
	line-height: " . crocal_eutf_option( 'body_font', '36px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'body_font', '0px', 'letter-spacing'  ) . "
}

";

/* Logo as text */
$typo_css .= "

#eut-header .eut-logo.eut-logo-text a {
	font-family: " . crocal_eutf_option( 'logo_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'logo_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'logo_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'logo_font', '11px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'logo_font', 'uppercase', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'logo_font', '0px', 'letter-spacing'  ) . "
}

";


/* Main Menu  */
$typo_css .= "
.eut-menu-text,
.eut-main-menu .eut-wrapper > ul > li > a,
.eut-main-menu .eut-wrapper > ul > li.megamenu > ul > li > a,
.eut-toggle-hiddenarea .eut-label,
.eut-main-menu .eut-wrapper > ul > li ul li.eut-goback a {
	font-family: " . crocal_eutf_option( 'main_menu_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'main_menu_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'main_menu_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'main_menu_font', '11px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'main_menu_font', 'uppercase', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'main_menu_font', '0px', 'letter-spacing'  ) . "
}

.eut-main-menu .eut-wrapper > ul > li ul li a {
	font-family: " . crocal_eutf_option( 'sub_menu_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'sub_menu_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'sub_menu_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'sub_menu_font', '11px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'sub_menu_font', 'uppercase', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'sub_menu_font', '0px', 'letter-spacing'  ) . "
}

.eut-main-menu .eut-wrapper > ul > li.megamenu  ul > li.menu-item-has-children > a {
	font-family: " . crocal_eutf_option( 'megamenu_titles_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'megamenu_titles_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'megamenu_titles_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'megamenu_titles_font', '11px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'megamenu_titles_font', 'uppercase', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'megamenu_titles_font', '0px', 'letter-spacing'  ) . "
}

.eut-main-menu .eut-menu-description {
	font-family: " . crocal_eutf_option( 'description_menu_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'description_menu_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'description_menu_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'description_menu_font', '11px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'description_menu_font', 'uppercase', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'description_menu_font', '0px', 'letter-spacing'  ) . "
}

";

/* Hidden Menu  */
$typo_css .= "
#eut-hidden-menu .eut-menu .sub-menu a {
	font-family: " . crocal_eutf_option( 'sub_hidden_menu_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'sub_hidden_menu_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'sub_hidden_menu_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'sub_hidden_menu_font', '11px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'sub_hidden_menu_font', 'uppercase', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'sub_hidden_menu_font', '0px', 'letter-spacing'  ) . "
}

#eut-hidden-menu .eut-menu .eut-first-level > a,
#eut-hidden-menu .eut-menu .eut-goback a {
	font-family: " . crocal_eutf_option( 'hidden_menu_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'hidden_menu_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'hidden_menu_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'hidden_menu_font', '11px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'hidden_menu_font', 'uppercase', 'text-transform'  ) . ";
}

#eut-hidden-menu .eut-menu-description {
	font-family: " . crocal_eutf_option( 'description_hidden_menu_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'description_hidden_menu_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'description_hidden_menu_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'description_hidden_menu_font', '11px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'description_hidden_menu_font', 'uppercase', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'description_hidden_menu_font', '0px', 'letter-spacing'  ) . "
}

";

/* Headings */
$typo_css .= "

h1,
.eut-h1,
#eut-theme-wrapper .eut-modal .eut-search input[type='text'],
.eut-dropcap span,
p.eut-dropcap:first-letter {
	font-family: " . crocal_eutf_option( 'h1_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'h1_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'h1_font', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'h1_font', ' none', 'text-transform'  ) . ";
	font-size: " . crocal_eutf_option( 'h1_font', '56px', 'font-size'  ) . ";
	line-height: " . crocal_eutf_option( 'h1_font', '60px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'h1_font', '0px', 'letter-spacing'  ) . "
}

h2,
.eut-h2,
.tribe-events-page-title,
.single-tribe_events .tribe-events-single-event-title {
	font-family: " . crocal_eutf_option( 'h2_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'h2_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'h2_font', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'h2_font', ' none', 'text-transform'  ) . ";
	font-size: " . crocal_eutf_option( 'h2_font', '36px', 'font-size'  ) . ";
	line-height: " . crocal_eutf_option( 'h2_font', '40px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'h2_font', '0px', 'letter-spacing'  ) . "
}

h3,
.eut-h3 {
	font-family: " . crocal_eutf_option( 'h3_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'h3_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'h3_font', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'h3_font', ' none', 'text-transform'  ) . ";
	font-size: " . crocal_eutf_option( 'h3_font', '30px', 'font-size'  ) . ";
	line-height: " . crocal_eutf_option( 'h3_font', '33px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'h3_font', '0px', 'letter-spacing'  ) . "
}

h4,
.eut-h4 {
	font-family: " . crocal_eutf_option( 'h4_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'h4_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'h4_font', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'h4_font', ' none', 'text-transform'  ) . ";
	font-size: " . crocal_eutf_option( 'h4_font', '23px', 'font-size'  ) . ";
	line-height: " . crocal_eutf_option( 'h4_font', '26px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'h4_font', '0px', 'letter-spacing'  ) . "
}

h5,
.eut-h5,
h3#reply-title,
.eut-navigation-bar.eut-layout-3 .eut-title {
	font-family: " . crocal_eutf_option( 'h5_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'h5_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'h5_font', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'h5_font', ' none', 'text-transform'  ) . ";
	font-size: " . crocal_eutf_option( 'h5_font', '18px', 'font-size'  ) . ";
	line-height: " . crocal_eutf_option( 'h5_font', '20px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'h5_font', '0px', 'letter-spacing'  ) . "
}

h6,
.eut-h6,
.vc_tta.vc_general .vc_tta-panel-title,
#eut-main-content .vc_tta.vc_general .vc_tta-tab > a,
.eut-navigation-bar.eut-layout-2 .eut-title {
	font-family: " . crocal_eutf_option( 'h6_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'h6_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'h6_font', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'h6_font', ' none', 'text-transform'  ) . ";
	font-size: " . crocal_eutf_option( 'h6_font', '16px', 'font-size'  ) . ";
	line-height: " . crocal_eutf_option( 'h6_font', '18px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'h6_font', '0px', 'letter-spacing'  ) . "
}

";

/* Page Title */
$typo_css .= "

#eut-page-title .eut-title,
#eut-blog-title .eut-title,
#eut-search-page-title .eut-title {
	font-family: " . crocal_eutf_option( 'page_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'page_title', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'page_title', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'page_title', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'page_title', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'page_title', '60px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'page_title', '0px', 'letter-spacing'  ) . "
}

#eut-page-title .eut-description,
#eut-blog-title .eut-description,
#eut-blog-title .eut-description p,
#eut-search-page-title .eut-description {
	font-family: " . crocal_eutf_option( 'page_description', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'page_description', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'page_description', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'page_description', '24px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'page_description', 'none', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'page_description', '60px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'page_description', '0px', 'letter-spacing'  ) . "
}

";


/* Post Title */
$typo_css .= "

#eut-post-title .eut-title-categories {
	font-family: " . crocal_eutf_option( 'post_title_meta', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'post_title_meta', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'post_title_meta', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'post_title_meta', '12px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'post_title_meta', 'none', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'post_title_meta', '24px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'post_title_meta', '0px', 'letter-spacing'  ) . "
}

#eut-post-title .eut-post-meta,
#eut-post-title .eut-post-meta li{
	font-family: " . crocal_eutf_option( 'post_title_extra_meta', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'post_title_extra_meta', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'post_title_extra_meta', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'post_title_extra_meta', '12px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'post_title_extra_meta', 'none', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'post_title_extra_meta', '24px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'post_title_extra_meta', '0px', 'letter-spacing'  ) . "
}

.eut-single-simple-title {
	font-family: " . crocal_eutf_option( 'post_simple_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'post_simple_title', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'post_simple_title', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'post_simple_title', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'post_simple_title', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'post_simple_title', '112px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'post_simple_title', '0px', 'letter-spacing'  ) . "
}

#eut-post-title .eut-title {
	font-family: " . crocal_eutf_option( 'post_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'post_title', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'post_title', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'post_title', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'post_title', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'post_title', '112px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'post_title', '0px', 'letter-spacing'  ) . "
}

#eut-post-title .eut-description {
	font-family: " . crocal_eutf_option( 'post_title_desc', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'post_title_desc', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'post_title_desc', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'post_title_desc', '26px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'post_title_desc', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'post_title_desc', '32px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'post_title_desc', '0px', 'letter-spacing'  ) . "
}

";

/* Portfolio Title */
$typo_css .= "

#eut-portfolio-title .eut-title {
	font-family: " . crocal_eutf_option( 'portfolio_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'portfolio_title', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'portfolio_title', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'portfolio_title', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'portfolio_title', 'normal', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'portfolio_title', '72px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'portfolio_title', '0px', 'letter-spacing'  ) . "
}

#eut-portfolio-title .eut-description {
	font-family: " . crocal_eutf_option( 'portfolio_description', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'portfolio_description', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'portfolio_description', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'portfolio_description', '18px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'portfolio_description', 'normal', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'portfolio_description', '30px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'portfolio_description', '0px', 'letter-spacing'  ) . "
}


";

/* Forum Title */
$typo_css .= "

#eut-forum-title .eut-title {
	font-family: " . crocal_eutf_option( 'forum_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'forum_title', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'forum_title', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'forum_title', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'forum_title', 'normal', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'forum_title', '72px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'forum_title', '0px', 'letter-spacing'  ) . "
}


";

/* Product Title
============================================================================= */
$typo_css .= "

.eut-product-area .product_title {
	font-family: " . crocal_eutf_option( 'product_simple_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'product_simple_title', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'product_simple_title', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'product_simple_title', '36px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'product_simple_title', 'normal', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'product_simple_title', '48px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'product_simple_title', '0px', 'letter-spacing'  ) . "
}

#eut-entry-summary .eut-short-description p {
	font-family: " . crocal_eutf_option( 'product_short_description', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'product_short_description', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'product_short_description', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'product_short_description', '24px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'product_short_description', 'normal', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'product_short_description', '30px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'product_short_description', '0px', 'letter-spacing'  ) . "
}

#eut-product-title .eut-title,
#eut-product-tax-title .eut-title,
.woocommerce-page #eut-page-title .eut-title {
	font-family: " . crocal_eutf_option( 'product_tax_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'product_tax_title', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'product_tax_title', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'product_tax_title', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'product_tax_title', 'normal', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'product_tax_title', '72px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'product_tax_title', '0px', 'letter-spacing'  ) . "
}

#eut-product-title .eut-description,
#eut-product-tax-title .eut-description,
#eut-product-tax-title .eut-description p,
.woocommerce-page #eut-page-title .eut-description {
	font-family: " . crocal_eutf_option( 'product_tax_description', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'product_tax_description', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'product_tax_description', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'product_tax_description', '24px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'product_tax_description', 'normal', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'product_tax_description', '30px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'product_tax_description', '0px', 'letter-spacing'  ) . "
}

";

/* Feature Section Custom */
$typo_css .= "

#eut-feature-section .eut-subheading {
	font-family: " . crocal_eutf_option( 'feature_subheading_custom_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'feature_subheading_custom_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'feature_subheading_custom_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'feature_subheading_custom_font', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'feature_subheading_custom_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'feature_subheading_custom_font', '112px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'feature_subheading_custom_font', '0px', 'letter-spacing'  ) . "
}

#eut-feature-section .eut-title {
	font-family: " . crocal_eutf_option( 'feature_title_custom_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'feature_title_custom_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'feature_title_custom_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'feature_title_custom_font', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'feature_title_custom_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'feature_title_custom_font', '112px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'feature_title_custom_font', '0px', 'letter-spacing'  ) . "
}

#eut-feature-section .eut-description {
	font-family: " . crocal_eutf_option( 'feature_desc_custom_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'feature_desc_custom_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'feature_desc_custom_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'feature_desc_custom_font', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'feature_desc_custom_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'feature_desc_custom_font', '112px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'feature_desc_custom_font', '0px', 'letter-spacing'  ) . "
}

";

/* Events Title
============================================================================= */
$typo_css .= "

#eut-event-title .eut-title,
#eut-event-tax-title .eut-title {
	font-family: " . crocal_eutf_option( 'event_tax_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'event_tax_title', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'event_tax_title', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'event_tax_title', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'event_tax_title', 'normal', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'event_tax_title', '72px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'event_tax_title', '0px', 'letter-spacing'  ) . "
}

#eut-event-title .eut-description,
#eut-event-tax-title .eut-description,
#eut-event-tax-title .eut-description p {
	font-family: " . crocal_eutf_option( 'event_tax_description', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'event_tax_description', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'event_tax_description', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'event_tax_description', '24px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'event_tax_description', 'normal', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'event_tax_description', '30px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'event_tax_description', '0px', 'letter-spacing'  ) . "
}

";

/* Feature Section Fullscreen */
$typo_css .= "

#eut-feature-section.eut-fullscreen .eut-subheading {
	font-family: " . crocal_eutf_option( 'feature_subheading_full_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'feature_subheading_full_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'feature_subheading_full_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'feature_subheading_full_font', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'feature_subheading_full_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'feature_subheading_full_font', '112px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'feature_subheading_full_font', '0px', 'letter-spacing'  ) . "
}

#eut-feature-section.eut-fullscreen .eut-title {
	font-family: " . crocal_eutf_option( 'feature_title_full_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'feature_title_full_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'feature_title_full_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'feature_title_full_font', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'feature_title_full_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'feature_title_full_font', '112px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'feature_title_full_font', '0px', 'letter-spacing'  ) . "
}

";

$typo_css .= "

#eut-feature-section.eut-fullscreen .eut-description {
	font-family: " . crocal_eutf_option( 'feature_desc_full_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'feature_desc_full_font', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'feature_desc_full_font', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'feature_desc_full_font', '60px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'feature_desc_full_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'feature_desc_full_font', '112px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'feature_desc_full_font', '0px', 'letter-spacing'  ) . "
}

";


/* Special Text */
$typo_css .= "

.eut-quote-text,
blockquote p,
blockquote {
	font-family: " . crocal_eutf_option( 'quote_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'quote_text', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'quote_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'quote_text', '34px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'quote_text', 'none', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'quote_text', '36px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'quote_text', '0px', 'letter-spacing'  ) . "
}

.eut-leader-text,
.eut-leader-text p,
p.eut-leader-text {
	font-family: " . crocal_eutf_option( 'leader_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'leader_text', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'leader_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'leader_text', '34px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'leader_text', 'none', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'leader_text', '36px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'leader_text', '0px', 'letter-spacing'  ) . "
}

.eut-subtitle,
.eut-subtitle p,
.eut-subtitle-text {
	font-family: " . crocal_eutf_option( 'subtitle_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'subtitle_text', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'subtitle_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'subtitle_text', '34px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'subtitle_text', 'none', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'subtitle_text', '36px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'subtitle_text', '0px', 'letter-spacing'  ) . "
}

.eut-small-text,
span.wpcf7-not-valid-tip,
div.wpcf7-mail-sent-ok,
div.wpcf7-validation-errors,
.eut-post-meta-wrapper .eut-categories li {
	font-family: " . crocal_eutf_option( 'small_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'small_text', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'small_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'small_text', '34px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'small_text', 'none', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'small_text', '26px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'small_text', '0px', 'letter-spacing'  ) . "
}

";

/* Link Text */
$crocal_eutf_btn_size = crocal_eutf_option( 'link_text', '13px', 'font-size'  );
$crocal_eutf_btn_size = filter_var( $crocal_eutf_btn_size, FILTER_SANITIZE_NUMBER_INT );

$crocal_eutf_btn_size_xsm = $crocal_eutf_btn_size * 0.7;
$crocal_eutf_btn_size_sm = $crocal_eutf_btn_size * 0.85;
$crocal_eutf_btn_size_lg = $crocal_eutf_btn_size * 1.2;
$crocal_eutf_btn_size_xlg = $crocal_eutf_btn_size * 1.35;

$typo_css .= "

.eut-link-text,
.more-link,
.eut-btn,
#cancel-comment-reply-link,
.eut-anchor-menu .eut-anchor-wrapper .eut-container > ul > li > a,
.eut-anchor-menu .eut-anchor-wrapper .eut-container ul.sub-menu li a,
.widget.widget_tag_cloud a,
" . implode( ',', crocal_eutf_get_button_classes() ) . " {
	font-family: " . crocal_eutf_option( 'link_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . " !important;
	font-weight: " . crocal_eutf_option( 'link_text', 'normal', 'font-weight'  ) . " !important;
	font-style: " . crocal_eutf_option( 'link_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'link_text', '13px', 'font-size'  ) . " !important;
	text-transform: " . crocal_eutf_option( 'link_text', 'uppercase', 'text-transform'  ) . ";
	line-height: 1.4em;
	" . crocal_eutf_css_option( 'link_text', '0px', 'letter-spacing'  ) . "
}

#eut-theme-wrapper .eut-btn.eut-btn-extrasmall,
#eut-theme-wrapper .eut-contact-form.eut-form-btn-extrasmall input[type='submit']:not(.eut-custom-btn) {
	font-size: " . round( $crocal_eutf_btn_size_xsm, 0 ) . "px !important;
}

#eut-theme-wrapper .eut-btn.eut-btn-small,
#eut-theme-wrapper .eut-contact-form.eut-form-btn-small input[type='submit']:not(.eut-custom-btn) {
	font-size: " . round( $crocal_eutf_btn_size_sm, 0 ) . "px !important;
}

#eut-theme-wrapper .eut-btn.eut-btn-large,
#eut-theme-wrapper .eut-contact-form.eut-form-btn-large input[type='submit']:not(.eut-custom-btn) {
	font-size: " . round( $crocal_eutf_btn_size_lg, 0 ) . "px !important;
}

#eut-theme-wrapper .eut-btn.eut-btn-extralarge,
#eut-theme-wrapper .eut-contact-form.eut-form-btn-extralarge input[type='submit']:not(.eut-custom-btn) {
	font-size: " . round( $crocal_eutf_btn_size_xlg, 0 ) . "px !important;
}


";

/* Widget Text */
$typo_css .= "

.eut-widget-title {
	font-family: " . crocal_eutf_option( 'widget_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'widget_title', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'widget_title', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'widget_title', '34px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'widget_title', 'none', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'widget_title', '36px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'widget_title', '0px', 'letter-spacing'  ) . "
}

.widget,
.widgets,
.widget p {
	font-family: " . crocal_eutf_option( 'widget_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'widget_text', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'widget_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'widget_text', '34px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'widget_text', 'none', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'widget_text', '36px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'widget_text', '0px', 'letter-spacing'  ) . "
}

";

/* Pagination Text */
$typo_css .= "

.eut-pagination-text {
	font-family: " . crocal_eutf_option( 'pagination_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'pagination_text', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'pagination_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'pagination_text', '34px', 'font-size'  ) . ";
	text-transform: " . crocal_eutf_option( 'pagination_text', 'none', 'text-transform'  ) . ";
	line-height: " . crocal_eutf_option( 'pagination_text', '36px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'pagination_text', '0px', 'letter-spacing'  ) . "
}

";

/* Single Post */
$typo_css .= "

.single-post #eut-single-content,
.single-product #tab-description,
.single-tribe_events #eut-single-content {
	font-size: " . crocal_eutf_option( 'single_post_font', '18px', 'font-size'  ) . ";
	font-family: " . crocal_eutf_option( 'single_post_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'single_post_font', 'normal', 'font-weight'  ) . ";
	line-height: " . crocal_eutf_option( 'single_post_font', '36px', 'line-height'  ) . ";
	" . crocal_eutf_css_option( 'single_post_font', '0px', 'letter-spacing'  ) . "
}

";


/* Custom Font Family */
$typo_css .= "
.eut-custom-font-1,
#eut-feature-section .eut-subheading.eut-custom-font-1,
#eut-feature-section.eut-fullscreen .eut-subheading.eut-custom-font-1,
#eut-feature-section .eut-title.eut-custom-font-1,
#eut-feature-section.eut-fullscreen .eut-title.eut-custom-font-1,
#eut-feature-section .eut-description.eut-custom-font-1,
#eut-feature-section.eut-fullscreen .eut-description.eut-custom-font-1 {
	font-family: " . crocal_eutf_option( 'custom_font_family_1', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'custom_font_family_1', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'custom_font_family_1', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'custom_font_family_1', 'none', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'custom_font_family_1', '0px', 'letter-spacing'  ) . "
}
.eut-custom-font-2,
#eut-feature-section .eut-subheading.eut-custom-font-2,
#eut-feature-section.eut-fullscreen .eut-subheading.eut-custom-font-2,
#eut-feature-section .eut-title.eut-custom-font-2,
#eut-feature-section.eut-fullscreen .eut-title.eut-custom-font-2,
#eut-feature-section .eut-description.eut-custom-font-2,
#eut-feature-section.eut-fullscreen .eut-description.eut-custom-font-2 {
	font-family: " . crocal_eutf_option( 'custom_font_family_2', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'custom_font_family_2', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'custom_font_family_2', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'custom_font_family_2', 'none', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'custom_font_family_2', '0px', 'letter-spacing'  ) . "
}
.eut-custom-font-3,
#eut-feature-section .eut-subheading.eut-custom-font-3,
#eut-feature-section.eut-fullscreen .eut-subheading.eut-custom-font-3,
#eut-feature-section .eut-title.eut-custom-font-3,
#eut-feature-section.eut-fullscreen .eut-title.eut-custom-font-3,
#eut-feature-section .eut-description.eut-custom-font-3,
#eut-feature-section.eut-fullscreen .eut-description.eut-custom-font-3 {
	font-family: " . crocal_eutf_option( 'custom_font_family_3', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'custom_font_family_3', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'custom_font_family_3', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'custom_font_family_3', 'none', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'custom_font_family_3', '0px', 'letter-spacing'  ) . "
}
.eut-custom-font-4,
#eut-feature-section .eut-subheading.eut-custom-font-4,
#eut-feature-section.eut-fullscreen .eut-subheading.eut-custom-font-4,
#eut-feature-section .eut-title.eut-custom-font-4,
#eut-feature-section.eut-fullscreen .eut-title.eut-custom-font-4,
#eut-feature-section .eut-description.eut-custom-font-4,
#eut-feature-section.eut-fullscreen .eut-description.eut-custom-font-4 {
	font-family: " . crocal_eutf_option( 'custom_font_family_4', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'custom_font_family_4', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'custom_font_family_4', 'normal', 'font-style'  ) . ";
	text-transform: " . crocal_eutf_option( 'custom_font_family_4', 'none', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'custom_font_family_4', '0px', 'letter-spacing'  ) . "
}

";

/* Blog Leader
============================================================================= */
$body_lineheight = crocal_eutf_option( 'body_font', '36px', 'line-height'  );
$body_lineheight = filter_var( $body_lineheight, FILTER_SANITIZE_NUMBER_INT );
$typo_css .= "
.eut-blog-leader .eut-post-list .eut-post-content p {
	max-height: " . ( esc_attr( $body_lineheight ) * 2 ) . "px;
}
";

//Responsive Typography

$crocal_eutf_responsive_fonts_group_headings =  array (
	array(
		'id'   => 'h1_font',
		'selector'  => 'h1,.eut-h1,#eut-theme-wrapper .eut-modal .eut-search input[type="text"],.eut-dropcap span,p.eut-dropcap:first-letter',
		'custom_selector'  => '.eut-h1',
	),
	array(
		'id'   => 'h2_font',
		'selector'  => 'h2,.eut-h2,.tribe-events-page-title,.single-tribe_events .tribe-events-single-event-title',
		'custom_selector'  => '.eut-h2',
	),
	array(
		'id'   => 'h3_font',
		'selector'  => 'h3,.eut-h3',
		'custom_selector'  => '.eut-h3',
	),
	array(
		'id'   => 'h4_font',
		'selector'  => 'h4,.eut-h4',
		'custom_selector'  => '.eut-h4',
	),
	array(
		'id'   => 'h5_font',
		'selector'  => 'h5,.eut-h5,h3#reply-title',
		'custom_selector'  => '.eut-h5',
	),
	array(
		'id'   => 'h6_font',
		'selector'  => 'h6,.eut-h6',
		'custom_selector'  => '.eut-h6',
	),
	array(
		'id'   => 'logo_font',
		'selector'  => '#eut-header .eut-logo.eut-logo-text a',
	),
);


$crocal_eutf_responsive_fonts_group_1 =  array (
	array(
		'id'   => 'page_title',
		'selector'  => '#eut-page-title .eut-title,#eut-blog-title .eut-title,#eut-search-page-title .eut-title',
	),
	array(
		'id'   => 'post_title',
		'selector'  => '#eut-post-title .eut-title',
	),
	array(
		'id'   => 'post_simple_title',
		'selector'  => '.eut-single-simple-title',
	),
	array(
		'id'   => 'portfolio_title',
		'selector'  => '#eut-portfolio-title .eut-title',
	),
	array(
		'id'   => 'forum_title',
		'selector'  => '#eut-forum-title .eut-title',
	),
	array(
		'id'   => 'product_simple_title',
		'selector'  => '.eut-product-area .product_title',
	),
	array(
		'id'   => 'product_tax_title',
		'selector'  => '#eut-product-title .eut-title,#eut-product-tax-title .eut-title,.woocommerce-page #eut-page-title .eut-title',
	),
	array(
		'id'   => 'event_tax_title',
		'selector'  => '#eut-event-title .eut-title,#eut-event-tax-title .eut-title',
	),
	array(
		'id'   => 'feature_title_custom_font',
		'selector'  => '#eut-feature-section .eut-title',
	),
	array(
		'id'   => 'feature_title_full_font',
		'selector'  => '#eut-feature-section.eut-fullscreen .eut-title',
	),
	array(
		'id'   => 'feature_desc_full_font',
		'selector'  => '#eut-feature-section.eut-fullscreen .eut-description',
	),
);

$crocal_eutf_responsive_fonts_group_2 =  array (
	array(
		'id'   => 'page_description',
		'selector'  => '#eut-page-title .eut-description,#eut-blog-title .eut-description,#eut-blog-title .eut-description p,#eut-search-page-title .eut-description',
	),
	array(
		'id'   => 'post_title_meta',
		'selector'  => '#eut-post-title .eut-title-categories',
	),
	array(
		'id'   => 'post_title_extra_meta',
		'selector'  => '#eut-post-title .eut-post-meta, #eut-post-title .eut-post-meta li',
	),
	array(
		'id'   => 'post_title_desc',
		'selector'  => '#eut-post-title .eut-description',
	),
	array(
		'id'   => 'product_short_description',
		'selector'  => '#eut-entry-summary .eut-short-description p',
	),
	array(
		'id'   => 'product_tax_description',
		'selector'  => '#eut-product-title .eut-description,#eut-product-tax-title .eut-description,#eut-product-tax-title .eut-description p,.woocommerce-page #eut-page-title .eut-description',
	),
	array(
		'id'   => 'event_tax_description',
		'selector'  => '#eut-event-title .eut-description,#eut-event-tax-title .eut-description,#eut-event-tax-title .eut-description p',
	),
	array(
		'id'   => 'feature_subheading_custom_font',
		'selector'  => '#eut-feature-section .eut-subheading',
	),
	array(
		'id'   => 'feature_subheading_full_font',
		'selector'  => '#eut-feature-section.eut-fullscreen .eut-subheading',
	),
	array(
		'id'   => 'feature_desc_custom_font',
		'selector'  => '#eut-feature-section .eut-description',
	),
	array(
		'id'   => 'quote_text',
		'selector'  => '.eut-quote-text,blockquote p',
	),
	array(
		'id'   => 'leader_text',
		'selector'  => '.eut-leader-text,.eut-leader-text p,p.eut-leader-text',
	),
	array(
		'id'   => 'subtitle_text',
		'selector'  => '.eut-subtitle,.eut-subtitle-text',
	),
	array(
		'id'   => 'link_text',
		'selector'  => '#eut-theme-wrapper .eut-link-text, #eut-theme-wrapper .eut-btn,' . implode( ',', crocal_eutf_get_button_classes() ),
	),
	array(
		'id'   => 'main_menu_font',
		'selector'  => '.eut-main-menu .eut-wrapper > ul > li > a,.eut-main-menu .eut-wrapper > ul > li.megamenu > ul > li > a,.eut-toggle-hiddenarea .eut-label',
	),
	array(
		'id'   => 'sub_menu_font',
		'selector'  => '.eut-main-menu .eut-wrapper > ul > li ul li a',
	),
	array(
		'id'   => 'description_menu_font',
		'selector'  => '.eut-main-menu .eut-menu-description',
	),
);

function crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts = array() , $threshold = 35, $ratio = 0.7, $mode = '') {

	$css = '';

	if ( !empty( $crocal_eutf_responsive_fonts ) && $ratio < 1 ) {

		foreach ( $crocal_eutf_responsive_fonts as $font ) {
			$crocal_eutf_size = crocal_eutf_option( $font['id'], '32px', 'font-size'  );
			$crocal_eutf_size = filter_var( $crocal_eutf_size, FILTER_SANITIZE_NUMBER_INT );
			$line_height = crocal_eutf_option( $font['id'], '32px', 'line-height'  );
			$line_height = filter_var( $line_height, FILTER_SANITIZE_NUMBER_INT );

			if ( $crocal_eutf_size >= $threshold ) {
				$custom_line_height = $line_height / $crocal_eutf_size;
				$custom_size = $crocal_eutf_size * $ratio;

				if ( 'link_text' == $font['id'] ) {
					$css .= $font['selector'] . " {
						font-size: " . round( $custom_size, 0 ) . "px !important;
						line-height: " . round( $custom_line_height, 2 ) . "em;
					}
					";
				} else {
					$css .= $font['selector'] . " {
						font-size: " . round( $custom_size, 0 ) . "px;
						line-height: " . round( $custom_line_height, 2 ) . "em;
					}
					";
				}
			}

			if ( isset( $font['custom_selector'] ) ) {
				$sizes = array( '120', '140', '160', '180', '200', '250', '300' );
				foreach ( $sizes as $size ) {
					$custom_size = $crocal_eutf_size * ( $size / 100 );
					if ( $custom_size >= $threshold ) {
						if ( '250' == $size || '300' == $size ) {
							$custom_size = $crocal_eutf_size * ( $ratio / 1.7 );
						} elseif ( '200' == $size ) {
							$custom_size = $crocal_eutf_size * ( $ratio / 1.4 );
						} else {
							$custom_size = $crocal_eutf_size * ( $ratio / 1.15 );
						}
						if( !empty ( $mode ) ) {
							$css .= $font['custom_selector'] . ".eut-heading-" . esc_attr( $size ) .":not(.eut-" . esc_attr( $mode ) . "-reset-increase-heading ) {
								font-size: " . round( $custom_size, 0 ) . "px;
							}
							";
						} else {
							$css .= $font['custom_selector'] . ".eut-heading-" . esc_attr( $size ) ." {
								font-size: " . round( $custom_size, 0 ) . "px;
							}
							";
						}
					}
				}
			}

		}

	}

	return $css;
}

$small_desktop_threshold_headings = crocal_eutf_option( 'typography_small_desktop_threshold_headings', 20 );
$small_desktop_ratio_headings = crocal_eutf_option( 'typography_small_desktop_ratio_headings', 1 );
$tablet_landscape_threshold_headings = crocal_eutf_option( 'typography_tablet_landscape_threshold_headings', 20 );
$tablet_landscape_ratio_headings = crocal_eutf_option( 'typography_tablet_landscape_ratio_headings', 1 );
$tablet_portrait_threshold_headings = crocal_eutf_option( 'typography_tablet_portrait_threshold_headings', 20 );
$tablet_portrait_ratio_headings = crocal_eutf_option( 'typography_tablet_portrait_ratio_headings', 1 );
$mobile_threshold_headings = crocal_eutf_option( 'typography_mobile_threshold_headings', 20 );
$mobile_ratio_headings = crocal_eutf_option( 'typography_mobile_ratio_headings', 1 );

$small_desktop_threshold = crocal_eutf_option( 'typography_small_desktop_threshold', 20 );
$small_desktop_ratio = crocal_eutf_option( 'typography_small_desktop_ratio', 1 );
$tablet_landscape_threshold = crocal_eutf_option( 'typography_tablet_landscape_threshold', 20 );
$tablet_landscape_ratio = crocal_eutf_option( 'typography_tablet_landscape_ratio', 0.9 );
$tablet_portrait_threshold = crocal_eutf_option( 'typography_tablet_portrait_threshold', 20 );
$tablet_portrait_ratio = crocal_eutf_option( 'typography_tablet_portrait_ratio', 0.85 );
$mobile_threshold = crocal_eutf_option( 'typography_mobile_threshold', 28 );
$mobile_ratio = crocal_eutf_option( 'typography_mobile_ratio', 0.6 );

$small_desktop_threshold2 = crocal_eutf_option( 'typography_small_desktop_threshold2', 14 );
$small_desktop_ratio2 = crocal_eutf_option( 'typography_small_desktop_ratio2', 1 );
$tablet_landscape_threshold2 = crocal_eutf_option( 'typography_tablet_landscape_threshold2', 14 );
$tablet_landscape_ratio2 = crocal_eutf_option( 'typography_tablet_landscape_ratio2', 0.9 );
$tablet_portrait_threshold2 = crocal_eutf_option( 'typography_tablet_portrait_threshold2', 14 );
$tablet_portrait_ratio2 = crocal_eutf_option( 'typography_tablet_portrait_ratio2', 0.8 );
$mobile_threshold2 = crocal_eutf_option( 'typography_mobile_threshold2', 13 );
$mobile_ratio2 = crocal_eutf_option( 'typography_mobile_ratio2', 0.7 );

$typo_css .= "
	@media only screen and (min-width: 1201px) and (max-width: 1440px) {
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_headings, $small_desktop_threshold_headings, $small_desktop_ratio_headings, 'desktop-sm' ). "
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_1, $small_desktop_threshold, $small_desktop_ratio, 'desktop-sm' ). "
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_2, $small_desktop_threshold2, $small_desktop_ratio2, 'desktop-sm' ). "
	}
	@media only screen and (min-width: 960px) and (max-width: 1200px) {
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_headings, $tablet_landscape_threshold_headings, $tablet_landscape_ratio_headings, 'tablet' ). "
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_1, $tablet_landscape_threshold, $tablet_landscape_ratio, 'tablet' ). "
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_2, $tablet_landscape_threshold2, $tablet_landscape_ratio2, 'tablet' ). "
	}
	@media only screen and (min-width: 768px) and (max-width: 959px) {
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_headings, $tablet_portrait_threshold_headings, $tablet_portrait_ratio_headings, 'tablet-sm' ). "
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_1, $tablet_portrait_threshold, $tablet_portrait_ratio, 'tablet-sm' ). "
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_2, $tablet_portrait_threshold2, $tablet_portrait_ratio2, 'tablet-sm' ). "
	}
	@media only screen and (max-width: 767px) {
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_headings, $mobile_threshold_headings, $mobile_ratio_headings, 'mobile' ). "
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_1, $mobile_threshold, $mobile_ratio, 'mobile' ). "
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_2, $mobile_threshold2, $mobile_ratio2, 'mobile' ). "
	}
	@media print {
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_headings, $mobile_threshold_headings, $mobile_ratio_headings ). "
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_1, $mobile_threshold, $mobile_ratio ). "
		" . crocal_eutf_print_typography_responsive( $crocal_eutf_responsive_fonts_group_2, $mobile_threshold2, $mobile_ratio2 ). "
	}
";

// output dynamic css
echo crocal_eutf_compress_css( $typo_css );


//Omit closing PHP tag to avoid accidental whitespace output errors.
