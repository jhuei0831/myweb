@extends('_layouts.manage.app')
@section('title', __('Notice').__('Create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('notice.store') }}" method="POST">
                    <div class="card-header">{{ __('Notice').__('Create') }}</div>
                    <div class="card-body">  
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('notice.index')) }}</li>
                        </ul>                 
                        @csrf
                        <div class="form-group row">
                            <label for="menu_id" class="col-sm-1 col-form-label">{{ __('Menu') }}</label>
                            <div class="col-sm-4">
                                <select class='form-control' name='menu_id' aria-describedby="menuHelp">
                                    <option value=''>{{ __('Please choose').__('Menu') }}</option>
									@foreach($menus as $key => $value)
										<option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
									@endforeach
								</select>
			                    <span id="menuHelp" class="help-block">
			                        選擇要加入的選單項目。
			                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-1 col-form-label">{{ __('Title') }}</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="{{ __('Title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-1 col-form-label">{{ __('Content') }}</label>
                            <div class="col-sm-12">
                                <textarea id="content" name="content" class="form-control" >{!! old('content') !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="is_open" class="col-sm-1 col-form-label">{{ __('Is_open') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_open" id="is_open" value="1">
                                <label class="form-check-label" for="inlineRadio1">{{ __('Yes') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_open" id="is_open" value="0">
                                <label class="form-check-label" for="inlineRadio2">{{ __('No') }}</label>
                            </div>
                        </div>   
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" class="btn btn-primary" value="{{ __('Create') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection