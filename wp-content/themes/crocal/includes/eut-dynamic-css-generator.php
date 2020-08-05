<?php
/**
 *  Generate Dynamic css
 *  @version	1.0
 *  @author		Euthemians Team
 *  @URI		http://euthemians.com
 */

function crocal_eutf_check_css_folder() {
	$wp_upload_dir = wp_upload_dir();
	if ( wp_mkdir_p( $wp_upload_dir['basedir'] . '/eutf-dynamic' ) ) {
		return true;
	}
	return false;
}
function crocal_eutf_get_css_file_path() {
	$wp_upload_dir = wp_upload_dir();
	return sprintf( '%s/eutf-dynamic/%s.%s', $wp_upload_dir['basedir'], 'eutf-dynamic-' . crocal_eutf_get_css_file_hash(), 'css' );
}

function crocal_eutf_get_css_file_url() {
	$wp_upload_dir = wp_upload_dir();
	return sprintf( '%s/eutf-dynamic/%s.%s', $wp_upload_dir['baseurl'], 'eutf-dynamic-' . crocal_eutf_get_css_file_hash(), 'css' );
}

function crocal_eutf_get_css_file_hash() {
	$hash = get_option( 'crocal_eutf_css_hash' );
	if( !$hash ) {
		$hash = uniqid();
		update_option('crocal_eutf_css_hash' , $hash );
	}
	return $hash;
}

if ( ! function_exists( 'crocal_eutf_remove_dynamic_css_file' ) ) {
	function crocal_eutf_remove_dynamic_css_file() {
		if (  1 == crocal_eutf_option( 'css_generation' ) ) {
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();
			}
			$file_path = crocal_eutf_get_css_file_path();
			if( crocal_eutf_check_css_folder() ) {
				$wp_filesystem->delete( $file_path );
			}
			delete_option( 'crocal_eutf_css_hash' );
			crocal_eutf_generate_dynamic_css_file();
		}
	}
}

if ( ! function_exists( 'crocal_eutf_generate_dynamic_css_file' ) ) {
	function crocal_eutf_generate_dynamic_css_file(){
		if (  1 == crocal_eutf_option( 'css_generation' ) ) {
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();
			}
			$file_path = crocal_eutf_get_css_file_path();
			$styles_css = crocal_eutf_dynamic_options_css();

			if( crocal_eutf_check_css_folder() ) {
				if( $wp_filesystem->put_contents( $file_path, $styles_css, 0777 ) ){
					return true;
				}
			}
			return false;
		}
		return false;
	}
}
add_action("redux/options/crocal_eutf_options/saved", 'crocal_eutf_remove_dynamic_css_file');
add_action("redux/options/crocal_eutf_options/reset", 'crocal_eutf_remove_dynamic_css_file');
add_action("redux/options/crocal_eutf_options/section/reset", 'crocal_eutf_remove_dynamic_css_file');
add_action("redux/options/crocal_eutf_options/import", 'crocal_eutf_remove_dynamic_css_file');
add_action('customize_save_after', 'crocal_eutf_remove_dynamic_css_file', 99);
add_action( 'after_switch_theme', 'crocal_eutf_remove_dynamic_css_file' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
