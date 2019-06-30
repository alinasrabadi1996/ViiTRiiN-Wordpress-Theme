<?php /* Template Name: Discount Fistival */ ?>
<?php get_header('shop'); ?>
<section id="content-wrap" class="section page-content section--page">
    <div class="container section-inner">
        <div class="section-heading">
            <h3 class="title"><?php the_title(); ?></h3>
            <p class="desc">بهترین کالا، بیشترین تخفیف</p>
        </div>
        <?php
        do_action( 'woocommerce_before_shop_loop' );
        woocommerce_product_loop_start();
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 24,
            'meta_key' => 'special_product',
            'meta_value' => true
        );
        $loop = new WP_Query($args);
        if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) : $loop->the_post();
                do_action( 'woocommerce_shop_loop' );
                wc_get_template_part( 'content', 'product' );
            endwhile;
        } else {
            do_action( 'woocommerce_no_products_found' );
        }
        woocommerce_product_loop_end();
        do_action( 'woocommerce_after_shop_loop' ); // Pagination
        ?>
    </div>
</section>


<script>
	jQuery(function () {
		'use strict';

		const $ = window.jQuery;
  
		const wc_variation_form = $.fn.wc_variation_form;

		if (!wc_variation_form) {
			console.log('wc_variation_form not found!')
			return;
		}

		const onShowVariation = function (event, variation, purchasable) {
			event.preventDefault();
			const $stockVariation = $('#stock_variation');
			// console.log('onShowVariation: %o ', {purchasable});
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
			// console.log('wc_variation_form: %o', this.$form)
			this.on('show_variation', onShowVariation);
			return this;
		};
	});
</script>
<?php get_footer('shop'); ?>