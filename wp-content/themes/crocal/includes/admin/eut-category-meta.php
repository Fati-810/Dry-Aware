<?php
/*
*	'crocal' Category Meta
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

	//Categories
	add_action('category_edit_form_fields','crocal_eutf_category_edit_form_fields', 10);
	add_action('post_tag_edit_form_fields','crocal_eutf_category_edit_form_fields', 10);
	add_action('product_cat_edit_form_fields','crocal_eutf_category_edit_form_fields', 10);
	add_action('product_tag_edit_form_fields','crocal_eutf_category_edit_form_fields', 10);
	add_action('edit_term','crocal_eutf_save_category_fields', 10, 3);

	function crocal_eutf_category_edit_form_fields( $term ) {
		$crocal_eutf_term_meta = crocal_eutf_get_term_meta( $term->term_id, '_crocal_eutf_custom_title_options' );
		crocal_eutf_print_category_fields( $crocal_eutf_term_meta );
	}

	function crocal_eutf_print_category_fields( $crocal_eutf_custom_title_options = array() ) {
?>
		<tr class="form-field">
			<td colspan="2">
				<div id="eut-category-title" class="postbox">
<?php

			//Custom Title Option
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'name' => 'crocal_eutf_term_meta[custom]',
					'id' => 'eut-category-title-custom',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'custom' ),
					'options' => array(
						'' => esc_html__( '-- Inherit --', 'crocal' ),
						'custom' => esc_html__( 'Custom', 'crocal' ),

					),
					'label' => array(
						"title" => esc_html__( 'Title Options', 'crocal' ),
					),
					'group_id' => 'eut-category-title',
					'highlight' => 'highlight',
				)
			);

			global $crocal_eutf_area_height;
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'options' => $crocal_eutf_area_height,
					'name' => 'crocal_eutf_term_meta[height]',
					'id' => 'eut-category-title-height',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'height', '40' ),
					'label' => array(
						"title" => esc_html__( 'Title Area Height', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
				)
			);
			crocal_eutf_print_admin_option(
				array(
					'type' => 'textfield',
					'name' => 'crocal_eutf_term_meta[min_height]',
					'id' => 'eut-category-title-min-height',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'min_height', '200' ),
					'label' => array(
						"title" => esc_html__( 'Title Area Minimum Height in px', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
				)
			);

			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'name' => 'crocal_eutf_term_meta[container_size]',
					'id' => 'eut-category-title-container-size',
					'options' => array(
						'' => esc_html__( 'Default', 'crocal' ),
						'large' => esc_html__( 'Large', 'crocal' ),
					),
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'container_size' ),
					'label' => array(
						"title" => esc_html__( 'Container Size', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
				)
			);

			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-colorpicker',
					'name' => 'crocal_eutf_term_meta[bg_color]',
					'id' => 'eut-category-title-bg-color',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'bg_color', 'dark' ),
					'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'bg_color_custom', '#000000' ),
					'default_value2' => '#000000',
					'label' => array(
						"title" => esc_html__( 'Background Color', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
					'multiple' => 'multi',
					'type_usage' => 'section-bg',
				)
			);
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-colorpicker',
					'name' => 'crocal_eutf_term_meta[content_bg_color]',
					'id' => 'eut-category-title-content-bg-color',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_bg_color', 'none' ),
					'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_bg_color_custom', '#ffffff' ),
					'default_value2' => '#ffffff',
					'label' => array(
						"title" => esc_html__( 'Content Background Color', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
					'multiple' => 'multi',
					'type_usage' => 'title-content-bg',
				)
			);
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-colorpicker',
					'name' => 'crocal_eutf_term_meta[title_color]',
					'id' => 'eut-category-title-title-color',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'title_color', 'light' ),
					'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'title_color_custom', '#ffffff' ),
					'default_value2' => '#ffffff',
					'label' => array(
						"title" => esc_html__( 'Title Color', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
					'multiple' => 'multi',
				)
			);

			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-colorpicker',
					'name' => 'crocal_eutf_term_meta[caption_color]',
					'id' => 'eut-category-title-caption_color',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'caption_color', 'light' ),
					'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'caption_color_custom', '#ffffff' ),
					'default_value2' => '#ffffff',
					'label' => array(
						"title" => esc_html__( 'Description Color', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
					'multiple' => 'multi',
				)
			);

			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'name' => 'crocal_eutf_term_meta[content_size]',
					'id' => 'eut-category-title-content-size',
					'options' => array(
						'large' => esc_html__( 'Large', 'crocal' ),
						'medium' => esc_html__( 'Medium', 'crocal' ),
						'small' => esc_html__( 'Small', 'crocal' ),
					),
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_size', 'large' ),
					'label' => array(
						"title" => esc_html__( 'Content Size', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
				)
			);

			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-align',
					'name' => 'crocal_eutf_term_meta[content_alignment]',
					'id' => 'eut-category-title-content-alignment',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_alignment', 'center' ),
					'label' => array(
						"title" => esc_html__( 'Content Alignment', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
				)
			);

			global $crocal_eutf_media_bg_position_selection;
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'name' => 'crocal_eutf_term_meta[content_position]',
					'id' => 'eut-category-title-content_position',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_position', 'center-center' ),
					'options' => $crocal_eutf_media_bg_position_selection,
					'label' => array(
						"title" => esc_html__( 'Content Position', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
				)
			);

			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-text-animation',
					'name' => 'crocal_eutf_term_meta[content_animation]',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_animation', 'fade-in' ),
					'label' => esc_html__( 'Content Animation', 'crocal' ),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }
					]',
				)
			);


			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'name' => 'crocal_eutf_term_meta[bg_mode]',
					'id' => 'eut-category-title-bg-mode',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'bg_mode'),
					'options' => array(
						'' => esc_html__( 'Color Only', 'crocal' ),
						'custom' => esc_html__( 'Custom Image', 'crocal' ),

					),
					'label' => array(
						"title" => esc_html__( 'Background Mode', 'crocal' ),
					),
					'group_id' => 'eut-category-title',
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] }

					]',
				)
			);
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-image',
					'name' => 'crocal_eutf_term_meta[bg_image_id]',
					'id' => 'eut-category-title-bg-image-id',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'bg_image_id'),
					'label' => array(
						"title" => esc_html__( 'Background Image', 'crocal' ),
					),
					'width' => 'fullwidth',
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] },
						{ "id" : "eut-category-title-bg-mode", "values" : ["custom"] }

					]',
				)
			);
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-bg-position',
					'name' => 'crocal_eutf_term_meta[bg_position]',
					'id' => 'eut-category-title-bg-position',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'bg_position', 'center-center'),
					'label' => array(
						"title" => esc_html__( 'Background Position', 'crocal' ),
					),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] },
						{ "id" : "eut-category-title-bg-mode", "values" : ["custom"] }
					]',
				)
			);

			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-pattern-overlay',
					'name' => 'crocal_eutf_term_meta[pattern_overlay]',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'pattern_overlay'),
					'label' => esc_html__( 'Pattern Overlay', 'crocal' ),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] },
						{ "id" : "eut-category-title-bg-mode", "values" : ["custom"] }
					]',
				)
			);
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-colorpicker',
					'name' => 'crocal_eutf_term_meta[color_overlay]',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'color_overlay', 'dark' ),
					'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'color_overlay_custom', '#000000' ),
					'default_value2' => '#000000',
					'label' => esc_html__( 'Color Overlay', 'crocal' ),
					'multiple' => 'multi',
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] },
						{ "id" : "eut-category-title-bg-mode", "values" : ["custom"] }
					]',
				)
			);
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select-opacity',
					'name' => 'crocal_eutf_term_meta[opacity_overlay]',
					'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'opacity_overlay', '0' ),
					'label' => esc_html__( 'Opacity Overlay', 'crocal' ),
					'dependency' =>
					'[
						{ "id" : "eut-category-title-custom", "values" : ["custom"] },
						{ "id" : "eut-category-title-bg-mode", "values" : ["custom"] }
					]',
				)
			);
?>
			</div>
		</td>
	</tr>
<?php
	}

	//Save Category Meta
	function crocal_eutf_save_category_fields( $term_id, $tt_id = '', $taxonomy = '' ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		$custom_meta_tax = array ( 'category', 'post_tag', 'product_cat', 'product_tag' );

		if ( isset( $_POST['crocal_eutf_term_meta'] ) && in_array( $taxonomy, $custom_meta_tax ) ) {
			$crocal_eutf_term_meta = crocal_eutf_get_term_meta( $term_id, '_crocal_eutf_custom_title_options' );
			$cat_keys = array_keys( $_POST['crocal_eutf_term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset( $_POST['crocal_eutf_term_meta'][$key] ) ) {
					$crocal_eutf_term_meta[$key] = sanitize_text_field( $_POST['crocal_eutf_term_meta'][$key] );
				}
			}
			crocal_eutf_update_term_meta( $term_id , '_crocal_eutf_custom_title_options', $crocal_eutf_term_meta );
		}
	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
