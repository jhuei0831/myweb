<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [UserController::class, 'login']); // 登入

Route::middleware('auth:sanctum')->group(function () {
    Route::get("user", [UserController::class, "user"]);      // 取得用戶資料
    Route::get('logout', [UserController::class, 'logout']); // 登出
    Route::resource('roles','RoleController');
});