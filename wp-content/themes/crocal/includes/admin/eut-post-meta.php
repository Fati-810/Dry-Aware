<?php
/*
*	Euthemians Post Items
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

	add_action( 'save_post', 'crocal_eutf_post_options_save_postdata', 10, 2 );

	$crocal_eutf_post_options = array (

		//Standard Format

		array(
			'name' => 'Standard Style',
			'id' => '_crocal_eutf_post_standard_style',
		),
		array(
			'name' => 'Standard Background Color',
			'id' => '_crocal_eutf_post_standard_bg_color',
		),
		array(
			'name' => 'Standard Background Opacity',
			'id' => '_crocal_eutf_post_standard_bg_opacity',
		),
		array(
			'name' => 'Standard Background Size',
			'id' => '_crocal_eutf_post_standard_bg_size',
		),
		//Gallery Format
		array(
			'name' => 'Media Mode',
			'id' => '_crocal_eutf_post_type_gallery_mode',
		),
		array(
			'name' => 'Media Image Mode',
			'id' => '_crocal_eutf_post_type_gallery_image_mode',
		),
		//Link Format
		array(
			'name' => 'Link URL',
			'id' => '_crocal_eutf_post_link_url',
		),
		array(
			'name' => 'Open Link in a new window',
			'id' => '_crocal_eutf_post_link_new_window',
		),
		array(
			'name' => 'Link Background Color',
			'id' => '_crocal_eutf_post_link_bg_color',
		),
		array(
			'name' => 'Link Background Hover Color',
			'id' => '_crocal_eutf_post_link_bg_hover_color',
		),
		array(
			'name' => 'Link Background Opacity',
			'id' => '_crocal_eutf_post_link_bg_opacity',
		),
		array(
			'name' => 'Link Background Size',
			'id' => '_crocal_eutf_post_link_bg_size',
		),		
		//Quote Format
		array(
			'name' => 'Quote Text',
			'id' => '_crocal_eutf_post_quote_text',
			'html' => true,
		),
		array(
			'name' => 'Quote Name',
			'id' => '_crocal_eutf_post_quote_name',
			'html' => true,
		),
		array(
			'name' => 'Quote Background Color',
			'id' => '_crocal_eutf_post_quote_bg_color',
		),
		array(
			'name' => 'Quote Background Hover Color',
			'id' => '_crocal_eutf_post_quote_bg_hover_color',
		),
		array(
			'name' => 'Quote Background Opacity',
			'id' => '_crocal_eutf_post_quote_bg_opacity',
		),
		array(
			'name' => 'Quote Background Size',
			'id' => '_crocal_eutf_post_quote_bg_size',
		),		
		//Audio Format
		array(
			'name' => 'Audio mp3 format',
			'id' => '_crocal_eutf_post_audio_mp3',
		),
		array(
			'name' => 'Audio ogg format',
			'id' => '_crocal_eutf_post_audio_ogg',
		),
		array(
			'name' => 'Audio wav format',
			'id' => '_crocal_eutf_post_audio_wav',
		),
		array(
			'name' => 'Audio embed',
			'id' => '_crocal_eutf_post_audio_embed',
			'html' => true,
		),
		//Video Format
		array(
			'name' => 'Video Style',
			'id' => '_crocal_eutf_post_video_style',
		),
		array(
			'name' => 'Video Background Color',
			'id' => '_crocal_eutf_post_video_bg_color',
		),
		array(
			'name' => 'Video Background Opacity',
			'id' => '_crocal_eutf_post_video_bg_opacity',
		),
		array(
			'name' => 'Video Background Size',
			'id' => '_crocal_eutf_post_video_bg_size',
		),		
		array(
			'name' => 'Video Mode',
			'id' => '_crocal_eutf_post_type_video_mode',
		),
		array(
			'name' => 'Video webm format',
			'id' => '_crocal_eutf_post_video_webm',
		),
		array(
			'name' => 'Video mp4 format',
			'id' => '_crocal_eutf_post_video_mp4',
		),
		array(
			'name' => 'Video ogv format',
			'id' => '_crocal_eutf_post_video_ogv',
		),
		array(
			'name' => 'Video Poster',
			'id' => '_crocal_eutf_post_video_poster',
		),
		array(
			'name' => 'Video embed Vimeo/Youtube',
			'id' => '_crocal_eutf_post_video_embed',
		),

	);

	function crocal_eutf_meta_box_post_format_standard( $post ) {

		global $crocal_eutf_post_color_selection, $crocal_eutf_post_bg_opacity_selection;
		$crocal_eutf_post_standard_style = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_standard_style' );
		$crocal_eutf_post_standard_bg_color = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_standard_bg_color', 'black' );
		$crocal_eutf_post_standard_bg_opacity = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_standard_bg_opacity', '70' );
		$crocal_eutf_post_standard_bg_size = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_standard_bg_size', 'double' );

		$format = get_post_format( $post->ID );
		if ( !$format ) {
			$format = 'standard';
		}

	?>
		<input type="hidden" id="eut-post-format-value" value="<?php echo esc_attr( $format ); ?>"/>
		<table class="form-table eut-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select one of the choices below for the post overview.', 'crocal' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
		<div id="eut-stadard-format-options">

	<?php
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_post_standard_style',
				'id' => 'eut-standard-format-style',
				'options' => array(
					'' => esc_html__( 'Classic', 'crocal' ),
					'crocal' => esc_html__( 'Crocal', 'crocal' ),
				),
				'value' => $crocal_eutf_post_standard_style,
				'default_value' => '',
				'label' => array(
					'title' => esc_html__( 'Post Style', 'crocal' ),
					'desc' => esc_html__( 'Note: Crocal style affects only Grid/Masonry style.', 'crocal' ),
				),
				'group_id' => 'eut-stadard-format-options',
				'highlight' => 'highlight',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_post_standard_bg_color',
				'options' => $crocal_eutf_post_color_selection,
				'value' => $crocal_eutf_post_standard_bg_color,
				'label' => esc_html__( 'Background Color', 'crocal' ),
				'default_value' => 'black',
				'dependency' =>
				'[
					{ "id" : "eut-standard-format-style", "values" : ["crocal"] }
				]',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'options' => $crocal_eutf_post_bg_opacity_selection,
				'name' => '_crocal_eutf_post_standard_bg_opacity',
				'value' => $crocal_eutf_post_standard_bg_opacity,
				'label' => array(
					'title' => esc_html__( 'Background Opacity', 'crocal' ),
					'desc' => esc_html__( 'Note: only if Featured Image is available.', 'crocal' ),
				),
				'default_value' => '70',
				'dependency' =>
				'[
					{ "id" : "eut-standard-format-style", "values" : ["crocal"] }
				]',
			)
		);
		
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'options' => array(
					'normal' => esc_html__( 'Normal', 'crocal' ),
					'double' => esc_html__( 'Double', 'crocal' ),
				),
				'name' => '_crocal_eutf_post_standard_bg_size',
				'value' => $crocal_eutf_post_standard_bg_size,
				'label' => array(
					'title' => esc_html__( 'Element Size', 'crocal' ),
				),
				'default_value' => 'double',
				'dependency' =>
				'[
					{ "id" : "eut-standard-format-style", "values" : ["crocal"] }
				]',
			)
		);		

	?>
		</div>
	<?php
	}

	function crocal_eutf_meta_box_post_format_gallery( $post ) {

		wp_nonce_field( 'crocal_eutf_nonce_post_save', '_crocal_eutf_nonce_post_save' );

		$gallery_mode = get_post_meta( $post->ID, '_crocal_eutf_post_type_gallery_mode', true );
		$gallery_image_mode = get_post_meta( $post->ID, '_crocal_eutf_post_type_gallery_image_mode', true );

		$media_slider_items = get_post_meta( $post->ID, '_crocal_eutf_post_slider_items', true );

		$media_slider_settings = get_post_meta( $post->ID, '_crocal_eutf_post_slider_settings', true );
		$media_slider_speed = crocal_eutf_array_value( $media_slider_settings, 'slideshow_speed', '3500' );
		$media_slider_dir_nav = crocal_eutf_array_value( $media_slider_settings, 'direction_nav', '1' );
		$media_slider_dir_nav_color = crocal_eutf_array_value( $media_slider_settings, 'direction_nav_color', 'dark' );

	?>
			<table class="form-table eut-metabox">
				<tbody>
					<tr class="eut-border-bottom">
						<th>
							<label for="eut-post-gallery-mode">
								<strong><?php esc_html_e( 'Gallery Mode', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select Gallery mode.', 'crocal' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="eut-post-gallery-mode" name="_crocal_eutf_post_type_gallery_mode">
								<option value="" <?php selected( '', $gallery_mode ); ?>><?php esc_html_e( 'Gallery', 'crocal' ); ?></option>
								<option value="slider" <?php selected( 'slider', $gallery_mode ); ?>><?php esc_html_e( 'Slider', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="eut-post-gallery-image-mode-section" class="eut-post-media-item">
						<th>
							<label for="eut-post-gallery-image-mode">
								<strong><?php esc_html_e( 'Image Mode', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select image mode.', 'crocal' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="eut-post-gallery-image-mode" name="_crocal_eutf_post_type_gallery_image_mode">
								<option value="" <?php selected( '', $gallery_image_mode ); ?>><?php esc_html_e( 'Auto Crop', 'crocal' ); ?></option>
								<option value="resize" <?php selected( 'resize', $gallery_image_mode ); ?>><?php esc_html_e( 'Resize', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="eut-post-media-slider-speed" class="eut-post-media-item">
						<th>
							<label for="eut-post-slider-speed">
								<strong><?php esc_html_e( 'Slideshow Speed', 'crocal' ); ?></strong>
							</label>
						</th>
						<td>
							<input type="text" id="eut-post-slider-speed" name="_crocal_eutf_post_slider_settings_speed" value="<?php echo esc_attr( $media_slider_speed ); ?>" /> ms
						</td>
					</tr>
					<tr id="eut-post-media-slider-direction-nav" class="eut-post-media-item">
						<th>
							<label for="eut-post-slider-direction-nav">
								<strong><?php esc_html_e( 'Navigation Buttons', 'crocal' ); ?></strong>
							</label>
						</th>
						<td>
							<select id="eut-post-slider-direction-nav" name="_crocal_eutf_post_slider_settings_direction_nav">
								<option value="1" <?php selected( "1", $media_slider_dir_nav ); ?>><?php esc_html_e( 'Style 1', 'crocal' ); ?></option>
								<option value="0" <?php selected( "0", $media_slider_dir_nav ); ?>><?php esc_html_e( 'No Navigation', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="eut-post-media-slider-direction-nav-color" class="eut-post-media-item">
						<th>
							<label for="eut-post-slider-direction-nav-color">
								<strong><?php esc_html_e( 'Navigation Buttons Color', 'crocal' ); ?></strong>
							</label>
						</th>
						<td>
							<select id="eut-post-slider-direction-nav-color" name="_crocal_eutf_post_slider_settings_direction_nav_color">
								<option value="dark" <?php selected( "dark", $media_slider_dir_nav_color ); ?>><?php esc_html_e( 'Dark', 'crocal' ); ?></option>
								<option value="light" <?php selected( "light", $media_slider_dir_nav_color ); ?>><?php esc_html_e( 'Light', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<label><?php esc_html_e( 'Images', 'crocal' ); ?></label>
						</th>
						<td>
							<input type="button" class="eut-upload-slider-button button-primary" value="<?php esc_attr_e( 'Insert Images to Gallery/Slider', 'crocal' ); ?>"/>
							<span id="eut-upload-slider-button-spinner" class="eut-action-spinner"></span>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="eut-slider-container" class="eut-slider-container-minimal" data-mode="minimal">
				<?php
					if( !empty( $media_slider_items ) ) {
						crocal_eutf_print_admin_media_slider_items( $media_slider_items );
					}
				?>
			</div>
	<?php
	}


	function crocal_eutf_meta_box_post_format_link( $post ) {

		global $crocal_eutf_post_color_selection, $crocal_eutf_post_bg_opacity_selection;

		$link_url = get_post_meta( $post->ID, '_crocal_eutf_post_link_url', true );
		$new_window = get_post_meta( $post->ID, '_crocal_eutf_post_link_new_window', true );

		$crocal_eutf_post_link_bg_color = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_link_bg_color', 'primary-1' );
		$crocal_eutf_post_link_bg_hover_color = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_link_bg_hover_color', 'black' );
		$crocal_eutf_post_link_bg_opacity = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_link_bg_opacity', '70' );
		$crocal_eutf_post_link_bg_size = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_link_bg_size', 'normal' );

	?>
		<table class="form-table eut-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Add your text in the content area. The text will be wrapped with a link.', 'crocal' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
<?php

			crocal_eutf_print_admin_option(
				array(
					'type' => 'textfield',
					'name' => '_crocal_eutf_post_link_url',
					'value' => $link_url ,
					'label' => array(
						'title' => esc_html__( 'Link URL', 'crocal' ),
						'desc' => esc_html__( 'Enter the full URL of your link.', 'crocal' ),
					),
					'width' => 'fullwidth',
				)
			);

			crocal_eutf_print_admin_option(
				array(
					'type' => 'checkbox',
					'name' => '_crocal_eutf_post_link_new_window',
					'value' => $new_window ,
					'label' => array(
						'title' => esc_html__( 'Open Link in new window', 'crocal' ),
						'desc' => esc_html__( 'If selected, link will open in a new window.', 'crocal' ),
					),
				)
			);

			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'name' => '_crocal_eutf_post_link_bg_color',
					'options' => $crocal_eutf_post_color_selection,
					'value' => $crocal_eutf_post_link_bg_color,
					'label' => esc_html__( 'Background Color', 'crocal' ),
				)
			);
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'name' => '_crocal_eutf_post_link_bg_hover_color',
					'options' => $crocal_eutf_post_color_selection,
					'value' => $crocal_eutf_post_link_bg_hover_color,
					'label' => esc_html__( 'Background Hover Color', 'crocal' ),
				)
			);
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'options' => $crocal_eutf_post_bg_opacity_selection,
					'name' => '_crocal_eutf_post_link_bg_opacity',
					'value' => $crocal_eutf_post_link_bg_opacity,
					'label' => array(
						'title' => esc_html__( 'Background Opacity', 'crocal' ),
						'desc' => esc_html__( 'Note: only if Featured Image is available.', 'crocal' ),
					),
					'default_value' => '70',
				)
			);
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'options' => array(
						'normal' => esc_html__( 'Normal', 'crocal' ),
						'double' => esc_html__( 'Double', 'crocal' ),
					),
					'name' => '_crocal_eutf_post_link_bg_size',
					'value' => $crocal_eutf_post_link_bg_size,
					'label' => array(
						'title' => esc_html__( 'Element Size', 'crocal' ),
					),
					'default_value' => 'normal',
				)
			);			

	}

	function crocal_eutf_meta_box_post_format_quote( $post ) {

		global $crocal_eutf_post_color_selection, $crocal_eutf_post_bg_opacity_selection;
		$crocal_eutf_post_quote_bg_color = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_quote_bg_color', 'primary-1' );
		$crocal_eutf_post_quote_bg_hover_color = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_quote_bg_hover_color', 'black' );
		$crocal_eutf_post_quote_bg_opacity = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_quote_bg_opacity', '70' );
		$crocal_eutf_post_quote_bg_size = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_quote_bg_size', 'normal' );

		$crocal_eutf_post_quote_text = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_quote_text' );
		$crocal_eutf_post_quote_name = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_quote_name' );

	?>
		<table class="form-table eut-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Simply add some text in the text area. This text will automatically displayed as quote.', 'crocal' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

<?php

		crocal_eutf_print_admin_option(
			array(
				'type' => 'textarea',
				'name' => '_crocal_eutf_post_quote_text',
				'id' => '_crocal_eutf_post_quote_text',
				'value' => $crocal_eutf_post_quote_text,
				'label' => array(
					'title' => esc_html__( 'Quote Text', 'crocal' ),
					'desc' => esc_html__( 'Enter your quote text.', 'crocal' ),
				),
				'width' => 'fullwidth',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'textfield',
				'name' => '_crocal_eutf_post_quote_name',
				'id' => '_crocal_eutf_post_quote_name',
				'value' => $crocal_eutf_post_quote_name,
				'label' => array(
					'title' => esc_html__( 'Quote Name', 'crocal' ),
					'desc' => esc_html__( 'Enter your quote name.', 'crocal' ),
				),
				'width' => 'fullwidth',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_post_quote_bg_color',
				'options' => $crocal_eutf_post_color_selection,
				'value' => $crocal_eutf_post_quote_bg_color,
				'label' => esc_html__( 'Background color', 'crocal' ),
			)
		);
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_post_quote_bg_hover_color',
				'options' => $crocal_eutf_post_color_selection,
				'value' => $crocal_eutf_post_quote_bg_hover_color,
				'label' => esc_html__( 'Background Hover color', 'crocal' ),
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'options' => $crocal_eutf_post_bg_opacity_selection,
				'name' => '_crocal_eutf_post_quote_bg_opacity',
				'value' => $crocal_eutf_post_quote_bg_opacity,
				'label' => array(
					'title' => esc_html__( 'Background Opacity', 'crocal' ),
					'desc' => esc_html__( 'Note: only if Featured Image is available.', 'crocal' ),
				),
				'default_value' => '70',
			)
		);
		
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'options' => array(
						'normal' => esc_html__( 'Normal', 'crocal' ),
						'double' => esc_html__( 'Double', 'crocal' ),
					),
					'name' => '_crocal_eutf_post_quote_bg_size',
					'value' => $crocal_eutf_post_quote_bg_size,
					'label' => array(
						'title' => esc_html__( 'Element Size', 'crocal' ),
					),
					'default_value' => 'normal',
				)
			);			

	}

	function crocal_eutf_meta_box_post_format_video( $post ) {

		global $crocal_eutf_post_color_selection, $crocal_eutf_post_bg_opacity_selection;
		$crocal_eutf_post_video_style = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_video_style' );
		$crocal_eutf_post_video_bg_color = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_video_bg_color', 'black' );
		$crocal_eutf_post_video_bg_opacity = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_video_bg_opacity', '70' );
		$crocal_eutf_post_video_bg_size = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_video_bg_size', '70' );

		$video_mode = get_post_meta( $post->ID, '_crocal_eutf_post_type_video_mode', true );
		$crocal_eutf_post_video_webm = get_post_meta( $post->ID, '_crocal_eutf_post_video_webm', true );
		$crocal_eutf_post_video_mp4 = get_post_meta( $post->ID, '_crocal_eutf_post_video_mp4', true );
		$crocal_eutf_post_video_ogv = get_post_meta( $post->ID, '_crocal_eutf_post_video_ogv', true );
		$crocal_eutf_post_video_poster = get_post_meta( $post->ID, '_crocal_eutf_post_video_poster', true );
		$crocal_eutf_post_video_embed = get_post_meta( $post->ID, '_crocal_eutf_post_video_embed', true );

	?>
		<table class="form-table eut-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select one of the choices below for the featured video.', 'crocal' ); ?></p>
					</td>
				</tr>
				<tr class="eut-border-bottom">
					<th>
						<label for="eut-post-type-video-mode">
							<strong><?php esc_html_e( 'Video Mode', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select your Video Mode', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="eut-post-type-video-mode" name="_crocal_eutf_post_type_video_mode">
							<option value="" <?php selected( "", $video_mode ); ?>><?php esc_html_e( 'YouTube/Vimeo Video', 'crocal' ); ?></option>
							<option value="html5" <?php selected( "html5", $video_mode ); ?>><?php esc_html_e( 'HTML5 Video', 'crocal' ); ?></option>
						</select>
					</td>
				</tr>
				<tr class="eut-post-video-html5">
					<th>
						<label for="eut-post-video-webm">
							<strong><?php esc_html_e( 'WebM File URL', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .webm video file.', 'crocal' ); ?>
								<br/>
								<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'crocal' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="eut-post-video-webm" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_post_video_webm" value="<?php echo esc_attr( $crocal_eutf_post_video_webm ); ?>"/>
						<input type="button" data-media-type="video" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
						<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
					</td>
				</tr>
				<tr class="eut-post-video-html5">
					<th>
						<label for="eut-post-video-mp4">
							<strong><?php esc_html_e( 'MP4 File URL', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .mp4 video file.', 'crocal' ); ?>
								<br/>
								<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'crocal' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="eut-post-video-mp4" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_post_video_mp4" value="<?php echo esc_attr( $crocal_eutf_post_video_mp4 ); ?>"/>
						<input type="button" data-media-type="video" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
						<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
					</td>
				</tr>
				<tr class="eut-post-video-html5">
					<th>
						<label for="eut-post-video-ogv">
							<strong><?php esc_html_e( 'OGV File URL', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .ogv video file (optional).', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="eut-post-video-ogv" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_post_video_ogv" value="<?php echo esc_attr( $crocal_eutf_post_video_ogv ); ?>"/>
						<input type="button" data-media-type="video" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
						<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
					</td>
				</tr>
				<tr class="eut-post-video-html5">
					<th>
						<label for="eut-post-video-poster">
							<strong><?php esc_html_e( 'Poster Image', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Use same resolution as video.', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="eut-post-video-poster" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_post_video_poster" value="<?php echo esc_attr( $crocal_eutf_post_video_poster ); ?>"/>
						<input type="button" data-media-type="image" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
						<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
					</td>
				</tr>
				<tr class="eut-post-video-embed">
					<th>
						<label for="eut-post-video-embed">
							<strong><?php esc_html_e( 'Vimeo/YouTube URL', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Enter the full URL of your video from Vimeo or YouTube.', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="eut-post-video-embed" class="eut-meta-text" name="_crocal_eutf_post_video_embed" value="<?php echo esc_attr( $crocal_eutf_post_video_embed ); ?>"/>
					</td>
				</tr>
			</tbody>
		</table>

		<div id="eut-video-format-options">
	<?php
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_post_video_style',
				'id' => 'eut-video-format-style',
				'options' => array(
					'' => esc_html__( 'Classic', 'crocal' ),
					'crocal' => esc_html__( 'Crocal', 'crocal' ),
				),
				'value' => $crocal_eutf_post_video_style,
				'default_value' => '',
				'label' => array(
					'title' => esc_html__( 'Post Style', 'crocal' ),
					'desc' => esc_html__( 'Note: Crocal style affects only Grid/Masonry style.', 'crocal' ),
				),
				'group_id' => 'eut-video-format-options',
				'highlight' => 'highlight',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_post_video_bg_color',
				'options' => $crocal_eutf_post_color_selection,
				'value' => $crocal_eutf_post_video_bg_color,
				'label' => esc_html__( 'Background color', 'crocal' ),
				'default_value' => 'black',
				'dependency' =>
				'[
					{ "id" : "eut-video-format-style", "values" : ["crocal"] }
				]',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'options' => $crocal_eutf_post_bg_opacity_selection,
				'name' => '_crocal_eutf_post_video_bg_opacity',
				'value' => $crocal_eutf_post_video_bg_opacity,
				'label' => array(
					'title' => esc_html__( 'Background Opacity', 'crocal' ),
					'desc' => esc_html__( 'Note: only if Featured Image is available.', 'crocal' ),
				),
				'default_value' => '70',
				'dependency' =>
				'[
					{ "id" : "eut-video-format-style", "values" : ["crocal"] }
				]',
			)
		);
		
			crocal_eutf_print_admin_option(
				array(
					'type' => 'select',
					'options' => array(
						'normal' => esc_html__( 'Normal', 'crocal' ),
						'double' => esc_html__( 'Double', 'crocal' ),
					),
					'name' => '_crocal_eutf_post_video_bg_size',
					'value' => $crocal_eutf_post_video_bg_size,
					'label' => array(
						'title' => esc_html__( 'Element Size', 'crocal' ),
					),
					'default_value' => 'normal',
					'dependency' =>
					'[
						{ "id" : "eut-video-format-style", "values" : ["crocal"] }
					]',
				)
			);			
	?>
		</div>
	<?php
	}

	function crocal_eutf_meta_box_post_format_audio( $post ) {

		$audio_mode = get_post_meta( $post->ID, '_crocal_eutf_post_type_audio_mode', true );
		$crocal_eutf_post_audio_mp3 = get_post_meta( $post->ID, '_crocal_eutf_post_audio_mp3', true );
		$crocal_eutf_post_audio_ogg = get_post_meta( $post->ID, '_crocal_eutf_post_audio_ogg', true );
		$crocal_eutf_post_audio_wav = get_post_meta( $post->ID, '_crocal_eutf_post_audio_wav', true );
		$crocal_eutf_post_audio_embed = get_post_meta( $post->ID, '_crocal_eutf_post_audio_embed', true );

	?>
		<table class="form-table eut-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select one of the choices below for the featured audio.', 'crocal' ); ?></p>
					</td>
				</tr>
				<tr class="eut-border-bottom">
					<th>
						<label for="eut-post-type-audio-mode">
							<strong><?php esc_html_e( 'Audio Mode', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select your Audio Mode', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="eut-post-type-audio-mode" name="_crocal_eutf_post_type_audio_mode">
							<option value="" <?php selected( "", $audio_mode ); ?>><?php esc_html_e( 'Embed Audio', 'crocal' ); ?></option>
							<option value="html5" <?php selected( "html5", $audio_mode ); ?>><?php esc_html_e( 'HTML5 Audio', 'crocal' ); ?></option>
						</select>
					</td>
				</tr>
				<tr class="eut-post-audio-html5">
					<th>
						<label for="eut-post-audio-mp3">
							<strong><?php esc_html_e( 'MP3 File URL', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .mp3 audio file.', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="eut-post-audio-mp3" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_post_audio_mp3" value="<?php echo esc_attr( $crocal_eutf_post_audio_mp3 ); ?>"/>
						<input type="button" data-media-type="audio" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
						<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
					</td>
				</tr>
				<tr class="eut-post-audio-html5">
					<th>
						<label for="eut-post-audio-ogg">
							<strong><?php esc_html_e( 'OGG File URL', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .ogg audio file.', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="eut-post-audio-ogg" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_post_audio_ogg" value="<?php echo esc_attr( $crocal_eutf_post_audio_ogg ); ?>"/>
						<input type="button" data-media-type="audio" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
						<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
					</td>
				</tr>
				<tr class="eut-post-audio-html5">
					<th>
						<label for="eut-post-audio-wav">
							<strong><?php esc_html_e( 'WAV File URL', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .wav audio file (optional).', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="eut-post-audio-wav" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_post_audio_wav" value="<?php echo esc_attr( $crocal_eutf_post_audio_wav ); ?>"/>
						<input type="button" data-media-type="audio" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
						<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
					</td>
				</tr>
				<tr class="eut-post-audio-embed">
					<th>
						<label for="eut-post-audio-embed">
							<strong><?php esc_html_e( 'Audio embed code', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Type your audio embed code.', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<textarea id="eut-post-audio-embed" name="_crocal_eutf_post_audio_embed" cols="40" rows="5"><?php echo esc_textarea( $crocal_eutf_post_audio_embed ); ?></textarea>
					</td>
				</tr>
			</tbody>
		</table>

	<?php
	}

	function crocal_eutf_post_options_save_postdata( $post_id , $post ) {
		global $crocal_eutf_post_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['_crocal_eutf_nonce_post_save'] ) || !wp_verify_nonce( $_POST['_crocal_eutf_nonce_post_save'], 'crocal_eutf_nonce_post_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'post' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		foreach ( $crocal_eutf_post_options as $value ) {
			$allow_html = ( isset( $value['html'] ) ? $value['html'] : false );
			if( $allow_html ) {
				$new_meta_value = ( isset( $_POST[$value['id']] ) ? wp_filter_post_kses( $_POST[$value['id']] ) : '' );
			} else {
				$new_meta_value = ( isset( $_POST[$value['id']] ) ? sanitize_text_field( $_POST[$value['id']] ) : '' );
			}
			$meta_key = $value['id'];


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



		//Feature Slider Items
		$media_slider_items = array();
		if ( isset( $_POST['_crocal_eutf_media_slider_item_id'] ) ) {

			$num_of_images = sizeof( $_POST['_crocal_eutf_media_slider_item_id'] );
			for ( $i=0; $i < $num_of_images; $i++ ) {

				$this_image = array (
					'id' => sanitize_text_field( $_POST['_crocal_eutf_media_slider_item_id'][ $i ] ),
				);
				array_push( $media_slider_items, $this_image );
			}

		}

		if( empty( $media_slider_items ) ) {
			delete_post_meta( $post->ID, '_crocal_eutf_post_slider_items' );
			delete_post_meta( $post->ID, '_crocal_eutf_post_slider_settings' );
		} else{
			update_post_meta( $post->ID, '_crocal_eutf_post_slider_items', $media_slider_items );
			$media_slider_speed = 3500;
			$media_slider_direction_nav = '1';
			$media_slider_direction_nav_color = 'dark';

			if ( isset( $_POST['_crocal_eutf_post_slider_settings_speed'] ) ) {
				$media_slider_speed = sanitize_text_field( $_POST['_crocal_eutf_post_slider_settings_speed'] );
			}
			if ( isset( $_POST['_crocal_eutf_post_slider_settings_direction_nav'] ) ) {
				$media_slider_direction_nav = sanitize_text_field( $_POST['_crocal_eutf_post_slider_settings_direction_nav'] );
			}
			if ( isset( $_POST['_crocal_eutf_post_slider_settings_direction_nav_color'] ) ) {
				$media_slider_direction_nav_color = sanitize_text_field( $_POST['_crocal_eutf_post_slider_settings_direction_nav_color'] );
			}

			$media_slider_settings = array (
				'slideshow_speed' => $media_slider_speed,
				'direction_nav' => $media_slider_direction_nav,
				'direction_nav_color' => $media_slider_direction_nav_color,
			);
			update_post_meta( $post->ID, '_crocal_eutf_post_slider_settings', $media_slider_settings );
		}


	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
