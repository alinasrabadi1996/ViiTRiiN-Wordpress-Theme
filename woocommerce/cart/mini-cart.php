<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wc_measurement_price_calculator_activated = true;

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="cart_list-outer">
	<ul class="cart_list product_list_widget">

		<?php  if ( ! WC()->cart->is_empty() ) :
			
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

						$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( apply_filters( 'single_product_small_thumbnail_size', '60x60' ) ), $cart_item, $cart_item_key );
						$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>

						<li data-key="<?php echo esc_attr( $cart_item_key ); ?>" class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">

							<div class="remove-item">
								<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"> &times; </a>',
										esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
										'حذف این ایتم',
										esc_attr( $cart_item_key ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
								?>
							</div>

							<div class="img-item-outer">
								<div class="img-item">
									<?php if ( ! $_product->is_visible() ) : ?>
										<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
											<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
							
							<div class="info-item">
								<h5 class="title-item">
									<?php echo '<a href="' . get_permalink( $cart_item['product_id'] ) . '">' . $product_name . '</a>'; ?>
								</h5>
								<div class="price-item">
									<?php
										if ( $_product->is_sold_individually() ) {
											$input_number = 1;
										} else {
											if ( $wc_measurement_price_calculator_activated && isset( $cart_item['pricing_item_meta_data']['_quantity'] ) && $cart_item['pricing_item_meta_data']['_quantity'] ) {
												$cart_item['quantity'] = $cart_item['pricing_item_meta_data']['_quantity'];
											}

											$input_number = $cart_item['quantity'];
										}

										echo '<span class="price-minicart">'.$product_price.'<span class="count-item">'.$input_number.' عدد</span></span>'; 
								 	?>
								</div>

								<?php echo WC()->cart->get_item_data( $cart_item ); ?>

							</div>
							<div class="clearfix"></div>
						</li>
						<?php
					}
				}
			?>

		<?php else : ?>

			<li class="empty">هیچ کالایی در سبد خرید شما نیست.</li>

		<?php endif; ?>

	</ul><!-- end product list -->
</div>

<?php if ( ! WC()->cart->is_empty() ) :
?>
	<div class="price-checkout">
		<p class="total"><strong>قیمت کل:</strong> <span class="mini-price"><?php echo WC()->cart->get_cart_subtotal(); ?></span></p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="buttons">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="mini-cart-btn mini-cart-btn-outline wc-forward">مشاهده سبد خرید</a>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="mini-cart-btn checkout">تسویه حساب</a>
		</p>
	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>