<?php 

if( !isset($_POST['subs_input']) || empty($_POST['subs_input']) ) {
    wp_die('دسترسی به این صفحه مقدور نیست.', 'خطا');
}

/* CEOPanel DB Info */
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
define('DBNAME','ceopanel');

include_once('framework/api/sms/SendSMS_SoapClient.php');
include_once('framework/api/mail/simpleMail.php');


$subs_type = "phone";
$subs_input = $_POST['subs_input'];
if( strpos($subs_input, "@") == true )
    $subs_type = "email";

$date = date('Y-m-d H:i:s');
try {
    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DBNAME.';charset=utf8',DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO subscription (subs_val, subs_type, subs_date)
    VALUES ('".$subs_input."', '".$subs_type."', '".$date."')";
    if($dbh->query($sql)) {
        if ( $subs_type == "phone" ) {
        $sms_text = "اطلاعات شما در ویترین با موفقیت ثبت شد.\r
منتظر خبرهای خوب ما باشید...
";
            SendSMS($sms_text, $subs_input);
        } else {
            $subject = "اشتراک در خبرنامه فروشگاه اینترنتی ویترین";
            $message = "اطلاعات شما در ویترین با موفقیت ثبت شد.
منتظر خبرهای خوب ما باشید...
";
            SendMail($subs_input, $subject, $message);
        }
    }
    $dbh = null;
}
catch(PDOException $e) {
    wp_die('سیستم با مشکل مواجع شد! لطفا با پشتیبانی تماس بگیرید.', 'خطا'); 
}

get_header(); 

?>

<section id="content-wrap" class="section page-content section--page page--subscribe">
    <div class="container section-inner">
        <div class="section-content">
            <div class="subscribe-icon"><img src="<?php echo get_template_uri(); ?>/images/misc/subscribe-icon.png" alt="subscribe"></div>
            <div class="subscribe-title"><h1 class="title">تبریک، شما هم‌اکنون مشترک ویترین شدید!</h1></div>
            <div class="subscribe-desc"><h3 class="desc">منتظر خبرهای خوب ما باشید...</h3></div>
        </div>
    </div>
</section>

<?php get_footer(); ?>