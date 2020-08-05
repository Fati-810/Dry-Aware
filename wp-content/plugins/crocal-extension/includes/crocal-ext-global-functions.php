<?php

/*
 *	Helper Global functions
 *
 * 	@version	1.0
 * 	@author		Euthemians Team
 * 	@URI		http://euthemians.com
 */

/**
 * Get allowed HTML for microdata
 */
function crocal_ext_get_microdata_allowed_html() {
	$allowed_html = array(
		'span' => array(
			'title' => true,
			'class' => true,
			'id' => true,
			'dir' => true,
			'align' => true,
			'lang' => true,
			'xml:lang' => true,
			'aria-hidden' => true,
			'data-icon' => true,
			'itemref' => true,
			'itemid' => true,
			'itemprop' => true,
			'itemscope' => true,
			'itemtype' => true,
			'xmlns:v' => true,
			'typeof' => true,
			'property' => true
		),
		'br' => array(),
	);

	return $allowed_html;
}

/**
 * Get allowed HTML for widget titles
 */
function crocal_ext_get_widget_allowed_html() {
	$allowed_html = array(
		'div' => array(
			'class' => true,
			'id' => true,
		),
		'h1' => array(
			'class' => true,
		),
		'h2' => array(
			'class' => true,
		),
		'h3' => array(
			'class' => true,
		),
		'h4' => array(
			'class' => true,
		),
		'h5' => array(
			'class' => true,
		),
		'h6' => array(
			'class' => true,
		),
		'br' => array(),
	);

	return $allowed_html;
}

/**
 * Get instagram array
 */
function crocal_ext_get_instagram_array( $username, $limit, $order_by, $order, $cache = "", $access_token = "", $user_id = ""  ) {

	$username = strtolower( $username );
	$transient_string = $access_token .'-'. $username .'-'. $order_by .'-'. $order;

	if ( false === ( $instagram = get_transient('eut-instagram-feed-v2-'.sanitize_title_with_dashes( $transient_string ) ) ) || empty( $cache ) ) {

		if( !empty( $user_id ) && !empty( $access_token ) ) {
			$url = 'https://api.instagram.com/v1/users/' . $user_id . '/media/recent/?access_token=' . $access_token;
		} else {
			$url = 'https://www.instagram.com/' . $username . '/media/';
		}

		$remote = wp_remote_get( $url );

		if ( is_wp_error( $remote ) ) {
			if( current_user_can( 'administrator' ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram!', 'crocal-extension' ) );
			} else {
				return new WP_Error('site_down', '' );
			}
		}
		if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
			if( current_user_can( 'administrator' ) ) {
				return new WP_Error('invalid_response', esc_html__( 'Instagram invalid response!', 'crocal-extension' ) );
			} else {
				return new WP_Error('invalid_response', '' );
			}
		}

		$insta_array = json_decode( $remote['body'], TRUE );

		if( !empty( $user_id ) && !empty( $access_token ) ) {
			$images = isset( $insta_array['data'] ) ? $insta_array['data'] : array();
		} else {
			$images = isset( $insta_array['items'] ) ? $insta_array['items'] : array();
		}

		$instagram = array();

		foreach ( $images as $image ) {

			if ($image['user']['username'] == $username) {

				$image['link']                          = preg_replace( "/^http:/i", "", $image['link'] );
				$image['images']['thumbnail']           = preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
				$image['images']['low_resolution']      = preg_replace( "/^http:/i", "", $image['images']['low_resolution'] );
				$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );

				$instagram[] = array(
					'description'   => $image['caption']['text'],
					'link'          => $image['link'],
					'time'          => $image['created_time'],
					'comments'      => $image['comments']['count'],
					'likes'         => $image['likes']['count'],
					'thumbnail'     => $image['images']['thumbnail'],
					'medium'        => $image['images']['low_resolution'],
					'large'         => $image['images']['standard_resolution'],
					'type'          => $image['type']
				);
			}
		}

		//Instagram Order
		if ( 'none' != $order_by ) {
			foreach ($instagram as $key => $row) {
				$time[$key] = $row['time'];
				$comments[$key]  = $row['comments'];
				$likes[$key] = $row['likes'];
			}
			if ( 'ASC' == $order ) {
				$order = SORT_ASC;
			} else {
				$order = SORT_DESC;
			}
			if ( 'datetime' == $order_by ) {
				$order_by = $time;
			} elseif ( 'comments' == $order_by ) {
				$order_by = $comments;
			} elseif ( 'likes' == $order_by ) {
				$order_by = $likes;
			}
			array_multisort( $order_by, $order, $instagram );
		}

		if( !empty( $cache ) ) {
			set_transient('eut-instagram-feed-v2-'.sanitize_title_with_dashes( $transient_string ), $instagram, apply_filters( 'crocal_eutf_instagram_cache_time', HOUR_IN_SECONDS ) );
		}
	}

	return array_slice( $instagram, 0, $limit );
}

function crocal_ext_shortcode_encode_urlencoded_json( $string, $encoding, $original_string ) {
    if ( 'urlencoded_json' === $encoding ) {
        $output = array();
        foreach ( $original_string as $combined_key => $value ) {
            $parts = explode( '_', $combined_key );
            $i = array_pop( $parts );
            $key = implode( '_', $parts );
            $output[ $i ][ $key ] = $value;
        }
        $string = urlencode( json_encode( $output ) );
    }
    return $string;
}
add_filter( 'wpml_pb_shortcode_encode', 'crocal_ext_shortcode_encode_urlencoded_json', 10, 3 );

function crocal_ext_shortcode_decode_urlencoded_json( $string, $encoding, $original_string ) {
    if ( 'urlencoded_json' === $encoding ) {
        $rows = json_decode( urldecode( $original_string ), true );
        $string = array();
        foreach ( $rows as $i => $row ) {
            foreach ( $row as $key => $value ) {
            if ( in_array( $key, array( 'text', 'title', 'features', 'substring', 'btn_text', 'label', 'value', 'y_values', 'infotext', 'link_text' ) ) ) {
                    $string[ $key . '_' . $i ] = array( 'value' => $value, 'translate' => true );
                } else {
                    $string[ $key . '_' . $i ] = array( 'value' => $value, 'translate' => false );
                }
            }
        }
    }
    return $string;
}
add_filter( 'wpml_pb_shortcode_decode', 'crocal_ext_shortcode_decode_urlencoded_json', 10, 3 );

//Omit closing PHP tag to avoid accidental whitespace output errors.
