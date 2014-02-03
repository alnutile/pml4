<?php

class Issue extends Eloquent {
	protected $guarded = array();

    protected $fillable = array('name', 'description', 'active', 'github_id', 'project_id', 'user_id');

    public static $rules = array(
        'name'=>'required|min:2',
        'description'=>'required|min:20',
    );

    public function project()
    {
        return $this->belongsTo('Project');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function getAllComments() {
        return $this->comments->toArray();
    }
}
