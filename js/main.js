$(document).ready(function () {

    var menuHeight = $('#mainNav').height();

    $('.pageWrap').css('margin-top', menuHeight);

    
    $('.postEntry').fitVids();


 
    var offset = 220;
    var duration = 500;
    $(window).scroll(function () {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(duration);
        } else {
            $('.back-to-top').fadeOut(duration);
        }
    });

    $('.back-to-top').click(function (event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    });

    $('.fullWidthVideo').fitVids();

});
