<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Str;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $apiToken = $user->createToken('api_token')->plainTextToken; //使用Sanctum自動產生token
            if ($user->update(['api_token' => $apiToken])) { //更新 api_token
                return response()->json(['token' => $apiToken, 'user' => $user], 200);
            }
        } 
        else {
            return response()->json(['message' => '登入失敗 : 帳號或密碼錯誤'], 401);
        }
    }

    public function user() 
    {
        $user = Auth::user();
        $permisssion = Auth::user()->allPermissions;
        if(!is_null($user)) { 
            return response()->json(["status" => "success", "user" => $user, "permission" => $permisssion]);
        }
        else {
            return response()->json(["status" => "failed", "message" => "Whoops! no user found"]);
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
            return response()->json(["status" => "success", "message" => '登出成功']);
        }
        else {
            return response()->json(["status" => "failed", "message" => "Whoops! no user found"]);
        } 
    }
}
