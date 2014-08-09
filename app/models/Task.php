<?php

class Task extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name'	=>	'required|max:255',
		'description'	=>	'required',
		'project_id'	=>	'required|exists:projects,id',
		'due_date'		=>	'date|date_format:Y-m-d',
		'user_id'		=>	'required|exists:users,id',
		'assigned_user_id'	=>	'required|exists:users,id'
	);

	public function project(){
		return $this->belongsTo('Project');
	}

	public function createdBy(){
		return $this->belongsTo('User', 'user_id');
	}

	public function assignedUser(){
		return $this->belongsTo('User', 'assigned_user_id');
	}

	public function validation(){
		foreach(self::$rules as $key => $value){
			$data[$key] = $this->{$key};
		}

		return Validator::make($data, self::$rules);
	}

	public static function fixTime($time){
	    if ($time < 0.6) {
	        return $time;
	    }

	    $time = explode('.', $time);
	    $mins = ($time[0]*60)+$time[1];

	    return $mins;
	}

	public function setTimeAttribute($value){
		$this->attributes['time'] = json_encode($value);
	}

	public function getTimeAttribute(){
		return json_decode($this->attributes['time']);
	}

	public function totalTime(){
		$time = $this->time;
		$totalTime = 0.00;

		foreach($time as $t){
			$totalTime += $t;
		}

		return $totalTime;
	}
}
