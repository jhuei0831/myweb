@extends('_layouts.manage.app')
@section('title', __('Navbar').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Navbar').__('Manage') }}</div>
                    
                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item">{{ App\Button::To('sort',__('Sort'),'','btn-primary') }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ __('Filter') }}</a></li>
					</ul>
					<div class="alert alert-warning" role="alert">
                        1. 新增頁面連結連結請照{{Request::root()}}/article/導覽列名稱/選單名稱?頁面網址。<br>
                        2. 外部連結請直接貼上整段網址即可。
                    </div>
                    {{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-group row">
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Navbar').__('Name') }}</label>
							<div id="filter_col1" data-column="0" class='col-md-3'>
								<input type="text" class="form-control column_filter" id="col0_filter">
							</div>
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Sort') }}</label>
							<div id="filter_col2" data-column="3" class='col-md-3'>
								<input type="text" class="form-control column_filter" id="col3_filter">
							</div>
						</div>
						<div class="form-group row">
							{{-- 選擇隱藏爛位 --}}
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Type') }}</label>
							<div id="filter_col3" data-column="5" class='col-md-3'>
								<select class="form-control column_filter" id="col5_filter">
									<option value="">{{ __('All') }}</option>
									@foreach (App\Enum::type['navbar'] as $key => $value)
										<option value="{{ $key }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Is_open') }}</label>
							<div id="filter_col4" data-column="6" class='col-md-3'>
								<select class="form-control column_filter" id="col6_filter">
									<option value="">{{ __('Please choose') }}</option>
									<option value="1">{{ __('Yes') }}</option>
									<option value="0">{{ __('No') }}</option>
								</select>
							</div>
						</div>
					</div>
                    <div class="table-responsive">
	                    <table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
		                			<th class="text-nowrap text-center">{{ __('Navbar').__('Name') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Link') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Type') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Sort') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
		                			{{-- 設置隱藏爛位提供篩選 --}}
		                			<th class="text-nowrap text-center" style="display:none">{{ __('Type') }}</th>
		                			<th class="text-nowrap text-center" style="display:none">{{ __('Is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_navbars as $navbar)
									<tr>
										<td>{{ $navbar->name }}</td>
										<td>{{ $navbar->link }}</td>
										<td>{{App\Enum::type['navbar'][$navbar->type]}}</td>
										<td>{{ $navbar->sort }}</td>
										<td><font color="{{App\Enum::is_open['color'][$navbar->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$navbar->is_open]}}"></i></font></td>
										{{-- 設置隱藏爛位提供篩選 --}}
										<td style="display:none">{{ $navbar->type }}</td>										
										<td style="display:none">{{ $navbar->is_open }}</td>
										<td>
											<form action="{{ route('navbar.destroy',$navbar->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::edit($navbar->id) }}
											{{ App\Button::deleting($navbar->id) }}
											</form>
										</td>									
									</tr>
		                		@endforeach
		                	</tbody>
	                    </table>	
                    </div>            	
                </div>
                <div class="card-footer pagination justify-content-center">
					{!! $all_navbars->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
