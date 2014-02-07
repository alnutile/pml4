<?php
use Zizaco\Confide\ConfideUser;

class User extends ConfideUser {

    public $usersAll;

	protected $table = 'users';

	protected $hidden = array('password');

    protected $fillable = array('firstname, lastname, email', 'admin');

    public function is_admin()
    {
        return (bool) $this->admin;
    }

    static public function allPeopleSelectOptions($users) {
        $people = $users;
        $options = array();
        foreach($people as $person) {
            $options[$person->id] = $person->email;
        }
        return $options;
    }


    public static $rules = array(
        'email' => 'required|email|unique:users',
        'password' => 'required|between:8,32|confirmed',
        'password_confirmation' =>  'required|between:8,32',
    );

    public function projects() {
        return $this->belongsToMany('Project');
    }

    public function getAllProjects() {
        return $this->projects->toArray();
    }

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getReminderEmail()
	{
		return $this->email;
	}
}