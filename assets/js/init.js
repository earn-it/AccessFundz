(function($) {
  
    "use strict";
    
  /*
  |=====================
  | NAV FIXED ON SCROLL
  |=====================
  */
      
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 55) {
            $(".nav-scroll").addClass("strict");
        } else {
            $(".nav-scroll").removeClass("strict");
        }
    });
    
    /*
    |====================
    | Mobile NAv trigger
    |====================
    */
  
          var trigger = $('.navbar-toggle'),
          overlay     = $('.overlay'),
          active      = false;
      
        $('.navbar-toggle, #navbar-nav li a, .overlay').on('click', function () {
            $('.navbar-toggle').toggleClass('active')
            $('#js-navbar-menu').toggleClass('active');
            overlay.toggleClass('active');
        });  
      
        $('#mobile-menu-active').meanmenu();
          var win = $(window);
          var headerArea = $('.menu-spacing ');
          var header3 = $('.menu-spacing ');
          var stick = 'stick';
          var stick2 = 'stick2';
      
            win.on('scroll',function() {    
             var scroll = win.scrollTop();
             if (scroll < 245) {
              headerArea.removeClass(stick);
             }else{
              headerArea.addClass(stick);
             }
            });
            win.on('scroll',function() {    
             var scroll = win.scrollTop();
             if (scroll < 100) {
              header3.removeClass(stick2);
             }else{
              header3.addClass(stick2);
             }
        });
          
    
    
    $( document ).ready(function() {
/*
|===========
| FANCYBOX
|===========
*/
        
    $("[data-fancybox]").fancybox({});
        
        
      
    $('.select-beast').selectize({
      create: false,
      sortField: [{field: 'Descripcion', direction: 'desc'}, {field: '$score'}],
      dropdownParent: 'body'
    });
    
    
/*
|=========================
| searchbar
|=========================
*/ 
    
    $('#besocial-header-right').on('click',function(){
      $('#besocial-search-bar').toggleClass("show-search-bar");
      $('#besocial-header-right').toggleClass("scroll-search-icon");
    });
    
/*
|=========================
| VIDEO
|=========================
*/
    $('.video-player').fitVids();
    

/*
|================
| ANIMATION
|================
*/

    var wow = new WOW({
        mobile: false  // trigger animations on mobile devices (default is true)
    });
    wow.init();
      
/*
|===================
| REVIEW SLIDE 
|===================
*/
      
    $('.xt-carousel').owlCarousel({
          loop: true,
          responsiveClass: true,
          nav: false,
          center: true,
          responsive:{
              0:{
                  items: 1,
                  nav: true,
                  loop:true
              },
              768:{
                  items: 1,
                  nav:true,
                  loop:true
              },
              992:{
                  items: 1,
                  nav:true,
                  loop:true
              }
          }
      });
      
/*
|=====================
| SMOTHSCROLL
|=====================
*/
      
      $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });

/*
|================
| CONTACT FORM
|================
*/
        
      $("#contactForm").validator().on("submit", function (event) {
          if (event.isDefaultPrevented()) {
            // handle the invalid form...
            formError();
            submitMSG(false, "Did you fill in the form properly?");
          } else {
            // everything looks good!
            event.preventDefault();
            submitForm();
          }
       });
  
      function submitForm(){
        var name = $("#name").val();
        var email = $("#email").val();
        var message = $("#message").val();
        $.ajax({
            type: "POST",
            url: "process.php",
            data: "name=" + name + "&email=" + email + "&message=" + message,
            success : function(text){
                if (text == "success"){
                    formSuccess();
                  } else {
                    formError();
                    submitMSG(false,text);
                  }
              }
          });
      }
      function formSuccess(){
          $("#contactForm")[0].reset();
          submitMSG(true, "Message Sent!")
      }
  	  function formError(){   
  	    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
  	        $(this).removeClass();
  	    });
  	  }
      function submitMSG(valid, msg){
        if(valid){
          var msgClasses = "h3 text-center fadeInUp animated text-success";
        } else {
          var msgClasses = "h3 text-center shake animated text-danger";
        }
        $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
      }
  });
  
/*
|===========
| ISOTOPE
|===========
*/
  
      $(window).load(function(){
        var $container = $('.portfolioContainer');
        $container.isotope({
            filter: '*',
            animationOptions: {
                queue: true
            }
        });
     
        $('.portfolio-nav li').click(function(){
            $('.portfolio-nav .current').removeClass('current');
            $(this).addClass('current');
     
            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                animationOptions: {
                    queue: true
                }
             });
             return false;
        }); 
      }); 
      
/*
|===========
| MAP
|===========
*/
      
      
    if( $('#map').length ) {
      google.maps.event.addDomListener(window, 'load', init);
      function init() {
        var mapOptions = {
          zoom: 15,
          scrollwheel: false, 
          navigationControl: false,
          center: new google.maps.LatLng(24.906308,91.870413),
          styles: [{
              
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "hue": "#76aee3"
                        },
                        {
                            "saturation": 38
                        },
                        {
                            "lightness": -11
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "hue": "#8dc749"
                        },
                        {
                            "saturation": -47
                        },
                        {
                            "lightness": -17
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "all",
                    "stylers": [
                        {
                            "hue": "#c6e3a4"
                        },
                        {
                            "saturation": 17
                        },
                        {
                            "lightness": -2
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "all",
                    "stylers": [
                        {
                            "hue": "#cccccc"
                        },
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 13
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "elementType": "all",
                    "stylers": [
                        {
                            "hue": "#5f5855"
                        },
                        {
                            "saturation": 6
                        },
                        {
                            "lightness": -31
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "all",
                    "stylers": [//
                        {
                            "hue": "#ffffff"
                        },
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 100
                        },
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": []
                }
            ]
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(24.906308,91.870413),
            map: map,
            title: '24 Golden Tower (2nd floor), Amborkhana, Sylhet.!'
        });
      }
    }
      

}(jQuery));