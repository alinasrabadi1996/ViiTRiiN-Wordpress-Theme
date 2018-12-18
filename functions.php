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
    if($old_status == "processing" || $old_status == "on-hold") {
        $sms_text = "فروشگاه اینترنتی ویترین.\r
        مشتری گرامی خرید شما با کد سفارش ".$order->get_order_number()." با موفقیت ثبت شد. \r
        https://viitriin.com
        ";
        SendSMS($sms_text, $order->billing_phone);        
    }
}