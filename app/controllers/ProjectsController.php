<?php

class ProjectsController extends BaseController {

     public function __construct() {
        $this->beforeFilter('auth');
        $this->beforeFilter('csrf', array('on'=>'post'));
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('projects.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $project = new Project;
        return View::make('projects.create', compact('project'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validate = Validator::make(Input::all(), Project::$rules);

        if($validate->passes()) {
            $project = new Project();
            $project->create(Input::all());
            return Redirect::to('dashboard')
                ->with('message', 'Project Created')
                ->with('type', 'success');
        }

        return Redirect::to('projects/create')
            ->with('message', "Looks like there is an issue with the form")
            ->with('type', "danger")
            ->withErrors($validate)
            ->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $project = Project::find($id);
        $users = $project->getAllPeople();
        $issues = $project->getAllIssues();
        return View::make('projects.show', compact('project', 'users', 'issues'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('projects.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
