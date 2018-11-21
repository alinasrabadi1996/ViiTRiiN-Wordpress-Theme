<?php
$pagename = get_query_var('pgname');

$current_user = wp_get_current_user();
$username = $current_user->user_login;
if(!empty($current_user->first_name))
    $username = $current_user->first_name;
?>
<div class="userarea">
    <div class="userinfo">
        <div class="avatar"><img src="<?php echo get_template_uri(); ?>/images/misc/default-avatar.png" alt="آواتار"></div>
        <span class="username"><?php echo $username; ?></span>
    </div>
</div>
<nav>
    <ul class="item-list">
        <li class="menu-item orders <?php if($pagename == "") echo "current"; ?>"><a href="<?php echo site_url(); ?>/dashboard/"><span class="icon icon-nav-cart"></span> سفارش های من</a></li>
        <li class="menu-item creadits <?php if($pagename == "creadits") echo "current"; ?>"><a href="<?php echo site_url(); ?>/dashboard/creadits"><span class="icon icon-stars"></span> امتیاز های من</a></li>
        <li class="menu-item methods <?php if($pagename == "methods") echo "current"; ?>"><a href="<?php echo site_url(); ?>/dashboard/methods"><span class="icon icon-star_half"></span> روش کسب امتیاز</a></li>
        <li class="menu-item profile <?php if($pagename == "profile") echo "current"; ?>"><a href="<?php echo site_url(); ?>/dashboard/profile"><span class="icon icon-account_circle"></span> اطلاعات حساب کاربری</a></li>
        <li class="menu-item passowrd <?php if($pagename == "passowrd") echo "current"; ?>"><a href="<?php echo site_url(); ?>/dashboard/"><span class="icon icon-keyboard"></span> تغییر گذرواژه</a></li>
        <li class="menu-item support <?php if($pagename == "support") echo "current"; ?>"><a href="<?php echo site_url(); ?>/dashboard/"><span class="icon icon-question_answer"></span> پشتیانی</a></li>
        <li class="menu-item logout <?php if($pagename == "logout") echo "current"; ?>"><a href="<?php echo site_url(); ?>/dashboard/logout"><span class="icon icon-exit_to_app"></span> خروج</a></li>
    </ul>
</nav>