<?php /* Template Name: HomePage */ ?>
<?php session_start(); ?>
<?php get_header(); ?>

<?php get_template_part('template-parts/content', 'slider-1'); ?>

<section class="products products-carousel">
    <div class="products-list owl-carousel owl-theme">
        <?php
            $meta_query  = WC()->query->get_meta_query();
            $tax_query   = WC()->query->get_tax_query();
            $tax_query[] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );

            $args = array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'posts_per_page'      => 30,
                'orderby'             => $atts['orderby'],
                'order'               => $atts['order'],
                'meta_query'          => $meta_query,
                'tax_query'           => $tax_query,
            );
            $loop = new WP_Query( $args );
            if ( $loop->have_posts() ) {
                while ( $loop->have_posts() ) : $loop->the_post();
                    wc_get_template_part( 'content', 'carousel' );
                endwhile;
            }
            wp_reset_postdata();
        ?>
    </div>
</section>

<div class="products-presentation">
    <div class="row">
        <div class="products-presentation-title">
            <h3>معرفی محصولات</h3>
            <p>ویترین؛ ببین، خرید کن، بهترین باش...</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 clear-boxing">
            <div class="product-presentation">
                <a href="<?php echo site_url(); ?>/introduction/callas-two-way-cack/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-callas-two-way-cake.jpg" class="product-presentation-image"></a>
            </div>            
            <div class="product-presentation">
                <a href="<?php echo site_url(); ?>/introduction/amitice-mineral-foundation/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-amitice-mineral-foundation.jpg" class="product-presentation-image"></a>
            </div>
            <div class="product-presentation">
            <a href="<?php echo site_url(); ?>/introduction/amitice-lipstick-pencil/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-amitice-lipstick-pencil.jpg" class="product-presentation-image"></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 clear-boxing">
            <div class="product-presentation">
                <a href="<?php echo site_url(); ?>/introduction/doucce-punk-mascara/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-doucce-punk-mascara-3.jpg" class="product-presentation-image"></a>
            </div>
            <div class="product-presentation">
                <a href="<?php echo site_url(); ?>/introduction/callas-cheek-blush/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-callas-cheek-blush.jpg" class="product-presentation-image"></a>
            </div>
            <div class="product-presentation">
                <a href="<?php echo site_url(); ?>/introduction/doucce-eyebrow-shadow/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-doucce-eyebrow-shadow.jpg" class="product-presentation-image"></a>
            </div>
        </div>
    </div>
</div>


<?php
/*
<section id="section-chance-key" class="container-fluid">
    <div class="row">
        <div class="col-container">
            <h3 class="col-title">قبل از خرید شانست رو امتحان کن!</h3>
            <ul id="straplines">
                <li class="col-desc">میشه تخفیف ۱۰۰ درصد باشه</li>
                <li class="col-desc">میشه ارسال رایگان باشه</li>
                <li class="col-desc">میشه برنده‌ی ویژه‌ی ویترین تو باشی</li>
            </ul>
            <button class="chance-button" onclick="chance_key()">کلیک کنید</button>
        </div>
    </div>
</section>
*/
?>


<?php get_footer(); ?>