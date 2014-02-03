<?php

class Comment extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
        'body'   => 'required|min:20',
        'user_id'       => 'required',
        'issue_id'      => 'required',
    );

    public function issue()
    {
        return $this->belongsTo('Issue');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}
