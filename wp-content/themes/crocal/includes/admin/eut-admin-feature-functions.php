<?php
/*
*	Collection of functions for admin feature section
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

/**
 * Get Replaced Image with ajax
 */
function crocal_eutf_get_replaced_image() {

	check_ajax_referer( 'crocal-eutf-get-replaced-image', '_eutf_nonce' );

	if( isset( $_POST['attachment_id'] ) ) {

		if ( isset( $_POST['attachment_mode'] ) && !empty( $_POST['attachment_mode'] ) ) {
			$mode = sanitize_text_field( $_POST['attachment_mode'] );
			switch( $mode ) {
				case 'image':
					$input_name = '_crocal_eutf_single_item_bg_image_id';
				break;
				case 'custom-image':
					if ( isset( $_POST['field_name'] ) && !empty( $_POST['field_name'] ) ) {
						$input_name = sanitize_text_field( $_POST['field_name'] );
					}
				break;
				case 'full-slider':
				default:
					$input_name = '_crocal_eutf_slider_item_bg_image_id[]';
				break;
			}
		} else {
			$input_name = '_crocal_eutf_slider_item_bg_image_id[]';
		}

		$media_id  = sanitize_text_field( $_POST['attachment_id'] );
		$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
		$thumbnail_url = $thumb_src[0];
		$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
?>
		<input type="hidden" class="eut-upload-media-id" value="<?php echo esc_attr( $media_id ); ?>" name="<?php echo esc_attr( $input_name ); ?>">
		<?php echo '<img class="eut-thumb" src="' . esc_url( $thumbnail_url ) . '" alt="' . esc_attr( $alt ) . '" width="120" height="120"/>'; ?>
		<a class="eut-upload-remove-image eut-item-new" href="#"></a>
<?php

	}

	if( isset( $_POST['attachment_id'] ) ) { die(); }
}
add_action( 'wp_ajax_crocal_eutf_get_replaced_image', 'crocal_eutf_get_replaced_image' );

/**
 * Get Single Feature Slider Media with ajax
 */
function crocal_eutf_get_admin_feature_slider_media() {

	check_ajax_referer( 'crocal-eutf-get-feature-slider-media', '_eutf_nonce' );

	if( isset( $_POST['attachment_ids'] ) ) {

		$attachment_ids = sanitize_text_field( $_POST['attachment_ids'] );

		if( !empty( $attachment_ids ) ) {

			$media_ids = explode(",", $attachment_ids);

			foreach ( $media_ids as $media_id ) {
				$slider_item = array (
					'bg_image_id' => $media_id,
				);

				crocal_eutf_print_admin_feature_slider_item( $slider_item, "new" );
			}
		}
	}

	if( isset( $_POST['post_ids'] ) ) {

		$post_ids = sanitize_text_field( $_POST['post_ids'] );
		if( !empty( $post_ids ) ) {

			$all_post_ids = explode(",", $post_ids);

			foreach ( $all_post_ids as $post_id ) {
				$slider_item = array (
					'type' => 'post',
					'post_id' => $post_id,
				);
				crocal_eutf_print_admin_feature_slider_item( $slider_item, "new" );
			}
		} else {
			$slider_item = array (
				'type' => 'post',
				'post_id' => '0',
			);
			crocal_eutf_print_admin_feature_slider_item( $slider_item, "new" );
		}
	}

	if( isset( $_POST['attachment_ids'] ) || isset( $_POST['post_ids'] )  ) { die(); }
}
add_action( 'wp_ajax_crocal_eutf_get_admin_feature_slider_media', 'crocal_eutf_get_admin_feature_slider_media' );

/**
 * Get Single Feature Map Point with ajax
 */
function crocal_eutf_get_map_point() {

	check_ajax_referer( 'crocal-eutf-get-map-point', '_eutf_nonce' );

	if( isset( $_POST['map_mode'] ) ) {
		$mode = sanitize_text_field( $_POST['map_mode'] );
		crocal_eutf_print_admin_feature_map_point( array(), $mode );
	}
	if( isset( $_POST['map_mode'] ) ) { die(); }
}
add_action( 'wp_ajax_crocal_eutf_get_map_point', 'crocal_eutf_get_map_point' );

/**
 * Prints Feature Map Points
 */
function crocal_eutf_print_admin_feature_map_items( $map_items ) {

	if( !empty($map_items) ) {
		foreach ( $map_items as $map_item ) {
			crocal_eutf_print_admin_feature_map_point( $map_item );
		}
	}

}

/**
 * Prints Feature Single Map Point
 */
function crocal_eutf_print_admin_feature_map_point( $map_item, $mode = '' ) {


	$map_item_id = uniqid('_crocal_eutf_map_point_');
	$map_uniqid = uniqid('-');
	$map_id = crocal_eutf_array_value( $map_item, 'id', $map_item_id );

	$map_lat = crocal_eutf_array_value( $map_item, 'lat', '51.516221' );
	$map_lng = crocal_eutf_array_value( $map_item, 'lng', '-0.136986' );
	$map_marker = crocal_eutf_array_value( $map_item, 'marker' );

	$map_title = crocal_eutf_array_value( $map_item, 'title' );
	$map_infotext = crocal_eutf_array_value( $map_item, 'info_text','' );
	$map_infotext_open = crocal_eutf_array_value( $map_item, 'info_text_open','no' );

	$button_text = crocal_eutf_array_value( $map_item, 'button_text' );
	$button_url = crocal_eutf_array_value( $map_item, 'button_url' );
	$button_target = crocal_eutf_array_value( $map_item, 'button_target', '_self' );
	$button_class = crocal_eutf_array_value( $map_item, 'button_class' );
	$crocal_eutf_closed_class = 'closed';
	$crocal_eutf_item_new = '';
	if( "new" == $mode ) {
		$crocal_eutf_item_new = " eut-item-new";
		$crocal_eutf_closed_class = "eut-item-new eut-toggle-new";
	}
?>
	<div class="eut-map-item postbox <?php echo esc_attr( $crocal_eutf_closed_class ); ?>">
		<button class="handlediv button-link" type="button">
			<span class="screen-reader-text"><?php esc_attr_e( 'Toggle panel: Feature Section Map Point', 'crocal' ); ?></span>
			<span class="toggle-indicator"></span>
		</button>
		<input class="eut-map-item-delete-button button<?php echo esc_attr( $crocal_eutf_item_new ); ?>" type="button" value="<?php esc_attr_e( 'Delete', 'crocal' ); ?>" />
		<span class="eut-button-spacer">&nbsp;</span>
		<span class="eut-modal-spinner"></span>
		<h3 class="eut-title">
			<span><?php esc_html_e( 'Map Point', 'crocal' ); ?>: </span><span id="<?php echo esc_attr( $map_id ); ?>_title_admin_label"><?php if ( !empty ($map_title) ) { echo esc_html( $map_title ); } ?></span>
		</h3>
		<div class="inside">

			<!--  METABOXES -->
			<div class="eut-metabox-content">

				<!-- TABS -->
				<div class="eut-tabs<?php echo esc_attr( $crocal_eutf_item_new ); ?>">

					<ul class="eut-tab-links">
						<li class="active"><a href="#eut-feature-single-map-tab-marker<?php echo esc_attr( $map_uniqid ); ?>"><?php esc_html_e( 'Marker', 'crocal' ); ?></a></li>
						<li><a href="#eut-feature-single-map-tab-infobox<?php echo esc_attr( $map_uniqid ); ?>"><?php esc_html_e( 'Info Box', 'crocal' ); ?></a></li>
						<li><a href="#eut-feature-single-map-tab-button<?php echo esc_attr( $map_uniqid ); ?>"><?php esc_html_e( 'Link', 'crocal' ); ?></a></li>
					</ul>

					<div class="eut-tab-content">

						<div id="eut-feature-single-map-tab-marker<?php echo esc_attr( $map_uniqid ); ?>" class="eut-tab-item active">
							<input type="hidden" name="_crocal_eutf_map_item_point_id[]" value="<?php echo esc_attr( $map_id ); ?>"/>
							<?php
								crocal_eutf_print_admin_option(
									array(
										'type' => 'select-image',
										'name' => '_crocal_eutf_map_item_point_marker[]',
										'value' => $map_marker,
										'label' => array(
											"title" => esc_html__( 'Marker', 'crocal' ),
										),
										'width' => 'fullwidth',
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => '_crocal_eutf_map_item_point_lat[]',
										'value' => $map_lat,
										'label' => array(
											"title" => esc_html__( 'Latitude', 'crocal' ),
										),
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => '_crocal_eutf_map_item_point_lng[]',
										'value' => $map_lng,
										'label' => array(
											"title" => esc_html__( 'Longitude', 'crocal' ),
										),
									)
								);
							?>

						</div>
						<div id="eut-feature-single-map-tab-infobox<?php echo esc_attr( $map_uniqid ); ?>" class="eut-tab-item">
							<?php
								crocal_eutf_print_admin_option(
									array(
										'type' => 'label',
										'label' => array(
											"title" => esc_html__( 'Title / Info Text', 'crocal' ),
										),
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => '_crocal_eutf_map_item_point_title[]',
										'value' => $map_title,
										'label' => array(
											"title" => esc_html__( 'Title', 'crocal' ),
										),
										'id' => $map_id . '_title',
										'extra_class' => 'eut-admin-label-update',
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'textarea',
										'name' => '_crocal_eutf_map_item_point_infotext[]',
										'value' => $map_infotext,
										'label' => array(
											"title" => esc_html__( 'Info Text', 'crocal' ),
										),
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'select-boolean',
										'name' => '_crocal_eutf_map_item_point_infotext_open[]',
										'value' => $map_infotext_open,
										'label' => esc_html__( 'Open Info Text Onload', 'crocal' ),
									)
								);
							?>
						</div>
						<div id="eut-feature-single-map-tab-button<?php echo esc_attr( $map_uniqid ); ?>" class="eut-tab-item">
							<?php
								crocal_eutf_print_admin_option(
									array(
										'type' => 'label',
										'label' => array(
											"title" => esc_html__( 'Link', 'crocal' ),
										),
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => '_crocal_eutf_map_item_point_button_text[]',
										'value' => $button_text,
										'label' => array(
											"title" => esc_html__( 'Link Text', 'crocal' ),
										),
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => '_crocal_eutf_map_item_point_button_url[]',
										'value' => $button_url,
										'label' => array(
											"title" => esc_html__( 'Link URL', 'crocal' ),
										),
										'width' => 'fullwidth',
									)
								);

								crocal_eutf_print_admin_option(
									array(
										'type' => 'select-button-target',
										'name' => '_crocal_eutf_map_item_point_button_target[]',
										'value' => $button_target,
										'label' => array(
											"title" => esc_html__( 'Link Target', 'crocal' ),
										),
									)
								);

								crocal_eutf_print_admin_option(
									array(
										'type' => 'textfield',
										'name' => '_crocal_eutf_map_item_point_button_class[]',
										'value' => $button_class,
										'label' => array(
											"title" => esc_html__( 'Link Class', 'crocal' ),
										),
									)
								);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}

/**
 * Prints Section Slider items
 */
function crocal_eutf_print_admin_feature_slider_items( $slider_items ) {

	foreach ( $slider_items as $slider_item ) {
		crocal_eutf_print_admin_feature_slider_item( $slider_item, '' );
	}

}

/**
* Prints Single Feature Slider Item
*/
function crocal_eutf_print_admin_feature_slider_item( $slider_item, $new = "" ) {

	$slide_id = crocal_eutf_array_value( $slider_item, 'id', uniqid() );
	$slider_item['id'] = $slide_id;
	$slide_type = crocal_eutf_array_value( $slider_item, 'type' );
	$slide_post_id = crocal_eutf_array_value( $slider_item, 'post_id' );

	$bg_image_id = crocal_eutf_array_value( $slider_item, 'bg_image_id' );
	$bg_image_size = crocal_eutf_array_value( $slider_item, 'bg_image_size' );
	$bg_position = crocal_eutf_array_value( $slider_item, 'bg_position', 'center-center' );
	$bg_tablet_sm_position = crocal_eutf_array_value( $slider_item, 'bg_tablet_sm_position' );


	$header_style = crocal_eutf_array_value( $slider_item, 'header_style', 'default' );
	$title = crocal_eutf_array_value( $slider_item, 'title' );

	$slider_item_button = crocal_eutf_array_value( $slider_item, 'button' );
	$slider_item_button2 = crocal_eutf_array_value( $slider_item, 'button2' );

	$crocal_eutf_button_class = "eut-feature-slider-item-delete-button";
	$crocal_eutf_replace_image_class = "eut-upload-replace-image";
	$crocal_eutf_open_modal_class = "eut-open-slider-modal";
	$crocal_eutf_closed_class = 'closed';
	$crocal_eutf_new_class = '';

	if( "new" == $new ) {
		$crocal_eutf_button_class = "eut-feature-slider-item-delete-button eut-item-new";
		$crocal_eutf_replace_image_class = "eut-upload-replace-image eut-item-new";
		$crocal_eutf_open_modal_class = "eut-open-slider-modal eut-item-new";
		$crocal_eutf_closed_class = 'eut-item-new eut-toggle-new';
		$crocal_eutf_new_class = ' eut-item-new';
	}

	$slide_uniqid = '-' . $slide_id;

	$slide_type_string = esc_html__( 'Slide', 'crocal' );
	if ( 'post' == $slide_type ) {
		$slide_type_string = esc_html__( 'Post Slide', 'crocal' );
		if( !empty( $slide_post_id ) ) {
			$title = get_the_title ( $slide_post_id  );
		}
	}

?>

	<div class="eut-slider-item postbox <?php echo esc_attr( $crocal_eutf_closed_class ); ?>">
		<button class="handlediv button-link" type="button">
			<span class="screen-reader-text"><?php esc_attr_e( 'Toggle panel: Feature Section Slide', 'crocal' ); ?></span>
			<span class="toggle-indicator"></span>
		</button>
		<input class="<?php echo esc_attr( $crocal_eutf_button_class ); ?> button" type="button" value="<?php esc_attr_e( 'Delete', 'crocal' ); ?>">
		<span class="eut-button-spacer">&nbsp;</span>
		<span class="eut-modal-spinner"></span>
		<h3 class="eut-title">
			<span><?php echo esc_html( $slide_type_string ); ?>: </span><span id="_crocal_eutf_slider_item_title<?php echo esc_attr( $slide_id ); ?>_admin_label"><?php if ( !empty ($title) ) { echo esc_html( $title ); } ?></span>
		</h3>
		<div class="inside">
			<!--  METABOXES -->
			<div class="eut-metabox-content">

				<!-- TABS -->
				<div class="eut-tabs<?php echo esc_attr( $crocal_eutf_new_class ); ?>">

					<ul class="eut-tab-links">
						<li class="active"><a href="#eut-feature-single-tab-bg<?php echo esc_attr( $slide_uniqid ); ?>"><?php esc_html_e( 'Background / Header', 'crocal' ); ?></a></li>
						<li><a href="#eut-feature-single-tab-content<?php echo esc_attr( $slide_uniqid ); ?>"><?php esc_html_e( 'Content', 'crocal' ); ?></a></li>
						<?php if ( 'post' != $slide_type ) { ?>
						<li><a href="#eut-feature-single-tab-button<?php echo esc_attr( $slide_uniqid ); ?>"><?php esc_html_e( 'First Button', 'crocal' ); ?></a></li>
						<li><a href="#eut-feature-single-tab-button2<?php echo esc_attr( $slide_uniqid ); ?>"><?php esc_html_e( 'Second Button', 'crocal' ); ?></a></li>
						<?php } ?>
						<li><a href="#eut-feature-single-tab-extra<?php echo esc_attr( $slide_uniqid ); ?>"><?php esc_html_e( 'Extra', 'crocal' ); ?></a></li>
					</ul>

					<div class="eut-tab-content">

						<div id="eut-feature-single-tab-bg<?php echo esc_attr( $slide_uniqid ); ?>" class="eut-tab-item active">
							<?php

								crocal_eutf_print_admin_option(
									array(
										'type' => 'hidden',
										'name' => '_crocal_eutf_slider_item_id[]',
										'value' => $slide_id,
									)
								);

								crocal_eutf_print_admin_option(
									array(
										'type' => 'hidden',
										'name' => '_crocal_eutf_slider_item_type[]',
										'value' => $slide_type,
									)
								);
								if ( 'post' == $slide_type ) {
									crocal_eutf_print_admin_option(
										array(
											'type' => 'hiddenfield',
											'name' => '_crocal_eutf_slider_item_post_id[]',
											'value' => $slide_post_id,
											'label' => array(
												"title" => esc_html__( 'Post ID', 'crocal' ),
												"desc" => esc_html__( 'Background Image can be still used instead of the Feature Image', 'crocal' ),
											),
										)
									);
								} else {
									crocal_eutf_print_admin_option(
										array(
											'type' => 'hidden',
											'name' => '_crocal_eutf_slider_item_post_id[]',
											'value' => $slide_post_id,
										)
									);
								}

								crocal_eutf_print_admin_option(
									array(
										'type' => 'select-image',
										'name' => '_crocal_eutf_slider_item_bg_image_id[]',
										'value' => $bg_image_id,
										'label' => array(
											"title" => esc_html__( 'Background Image', 'crocal' ),
										),
										'width' => 'fullwidth',
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'select',
										'name' => '_crocal_eutf_slider_item_bg_image_size[]',
										'value' => $bg_image_size,
										'options' => array(
											'' => esc_html__( '--Inherit--', 'crocal' ),
											'responsive' => esc_html__( 'Responsive', 'crocal' ),
											'extra-extra-large' => esc_html__( 'Extra Extra Large', 'crocal' ),
											'full' => esc_html__( 'Full', 'crocal' ),
										),
										'label' => array(
											"title" => esc_html__( 'Background Image Size', 'crocal' ),
											"desc" => esc_html__( 'Inherit : Theme Options - Media Sizes.', 'crocal' ),
										),
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'label',
										'label' => array(
											"title" => esc_html__( 'Header / Background Position', 'crocal' ),
										),
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'select-bg-position',
										'name' => '_crocal_eutf_slider_item_bg_position[]',
										'value' => $bg_position,
										'label' => array(
											"title" => esc_html__( 'Background Position', 'crocal' ),
										),
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'select-bg-position-inherit',
										'name' => '_crocal_eutf_slider_item_bg_tablet_sm_position[]',
										'value' => $bg_tablet_sm_position,
										'label' => array(
											"title" => esc_html__( 'Background Position ( Tablet Portrait )', 'crocal' ),
											"desc" => esc_html__( 'Tablet devices with portrait orientation and below.', 'crocal' ),
										),
									)
								);
								crocal_eutf_print_admin_option(
									array(
										'type' => 'select-header-style',
										'name' => '_crocal_eutf_slider_item_header_style[]',
										'value' => $header_style,
										'label' => array(
											"title" => esc_html__( 'Header Style', 'crocal' ),
										),
									)
								);

								crocal_eutf_print_admin_feature_item_overlay_options( $slider_item, '_crocal_eutf_slider_item_', 'multi' );
							?>
						</div>
						<div id="eut-feature-single-tab-content<?php echo esc_attr( $slide_uniqid ); ?>" class="eut-tab-item">
							<?php crocal_eutf_print_admin_feature_item_content_options( $slider_item, '_crocal_eutf_slider_item_', 'multi' ); ?>
						</div>
						<div id="eut-feature-single-tab-button<?php echo esc_attr( $slide_uniqid ); ?>" class="eut-tab-item">
							<?php crocal_eutf_print_admin_feature_item_button_options( $slider_item_button, '_crocal_eutf_slider_item_button_', 'multi' ); ?>
						</div>
						<div id="eut-feature-single-tab-button2<?php echo esc_attr( $slide_uniqid ); ?>" class="eut-tab-item">
							<?php crocal_eutf_print_admin_feature_item_button_options( $slider_item_button2, '_crocal_eutf_slider_item_button2_', 'multi' ); ?>
						</div>
						<div id="eut-feature-single-tab-extra<?php echo esc_attr( $slide_uniqid ); ?>" class="eut-tab-item">
							<?php crocal_eutf_print_admin_feature_item_extra_options( $slider_item, '_crocal_eutf_slider_item_', 'multi' ); ?>
						</div>
					</div>

				</div>
				<!-- END TABS -->

			</div>
			<!-- END  METABOXES -->
		</div>

	</div>
<?php

}

/**
* Get Revolution Sliders
*/
function crocal_eutf_get_revolution_selection() {

	$revsliders = array(
		"" => esc_html__( "None", 'crocal' ),
	);

	if ( class_exists( 'RevSlider' ) ) {
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();

		if ( $arrSliders ) {
			foreach ( $arrSliders as $slider ) {
				$revsliders[ $slider->getAlias() ] = $slider->getTitle();
			}
		}
	}

	return $revsliders;
}

/**
* Prints Item Button Options
*/
function crocal_eutf_print_admin_feature_item_button_options( $item, $prefix = '_crocal_eutf_single_item_button_', $mode = '' ) {


	$button_id = crocal_eutf_array_value( $item, 'id', uniqid() );
	$group_id = $prefix . $button_id;

	$button_text = crocal_eutf_array_value( $item, 'text' );
	$button_url = crocal_eutf_array_value( $item, 'url' );
	$button_type = crocal_eutf_array_value( $item, 'type', '' );
	$button_size = crocal_eutf_array_value( $item, 'size', 'medium' );
	$button_color = crocal_eutf_array_value( $item, 'color', 'primary-1' );
	$button_hover_color = crocal_eutf_array_value( $item, 'hover_color', 'black' );
	$button_gradient_color_1 = crocal_eutf_array_value( $item, 'gradient_1_color', 'primary-1' );
	$button_gradient_color_2 = crocal_eutf_array_value( $item, 'gradient_2_color', 'primary-2' );
	$button_shape = crocal_eutf_array_value( $item, 'shape', 'square' );
	$button_shadow = crocal_eutf_array_value( $item, 'shadow' );
	$button_target = crocal_eutf_array_value( $item, 'target', '_self' );
	$button_class = crocal_eutf_array_value( $item, 'class' );

	$sufix  = '';
	if ( 'multi' == $mode ) {
		$sufix = '[]';
	};
	echo '<div id="' . esc_attr( $group_id ) . '">';


	crocal_eutf_print_admin_option(
		array(
			'type' => 'hidden',
			'name' => $prefix . 'id' . $sufix,
			'value' => $button_id,
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'text' . $sufix,
			'id' => $prefix . 'text' . '_' . $button_id,
			'value' => $button_text,
			'label' => esc_html__( 'Button Text', 'crocal' ),
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'url' . $sufix,
			'id' => $prefix . 'url' . '_' . $button_id,
			'value' => $button_url,
			'label' => esc_html__( 'Button URL', 'crocal' ),
			'width' => 'fullwidth',
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-button-target',
			'name' => $prefix . 'target' . $sufix,
			'id' => $prefix . 'target' . '_' . $button_id,
			'value' => $button_target,
			'label' => esc_html__( 'Button Target', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select',
			'name' => $prefix . 'type' . $sufix,
			'id' => $prefix . 'type' . '_' . $button_id,
			'options' => array(
				'simple' => esc_html__( 'Simple', 'crocal' ),
				'outline' => esc_html__( 'Outline', 'crocal' ),
				'gradient' => esc_html__( 'Gradient', 'crocal' ),
			),
			'value' => $button_type,
			'group_id' => $group_id,
			'label' => esc_html__( 'Button Type', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-button-color',
			'name' => $prefix . 'color' . $sufix,
			'id' => $prefix . 'color' . '_' . $button_id,
			'value' => $button_color,
			'group_id' => $group_id,
			'label' => esc_html__( 'Button Color', 'crocal' ),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'type' . '_' . $button_id . '", "values" : ["simple","outline"] }
			]',
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-button-color',
			'name' => $prefix . 'gradient_1_color' . $sufix,
			'id' => $prefix . 'gradient_1_color' . '_' . $button_id,
			'value' => $button_gradient_color_1,
			'group_id' => $group_id,
			'label' => esc_html__( 'Button Gradient 1 Color', 'crocal' ),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'type' . '_' . $button_id . '", "values" : ["gradient"] }
			]',
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-button-color',
			'name' => $prefix . 'gradient_2_color' . $sufix,
			'id' => $prefix . 'gradient_2_color' . '_' . $button_id,
			'value' => $button_gradient_color_2,
			'group_id' => $group_id,
			'label' => esc_html__( 'Button Gradient 2 Color', 'crocal' ),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'type' . '_' . $button_id . '", "values" : ["gradient"] }
			]',
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-button-color',
			'name' => $prefix . 'hover_color' . $sufix,
			'id' => $prefix . 'hover_color' . '_' . $button_id,
			'value' => $button_hover_color,
			'group_id' => $group_id,
			'label' => esc_html__( 'Button Hover Color', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-button-size',
			'name' => $prefix . 'size' . $sufix,
			'value' => $button_size,
			'label' => esc_html__( 'Button Size', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-button-shape',
			'name' => $prefix . 'shape' . $sufix,
			'value' => $button_shape,
			'label' => esc_html__( 'Button Shape', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select',
			'name' => $prefix . 'shadow' . $sufix,
			'value' => $button_shadow,
			'options' => array(
				'' => esc_html__( 'None', 'crocal' ),
				'small' => esc_html__( 'Small', 'crocal' ),
				'medium' => esc_html__( 'Medium', 'crocal' ),
				'large' => esc_html__( 'Large', 'crocal' ),
			),
			'label' => esc_html__( 'Button Shadow', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'class' . $sufix,
			'id' => $prefix . 'class' . '_' . $button_id,
			'value' => $button_class,
			'label' => esc_html__( 'Button Class', 'crocal' ),
		)
	);

	echo '</div>';

}


/**
* Prints Item Overlay Options
*/
function crocal_eutf_print_admin_feature_item_overlay_options( $item, $prefix = '_crocal_eutf_single_item_', $mode = '' ) {

	$overlay_id = crocal_eutf_array_value( $item, 'id', uniqid() );
	$group_id = $prefix . 'overlay_container' . $overlay_id;

	$pattern_overlay = crocal_eutf_array_value( $item, 'pattern_overlay' );
	$color_overlay = crocal_eutf_array_value( $item, 'color_overlay', 'dark' );
	$color_overlay_custom  = crocal_eutf_array_value( $item, 'color_overlay_custom', '#000000' );
	$opacity_overlay = crocal_eutf_array_value( $item, 'opacity_overlay', '0' );
	$gradient_overlay_custom_1 = crocal_eutf_array_value( $item, 'gradient_overlay_custom_1', '#034e90' );
	$gradient_overlay_custom_1_opacity = crocal_eutf_array_value( $item, 'gradient_overlay_custom_1_opacity', '0.90' );
	$gradient_overlay_custom_2 = crocal_eutf_array_value( $item, 'gradient_overlay_custom_2', '#19b4d7' );
	$gradient_overlay_custom_2_opacity = crocal_eutf_array_value( $item, 'gradient_overlay_custom_2_opacity', '0.90' );
	$gradient_overlay_direction  = crocal_eutf_array_value( $item, 'gradient_overlay_direction', '90' );

	$sufix  = '';
	if ( 'multi' == $mode ) {
		$sufix = '[]';
	};

	echo '<div id="' . esc_attr( $group_id ) . '">';

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-pattern-overlay',
			'name' => $prefix . 'pattern_overlay' . $sufix,
			'value' => $pattern_overlay,
			'label' => esc_html__( 'Pattern Overlay', 'crocal' ),
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-colorpicker',
			'name' => $prefix . 'color_overlay' . $sufix,
			'id' => $prefix . 'color_overlay' . $overlay_id,
			'value' => $color_overlay,
			'value2' => $color_overlay_custom,
			'default_value2' => $color_overlay_custom,
			'label' => esc_html__( 'Color Overlay', 'crocal' ),
			'type_usage' => 'overlay-bg',
			'multiple' => 'multi',
			'group_id' => $group_id,
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-opacity',
			'name' => $prefix . 'opacity_overlay' . $sufix,
			'value' => $opacity_overlay,
			'label' => esc_html__( 'Opacity Overlay', 'crocal' ),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'color_overlay' . $overlay_id . '", "value_not_equal_to" : ["gradient"] }
			]',
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'colorpicker',
			'name' => $prefix . 'gradient_overlay_custom_1' . $sufix,
			'value' => $gradient_overlay_custom_1,
			'label' => esc_html__( 'Custom Color 1', 'crocal' ),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'color_overlay' . $overlay_id . '", "values" : ["gradient"] }
			]',
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-opacity',
			'name' => $prefix . 'gradient_overlay_custom_1_opacity' . $sufix,
			'value' => $gradient_overlay_custom_1_opacity,
			'label' => esc_html__( 'Custom Color 1 Opacity', 'crocal' ),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'color_overlay' . $overlay_id . '", "values" : ["gradient"] }
			]',
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'colorpicker',
			'name' => $prefix . 'gradient_overlay_custom_2' . $sufix,
			'value' => $gradient_overlay_custom_2,
			'label' => esc_html__( 'Custom Color 2', 'crocal' ),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'color_overlay' . $overlay_id . '", "values" : ["gradient"] }
			]',
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-opacity',
			'name' => $prefix . 'gradient_overlay_custom_2_opacity' . $sufix,
			'value' => $gradient_overlay_custom_2_opacity,
			'label' => esc_html__( 'Custom Color 2 Opacity', 'crocal' ),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'color_overlay' . $overlay_id . '", "values" : ["gradient"] }
			]',
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select',
			'name' => $prefix . 'gradient_overlay_direction' . $sufix,
			'value' => $gradient_overlay_direction,
			'options' => array(
				'90' => esc_html__( "Left to Right", 'crocal' ),
				'135' => esc_html__( "Left Top to Right Bottom", 'crocal' ),
				'45' => esc_html__( "Left Bottom to Right Top", 'crocal' ),
				'180' => esc_html__( "Bottom to Top", 'crocal' ),
			),
			'label' => array(
				"title" => esc_html__( 'Gradient Direction', 'crocal' ),
			),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'color_overlay' . $overlay_id . '", "values" : ["gradient"] }
			]',
		)
	);

	echo '</div>';

}

/**
* Prints Item Content Options
*/
function crocal_eutf_print_admin_feature_item_content_options( $item, $prefix = '_crocal_eutf_single_item_', $mode = '' ) {

	$item_id = crocal_eutf_array_value( $item, 'id' );
	$title = crocal_eutf_array_value( $item, 'title' );
	$content_bg_color = crocal_eutf_array_value( $item, 'content_bg_color', 'none' );
	$content_bg_color_custom = crocal_eutf_array_value( $item, 'content_bg_color_custom', '#ffffff' );
	$title_color = crocal_eutf_array_value( $item, 'title_color', 'light' );
	$title_color_custom = crocal_eutf_array_value( $item, 'title_color_custom', '#ffffff' );
	$title_tag = crocal_eutf_array_value( $item, 'title_tag', 'div' );
	$caption = crocal_eutf_array_value( $item, 'caption' );
	$caption_color = crocal_eutf_array_value( $item, 'caption_color', 'light' );
	$caption_color_custom = crocal_eutf_array_value( $item, 'caption_color_custom', '#ffffff' );
	$caption_tag = crocal_eutf_array_value( $item, 'caption_tag', 'div' );
	$subheading = crocal_eutf_array_value( $item, 'subheading' );
	$subheading_color = crocal_eutf_array_value( $item, 'subheading_color', 'light' );
	$subheading_color_custom = crocal_eutf_array_value( $item, 'subheading_color_custom', '#ffffff' );
	$subheading_tag = crocal_eutf_array_value( $item, 'subheading_tag', 'div' );

	$subheading_family = crocal_eutf_array_value( $item, 'subheading_family' );
	$title_family = crocal_eutf_array_value( $item, 'title_family' );
	$caption_family = crocal_eutf_array_value( $item, 'caption_family' );

	$content_size = crocal_eutf_array_value( $item, 'content_size', 'large' );
	$content_align = crocal_eutf_array_value( $item, 'content_align', 'center' );
	$content_position = crocal_eutf_array_value( $item, 'content_position', 'center-center' );
	$content_animation = crocal_eutf_array_value( $item, 'content_animation', 'fade-in' );
	$content_image_id = crocal_eutf_array_value( $item, 'content_image_id', '0' );
	$content_image_size = crocal_eutf_array_value( $item, 'content_image_size' );
	$content_image_max_height = crocal_eutf_array_value( $item, 'content_image_max_height', '150' );
	$content_image_responsive_max_height = crocal_eutf_array_value( $item, 'content_image_responsive_max_height', '50' );

	$container_size = crocal_eutf_array_value( $item, 'container_size' );



	$sufix  = '';
	if ( 'multi' == $mode ) {
		$sufix = '[]';
	};

	$type = crocal_eutf_array_value( $item, 'type' );

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select',
			'name' => $prefix . 'container_size' . $sufix,
			'options' => array(
				'' => esc_html__( 'Default', 'crocal' ),
				'large' => esc_html__( 'Large', 'crocal' ),
			),
			'value' => $container_size,
			'label' => esc_html__( 'Container Size', 'crocal' ),
		)
	);

	if ( 'post' == $type ) {
?>
		<input type="hidden" name="<?php echo esc_attr( $prefix . 'content_image_id' . $sufix ); ?>" value="" />
		<input type="hidden" name="<?php echo esc_attr( $prefix . 'content_image_size' . $sufix ); ?>" value="" />
		<input type="hidden" name="<?php echo esc_attr( $prefix . 'content_image_max_height' . $sufix ); ?>" value="" />
		<input type="hidden" name="<?php echo esc_attr( $prefix . 'content_image_responsive_max_height' . $sufix ); ?>" value="" />
		<input type="hidden" name="<?php echo esc_attr( $prefix . 'subheading' . $sufix ); ?>" value="" />
		<input type="hidden" name="<?php echo esc_attr( $prefix . 'title' . $sufix ); ?>" value="" />
		<input type="hidden" name="<?php echo esc_attr( $prefix . 'caption' . $sufix ); ?>" value="" />
<?php

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-colorpicker',
				'name' => $prefix . 'title_content_bg_color' . $sufix,
				'value' => $content_bg_color,
				'value2' => $content_bg_color_custom,
				'default_value2' => $content_bg_color_custom,
				'label' => array(
					"title" => esc_html__( 'Content Background Color', 'crocal' ),
				),
				'multiple' => 'multi',
				'type_usage' => 'title-content-bg',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-colorpicker',
				'name' => $prefix . 'subheading_color' . $sufix,
				'value' => $subheading_color,
				'value2' => $subheading_color_custom,
				'default_value2' => $subheading_color_custom,
				'label' => esc_html__( 'Post Meta Color', 'crocal' ),
				'multiple' => 'multi',
			)
		);
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-colorpicker',
				'name' => $prefix . 'title_color' . $sufix,
				'value' => $title_color,
				'value2' => $title_color_custom,
				'default_value2' => $title_color_custom,
				'label' => esc_html__( 'Post Title Color', 'crocal' ),
				'multiple' => 'multi',
			)
		);
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-colorpicker',
				'name' => $prefix . 'caption_color' . $sufix,
				'value' => $caption_color,
				'value2' => $caption_color_custom,
				'default_value2' => $caption_color_custom,
				'label' => esc_html__( 'Post Description Color', 'crocal' ),
				'multiple' => 'multi',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-tag',
				'name' => $prefix . 'subheading_tag' . $sufix,
				'value' => $subheading_tag,
				'label' => esc_html__( 'Post Meta Tag', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-tag',
				'name' => $prefix . 'title_tag' . $sufix,
				'value' => $title_tag,
				'label' => esc_html__( 'Post Title Tag', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-tag',
				'name' => $prefix . 'caption_tag' . $sufix,
				'value' => $caption_tag,
				'label' => esc_html__( 'Post Description Tag', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-custom-font-family',
				'name' => $prefix . 'subheading_family' . $sufix,
				'value' => $subheading_family,
				'label' => esc_html__( 'Post Meta Font Family', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-custom-font-family',
				'name' => $prefix . 'title_family' . $sufix,
				'value' => $title_family,
				'label' => esc_html__( 'Post Title Font Family', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-custom-font-family',
				'name' => $prefix . 'caption_family' . $sufix,
				'value' => $caption_family,
				'label' => esc_html__( 'Post Description Font Family', 'crocal' ),
			)
		);

	} else {
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-image',
				'name' => $prefix . 'content_image_id' . $sufix,
				'value' => $content_image_id,
				'label' => array(
					"title" => esc_html__( 'Graphic Image', 'crocal' ),
				),
				'width' => 'fullwidth',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => $prefix . 'content_image_size' . $sufix,
				'options' => array(
					'' => esc_html__( 'Resize ( Medium )', 'crocal' ),
					'full' => esc_html__( 'Full size', 'crocal' ),
				),
				'value' => $content_image_size,
				'label' => esc_html__( 'Graphic Image Size', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'textfield',
				'name' => $prefix . 'content_image_max_height' . $sufix,
				'value' => $content_image_max_height,
				'label' => esc_html__( 'Graphic Image Max Height', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'textfield',
				'name' => $prefix . 'content_image_responsive_max_height' . $sufix,
				'value' => $content_image_responsive_max_height,
				'label' => esc_html__( 'Graphic Image responsive Max Height', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'textarea',
				'name' => $prefix . 'subheading' . $sufix,
				'value' => $subheading,
				'label' => esc_html__( 'Sub Heading', 'crocal' ),
				'width' => 'fullwidth',
				'rows' => 2,
			)
		);


		crocal_eutf_print_admin_option(
			array(
				'type' => 'textarea',
				'name' => $prefix . 'title' . $sufix,
				'value' => $title,
				'label' => esc_html__( 'Title', 'crocal' ),
				'extra_class' =>  'eut-admin-label-update',
				'id' => $prefix . 'title' . $item_id,
				'width' => 'fullwidth',
				'rows' => 2,
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'textarea',
				'name' => $prefix . 'caption' . $sufix,
				'value' => $caption,
				'label' => esc_html__( 'Description', 'crocal' ),
				'width' => 'fullwidth',
				'rows' => 2,
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-colorpicker',
				'name' => $prefix . 'title_content_bg_color' . $sufix,
				'value' => $content_bg_color,
				'value2' => $content_bg_color_custom,
				'default_value2' => $content_bg_color_custom,
				'label' => array(
					"title" => esc_html__( 'Content Background Color', 'crocal' ),
				),
				'multiple' => 'multi',
				'type_usage' => 'title-content-bg',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-colorpicker',
				'name' => $prefix . 'subheading_color' . $sufix,
				'value' => $subheading_color,
				'value2' => $subheading_color_custom,
				'default_value2' => $subheading_color_custom,
				'label' => esc_html__( 'Sub Heading Color', 'crocal' ),
				'multiple' => 'multi',
			)
		);
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-colorpicker',
				'name' => $prefix . 'title_color' . $sufix,
				'value' => $title_color,
				'value2' => $title_color_custom,
				'default_value2' => $title_color_custom,
				'label' => esc_html__( 'Title Color', 'crocal' ),
				'multiple' => 'multi',
			)
		);
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-colorpicker',
				'name' => $prefix . 'caption_color' . $sufix,
				'value' => $caption_color,
				'value2' => $caption_color_custom,
				'default_value2' => $caption_color_custom,
				'label' => esc_html__( 'Description Color', 'crocal' ),
				'multiple' => 'multi',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-tag',
				'name' => $prefix . 'subheading_tag' . $sufix,
				'value' => $subheading_tag,
				'label' => esc_html__( 'Sub Heading Tag', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-tag',
				'name' => $prefix . 'title_tag' . $sufix,
				'value' => $title_tag,
				'label' => esc_html__( 'Title Tag', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-tag',
				'name' => $prefix . 'caption_tag' . $sufix,
				'value' => $caption_tag,
				'label' => esc_html__( 'Description Tag', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-custom-font-family',
				'name' => $prefix . 'subheading_family' . $sufix,
				'value' => $subheading_family,
				'label' => esc_html__( 'Sub Heading Font Family', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-custom-font-family',
				'name' => $prefix . 'title_family' . $sufix,
				'value' => $title_family,
				'label' => esc_html__( 'Title Font Family', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-custom-font-family',
				'name' => $prefix . 'caption_family' . $sufix,
				'value' => $caption_family,
				'label' => esc_html__( 'Description Font Family', 'crocal' ),
			)
		);

	}

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select',
			'name' => $prefix . 'content_size' . $sufix,
			'options' => array(
				'large' => esc_html__( 'Large', 'crocal' ),
				'medium' => esc_html__( 'Medium', 'crocal' ),
				'small' => esc_html__( 'Small', 'crocal' ),
			),
			'value' => $content_size,
			'label' => esc_html__( 'Content Size', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-align',
			'name' => $prefix . 'content_align' . $sufix,
			'value' => $content_align,
			'label' => esc_html__( 'Content Alignment', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-bg-position',
			'name' => $prefix . 'content_position' . $sufix,
			'value' => $content_position,
			'label' => esc_html__( 'Content Position', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-text-animation',
			'name' => $prefix . 'content_animation' . $sufix,
			'value' => $content_animation,
			'label' => esc_html__( 'Content Animation', 'crocal' ),
		)
	);

}

/**
* Prints Item Extra Options
*/
function crocal_eutf_print_admin_feature_item_extra_options( $item, $prefix = '_crocal_eutf_single_item_', $mode = '' ) {

	$sufix  = '';
	if ( 'multi' == $mode ) {
		$sufix = '[]';
	};

	$el_class = crocal_eutf_array_value( $item, 'el_class' );
	$arrow_enabled = crocal_eutf_array_value( $item, 'arrow_enabled', 'no' );
	$arrow_text = crocal_eutf_array_value( $item, 'arrow_text', 'Scroll to content' );
	$arrow_color = crocal_eutf_array_value( $item, 'arrow_color', 'light' );
	$arrow_color_custom = crocal_eutf_array_value( $item, 'arrow_color_custom', '#ffffff' );
	$arrow_id = uniqid();
	$group_id = $prefix . $arrow_id;

	echo '<div id="' . esc_attr( $group_id ) . '">';

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select',
			'name' => $prefix . 'arrow_enabled' . $sufix,
			'value' => $arrow_enabled,
			'id' => $prefix . 'arrow_enabled' . '_' . $arrow_id,
			'group_id' => $group_id,
			'options' => array(
				'no' => esc_html__( 'None', 'crocal' ),
				'yes' => esc_html__( 'Arrow', 'crocal' ),
				'text' => esc_html__( 'Text', 'crocal' ),
			),
			'label' => esc_html__( 'Scroll to Content', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'arrow_text' . $sufix,
			'value' => $arrow_text,
			'label' => esc_html__( 'Scroll to Content Text', 'crocal' ),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'arrow_enabled' . '_' . $arrow_id . '", "values" : ["text"] }
			]',
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-colorpicker',
			'name' => $prefix . 'arrow_color' . $sufix,
			'value' => $arrow_color,
			'value2' => $arrow_color_custom,
			'default_value2' => $arrow_color_custom,
			'label' => esc_html__( 'Scroll to Content Color', 'crocal' ),
			'multiple' => 'multi',
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'arrow_enabled' . '_' . $arrow_id . '", "value_not_equal_to" : ["no"] }
			]',
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => $prefix . 'el_class' . $sufix,
			'value' => $el_class,
			'label' => esc_html__( 'Extra Class', 'crocal' ),
			'dependency' =>
			'[
				{ "id" : "' . $prefix . 'arrow_enabled' . '_' . $arrow_id . '", "value_not_equal_to" : ["no"] }
			]',
		)
	);

	echo '</div>';

}

/**
 * Prints Item Background Image Options
 */
function crocal_eutf_print_admin_feature_item_background_options( $item ) {

	$bg_image_id = crocal_eutf_array_value( $item, 'bg_image_id', '0' );
	$bg_image_size = crocal_eutf_array_value( $item, 'bg_image_size' );
	$bg_position = crocal_eutf_array_value( $item, 'bg_position', 'center-center' );
	$bg_tablet_sm_position = crocal_eutf_array_value( $item, 'bg_tablet_sm_position' );
	$image_effect = crocal_eutf_array_value( $item, 'image_effect' );


	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-image',
			'name' => '_crocal_eutf_single_item_bg_image_id',
			'value' => $bg_image_id,
			'label' => array(
				"title" => esc_html__( 'Background Image', 'crocal' ),
			),
			'width' => 'fullwidth',
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select',
			'name' => '_crocal_eutf_single_item_bg_image_size',
			'value' => $bg_image_size,
			'options' => array(
				'' => esc_html__( '--Inherit--', 'crocal' ),
				'responsive' => esc_html__( 'Responsive', 'crocal' ),
				'extra-extra-large' => esc_html__( 'Extra Extra Large', 'crocal' ),
				'full' => esc_html__( 'Full', 'crocal' ),
			),
			'label' => array(
				"title" => esc_html__( 'Background Image Size', 'crocal' ),
				"desc" => esc_html__( 'Inherit : Theme Options - Media Sizes.', 'crocal' ),
			),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-bg-position',
			'name' => '_crocal_eutf_single_item_bg_position',
			'value' => $bg_position,
			'label' => esc_html__( 'Background Position', 'crocal' ),
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-bg-position-inherit',
			'name' => '_crocal_eutf_single_item_bg_tablet_sm_position',
			'value' => $bg_tablet_sm_position,
			'label' => array(
				"title" => esc_html__( 'Background Position ( Tablet Portrait )', 'crocal' ),
				"desc" => esc_html__( 'Tablet devices with portrait orientation and below.', 'crocal' ),
			),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select',
			'name' => '_crocal_eutf_single_item_image_effect',
			'options' => array(
				'' => esc_html__( 'None', 'crocal' ),
				'animated' => esc_html__( 'Animated', 'crocal' ),
				'parallax' => esc_html__( 'Classic Parallax', 'crocal' ),
				'advanced-parallax' => esc_html__( 'Advanced Parallax', 'crocal' ),
				'fixed-section' => esc_html__( 'Fixed Section', 'crocal' ),
			),
			'value' => $image_effect,
			'label' => esc_html__( 'Background Effect', 'crocal' ),
			'wrap_class' => 'eut-feature-required eut-item-feature-image-settings',
		)
	);

}

/**
 * Prints Item Background Video Options
 */
function crocal_eutf_print_admin_feature_item_video_options( $item ) {

	$video_webm = crocal_eutf_array_value( $item, 'video_webm' );
	$video_mp4 = crocal_eutf_array_value( $item, 'video_mp4' );
	$video_ogv = crocal_eutf_array_value( $item, 'video_ogv' );
	$video_poster = crocal_eutf_array_value( $item, 'video_poster', 'no' );
	$video_device = crocal_eutf_array_value( $item, 'video_device', 'no' );
	$video_loop = crocal_eutf_array_value( $item, 'video_loop', 'yes' );
	$video_muted = crocal_eutf_array_value( $item, 'video_muted', 'yes' );
	$video_effect = crocal_eutf_array_value( $item, 'video_effect' );

	crocal_eutf_print_admin_option(
		array(
			'type' => 'label',
			'label' => esc_html__( 'HTML5 Video', 'crocal' ),
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-bg-video',
			'name' => '_crocal_eutf_single_item_video_webm',
			'value' => $video_webm,
			'label' => esc_html__( 'WebM File URL', 'crocal' ),
			'width' => 'fullwidth',
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-bg-video',
			'name' => '_crocal_eutf_single_item_video_mp4',
			'value' => $video_mp4,
			'label' => esc_html__( 'MP4 File URL', 'crocal' ),
			'width' => 'fullwidth',
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-bg-video',
			'name' => '_crocal_eutf_single_item_video_ogv',
			'value' => $video_ogv,
			'label' => esc_html__( 'OGV File URL', 'crocal' ),
			'width' => 'fullwidth',
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-boolean',
			'name' => '_crocal_eutf_single_item_video_poster',
			'value' => $video_poster,
			'label' => esc_html__( 'Use Fallback Image as Poster', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-boolean',
			'name' => '_crocal_eutf_single_item_video_device',
			'value' => $video_device,
			'label' => esc_html__( 'Show video on devices', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-boolean',
			'name' => '_crocal_eutf_single_item_video_loop',
			'value' => $video_loop,
			'label' => esc_html__( 'Loop', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'select-boolean',
			'name' => '_crocal_eutf_single_item_video_muted',
			'value' => $video_muted,
			'label' => array(
				"title" => esc_html__( 'Muted', 'crocal' ),
				"info" => esc_html__( 'Note: Due to new browser/device restrictions, videos with sound are no longer allowed to autoplay in Chrome, Safari and mobile devices. In these cases videos will be automatically muted.', 'crocal' ),
			),

		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'select',
			'name' => '_crocal_eutf_single_item_video_effect',
			'options' => array(
				'' => esc_html__( 'None', 'crocal' ),
				'animated' => esc_html__( 'Animated', 'crocal' ),
			),
			'value' => $video_effect,
			'label' => esc_html__( 'Video Effect', 'crocal' ),
		)
	);


}

/**
 * Prints Item Background Video Options
 */
function crocal_eutf_print_admin_feature_item_youtube_options( $item ) {

	$video_url = crocal_eutf_array_value( $item, 'video_url' );
	$video_start = crocal_eutf_array_value( $item, 'video_start' );
	$video_end = crocal_eutf_array_value( $item, 'video_end' );
	crocal_eutf_print_admin_option(
		array(
			'type' => 'label',
			'label' => esc_html__( 'YouTube/Vimeo Video', 'crocal' ),
		)
	);

	crocal_eutf_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => '_crocal_eutf_single_item_video_url',
			'value' => $video_url,
			'label' => array(
				"title" => esc_html__( 'YouTube/Vimeo link', 'crocal' ),
				"desc" => esc_html__( 'e.g: https://www.youtube.com/watch?v=lMJXxhRFO1k', 'crocal' ),
			),
			'width' => 'fullwidth',
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => '_crocal_eutf_single_item_video_start',
			'value' => $video_start,
			'label' => array(
				"title" => esc_html__( 'Start at:', 'crocal' ),
				"desc" => esc_html__( 'Value in seconds', 'crocal' ),
				"info" => esc_html__( 'Note: Only available in YouTube videos.', 'crocal' ),
			),
		)
	);
	crocal_eutf_print_admin_option(
		array(
			'type' => 'textfield',
			'name' => '_crocal_eutf_single_item_video_end',
			'value' => $video_end,
			'label' => array(
				"title" => esc_html__( 'End at:', 'crocal' ),
				"desc" => esc_html__( 'Value in seconds', 'crocal' ),
				"info" => esc_html__( 'Note: Only available in YouTube videos.', 'crocal' ),
			),
		)
	);
}


function crocal_eutf_admin_get_feature_section( $post_id ) {

	$post_type = get_post_type( $post_id );

	//Feature Section
	$feature_section = get_post_meta( $post_id, '_crocal_eutf_feature_section', true );

	//Feature Settings
	$feature_settings = crocal_eutf_array_value( $feature_section, 'feature_settings' );

	$feature_element = crocal_eutf_array_value( $feature_settings, 'element' );
	$feature_size = crocal_eutf_array_value( $feature_settings, 'size' );
	$feature_height = crocal_eutf_array_value( $feature_settings, 'height', '60' );
	$feature_min_height = crocal_eutf_array_value( $feature_settings, 'min_height', '200' );
	$feature_bg_color  = crocal_eutf_array_value( $feature_settings, 'bg_color', 'dark' );
	$feature_bg_color_custom  = crocal_eutf_array_value( $feature_settings, 'bg_color_custom', '#eef1f6' );
	$feature_header_position = crocal_eutf_array_value( $feature_settings, 'header_position', 'above' );
	$feature_bg_gradient_color_1  = crocal_eutf_array_value( $feature_settings, 'bg_gradient_color_1', '#034e90' );
	$feature_bg_gradient_color_2  = crocal_eutf_array_value( $feature_settings, 'bg_gradient_color_2', '#19b4d7' );
	$feature_bg_gradient_direction  = crocal_eutf_array_value( $feature_settings, 'bg_gradient_direction', '90' );
	$feature_separator_bottom  = crocal_eutf_array_value( $feature_settings, 'separator_bottom' );
	$feature_separator_bottom_size  = crocal_eutf_array_value( $feature_settings, 'separator_bottom_size', '90px' );
	$feature_separator_bottom_color  = crocal_eutf_array_value( $feature_settings, 'separator_bottom_color', '#ffffff' );

	//Feature Single Item
	$feature_single_item = crocal_eutf_array_value( $feature_section, 'single_item' );
	$feature_single_item_button = crocal_eutf_array_value( $feature_single_item, 'button' );
	$feature_single_item_button2 = crocal_eutf_array_value( $feature_single_item, 'button2' );


	//Slider Item
	$slider_items = crocal_eutf_array_value( $feature_section, 'slider_items' );
	$slider_settings = crocal_eutf_array_value( $feature_section, 'slider_settings' );

	$slider_speed = crocal_eutf_array_value( $slider_settings, 'slideshow_speed', '3500' );
	$slider_pause = crocal_eutf_array_value( $slider_settings, 'slider_pause', 'no' );
	$slider_dir_nav = crocal_eutf_array_value( $slider_settings, 'direction_nav', '1' );
	$slider_dir_nav_color = crocal_eutf_array_value( $slider_settings, 'direction_nav_color', 'light' );
	$slider_transition = crocal_eutf_array_value( $slider_settings, 'transition', 'slide' );
	$slider_effect = crocal_eutf_array_value( $slider_settings, 'slider_effect' );
	$slider_pagination = crocal_eutf_array_value( $slider_settings, 'pagination', 'yes' );

	//Map Item
	$map_items = crocal_eutf_array_value( $feature_section, 'map_items' );
	$map_settings = crocal_eutf_array_value( $feature_section, 'map_settings' );

	$map_zoom = crocal_eutf_array_value( $map_settings, 'zoom', 14 );
	$map_marker_type = crocal_eutf_array_value( $map_settings, 'marker_type' );
	$map_marker = crocal_eutf_array_value( $map_settings, 'marker' );
	$map_marker_bg_color = crocal_eutf_array_value( $map_settings, 'marker_bg_color', 'primary-1' );
	$map_disable_style = crocal_eutf_array_value( $map_settings, 'disable_style', 'no' );

	//Revolution slider
	$revslider_alias = crocal_eutf_array_value( $feature_section, 'revslider_alias' );

	global $crocal_eutf_area_height;

?>

		<div class="eut-fields-wrapper eut-highlight">
			<div class="eut-label">
				<label for="eut-page-feature-element">
					<span class="eut-title"><?php esc_html_e( 'Feature Element', 'crocal' ); ?></span>
					<span class="eut-description"><?php esc_html_e( 'Select feature section element', 'crocal' ); ?></span>
				</label>
			</div>
			<div class="eut-field-items-wrapper">
				<div class="eut-field-item">
					<select id="eut-page-feature-element" name="_crocal_eutf_page_feature_element">
						<option value="" <?php selected( "", $feature_element ); ?>><?php esc_html_e( 'None', 'crocal' ); ?></option>
						<option value="title" <?php selected( "title", $feature_element ); ?>><?php esc_html_e( 'Title', 'crocal' ); ?></option>
						<option value="image" <?php selected( "image", $feature_element ); ?>><?php esc_html_e( 'Image', 'crocal' ); ?></option>
						<option value="video" <?php selected( "video", $feature_element ); ?>><?php esc_html_e( 'Video', 'crocal' ); ?></option>
						<option value="youtube" <?php selected( "youtube", $feature_element ); ?>><?php esc_html_e( 'YouTube/Vimeo', 'crocal' ); ?></option>
						<option value="slider" <?php selected( "slider", $feature_element ); ?>><?php esc_html_e( 'Slider', 'crocal' ); ?></option>
						<option value="revslider" <?php selected( "revslider", $feature_element ); ?>><?php esc_html_e( 'Revolution Slider', 'crocal' ); ?></option>
						<option value="map" <?php selected( "map", $feature_element ); ?>><?php esc_html_e( 'Map', 'crocal' ); ?></option>
					</select>
				</div>
			</div>
		</div>

		<div id="eut-feature-section-options" class="eut-feature-section-item postbox">

			<div class="eut-fields-wrapper eut-feature-options-wrapper">
				<div class="eut-label">
					<label for="eut-page-feature-element">
						<span class="eut-title"><?php esc_html_e( 'Feature Size', 'crocal' ); ?></span>
						<span class="eut-description"><?php esc_html_e( 'With Custom Size option you can select the feature height.', 'crocal' ); ?></span>
					</label>
				</div>
				<div class="eut-field-items-wrapper">
					<div class="eut-field-item">
						<select name="_crocal_eutf_page_feature_size" id="eut-page-feature-size">
							<option value="" <?php selected( "", $feature_size ); ?>><?php esc_html_e( 'Full Screen', 'crocal' ); ?></option>
							<option value="custom" <?php selected( "custom", $feature_size ); ?>><?php esc_html_e( 'Custom Size', 'crocal' ); ?></option>
						</select>
					</div>
					<div class="eut-field-item">
						<span id="eut-feature-section-height">
							<select name="_crocal_eutf_page_feature_height">
								<?php crocal_eutf_print_select_options( $crocal_eutf_area_height, $feature_height ); ?>
							</select>
							<span class="eut-sub-title"><?php esc_html_e( 'Height', 'crocal' ); ?></span>
							<input type="text" name="_crocal_eutf_page_feature_min_height" value="<?php echo esc_attr( $feature_min_height ); ?>"/>
							<span class="eut-sub-title"><?php esc_html_e( 'Minimum Height in px', 'crocal' ); ?></span>
						</span>
					</div>
				</div>
			</div>
			<?php
				crocal_eutf_print_admin_option(
					array(
						'type' => 'select',
						'options' => array(
							'above' => esc_html__( 'Header above Feature', 'crocal' ),
							'below' => esc_html__( 'Header below Feature', 'crocal' ),
						),
						'name' => '_crocal_eutf_page_feature_header_position',
						'value' => $feature_header_position,
						'label' => array(
							'title' => esc_html__( 'Feature/Header Position', 'crocal' ),
							'desc' => esc_html__( 'With this option header will be shown above or below feature section.', 'crocal' ),
						),
					)
				);
			?>
			<div id="eut-feature-options-wrapper" class="eut-feature-options-wrapper">
			<?php

				crocal_eutf_print_admin_option(
					array(
						'type' => 'select-colorpicker',
						'name' => '_crocal_eutf_page_feature_bg_color',
						'id' => '_crocal_eutf_page_feature_bg_color',
						'value' => $feature_bg_color,
						'value2' => $feature_bg_color_custom,
						'default_value2' => $feature_bg_color_custom,
						'label' => esc_html__( 'Background Color', 'crocal' ),
						'multiple' => 'multi',
						'type_usage' => 'feature-bg',
						'group_id' => 'eut-feature-options-wrapper',
					)
				);

				crocal_eutf_print_admin_option(
					array(
						'type' => 'colorpicker',
						'name' => '_crocal_eutf_page_feature_bg_gradient_color_1',
						'value' => $feature_bg_gradient_color_1,
						'label' => esc_html__( 'Custom Color 1', 'crocal' ),
						'dependency' =>
						'[
							{ "id" : "_crocal_eutf_page_feature_bg_color", "values" : ["gradient"] }
						]',
					)
				);
				crocal_eutf_print_admin_option(
					array(
						'type' => 'colorpicker',
						'name' => '_crocal_eutf_page_feature_bg_gradient_color_2',
						'value' => $feature_bg_gradient_color_2,
						'label' => esc_html__( 'Custom Color 2', 'crocal' ),
						'dependency' =>
						'[
							{ "id" : "_crocal_eutf_page_feature_bg_color", "values" : ["gradient"] }
						]',
					)
				);
				crocal_eutf_print_admin_option(
					array(
						'type' => 'select',
						'name' => '_crocal_eutf_page_feature_bg_gradient_direction',
						'value' => $feature_bg_gradient_direction,
						'options' => array(
							'90' => esc_html__( "Left to Right", 'crocal' ),
							'135' => esc_html__( "Left Top to Right Bottom", 'crocal' ),
							'45' => esc_html__( "Left Bottom to Right Top", 'crocal' ),
							'180' => esc_html__( "Bottom to Top", 'crocal' ),
						),
						'label' => array(
							"title" => esc_html__( 'Gradient Direction', 'crocal' ),
						),
						'dependency' =>
						'[
							{ "id" : "_crocal_eutf_page_feature_bg_color", "values" : ["gradient"] }
						]',
					)
				);

				$crocal_eutf_feature_separator_list = array(
					'' => esc_html__( "None", 'crocal' ),
					'triangle-separator' => esc_html__( "Triangle", 'crocal' ),
					'large-triangle-separator' => esc_html__( "Large Triangle", 'crocal' ),
					'curve-separator' => esc_html__( "Curve", 'crocal' ),
					'curve-left-separator' => esc_html__( "Curve Left", 'crocal' ),
					'curve-right-separator' => esc_html__( "Curve Right", 'crocal' ),
					'tilt-left-separator' => esc_html__( "Tilt Left", 'crocal' ),
					'tilt-right-separator' => esc_html__( "Tilt Right", 'crocal' ),
					'round-split-separator' => esc_html__( "Round Split", 'crocal' ),
					'wave-left-separator' => esc_html__( "Wave Left", 'crocal' ),
					'wave-right-separator' => esc_html__( "Wave Right", 'crocal' ),
					'wave-2-left-separator' => esc_html__( "Wave 2 Left", 'crocal' ),
					'wave-2-right-separator' => esc_html__( "Wave 2 Right", 'crocal' ),
					'line-separator' => esc_html__( "Line", 'crocal' ),
					'torn-paper-separator' => esc_html__( "Torn Paper", 'crocal' ),
				);

				$crocal_eutf_feature_separator_size_list = array(
					'30px' => esc_html__( "30px", 'crocal' ),
					'60px' => esc_html__( "60px", 'crocal' ),
					'90px' => esc_html__( "90px", 'crocal' ),
					'120px'=> esc_html__( "120px", 'crocal' ),
					'150px'=> esc_html__( "150px", 'crocal' ),
					'180px'=> esc_html__( "180px", 'crocal' ),
					'200px'=> esc_html__( "200px", 'crocal' ),
					'300px'=> esc_html__( "300px", 'crocal' ),
					'10%' => esc_html__( "10%", 'crocal' ),
					'20%' => esc_html__( "20%", 'crocal' ),
					'30%' => esc_html__( "30%", 'crocal' ),
					'40%' => esc_html__( "40%", 'crocal' ),
					'50%' => esc_html__( "50%", 'crocal' ),
					'60%' => esc_html__( "60%", 'crocal' ),
					'70%' => esc_html__( "70%", 'crocal' ),
					'80%' => esc_html__( "80%", 'crocal' ),
					'90%' => esc_html__( "90%", 'crocal' ),
					'100%' => esc_html__( "100%", 'crocal' ),
				);
				crocal_eutf_print_admin_option(
					array(
						'type' => 'select',
						'name' => '_crocal_eutf_page_feature_separator_bottom',
						'id' => '_crocal_eutf_page_feature_separator_bottom',
						'value' => $feature_separator_bottom,
						'options' => $crocal_eutf_feature_separator_list,
						'label' => array(
							"title" => esc_html__( 'Bottom Separator', 'crocal' ),
						),
						'group_id' => 'eut-feature-options-wrapper',
					)
				);
				crocal_eutf_print_admin_option(
					array(
						'type' => 'colorpicker',
						'name' => '_crocal_eutf_page_feature_separator_bottom_color',
						'value' => $feature_separator_bottom_color,
						'label' => esc_html__( 'Bottom Separator Color', 'crocal' ),
						'dependency' =>
						'[
							{ "id" : "_crocal_eutf_page_feature_separator_bottom", "value_not_equal_to" : [""] }
						]',
					)
				);
				crocal_eutf_print_admin_option(
					array(
						'type' => 'select',
						'name' => '_crocal_eutf_page_feature_separator_bottom_size',
						'value' => $feature_separator_bottom_size,
						'options' => $crocal_eutf_feature_separator_size_list,
						'label' => array(
							"title" => esc_html__( 'Bottom Separator Size', 'crocal' ),
						),
						'dependency' =>
						'[
							{ "id" : "_crocal_eutf_page_feature_separator_bottom", "value_not_equal_to" : [""] }
						]',
					)
				);
			?>
			</div>

		</div>



		<div id="eut-feature-section-slider" class="eut-feature-section-item">

			<div class="postbox">
				<h3 class="eut-title">
					<span><?php esc_html_e( 'Slider Settings', 'crocal' ); ?></span>
				</h3>
				<div class="inside">

					<?php
						crocal_eutf_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => '_crocal_eutf_page_slider_settings_speed',
								'value' => $slider_speed,
								'label' => esc_html__( 'Slideshow Speed', 'crocal' ),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_page_slider_settings_pause',
								'options' => array(
									'no' => esc_html__( 'No', 'crocal' ),
									'yes' => esc_html__( 'Yes', 'crocal' ),
								),
								'value' => $slider_pause,
								'label' => esc_html__( 'Pause on Hover', 'crocal' ),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'options' => array(
									'yes' => esc_html__( 'Yes', 'crocal' ),
									'no' => esc_html__( 'No', 'crocal' ),
								),
								'name' => '_crocal_eutf_page_slider_settings_pagination',
								'value' => $slider_pagination,
								'label' => array(
									'title' => esc_html__( 'Pagination', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'options' => array(
									'1' => esc_html__( 'Arrows', 'crocal' ),
									'2' => esc_html__( 'Numbers', 'crocal' ),
									'0' => esc_html__( 'No Navigation', 'crocal' ),
								),
								'name' => '_crocal_eutf_page_slider_settings_direction_nav',
								'value' => $slider_dir_nav,
								'label' => array(
									'title' => esc_html__( 'Navigation Buttons', 'crocal' ),
								),
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'options' => array(
									'slide' => esc_html__( 'Slide', 'crocal' ),
									'fade' => esc_html__( 'Fade', 'crocal' ),
									'backSlide' => esc_html__( 'Back Slide', 'crocal' ),
									'goDown' => esc_html__( 'Go Down', 'crocal' ),
								),
								'name' => '_crocal_eutf_page_slider_settings_transition',
								'value' => $slider_transition,
								'label' => array(
									'title' => esc_html__( 'Transition', 'crocal' ),
								),
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'options' => array(
									'' => esc_html__( 'None', 'crocal' ),
									'animated' => esc_html__( 'Animated', 'crocal' ),
									'parallax' => esc_html__( 'Classic Parallax', 'crocal' ),
									'advanced-parallax' => esc_html__( 'Advanced Parallax', 'crocal' ),
									'fixed-section' => esc_html__( 'Fixed Section', 'crocal' ),
								),
								'name' => '_crocal_eutf_page_slider_settings_effect',
								'value' => $slider_effect,
								'label' => array(
									'title' => esc_html__( 'Slider Effect', 'crocal' ),
								),
							)
						);
					?>

					<div class="eut-fields-wrapper">
						<div class="eut-label">
							<label for="eut-page-feature-element">
								<span class="eut-title"><?php esc_html_e( 'Add Slides', 'crocal' ); ?></span>
							</label>
						</div>
						<div class="eut-field-items-wrapper">
							<div class="eut-field-item">
								<input type="button" class="eut-upload-feature-slider-button button-primary" value="<?php esc_attr_e( 'Insert Images to Slider', 'crocal' ); ?>"/>
								<span id="eut-upload-feature-slider-button-spinner" class="eut-action-spinner"></span>
							</div>
						</div>
					</div>
					<?php if ( 'product' != $post_type && 'tribe_events' != $post_type ) { ?>
					<div class="eut-fields-wrapper">
						<div class="eut-label">
							<label for="eut-page-feature-element">
								<span class="eut-title"><?php esc_html_e( 'Add Post Slides', 'crocal' ); ?></span>
								<span class="eut-description"><?php esc_html_e( 'Type the specific post ids you want to include separated by comma ( , ) and click Insert Posts to Slider.', 'crocal' ); ?></span>
							</label>
						</div>
						<div class="eut-field-items-wrapper">
							<div class="eut-field-item">
								<input type="button" class="eut-upload-feature-slider-post-button button-primary" value="<?php esc_attr_e( 'Insert Posts to Slider', 'crocal' ); ?>"/>
							</div>
							<div class="eut-field-item">
								<input id="eut-upload-feature-slider-post-selection" type="text" value="" />
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div id="eut-feature-slider-container" data-mode="slider-full" class="eut-feature-section-item">
			<?php
				if( !empty( $slider_items ) ) {
					crocal_eutf_print_admin_feature_slider_items( $slider_items );
				}
			?>
		</div>

		<div id="eut-feature-map-container" class="eut-feature-section-item">
			<div class="eut-map-item postbox">
				<h3 class="eut-title">
					<span><?php esc_html_e( 'Map', 'crocal' ); ?></span>
				</h3>
				<div class="inside">
					<div class="eut-fields-wrapper">
						<div class="eut-label">
							<label for="eut-page-feature-element">
								<span class="eut-title"><?php esc_html_e( 'Single Point Zoom', 'crocal' ); ?></span>
							</label>
						</div>
						<div class="eut-field-items-wrapper">
							<div class="eut-field-item">
								<select id="eut-page-feature-map-zoom" name="_crocal_eutf_page_feature_map_zoom">
									<?php for ( $i=1; $i < 20; $i++ ) { ?>
										<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, $map_zoom ); ?>><?php echo esc_html( $i ); ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<?php

					crocal_eutf_print_admin_option(
						array(
							'type' => 'select',
							'id' => '_crocal_eutf_page_feature_map_marker_type',
							'name' => '_crocal_eutf_page_feature_map_marker_type',
							'value' => $map_marker_type,
							'label' => array(
								"title" => esc_html__( 'Global Marker Type', 'crocal' ),
							),
							'options' => array(
								'' => esc_html__( 'Image', 'crocal' ),
								'pulse-dot' => esc_html__( 'Pulse Dot Icon', 'crocal' ),
								'dot' => esc_html__( 'Dot Icon', 'crocal' ),
							),
							'group_id' => 'eut-feature-map-container',
						)
					);

					crocal_eutf_print_admin_option(
						array(
							'type' => 'select-image',
							'name' => '_crocal_eutf_page_feature_map_marker',
							'value' => $map_marker,
							'label' => array(
								"title" => esc_html__( 'Global Marker', 'crocal' ),
							),
							'width' => 'fullwidth',
							'dependency' =>
							'[
								{ "id" : "_crocal_eutf_page_feature_map_marker_type", "values" : [""] }
							]',
							'group_id' => 'eut-feature-map-container',
						)
					);
					crocal_eutf_print_admin_option(
						array(
							'type' => 'select-button-color',
							'name' => '_crocal_eutf_page_feature_map_marker_bg_color',
							'id' => '_crocal_eutf_page_feature_map_marker_bg_color',
							'value' => $map_marker_bg_color,
							'label' => esc_html__( 'Marker Background Color', 'crocal' ),
							'dependency' =>
							'[
								{ "id" : "_crocal_eutf_page_feature_map_marker_type", "value_not_equal_to" : [""] }
							]',
							'group_id' => 'eut-feature-map-container',
						)
					);
					?>
					<div class="eut-fields-wrapper">
						<div class="eut-label">
							<label for="eut-page-feature-element">
								<span class="eut-title"><?php esc_html_e( 'Disable Custom Style', 'crocal' ); ?></span>
							</label>
						</div>
						<div class="eut-field-items-wrapper">
							<div class="eut-field-item">
								<select id="eut-page-feature-map-disable-style" name="_crocal_eutf_page_feature_map_disable_style">
									<option value="no" <?php selected( "no", $map_disable_style ); ?>><?php esc_html_e( 'No', 'crocal' ); ?></option>
									<option value="yes" <?php selected( "yes", $map_disable_style ); ?>><?php esc_html_e( 'Yes', 'crocal' ); ?></option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="eut-fields-wrapper">
					<div class="eut-label">
						<label for="eut-page-feature-element">
							<span class="eut-title"><?php esc_html_e( 'Add Map Points', 'crocal' ); ?></span>
						</label>
					</div>
					<div class="eut-field-items-wrapper">
						<div class="eut-field-item">
							<input type="button" id="eut-upload-multi-map-point" class="eut-upload-multi-map-point button-primary" value="<?php esc_attr_e( 'Insert Point to Map', 'crocal' ); ?>"/>
							<span id="eut-upload-multi-map-button-spinner" class="eut-action-spinner"></span>
						</div>
					</div>
				</div>
			</div>
			<?php crocal_eutf_print_admin_feature_map_items( $map_items ); ?>
		</div>

		<div id="eut-feature-single-container" class="eut-feature-section-item">
			<div class="eut-video-item postbox">
				<span class="eut-modal-spinner"></span>
				<h3 class="eut-title">
					<span><?php esc_html_e( 'Options', 'crocal' ); ?></span>
				</h3>
				<div class="inside">

					<!--  METABOXES -->
					<div class="eut-metabox-content">

						<!-- TABS -->
						<div class="eut-tabs">

							<ul class="eut-tab-links">
								<li class="eut-feature-required eut-item-feature-video-settings active"><a id="eut-feature-single-tab-video-link" href="#eut-feature-single-tab-video"><?php esc_html_e( 'Video', 'crocal' ); ?></a></li>
								<li class="eut-feature-required eut-item-feature-youtube-settings active"><a id="eut-feature-single-tab-youtube-link" href="#eut-feature-single-tab-youtube"><?php esc_html_e( 'YouTube/Vimeo', 'crocal' ); ?></a></li>
								<li class="eut-feature-required eut-item-feature-bg-settings"><a id="eut-feature-single-tab-bg-link" href="#eut-feature-single-tab-bg"><?php esc_html_e( 'Background', 'crocal' ); ?></a></li>
								<li class="eut-feature-required eut-item-feature-content-settings"><a id="eut-feature-single-tab-content-link" href="#eut-feature-single-tab-content"><?php esc_html_e( 'Content', 'crocal' ); ?></a></li>
								<li class="eut-feature-required eut-item-feature-revslider-settings"><a id="eut-feature-single-tab-revslider-link" href="#eut-feature-single-tab-revslider"><?php esc_html_e( 'Revolution Slider', 'crocal' ); ?></a></li>
								<li class="eut-feature-required eut-item-feature-button-settings"><a href="#eut-feature-single-tab-button"><?php esc_html_e( 'First Button', 'crocal' ); ?></a></li>
								<li class="eut-feature-required eut-item-feature-button-settings"><a href="#eut-feature-single-tab-button2"><?php esc_html_e( 'Second Button', 'crocal' ); ?></a></li>
								<li class="eut-feature-required eut-item-feature-extra-settings"><a href="#eut-feature-single-tab-extra"><?php esc_html_e( 'Extra', 'crocal' ); ?></a></li>
							</ul>

							<div class="eut-tab-content">
								<div id="eut-feature-single-tab-video" class="eut-tab-item">
									<?php crocal_eutf_print_admin_feature_item_video_options( $feature_single_item ); ?>
								</div>
								<div id="eut-feature-single-tab-youtube" class="eut-tab-item">
									<?php crocal_eutf_print_admin_feature_item_youtube_options( $feature_single_item ); ?>
								</div>
								<div id="eut-feature-single-tab-revslider" class="eut-tab-item">
									<?php
										crocal_eutf_print_admin_option(
												array(
													'type' => 'select',
													'options' => crocal_eutf_get_revolution_selection(),
													'name' => '_crocal_eutf_page_revslider',
													'value' => $revslider_alias,
													'label' => array(
														'title' => esc_html__( 'Revolution Slider', 'crocal' ),
													),
												)
											);
									?>
								</div>
								<div id="eut-feature-single-tab-bg" class="eut-tab-item">
									<?php crocal_eutf_print_admin_feature_item_background_options( $feature_single_item ); ?>
									<?php crocal_eutf_print_admin_feature_item_overlay_options( $feature_single_item ); ?>
								</div>
								<div id="eut-feature-single-tab-content" class="eut-tab-item">
									<?php crocal_eutf_print_admin_feature_item_content_options( $feature_single_item ); ?>
								</div>
								<div id="eut-feature-single-tab-button" class="eut-tab-item">
									<?php crocal_eutf_print_admin_feature_item_button_options( $feature_single_item_button, '_crocal_eutf_single_item_button_' ); ?>
								</div>
								<div id="eut-feature-single-tab-button2" class="eut-tab-item">
									<?php crocal_eutf_print_admin_feature_item_button_options( $feature_single_item_button2, '_crocal_eutf_single_item_button2_' ); ?>
								</div>
								<div id="eut-feature-single-tab-extra" class="eut-tab-item">
									<?php crocal_eutf_print_admin_feature_item_extra_options( $feature_single_item ); ?>
								</div>
							</div>

						</div>
						<!-- END TABS -->

					</div>
					<!-- END  METABOXES -->
				</div>
			</div>
		</div>
<?php
}

function crocal_eutf_admin_save_feature_section( $post_id ) {

	//Feature Section variable
	$feature_section = array();


	if ( isset( $_POST['_crocal_eutf_page_feature_element'] ) ) {

		//Feature Settings

		$feature_section['feature_settings'] = array (
			'element' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_element'] ),
			'size' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_size'] ),
			'height' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_height'] ),
			'min_height' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_min_height'] ),
			'header_position' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_header_position'] ),
			'bg_color' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_bg_color'] ),
			'bg_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_bg_color_custom'] ),
			'bg_gradient_color_1' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_bg_gradient_color_1'] ),
			'bg_gradient_color_2' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_bg_gradient_color_2'] ),
			'bg_gradient_direction' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_bg_gradient_direction'] ),
			'separator_bottom' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_separator_bottom'] ),
			'separator_bottom_color' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_separator_bottom_color'] ),
			'separator_bottom_size' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_separator_bottom_size'] ),
		);


		//Feature Revolution Slider
		if ( isset( $_POST['_crocal_eutf_page_revslider'] ) ) {
			$feature_section['revslider_alias'] = sanitize_text_field( $_POST['_crocal_eutf_page_revslider'] );
		}

		//Feature Single Item
		if ( isset( $_POST['_crocal_eutf_single_item_title'] ) ) {


			$feature_section['single_item'] = array (

				'title' => wp_filter_post_kses( $_POST['_crocal_eutf_single_item_title'] ),
				'content_bg_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_title_content_bg_color'] ),
				'content_bg_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_single_item_title_content_bg_color_custom'] ),
				'title_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_title_color'] ),
				'title_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_single_item_title_color_custom'] ),
				'title_tag' => sanitize_text_field( $_POST['_crocal_eutf_single_item_title_tag'] ),
				'caption' => wp_filter_post_kses( $_POST['_crocal_eutf_single_item_caption'] ),
				'caption_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_caption_color'] ),
				'caption_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_single_item_caption_color_custom'] ),
				'caption_tag' => sanitize_text_field( $_POST['_crocal_eutf_single_item_caption_tag'] ),
				'subheading' => wp_filter_post_kses( $_POST['_crocal_eutf_single_item_subheading'] ),
				'subheading_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_subheading_color'] ),
				'subheading_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_single_item_subheading_color_custom'] ),
				'subheading_tag' => sanitize_text_field( $_POST['_crocal_eutf_single_item_subheading_tag'] ),
				'subheading_family' => sanitize_text_field( $_POST['_crocal_eutf_single_item_subheading_family'] ),
				'title_family' => sanitize_text_field( $_POST['_crocal_eutf_single_item_title_family'] ),
				'caption_family' => sanitize_text_field( $_POST['_crocal_eutf_single_item_caption_family'] ),
				'content_size' => sanitize_text_field( $_POST['_crocal_eutf_single_item_content_size'] ),
				'content_align' => sanitize_text_field( $_POST['_crocal_eutf_single_item_content_align'] ),
				'content_position' => sanitize_text_field( $_POST['_crocal_eutf_single_item_content_position'] ),
				'content_animation' => sanitize_text_field( $_POST['_crocal_eutf_single_item_content_animation'] ),
				'container_size' => sanitize_text_field( $_POST['_crocal_eutf_single_item_container_size'] ),
				'content_image_id' => sanitize_text_field( $_POST['_crocal_eutf_single_item_content_image_id'] ),
				'content_image_size' => sanitize_text_field( $_POST['_crocal_eutf_single_item_content_image_size'] ),
				'content_image_max_height' => sanitize_text_field( $_POST['_crocal_eutf_single_item_content_image_max_height'] ),
				'content_image_responsive_max_height' => sanitize_text_field( $_POST['_crocal_eutf_single_item_content_image_responsive_max_height'] ),
				'pattern_overlay' => sanitize_text_field( $_POST['_crocal_eutf_single_item_pattern_overlay'] ),
				'color_overlay' => sanitize_text_field( $_POST['_crocal_eutf_single_item_color_overlay'] ),
				'color_overlay_custom' => sanitize_text_field( $_POST['_crocal_eutf_single_item_color_overlay_custom'] ),
				'opacity_overlay' => sanitize_text_field( $_POST['_crocal_eutf_single_item_opacity_overlay'] ),
				'gradient_overlay_custom_1' => sanitize_text_field( $_POST['_crocal_eutf_single_item_gradient_overlay_custom_1'] ),
				'gradient_overlay_custom_1_opacity' => sanitize_text_field( $_POST['_crocal_eutf_single_item_gradient_overlay_custom_1_opacity'] ),
				'gradient_overlay_custom_2' => sanitize_text_field( $_POST['_crocal_eutf_single_item_gradient_overlay_custom_2'] ),
				'gradient_overlay_custom_2_opacity' => sanitize_text_field( $_POST['_crocal_eutf_single_item_gradient_overlay_custom_2_opacity'] ),
				'gradient_overlay_direction' => sanitize_text_field( $_POST['_crocal_eutf_single_item_gradient_overlay_direction'] ),
				'bg_image_id' => sanitize_text_field( $_POST['_crocal_eutf_single_item_bg_image_id'] ),
				'bg_image_size' => sanitize_text_field( $_POST['_crocal_eutf_single_item_bg_image_size'] ),
				'bg_position' => sanitize_text_field( $_POST['_crocal_eutf_single_item_bg_position'] ),
				'bg_tablet_sm_position' => sanitize_text_field( $_POST['_crocal_eutf_single_item_bg_tablet_sm_position'] ),
				'image_effect' => sanitize_text_field( $_POST['_crocal_eutf_single_item_image_effect'] ),
				'video_webm' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_webm'] ),
				'video_mp4' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_mp4'] ),
				'video_ogv' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_ogv'] ),
				'video_poster' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_poster'] ),
				'video_device' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_device'] ),
				'video_loop' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_loop'] ),
				'video_muted' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_muted'] ),
				'video_effect' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_effect'] ),
				'video_url' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_url'] ),
				'video_start' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_start'] ),
				'video_end' => sanitize_text_field( $_POST['_crocal_eutf_single_item_video_end'] ),
				'button' => array(
					'id' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_id'] ),
					'text' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_text'] ),
					'url' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_url'] ),
					'target' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_target'] ),
					'color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_color'] ),
					'hover_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_hover_color'] ),
					'gradient_1_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_gradient_1_color'] ),
					'gradient_2_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_gradient_2_color'] ),
					'size' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_size'] ),
					'shape' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_shape'] ),
					'shadow' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_shadow'] ),
					'type' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_type'] ),
					'class' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button_class'] ),
				),
				'button2' => array(
					'id' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_id'] ),
					'text' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_text'] ),
					'url' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_url'] ),
					'target' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_target'] ),
					'color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_color'] ),
					'hover_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_hover_color'] ),
					'gradient_1_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_gradient_1_color'] ),
					'gradient_2_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_gradient_2_color'] ),
					'size' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_size'] ),
					'shape' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_shape'] ),
					'shadow' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_shadow'] ),
					'type' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_type'] ),
					'class' => sanitize_text_field( $_POST['_crocal_eutf_single_item_button2_class'] ),
				),
				'arrow_enabled' => sanitize_text_field( $_POST['_crocal_eutf_single_item_arrow_enabled'] ),
				'arrow_text' => sanitize_text_field( $_POST['_crocal_eutf_single_item_arrow_text'] ),
				'arrow_color' => sanitize_text_field( $_POST['_crocal_eutf_single_item_arrow_color'] ),
				'arrow_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_single_item_arrow_color_custom'] ),
				'el_class' => sanitize_text_field( $_POST['_crocal_eutf_single_item_el_class'] ),

			);
		}

		//Feature Slider Items
		$slider_items = array();
		if ( isset( $_POST['_crocal_eutf_slider_item_id'] ) ) {

			$num_of_images = sizeof( $_POST['_crocal_eutf_slider_item_id'] );
			for ( $i=0; $i < $num_of_images; $i++ ) {

				$slide = array (
					'id' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_id'][ $i ] ),
					'type' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_type'][ $i ] ),
					'post_id' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_post_id'][ $i ] ),
					'bg_image_id' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_bg_image_id'][ $i ] ),
					'bg_image_size' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_bg_image_size'][ $i ] ),
					'bg_position' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_bg_position'][ $i ] ),
					'bg_tablet_sm_position' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_bg_tablet_sm_position'][ $i ] ),
					'header_style' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_header_style'][ $i ] ),
					'title' => wp_filter_post_kses( $_POST['_crocal_eutf_slider_item_title'][ $i ] ),
					'content_bg_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_title_content_bg_color'][ $i ] ),
					'content_bg_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_title_content_bg_color_custom'][ $i ] ),
					'title_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_title_color'][ $i ] ),
					'title_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_title_color_custom'][ $i ] ),
					'title_tag' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_title_tag'][ $i ] ),
					'caption' => wp_filter_post_kses( $_POST['_crocal_eutf_slider_item_caption'][ $i ] ),
					'caption_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_caption_color'][ $i ] ),
					'caption_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_caption_color_custom'][ $i ] ),
					'caption_tag' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_caption_tag'][ $i ] ),
					'subheading' => wp_filter_post_kses( $_POST['_crocal_eutf_slider_item_subheading'][ $i ] ),
					'subheading_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_subheading_color'][ $i ] ),
					'subheading_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_subheading_color_custom'][ $i ] ),
					'subheading_tag' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_subheading_tag'][ $i ] ),
					'subheading_family' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_subheading_family'][ $i ] ),
					'title_family' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_title_family'][ $i ] ),
					'caption_family' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_caption_family'][ $i ] ),
					'content_size' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_content_size'][ $i ] ),
					'content_align' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_content_align'][ $i ] ),
					'content_position' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_content_position'][ $i ] ),
					'content_animation' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_content_animation'][ $i ] ),
					'container_size' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_container_size'][ $i ] ),
					'content_image_id' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_content_image_id'][ $i ] ),
					'content_image_size' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_content_image_size'][ $i ] ),
					'content_image_max_height' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_content_image_max_height'][ $i ] ),
					'content_image_responsive_max_height' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_content_image_responsive_max_height'][ $i ] ),
					'pattern_overlay' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_pattern_overlay'][ $i ] ),
					'color_overlay' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_color_overlay'][ $i ] ),
					'color_overlay_custom' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_color_overlay_custom'][ $i ] ),
					'opacity_overlay' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_opacity_overlay'][ $i ] ),
					'gradient_overlay_custom_1' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_gradient_overlay_custom_1'][ $i ] ),
					'gradient_overlay_custom_1_opacity' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_gradient_overlay_custom_1_opacity'][ $i ] ),
					'gradient_overlay_custom_2' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_gradient_overlay_custom_2'][ $i ] ),
					'gradient_overlay_custom_2_opacity' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_gradient_overlay_custom_2_opacity'][ $i ] ),
					'gradient_overlay_direction' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_gradient_overlay_direction'][ $i ] ),
					'button' => array(
						'id' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_id'][ $i ] ),
						'text' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_text'][ $i ] ),
						'url' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_url'][ $i ] ),
						'target' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_target'][ $i ] ),
						'color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_color'][ $i ] ),
						'hover_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_hover_color'][ $i ] ),
						'gradient_1_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_gradient_1_color'][ $i ] ),
						'gradient_2_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_gradient_2_color'][ $i ] ),
						'size' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_size'][ $i ] ),
						'shape' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_shape'][ $i ] ),
						'shadow' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_shadow'][ $i ] ),
						'type' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_type'][ $i ] ),
						'class' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button_class'][ $i ] ),
					),
					'button2' => array(
						'id' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_id'][ $i ] ),
						'text' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_text'][ $i ] ),
						'url' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_url'][ $i ] ),
						'target' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_target'][ $i ] ),
						'color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_color'][ $i ] ),
						'hover_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_hover_color'][ $i ] ),
						'gradient_1_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_gradient_1_color'][ $i ] ),
						'gradient_2_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_gradient_2_color'][ $i ] ),
						'size' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_size'][ $i ] ),
						'shape' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_shape'][ $i ] ),
						'shadow' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_shadow'][ $i ] ),
						'type' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_type'][ $i ] ),
						'class' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_button2_class'][ $i ] ),
					),
					'arrow_enabled' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_arrow_enabled'][ $i ] ),
					'arrow_text' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_arrow_text'][ $i ] ),
					'arrow_color' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_arrow_color'][ $i ] ),
					'arrow_color_custom' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_arrow_color_custom'][ $i ] ),
					'el_class' => sanitize_text_field( $_POST['_crocal_eutf_slider_item_el_class'][ $i ] ),
				);

				$slider_items[] = $slide;
			}

		}



		if( !empty( $slider_items ) ) {
			$feature_section['slider_items'] = $slider_items;

			$feature_section['slider_settings'] = array (
				'slideshow_speed' => sanitize_text_field( $_POST['_crocal_eutf_page_slider_settings_speed'] ),
				'direction_nav' => sanitize_text_field( $_POST['_crocal_eutf_page_slider_settings_direction_nav'] ),
				'slider_pause' => sanitize_text_field( $_POST['_crocal_eutf_page_slider_settings_pause'] ),
				'transition' => sanitize_text_field( $_POST['_crocal_eutf_page_slider_settings_transition'] ),
				'slider_effect' => sanitize_text_field( $_POST['_crocal_eutf_page_slider_settings_effect'] ),
				'pagination' => sanitize_text_field( $_POST['_crocal_eutf_page_slider_settings_pagination'] ),
			);
		}

		//Feature Map Items
		$map_items = array();
		if ( isset( $_POST['_crocal_eutf_map_item_point_id'] ) ) {

			$num_of_map_points = sizeof( $_POST['_crocal_eutf_map_item_point_id'] );
			for ( $i=0; $i < $num_of_map_points; $i++ ) {

				$this_point = array (
					'id' => sanitize_text_field( $_POST['_crocal_eutf_map_item_point_id'][ $i ] ),
					'lat' => sanitize_text_field( $_POST['_crocal_eutf_map_item_point_lat'][ $i ] ),
					'lng' => sanitize_text_field( $_POST['_crocal_eutf_map_item_point_lng'][ $i ] ),
					'marker' => sanitize_text_field( $_POST['_crocal_eutf_map_item_point_marker'][ $i ] ),
					'title' => sanitize_text_field( $_POST['_crocal_eutf_map_item_point_title'][ $i ] ),
					'info_text' => wp_filter_post_kses( $_POST['_crocal_eutf_map_item_point_infotext'][ $i ] ),
					'info_text_open' => sanitize_text_field( $_POST['_crocal_eutf_map_item_point_infotext_open'][ $i ] ),
					'button_text' => sanitize_text_field( $_POST['_crocal_eutf_map_item_point_button_text'][ $i ] ),
					'button_url' => sanitize_text_field( $_POST['_crocal_eutf_map_item_point_button_url'][ $i ] ),
					'button_target' => sanitize_text_field( $_POST['_crocal_eutf_map_item_point_button_target'][ $i ] ),
					'button_class' => sanitize_text_field( $_POST['_crocal_eutf_map_item_point_button_class'][ $i ] ),
				);
				$map_items[] =  $this_point;
			}

		}

		if( !empty( $map_items ) ) {

			$feature_section['map_items'] = $map_items;
			$feature_section['map_settings'] = array (
				'zoom' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_map_zoom'] ),
				'marker' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_map_marker'] ),
				'marker_type' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_map_marker_type'] ),
				'marker_bg_color' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_map_marker_bg_color'] ),
				'disable_style' => sanitize_text_field( $_POST['_crocal_eutf_page_feature_map_disable_style'] ),
			);

		}

	}

	//Save Feature Section

	$new_meta_value = $feature_section;
	$meta_key = '_crocal_eutf_feature_section';
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( $new_meta_value && '' == $meta_value ) {
		if ( !add_post_meta( $post_id, $meta_key, $new_meta_value, true ) ) {
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}
	} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	} elseif ( '' == $new_meta_value && $meta_value ) {
		delete_post_meta( $post_id, $meta_key, $meta_value );
	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
