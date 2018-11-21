<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="order-received" class="woocommerce-order">

	<?php if ( $order ) : ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
			<?php
			/*
			Order Point
			*/
			$items = $order->get_items();
			$order_point = 0;
			foreach ( $items as $item ) {
				$product_id = $item->get_product_id();
				$product_point = get_post_meta($product_id, "product_point", true);
				if( !empty($product_point) )
					$order_point += $product_point;
			}
			add_post_meta($order->id, "_order_point", $order_point);


			/*
			REGITER USER IF NOT EXIST
			*/
			$billing_phone = $order->billing_phone;
			$password = wp_generate_password( 12, false );
			$args = array(
				'meta_key'     => 'billing_phone',
				'meta_value'   => $billing_phone,
				'meta_compare' => '='
			);
			$user_query = new WP_User_Query( $args );
			$ex_billing_phone = $user_query->get_results();

            

			if( empty( $ex_billing_phone ) ) :
				// INSERT USER
				$userdata = array(
					'user_login' => esc_attr($billing_phone),
					'user_email' => "",
					'user_pass' => esc_attr($password)
				);
				$user_id = wp_insert_user($userdata);
				// INSERT META
				$userdata = array(
					'billing_phone'         => esc_attr($billing_phone)
				);	
				foreach ($userdata as $meta_key => $meta_value ) {
					update_user_meta( $user_id, $meta_key, $meta_value );
				}
			endif;
			
			
			
			
			?>
			
			<p class="order-success__text">سفارش شما با موفقیت ثبت شد.</p>
			<p class="order-number__text"><span>کد سفارش:<span> <?php echo $order->get_order_number(); ?></p>
			<p class="order-tracking__text">جهت پیگیری سفارش <a href="<?php echo site_url(); ?>/dashboard">اینجا</a> کلیک کنید.</p>

		<?php endif; ?>

		<?php // do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php // do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

	<?php endif; ?>

</div>
