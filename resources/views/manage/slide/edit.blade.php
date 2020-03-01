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
                            <label for="name" class="col-sm-1 col-form-label">{{ __('Slide').__('Name') }}</label>
                            <div class="col-sm-4">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $slide->name }}" required autocomplete="{{ __('Slide') }}{{ __('Name') }}" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link" class="col-sm-1 col-form-label">{{ __('Link') }}</label>
                            <div class="col-sm-4">
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ $slide->link }}" autocomplete="{{ __('Link') }}">
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-1 col-form-label">{{ __('Image') }}</label>                          
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="{{ __('Image') }}">
                                    <span class='input-group-text'>
                                        <a target='_blank' href="{{ asset('/images/slide/'.$slide->image) }}"><i class="far fa-image"></i>觀看圖片</a>
                                    </span>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_open" class="col-sm-1 col-form-label">{{ __('Is_open') }}</label>
                            <div class="col-md-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_open" id="is_open" value="1" {{ ($slide->is_open=="1")? "checked" : "" }}>
                                    <label class="form-check-label" for="inlineRadio1">{{ __('Yes') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_open" id="is_open" value="0" {{ ($slide->is_open=="0")? "checked" : "" }}>
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