<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( $related_products ) {
	?>

	<div id="eut-related-products" class="eut-bookmark clearfix">
		<div class="eut-container eut-margin-top-3x eut-padding-top-3x eut-border eut-border-top">
			<div class="eut-wrapper">
				<div class="related products">

					<h5 class="eut-link-text"><?php esc_html_e( 'Related products', 'crocal' ); ?></h5>


					<?php woocommerce_product_loop_start(); ?>

						<?php foreach ( $related_products as $related_product ) : ?>

							<?php
								$post_object = get_post( $related_product->get_id() );

								setup_postdata( $GLOBALS['post'] =& $post_object );

								wc_get_template_part( 'content', 'product' ); ?>

						<?php endforeach; ?>

					<?php woocommerce_product_loop_end(); ?>

				</div>
			</div>
		</div>
	</div>

	<?php
}
wp_reset_postdata();

//Omit closing PHP tag to avoid accidental whitespace output errors.
