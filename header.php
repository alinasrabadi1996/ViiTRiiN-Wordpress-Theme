<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<meta name="keywords" content="" />
	<link rel="pingback" href="<?php echo bloginfo( 'pingback_url' ); ?>">
    <link href="<?php echo get_template_uri(); ?>/css/init.css?v=1" rel="stylesheet" />
    <link href="<?php echo get_template_uri(); ?>/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo get_template_uri(); ?>/css/style.css?v=3.1" rel="stylesheet" />
    <?php wp_head(); ?>
    <script>
        var WRAjaxURL = '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>';
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-118341117-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-118341117-1');
    </script>
</head>

<?php
global $post;

$pagename = get_query_var('pagename');  
if ( !$pagename && $id > 0 ) {  
    $post = $wp_query->get_queried_object();  
    $pagename = $post->post_name;  
}
?>
<body class="<?php if(is_front_page()) echo 'homepage'; ?> <?php echo $pagename; ?>">
<div id="modal"></div>
<style>
#modal {
    display: none;
    position: fixed;
    background: #0003;
    width: 100%;
    height: 100%;
    z-index: 999999;
    overflow: scroll;
}

#page-checkout .wc_payment_method.payment_method_cod, 
#page-checkout .wc_payment_method.payment_method_bacs {
    display: none;
}
</style>
<?php get_template_part('framework/pazh', 'main-header'); ?>
