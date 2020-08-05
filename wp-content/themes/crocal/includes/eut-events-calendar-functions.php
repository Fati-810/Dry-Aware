<?php

/*
*	Events Calendar helper functions and configuration
*
* 	@version	1.0
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
*/

/**
 * Helper function to check if Events Calendar is enabled
 */
function crocal_eutf_events_calendar_enabled() {

	if ( class_exists( 'Tribe__Events__Main' ) || class_exists( 'TribeEvents' ) ) {
		return true;
	}
	return false;
}

function crocal_eutf_events_calendar_pro_enabled() {
	if ( class_exists( 'Tribe__Events__Pro__Main' ) || class_exists( 'TribeEventsPro' ) ) {
		return true;
	}
	return false;
}

/**
 * Helper function to check if is Events Calendar Overview Page
 */
function crocal_eutf_events_calendar_is_overview() {
	if ( crocal_eutf_events_calendar_enabled() ) {
		if ( tribe_is_list_view() || tribe_is_day() || tribe_is_month() ) {
			return true;
		}
	}
	if ( crocal_eutf_events_calendar_pro_enabled() ) {
		if ( tribe_is_event_query() ) {
			if ( tribe_is_week() || tribe_is_map() || tribe_is_photo() ) {
				return true;
			}
		}
	}
	return false;
}

//If Events Calendar plugin is not enabled return
if ( !crocal_eutf_events_calendar_enabled() ) {
	return false;
}


/**
 * Prints title organizer meta
 */
function crocal_eutf_event_organizer_title_meta() {
	$phone = tribe_get_organizer_phone();
	$email = tribe_get_organizer_email();
	$website = tribe_get_organizer_website_link();

	$details = array();
	if ( $tel = tribe_get_organizer_phone() ) {
		$details[] = '<span class="tel">' . esc_html( $tel ) . '</span>';
	}
	if ( $email = tribe_get_organizer_email() ) {
		$details[] = '<span class="email"> <a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a> </span>';
	}
	if ( $link = tribe_get_organizer_website_link() ) {
		$details[] = '<span class="link"> <a href="' . esc_attr( $link ) . '">' . $link . '</a> </span>';
	}

	$html = join( '<span class="eut-tribe-events-divider">|</span>', $details );

	if ( ! empty( $html ) ) {
		return $html;
	} else {
		return "";
	}
}


function crocal_eutf_print_event_bar() {

	if( crocal_eutf_social_bar( 'event', 'check' ) ) {
?>
	<div id="eut-socials-section" class="eut-align-center clearfix">
		<div class="eut-container">
		<?php crocal_eutf_social_bar ( 'event' ); ?>
		</div>
	</div>
<?php
	}
	if ( crocal_eutf_nav_bar( 'event', 'check') ) {
		crocal_eutf_nav_bar( 'event' );
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.