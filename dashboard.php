<?php /* Template Name: Dashboard */ ?>
<?php if( !isset($_SESSION) ) session_start(); ?>
<?php get_header(); ?>

<?php
    $pagename = get_query_var('pgname');
    $pages = array('profile', 'orders', 'creadits', 'logout', 'methods');
?>

<section id="content-wrap" class="section page-content">
    <div class="container-fluid section-inner">
        <div id="page-dashboard">
            <?php
            
            
            
            if( isset($_SESSION['verfied_mobile']) ) { 
                
                // 09xxx OR 9xxx
                $havePrefix = 0;
                if (substr($_SESSION['verfied_mobile'], 0, 1) == '0') {
                    $havePrefix = 1;
                }
                
                /* BEGIN FIRST TRY */
                $args = array(
                    'meta_key'     => 'billing_phone',
                    'meta_value'   => $_SESSION['verfied_mobile'],
                    'meta_compare' => '='
                );
                $user_query = new WP_User_Query( $args );
                /* END FIRST TRY */
                
                if ( empty( $user_query->get_results() ) ) {
                    
                    /* BEGIN SECOND TRY */
                    if($havePrefix == 1) {
                        $args = array(
                            'meta_key'     => 'billing_phone',
                            'meta_value'   =>  substr($_SESSION['verfied_mobile'], 1),
                            'meta_compare' => '='
                        );
                    } else {
                        $args = array(
                            'meta_key'     => 'billing_phone',
                            'meta_value'   => "0".$_SESSION['verfied_mobile'],
                            'meta_compare' => '='
                        );  
                    }
                    $user_query = new WP_User_Query( $args );
                    /* END SECOND TRY */
                    
                    if( !empty( $user_query->get_results() ) ) {
                        
                        /* BEGIN GET USER */
                        foreach ( $user_query->get_results() as $user ) {
                            $user_id = $user->id;
                        }
                        $_SESSION['global_current_user_id'] = $user_id;
                        wp_set_current_user($user_id); 
                        wp_set_auth_cookie($user_id, true, true );
                        /* END GET USER */
                        
                    } else {
                        unset($_SESSION['verfied_mobile']);
                        echo '<p class="error">در حال حاضر خریدی با این شماره انجام نشده است!</p>';
                        exit;
                    }
                } else {
                    /* BEGIN GET USER */
                    foreach ( $user_query->get_results() as $user ) {
                        $user_id = $user->id;
                    }
                    $_SESSION['global_current_user_id'] = $user_id;
                    wp_set_current_user($user_id); 
                    wp_set_auth_cookie($user_id, true, true );
                    /* END GET USER */
                }
                

                ?>
                <div id="dashboard-sidebar" class="col-md-3">
                    <div class="container-inner">
                        <?php include_once('dashboard/sidebar.php'); ?>
                    </div>
                </div>
                <div id="dashboard-content" class="col-md-9">
                    <div class="container-inner">
                        <?php
                        $end_of_pages = false;
                        foreach($pages as $page) {
                            if($pagename == $page) { 
                                include_once("dashboard/".$pagename.".php");
                                $end_of_pages = true;
                                break;
                            }
                        }
                        if($end_of_pages == false) {
                            include_once("dashboard/index.php");
                        }
                        ?>
                    </div>
                </div>
            <?php } else { ?>
            <div class="tracking-container tracking-auth">          
                <div class="page-title page-title-1">
                    <h1 class="title">ورود به حساب کاربری</h1>
                    <p class="desc">مدیریت حساب کاربری و پیگیری سفارش</p>
                </div>
                <form name="tracking-form" id="tracking-form" method="post">
                    <div id="mobile-form" class="tracking-form">
                        <div class="form-group">
                            <label for="mobile">شماره موبایل</label>
                            <input class="input" type="number" name="mobile" id="mobile">
                        </div>
                        <div class="form-group submit">
                            <input class="button" type="submit" name="order-tracking" value="ادامه">
                        </div>
                    </div>
                    <div id="verification-form" class="tracking-form" style="display: none;">
                        <div class="form-group">
                            <label for="mobile">کد فعال سازی</label>
                            <input class="input" type="number" name="verify-code" id="verify-code">
                        </div>
                        <div class="form-group submit">
                            <div id="response"></div>
                            <input class="button" type="submit" name="order-tracking" value="تایید">
                        </div>
                    </div>
                    <input type="hidden" name="verification_sts" id="verification_sts" value="get-mobile">
                </form>
                <div id="loading" style="display: none;"><img class="loader" src="http://webstatic.net/projects/viitriin.com/images/misc/loading_64.gif" alt="loading"></div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>


<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#tracking-form").submit(function(e) {
            e.preventDefault();
            jQuery("#loading").show();
            initSMS();
        });
    });

    function initSMS() {
        var mobile = jQuery("#mobile").val();
        var code = "Null";
        code = jQuery("#verify-code").val();
        var verification_sts = jQuery("#verification_sts").val();
        jQuery.post("<?php echo site_url(); ?>/includes/mobile-verify.php", {mobile_entry: mobile, verify_code: code, sts: verification_sts }, function(result) {
            if(result == "sent") {
                jQuery("#mobile-form").hide();
                jQuery("#verification-form").show();
                jQuery("#verification_sts").val("get-code");
                jQuery("#response").html("<span class='success'>کد فعال سازی ارسال شده را وارد کنید.<span>");
            } else if(result == "verified") {
                jQuery("#response").html("<span class='success'>اعتبار سنجی انجام شد. در حال انتقال...<span>");
                location.reload();
            } else if(result == "invalid") {
                jQuery("#response").html("<span class='failed'>کد فعال سازی صحیح نمی باشد.<span>");
            } else {
                jQuery("#response").html("<span class='failed'>سیستم با خطا مواجه شد! لطفا دوباره تلاش کنید.<span>");
            }
            jQuery("#loading").hide();
            //console.log(result);
        });
    }
</script>

<?php get_footer(); ?>