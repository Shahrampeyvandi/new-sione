<div class="blog-body">
    <h1>
        <span>
            ارسال نظر
        </span>
    </h1>
    <div class="sendOpinion">
    <form action="{{route('Blog.SaveComment',$post)}}" method="POST">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 col-lg-1">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <div class="col-10 col-lg-11">
                        <div class="input-place">

                            <textarea type="text" id="Opinion" name="opinion" autocomplete="off" required></textarea>
                            <label for="Opinion">
                                <span class="text-danger">*</span>
                                نظر
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-place">
                            <input type="email" id="Email" name="email" autocomplete="off" >
                            <label for="Email">
                                ایمیل
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <button class="sendOpinionBtn btn--ripple">
                ارسال دیدگاه
            </button>
        </form>
    </div>
</div>