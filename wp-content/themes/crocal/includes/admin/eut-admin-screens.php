<?php

/*
*	Admin screen functions
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

function crocal_eutf_admin_menu(){
	if ( current_user_can( 'edit_theme_options' ) ) {
		add_menu_page( 'Crocal', 'Crocal', 'edit_theme_options', 'crocal', 'crocal_eutf_admin_page_welcome', get_template_directory_uri() .'/includes/images/adminmenu/theme.png', 4 );
		add_submenu_page( 'crocal', esc_html__('Welcome','crocal'), esc_html__('Welcome','crocal'), 'edit_theme_options', 'crocal', 'crocal_eutf_admin_page_welcome' );
		add_submenu_page( 'crocal', esc_html__('Status','crocal'), esc_html__('Status','crocal'), 'edit_theme_options', 'crocal-status', 'crocal_eutf_admin_page_status' );
		add_submenu_page( 'crocal', esc_html__( 'Custom Sidebars', 'crocal' ), esc_html__( 'Custom Sidebars', 'crocal' ), 'edit_theme_options','crocal-sidebars','crocal_eutf_admin_page_sidebars');
		add_submenu_page( 'crocal', esc_html__( 'Import Demos', 'crocal' ), esc_html__( 'Import Demos', 'crocal' ), 'edit_theme_options','crocal-import','crocal_eutf_admin_page_import');
	}
}

add_action( 'admin_menu', 'crocal_eutf_admin_menu' );


function crocal_eutf_tgmpa_plugins_links(){
	crocal_eutf_print_admin_links('plugins');
}
add_action( 'crocal_eutf_before_tgmpa_plugins', 'crocal_eutf_tgmpa_plugins_links' );

function crocal_eutf_admin_page_welcome(){
	require_once get_template_directory() . '/includes/admin/pages/eut-admin-page-welcome.php';
}
function crocal_eutf_admin_page_status(){
	require_once get_template_directory() . '/includes/admin/pages/eut-admin-page-status.php';
}
function crocal_eutf_admin_page_sidebars(){
	require_once get_template_directory() . '/includes/admin/pages/eut-admin-page-sidebars.php';
}
function crocal_eutf_admin_page_import(){
	require_once get_template_directory() . '/includes/admin/pages/eut-admin-page-import.php';
}

function crocal_eutf_print_admin_links( $active_tab = 'status' ) {
?>
<h2 class="nav-tab-wrapper">
	<a href="?page=crocal" class="nav-tab <?php echo 'welcome' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Welcome','crocal'); ?></a>
	<a href="?page=crocal-status" class="nav-tab <?php echo 'status' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Status','crocal'); ?></a>
	<a href="?page=crocal-sidebars" class="nav-tab <?php echo 'sidebars' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Custom Sidebars','crocal'); ?></a>
	<a href="?page=crocal-import" class="nav-tab <?php echo 'import' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Import Demos','crocal'); ?></a>
	<a href="?page=crocal-tgmpa-install-plugins" class="nav-tab <?php echo 'plugins' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Theme Plugins','crocal'); ?></a>
	<?php do_action( 'crocal_eutf_admin_links', $active_tab ); ?>
</h2>
<?php
}

//Omit closing PHP tag to avoid accidental whitespace output errors.