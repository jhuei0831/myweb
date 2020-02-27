@extends('_layouts.home.app')

@section('menu')
<div class="col-md-2">
    <nav class="navbar-vertical">
        <ul class="navbar-nav">
            @foreach($menus as $menu)
                @if($menu->name == $select_menu->name)
                <li class="active">
                    <a class="nav-link" href="/menu/{{ $menu->navbar_id }}/{{ $menu->name }}">{{ $menu->name }}</a>
                </li>
                @else
                <li class="">
                    <a class="nav-link" href="/menu/{{ $menu->navbar_id }}/{{ $menu->name }}">{{ $menu->name }}</a>
                </li>
                @endif
            @endforeach
        </ul>
    </nav>
</div>
@endsection

@section('content')
    @section('title',$page->name)
    <div class="col-md-10">
        <div class="card border-light" style="border: none;">
            <div class="card-header bg-transparent">
                <h1><b>{{$page->name}}</b></h1>
            </div>
            <div class="card-body">               
                @php           
                    echo clean($page->content);
                @endphp                                                                   
            </div>
        </div>
    </div>
@endsection

