<?php

if( !isset($_SESSION) ) {
    session_start();
}

/* USER ID */
wp_set_current_user($_SESSION['global_current_user_id']); 
wp_set_auth_cookie($_SESSION['global_current_user_id'], true, true );
$user_id = $current_user->id;

/* GET */
$action = sanitize_key( $_GET['action'] );
$order_id = sanitize_key( $_GET['order_id'] );



$order = wc_get_order($order_id);
if ( ! $order ) {
	wp_die( 'سفارش پیدا نشد! با پشتیبانی تماس بگیرید.', "خطا" );
}

if( $user_id == $order->get_user_id() ||
	$_SESSION['verfied_mobile'] === $order->get_billing_phone() ) 
{
	$view_mode    = 'download' === WPI()->get_option( 'general', 'view_pdf' ) ? 'D' : 'I';
	$packing_slip = new BEWPI_Packing_Slip( $order );
	$packing_slip->generate( $view_mode );
} else {
	wp_die( 'اعتبار سنجی با مشکل مواجه شد.', "خطا"  );
}

