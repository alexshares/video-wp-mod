jQuery( document ).ready( function( $ ) {
"use strict";

     // Sticky Sidebar
    jQuery('.sidebar').stick_in_parent({parent: '.wrap-fullwidth, .wrap-middle', spacer: '.sidebar-wrapper'});
    jQuery('#small-sidebar').stick_in_parent();

    // Auto Height Articles
    jQuery('.modern-articles li, .video-articles li').matchHeight();

    // Opacity from 0 to 1 for Sliders / articles
    jQuery("#top-slider, .trending-articles, #featured-slider, #featured-slider2, .modern-articles, footer ul.video-articles, #related-wrap ul.video-articles, .single-gallery").delay(300).animate({"opacity": "1"}, 100);

    // Top Slider
    jQuery('#top-slider ul').owlCarousel({
        loop: true,
        center: true,
        autoWidth: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
    }) 

    // Single Gallery Article
    jQuery('.single-gallery').owlCarousel({
        loop: false,
        center: false,
        autoWidth: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
    }) 

    // Footer Slider & Related Articles Slider
    jQuery('footer ul.video-articles, #related-wrap ul.video-articles').owlCarousel({
        loop: true,
        center: false,
        autoWidth: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
    })     

    /////////////////////////////////
    // Slider Featured Articles
    /////////////////////////////////
    jQuery('#featured-slider, #featured-slider2').owlCarousel({
        loop: true,
        center: false,
        autoWidth: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
    })  
    // Slider Nav
    jQuery('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        e.preventDefault();
    });

    jQuery('ul.trend-slide').owlCarousel({
        loop: true,
        autoWidth: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true 
    })

    /////////////////////////////////
    // Accordion 
    /////////////////////////////////       
    jQuery(".accordionButton").click(function(){jQuery(".accordionButton").removeClass("on");jQuery(".accordionContent").slideUp("normal");if(jQuery(this).next().is(":hidden")==true){jQuery(this).addClass("on");jQuery(this).next().slideDown("normal")}});jQuery(".accordionButton").mouseover(function(){jQuery(this).addClass("over")}).mouseout(function(){jQuery(this).removeClass("over")});jQuery(".accordionContent").hide(); 

    /////////////////////////////////
    // Go to TOP
    /////////////////////////////////
    // hide #back-top first
    jQuery("#back-top").hide();
    
    // fade in #back-top
    jQuery(function () {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#back-top').fadeIn();
            } else {
                jQuery('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        jQuery('#back-top a').click(function () {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
 

    /////////////////////////////////
    // Sticky Header
    /////////////////////////////////
    var stickyNavTop = jQuery('.main-menu').offset().top;    
    var stickyNav = function(){  
    var scrollTop = jQuery(window).scrollTop();  
           
    if (scrollTop > stickyNavTop) {   
        jQuery('.main-menu').addClass('stickytop');  
    } else {  
        jQuery('.main-menu').removeClass('stickytop');   
    }  
    };  
    stickyNav();  
    jQuery(window).scroll(function() { stickyNav(); });

    
}); // jQuery(document).