@extends('frontend.layouts.default')

@section('title')
My Tasks
@stop

@section('content')
<div class="row-fluid">
	<div class="span8">
		@if (! $showCompleted)
			<h3 class="page-title">Incomplete <small>My Courses</small></h3>
		@else
			<h3>Completed <small>My Courses</small></h3>
		@endif
	</div>
	<div class="span4">
		<div class="page-title pull-right">
			@if(Sentry::getUser()->hasAccess('task.create'))
				{{ link_to('tasks/create/', 'Add Course', array('class' => 'btn blue')) }}
			@endif
			@if (! $showCompleted)
				{{ link_to('tasks/my/', 'Show Completed', array('class' => 'btn green')) }}
			@else
				{{ link_to('tasks/my/?showInCompleted=1', 'Show Incompleted', array('class' => 'btn red')) }}
			@endif
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<ul class="breadcrumb">
			<li>{{ link_to('projects', 'Degree Type' ) }} <i class="icon-angle-right"></i></li>
			<li>{{ link_to('tasks/my', 'My Courses') }}</li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span12 no-more-tables">
		@if(count($tasks) > 0)
		{{ Form::open(array('action' => 'TasksController@postMarkCompleted')) }}
		<div class="row-fluid">
			<div class="span12">
				<table class="table table-hover table-striped cf">
				<thead class="cf">
					<tr>
						@if(Sentry::getUser()->hasAccess('task.change_status'))
						<th></th>
						@endif
						<th>Date</th>
						<th>User</th>
						<th>Degree Type</th>
						<th>Course Title</th>
						<th>Course Description</th>
						@foreach($timeFields as $field)
						<th>{{ ucfirst($field) }} </th>
						@endforeach
						<th> . </th>
					</tr>
				</thead>
				<tbody>
					@foreach($tasks as $task)
					<tr>
						@if(Sentry::getUser()->hasAccess('task.change_status'))
						<td data-title="">
							{{ Form::checkbox('id[]', $task->id) }}
						</td>
						@endif
						<td data-title="Date">{{ $task->due_date }}</td>
						<td data-title="User">{{ $task->assignedUser->fullName() }}
						<td data-title="Project">{{ $task->project->name }}</td>
						<td data-title="Task">{{ $task->name }}</td>
						<td data-title="Description">{{ $task->description }}</td>
						@foreach($task->time as $key => $time)
						<td data-title="{{ ucfirst($key) }} Time">{{ $time }}</td>
						@endforeach
						<td data-title="Total Time">{{ $task->totalTime() }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				@if(Sentry::getUser()->hasAccess('task.change_status'))
					@if(! $showCompleted)
						{{ Form::submit('Mark as Complete', array('class' => 'btn green')) }}
					@else
						{{ Form::submit('Mark as Incomplete', array('class' => 'btn red')) }}
					@endif
				@endif
			</div>
		</div>
		{{ Form::close() }}

		@else
		<p>No tasks found</p>
		@endif
	</div>
</div>
@stop