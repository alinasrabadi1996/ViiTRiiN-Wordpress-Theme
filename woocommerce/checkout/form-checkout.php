<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>

<div id="page-checkout" class="page-content-inner">
	<div class="row">
		<div class="col-md-8">
			<div class="checkout-list col-container wcard">
				<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents cart-list" cellspacing="0">
					<tbody>
					<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
								<td class="product-thumbnail"><?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo $thumbnail;
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
								}
								?></td>
								<td class="product-name">
									<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
									<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
									<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
								</td>
								<td class="product-total">
									<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
								</td>
							</tr>
							<?php
						}
					} ?>
					<tbody>
				</table>
			</div>
			
			<div class="col-container wcard" style="padding: 1.5em;">
				<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" autocomplete="off">
					<?php if ( $checkout->get_checkout_fields() ) : ?>
						<div id="checkout-fields">
							<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
								<?php do_action( 'woocommerce_checkout_billing' ); ?>
								<?php do_action( 'woocommerce_checkout_shipping' ); ?>
							<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
						</div>
					<?php endif; ?>



					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>
					
					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				</form>
				<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
			</div>
		</div>
		<div class="col-md-4">
			<div id="sidebar" class="sidebar">
				<div class="shoping-help wcard sidebar__inner">
					<div class="help-header-backgruond"></div>
					<div class="help-texts">
						<h3>ارسال رایگان توسط ویترین</h3>
                        <p>با خرید بیشتر از 100,000 تومان از ارسال رایگان به تمام نقاط کشور بهره‌مند شوید.</p>
                    </div>
					<div class="help-seperator"></div>
					<div class="help-texts">
						<h3>بررسی مقصد ارسال</h3>
						<p>مطمئن شوید سفارش شما به مقصد صحیح ارسال میشود.</p>
					</div>
					<div class="help-seperator"></div>
					<div class="help-texts">
						<h3>نیاز به کمک دارید؟</h3>
						<p>با واحد پشتیبانی تماس بگیرید.</p>
					</div>
					<div class="wc-proceed-to-checkout">
                        <a href="<?php echo site_url(); ?>/shop/" class="checkout-button button alt wc-forward">افزودن کالای جدید</a>
                	</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.woocommerce .woocommerce-info:first-child {
		display: none;
	}
	
	#order_comments {
	   min-height: 80px;
	}
</style>