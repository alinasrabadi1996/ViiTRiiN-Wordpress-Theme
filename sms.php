<?php /* Template Name: SMS */ ?>
<?php error_reporting( E_ALL ); ?>
<?php
    include_once('framework/api/sms/SendSMS_SoapClient.php');
    $text = "
کد تخفیف شما: X2S4D2 \n
اعتبار: 24 ساعت \n
http://viitriin.com
";
    echo SendSMS($text, '09368315217');
?>