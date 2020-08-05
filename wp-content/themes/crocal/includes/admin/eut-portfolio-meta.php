<?php
/*
*	Euthemians Portfolio Items
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

	add_action( 'save_post', 'crocal_eutf_portfolio_options_save_postdata', 10, 2 );

	$crocal_eutf_portfolio_options = array (
		//Media
		array(
			'name' => 'Media Selection',
			'id' => '_crocal_eutf_portfolio_media_selection',
		),
		array(
			'name' => 'Media Fullwidth',
			'id' => '_crocal_eutf_portfolio_media_fullwidth',
		),
		array(
			'name' => 'Media Margin Bottom',
			'id' => '_crocal_eutf_portfolio_media_margin_bottom',
		),
		array(
			'name' => 'Media Image Mode',
			'id' => '_crocal_eutf_portfolio_media_image_mode',
		),
		array(
			'name' => 'Media Image Link Mode',
			'id' => '_crocal_eutf_portfolio_media_image_link_mode',
		),
		array(
			'name' => 'Masonry Size',
			'id' => '_crocal_eutf_portfolio_media_masonry_size',
		),
		array(
			'name' => 'Video webm format',
			'id' => '_crocal_eutf_portfolio_video_webm',
		),
		array(
			'name' => 'Video mp4 format',
			'id' => '_crocal_eutf_portfolio_video_mp4',
		),
		array(
			'name' => 'Video ogv format',
			'id' => '_crocal_eutf_portfolio_video_ogv',
		),
		array(
			'name' => 'Video Poster',
			'id' => '_crocal_eutf_portfolio_video_poster',
		),
		array(
			'name' => 'Video embed Vimeo/Youtube',
			'id' => '_crocal_eutf_portfolio_video_embed',
		),
		array(
			'name' => 'Video code',
			'id' => '_crocal_eutf_portfolio_video_code',
			'html' => true,
		),

		//Link Mode
		array(
			'name' => 'Link Mode',
			'id' => '_crocal_eutf_portfolio_link_mode',
		),
		array(
			'name' => 'Link URL',
			'id' => '_crocal_eutf_portfolio_link_url',
		),
		array(
			'name' => 'Open Link in a new window',
			'id' => '_crocal_eutf_portfolio_link_new_window',
		),
		array(
			'name' => 'Link Extra Class',
			'id' => '_crocal_eutf_portfolio_link_extra_class',
		),
		//Overview Mode
		array(
			'name' => 'Custom Overview Mode',
			'id' => '_crocal_eutf_portfolio_overview_mode',
		),
		array(
			'name' => 'Overview Color',
			'id' => '_crocal_eutf_portfolio_overview_color',
		),
		array(
			'name' => 'Overview Background Color',
			'id' => '_crocal_eutf_portfolio_overview_bg_color',
		),
		array(
			'name' => 'Overview custom text',
			'id' => '_crocal_eutf_portfolio_overview_text',
			'html' => true,
		),
		array(
			'name' => 'Overview custom text size',
			'id' => '_crocal_eutf_portfolio_overview_text_heading',
		),
		array(
			'name' => 'Second Featured Image',
			'id' => '_crocal_eutf_second_featured_image',
		),

	);

	function crocal_eutf_second_featured_image_section_box( $post ) {

		$second_featured_image = get_post_meta( $post->ID, '_crocal_eutf_second_featured_image', true );

	?>

		<div id="eut-second-featured-image-wrapper">
	<?php

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select-image',
				'name' => '_crocal_eutf_second_featured_image',
				'value' => $second_featured_image,
				'label' => array(
					"desc" => esc_html__( 'Set Second Fetured Image', 'crocal' ),
				),
				'width' => 'fullwidth',
				'wrap_class' => 'eut-metabox-side',
			)
		);
	?>
		</div>
	<?php
	}

	function crocal_eutf_portfolio_link_mode_box( $post ) {

		$link_mode = get_post_meta( $post->ID, '_crocal_eutf_portfolio_link_mode', true );
		$link_url = get_post_meta( $post->ID, '_crocal_eutf_portfolio_link_url', true );
		$new_window = get_post_meta( $post->ID, '_crocal_eutf_portfolio_link_new_window', true );
		$link_class = get_post_meta( $post->ID, '_crocal_eutf_portfolio_link_extra_class', true );

		wp_nonce_field( 'crocal_eutf_nonce_portfolio_save', '_crocal_eutf_nonce_portfolio_save' );

	?>
		<table class="form-table eut-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select link mode for Portfolio Overview (Used in Portfolio Element Link Type: Custom Link).', 'crocal' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<div id="eut-portfolio-custom-overview">
	<?php

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_portfolio_link_mode',
				'id' => 'eut-portfolio-link-mode',
				'options' => array(
					'' => esc_html__( 'Portfolio Item', 'crocal' ),
					'link' => esc_html__( 'Custom Link', 'crocal' ),
					'none' => esc_html__( 'None', 'crocal' ),
				),
				'value' => $link_mode,
				'default_value' => '',
				'label' => array(
					'title' => esc_html__( 'Link Mode', 'crocal' ),
					'desc' => esc_html__( 'Select Link Mode', 'crocal' ),
				),
				'group_id' => 'eut-portfolio-custom-overview',
				'highlight' => 'highlight',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'textfield',
				'name' => '_crocal_eutf_portfolio_link_url',
				'value' => $link_url,
				'label' => array(
					'title' => esc_html__( 'Link URL', 'crocal' ),
					'desc' => esc_html__( 'Enter the full URL of your link.', 'crocal' ),
				),
				'width' => 'fullwidth',
				'dependency' =>
				'[
					{ "id" : "eut-portfolio-link-mode", "values" : ["link"] }
				]',
			)
		);
		crocal_eutf_print_admin_option(
			array(
				'type' => 'checkbox',
				'name' => '_crocal_eutf_portfolio_link_new_window',
				'value' => $new_window ,
				'label' => array(
					'title' => esc_html__( 'Open Link in new window', 'crocal' ),
					'desc' => esc_html__( 'If selected, link will open in a new window.', 'crocal' ),
				),
				'dependency' =>
				'[
					{ "id" : "eut-portfolio-link-mode", "values" : ["link"] }
				]',
			)
		);
		crocal_eutf_print_admin_option(
			array(
				'type' => 'textfield',
				'name' => '_crocal_eutf_portfolio_link_extra_class',
				'value' => $link_class,
				'label' => array(
					'title' => esc_html__( 'Link extra class name', 'crocal' ),
				),
				'dependency' =>
				'[
					{ "id" : "eut-portfolio-link-mode", "values" : ["link"] }
				]',
			)
		);
	?>
		</div>
	<?php
	}

	function crocal_eutf_portfolio_overview_mode_box( $post ) {

		$overview_mode = get_post_meta( $post->ID, '_crocal_eutf_portfolio_overview_mode', true );
		$overview_color = get_post_meta( $post->ID, '_crocal_eutf_portfolio_overview_color', true );
		$overview_bg_color = get_post_meta( $post->ID, '_crocal_eutf_portfolio_overview_bg_color', true );
		$overview_text = get_post_meta( $post->ID, '_crocal_eutf_portfolio_overview_text', true );
		$overview_text_heading = get_post_meta( $post->ID, '_crocal_eutf_portfolio_overview_text_heading', true );


		wp_nonce_field( 'crocal_eutf_nonce_portfolio_save', '_crocal_eutf_nonce_portfolio_save' );

	?>
		<table class="form-table eut-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select overview mode for Portfolio Overview (Used in Portfolio Element Overview Type: Custom Overview).', 'crocal' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<div id="eut-portfolio-custom-overview">
	<?php
		global $crocal_eutf_button_color_selection;

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_portfolio_overview_mode',
				'id' => 'eut-portfolio-overview-mode',
				'options' => array(
					'' => esc_html__( 'Featured Image', 'crocal' ),
					'color' => esc_html__( 'Color', 'crocal' ),
				),
				'value' => $overview_mode,
				'default_value' => '',
				'label' => esc_html__( 'Overview Mode', 'crocal' ),
				'group_id' => 'eut-portfolio-custom-overview',
				'highlight' => 'highlight',
			)
		);
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_portfolio_overview_bg_color',
				'options' => $crocal_eutf_button_color_selection,
				'value' => $overview_bg_color,
				'default_value' => 'primary-1',
				'label' => esc_html__( 'Background color', 'crocal' ),
				'dependency' =>
				'[
					{ "id" : "eut-portfolio-overview-mode", "values" : ["color"] }
				]',
			)
		);
		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_portfolio_overview_color',
				'options' => $crocal_eutf_button_color_selection,
				'value' => $overview_color,
				'default_value' => 'black',
				'label' => esc_html__( 'Text Color', 'crocal' ),
				'dependency' =>
				'[
					{ "id" : "eut-portfolio-overview-mode", "values" : ["color"] }
				]',
			)
		);
		crocal_eutf_print_admin_option(
			array(
				'type' => 'textarea',
				'name' => '_crocal_eutf_portfolio_overview_text',
				'value' => $overview_text,
				'label' => array(
					'title' => esc_html__( 'Custom Text', 'crocal' ),
					'desc' => esc_html__( 'If entered, this text will replace default title and description.', 'crocal' ),
				),
				'width' => 'fullwidth',
				'dependency' =>
				'[
					{ "id" : "eut-portfolio-overview-mode", "values" : ["color"] }
				]',
			)
		);

		crocal_eutf_print_admin_option(
			array(
				'type' => 'select',
				'name' => '_crocal_eutf_portfolio_overview_text_heading',
				'options' => array(
					'h2'  => 'h2',
					'h3'  => 'h3',
					'h4'  => 'h4',
					'h5'  => 'h5',
					'h6'  => 'h6',
					'leader-text' => esc_html__( 'Leader Text', 'crocal' ),
					'subtitle-text' => esc_html__( 'Subtitle Text', 'crocal' ),
					'small-text' => esc_html__( 'Small Text', 'crocal' ),
					'link-text' => esc_html__( 'Link Text', 'crocal' ),
				),
				'value' => $overview_text_heading,
				'default_value' => 'h3',
				'label' => array(
					'title' => esc_html__( 'Custom Text size', 'crocal' ),
					'desc' => esc_html__( 'Custom Text size and typography', 'crocal' ),
				),
				'dependency' =>
				'[
					{ "id" : "eut-portfolio-overview-mode", "values" : ["color"] }
				]',
			)
		);
	?>
		</div>
	<?php
	}

	function crocal_eutf_portfolio_media_section_box( $post ) {

		wp_nonce_field( 'crocal_eutf_nonce_portfolio_save', 'eut_portfolio_media_save_nonce' );

		$portfolio_masonry_size = get_post_meta( $post->ID, '_crocal_eutf_portfolio_media_masonry_size', true );
		$portfolio_media = get_post_meta( $post->ID, '_crocal_eutf_portfolio_media_selection', true );
		$portfolio_media_fullwidth = get_post_meta( $post->ID, '_crocal_eutf_portfolio_media_fullwidth', true );
		$portfolio_media_margin_bottom = get_post_meta( $post->ID, '_crocal_eutf_portfolio_media_margin_bottom', true );

		$portfolio_image_mode = get_post_meta( $post->ID, '_crocal_eutf_portfolio_media_image_mode', true );
		$portfolio_image_link_mode = get_post_meta( $post->ID, '_crocal_eutf_portfolio_media_image_link_mode', true );

		$eut_portfolio_video_webm = get_post_meta( $post->ID, '_crocal_eutf_portfolio_video_webm', true );
		$eut_portfolio_video_mp4 = get_post_meta( $post->ID, '_crocal_eutf_portfolio_video_mp4', true );
		$eut_portfolio_video_ogv = get_post_meta( $post->ID, '_crocal_eutf_portfolio_video_ogv', true );
		$eut_portfolio_video_poster = get_post_meta( $post->ID, '_crocal_eutf_portfolio_video_poster', true );
		$eut_portfolio_video_embed = get_post_meta( $post->ID, '_crocal_eutf_portfolio_video_embed', true );
		$eut_portfolio_video_code = get_post_meta( $post->ID, '_crocal_eutf_portfolio_video_code', true );

		$media_slider_items = get_post_meta( $post->ID, '_crocal_eutf_portfolio_slider_items', true );
		$media_slider_settings = get_post_meta( $post->ID, '_crocal_eutf_portfolio_slider_settings', true );
		$media_slider_speed = crocal_eutf_array_value( $media_slider_settings, 'slideshow_speed', '3500' );
		$media_slider_dir_nav = crocal_eutf_array_value( $media_slider_settings, 'direction_nav', '1' );
		$media_slider_dir_nav_color = crocal_eutf_array_value( $media_slider_settings, 'direction_nav_color', 'dark' );

	?>
			<table class="form-table eut-metabox">
				<tbody>
					<tr>
						<th>
							<label for="eut-portfolio-media-masonry-size">
								<strong><?php esc_html_e( 'Masonry Size', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select your masonry image size.', 'crocal' ); ?>
									<br/>
									<strong><?php esc_html_e( 'Used in Portfolio Element with style Masonry.', 'crocal' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<select id="eut-portfolio-media-masonry-size" name="_crocal_eutf_portfolio_media_masonry_size">
								<option value="square" <?php selected( 'square', $portfolio_masonry_size ); ?>><?php esc_html_e( 'Square', 'crocal' ); ?></option>
								<option value="landscape" <?php selected( 'landscape', $portfolio_masonry_size ); ?>><?php esc_html_e( 'Landscape', 'crocal' ); ?></option>
								<option value="portrait" <?php selected( 'portrait', $portfolio_masonry_size ); ?>><?php esc_html_e( 'Portrait', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<label for="eut-portfolio-media-selection">
								<strong><?php esc_html_e( 'Media Selection', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Choose your portfolio media.', 'crocal' ); ?>
									<br/>
									<strong><?php esc_html_e( 'In overview only Featured Image is displayed.', 'crocal' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<select id="eut-portfolio-media-selection" name="_crocal_eutf_portfolio_media_selection">
								<option value="" <?php selected( '', $portfolio_media ); ?>><?php esc_html_e( 'Featured Image', 'crocal' ); ?></option>
								<option value="second-image" <?php selected( 'second-image', $portfolio_media ); ?>><?php esc_html_e( 'Second Featured Image', 'crocal' ); ?></option>
								<option value="gallery" <?php selected( 'gallery', $portfolio_media ); ?>><?php esc_html_e( 'Classic Gallery', 'crocal' ); ?></option>
								<option value="gallery-vertical" <?php selected( 'gallery-vertical', $portfolio_media ); ?>><?php esc_html_e( 'Vertical Gallery', 'crocal' ); ?></option>
								<option value="slider" <?php selected( 'slider', $portfolio_media ); ?>><?php esc_html_e( 'Slider', 'crocal' ); ?></option>
								<option value="video" <?php selected( 'video', $portfolio_media ); ?>><?php esc_html_e( 'YouTube/Vimeo Video', 'crocal' ); ?></option>
								<option value="video-html5" <?php selected( 'video-html5', $portfolio_media ); ?>><?php esc_html_e( 'HMTL5 Video', 'crocal' ); ?></option>
								<option value="video-code" <?php selected( 'video-code', $portfolio_media ); ?>><?php esc_html_e( 'Embed Video', 'crocal' ); ?></option>
								<option value="none" <?php selected( 'none', $portfolio_media ); ?>><?php esc_html_e( 'None', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr class="eut-portfolio-media-item eut-portfolio-media-fullwidth">
						<th>
							<label for="eut-portfolio-media-fullwidth">
								<strong><?php esc_html_e( 'Media Fullwidth', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select if you want fullwidth media.', 'crocal' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="eut-portfolio-media-fullwidth" name="_crocal_eutf_portfolio_media_fullwidth">
								<option value="no" <?php selected( 'no', $portfolio_media_fullwidth ); ?>><?php esc_html_e( 'No', 'crocal' ); ?></option>
								<option value="yes" <?php selected( 'yes', $portfolio_media_fullwidth ); ?>><?php esc_html_e( 'Yes', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr class="eut-portfolio-media-item eut-portfolio-media-margin-bottom">
						<th>
							<label for="eut-portfolio-media-margin-bottom">
								<strong><?php esc_html_e( 'Margin Bottom', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Define the space below the portfolio media.', 'crocal' ); ?> <?php esc_html_e( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'crocal' ); ?>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="eut-portfolio-media-margin-bottom" name="_crocal_eutf_portfolio_media_margin_bottom" value="<?php echo esc_attr( $portfolio_media_margin_bottom ); ?>" />
						</td>
					</tr>
					<tr class="eut-portfolio-media-item eut-portfolio-video-html5">
						<th>
							<label for="eut-portfolio-video-webm">
								<strong><?php esc_html_e( 'WebM File URL', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Upload the .webm video file.', 'crocal' ); ?>
									<br/>
									<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'crocal' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="eut-portfolio-video-webm" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_portfolio_video_webm" value="<?php echo esc_attr( $eut_portfolio_video_webm ); ?>"/>
							<input type="button" data-media-type="video" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
							<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
						</td>
					</tr>
					<tr class="eut-portfolio-media-item eut-portfolio-video-html5">
						<th>
							<label for="eut-portfolio-video-mp4">
								<strong><?php esc_html_e( 'MP4 File URL', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Upload the .mp4 video file.', 'crocal' ); ?>
									<br/>
									<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'crocal' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="eut-portfolio-video-mp4" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_portfolio_video_mp4" value="<?php echo esc_attr( $eut_portfolio_video_mp4 ); ?>"/>
							<input type="button" data-media-type="video" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
							<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
						</td>
					</tr>
					<tr class="eut-portfolio-media-item eut-portfolio-video-html5">
						<th>
							<label for="eut-portfolio-video-ogv">
								<strong><?php esc_html_e( 'OGV File URL', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Upload the .ogv video file (optional).', 'crocal' ); ?>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="eut-portfolio-video-ogv" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_portfolio_video_ogv" value="<?php echo esc_attr( $eut_portfolio_video_ogv ); ?>"/>
							<input type="button" data-media-type="video" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
							<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
						</td>
					</tr>
					<tr class="eut-portfolio-media-item eut-portfolio-video-html5">
						<th>
							<label for="eut-portfolio-video-poster">
								<strong><?php esc_html_e( 'Poster Image', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Use same resolution as video.', 'crocal' ); ?>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="eut-portfolio-video-poster" class="eut-upload-simple-media-field eut-meta-text" name="_crocal_eutf_portfolio_video_poster" value="<?php echo esc_attr( $eut_portfolio_video_poster ); ?>"/>
							<input type="button" data-media-type="image" class="eut-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'crocal' ); ?>"/>
							<input type="button" class="eut-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'crocal' ); ?>"/>
						</td>
					</tr>
					<tr class="eut-portfolio-media-item eut-portfolio-video-embed">
						<th>
							<label for="eut-portfolio-video-embed">
								<strong><?php esc_html_e( 'Vimeo/YouTube URL', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Enter the full URL of your video from Vimeo or YouTube.', 'crocal' ); ?>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="eut-portfolio-video-embed" class="eut-meta-text" name="_crocal_eutf_portfolio_video_embed" value="<?php echo esc_attr( $eut_portfolio_video_embed ); ?>"/>
						</td>
					</tr>
					<tr class="eut-portfolio-media-item eut-portfolio-video-code">
						<th>
							<label for="eut-portfolio-video-code">
								<strong><?php esc_html_e( 'Video Embed', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Enter the embed code of your video.', 'crocal' ); ?>
								</span>
							</label>
						</th>
						<td>
							<textarea id="eut-portfolio-video-code" name="_crocal_eutf_portfolio_video_code" cols="40" rows="5"><?php echo esc_textarea( $eut_portfolio_video_code ); ?></textarea>
						</td>
					</tr>
					<tr class="eut-portfolio-media-item eut-portfolio-media-image-mode">
						<th>
							<label for="eut-portfolio-media-image-mode">
								<strong><?php esc_html_e( 'Image Mode', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select image mode.', 'crocal' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="eut-portfolio-media-image-mode" name="_crocal_eutf_portfolio_media_image_mode">
								<option value="" <?php selected( '', $portfolio_image_mode ); ?>><?php esc_html_e( 'Auto Crop', 'crocal' ); ?></option>
								<option value="resize" <?php selected( 'resize', $portfolio_image_mode ); ?>><?php esc_html_e( 'Resize', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr class="eut-portfolio-media-item eut-portfolio-media-image-link-mode">
						<th>
							<label for="eut-portfolio-media-image-link-mode">
								<strong><?php esc_html_e( 'Image Link Mode', 'crocal' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select image link mode.', 'crocal' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="eut-portfolio-media-image-link-mode" name="_crocal_eutf_portfolio_media_image_link_mode">
								<option value="" <?php selected( '', $portfolio_image_link_mode ); ?>><?php esc_html_e( 'Popup', 'crocal' ); ?></option>
								<option value="none" <?php selected( 'none', $portfolio_image_link_mode ); ?>><?php esc_html_e( 'None', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="eut-portfolio-media-slider-speed" class="eut-portfolio-media-item">
						<th>
							<label for="eut-page-slider-speed">
								<strong><?php esc_html_e( 'Slideshow Speed', 'crocal' ); ?></strong>
							</label>
						</th>
						<td>
							<input type="text" id="eut-page-slider-speed" name="_crocal_eutf_portfolio_slider_settings_speed" value="<?php echo esc_attr( $media_slider_speed ); ?>" /> ms
						</td>
					</tr>
					<tr id="eut-portfolio-media-slider-direction-nav" class="eut-portfolio-media-item">
						<th>
							<label for="eut-page-slider-direction-nav">
								<strong><?php esc_html_e( 'Navigation Buttons', 'crocal' ); ?></strong>
							</label>
						</th>
						<td>
							<select id="eut-page-slider-direction-nav" name="_crocal_eutf_portfolio_slider_settings_direction_nav">
								<option value="1" <?php selected( "1", $media_slider_dir_nav ); ?>><?php esc_html_e( 'Style 1', 'crocal' ); ?></option>
								<option value="0" <?php selected( "0", $media_slider_dir_nav ); ?>><?php esc_html_e( 'No Navigation', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="eut-portfolio-media-slider-direction-nav-color" class="eut-portfolio-media-item">
						<th>
							<label for="eut-page-slider-direction-nav-color">
								<strong><?php esc_html_e( 'Navigation Buttons Color', 'crocal' ); ?></strong>
							</label>
						</th>
						<td>
							<select id="eut-page-slider-direction-nav-color" name="_crocal_eutf_portfolio_slider_settings_direction_nav_color">
								<option value="dark" <?php selected( "dark", $media_slider_dir_nav_color ); ?>><?php esc_html_e( 'Dark', 'crocal' ); ?></option>
								<option value="light" <?php selected( "light", $media_slider_dir_nav_color ); ?>><?php esc_html_e( 'Light', 'crocal' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="eut-portfolio-media-slider" class="eut-portfolio-media-item">
						<th>
							<label><?php esc_html_e( 'Media Items', 'crocal' ); ?></label>
						</th>
						<td>
							<input type="button" class="eut-upload-slider-button button-primary" value="<?php esc_attr_e( 'Insert Images', 'crocal' ); ?>"/>
							<span id="eut-upload-slider-button-spinner" class="eut-action-spinner"></span>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="eut-slider-container" data-mode="minimal" class="eut-portfolio-media-item">
				<?php
					if( !empty( $media_slider_items ) ) {
						crocal_eutf_print_admin_media_slider_items( $media_slider_items );
					}
				?>
			</div>


	<?php
	}

	function crocal_eutf_portfolio_options_save_postdata( $post_id , $post ) {
		global $crocal_eutf_portfolio_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['_crocal_eutf_nonce_portfolio_save'] ) || !wp_verify_nonce( $_POST['_crocal_eutf_nonce_portfolio_save'], 'crocal_eutf_nonce_portfolio_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'portfolio' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}

		foreach ( $crocal_eutf_portfolio_options as $value ) {
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

		if ( isset( $_POST['eut_portfolio_media_save_nonce'] ) && wp_verify_nonce( $_POST['eut_portfolio_media_save_nonce'], 'crocal_eutf_nonce_portfolio_save' ) ) {


			//Media Slider Items
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
				delete_post_meta( $post->ID, '_crocal_eutf_portfolio_slider_items' );
				delete_post_meta( $post->ID, '_crocal_eutf_portfolio_slider_settings' );
			} else{
				update_post_meta( $post->ID, '_crocal_eutf_portfolio_slider_items', $media_slider_items );

				$media_slider_speed = 3500;
				$media_slider_direction_nav = '1';
				$media_slider_direction_nav_color = 'dark';
				if ( isset( $_POST['_crocal_eutf_portfolio_slider_settings_speed'] ) ) {
					$media_slider_speed = sanitize_text_field( $_POST['_crocal_eutf_portfolio_slider_settings_speed'] );
				}
				if ( isset( $_POST['_crocal_eutf_portfolio_slider_settings_direction_nav'] ) ) {
					$media_slider_direction_nav = sanitize_text_field( $_POST['_crocal_eutf_portfolio_slider_settings_direction_nav'] );
				}
				if ( isset( $_POST['_crocal_eutf_portfolio_slider_settings_direction_nav_color'] ) ) {
					$media_slider_direction_nav_color = sanitize_text_field( $_POST['_crocal_eutf_portfolio_slider_settings_direction_nav_color'] );
				}

				$media_slider_settings = array (
					'slideshow_speed' => $media_slider_speed,
					'direction_nav' => $media_slider_direction_nav,
					'direction_nav_color' => $media_slider_direction_nav_color,
				);
				update_post_meta( $post->ID, '_crocal_eutf_portfolio_slider_settings', $media_slider_settings );
			}

		}

	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
