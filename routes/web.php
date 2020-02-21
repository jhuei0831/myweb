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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/manage', 'ManageController@index')->name('manage');

Route::get('/manage/member', 'MemberController@show')->name('member');
Route::get('/manage/member/create', 'MemberController@create')->name('member.create');
Route::post('/manage/member/store', 'MemberController@store')->name('member.store');
Route::get('/manage/member/edit/{id}', 'MemberController@edit')->name('member.edit');
Route::put('/manage/member/update/{id}', 'MemberController@update')->name('member.update');
Route::get('/manage/member/delete/{id}', 'MemberController@destroy')->name('member.delete');

Route::get('/manage/page', 'PageController@index')->name('page');
Route::get('/manage/page/create', 'PageController@create')->name('page.create');
Route::post('/manage/page/store', 'PageController@store')->name('page.store');
Route::get('/manage/page/edit/{id}', 'PageController@edit')->name('page.edit');
Route::put('/manage/page/update/{id}', 'PageController@update')->name('page.update');
Route::get('/manage/page/delete/{id}', 'PageController@destroy')->name('page.delete');

Route::get('/manage/navbar', 'NavbarController@index')->name('navbar');
Route::get('/manage/navbar/create', 'NavbarController@create')->name('navbar.create');
Route::post('/manage/navbar/store', 'NavbarController@store')->name('navbar.store');