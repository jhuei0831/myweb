@extends('_layouts.manage.app')
@section('title', __('Slide').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Slide').__('Manage') }}</div>
                    
                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item">{{ App\Button::To(true,'sort',__('Sort'),'','btn-primary') }}</li>
						<li class="list-inline-item"><a class="btn btn-sm btn-primary" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search"><i class="fas fa-filter"></i> {{ __('Filter') }}</a></li>
					</ul>
					<div class="alert alert-warning" role="alert">
                        1. 輪播圖片尺寸大小請裁剪成統一大小。<br>
                    </div>
                    {{-- 篩選器設定 --}}
                    <div class="collapse" id="search">
	                    <div class="form-group row">
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Slide').__('Name') }}</label>
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
							<label class='col-md-2 col-form-label text-md-right'>{{ __('Is_open') }}</label>
							<div id="filter_col3" data-column="5" class='col-md-3'>
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
		                			<th class="text-nowrap text-center">{{ __('Slide').__('Name') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Image') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Link') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Sort') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
		                			{{-- 設一個隱藏爛位提供篩選 --}}
		                			<th class="text-nowrap text-center" style="display:none">{{ __('Is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_slides as $slide)
									<tr>
										<td>{{ $slide->name }}</td>
										<td><a target='_blank' href="{{ $slide->image }}"><i class="far fa-images"></i></a></td>
										<td>
											@isset ($slide->link)
											    <a href="{{ $slide->link }}" target="_blank" rel = "noopener noreferrer"><i class="fas fa-link"></i></a>
											@endisset											
										</td>
										<td>{{ $slide->sort }}</td>
										<td>
											<font color="{{App\Enum::is_open['color'][$slide->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$slide->is_open]}}"></i></font>
										</td>
										{{-- 設一個隱藏爛位提供篩選 --}}
										<td style="display:none">{{ $slide->is_open }}</td>
										<td>
											<form action="{{ route('slide.edit',$slide->id) }}" method="GET">
											@csrf
											{{ App\Button::edit($slide->id) }}
											</form>
											<form action="{{ route('slide.destroy',$slide->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::deleting($slide->id) }}
											</form>
										</td>
									</tr>
		                		@endforeach
		                	</tbody>
	                    </table>	
                    </div>
                </div>
                {{-- <div class="card-footer pagination justify-content-center">
					{!! $all_slides->links("pagination::bootstrap-4") !!}
				</div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

