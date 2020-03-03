@extends('_layouts.manage.app')
@section('title', __('Notice').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Notice').__('Manage') }}</div>
                    
                <div class="card-body">
					<ul class="list-unstyled">
						<li>{{ App\Button::Create() }}</li>
					</ul>
                	<table class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="table-info active">
								<th class="text-nowrap text-center">{{ __('Title') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Menu') }}</th>	                			
	                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
	                		</tr>
	                	</thead>
	                	<tbody>
							@foreach ($notices as $notice)
								<tr>
									<td>{{ $notice->title }}</td>
									<td>{{ App\Menu::where('id','=',$notice->menu_id)->first('name')['name'] }}</td>
									<td>
										<font color="{{App\Enum::is_open['color'][$notice->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$notice->is_open]}}"></i></font>
									</td>
									<td>
										<form action="{{ route('notice.destroy',$notice->id) }}" method="POST">
										@method('DELETE')
										@csrf
										{{ App\Button::edit($notice->id) }}
										{{ App\Button::deleting($notice->id) }}
										</form>
									</td>
								</tr>
	                		@endforeach
	                	</tbody>
                    </table>
                </div>
                <div class="card-footer pagination justify-content-center">
					{!! $notices->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
