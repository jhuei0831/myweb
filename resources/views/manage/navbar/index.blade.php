@extends('_layouts.manage.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">導覽列管理</div>
                    
                <div class="card-body">
					<ul class="list-unstyled">
						<li>{{ App\Button::Create() }}</li>
					</ul>
                	<table class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="active">
	                			<th class="text-nowrap text-center">{{ __('Navbar name') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Link') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Type') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Sort') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
	                		</tr>
	                	</thead>
	                	<tbody>
							@foreach ($navbars as $navbar)
								<tr>
									<td>{{ $navbar->name }}</td>
									<td>{{ $navbar->link }}</td>
									<td>{{App\Enum::type['navbar'][$navbar->type]}}</td>
									<td>{{ $navbar->sort }}</td>
									<td><font color="{{App\Enum::is_open['color'][$navbar->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$navbar->is_open]}}"></i></font></td>
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
                <div class="card-footer pagination justify-content-center">
					{!! $navbars->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
