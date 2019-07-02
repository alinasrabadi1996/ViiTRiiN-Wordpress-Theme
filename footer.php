</div>
    </div>
        </div>
        <footer id="footer">
            <div class="footer-inner container-fluid">
                <div class="row">
                    <div class="col-md-7">
                        <div class="col-container">
                            <div class="col-section grid-fifth">
                                <div class="section-head">
                                    <h3 class="title">خدمات مشتریان</h3>
                                </div>
                                <div class="section-body">
                                    <ul class="nav-items">
                                        <li class="item"><a target="_blank" href="<?php echo site_url(); ?>/faq/">پرسش های متداول</a></li>
                                        <li class="item"><a target="_blank" href="#">حریم شخصی</a></li>
                                        <li class="item"><a target="_blank" href="<?php echo site_url(); ?>/terms-of-service/">قوانین و مقررات</a></li>
                                        <li class="item"><a target="_blank" href="<?php echo site_url(); ?>/complaints/">ثبت شکایات</a></li>
                                    </ul>
                                    <ul class="nav-items">
                                        <li class="item"><a target="_blank" href="#">راهنمای خرید</a></li>
                                        <li class="item"><a target="_blank" href="<?php echo site_url(); ?>/contact-us/">تماس با ما</a></li>
                                        <li class="item"><a target="_blank" href="<?php echo site_url(); ?>/about-us/">درباره ما</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-section grid-fifth">
                                <div class="section-head">
                                    <h3 class="title">فروشگاه</h3>
                                </div>
                                <div class="section-body">
                                    <ul class="nav-items">
                                        <li class="item"><a target="_blank" href="<?php echo site_url(); ?>/dashboard/">ورود به پنل کاربری</a></li>
                                        <li class="item"><a target="_blank" href="<?php echo site_url(); ?>/cart/">سبد خرید</a></li>
                                        <li class="item"><a target="_blank" href="<?php echo site_url(); ?>/order-tracking/">پیگیری سفارش</a></li>
                                        <li class="item"><a target="_blank" href="#">شرایط همکاری</a></li>
                                    </ul>
                                    <ul class="nav-items">
                                        <li class="item"><a target="_blank" href="#">تبلیغات و اسپانسر</a></li>
                                        <li class="item"><a target="_blank" href="#">پشتیبانی</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="col-container">
                            <div class="col-section grid-wide">
                                <div class="section-head">
                                    <h3 class="title">عضویت در خبرنامه</h3>
                                </div>
                                <div class="section-body">
                                    <p class="desc">ایمیل یا شماره همراه خود را وارد نمایید تا از آخرین تخفیف ها و جدید ترین محصولات ویترین با خبر شوید...</p>
                                    <div id="subscription">
                                        <form name="subscribe-form" id="subscribe-form" method="post" action="<?php echo site_url(); ?>/subscribe">
                                            <input type="text" class="form-input" id="subs_input" name="subs_input" placeholder="ایمیل یا شماره همراه" />
                                            <button class="form-button" type="submit">عضویت</button>
                                        </form>
                                    </div>
                                    <div id="footer-socials">
                                        <ul>
                                            <li class="social-item"><a target="_blank" href="https://www.instagram.com/viitriin_store/"><i class="icon icon-instagram"></i></a></li>
                                            <li class="social-item"><a target="_blank" href="https://www.facebook.com/ViitriinCom/"><i class="icon icon-facebook"></i></a></li>
                                            <li class="social-item"><a target="_blank" href="https://www.linkedin.com/in/viitriin-store/"><i class="icon icon-linkedin2"></i></a></li>
                                            <li class="social-item"><a target="_blank" href="https://twitter.com/ViitriinCom"><i class="icon icon-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div id="footer-bottom">
                    <div class="enamad">
                        <img src="<?php echo get_template_uri(); ?>/images/misc/enamad-logo.png" alt="" onclick="window.open(&quot;https://trustseal.enamad.ir/Verify.aspx?id=125903&amp;p=7i6pSlDPnlaVnxNp&quot;, &quot;Popup&quot;,&quot;toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30&quot;)" style="cursor:pointer" id="7i6pSlDPnlaVnxNp">
                    </div>
                    <p class="copyright"><small class="_txt">کلیه حقوق این وب سایت برای فروشگاه اینترنتی ویترین محفوظ می باشد.</small></p>
                </div>
            </div>
        </footer>

        <script src="<?php echo get_template_uri(); ?>/js/init.js?v=1"></script>
        <script src="<?php echo get_template_uri(); ?>/js/customize.js?v=2.8"></script>

        <script type="text/javascript">
            paceOptions = {
                ajax: false, // Monitors all ajax requests on the page
                document: false, // Checks for the existance of specific elements on the page
                eventLag: false, // Checks the document readyState
                elements: {
                    selectors: ['.my-page'] // Checks for event loop lag signaling that javascript is being executed
                }
            };

            jQuery(".form-row").removeClass("address-field");
            jQuery(document).ready(function() {
                jQuery('#page-checkout #billing_city').on('change', function (e) {
                    if(jQuery(this).val() === "تهران") {
                        jQuery("#page-checkout .wc_payment_method.payment_method_cod").show(300);
                        jQuery("#payment_notice").show(300);
                    } else {
                        jQuery("#page-checkout .wc_payment_method.payment_method_cod").hide(300);
                        jQuery("#payment_notice").hide(300);
                    }
                    
                });
                jQuery('#payment_method_bankmellat').prop("checked", true);
            });

            jQuery(document).on('keyup', '#billing_phone', function(){
                String.prototype.toEnglishDigits = function () {
                    var persian = { '۰': '0', '۱': '1', '۲': '2', '۳': '3', '۴': '4', '۵': '5', '۶': '6', '۷': '7', '۸': '8', '۹': '9' };
                    var arabic = { '٠': '0', '١': '1', '٢': '2', '٣': '3', '٤': '4', '٥': '5', '٦': '6', '٧': '7', '٨': '8', '٩': '9' };
                    return this.replace(/[^0-9.]/g, function (res) {
                        return persian[res] || arabic[res] || res;
                    });
                };
                var phone = jQuery(this).val();
                if(phone.length > 0) {
                    phone = phone.toEnglishDigits();
                    if(phone.indexOf(0) != 0) {
                        jQuery(this).val('0' + phone);
                    } else {
                        jQuery(this).val(phone);
                    }
                }
            });


            /*
            CHANCE KEY
            */
            jQuery(document).ready(function() {
                jQuery("#chancekey-link, .chancekey-link").click(function(e) {
                    e.preventDefault();
                    chance_key();
                });
            });

            function validate_national(meli_code) {
                if (meli_code.length == 10) {
                    if (meli_code == '1111111111' ||
                        meli_code == '0000000000' ||
                        meli_code == '2222222222' ||
                        meli_code == '3333333333' ||
                        meli_code == '4444444444' ||
                        meli_code == '5555555555' ||
                        meli_code == '6666666666' ||
                        meli_code == '7777777777' ||
                        meli_code == '8888888888' ||
                        meli_code == '9999999999') {
                        return false;
                    }
                    c = parseInt(meli_code.charAt(9));
                    n = parseInt(meli_code.charAt(0)) * 10 +
                        parseInt(meli_code.charAt(1)) * 9 +
                        parseInt(meli_code.charAt(2)) * 8 +
                        parseInt(meli_code.charAt(3)) * 7 +
                        parseInt(meli_code.charAt(4)) * 6 +
                        parseInt(meli_code.charAt(5)) * 5 +
                        parseInt(meli_code.charAt(6)) * 4 +
                        parseInt(meli_code.charAt(7)) * 3 +
                        parseInt(meli_code.charAt(8)) * 2;
                    r = n - parseInt(n / 11) * 11;
                    if ((r == 0 && r == c) || (r == 1 && c == 1) || (r > 1 && c == 11 - r)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
            jQuery("#chance-key-form").validate({
                rules: {
                    national_code: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    billing_phone: {
                        required: true,
                        minlength: 11,
                        maxlength: 11
                    }
                },
                messages: {
                    national_code: {
                        required: "کد ملی خود را وارد نمائید.",
                        minlength: "کد ملی وارد شده معتبر نیست.",
                        maxlength: "کد ملی وارد شده معتبر نیست."
                    },
                    billing_phone: {
                        required: "شماره همراه خود را وارد نمائید.",
                        minlength: "شماره همراه معتبر نیست.",
                        maxlength: "شماره همراه معتبر نیست."
                    }
                },
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent().parent());
                },
                success: function(label,element) {
                    label.parent().removeClass('field-error');
                    //label.parent().addClass("field-success");
                },
                highlight: function(element) {
                    jQuery(element).parent().addClass("field-error");
                },
                unhighlight: function(element) {
                    jQuery(element).parent().removeClass("field-error");
                },
                submitHandler: function (form) {
                    var national_code = jQuery('#national_code').val();
                    if( validate_national(national_code) ) {
                        var request;
                        if (request) {
                            request.abort(); 
                        }
                        var jQueryform = jQuery("#chance-key-form");
                        var jQueryinputs = jQueryform.find("input, select, button, textarea");
                        var serializedData = jQueryform.serialize();
                        jQueryinputs.prop("disabled", true);

                        request = jQuery.ajax({
                            url: '<?php echo site_url(); ?>/chance-key',
                            type: 'POST',
                            data: serializedData,
                            cache: false,
                            dataType: 'JSON',
                            beforeSend: function() {
                                jQuery('#chance-loading').show();
                                jQuery("#chance-key-error").hide();
                                jQuery("#chance-key-fields").hide();
                            }
                        });

                        request.done(function (response, textStatus, jqXHR){
                            jQuery('#chance-loading').hide();
                            console.log(response);
                            if(response.sts == 1) {
                                var congText = "";
                                switch(response.discount) {
                                    case 1001:
                                        congText = "ارسال رایگان (حداقل خرید ۱۰۰ هزار تومان)!";
                                        break;
                                    case 1002:
                                        congText = "ارسال رایگان (حداقل خرید ۱۵۰ هزار تومان)!";
                                        break;
                                    case 1003:
                                        congText = "۱۰,۰۰۰ تومان تخفیف!";
                                        break;
                                    case 1004:
                                        congText = "۵۰,۰۰۰ تومان تخفیف!";
                                        break;
                                    case 1005:
                                        congText = "مداد چشم شمعی آمیتیس";
                                        break;
                                    case 1006: 
                                        congText = "کرم پودر تیوپی آمیتیس";
                                        break;
                                }
                                jQuery("#chance-key-response").html('<h3 class="title">تبریک شما برنده شدید</h3><h4 class="desc">'+congText+'</h4><div class="coupon-code">کد تخفیف به موبایل شما پیامک می‌شود</div> ' + ' <div class="expire-timer"><h4 class="title">زمان باقی مانده تا شانس بعدی</h3><span id="exp_countdown"></span></div>');
                                jQuery('#exp_countdown').countdown('<?php echo date('Y-m-d H:i:s', strtotime(' +1 days ')); ?>', function(event) {
                                    jQuery(this).html(event.strftime('%H:%M:%S'));
                                });
                            } else if (response.sts == 0) { 
                                jQuery("#chance-key-response").html('<h3 class="title spacing">شما امروز از کلید شانس خود استفاده کرده‌اید!</h3>' + '<div class="expire-timer"><h4 class="title">زمان باقی مانده تا شانس بعدی</h3><span id="exp_countdown"></span></div>');
                                jQuery('#exp_countdown').countdown(response.expire, function(event) {
                                    jQuery(this).html(event.strftime('%H:%M:%S'));
                                });
                            } else {
                                jQuery("#chance-key-error").html('<h3 class="fail">خطایی رخ داده است!<br> لطفا مجدد تلاش کنید.</h3>');
                                jQuery("#chance-key-fields").show();
                            }
                        });
                        request.fail(function (jqXHR, textStatus, errorThrown){
                            jQuery("#chance-key-response").html('<h3 class="fail">خطایی رخ داده است!<br> لطفا مجدد تلاش کنید.</h3>');
                            jQuery("#chance-key-fields").show();
                        });
                        request.always(function () {
                            jQueryinputs.prop("disabled", false);
                        });
                    } else {
                        jQuery("#chance-key-error").html('<h3 class="fail">کد ملی وارد شده نامعتبر است!</h3>');
                        jQuery("#chance-key-fields").show();
                    }
                }
            });
            jQuery.extend(jQuery.validator.messages, {
                required: "This field is required.",
                remote: "Please fix this field.",
                email: "Please enter a valid email address.",
                url: "Please enter a valid URL.",
                date: "Please enter a valid date.",
                dateISO: "Please enter a valid date (ISO).",
                number: "مقدار وارد شده معتبر نیست.",
                digits: "Please enter only digits.",
                creditcard: "Please enter a valid credit card number.",
                equalTo: "Please enter the same value again.",
                accept: "Please enter a value with a valid extension.",
                maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
                minlength: jQuery.validator.format("Please enter at least {0} characters."),
                rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
                range: jQuery.validator.format("Please enter a value between {0} and {1}."),
                max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
                min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
            });
            jQuery(".chance-key-input").focus(function() {
                if( !jQuery(this).parent().hasClass("field-error")) {
                    jQuery(this).parent().addClass("success");
                }
            });
            jQuery.validator.addMethod('iranPhone', function (value, element) {
                return this.optional(element) || /(0|\+98)?([ ]|-|[()]){0,2}9[1|2|3|4]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/.test(value);
            }, "Please enter a valid phone number");

            function chance_key(){
                jQuery("#popup-chance-key").toggleClass("hide-element");
                jQuery(".chance-key-form").toggleClass("hide-element scale-off");
            }

            jQuery('#popup-chance-key').click(function(e) {
                if(!jQuery(e.target).hasClass('.chance-key-form'))
                {
                    chance_key();
                }
            });

            jQuery('.chance-key-form').click(function(event){
                event.stopPropagation();
            });
        </script>
        <?php wp_footer(); ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="[https://www.googletagmanager.com/gtag/js?id=UA-141728751-2](https://www.googletagmanager.com/gtag/js?id=UA-141728751-2)"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-141728751-2');
        </script>
    </body>
</html>