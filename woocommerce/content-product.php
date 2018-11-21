<?php
/**
 * Displayed when no products are found matching the current query
 *
 * @author 		Pazh Design
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<div <?php post_class('col-sm-6 col-md-3'); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<?php
		wc_get_template( 'framework/content-product/style-1.php' );
	?>
	
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</div>
