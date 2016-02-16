

(function ($) {

    wp.customize('magee_logo', function (value) {
        value.bind(function (newval) {
            $('.navbar-brand img').attr('src', newval);
        });
    });
    
    wp.customize('theme_color', function (value) {
        value.bind(function (newval) {
            $('.team .social').css('border-top-color', newval);
        });
    });
    
    wp.customize('button_background_color', function (value) {
        value.bind(function (newval) {
            $('.snrBtn, #comments input[type="submit"], article.postEntry a.continueReading, article.home-post-article a.read-more').css('background', newval);
        });
    });
    
    wp.customize('button_text_color', function (value) {
        value.bind(function (newval) {
            $('.snrBtn, #comments input[type="submit"], article.postEntry a.continueReading, article.home-post-article a.read-more').css('color', newval);
        });
    });
    
    wp.customize('icon_bg_color', function (value) {
        value.bind(function (newval) {
            $('.service .icon').css('background', newval);
        });
    });
    
    wp.customize('icon_text_color', function (value) {
        value.bind(function (newval) {
            $('.service .icon').css('color', newval);
        });
    });

    wp.customize('navbar_background', function (value) {
        value.bind(function (newval) {
            $('.navbar-default').css('background', newval);
        });
    });

    wp.customize('navbar_link_color', function (value) {
        value.bind(function (newval) {
            $('.navbar-default .navbar-nav>li>a').css('color', newval);
        });
    });

    wp.customize('navbar_link_active_color', function (value) {
        value.bind(function (newval) {
            $('.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover').css('color', newval);
        });
    });

    wp.customize('banner_image', function (value) {
        value.bind(function (newval) {
            $('#homeSlider .slide-item').css('background-image', 'url("' + newval + '")');
        });
    });
    
    wp.customize('banner_title', function (value) {
        value.bind(function (newval) {
            $('#homeSlider h3').html(newval);
        });
    });
    
    wp.customize('banner_text', function (value) {
        value.bind(function (newval) {
            $('#homeSlider p.desc').html(newval);
        });
    });
    
    wp.customize('aboutus_image', function (value) {
        value.bind(function (newval) {
            $('#about-us-img').attr('src', newval);
        });
    });

    wp.customize('copyright_text', function (value) {
        value.bind(function (newval) {
            $('#magee-copyright').html(newval);
        });
    });

})(jQuery);