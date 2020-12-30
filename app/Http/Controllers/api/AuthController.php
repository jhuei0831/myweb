<?php

namespace App\Http\Controllers\api;

# Facades
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Str;

# Models
use App\Models\User;

# Service
use App\Services\LogService;

class AuthController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct(LogService $log)
    {
        $this->log = $log;
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $apiToken = $user->createToken('api_token')->plainTextToken; //使用Sanctum自動產生token
            if ($user->update(['api_token' => $apiToken])) { //更新 api_token
                $this->log->write_log('users', ['message' => '使用者登入成功', 'data' => $request->only(['email'])], 'login');
                return response()->json(['token' => $apiToken, 'user' => $user], 200);
            }
        } 
        else {
            $this->log->write_log('users', ['message' => '使用者登入失敗', 'data' => $request->only(['email'])], 'login_failed');
            return response()->json(['message' => '登入失敗 : 帳號或密碼錯誤'], 401);
        }
    }

    public function user() 
    {
        $user = Auth::user();
        $permisssion = Auth::user()->allPermissions;
        $role = Auth::user()->role;
        if(!is_null($user)) { 
            return response()->json(["status" => "success", "user" => $user, "permission" => $permisssion]);
        }
        else {
            return response()->json(["status" => "failed", "message" => "查無使用者"], 401);
        }        
    }

    function user_permission(Request $request)
    {
        $permisssion = Auth::user()->allPermissions;
        if (in_array($request->permission, $permisssion)) {
            return response()->json(["status" => "success", "allow" => true]);
        }
        else {
            return response()->json(["status" => "failed", "allow" => false]);
        }
    }
    
    function logout()
    {
        $user = Auth::user();
        if(!is_null($user)) { 
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
            $this->log->write_log('users', ['message' => '使用者登出成功'], 'logout');
            return response()->json(["status" => "success", "message" => "登出成功"]);
        }
        else {
            $this->log->write_log('users', ['message' => '使用者登出失敗'], 'logout_failed');
            return response()->json(["status" => "failed", "message" => "查無使用者"], 401);
        } 
    }

    function notfound()
    {
        return response()->json(["status" => "failed", "message" => "查無頁面"], 404);
    }
}
