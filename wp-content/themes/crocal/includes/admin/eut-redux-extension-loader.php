<?php
/**
 * Euthemians Redux Extension Loader
 * @version	1.0
 * @author		Euthemians Team
 * @URI		http://euthemians.com
 * */

if(!function_exists('crocal_eutf_redux_register_custom_extension_loader')) :
    function crocal_eutf_redux_register_custom_extension_loader($ReduxFramework) {
        $path = get_template_directory() . '/includes/admin/extensions/';
            $folders = scandir( $path, 1 );
            foreach ( $folders as $folder ) {
                if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
                    continue;
                }
                $extension_class = 'ReduxFramework_Extension_' . $folder;
                if ( ! class_exists( $extension_class ) ) {
                    $class_file = $path . $folder . '/extension_' . $folder . '.php';
                    $class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
                    if ( $class_file ) {
                        require_once $class_file;
                    }
                }
                if ( ! isset( $ReduxFramework->extensions[ $folder ] ) ) {
                    $ReduxFramework->extensions[ $folder ] = new $extension_class( $ReduxFramework );
                }
            }
    }
    add_action("redux/extensions/crocal_eutf_options/before", 'crocal_eutf_redux_register_custom_extension_loader', 0);
	add_action("redux/extensions/um_options/before", 'crocal_eutf_redux_register_custom_extension_loader', 0);
endif;

function crocal_eutf_redux_scripts() {
	if ( !wp_script_is( 'select2-js', 'registered' ) ) {
		wp_register_script( 'select2-js', get_template_directory_uri() . '/includes/admin/extensions/vendor_support/vendor/select2/select2.js', array( 'jquery', 'redux-select2-sortable-js' ), time(), true );
		wp_enqueue_style( 'select2-css', get_template_directory_uri() . '/includes/admin/extensions/vendor_support/vendor/select2/select2.css', array(), time(), 'all' );
	}
}
add_action( "redux/page/crocal_eutf_options/enqueue", 'crocal_eutf_redux_scripts' );

function crocal_eutf_cdn_fix( $args ) {
	$args['use_cdn'] = false;
	return $args;
}
add_filter("redux/options/um_options/args", 'crocal_eutf_cdn_fix', 11 );

//Omit closing PHP tag to avoid accidental whitespace output errors.
