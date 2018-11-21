<div class="page-title page-title-2">
    <h1 class="title">اطلاعات حساب کاربری</h1>
    <p class="desc">بروزرسانی اطلاعت حساب کاربری</p>
</div>
<?php
global $current_user, $wp_roles;

$error = array();

$months = array( 'فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند' );

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('ایمیل وارد شده نامعتبر است.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
            $error[] = __('ایمیل وارد شده قبلا ثبت شده است.', 'profile');
        else {
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }

    if ( !empty( $_POST['billing_phone'] ) )
    update_user_meta( $current_user->ID, 'billing_phone', esc_attr( $_POST['billing_phone'] ) );

    /*
    if ( !empty( $_POST['phone_number'] ) )
        update_user_meta( $current_user->ID, 'phone_number', esc_attr( $_POST['phone_number'] ) );
    */

    if ( !empty( $_POST['billing_postcode'] ) )
        update_user_meta( $current_user->ID, 'billing_postcode', esc_attr( $_POST['billing_postcode'] ) );

    if ( !empty( $_POST['national_code'] ) )
        update_user_meta( $current_user->ID, 'national_code', esc_attr( $_POST['national_code'] ) );

    if ( !empty( $_POST['gender'] ) )
        update_user_meta( $current_user->ID, 'gender', esc_attr( $_POST['gender'] ) );
    
    if ( !empty( $_POST['birth_date_day'] ) )
        update_user_meta( $current_user->ID, 'birth_date_day', esc_attr( $_POST['birth_date_day'] ) );

    if ( !empty( $_POST['birth_date_month'] ) )
        update_user_meta( $current_user->ID, 'birth_date_month', esc_attr( $_POST['birth_date_month'] ) );

    if ( !empty( $_POST['birth_date_year'] ) )
        update_user_meta( $current_user->ID, 'birth_date_year', esc_attr( $_POST['birth_date_year'] ) );


    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('پسورد وارد شده یکسان نیست!', 'profile');
    }

    /*‌ UPDATE */
    if ( count($error) == 0 ) {
        do_action('edit_user_profile_update', $current_user->ID);
    }

}
?>

<?php if ( !is_user_logged_in() ) : ?>
    <p class="error">نشست منقضی شده است.</p>
<?php else : ?>
    <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
    <div id="dashboard-form">
        <form method="post" action="">
            <div class="row">
            <div class="col-md-6">
                <div class="form-control form-username">
                    <label for="first-name">نام و نام خانواگی</label>
                    <input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
                </div><!-- form-username -->
                <div class="form-control form-email">
                    <label for="email">ایمیل</label>
                    <input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
                </div><!-- form-email -->
                <div class="form-control form-billing_phone">
                    <label for="billing_phone">شماره همراه</label>
                    <input class="text-input" name="billing_phone" type="text" id="billing_phone_profile" value="<?php the_author_meta( 'billing_phone', $current_user->ID ); ?>" disabled />
                </div><!-- form-billing_phone -->
                <div class="form-control form-phone_number">
                    <label for="phone_number">تلفن ثابت</label>
                    <input class="text-input" name="phone_number" type="text" id="phone_number" value="<?php the_author_meta( 'phone_number', $current_user->ID ); ?>" />
                </div><!-- form-phone_number -->
                <div class="form-control form-billing_postcode">
                    <label for="phone_number">کد پستی</label>
                    <input class="text-input" name="billing_postcode" type="text" id="billing_postcode" value="<?php the_author_meta( 'billing_postcode', $current_user->ID ); ?>" />
                </div><!-- form-phone_number -->
                <div class="form-control form-national_code">
                    <label for="national_code">کد ملی</label>
                    <input class="text-input" name="national_code" type="text" id="national_code_profile" value="<?php the_author_meta( 'national_code', $current_user->ID ); ?>" />
                </div><!-- form-national_code -->
            </div>
            <div class="col-md-6">
                <div class="form-control form-gender">
                    <label for="gender">جنسیت</label>
                    <div class="radio-item">
                        <input class="magic-radio" name="gender" type="radio" id="man" value="man" <?php if(get_the_author_meta( 'gender', $current_user->ID ) == "man") echo "checked"; ?>>
                        <label for="man">مرد</label>
                    </div>
                    <div class="radio-item">
                        <input class="magic-radio" name="gender" type="radio" id="woman" value="woman" <?php if(get_the_author_meta( 'gender', $current_user->ID ) == "woman") echo "checked"; ?>>
                        <label for="woman">زن</label>
                    </div>
                </div><!-- form-gender -->
                <div class="form-control form-gender">
                    <label for="birth-date">تاریخ تولد</label>
                    <select id="birth-date-day" name="birth_date_day">
                        <option value="-1">روز</option>
                        <?php
                            for ( $i = 1; $i <= 31; $i++ ) {
                                printf( '<option value="%1$s" %2$s>%1$s</option>', $i, selected( get_the_author_meta('birth_date_day', $current_user->ID), $i, false ) );
                            }
                        ?>
                    </select>
                    <select id="birth_date_month" name="birth_date_month">
                        <option value="-1">ماه</option>
                        <?php
                            foreach ( $months as $month ) {
                                printf( '<option value="%1$s" %2$s>%1$s</option>', $month, selected( get_the_author_meta('birth_date_month', $current_user->ID), $month, false ) );
                            }
                        ?>
                    </select>
                    <select id="birth_date_year" name="birth_date_year">
                        <option value="-1">سال</option>
                        <?php
                            for ( $i = 1300; $i <= 1392; $i++ ) {
                                printf( '<option value="%1$s" %2$s>%1$s</option>', $i, selected( get_the_author_meta('birth_date_year', $current_user->ID), $i, false ) );
                            }
                        ?>
                    </select>
                </div><!-- form-gender -->
            </div>
            </div>

            <?php do_action('edit_user_profile', $current_user);  ?>
            <div class="form-control form-submit">
                <?php echo $referer; ?>
                <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('بروزرسانی', 'profile'); ?>" />
                <?php wp_nonce_field( 'update-user' ) ?>
                <input name="action" type="hidden" id="action" value="update-user" />
            </div>
        </form>
    </div>
<?php endif;

