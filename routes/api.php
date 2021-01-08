<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\LogController;
use App\Http\Controllers\api\RoleController;
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

Route::post('login', [AuthController::class, 'login']); // 登入
Route::post('forgot-password', [UserController::class, 'forgot_password']); // 使用者忘記密碼

Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::get("user", [AuthController::class, "user"]);      // 取得用戶資料 
    Route::get('logout', [AuthController::class, 'logout']); // 登出
    Route::post('get-permission', [AuthController::class, 'user_permission']); // 取得用戶權限
    // 角色
    Route::get('roles', [RoleController::class, 'index']); // 角色列表
    Route::get('permissions', [RoleController::class, 'permission']); // 取得權限
    Route::post('roles-create', [RoleController::class, 'store']); // 新增角色
    Route::get('role/{id}', [RoleController::class, 'show']); // 取得指定角色
    Route::put('role-edit/{id}', [RoleController::class, 'update']); // 修改角色
    Route::delete('role-delete/{id}', [RoleController::class, 'destroy']); // 刪除角色
    // 使用者
    Route::get('users', [UserController::class, 'index']); // 使用者列表
    Route::get('user/roles', [UserController::class, 'create']); // 取得角色
    Route::post('users-create', [UserController::class, 'store']); // 新增使用者
    Route::get('user/{id}', [UserController::class, 'show']); // 取得指定使用者
    Route::put('user-edit/{id}', [UserController::class, 'update']); // 修改使用者
    Route::put('user-edit-self/{id}', [UserController::class, 'edit_self']); // 使用者修改自己的資料
    Route::delete('user-delete/{id}', [UserController::class, 'destroy']); // 刪除使用者
    Route::put('user-photo/{id}', [UserController::class, 'photo']); // 使用者照片
    // Logs
    Route::get('logs', [LogController::class, 'index']); // Log列表
    Route::get('logs/{id}', [LogController::class, 'detail']); // Log詳細資料
});