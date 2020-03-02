@extends('_layouts.manage.app')
@section('title', __('Notice').__('Edit'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Notice').__('Edit') }}</div>
                    
                <div class="card-body">
                	<ul class="list-unstyled">
						<li>{{ App\Button::GoBack(route('notice.index')) }}</li>
					</ul>
                	<form method="POST" action="{{ route('notice.update' , $notice->id) }}">
                		@csrf
						@method('PUT')
                        <div class="form-group row">
                            <label for="menu_id" class="col-sm-1 col-form-label">{{ __('Menu') }}</label>
                            <div class="col-sm-4">
                                <select class='form-control' name='menu_id' aria-describedby="menuHelp">
                                    <option value='NULL' {{ ($notice->menu_id) ? "selected" : "" }}>{{ __('Please choose').__('Menu') }}</option>
                                    @foreach($menus as $key => $value)
                                        @if ($value['id'] == $notice->menu_id)
                                            <option value="{{ $value['id'] }}" selected>{{ $value['name'] }}</option>
                                        @else
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endif
									@endforeach
								</select>
			                    <span id="menuHelp" class="help-block">
			                        選擇要加入的導覽列項目。
			                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-sm-1 col-form-label">{{ __('Title') }}</label>

                            <div class="col-md-4">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $notice->title }}" required autocomplete="{{ __('Title') }}" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-sm-1 col-form-label">{{ __('Content') }}</label>

                            <div class="col-md-12">
                                <textarea id="content" name="content" class="form-control ckeditor" >{{ $notice->content }}</textarea>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_open" class="col-sm-1 col-form-label">{{ __('Is_open') }}</label>
                            <div class="col-md-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_open" id="is_open" value="1" {{ ($notice->is_open=="1")? "checked" : "" }}>
                                    <label class="form-check-label" for="inlineRadio1">{{ __('Yes') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_open" id="is_open" value="0" {{ ($notice->is_open=="0")? "checked" : "" }}>
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
<script type="text/javascript">
    CKEDITOR.replace('content',
    {
        customConfig : 'config.js',
        toolbar : 'simple'
    })
</script> 
