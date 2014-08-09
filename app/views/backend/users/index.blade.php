@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
User Management
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		User Management

		<div class="pull-right">
			<a href="{{ route('create/user') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h3>
</div>

{{ $users->links() }}

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span1">@lang('admin/users/table.id')</th>
		
			<th class="span3">@lang('admin/users/table.email')</th>
			
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			
			<td>{{ $user->email }}</td>	
		</tr>
		@endforeach
	</tbody>
</table>

{{ $users->links() }}
@stop
