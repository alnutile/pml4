<?php

class Project extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

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
