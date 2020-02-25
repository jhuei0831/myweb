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

Route::get('/', function () {
    return view('home');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/manage', 'ManageController@index')->name('manage');
Route::get('/{url}', 'PageController@pages')->name('page');
Route::post('navbar-sortable','NavbarController@sort')->name('navbar.sort');
Route::post('slide-sortable','SlideController@sort')->name('slide.sort');
Route::get('/manage/navbar/sort', function () {return view('manage.navbar.sort');});
Route::get('/manage/slide/sort', function () {return view('manage.slide.sort');});

Route::prefix('manage')->middleware('auth')->group(function(){
    Route::resource('member', 'MemberController');
    Route::resource('page', 'PageController');
    Route::resource('navbar', 'NavbarController');
    Route::resource('slide', 'SlideController');
});


View::composer(['*'], function ($view) {
    $navbars = App\Navbar::orderby('sort')->paginate(10);
    $pages = App\Page::paginate(10);
    $current_page = App\Page::where('url',Request::path())->first();
    $users = App\User::paginate(10);
    $slides = App\Slide::orderby('sort')->paginate(10);

    $view->with('navbars',$navbars);
    $view->with('pages',$pages);
    $view->with('users',$users);
    $view->with('slides',$slides);
    $view->with('current_page',$current_page);
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
