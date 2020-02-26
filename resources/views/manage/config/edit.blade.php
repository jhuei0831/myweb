@extends('_layouts.manage.app')
@section('title',__('Config').__('Edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Config').__('Edit') }}</div>
                    
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>{{ App\Button::GoBack(route('config.index')) }}</li>
                    </ul>
                    <p>上次更新時間：{{ $config->updated_at }}</p><br>
                	<form method="POST" action="{{ route('config.update' , $config->id) }}" enctype="multipart/form-data">
                		@csrf
						@method('PUT')
						<div class="form-group row">
                            <label for="app_name" class="col-md-1 control-label">{{ __('App name')}}</label>
                            <div class="col-sm-4">
                                <input id="app_name" type="text" class="form-control @error('app_name') is-invalid @enderror" name="app_name" value="{{ $config->app_name }}" required autocomplete="{{ __('App name')}}" autofocus>
                                @error('app_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="is_open" class="col-md-1 col-form-label">{{ __('Is_open') }}</label>
                            <div class="col-md-4">
                                <select class="form-control @error('is_open') is-invalid @enderror" name="is_open" required>
                                        <option value="1" {{ ($config->is_open=="1")? "selected" : "" }}>{{ __('Yes') }}</option>
                                        <option value="0" {{ ($config->is_open=="0")? "selected" : "" }}>{{ __('No') }}</option>
                                </select>
                            </div>
                        </div><br><hr>

                        <div class="form-group row">
                            <label for="font_family" class="col-sm-1 control-label">{{ __('Font family') }}</label>
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
                            <label for="font_size" class="col-sm-1 control-label">{{ __('Font size') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control @error('font_size') is-invalid @enderror" name="font_size" required>
                                    @foreach(App\Enum::config['font_size'] as $key => $value)
                                        @if($key == $config->font_size)
                                            <option value="{{ $key }}" style="font-size:{{ $key }};" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}" style="font-size:{{ $key }};">{{ $value }}</option>
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
                            <label for="font_weight" class="col-sm-1 control-label">{{ __('Font weight') }}</label>
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
                        </div><br><hr>
                        
                        <div class="form-group row">
                            <label for="background" class="col-sm-1 control-label">{{ __('Background') }}</label>                          
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="file" class="form-control @error('background') is-invalid @enderror" id="background" name="background" placeholder="{{ __('Background') }}">
                                    <span class='input-group-text'>
                                        @if(file_exists(public_path().'/images/background.jpg'))
                                        <a target='_blank' href="{{ asset('/images/'.$config->background) }}"><i class="far fa-image"></i>觀看圖片</a>
                                        @else
                                        <a href="#"><i class="fas fa-times-circle"></i> 目前沒有背景</a>
                                        @endif
                                    </span>
                                    @error('background')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <label for="background_color" class="col-sm-1 control-label">{{ __('Background color')}}</label>
                            <div class="col-sm-4">
                                <input id="background_color" class="form-control @error('background_color') is-invalid @enderror jscolor {required:false}" name="background_color" value="{{ $config->background_color }}"aria-describedby="bgcolorHelp">
                                <span id="bgcolorHelp" class="help-block">可輸入色碼或點選顏色。色碼HEX(如#4E070B)和RGB(如78,7,11，會轉成HEX)都能使用。主背景色有和白色做垂直線性漸層。</span>
                                @error('background_color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div><br><hr>

                        <div class="form-group row">
                            <label for="navbar_bcolor" class="col-sm-1 control-label">{{ __('Navbar background color')}}</label>
                            <div class="col-sm-4">
                                <input id="navbar_bcolor" class="form-control @error('navbar_bcolor') is-invalid @enderror jscolor {required:false}" name="navbar_bcolor" value="{{ $config->navbar_bcolor }}" required>
                                @error('navbar_bcolor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="navbar_wcolor" class="col-sm-1 control-label">{{ __('Navbar text color')}}</label>
                            <div class="col-sm-4">
                                <input id="navbar_wcolor" class="form-control @error('navbar_wcolor') is-invalid @enderror jscolor {required:false}" name="navbar_wcolor" value="{{ $config->navbar_wcolor }}" required>
                                @error('navbar_wcolor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="navbar_size" class="col-sm-1 control-label">{{ __('Navbar text size') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control @error('navbar_size') is-invalid @enderror" name="navbar_size" required>
                                    @foreach(App\Enum::config['navbar_size'] as $key => $value)
                                        @if($key == $config->navbar_size)
                                            <option value="{{ $key }}" style="font-size:{{ $key }};" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}" style="font-size:{{ $key }};">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('navbar_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
