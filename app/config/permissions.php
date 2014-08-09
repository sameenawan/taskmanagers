<?php

return array(

	'Global' => array(
		array(
			'permission' => 'superuser',
			'label'      => 'Super Admin',
		),
	),

	'Admin' => array(
		array(
			'permission' => 'admin',
			'label'      => 'Manage Users & Groups',
		),
	),

	'Projects' => array(
		array(
			'permission'	=> 'project.create',
			'label'			=> 'Create Project'
		),
		array(
			'permission'	=> 'project.edit',
			'label'			=> 'Edit Project'
		),
		array(
			'permission'	=> 'project.delete',
			'label'			=> 'Delete Project'
		),
	),

	'Tasks' => array(
		array(
			'permission'	=> 'task.create',
			'label'			=> 'Create Task'
		),
		array(
			'permission'	=> 'task.edit',
			'label'			=> 'Edit Task'
		),
		array(
			'permission'	=> 'task.delete',
			'label'			=> 'Delete Task'
		),
		array(
			'permission'	=> 'task.change_status',
			'label'			=> 'Mark Complete/Incomplete'
		),
	)

);
