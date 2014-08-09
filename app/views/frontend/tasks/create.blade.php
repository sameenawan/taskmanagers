@extends('frontend.layouts.default')

@section('title')
Add Course
@stop

@section('content')
<div class="row-fluid">
	<div class="span12">
		<h3 class="page-title">Add Courses</h3>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		{{ Form::open(array('action' => array('TasksController@postStore'), 'class' => 'form-horizontal')) }}
		<div class="control-group">
			<label for="name" class="control-label">Degree</label>
			<div class="controls">
				{{ Form::select('project_id', Project::all()->lists('name', 'id'), Input::old('project_id')) }}
			</div>
		</div>
		<div class="control-group">
			<label for="name" class="control-label">Course Title</label>
			<div class="controls">
				{{ Form::text('name') }}
			</div>
		</div>
		<div class="control-group">
			<label for="description" class="control-label">Course Description</label>
			<div class="controls">
				{{ Form::textarea('description') }}
			</div>
		</div>
		<div class="control-group">
			<label for="outcome" class="control-label">Course Number</label>
			<div class="controls">
				{{ Form::textarea('outcome') }}
			</div>
		</div>
		<div class="control-group">
			<label for="verification" class="control-label">Instructor</label>
			<div class="controls">
				{{ Form::textarea('verification') }}
			</div>
		</div>
		<div class="control-group">
			Time inputs should be in minutes. e.g. 0.30 for 30 minutes, 3.32 for 3 hrs, 32 minutes
		</div>
		<div class="control-group">
			<label for="name" class="control-label">Day and Time</label>
			<div class="controls">
				{{ Form::text('time[preparation]', Input::old('time')['preparation'], array('class' =>  'time')) }}<br/>
			</div>
		</div>
		<div class="control-group">
			<label for="name" class="control-label">Location</label>
			<div class="controls">
				{{ Form::text('time[travel]', Input::old('time')['travel'], array('class' =>  'time')) }}
			</div>
		</div>
		<div class="control-group">
			<label for="name" class="control-label">Lecture Type</label>
			<div class="controls">
				{{ Form::text('time[execution]', Input::old('execution')['preparation'], array('class' =>  'time')) }}
			</div>
		</div>
		<div class="control-group">
			<label for="name" class="control-label">enroll limit</label>
			<div class="controls">
				{{ Form::text('time[reporting]', Input::old('time')['reporting'], array('class' =>  'time')) }}
			</div>
		</div>
			@if(Sentry::getUser()->hasAccess('task.change_status'))
		<div class="control-group">
			<label for="description" class="control-label">Is Complete?</label>
			<div class="controls">
				{{ Form::checkbox('is_complete') }}
			</div>
		</div>
		@endif

		{{ Form::submit('Add Task', array('class' => 'btn green')) }}
		{{ Form::close() }}
	</div>
</div>
@stop

@section('footer')
@stop