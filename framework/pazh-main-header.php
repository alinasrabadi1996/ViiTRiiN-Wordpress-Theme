<?php
get_template_part('framework/pazh', 'sidebar-menu'); ?>

<div id="popup-chance-key" class="hide-element">
    <div class="chance-key-form hide-element">
        <i class="icon-close close-chance-key" onclick="chance_key()"></i>
        <div class="change-key-image">
            <img src="<?php echo get_template_uri(); ?>/images/branding/logo.png">
        </div>
        <div id="chance-loading"><img src="<?php echo get_template_uri(); ?>/images/misc/chance-animate.gif"></div>
        <div id="chance-key-error"></div>
        <div id="chance-key-fields">
            <form name="chance-key-form" id="chance-key-form" method="post" action="">
                <div class="form-field">
                    <div class="chance-key-input-boxing">
                        <i class="icon-account_box chance-key-icons"></i>
                        <input name="national_code" id="national_code" type="number" placeholder="کد ملی" class="chance-key-input" required>
                    </div>
                </div>
                <div class="form-field">
                    <div class="chance-key-input-boxing">
                        <i class="icon-phone chance-key-icons"></i>
                        <input name="billing_phone" id="billing_phone" type="number" placeholder="شماره همراه" class="chance-key-input" required>
                    </div>
                </div>
                <input type="submit" name="chance-key-submit" id="chance-key-submit" class="submit-chance-key" value="ثبت">
            </form>
        </div>
        <div id="chance-key-response"></div>
    </div>
</div>

<div class="md-modal" id="notifire-box">
    <div class="md-modal-overlay md-modal-toggle"></div>
    <div class="md-modal-wrapper md-modal-transition">
        <div class="md-modal-header">
            <h4 class="md-modal-title">به من اطلاع بده</h4>
            <i class="icon-close md-modal-close"></i>
        </div>
        <div class="md-modal-content">
            <form id="notifire-form" method="post" action="">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5"><label class="form-label" for="notifier_phone">شماره همراه</label></div>
                        <div class="col-md-7"><input name="notifier_phone" id="notifier_phone" type="number" required></div>
                    </div>
                </div>
                <div class="form-group"> 
                    <div class="row">
                        <div class="col-md-5"><label class="form-label" for="notifier_name">نام و نام خانوادگی</label></div>
                        <div class="col-md-7"><input name="notifier_name" id="notifier_name" type="text" required></div>
                    </div>
                </div>
                <div class="form-control">
                    <input type="submit" class="submit-button" name="notifire-submit" id="notifire-submit" value="ثبت">
                    <div id="md-modal-response"></div>
                </div>
                <input type="hidden" id="notifier_var_id" name="variation_id" value="0" />
            </form>
        
            <div id="md-modal-loading" style="display: none;"><img class="loading" src="<?php echo get_template_uri(); ?>/images/misc/loading_64.gif" alt="loading"></div>
        </div>
    </div>
</div>

<div class="main-topbar winter-festival" data-offset="60">
    <div class="snowflakes" aria-hidden="true">
        <div class="festival-details">
            <div class="title">جشنواره زمستانه ویترین</div>
            <div class="deposit">تخفیف + ارسال رایگان</div>
        </div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
        <div class="snowflake"><img draggable="false" class="emoji" alt="❄" src="https://s.w.org/images/core/emoji/11/svg/2744.svg"></div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
        <div class="snowflake"><img draggable="false" class="emoji" alt="❄" src="https://s.w.org/images/core/emoji/11/svg/2744.svg"></div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
        <div class="snowflake"><img draggable="false" class="emoji" alt="❄" src="https://s.w.org/images/core/emoji/11/svg/2744.svg"></div>
    </div>
</div>

<header id="main-header" class="container-fluid static">
    <div class="search">
        <?php echo do_shortcode('[wcas-search-form]'); ?>
    </div>                
    <div class="header-col col-right">
        <div class="branding"><a href="<?php echo site_url(); ?>"><img class="logo-img" src="<?php echo get_template_uri(); ?>/images/branding/logo.png"></a></div>
        <div id="navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'menu_class' => 'header-menu menu',
                'container' => 'nav'
            ));
            ?>
        </div>   
        <div id="navbar-collapse" class="hidden-lg hidden-md hidden-sm">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
        </div>                 
    </div>
    <div class="header-col col-left">
        <div class="member-area">
            <ul class="item-list">
                <li class="item">
                    <div class="navbar-icon menu-cart dropdown">
                        <a class="cart-btn" href="<?php echo WC()->cart->get_cart_url(); ?>">
                            <i class="col-icon icon icon-nav-cart navbar-shop-icon"></i>
                        </a>
                    </div>
                </li>
                <li class="item">                             
                    <i class="col-icon icon icon-search-icon navbar-search-icon"></i>
                </li>
                <li class="item item-button">
                    <a class="button" href="<?php echo site_url(); ?>/dashboard">پنل کاربری</a>
                </li>
                <?php
/*
                <li class="item item-button chance-key">
                    <a class="button" href="#">کلید شانس</a>
                </li>
*/ ?>
            </ul>
        </div>
    </div>
</header>
<div class="main-wrapper woocommerce">