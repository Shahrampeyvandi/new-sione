<?php

Route::get('/admin/login', 'Panel\LoginController@Login')->name('Admin.Login');
Route::post('/admin/login', 'Panel\LoginController@Verify')->name('Admin.Login');
Route::get('/login', 'Front\LoginController@Login')->name('login');
Route::post('/login', 'Front\LoginController@Verify')->name('login');
Route::post('/register', 'Front\LoginController@Register')->name('S.Register');
Route::post('/forgetpass', 'Front\LoginController@ForgetPassword')->name('forgetpass');
Route::post('/forgetpasscode', 'Front\LoginController@ForgetPasswordSubmitCode')->name('forgetpass.submitCode');
Route::post('/forgetpassnewpass', 'Front\LoginController@ForgetPasswordSubmitnewPass')->name('forgetpass.submitNewPass');

Route::get('/testapi/{id}', 'Panel\ImdbController@testApi')->name('Test.Api');

// Route::post('/buy', 'Front\PlanController@Buy')->name('S.BuyPlan');
Route::post('/pay', 'Panel\PayController@pay')->name('S.BuyPlan');
Route::get('/pay/cb', 'Panel\PayController@callback')->name('Pay.CallBack');




Route::group(['middleware' => ['userauth']], function () {
    Route::post('ajax/checktakhfif', 'Front\AjaxController@checkTakhfif')->name('checkTakhfif');
    Route::get('/sitesharing', 'Front\PlanController@All')->name('S.SiteSharing');
});


Route::group(['middleware' => ['userauth', 'userplan']], function () {
    Route::get('/', 'Front\MainController@index')->name('MainUrl');

    Route::post('/getdownloadlinks', 'Front\MainController@getDownLoadLinks');

    Route::get('/movies', 'Front\MovieController@All')->name('AllMovies');
    Route::get('/series', 'Front\SerieController@All')->name('AllSeries');
    Route::get('/documentaries', 'Front\SerieController@All')->name('AllDocumentaries');
    Route::get('/childs', 'Front\ChildController@Show')->name('Childrens');
    Route::get('/categories', 'Front\CategoryController@All')->name('Categories');
    Route::get('/category/{name}', 'Front\CategoryController@Show')->name('Category.Show');
    Route::get('/movie/{slug}', 'Front\MovieController@Show')->name('ShowMovie');
    // Route::get('/serie/{slug}/{season?}', 'Front\SerieController@Show')->name('ShowSerie');
    Route::post('/addcomment/{post}', 'Front\CommentController@Save')->name('SaveComment');
    Route::post('/getcomment/{post}/ajax', 'Front\CommentController@getCommentAjax')->name('GetCommentAjax');
    Route::post('/ajax/getmoviedetail', 'Front\AjaxController@getMovieDetail')->name('GetMovieDetail');
    Route::get('/logout', 'Front\LoginController@logout')->name('logout-user');
    Route::get('/download/{id}', 'Front\MainController@DownLoad')->name('DownLoad');
    Route::get('/myfavorite', 'Front\MainController@MyFavorite')->name('S.MyFavorite');
    Route::get('/showall', 'Front\MainController@ShowMore')->name('S.ShowMore');
    Route::get('/play/{slug}', 'Front\MainController@Play')->name('S.Play');
    Route::get('/trailer/{slug}', 'Front\MainController@Trailer')->name('S.Trailer');
    Route::get('/play', 'Front\MainController@Play')->name('S.Series.Play');
    Route::post('/likepost', 'Front\AjaxController@Like')->name('S.Like');
    Route::get('/comming-soon', 'Front\MainController@CommingSoon')->name('CommingSoon');
    Route::get('/cast/{name}', 'Front\MainController@ShowCast')->name('ShowCast');
    Route::post('ajax/search', 'Front\AjaxController@Search')->name('S.Search');
    Route::post('ajax/favorite', 'Front\AjaxController@addToFavorite')->name('S.addToFavorite');
    Route::get('/account', 'Front\UserController@Account')->name('S.Account');
    Route::get('/orders', 'Front\UserController@Orders')->name('S.OrderLists');
    Route::get('blog/', 'Blog\BlogController@index')->name('Blog.index');
    Route::get('blog/{category}/{slug}', 'Blog\BlogController@show')->name('Blog.show');
    Route::get('blog/video/{id}', 'Blog\BlogController@showvideo')->name('Blog.show.video');
    Route::get('blog/{category}', 'Blog\BlogController@Category')->name('Blog.Category');
    Route::post('blog/comment/{blog}', 'Blog\BlogController@Comment')->name('Blog.SaveComment');
    Route::post('blog/search', 'Front\AjaxController@SearchBlog')->name('Blog.Ajax.Search');

    Route::get('collection/{id}', 'Front\MainController@ShowCollection')->name('Show-Collection');
    Route::get('movie-request', 'Front\UserController@MovieRequest')->name('MovieRequest');
    Route::post('movie-request', 'Front\UserController@SaveRequest')->name('MovieRequest');


});




//   ******* ADMIN *********  //

Route::group(['middleware' => ['admin'], 'prefix' => 'panel'], function () {
    Route::get('/', 'Panel\DashboardController@Index')->name('BaseUrl');
    Route::get('/logout', function () {
        Auth::guard('admin')->logout();
        return redirect()->route('Admin.Login');
    })->name('logout');
    Route::get('movie/add', 'Panel\MoviesController@Add')->name('Panel.AddMovie');
    Route::post('movie/add', 'Panel\MoviesController@Save')->name('Panel.AddMovie');
    Route::put('movie/add', 'Panel\MoviesController@EditPost')->name('Panel.AddMovie');
    Route::get('users', 'Panel\UserController@List')->name('Panel.UserList');
    Route::post('user/add', 'Panel\UserController@Add')->name('Panel.AddUser');
    Route::get('user/edit/{user}', 'Panel\UserController@Edit')->name('Panel.EditUser');
    Route::post('user/edit/{user}', 'Panel\UserController@SaveEdit')->name('Panel.EditUser');
    Route::get('series/add', 'Panel\SeriesController@Add')->name('Panel.AddSerie');
    Route::post('series/add', 'Panel\SeriesController@Save')->name('Panel.AddSerie');
    Route::delete('user/delete', 'Panel\UserController@Delete')->name('Panel.DeleteUser');
    Route::get('movies/list', 'Panel\MoviesController@MoviesList')->name('Panel.MoviesList');
    Route::get('series/list', 'Panel\SeriesController@SeriesList')->name('Panel.SeriesList');
    Route::get('series/{serie}/season/add', 'Panel\SeriesController@AddSeason')->name('Panel.AddSeason');
    Route::post('series/{serie}/season/add', 'Panel\SeriesController@InsertSeason')->name('Panel.AddSeason');
    Route::delete('series/season/delete', 'Panel\SeriesController@DeleteSeason')->name('Panel.DeleteSeason');
    Route::get('series/season/{season}', 'Panel\SeriesController@EditSeason')->name('Panel.EditSeason');
    Route::post('series/season/{season}', 'Panel\SeriesController@SaveEditSeason')->name('Panel.EditSeason');
    Route::post('series/section/ajax/imdb', 'Panel\SeriesController@getSectionImdbData')->name('Panel.getSectionImdbData');
    Route::get('series/addsection/{id}', 'Panel\SeriesController@AddSection')->name('Panel.AddSection');
    Route::post('series/addsection/{id}', 'Panel\SeriesController@InsertSection')->name('Panel.AddSection');
    Route::delete('series/section/delete', 'Panel\SeriesController@DeleteSection')->name('Panel.DeleteSection');
    Route::get('series/section/{section}', 'Panel\SeriesController@EditSection')->name('Panel.EditSection');
    Route::post('series/section/{section}', 'Panel\SeriesController@SaveEditSection')->name('Panel.EditSection');
    Route::post('ajax/series/all', 'Panel\SeriesController@GetSeriesAjax')->name('Panel.Ajax.Series');
    Route::get('movie/{post}', 'Panel\MoviesController@Edit')->name('Panel.EditMovie');
    Route::post('movie/{post}', 'Panel\MoviesController@EditMovie')->name('Panel.EditMovie');
    Route::get('serie/{post}', 'Panel\SeriesController@Edit')->name('Panel.EditSerie');
    Route::post('serie/{post}', 'Panel\SeriesController@EditSerie')->name('Panel.EditSerie');
    Route::post('actor/insert', 'Panel\ActorsController@Insert')->name('Panel.Actor.Insert');
    Route::delete('actor/delete', 'Panel\ActorsController@Delete')->name('Panel.DeleteActor');
    Route::get('upload/video', 'Panel\MoviesController@UploadVideo')->name('Panel.UploadVideo');
    Route::post('upload/video', 'Panel\MoviesController@SaveVideo')->name('Panel.UploadVideo');
    Route::get('upload/episode', 'Panel\MoviesController@AddEpisode')->name('Panel.UploadEpisode');
    Route::post('upload/episode', 'Panel\MoviesController@SaveEpisode')->name('Panel.UploadEpisode');
    Route::delete('post/delete', 'Panel\MoviesController@DeletePost')->name('Panel.DeletePost');
    Route::delete('video/delete', 'Panel\MoviesController@DeleteVideo')->name('Panel.DeleteVideo');
    Route::get('plans/add', 'Panel\PlanController@Add')->name('Panel.AddPlan');
    Route::post('plans/add', 'Panel\PlanController@Save')->name('Panel.AddPlan');
    Route::get('plans/{id}/edit', 'Panel\PlanController@Edit')->name('Panel.EditPlan');
    Route::put('plans/{id}/edit', 'Panel\PlanController@SaveEdit')->name('Panel.EditPlan');
    Route::get('plans/list', 'Panel\PlanController@List')->name('Panel.PlanList');
    Route::delete('plans/delete', 'Panel\PlanController@Delete')->name('Panel.DeletePlan');
    Route::delete('post/image/delete', 'Panel\MoviesController@DeleteImage')->name('Panel.DeleteImage');
    Route::get('discounts', 'Panel\DiscountController@List')->name('Panel.DiscountList');
    Route::post('discount/save', 'Panel\DiscountController@Save')->name('Panel.Discount.Insert');
    Route::get('discount/{id}/edit', 'Panel\DiscountController@Edit')->name('Panel.Discount.Edit');
    Route::put('discount/{id}/edit', 'Panel\DiscountController@SaveEdit')->name('Panel.Discount.Edit');
    Route::delete('discount/delete', 'Panel\DiscountController@Delete')->name('Panel.DeleteDiscount');
    Route::get('sendmessage', 'Panel\MessageController@Add')->name('Panel.SendMessage');
    Route::post('sendmessage', 'Panel\MessageController@Send')->name('Panel.SendMessage');
    Route::get('blog/add', 'Panel\BlogController@Add')->name('Panel.AddBlog');
    Route::post('upload-image', 'Panel\BlogController@UploadImage')->name('UploadImage');
    Route::post('blog/add', 'Panel\BlogController@Save')->name('Panel.AddBlog');
    Route::get('blog/list', 'Panel\BlogController@List')->name('Panel.BlogList');
    Route::delete('blog/delete', 'Panel\BlogController@DeleteBlog')->name('Panel.DeleteBlog');
    Route::get('blog/edit/{blog}', 'Panel\BlogController@Edit')->name('Panel.EditBlog');
    Route::post('blog/edit/{blog}', 'Panel\BlogController@SaveEdit')->name('Panel.EditBlog');
    Route::get('comments/unconfirmed', 'Panel\CommentController@UnconfirmedComments')->name('Panel.UnconfirmedComments');
    Route::get('comments/confirmed', 'Panel\CommentController@ConfirmedComments')->name('Panel.ConfirmedComments');
    Route::get('setting', 'Panel\SettingController@Show')->name('Panel.Setting');
    Route::post('setting', 'Panel\SettingController@Save')->name('Panel.Setting');
    Route::get('sliders', 'Panel\SlideshowController@List')->name('Panel.SliderList');
    Route::get('sliders/add', 'Panel\SlideshowController@Add')->name('Panel.AddSlider');
    Route::post('sliders/add', 'Panel\SlideshowController@Save')->name('Panel.AddSlider');
    Route::delete('slider/delete', 'Panel\SlideshowController@Delete')->name('Panel.DeleteSlider');
    Route::get('slider/edit/{id}', 'Panel\SlideshowController@Edit')->name('Panel.EditSlider');
    Route::post('slider/edit/{id}', 'Panel\SlideshowController@SaveEdit')->name('Panel.EditSlider');
    Route::post('imdb/get', 'Panel\ImdbController@Get')->name('Panel.GetImdb');
    Route::get('categories/add', 'Panel\CategoryController@Add')->name('Panel.AddCat');
    Route::post('categories/add', 'Panel\CategoryController@Save')->name('Panel.AddCat');
    Route::get('categories/list', 'Panel\CategoryController@List')->name('Panel.CatList');
    Route::get('categories/edit/{category}', 'Panel\CategoryController@Edit')->name('Panel.EditCat');
    Route::post('categories/edit/{category}', 'Panel\CategoryController@SaveEdit')->name('Panel.EditCat');
    Route::delete('category/delete', 'Panel\CategoryController@Delete')->name('Panel.DeleteCat');

    Route::get('collections/add', 'Panel\CollectionController@Add')->name('Panel.AddCollection');
    Route::post('collections/add', 'Panel\CollectionController@Save')->name('Panel.AddCollection');
    Route::get('collections/list', 'Panel\CollectionController@List')->name('Panel.CollectionList');
    Route::get('collections/edit/{collection}', 'Panel\CollectionController@Edit')->name('Panel.EditCollection');
    Route::post('collections/edit/{collection}', 'Panel\CollectionController@SaveEdit')->name('Panel.EditCollection');
    Route::delete('collection/delete', 'Panel\CollectionController@Delete')->name('Panel.DeleteCollection');

    Route::get('advert/add', 'Panel\AdvertController@Add')->name('Panel.AddAdvert');
    Route::post('advert/add', 'Panel\AdvertController@Save')->name('Panel.AddAdvert');
    Route::get('advert/list', 'Panel\AdvertController@List')->name('Panel.AdvertList');
    Route::delete('advert/delete', 'Panel\AdvertController@DeleteAdvert')->name('Panel.DeleteAdvert');
    Route::get('advert/edit/{advert}', 'Panel\AdvertController@Edit')->name('Panel.EditAdvert');
    Route::post('advert/edit/{advert}', 'Panel\AdvertController@SaveEdit')->name('Panel.EditAdvert');

    Route::post('actors/add', 'Panel\ActorsController@Save')->name('Panel.AddActor');
    Route::get('actors/list', 'Panel\ActorsController@List')->name('Panel.ActorsList');
    Route::get('actor/edit/{actor}', 'Panel\ActorsController@Edit')->name('Panel.EditActor');
    Route::post('actor/edit/{actor}', 'Panel\ActorsController@SaveEdit')->name('Panel.EditActor');

    Route::post('sitesharing/edit', 'Panel\ContentController@SiteSharing')->name('EditSiteSharing');

    Route::get('movie-requests', 'Panel\CommentController@MovieRequests')->name('Panel.MovieRequests');

    
    Route::post('ajax/caption/delete', 'Panel\MoviesController@DeleteCaption')->name('Ajax.DeleteCaption');

    Route::post('ajax/actor/get', 'Panel\ActorsController@GetActorAjax')->name('Panel.Ajax.GetActor');
    Route::post('ajax/director/get', 'Panel\ActorsController@GetDirectorAjax')->name('Panel.Ajax.GetDirector');
    Route::post('ajax/category', 'Panel\MoviesController@AddCatAjax')->name('Panel.AddCatAjax');
    Route::post('ajax/checkname', 'Panel\MoviesController@checkNameAjax')->name('Panel.checkNameAjax');
});
