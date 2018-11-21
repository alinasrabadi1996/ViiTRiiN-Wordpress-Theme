<?php /* Template Name: Complaints */ ?>
<?php
    session_start();
    $_session['message'] = null;
    $captcha_instance = new ReallySimpleCaptcha();
    //$captcha_instance->bg = array( 0, 0, 0 );
    $word = $captcha_instance->generate_random_word();
    
    // Generate an image file and a corresponding text file in the temporary directory.
    $prefix = mt_rand();
    $captcha_image_name = $captcha_instance->generate_image( $prefix, $word );
    
    // Create the image file path:
    $captcha_image_file_path = plugins_url().'/really-simple-captcha/tmp/'.$captcha_image_name;


if(isset($_POST['complaints-form'])) :
    $content = $_POST['message'];
    $name = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $captcha_answer = $_POST['captcha_code'];
    $captcha_prefix = $_POST['captcha_prefix'];
    $date = date('Y-m-d H:i:s');
    
    if($captcha_instance->check( $captcha_prefix, $captcha_answer)) {
        $hostname='localhost';
        $username='viitriin_ceouser';
        $password='Aht5vPq9s34E';
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=viitriin_ceopanel;charset=utf8",$username,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO complaints (content, name, phone, email, date)
            VALUES ('".$content."', '".$name."', '".$phone."', '".$email."', '".$date."')";
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
?>
<?php get_header(); ?>
<section id="content-wrap" class="section page-content section--page page--contact">
    <div class="container section-inner">
        <div class="section-title page-title-3">
            <h1 class="title"><?php the_title(); ?></h1>
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-md-12 col complaint-intro">
                    <p class="desc">کاربر گرامی، به اطلاع می رساند فروشگاه اینترنتی ویترین در راستای فعالیت خود و پاسخگویی هرچه بهتر خدمات و نیز عدم تضییع حقوق کاربران، نسبت به ایجاد سامانه پاسخگویی به شکایات اقدام کرده است. این سامانه به منظور رسیدگی به شکایات، انتقادات و پیشنهادات و نیز اطلاع رسانی به موقع شما کاربر محترم طراحی گردیده است.</p>
                </div>
                <div class="col-md-12 col contact-form complaint-form">
                    <div class="col-container">
                        <div class="col-title title-type-2">
                            <h3 class="title">درج شکایت</h3>
                            <h4 class="desc">جهت درج  شکایات، انتقادات و پیشنهادات خود فرم زیر را تکمیل نمایید.</h4>
                        </div>
                        <div class="col-content">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <input name="fullname" id="fullname" type="text" class="form-control" placeholder="نام و نام خانوادگی">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input name="phone" id="phone" type="number" class="form-control" placeholder="تلفن همراه">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input name="email" id="email" type="text" class="form-control" placeholder="آدرس ایمیل">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="form-group col-md-12 textarea">
                                                <textarea name="message" class="form-control" placeholder="متن پیام"></textarea>
                                            </div>
                                            <div class="form-group form-captcha col-md-6">
                                                <input type="text" name="captcha_code" id="captcha_code" class="form-control" placeholder="کد تصویر را وارد کنید...">
                                                <?php echo '<img class="captcha-image" src="'.$captcha_image_file_path.'">'; ?>
                                                <input type="hidden" name="captcha_prefix" value="<?php echo $prefix; ?>">
                                            </div>
                                            <div class="form-group form-action col-md-6">
                                                <button type="submit" name="complaints-form" id="complaints-form" class="button">ارسال پیام</button>
                                            </div>
                                        </div>
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