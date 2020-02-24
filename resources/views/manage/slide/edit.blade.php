@extends('_layouts.manage.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Slide') }}{{ __('Edit') }}</div>
                    
                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('slide.index')) }}</li>
					</ul>
                	<form method="POST" action="{{ route('slide.update' , $slide->id) }}">
                		@csrf
						@method('PUT')
						<div class="form-group row">
                            <label for="name" class="col-sm-1 col-form-label">{{ __('Slide') }}{{ __('Name') }}</label>
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
                            <label for="page_id" class="col-sm-1 col-form-label">{{ __('Page') }}</label>
                            <div class="col-sm-4">
                                <select class='form-control' name='page_id' required aria-describedby="navHelp">
                                    @foreach($pages as $key => $value)
                                        @if ($value['id'] == $slide->id)
                                            <option value="{{ $value['id'] }}" selected>{{ $value['name'] }}</option>
                                        @else
                                            <option value="{{ $value['id'] }}">{{ __('Page') }}</option>
                                        @endif
									@endforeach
								</select>
			                    <span id="navHelp" class="help-block">
			                        選擇要加入的導覽列項目。
			                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-1 col-form-label">{{ __('Image') }}</label>                          
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}" placeholder="{{ __('Image') }}">
                                    <span class='input-group-text'>
                                        <a target='_blank' href="{{ asset('/images/slide/'.$slide->image) }}"><i class="far fa-image"></i> 觀看圖片</a>
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
