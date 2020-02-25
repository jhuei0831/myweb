<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Navbar;
class NavbarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navbars = Navbar::paginate(10);
        return view('manage.navbar.index',compact('navbars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->permission < '2') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        return view('manage.navbar.create');
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
        $navbar = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
            'is_open' => ['required'],          
        ]);

        if ($navbar) {
            Navbar::create($request->all());
        }

        return back()->with('success', '導覽列新增成功 !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $navbar = Navbar::where('id',$id)->first();
        return view('manage.navbar.edit',compact('navbar'));
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
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        $navbar = Navbar::where('id', $id)->first();

        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'link' => ['string', 'max:255'],
            'type' => ['required'],
            'is_open' => ['required'],
        ]);

        // 逐筆進行htmlpurufier 並去掉<p></p>
        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key)) {
                $navbar->$key = strip_tags(clean($data[$key]));
            }
        }

        $navbar->save();
        return back()->with('success', '修改導覽列成功 !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '4') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        Navbar::destroy($id);
        return back()->with('success', '刪除導覽列成功 !');

    }

    //拖曳排序
    public function sort(Request $request)
    {
        $navbars = Navbar::all();

        foreach ($navbars as $navbar) {
            foreach ($request->order as $order) {
                if ($order['id'] == $navbar->id) {
                    $navbar->update(['sort' => $order['position']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
}
