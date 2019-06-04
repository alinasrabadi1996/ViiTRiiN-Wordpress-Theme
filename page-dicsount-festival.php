<?php /* Template Name: Discount Fistival */ ?>
<?php get_header('shop'); ?>
<section id="content-wrap" class="section page-content section--page">
    <div class="container section-inner">
        <div class="section-heading">
            <h3 class="title"><?php the_title(); ?></h3>
            <p class="desc">بهترین کالا، بیشترین تخفیف</p>
        </div>
        <?php
        do_action( 'woocommerce_before_shop_loop' );
        woocommerce_product_loop_start();
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 24,
            'meta_key' => 'special_product',
            'meta_value' => true
        );
        $loop = new WP_Query($args);
        if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) : $loop->the_post();
                do_action( 'woocommerce_shop_loop' );
                wc_get_template_part( 'content', 'product' );
            endwhile;
        } else {
            do_action( 'woocommerce_no_products_found' );
        }
        woocommerce_product_loop_end();
        do_action( 'woocommerce_after_shop_loop' ); // Pagination
        ?>
    </div>
</section>
<?php get_footer('shop'); ?>