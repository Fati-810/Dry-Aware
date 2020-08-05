<?php

/*
*	bbPress helper functions and configuration
*
* 	@version	1.0
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
*/

/**
 * Helper function to check if bbPress is enabled
 */
function crocal_eutf_bbpress_enabled() {
	if ( class_exists( 'bbPress' ) ) {
		return true;
	}
	return false;
}

function crocal_eutf_is_bbpress() {
	if ( crocal_eutf_bbpress_enabled() && is_bbpress() ) {
		return true;
	}
	return false;
}

//If woocomerce plugin is not enabled return
if ( !crocal_eutf_bbpress_enabled() ) {
	return false;
}

/**
 * De-register bbPress styles
 */
add_filter( 'bbp_default_styles', 'crocal_eutf_bbpress_deregister_styles', 10, 1 );
function crocal_eutf_bbpress_deregister_styles( $styles ) {
	return array();
}

/**
 * Register custom bbPress styles
 */
if( !is_admin() ) {
	add_action('bbp_enqueue_scripts', 'crocal_eutf_bbpress_register_styles', 15 );
}
function crocal_eutf_bbpress_register_styles() {
	wp_enqueue_style( 'crocal-eutf-bbpress-general', get_template_directory_uri() . '/css/bbpress.css', array(), '1.0.0', 'all' );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
