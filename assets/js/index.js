

// ---------- Navbar Search


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


// ---------- Move To Products


function goto_products(selector, offset){
    jQuery('html, body').animate({
        scrollTop: jQuery(selector).offset().top - offset
    }, 1000);
}


// ---------- Move To Begin/End Of Produts
// Left - Right


function animation_products(input){
    jQuery(".product-preview:eq("+input+")").addClass("products-animation");    
}

jQuery( document ).ready(function() {
    var item_counter = 0;
    setInterval(
        function(){
            animation_products(item_counter);
            item_counter++;
        }
    , 300 );
    if(jQuery('.products-preview-list').scrollLeft() >= -70 ){
        jQuery(".right").addClass("hide-element");
    }else{
        jQuery(".right").removeClass("hide-element");        
    }
});

/*
jQuery(".left").click(function(){    
    var leftPos = jQuery('.products-preview-list').scrollLeft();
    var targetPos = jQuery(".products-preview-list").get(0).scrollWidth;    
    jQuery(".products-preview-list").animate({scrollLeft: -targetPos }, 1000);
});

jQuery(".right").click(function(){      
    var leftPos = jQuery('.products-preview-list').scrollLeft();
    jQuery(".products-preview-list").animate({scrollLeft: 0}, 800);  
});

jQuery(".products-preview-list").scroll(function(){    
    var scroll = jQuery('.products-preview-list');    
    if(scroll.scrollLeft() >= -70 ){        
        jQuery(".right").addClass("hide-element");
    }else if(scroll.scrollLeft() <= -1200){
        alert("l");
        jQuery(".left").addClass("hide-element");
    }else if(scroll.scrollLeft() < -70 &&
              scroll.scrollLeft() > -1000){
        jQuery(".right").removeClass("hide-element");
        jQuery(".left").removeClass("hide-element");
    }
});
*/


// ---------- Chance Key PopUp


var chance_key_status = false;
function chance_key(){
    chance_key_status = !chance_key_status;
    jQuery("#popup-chance-key").toggleClass("hide-element");
    jQuery(".chance-key-form").toggleClass("hide-element scale-off");
    if(chance_key_status){
        jQuery('html, body').animate({
            scrollTop: jQuery(".products-preview").offset().top - 55
        }, 800);
        jQuery("body").addClass("no-scoll");
    }else{
        jQuery('html, body').animate({
            scrollTop: jQuery(".clinet-club").offset().top - 200
        }, 300);
        jQuery("body").removeClass("no-scoll");
    }
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


// ---------- SideBar Mobile


jQuery(".collaps-menu-icon").click(function(){
    jQuery(".sidebar-menu").toggleClass("translate-off");
    jQuery("body").addClass("no-scoll");
});

jQuery(".sidebar-close-icon").click(function(){
    jQuery(".sidebar-menu").toggleClass("translate-off");
    jQuery("body").removeClass("no-scoll");
});

jQuery(".sidebar-menu-item").click(function(){
    jQuery(this).find(".sub-sidebar-menu").toggleClass("sub-sidebar-menu-show");
});

jQuery(".sub-sidebar-menu-item").hover(
    function(){
        jQuery(this).find(".sub-sidebar-menu-icon").removeClass("hide-element");
    },
    function(){
        jQuery(this).find(".sub-sidebar-menu-icon").addClass("hide-element");
    }
);

var w = window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth;

jQuery( window ).resize(function() {
    var w = window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth;
    if(w>=768){
        jQuery(".sidebar-menu").removeClass("translate-off");
        jQuery("body").removeClass("no-scoll");  
    }

    // ---------- Dashboard Sidebar Responsive (On Resize)


    if(w<=991){
        jQuery(".dashboard-sidebar").addClass("dashboard-sidebar-closed");
        jQuery(".dashboard-main").addClass("dashboard-main-full");
    }else{
        jQuery(".dashboard-sidebar").removeClass("dashboard-sidebar-closed");
        jQuery(".dashboard-main").removeClass("dashboard-main-full");
        jQuery(".dashboard-sidebar").removeClass("translate-off");
    jQuery(".dashboard-sidebar-background").addClass("hide-element");
    }
});


// ---------- Dashboard Sidebar Responsive (On Page Load)


if(w<=991){
    jQuery(".dashboard-sidebar").addClass("dashboard-sidebar-closed");
    jQuery(".dashboard-main").addClass("dashboard-main-full");
}else{
    jQuery(".dashboard-sidebar").removeClass("dashboard-sidebar-closed");
    jQuery(".dashboard-main").removeClass("dashboard-main-full");    
}


// ---------- Dashboard Sidebar Responsive (On Icon Click)


jQuery(".dashboard-sidebar-collapsed-icon").click(function(){
    jQuery(".dashboard-sidebar").addClass("translate-off");
    jQuery(".dashboard-sidebar-background").removeClass("hide-element");
});

jQuery('.dashboard-sidebar-background').click(function(e) {
    if(!jQuery(e.target).hasClass('.chance-key-form'))
    {
        jQuery(".dashboard-sidebar").removeClass("translate-off");
        jQuery(".dashboard-sidebar-background").addClass("hide-element");
    }
});

jQuery('.dashboard-sidebar').click(function(event){
     event.stopPropagation();
});

// ---------- Categories Page
// ---------- Products Animations


jQuery(".product-item").hover(
    function(){        
        jQuery(this).find(".categories-effect-image").removeClass("hide-element");
        jQuery(this).find(".categories-effect-image").addClass("scale-off");
    },
    function(){
        jQuery(this).find(".categories-effect-image").addClass("hide-element");
        jQuery(this).find(".categories-effect-image").removeClass("scale-off");
    }
);

jQuery(window).on('scroll', function() {    
    if (jQuery(window).scrollTop() > jQuery(".second-product-list").offsetTop - 450) {
        jQuery(".second-product-list").removeClass("hide-element");
    }
    if (jQuery(window).scrollTop() > jQuery(".third-product-list").offsetTop - 450) {
        jQuery(".third-product-list").removeClass("hide-element");
    }
    if (jQuery(window).scrollTop() > jQuery(".forth-product-list").offsetTop - 450) {
        jQuery(".forth-product-list").removeClass("hide-element");
    }    
    if (jQuery(window).scrollTop() > jQuery(".fifth-product-list").offsetTop - 450) {
        jQuery(".fifth-product-list").removeClass("hide-element");
    }            
});


// ---------- Products Categories Show/Hide


jQuery(".collapsed-products").click(function(){
    jQuery(".categories-categories-slider").toggleClass("translate-off");
});


// ---------- Add To Shoping Card


var shoping_cart = 0;
jQuery(".shoping-cart-number-counter").text(shoping_cart);
jQuery(".add-to-cart").click(function(){    
    jQuery(".shoping-cart-number-counter").text(++shoping_cart);
    jQuery(".added-product-to-shoping-list").addClass("translate-off");
    setTimeout(function(){
        jQuery(".added-product-to-shoping-list").removeClass("translate-off");
    }, 1500); 
});



// ---------- Selected Card

jQuery(".card").removeClass("selected-card");
jQuery(".border-selected").addClass("hide-element");
jQuery(".card:eq(0)").find(".border-selected").removeClass("hide-element");
jQuery(".card:eq(0)").addClass("selected-card");
jQuery(".card").click(function(){
    jQuery(".card").removeClass("selected-card");
    jQuery(".border-selected").addClass("hide-element");
    jQuery(this).find(".border-selected").removeClass("hide-element");
    jQuery(this).addClass("selected-card");    
    jQuery(".svg-model").css("fill",jQuery(this).data("color"));
});


// ---------- Cards Color Picker


jQuery(".card").each(function() {
  jQuery(this).find(".colors").find(".color").css("background",jQuery(this).data("color"));
});


// ---------- Select Payment (Shpoing Card Page)


var sum = 0;

jQuery(".radio-btn").click(function(){
    jQuery(".radio-btn").find(".radio-inside").removeClass("scale-off");
    jQuery(".radio-btn").removeClass("selected-payment");
    jQuery(".payment-method-selected").val(jQuery(this).data("payment-method"));    
    jQuery(this).find(".radio-inside").addClass("scale-off");
    jQuery(this).addClass("selected-payment");
});

jQuery(".radio-btn:eq(0)").trigger("click");

jQuery(".number-of-product").each(function() {
    jQuery(this).val(1);
    sum+=jQuery(this).data("price");
});


// ---------- Count Total Cost


jQuery(".total-price-count").html(sum.toLocaleString());

jQuery(".number-of-product").focusout(function(){
    if(jQuery(this).val() == "" || jQuery(this).val() == "0" ) {
        jQuery(this).val(1);
        sum = 0;
        jQuery(".number-of-product").each(function() {
            sum += jQuery(this).data("price") * jQuery(this).val();
        });
        jQuery(".total-price-count").html(sum.toLocaleString());
    }
});

jQuery(".number-of-product").keyup(function() {
    if(isNaN(jQuery(this).val())) {
        jQuery(this).val(1);        
    }else{
        sum = 0;
        jQuery(".number-of-product").each(function() {
            sum += jQuery(this).data("price") * jQuery(this).val();
        });
        jQuery(".total-price-count").html(sum.toLocaleString());
    }
});


// ---------- Address Input Effect

function Light_Up(switch_key, selector) {
    if(switch_key) {
        jQuery("." + selector).css("color","#448AFF");
        return;
    }
    jQuery("." + selector).css("color","#727276");
}

function border_effect(key, element) {
    if(key) {
        jQuery("."+element).css("width","100%");
        jQuery(".checkout-location-icon").css("color","#448AFF");
        return ;
    }
    jQuery("."+element).css("width","0");
    jQuery(".checkout-location-icon").css("color","#727276");
}


// ---------- Select Shipping (Checkout Card Page)


var Shipping_Selection = false;


jQuery(".shipping-method-item").hover(
    function() {
        jQuery(this).find(".checkout-radio-btn").find(".checkout-radio-inside-hover").removeClass("hide-element");
    },
    function() {
        jQuery(this).find(".checkout-radio-btn").find(".checkout-radio-inside-hover").addClass("hide-element");
});

jQuery(".shipping-method-item").click(function(){    
    jQuery(".checkout-radio-btn").find(".checkout-radio-inside").removeClass("scale-off");
    jQuery(".checkout-radio-btn").removeClass("selected-shipping");
    jQuery(".shipping-method-selected").val(jQuery(this).data("shipping-method"));
    jQuery(this).find(".checkout-radio-btn").find(".checkout-radio-inside").addClass("scale-off");
    jQuery(this).find(".checkout-radio-btn").addClass("selected-shipping");
    if(!Shipping_Selection) {
        jQuery(this).css("border-bottom","1px solid #DDDDDD");
        jQuery(".checkout-radio-btn").removeClass("hide-element");
        jQuery(".checkout-shipping-icon").addClass("hide-element");        
        jQuery(".shipping-method-item:eq(0)").css("border-bottom","1px solid #DDDDDD");
        jQuery(".select-shipping-method-arrow-icon").css("transform","scale(0)");
        jQuery(".shipping-method-item").slideDown();
        Shipping_Selection = true;
    }else {
        jQuery(this).css("border","none");
        jQuery(".checkout-radio-btn").addClass("hide-element");
        jQuery(".checkout-shipping-icon").removeClass("hide-element");        
        jQuery(".shipping-method-item:eq(0)").css("border-bottom","none");
        jQuery(".select-shipping-method-arrow-icon").css("transform","scale(1)");
        for(var i=0;i<4;++i) {
            if(i!=jQuery(this).index(0)) {
                jQuery(".shipping-method-item:eq("+i+")").slideUp();
            }            
        }        
        jQuery(this).slideDown();
        Shipping_Selection = false;
    }
    jQuery(".shipping-method-item:eq(3)").css("border-bottom","none");        
});

jQuery(".shipping-method-selected").val(jQuery(".shipping-method-item:eq(0)").data("shipping-method"));
jQuery(".shipping-method-item:eq(0)").find(".checkout-radio-btn").find(".checkout-radio-inside").addClass("scale-off");
jQuery(".shipping-method-item:eq(0)").find(".checkout-radio-btn").addClass("selected-shipping");    
jQuery(".checkout-radio-btn").addClass("hide-element");
jQuery(".shipping-method-item:eq(0)").css("border-bottom","none");

for(var i=1;i<4;++i) {
    jQuery(".shipping-method-item:eq("+i+")").slideUp();
}


// ---------- Validates

// pats
var phone_valid_pat = /^\d{11}jQuery/; 
var mail_valid_pat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+jQuery/;

function phone_validation(value){
    if(jQuery(value).val().match(phone_valid_pat)) return true;
    return false;
}

function mail_validation(value){
    if(jQuery(value).val().match(mail_valid_pat)) return true;
    return false;
}


// ---------- Dashboard/Profile Add Inputs
function validate_add_new_data(key, input){    
    if(key == "phone"){
        if(phone_validation(".edit-input-phone")) return true;
        jQuery(".dashboard-profile-add-error").css("display","block");
        return false;
    }else if(key == "mail"){
        if(mail_validation(".edit-input-email")) return true;
        jQuery(".dashboard-profile-add-error").css("display","block");
        return false;
    }else if(key == "address"){
        if(jQuery(".edit-input-address").val() != "") return true;
        jQuery(".dashboard-profile-add-error").css("display","block");
        return false;
    }    
}


// ---------- Dashboard/Profile Edit Inputs
function validate_edit_info() {    
    var access = true;
    jQuery(".dashboard-profile-data-phone").each(function(){
        if(!jQuery(this).val().match(phone_valid_pat)){
            jQuery(".edit-phone-error").css("display","block");
            access = false;
            return false;
        }else{
            jQuery(".edit-phone-error").css("display","none");
        }
    });
    jQuery(".dashboard-profile-data-email").each(function(){
        if(!mail_validation(jQuery(this))){
            jQuery(".edit-mail-error").css("display","block");
            access = false;
            return false;
        }else{
            jQuery(".edit-mail-error").css("display","none");
        }
    });
    jQuery(".dashboard-profile-data-address").each(function(){
        if(jQuery(this).val() == ""){
            jQuery(".edit-address-error").css("display","block");
            access = false;
            return false;
        }else{
            jQuery(".edit-address-error").css("display","none");
        }
    });
    return access;
}


// ---------- Dashboard/New-Ticket
function new_ticket_validate(){
    if(jQuery(".new-ticket-input-text").val() != "") return true;
    jQuery(".new-ticket-input-text-error").css("display","block");
    return false;
}


// ---------- Login
function login_check_form(){
    if(phone_validation(".login-phone-number")) return true;
    jQuery(".login-error").css("display","block");
    return false;
}


// ---------- Signup
function signup_check_form(){
    jQuery(".signup-error").css("display","block");
    if(!jQuery(".signup-full-name").val()) {
        jQuery(".signup-error").text("لطفا نام و نام خانوادگی را وارد نمایید");        
        return false;
    }else if(!phone_validation(".signup-phone-number")){
        jQuery(".signup-error").text("شماره همراه صحیح نمیباشد");
        return false;
    }else if(!mail_validation(".signup-mail")){
        jQuery(".signup-error").text("ایمیل صحیح نمیباشد");        
        return false;
    }
    jQuery(".signup-error").css("display","none");
    return true;
}


// ---------- Checkout
function validate_form() {
    if(phone_validation(".phone-number")) return true;
    jQuery(".phone-number-error").css("display","block");
    jQuery('html, body').animate({
        scrollTop: jQuery(".checkout-complete-information").offset().top - 150
    }, 500);
    return false;
}


// ---------- Select Bank


jQuery(".bank-input").val(jQuery(".selected-bank").data("bank"));
jQuery(".bank-logo").click(function(){
    jQuery(".bank-logo").removeClass("selected-bank");
    jQuery(this).addClass("selected-bank");
    jQuery(".bank-input").val(jQuery(this).data("bank"));    
});


// ---------- Select Form


jQuery(".change-forms-btn").click(function(){
    jQuery(".signup-main").toggleClass("hide-element");
    jQuery(".signup-main").toggleClass("scale-off");
    jQuery(".login-main").toggleClass("hide-element");
    jQuery(".login-main").toggleClass("scale-off"); 
});


// ---------- Border Selection + Login/Signup


jQuery(".selecting-borders").click(function(){
    jQuery(".selecting-borders").removeClass("selected-border");
    jQuery(this).addClass("selected-border");
});


// ---------- Fill Price Show From Data


jQuery(".product-number").each(function(){
    jQuery(this).find(".cart-product-cost").find("span").html(jQuery(this).find(".number-of-product").data("price"));
});


// ---------- Split Numebrs
// ---------- ++ MUST BE AT THE END OF THIS FILE ++


jQuery(".split-number").each(function(){
    var temp_num = parseInt(jQuery(this).html());
    jQuery(this).html(temp_num.toLocaleString());
});


// ---------- Dashboard PopUps


function open_edit_box(key) {
    jQuery(key).find(".popup").addClass("scale-off");
    jQuery(key).removeClass("hide-element");
}

jQuery('.popup-background').click(function(e) {
    if(!jQuery(e.target).hasClass('.popup'))
    {
        jQuery(".popup-background").addClass("hide-element");
        jQuery(".popup-background").find(".popup").removeClass("scale-off");
        jQuery(".dashboard-profile-add-error").css("display","none");
    }
});

jQuery('.popup').click(function(event){
     event.stopPropagation();
});

jQuery(".dashboard-items-close-icon").click(function(){
    jQuery(".popup-background").addClass("hide-element");
    jQuery(".popup-background").find(".popup").removeClass("scale-off");
    jQuery(".dashboard-profile-add-error").css("display","none");
});



jQuery(".dashboard-profile-data").prop('disabled', true);



function chnage_inputs_status(key){
    jQuery(key).prop('disabled', false);
    jQuery(key).addClass("dashboard-profile-data-active");
}


// Dashboard/Profile - Prevent Leaving Name Input Empty 
var name_holder = "";
jQuery(".dashboard-profile-data-name").focus(function(){
    name_holder = jQuery(this).val();
});

jQuery(".dashboard-profile-data-name").focusout(function(){
    if(jQuery(this).val()=="") jQuery(this).val(name_holder);
});


// Dashboard/New-Ticket - File Attachment
setInterval(function(){title_fixer()}, 500);
function title_fixer(){    
    jQuery(".new-ticket-file").each(function(){
        if(jQuery(this).find(".new-ticket-file-input").val() == ""){
            jQuery(this).find('.new-ticket-file-name').html("فایل را انتخاب کنید...");
        }else{
            jQuery(this).find('.new-ticket-file-name').html(jQuery(this).find(".new-ticket-file-input").val());
        }
    });
}

var attachment_counter = 2;
jQuery(".add-attachment-icon").click(function(){    
    jQuery(".new-ticket-file").last().clone().appendTo(".new-ticket-box");
    jQuery(".new-ticket-file").last().find(".new-ticket-file-input").attr('name','file_'+attachment_counter);
    jQuery(".new-ticket-file").last().find(".new-ticket-file-input").val('');
    jQuery(".new-ticket-file").last().find(".new-ticket-file-name").html('فایل را انتخاب کنید...');
    attachment_counter++;    
});