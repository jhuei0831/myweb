@extends('_layouts.manage.app')
@section('title', __('Navbar').__('Edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Navbar').__('Edit') }}</div>
                    
                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('navbar.index')) }}</li>
					</ul>
                	<form method="POST" action="{{ route('navbar.update' , $navbar->id) }}">
                		@csrf
						@method('PUT')
						<div class="form-group row">
                            <label for="name" class="col-sm-1 col-form-label">{{ __('Navbar').__('Name') }}</label>
                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $navbar->name }}" required autocomplete="{{ __('Page name') }}" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-sm-1 col-form-label">{{ __('Link') }}</label>

                            <div class="col-md-8">
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ $navbar->link }}" autocomplete="{{ __('Link') }}" autofocus>

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
                                <select class="form-control @error('type') is-invalid @enderror" name='type' required aria-describedby="typeHelp" required>
									@foreach(App\Enum::type['navbar'] as $key => $value)
                                        @if ($key == $navbar->type)
                                            <option value='{{ $key }}' selected>{{ $value }}</option>
                                        @else
                                            <option value='{{ $key }}'>{{ $value }}</option>
                                        @endif
									@endforeach
								</select>
			                    <span id="typeHelp" class="help-block">
			                        導覽目錄：顯示選單目錄；</br>
			                        一般頁面：不顯示選單目錄，直接列出底下的頁面；</br>
			                        例如：點選[XXX中心]，底下還有簡介和各實驗室等選單細項，或是直接呈現介紹的頁面內容或頁面清單。
			                    </span>
                                @error('type')
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
                                    <input class="form-check-input" type="radio" name="is_open" id="is_open" value="1" {{ ($navbar->is_open=="1")? "checked" : "" }}>
                                    <label class="form-check-label" for="inlineRadio1">{{ __('Yes') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_open" id="is_open" value="0" {{ ($navbar->is_open=="0")? "checked" : "" }}>
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
