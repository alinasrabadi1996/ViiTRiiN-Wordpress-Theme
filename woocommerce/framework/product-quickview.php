<?php
/**
 * The template for displaying content of quick view product
 *
 */

global $post, $woocommerce, $product;

// Catalog mode
// Show price

// Icon Set

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="quickview-modal">
	<div <?php post_class(); ?>> 
		<div class="row quickview-modal-inner">
			<?php
				if ( $product->is_on_sale() ) {
					wc_get_template( 'loop/sale-flash.php' );
				}
				wc_get_template( 'single-product/product-image.php' );
			?>
			<div class="col-md-6 col-content">
				<h1 itemprop="name" class="product_title entry-title mgb10"><a href="<?php esc_url( the_permalink() ); ?>" title="<?php esc_attr( the_title() ); ?>"><?php the_title(); ?></a></h1>
				<div class="quickview-button">
					<?php woocommerce_template_single_add_to_cart(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_quickview_modal' ); ?>
