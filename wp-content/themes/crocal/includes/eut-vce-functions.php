<?php

/*
*	Visual Composer Extension Plugin Hooks
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

/**
 * Translation function returning the theme translations
 */

/* All */
function crocal_eutf_theme_vce_get_string_all() {
    return esc_html__( 'All', 'crocal' );
}
/* Read more */
function crocal_eutf_theme_vce_get_string_read_more() {
    return esc_html__( 'read more', 'crocal' );
}
/* In Categories */
function crocal_eutf_theme_vce_get_string_categories_in() {
    return esc_html__( 'in', 'crocal' );
}

/* Author By */
function crocal_eutf_theme_vce_get_string_by_author() {
    return esc_html__( 'By:', 'crocal' );
}

/* E-mail */
function crocal_eutf_theme_vce_get_string_email() {
    return esc_html__( 'E-mail', 'crocal' );
}

/**
 * Hooks for portfolio translations
 */

add_filter( 'crocal_eutf_vce_portfolio_string_all_categories', 'crocal_eutf_theme_vce_get_string_all' );

 /**
 * Hooks for blog translations
 */

add_filter( 'crocal_eutf_vce_string_read_more', 'crocal_eutf_theme_vce_get_string_read_more' );
add_filter( 'crocal_eutf_vce_blog_string_all_categories', 'crocal_eutf_theme_vce_get_string_all' );
add_filter( 'crocal_eutf_vce_blog_string_categories_in', 'crocal_eutf_theme_vce_get_string_categories_in' );
add_filter( 'crocal_eutf_vce_blog_string_by_author', 'crocal_eutf_theme_vce_get_string_by_author' );




 /**
 * Hooks for general translations
 */

add_filter( 'crocal_eutf_vce_product_string_all_categories', 'crocal_eutf_theme_vce_get_string_all' );
add_filter( 'crocal_eutf_vce_event_string_all_categories', 'crocal_eutf_theme_vce_get_string_all' );
add_filter( 'crocal_eutf_vce_string_email', 'crocal_eutf_theme_vce_get_string_email' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
