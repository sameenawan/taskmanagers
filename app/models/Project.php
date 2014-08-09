<?php

class Project extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name'			=>	'required|max:255',
		'description'	=>	'required',
		'user_id'		=>	'required'
	);

	public function tasks(){
		return $this->hasMany('Task');
	}

	public function validation(){
		foreach(self::$rules as $key => $value){
			$data[$key] = $this->{$key};
		}

		return Validator::make($data, self::$rules);
	}
}
