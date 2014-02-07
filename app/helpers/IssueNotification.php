<?php


class IssueNotification implements NotificationsHelpers {

    protected $model;
    protected $mailer;
    protected $sent;
    protected $failed;
    protected $results;


    public function __construct(Project $model, Mailers\Issues $mailer)
    {
        $this->model = $model;
        $this->mailer = $mailer;
    }

    public function notify($params = array())
    {

        list($issue) = $params;

        $mailed[0] = array();
        $mailed[1] = array();
        $mailed['results'] = null;
        $project = $this->model->find($issue->project_id);
        $users = $project->getUsersEmails();
        foreach($users as $key => $value) {
            $mailer = new $this->mailer($value);
            $results = $mailer->new_issue($issue)->deliver();
            $mailed[$results][] = $value;
        }

        $this->sent = count($mailed[1]);
        $this->failed = count($mailed[0]);
        $this->results = $mailed;
        $this->setSessionResults();
        return array('sent' => count($mailed[1]), 'failed' => count($mailed[0]), 'results' => $mailed);
    }

    public function setSessionResults()
    {
        $sent_to = implode($this->results[1]);
        $failed_to = implode($this->results[0]);
        (empty($failed_to)) ? $failed_to = 'none' : null ;
        ($this->failed === 0) ?$this->failed = 'none' : $this->failed = "Yes :(" ;

        Session::put('emailsSent', "Emails sent {$this->sent}");
        Session::put('type', 'success');
        Session::put('emailsFailed', "Emails Failed {$this->failed}");
        Session::put('type', 'danger');
        Session::put('emailsWho', "Emails sent {$this->sent}");
        Session::put('type', 'success');
        Session::put('emailsSent', "Emailed {$sent_to}");
        Session::put('type', 'success');
        Session::put('emailsWhoFailed', "Failed Emails are {$failed_to}");
        Session::put('type', 'danger');
    }


}