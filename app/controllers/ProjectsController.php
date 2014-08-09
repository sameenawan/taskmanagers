<?php

class ProjectsController extends \AuthorizedController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//
		if(Sentry::getUser()->hasAnyAccess(array('task.create', 'task.edit', 'task.delete'))){
		
			$projects = Project::all();

			return View::make('frontend.projects.index')
				->with('projects', $projects);
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
	public function getCreate()
	{
		//
		if(Sentry::getUser()->hasAccess('project.create'))
			return View::make('frontend.projects.create');
		else
			return Redirect::back()->with('error', 'You do not have permission.');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		//
		if(! Sentry::getUser()->hasAccess('project.create'))
			return Redirect::back()->with('error', 'You do not have permission.');

		$project = new Project;

		$project->name = Input::get('name');
		$project->description = Input::get('description');
		$project->user_id = Sentry::getUser()->id;

		$validation = $project->validation();

		if($validation->passes()){
			$project->save();

			return Redirect::to('projects')->with('success', 'Project has been added.');
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
		if(! Sentry::getUser()->hasAccess('project.edit'))
			return Redirect::back()->with('error', 'You do not have permission.');

		$project = Project::find($id);

		return View::make('frontend.projects.edit')->with('project', $project);
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
		if(! Sentry::getUser()->hasAccess('project.edit'))
			return Redirect::back()->with('error', 'You do not have permission.');

		$project = Project::find(Input::get('id'));

		$project->name = Input::get('name');
		$project->description = Input::get('description');

		$validation = $project->validation();

		if($validation->passes()){
			$project->save();

			return Redirect::to('projects')->with('success', 'Project has been updated.');
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
		if(! Sentry::getUser()->hasAccess('project.delete'))
			return Redirect::back()->with('error', 'You do not have permission.');

		$project = Project::find($id);
		$project->tasks()->delete();
		$project->delete();

		return Redirect::back()->with('success', 'Project deleted successfully.');
	}

}