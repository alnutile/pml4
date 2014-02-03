<?php namespace Mailers;

class Comments extends Mailer {

    public function new_comment($params = array())
    {
        $comment = $params['comment'];
        $project = $params['project'];
        $issue = $params['issue'];

        $this->subject  = 'New Comment #' . $comment->id . ' For issue ' . $issue->name;
        $this->view     = 'emails.comments.new';
        $this->data     = array('comment_id' => $comment->id, 'body' => $comment->body, 'issue_id' => $issue->id, 'project_id' => $project->id);

        return $this;
    }
}