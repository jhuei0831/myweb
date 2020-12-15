<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $apiToken = Str::random(10); //隨機產生一組10個英數字組成的字串
        if (Hash::check($request->password, $user->password)) {
            if ($user->update(['api_token' => $apiToken])) { //更新 api_token
                if ($user->remember_token) {
                    return "login as admin, your api token is $apiToken";
                } else {
                    return "login as user, your api token is $apiToken";
                }

            }
        } else {
            return "Wrong email or password！";
        }
    }
}
