<?php
/*
*	Admin Functions
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function crocal_ext_admin_menu(){
	if ( current_user_can( 'edit_theme_options' ) ) {
		if ( function_exists( 'crocal_eutf_info') ) {
			add_submenu_page( 'crocal', esc_html__('Custom Codes','crocal-extension'), esc_html__('Custom Codes','crocal-extension'), 'edit_theme_options', 'crocal-codes', 'crocal_ext_admin_page_html_codes' );
		} else {
			add_menu_page( 'Crocal', 'Crocal', 'edit_theme_options', 'crocal', 'crocal_ext_admin_page_html_codes', CROCAL_EXT_PLUGIN_DIR_URL .'assets/images/adminmenu/theme.png', 4 );
			add_submenu_page( 'crocal', esc_html__('Custom Codes','crocal-extension'), esc_html__('Custom Codes','crocal-extension'), 'edit_theme_options', 'crocal-codes', 'crocal_ext_admin_page_html_codes' );
		}
	}
}
add_action( 'admin_menu', 'crocal_ext_admin_menu', 11 );


function crocal_ext_admin_page_html_codes(){
	require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'includes/admin/crocal-ext-admin-page-codes.php';
}

function crocal_ext_admin_links( $active_tab = 'status' ){
?>
	<a href="?page=crocal-codes" class="nav-tab <?php echo 'codes' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Custom Codes','crocal-extension'); ?></a>
<?php
}
add_action( 'crocal_eutf_admin_links', 'crocal_ext_admin_links' );

function crocal_ext_add_settings() {

	if ( isset( $_POST['_crocal_ext_options_nonce_save'] ) && wp_verify_nonce( $_POST['_crocal_ext_options_nonce_save'], 'crocal_ext_options_nonce_save' ) ) {

		if ( isset( $_POST['crocal_eutf_ext_options'] ) ) {
			$options = get_option('crocal_eutf_ext_options');

			$keys = array_keys( $_POST['crocal_eutf_ext_options'] );
			foreach ( $keys as $key ) {
				if ( isset( $_POST['crocal_eutf_ext_options'][$key] ) ) {
					$options[$key] = $_POST['crocal_eutf_ext_options'][$key];
				}
			}
			if ( empty( $options ) ) {
				delete_option( 'crocal_eutf_ext_options' );
			} else {
				update_option( 'crocal_eutf_ext_options', $options );
			}
		}
		wp_safe_redirect( 'admin.php?page=crocal-codes&ext-settings=saved' );
	}
}
add_action( 'admin_menu', 'crocal_ext_add_settings' );



if ( !function_exists('crocal_ext_print_head_code') ) {
	function crocal_ext_print_head_code() {
		$options = get_option('crocal_eutf_ext_options');
		$code = crocal_ext_vce_array_value( $options, 'head_code' );
		if ( !empty( $code ) ) {
			echo wp_unslash( $code );
		}
	}
}
add_action('wp_head', 'crocal_ext_print_head_code');

if ( !function_exists('crocal_ext_print_body_code') ) {
	function crocal_ext_print_body_code() {
		$options = get_option('crocal_eutf_ext_options');
		$code = crocal_ext_vce_array_value( $options, 'body_code' );
		if ( !empty( $code ) ) {
			echo wp_unslash( $code );
		}
	}
}
add_action('crocal_eutf_body_top', 'crocal_ext_print_body_code');


if ( !function_exists('crocal_ext_print_footer_code') ) {
	function crocal_ext_print_footer_code() {
		$options = get_option('crocal_eutf_ext_options');
		$code = crocal_ext_vce_array_value( $options, 'footer_code' );
		if ( !empty( $code ) ) {
			echo wp_unslash( $code );
		}
	}
}
add_action('wp_footer', 'crocal_ext_print_footer_code');

//Omit closing PHP tag to avoid accidental whitespace output errors.
