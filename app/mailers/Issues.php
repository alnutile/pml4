<?php namespace Mailers;

class Issues extends Mailer {

    public function new_issue($issue)
    {
        $this->subject  = 'New Issue #' . $issue->id . " $issue->name";
        $this->view     = 'emails.issues.new';
        $this->data     = array('description' => $issue->description, 'issue_id' => $issue->id, 'project_id' => $issue->project_id);

        return $this;
    }
}