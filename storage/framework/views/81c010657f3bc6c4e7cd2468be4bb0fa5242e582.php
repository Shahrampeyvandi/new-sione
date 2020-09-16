<div id="popup" class="overlay">
    <div class="popup">
        <a class="close" href="#">&times;</a>
        <div class="content">
            <div id="shareModalInner" class="modal-inner mt-3">
                <h3 class="modal-title text-center">اشتراک در شبکه های اجتماعی</h3>
                <div class="share-options">
                    <ul class="socials">

                        <li class="social face">
                            <a href="#" title="فیسبوک" target="_blank"><span class="circle">
                                    <i class="fab fa-facebook"></i></span>
                                <span class="text">فیسبوک</span></a>
                        </li>
                        <li class="social twit">
                            <a href="#" title="تویتتر" target="_blank"><span class="circle">
                                    <i class="fab fa-twitter"></i></span>
                                <span class="text">تویتتر</span></a>
                        </li>
                        <li class="social whats">
                            <a href="#" title="واتس‌اپ" target="_blank"><span class="circle">
                                    <i class="fab fa-whatsapp"></i> </span>
                                <span class="text">واتس‌اپ</span></a>
                        </li>
                        <li class="social tel">
                            <a href="#" title="تلگرام" target="_blank"><span class="circle">
                                    <i class="fab fa-telegram"></i> </span>
                                <span class="text">تلگرام</span></a>
                        </li>
                        <li class="social link">
                            <a href="#" title="لینکداین" target="_blank"><span class="circle">
                                    <i class="fab fa-linkedin"></i> </span>
                                <span class="text">لینکداین</span></a>
                        </li>
                    </ul>
                    <div class="form-field mt-lg">
                        <div class="field-inner">
                            <div class="input-copy w-100">
                                <div class="input-text form-input">
                                    <div class="input-inner">

                                        <input class="input ltr input-disabled" type="" id="shareUrl" value=""
                                            name="link" placeholder="" autocomplete="off" disabled="true" readonly="">

                                        <div class="input-box"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $('#shareUrl').val(window.location.href);
                    $('.social.face a').attr('href','http://www.facebook.com/share.php?u='+window.location.href+'')
                    $('.social.whats a').attr('href','https://wa.me/?text='+window.location.href+'')
                    $('.social.twit a').attr('href','https://www.twitter.com/intent/tweet?url='+window.location.href+'')
                    $('.social.tel a').attr('href','https://t.me/share/url?url='+window.location.href+'')
                    $('.social.link a').attr('href','https://www.linkedin.com/shareArticle?mini=true&amp;url='+window.location.href+'')
            
                </script>

            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Blog/popups.blade.php ENDPATH**/ ?>