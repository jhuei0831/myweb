<?php

use Illuminate\Support\Facades\Route;

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
    return view('vue');
});
// Route::get('/vue', function () {
//     return view('vue');
// });
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    // Route::resource('roles','RoleController');
    // Route::resource('users','UserController');
    Route::resource('products','ProductController');
});

Route::get('/{vue?}', function () {
    return view('vue');
})->where('vue', '[\/\w\.-]*');



