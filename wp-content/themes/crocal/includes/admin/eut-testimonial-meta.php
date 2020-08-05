<?php
/*
*	Euthemians Testimonial Items
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

	add_action( 'save_post', 'crocal_eutf_testimonial_options_save_postdata', 10, 2 );

	$crocal_eutf_testimonial_options = array (
		array(
			'name' => 'Name',
			'id' => '_crocal_eutf_testimonial_name',
			'html' => true,
		),
		array(
			'name' => 'Identity',
			'id' => '_crocal_eutf_testimonial_identity',
			'html' => true,
		),
	);

	function crocal_eutf_testimonial_options_box( $post ) {

		wp_nonce_field( 'crocal_eutf_nonce_testimonial_save', '_crocal_eutf_nonce_testimonial_save' );

		$crocal_eutf_testimonial_name = get_post_meta( $post->ID, '_crocal_eutf_testimonial_name', true );
		$crocal_eutf_testimonial_identity = get_post_meta( $post->ID, '_crocal_eutf_testimonial_identity', true );

	?>
		<table class="form-table eut-metabox">
			<tbody>
				<tr class="eut-border-bottom">
					<th>
						<label for="eut-testimonial-name">
							<strong><?php esc_html_e( 'Name', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Type the name.', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="eut-testimonial-name" class="eut-meta-text" name="_crocal_eutf_testimonial_name" value="<?php echo esc_attr( $crocal_eutf_testimonial_name ); ?>"/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="eut-testimonial-identity">
							<strong><?php esc_html_e( 'Identity', 'crocal' ); ?></strong>
							<span>
								<?php esc_html_e( 'Type the identity', 'crocal' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="eut-testimonial-identity" class="eut-meta-text" name="_crocal_eutf_testimonial_identity" value="<?php echo esc_attr( $crocal_eutf_testimonial_identity ); ?>"/>
					</td>
				</tr>
			</tbody>
		</table>


	<?php
	}


	function crocal_eutf_testimonial_options_save_postdata( $post_id , $post ) {
		global $crocal_eutf_testimonial_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['_crocal_eutf_nonce_testimonial_save'] ) || !wp_verify_nonce( $_POST['_crocal_eutf_nonce_testimonial_save'], 'crocal_eutf_nonce_testimonial_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'testimonial' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}

		foreach ( $crocal_eutf_testimonial_options as $value ) {
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

	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
