@extends('_layouts.manage.app')
@section('title', __('Page').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Page').__('Manage') }}</div>
                    
                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ __('Filter') }}</a></li>
					</ul>
					<div class="alert alert-warning" role="alert">
                        1. 前台排序以頁面修改日期為主。<br>
                        2. 頁面網址唯一，用途為導向該頁面。
                    </div>
                    {{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-inline form-group">
							<label class='control-label col-md-1'>{{ __('Editor') }}</label>
							<div id="filter_col1" data-column="0" class='col-md-2'>
								<input type="text" class="form-control column_filter" id="col0_filter">
							</div>
							<label class='control-label col-md-1'>{{ __('Menu') }}</label>
							<div id="filter_col2" data-column="1" class='col-md-2'>
								<input type="text" class="form-control column_filter" id="col1_filter">
							</div>
							<label class='control-label col-md-1'>{{ __('Page').__('Url') }}</label>
							<div id="filter_col3" data-column="3" class='col-md-2'>
								<input type="text" class="form-control column_filter" id="col3_filter">
							</div>
							{{-- 選擇隱藏爛位 --}}							
							<label class='control-label col-md-1'>{{ __('Is_open') }}</label>
							<div id="filter_col4" data-column="4" class='col-md-2'>
								<select class="form-control column_filter" id="col4_filter">
									<option value="">{{ __('All') }}</option>
									<option value="1">{{ __('Yes') }}</option>
									<option value="0">{{ __('No') }}</option>
								</select>
							</div>							
						</div>
						<div class="form-inline form-group">
							<label class='control-label col-md-1'>{{ __('Is_slide') }}</label>
							<div id="filter_col5" data-column="5" class='col-md-2'>
								<select class="form-control column_filter" id="col5_filter">
									<option value="">{{ __('All') }}</option>
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
		                			<th class="text-nowrap text-center">{{ __('Editor') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Menu') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Title') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Page').__('Url') }}</th>
		                			{{-- 設置隱藏爛位提供篩選 --}}
		                			<th class="text-nowrap text-center" style="display:none">{{ __('Is_open') }}</th>
		                			<th class="text-nowrap text-center" style="display:none">{{ __('Is_Slide') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Is_slide') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_pages as $page)
									<tr>
										<td>{{ $page->editor }}</td>
										<td>{{ App\Menu::where('id','=',$page->menu_id)->first('name')['name'] }}</td>
										<td>{{ $page->title }}</td>
										<td>
											{{ $page->url }}
										</td>
										{{-- 設置隱藏爛位提供篩選 --}}
										<td style="display:none">{{ $page->is_open }}</td>
										<td style="display:none">{{ $page->is_slide }}</td>										
										<td>
											<font color="{{App\Enum::is_open['color'][$page->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$page->is_open]}}"></i></font>
										</td>
										<td>
											<font color="{{App\Enum::is_open['color'][$page->is_slide]}}"><i class="fas fa-{{App\Enum::is_open['label'][$page->is_slide]}}"></i></font>
										</td>
										<td>
											<form action="{{ route('page.destroy',$page->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::edit($page->id) }}
											{{ App\Button::deleting($page->id) }}
											</form>
										</td>
									</tr>
		                		@endforeach
		                	</tbody>
	                    </table>	
                    </div>      	
                </div>
                <div class="card-footer pagination justify-content-center">
					{!! $all_pages->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
