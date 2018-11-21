<?php
/**
 * Loop Price
 *
 * @author 		Pazh Design
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $product;
?>


<?php
if ($product->is_type( 'simple' )) { ?>
	<span class="price"><?php echo wc_price($product->get_regular_price()); ?></span>
<?php } elseif($product->product_type=='variable') {
	$available_variations = $product->get_available_variations();
	$count = count($available_variations) - 1;
	$variation_id = $available_variations[$count]['variation_id'];
	$variable_product1 = new WC_Product_Variation( $variation_id );
	$regular_price = $variable_product1->regular_price;
	?>
	<span class="price"><?php echo wc_price($regular_price); ?></span>
<?php } ?>