@extends('_layouts.home.app')

@section('content')
    @foreach($pages as $page)
        @if($page->url == Request::path())
            @section('title',$page->name)
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card border-light">
                            <div class="card-header bg-transparent"><h1>{{$page->name}}</h1></div>
                            <div class="card-body">               
                                @php           
                                    echo clean($page->content);
                                @endphp                                                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

