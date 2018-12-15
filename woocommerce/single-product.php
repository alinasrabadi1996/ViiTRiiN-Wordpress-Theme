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

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>


<script>
	jQuery(function () {
		'use strict';
		const $ = window.jQuery;

		const wc_variation_form = $.fn.wc_variation_form;

		if (!wc_variation_form) {
			return;
		}

		const onShowVariation = function (event, variation, purchasable) {
			event.preventDefault();
			const $stockVariation = $('#stock_variation');
			console.log('onShowVariation: %o ', {purchasable});
			if (purchasable) {
				$stockVariation.css({
					display: 'none',
				});
				$('.configure-summary-container .button').removeClass('deactive');
			}
			else {
				$stockVariation.css({
					display: '',
				});
				$('.configure-summary-container .button').addClass('deactive');
			}
		};

		$.fn.wc_variation_form = function () {
			wc_variation_form.apply(this);
			this.on('show_variation', onShowVariation);
			return this;
		};
	});
</script>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
