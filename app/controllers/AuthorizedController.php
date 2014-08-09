<?php

class AuthorizedController extends BaseController {

	/**
	 * Whitelisted auth routes.
	 *
	 * @var array
	 */
	protected $whitelist = array();

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Call parent
		parent::__construct();

		// Apply the auth filter
		$this->beforeFilter('auth', array('except' => $this->whitelist));

		// Menu
		$menu = Menu::handler('main', array('class' => 'page-sidebar-menu'));
		$menu->add('tasks/my', 'My Tasks');
		if(Sentry::getUser()->hasAnyAccess(array('task.create', 'task.edit', 'task.delete'))){
			$menu->add('projects', 'Projects'); 
		}
		if(Sentry::getUser()->hasAccess('admin')){
			$menu->add('admin/users', 'Users');
			$menu->add('admin/groups', 'Groups');
		}
	}

}
