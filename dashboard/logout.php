<?php
ob_start();

if( !isset($_SESSION) ) {
    session_start();
}

session_destroy();
wp_clear_auth_cookie();

$_SESSION['global_current_user_id'] = "";

header('Location: '.site_url());

echo "در حال خروج...";
echo "<script type='text/javascript'>  window.location='".site_url()."'; </script>";
