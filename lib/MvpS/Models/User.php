<?php

namespace MvpS\Models;

class User extends \MvpS\Core\Model\Model {
	use \MvpS\Core\Accounts\Account;

	public function __construct() {
	}

	public function guid() { return "This is my GUID: {$this->getGuid()}"; }
}
