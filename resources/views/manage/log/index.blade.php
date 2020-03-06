@extends('_layouts.manage.app')
@section('title', __('Log').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Log').__('Manage') }}</div>               
                <div class="card-body">
                	<ul class="list-inline">
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ __('Filter') }}</a></li>
					</ul>
					{{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-inline form-group">
							<label class='control-label col-md-1'>{{ __('Member') }}</label>
							<div id="filter_col1" data-column="0" class='col-md-2'>
								<input type="text" class="form-control column_filter" id="col0_filter">
							</div>
							<label class='control-label col-md-1'>{{ __('IP') }}</label>
							<div id="filter_col2" data-column="1" class='col-md-2'>
								<input type="text" class="form-control column_filter" id="col1_filter">
							</div>
							{{-- 選擇隱藏爛位 --}}							
							<label class='control-label col-md-1'>{{ __('Browser') }}</label>
							<div id="filter_col3" data-column="2" class='col-md-2'>
								<select class="form-control column_filter" id="col2_filter">
									<option value="">{{ __('All') }}</option>
									@foreach (App\Enum::browser as $key => $value)
										<option value="{{ $value }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>	
							<label class='control-label col-md-1'>{{ __('Action') }}</label>
							<div id="filter_col4" data-column="3" class='col-md-2'>
								<select class="form-control column_filter" id="col3_filter">
									<option value="">{{ __('All') }}</option>
									@foreach (App\Enum::action as $key => $value)
										<option value="{{ $value }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>						
						</div>
					</div>
                	<table id="data" class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="table-info active">
	                			<th class="text-nowrap text-center">{{ __('Member') }}</th>
	                			<th class="text-nowrap text-center">{{ __('IP') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Browser') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
	                			<th class="text-nowrap text-center">{{ __('Table') }}</th>	                			
	                			<th class="text-nowrap text-center">{{ __('Created_at') }}</th>	                			
	                			<th class="text-nowrap text-center">*</th>	                			
	                		</tr>
	                	</thead>
	                	<tbody>
							@foreach ($logs as $log)
								<tr>
									<td>{{ $log->user }}</td>
									<td>{{ $log->ip }}</td>
									<td>{{ $log->browser }}</td>
									<td>{{ $log->action }}</td>
									<td>{{ $log->table }}</td>
									<td>{{ $log->created_at }}</td>
									<td>
										<form action="{{ route('log.show',$log->id) }}" method="GET">
										@csrf
										{{ App\Button::detail($log->id) }}
										</form>
									</td>
								</tr>
	                		@endforeach
	                	</tbody>
                    </table>
                </div>
                <div class="card-footer pagination justify-content-center">
					{!! $logs->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
