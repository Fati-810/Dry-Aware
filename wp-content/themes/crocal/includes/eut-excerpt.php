<?php

/*
 *	Excerpt functions
 *
 * 	@version	1.0
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */


 /**
 * Custom excerpt
 */
if ( !function_exists('crocal_eutf_excerpt') ) {
	function crocal_eutf_excerpt( $limit, $more = '0' ) {
		global $post;
		$post_id = $post->ID;
		$excerpt = "";

		if ( has_excerpt( $post_id ) ) {
			if ( 0 != $limit ) {
				$excerpt = $post->post_excerpt;
				$excerpt = apply_filters('the_excerpt', $excerpt);
			}
			if ( '1' == $more ) {
				$excerpt .= crocal_eutf_read_more();
			}
		} else {
			$content = get_the_content('');
			$content = apply_filters('crocal_eutf_the_content', $content);
			$content = str_replace(']]>', ']]>', $content);
			if ( 0 != $limit ) {
				$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
			}
			if ( '1' == $more ) {
				$excerpt .= crocal_eutf_read_more();
			}
		}
		return	$excerpt;
	}
}

if ( !function_exists('crocal_eutf_quote_excerpt') ) {
	function crocal_eutf_quote_excerpt( $limit ) {
		global $post;
		$post_id = $post->ID;
		$excerpt = "";

		$content = crocal_eutf_post_meta( '_crocal_eutf_post_quote_text' );
		if( is_single() ){
			$excerpt = '<p>' . wp_kses_post( $content ) . '</p>';
		} else {
			if ( 0 != $limit ) {
				$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
			}
		}

		return	$excerpt;
	}
}

 /**
 * Custom more
 */
if ( !function_exists('crocal_eutf_read_more') ) {
	function crocal_eutf_read_more() {
		$more_button = '<a class="eut-read-more eut-link-text eut-heading-color eut-heading-hover-color" href="' . esc_url( get_permalink( get_the_ID() ) ) . '"><span>' . esc_html__( 'read more', 'crocal' ) . '</span></a>';
		return $more_button;
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
