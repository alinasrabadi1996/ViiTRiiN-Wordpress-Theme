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
                                        <li class="item"><a href="#">پرسش های متداول</a></li>
                                        <li class="item"><a href="#">حریم شخصی</a></li>
                                        <li class="item"><a href="<?php echo site_url(); ?>/terms-of-service/">قوانین و مقررات</a></li>
                                        <li class="item"><a href="<?php echo site_url(); ?>/complaints/">ثبت شکایات</a></li>
                                    </ul>
                                    <ul class="nav-items">
                                        <li class="item"><a href="#">راهنمای خرید</a></li>
                                        <li class="item"><a href="<?php echo site_url(); ?>/contact-us/">تماس با ما</a></li>
                                        <li class="item"><a href="<?php echo site_url(); ?>/about-us/">درباره ما</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-section grid-fifth">
                                <div class="section-head">
                                    <h3 class="title">فروشگاه</h3>
                                </div>
                                <div class="section-body">
                                    <ul class="nav-items">
                                        <li class="item"><a href="<?php echo site_url(); ?>/dashboard/">ورود به پنل کاربری</a></li>
                                        <li class="item"><a href="<?php echo site_url(); ?>/cart/">سبد خرید</a></li>
                                        <li class="item"><a href="<?php echo site_url(); ?>/order-tracking/">پیگیری سفارش</a></li>
                                        <li class="item"><a href="#">شرایط همکاری</a></li>
                                    </ul>
                                    <ul class="nav-items">
                                        <li class="item chancekey-link"><a href="#">کلید شانس</a></li>
                                        <li class="item"><a href="#">تبلیغات و اسپانسر</a></li>
                                        <li class="item"><a href="#">پشتیبانی</a></li>
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
                                            <li class="social-item"><a href="https://www.instagram.com/viitriin_store/"><i class="icon icon-instagram"></i></a></li>
                                            <li class="social-item"><a href="https://www.facebook.com/ViitriinCom/"><i class="icon icon-facebook"></i></a></li>
                                            <li class="social-item"><a href="https://www.linkedin.com/in/viitriin-store/"><i class="icon icon-linkedin2"></i></a></li>
                                            <li class="social-item"><a href="https://twitter.com/ViitriinCom"><i class="icon icon-twitter"></i></a></li>
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
                        <img src="https://trustseal.enamad.ir/logo.aspx?id=89076&amp;p=5ONOykIjqCEUMJY7" alt="" onclick="window.open(&quot;https://trustseal.enamad.ir/Verify.aspx?id=89076&amp;p=5ONOykIjqCEUMJY7&quot;, &quot;Popup&quot;,&quot;toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30&quot;)" style="cursor:pointer" id="5ONOykIjqCEUMJY7">			
                    </div>
					
                    <div class="enamad" id="samandehi">
						<img id='jxlzesgtesgtesgtapfuesgtjxlz' style='cursor:pointer; padding-bottom: 16px;' onclick='window.open("https://logo.samandehi.ir/Verify.aspx?id=1000501&p=rfthobpdobpdobpddshwobpdrfth", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' alt='logo-samandehi' src='https://logo.samandehi.ir/logo.aspx?id=1000501&p=nbpdlymalymalymaujynlymanbpd'/>
                    </div>
							
                    <p class="copyright"><small class="_txt">کلیه حقوق این وب سایت برای فروشگاه اینترنتی ویترین محفوظ می باشد.</small></o>
                </div>
            </div>
        </footer>

        <script src="<?php echo get_template_uri(); ?>/js/init.js"></script>
        <script src="<?php echo get_template_uri(); ?>/js/customize.js"></script>

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
                    } else {
                        jQuery("#page-checkout .wc_payment_method.payment_method_cod").hide(300);
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
        </script>
        <?php wp_footer(); ?>
    </body>
</html>