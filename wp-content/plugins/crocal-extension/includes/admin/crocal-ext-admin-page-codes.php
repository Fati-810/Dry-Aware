<?php
/*
*	Admin Page Codes
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
	<div id="eut-codes-wrap" class="wrap">
		<h2><?php esc_html_e( "Custom Codes", 'crocal-extension' ); ?></h2>
		<?php
			if ( function_exists( 'crocal_eutf_print_admin_links') ) {
				crocal_eutf_print_admin_links('codes');
			}
		?>
		<div id="eut-codes-panel" class="eut-admin-panel">

			<form method="post" action="admin.php?page=crocal-codes">
				<?php
					settings_fields('crocal_eutf_ext_options');
					$options = get_option('crocal_eutf_ext_options');
					$head_code = ( isset( $options['head_code'] ) ? $options['head_code'] : '' );
					$body_code = ( isset( $options['body_code'] ) ? $options['body_code'] : '' );
					$footer_code = ( isset( $options['footer_code'] ) ? $options['footer_code'] : '' );
				?>
				<p class="about-description"><?php esc_html_e( "In this area you can paste your tracking codes. Place your code inside &lt;script&gt; tags, usually tracking code is added to the head but in some cases additional script is needed after the body or closer to the footer.", 'crocal' ); ?></p>

				<table class="eut-admin-panel-left widefat" cellspacing="0">
					<tr>
						<td>
							<h3><?php esc_html_e( 'Code ( Head )', 'crocal-extension'); ?></h3>
							<p><?php esc_html_e( 'Code will be placed after the opening <head> tag. ', 'crocal-extension' ); ?></p>
							<textarea id="eut-head-code-area" name="crocal_eutf_ext_options[head_code]" class="widefat" rows="8"><?php echo wp_unslash( $head_code ); ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Code ( Body )', 'crocal-extension'); ?></h3>
							<p><?php esc_html_e( 'Code will be placed after the opening <body> tag. ', 'crocal-extension' ); ?></p>
							<textarea id="eut-body-code-area" name="crocal_eutf_ext_options[body_code]" class="widefat" rows="8"><?php echo wp_unslash( $body_code ); ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Code ( Footer )', 'crocal-extension'); ?></h3>
							<p><?php esc_html_e( 'Code will be placed before the closing </body> tag.', 'crocal-extension' ); ?></p>
							<textarea id="eut-footer-code-area" name="crocal_eutf_ext_options[footer_code]" class="widefat" rows="8"><?php echo wp_unslash( $footer_code ); ?></textarea>
						</td>
					</tr>
				</table>
				<?php wp_nonce_field( 'crocal_ext_options_nonce_save', '_crocal_ext_options_nonce_save' ); ?>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php esc_html_e('Save Changes', 'crocal-extension') ?>" />
				</p>
			</form>

		</div>
	</div>
<?php

//Omit closing PHP tag to avoid accidental whitespace output errors.
