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

$crocal_eutf_custom_sidebars = get_option( '_crocal_eutf_custom_sidebars' );
?>
	<div id="eut-sidebar-wrap" class="wrap">
		<h2><?php esc_html_e( "Sidebars", 'crocal' ); ?></h2>
		<?php crocal_eutf_print_admin_links('sidebars'); ?>
		<br/>
		<?php if( isset( $_GET['sidebar-settings'] ) ) { ?>
		<div class="eut-sidebar-saved updated inline eut-notice-green">
			<p><strong><?php esc_html_e('Settings Saved!', 'crocal' ); ?></strong></p>
		</div>
		<?php } ?>
		<div class="eut-sidebar-changed updated inline eut-notice-green">
			<p><strong><?php esc_html_e('Settings have changed, you should save them!', 'crocal' ); ?></strong></p>
		</div>
		<form method="post" action="admin.php?page=crocal-sidebars">
			<table class="eut-sidebar-table widefat" cellspacing="0">
				<thead>
					<tr>
						<th>
							<input type="button" id="eut-add-custom-sidebar-item" class="button button-primary" value="<?php esc_html_e('Add Sidebar', 'crocal' ); ?>"/>
							<span class="eut-sidebar-spinner"></span>
						</th>
						<th>
							<input type="text" class="eut-sidebar-text" id="eut-custom-sidebar-item-name-new" value=""/>
							<div class="eut-sidebar-notice eut-notice-red">
								<strong><?php esc_html_e('Field must not be empty!', 'crocal' ); ?></strong>
							</div>
							<div class="eut-sidebar-notice-exists eut-notice-red">
								<strong><?php esc_html_e('Sidebar with this name already exists!', 'crocal' ); ?></strong>
							</div>
						</th>
					</tr>
				</thead>
				<tbody id="eut-custom-sidebar-container">
					<?php crocal_eutf_print_admin_custom_sidebars( $crocal_eutf_custom_sidebars ); ?>
				</tbody>
				<tfoot>
					<tr>
						<td><?php submit_button(); ?></td>
						<td>&nbsp;</td>
					</tr>
				</tfoot>
			</table>
			<?php wp_nonce_field( 'crocal_eutf_nonce_sidebar_save', '_crocal_eutf_nonce_sidebar_save' ); ?>

		</form>
	</div>
<?php


//Omit closing PHP tag to avoid accidental whitespace output errors.
