<?php

class CommentsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('comments.index');
	}

	public function create($project_id, $issue_id)
	{
        $issueFull = Issue::find($issue_id);
        $issue = $issueFull->id;
        $issue_name = $issueFull->name;
        $project = $project_id;
        $github_id = 0;
        $model = new Comment;
        $user = Auth::user();
        $submit = array('name' => "Create Comment");
        return View::make('comments.create', compact('project', 'model', 'submit', 'user', 'issue', 'issue_name', 'github_id'));
	}

	public function store($project_id, $issue_id)
	{
        $validate = Validator::make(Input::all(), Comment::$rules);
        if($validate->passes()) {
            $comment = new Comment;
            $comment->body = Input::get('body');
            $comment->user_id = Input::get('user_id');
            $comment->issue_id = Input::get('issue_id');
            $comment->github_id = Input::get('github_id');
            $comment->save();
            $mailed = $this->notify($comment, $project_id, $issue_id);
            $sent = implode(', ', $mailed["results"][1]);
            $failed = implode(', ', $mailed["results"][0]);
            return Redirect::to("projects/$project_id/issues/$issue_id")
                ->with('message', "Comment Created #" . $comment->id)
                ->with('type', 'success')
                ->with('emailsSent', "Emails sent {$mailed['sent']}")
                ->with('type', 'success')
                ->with('emailsFailed', "Emailed failed {$mailed['failed']}")
                ->with('type', 'warning')
                ->with('emailsWho', "Emailed {$sent}")
                ->with('type', 'success')
                ->with('emailsWhoFailed', "Emailed Failed {$failed}")
                ->with('type', 'danger');
        }
        return Redirect::to("projects/{$project_id}/issues/$issue_id/comments/create")
            ->with('message', "Seems to be an error with the form please review below")
            ->with('type', "danger")
            ->withErrors($validate)
            ->withInput();
	}

    public function notify($comment, $project_id, $issue_id)
    {
        $mailed[0] = array();
        $mailed[1] = array();
        $mailed['results'] = null;
        $project = Project::find($project_id);
        $issue = Issue::find($issue_id);
        $users = $project->getUsersEmails();
        foreach($users as $key => $value) {
            $mailer = new Mailers\Comments($value);
            $results = $mailer->new_comment(compact('comment', 'project',  'issue'))->deliver();
            $mailed[$results][] = $value;
        }
        return array('sent' => count($mailed[1]), 'failed' => count($mailed[0]), 'results' => $mailed);
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('comments.show');
	}

	public function edit($project_id, $issue_id, $comment_id)
	{
            $issueFull = Issue::find($issue_id);
            $issue = $issueFull;
            $issue_name = $issueFull->name;
            $project = $project_id;
            $github_id = 0;
            $model = Comment::find($comment_id);
            $user = Auth::user();
            $submit = array('name' => "Update Comment");
        return View::make('comments.edit', compact('project', 'model', 'submit', 'user', 'issue', 'issue_name', 'github_id'));
	}


	public function update($project_id, $issue_id, $comment_id)
    {
        $validate = Validator::make(Input::all(), Comment::$rules);
        if($validate->passes()) {
            $comment = Comment::find($comment_id);
            $comment->body = Input::get('body');
            $comment->user_id = Input::get('user_id');
            $comment->issue_id = $issue_id;
            $comment->github_id = Input::get('github_id');
            $comment->save();
            return Redirect::to("projects/$project_id/issues/$issue_id")
                ->with('message', "Comment Updated #" . $comment->id)
                ->with('type', 'success');
        }
        return Redirect::to("projects/{$project_id}/issues/$issue_id/comments/$comment_id/edit")
            ->with('message', "Seems to be an error with the form please review below")
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
