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
						<li class="list-inline-item">{{ App\Button::To('sort',__('Sort'),'','btn-primary') }}</li>
					</ul>
                	<table class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="active">
	                			<th class="text-nowrap text-center">{{ __('Slide').__('Name') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Image') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Link') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Sort') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
	                		</tr>
	                	</thead>
	                	<tbody>
							@foreach ($slides as $slide)
								<tr>
									<td>{{ $slide->name }}</td>
									<td><a target='_blank' href="{{ $slide->image }}"><i class="far fa-images"></i></a></td>
									<td>
										<a href="{{ $slide->link }}" target="_blank" rel = "noopener noreferrer"><i class="fas fa-link"></i></a>
									</td>
									<td>{{ $slide->sort }}</td>
									<td>
										<font color="{{App\Enum::is_open['color'][$slide->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$slide->is_open]}}"></i></font>
									</td>
									<td>
										<form action="{{ route('slide.destroy',$slide->id) }}" method="POST">
										@method('DELETE')
										@csrf
										{{ App\Button::edit($slide->id) }}
										{{ App\Button::deleting($slide->id) }}
										</form>
									</td>
								</tr>
	                		@endforeach
	                	</tbody>
                    </table>
                </div>
                <div class="card-footer pagination justify-content-center">
					{!! $slides->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
