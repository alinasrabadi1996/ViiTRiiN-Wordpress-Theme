<?php  /* CEOPanel DB Info */
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
define('DBNAME','ceopanel');

if(isset($_POST['notifier_phone']) && isset($_POST['prod_id'])) {
    $notifier_phone = $_POST['notifier_phone'];
    $notifier_name = $_POST['notifier_name'];
    $prod_id = $_POST['prod_id'];                           
    $var_id = $_POST['var_id'];
    $date = date('Y-m-d H:i:s');
    
    try {
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DBNAME.';charset=utf8',DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "INSERT INTO stock_notifier (product_id, product_color, notifi_date, phone, fullname)
        VALUES ('".$prod_id."', '".$var_id."', '".$date."', '".$notifier_phone."', '".$notifier_name."')";

        if($res = $dbh->query($sql)) {
            echo 1;
        }
        
        $dbh = null;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
 
} else {
    echo 0;
}