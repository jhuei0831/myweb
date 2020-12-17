<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
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
            return response()->json(['message' => '登入失敗'], 401);
        }
    }

    public function user() {
        $user = Auth::user();
        if(!is_null($user)) { 
            return response()->json(["status" => "success", "data" => $user]);
        }
        else {
            return response()->json(["status" => "failed", "message" => "Whoops! no user found"]);
        }        
    }
}
