<?php /* Template Name: Chance Key */ ?>
<?php
session_start();

include_once('framework/api/sms/SendSMS_SoapClient.php');

/*
if( !isset($_POST['chance-key-submit']) || 
    empty($_POST['national_code']) || 
    empty($_POST['phone']) ) {
    wp_redirect(site_url());
}
*/

if(isset($_POST['billing_phone']))  :
    $national_code = $_POST['national_code'];
    $billing_phone = $_POST['billing_phone'];

    $discount = discount();

    $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $coupon_code = "";
    for ($i = 0; $i < 6; $i++) {
        $coupon_code .= $chars[mt_rand(0, strlen($chars)-1)];
    }

    $result = new_member($billing_phone, $national_code, $coupon_code);

    $sms_text = "کد تخفیف شما: $coupon_code \n
اعتبار تا پایان امروز \n
http://viitriin.com
";
 
    if($result == 1) {
        $user_id = isset($_SESSION['coupon_user_id']) ? $_SESSION['coupon_user_id'] : get_current_user_id();
        new_coupon($coupon_code, $discount, $user_id);
        SendSMS($sms_text, $billing_phone);
    }

    if(is_array($result)) {
        echo json_encode( array("sts" => -1, "coupon" => $result['coupon_code'], "expire" => $result['coupon_expiration']) );
    } else {
        echo json_encode( array("sts" => $result, "coupon" => $coupon_code, "discount" => $discount) );
    }
    
    die();
else :
    wp_redirect(site_url());
endif;