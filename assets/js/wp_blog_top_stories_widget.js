$(document).ready(function () {
    $(".top_stories_pages:eq(0)").css('display', 'none');
    $(".top_stories_pages:eq(2)").css('display', 'none');
    $(".top_stories_category").click(function () {
        $(".top_stories_three_pages .active").fadeOut();
        $(".top_stories_list .active").removeClass("active");
        $(this).addClass("active");
        var first = $(".top_stories_category:eq(0)").hasClass("active");
        var second = $(".top_stories_category:eq(1)").hasClass("active");
        var third = $(".top_stories_category:eq(2)").hasClass("active");
        $(".top_stories_three_pages .active").removeClass("active");
        if (first) {
            $(".top_stories_pages:eq(0)").addClass("active");
            var color = $(".top_stories_category:eq(0) p").css("background-color");
            var width = (+$(".top_stories_category:eq(0) p").css("width").slice(0, -2))/2 - 8;
            $('<style>.top_stories_list .active p:after{content: \'\';\n' +
                '    position: absolute;\n' +
                '    top: 50px;\n' +
                '    left: '+ width +'px;\n' +
                '    border: 8px solid transparent;\n' +
                '    transition: 200ms;\n' +
                '    border-top: 10px solid '+ color +';}</style>').appendTo('head');
            $(".top_stories_three_pages .active").fadeIn();
        }
        if (second) {
            $(".top_stories_pages:eq(1)").addClass("active");
            var color = $(".top_stories_category:eq(1) p").css("background-color");
            var width = (+$(".top_stories_category:eq(1) p").css("width").slice(0, -2))/2 - 8;
            $('<style>.top_stories_list .active p:after{content: \'\';\n' +
                '    position: absolute;\n' +
                '    top: 50px;\n' +
                '    left: '+ width +'px;\n' +
                '    border: 8px solid transparent;\n' +
                '    transition: 200ms;\n' +
                '    border-top: 10px solid '+ color +';}</style>').appendTo('head');
            $(".top_stories_three_pages .active").fadeIn();
        }
        if (third) {
            $(".top_stories_pages:eq(2)").addClass("active");
            var color = $(".top_stories_category:eq(2) p").css("background-color");
            var width = (+$(".top_stories_category:eq(2) p").css("width").slice(0, -2))/2 - 8;
            $('<style>.top_stories_list .active p:after{content: \'\';\n' +
                '    position: absolute;\n' +
                '    top: 50px;\n' +
                '    left: '+ width +'px;\n' +
                '    border: 8px solid transparent;\n' +
                '    transition: 200ms;\n' +
                '    border-top: 10px solid '+ color +';}</style>').appendTo('head');
            $(".top_stories_three_pages .active").fadeIn();
        }

    });
});

/*---100-92-127---*/
