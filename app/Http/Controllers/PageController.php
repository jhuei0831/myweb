<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Page;
use App\Navbar;
use App\menu;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = DB::table('pages')->paginate(10);
        return view('manage.page.index',compact('pages'));
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

        return view('manage.page.create');
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
        $page = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'menu_id' => ['nullable','integer'],
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255','unique:pages,url'],
            'is_open' => ['required'],
            'is_slide' => ['required'],
        ]);
        if ($page) {
            Page::create($request->all());
        } 

        return back()->with('success','頁面新增成功 !');
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
        $page = Page::where('id',$id)->first();
        $navbars = Navbar::where('type', '=', '1')->get();
        return view('manage.page.edit',compact('page','navbars'));
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

        $page = Page::where('id',$id)->first();

        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'menu_id' => ['nullable'],
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'is_open' => ['required'],
            'is_slide' => ['required'],
        ]);

        // 逐筆進行htmlpurufier 並去掉<p></p>
        foreach ($request->except('_token','_method') as $key => $value) {
            if ($request->filled($key) && $key != 'content') {
                $page->$key = strip_tags(clean($data[$key]));
            }
            $page->content = $request->input('content');
        }
        if (!$request->filled('menu_id')) {
            $page->menu_id = NULL;
        }

        $page->save();
        return back()->with('success','修改頁面成功 !');
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
        Page::destroy($id);
        return back()->with('success','刪除頁面成功 !');
    }

    //
    /* public function pages($nav,$menu,$page)
    {
        $page = Page::where('url',$page)->first();
        $select_menu = Menu::where('id',$page->menu_id)->first();
        $menus_nav = Menu::where('navbar_id',$select_menu->navbar_id)->get();
        return view('page',compact('page','select_menu','menus_nav'));
    } */
}
