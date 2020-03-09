@extends('_layouts.manage.app')
@section('title',__('Slide').__('Edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Slide').__('Edit') }}</div>
                    
                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('slide.index')) }}</li>
					</ul>
                	<form method="POST" action="{{ route('slide.update' , $slide->id) }}" enctype="multipart/form-data">
                		@csrf
						@method('PUT')
						<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Slide').__('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $slide->name }}" required autocomplete="{{ __('Slide') }}{{ __('Name') }}" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-md-4 col-form-label text-md-right">{{ __('Link') }}</label>
                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ $slide->link }}" autocomplete="{{ __('Link') }}">
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="input-group col-md-6">
                                <div class="input-group-prepend">
                                    <a id="lfm" data-input="image" data-preview="holder" class="btn btn-secondary">
                                        <i class="far fa-folder-open"></i>
                                    </a>
                                </div>
                                <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="{{ __('Image') }}" value="{{ $slide->image }}">
                                <img id="holder" style="margin-top:15px;max-height:100px;">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ __('Is_open') }}</label>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open1" value="1" {{ ($slide->is_open=="1")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_open1">{{ __('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open2" value="0" {{ ($slide->is_open=="0")? "checked" : "" }}>
                                    <label class="custom-control-label" for="is_open2">{{ __('No') }}</label>
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
