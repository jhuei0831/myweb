@extends('_layouts.manage.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('slide.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header">{{ __('Slide') }}{{ __('Create') }}</div>
                    <div class="card-body">  
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('slide.index')) }}</li>
                        </ul>                 
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-1 col-form-label">{{ __('Slide') }}{{ __('Name') }}</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Slide') }}{{ __('Name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="page_id" class="col-sm-1 col-form-label">{{ __('Page') }}</label>
                            <div class="col-sm-4">
                                <select class='form-control' name='page_id' aria-describedby="pageHelp">
                                    <option value=''>{{ __('Please choose') }}{{ __('Page') }}</option>
									@foreach($pages as $key => $value)
										<option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
									@endforeach
								</select>
			                    <span id="pageHelp" class="help-block">
			                        若沒有選擇特定頁面則全域播放。
			                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-1 col-form-label">{{ __('Image') }}</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}" placeholder="{{ __('Image') }}">
                                @error('image')
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
