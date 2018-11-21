<?php
/**
 * Loop Add to Cart
 *
 * @author 		Pazh Design
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $post;

if ( $product->is_type( 'variable' ) ) {
	echo '<a class="product-btn button btn-quickview" href="#0" data-prod="' . esc_attr( $post->ID ) . '">افزودن به سبد</a>';
} else {
	echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf( '<a href="%s" data-quantity="%s" class="product-btn %s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( "افزودن به سبد" )
	),
$product, $args );
}


