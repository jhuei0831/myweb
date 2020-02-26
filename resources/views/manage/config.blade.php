@extends('_layouts.manage.app')
@section('title',__('Config'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Config') }}</div>
                    
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>{{ App\Button::GoBack(route('config.index')) }}</li>
                    </ul>
                	<form method="POST" action="{{ route('config.update' , $config->id) }}" enctype="multipart/form-data">
                		@csrf
						@method('PUT')
						<div class="form-group row">
                            <label for="app_name" class="col-sm-1 col-form-label">{{ __('App name')}}</label>
                            <div class="col-sm-4">
                                <input id="app_name" type="text" class="form-control @error('app_name') is-invalid @enderror" name="app_name" value="{{ $config->app_name }}" required autocomplete="{{ __('App name')}}" autofocus>
                                @error('app_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="font_family" class="col-sm-1 col-form-label">{{ __('Font family') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control @error('font_family') is-invalid @enderror" name="font_family" required>
                                    @foreach(App\Enum::config['font_family'] as $key => $value)
                                        @if($key == $config->font_family)
                                            <option value="{{ $key }}" style="font-family:{{ $key }};" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}" style="font-family:{{ $key }};">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('font_family')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="font_size" class="col-sm-1 col-form-label">{{ __('Font size') }}</label>
                            <div class="col-sm-4">
                                <input id="font_size" type="number" class="form-control @error('font_size') is-invalid @enderror" name="font_size" value="{{ $config->font_size }}" autocomplete="{{ __('Font size') }}">
                                @error('font_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="font_weight" class="col-sm-1 col-form-label">{{ __('Font weight') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control @error('font_weight') is-invalid @enderror" name="font_weight" required>
                                    @foreach(App\Enum::config['font_weight'] as $key => $value)
                                        @if($key == $config->font_weight)
                                            <option value="{{ $key }}" style="font-weight:{{ $key }};" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}" style="font-weight:{{ $key }};">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('font_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_open" class="col-sm-1 col-form-label">{{ __('Is_open') }}</label>
                            <div class="col-md-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_open" id="is_open" value="1" {{ ($config->is_open=="1")? "checked" : "" }}>
                                    <label class="form-check-label" for="inlineRadio1">{{ __('Yes') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_open" id="is_open" value="0" {{ ($config->is_open=="0")? "checked" : "" }}>
                                    <label class="form-check-label" for="inlineRadio2">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
			                <div class="col-md-4">
			                    <input type="submit" class="btn btn-primary" value="送出">
			                </div>
			            </div>
                	</form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
