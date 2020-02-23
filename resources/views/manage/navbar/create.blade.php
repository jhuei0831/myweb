@extends('_layouts.manage.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('navbar.store') }}" method="POST">
                    <div class="card-header">{{ __('Navbar') }}{{ __('Create') }}</div>
                    <div class="card-body">  
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('navbar')) }}</li>
                        </ul>                 
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-1 col-form-label">{{ __('Navbar name') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Page name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="link" class="col-sm-1 col-form-label">{{ __('Link') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="{{ __('Link') }}">
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-1 col-form-label">{{ __('Type') }}</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='type' required aria-describedby="typeHelp">
									<option value=''>請選擇類型</option>
									@foreach(App\Enum::type['navbar'] as $key => $value)
										<option value='{{ $key }}'>{{ $key }}.{{ $value }}</option>
									@endforeach
								</select>
			                    <span id="typeHelp" class="help-block">
			                        導覽目錄：顯示選單目錄；</br>
			                        一般頁面：不顯示選單目錄，直接列出底下的頁面；</br>
			                        例如：點選[XXX中心]，底下還有簡介和各實驗室等選單細項，或是直接呈現介紹的頁面內容或頁面清單。
			                    </span>
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
