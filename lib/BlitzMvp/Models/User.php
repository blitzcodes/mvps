<?php

namespace BlitzMvp\Models;

class User extends \BlitzMvp\Core\Model\Model {
	use \BlitzMvp\Core\Accounts\Account;

	public function __construct() {
	}

	public function guid() { return "This is my GUID: {$this->getGuid()}"; }
}
