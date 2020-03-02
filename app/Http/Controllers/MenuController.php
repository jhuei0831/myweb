<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Navbar;
use App\Page;
use App\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(10);
        return view('manage.menu.index',compact('menus'));
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
        return view('manage.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '2') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $menu = $request->validate([
            'name' => ['required', 'string', 'max:255','unique:menus,name'],
            'navbar_id' => ['required','integer'],
            'link' => ['nullable'],
            'is_open' => ['required'],
            'is_list' => ['required'],
        ]);

        if ($menu) {
            Menu::create($request->all());
        }

        return back()->with('success', '選單新增成功 !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        $menu = Menu::where('id',$id)->first();
        return view('manage.menu.edit',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        $menu = Menu::where('id', $id)->first();

        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'navbar_id' => ['required','integer'],
            'link' => ['nullable','string'],
            'is_open' => ['required','boolean'],
            'is_list' => ['required','boolean'],
        ]);

        // 逐筆進行htmlpurufier 並去掉<p></p>
        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key)) {
                $menu->$key = strip_tags(clean($data[$key]));
            }
        }

        $menu->save();
        return back()->with('success', '修改選單成功 !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '4') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        Menu::destroy($id);
        return back()->with('success', '刪除選單成功 !');
    }

    //拖曳排序
    public function sort(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        $menus = Menu::all();

        foreach ($menus as $menu) {
            foreach ($request->order as $order) {
                if ($order['id'] == $menu->id) {
                    $menu->update(['sort' => $order['position']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
    /**
     * [menus description]
     * @param  [type] $nav  [description]
     * @param  [type] $menu [description]
     * @return [type]       [description]
     */
    public function menus($nav,$menu)
    {
        $navbar = Navbar::where('name',$nav)->first();
        $menus_nav = Menu::where('navbar_id',$navbar->id)->orderby('sort')->get();
        $select_menu = Menu::where('name',$menu)->first();
        $notice = Notice::where('menu_id',$select_menu->id)->where('is_open',1)->first();
        if ($select_menu->is_list == '1') {
            $menu_pages = Page::all();
        }
        else {
            $menu_pages = Page::where('menu_id',$select_menu->id)->first();
        }
        
        return view('menu',compact('menus_nav','select_menu','navbar','menu_pages','notice'));
    }
}
