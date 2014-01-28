<?php

class Project extends Eloquent {
	protected $guarded = array();

    protected $fillable = array('name', 'description', 'active', 'accountingurl', 'giturl');

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

    public function issues()
    {
        return $this->hasMany('Issue');
    }

    public function getAllIssues() {
        return $this->issues->toArray();
    }
}
