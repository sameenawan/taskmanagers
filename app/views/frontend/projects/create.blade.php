@extends('frontend.layouts.default')

@section('title')
Create Project ::
@parent
@stop

@section('content')

{{ Form::open(array('action' => 'ProjectsController@postStore')) }}

<h4>Degree Type</h4>
<p>{{ Form::text('name') }}</p>

<h4>Degree Description:</h4>
<p>{{ Form::textarea('description') }}</p>

{{ Form::submit('Create Schedule') }}

@stop