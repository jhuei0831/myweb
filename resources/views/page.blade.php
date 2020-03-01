@extends('_layouts.home.app')

@section('menu')
<div class="col-md-2">
    <nav class="navbar-vertical">
        <ul class="navbar-nav">
            @foreach($menus_nav as $menu)
                @if($menu->name == $select_menu->name)
                <li class="active">
                    <a class="nav-link" href="/article/{{ $navbar->name }}/{{ $select_menu->name }}">{{ $menu->name }}</a>
                </li>
                @else
                <li class="">
                    <a class="nav-link" href="/article/{{ $navbar->name }}/{{ $select_menu->name }}">{{ $menu->name }}</a>
                </li>
                @endif
            @endforeach
        </ul>
    </nav>
</div>
@endsection

@section('content')
    @section('title',$current_page->name)
    <div class="col-md-10">
        <div class="card border-light" style="border: none;">
            <div class="card-header bg-transparent">
                <h1><b>{{$current_page->name}}</b></h1>
            </div>
            <div class="card-body">               
                @php           
                    echo clean($current_page->content);
                @endphp                                                                   
            </div>
        </div>
    </div>
@endsection

