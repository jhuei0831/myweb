<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        // echo $request->input("name") . "<br/>";

        $user = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'permission' => ['required', 'string', 'max:1'],
        ]);
       
        if ($user) {
            User::create($request->all());
        } 

        return back()->with('success','Item created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
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
        $login_data = User::where('id', Auth::id())->first();
        if ($login_data->permission < '3') {
            return back()->with('warning', 'Permission denied!');
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
        $user = User::where('id',$id)->first();

        if ($request->input('password')) {
                $data = $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'permission' => ['required', 'integer', 'min:0','max:5'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->permission = $data['permission'];
            $user->password = Hash::make($data['password']);
        }
        else{
            $data = $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'permission' => ['required', 'integer', 'min:0','max:5'],
            ]);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->permission = $data['permission'];
        }
        
        $user->save();

        return redirect()->route('member');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $login_data = User::where('id', Auth::id())->first();
        if ($login_data->permission < '5') {
            return back()->with('warning', 'Permission denied!');
        }
        User::destroy($id);
        return redirect()->route('member');
    }
}
