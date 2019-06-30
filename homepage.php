<?php /* Template Name: HomePage */
get_header();

get_template_part('template-parts/content', 'slider-1');

?>

<?php /*
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
*/ ?>

<section class="products products-carousel special-products">
    <div class="section-heading">
        <h3 class="title">محصولات تخفیف دار ویترین</h3>
        <p class="desc">بهترین کالا، بیشترین تخفیف</p>
    </div>
    <div class="products-list owl-carousel owl-theme">
        <?php
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 15,
            'meta_key' => 'special_product',
            'meta_value' => true
        );
        $loop = new WP_Query($args);
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
            <?php
            $args = array(
                'post_type' => 'homepage_banner',
                'posts_per_page' => -1, 
                'post_status' => 'publish',
                'meta_key'		=> 'banner_position',
                'meta_value'	=> 'right'
            );
            $loop = new WP_Query($args);
            if ( $loop->have_posts() ) :
                while ( $loop->have_posts() ) : $loop->the_post();
                ?>
                <div class="product-presentation">
                    <a href="<?php if($banner_link = get_field('banner_permalink')) echo $banner_link; ?>"><img src="<?php echo get_the_post_thumbnail_url('', 'full'); ?>" title="<?php if($banner_title = get_field('banner_title')) echo $banner_title; ?>" alt="<?php if($banner_alt = get_field('banner_image_alt')) echo $banner_alt; ?>" class="product-presentation-image"></a>
                </div>
                <?php
                endwhile;
            endif; ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 clear-boxing">
        <?php
            $args = array(
                'post_type' => 'homepage_banner',
                'posts_per_page' => -1, 
                'post_status' => 'publish',
                'meta_key'		=> 'banner_position',
                'meta_value'	=> 'left'
            );
            $loop = new WP_Query($args);
            if ( $loop->have_posts() ) :
                while ( $loop->have_posts() ) : $loop->the_post();
                ?>
                <div class="product-presentation">
                    <a href="<?php if($banner_link = get_field('banner_permalink')) echo $banner_link; ?>"><img src="<?php echo get_the_post_thumbnail_url('', 'full'); ?>" title="<?php if($banner_title = get_field('banner_title')) echo $banner_title; ?>" alt="<?php if($banner_alt = get_field('banner_image_alt')) echo $banner_alt; ?>" class="product-presentation-image"></a>
                </div>
                <?php
                endwhile;
            endif; ?>
        </div>
    </div>
</div>


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

<?php get_footer(); ?>