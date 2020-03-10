@extends('_layouts.manage.app')
@section('title', __('Menu').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Menu').__('Manage') }}</div>
                    
                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item">{{ App\Button::To(true,'sort',__('Sort'),'','btn-primary') }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ __('Filter') }}</a></li>
					</ul>
					<div class="alert alert-warning" role="alert">
                        若有建立連結，點擊選單則直接跳到該連結頁面。<br>
                    </div>
                    {{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-group row">
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Menu').__('Name') }}</label>
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
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Is_list') }}</label>
							<div id="filter_col3" data-column="4" class='col-md-3'>
								<select class="form-control column_filter" id="col4_filter">
									<option value="">{{ __('All') }}</option>
									<option value="1">{{ __('Yes') }}</option>
									<option value="0">{{ __('No') }}</option>
								</select>
							</div>					
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Is_open') }}</label>
							<div id="filter_col4" data-column="5" class='col-md-3'>
								<select class="form-control column_filter" id="col5_filter">
									<option value="">{{ __('All') }}</option>
									<option value="1">{{ __('Yes') }}</option>
									<option value="0">{{ __('No') }}</option>
								</select>
							</div>
						</div>
						
						<div class="form-group row"> 
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Navbar') }}</label>
							<div id="filter_col5" data-column="1" class='col-md-3'>
								<select class="form-control column_filter" id="col1_filter">
									<option value="">{{ __('Please choose') }}</option>
									@foreach ($all_navbars as $navbar)
										<option value="{{ $navbar->name }}">{{ $navbar->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
		                			<th class="text-nowrap text-center">{{ __('Menu').__('Name') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Navbar') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Link') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Sort') }}</th>
		                			{{-- 設置隱藏爛位提供篩選 --}}
		                			<th class="text-nowrap text-center" style="display:none">{{ __('Is_list') }}</th>
		                			<th class="text-nowrap text-center" style="display:none">{{ __('Is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Is_list') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_menus as $menu)
									<tr>
										<td>{{ $menu->name }}</td>
										<td>{{ App\Navbar::where('id','=',$menu->navbar_id)->first('name')['name'] }}</td>
										<td>{{ $menu->link }}</td>
										<td>{{ $menu->sort }}</td>
										{{-- 設置隱藏爛位提供篩選 --}}
										<td style="display:none">{{ $menu->is_list }}</td>										
										<td style="display:none">{{ $menu->is_open }}</td>
										<td><font color="{{App\Enum::is_open['color'][$menu->is_list]}}"><i class="fas fa-{{App\Enum::is_open['label'][$menu->is_list]}}"></i></font></td>
										<td><font color="{{App\Enum::is_open['color'][$menu->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$menu->is_open]}}"></i></font></td>
										<td>
											<form action="{{ route('menu.edit',$menu->id) }}" method="GET">
											@csrf
											{{ App\Button::edit($menu->id) }}
											</form>
											<form action="{{ route('menu.destroy',$menu->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::deleting($menu->id) }}
											</form>
										</td>									
									</tr>
		                		@endforeach
		                	</tbody>
		                </table>	
					</div>               	
                </div>
                {{-- <div class="card-footer pagination justify-content-center">
					{!! $all_menus->links("pagination::bootstrap-4") !!}
				</div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
