<?php namespace Controllers\Account;

use AuthorizedController;
use Redirect;

class DashboardController extends AuthorizedController {

	public function getIndex()
	{

		return Redirect::route('profile');
	}

}
