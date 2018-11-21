<?php
global $product, $post;

$intro_url = get_permalink();
if( !empty(get_field('intro_post_id')) ) {
    foreach(get_field('intro_post_id') as $intro){
        $intro_url = get_permalink($intro);
    }
}
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
        <?php wc_get_template( 'loop/price.php' ); ?>
    </div>
</div>
