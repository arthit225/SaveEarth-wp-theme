jQuery(function($){
    $(window).load(function(){
        //Check if page is scrolled
        var scroll = $(window).scrollTop();
        if (scroll >= 50) {
            $("#masthead").addClass("scrolled");
            $("#portfolio-header-title").addClass("invisible");
            $("#portfolio-body-title").removeClass("invisible");
        } else {
            $("#masthead").removeClass("scrolled");
            $("#portfolio-header-title").removeClass("invisible");
            $("#portfolio-body-title").addClass("invisible");
        }
        //Add Class After Scroll
        $(window).scroll(function() {    
            var scroll = $(window).scrollTop();
            if (scroll >= 50) {
                $("#masthead").addClass("scrolled");
                $("#portfolio-header-title").addClass("invisible");
                $("#portfolio-body-title").removeClass("invisible");
            } else {
                $("#masthead").removeClass("scrolled");
                $("#portfolio-header-title").removeClass("invisible");
                $("#portfolio-body-title").addClass("invisible");
            }
        });
        
        $('a#searchbutton').on('click', function() {
            $('input.search-field').focus();
        });
                
        // Light Slider Initiate
        $("#lightSlider").lightSlider({
            item: 1,
            slideMargin: 0,
            autoWidth: true,
            pager: false,
            mode: "fade",
            speed: 500,
            pause: 7000,
            auto: true,
            adaptiveHeight:true,
            loop: true,
            vertical: true,
            controls: true,
            prevHtml: '<img src="//www.deartomorrow.org/wp-content/themes/deartomorrow/images/slider-previous.png" border="0" />',
            nextHtml: '<img src="//www.deartomorrow.org/wp-content/themes/deartomorrow/images/slider-next.png" border="0" />',
            onSliderLoad: function() {
                $('#lightSlider').removeClass('cS-hidden');
            }         
        }); 

        // Light Slider Initiate
        $("#pagelightSlider").lightSlider({
            item: 1,
            slideMargin: 10,
            autoWidth: false,
            pager: false,
            mode: "slide",
            speed: 500,
            pause: 4500,
            auto: true,
            adaptiveHeight:false,
            loop: true,
            vertical: false,
            controls: false,
            onSliderLoad: function() {
                $('#pagelightSlider').removeClass('cS-hidden');
            }         
        }); 
        
        
        
        // init Isotope
        
        var $grid = $('.grid');
        
        $grid.infiniteScroll({
          // options
          path: '.pagination__next',
          append: '.element-item',
          history: false,
        });
        
        $('#social-menu .nav-search a').attr('data-fancybox', '');
        $('#social-menu .nav-search a').attr('data-src', '#searchbox');
        
        
        
    });
});
