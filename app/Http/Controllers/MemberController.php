<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Log;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        $users = DB::table('users')->paginate(10);
        return view('manage.member.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        return view('manage.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
<<<<<<< HEAD
=======
        $error = 0;
>>>>>>> 0225b91b39442b86e84d94a2599a077a1bc820d8
        $user = new User;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'permission' => ['required', 'string', 'max:5', 'min:0'],
        ]);
       
        foreach ($request->except('_token','_method','password_confirmation') as $key => $value) {
            if ($request->filled($key) && $key == 'password') {
                $user->password = Hash::make($data['password']);
            }
            elseif ($request->filled($key)) {
                $user->$key = strip_tags(clean($data[$key]));
<<<<<<< HEAD
            }
        } 

        // 寫入log
        Log::write_log('users',$request->except('password','password_confirmation'));
        $user->save();
=======
                if ($user->$key == '') {
                    $error += 1;
                }
            }
        } 

        if ($error == 0) {
            // 寫入log
            Log::write_log('users',$request->all());
            $user->save();
        }
        else{
            return back()->withInput()->with('warning', '請確認輸入 !');
        }

>>>>>>> 0225b91b39442b86e84d94a2599a077a1bc820d8
        return back()->with('success','會員新增成功 !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        $users = DB::table('users')->paginate(10);
        return view('manage.member.index',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $user = User::where('id',$id)->first();
        return view('manage.member.edit',compact('user'));
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
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $error = 0;
        $user = User::where('id',$id)->first();        

        // 如果有輸入密碼
        if ($request->filled('password')) {
                $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:1', 'confirmed'],
                'permission' => ['required', 'integer', 'max:5', 'min:0'],
            ]);

            foreach ($request->except('_token','_method','password_confirmation') as $key => $value) {
                if ($request->filled($key) && $key == 'password') {
                    $user->password = Hash::make($data['password']);
                }
                elseif ($request->filled($key)) {
                    $user->$key = strip_tags(clean($data[$key]));
                    if ($user->$key == '') {
                        $error += 1;
                    }
                }
            }

<<<<<<< HEAD
            // 寫入log
            Log::write_log('users',$request->except('password','password_confirmation'));
            // 儲存資料
            $user->save();
=======
            if ($error == 0) {
                // 寫入log
                Log::write_log('users',$request->all());
                $user->save();
            }
            else{
                return back()->withInput()->with('warning', '請確認輸入 !');
            }
>>>>>>> 0225b91b39442b86e84d94a2599a077a1bc820d8
        }
        else{

            $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'permission' => ['required', 'integer', 'max:5', 'min:0'],
            ]);

            // 逐筆進行htmlpurufier 並去掉<p></p>
            foreach ($request->except('_token','_method') as $key => $value) {
                if ($request->filled($key)) {
                    $user->$key = strip_tags(clean($data[$key]));
                    if ($user->$key == '') {
                        $error += 1;
                    }
                }
            }

<<<<<<< HEAD
            // 寫入log
            Log::write_log('users',$request->all());
            // 儲存資料
            $user->save();
=======
            if ($error == 0) {
                // 寫入log
                Log::write_log('users',$request->all());
                $user->save();
            }
            else{
                return back()->withInput()->with('warning', '請確認輸入 !');
            }
>>>>>>> 0225b91b39442b86e84d94a2599a077a1bc820d8
        }       

        return back()->with('success', '會員更新成功 !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '5') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        // 寫入log
        Log::write_log('users',User::where('id',$id)->first());

        User::destroy($id);
        return back()->with('success', '會員刪除成功 !');
    }
}
