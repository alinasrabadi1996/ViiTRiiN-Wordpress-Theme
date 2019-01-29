<?php /* Template Name: Contact Us */
/* CEOPanel DB Info */
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
define('DBNAME','ceopanel');

$_session['message'] = null;
$captcha_instance = new ReallySimpleCaptcha();
//$captcha_instance->bg = array( 0, 0, 0 );
$word = $captcha_instance->generate_random_word();

// Generate an image file and a corresponding text file in the temporary directory.
$prefix = mt_rand();
$captcha_image_name = $captcha_instance->generate_image( $prefix, $word );

// Create the image file path:
$captcha_image_file_path = plugins_url().'/really-simple-captcha/tmp/'.$captcha_image_name;


if(isset($_POST['contact-form'])) :
    $content = $_POST['message'];
    $name = $_POST['fullname'];
    $phone = $_POST['phone'];
    $captcha_answer = $_POST['captcha_code'];
    $captcha_prefix = $_POST['captcha_prefix'];
    $date = date('Y-m-d H:i:s');
    
    if($captcha_instance->check( $captcha_prefix, $captcha_answer)) {
        try {
            $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DBNAME.';charset=utf8',DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO contact (content, name, phone, date)
            VALUES ('".$content."', '".$name."', '".$phone."', '".$date."')";
            if($dbh->query($sql)) {
                $_session['message'] = '<div class="form-alert success">پیام شما دریافت شد. در صورت نیاز با شما تماس حاصل می شود.</div>';
            }
            $dbh = null;
        }
        catch(PDOException $e) {
            wp_die('سیستم با مشکل مواجع شد! لطفا با پشتیبانی تماس بگیرید.', 'خطا'); 
        }
    } else {
        $_session['message'] = '<div class="form-alert danger">کد با تصویر مطابقت ندارد.</div>';
    }
endif;

get_header();

?>
<section id="content-wrap" class="section page-content section--page page--contact">
    <div class="container section-inner">
        <div class="section-title page-title-3">
            <h1 class="title"><?php the_title(); ?></h1>
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-md-6 col contact-details">
                    <div class="col-container">
                        <div class="col-title title-type-2">
                            <h3 class="title">اطلاعات تماس</h3>
                            <h4 class="desc">جهت تماس با ما از اطلاعات زیر می توانید استفاده کنید.</h4>
                        </div>
                        <div class="col-content">
                            <ul>
                                <li class="contact-item">
                                    <span class="meta"><i class="icon icon-pin_drop"></i>آدرس:</span>
                                    <span class="value">تهران – خیابان سهروردی شمالی – کوچه افشار جوان – پلاک ۴۸<span>
                                </li>
                                <li class="contact-item">
                                    <span class="meta"><i class="icon icon-phone"></i>تلفن تماس:</span>
                                    <!--<span class="value ltr">۰۲۱ - ۸۸۹۳۰۵۱۱ &nbsp;&nbsp;|&nbsp;&nbsp; ۰۹۹۸۱۰۰۷۲۴۰<span>-->
                                    <span class="value ltr">۰۹۹۸۱۰۰۷۲۴۰<span>
                                    
                                </li>
                                <li class="contact-item">
                                    <span class="meta"><i class="icon icon-mail_outline"></i>ایمیل:</span>
                                    <span class="value ltr">info@viitriin.com<span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col contact-form">
                    <div class="col-container">
                        <div class="col-title title-type-2">
                            <h3 class="title">ارتباط با ما</h3>
                            <h4 class="desc">جهت ارتباط با ما فرم زیر را تکمیل نمایید.</h4>
                        </div>
                        <div class="col-content">
                            <?php //site_url(); /includes/contact-from.php ?>
                            <form method="post" action="">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input name="fullname" id="fullname" type="text" class="form-control" placeholder="نام و نام خانوادگی">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input name="phone" id="phone" type="number" class="form-control" placeholder="تلفن همراه">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 textarea">
                                        <textarea name="message" id="message" class="form-control" placeholder="متن پیام"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group form-captcha col-md-6">
                                        <input type="text" name="captcha_code" id="captcha_code" class="form-control" placeholder="کد تصویر را وارد کنید...">
                                        <?php echo '<img class="captcha-image" src="'.$captcha_image_file_path.'">'; ?>
                                        <input type="hidden" name="captcha_prefix" value="<?php echo $prefix; ?>">
                                    </div>
                                    <div class="form-group form-action col-md-6">
                                        <button type="submit" name="contact-form" class="button">ارسال پیام</button>
                                    </div>
                                </div>
                                <?php echo $_session['message']; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>