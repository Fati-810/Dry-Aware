<?php

/*
*	Nav Menu Edit
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

if ( ! class_exists( 'Walker_Nav_Menu_Edit' ) ) {
	global $wp_version;
	if ( version_compare( $wp_version, '4.4', '>=' ) ) {
		require_once ABSPATH . 'wp-admin/includes/class-walker-nav-menu-edit.php';
	} else {
		require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
	}
}

class Crocal_Eutf_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $item_output = '';
        $output .= parent::start_el( $item_output, $item, $depth, $args, $id );
        $output .= preg_replace(
            // NOTE: Check this regex on major WP version updates!
            '/(?=<fieldset[^>]+class="[^"]*field-move)/',
            $this->get_custom_fields( $item, $depth, $args ),
            $item_output
        );
	}

	protected function get_custom_fields( $item, $depth, $args = array() ) {
		ob_start();
		$item_id = intval( $item->ID );
		do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );

		return ob_get_clean();
	}
} // Crocal_Eutf_Walker_Nav_Menu_Edit

function crocal_eutf_wp_nav_menu_item_custom_fields( $item_id, $item, $depth, $args ) {
?>
	<p class="eut-field-custom description description-wide">
		<label for="edit-menu-item-eut-megamenu-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Mega Menu', 'crocal' ); ?><br />
			<select class="widefat eut-menu-item-megamenu" id="edit-menu-eut-item-megamenu-<?php echo esc_attr($item_id); ?>" data-eut-menu-item data-eut-menu-name="<?php echo esc_attr( '_crocal_eutf_menu_item_megamenu_' . $item_id ); ?>">
				<option value="" <?php selected( "", $item->eut_megamenu ); ?>><?php esc_html_e( 'None', 'crocal' ); ?></option>
				<option value="2" <?php selected( "2", $item->eut_megamenu ); ?>><?php esc_html_e( '2 Columns', 'crocal' ); ?></option>
				<option value="3" <?php selected( "3", $item->eut_megamenu ); ?>><?php esc_html_e( '3 Columns', 'crocal' ); ?></option>
				<option value="4" <?php selected( "4", $item->eut_megamenu ); ?>><?php esc_html_e( '4 Columns', 'crocal' ); ?></option>
				<option value="5" <?php selected( "5", $item->eut_megamenu ); ?>><?php esc_html_e( '5 Columns', 'crocal' ); ?></option>
				<option value="6" <?php selected( "6", $item->eut_megamenu ); ?>><?php esc_html_e( '6 Columns', 'crocal' ); ?></option>
			</select>
			<span class="description"><?php esc_html_e( 'Mega Menu should be used only on first level menu items.', 'crocal' ); ?></span>
		</label>
	</p>
	<p class="eut-field-custom description description-wide">
		<label for="edit-menu-item-eut-link-mode-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Link Mode', 'crocal' ); ?><br />
			<select class="widefat" id="edit-menu-item-eut-link-mode-<?php echo esc_attr($item_id); ?>" data-eut-menu-item data-eut-menu-name="<?php echo esc_attr( '_crocal_eutf_menu_item_link_mode_' . $item_id ); ?>">
				<option value="" <?php selected( "", $item->eut_link_mode ); ?>><?php esc_html_e( 'Default', 'crocal' ); ?></option>
				<option value="no-link" <?php selected( "no-link", $item->eut_link_mode ); ?>><?php esc_html_e( 'No Link', 'crocal' ); ?></option>
				<option value="hidden" <?php selected( "hidden", $item->eut_link_mode ); ?>><?php esc_html_e( 'Hidden', 'crocal' ); ?></option>
			</select>
		</label>
	</p>
	<p class="eut-field-custom description description-wide">
		<label for="edit-menu-item-eut-link-classes-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Link CSS Classes', 'crocal' ); ?><br />
			<input type="text" id="edit-menu-item-eut-link-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code" value="<?php echo esc_attr( $item->eut_link_classes ); ?>" data-eut-menu-item data-eut-menu-name="<?php echo esc_attr( '_crocal_eutf_menu_item_link_classes_' . $item_id ); ?>"/>
		</label>
	</p>
	<p class="eut-field-custom description description-wide">
		<label for="edit-menu-item-eut-label-text-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Label Text', 'crocal' ); ?><br />
			<input id="edit-menu-item-eut-label-text-<?php echo esc_attr( $item_id ); ?>" type="text" class="widefat"  value="<?php echo esc_attr( $item->eut_label_text ); ?>" data-eut-menu-item data-eut-menu-name="<?php echo esc_attr( '_crocal_eutf_menu_item_label_text_' . $item_id ); ?>"/>
		</label>
	</p>
	<p class="eut-field-custom description description-wide">
		<label for="edit-menu-item-eut-label-color-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Label Color', 'crocal' ); ?><br />
			<select class="widefat" id="edit-menu-eut-item-label-color-<?php echo esc_attr($item_id); ?>" data-eut-menu-item data-eut-menu-name="<?php echo esc_attr( '_crocal_eutf_menu_item_label_color_' . $item_id ); ?>">
				<option value="" <?php selected( "", $item->eut_label_color ); ?>><?php esc_html_e( 'Default', 'crocal' ); ?></option>
				<?php crocal_eutf_print_media_button_color_selection( $item->eut_label_color ); ?>
			</select>
		</label>
	</p>
	<p class="eut-field-custom description description-wide">
		<label for="edit-menu-item-eut-style-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Menu item Style', 'crocal' ); ?><br />
			<select class="widefat eut-menu-item-style" id="edit-menu-eut-item-style-<?php echo esc_attr($item_id); ?>" data-eut-menu-item data-eut-menu-name="<?php echo esc_attr( '_crocal_eutf_menu_item_style_' . $item_id ); ?>">
				<option value="" <?php selected( "", $item->eut_style ); ?>><?php esc_html_e( 'Default', 'crocal' ); ?></option>
				<option value="button" <?php selected( "button", $item->eut_style ); ?>><?php esc_html_e( 'Button', 'crocal' ); ?></option>
			</select>
		</label>
	</p>
	<p class="eut-field-custom description description-wide eut-menu-item-color-container">
		<label for="edit-menu-item-eut-color-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Menu Item Color', 'crocal' ); ?><br />
			<select class="widefat" id="edit-menu-eut-item-color-<?php echo esc_attr($item_id); ?>" data-eut-menu-item data-eut-menu-name="<?php echo esc_attr( '_crocal_eutf_menu_item_color_' . $item_id ); ?>">
				<option value="" <?php selected( "", $item->eut_color ); ?>><?php esc_html_e( 'Default', 'crocal' ); ?></option>
				<?php crocal_eutf_print_media_button_color_selection( $item->eut_color ); ?>
			</select>
		</label>
	</p>
	<p class="eut-field-custom description description-wide eut-menu-item-hover-color-container">
		<label for="edit-menu-item-eut-hover-color-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Menu Item Hover color', 'crocal' ); ?><br />
			<select class="widefat" id="edit-menu-eut-item-hover-color-<?php echo esc_attr($item_id); ?>" data-eut-menu-item data-eut-menu-name="<?php echo esc_attr( '_crocal_eutf_menu_item_hover_color_' . $item_id ); ?>">
				<option value="" <?php selected( "", $item->eut_hover_color ); ?>><?php esc_html_e( 'Default', 'crocal' ); ?></option>
				<?php crocal_eutf_print_media_button_color_selection( $item->eut_hover_color ); ?>
			</select>
		</label>
	</p>
	<?php
		global $crocal_eutf_awsome_fonts_list;
	?>
	<p class="eut-field-custom description description-wide">
		<label for="edit-menu-item-eut-icon-fontawesome-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'Icon', 'crocal' ); ?><br />
			<select class="widefat" id="edit-menu-item-eut-icon-fontawesome-<?php echo esc_attr($item_id); ?>" data-eut-menu-item data-eut-menu-name="<?php echo esc_attr( '_crocal_eutf_menu_item_icon_fontawesome_' . $item_id ); ?>">
				<option value="" <?php selected( "", $item->eut_icon_fontawesome ); ?>><?php esc_html_e( 'None', 'crocal' ); ?></option>
			<?php
				$icons_array = $crocal_eutf_awsome_fonts_list;
				foreach ($icons_array as $icon) {
			?>
					<option value="fa fa-<?php echo esc_attr( $icon ); ?>" <?php selected( $item->eut_icon_fontawesome, 'fa fa-' . $icon ); ?>><?php echo esc_html( $icon ); ?></option>
			<?php
				}
			?>
			</select>
		</label>
	</p>
<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'crocal_eutf_wp_nav_menu_item_custom_fields', 10, 4 );

//Omit closing PHP tag to avoid accidental whitespace output errors.
