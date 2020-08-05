<?php

/*
*	Admin functions and definitions
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

/**
 * Default hidden metaboxes for portfolio
 */
function crocal_eutf_change_default_hidden( $hidden, $screen ) {
    if ( 'portfolio' == $screen->id ) {
        $hidden = array_flip( $hidden );
        unset( $hidden['portfolio_categorydiv'] ); //show portfolio category box
        $hidden = array_flip( $hidden );
        $hidden[] = 'postexcerpt';
		$hidden[] = 'postcustom';
		$hidden[] = 'commentstatusdiv';
		$hidden[] = 'commentsdiv';
		$hidden[] = 'authordiv';
    }
    return $hidden;
}
add_filter( 'default_hidden_meta_boxes', 'crocal_eutf_change_default_hidden', 10, 2 );

/**
 * Enqueue scripts and styles for the back end.
 */
function crocal_eutf_backend_scripts( $hook ) {
	global $post, $pagenow;

	wp_register_style( 'crocal-eutf-page-feature-section', get_template_directory_uri() . '/includes/css/eut-page-feature-section.css', array(), '1.0' );
	wp_register_style( 'crocal-eutf-admin-meta', get_template_directory_uri() . '/includes/css/eut-admin-meta.css', array(), '1.0' );
	wp_register_style( 'crocal-eutf-custom-sidebars', get_template_directory_uri() . '/includes/css/eut-custom-sidebars.css', array(), '1.0'  );
	wp_register_style( 'crocal-eutf-status', get_template_directory_uri() . '/includes/css/eut-status.css', array(), '1.0'  );
	wp_register_style( 'crocal-eutf-admin-panel', get_template_directory_uri() . '/includes/css/eut-admin-panel.css', array(), '1.0'  );

	wp_register_style( 'crocal-eutf-custom-nav-menu', get_template_directory_uri() . '/includes/css/eut-custom-nav-menu.css', array(), '1.1'  );

	$crocal_eutf_upload_slider_texts = array(
		'modal_title' => esc_html__( 'Insert Images', 'crocal' ),
		'modal_button_title' => esc_html__( 'Insert Images', 'crocal' ),
		'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
		'nonce_feature_slider_media' => wp_create_nonce( 'crocal-eutf-get-feature-slider-media' ),
		'nonce_slider_media' => wp_create_nonce( 'crocal-eutf-get-slider-media' ),
	);

	$crocal_eutf_upload_image_replace_texts = array(
		'modal_title' => esc_html__( 'Replace Image', 'crocal' ),
		'modal_button_title' => esc_html__( 'Replace Image', 'crocal' ),
		'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
		'nonce_replace' => wp_create_nonce( 'crocal-eutf-get-replaced-image' ),
	);

	$crocal_eutf_upload_media_texts = array(
		'modal_title' => esc_html__( 'Insert Media', 'crocal' ),
		'modal_button_title' => esc_html__( 'Insert Media', 'crocal' ),
	);

	$crocal_eutf_feature_section_texts = array(
		'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
		'nonce_map_point' => wp_create_nonce( 'crocal-eutf-get-map-point' ),
	);

	$crocal_eutf_custom_sidebar_texts = array(
		'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
		'nonce_custom_sidebar' => wp_create_nonce( 'crocal-eutf-get-custom-sidebar' ),
	);

	wp_register_script( 'crocal-eutf-status', get_template_directory_uri() . '/includes/js/eut-status.js', array( 'jquery'), time(), false );
	wp_register_script( 'crocal-eutf-codes-script', get_template_directory_uri().'/includes/js/eut-codes.js', array( 'jquery'), time(), false );

	wp_register_script( 'crocal-eutf-custom-sidebars', get_template_directory_uri() . '/includes/js/eut-custom-sidebars.js', array( 'jquery'), time(), false );
	wp_localize_script( 'crocal-eutf-custom-sidebars', 'crocal_eutf_custom_sidebar_texts', $crocal_eutf_custom_sidebar_texts );

	wp_register_script( 'crocal-eutf-upload-slider-script', get_template_directory_uri() . '/includes/js/eut-upload-slider.js', array( 'jquery'), time(), false );
	wp_localize_script( 'crocal-eutf-upload-slider-script', 'crocal_eutf_upload_slider_texts', $crocal_eutf_upload_slider_texts );

	wp_register_script( 'crocal-eutf-upload-feature-slider-script', get_template_directory_uri() . '/includes/js/eut-upload-feature-slider.js', array( 'jquery'), time(), false );
	wp_localize_script( 'crocal-eutf-upload-feature-slider-script', 'crocal_eutf_upload_feature_slider_texts', $crocal_eutf_upload_slider_texts );

	wp_register_script( 'crocal-eutf-upload-image-replace-script', get_template_directory_uri() . '/includes/js/eut-upload-image-replace.js', array( 'jquery'), time(), false );
	wp_localize_script( 'crocal-eutf-upload-image-replace-script', 'crocal_eutf_upload_image_replace_texts', $crocal_eutf_upload_image_replace_texts );

	wp_register_script( 'crocal-eutf-upload-simple-media-script', get_template_directory_uri() . '/includes/js/eut-upload-simple.js', array( 'jquery'), time(), false );
	wp_localize_script( 'crocal-eutf-upload-simple-media-script', 'crocal_eutf_upload_media_texts', $crocal_eutf_upload_media_texts );

	wp_register_script( 'crocal-eutf-page-feature-section-script', get_template_directory_uri() . '/includes/js/eut-page-feature-section.js', array( 'jquery', 'wp-color-picker' ), time(), false );
	wp_localize_script( 'crocal-eutf-page-feature-section-script', 'crocal_eutf_feature_section_texts', $crocal_eutf_feature_section_texts );

	wp_register_script( 'crocal-eutf-post-options-script', get_template_directory_uri() . '/includes/js/eut-post-options.js', array( 'jquery'), time(), false );
	wp_register_script( 'crocal-eutf-portfolio-options-script', get_template_directory_uri() . '/includes/js/eut-portfolio-options.js', array( 'jquery'), time(), false );

	wp_register_script( 'crocal-eutf-custom-nav-menu-script', get_template_directory_uri().'/includes/js/eut-custom-nav-menu.js', array( 'jquery'), time(), false );


	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {

		$feature_section_post_types = crocal_eutf_option( 'feature_section_post_types' );

		if ( !empty( $feature_section_post_types ) && in_array( $post->post_type, $feature_section_post_types ) && 'attachment' != $post->post_type ) {

			wp_enqueue_style( 'crocal-eutf-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'crocal-eutf-page-feature-section' );

			wp_enqueue_script( 'crocal-eutf-upload-simple-media-script' );
			wp_enqueue_script( 'crocal-eutf-upload-slider-script' );
			wp_enqueue_script( 'crocal-eutf-upload-feature-slider-script' );
			wp_enqueue_script( 'crocal-eutf-upload-image-replace-script' );
			wp_enqueue_script( 'crocal-eutf-page-feature-section-script' );
		}


        if ( 'post' === $post->post_type ) {

			wp_enqueue_style( 'crocal-eutf-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'crocal-eutf-page-feature-section' );

			wp_enqueue_script( 'crocal-eutf-upload-simple-media-script' );
			wp_enqueue_script( 'crocal-eutf-upload-slider-script' );
			wp_enqueue_script( 'crocal-eutf-upload-feature-slider-script' );
			wp_enqueue_script( 'crocal-eutf-upload-image-replace-script' );
			wp_enqueue_script( 'crocal-eutf-page-feature-section-script' );
			wp_enqueue_script( 'crocal-eutf-post-options-script' );

        } else if ( 'page' === $post->post_type || 'portfolio' === $post->post_type || 'product' === $post->post_type || 'tribe_events' === $post->post_type ) {

			wp_enqueue_style( 'crocal-eutf-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'crocal-eutf-page-feature-section' );

			wp_enqueue_script( 'crocal-eutf-upload-simple-media-script' );
			wp_enqueue_script( 'crocal-eutf-upload-slider-script' );
			wp_enqueue_script( 'crocal-eutf-upload-feature-slider-script' );
			wp_enqueue_script( 'crocal-eutf-upload-image-replace-script' );
			wp_enqueue_script( 'crocal-eutf-page-feature-section-script' );

			wp_enqueue_script( 'crocal-eutf-portfolio-options-script' );

        } else if ( 'testimonial' === $post->post_type ) {

			wp_enqueue_style( 'crocal-eutf-admin-meta' );

        }
    }

	if ( $hook == 'edit-tags.php' || $hook == 'term.php') {
		wp_enqueue_style( 'crocal-eutf-admin-meta' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'crocal-eutf-page-feature-section' );


		wp_enqueue_media();
		wp_enqueue_script( 'crocal-eutf-page-feature-section-script' );
		wp_enqueue_script( 'crocal-eutf-upload-image-replace-script' );

	}

	if ( $hook == 'nav-menus.php' ) {
		wp_enqueue_style( 'crocal-eutf-custom-nav-menu' );

		wp_enqueue_media();
		wp_enqueue_script( 'crocal-eutf-upload-simple-media-script' );
		wp_enqueue_script( 'crocal-eutf-custom-nav-menu-script' );
	}

	//Admin Screens
	if ( isset( $_GET['page'] ) && ( 'crocal' == $_GET['page'] ) ) {
		wp_enqueue_style( 'crocal-eutf-admin-panel' );
	}
	if ( isset( $_GET['page'] ) && ( 'crocal-sidebars' == $_GET['page'] ) ) {
		wp_enqueue_style( 'crocal-eutf-custom-sidebars' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'crocal-eutf-custom-sidebars' );
	}
	if ( isset( $_GET['page'] ) && ( 'crocal-status' == $_GET['page'] ) ) {
		wp_enqueue_style( 'crocal-eutf-status' );
		wp_enqueue_script( 'crocal-eutf-status' );
	}
	if ( isset( $_GET['page'] ) && ( 'crocal-import' == $_GET['page'] ) ) {
		wp_enqueue_style( 'crocal-eutf-admin-panel' );
	}

	if ( isset( $_GET['page'] ) && ( 'crocal-codes' == $_GET['page'] ) ) {
		wp_enqueue_style( 'crocal-eutf-admin-panel' );
		wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
		wp_enqueue_script( 'crocal-eutf-codes-script' );
	}

	wp_enqueue_style(
		'redux-custom-css',
		get_template_directory_uri() . '/includes/css/eut-redux-panel.css',
		array(),
		time(),
		'all'
	);

}
add_action( 'admin_enqueue_scripts', 'crocal_eutf_backend_scripts', 10, 1 );

/**
 * Helper function to get custom fields with fallback
 */
function crocal_eutf_post_meta( $id, $fallback = false ) {
	global $post;
	$post_id = $post->ID;
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

function crocal_eutf_admin_post_meta( $post_id, $id, $fallback = false ) {
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

function crocal_eutf_get_term_meta( $term_id, $meta_key ) {
	$crocal_eutf_term_meta  = '';

	if ( function_exists( 'get_term_meta' ) ) {
		$crocal_eutf_term_meta = get_term_meta( $term_id, $meta_key, true );
	}
	if( empty ( $crocal_eutf_term_meta ) ) {
		$crocal_eutf_term_meta = array();
	}
	return $crocal_eutf_term_meta;
}

function crocal_eutf_update_term_meta( $term_id , $meta_key, $meta_value ) {

	if ( function_exists( 'update_term_meta' ) ) {
		update_term_meta( $term_id, $meta_key, $meta_value );
	}

}

/**
 * Helper function to get theme options with fallback
 */
function crocal_eutf_option( $id, $fallback = false, $param = false ) {
	global $crocal_eutf_options;
	$eut_theme_options = $crocal_eutf_options;

	if ( $fallback == false ) $fallback = '';
	$output = ( isset($eut_theme_options[$id]) && $eut_theme_options[$id] !== '' ) ? $eut_theme_options[$id] : $fallback;
	if ( !empty($eut_theme_options[$id]) && $param ) {
		$output = ( isset($eut_theme_options[$id][$param]) && $eut_theme_options[$id][$param] !== '' ) ? $eut_theme_options[$id][$param] : $fallback;
		if ( 'font-family' == $param ) {
			$output = urldecode( $output );
			if ( strpos($output, ' ') && !strpos($output, ',') ) {
				$output = '"' . $output . '"';
			}
		}
	}
	return $output;
}

/**
 * Helper function to print css code if not empty
 */
function crocal_eutf_css_option( $id, $fallback = false, $param = false ) {
	$option = crocal_eutf_option( $id, $fallback, $param );
	if ( !empty( $option ) && 0 !== $option && $param ) {
		return $param . ': ' . $option . ';';
	}
}

/**
 * Helper function to get array value with fallback
 */
function crocal_eutf_array_value( $input_array, $id, $fallback = false, $param = false ) {

	if ( $fallback == false ) $fallback = '';
	$output = ( isset($input_array[$id]) && $input_array[$id] !== '' ) ? $input_array[$id] : $fallback;
	if ( !empty($input_array[$id]) && $param ) {
		$output = ( isset($input_array[$id][$param]) && $input_array[$id][$param] !== '' ) ? $input_array[$id][$param] : $fallback;
	}
	return $output;
}

/**
 * Helper function to return trimmed css code
 */
if ( ! function_exists( 'crocal_eutf_compress_css' ) ) {
	function crocal_eutf_compress_css( $css ) {
		$css_trim =  preg_replace( '/\s+/', ' ', $css );
		return $css_trim;
	}
}

/**
 * Helper function to get css template code
 */
function crocal_eutf_get_css_template( $template_name = '' ) {
	ob_start();
	get_template_part( '/includes/css-templates/' . $template_name );
	return ob_get_clean();
}

/**
 * Helper functions to set/get current template
 */
function crocal_eutf_set_current_view( $id ) {
	global $crocal_eutf_options;
	$crocal_eutf_options['current_view'] = $id;
}
function crocal_eutf_get_current_view( $fallback = '' ) {
	global $crocal_eutf_options;
	$crocal_eutf_theme_options = $crocal_eutf_options;

	if ( $fallback == false ) $fallback = '';
	$output = ( isset($crocal_eutf_theme_options['current_view']) && $crocal_eutf_theme_options['current_view'] !== '' ) ? $crocal_eutf_theme_options['current_view'] : $fallback;
	return $output;
}

/**
 * Helper function convert hex to rgb
 */
function crocal_eutf_hex2rgb( $hex ) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1) );
		$g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1) );
		$b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1) );
	} else {
		$r = hexdec( substr( $hex, 0, 2) );
		$g = hexdec( substr( $hex, 2, 2) );
		$b = hexdec( substr( $hex, 4, 2) );
	}
	$rgb = array($r, $g, $b);
	return implode(",", $rgb);
}

/**
 * Helper function to get theme visibility options
 */
function crocal_eutf_visibility( $id, $fallback = '' ) {
	$visibility = crocal_eutf_option( $id, $fallback  );
	if ( '1' == $visibility ) {
		return true;
	}
	return false;
}

/**
 * Get Color
 */
function crocal_eutf_get_color( $color = 'dark', $color_custom = '#000000' ) {

	switch( $color ) {

		case 'none':
		case 'transparent':
			$color_custom = 'transparent';
			break;
		case 'dark':
			$color_custom = '#000000';
			break;
		case 'light':
			$color_custom = '#ffffff';
			break;
		case 'primary-1':
			$color_custom = crocal_eutf_option( 'body_primary_1_color' );
			break;
		case 'primary-2':
			$color_custom = crocal_eutf_option( 'body_primary_2_color' );
			break;
		case 'primary-3':
			$color_custom = crocal_eutf_option( 'body_primary_3_color' );
			break;
		case 'primary-4':
			$color_custom = crocal_eutf_option( 'body_primary_4_color' );
			break;
		case 'primary-5':
			$color_custom = crocal_eutf_option( 'body_primary_5_color' );
			break;
		case 'primary-6':
			$color_custom = crocal_eutf_option( 'body_primary_6_color' );
			break;
	}

	return $color_custom;
}

/**
 * Backend Theme Activation Actions
 */
function crocal_eutf_backend_theme_activation() {
	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
		//Redirect to Welcome
		header( 'Location: ' . esc_url( admin_url() ) . 'admin.php?page=crocal' ) ;
	}
}

add_action('admin_init','crocal_eutf_backend_theme_activation');

/**
 * Check if Revolution slider is active
 */

/**
 * Check if to replace Backend Logo
 */
function crocal_eutf_admin_login_logo() {
	$replace_logo = crocal_eutf_option( 'replace_admin_logo' );
	if ( $replace_logo ) {
		$admin_logo = crocal_eutf_option( 'admin_logo','','url' );
		$admin_logo_height = crocal_eutf_option( 'admin_logo_height','84');
		$admin_logo_height = preg_match('/(px|em|\%|pt|cm)$/', $admin_logo_height) ? $admin_logo_height : $admin_logo_height . 'px';
		if( empty( $admin_logo ) ) {
			$admin_logo = crocal_eutf_option( 'logo','','url' );
		}
		if ( !empty( $admin_logo ) ) {
			$admin_logo = str_replace( array( 'http:', 'https:' ), '', $admin_logo );
			echo "
			<style>
			.login h1 a {
				background-image: url('" . esc_url( $admin_logo ) . "');
				width: 100%;
				max-width: 300px;
				background-size: auto " . esc_attr( $admin_logo_height ) . ";
				height: " . esc_attr( $admin_logo_height ) . ";
			}
			</style>
			";
		}
	}

}
add_action( 'login_head', 'crocal_eutf_admin_login_logo' );

function crocal_eutf_login_headerurl( $url ){
	$replace_logo = crocal_eutf_option( 'replace_admin_logo' );
	if ( $replace_logo ) {
		return esc_url( home_url( '/' ) );
	}
	return esc_url( $url );
}
add_filter('login_headerurl', 'crocal_eutf_login_headerurl');

function crocal_eutf_login_headertitle( $title ) {
	$replace_logo = crocal_eutf_option( 'replace_admin_logo' );
	if ( $replace_logo ) {
		return esc_attr( get_bloginfo( 'name' ) );
	}
	return esc_attr( $title );
}
add_filter('login_headertext', 'crocal_eutf_login_headertitle' );

/**
 * Scroll Check
 */
if ( ! function_exists( 'crocal_eutf_scroll_check' ) ) {
	function crocal_eutf_scroll_check() {
		$scrolling_speed = crocal_eutf_option( 'scrolling_speed', 'normal' );
		if ( 'disabled' == $scrolling_speed ) {
			return false;
		} else {
			return crocal_eutf_browser_webkit_check();
		}
	}
}

/**
 * Browser Webkit Check
 */
if ( ! function_exists( 'crocal_eutf_browser_webkit_check' ) ) {
	function crocal_eutf_browser_webkit_check() {
		if ( function_exists( 'crocal_ext_browser_webkit_check' ) ) {
			return crocal_ext_browser_webkit_check();
		} else {
			return false;
		}
	}
}

/**
 * Add Hooks for Page Redirect ( Coming Soon )
 */
add_filter( 'template_include', 'crocal_eutf_redirect_page_template', 99 );

if ( ! function_exists( 'crocal_eutf_redirect_page_template' ) ) {
	function crocal_eutf_redirect_page_template( $template ) {
		if ( crocal_eutf_visibility('coming_soon_enabled' )  && !is_user_logged_in() ) {
			$redirect_page = crocal_eutf_option( 'coming_soon_page' );
			$redirect_template = crocal_eutf_option( 'coming_soon_template' );
			if ( !empty( $redirect_page ) && 'content' == $redirect_template ) {
				$new_template = get_template_directory() . '/page-templates/template-content-only.php';
				return $new_template ;
			}
		}
		return $template;
	}
}

add_filter( 'template_redirect', 'crocal_eutf_redirect' );

if ( ! function_exists( 'crocal_eutf_redirect' ) ) {
	function crocal_eutf_redirect() {
		if ( crocal_eutf_visibility('coming_soon_enabled' ) && !is_user_logged_in() ) {
			$redirect_page = crocal_eutf_option( 'coming_soon_page' );
			if ( !empty( $redirect_page )
				&& !in_array( $GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php') )
				&& !is_admin()
				&& !is_page( $redirect_page ) ) {
				wp_redirect( get_permalink( $redirect_page ) );
				exit();

			}
		}
		return false;
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
