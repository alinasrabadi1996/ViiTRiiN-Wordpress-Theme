<?php
global $product, $post;

// GET INTRO URL
$intro_url = get_permalink();
if( !empty(get_field('intro_post_id')) ) {
    foreach(get_field('intro_post_id') as $intro){
        $intro_url = get_permalink($intro);
    }
}

// STOCK STATUS
$stock_status = $product->get_stock_status();

?>
<div class="product-inner">
    <div class="product-image">
        <?php
            echo '<a href="' . esc_url( $intro_url ) . '">';
            do_action( 'woocommerce_before_shop_loop_item_title' ) ;
            echo '</a>';
        ?>
    </div>
    <div class="product-title">
        <h3 class="title"><a href="<?php echo $intro_url; ?>" title="<?php echo wp_kses( get_the_title(), '' ); ?>"><?php the_title(); ?></a></h3>
    </div>
    
    <div class="product-price">
        <?php if($stock_status != "outofstock") : ?>
            <?php wc_get_template( 'loop/price.php' ); ?>
        <?php else: ?>
            <?php if( get_field('pause_of_production') == true )  { ?>
                <span class="out-of-stock">توقف تولید</span>
            <?php } else { ?>
                <span class="out-of-stock">ناموجود</span>
            <?php } ?>
        <?php endif; ?>
    </div>
    
    <div class="product-action">
        <?php if($stock_status != "outofstock") : ?>
            <?php woocommerce_template_loop_add_to_cart(); ?>
            <?php if ( $product->is_type( 'variable' ) ) { ?>
                <a class="product-btn button" href="<?php echo $intro_url; ?>">خرید</a>
            <?php } else { ?>
                <a class="product-btn button" href="<?php echo $intro_url; ?>">خرید</a>
            <?php } ?>
        <?php else : ?>
            <?php /*
            <a class="product-btn button stock-notifier" prod-id="<?php echo $post->ID ?>" var-id="0" href="#">به من اطلاع بده</a>
            <a class="product-btn button" href="<?php echo $intro_url; ?>">مشاهده</a>
            */ ?>
            <a class="product-btn button stock-notifier" prod-id="<?php echo $post->ID ?>" var-id="0" href="#">به من اطلاع بده</a>
            <a class="product-btn button" href="<?php echo $intro_url; ?>">مشاهده</a>
        <?php endif; ?>
    </div>
</div>
