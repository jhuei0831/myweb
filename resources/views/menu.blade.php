@extends('_layouts.home.app')
@section('title',$select_menu->name)
@section('menu')
<div class="col-md-2">
    <nav class="navbar-vertical">
        <ul class="navbar-nav">
            @foreach($menus as $menu)
            @if($menu->name == $select_menu->name)
            <li class="active">
                <a class="nav-link" href="/menu/{{ $navbar->id }}/{{ $menu->name }}">{{ $menu->name }}</a>
            </li>
            @else
            <li class="">
                <a class="nav-link" href="/menu/{{ $navbar->id }}/{{ $menu->name }}">{{ $menu->name }}</a>
            </li>
            @endif
            @endforeach
        </ul>
    </nav>
</div>
@endsection

@section('content')
    @if($select_menu->is_list)
    <div class="col-md-10">
        <div class="card border-light" style="border: none;">
            <div class="card-header bg-transparent">
                <h1><b>{{$select_menu->name}}</b></h1>
            </div>
            <div class="card-body">
                @foreach($pages as $page)
                    @if($page->menu_id == $select_menu->id)
                    <div class="card-body">               
                        <div class="col-md-3 col-sm-12 text-list"><p>{{ $page->created_at }}</p></div>                                                                  
                        <div class="col-md-9 col-sm-12 text-list"><p><a href="/page/{{ $page->url }}">{{ $page->name }}</a></p></div>                                                                  
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endsection