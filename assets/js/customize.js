jQuery(document).ready(function() {
    // jQuery(".cart-btn").click(function() {
    //     jQuery("#shopping-cart").toggleClass('active-dropdown');
    // });

    // jQuery("body").click(function(e) {
    //     e.stopPropagation();

    //     if(jQuery(e.target).hasClass("count") || jQuery(e.target).hasClass("navbar-shop-icon") || jQuery(e.target).hasClass("menu-minicart")) {
            
    //     } else {
    //         jQuery("#shopping-cart").removeClass('active-dropdown');
    //     }

    // });

    // setInterval(function(){
    //     ag = jQuery(window).width();
    //     ak = jQuery(window).height();
    //     am = jQuery(".menu-minicart-outer");
    //     ad = am[0].getBoundingClientRect();

    //     var se = jQuery(".menu-minicart").height();

    //     if (ad.bottom > ak) {
    //         var ae = ad.height - (ad.bottom - ak) - 5;
    //         am.css({
    //             overflowY: "scroll",
    //             height: ae
    //         });
    //     }

    //     if(se < ak) {
    //         am.css({
    //             overflowY: "visible",
    //             height: se
    //         })
    //     }
    // }, 500);

    /* NAVBAR COLLAPSE */
    jQuery('#navbar-collapse').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        jQuery('header #navigation').toggleClass('active');
        //jQuery('#overlay').toggleClass('active');
        jQuery(this).toggleClass('collapsed');
    });    

    /* Disable Gallery Href */
    jQuery(".woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image").click(function(e) {
        e.preventDefault();
    });

    /* OWL CAROUSEL */
    var owl = jQuery('.owl-carousel');
    owl.owlCarousel({
        loop: false,
        nav: true,
        navText: ['<i class="icon icon-keyboard_arrow_right"></i>', '<i class="icon icon-keyboard_arrow_left"></i>'],
        margin: 10,
        dots: false,
        rtl: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },            
            960:{
                items:5
            },
            1200:{
                items:7
            }
        }
    });

    /* Collapse Table */
    jQuery("#collapse-table .collapse-md").click(function(e) {
        e.preventDefault();
        var tid = jQuery(this).attr('item-id');
        jQuery(this).toggleClass("collapsed");

        jQuery("#collapse-table .tr-data").each(function() {
            if (jQuery(this).attr('item-id') == tid) {
                jQuery(this).toggleClass("active");
            }
        });    
    });

    /* Chance Key Button */
    jQuery(".member-area .item.chance-key .button").click(function(e) {
        e.preventDefault();
        chance_key();
    });

    /* STRAP LINES */
    function fadeInOut(item) {
        item.fadeIn(1000).delay(2000).fadeOut(1000, function() {
            if (item.next().length)
            {
                fadeInOut(item.next());
            }
            else {
                fadeInOut(item.siblings(':first'));
            }
        });
    }  
    fadeInOut(jQuery('#straplines li:first-child'));   
    
    /* ATTRIBUTE SELECTOR */
    jQuery(window).on('scroll', function() {
        if(window.innerWidth <= 768) {
            jQuery('.attribute-selector').mousewheel(function(e, delta) {
                this.scrollLeft -= (delta * 30);
                e.preventDefault();
            });
        }
    });
    
    /* DISABLE SEARCH SUBMIT */
    jQuery('.dgwt-wcas-search-form').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });
    
    jQuery("#main-header .search .dgwt-wcas-search-submit .icon").click(function(e) {
        e.preventDefault();
    });
});


jQuery(window).on('scroll', function() {
    var ww = jQuery(window).scrollTop()
    if (ww > 61) {
        jQuery(".config-product-header").addClass("config-product-header-fix");
        jQuery(".config-header-product-name").addClass("config-header-product-name-fix");
        jQuery(".customize-product").css("margin-top","80px");
    }else{
        jQuery(".config-product-header").removeClass("config-product-header-fix");
        jQuery(".config-header-product-name").removeClass("config-header-product-name-fix");
        jQuery(".customize-product").css("margin-top","0");
    }
    
});


/* PRODUCT INTRO TOP-HEADER STICKY  */
var MainHeader = jQuery('#main-header').height();
jQuery(window).scroll(function() {
    if(jQuery(window).width() > 768) {
        if( jQuery(this).scrollTop() > MainHeader ) {
            jQuery("#product-top-header").addClass("sticky");
        } else {
            jQuery("#product-top-header").removeClass("sticky");
        }
    }
});

/*
QUICK VIEW
*/
(function(E) {
    E("body").on("click", ".btn-quickview", function(ab) {
        ab.preventDefault();
        ab.stopPropagation();
        var ad = E(this);
        E(this).addClass("loading");
        var product_id = ad.attr("data-prod");
        var data = {
            action: "wr_quickview",
            product: product_id
        };
        E.post(WRAjaxURL, data, function(res) {
            E.magnificPopup.open({
                items: {
                    src: E(res)
                },
                mainClass: "mfp-fade mfp-quickview",
                removalDelay: 300,
                callbacks: {
                    open: function() {
                        var form = ".variations_form";
                        var calculator = new variation_calculator(jQuery(form).data('product_attributes'), jQuery(form).data('product_variations'), jQuery(form).data('product_variations_flat'), my_all_set_callback, my_not_all_set_callback, jQuery(form).data('variations_map'));
                        jQuery(form).find('.variations select').unbind();
                        jQuery(form).find('div.select, select').unbind();
                        jQuery(form).data('calculator', calculator);
                        variation_inits();


                        init_swatches(form);

                        calculator.reset_selected();
                        calculator.reset_current();
            
                        jQuery('select', form).trigger('change', []);
                        
                        jQuery(form).find('div.select-option[data-default=true]').find('a').each(function(index, element) {
                            jQuery(element).click();
                        });
                                    
                        jQuery(form).data('bound', 1);

                        function my_not_all_set_callback() {

                            // Reset image
                            var img = jQuery('div.images img:eq(0)');
                            var link = jQuery('div.images a.zoom:eq(0)');
                            var o_src = jQuery(img).attr('data-o_src');
                            var o_href = jQuery(link).attr('data-o_href');
                    
                            if (o_src && o_href) {
                                jQuery(img).attr('src', o_src);
                                jQuery(link).attr('href', o_href);
                            }
                    
                            jQuery('form input[name=variation_id]').val('').change();
                            jQuery('.single_variation_wrap').hide();
                            jQuery('.single_variation').text('');
                            jQuery('#variations_clear').hide();
                    
                            if (jQuery().uniform && jQuery.isFunction(jQuery.uniform.update)) {
                                jQuery.uniform.update();
                            }
                    
                        }
                    
                        function my_all_set_callback(selected, product_variations, variations_map) {
                            var found = null;
                            var value = '';
                            
                            for (sa in selected) {
                                if (sa.indexOf('attribute') > -1) {		
                                    
                                    value = variations_map[sa][selected[sa]];
                                    jQuery('#' + wc_escapeStr(sa) ).val( value );
                    
                                }
                            }
                    
                            for (var p = 0; p < product_variations.length; p++) {
                                var result = true;
                                for (attribute in product_variations[p].attributes) {
                                    for (selected_attribute in selected) {
                                        if (selected_attribute == attribute) {
                                            var v = product_variations[p].attributes[attribute];
                                            if (v != selected[ value ]) {
                                                result = false;
                                            }
                                        }
                                    }
                                }
                    
                                if (result) {
                                    found = product_variations[p];
                                }
                    
                            }
                    
                            if (!found) {
                                for (var p = 0; p < product_variations.length; p++) {
                                    var result = true;
                                    for (attribute in product_variations[p].attributes) {
                                        for (selected_attribute in selected) {
                                            if (selected_attribute == attribute) {
                                                var value = variations_map[ selected_attribute ][ selected[ selected_attribute ] ];
                                                var v = product_variations[p].attributes[attribute];
                                                var vs = selected[selected_attribute];
                                                if (v != '' && v != value) {
                                                    result = false;
                                                }
                                            }
                                        }
                                    }
                    
                                    if (result) {
                                        found = product_variations[p];
                                    }
                                }
                            }
                    
                            if (found) {
                                jQuery('#variations_clear').show();
                                show_variation(found);
                            } else {
                                jQuery('#variations_clear').hide();
                            }
                        }
                    
                        function show_variation(variation) {
                            swap_image(variation);
                    
                            jQuery('.variations_button').show();
                            jQuery('.single_variation').html(variation.price_html + variation.availability_html);
                    
                            if (variation.sku) {
                                jQuery('.product_meta').find('.sku').text(variation.sku);
                            } else {
                                jQuery('.product_meta').find('.sku').text('');
                            }
                    
                            jQuery('.single_variation_wrap').find('.quantity').show();
                    
                            if (variation.min_qty) {
                                jQuery('.single_variation_wrap').find('input[name=quantity]').attr('data-min', variation.min_qty).val(variation.min_qty);
                            } else {
                                jQuery('.single_variation_wrap').find('input[name=quantity]').removeAttr('data-min');
                            }
                    
                            if (variation.max_qty) {
                                jQuery('.single_variation_wrap').find('input[name=quantity]').attr('data-max', variation.max_qty);
                            } else {
                                jQuery('.single_variation_wrap').find('input[name=quantity]').removeAttr('data-max');
                            }
                    
                            if (variation.is_sold_individually == 'yes') {
                                jQuery('.single_variation_wrap').find('input[name=quantity]').val('1');
                                jQuery('.single_variation_wrap').find('.quantity').hide();
                            }
                    
                            jQuery('form input[name=variation_id]').val(variation.variation_id).change();
                            
                            jQuery('.single_variation_wrap').slideDown('200').trigger('show_variation', [variation]);
                            jQuery('form.cart').trigger('found_variation', [variation]);
                    
                        }
                    
                        function swap_image(variation) {
                            
                            var img = jQuery('div.images img:eq(0)');
                            var link = jQuery('div.images a.zoom:eq(0)');
                            var o_src = jQuery(img).attr('data-o_src');
                            var o_title = jQuery(img).attr('data-o_title');
                    
                            var o_href = jQuery(link).attr('data-o_href');
                    
                    
                            var variation_image = variation.image_src;
                            var variation_link = variation.image_link;
                            var variation_title = variation.image_title;
                    
                    
                            if (!o_src) {
                                jQuery(img).attr('data-o_src', jQuery(img).attr('src'));
                            }
                    
                            if (!o_title) {
                                jQuery(img).attr('data-o_title', jQuery(img).attr('title'));
                            }
                    
                            if (!o_href) {
                                jQuery(link).attr('data-o_href', jQuery(link).attr('href'));
                            }
                    
                    
                            if (variation_image && variation_image.length > 1) {
                                jQuery(img).attr('src', variation_image);
                                jQuery(img).attr('title', variation_title);
                                jQuery(img).attr('alt', variation_title);
                                jQuery(link).attr('href', variation_link);
                                jQuery(link).attr('title', variation_title);
                            } else {
                                jQuery(img).attr('src', o_src);
                                jQuery(img).attr('title', o_title);
                                jQuery(img).attr('alt', o_title);
                                jQuery(link).attr('href', o_href);
                                jQuery(link).attr('title', o_title);
                            }
                        }
                    

            
                        function init_swatches(form) {
                            jQuery(form).on('click', 'div.select-option', function(event) {
                                event.preventDefault();

                    
                                var jQuerythe_option = jQuery(this);
                                if (jQuerythe_option.hasClass('disabled')) {
                                    return false;
                                }
                                /*
                                else if (jQuerythe_option.hasClass('selected')) {
                                    jQuerythe_option.removeClass('selected');
                    
                                    var select = jQuerythe_option.closest('div.select');
                                    select.data('value', '');
                    
                                    var label_id = '#' + jQuery(select).attr('id') + '_label';
                                    var jQuerylabel = jQuery(wc_escapeStr( label_id ));
                                    if (jQuerylabel) {
                                        jQuerylabel.html("&nbsp;");
                                    }
                                    jQuery(this).parents('div.select').trigger('change', []);
                                }
                                */
                                else {
                                    var select = jQuery(this).closest('div.select');
                                    jQuery(select).find('div.select-option').removeClass('selected');
                                    jQuerythe_option.addClass('selected');
                                    
                                    var val = jQuerythe_option.data('value');
                                    select.data('value', val );
                                    
                                    var label_id = '#' + jQuery(select).attr('id') + '_label';
                                    var jQuerylabel = jQuery(wc_escapeStr( label_id ) );
                                    if (jQuerylabel) {
                                        jQuerylabel.text(jQuerythe_option.data('name'));
                                    }
                    
                                    jQuery(this).parents('div.select').trigger('change', []);
                                }
                    
                    
                    
                                return false;
                            });
                    
                            jQuery(form).on('change', 'div.select', function() {			
                                jQueryvariation_form = jQuery(this).closest('form.cart');
                                calculator = jQueryvariation_form.data('calculator');
                    
                                jQueryvariation_form.trigger('woocommerce_variation_select_change');
                    
                                var jQueryparent = jQuery(this).closest('.variation_form_section');
                                jQuery('select', jQueryparent).each(function(index, element) {
                                    var optval = jQuery(element).val();
                    
                                    optval = optval.replace("'", "&#039;");
                                    optval = optval.replace('"', "&quot;");
                    
                                    calculator.set_selected(jQuery(element).data('attribute-name'), optval);
                                });
                    
                                jQuery('div.select', jQueryparent).each(function(index, element) {
                                    var optval = jQuery(element).data('value');
                                    calculator.set_selected( jQuery(element).data('attribute-name'), optval);
                                });
                    
                                var current_options = calculator.get_current();
                                jQuery('select', jQueryparent).each(function(index, element) {
                                    var attribute_name = jQuery(element).data('attribute-name');
                                    var avaiable_options = current_options[attribute_name];
                    
                                    jQuery(element).find('option:gt(0)').each(function(index, option) {
                                        var optval = jQuery(option).val();
                    
                                        optval = optval.replace("'", "&#039;");
                                        optval = optval.replace('"', "&quot;");
                    
                                        if (!avaiable_options[ optval ]) {
                                            jQuery(option).attr('disabled', 'disabled');
                                        } else {
                                            jQuery(option).removeAttr('disabled');
                                        }
                                    });
                                });
                    
                                jQuery('div.select', jQueryparent).each(function(index, element) {
                                    var attribute_name = jQuery(element).data('attribute-name');
                                    var avaiable_options = current_options[attribute_name];
                    
                                    jQuery(element).find('div.select-option').each(function(index, option) {
                                        if (!avaiable_options[ jQuery(option).data('value') ]) {
                                            jQuery(option).addClass('disabled', 'disabled');
                                        } else {
                                            jQuery(option).removeClass('disabled');
                                        }
                                    });
                                });
                    
                                calculator.trigger_callbacks();
                    
                            });
                    
                            jQuery(form).on('change', 'select', function() {
                    
                                jQueryvariation_form = jQuery(this).closest('form.cart');
                                calculator = jQueryvariation_form.data('calculator');
                    
                                var jQueryparent = jQuery(this).closest('.variation_form_section');
                    
                                jQuery('select', jQueryparent).each(function(index, element) {
                                    var optval = jQuery(element).val();
                    
                                    optval = optval.replace("'", "&#039;");
                                    optval = optval.replace('"', "&quot;");
                                    calculator.set_selected(jQuery(element).data('attribute-name'), optval);
                                });
                    
                                var current_options = calculator.get_current();
                                jQuery('select', jQueryparent).each(function(index, element) {
                                    var attribute_name = jQuery(element).data('attribute-name');
                                    var avaiable_options = current_options[attribute_name];
                    
                                    jQuery(element).find('option:gt(0)').each(function(index, option) {
                                        var optval = jQuery(option).val();
                    
                                        optval = optval.replace("'", "&#039;");
                                        optval = optval.replace('"', "&quot;");
                    
                                        if (!avaiable_options[ optval ]) {
                                            //jQuery(option).attr('disabled', 'disabled');
                                        } else {
                                            jQuery(option).removeAttr('disabled');
                                        }
                                    });
                    
                                });
                    
                                jQuery('div.select', jQueryparent).each(function(index, element) {
                                    var attribute_name = jQuery(element).data('attribute-name');
                                    var avaiable_options = current_options[attribute_name];
                    
                                    jQuery(element).find('div.select-option').each(function(index, option) {
                                        if (!avaiable_options[ jQuery(option).data('value') ]) {
                                            jQuery(option).addClass('disabled', 'disabled');
                                        } else {
                                            jQuery(option).removeClass('disabled');
                                        }
                                    });
                                });
                    
                                calculator.trigger_callbacks();
                    
                            });
                        }

                        function variation_manager(variations) {
                            this.variations = variations;
                            this.find_matching_variation = function(selected) {
                        
                                for (var v = 0; v < this.variations.length; v++) {
                                    var variation = this.variations[v];
                                    var matched = true;
                        
                                    //Find any with an exact match.
                                    for (var attribute in variation.attributes) {
                                        matched = matched & selected[attribute] != undefined && selected[attribute] == variation.attributes[attribute];
                                    }
                        
                                    if (matched) {
                                        return variation;
                                    }
                                }
                        
                                //An exact match was not found.   Find any with a wildcard match
                                for (var v = 0; v < this.variations.length; v++) {
                                    var variation = this.variations[v];
                                    var matched = true;
                        
                                    //Find any with an exact match.
                                    for (var attribute in variation.attributes) {
                                        matched = matched & selected[attribute] != undefined && (selected[attribute] == variation.attributes[attribute] || variation.attributes[attribute] == '');
                                    }
                        
                                    if (matched) {
                                        return variation;
                                    }
                                }
                        
                                return false;
                            }
                        }

                        function variation_calculator(keys, possibile, possibile_flat, all_set_callback, not_all_set_callback, variations_map) {
                            this.recalc_needed = true;
                        
                            this.all_set_callback = all_set_callback;
                            this.not_all_set_callback = not_all_set_callback;
                        
                            //The varioius variation key values available as configured in woocommerce.
                            this.variation_keys = keys;
                            
                            this.variations_map = variations_map;
                            
                            //The actual variations that are configured in woocommerce.
                            this.variations_available = possibile_flat;
                        
                            //Stores the attribute + values that are currently available
                            this.variations_current = {};
                        
                            //Stores the selected attributes + values
                            this.variations_selected = {};
                        
                            this.reset_current = function( ) {
                                for (var key in this.variation_keys) {
                                    this.variations_current[ key ] = {};
                                    for (var av = 0; av < this.variation_keys[key].length; av++) {
                                        this.variations_current[ key ][ this.variation_keys[key][av] ] = 0;
                                    }
                                }
                            };
                        
                            this.update_current = function( ) {
                                this.reset_current();
                                for (var i = 0; i < this.variations_available.length; i++) {
                                    for (var attribute in this.variations_available[ i ]) {
                        
                                        var available_value = this.variations_available[ i ][attribute];
                                        var selected_value = this.variations_selected[attribute];
                                        
                                        if (selected_value && selected_value == available_value) {
                                            this.variations_current[ attribute ][ available_value ] = 1;//this is a currently selected attribute value
                                        } else {
                        
                                            var result = true;
                        
                                            //Loop though any other item that is selected, checking to see if any do not match.
                                            for (var other_selected_attribute in this.variations_selected) {
                        
                                                if (other_selected_attribute == attribute) {
                                                    //We are looking to see if any attribute that is selected will cause this to fail.
                                                    continue;
                                                }
                        
                                                var other_selected_attribute_value = this.variations_selected[other_selected_attribute];
                                                var other_available_attribute_value = this.variations_available[i][other_selected_attribute];
                                                if (other_selected_attribute_value) {
                                                    if (other_available_attribute_value) {
                                                        if (other_selected_attribute_value != other_available_attribute_value) {
                                                            result = false;
                                                        }
                                                    }
                                                }
                                            }
                                            
                                            if (result) {
                                                if (available_value) {
                                                    this.variations_current[ attribute ][ available_value ] = 1;
                                                } else {
                                                    for (var av in this.variations_current[ attribute ]) {
                                                        this.variations_current[ attribute ][ av ] = 1;
                                                    }
                                                }
                                            }
                        
                                        }
                                    }
                                }
                        
                                this.recalc_needed = false;
                            };
                        
                            this.get_current = function() {
                                if (this.recalc_needed) {
                                    this.update_current();
                                }
                        
                                return this.variations_current;
                            };
                        
                            this.get_value_is_current = function(key, value) {
                                if (this.recalc_needed) {
                                    this.update_current();
                                }
                        
                                return this.variations_current[ key ][ value ] === true;
                            };
                        
                            this.reset_selected = function() {
                                this.recalc_needed = true;
                                this.variations_selected = {};
                            }
                        
                            this.set_selected = function(key, value) {
                                this.recalc_needed = true;
                                this.variations_selected[ key ] = value;
                            };
                        
                            this.get_selected = function() {
                                return this.variations_selected;
                            }
                        
                            this.trigger_callbacks = function() {
                                var all_set = true;
                        
                                for (var key in this.variation_keys) {
                                    all_set = all_set & this.variations_selected[key] != undefined && this.variations_selected[key] != '';
                                }
                        
                                if (all_set) {
                                    this.all_set_callback(this.variations_selected, possibile, this.variations_map );
                                } else {
                                    this.not_all_set_callback();
                                }
                            }
                        };
    
                        function variation_inits() {
                            if ( typeof wc_add_to_cart_variation_params !== 'undefined' ) {
                                E( '.variations_form' ).each( function() {
                                    E( this ).wc_variation_form().find(".variations select:eq(0)").change()
                                });
                            }
                        }
                    }
                }
            });
            ad.removeClass("loading");
            setTimeout(function() {
                var af = E(".woocommerce-product-gallery").outerHeight();
                E(".quickview-modal .col-content").css({
                    height: af,
                    overflow: "auto"
                })
            }, 500)
        }); // END MAGNIFIC
    }); // End Click EVENT
})(jQuery);


/* MATERIAL KIT Minimal Javascript (for Edge, IE and select box) */
document.addEventListener("change", function(event) {
    let element = event.target;
    if (element && element.matches(".form-element-field")) {
        element.classList[element.value ? "add" : "remove"]("-hasvalue");
    }
});


/*
STOCK NOTIFIER 
*/
var prod_id = 0;
//var var_id = 0;
jQuery(".stock-notifier").click(function(e) {
    e.preventDefault();
    prod_id = jQuery(this).attr('prod-id');
    //var_id = jQuery(this).attr('var-id');
    jQuery('.md-modal').addClass('is-visible');
});


jQuery("#notifire-form").validate({
    rules: {
        notifier_phone: {
            required: true,
            minlength: 11,
            maxlength: 11
        },
        notifier_name: {
            required: true
        }
    },
    messages: {
        notifier_phone: {
            required: "شماره همراه خود را وارد نمائید.",
            minlength: "شماره همراه معتبر نیست.",
            maxlength: "شماره همراه معتبر نیست."
        },
        notifier_name: {
            required: "نام و نام خانوادگی خود را وارد نمائید."
        }
    },
    errorPlacement: function(error, element) {
        error.appendTo(element.parent());
    },
    success: function(label,element) {
        label.parent().removeClass('field-error');
    },
    highlight: function(element) {
        jQuery(element).parent().addClass("field-error");
    },
    unhighlight: function(element) {
        jQuery(element).parent().removeClass("field-error");
    },
    submitHandler: function (form) {
        var notifier_phone = jQuery("#notifier_phone").val();
        var notifier_name = jQuery("#notifier_name").val();
        var var_id = jQuery("#notifier_var_id").val();
        var request;
        if (request) {
            request.abort(); 
        }

        request = jQuery.ajax({
            url: '/store/wp-content/themes/main/includes/stock-notifier.php',
            type: 'POST',
            data: {"notifier_phone": notifier_phone, "notifier_name": notifier_name, "prod_id": prod_id, "var_id": var_id},
            cache: false,
            //dataType: 'JSON',
            beforeSend: function() {
                jQuery('#md-modal-loading').show();
            }
        });

        request.done(function (response, textStatus, jqXHR){
            jQuery('#md-modal-loading').hide();
            jQuery('#md-modal-response').html(response);
            if(response == 1) {
                jQuery('#md-modal-response').html('<span class="success">درخواست اطلاع رسانی ثبت گردید.</span>');
            } else {
                jQuery('#md-modal-response').html('<span class="fail">سیستم با خطا مواجه شد!</span>');
            }
        });

        request.fail(function (jqXHR, textStatus, errorThrown){
            jQuery('#md-modal-response').html('<span class="fail">سیستم با خطا مواجه شد!</span>');
        });

        request.always(function () {
            jQuery('#phone').prop("disabled", false);
        });
    }
});

/*
NOTIFIER MODAL
*/
jQuery(".md-modal .md-modal-close").click(function() {
    jQuery('.md-modal').removeClass('is-visible');
    jQuery('#md-modal-response').html("");
    jQuery("#notifier_phone").val("");
    jQuery("#notifier_name").val("");
});


/*
SEARCH
*/
var search_input = false;
jQuery(".navbar-search-icon").click(function(e) {
    if(!search_input){        
        jQuery(".search").toggleClass("translate-off");
        jQuery(".menu").toggleClass("hide-element");
        jQuery(".navbar-search-icon").toggleClass("hide-element");
        setTimeout(function(){
            jQuery(".search-products-suggest").toggleClass("hide-element translate-off");
        }, 50);
        search_input = true;
    }else{        
        setTimeout(function(){
            jQuery(".search").toggleClass("translate-off");
            jQuery(".menu").toggleClass("hide-element");
        }, 50);
        jQuery(".search-products-suggest").toggleClass("hide-element translate-off");
        jQuery(".navbar-search-icon").toggleClass("hide-element");
        search_input = false;
    }    
});

jQuery(".search-close-icon").click(function() {
    jQuery(".search-products-suggest").addClass("hide-element");
    jQuery(".search-products-suggest").removeClass("translate-off");
    jQuery(".navbar-search-icon").removeClass("hide-element");
    setTimeout(function(){
        jQuery(".search").removeClass("translate-off");
        jQuery(".menu").removeClass("hide-element");
    }, 50);
    search_input = false;
});


/*
CHANCE KEY
*/
function chance_key(){
    jQuery("#popup-chance-key").toggleClass("hide-element");
    jQuery(".chance-key-form").toggleClass("hide-element scale-off");
}

jQuery('#popup-chance-key').click(function(e) {
    if(!jQuery(e.target).hasClass('.chance-key-form'))
    {
        chance_key();
    }
});

jQuery('.chance-key-form').click(function(event){
     event.stopPropagation();
});

/*
STOCK NOTIFIER 

var prod_id = 0;
//var var_id = 0;
jQuery(".stock-notifier").click(function(e) {
    e.preventDefault();
    prod_id = jQuery(this).attr('prod-id');
    //var_id = jQuery(this).attr('var-id');
    jQuery('.md-modal').addClass('is-visible');
});
*/

/* SUBSCRIBE FORM */
jQuery("#subscribe-form").validate({
    rules: {
        subs_input: {
            required: true
        }
    },
    messages: {
        subs_input: {
            required: "جهت عضویت ایمیل یا شماره همراه خود را وارد نمایید."
        }
    },
    errorPlacement: function(error, element) {
        error.appendTo(element.parent());
    },
    success: function(label,element) {
        label.parent().removeClass('field-error');
    },
    highlight: function(element) {
        jQuery(element).parent().addClass("field-error");
    },
    unhighlight: function(element) {
        jQuery(element).parent().removeClass("field-error");
    }
});
