<?php /* Template Name: HomePage */
if( !isset($_SESSION) ) {
    session_start();
}

get_header();

get_template_part('template-parts/content', 'slider-1');

?>

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
                <a href="<?php echo site_url(); ?>/introduction/callas-two-way-cack-1/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-callas-two-way-cake.jpg" class="product-presentation-image"></a>
            </div>
            <div class="product-presentation">
                <a href="<?php echo site_url(); ?>/introduction/amitice-lipstick-pencil-1/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-amitice-lipstick-pencil.jpg" class="product-presentation-image"></a>
            </div>       
            <div class="product-presentation">
                <a href="<?php echo site_url(); ?>/introduction/vitrin-maybelline-mascara/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-maybelline-mascara-volum-express-colossal.jpg" class="product-presentation-image"></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 clear-boxing">
            <div class="product-presentation">
                <a href="<?php echo site_url(); ?>/introduction/doucce-punk-mascara-1/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-doucce-punk-mascara-3.jpg" class="product-presentation-image"></a>
            </div>
            <div class="product-presentation">
                <a href="<?php echo site_url(); ?>/introduction/chapter-body-butter-1/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-chapter-body-butter.jpg" class="product-presentation-image"></a>
            </div>
            <div class="product-presentation">
                <a href="<?php echo site_url(); ?>/introduction/comeon-hand-face-cream-normal-1/"><img src="<?php echo get_template_uri(); ?>/images/misc/vitrin-comeon-hand-face-cream-normal.jpg" class="product-presentation-image"></a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>