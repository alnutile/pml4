<?php
use Zizaco\Confide\ConfideUser;

class User extends ConfideUser {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

    protected $fillable = array('firstname, lastname, email', 'admin');

    public function is_admin()
    {
        return (bool) $this->admin;
    }

    static public function allPeopleSelectOptions() {
        $people = User::all();
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

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}