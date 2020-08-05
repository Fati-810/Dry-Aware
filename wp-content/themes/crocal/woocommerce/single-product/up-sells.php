<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;
if ( $upsells ) {
	?>

	<div id="eut-up-cells-products" class="eut-bookmark clearfix">
		<div class="eut-container eut-margin-top-3x eut-padding-top-3x eut-border eut-border-top">
			<div class="eut-wrapper">
				<div class="upsells products">

					<h5 class="eut-link-text"><?php esc_html_e( 'You may also like&hellip;', 'crocal' ) ?></h5>

					<?php woocommerce_product_loop_start(); ?>

						<?php foreach ( $upsells as $upsell ) : ?>

							<?php
								$post_object = get_post( $upsell->get_id() );

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
