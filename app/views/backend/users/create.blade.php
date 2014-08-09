@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Create a User
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Create a New User

		
	</h3>
</div>

<!-- Tabs -->

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content">
	
		<div class="tab-pane active" id="tab-general">
			

			<!-- Email -->
			<div class="control-group {{ $errors->has('email') ? 'error' : '' }}">
				<label class="control-label" for="email">Email</label>
				<div class="controls">
					<input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
					{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Password -->
			<div class="control-group {{ $errors->has('password') ? 'error' : '' }}">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
					<input type="password" name="password" id="password" value="" />
					{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Password Confirm -->
			<div class="control-group {{ $errors->has('password_confirm') ? 'error' : '' }}">
				<label class="control-label" for="password_confirm">Confirm Password</label>
				<div class="controls">
					<input type="password" name="password_confirm" id="password_confirm" value="" />
					{{ $errors->first('password_confirm', '<span class="help-inline">:message</span>') }}
				</div>
			</div>


			<!-- Groups -->
			<div class="control-group {{ $errors->has('groups') ? 'error' : '' }}">
				<label class="control-label" for="groups">Groups</label>
				<div class="controls">
					<select name="groups[]" id="groups[]" multiple="multiple">
						@foreach ($groups as $group)
						<option value="{{ $group->id }}"{{ (in_array($group->id, $selectedGroups) ? ' selected="selected"' : '') }}>{{ $group->name }}</option>
						@endforeach
					</select>

					<span class="help-block">
						Select a Masters Program to assign to the student.
					</span>
				</div>
			</div>
		</div>

		

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-success">Create User</button>
		</div>
	</div>
</form>
@stop
