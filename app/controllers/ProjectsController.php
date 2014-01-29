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
        $people = User::allPeopleSelectOptions();
        return View::make('projects.create', compact('project', 'people'));
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
            $project = Project::create(Input::all());
            $people = Input::get('people');
            $date = $project->created_at;
            $project->users()->attach( (array) $people, array('created_at' => $date, 'updated_at' => $date) );
            return Redirect::to('dashboard')
                ->with('message', "Project Created " . $project->name . ' - ' . $project->id)
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
