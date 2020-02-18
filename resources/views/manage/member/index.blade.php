@extends('_layouts.manage.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">帳號管理</div>
                    
                <div class="card-body">
					<p><button type="button" class="btn btn-primary" onclick="location.href='{{ route('member.create') }}'"><i class="fas fa-plus"></i> {{ __('Create') }}</button></p>
                	<table class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="active">
	                			<th class="text-nowrap text-center">{{ __('Name') }}</th>
	                			<th class="text-nowrap text-center">{{ __('E-Mail Address') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Permission') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
	                		</tr>
	                	</thead>
	                	<tbody>
							@foreach ($users as $user)
								<tr>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
									<td>{{App\Enum::permission[$user->permission]}}</td>
									<td>{{ App\Button::edit($user->id) }}
										{{ App\Button::deleting($user->id) }}</td>
								</tr>
	                		@endforeach
	                	</tbody>
                    </table>
                </div>
                <div class="card-footer pagination justify-content-center">
					{!! $users->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
