<?php namespace Mailers;

abstract class Mailer {
    protected $to;
    protected $email;
    protected $subject;
    protected $view;
    protected $data = array();

    public function __construct($user = null)
    {
        ( $user == null ) ? $email = \Auth::user()->email : $email = $user;
        $this->to     = "Username: ";
        $this->email       = $email;
    }

    public function deliver()
    {
        return \Mail::send($this->view, $this->data, function($message)
        {
                $message->to($this->email, $this->email)->subject($this->subject);
        });
    }

}