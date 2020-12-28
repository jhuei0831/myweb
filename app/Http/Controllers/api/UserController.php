<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('roles')->orderBy('id','ASC')->get();
        return response()->json(["status" => "success", "data" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return response()->json(["status" => "success", "data" => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:password_confirmation',
            'role' => 'required'
        ]);
        if ($validated) {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $user->assignRole($request->input('role'));
            return response()->json(["status" => "success", "message" => '使用者新增成功']);
        }
        else{
            return response()->json(["status" => "failed", "message" => '使用者新增失敗']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user_role = User::with('roles')->find($id)->roles[0]->name;
        return response()->json(["status" => "success", "user" => $user, "user_role" => $user_role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('password')) {
            $validated = $request->validate([
                'password' => 'same:password_confirmation',
            ]);
            if ($validated) {
                $input = $request->only('password');
                $input['password'] = Hash::make($input['password']);
                $user = User::find($id);
                $user->update($input);
                return response()->json(["status" => "success", "message" => '使用者密碼修改成功']);
            }
            else{
                return response()->json(["status" => "failed", "message" => '使用者密碼修改失敗']);
            }
        }
        else {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'roles' => 'required'
            ]);
            if ($validated) {
                $input = $request->only('name', 'email');
                $user = User::find($id);

                $user->update($input);
                DB::table('model_has_roles')->where('model_id',$id)->delete();
                $user->assignRole($request->input('roles'));
                return response()->json(["status" => "success", "message" => '使用者資料修改成功']);
            }
            else{
                return response()->json(["status" => "failed", "message" => '使用者資料修改失敗']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            return response()->json(["status" => "failed", "message" => '不能刪除目前登入的帳號']);
        }
        else{
            User::find($id)->delete();
            return response()->json(["status" => "success", "message" => '使用者刪除成功']);
        }     
    }
}
