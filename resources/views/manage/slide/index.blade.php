@extends('_layouts.manage.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Slide') }}{{ __('Manage') }}</div>
                    
                <div class="card-body">
					<ul class="list-unstyled">
						<li>{{ App\Button::Create() }}</li>
					</ul>
                	<table class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="active">
	                			<th class="text-nowrap text-center">{{ __('Slide') }}{{ __('Name') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Page') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Sort') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
	                		</tr>
	                	</thead>
	                	<tbody>
							@foreach ($slides as $slide)
								<tr>
									<td>{{ $slide->name }}</td>
									<td>{{ App\Page::where('id','=',$slide->page_id)->first('name')['name'] }}</td>
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
