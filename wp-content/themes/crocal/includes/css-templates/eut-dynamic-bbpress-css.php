<?php
/**
 *  Dynamic css style for bbPress Forum
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */

$css = "";

/**
 * Text Colors
 * ----------------------------------------------------------------------------
 */
$css .= "

#bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
#bbpress-forums .status-closed, #bbpress-forums .status-closed a {
	color: " . crocal_eutf_option( 'body_text_color' ) . ";
}

";

/**
 * Headings Colors
 * ----------------------------------------------------------------------------
 */
$css .= "

#eut-main-content .eut-widget.widget_display_topics li div,
#eut-main-content .eut-widget.widget_display_replies li div {
	color: " . crocal_eutf_option( 'body_heading_color' ) . ";
}


#eut-footer-area .eut-widget.widget_display_topics li div,
#eut-footer-area .eut-widget.widget_display_replies li div {
	color: " . crocal_eutf_option( 'footer_widgets_headings_color' ) . ";
}

";

/**
 * Primary #1 Colors
 * ----------------------------------------------------------------------------
 */
$css .= "

#bbpress-forums #bbp-single-user-details #bbp-user-navigation a:hover,
#bbpress-forums #bbp-single-user-details #bbp-user-navigation .current a {
	color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
}

";

/**
 * Main Border Colors
 * ----------------------------------------------------------------------------
 */
$css .= "

#eut-main-content #bbpress-forums #bbp-single-user-details,
#eut-main-content #bbpress-forums #bbp-your-profile fieldset span.description,
#bbpress-forums li.bbp-body ul.forum,
#bbpress-forums li.bbp-body ul.topic,
#bbpress-forums ul.bbp-lead-topic,
#bbpress-forums ul.bbp-topics,
#bbpress-forums ul.bbp-forums,
#bbpress-forums ul.bbp-replies,
#bbpress-forums ul.bbp-search-results,
#bbpress-forums .bbp-forums-list,
#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content,
.bbp-pagination-links a,
.bbp-pagination-links span.current,
#bbpress-forums div.bbp-forum-header,
#bbpress-forums div.bbp-topic-header,
#bbpress-forums div.bbp-reply-header,
#eut-main-content .eut-widget.widget_display_stats dd,
#eut-main-content .bbp_widget_login fieldset {
	border-color: " . crocal_eutf_option( 'body_border_color' ) . ";
}

#eut-footer-area .eut-widget.widget_display_stats dd,
#eut-footer-area .bbp_widget_login fieldset {
	border-color: " . crocal_eutf_option( 'footer_widgets_border_color' ) . ";
}

";

/**
 * Typography
 * ----------------------------------------------------------------------------
 */
$css .= "
.eut-widget.widget_display_topics li div,
.eut-widget.widget_display_replies li div {
	font-family: " . crocal_eutf_option( 'small_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'small_text', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'small_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'small_text', '10px', 'font-size'  ) . " !important;
	text-transform: " . crocal_eutf_option( 'small_text', 'uppercase', 'text-transform'  ) . ";
	" . crocal_eutf_css_option( 'small_text', '', 'letter-spacing'  ) . "
}

";

// output dynamic css
echo crocal_eutf_compress_css( $css );

//Omit closing PHP tag to avoid accidental whitespace output errors.
