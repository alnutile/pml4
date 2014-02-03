<?php

class IssuesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('issues.index');
	}

	public function create($project_id)
	{
        $project = Project::find($project_id);
        $model = new Issue;
        $user = Auth::user();
        $submit = array('name' => "Create issue");
        return View::make('issues.create', compact('project', 'model', 'submit', 'user'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validate = Validator::make(Input::all(), Issue::$rules);
        if($validate->passes()) {
            $issue = new Issue;
            $issue->name = Input::get('name');
            $issue->github_id = Input::get('github_id');
            $issue->project_id = Input::get('project_id');
            $issue->user_id = Input::get('user_id');
            $active = Input::get('active');
            $issue->active = (isset($active)) ? 1 : 0;
            $issue->description = Input::get('description');
            $issue->save();
            $this->notify($issue);
            return Redirect::to("projects/$issue->project_id")
                ->with('message', "Issue Created #" . $issue->id)
                ->with('type', 'success');
        }
        $project_id = Input::get('project_id');
        return Redirect::to("projects/{$project_id}/issues/create")
            ->with('message', "Seems to be an error with the form please review below")
            ->with('type', "danger")
            ->withErrors($validate)
            ->withInput();
	}

    public function notify($issue)
    {
        $project = Project::find($issue->project_id);
        $users = $project->getUsersEmails();
        foreach($users as $key => $value) {
            $mailer = new Mailers\Issues($value);
            $mailer->new_issue($issue)->deliver();
        }
    }

	public function show($pid, $issue_id)
    {
        $issue = Issue::find($issue_id);
        $comments = $issue->getAllComments();
        $project = Project::find($pid);
        return View::make('issues.show', compact('comments', 'issue', 'project'));
    }

	public function edit($project_id, $issue_id)
	{
        $model = Issue::find($issue_id);
        $project = Project::find($project_id);
        $user = Auth::user();
        return View::make('issues.edit', compact('model', 'project', 'user'));
	}

	public function update($project_id, $issue_id)
	{
        $validate = Validator::make(Input::all(), Issue::$rules);
        if($validate->passes()) {
            $issue = Issue::find($issue_id);
            $inputs = Input::all();
            $issue->name = $inputs['name'];
            $issue->github_id = $inputs['github_id'];
            $issue->project_id = $inputs['project_id'];
            $issue->user_id = $inputs['user_id'];
            $issue->description = $inputs['description'];
            $issue->active = (isset($inputs['active'])) ? $inputs['active'] : 0;
            $issue->save();
            return Redirect::to("projects/{$project_id}/issues/{$issue_id}")
                ->with('message', "Issue Updated " . $issue->name . ' - ' . $issue->id)
                ->with('type', 'success');
        }

        return Redirect::to("projects/{$project_id}/issues/{$issue_id}/edit")
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
