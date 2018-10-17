/**
* Init Puglins
*/
!(function ($, window, document, undefined) {
    'use strict';

    var InitComponent = function(){};

    InitComponent.prototype = {
        /**
        * Constructor or Initializer Method
        */
        initialize: function () {
            // this.initConfig();
            this.initCarousel();
            this.anchorTo();
            this.scrollTop();
            this.ajaxCall();
        },

        /**
        * Trigger Slick plugin config
        */
        initCarousel: function () {
            var _this = this,
                config = {
                '.slick-catalog': {
                    dots: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    centerMode: true,
                    focusOnSelect: true,
                    autoplay: false,
                    infinite: true,
                    speed: 350,
                    cssEase: 'ease',
                    arrows: false,
                    centerPadding: '25px',
                    adaptiveHeight: true,
                    variableWidth: false,
                    verticalSwiping: false,
                    // prevArrow: '<a href="#" style="background: gray"><i class="fa fa-angle-left"></i></a>',
                    // nextArrow: '<a href="#" style="background: gray"><i class="fa fa-angle-right"></i></a>'
                    // pauseOnDotsHover: true,
                    responsive: [
                        {
                            breakpoint: 1400,
                            settings: {
                                slidesToShow: 1,
                                centerPadding: '400px'
                            }
                        },
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 1,
                                centerPadding: '300px'
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 1,
                                centerPadding: '180px'
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                centerPadding: '80px'
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                centerPadding: '25px'
                            }
                        }
                    ]
                },
                '.slick-gallery': {
                    dots: false,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    centerMode: false,
                    centerPadding: '0px',
                    focusOnSelect: true,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    infinite: true,
                    speed: 350,
                    cssEase: 'ease',
                    arrows: true,
                    adaptiveHeight: false,
                    verticalSwiping: false,
                    swipeToSlide: true,
                    prevArrow: '<button type="button" class="slick-prev"></button>',
                    nextArrow: '<button type="button" class="slick-next"></button>',
                    // pauseOnDotsHover: true
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                }
            };

            for (var selector in config){
                if( ({}).hasOwnProperty.call(config, selector) ) {
                    $(selector).each(function(index, el) {
                        var $el = $(el);

                        if( !$el.hasClass('slick-initialized') ){
                            $el.slick(config[selector]);
                        }
                    });
                }
            }
        },

        /*
         * Anchor to  animation
         */
        anchorTo: function () {
            var $root = $('html, body');

            $('#rp-sg-header .rp-sg-header-grid a[href^="#"],.rp-sg-content-banner a[href^="#"],#lb-como-funciona a[href^="#"]').click(function () {

                $root.animate({
                    scrollTop: $( $.attr(this, 'href') ).offset().top
                }, 500);

                return false;
            });
        },

        /*
         * scroll to top actions
         */
        scrollTop: function () {
            $(window).scroll(function(){
                if (document.documentElement.clientWidth > 991) {
                    if ($(this).scrollTop() > 100) {
                        $('#rp-sg-header').addClass("isFixedHeader");
                    } else {
                        $('#rp-sg-header').removeClass("isFixedHeader");
                    }
                }

                if ($(this).scrollTop() > 1500) {
                    $('#return-top').fadeIn();
                } else {
                    $('#return-top').fadeOut();
                }
            });

            $('#return-top').click(function(){
                $('html, body').animate({scrollTop : 0},1200);
                return false;
            });
        },

        /**
         * call to custom ajax actions
         */
        ajaxCall: function () {
            $(document).on('click', '.rp-paginator-resources .pagination a', function(event) {
                event.preventDefault();

                var $el = $(event.currentTarget),
                    $results_wrapper = $el.closest('.rp-results-wrapper');

                if($el.hasClass('disabled') || !$el.is('a')) return;

                var href = $el.attr('href');

                var data = parseQueryString( href.split('?')[1] );
                data['action'] = 'testimonials_action';
                // history.pushState({}, document.title, href);

                $results_wrapper.animate({
                    background : '#898989'
                }, 400, 'easeInOutQuad');

                $.ajax({
                    url: customapp.ajax_url,
                    type: 'post',
                    dataType: 'json',
                    data: data,
                    beforeSend: function () {

                    }
                })
                .done(function(response) {
                    if( response['have_posts'] ) {
                        var $markup = $(response['html'].replace(/(\r\n|\n|\r)/gm, ''));
                        $results_wrapper.html($markup);

                        $results_wrapper.animate({
                            background : 'none'
                        }, 400, 'easeInOutQuad');
                    }
                })
                .fail(function(err) {
                    console.error('An error has ocurred:', err);
                });
            });
        }
    }

    // Helper Functions
    // ----------------
    /**
    * Parse queryString to object
    */
    function parseQueryString(queryString) {
        var params = {};
        if(queryString) {
            jQuery.each(jQuery.map(decodeURI(queryString).split(/&/g), function(el,i){
                var aux = el.split('='), o = {};
                if(aux.length >= 1){
                    var val = undefined;
                    if(aux.length == 2)
                        val = aux[1];
                    o[aux[0]] = val;
                }
                return o;
            }), function(index, o) {
                jQuery.extend(params, o);
            });
        }
        return params;
    }

    //Init App Components
    //-----------------------
    $(function() {
        window.initComponent = new InitComponent();
        window.initComponent.initialize();
    });

})(jQuery, this, this.document);
