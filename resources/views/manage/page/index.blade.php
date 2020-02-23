@extends('_layouts.manage.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">頁面管理</div>
                    
                <div class="card-body">
					<ul class="list-unstyled">
						<li>{{ App\Button::Create() }}</li>
					</ul>
                	<table class="table table-hover table-bordered text-center">
	                	<thead>
	                		<tr class="active">
	                			<th class="text-nowrap text-center">{{ __('Page name') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Navbar') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Title') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Page url') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Is_open') }}</th>
	                			<th class="text-nowrap text-center">{{ __('Action') }}</th>	                			
	                		</tr>
	                	</thead>
	                	<tbody>
							@foreach ($pages as $page)
								<tr>
									<td>{{ $page->name }}</td>
									<td>{{ App\Navbar::where('id','=',$page->navbar_id)->first('name')['name'] }}</td>
									<td>{{ $page->title }}</td>
									<td>{{ $page->url }}</td>
									<td><font color="{{App\Enum::is_open['color'][$page->is_open]}}"><i class="fas fa-{{App\Enum::is_open['label'][$page->is_open]}}"></i></font></td>
									<td>{{ App\Button::edit($page->id) }}
										{{ App\Button::deleting($page->id) }}</td>
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
