$(document).ready(function(){
    $('.slider').slick({
        speed: 500,
        cssEase: 'linear',
        slidesToShow: 3,
        slidesToScroll: 1,
        daptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 2000,
    });
});


$(document).ready(function () {
    $(".slick-prev, .slick-next, .slick-active, .slick-slide, .slide").on('mouseenter keydown click', function () {
        var bcNext = $(".slick-active .slide_heading:eq(-1)").css("background-color");
        var bcPrev = $(".slick-active .slide_heading").css("background-color");
        $('<style>.slick-next:before{content: \'\';\n' +
            'position: absolute;\n' +
            'right: -4px;\n' +
            'top: 75px;\n' +
            'border: 12px solid transparent;\n' +
            'border-left: 14px solid;\n' +
            'transition: 1s;\n' +
            'border-left-color: '+bcNext+';}</style>').appendTo('head');
        $('<style>.slick-prev:before{content: \'\';\n' +
            'position: absolute;\n' +
            'left: 0;\n' +
            'top: 75px;\n' +
            'border: 12px solid transparent;\n' +
            'border-right: 14px solid;\n' +
            'transition: 1s;\n' +
            'border-right-color: '+bcPrev+';}</style>').appendTo('head');
    });
})
