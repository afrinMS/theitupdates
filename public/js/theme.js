
//  Theme Custom jquery file, 

    // Created on   : 19/02/2018.
    // Theme Name   : Corpoz.
    // Description  : Corpoz-multipurpose Business &amp; Agency Template.
    // Version      : 1.1.
    // Author       : @TheMazine.
    // Designed By  : @TheMazine.
    // Developed By : @TheMazine.
   



"use strict";

// Prealoder
 function prealoader () {
   if ($('#loader').length) {
     $('#loader').fadeOut(); // will first fade out the loading animation
     $('#loader-wrapper').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
     $('body').delay(350).css({'overflow':'visible'});
  };
 }


// placeholder remove
function removePlaceholder () {
  if ($("input,textarea").length) {
    $("input,textarea").each(
        function(){
            $(this).data('holder',$(this).attr('placeholder'));
            $(this).on('focusin', function() {
                $(this).attr('placeholder','');
            });
            $(this).on('focusout', function() {
                $(this).attr('placeholder',$(this).data('holder'));
            });
            
    });
  }
}


// Theme-banner slider 
function BannerSliderone () {
  var banner = $(".banner-one");
  if (banner.length) {
    banner.camera({ //here I declared some settings, the height and the presence of the thumbnails 
      height: '1100px',
      pagination: true,
      navigation: false,
      thumbnails: false,
      playPause: false,
      pauseOnClick: false,
      autoPlay:true,
      hover: false,
      overlayer: true,
      loader: 'none',
      minHeight: '650px',
      time: 4000,
    });
  };
}


// Theme-banner slider 
function BannerSliderTwo () {
  var banner = $(".banner-two");
  if (banner.length) {
    banner.camera({ //here I declared some settings, the height and the presence of the thumbnails 
      height: '1050px',
      pagination: true,
      navigation: false,
      thumbnails: false,
      playPause: false,
      pauseOnClick: false,
      autoPlay:true,
      hover: false,
      overlayer: true,
      loader: 'none',
      minHeight: '700px',
      time: 4000,
    });
  };
}

// Theme-banner slider 
function BannerSliderThree () {
  var banner = $(".banner-three");
  if (banner.length) {
    banner.camera({ //here I declared some settings, the height and the presence of the thumbnails 
      height: '800px',
      pagination: true,
      navigation: false,
      thumbnails: false,
      playPause: false,
      pauseOnClick: false,
      autoPlay:true,
      hover: false,
      overlayer: true,
      loader: 'none',
      minHeight: '600px',
      time: 4000,
    });
  };
}


// Theme-banner slider 
function BannerSliderFour () {
  var banner = $(".banner-four");
  if (banner.length) {
    banner.camera({ //here I declared some settings, the height and the presence of the thumbnails 
      height: '815px',
      pagination: true,
      navigation: false,
      thumbnails: false,
      playPause: false,
      pauseOnClick: false,
      autoPlay:true,
      hover: false,
      overlayer: true,
      loader: 'none',
      minHeight: '600px',
      time: 4000,
    });
  };
}

// WOW animation 
function wowAnimation () {
  if($('.wow').length) {
    var wow = new WOW(
    {
      boxClass:     'wow',      // animated element css class (default is wow)
      animateClass: 'animated', // animation css class (default is animated) 
      mobile:       true,       // trigger animations on mobile devices (default is true)
      live:         true,       // act on asynchronously loaded content (default is true)
      callback:     function(box) {
        // the callback is fired every time an animation is started
        // the argument that is passed in is the DOM node being animated
      },
      scrollContainer: null // optional scroll container selector, otherwise use window
    }
  );
  wow.init();
  }
}


// Testimonial Slider One 
function testimonialSliderOne () {
  var testSlider = $ (".testimonial-slider-one");
  if(testSlider.length) {
      testSlider.owlCarousel({
        loop:true,
        nav:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:4000,
        autoplaySpeed:1000,
        lazyLoad:true,
        singleItem:true,
        responsive:{
            0:{
                items:1
            },
            550:{
                items:2
            },
            992:{
                items:3
            }
        }
    })
  }
}


// Testimonial Slider Two 
function testimonialSliderTwo () {
  var testSlider = $ (".testimonial-slider-two");
  if(testSlider.length) {
      testSlider.owlCarousel({
        loop:true,
        nav:false,
        dots:true,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        smartSpeed:1200,
        lazyLoad:true,
        singleItem:true,
        items:1
    })
  }
}

// Testimonial Slider Three
function testimonialSliderThree () {
  var testSlider = $ (".testimonial-slider-three");
  if(testSlider.length) {
      testSlider.owlCarousel({
        loop:true,
        nav:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        smartSpeed:1200,
        lazyLoad:true,
        singleItem:true,
        responsive:{
            0:{
                items:1
            },
            550:{
                items:1
            },
            992:{
                items:2
            }
        }
    })
  }
}


// Team Slider One
function teamSliderOne () {
  var testSlider = $ (".team-slider");
  if(testSlider.length) {
      testSlider.owlCarousel({
        loop:true,
        nav:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        smartSpeed:1200,
        lazyLoad:true,
        singleItem:true,
        responsive:{
            0:{
                items:1
            },
            550:{
                items:2
            },
            992:{
                items:3
            }
        }
    })
  }
}


// Partner Logo Footer 
function partnersLogo () {
  var logoslider = $ ("#partner-logo");
  if(logoslider.length) {
      logoslider.owlCarousel({
        loop:true,
        nav:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:4200,
        autoplaySpeed:1000,
        lazyLoad:true,
        singleItem:true,
        responsive:{
            0:{
                items:1
            },
            550:{
                items:3
            },
            992:{
                items:4
            }
        }
    })
  }
}


// Scroll to top
function scrollToTop () {
  if ($('.scroll-top').length) {

    //Check to see if the window is top if not then display button
    $(window).on('scroll', function (){
      if ($(this).scrollTop() > 200) {
        $('.scroll-top').fadeIn();
      } else {
        $('.scroll-top').fadeOut();
      }
    });
    
    //Click event to scroll to top
    $('.scroll-top').on('click', function() {
      $('html, body').animate({scrollTop : 0},1500);
      return false;
    });
  }
}



//Contact Form Validation
function contactFormValidation () {
  if($('.form-validation').length){
    $('.form-validation').validate({ // initialize the plugin
      rules: {
        name: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        sub: {
          required: true
        },
        message: {
          required: true
        }
      },
      submitHandler: function(form) {
                $(form).ajaxSubmit({
                    success: function() {
                        $('.form-validation :input').attr('disabled', 'disabled');
                        $('.form-validation').fadeTo( "slow", 1, function() {
                            $(this).find(':input').attr('disabled', 'disabled');
                            $(this).find('label').css('cursor','default');
                            $('#alert-success').fadeIn();
                        });
                    },
                    error: function() {
                        $('.form-validation').fadeTo( "slow", 1, function() {
                            $('#alert-error').fadeIn();
                        });
                    }
                });
            }
        });
  }
}

// Close suddess Alret
function closeSuccessAlert () {
  var closeButton = $ (".closeAlert");
  if(closeButton.length) {
      closeButton.on('click', function(){
        $(".alert-wrapper").fadeOut();
      });
      closeButton.on('click', function(){
        $(".alert-wrapper").fadeOut();
      })
  }
}


// Sticky header
function stickyHeader () {
  if ($('.theme-menu-wrapper').length) {
    var sticky = $('.theme-menu-wrapper'),
        scroll = $(window).scrollTop();

    if (scroll >= 190) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
    
  };
}


// Accordion panel
function themeAccrodion () {
  if ($('.theme-accordion > .panel').length) {
    $('.theme-accordion > .panel').on('show.bs.collapse', function (e) {
          var heading = $(this).find('.panel-heading');
          heading.addClass("active-panel");
          
    });
    $('.theme-accordion > .panel').on('hidden.bs.collapse', function (e) {
        var heading = $(this).find('.panel-heading');
          heading.removeClass("active-panel");
          //setProgressBar(heading.get(0).id);
    });
    $('.panel-heading a').on('click',function(e){
        if($(this).parents('.panel').children('.panel-collapse').hasClass('in')){
            e.stopPropagation();
        }
    });
  };
}



// Product value
function productValue () {
  var inputVal = $("#product-value");
  if(inputVal.length) {
    $("#value-decrease").on('click', function() {
        var v= inputVal.val()-1;
        if(v>=inputVal.attr('min'))
        inputVal.val(v)
      });

    $("#value-increase").on('click', function() {
      var v= inputVal.val()*1+1;
      if(v<=inputVal.attr('max'))
      inputVal.val(v)
    });
  }
}


// Mixitup gallery
function mixitupGallery () {
  if ($("#mixitUp-item").length) {
    $("#mixitUp-item").mixItUp()
  };
}

// Related Product Slider
function productSlider () {
  var pSlider = $ (".related-product-slider");
  if(pSlider.length) {
      pSlider.owlCarousel({
        loop:true,
        nav:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:4000,
        autoplaySpeed:1000,
        lazyLoad:true,
        smartSpeed:1000,
        responsive:{
            0:{
                items:1
            },
            550:{
                items:2
            },
            1200:{
                items:3
            }
        }
    })
  }
}

// Counter function
function CounterNumberChanger () {
  var timer = $('.timer');
  if(timer.length) {
      timer.appear(function () {
        timer.countTo();
    })
  }
}


// DOM ready function
jQuery(document).on('ready', function() {
	(function ($) {
	   removePlaceholder ();
     BannerSliderone ();
     BannerSliderTwo ();
     BannerSliderThree ();
     BannerSliderFour ();
     wowAnimation ();
     testimonialSliderOne ();
     testimonialSliderTwo ();
     testimonialSliderThree ();
     teamSliderOne ();
     partnersLogo ();
     mixitupGallery ();
     scrollToTop ();
     contactFormValidation ();
     closeSuccessAlert ();
     themeAccrodion ();
     productValue ();
     productSlider ();
     CounterNumberChanger ();
  })(jQuery);
});


// Window load function
jQuery(window).on('load', function () {
   (function ($) {
		  prealoader ();
  })(jQuery);
 });


// Window scroll function
jQuery(window).on('scroll', function () {
  (function ($) {
    stickyHeader ();
  })(jQuery);
});
