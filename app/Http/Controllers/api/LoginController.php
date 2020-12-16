<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $apiToken = $user->createToken('api_token')->plainTextToken; //使用Sanctum自動產生token
            if ($user->update(['api_token' => $apiToken])) { //更新 api_token
                return response()->json(['token' => $apiToken], 200);
            }
        } 
        else {
            return response()->json(['message' => '登入失敗'], 404);
        }
    }
}
