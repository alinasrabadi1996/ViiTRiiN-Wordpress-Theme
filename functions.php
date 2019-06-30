<?php
include_once("includes/init_conf.php");
include_once("includes/wc_conf.php");
include_once('framework/api/sms/SendSMS_SoapClient.php');
include_once('framework/api/mail/simpleMail.php');

add_theme_support('title-tag');

/* WP INIT */
show_admin_bar(false);
add_theme_support('post-thumbnails');

/* DISABLE JQUERY UI */
function wpdocs_dequeue_script() {
    wp_dequeue_script( 'jquery-ui-css' );
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );

/* REGISTER MENUS */
function pazh_header_menu() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'pazh_header_menu' );


/* REGISTER MENUS */
function pazh_app_menu() {
    register_nav_menu('app-menu',__( 'App Menu' ));
}
add_action( 'init', 'pazh_app_menu' );

/* WIDGETS AREA */
function pazh_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Product Category', 'product-category' ),
        'id' => 'side-product-category',
        'before_widget' => '<div class="products-carousel products side-product-category">',
        'after_widget' => '</div>',
        'before_title' => '<div class="title-type-1"><h3 class="title">',
        'after_title' => '</h3></div>',
    ) );

    register_sidebar( array(
        'name' => __( 'Shop Sidebar', 'shop-sidebar' ),
        'id' => 'side-shop-sidebar',
        'before_widget' => '<div class="sidebar-inner">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ) );
}
add_action( 'widgets_init', 'pazh_widgets_init' );

/* DASHBOARD URL */
function custom_rewrite_rule() {
    add_rewrite_rule('^dashboard/?([^/]*)/?','index.php?pagename=dashboard&pgname=$matches[1]','top');
    add_rewrite_tag('%pgname%','([a-z]+)');
}
add_action('init', 'custom_rewrite_rule', 10, 0);


/*
DISPLAY DOUPON DESC IN CART
*/
add_action('woocommerce_after_cart_table', 'apply_product_on_coupon');
function apply_product_on_coupon() {
    global $woocommerce;
    if ( ! empty( $woocommerce->cart->applied_coupons ) ) {
         $my_coupon = $woocommerce->cart->get_coupons() ;
         foreach($my_coupon as $coupon){
            if ( $post = get_post( $coupon->id ) ) {
                if ( !empty( $post->post_excerpt ) ) {
                    echo "<p class='coupon-description'>".$post->post_excerpt."</p>";
                }
            }
        }
    }
}

/*
CUSTOM POST STATUS FOR SYNC CEOPANEL
*/
function viitriin_custom_post_status(){
    register_post_status( 'wc-sales', array(
        'label'                     => _x( 'واحد فروش', 'wc-sales' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'واحد فروش <span class="count">(%s)</span>', 'واحد فروش <span class="count">(%s)</span>' ),
    ) );
    register_post_status( 'wc-depot', array(
        'label'                     => _x( 'واحد انبار', 'wc-depot' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'واحد انبار <span class="count">(%s)</span>', 'واحد انبار <span class="count">(%s)</span>' ),
    ) );
    register_post_status( 'wc-sending', array(
        'label'                     => _x( 'واحد ارسال', 'wc-sending' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'واحد ارسال <span class="count">(%s)</span>', 'واحد ارسال <span class="count">(%s)</span>' ),
    ) );
}
add_action( 'init', 'viitriin_custom_post_status' );


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );


/*
SEND SMS After Ordering
*/
add_action('woocommerce_order_status_changed', 'send_sms_after_ordering', 10, 4 );
function send_sms_after_ordering( $order_id, $old_status, $new_status, $order ) {
    $order = new WC_Order($order_id);
    if($new_status == "processing" || $new_status == "on-hold") {
        $sms_text = "فروشگاه اینترنتی ویترین.\r
مشتری گرامی خرید شما با کد سفارش ".$order->get_order_number()." با موفقیت ثبت شد. \r
https://viitriin.com";
        SendSMS($sms_text, $order->billing_phone);        
    }
}

// add_action('woocommerce_checkout_before_order_review', 'display_payment_notice');
// function display_payment_notice() {
//     echo '<div id="payment_notice" style="display: none;background: #d22929;padding: 9px;color: #FFF;border-radius: 3px;margin-top: 3em;font-weight: bold;box-shadow: 0 0px 2px 0px rgba(0, 0, 0, 0.21176470588235294);font-size: 14px;border: 3px solid #bd3421;">در صورت انتخاب پرداخت آنلاین، سفارش شما در اولویت ارسال قرار گرفته و به صورت پیشتاز پست خواهد شد.</div>';
// }

// add_action('woocommerce_after_cart_table', 'check_product_in_cart');
// function check_product_in_cart() {
//     foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
//         // 278 = Rimmel Pank Doucce
//         if ($cart_item['product_id'] == 278) {
//             echo '<p class="coupon-description" style="background: #d61b1b;">با خرید هر ریمل پانک، یک هدیه برای شما ارسال خواهد شد.</p>';
//         }
//     }
// }

// add_action('woocommerce_after_cart_table', 'display_notification_in_cart');
// function display_notification_in_cart() {
//     echo '<p class="coupon-description" style="background: rgba(84, 62, 155, 0.8);">جشنواره زمستانه ویترین؛ علاوه بر خریدتان، یک هدیه برای شما ارسال می شود.</p>';
// }

// add_action('woocommerce_after_cart_table', 'display_notice_by_cart_total_func');
// function display_notice_by_cart_total_func() {
//     global $woocommerce;
//     $cart_total = $woocommerce->cart->total;
//     if($cart_total >= 150000 && $cart_total < 200000) {
//         echo '<p class="coupon-description" style="background: rgba(84, 62, 155, 0.8);">جشنواره عید فطر ویترین <strong>علاوه بر خریدتان، یک رژ لب به صورت هدیه برای شما ارسال می گردد.</strong></p>';
//     } elseif($cart_total >= 200000 && $cart_total < 300000 ) {
//         echo '<p class="coupon-description" style="background: rgba(84, 62, 155, 0.8);">جشنواره عید فطر ویترین <strong>علاوه بر خریدتان، یک رژ لب و سایه به صورت هدیه برای شما ارسال می گردد.</strong></p>';
//     } elseif($cart_total >= 300000) {
//         echo '<p class="coupon-description" style="background: rgba(84, 62, 155, 0.8);">جشنواره عید فطر ویترین <strong>علاوه بر خریدتان، یک کرم پودر مینی آمیتیس به صورت هدیه برای شما ارسال می گردد.</strong></p>';
//     }
// }

// add_action('woocommerce_after_cart_table', 'display_alert_in_cart_func');
// function display_alert_in_cart_func() {
//     echo '<p class="coupon-description" style="background: rgba(222, 11, 11, 0.85);">سفارشات ثبت شده، بعد از تعطیلات نوروزی ارسال می گردد.</p>';
// }

/*
Hook - FIX DISCOUNT PRICE (Dynamic Price Discount Plugin)
*/
function hook_fix_discount_price($order_id) {
    $order = wc_get_order($order_id);
    $items = $order->get_items();
    foreach ( $items as $item_id => $item ) {
        $product_id = $item->get_product_id(); // Return ID Simple & Variable Product
        $product = wc_get_product($product_id);
        $item_subtotal = wc_get_order_item_meta($item_id, '_line_subtotal', true);
        $item_qty = wc_get_order_item_meta($item_id, '_qty', true);
        if(empty($item_qty)) $item_qty = 1;

        // # For Debuging:
        // error_log("Item ID:".$item_id, 0);
        // error_log("Var ID:".$product->get_variation_id(), 0);
        // error_log("Prod ID:".$product_id, 0);
        // error_log("Sub Total:".$item_subtotal, 0);

        if( $product->is_type('variable') ) {
            $current_product_price = get_post_meta($product_id, '_price', true);					
        } else {
            $current_product_price = $product->get_regular_price();
        }

        $current_product_price *= $item_qty; // Mul With Quantity

        // # For Debuging:
        // error_log("Current Price:".$current_product_price, 0);


        if($current_product_price !== $item_subtotal) wc_update_order_item_meta($item_id, '_line_subtotal', $current_product_price);
    }
}

/*
FIX DISCOUNT PRICE
*/
add_action('woocommerce_order_status_changed', 'func_fix_discount_price', 10, 4 );
function func_fix_discount_price( $order_id, $old_status, $new_status, $order ) {
    hook_fix_discount_price($order_id);
}