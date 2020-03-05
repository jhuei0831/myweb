@extends('_layouts.manage.app')
@section('title', __('Information').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Information').__('Manage') }}</div>
                    
                <div class="card-body">
					<ul class="list-inline">
						<li class="list-inline-item">{{ App\Button::Create() }}</li>
						<li class="list-inline-item">{{ App\Button::To('sort',__('Sort'),'','btn-primary') }}</li>
					</ul>
					<div class="alert alert-warning" role="alert">
                        只有置頂消息可以進行排序
                    </div>
					<div class="table-responsive">
						<table class="table table-hover table-bordered text-center">
		                	<thead>
		                		<tr class="table-info active">
									<th class="text-nowrap text-center">{{ __('Title') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Editor') }}</th>	                			
		                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
		                			<th class="text-nowrap text-center">{{ __('Is_sticky') }}</th>	                			
		                			<th class="text-nowrap text-center">{{ __('Created_at') }}</th>	                			
		                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
		                		</tr>
		                	</thead>
		                	<tbody>
								@foreach ($all_infos as $info)
									<tr>
										<td>{{ $info->title }}</td>
										<td>{{ $info->editor }}</td>
										<td>
											<font color="{{App\Enum::is_open['color'][$info->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$info->is_open]}}"></i></font>
										</td>
										<td>
											<font color="{{App\Enum::is_open['color'][$info->is_sticky]}}"><i class="fas fa-{{App\Enum::is_open['label'][$info->is_sticky]}}"></i></font>
										</td>
										<td>{{ $info->created_at }}</td>
										<td>
											<form action="{{ route('info.destroy',$info->id) }}" method="POST">
											@method('DELETE')
											@csrf
											{{ App\Button::edit($info->id) }}
											{{ App\Button::deleting($info->id) }}
											</form>
										</td>
									</tr>
		                		@endforeach
		                	</tbody>
	                    </table>	
					</div>                	
                </div>
                <div class="card-footer pagination justify-content-center">
					{!! $all_infos->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
