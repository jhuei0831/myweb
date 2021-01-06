<?php

namespace App\Http\Controllers\api;

# Facades
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;

# Model
use App\Models\User;
use Spatie\Permission\Models\Role;

# Service
use App\Services\LogService;


class UserController extends Controller
{
    public function __construct(LogService $log)
    {
        $this->log = $log;
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['show', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
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
        $roles = Role::orderBy('id', 'ASC')->get();
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
            $this->log->write_log('users', ['message' => '使用者新增成功', 'data' => $request->except(['_token', 'password', 'password_confirmation'])], 'create');
            return response()->json(["status" => "success", "message" => '使用者新增成功']);
        }
        else{
            $this->log->write_log('users', ['message' => '使用者新增失敗', 'data' => $request->except(['_token', 'password', 'password_confirmation'])], 'create_failed');
            return response()->json(["status" => "failed", "message" => '使用者新增失敗']);
        }
    }

    function edit_self(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        if ($validated) {
            $input = $request->only('name', 'email');
            $user = User::find($id);
            $user->update($input);
            $this->log->write_log('users', ['message' => '使用者資料修改成功', 'data' => $request->only(['name', 'email'])], 'update');
            return response()->json(["status" => "success", "message" => '使用者資料修改成功']);
        }
        else{
            $this->log->write_log('users', ['message' => '使用者資料修改失敗', 'data' => $request->only(['name', 'email'])], 'update_failed');
            return response()->json(["status" => "failed", "message" => '使用者資料修改失敗']);
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
        $user_role = User::with('roles')->find($id)->roles;
        // 判斷使用者帳號是否有角色
        if ($user_role->isNotEmpty()) {
            $user_role = User::with('roles')->find($id)->roles[0]->name;
        }
        else {
            $user_role = null;
        }
        return response()->json(["status" => "success", "user" => $user, "user_role" => $user_role]);
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
                $this->log->write_log('users', ['message' => '密碼修改'], 'edit');
                return response()->json(["status" => "success", "message" => '使用者密碼修改成功']);
            }
            else{
                $this->log->write_log('users', ['message' => '密碼修改'], 'edit_failed');
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
                $this->log->write_log('users', ['message' => '使用者資料修改成功', 'data' => $request->only(['name', 'email', 'roles'])], 'update');
                return response()->json(["status" => "success", "message" => '使用者資料修改成功']);
            }
            else{
                $this->log->write_log('users', ['message' => '使用者資料修改失敗', 'data' => $request->only(['name', 'email', 'roles'])], 'update_failed');
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
            $user = User::find($id);
            $this->log->write_log('users', ['message' => '不能刪除目前登入的帳號', 'data' => $user], 'delete_failed');
            return response()->json(["status" => "failed", "message" => '不能刪除目前登入的帳號']);
        }
        else{
            $user = User::find($id);
            User::find($id)->delete();
            $this->log->write_log('users', ['message' => '使用者刪除成功', 'data' => $user], 'delete');
            return response()->json(["status" => "success", "message" => '使用者刪除成功']);
        }     
    }

    /**
     * 修改大頭貼照片
     */
    public function photo(Request $request, $id)
    {
        if ($request->has('photo')) {
            $input = $request->only('photo');
            $user = User::find($id);
            $user->update($input);
            $this->log->write_log('users', ['message' => '照片修改'], 'edit');
            return response()->json(["status" => "success", "message" => $input]);
        }
    }
}
