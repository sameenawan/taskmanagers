@extends('frontend.layouts.default')

@section('title')
Degree Type
@stop

@if(Sentry::getUser()->hasAccess('project.create'))
	@section('head')
		
	@stop

	@section('plugins')
		<script language="javascript" type="text/javascript" src="{{ asset('plugins/bootstrap-modal/js/bootstrap-modal.js') }}"></script>
		<script language="javascript" type="text/javascript" src="{{ asset('plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"></script>
	@stop

	@section('scripts')
		<script language="javascript" type="text/javascript" src="{{ asset('scripts/ui-modals.js') }}"></script> 
	@stop

	@section('init_hooks')
		UIModals.init();
	@stop
@endif

@section('content')
<div class="row-fluid">
	<div class="span9">
		<h3 class="page-title">Degree Schedule</h3>
	</div>
	@if(Sentry::getUser()->hasAccess('project.create'))
		<div class="span3">
			<div class="page-title pull-right">
				{{ link_to('#responsive', 'Create', array('class' => 'btn blue', 'data-toggle' => 'modal') ) }}
			</div>
		</div>
	@endif
	<div class="clear"></div>
</div>


<?php $i = 1; ?>
@foreach($projects as $project)
			@if($i == 1)
			<div class="row-fluid">
			@endif
			<div class="span4">
				<div class="portlet box random-color" data-id="{{ $project->id }}">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-reorder"></i>
							{{ $project->name }}
						</div>
						<div class="tools">
							<a href="javascript:;" class="expand"></a>
							{{ link_to('tasks/index/'.$project->id, '', array('class' => 'icon-tasks icon-white', 'alt' => 'Tasks')) }}
							@if(Sentry::getUser()->hasAccess('project.edit'))							
								{{ link_to('projects/edit/'.$project->id, '', array('class' => 'icon-edit icon-white', 'alt' => 'Edit')) }}
							@endif
							@if(Sentry::getUser()->hasAccess('project.delete'))
								{{ link_to('projects/destroy/'.$project->id, '', array('class' => 'icon-remove icon-white', 'alt' => 'Delete')) }}
							@endif
						</div>
					</div>
					<div style="display:none;" class="portlet-body">
						<div>
							{{ $project->description }}
						</div>
					</div>
				</div>
			</div>
			@if($i%3 == 0)
			</div>
			@endif
			<?php 
				if($i%3 == 0) $i = 1;
				else $i++; 
			?>
@endforeach

@if(Sentry::getUser()->hasAccess('project.create'))
	<div id="responsive" class="modal hide fade">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Create Project</h3>
		</div>
		<div class="modal-body">
			{{ Form::open(array('action' => 'ProjectsController@postStore', 'class' => 'form-horizontal')) }}
			<div class="control-group">
				<label for="name" class="control-label">Degree Type</label>
				<div class="controls">
					{{ Form::text('name') }}
				</div>
			</div>

			<div class="control-group">
				<label for="description" class="control-label">Degree Description</label>
				<div class="controls">
					{{ Form::textarea('description') }}
				</div>
			</div>
		</div>
		<div class="modal-footer">
			{{ Form::submit('Create Project', array('class' => 'btn green')) }}
			{{ Form::close() }}
		</div>	
	</div>
@endif

@stop