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
    return view('welcome');
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
