<?php /* Template Name: Chance Key */
include_once('framework/api/sms/SendSMS_SoapClient.php');

// SendSMS("test", "09368315217");

if(!isset($_POST['national_code']) || !isset($_POST['billing_phone']) )
    wp_redirect(site_url());

/* Initial Entries */
$national_code = $_POST['national_code'];
$billing_phone = $_POST['billing_phone'];

/* Get Randomize Discount */
$discount = discount();

/* Generate Coupon Code */
$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$coupon_code = "";
for ($i = 0; $i < 6; $i++)
    $coupon_code .= $chars[mt_rand(0, strlen($chars)-1)];

/* Create Coupon */
$result = new_coupon_type2($coupon_code, $discount, $national_code, $billing_phone);

// Send SMS

if($result == 1) {
    switch ($discount) {
        case '1001':
            $sms_text = "تبریک!\nکد تخفیف $coupon_code\nارسال رایگان به تمامی نقاط کشور\nاعتبار ۴۸ ساعت";
            break;
        case '1002':
            $sms_text = "تبریک!\nکد تخفیف $coupon_code\nارسال رایگان برای خریدهای بالای پنجاه هزار تومان، به تمامی نقاط کشور\nاعتبار ۴۸ ساعت";
            break;
        case '1003':
            $sms_text = "تبریک!\nکد تخفیف $coupon_code\n۱۰ هزار تومان تخفیف بر روی سبد خرید حداقل صد هزار تومان\nاعتبار ۴۸ ساعت";
            break;
        case '1004':
            $sms_text = "تبریک!\nکد تخفیف $coupon_code\n۵۰ هزار تومان تخفیف بر روی سبد خرید حداقل صد هزار تومان\nاعتبار ۴۸ ساعت";
            break;
        case '1005':
            $sms_text = "تبریک!\nکد تخفیف مداد چشم چوبی آمیتیس: $coupon_code\nاعتبار ۴۸ساعت";
            break;
        case '1006':
            $sms_text = "تبریک!\nکد تخفیف کرم پودر تیوپی آمیتیس: $coupon_code\nاعتبار ۴۸ساعت";
            break;
    }
    SendSMS($sms_text, $billing_phone);
}

// Response
if(is_array($result)) {
    // Already Exist
    echo json_encode( array("sts" => $result['sts'], "expire" => $result['coupon_expiration']) );
} else {
    echo json_encode( array("sts" => $result, "discount" => $discount) );
}

die();
