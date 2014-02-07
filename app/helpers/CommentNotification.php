<?php


class CommentNotification implements NotificationsHelpers {

    protected $model;
    protected $mailer;

    public function __construct(Project $model, Mailers\Comments $mailer)
    {
        $this->model = $model;
        $this->mailer = $mailer;
    }

    public function notify($params = array())
    {

        list($comment, $project_id, $issue_id) = $params;

        $mailed[0] = array();
        $mailed[1] = array();
        $mailed['results'] = null;
        $project = $this->model->find($project_id);
        $issue = Issue::find($issue_id);
        $users = $project->getUsersEmails();
        foreach($users as $key => $value) {
            $mailer = new $this->mailer($value);
            $results = $mailer->new_comment(compact('comment', 'project',  'issue'))->deliver();
            $mailed[$results][] = $value;
        }
        return array('sent' => count($mailed[1]), 'failed' => count($mailed[0]), 'results' => $mailed);
    }

    public function setSessionResults()
    {

    }
}