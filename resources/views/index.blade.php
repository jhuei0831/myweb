@extends('_layouts.home.app')
@section('title',__('Home Page'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="border: none;">
                <div class="card-header bg-transparent">
                    <h3 class="home-title"><b>{{ __('Information') }}</b></h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless">
                        <tbody>
                            @foreach ($info_stickys as $info_sticky)
                            <tr>
                                <td width=2%><span class="badge badge-pill badge-danger">TOP</span></td>
                                <td width=10%>{{ $info_sticky->updated_at->format('Y/m/d') }}</td>
                                <td ><a href="{{ route('info.detail',$info_sticky->id) }}">{{ str_limit($info_sticky->title,60,'…') }}</a></td>
                            </tr>
                            @endforeach
                            @foreach ($infos as $info)
                            <tr>
                                <td width=2%></td>
                                <td width=10%>{{ $info->updated_at->format('Y/m/d') }}</td>
                                <td ><a href="{{ route('info.detail',$info->id) }}">{{ str_limit($info->title,60,'…') }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-transparent text-right">
                    <a href="{{ route('info') }}" class="btn btn-link"><i class="fas fa-search"></i> 所有消息...</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
