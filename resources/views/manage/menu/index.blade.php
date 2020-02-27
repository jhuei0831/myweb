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
						<li class="list-inline-item">{{ App\Button::To('sort',__('Sort'),'','btn-primary') }}</li>
					</ul>
                	<table class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="active">
	                			<th class="text-nowrap text-center">{{ __('Menu').__('Name') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Navbar') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Link') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Sort') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Is_list') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
	                		</tr>
	                	</thead>
	                	<tbody>
							@foreach ($menus as $menu)
								<tr>
									<td>{{ $menu->name }}</td>
									<td>{{ App\Navbar::where('id','=',$menu->navbar_id)->first('name')['name'] }}</td>
									<td>{{ $menu->link }}</td>
									<td>{{ $menu->sort }}</td>
									<td><font color="{{App\Enum::is_open['color'][$menu->is_list]}}"><i class="fas fa-{{App\Enum::is_open['label'][$menu->is_list]}}"></i></font></td>
									<td><font color="{{App\Enum::is_open['color'][$menu->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$menu->is_open]}}"></i></font></td>
									<td>
										<form action="{{ route('menu.destroy',$menu->id) }}" method="POST">
										@method('DELETE')
										@csrf
										{{ App\Button::edit($menu->id) }}
										{{ App\Button::deleting($menu->id) }}
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
