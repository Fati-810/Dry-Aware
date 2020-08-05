<?php
/**
 * Side Area Mini-cart
 *
 * Contains the markup for the mini-cart, used by the sidearea cart
 *
 * @author 	Euthemians Team
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( function_exists( 'wc_get_cart_url' ) ) {
	$get_cart_url = wc_get_cart_url();
} else {
	$get_cart_url = WC()->cart->get_cart_url();
}
if ( function_exists( 'wc_get_checkout_url' ) ) {
	$get_checkout_url = wc_get_checkout_url();
} else {
	$get_checkout_url = WC()->cart->get_checkout_url();
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="eut-scroller">
	<ul class="eut-mini-cart <?php echo esc_attr( $args['list_class'] ); ?>">

		<?php if ( ! WC()->cart->is_empty() ) : ?>

			<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

						$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
						<li class="eut-cart-item eut-border">

							<a class="eut-product-thumb" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
							</a>
							<div class="cart-item-content">
								<a class="eut-link-text" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php echo wp_kses_post( $product_name ); ?></a>
								<?php
									if ( function_exists( 'wc_get_formatted_cart_item_data' ) ) {
										echo wc_get_formatted_cart_item_data( $cart_item );
									} else {
										echo WC()->cart->get_item_data( $cart_item );
									}
								?>
								<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
							</div>
						</li>
						<?php
					}
				}
			?>

		<?php else : ?>

			<li class="eut-empty-cart">
				<div class="eut-h6"><?php esc_html_e( 'No products in the cart.', 'crocal' ); ?></div>
				<a class="eut-link-text" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Return to shop', 'crocal' ) ?></a>
			</li>

		<?php endif; ?>

	</ul><!-- end product list -->
</div>

<?php if ( ! WC()->cart->is_empty() ) : ?>
<div class="eut-buttons-wrapper">
	<div class="eut-cart-total eut-h6"><?php esc_html_e( 'Subtotal', 'crocal' ); ?> : <?php echo WC()->cart->get_cart_subtotal(); ?></div>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="eut-total-btn">
		<a class="eut-btn eut-woo-btn eut-fullwidth-btn eut-bg-grey eut-bg-hover-black" href="<?php echo esc_url( $get_cart_url ); ?>"><span><?php esc_html_e( 'View cart', 'crocal' ); ?></span></a>
		<a class="eut-btn eut-woo-btn eut-fullwidth-btn eut-bg-primary-1 eut-bg-hover-black" href="<?php echo esc_url( $get_checkout_url ); ?>"><span><?php esc_html_e( 'Checkout', 'crocal' ); ?></span></a>
	</div>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
