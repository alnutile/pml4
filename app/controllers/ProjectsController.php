<?php

class ProjectsController extends BaseController {

     protected $user;
     protected $project;

     public function __construct(User $user, Project $project) {
        $this->user = $user;
        $this->project = $project;
        $this->beforeFilter('admin');
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

	public function index()
	{
        return Redirect::to('/dashboard');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $model = new $this->project;
        $options_all = $this->user->allPeopleSelectOptions($this->user->all());
        $options_selected = array();
        $submit = array('test' => "Create Project");
        return View::make('projects.create', compact('model', 'destination', 'submit', 'options_all', 'options_selected'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        //@TODO start using the BaseModel helper
        $validate = Validator::make(Input::all(), Project::$rules);
        if($validate->passes()) {
            $project = new $this->project;
            $project->name = Input::get('name');
            $project->description = Input::get('description');
            $project->giturl = Input::get('giturl');
            $project->accountingurl = Input::get('accountingurl');
            $active = Input::get('active');
            $project->active = (isset($active)) ? 1 : 0;
            $project->save();
            if(Input::get('people') && count(Input::get('people')) > 0) {
                $people = Input::get('people');
                $date = $project->created_at;
                $project->users()->attach( (array) $people, array('created_at' => $date, 'updated_at' => $date) );
            }
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
        $project = $this->project->find($id);
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
        $model = $this->project->find($id);
        $options_all = $this->user->allPeopleSelectOptions($this->user->all());
        $options_selected = $model->getUsersSelectedOptionList();

        return View::make('projects.edit', compact('model', 'options_all', 'options_selected'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        //@TODO start using the BaseModel helper
        $validate = Validator::make(Input::all(), Project::$rules);
        $project = $this->project->find($id);
        if($validate->passes()) {
            $inputs = Input::all();
            $project->name = $inputs['name'];
            $project->description = $inputs['description'];
            $project->active = (isset($inputs['active'])) ? $inputs['active'] : 0;
            $project->giturl = $inputs['giturl'];
            $project->accountingurl = $inputs['accountingurl'];
            $project->save();
            $people = Input::get('people');
            $date = $project->updated_at;
            foreach($people as $person => $value) {
                $p[$value] = array('project_id' => $project->id, 'created_at' => $date, 'updated_at' => $date, 'user_id' => $value);
            }

            $project->users()->sync( (array) $p);
            return Redirect::to('dashboard')
                ->with('message', "Project Updated " . $project->name . ' - ' . $project->id)
                ->with('type', 'success');
        }

        return Redirect::to("projects/{$id}/edit")
            ->with('message', "Looks like there is an issue with the form")
            ->with('type', "danger")
            ->withErrors($validate)
            ->withInput();
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
