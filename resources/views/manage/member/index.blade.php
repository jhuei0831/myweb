@extends('_layouts.manage.app')
@section('title', __('Member').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Member').__('Manage') }}</div>
                    
                <div class="card-body">
					<ul class="list-unstyled">
						<li>{{ App\Button::Create() }}</li>
					</ul>
                	<table class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="table-info active">
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
									<td>
										<form action="{{ route('member.destroy',$user->id) }}" method="POST">
										@method('DELETE')
										@csrf
										{{ App\Button::edit($user->id) }}
										{{ App\Button::deleting($user->id) }}
										</form>
									</td>
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
