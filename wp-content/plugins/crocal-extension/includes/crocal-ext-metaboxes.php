<?php

/*
 *	Metabox functions
 *
 * 	@version	1.0
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */


/**
 * Functions to print global metaboxes
 */
add_action( 'add_meta_boxes', 'crocal_ext_generic_options_add_custom_boxes' );

function crocal_ext_generic_options_add_custom_boxes() {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}

	//General Page Options
	if ( function_exists( 'crocal_eutf_page_options_box' ) ) {

		$post_types = array(
			'page' => esc_html__( 'Page Options', 'crocal-extension' ),
			'post' => esc_html__( 'Post Options', 'crocal-extension' ),
			'portfolio' => esc_html__( 'Portfolio Options', 'crocal-extension' ),
			'product' => esc_html__( 'Product Options', 'crocal-extension' ),
			'tribe_events' => esc_html__( 'Events Options', 'crocal-extension' ),
		);

		$post_types = apply_filters( 'crocal_ext_page_options_post_types', $post_types );

		if ( !empty( $post_types ) ) {

			foreach ( $post_types as $post_type => $title ) {
				add_meta_box(
					'eut-page-options',
					$title,
					'crocal_eutf_page_options_box',
					$post_type
				);
			}
		}
	}

	if ( function_exists( 'crocal_eutf_option' ) && function_exists( 'crocal_eutf_page_feature_section_box' )  ) {
		$feature_section_post_types = crocal_eutf_option( 'feature_section_post_types');

		if ( !empty( $feature_section_post_types ) ) {

			foreach ( $feature_section_post_types as $key => $value ) {

				if ( 'attachment' != $value ) {

					add_meta_box(
						'eut-feature-section-metabox',
						esc_html__( 'Feature Section', 'crocal-extension' ),
						'crocal_eutf_page_feature_section_box',
						$value,
						'advanced',
						'low'
					);

				}

			}
		}
	}
}

/**
 * Functions to print portfolio metaboxes
 */

add_action( 'add_meta_boxes', 'crocal_ext_portfolio_options_add_custom_boxes' );

function crocal_ext_portfolio_options_add_custom_boxes() {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}

	$visibility = apply_filters( 'crocal_ext_portfolio_options_visibility', true );
	if ( !$visibility ) {
		return;
	}

	if ( function_exists( 'crocal_eutf_portfolio_link_mode_box' ) ) {
		add_meta_box(
			'eut-meta-box-portfolio-link-mode',
			esc_html__( 'Portfolio Link Options', 'crocal-extension' ),
			'crocal_eutf_portfolio_link_mode_box',
			'portfolio'
		);
	}
	if ( function_exists( 'crocal_eutf_portfolio_overview_mode_box' ) ) {
		add_meta_box(
			'eut-meta-box-portfolio-overview-mode',
			esc_html__( 'Portfolio Overview Options', 'crocal-extension' ),
			'crocal_eutf_portfolio_overview_mode_box',
			'portfolio'
		);
	}
	if ( function_exists( 'crocal_eutf_portfolio_media_section_box' ) ) {
		add_meta_box(
			'eut-meta-box-portfolio-media-section',
			esc_html__( 'Portfolio Media', 'crocal-extension' ),
			'crocal_eutf_portfolio_media_section_box',
			'portfolio'
		);
	}
	if ( function_exists( 'crocal_eutf_second_featured_image_section_box' ) ) {
		add_meta_box(
			'eut-meta-box-portfolio-second-featured-image',
			esc_html__( 'Second Featured Image', 'crocal-extension' ),
			'crocal_eutf_second_featured_image_section_box',
			'portfolio',
			'side',
			'low'
		);
	}

}

/**
 * Functions to print post metaboxes
 */
add_action( 'add_meta_boxes', 'crocal_ext_post_options_add_custom_boxes' );

function crocal_ext_post_options_add_custom_boxes() {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}

	$visibility = apply_filters( 'crocal_ext_post_options_visibility', true );
	if ( !$visibility ) {
		return;
	}

	if ( function_exists( 'crocal_eutf_meta_box_post_format_standard' ) ) {
		add_meta_box(
			'eut-meta-box-post-format-standard',
			esc_html__( 'Standard Format Options', 'crocal-extension' ),
			'crocal_eutf_meta_box_post_format_standard',
			'post'
		);
	}
	if ( function_exists( 'crocal_eutf_meta_box_post_format_gallery' ) ) {
		add_meta_box(
			'eut-meta-box-post-format-gallery',
			esc_html__( 'Gallery Format Options', 'crocal-extension' ),
			'crocal_eutf_meta_box_post_format_gallery',
			'post'
		);
	}
	if ( function_exists( 'crocal_eutf_meta_box_post_format_link' ) ) {
		add_meta_box(
			'eut-meta-box-post-format-link',
			esc_html__( 'Link Format Options', 'crocal-extension' ),
			'crocal_eutf_meta_box_post_format_link',
			'post'
		);
	}
	if ( function_exists( 'crocal_eutf_meta_box_post_format_quote' ) ) {
		add_meta_box(
			'eut-meta-box-post-format-quote',
			esc_html__( 'Quote Format Options', 'crocal-extension' ),
			'crocal_eutf_meta_box_post_format_quote',
			'post'
		);
	}
	if ( function_exists( 'crocal_eutf_meta_box_post_format_video' ) ) {
		add_meta_box(
			'eut-meta-box-post-format-video',
			esc_html__( 'Video Format Options', 'crocal-extension' ),
			'crocal_eutf_meta_box_post_format_video',
			'post'
		);
	}
	if ( function_exists( 'crocal_eutf_meta_box_post_format_audio' ) ) {
		add_meta_box(
			'eut-meta-box-post-format-audio',
			esc_html__( 'Audio Format Options', 'crocal-extension' ),
			'crocal_eutf_meta_box_post_format_audio',
			'post'
		);
	}

}



/**
 * Functions to print testimonial metaboxes
 */

add_action( 'add_meta_boxes', 'crocal_ext_testimonial_options_add_custom_boxes' );

function crocal_ext_testimonial_options_add_custom_boxes() {

	if ( function_exists( 'crocal_eutf_testimonial_options_box' ) ) {
		add_meta_box(
			'eut-testimonial-options',
			esc_html__( 'Testimonial Options', 'crocal-extension' ),
			'crocal_eutf_testimonial_options_box',
			'testimonial'
		);
	}

}
//Omit closing PHP tag to avoid accidental whitespace output errors.
