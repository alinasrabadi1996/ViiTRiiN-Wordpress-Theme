<?php get_header(); ?>

<script>        
    $(window).on('scroll', function() {    
        var w = window.innerWidth
                || document.documentElement.clientWidth
                || document.body.clientWidth;
        if(w>991){
            if ($(window).scrollTop() > $(".shoping-cart-products").offset().top - 111) {
                $(".factor").addClass("factor-fix");
            }else{
                $(".factor").removeClass("factor-fix");
            }
        }
    });
</script>

<div class="cart-shoping-cart">
    <div class="cart-shoping-cart-boxing">
        <form id="card" method="POST"></form>
        <h3 class="cart-shoping-cart-title">سبد خرید</h3>
        <div class="row">            
            <div class="col-lg-8 col-md-8">

                <!--
                    List Of Product(s) In The Cart
                -->

                <div class="shoping-cart-products">
                    <ul class="shoping-cart-list">
                        <li>
                            <div class="shoping-cart-product-info">
                                <div class="shoping-image-preview">
                                    <img src="<?php echo get_template_uri(); ?>/images/misc/cart/products-presentation-callas-3-4-SSM.png">                                    
                                </div>
                                <p class="shoping-cart-product-name">رژلب جامد کالاس</p>
                            </div>
                            <div class="product-number">
                                <p class="cart-product-cost"><span class="split-number"></span> تومان</p>
                                <input type="text" data-price="10000" class="number-of-product" placeholder="تعداد" form="card">
                                <a href="#" class="remove-from-cart">حذف</a>
                            </div>
                        </li>
                        <li>
                            <div class="shoping-cart-product-info">
                                <div class="shoping-image-preview">
                                    <img src="<?php echo get_template_uri(); ?>/images/misc/cart/products-presentation-callas-3-4-SSM.png">                                    
                                </div>
                                <p class="shoping-cart-product-name">رژلب جامد کالاس</p>
                            </div>
                            <div class="product-number">
                                <p class="cart-product-cost"><span class="split-number"></span> تومان</p>
                                <input type="text" data-price="20000" class="number-of-product" placeholder="تعداد" form="card">
                                <p class="remove-from-cart">حذف</p>
                            </div>
                        </li>
                        <li>
                            <div class="shoping-cart-product-info">
                                <div class="shoping-image-preview">
                                    <img src="<?php echo get_template_uri(); ?>/images/misc/cart/products-presentation-callas-3-4-SSM.png">                                    
                                </div>
                                <p class="shoping-cart-product-name">رژلب جامد کالاس</p>
                            </div>
                            <div class="product-number">
                                <p class="cart-product-cost"><span class="split-number"></span> تومان</p>
                                <input type="text" data-price="10000" class="number-of-product" placeholder="تعداد" form="card">
                                <p class="remove-from-cart">حذف</p>
                            </div>
                        </li>
                        <li>
                            <div class="shoping-cart-product-info">
                                <div class="shoping-image-preview">
                                    <img src="<?php echo get_template_uri(); ?>/images/misc/cart/products-presentation-callas-3-4-SSM.png">                                    
                                </div>
                                <p class="shoping-cart-product-name">رژلب جامد کالاس</p>
                            </div>
                            <div class="product-number">
                                <p class="cart-product-cost"><span class="split-number"></span> تومان</p>
                                <input type="text" data-price="20000" class="number-of-product" placeholder="تعداد" form="card">
                                <p class="remove-from-cart">حذف</p>
                            </div>
                        </li>
                        <li>
                            <div class="shoping-cart-product-info">
                                <div class="shoping-image-preview">
                                    <img src="<?php echo get_template_uri(); ?>/images/misc/cart/products-presentation-callas-3-4-SSM.png">                                    
                                </div>
                                <p class="shoping-cart-product-name">رژلب جامد کالاس</p>
                            </div>
                            <div class="product-number">
                                <p class="cart-product-cost"><span class="split-number"></span> تومان</p>
                                <input type="text" data-price="10000" class="number-of-product" placeholder="تعداد" form="card">
                                <p class="remove-from-cart">حذف</p>
                            </div>
                        </li>
                        <li>
                            <div class="shoping-cart-product-info">
                                <div class="shoping-image-preview">
                                    <img src="<?php echo get_template_uri(); ?>/images/misc/cart/products-presentation-callas-3-4-SSM.png">                                    
                                </div>
                                <p class="shoping-cart-product-name">رژلب جامد کالاس</p>
                            </div>
                            <div class="product-number">
                                <p class="cart-product-cost"><span class="split-number"></span> تومان</p>
                                <input type="text" data-price="20000" class="number-of-product" placeholder="تعداد" form="card">
                                <p class="remove-from-cart">حذف</p>
                            </div>
                        </li>
                        <li>
                            <div class="shoping-cart-product-info">
                                <div class="shoping-image-preview">
                                    <img src="<?php echo get_template_uri(); ?>/images/misc/cart/products-presentation-callas-3-4-SSM.png">                                    
                                </div>
                                <p class="shoping-cart-product-name">رژلب جامد کالاس</p>
                            </div>
                            <div class="product-number">
                                <p class="cart-product-cost"><span class="split-number"></span> تومان</p>
                                <input type="text" data-price="10000" class="number-of-product" placeholder="تعداد" form="card">
                                <p class="remove-from-cart">حذف</p>
                            </div>
                        </li>
                        <li>
                            <div class="shoping-cart-product-info">
                                <div class="shoping-image-preview">
                                    <img src="<?php echo get_template_uri(); ?>/images/misc/cart/products-presentation-callas-3-4-SSM.png">                                    
                                </div>
                                <p class="shoping-cart-product-name">رژلب جامد کالاس</p>
                            </div>
                            <div class="product-number">
                                <p class="cart-product-cost"><span class="split-number"></span> تومان</p>
                                <input type="text" data-price="20000" class="number-of-product" placeholder="تعداد" form="card">
                                <p class="remove-from-cart">حذف</p>
                            </div>
                        </li>
                    </ul>                    
                </div>
            </div>
            <div class="col-lg-4 col-md-4">

                <!--
                    Factor
                -->

                <div class="factor">
                    <div class="total-cost">
                        <p>جمع کل</p>
                        <p class="total-cost-number"><span class="total-price-count"></span> ریال</p>
                    </div>
                    <input type="hidden" class="payment-method-selected">
                    <div class="payment-method">                        
                        <div class="online-pay">
                            <div class="radio-btn" data-payment-method="online">
                                <div class="radio-inside"></div>
                            </div>
                            <p>پرداخت آنلاین</p>                            
                        </div>
                        <div class="online-pay">
                            <div class="radio-btn" data-payment-method="in_person">
                                <div class="radio-inside"></div>
                            </div>
                            <p>پرداخت حضوری در تهران</p>
                        </div>
                    </div>
                    <div class="complete-order">
                        <a href="#">تکمیل خرید</a>
                    </div>
                    <p class="pay-hint">قیمت نهایی در تکمیل خرید محاسبه میگردد</p>
                </div>
            </div>            
        </div>
    <div>
</div>

<?php get_footer(); ?>
