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

	if($term_children) :
	?>

	<div class="categories-menu">
		<ul class="categories-menu-list">
			<img src="<?php echo get_template_uri(); ?>/images/branding/logo.png" class="second-navbar-logo hide-element">        
			<?php foreach($term_children as $child) :
			$cat = get_term_by( 'id', $child, $taxonomy_name );
			$thumb_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
			if(empty($thumb_id) || $thumb_id == 0)
			$thumb_id = 165; // Default Thumb
			?>
				<li>
					<img src="<?php echo wp_get_attachment_url( $thumb_id ); ?>" />
					<a href="<?php echo get_term_link($cat); ?>"><?php echo $cat->name; ?></a>
				</li>
			<?php endforeach; ?>
		</ul>    
	</div>
	<?php endif; ?>

	<?php
		$term = get_queried_object();
		$image = site_url()."/wp-content/uploads/2018/03/categories-header.jpg";
		if( get_field('intro_image', $term) && !empty(get_field('intro_image', $term)) )
			$image = get_field('intro_image', $term)['url'];
	?>
	<div style="background-image: url(<?php echo $image; ?>)" class="categories-header-slider">
		
		<div class="move-to-content-arrow" onclick="goto_products('.categories-products-section',58)">
			<span class="slider-move-to-title">محصولات</span>
			<i class="icon-keyboard_arrow_down"></i>
		</div>
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
	<script type="text/javascript">
		jQuery(window).on('scroll', function() {
			var w = window.innerWidth
					|| document.documentElement.clientWidth
					|| document.body.clientWidth;
			if(w>=768){
				jQuery("#main-header").css({"box-shadow":"none","position":"relative"});
				if (jQuery(window).scrollTop() > 60) {
					jQuery("#main-header").addClass("sticky");
					jQuery(".categories-menu").addClass("categories-menu-fix");
					jQuery(".second-navbar-logo").addClass("scale-off");
					jQuery(".second-navbar-logo").removeClass("hide-element");
					jQuery(".categories-menu-list").addClass("categories-menu-list-margin");
					jQuery(".second-navbar-categories-icons").addClass("translate-off");
				}else{
					jQuery("#main-header").removeClass("sticky");
					jQuery(".search").css("background","#FAFAFA");
					jQuery(".categories-menu").removeClass("categories-menu-fix");
					jQuery(".second-navbar-logo").removeClass("scale-off");
					jQuery(".second-navbar-logo").addClass("hide-element");
					jQuery(".categories-menu-list").removeClass("categories-menu-list-margin");
					jQuery(".second-navbar-categories-icons").removeClass("translate-off");
				}
			}else{
				jQuery("#main-header").css({"box-shadow":"box-shadow: 0 5px 3px -3px rgba(0,0,0,0.1)","position":"fixed"});
			}
		});
	</script>
	<?php

	get_footer( 'shop' );
