<?php

class Project extends BaseModel {
	protected $guarded = array();

    protected $fillable = array('name', 'description', 'active', 'accountingurl', 'giturl');

    public function  __construct()
    {
        parent::__construct();
    }

    public static $rules = array(
        'name'=>'required|min:2',
        'description'=>'required|min:20',
    );

    public function users() {
        return $this->belongsToMany('User');
    }

    public function getAllPeople() {
        return $this->users->toArray();
    }

    public function getUsersSelectedOptionList() {
        $people = $this->users;
        $options = array();
        foreach($people as $person) {
            $options[] = $person->id;
        }
        return $options;
    }

    public function issues()
    {
        return $this->hasMany('Issue');
    }

    public function getAllIssues() {
        return $this->issues->toArray();
    }
}
