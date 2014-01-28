<?php

class Issue extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function getAllComments() {
        return $this->comments->toArray();
    }
}
