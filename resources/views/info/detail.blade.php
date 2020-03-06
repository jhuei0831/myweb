@extends('_layouts.home.app')

@section('menu')
<div class="col-md-2">
    <nav class="navbar navbar-vertical">
        <ul class="navbar-nav">
            <li class="">
                <a class="nav-link" href="{{ route('info') }}">{{ __('Information').__('List') }}</a>
            </li>
            <li class="">
                <a class="nav-link" href="/">{{ __('Home Page') }}</a>
            </li>
        </ul>
    </nav>
</div>
@endsection

@section('content')
    @section('title',__('Information').__('Detail'))
    <div class="col-md-10">
        <div class="card border-light" style="border: none;">
            <div class="card-header bg-transparent">
                <h1><b>{{ $info_detail->title }}</b></h1>
            </div>
            <div class="card-body">               
                @php           
                    echo clean($info_detail->content);
                @endphp                                                                   
            </div>
            <div class="card-footer bg-transparent">
                <p><span class="badge badge-pill badge-primary">{{ __('Editor').' : '.$info_detail->editor }}</span></p>
                <p><span class="badge badge-pill badge-primary">{{ __('Created_at').' : '.$info_detail->created_at }}</span></p>
                <p><span class="badge badge-pill badge-primary">{{ __('Updated_at').' : '.$info_detail->updated_at }}</span></p>
            </div>
        </div>
    </div>
@endsection