@extends('_layouts.home.app')
@section('title',$select_menu->name)
@section('menu')
<div class="col-md-2">
    <nav class="navbar navbar-vertical">
        <div class="container-fluid">
            <div class="navbar-header col-md-12">
                <a class="navbar-toggle collapsed" style="color: #7F0015;" data-toggle="collapse" data-target="#pnlSubNavbar" aria-expanded="false">
                    <i id="toggle" class="fas fa-eye-slash" onclick="changeClass()"></i>
                </a>
            </div>
            <div class="navbar-collapse collapse show" id="pnlSubNavbar">
                <ul class="nav navbar-nav">
                    @foreach($menus_nav as $menu)
                    @if($menu->name == $select_menu->name)
                    <li class="active">
                        <a class="nav-link" href="/article/{{ $navbar->name }}/{{ $menu->name }}">{{ $menu->name }}</a>
                    </li>
                    @else
                    <li class="">
                        <a class="nav-link" href="/article/{{ $navbar->name }}/{{ $menu->name }}">{{ $menu->name }}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</div>
@endsection

@section('content')
@if(Request::getQueryString())
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
    @elseif($select_menu->is_list)
    <div class="col-md-10">
        <div class="card border-light" style="border: none;">
            <div class="card-header bg-transparent">
                <h1><b>{{$select_menu->name}}</b></h1>
            </div>
            <div class="card-body">
                @foreach($menu_pages as $page)
                    @if($page->menu_id == $select_menu->id && $page->is_open == '1')
                    <div class="card-body">               
                        <div class="col-md-3 text-list"><p>{{ $page->created_at }}</p></div>                                                                  
                        <div class="col-md-9 text-list"><p><a href="{{ route('page', [$navbar->name,$select_menu->name,$page->name]) }}">{{ $page->name }}</a></p></div>                                                                  
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
    @else
    <div class="col-md-10">
        <div class="card border-light" style="border: none;">

            <div class="card-header bg-transparent">
                <h1><b>{{$menu_pages->name}}</b></h1>
            </div>
            <div class="card-body">               
                @php           
                    echo clean($menu_pages->content);
                @endphp                                                                   
            </div>

        </div>
    </div>
    @endif
@endsection
@section('script')
@parent
<script>
    $(document).ready(function() {
        $('#toggle').on('click', function() {
            if ($('#toggle').hasClass('fa-eye')) {             
                $('#toggle').removeClass("fa-eye").addClass("fa-eye-slash"); 
            }else {
                $('#toggle').removeClass("fa-eye-slash").addClass("fa-eye");
            }        
        });  
});
</script>
@show