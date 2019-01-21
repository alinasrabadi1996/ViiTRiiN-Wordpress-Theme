<?php
include_once(__DIR__.'/../framework/api/sms/SendSMS_SoapClient.php');

if( isset($_POST['sts']) ) :
    $sts = $_POST['sts'];
    if($sts == "get-mobile") {
        if( isset($_POST['mobile_entry']) ) :
            $_SESSION['mobile_entry'] = $_POST['mobile_entry'];
            $_SESSION['verfied_code'] = rand(1000, 9999);
            $assigned_code = $_SESSION['verfied_code'];
            $sms_text = "کد فعال سازی شما در ویترین: $assigned_code";
            $send_sms = SendSMS($sms_text, $_SESSION['mobile_entry']);
            if($send_sms == 1) {
                echo "sent";
                exit; 
            } elseif($send_sms == -1) {
                echo "API_Err";
                exit;
            } else {
                echo "Err";
                exit;
            }
        else :
            echo "Err";
            exit;
        endif;
    } elseif($sts == "get-code") {
        if( isset($_POST['verify_code']) ) :
            if($_SESSION['verfied_code'] == $_POST['verify_code']) {
                echo "verified";
                unset($_SESSION['verfied_code']);
                $_SESSION['verfied_mobile'] = $_SESSION['mobile_entry'];
                unset($_SESSION['mobile_entry']);
                exit;
            } else {
                echo "invalid";
                exit;
            }
        else :
            echo "Err";
            exit;
        endif;
    } else {
        echo "Err";
        exit;
    }
else :
    echo "Err";
    exit;
endif;
