@extends('_layouts.manage.app')
@section('title', __('Member').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Member').__('Manage') }}</div>
                    
                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ __('Filter') }}</a></li>
					</ul>
					{{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-inline form-group">
							<label class='control-label col-md-1'>{{ __('Name') }}</label>
							<div id="filter_col1" data-column="0" class='col-md-2'>
								<input type="text" class="form-control column_filter" id="col0_filter">
							</div>
							<label class='control-label col-md-1'>{{ __('E-Mail Address') }}</label>
							<div id="filter_col2" data-column="1" class='col-md-2'>
								<input type="text" class="form-control column_filter" id="col1_filter">
							</div>
							{{-- 選擇隱藏爛位 --}}							
							<label class='control-label col-md-1'>{{ __('Permission') }}</label>
							<div id="filter_col3" data-column="2" class='col-md-2'>
								<select class="form-control column_filter" id="col2_filter">
									<option value="">{{ __('All') }}</option>
									@foreach (App\Enum::permission as $key => $value)
										<option value="{{ $key }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>							
						</div>
					</div>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
		                			<th class="text-nowrap text-center">{{ __('Name') }}</th>
		                			<th class="text-nowrap text-center">{{ __('E-Mail Address') }}</th>
		                			<th class="text-nowrap text-center" style="display:none">{{ __('Permission') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Permission') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_users as $user)
									<tr>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td style="display:none">{{ $user->permission }}</td>
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
                </div>
                <div class="card-footer pagination justify-content-center">
					{!! $all_users->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
