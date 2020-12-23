<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\RoleController;

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
    Route::post('get-permission', [UserController::class, 'user_permission']); // 取得用戶權限
    Route::get('permissions', [RoleController::class, 'permission']); // 權限
    // 角色
    Route::get('roles', [RoleController::class, 'index']); // 角色列表
    Route::post('roles-create', [RoleController::class, 'store']); // 新增角色
    Route::get('role/{id}', [RoleController::class, 'show']); // 取得指定角色
    Route::put('roles-edit/{id}', [RoleController::class, 'update']); // 修改角色
    // Route::resource('roles', RoleController::class);
});