<?php
/* WC From Scratch */
add_theme_support('woocommerce');
add_theme_support( 'wc-product-gallery-lightbox' );

/* WC AJAX ADD TO CART */
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
    $fragments['#shopping-cart div.count'] = '<div class="count">' . WC()->cart->get_cart_contents_count() . '</div>';
    return $fragments;
}
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/* WC REMOVE USELESS HOOKS */
function woo_remove_hooks() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10, 0 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5  );
    remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action('init', 'woo_remove_hooks');

/* WC SINGLE HEADING */
function single_heading() {
    ?>
    <div class="config-product-header">
        <div class="row">
            <h3 class="col-md-12 config-header-product-name" data-offset="71"><?php the_title(); ?></h3>
        </div>
    </div>
    <?php
}
add_action('woocommerce_before_single_product', 'single_heading');

/* WC REMOVE SORTING DROPDOWN */
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );

/* WC REMOVE RESULT COUNT */
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );

/* QUICK VIEW AJAX */
function wr_quickview() {
    if ( isset( $_POST['product'] ) && (int) $_POST['product'] ) {
        global $post, $product, $woocommerce;

        $id      = ( int ) $_POST['product'];
        $post    = get_post( $id );
        $product = function_exists('wc_get_product') ? wc_get_product($id) : get_product($id);

        if ( $product ) {
            wc_get_template( 'framework/product-quickview.php' );
        }
    }

    wp_die();
}
add_action( 'wp_ajax_wr_quickview', 'wr_quickview');
add_action( 'wp_ajax_nopriv_wr_quickview', 'wr_quickview');


/*
FIX PRODUCT DETAILS
*/
add_action( 'wp_enqueue_scripts', 'jt_enqueue_scripts' );

function jt_enqueue_scripts() {
    wp_enqueue_script( 'underscore' );
    wp_enqueue_script( 'wp-util' );
    wp_enqueue_script( 'wc-add-to-cart-variation' );
}

/*
PRODUCT REVIEW PARENT ELEMENT
*/
add_filter( "woocommerce_before_widget_product_list", "edit_product_widget_list", 1, 1 );

function edit_product_widget_list ( $old_html ) {
    return '<div class="products-list owl-carousel owl-theme">';
}

/* Woo Change Arrows */
add_filter( 'woocommerce_pagination_args', 	'rocket_woo_pagination' );
function rocket_woo_pagination( $args ) {
	$args['prev_text'] = '<i class="icon icon-keyboard_arrow_right"></i>';
	$args['next_text'] = '<i class="icon icon-keyboard_arrow_left"></i>';
	return $args;
}

/* Woo Display Price For Variable Product With Same Variations Prices */
add_filter('woocommerce_available_variation', function ($value, $object = null, $variation = null) {
	if ($value['price_html'] == '') {
		$value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
	}
    return $value;
}, 10, 3);

/* Woo Change Variation Limit To 100 */
function woo_custom_ajax_variation_threshold( $qty, $product ) {
    return 100;
}       
add_filter( 'woocommerce_ajax_variation_threshold', 'woo_custom_ajax_variation_threshold', 10, 2 );

/*
Redirect users after add to cart.
*/
function custom_add_to_cart_redirect( $url ) {
    $url = WC()->cart->get_cart_url();
	return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect' );




/*
WOO CUSTOMIZE CHECKOUT FIELDS
*/
/*
class woocommerce_disable_checkout_fields {
 
	var $update_billing;
	var $disabled_billing;
	var $disabled_shipping;
	var $update_shipping;
 
	public function __construct() { 

 		$this->disabled_shipping = array('shipping_country', 'shipping_last_name', 'shipping_first_name', 'shipping_company', 'shipping_postcode');
         $this->update_billing = array(
            'shipping_address_1' 	=> array(
                'label'                 => __('','wc_disable_checkout_fields'),
                'placeholder'   	=> __('آدرس مقصد','wc_disable_checkout_fields'),
                'required'              => false,
                'class'                 => array('form-row-first')
            ),
            'shipping_address_2' 	=> array(
                'label'                 => __('','wc_disable_checkout_fields'),
                'placeholder'   	=> __('آدرس مقصد','wc_disable_checkout_fields'),
                'required'              => false,
                'class'                 => array('form-row-first')
            )
        );

		$this->disabled_billing = array('billing_last_name', 'billing_postcode', 'billing_country', 'billing_company', 'billing_email');
		$this->update_billing = array(
			'billing_first_name' 	=> array(
				'name'=>	'billing_first_name',
				'label'                 => __('','wc_disable_checkout_fields'),
				'placeholder'  		=> __('نام و نام خانوادگی','wc_disable_checkout_fields'),
				'required'              => true,
				'class'                 => array('form-row-first')
				),
			'billing_phone'         => array(
				'label'                 => __('','wc_disable_checkout_fields'),
				'placeholder'   	=> __('شماره همراه','wc_disable_checkout_fields'),
				'required'              => true,
				'class'                 => array('form-row-first')
                ),
                'billing_address_1' 	=> array(
                    'label'                 => __('','wc_disable_checkout_fields'),
                    'placeholder'   	=> __('آدرس مقصد','wc_disable_checkout_fields'),
                    'required'              => false,
                    'class'                 => array('form-row-first')
                ),
                'billing_address_2' 	=> array(
                    'label'                 => __('','wc_disable_checkout_fields'),
                    'placeholder'   	=> __('آدرس مقصد','wc_disable_checkout_fields'),
                    'required'              => false,
                    'class'                 => array('form-row-first')
                )
			);
 
		// Filters for checkout actions
		add_filter( 'woocommerce_shipping_fields', array(&$this, 'filter_shipping'), 10, 1 );
		add_filter( 'woocommerce_billing_fields', array(&$this, 'filter_billing'), 10, 1 );
	} 
 
 
	// array_flip is a somewhat smelly way to make a normal array into an associative one
	function filter_shipping( $fields_array ) {
		$fields_array = array_replace($fields_array, $this->update_shipping);
		return array_diff_key($fields_array, array_flip($this->disabled_shipping));
	}
 
	function filter_billing( $fields_array ) {
		$fields_array = array_replace($fields_array, $this->update_billing);
		return array_diff_key($fields_array, array_flip($this->disabled_billing));
	}
}

$woocommerce_disable_checkout_fields = new woocommerce_disable_checkout_fields();


/*
ORDER
*/

/*
add_filter("woocommerce_checkout_fields", "order_fields");

function order_fields($fields) {

    $order = array(
        "billing_first_name",
        "billing_phone",
        "billing_address_1",
        "billing_state",
        "billing_city",
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
    return $fields;

}

*/

/**
 * Add the field to the checkout page
 */
add_action('woocommerce_before_order_notes', 'customise_checkout_field');

function customise_checkout_field($checkout)
{
    
	woocommerce_form_field('representer_phone', array(
		'type' => 'text',
		'class' => array(
			'my-field-class form-row-wide'
		) ,
		'label' => __('شماره موبایل معرف') ,
		'placeholder' => __('') ,
		'required' => false,
	) , $checkout->get_value('representer_phone'));
}

add_action('woocommerce_checkout_update_order_meta', 'customise_checkout_field_update_order_meta');
 
function customise_checkout_field_update_order_meta($order_id)
{
	if (!empty($_POST['representer_phone'])) {
		update_post_meta($order_id, '_representer_phone', sanitize_text_field($_POST['representer_phone']));
	}
}


/*
WOO QUANTITY AJAX CHANGE
*/
add_action( 'wp_footer', 'cart_update_qty_script' );
function cart_update_qty_script() {
    if (is_cart()) :
        ?>
        <script type="text/javascript">
            (function($){
                $(function(){
                    $('div.woocommerce').on( 'change', '.qty', function(){
                        $("[name='update_cart']").trigger('click');
                    });
                });
            })(jQuery);
        </script>
        <?php
    endif;
}

/*
REMOVE TABLE REVIEW FROM CHECKOUT
*/
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );

/*
RENEMAE RETURN CUSTOMER (CHECKOUT PAGE)
*/
add_filter( 'woocommerce_checkout_login_message', 'minutesguide_return_customer_message' );
function minutesguide_return_customer_message() {
    return '';
}


// REMOVE VARIATION STOCK DATA
function wc_remove_variation_stock_display( $data ) {
    unset( $data['availability_html'] );
    return $data;
}
add_filter( 'woocommerce_available_variation', 'wc_remove_variation_stock_display', 99 );

/*
GENERATE DISCOUNT
*/
function discount() {
    $frequencies = [60, 40, 15, 5, 1, 1, 1, 1, 1]; // 1001 1002 1003 1004 1005 1006 1007 1008 1009
    $frequenciesborders = [];
    $maxfrequenciesindex = count($frequencies)-1;
    $total = 0;
    
    for ($i = 0; $i <= $maxfrequenciesindex; $i++) {
        $total = $total + $frequencies[$i];
        if ($i == 0) {
            $frequenciesborders[$i] = $frequencies[$i];
        }
        else {
            $frequenciesborders[$i] = $frequenciesborders[$i-1] + $frequencies[$i];
        }
    }

    $randomnumber = floor(mt_rand(1, $total-1)) + 1;

    $code = 1001;

    if ( ($randomnumber >= 1) && ($randomnumber <= $frequenciesborders[0]) )
    {
        $code = 1001;
    }
    if ( ($randomnumber >= $frequenciesborders[0] + 1) && ($randomnumber <= $frequenciesborders[1]) )
    {
        $code = 1002;
    }
    if ( ($randomnumber >= $frequenciesborders[1] + 1) && ($randomnumber <= $frequenciesborders[2]) )
    {
        $code = 1003;
    }
    if ( ($randomnumber >= $frequenciesborders[2] + 1) && ($randomnumber <= $frequenciesborders[3]) )
    {
        $code = 1004;
    }
    if ( ($randomnumber >= $frequenciesborders[3] + 1) && ($randomnumber <= $frequenciesborders[4]) )
    {
        $code = 1005;
    }
    if ( ($randomnumber >= $frequenciesborders[4] + 1) && ($randomnumber <= $frequenciesborders[5]) )
    {
        $code = 1006;
    }
    if ( ($randomnumber >= $frequenciesborders[5] + 1) && ($randomnumber <= $frequenciesborders[6]) )
    {
        $code = 1007;
    }
    if ( ($randomnumber >= $frequenciesborders[6] + 1) && ($randomnumber <= $frequenciesborders[7]) )
    {
        $code = 1008;
    }
    if ( ($randomnumber >= $frequenciesborders[7] + 1) && ($randomnumber <= $frequenciesborders[8]) )
    {
        $code = 1009;
    }
    return $code;
}

/*
NEW COUPON
*/
function new_coupon($coupon_code, $amount, $user_id) {
    $discount_type = 'percent'; // Type: fixed_cart, percent, fixed_product, percent_product

    $coupon = array(
        'post_title' => $coupon_code,
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type'     => 'shop_coupon'
    );    

    $new_coupon_id = wp_insert_post( $coupon );

    // Add meta
    update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
    update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
    update_post_meta( $new_coupon_id, 'individual_use', 'no' );
    update_post_meta( $new_coupon_id, 'product_ids', '' );
    update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
    update_post_meta( $new_coupon_id, 'usage_limit', '1' );
    update_post_meta( $new_coupon_id, 'usage_limit_per_user', '1' );
    update_post_meta( $new_coupon_id, 'expiry_date', date("Y-m-d", strtotime("+ 1 day")) );
    update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
    update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
    update_post_meta( $new_coupon_id, 'coupon_member', $user_id );
}

function new_coupon_type2($coupon_code, $discount, $national_code, $phone) {
    global $wpdb;

    if(empty($coupon_code)
        || empty($discount)
        || empty($national_code)
        || empty($phone)) {
            return -1;
    }

    // Check User Can Get Coupon (Alrady Gived or Not)
    $query = "SELECT * FROM {$wpdb->prefix}chancekey WHERE phone = ".$phone." ORDER BY id DESC LIMIT 1";
    $result = $wpdb->get_results($query, ARRAY_A);
    if($result) {
        foreach($result as $res) {
            if($res['date'] > date('Y-m-d H:i:s'))
                return array("sts" => 0, "coupon_code" => $res['coupon_code'], "coupon_expiration" => $res['date']);
            
            // Taking Chance If User Already Winner!
            if($res['coupon_code'] >= 1005)
                $discount = 1001;
        }
    }
    
    // Insert Fuckin Coupon
    $coupon = array(
        'post_title' => $coupon_code,
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type'     => 'shop_coupon'
    );    
    $new_coupon_id = wp_insert_post( $coupon );
    if(!$new_coupon_id) return -1;

    switch($discount) {
        case '1001':
            // 1001-> ارسال رایگان برای خریدهای بالای صد هزار تومان
            $discount_type = 'percent';
            $amount = 0;
            update_post_meta( $new_coupon_id, 'free_shipping', 'yes' );
            update_post_meta( $new_coupon_id, 'minimum_amount', '100000' );
            break;
        case '1002':
            // 1002-> ارسال رایگان برای خریدهای بالای پنجاه هزار تومان
            $discount_type = 'percent';
            $amount = 0;
            update_post_meta( $new_coupon_id, 'free_shipping', 'yes' );
            update_post_meta( $new_coupon_id, 'minimum_amount', '50000' );
            break;
        case '1003':
            // 1003-> درصد ارسال رایگان
            $discount_type = 'percent';
            $amount = 0;
            update_post_meta( $new_coupon_id, 'free_shipping', 'yes' );
            break;
        case '1004':
            // 1004-> بن خرید ده هزار تومانی برای خریدهای بالای صد تومان
            $discount_type = 'fixed_cart';
            $amount = '10000';
            update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
            update_post_meta( $new_coupon_id, 'minimum_amount', '100000' );
            break;
        case '1005':
            // 1005-> بن خرید مداد چشم چوبی امیتیس
            $discount_type = 'percent';
            $amount = 100;
            update_post_meta( $new_coupon_id, 'product_ids', '609' ); // 609 => Eye Pen Choobi
            update_post_meta( $new_coupon_id, 'limit_usage_to_x_items', '1' );
            update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
            break;
        case '1006':
            // 1006->  بن خرید رژلب کلیک کلیک دوسه
            $discount_type = 'percent';
            $amount = 100;
            update_post_meta( $new_coupon_id, 'product_ids', '1543' ); // 1543 => Click Click
            update_post_meta( $new_coupon_id, 'limit_usage_to_x_items', '1' );
            update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
            break;
        case '1007':
            // 1007->  بن خرید رژ لب جامد مینرال دوسه (۲۱۲۸)
            $discount_type = 'percent';
            $amount = 100;
            update_post_meta( $new_coupon_id, 'product_ids', '2128' ); // 2128 => Minral Doucce
            update_post_meta( $new_coupon_id, 'limit_usage_to_x_items', '1' );
            update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
            break;
        case '1008':
            // 1008->  بن خرید کرم پودر تیوپی امیتیس
            $discount_type = 'percent';
            $amount = 100;
            update_post_meta( $new_coupon_id, 'product_ids', '767' ); // 767 => Tiupi
            update_post_meta( $new_coupon_id, 'limit_usage_to_x_items', '1' );
            update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
            break;
        case '1009':
            // 1009->  بن خرید پنجاه هزار تومانی برای خریدهای بالای صد هزار تومان
            $discount_type = 'fixed_cart';
            $amount = '50000';
            update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
            update_post_meta( $new_coupon_id, 'minimum_amount', '150000' );
            break;
        default:
            return -1;
    }
    // Add Common Coupon Details
    update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
    update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
    update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
    update_post_meta( $new_coupon_id, 'exclude_sale_items', 'no' );
    update_post_meta( $new_coupon_id, 'expiry_date', date("Y-m-d", strtotime("+ 3 day")) );
    update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
    update_post_meta( $new_coupon_id, 'usage_limit_per_user', '1' );
    update_post_meta( $new_coupon_id, 'usage_limit', '1' );
    
    // Insert Record
    $wpdb->insert($wpdb->prefix.'chancekey', array(
        'national_code' => $national_code,
        'phone' => $phone,
        'coupon_type' => $discount,
        'coupon_code' => $coupon_code,
        'date' => date('Y-m-d H:i:s', strtotime(' +1 days '))
    ));

    // return 0 => Already Gived
    // return -1 => Error
    // return 1 => Coupon Created
    return 1;
}

/*
NEW MEMEBER
*/
function new_member($billing_phone, $national_code, $coupon_code) {
    global $wpdb;

    $password = wp_generate_password( 12, false );

    $args = array(
        'meta_key'     => 'billing_phone',
        'meta_value'   => $billing_phone,
        'meta_compare' => '='
    );
    $user_query = new WP_User_Query( $args );
    $ex_billing_phone = $user_query->get_results();
    
    
    $args = array(
        'meta_key'     => 'national_code',
        'meta_value'   => $national_code,
        'meta_compare' => '='
    );
    $user_query = new WP_User_Query( $args );
    $ex_national_code = $user_query->get_results();

    
    if( empty( $ex_billing_phone ) && empty( $ex_national_code ) ) :
        // INSERT USER
        $userdata = array(
            'user_login' => esc_attr($billing_phone),
            'user_email' => "",
            'user_pass' => esc_attr($password)
        );
        $user_id = wp_insert_user($userdata);

        // INSERT META
        $userdata = array(
            'billing_phone'         => esc_attr($billing_phone),
            'national_code'         => esc_attr($national_code),
            'user_coupon_code'      => esc_attr($coupon_code),
            'user_coupon_expire'    => date("Y-m-d", strtotime("+ 1 day"))
        );
        
        foreach ($userdata as $meta_key => $meta_value ) {
            update_user_meta( $user_id, $meta_key, $meta_value );
        }

        if (!is_wp_error($user_id)) {
            // MEMBER AUTO LOGIN
            $current_user = get_user_by( 'id', $user_id );
            $secure_cookie = is_ssl() ? true : false;
            wp_set_auth_cookie( $user_id, true, $secure_cookie );
            //
            $_SESSION['coupon_user_id'] = $user_id;
            return 1;
        } else {
            return 0;
        }
    else :
        
        // GET USER ID
        $users = get_users(array('meta_key' => 'national_code', 'meta_value' => $national_code));
        foreach($users as $user) {
            $user_id = $user->ID;
        }

        $expire_time = get_user_meta($user_id, 'user_coupon_expire', true);

        if($expire_time > date("Y-m-d")) {
            if($user_id) {
                return array( "sts" => -1, "coupon_code" => get_user_meta($user_id, 'user_coupon_code', true), "coupon_expiration" => $expire_time );
            } else {
                return 0;
            }
        } else {
            $userdata = array(
                'user_coupon_code'      => esc_attr($coupon_code),
                'user_coupon_expire'    => date("Y-m-d", strtotime("+ 1 day"))
            );
            
            foreach ($userdata as $meta_key => $meta_value ) {
                update_user_meta( $user_id, $meta_key, $meta_value );
            }
            return 1;
        }


    endif;

/* Returns:
0    => 'Error',
1    => 'User and Coupon Created',
-1   => 'Coupon Already Token and User Exist' 
*/
}


/*
PRODUCTS LOOP BY SKU
*/
class iWC_Orderby_Stock_Status
{
    public function __construct()
    {
        // Check if WooCommerce is active
        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            add_filter('posts_clauses', array($this, 'order_by_stock_status'), 2000);
        }
    }
    public function order_by_stock_status($posts_clauses)
    {
        global $wpdb;
        // only change query on WooCommerce loops
        if (is_woocommerce() && (is_shop() || is_product_category() || is_product_tag())) {
            $posts_clauses['join'] .= " INNER JOIN $wpdb->postmeta istockstatus ON ($wpdb->posts.ID = istockstatus.post_id) ";
            $posts_clauses['orderby'] = " istockstatus.meta_value ASC, $wpdb->posts.post_date DESC," . $posts_clauses['orderby'];
            $posts_clauses['where'] = " AND istockstatus.meta_key = '_stock_status' AND istockstatus.meta_value <> '' " . $posts_clauses['where'];
        }
        return $posts_clauses;
    }
}
new iWC_Orderby_Stock_Status;

/* Hide shipping rates when free shipping is available */
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );



/*
CHECKOUT GATWAY SET DEFAULT
*/
function wpchris_filter_gateways( $gateways ){

    global $woocommerce;
    
    foreach ($gateways as $gateway) {
        $gateway->chosen = 1;
    }
    return $gateways;
    
    }
add_filter( 'woocommerce_available_payment_gateways', 'wpchris_filter_gateways', 1);





