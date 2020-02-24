@extends('_layouts.manage.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('member.store') }}" method="POST">
                    <div class="card-header">{{ __('Member Create') }}</div>
                    <div class="card-body">  
                        <ul class="list-unstyled">
                            <li>{{ App\Button::GoBack(route('member.index')) }}</li>
                        </ul>                 
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('email') }}" placeholder="{{ __('Name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">{{ __('E-Mail Address') }}</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="permission" class="col-sm-2 col-form-label">{{ __('Permission') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control @error('permission') is-invalid @enderror" id="permission" name='permission' required aria-describedby="typeHelp" value="{{ old('permission') }}" placeholder="{{ __('Permission') }}">
                                    <option value=''>{{ __('Please choose')}}{{ __('Permission')}}</option>
                                    @foreach(App\Enum::permission as $key => $value)
                                        <option value='{{ $key }}'>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('permission')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{ __('Password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">{{ __('Confirm Password') }}</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
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