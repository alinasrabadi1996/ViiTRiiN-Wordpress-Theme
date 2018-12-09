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

	get_header( 'shop' );

	/**
	 * Hook: woocommerce_before_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 * @hooked WC_Structured_Data::generate_website_data() - 30
	 */
	

	/* GET PRODUCTS CATEGORIES */
	$parent = get_queried_object()->term_id;
	$taxonomy_name = 'product_cat';
	$term_children = get_term_children( $parent, $taxonomy_name );
	/*
	$categories = get_terms(array(
		'taxonomy' => 'product_cat',
		'hide_empty' => false	
	));
	*/
	?>

	<div class="categories-menu <?php if($term_children) { echo "has-fixbar"; } ?>">
		<ul class="categories-menu-list">
			<img src="<?php echo get_template_uri(); ?>/images/branding/logo.png" class="second-navbar-logo hide-element">        
			<?php foreach($term_children as $child) :
				$cat = get_term_by( 'id', $child, $taxonomy_name );
				$thumb_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				if(empty($thumb_id) || $thumb_id == 0) :
				//$thumb_id = 165; // Default Thumb
				?>
				<li>
					<img src="<?php echo wp_get_attachment_url( $thumb_id ); ?>" />
					<a href="<?php echo get_term_link($cat); ?>"><?php echo $cat->name; ?></a>
				</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>    
	</div>

	<?php
		$term = get_queried_object();
		$intro_image = get_field('intro_image', $term);

		echo '<div style="display: none">'.$intro_image.'</div>'; 

		if(is_array($intro_image) && in_array('url', $intro_image) && !empty($intro_image['url']) ) {
			$image = $intro_image['url'];
		}
		else {
			$image = site_url()."/wp-content/uploads/2018/03/categories-header.jpg";
		}
	?>
	<div style="background-image: url(<?php echo $image; ?>)" class="categories-header-slider <?php if($term_children) { echo "has-fixbar"; } ?>">
		<!--
		<div class="move-to-content-arrow" onclick="goto_products('.categories-products-section',58)">
			<span class="slider-move-to-title">محصولات</span>
			<i class="icon-keyboard_arrow_down"></i>
		</div>
		-->
	</div>

	<?php

	do_action( 'woocommerce_before_main_content' );

	?>

	<header class="woocommerce-products-header">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>
	</header>
	<?php

	if ( have_posts() ) {

		/**
		 * Hook: woocommerce_before_shop_loop.
		 *
		 * @hooked wc_print_notices - 10
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );

		?>
		<div class="row">
			<?php if ( ! is_product() && ! wp_is_mobile() ) : ?>
				<div id="shop-sidebar" class="col-md-2">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('side-shop-sidebar') ) : endif; ?>
				</div>
			<?php endif; ?>
			<div class="col-md-10">
			<?php
			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();
			do_action( 'woocommerce_after_shop_loop' ); // Pagination
			?>
			</div>
		</div> 
		<?php

		/**
		 * Hook: woocommerce_after_shop_loop.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
	} else {
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );
	}

	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('side-product-category') ) : endif;

	/**
	 * Hook: woocommerce_after_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );

	/**
	 * Hook: woocommerce_sidebar.
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	do_action( 'woocommerce_sidebar' );

?>
<script>
	jQuery(window).on('scroll', function() {
		var w = window.innerWidth
				|| document.documentElement.clientWidth
				|| document.body.clientWidth;
		if(w>=768){
			jQuery("#main-header").css({"position":"relative"});
			if (jQuery(window).scrollTop() > 60) {
				jQuery("#main-header").addClass("header-sticky");
				jQuery(".categories-menu").addClass("categories-menu-fix");
				jQuery(".second-navbar-logo").addClass("scale-off");
				jQuery(".second-navbar-logo").removeClass("hide-element");
				jQuery(".categories-menu-list").addClass("categories-menu-list-margin");
				jQuery(".second-navbar-categories-icons").addClass("translate-off");
			}else{
				jQuery("#main-header").removeClass("header-sticky");
				jQuery(".search").css("background","#FAFAFA");
				jQuery(".categories-menu").removeClass("categories-menu-fix");
				jQuery(".second-navbar-logo").removeClass("scale-off");
				jQuery(".second-navbar-logo").addClass("hide-element");
				jQuery(".categories-menu-list").removeClass("categories-menu-list-margin");
				jQuery(".second-navbar-categories-icons").removeClass("translate-off");
			}
		}else{
			jQuery("#main-header").css("position", "fixed");
			jQuery(".categories-header-slider").removeClass("has-fixbar");
		}
	});
</script>

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
			// console.log('wc_variation_form: %o', this.$form)
			this.on('show_variation', onShowVariation);
			return this;
		};
	});

</script>

<?php
	
	get_footer( 'shop' );

