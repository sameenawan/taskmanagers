<?php

class TasksController extends \AuthorizedController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex($id)
	{
		//
		if(Sentry::getUser()->hasAnyAccess(array('task.create', 'task.edit', 'task.delete'))){
			$project = Project::find($id);

			$tasks = $project->tasks();
			if(! Input::has('showInCompleted')){
				$showCompleted = true;
				$tasks->whereNotNull('is_complete');
			} 
			else {
				$showCompleted = false;
				$tasks->whereNull('is_complete');
			}

			// User can not see all tasks
			if(! Sentry::getUser()->hasAccess('admin')){
				$tasks->where('user_id', '=', Sentry::getUser()->id);
			}

			$tasks = $tasks->get();

			$timeFields = array();
			if(count($tasks) > 0){
				foreach($tasks[0]->time as $key => $value){
					$timeFields[] = $key;
				}
			}

			return View::make('frontend.tasks.index')
				->with('project', $project)
				->with('tasks', $tasks)
				->with('timeFields', $timeFields)
				->with('showCompleted', $showCompleted);
		}
		else {
			return Redirect::back()->with('error', 'You do not have permission.');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($id = null)
	{
		//
		if(! Sentry::getUser()->hasAccess('task.create'))
			return Redirect::back()->with('error', 'You do not have permission.');

		$project = (($id != null) ? Project::find($id) : null);
		return View::make('frontend.tasks.create')
			->with('project', $project);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		//
		$task = new Task;

		$task->name = Input::get('name');
		$task->description = Input::get('description');
		$task->project_id = Input::get('project_id');
		$task->user_id = Sentry::getUser()->id;
		$task->due_date = date('Y-m-d');
		$task->is_complete = null;
		$task->outcome = Input::get('outcome', '');
		$task->verification = Input::get('verification', '');
		$task->time = Input::get('time');
		if(Input::has('is_complete') || (! Sentry::getUser()->hasAccess('task.change_status'))){
			$task->is_complete = date('Y-m-d');
		}
		$task->assigned_user_id = Sentry::getUser()->id;

		$validation = $task->validation();

		if($validation->passes()){
			$task->save();

			return Redirect::to('tasks/index/'.$task->project_id)->with('success', 'Task has been added and assigned.');
		}
		else {
			return Redirect::back()->withErrors($validation)->withInput();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		//
		if(! Sentry::getUser()->hasAccess('task.edit'))
			return Redirect::back()->with('error', 'You do not have permission.');

		return View::make('frontend.tasks.edit')
			->with('task', Task::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate()
	{
		//
		if(! Sentry::getUser()->hasAccess('task.edit'))
			return Redirect::back()->with('error', 'You do not have permission.');

		$task = Task::find(Input::get('task_id'));

		$task->name = Input::get('name');
		$task->description = Input::get('description');
		$task->project_id = Input::get('project_id');
//		$task->user_id = Sentry::getUser()->id;
//		$task->due_date = date('Y-m-d');
//		$task->is_complete = null;
		$task->outcome = Input::get('outcome', '');
		$task->verification = Input::get('verification', '');
		$task->time = Input::get('time');
		$task->assigned_user_id = Sentry::getUser()->id;

		$validation = $task->validation();

		if($validation->passes()){
			$task->save();

			return Redirect::to('tasks/index/'.$task->project->id)->with('success', 'Task has been modified.'); 
		}
		else {
			return Redirect::back()->withErrors($validation)->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id)
	{
		//
		if(! Sentry::getUser()->hasAccess('task.delete'))
			return Redirect::back()->with('error', 'You do not have permission.');

		$task = Task::find($id);
		$task->delete();

		return Redirect::back()->with('success', 'Task has been removed successfully.');
	}

	/**
	 * Mark task/s completed.
	 *
	 * @param array $_POST['id']
	 * @return Redirect back
	 */
	public function postMarkCompleted(){
		if(! Sentry::getUser()->hasAccess('task.change_status'))
			return Redirect::back()->with('error', 'You do not have permission.');

		$tasks = Input::get('id');

		foreach($tasks as $task_id){
			$task = Task::find($task_id);
			
			if($task->is_complete != null)
				$task->is_complete = null;
			else
				$task->is_complete = date('Y-m-d', time());

			$task->save();
		}

		return Redirect::back()->with('success', 'Task(s) in/completed successfully.');
	}

	/**
	 * Returns all task assigned to logged in user
	 *
	 * @return Response View
	 */
	public function getMy(){
		$tasks = Task::where('assigned_user_id', Sentry::getUser()->id);

		if(! Input::has('showInCompleted')){
			$showCompleted = true;
			$tasks->whereNotNull('is_complete');
		} 
		else {
			$showCompleted = false;
			$tasks->whereNull('is_complete');
		}

		$tasks = $tasks->get();

		$timeFields = array();
		if(count($tasks) > 0){
			foreach($tasks[0]->time as $key => $value){
				$timeFields[] = $key;
			}
		}

		return View::make('frontend.tasks.my')
			->with('tasks', $tasks)
			->with('timeFields', $timeFields)
			->with('showCompleted', $showCompleted);
	}

}