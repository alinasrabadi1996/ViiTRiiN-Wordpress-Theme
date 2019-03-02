<?php
define( 'SHORTINIT', true );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
global $wpdb;

if( !isset($_SESSION) ) {
    session_start();
}

include_once(__DIR__.'/../framework/api/sms/SendSMS_SoapClient.php');

if( isset($_POST['sts']) ) :
    $sts = $_POST['sts'];
    if($sts == "get-mobile") {
        if( isset($_POST['mobile_entry']) ) :
            $_SESSION['mobile_entry'] = $_POST['mobile_entry'];
            $_SESSION['verfied_code'] = rand(1000, 9999);
            $assigned_code = $_SESSION['verfied_code'];
            $sms_text = "کد فعال سازی شما در ویترین: $assigned_code";
            
            //
            // Prevent too many requests
            //
            $current_date = date("Y-m-d H:i:s");
            $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}sms_list WHERE phone = $_SESSION[mobile_entry] ORDER BY ID DESC Limit 1", OBJECT);
            if(!empty($result)) { // If phone exist
                $diff_time = strtotime($current_date) - strtotime($result[0]->last_request);
                if($diff_time > 180) { // Limit Time (3 Minutes)
                    $send_sms = SendSMS($sms_text, $_SESSION['mobile_entry']);
                    // Update record
                    $wpdb->update(
                        "{$wpdb->prefix}sms_list",
                        array (
                            'phone' => $result[0]->phone,
                            'token' => $assigned_code,
                            'last_request' => $current_date
                        ),
                        array (
                            'phone' => $result[0]->phone
                        )
                    );
                } else {
                    echo "exceed_time";
                    exit;
                }
            } else { // If phone not exist
                $send_sms = SendSMS($sms_text, $_SESSION['mobile_entry']);
                $wpdb->insert(
                    "{$wpdb->prefix}sms_list",
                    array (
                        'phone' => $_SESSION['mobile_entry'],
                        'token' => $assigned_code,
                        'last_request' => $current_date
                    )
                );
            }

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
