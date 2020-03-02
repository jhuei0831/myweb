@extends('_layouts.home.app')
@section('title',$select_menu->name)
@section('menu')
{{-- 選單顯示 --}}
<div id="menu" class="col-md-2">
    <nav class="navbar navbar-vertical">
        <div class="container-fluid">
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
{{-- 通知顯示 --}}
@isset($notice)
<div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="savePageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="savePageLabel">{{$notice->title}}</h5>
            </div>
            <div class="modal-body">
                {!! clean($notice->content) !!}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
@endisset
@endsection

@section('content')
{{-- 頁面顯示 --}}
@if(Request::getQueryString())
    <div id="content" class="col-md-10">
        <div class="card border-light" style="border: none;">
            <div class="card-header bg-transparent">
                <h1><b>{{$current_page->title}}</b></h1>
            </div>
            <div class="card-body">               
                {!! clean($current_page->content) !!}                                                                
            </div>
        </div>
    </div>
{{-- 是否清單顯示 --}}
@elseif($select_menu->is_list)
    <div id="content" class="col-md-10">
        <div class="card border-light" style="border: none;">
            <div class="card-header bg-transparent">
                <h1><b>{{$select_menu->name}}</b></h1>
            </div>
            <div class="card-body">
                @foreach($menu_pages as $page)
                    @if($page->menu_id == $select_menu->id && $page->is_open == '1')
                    <div class="card-body">               
                        <div class="col-md-3 text-list"><p>{{ $page->created_at }}</p></div>                                                                  
                        <div class="col-md-9 text-list"><p><a href="{{ route('page', [$navbar->name,$select_menu->name,$page->name]) }}">{{ $page->title }}</a></p></div>                                                                  
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
@else
    <div id="content" class="col-md-10">
        <div class="card border-light" style="border: none;">

            <div class="card-header bg-transparent">
                <h1><b>{{$menu_pages->title}}</b></h1>
            </div>
            <div class="card-body">  
                {!! clean($menu_pages->content) !!}                                                                            
            </div>
        </div>
    </div>
@endif
@endsection
@section('script')
@parent
<script>
 
$(document).ready(function() {
    $(window).on('load',function(){
        $('#my_modal').modal('show');
    });
    $('#toggle').on('click', function() {
        if ($('#toggle').hasClass('fa-eye')) {             
            $('#toggle').removeClass("fa-eye").addClass("fa-eye-slash"); 
            $('#menu').removeClass("invisible").addClass("visible"); 
            $('#content').removeClass("col-md-12").addClass("col-md-10"); 
        }else {
            $('#toggle').removeClass("fa-eye-slash").addClass("fa-eye");
            $('#menu').removeClass("visible").addClass("invisible");
            $('#content').removeClass("col-md-10").addClass("col-md-12");
        }        
    });  
});

</script>
@show