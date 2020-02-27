@extends('_layouts.manage.app')
@section('title', __('Page').__('Manage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Page').__('Manage') }}</div>
                    
                <div class="card-body">
					<ul class="list-unstyled">
						<li>{{ App\Button::Create() }}</li>
					</ul>
                	<table class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="active">
	                			<th class="text-nowrap text-center">{{ __('Page').__('Name') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Menu') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Title') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Page').__('Url') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Is_slide') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
	                		</tr>
	                	</thead>
	                	<tbody>
							@foreach ($pages as $page)
								<tr>
									<td>{{ $page->name }}</td>
									<td>{{ App\Menu::where('id','=',$page->menu_id)->first('name')['name'] }}</td>
									<td>{{ $page->title }}</td>
									<td>
										<a href="{{ $page->url }}" target="_blank" rel = "noopener noreferrer"><i class="fas fa-link"></i></a>
									</td>
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
                <div class="card-footer pagination justify-content-center">
					{!! $pages->links("pagination::bootstrap-4") !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
