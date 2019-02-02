<?php get_header(); ?>

<?php
$current_post_id = get_the_ID();
$product_target = 'a:1:{i:0;'.serialize("$current_post_id").'}';


$args = array(
    'post_type'         => 'product',
    'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
    'posts_per_page'    => -1,
    'meta_query' => array(
        array(
            'key' => 'intro_post_id',
            'value' => $product_target,
            'compare' => '=',
        )
    )
);
$loop = new WP_Query($args);
if( $loop->have_posts() ) :
    while( $loop->have_posts() ) : $loop->the_post();
        $product_id = get_the_ID();
    endwhile;
else:
    wp_die("محصول مورد نظر یافت نشد! لطفا با پشتیبانی تماس بگیرید.");
endif;


$stock_status = $product->get_stock_status();
?>


<div id="product-top-header" class="product-top-header">
    <div class="row">        
        <div class="col-md-6 right-col">
            <div class="product-header-thumb">
                <?php the_post_thumbnail('thumbnail'); ?>
            </div>
            <h3 class="product-top-header-name"><?php echo get_the_title( $product_id ); ?></h3>
        </div>
        <div class="col-md-6 left-col">
            <div class="price-and-shop-header">
                <a href="<?php echo get_permalink($product_id); ?>">خرید</a>
                <div class="price-and-shop">
                    <?php if($stock_status != "outofstock") : ?>
                        <p class="price-label">قیمت: 
                        <?php
                        if( $product->is_type( 'simple' ) && $price_html = $product->get_price_html($product_id) ) {
                            echo $price_html;
                        } else {
                            $product->get_price_html();
                        }
                        ?>
                        </p>
                    <?php else: ?>
                        <span class="out-of-stock">ناموجود</span>
                    <?php endif; ?>
                    <p class="chance-label">ببین؛ خرید کن، بهترین باش!</p>
                </div>                
            </div>            
        </div>        
    </div>
</div>

<div id="page_intro" class="main-product">
    <?php if( has_post_thumbnail($current_post_id) ) : ?>
    <div class="intro-cover">
        <?php echo get_the_post_thumbnail($current_post_id); ?>
    </div>
    <?php endif; ?>
    <div class="container-fluid">
        <div class="row">
            <div id="content-wrap" class="col-md-9 content-entry">
                <div class="content-inner">
                    <?php
                        $content_post = get_post($current_post_id);
                        $content = $content_post->post_content;
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
                        echo $content;
                    ?>
                    <div id="product_attributes">
                        <h3 class="title">مشخصات محصول</h3>
                        <?php do_action( 'woocommerce_product_additional_information', $product ); ?>
                    </div>
                </div>
            </div>
            <div id="content-sidebar" class="col-md-3">
                <div class="content-inner">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('side-shop-sidebar') ) : endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>