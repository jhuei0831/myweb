<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Slide;
class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::paginate(10);
        return view('manage.slide.index',compact('slides'));
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
        return view('manage.slide.create');
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
        $slide = new Slide;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'link' => ['max:255'],
            'image' => ['required'],
            'is_open' => ['required'],          
        ]);

        $slide->name = $request->name;
        $slide->link = $request->link;
        $slide->image = $request->image;
        $slide->is_open = $request->is_open;

        if ($data) {
           $slide->save();
        }

        return back()->with('success', '輪播新增成功 !');
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
        $slide = Slide::where('id',$id)->first();
        return view('manage.slide.edit',compact('slide'));
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

        $slide = Slide::where('id',$id)->first();
        
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'link' => ['nullable','string', 'max:255'],
            'image' => ['required'],
            'is_open' => ['required'],
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key)) {
                $slide->$key = strip_tags(clean($data[$key]));
            }
        }

        $slide->save();
        return back()->with('success','修改輪播成功 !');
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

        Slide::destroy($id);
        return back()->with('success', '刪除輪播成功 !');
    }

    //拖曳排序
    public function sort(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $slides = Slide::all();

        foreach ($slides as $slide) {
            foreach ($request->order as $order) {
                if ($order['id'] == $slide->id) {
                    $slide->update(['sort' => $order['position']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
}
