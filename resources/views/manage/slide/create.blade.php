@extends('_layouts.manage.app')
@section('title', __('Slide').__('Create'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('slide.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header">{{ __('Slide').__('Create') }}</div>
                    <div class="card-body">  
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('slide.index')) }}</li>
                        </ul>                 
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Slide').__('Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Slide') }}{{ __('Name') }}">
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
                                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="{{ __('Link') }}">
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
                                <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="{{ __('Image') }}" value="{{ old('image') }}">
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
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open1" value="1">
                                    <label class="custom-control-label" for="is_open1">{{ __('Yes') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_open" id="is_open2" value="0">
                                    <label class="custom-control-label" for="is_open2">{{ __('No') }}</label>
                                </div>
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
@section('script')
@parent
<script>
    $('#lfm').filemanager('image');
</script>
@endsection
