


var currentSlide;
var currentQuote;
var overallCounter;

$(document).ready(function () {


    $(".tabs-detail").hide(); //Hide all content
    $("ul.tabs_nav li:first").addClass("active").show(); //Activate first tab
    $(".tabs-detail:first").show(); //Show first tab content

    //On Click Event
    $("ul.tabs_nav li").click(function () {

        $("ul.tabs_nav li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(".tabs-detail").hide(); //Hide all tab content

        var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
        $(activeTab).fadeIn('fast'); //Fade in the active ID content
        return false;
    });

    //    this is for the beta, not to allow login / signup

    $('.modal').click(function (e) {
        $('#SignUp').modal();
        return false;
    });
    $('.modal2').click(function (e) {
        $('#Login').modal();
        return false;
    });



    if (document.URL.indexOf("#tab3") != -1) {
        $('#price').click()
        ;
        $('.grid_3').click(function () {
            var jump = $(this).attr('href');
            var new_position = $('#' + jump).offset();
            window.scrollTo(new_position.left, new_position.top);
            return false;
        });
    }

    if (document.URL.indexOf("#tab4") != -1) {
        $('#examples').click()
        ;
        $('.grid_3').click(function () {
            var jump = $(this).attr('href');
            var new_position = $('#' + jump).offset();
            window.scrollTo(new_position.left, new_position.top);
            return false;
        });
    }



    //for the upper area slide show images... 
    var x = css_browser_selector(navigator.userAgent);
    if (x.indexOf('mac') != -1 && x.indexOf('chrome') != -1) {

        //chrome on mac requires a custom made slide show... 
        currentSlide = 1;
        currentQuote = 1;
        overallCounter = 1;
        var myVar2 = setInterval(function () { FadeEventsForChromeMac() }, 5000);

    }
    else {
        //for all other browsers...
        BindNormalSlideShow();

        //----------------------------------
        //for the quotes on the home page... 
        currentQuote = 1;
        //window.setTimeout(function () { FadeNextQuote() }, 5000);
        //----------------------------------

    }


});


function BindNormalSlideShow() {


    //for most browsers, this is the normal slide show we want to use... 
    $('#showcase').slides({
        preload: true,
        preloadImage: 'images/loading.gif',
        effect: 'slide',
        crossfade: true,
        play: 5000,
        slideSpeed: 350,
        fadeSpeed: 500,
        generateNextPrev: false,
        generatePagination: false,
        animationStart: function (current) {
            $('').animate({
                bottom: -155
            }, 100);
            //if (window.console && console.log) {
            // example return of current slide number
            //console.log('animationStart on slide: ', current);
            //};
        },
        animationComplete: function (current) {
            $('').animate({
                bottom: 0
            }, 200);
            //if (window.console && console.log) {
            // example return of current slide number
            //console.log('animationComplete on slide: ', current);
            //};
        },
        slidesLoaded: function () {
            $('').animate({
                bottom: 0
            }, 200);
        }
    });

}



//for the custom-made slide show, for Chrome on Mac... 
function FadeEventsForChromeMac() {

    var pixelLeft = '';

    overallCounter = overallCounter + 1;

    //fail-safe... as it gets messy after a while sitting there... 
    if (overallCounter > 200)
        return;


    $('#slide' + currentSlide).hide();

    //$('#q-' + currentQuote).hide();


    switch (currentSlide) {
        case 1:
            currentSlide = 2;
            currentQuote = 2;
            pixelLeft = '375px';
            break;
        case 2:
            currentSlide = 3;
            currentQuote = 3;
            pixelLeft = '560px';
            break;
        case 3:
            currentSlide = 4;
            currentQuote = 4;
            pixelLeft = '760px';
            break;
        case 4:
            currentSlide = 1;
            currentQuote = 1;
            pixelLeft = '175px';
            break;
    }

    $('#slide' + currentSlide).fadeIn();


    //QUOTES
    //$('#q-' + currentQuote).fadeIn();
    //$('.pr-quote-arrow').animate({ left: pixelLeft }, 800, 'easeInOutCirc');



    //set the next timeout... we do this one at a time due to a chrome bug... 
    window.setTimeout(function () { FadeEventsForChromeMac() }, 5000);


}


function ShowQuote(QuoteNum) {


    //hide all of them...
    $('.quoteDIV').animate({ opacity: 0 }, 300);
    $('.quoteDIV').hide();

    switch (QuoteNum) {
        case 1:
            pixelLeft = '175px';
            break;
        case 2:
            pixelLeft = '375px';
            break;
        case 3:
            pixelLeft = '560px';
            break;
        case 4:
            pixelLeft = '760px';
            break;
    }

    $('#q-' + QuoteNum).animate({ opacity: 1 }, 300);
    $('#q-' + QuoteNum).css('display', 'inline-block');

    //$('.pr-quote-arrow').animate({ left: pixelLeft }, 800, 'easeInOutCirc');
    $('.pr-quote-arrow').css('left',pixelLeft);

}




//FOR QUOTE AREA.... 
function FadeNextQuote() {

    /*
    5 items:
    300
    470
    630
    830
    110

    4 items:
    175
    375
    560
    760


    3 items:
    280
    490
    680

    */


    $('#q-' + currentQuote).fadeOut('slow', function () {
        // Animation complete

        //bring opacity down to zero... then hide it... 
        $('#q-' + currentQuote).css('opacity', 0);
        $('#q-' + currentQuote).hide();

        switch (currentQuote) {
            case 1:
                currentQuote = 2;
                $('.pr-quote-arrow').animate({ left: '375px' }, 800, 'easeInOutCirc', function () {
                    // Animation complete.
                });
                break;
            case 2:
                currentQuote = 3;
                $('.pr-quote-arrow').animate({ left: '560px' }, 800, 'easeInOutCirc', function () {
                    // Animation complete.
                });
                break;
            case 3:
                currentQuote = 4;
                $('.pr-quote-arrow').animate({ left: '760px' }, 800, 'easeInOutCirc', function () {
                    // Animation complete.
                });
                break;
            case 4:
                currentQuote = 1;
                $('.pr-quote-arrow').animate({ left: '175px' }, 1100, 'easeInOutCirc', function () {
                    // Animation complete.
                });
                break;
            //            case 5:
            //                currentQuote = 1;
            //                $('.pr-quote-arrow').animate({ left: '110px' }, 1200, 'easeInOutCirc', function () {
            //                    // Animation complete.
            //                });
            //                break;
            default:
                $('.pr-quote-arrow').css('left', '175px');
                currentQuote = 1;
        }
        
        //reset this back to inline-block, which allows it to center... 
        $('#q-' + currentQuote).css('display', 'inline-block');

        //then fade it in to full opacity...
        $('#q-' + currentQuote).animate({ opacity: 1 }, 'slow', function () {
            // Animation complete
        });

        //due to a bug in most browsers, safest interval is to keep setting it... 
        window.setTimeout(function () { FadeNextQuote() }, 5000);

    });

}