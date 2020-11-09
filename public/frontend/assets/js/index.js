$(document).ready(function () {


    $(".overlay").fadeIn();
    $(".lds-ripple").fadeIn();

    $(window).on("load", function () {
        $(".overlay").fadeOut(300)
        $(".lds-ripple").fadeOut(300);

    });


    $('input[name="order_show"]').on('change', function () {
        var token = $('meta[name="_token"]').attr("content");
        var val = $(this).val()
        var c = $(this).data('c')
        var type = $(this).data('type')
        var data = { type: type, val: val, c: c, _token: token }
        var request = $.post(mainUrl + '/showall/changestatus', data);
        request.done(function (res) {
            $(".results").html(res);
            timeout = true;
        });
    })




    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            return this.optional(element) || regexp.test(value);
        },
        "Please check your input."
    );

    $(".loginform").validate({
        rules: {
            mobile: {
                required: true,
                regex: /^09[0-9]{9}$/
            },
            password: {
                required: true,
                minlength: 8,
                regex: /^[a-zA-Z\d]*$/
            }
        },
        messages: {
            password: {
                required: "لطفا رمز عبور خود را وارد نمایید",
                minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
                regex: "پسورد بایستی شامل اعداد و حروف لاتین باشد"
            },
            mobile: {
                required: "لطفا شماره موبایل خود را وارد نمایید",
                regex: "موبایل دارای فرمت نامعتبر می باشد"
            }
        }
    });
    $(".forget-pas").validate({
        rules: {
            mobile: {
                required: true,
                regex: /^09[0-9]{9}$/
            }
        },
        messages: {
            mobile: {
                required: "لطفا شماره موبایل خود را وارد نمایید",
                regex: "موبایل دارای فرمت نامعتبر می باشد"
            }
        }
    });

    $("#registerForm").validate({
        rules: {
            mobile: {
                required: true,
                regex: /^09[0-9]{9}$/
            },
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            password: {
                required: true,
                minlength: 8,
                regex: /^[a-zA-Z\d]*$/
            },
            cpassword: {
                required: true,
                minlength: 8,
                equalTo: "#mainpassword"
            }
        },
        messages: {
            password: {
                required: "لطفا رمز عبور خود را وارد نمایید",
                minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
                regex: "پسورد بایستی شامل اعداد و حروف لاتین باشد"
            },
            cpassword: {
                required: "لطفا رمز عبور خود را وارد نمایید",
                minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
                equalTo: "رمز عبور یکسان نیست"
            },
            fname: {
                required: "نام خود را وارد نمایید"
            },
            lname: {
                required: "نام خانوادگی خود را وارد نمایید"
            },
            mobile: {
                required: "لطفا شماره موبایل خود را وارد نمایید",
                regex: "موبایل دارای فرمت نامعتبر می باشد"
            }
        }
    });

    var rangeSlider = function () {
        var slider = $(".range-slider"),
            range = $(".range-slider__range"),
            value = $(".range-slider__value");

        slider.each(function () {
            value.each(function () {
                var value = $(this)
                    .prev()
                    .attr("value");
                $(this).html(value);
            });

            range.on("input", function () {
                $(this)
                    .next(value)
                    .html(this.value);
            });
        });
    };

    rangeSlider();

    $(".inbox-icon").on("click", function (e) {
        e.preventDefault();
        var el = $(e.target);
        next = el.next(".inbox");
        if (
            $(this)
                .next()
                .hasClass("close")
        ) {
            $(this)
                .next()
                .addClass("open");
            $(this)
                .next()
                .removeClass("close");
        } else {
            $(this)
                .next()
                .addClass("close");
            $(this)
                .next()
                .removeClass("open");
        }
    });

    //Ripple
    let $btnRipple = $(".btn--ripple"),
        $btnRippleInk,
        btnRippleH,
        btnRippleX,
        btnRippleY;
    $btnRipple.on("mouseenter", function (e) {
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
        $btnRippleInk
            .css({ top: btnRippleY + "px", left: btnRippleX + "px" })
            .addClass("btn--ripple-animate");
    });
    // menu
    $(".menu-button").on("click", function () {
        $(".cover-menu").css("display", "block");
        if ($(this).hasClass("cross")) {
            $(".navList").css("right", "-20rem");
            $(this).removeClass("cross");
            $(".navItem.logo")
                .css("transition", "none")
                .css("background-color", "transparent")
                .css("position", "absolute");
            $(".cover-menu").css("display", "none");
            $("#search-box,.buy-subscribe").css("z-index", "90");
            $(".menu-button").css("position", "absolute");
        } else {
            $(".navList").css("right", "0");
            $(this).addClass("cross");
            $(".navItem.logo")
                .css("transition", "1s ease-in-out")
                .css("background-color", "#222327")
                .css("position", "fixed");
            $("#search-box,.buy-subscribe").css("z-index", "20");
            $(".menu-button").css("position", "fixed");
        }
    });
    $(".cover-menu").on("click", function () {
        $(".navList").css("right", "-20rem");
        $(".navItem.logo")
            .css("transition", "none")
            .css("background-color", "transparent")
            .css("position", "absolute");
        $(this).css("display", "none");
        $(".menu-button")
            .removeClass("cross")
            .css("position", "absolute");
        $("#search-box,.buy-subscribe").css("z-index", "90");
    });
    $(window).scroll(function () {
        let currentScrollPos = window.pageYOffset;
        $(window).scroll(function () {
            if (
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                    navigator.userAgent
                )
            ) {
                 $(".siteNav").css("top", "0");
            }else{

                let scroll_get_top = $(document).scrollTop();
                // console.log(currentScrollPos,scroll_get_top)
                if (currentScrollPos > scroll_get_top) {
    
                    $(".siteNav").css("top", "0");
                } else {
                    $(".siteNav,.menu-items-left").css("top", "-20rem");
                }
            }
        });

        let scroll_get = $(document).scrollTop();
        if (scroll_get > 0) {
            $(".siteNav").css({
                backgroundColor: "#000000",
                backgroundImage: "none"
            });
        } else {

            $(".siteNav").css("background-color", "transparent");
            $(".siteNav").css(
                "background-image",
                "linear-gradient(to bottom, rgba(18,18,18,1), rgba(18,18,18,0))"
            );
        }
    });
    //profile dropdown
    // $(".user-login-show").on("click", function() {
    //     let status = $(".profile-dropdown-box").css("display");
    //     if (status === "none") {
    //         $(".profile-dropdown-box").fadeIn(300);
    //     } else {
    //         $(".profile-dropdown-box").hide();
    //     }
    // });
    // search box

    $("#close_search").on("click", function () {
        $(".search-panel").css("display", "none");
    });
    $(".filter-search").on("click", function () {
        let status_filter_box = $(".filter-box").css("display");
        if (status_filter_box === "none") {
            $(".filter-box")
                .slideDown(500)
                .css("display", "flex");
            $(".filter-search .fa-angle-down").css(
                "transform",
                "rotate(180deg)"
            );
        } else {
            $(".filter-box").slideUp(500);
            $(".filter-search .fa-angle-down").css("transform", "rotate(0)");
        }
    });
    $(".menu-filters ul li").on("click", function () {
        let status_show = $(this).css("background-color");
        if (status_show === "rgb(34, 35, 39)") {
            $(this).css("background-color", "#37383e");
            $(this)
                .find(".fa-angle-left")
                .css("transform", "rotate(0)");
        } else {
            $(".menu-filters ul li").css("background-color", "#37383e");
            $(this).css("background-color", "#222327");
            $(".menu-filters ul li .fa-angle-left").css(
                "transform",
                "rotate(0)"
            );
            $(this)
                .find(".fa-angle-left")
                .css("transform", "rotate(-90deg)");
        }
    });
    $(".filter-body-box").css("display", "none");
    $(".genre-box").css("display", "block");
    $("#genre").on("click", function () {
        let status_box_show = $(".genre-box").css("display");
        if (status_box_show === "none") {
            $(".filter-body-box").css("display", "none");
            $(".genre-box").css("display", "block");
        } else {
            $(".genre-box").css("display", "none");
        }
    });
    $("#Country").on("click", function () {
        let status_box_show = $(".ManufacturingCountry-box").css("display");
        if (status_box_show === "none") {
            $(".filter-body-box").css("display", "none");
            $(".ManufacturingCountry-box").css("display", "block");
        } else {
            $(".ManufacturingCountry-box").css("display", "none");
        }
    });
    $("#Sound").on("click", function () {
        let status_box_show = $(".SoundSubtitles-box").css("display");
        if (status_box_show === "none") {
            $(".filter-body-box").css("display", "none");
            $(".SoundSubtitles-box").css("display", "block");
        } else {
            $(".SoundSubtitles-box").css("display", "none");
        }
    });
    $("#Construction").on("click", function () {
        let status_box_show = $(".YearConstruction-box").css("display");
        if (status_box_show === "none") {
            $(".filter-body-box").css("display", "none");
            $(".YearConstruction-box").css("display", "block");
        } else {
            $(".YearConstruction-box").css("display", "none");
        }
    });
    $("#Order").on("click", function () {
        let status_box_show = $(".OrderConstruction-box").css("display");
        if (status_box_show === "none") {
            $(".filter-body-box").css("display", "none");
            $(".OrderConstruction-box").css("display", "block");
        } else {
            $(".OrderConstruction-box").css("display", "none");
        }
    });

    var timeout = true;
    var delay = 1000; // 2 seconds

    $("#search-input").on("keyup", function () {
        if (timeout) {
            timeout = false;
            setTimeout(() => {
                arr = [];
                let val = $(this).val();
                let url = $(this).data("url");
                arr.push({ type: "word", key: val });

                var token = $('meta[name="_token"]').attr("content");

                PostData({ data: arr, _token: token }, url);
            }, 1000);
        }
    });

    $(".checkbox-place input").on("click", function () {
        arr = [];
        let val_filter = $(this).val();
        let id_filter = $(this).attr("id");

        let url = $(this).data("url");

        var token = $('meta[name="_token"]').attr("content");

        $("input.filter:checked").each(function () {
            let id = $(this).data("id");
            let type = $(this).data("type");
            arr.push({ type, id });
        });

        arr.push({
            type: "order",
            name: $('input[name="order"]:checked').val()
        });
        PostData({ data: arr, _token: token }, url);

        if ($(this).attr("name") !== "order") {
            if ($(this).prop("checked") === true) {
                $(".filter-place-elements").append(
                    "<span id=" +
                    id_filter +
                    " class='filter-place-box_new-filter'>" +
                    val_filter +
                    " <i class='fa fa-times'></i></span>"
                );
            } else if ($(this).prop("checked") === false) {
                $(".filter-place-elements span" + "#" + id_filter).remove();
            }
            if ($(".filter_all_delete").length) {
                if ($(".filter-place-elements span").length) {
                } else {
                    $(".filter_all_delete").remove();
                }
            } else {
                $(".filter-delete-place").append(
                    "<div class='filter_all_delete'>حذف همه فیلتر ها</div>"
                );
            }
        }
    });

    $(".range-slider__range").change(function () {
        arr = [];
        let year = $(this).val();

        arr.push({ type: "year", year: year });
        let url = $(this).data("url");
        var token = $('meta[name="_token"]').attr("content");
        $("input.filter:checked").each(function () {
            let id = $(this).data("id");
            let type = $(this).data("type");
            arr.push({ type, id });
        });
        arr.push({
            type: "order",
            name: $('input[name="order"]').val()
        });

        PostData({ data: arr, _token: token }, url);
    });

    function PostData(data, url) {
        setTimeout(() => {
            var request = $.post(url, data);
            request.done(function (res) {
                $(".results").html(res);
                timeout = true;
            });
        }, 1000);
    }

    function SendData() {
        arr = [];
        $("input.filter:checked").each(function () {
            let id = $(this).data("id");
            let type = $(this).data("type");
            arr.push({ type, id });
        });

        arr.push({
            type: "order",
            name: $('input[name="order"]:checked').val()
        });
        var token = $('meta[name="_token"]').attr("content");
        var url = $(".range-slider__range").data("url");
        PostData({ data: arr, _token: token }, url);
    }

    $(".filter-place-box").on("mouseenter", function () {
        $(".filter-place-box_new-filter svg").on("click", function () {
            if ($(".filter-place-elements span").length) {
                let get_id = $(this)
                    .parent()
                    .attr("id");
                $(".checkbox-place input#" + get_id).prop("checked", false);
                $(this)
                    .parent()
                    .remove();
                if ($(".filter-place-elements span").length === 0) {
                    $(".filter_all_delete").remove();
                    $(".checkbox-place input").prop("checked", false);
                }
                SendData();
            }
        });
        $(".filter_all_delete").on("click", function () {
            $(".filter-place-elements span").remove();
            $(this).remove();
            $(".checkbox-place input").prop("checked", false);
            SendData();
        });
    });
    // login and register page
    $(".login-form-load").on("click", function () {
        $("#registerForm").css("display", "none");
        $(".forget-pas").css("display", "none");
        $("#loginForm").css("display", "block");
    });
    $(".register-form-load").on("click", function () {
        $("#loginForm").css("display", "none");
        $(".forget-pas").css("display", "none");
        $("#registerForm").css("display", "block");
    });
    $(".forget-pass").on("click", function () {
        $("#loginForm").css("display", "none");
        $("#registerForm").css("display", "none");
        $(".forget-pas").css("display", "block");
    });

    $(".changeMood").on("click", function () {
        let status_text = $(this).text();
        if (status_text === "ورود از طریق ایمیل") {
            $(this).text("ورود از طریق شماره تلفن همراه");
            $("#Mobile + label").text("ایمیل");
            $("#Mobile").attr("placeholder", "example@example.mail");
            $("#loginForm h1").text("ورود از طریق ایمیل");
            $("#loginForm h3").text(
                "لطفا ایمیل خود و رمز عبور را وارد فرمایید"
            );
        } else {
            $(this).text("ورود از طریق ایمیل");
            $("#Mobile + label").text("شماره تلفن همراه");
            $("#Mobile").attr("placeholder", "+98**********");
            $("#loginForm h1").text("ورود از طرق شماره تلفن همراه");
            $("#loginForm h3").text(
                "لطفا شماره تلفن خود و رمز عبور را وارد نمایید"
            );
        }
    });
    //
    // Season movie
    $(".Season-select").on("click", function () {
        let status = $(".movie-Season-box").css("display");
        if (status === "none") {
            $(".movie-Season-box").fadeIn(200);
        } else {
            $(".movie-Season-box").fadeOut(250);
        }
    });
    // site sharing
    $(".choosePlane").on("click", function (e) {
        e.preventDefault();
        let plan_choose_day = $(this)
            .parent()
            .parent()
            .find(".plan-length")
            .text();
        let id = $(this).data("id");
        $('input[name="plan_name"]').val(id);
        let plan_choose_price = $(this)
            .parent()
            .parent()
            .find(".after-off")
            .text();

        $(".buy-sharing-plan").css("display", "block");
        $(".buy-sharing-plan-box h1").text(plan_choose_day);
        $(".price-plan_price").text(plan_choose_price);
        $("#pay_price").text(plan_choose_price);

    });
    $("#close_buy-plan-box").on("click", function (e) {
        e.preventDefault();
        $(".buy-sharing-plan").css("display", "none");
    });
    //profile change
    $(".edit-account-name").on("click", function () {
        $(".user-profile-change").css("display", "block");
        $(".user-detail-change-box").css("display", "block");
    });
    $(".change_pass_user").on("click", function () {
        $(".user-profile-change").css("display", "block");
        $(".user-change-pass-box").css("display", "block");
    });
    $(".user-detail-change-box .fa-times,.user-change-pass-box .fa-times").on(
        "click",
        function () {
            $(this)
                .parent()
                .css("display", "none");
            $(".user-profile-change").css("display", "none");
        }
    );

    // swiper
    var swiper = new Swiper(".header-slider", {
        effect: "fade",
        navigation: {
            nextEl: ".next-header-slide",
            prevEl: ".prev-header-slide"
        },
        pagination: {
            el: ".swiper-pagination"
        },
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        }
    });
    //top slider
    var swiper = new Swiper(".TopSlider", {
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        breakpoints: {
            // when window width is >= 0
            0: {
                slidesPerGroup: 1,
                slidesPerView: 1.1,
                spaceBetween: 15
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 3.3,
                spaceBetween: 20
            },
            992: {
                slidesPerView: 3.2,
                spaceBetween: 30
            },
            1400: {
                slidesPerView: 3.4,
                spaceBetween: 30
            }
        }
    });
    var swiper = new Swiper(".mobile-slider", {
        spaceBetween: 30,
        effect: "fade",
        speed: 500,
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        }
    });


    var swiper = new Swiper(".BlogSlider", {
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        breakpoints: {
            // when window width is >= 0
            0: {
                slidesPerGroup: 2,
                slidesPerView: 1,
                spaceBetween: 15
            },
            400: {
                slidesPerGroup: 2,
                slidesPerView: 1,
                spaceBetween: 15
            },
            576: {
                slidesPerView: 2.5,
                spaceBetween: 20
            },
            768: {
                slidesPerGroup: 4,
                slidesPerView: 4.4,
                spaceBetween: 20
            },
            1200: {
                slidesPerGroup: 5,
                slidesPerView: 5,
                spaceBetween: 20
            }
        }
    });

    var swiper = new Swiper(".CollectionSlider", {
        slidesPerGroup: 1,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        breakpoints: {
            // when window width is >= 0
            0: {
                slidesPerGroup: 1,
                slidesPerView: 1,
                spaceBetween: 15
            },
            400: {
                slidesPerGroup: 1,
                slidesPerView: 1,
                spaceBetween: 15
            },
            576: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            768: {
                slidesPerGroup: 4,
                slidesPerView: 4.4,
                spaceBetween: 20
            },
            1200: {
                slidesPerGroup: 5,
                slidesPerView: 5.4,
                spaceBetween: 20
            }
        }
    });

    //iran news
    var swiper = new Swiper(".IranNews", {
        slidesPerGroup: 2,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        breakpoints: {
            // when window width is >= 0
            0: {
                slidesPerGroup: 2,
                slidesPerView: 2,
                spaceBetween: 15
            },
            400: {
                slidesPerGroup: 2,
                slidesPerView: 2,
                spaceBetween: 15
            },
            576: {
                slidesPerView: 5.3,
                spaceBetween: 20
            },
            768: {
                slidesPerGroup: 4,
                slidesPerView: 5.4,
                spaceBetween: 20
            },
            1200: {
                slidesPerGroup: 5,
                slidesPerView: 6.4,
                spaceBetween: 20
            }
        }
    });
});

$(document).click(function (e) {
    if (
        $(e.target).closest(".user-login-show").length == 0 &&
        $(e.target).closest(".profile-dropdown-box").length == 0
    ) {
        $(".profile-dropdown-box").hide();
    }

    if (
        $(e.target).closest(".inbox-icon").length == 0 &&
        $(e.target).closest(".inbox").length == 0
    ) {
        $(".inbox").removeClass("open");
        $(".inbox").addClass("close");
    }
});

var prev_id = 0;
function showDetails(event, id, url) {
    if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
            navigator.userAgent
        )
    ) {
        return true;
    }
    event.preventDefault();
    let detailbox = $(event.target)
        .parents(".swiper-container")
        .next(".movie-detail-show_index");
    if (id === prev_id) {
        if (detailbox.css("display") == "block") {
            detailbox.hide();
        } else {
            detailbox.fadeIn(300);
        }
    } else {
        $(".lds-ripple").fadeIn();
        prev_id = id;
        // ajax call
        var token = $('meta[name="_token"]').attr("content");
        var request = $.post(url, { id: id, _token: token });
        request.done(function (res) {
            // console.log(res);
            $(".lds-ripple").fadeOut();
            detailbox.css({
                background: "url(" + res.poster + ")",
                "background-size": "570px",
                "background-repeat": "no-repeat",
                "background-position": "0 0"
            });
            detailbox.find("h1").text(res.title);
            detailbox.find(".desc").html(res.desc);
            const Stars = res.stars.map((item, index) => {
                return `<span>${item} &nbsp;&nbsp;</span> `;
            });
            joinStars = Stars.join("");
            detailbox.find(".stars").html(joinStars);

            const Categories = Object.entries(res.category).map(
                ([k, v]) =>
                    `<a href="${mainUrl}/showall?c=${k.toLowerCase()}&type=all">${v} &nbsp;&nbsp;</a> `
            );
            //  console.log(Categories)
            joinCat = Categories.join("");
            detailbox.find(".categories").html(joinCat);

            if (res.age_rate) {
                detailbox.find(".age-rate")
                    .html(`<span style="background: #ff7600cc;
                            margin-top: 1rem;
                            display: inline-block;
                            padding: 3px;
                            border-radius: 4px;">${res.age_rate}</span>`);
            }


            if (res.favoritestatus) {
                favoriteHtml = `<a href="#" style="background:#007bff" onclick="addToFavorite(event,'${res.id}','${res.favoritepath}')" title="افزودن به علاقه مندی" class="more-detail-movie btn--ripple">
                        <i class="fa fa-check"></i>
                       
                    </a>`;
            } else {
                favoriteHtml = `<a href="#" onclick="addToFavorite(event,'${res.id}','${res.favoritepath}')" title="افزودن به علاقه مندی" class="more-detail-movie btn--ripple">
                        <i class="fa fa-plus"></i>
                       
                    </a>`;
            }
            if (res.type == "movies") {
                detailbox.find(".links").html(`
                 <a href="${res.play}" class="page-movie-play btn--ripple mr-0 mt-5">
                        <i class="fa fa-play"></i>
                        پخش فیلم
                    </a>
                     <a href="${res.download}" data-id="${res.id}" onclick="call(event)"  class="page-movie-download btn--ripple mr-0 mt-5">  
                        دانلود
                    </a>
                    
                   
                <a href="${res.path}" class="more-detail-movie btn--ripple mr-0">
                        <i class="fa fa-exclamation"></i>
                        توضیحات بیشتر
                    </a>
                    ${favoriteHtml}
                     
                `);
            } else {
                detailbox.find(".links").html(`
            
                <a href="${res.path}" class="more-detail-movie btn--ripple mr-0">
                        <i class="fa fa-exclamation"></i>
                     مشاهده و توضیحات بیشتر
                    </a>
                     ${favoriteHtml}
                `);
            }

            detailbox.fadeIn(300);
            $("body,html").animate(
                {
                    scrollTop: $(detailbox).offset().top
                },
                400 //speed
            );
        });
        // end ajax call
    }
}

function getComments(event, url) {
    event.preventDefault();
    $(".overlay").fadeIn();
    $(".lds-ripple").fadeIn();
    $(event.target).on("click", false);
    var data = $(event.target).data("data");

    var token = $('meta[name="_token"]').attr("content");
    // data = ;
    var request = $.post(url, { data: data, _token: token });
    request.done(function (res) {
        $("#comments").append(res.data);
        $(".lds-ripple").fadeOut();
        $(".overlay").fadeOut();
    });
}

function checkTakhfif(event, url) {
    event.preventDefault();
    var code = $("#off_code").val();
    var plan_id = $("#plan_name").val();
    if (code.length) {
        var token = $('meta[name="_token"]').attr("content");
        // data = ;
        var request = $.post(url, {
            code: code,
            plan_id: plan_id,
            _token: token
        });
        request.done(function (res) {
            if (res.error) {
                alert(res.data);
            }
            if (!res.error) {
                $("#submit-off_code").addClass("bg-success");
                $("#pay_price").text(res.data);
            }
        });
    }
}

function downLoad(event, url) {
    event.preventDefault();
    var token = $('meta[name="_token"]').attr("content");
    // data = ;
    var request = $.get(url, {
        _token: token
    });
    request.done(function (res) {
        if (res.data == "error") {
            window.location.href = res.redirect;
        }
    });
}

function addToFavorite(event, id, url) {
    event.preventDefault();
    var el = $(event.target);
    var token = $('meta[name="_token"]').attr("content");

    var request = $.post(url, {
        post_id: id,
        _token: token
    });
    request.done(function (res) {
        if (res == "attach") {
            el.html('<i class="fa fa-check"></i>');
            el.css("background-color", "#007bff");
        } else {
            el.html('<i class="fa fa-plus"></i> افزودن به لیست');
            el.css("background-color", "transparent");
        }
    });
}

function showImage(event) {
    event.preventDefault();
    var src = $(event.target).attr("src");
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = src;
    captionText.innerHTML = this.alt;
}

function closeImage(event) {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

function call(e) {
    e.preventDefault();
    var id = $(event.target)
        .closest("a")
        .data("id");
    var episode = $(event.target)
        .closest("a")
        .data("episode");
    var token = $('meta[name="_token"]').attr("content");
    var jbox = new jBox("Modal", {
        attach: ".openModal",
        minWidth: 300,
        ajax: {
            type: "POST",
            url: mainUrl + "/getdownloadlinks",
            data: {
                id: id,
                episode: episode,
                _token: token
            },
            reload: "strict",
            setContent: false,
            success: function (response) {
                this.setContent(response);
            },
            error: function () {
                this.setContent(
                    '<b style="color: #d33">Error loading content.</b>'
                );
            }
        }
    });
    jbox.open();
}

function likepost(event, id, status) {
    event.preventDefault();
    var token = $('meta[name="_token"]').attr("content");
    var url = mainUrl + "/likepost";
    var request = $.post(url, {
        post_id: id,
        status: status,
        _token: token
    });
    request.done(function (res) {
        if (res.status == 1) {
            $(".like-icon").html(`
        <div title="" role="button" aria-label="animation" tabindex="0" style="width: 100%; height: 100%; overflow: hidden; margin: 0px auto; outline: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40" preserveAspectRatio="xMidYMid slice" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px);"><defs><clipPath id="__lottie_element_7"><rect width="40" height="40" x="0" y="0"></rect></clipPath></defs><g clip-path="url(#__lottie_element_7)"><g transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,19.910999298095703,19.000999450683594)"><path fill="rgb(255,255,255)" fill-opacity="1" d=" M-12.197999954223633,1.0759999752044678 C-12.197999954223633,1.0759999752044678 -9.713000297546387,9.647000312805176 -9.713000297546387,9.647000312805176 C-9.032999992370605,11.96500015258789 -6.910999774932861,13.560999870300293 -4.494999885559082,13.569999694824219 C-4.494999885559082,13.569999694824219 1.065000057220459,13.569999694824219 1.065000057220459,13.569999694824219 C2.3340001106262207,13.569000244140625 3.562000036239624,13.125 4.538000106811523,12.314000129699707 C4.538000106811523,12.314000129699707 5.752999782562256,11.303999900817871 5.752999782562256,11.303999900817871 C6.672999858856201,10.539999961853027 7.830999851226807,10.121000289916992 9.027000427246094,10.119999885559082 C9.027000427246094,10.119999885559082 9.982999801635742,10.119999885559082 9.982999801635742,10.119999885559082 C11.394000053405762,10.118000030517578 12.538000106811523,8.975000381469727 12.539999961853027,7.563000202178955 C12.539999961853027,7.563000202178955 12.539999961853027,-1.312999963760376 12.539999961853027,-1.312999963760376 C12.538000106811523,-2.7239999771118164 11.394000053405762,-3.868000030517578 9.982999801635742,-3.869999885559082 C7.447000026702881,-3.869999885559082 0.6610000133514404,-4.96999979019165 -0.26499998569488525,-9.98799991607666 C-0.8790000081062317,-13.312000274658203 -2.9649999141693115,-13.569999694824219 -3.5869998931884766,-13.569999694824219 C-3.750999927520752,-13.569999694824219 -3.9149999618530273,-13.555000305175781 -4.076000213623047,-13.527000427246094 C-5.8429999351501465,-13.173999786376953 -7,-11.470000267028809 -6.676000118255615,-9.697999954223633 C-6.676000118255615,-9.697999954223633 -5.644000053405762,-3.869999885559082 -5.644000053405762,-3.869999885559082 C-5.644000053405762,-3.869999885559082 -8.472999572753906,-3.869999885559082 -8.472999572753906,-3.869999885559082 C-9.694000244140625,-3.875999927520752 -10.843999862670898,-3.302000045776367 -11.572999954223633,-2.3239998817443848 C-12.307999610900879,-1.3539999723434448 -12.539999961853027,-0.09200000017881393 -12.197999954223633,1.0759999752044678z"></path></g><g opacity="1" transform="matrix(1,0,0,1,19.905000686645508,19.000999450683594)"><path fill="rgb(255,255,255)" fill-opacity="1" d=" M-9.713000297546387,9.64799976348877 C-9.034000396728516,11.965999603271484 -6.910999774932861,13.562000274658203 -4.494999885559082,13.569999694824219 C-4.494999885559082,13.569999694824219 1.065000057220459,13.569999694824219 1.065000057220459,13.569999694824219 C2.3329999446868896,13.569000244140625 3.562999963760376,13.125 4.538000106811523,12.314000129699707 C4.538000106811523,12.314000129699707 5.752999782562256,11.305000305175781 5.752999782562256,11.305000305175781 C6.672999858856201,10.541000366210938 7.830999851226807,10.121000289916992 9.026000022888184,10.119999885559082 C9.026000022888184,10.119999885559082 9.982999801635742,10.119999885559082 9.982999801635742,10.119999885559082 C11.395000457763672,10.118000030517578 12.538000106811523,8.97599983215332 12.539999961853027,7.564000129699707 C12.539999961853027,7.564000129699707 12.539999961853027,-1.312000036239624 12.539999961853027,-1.312000036239624 C12.538000106811523,-2.7239999771118164 11.395000457763672,-3.86899995803833 9.982999801635742,-3.869999885559082 C7.447000026702881,-3.869999885559082 0.6610000133514404,-4.96999979019165 -0.26499998569488525,-9.98799991607666 C-0.8790000081062317,-13.312000274658203 -2.9649999141693115,-13.569999694824219 -3.5869998931884766,-13.569999694824219 C-3.750999927520752,-13.569999694824219 -3.9140000343322754,-13.555999755859375 -4.076000213623047,-13.527000427246094 C-5.8429999351501465,-13.173999786376953 -7,-11.468999862670898 -6.676000118255615,-9.696999549865723 C-6.676000118255615,-9.696999549865723 -5.644000053405762,-3.869999885559082 -5.644000053405762,-3.869999885559082 C-5.644000053405762,-3.869999885559082 -8.472999572753906,-3.869999885559082 -8.472999572753906,-3.869999885559082 C-9.692999839782715,-3.875999927520752 -10.843999862670898,-3.302999973297119 -11.572999954223633,-2.3239998817443848 C-12.309000015258789,-1.3539999723434448 -12.539999961853027,-0.09099999815225601 -12.197999954223633,1.0770000219345093 C-12.197999954223633,1.0770000219345093 -9.713000297546387,9.64799976348877 -9.713000297546387,9.64799976348877z M-10.267000198364258,-1.3530000448226929 C-9.843999862670898,-1.9220000505447388 -9.175999641418457,-2.25600004196167 -8.467000007629395,-2.253000020980835 C-8.467000007629395,-2.253000020980835 -3.6989998817443848,-2.253000020980835 -3.6989998817443848,-2.253000020980835 C-3.6989998817443848,-2.253000020980835 -5.067999839782715,-9.982000350952148 -5.067999839782715,-9.982000350952148 C-5.248000144958496,-10.871999740600586 -4.679999828338623,-11.741999626159668 -3.7929999828338623,-11.934000015258789 C-2.881999969482422,-12.093000411987305 -2.1470000743865967,-11.234000205993652 -1.8619999885559082,-9.701000213623047 C-1.3619999885559082,-7.000999927520752 0.5109999775886536,-4.882999897003174 3.559999942779541,-3.5789999961853027 C5.60099983215332,-2.742000102996826 7.7779998779296875,-2.2899999618530273 9.982999801635742,-2.250999927520752 C10.498000144958496,-2.25 10.913999557495117,-1.8339999914169312 10.914999961853027,-1.3200000524520874 C10.914999961853027,-1.3200000524520874 10.914999961853027,7.557000160217285 10.914999961853027,7.557000160217285 C10.913999557495117,8.071000099182129 10.498000144958496,8.487000465393066 9.982999801635742,8.48799991607666 C9.982999801635742,8.48799991607666 9.027000427246094,8.48799991607666 9.027000427246094,8.48799991607666 C7.452000141143799,8.48900032043457 5.927000045776367,9.041000366210938 4.715000152587891,10.04800033569336 C4.715000152587891,10.04800033569336 3.5,11.059000015258789 3.5,11.059000015258789 C2.815999984741211,11.626999855041504 1.9550000429153442,11.939000129699707 1.065999984741211,11.939000129699707 C1.065999984741211,11.939000129699707 -4.489999771118164,11.939000129699707 -4.489999771118164,11.939000129699707 C-6.183000087738037,11.932999610900879 -7.670000076293945,10.814000129699707 -8.145999908447266,9.189000129699707 C-8.145999908447266,9.189000129699707 -10.625,0.6200000047683716 -10.625,0.6200000047683716 C-10.824000358581543,-0.0560000017285347 -10.690999984741211,-0.7850000262260437 -10.267999649047852,-1.3480000495910645 C-10.267999649047852,-1.3480000495910645 -10.267000198364258,-1.3530000448226929 -10.267000198364258,-1.3530000448226929z"></path></g></g></g></svg></div>
        `);
            $(".dislike-icon")
                .html(`<div title="" role="button" aria-label="animation" tabindex="0" style="width: 100%; height: 100%; overflow: hidden; margin: 0px auto; outline: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40" preserveAspectRatio="xMidYMid slice" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px);">
                        <defs>
                            <clipPath id="__lottie_element_20">
                                <rect width="40" height="40" x="0" y="0"></rect>
                            </clipPath>
                        </defs>
                        <g clip-path="url(#__lottie_element_20)">
                            <g transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;">
                                <g opacity="1" transform="matrix(0,0,0,0,20.089000701904297,21)">
                                    <path fill="rgb(255,255,255)" fill-opacity="1" d=" M9.864999771118164,-2.624000072479248 C9.864999771118164,-3.5399999618530273 9.741000175476074,-4.427000045776367 9.508999824523926,-5.269999980926514 C9.277000427246094,-6.11299991607666 8.937999725341797,-6.910999774932861 8.505999565124512,-7.6479997634887695 C8.074000358581543,-8.385000228881836 7.548999786376953,-9.062000274658203 6.948999881744385,-9.661999702453613 C6.348999977111816,-10.26200008392334 5.671999931335449,-10.786999702453613 4.934999942779541,-11.218999862670898 C4.197999954223633,-11.651000022888184 3.4000000953674316,-11.989999771118164 2.556999921798706,-12.222000122070312 C1.7139999866485596,-12.454000473022461 0.8270000219345093,-12.57800006866455 -0.08900000154972076,-12.57800006866455 C-1.4630000591278076,-12.57800006866455 -2.7720000743865967,-12.300000190734863 -3.9630000591278076,-11.795999526977539 C-5.1539998054504395,-11.291999816894531 -6.22599983215332,-10.562999725341797 -7.126999855041504,-9.661999702453613 C-8.027999877929688,-8.76099967956543 -8.756999969482422,-7.689000129699707 -9.26099967956543,-6.498000144958496 C-9.765000343322754,-5.307000160217285 -10.043000221252441,-3.997999906539917 -10.043000221252441,-2.624000072479248 C-10.043000221252441,-1.25 -9.765000343322754,0.05900000035762787 -9.26099967956543,1.25 C-8.756999969482422,2.440999984741211 -8.027999877929688,3.513000011444092 -7.126999855041504,4.414000034332275 C-6.22599983215332,5.315000057220459 -5.1539998054504395,6.043000221252441 -3.9630000591278076,6.546999931335449 C-2.7720000743865967,7.051000118255615 -1.4630000591278076,7.328999996185303 -0.08900000154972076,7.328999996185303 C1.284999966621399,7.328999996185303 2.5940001010894775,7.051000118255615 3.7850000858306885,6.546999931335449 C4.97599983215332,6.043000221252441 6.047999858856201,5.315000057220459 6.948999881744385,4.414000034332275 C7.849999904632568,3.513000011444092 8.579000473022461,2.440999984741211 9.083000183105469,1.25 C9.586999893188477,0.05900000035762787 9.864999771118164,-1.25 9.864999771118164,-2.624000072479248z">
                                    </path>
                                </g>
                                <g opacity="1" transform="matrix(1,0,0,1,20.0939998626709,21)">
                                    <path fill="rgb(255,255,255)" fill-opacity="1" d=" M9.713000297546387,-9.64799976348877 C9.034000396728516,-11.965999603271484 6.9120001792907715,-13.562000274658203 4.495999813079834,-13.569999694824219 C4.495999813079834,-13.569999694824219 -1.065000057220459,-13.569999694824219 -1.065000057220459,-13.569999694824219 C-2.3329999446868896,-13.569000244140625 -3.562000036239624,-13.12600040435791 -4.5370001792907715,-12.3149995803833 C-4.5370001792907715,-12.3149995803833 -5.752999782562256,-11.305000305175781 -5.752999782562256,-11.305000305175781 C-6.671999931335449,-10.541000366210938 -7.829999923706055,-10.121999740600586 -9.026000022888184,-10.121000289916992 C-9.026000022888184,-10.121000289916992 -9.982000350952148,-10.121000289916992 -9.982000350952148,-10.121000289916992 C-11.394000053405762,-10.119000434875488 -12.538000106811523,-8.975000381469727 -12.539999961853027,-7.564000129699707 C-12.539999961853027,-7.564000129699707 -12.539999961853027,1.312000036239624 -12.539999961853027,1.312000036239624 C-12.538000106811523,2.7239999771118164 -11.394000053405762,3.868000030517578 -9.982000350952148,3.869999885559082 C-7.446000099182129,3.869999885559082 -0.6600000262260437,4.968999862670898 0.26600000262260437,9.98799991607666 C0.8799999952316284,13.310999870300293 2.9649999141693115,13.569999694824219 3.5869998931884766,13.569999694824219 C3.750999927520752,13.569999694824219 3.9149999618530273,13.555000305175781 4.077000141143799,13.527000427246094 C5.8429999351501465,13.17300033569336 7,11.468999862670898 6.676000118255615,9.697999954223633 C6.676000118255615,9.697999954223633 5.644999980926514,3.869999885559082 5.644999980926514,3.869999885559082 C5.644999980926514,3.869999885559082 8.473999977111816,3.869999885559082 8.473999977111816,3.869999885559082 C9.694000244140625,3.875 10.843999862670898,3.302000045776367 11.574000358581543,2.3239998817443848 C12.309000015258789,1.3530000448226929 12.539999961853027,0.09099999815225601 12.199000358581543,-1.0770000219345093 C12.199000358581543,-1.0770000219345093 9.713000297546387,-9.64799976348877 9.713000297546387,-9.64799976348877z M10.267999649047852,1.3519999980926514 C9.845000267028809,1.9210000038146973 9.175999641418457,2.255000114440918 8.467000007629395,2.252000093460083 C8.467000007629395,2.252000093460083 3.700000047683716,2.252000093460083 3.700000047683716,2.252000093460083 C3.700000047683716,2.252000093460083 5.068999767303467,9.982000350952148 5.068999767303467,9.982000350952148 C5.248000144958496,10.871999740600586 4.679999828338623,11.741000175476074 3.7929999828338623,11.932999610900879 C2.881999969482422,12.092000007629395 2.1480000019073486,11.232999801635742 1.8630000352859497,9.701000213623047 C1.3630000352859497,7 -0.5099999904632568,4.881999969482422 -3.559999942779541,3.5789999961853027 C-5.599999904632568,2.740999937057495 -7.7779998779296875,2.2899999618530273 -9.982999801635742,2.250999927520752 C-10.498000144958496,2.25 -10.913999557495117,1.8329999446868896 -10.914999961853027,1.3200000524520874 C-10.914999961853027,1.3200000524520874 -10.914999961853027,-7.557000160217285 -10.914999961853027,-7.557000160217285 C-10.913999557495117,-8.071000099182129 -10.496999740600586,-8.487000465393066 -9.982999801635742,-8.48799991607666 C-9.982999801635742,-8.48799991607666 -9.027000427246094,-8.48799991607666 -9.027000427246094,-8.48799991607666 C-7.452000141143799,-8.48900032043457 -5.926000118255615,-9.041000366210938 -4.714000225067139,-10.04800033569336 C-4.714000225067139,-10.04800033569336 -3.5,-11.059000015258789 -3.5,-11.059000015258789 C-2.815000057220459,-11.626999855041504 -1.9550000429153442,-11.937999725341797 -1.065000057220459,-11.939000129699707 C-1.065000057220459,-11.939000129699707 4.491000175476074,-11.939000129699707 4.491000175476074,-11.939000129699707 C6.183000087738037,-11.932999610900879 7.670000076293945,-10.8149995803833 8.147000312805176,-9.1899995803833 C8.147000312805176,-9.1899995803833 10.625,-0.6209999918937683 10.625,-0.6209999918937683 C10.824999809265137,0.054999999701976776 10.692000389099121,0.7850000262260437 10.269000053405762,1.347000002861023 C10.269000053405762,1.347000002861023 10.267999649047852,1.3519999980926514 10.267999649047852,1.3519999980926514z">
                                    </path>
                                </g>
                            </g>
                        </g>
                    </svg></div>`);
        } else {
            $(".like-icon")
                .html(`<div title="" role="button" aria-label="animation" tabindex="0" style="width: 100%; height: 100%; overflow: hidden; margin: 0px auto; outline: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40" preserveAspectRatio="xMidYMid slice" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px);">
                        <defs>
                            <clipPath id="__lottie_element_58">
                                <rect width="40" height="40" x="0" y="0"></rect>
                            </clipPath>
                        </defs>
                        <g clip-path="url(#__lottie_element_58)">
                            <g transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;">
                                <g opacity="1" transform="matrix(0.0000034119582323910436,0,0,0.0000034119582323910436,19.910999298095703,19.000999450683594)">
                                    <path fill="rgb(255,255,255)" fill-opacity="1" d=" M-10.095999717712402,2.884000062942505 C-10.095999717712402,3.799999952316284 -9.972000122070312,4.686999797821045 -9.739999771118164,5.53000020980835 C-9.508000373840332,6.373000144958496 -9.168999671936035,7.171000003814697 -8.737000465393066,7.9079999923706055 C-8.305000305175781,8.645000457763672 -7.781000137329102,9.321999549865723 -7.181000232696533,9.92199993133545 C-6.580999851226807,10.522000312805176 -5.9039998054504395,11.04699993133545 -5.166999816894531,11.479000091552734 C-4.429999828338623,11.91100025177002 -3.631999969482422,12.25 -2.7890000343322754,12.482000350952148 C-1.9459999799728394,12.71399974822998 -1.059000015258789,12.838000297546387 -0.14300000667572021,12.838000297546387 C1.2309999465942383,12.838000297546387 2.5399999618530273,12.5600004196167 3.7309999465942383,12.055999755859375 C4.921999931335449,11.552000045776367 5.99399995803833,10.822999954223633 6.894999980926514,9.92199993133545 C7.796000003814697,9.020999908447266 8.524999618530273,7.948999881744385 9.029000282287598,6.757999897003174 C9.532999992370605,5.566999912261963 9.810999870300293,4.257999897003174 9.810999870300293,2.884000062942505 C9.810999870300293,1.5099999904632568 9.532999992370605,0.20100000500679016 9.029000282287598,-0.9900000095367432 C8.524999618530273,-2.180999994277954 7.796000003814697,-3.253000020980835 6.894999980926514,-4.1539998054504395 C5.99399995803833,-5.054999828338623 4.921999931335449,-5.783999919891357 3.7309999465942383,-6.288000106811523 C2.5399999618530273,-6.791999816894531 1.2309999465942383,-7.070000171661377 -0.14300000667572021,-7.070000171661377 C-1.5169999599456787,-7.070000171661377 -2.8259999752044678,-6.791999816894531 -4.017000198364258,-6.288000106811523 C-5.208000183105469,-5.783999919891357 -6.28000020980835,-5.054999828338623 -7.181000232696533,-4.1539998054504395 C-8.081999778747559,-3.253000020980835 -8.8100004196167,-2.180999994277954 -9.314000129699707,-0.9900000095367432 C-9.817999839782715,0.20100000500679016 -10.095999717712402,1.5099999904632568 -10.095999717712402,2.884000062942505z">
                                    </path>
                                </g>
                                <g opacity="1" transform="matrix(1,0,0,1,19.905000686645508,19.000999450683594)">
                                    <path fill="rgb(255,255,255)" fill-opacity="1" d=" M-9.713000297546387,9.64799976348877 C-9.034000396728516,11.965999603271484 -6.910999774932861,13.562000274658203 -4.494999885559082,13.569999694824219 C-4.494999885559082,13.569999694824219 1.065000057220459,13.569999694824219 1.065000057220459,13.569999694824219 C2.3329999446868896,13.569000244140625 3.562999963760376,13.125 4.538000106811523,12.314000129699707 C4.538000106811523,12.314000129699707 5.752999782562256,11.305000305175781 5.752999782562256,11.305000305175781 C6.672999858856201,10.541000366210938 7.830999851226807,10.121000289916992 9.026000022888184,10.119999885559082 C9.026000022888184,10.119999885559082 9.982999801635742,10.119999885559082 9.982999801635742,10.119999885559082 C11.395000457763672,10.118000030517578 12.538000106811523,8.97599983215332 12.539999961853027,7.564000129699707 C12.539999961853027,7.564000129699707 12.539999961853027,-1.312000036239624 12.539999961853027,-1.312000036239624 C12.538000106811523,-2.7239999771118164 11.395000457763672,-3.86899995803833 9.982999801635742,-3.869999885559082 C7.447000026702881,-3.869999885559082 0.6610000133514404,-4.96999979019165 -0.26499998569488525,-9.98799991607666 C-0.8790000081062317,-13.312000274658203 -2.9649999141693115,-13.569999694824219 -3.5869998931884766,-13.569999694824219 C-3.750999927520752,-13.569999694824219 -3.9140000343322754,-13.555999755859375 -4.076000213623047,-13.527000427246094 C-5.8429999351501465,-13.173999786376953 -7,-11.468999862670898 -6.676000118255615,-9.696999549865723 C-6.676000118255615,-9.696999549865723 -5.644000053405762,-3.869999885559082 -5.644000053405762,-3.869999885559082 C-5.644000053405762,-3.869999885559082 -8.472999572753906,-3.869999885559082 -8.472999572753906,-3.869999885559082 C-9.692999839782715,-3.875999927520752 -10.843999862670898,-3.302999973297119 -11.572999954223633,-2.3239998817443848 C-12.309000015258789,-1.3539999723434448 -12.539999961853027,-0.09099999815225601 -12.197999954223633,1.0770000219345093 C-12.197999954223633,1.0770000219345093 -9.713000297546387,9.64799976348877 -9.713000297546387,9.64799976348877z M-10.267000198364258,-1.3530000448226929 C-9.843999862670898,-1.9220000505447388 -9.175999641418457,-2.25600004196167 -8.467000007629395,-2.253000020980835 C-8.467000007629395,-2.253000020980835 -3.6989998817443848,-2.253000020980835 -3.6989998817443848,-2.253000020980835 C-3.6989998817443848,-2.253000020980835 -5.067999839782715,-9.982000350952148 -5.067999839782715,-9.982000350952148 C-5.248000144958496,-10.871999740600586 -4.679999828338623,-11.741999626159668 -3.7929999828338623,-11.934000015258789 C-2.881999969482422,-12.093000411987305 -2.1470000743865967,-11.234000205993652 -1.8619999885559082,-9.701000213623047 C-1.3619999885559082,-7.000999927520752 0.5109999775886536,-4.882999897003174 3.559999942779541,-3.5789999961853027 C5.60099983215332,-2.742000102996826 7.7779998779296875,-2.2899999618530273 9.982999801635742,-2.250999927520752 C10.498000144958496,-2.25 10.913999557495117,-1.8339999914169312 10.914999961853027,-1.3200000524520874 C10.914999961853027,-1.3200000524520874 10.914999961853027,7.557000160217285 10.914999961853027,7.557000160217285 C10.913999557495117,8.071000099182129 10.498000144958496,8.487000465393066 9.982999801635742,8.48799991607666 C9.982999801635742,8.48799991607666 9.027000427246094,8.48799991607666 9.027000427246094,8.48799991607666 C7.452000141143799,8.48900032043457 5.927000045776367,9.041000366210938 4.715000152587891,10.04800033569336 C4.715000152587891,10.04800033569336 3.5,11.059000015258789 3.5,11.059000015258789 C2.815999984741211,11.626999855041504 1.9550000429153442,11.939000129699707 1.065999984741211,11.939000129699707 C1.065999984741211,11.939000129699707 -4.489999771118164,11.939000129699707 -4.489999771118164,11.939000129699707 C-6.183000087738037,11.932999610900879 -7.670000076293945,10.814000129699707 -8.145999908447266,9.189000129699707 C-8.145999908447266,9.189000129699707 -10.625,0.6200000047683716 -10.625,0.6200000047683716 C-10.824000358581543,-0.0560000017285347 -10.690999984741211,-0.7850000262260437 -10.267999649047852,-1.3480000495910645 C-10.267999649047852,-1.3480000495910645 -10.267000198364258,-1.3530000448226929 -10.267000198364258,-1.3530000448226929z">
                                    </path>
                                </g>
                            </g>
                        </g>
                    </svg></div>`);
            $(".dislike-icon").html(
                `<div title="" role="button" aria-label="animation" tabindex="0" style="width: 100%; height: 100%; overflow: hidden; margin: 0px auto; outline: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40" preserveAspectRatio="xMidYMid slice" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px);"><defs><clipPath id="__lottie_element_12"><rect width="40" height="40" x="0" y="0"></rect></clipPath></defs><g clip-path="url(#__lottie_element_12)"><g transform="matrix(1,0,0,1,0,0)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(0.9999980330467224,0,0,0.9999980330467224,20.089000701904297,21)"><path fill="rgb(255,255,255)" fill-opacity="1" d=" M12.197999954223633,-1.0770000219345093 C12.197999954223633,-1.0770000219345093 9.713000297546387,-9.64799976348877 9.713000297546387,-9.64799976348877 C9.032999992370605,-11.965999603271484 6.909999847412109,-13.562000274658203 4.494999885559082,-13.569999694824219 C4.494999885559082,-13.569999694824219 -1.065000057220459,-13.569999694824219 -1.065000057220459,-13.569999694824219 C-2.3340001106262207,-13.569999694824219 -3.562999963760376,-13.125 -4.538000106811523,-12.314000129699707 C-4.538000106811523,-12.314000129699707 -5.752999782562256,-11.305000305175781 -5.752999782562256,-11.305000305175781 C-6.672999858856201,-10.541000366210938 -7.830999851226807,-10.121000289916992 -9.027000427246094,-10.119999885559082 C-9.027000427246094,-10.119999885559082 -9.982999801635742,-10.119999885559082 -9.982999801635742,-10.119999885559082 C-11.395000457763672,-10.118000030517578 -12.538999557495117,-8.975000381469727 -12.539999961853027,-7.564000129699707 C-12.539999961853027,-7.564000129699707 -12.539999961853027,1.312000036239624 -12.539999961853027,1.312000036239624 C-12.538999557495117,2.7239999771118164 -11.395000457763672,3.868000030517578 -9.982999801635742,3.869999885559082 C-7.447999954223633,3.869999885559082 -0.6610000133514404,4.96999979019165 0.26499998569488525,9.98799991607666 C0.8790000081062317,13.312000274658203 2.9649999141693115,13.569999694824219 3.5869998931884766,13.569999694824219 C3.750999927520752,13.569999694824219 3.9140000343322754,13.555000305175781 4.076000213623047,13.527000427246094 C5.8429999351501465,13.17300033569336 7,11.468999862670898 6.676000118255615,9.696999549865723 C6.676000118255615,9.696999549865723 5.64300012588501,3.869999885559082 5.64300012588501,3.869999885559082 C5.64300012588501,3.869999885559082 8.472000122070312,3.869999885559082 8.472000122070312,3.869999885559082 C9.692999839782715,3.875999927520752 10.843999862670898,3.302999973297119 11.572999954223633,2.3239998817443848 C12.307999610900879,1.3539999723434448 12.539999961853027,0.09099999815225601 12.197999954223633,-1.0770000219345093z"></path></g><g opacity="1" transform="matrix(1,0,0,1,20.0939998626709,21)"><path fill="rgb(255,255,255)" fill-opacity="1" d=" M9.713000297546387,-9.64799976348877 C9.034000396728516,-11.965999603271484 6.9120001792907715,-13.562000274658203 4.495999813079834,-13.569999694824219 C4.495999813079834,-13.569999694824219 -1.065000057220459,-13.569999694824219 -1.065000057220459,-13.569999694824219 C-2.3329999446868896,-13.569000244140625 -3.562000036239624,-13.12600040435791 -4.5370001792907715,-12.3149995803833 C-4.5370001792907715,-12.3149995803833 -5.752999782562256,-11.305000305175781 -5.752999782562256,-11.305000305175781 C-6.671999931335449,-10.541000366210938 -7.829999923706055,-10.121999740600586 -9.026000022888184,-10.121000289916992 C-9.026000022888184,-10.121000289916992 -9.982000350952148,-10.121000289916992 -9.982000350952148,-10.121000289916992 C-11.394000053405762,-10.119000434875488 -12.538000106811523,-8.975000381469727 -12.539999961853027,-7.564000129699707 C-12.539999961853027,-7.564000129699707 -12.539999961853027,1.312000036239624 -12.539999961853027,1.312000036239624 C-12.538000106811523,2.7239999771118164 -11.394000053405762,3.868000030517578 -9.982000350952148,3.869999885559082 C-7.446000099182129,3.869999885559082 -0.6600000262260437,4.968999862670898 0.26600000262260437,9.98799991607666 C0.8799999952316284,13.310999870300293 2.9649999141693115,13.569999694824219 3.5869998931884766,13.569999694824219 C3.750999927520752,13.569999694824219 3.9149999618530273,13.555000305175781 4.077000141143799,13.527000427246094 C5.8429999351501465,13.17300033569336 7,11.468999862670898 6.676000118255615,9.697999954223633 C6.676000118255615,9.697999954223633 5.644999980926514,3.869999885559082 5.644999980926514,3.869999885559082 C5.644999980926514,3.869999885559082 8.473999977111816,3.869999885559082 8.473999977111816,3.869999885559082 C9.694000244140625,3.875 10.843999862670898,3.302000045776367 11.574000358581543,2.3239998817443848 C12.309000015258789,1.3530000448226929 12.539999961853027,0.09099999815225601 12.199000358581543,-1.0770000219345093 C12.199000358581543,-1.0770000219345093 9.713000297546387,-9.64799976348877 9.713000297546387,-9.64799976348877z M10.267999649047852,1.3519999980926514 C9.845000267028809,1.9210000038146973 9.175999641418457,2.255000114440918 8.467000007629395,2.252000093460083 C8.467000007629395,2.252000093460083 3.700000047683716,2.252000093460083 3.700000047683716,2.252000093460083 C3.700000047683716,2.252000093460083 5.068999767303467,9.982000350952148 5.068999767303467,9.982000350952148 C5.248000144958496,10.871999740600586 4.679999828338623,11.741000175476074 3.7929999828338623,11.932999610900879 C2.881999969482422,12.092000007629395 2.1480000019073486,11.232999801635742 1.8630000352859497,9.701000213623047 C1.3630000352859497,7 -0.5099999904632568,4.881999969482422 -3.559999942779541,3.5789999961853027 C-5.599999904632568,2.740999937057495 -7.7779998779296875,2.2899999618530273 -9.982999801635742,2.250999927520752 C-10.498000144958496,2.25 -10.913999557495117,1.8329999446868896 -10.914999961853027,1.3200000524520874 C-10.914999961853027,1.3200000524520874 -10.914999961853027,-7.557000160217285 -10.914999961853027,-7.557000160217285 C-10.913999557495117,-8.071000099182129 -10.496999740600586,-8.487000465393066 -9.982999801635742,-8.48799991607666 C-9.982999801635742,-8.48799991607666 -9.027000427246094,-8.48799991607666 -9.027000427246094,-8.48799991607666 C-7.452000141143799,-8.48900032043457 -5.926000118255615,-9.041000366210938 -4.714000225067139,-10.04800033569336 C-4.714000225067139,-10.04800033569336 -3.5,-11.059000015258789 -3.5,-11.059000015258789 C-2.815000057220459,-11.626999855041504 -1.9550000429153442,-11.937999725341797 -1.065000057220459,-11.939000129699707 C-1.065000057220459,-11.939000129699707 4.491000175476074,-11.939000129699707 4.491000175476074,-11.939000129699707 C6.183000087738037,-11.932999610900879 7.670000076293945,-10.8149995803833 8.147000312805176,-9.1899995803833 C8.147000312805176,-9.1899995803833 10.625,-0.6209999918937683 10.625,-0.6209999918937683 C10.824999809265137,0.054999999701976776 10.692000389099121,0.7850000262260437 10.269000053405762,1.347000002861023 C10.269000053405762,1.347000002861023 10.267999649047852,1.3519999980926514 10.267999649047852,1.3519999980926514z"></path></g></g></g></svg></div>`
            );
        }
    });
}


function reportBug(event, id) {
    event.preventDefault()

    var myModal = new jBox("Modal", {
        title: "<div class='text-right'>متن گزارش خطا را وارد نمایید</div>",
        content: `<form action="${mainUrl}/send-bug" method="post">
      <input type="hidden"  name="id" value="${id}"> 
      <textarea name='content' class='form-control text-area'></textarea>
      <button class="btn--gray">ارسال</button>
      </form>`
    });
    myModal.open()
}