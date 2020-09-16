$(document).ready(function () {
    $('.share-links').click(function (e) {
        e.preventDefault()
        let id = $(this).data('id')
        $('#comment_id').attr('value', id)
        $('.overlay').css({
            'visibility': 'visible',
            'opacity': '1',
            'z-index': '100',
        })
    })

    $('.close').click(function (e) {
        e.preventDefault()
        $('.overlay').css({
            'visibility': 'hidden',
            'opacity': '0',
            'z-index': '0',
        })
    })

    $(".search-blog-close").click(function(e){
        e.preventDefault()
        $(".row-ajax-s").html('');
        $(".search-modal").fadeOut(100);
    });

    $(".search-blog").click(function() {
        $(".search-modal").fadeIn();
    });
    //Ripple
    let $btnRipple = $('.btn--ripple'),
        $btnRippleInk, btnRippleH, btnRippleX, btnRippleY;
    $btnRipple.on('mouseenter', function (e) {
        let $t = $(this);
        if ($t.find(".btn--ripple-ink").length === 0) {
            $t.prepend("<span class='btn--ripple-ink'></span>");
        }

        $btnRippleInk = $t.find(".btn--ripple-ink");
        $btnRippleInk.removeClass("btn--ripple-animate");
        if (!$btnRippleInk.height() && !$btnRippleInk.width()) {
            btnRippleH = Math.max($t.outerWidth(), $t.outerHeight());
            $btnRippleInk.css({ height: btnRippleH, width: btnRippleH });
        }

        btnRippleX = e.pageX - $t.offset().left - $btnRippleInk.width() / 2;
        btnRippleY = e.pageY - $t.offset().top - $btnRippleInk.height() / 2;
        $btnRippleInk.css({ top: btnRippleY + 'px', left: btnRippleX + 'px' }).addClass("btn--ripple-animate");
    });
    // menu
    $('.menu-button').on('click', function () {
        if ($(this).hasClass('cross')) {
            $('.menuList').css('right', '-400px')
            $(this).removeClass('cross')
        } else {
            $('.menuList').css('right', '0px')
            $(this).addClass('cross')
        }
    })
    $('.menuItems.close_menu').on('click', function (e) {
        e.preventDefault()
        $('.menuList').css('right', '-400px')
        $('.menu-button').removeClass('cross')
    })
    // swiper
    let slider_blog = new Swiper('.slider-blog', {
        navigation: {
            nextEl: '.slider-prev',
            prevEl: '.slider-next',
        },
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        centeredSlides: true,
        breakpoints: {
            // when window width is >= 0
            0: {
                slidesPerGroup: 1,
                slidesPerView: 1,
                spaceBetween: 15
            },
            576: {
                slidesPerGroup: 1,
                slidesPerView: 2,
                spaceBetween: 15
            },
            768: {
                slidesPerGroup: 1,
                slidesPerView: 2.5,
                spaceBetween: 15
            },
            992: {
                slidesPerGroup: 1,
                slidesPerView: 3,
                spaceBetween: 15
            },
            1200: {
                slidesPerGroup: 1,
                slidesPerView: 3.5,
                spaceBetween: 15
            },
        }
    });
    let slider_Blog_Blog = new Swiper('.slider-blog_blog', {
        navigation: {
            nextEl: '.slider-next',
            prevEl: '.slider-prev',
        },
        loop: true,
        centeredSlides: true,
        breakpoints: {
            // when window width is >= 0
            0: {
                slidesPerGroup: 1,
                slidesPerView: 1,
                spaceBetween: 15
            },
            576: {
                slidesPerGroup: 1,
                slidesPerView: 2,
                spaceBetween: 15
            },
            768: {
                slidesPerGroup: 1,
                slidesPerView: 2.5,
                spaceBetween: 15
            },
            992: {
                slidesPerGroup: 1,
                slidesPerView: 3,
                spaceBetween: 15
            },
            1200: {
                slidesPerGroup: 1,
                slidesPerView: 3.5,
                spaceBetween: 15
            },
        }
    });
    let post_blog_slider = new Swiper('.post-blog-page-slider', {
        loop: true,
        // autoplay: {
        //     delay: 5000,
        //     disableOnInteraction: false,
        // },
        centeredSlides: true,
        breakpoints: {
            // when window width is >= 0
            0: {
                slidesPerGroup: 1,
                slidesPerView: 1.7,
                spaceBetween: 15
            },
            576: {
                slidesPerGroup: 1,
                slidesPerView: 3.7,
                spaceBetween: 15
            },
        }
    });
})


function searchInBlogs(event,url) {
    event.preventDefault()
     var token = $('meta[name="_token"]').attr("content");
     // data = ;
     var request = $.post(url, {
         word: $(event.target).find('input#s-blog').val(),
         _token: token
     });
     request.done(function(res) {
         $('.row-ajax-s').html(res);
     });
    
}