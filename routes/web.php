<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/errors/change_browser', function () {return view('errors.change_browser');});
// File manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
 \UniSharp\LaravelFilemanager\Lfm::routes();
});
//非IE瀏覽器
Route::middleware('browser')->group(function() {
	Auth::routes(['verify' => true]);
	Route::get('/', function () {return view('index');});
	Route::get('/manage', function () {return view('manage.index');})->middleware('auth','admin','verified')->name('manage');
    Route::get('/home', 'HomeController@index')->middleware('browser')->name('home');
	Route::get('/article/{nav}/{menu}?{page}', 'PageController@pages')->name('page');
	Route::get('/article/{nav}/{menu}', 'MenuController@menus')->name('menu');
});

//要登入和非IE瀏覽器
Route::middleware('auth','browser','admin','verified')->group(function() {
	//排序
    Route::post('navbar-sortable','NavbarController@sort')->name('navbar.sort');
	Route::post('slide-sortable','SlideController@sort')->name('slide.sort');
	Route::post('menu-sortable','MenuController@sort')->name('menu.sort');
	Route::get('/manage/navbar/sort', function () {return view('manage.navbar.sort');});
	Route::get('/manage/slide/sort', function () {return view('manage.slide.sort');});
	Route::get('/manage/menu/sort', function () {return view('manage.menu.sort');});
	//刪除背景
	Route::get('/manage/config/delete_background/{id}', 'ConfigController@delete_background')->name('config.delete_background');
});

//Resource
Route::prefix('manage')->middleware('auth','browser','admin','verified')->group(function(){
    Route::resource('member', 'MemberController');
    Route::resource('page', 'PageController');
    Route::resource('navbar', 'NavbarController');
    Route::resource('slide', 'SlideController');
    Route::resource('config', 'ConfigController');
    Route::resource('menu', 'MenuController');
    Route::resource('notice', 'NoticeController');
    Route::resource('log', 'LogController');
});


View::composer(['*'], function ($view) {
    if (Request::getQueryString()) {
        $current_page = App\Page::where('url', $_SERVER['QUERY_STRING'])->first();
        $view->with('current_page', $current_page);
    }
    $config = DB::table('configs')->where('id','1')->first();
    Config::set('app.name', $config->app_name);
    $navbars = App\Navbar::orderby('sort')->paginate(10);
    $slides = App\Slide::orderby('sort')->paginate(10);
    $menus = App\Menu::orderby('sort')->paginate(10);
    $config = App\Config::where('id','1')->first();
    $pages = App\Page::paginate(10);   
    $users = App\User::paginate(10);
       
    $view->with('navbars',$navbars);
    $view->with('pages',$pages);
    $view->with('users',$users);
    $view->with('menus',$menus);
    $view->with('slides',$slides);
    $view->with('config',$config);
});

// Route::get('/manage/member', 'MemberController@show')->name('member');
// Route::get('/manage/member/create', 'MemberController@create')->name('member.create');
// Route::post('/manage/member/store', 'MemberController@store')->name('member.store');
// Route::get('/manage/member/edit/{id}', 'MemberController@edit')->name('member.edit');
// Route::put('/manage/member/update/{id}', 'MemberController@update')->name('member.update');
// Route::get('/manage/member/delete/{id}', 'MemberController@destroy')->name('member.delete');

// Route::get('/manage/page', 'PageController@index')->name('page');
// Route::get('/manage/page/create', 'PageController@create')->name('page.create');
// Route::post('/manage/page/store', 'PageController@store')->name('page.store');
// Route::get('/manage/page/edit/{id}', 'PageController@edit')->name('page.edit');
// Route::put('/manage/page/update/{id}', 'PageController@update')->name('page.update');
// Route::get('/manage/page/delete/{id}', 'PageController@destroy')->name('page.delete');

// Route::get('/manage/navbar', 'NavbarController@index')->name('navbar');
// Route::get('/manage/navbar/create', 'NavbarController@create')->name('navbar.create');
// Route::post('/manage/navbar/store', 'NavbarController@store')->name('navbar.store');
// Route::get('/manage/navbar/edit/{id}', 'NavbarController@edit')->name('navbar.edit');
// Route::put('/manage/navbar/update/{id}', 'NavbarController@update')->name('navbar.update');
// Route::get('/manage/navbar/delete/{id}', 'NavbarController@destroy')->name('navbar.delete');
