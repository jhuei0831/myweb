@extends('_layouts.home.app')
@section('content')
@foreach($pages as $page)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{$page->name}}</div>
                <div class="card-body">               
                    @php           
                        echo clean($page->content);
                    @endphp                                                                   
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

