@extends('_layouts.home.app')
@section('title',__('Information').__('List'))
@section('menu')
<div class="col-md-2">
    <nav class="navbar-vertical">
        <ul class="navbar-nav">
            <li class="active">
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
    <div class="col-md-10">
        <div class="card border-light" style="border: none;">
            <div class="card-header bg-transparent">
                <h1><b>{{ __('Information').__('List') }}</b></h1>
            </div>
            <div class="card-body">            
                <table class="table table-hover table-borderless">
                    <tbody>
                        @foreach ($info_stickys as $info_sticky)
                        <tr>
                            <td width=2%><span class="badge badge-pill badge-danger">TOP</span></td>
                            <td width=10%>{{ $info_sticky->updated_at->format('Y/m/d') }}</td>
                            <td class="text-list"><a href="{{ route('info.detail',$info_sticky->id) }}">{{ $info_sticky->title }}</a></td>
                        </tr>
                        @endforeach
                        @foreach ($infos as $info)
                        <tr>
                            <td></td>
                            <td>{{ $info->updated_at->format('Y/m/d') }}</td>
                            <td class="text-list"><a href="{{ route('info.detail',$info->id) }}">{{ $info->title }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                                                                 
            </div>
            <div class="card-footer pagination justify-content-center bg-transparent">
                {!! $infos->links("pagination::bootstrap-4") !!}
            </div>
        </div>
    </div>
@endsection

