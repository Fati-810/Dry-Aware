<?php
/*
*	Admin Custom Sidebars
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $_POST['_crocal_eutf_nonce_sidebar_save'] ) && wp_verify_nonce( $_POST['_crocal_eutf_nonce_sidebar_save'], 'crocal_eutf_nonce_sidebar_save' ) ) {
	$sidebars_items = array();
	if( isset( $_POST['_crocal_eutf_custom_sidebar_item_id'] ) ) {
		$num_of_sidebars = sizeof( $_POST['_crocal_eutf_custom_sidebar_item_id'] );
		for ( $i=0; $i < $num_of_sidebars; $i++ ) {
			$this_sidebar = array (
				'id' => sanitize_text_field( $_POST['_crocal_eutf_custom_sidebar_item_id'][ $i ] ),
				'name' => sanitize_text_field( $_POST['_crocal_eutf_custom_sidebar_item_name'][ $i ] ),
			);
			array_push( $sidebars_items, $this_sidebar );
		}
	}
	if ( empty( $sidebars_items ) ) {
		delete_option( '_crocal_eutf_custom_sidebars' );
	} else {
		update_option( '_crocal_eutf_custom_sidebars', $sidebars_items );
	}
	//Update Sidebar list
	wp_get_sidebars_widgets();
	wp_safe_redirect( 'admin.php?page=crocal-sidebars&sidebar-settings=saved' );

}

function  crocal_eutf_print_admin_custom_sidebars( $crocal_eutf_custom_sidebars ) {
	crocal_eutf_print_admin_empty_custom_sidebar();
	if ( ! empty( $crocal_eutf_custom_sidebars ) ) {
		foreach ( $crocal_eutf_custom_sidebars as $crocal_eutf_custom_sidebar ) {
			crocal_eutf_print_admin_single_custom_sidebar( $crocal_eutf_custom_sidebar );
		}
	}
}

function  crocal_eutf_print_admin_empty_custom_sidebar() {
?>
	<tr class="eut-custom-sidebar-item eut-custom-sidebar-empty">
		<td>&nbsp;</td>
		<td>
			<h4 class="eut-custom-sidebar-title">
				<span><?php esc_html_e('No Sidebars added yet!', 'crocal' ); ?></span>
			</h4>
		</td>
	</tr>
<?php

}

function  crocal_eutf_print_admin_single_custom_sidebar( $sidebar_item, $mode = '' ) {

	$crocal_eutf_button_class = "eut-custom-sidebar-item-delete-button";
	$sidebar_item_id = uniqid('crocal_eutf_sidebar_');

	if( $mode = "new" ) {
		$crocal_eutf_button_class = "eut-custom-sidebar-item-delete-button eut-item-new";
	}
?>

	<tr class="eut-custom-sidebar-item eut-custom-sidebar-normal">
		<td>
			<input class="<?php echo esc_attr( $crocal_eutf_button_class ); ?> button" type="button" value="<?php esc_attr_e('Delete', 'crocal' ); ?>">
		</td>
		<td>
			<h4 class="eut-custom-sidebar-title">
				<span><?php esc_html_e('Custom Sidebar', 'crocal' ); ?>: <?php echo crocal_eutf_array_value( $sidebar_item, 'name' ); ?></span>
			</h4>
			<div class="eut-custom-sidebar-settings">
				<input type="hidden" name="_crocal_eutf_custom_sidebar_item_id[]" value="<?php echo crocal_eutf_array_value( $sidebar_item, 'id', $sidebar_item_id ); ?>">
				<input type="hidden" class="eut-custom-sidebar-item-name" name="_crocal_eutf_custom_sidebar_item_name[]" value="<?php echo crocal_eutf_array_value( $sidebar_item, 'name' ); ?>"/>
			</div>
		</td>
	</tr>


<?php

}

add_action( 'wp_ajax_crocal_eutf_get_custom_sidebar', 'crocal_eutf_get_custom_sidebar' );

function crocal_eutf_get_custom_sidebar() {
	
	check_ajax_referer( 'crocal-eutf-get-custom-sidebar', '_eutf_nonce' );

	if( isset( $_POST['sidebar_name'] ) ) {

		$sidebar_item_name = sanitize_text_field( $_POST['sidebar_name'] );
		$sidebar_item_id = uniqid('crocal_eutf_sidebar_');
		if( empty( $sidebar_item_name ) ) {
			$sidebar_item_name = $sidebar_item_id;
		}

		$this_sidebar = array (
			'id' => $sidebar_item_id,
			'name' => $sidebar_item_name,
		);

		crocal_eutf_print_admin_single_custom_sidebar( $this_sidebar, 'new' );
	}
	die();

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
