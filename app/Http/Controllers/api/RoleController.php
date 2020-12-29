<?php

namespace App\Http\Controllers\api;

# Facades
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

# Model
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

# Service
use App\Services\LogService;

class RoleController extends Controller
{
    public function __construct(LogService $log)
    {
        $this->log = $log;
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['permission', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['show', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'ASC')->get();
        return response()->json(["status" => "success", "data" => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permission()
    {
        $permission = Permission::get();
        return response()->json(["status" => "success", "data" => $permission]);
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        if ($validated) {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));
            $this->log->write_log('roles', $request->only('name', 'permission'), 'create');
            return response()->json(["status" => "success", "message" => '角色新增成功']);
        }
        else {
            $this->log->write_log('roles', $request->only('name', 'permission'), 'create_failed');
            return response()->json(["status" => "failed", "message" => '角色新增失敗']);
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
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return response()->json(["status" => "success", "role" => $role, "rolePermissions" => $rolePermissions]);
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
        $validated = $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);
        if ($validated) {
            // 檢查名稱是否重複
            $check_name = Role::where('id', '!=', $id)->where('name', $request->input('name'))->get();
            if ($check_name->isNotEmpty()) {
                $this->log->write_log('roles', ['message' => '名稱重複', 'data' => $request->only('name')], 'update_failed');
                return response()->json(["status" => "failed", "message" => '角色修改失敗', "errors" => '名稱重複' ]);
            }
            $role = Role::find($id);
            if (isset($request->input('permission')[0]['id']) && $role->name == $request->input('name')) {
                return response()->json(["status" => "failed", "message" => '角色修改失敗', "errors" => '無修改動作']);
            }
            // 只修改名稱
            elseif (isset($request->input('permission')[0]['id'])) {
                $role->name = $request->input('name');
                $role->save();
                $this->log->write_log('roles', ['message' => '角色修改成功', 'data' => $request->only('name', 'permission')], 'update');
                return response()->json(["status" => "success", "message" => '角色名稱修改成功']);
            }
            else{
                $role->name = $request->input('name');
                $role->save();
                $role->syncPermissions($request->input('permission'));
                $this->log->write_log('roles', ['message' => '角色修改成功', 'data' => $request->only('name', 'permission')], 'update');
                return response()->json(["status" => "success", "message" => '角色修改成功']); 
            }
                 
        }
        else {
            $this->log->write_log('roles', ['message' => '角色修改失敗', 'data' => $request->only('name', 'permission')], 'update_failed');
            return response()->json(["status" => "failed", "message" => '角色修改失敗']);
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
        $role = DB::table("roles")->where('id', $id)->first();
        if (Auth::user()->hasRole($role->name)) {
            $this->log->write_log('users', ['message' => '角色刪除失敗', 'data' => $role], 'delete_failed');
            return response()->json(["status" => "failed", "message" => '角色刪除失敗'], 401);
        }
        else {
            DB::table("roles")->where('id', $id)->delete();
            $this->log->write_log('users', ['message' => '角色刪除成功', 'data' => $role], 'delete');
            return response()->json(["status" => "success", "message" => '角色刪除成功']);
        }
    }
}
