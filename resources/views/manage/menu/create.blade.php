@extends('_layouts.manage.app')
@section('title', __('Menu').__('Create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('menu.store') }}" method="POST">
                    <div class="card-header">{{ __('Menu').__('Create') }}</div>
                    <div class="card-body">  
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('menu.index')) }}</li>
                        </ul>                 
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-1 col-form-label">{{ __('Menu').__('Name') }}</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Menu').__('Name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="navbar_id" class="col-sm-1 col-form-label">{{ __('Navbar') }}</label>
                            <div class="col-sm-4">
                                <select class='form-control' name='navbar_id' required aria-describedby="navHelp" required>
                                    <option value=''>請選擇導覽列</option>
                                    @foreach($navbars as $key => $value)
                                        <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    @endforeach
                                </select>
                                <span id="navHelp" class="help-block">
                                    選擇要加入的導覽列項目。
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="link" class="col-sm-1 col-form-label">{{ __('Link') }}</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="{{ __('Link') }}">
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="is_list" class="col-sm-1 col-form-label">{{ __('Is_list') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_list" id="is_list" value="1">
                                <label class="form-check-label" for="inlineRadio1">{{ __('Yes') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_list" id="is_list" value="0">
                                <label class="form-check-label" for="inlineRadio2">{{ __('No') }}</label>
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
