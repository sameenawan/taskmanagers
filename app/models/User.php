<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel {

	/**
	 * Indicates if the model should soft delete.
	 *
	 * @var bool
	 */
	protected $softDelete = true;

	public function task(){
		return $this->hasMany('Task');
	}

	/**
	 * Returns the user full name, it simply concatenates
	 * the user first and last name.
	 *
	 * @return string
	 */
	public function fullName()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	/**
	 * Returns the user Gravatar image url.
	 *
	 * @return string
	 */
	public function gravatar()
	{
		// Generate the Gravatar hash
		$gravatar = md5(strtolower(trim($this->gravatar)));

		// Return the Gravatar url
		return "//gravatar.org/avatar/{$gravatar}";
	}

	/**
	 * Print html field type
	 *
	 * @return void
	 */
	public static function field($defaultValue = null){
		Form::macro('userField', function($value){
			
			$data = '<select name="user_id"><option value="">-- Select --</option>';
			$selected = null;

			foreach(self::all() as $user){
				$selected = ($value == $user->id) ? 'selected' : '';
				$data .= '<option value="'.$user->id.'" '.$selected.'>'.$user->fullName().'</option>';
			}

			$data .= '</select>';

			return $data;
		});

		echo Form::userField($defaultValue);
	} 

}
