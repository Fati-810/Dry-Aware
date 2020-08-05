<?php
/**
 *  Dynamic css style for Events Calendar
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */

$css = "";

// Event Anchor Size
$css .= "

#eut-event-anchor {
	height: " . intval( crocal_eutf_option( 'event_anchor_menu_height', 120 ) + 2 ) . "px;
}

#eut-event-anchor .eut-anchor-wrapper {
	line-height: " . crocal_eutf_option( 'event_anchor_menu_height' ) . "px;
}

#eut-event-anchor.eut-anchor-menu .eut-anchor-btn {
	width: " . crocal_eutf_option( 'event_anchor_menu_height' ) . "px;
}

";

/* Tribe Events
============================================================================= */
$css .= "
.events-list.tribe-bar-is-disabled #tribe-events-content-wrapper {
    max-width: " . esc_attr( crocal_eutf_option( 'container_size', 1170 ) ) . "px;
}

.tribe-events-day {
    padding: 0;
}

#eut-theme-wrapper #tribe-bar-collapse-toggle {
    display: none;
}

";

/* Featured Event
============================================================================= */
$css .= "
#eut-tribe-events-list .tribe-event-featured,
#eut-tribe-events-day .tribe-event-featured,
#eut-tribe-events-map .tribe-event-featured {
    color: inherit;
    background-color: #fafafa;
}

#eut-tribe-events-list .tribe-event-featured .eut-post-content-wrapper,
#eut-tribe-events-day .tribe-event-featured .eut-post-content-wrapper,
#eut-tribe-events-map .tribe-event-featured .eut-post-content-wrapper {
	padding-left: 30px;
	padding-right: 30px;
}

.tribe-event-featured .event-is-recurring {
    color: inherit;
}

.tribe-event-featured .event-is-recurring:hover {
	color: inherit;
}

#eut-tribe-events-list .type-tribe_events,
#eut-tribe-events-day .type-tribe_events,
#eut-tribe-events-map .type-tribe_events {
	padding-top: 0;
}

.tribe-events-divider,
.tribe-events-organizer .tribe-events-divider {
	margin: 0 8px;
}
.tribe-events-loop .tribe-events-photo-event .recurringinfo .tribe-events-divider {
    display: inline;
}

.eut-tribe-events-divider,
#eut-event-title .tribe-events-divider {
	margin: 0 5px;
}

.tribe-events-photo .eut-media img {
	height: auto;
	width: 100%;
}

#eut-event-title .eut-event-cost {
	margin-left: 10px;
	font-style: italic;
}
.eut-event-item .tribe-events-tooltip {
	display: none;
}

";

/* Event Page Title
============================================================================= */
$css .= "

#tribe-events-content-wrapper .tribe-events-title-bar {
	margin-bottom: 60px;
}

.eut-tribe-events-list-event-title {
	margin-bottom: 6px;
}

.eut-tribe-events-event-meta.eut-post-meta {
	line-height: 24px;
	margin-bottom: 20px;
	opacity: .8;
	font-size: inherit;
}

";

/* Event Page Title
============================================================================= */
$css .= "

#eut-event-title .event-is-recurring,
#eut-event-title .eut-description a,
#eut-event-tax-title .eut-description a {
	color: inherit;
}

#eut-event-title .eut-description a:hover,
#eut-event-tax-title .eut-description a:hover {
	opacity: 0.5;
}

";

/* Event Single
============================================================================= */
$css .= "
#tribe-events-content {
	margin-bottom: 0;
	padding: 0;
}

.single-tribe_events .tribe-events-event-meta:last-child {
	margin-bottom: 0;
}

.single-tribe_events .tribe-events-cal-links {
	margin-bottom: 60px;
}

a.tribe-events-gcal,
a.tribe-events-ical {
	margin-top: 40px;
}

.single-tribe_events #eut-single-media {
    margin-bottom: 5%;
}

";


/* Event Bar Form
============================================================================= */
$css .= "

#tribe-events-bar {
	margin-bottom: 60px;
}

#tribe-bar-form {
	margin: 0;
	position: relative;
	width: 100%;
}

.tribe-bar-submit,
.tribe-events-uses-geolocation .tribe-bar-submit {
	padding-top: 28px;
}

.tribe-bar-views-inner {
	padding: 15px 0 53px;
	background: transparent;
}

#tribe-events-content table.tribe-events-calendar {
	margin-bottom: 30px;
}

#tribe-bar-views li.tribe-bar-views-option {
	line-height: 41px;
}

.tribe-bar-collapse #tribe-bar-collapse-toggle {
	margin-top: 26px;
	padding: 13px;
}

#tribe-bar-form.tribe-bar-collapse .tribe-bar-views-inner label {
	margin-bottom: 5px;
	padding: 0;
}

#tribe-bar-views-toggle {
	outline: none;
}

#tribe-bar-views-toggle:focus,
#tribe-bar-views-toggle:hover {
	outline: none;
	background-color: transparent;
}

#tribe-bar-views .tribe-bar-views-list {
	outline: none;
}

#tribe-bar-views .tribe-bar-views-inner {
	background-color: transparent;
}

#tribe-bar-views-toggle,
#tribe-bar-views li.tribe-bar-views-option {
	padding: 1.250em 2.500em;
	line-height: 1.4;
	position: relative;
	z-index: 2;
	margin-top: -2px;
}

#tribe-bar-views-toggle .tribe-icon-month,
#tribe-bar-views-toggle .tribe-icon-list,
#tribe-bar-views-toggle .tribe-icon-day,
#tribe-bar-views li .tribe-icon-list,
#tribe-bar-views li .tribe-icon-month,
#tribe-bar-views li .tribe-icon-day {
	position: absolute;
	left: 10px;
}

.tribe-bar-collapse #tribe-bar-views-toggle .tribe-icon-month,
.tribe-bar-collapse #tribe-bar-views-toggle .tribe-icon-list,
.tribe-bar-collapse #tribe-bar-views-toggle .tribe-icon-day {
	position: relative;
	left: 0;
}

#tribe-bar-views-toggle:after {
	border: solid transparent;
	border-color: rgba(136,183,213,0);
	border-top-color: inherit;
	border-width: 4px;
	pointer-events: none;
	position: absolute;
	right: 15px;
	top: 50%;
	margin-top: -2px;
}

#tribe-bar-collapse-toggle span.tribe-bar-toggle-arrow:after {
	border: solid transparent;
	border-color: rgba(136,183,213,0);
	border-top-color: inherit;
	border-width: 4px;
	pointer-events: none;
	position: absolute;
	top: 13px;
}

#tribe-bar-collapse-toggle.tribe-bar-filters-open span.tribe-bar-toggle-arrow:after {
	top: 9px;
}

.tribe-bar-views-open #tribe-bar-views-toggle:after {
	top: 50%;
	margin-top: -6px;
}

#tribe-bar-views .tribe-bar-views-list {
	background: #eaeaea;
	border-radius: 0;
	padding: 0;
}

#tribe-bar-views .tribe-bar-views-option.tribe-bar-active,
#tribe-bar-views .tribe-bar-views-option:hover {
	background: #f1f1f1;
}


#tribe-bar-form.tribe-bar-collapse #tribe-bar-collapse-toggle {
	outline: none;
}

#tribe-bar-form.tribe-bar-collapse .tribe-bar-submit {
	margin-left: 0;
}

";


/* Event Cost
============================================================================= */
$css .= "

.eut-event-grid .tribe-events-event-cost,
.eut-tribe-events-event-cost {
	background-color: #f7f7f7;
	color: #999999;
	font-size: 12px;
	line-height: 2;
	padding: 4px 12px;
	display: inline-block;
	-webkit-border-radius: 50px;
	border-radius: 50px;
	-webkit-transition : all .3s;
	-moz-transition    : all .3s;
	-ms-transition     : all .3s;
	-o-transition      : all .3s;
	transition         : all .3s;
}

.eut-event-grid .eut-event-item-inner:hover .tribe-events-event-cost,
.eut-blog-item-inner:hover .eut-tribe-events-event-cost,
.tribe-event-featured .eut-tribe-events-event-cost {
	background-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	color: #ffffff;
	font-size: 12px;
	line-height: 2;
	padding: 4px 12px;
	display: inline-block;
	-webkit-border-radius: 50px;
	border-radius: 50px;
}

.eut-tribe-events-event-cost {
	margin-bottom: 15px;
}


";

/* Event Tooltip
============================================================================= */
$css .= "

.recurring-info-tooltip,
.tribe-events-calendar .tribe-events-tooltip,
.tribe-events-shortcode.view-week .tribe-events-tooltip,
.tribe-events-week .tribe-events-tooltip {
	padding: 30px;
	text-align: left;
}

.tribe-events-tooltip .tribe-events-event-thumb {
	float: none;
	margin-bottom: 10px;
}

.tribe-events-tooltip .tribe-events-event-body .tribe-events-event-thumb img {
	width: 100%;
	max-width: none;
	max-height: none;
}

.tribe-events-tooltip.tribe-event-featured .tribe-event-description {
	margin-top: 10px;
}
";

/* Event Navigation Bar
============================================================================= */
$css .= "
#eut-event-bar.eut-layout-1 {
	padding-top: " . crocal_eutf_option( 'event_nav_spacing', '', 'padding-top' ) . ";
	padding-bottom: " . crocal_eutf_option( 'event_nav_spacing', '', 'padding-bottom'  ) . ";
	background-color: " . crocal_eutf_option( 'event_bar_background_color', '#000000'  ) . ";
	border-color: " . crocal_eutf_option( 'event_bar_border_color', '#000000'  ) . " !important;
}

#eut-event-bar.eut-layout-1 .eut-nav-item {
	color: " . crocal_eutf_option( 'event_bar_nav_title_color', '#ffffff'  ) . ";
}

#eut-event-bar.eut-layout-1 .eut-nav-item .eut-arrow {
	color: " . crocal_eutf_option( 'event_bar_arrow_color', '#ffffff'  ) . ";
}

#eut-event-bar .eut-backlink {
	background-color: " . crocal_eutf_option( 'event_bar_backlink_background', '#ffffff'  ) . ";
}

#eut-event-bar .eut-backlink svg {
	fill: " . crocal_eutf_option( 'event_bar_backlink_color', '#000000'  ) . ";
}

";


/* Event Photo Layout
============================================================================= */
$css .= "

.type-tribe_events.tribe-events-photo-event .tribe-events-photo-event-wrap {
	background-color: #ffffff;
	-webkit-box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.1);
	-moz-box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.1);
	box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.1);
}

.tribe-events-list .tribe-events-photo-event .tribe-events-event-details {
	padding: 36px;
}

.tribe-events-list .tribe-events-loop .tribe-event-featured,
.tribe-events-list #tribe-events-day.tribe-events-loop .tribe-event-featured,
.type-tribe_events.tribe-events-photo-event.tribe-event-featured .tribe-events-photo-event-wrap,
.type-tribe_events.tribe-events-photo-event.tribe-event-featured .tribe-events-photo-event-wrap:hover {
	background-color: #101215 !important;
}

";

/* Event Grid
============================================================================= */
$css .= "
.eut-event-item {
	-webkit-backface-visibility : hidden;
	-moz-backface-visibility    : hidden;
	-ms-backface-visibility     : hidden;
}

.eut-event-grid .eut-event-item .eut-event-item-inner {
	background-color: #ffffff;
	-webkit-backface-visibility : hidden;
	-moz-backface-visibility    : hidden;
	-ms-backface-visibility     : hidden;
	-webkit-transition : all .3s;
	-moz-transition    : all .3s;
	-ms-transition     : all .3s;
	-o-transition      : all .3s;
	transition         : all .3s;
	-webkit-box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.1);
	-moz-box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.1);
	box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.1);
}

.eut-event-grid .eut-event-item:hover .eut-blog-item-inner {
	-webkit-box-shadow: 0px 8px 35px 0px rgba(0,0,0,0.13);
	-moz-box-shadow: 0px 8px 35px 0px rgba(0,0,0,0.13);
	box-shadow: 0px 8px 35px 0px rgba(0,0,0,0.13);
}

.eut-event-grid .eut-event-item .eut-media {
	margin-bottom: 0;
}

.eut-event-grid .eut-event-item .eut-event-content-wrapper {
	padding: 36px;
}

.eut-event-grid .tribe-events-event-cost {
	margin-top: 15px;
}

";


/**
* Header Colors
* ----------------------------------------------------------------------------
*/

$css .= "
.tribe-events-day .tribe-event-featured a,
.tribe-events-day .tribe-event-featured a:hover,
.eut-tribe-events-meta-group ul li span,
#tribe-events-content .tribe-events-calendar div[id*=tribe-events-event-] h3.tribe-events-month-event-title a {
	color: " . crocal_eutf_option( 'body_heading_color' ) . ";
}

";


/**
* Borders
* ----------------------------------------------------------------------------
*/
$css .= "

.eut-tribe-events-meta-group ul li,
.eut-list-separator:after,
.eut-post-content .eut-tribe-events-venue-details,
#tribe-events-content .tribe-events-calendar td,
.tribe-grid-allday .type-tribe_events>div,
.tribe-grid-allday .type-tribe_events>div:hover,
.tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single,
.tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single:hover {
	border-color: " . crocal_eutf_option( 'body_border_color' ) . ";
}

";

/**
* Heading Text
* ----------------------------------------------------------------------------
*/

$css .= "

.eut-tribe-events-list-event-title a {
	color: " . crocal_eutf_option( 'body_heading_color' ) . ";
}

";

/**
* Primary Text
* ----------------------------------------------------------------------------
*/

$css .= "

#tribe-events-content .tribe-events-calendar div[id*=tribe-events-event-] h3.tribe-events-month-event-title a:hover,
#tribe_events_filters_wrapper .tribe_events_slider_val,
.single-tribe_events a.tribe-events-gcal,
.single-tribe_events a.tribe-events-ical {
	color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
}

";

/**
* Primary Bg
* ----------------------------------------------------------------------------
*/

$css .= "
/*
#tribe-bar-form .tribe-bar-submit input[type=submit],
#tribe-events .tribe-events-button,
#tribe-events .tribe-events-button:hover,
#tribe_events_filters_wrapper input[type=submit],
.tribe-events-button,
.tribe-events-button.tribe-active:hover,
.tribe-events-button.tribe-inactive,
.tribe-events-button:hover, .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-],
.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a,
.tribe-grid-allday .type-tribe_events>div,
.tribe-grid-allday .type-tribe_events>div:hover,
.tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single,
.tribe-grid-body .type-tribe_events .tribe-events-week-hourly-single:hover {
	background-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	color: #ffffff;
}

#tribe-bar-form .tribe-bar-submit input[type=submit]:hover {
	background-color: " . crocal_eutf_option( 'body_primary_1_hover_color' ) . ";
	border-color: " . crocal_eutf_option( 'body_primary_1_hover_color' ) . ";
	color: #ffffff;
}
*/

";

/**
* Widgets
* ----------------------------------------------------------------------------
*/

$css .= "

#eut-main-content .eut-widget .entry-title a,
#eut-main-content .widget .tribe-countdown-text a,
#tribe-events-content .tribe-events-tooltip h4 {
	color: " . crocal_eutf_option( 'body_heading_color' ) . ";
}

#eut-main-content .widget .tribe-mini-calendar .tribe-events-has-events a,
#eut-main-content .widget .tribe-countdown-number,
#eut-main-content .widget .tribe-mini-calendar-no-event {
	color: " . crocal_eutf_option( 'body_text_color' ) . ";
}

#eut-main-content .eut-widget .entry-title a:hover,
.widget .tribe-countdown-text a:hover,
.widget .tribe-mini-calendar-event .list-date .list-dayname,
.widget .tribe-countdown-under,
.widget .tribe-mini-calendar td.tribe-events-has-events a {
	color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
}

#eut-main-content .tribe-mini-calendar-event {
	border-color: " . crocal_eutf_option( 'body_border_color' ) . ";
}

.widget .tribe-mini-calendar-nav td,
.widget .tribe-mini-calendar td.tribe-events-has-events.tribe-events-present,
.widget .tribe-mini-calendar td.tribe-events-has-events.tribe-events-present a:hover,
.widget .tribe-mini-calendar td.tribe-events-has-events a:hover,
.widget .tribe-mini-calendar td.tribe-events-has-events.tribe-mini-calendar-today {
	background-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	color: #ffffff;
}

";

/* Footer */
$css .= "

#eut-footer .eut-widget .entry-title a,
#eut-footer .widget .tribe-countdown-text a {
	color: " . crocal_eutf_option( 'footer_widgets_headings_color' ) . ";
}

#eut-footer .widget .tribe-countdown-number,
#eut-footer .widget .tribe-mini-calendar-no-event {
	color: " . crocal_eutf_option( 'footer_widgets_font_color' ) . ";
}

#eut-footer .widget .tribe-mini-calendar-event,
#eut-footer table,
#eut-footer td,
#eut-footer th {
	border-color: " . crocal_eutf_option( 'footer_widgets_border_color' ) . ";
}

#eut-footer .widget .tribe-mini-calendar-event .list-date,
#eut-footer .widget .tribe-mini-calendar th {
	background-color: " . crocal_eutf_option( 'footer_widgets_border_color' ) . ";
}

";

/**
* Typography
* ----------------------------------------------------------------------------
*/

$css .= "

.widget .tribe-mini-calendar-event .list-info {
	font-size: " . crocal_eutf_option( 'body_font', '14px', 'font-size'  ) . ";
	font-family: " . crocal_eutf_option( 'body_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'body_font', 'normal', 'font-weight'  ) . ";
}

#tribe-bar-form .tribe-bar-submit input[type=submit],
.eut-widget .entry-title,
.widget .tribe-mini-calendar-nav td,
.widget .tribe-countdown-text,
#tribe-events-content .tribe-events-calendar div[id*=tribe-events-event-] h3.tribe-events-month-event-title,
#tribe-bar-views-toggle,
#tribe-bar-views li.tribe-bar-views-option {
	font-family: " . crocal_eutf_option( 'link_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . crocal_eutf_option( 'link_text', 'normal', 'font-weight'  ) . ";
	font-style: " . crocal_eutf_option( 'link_text', 'normal', 'font-style'  ) . ";
	font-size: " . crocal_eutf_option( 'link_text', '11px', 'font-size'  ) . " !important;
	text-transform: " . crocal_eutf_option( 'link_text', 'uppercase', 'text-transform'  ) . ";
}

";

// output dynamic css
echo crocal_eutf_compress_css( $css );

//Omit closing PHP tag to avoid accidental whitespace output errors.
