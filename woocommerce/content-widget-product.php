<?php
/**
 * Displayed when no products are found matching the current query
 *
 * @author 		Pazh Design
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>


<div <?php post_class(); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<?php
		wc_get_template( 'framework/content-product/style-2.php' );
	?>
	
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</div>

